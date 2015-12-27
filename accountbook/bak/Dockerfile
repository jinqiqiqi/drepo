FROM centos
MAINTAINER Eric King <jinqiqiqi@gamil.com>


###### static lines
ADD ./conf/CentOS-Base.repo /etc/yum.repos.d/CentOS-Base.repo
RUN ["rpm", "--import", "/etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7"]
RUN ["yum", "clean", "all"]
RUN ["yum", "-y", "update"]

# 安装需要的软件
RUN yum -y install nginx php-fpm phpmyadmin mariadb-server supervisor php-mcrypt php-ldap php-magickwand php-imap php-markdown php-soap php-xmlrpc php-devel php-pecl-memcached php-pecl-uuid memcached 

# 初始化数据库
RUN mysql_install_db --user=mysql


RUN echo "daemon off;" >> /etc/nginx/nginx.conf
ADD ./conf/book.conf /etc/nginx/conf.d/book.conf

ADD ./conf/accountbook.ini /etc/supervisord.d/accountbook.ini

RUN sed -e 's/daemonize = no/daemonize = yes/' \
	-e 's/;date.timezone =/date.timezone = "Asia\/Shanghai"/' \
	-e 's/display_errors = Off/display_errors = On/' -i /etc/php.ini

RUN sed -e 's/nodaemon=false/nodaemon=true/' \
	-e 's/;\[inet_http_server\]/\[inet_http_server\]/' \
	-e 's/;port=127.0.0.1:9001/port=*:9001/' \
	-e 's/;username=user/username=user/' \
	-e 's/;password=123/password=123/' \
	-i /etc/supervisord.conf


ENV TERM dumb
ENV MYSQL_USER test
ENV MYSQL_PASS test

ADD shells/init.sh /opt/shells/init.sh
RUN chmod +x /opt/shells/init.sh 
RUN /opt/shells/init.sh

VOLUME ["/usr/share/nginx/html/"]

EXPOSE 80 9001


ENTRYPOINT ["/usr/bin/supervisord"]


