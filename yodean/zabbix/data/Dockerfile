FROM centos
MAINTAINER Eric King <jinqiqiqi@gamil.com>

RUN rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7 
RUN yum install -y epel-release 
RUN rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-EPEL-7 && yum clean all && yum update -y
RUN yum install -y supervisor

RUN sed -e 's/nodaemon=false/nodaemon=true/' \
	-e 's/;\[inet_http_server\]/\[inet_http_server\]/' \
	-e 's/;port=127.0.0.1:9001/port=*:9001/' \
	-e 's/;username=user/username=user/' \
	-e 's/;password=123/password=123/' \
	-i /etc/supervisord.conf

VOLUME ["/var/lib/mysql/"]

ENTRYPOINT ["/usr/bin/supervisord"]

