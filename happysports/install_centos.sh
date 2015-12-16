#!/bin/sh

yum update -y device-mapper-libs

tee /etc/yum.repos.d/docker.repo <<-'EOF'
[dockerrepo]
name=Docker Repository
baseurl=https://yum.dockerproject.org/repo/main/centos/$releasever/
enabled=1
gpgcheck=0
gpgkey=https://yum.dockerproject.org/gpg
EOF

yum install docker-engine -y

chkconfig docker on
service docker start

curl -L https://github.com/docker/compose/releases/download/1.5.2/docker-compose-`uname -s`-`uname -m` > /usr/local/bin/docker-compose

chmod +x /usr/local/bin/docker-compose

docker ps 

docker-compose

