FROM centos
MAINTAINER Eric King <jinqiqiqi@gamil.com>


###### static lines
ADD ./conf/CentOS-Base.repo /etc/yum.repos.d/CentOS-Base.repo

RUN rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7 && yum clean all && yum -y update && yum install -y redis

RUN sed -e 's/bind 127.0.0.1/bind 0.0.0.0/' \
		-i /etc/redis.conf

EXPOSE 6379

ENTRYPOINT ["/usr/bin/redis-server", "/etc/redis.conf"]

