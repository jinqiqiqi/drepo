#!/bin/sh

# run in mac
sudo echo "/Users -mapall=kinch:staff 192.168.1.2" >> /etc/exports
sudo nfsd restart


# in docker-machine
sudo umount /Users

sudo mount 192.168.1.2:/Users /Users -t nfs -o async,noatime,actimeo=1,nolock,vers=3,udp

