FROM centos
MAINTAINER Eric King <jinqiqiqi@gamil.com>


###### static lines
ADD ./conf/CentOS-Base.repo /etc/yum.repos.d/CentOS-Base.repo

RUN ["rpm", "--import", "/etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7"]
RUN yum clean all
RUN yum -y update

RUN yum install -y supervisor

ADD ./conf/book.ini /etc/supervisord.d/book.ini

RUN sed -e 's/nodaemon=false/nodaemon=true/' \
	-e 's/;\[inet_http_server\]/\[inet_http_server\]/' \
	-e 's/;port=127.0.0.1:9001/port=*:9001/' \
	-e 's/;username=user/username=user/' \
	-e 's/;password=123/password=123/' \
	-i /etc/supervisord.conf

VOLUME ["/usr/share/nginx/html/", "/var/lib/mysql/", "/var/lib/redis/", "/var/log/nginx/", "/var/log/php-fpm/", "/var/log/redis/", "/var/log/mysql/"]

ENTRYPOINT ["/usr/bin/supervisord"]

