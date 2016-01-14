#!/bin/bash

#
# This script will mount /Users in the boot2docker VM using NFS (instead of the
# default vboxsf). It's probably not a good idea to run it while there are
# Docker containers running in boot2docker.
#
# Usage: sudo ./boot2docker-use-nfs.sh
#

docker-machine ssh default << EOF | grep "already mounted" &> /dev/null
  mount | grep nfs > /dev/null && \
    echo "/Users already mounted with NFS" && \
    exit
EOF

if [ "$?" == "0" ]
then
  # Already mounted
  exit
fi

if [ "$USER" != "root" ]
then
  echo "This script must be run with sudo: sudo ${0}"
  exit -1
fi

# Run command as non root http://stackoverflow.com/a/10220200/96855
B2D_IP=$(sudo -u ${SUDO_USER} docker-machine ip default)

if [ "$B2D_IP" == "" ]
then
  sudo -u ${SUDO_USER} docker-machine start default
  eval "$(sudo -u ${SUDO_USER} docker-machine env default)"
  B2D_IP=$(sudo -u ${SUDO_USER} docker-machine ip default &> /dev/null)
  #echo "You need to start boot2docker first: boot2docker up && \$(boot2docker shellinit) "
  #exit -1
fi

OSX_IP=$(ifconfig en1 | grep --word-regexp inet | awk '{print $2}')
MAP_USER=${SUDO_USER}
MAP_GROUP=$(sudo -u ${SUDO_USER} id -n -g)
RESTART_NFSD=0

EXPORTS_LINE="/Users -mapall=${MAP_USER}:${MAP_GROUP} ${OSX_IP}"
grep "$EXPORTS_LINE" /etc/exports > /dev/null
if [ "$?" != "0" ]
then
  RESTART_NFSD=1
  # Backup exports file
  $(cp -n /etc/exports /etc/exports.bak) && \
    echo "Backed up /etc/exports to /etc/exports.bak"
  # Delete previously generated line if it exists
  grep -v '^/Users ' /etc/exports > /etc/exports
  # We are using the OS X IP because the b2d VM is behind NAT
  echo "$EXPORTS_LINE" >> /etc/exports
fi

NFSD_LINE="nfs.server.mount.require_resv_port = 0"
grep "$NFSD_LINE" /etc/nfs.conf > /dev/null
if [ "$?" != "0" ]
then
  RESTART_NFSD=1
  # Backup /etc/nfs.conf file
  $(cp -n /etc/nfs.conf /etc/nfs.conf.bak) && \
      echo "Backed up /etc/nfs.conf to /etc/nfs.conf.bak"
  echo "nfs.server.mount.require_resv_port = 0" >> /etc/nfs.conf
fi

if [ "$RESTART_NFSD" == "1" ]
then
  echo "Restarting nfsd"
  nfsd update 2> /dev/null || (nfsd start && sleep 5)
fi

sudo -u ${SUDO_USER} docker-machine ssh default << EOF
  echo "Unmounting /Users"
  sudo umount /Users 2> /dev/null
  echo "Starting nfs-client"
  sudo /usr/local/etc/init.d/nfs-client start 2> /dev/null
  echo "Mounting /Users"
  sudo mount $OSX_IP:/Users /Users -o rw,async,noatime,rsize=32768,wsize=32768,proto=tcp,nfsvers=3
  echo "Mounted /Users:"
  ls -al /Users
  exit
EOF
