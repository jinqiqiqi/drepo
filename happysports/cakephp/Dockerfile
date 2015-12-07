FROM centos
MAINTAINER Eric King <jinqiqiqi@gamil.com>


###### static lines
# RUN curl https://bintray.com/sbt/rpm/rpm | tee /etc/yum.repos.d/bintray-sbt-rpm.repo
ADD ./conf/CentOS-Base.repo /etc/yum.repos.d/CentOS-Base.repo

RUN ["rpm", "--import", "/etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7"]
RUN ["yum", "clean", "all"]
RUN ["yum", "-y", "update"]

RUN yum install -y php php-mbstring php-intl phpMyAdmin nginx php-fpm php-mbstring php-mysql php-gd php-imap php-soap php-xmlrpc php-pecl-redis redis mariadb-server supervisor

# 初始化数据库
RUN mysql_install_db --user=mysql

ADD ./conf/hpp.conf /etc/nginx/conf.d/hpp.conf
ADD ./conf/hpp.ini /etc/supervisord.d/hpp.ini

RUN echo "daemon off;">> /etc/nginx/nginx.conf

RUN sed -e 's/daemonize = no/daemonize = yes/' \
	-e 's/;date.timezone =/date.timezone = "Asia\/Shanghai"/' \
	-e 's/display_errors = Off/display_errors = On/' -i /etc/php.ini

RUN sed -e 's/127.0.0.1:9000/9000/' \
		-e '/allowed_clients/d' \
		-e '/catch_workers_output/s/^;//' \
		-e '/error_log/d' \
		-i /etc/php-fpm.d/www.conf

RUN sed -e 's/nodaemon=false/nodaemon=true/' \
	-e 's/;\[inet_http_server\]/\[inet_http_server\]/' \
	-e 's/;port=127.0.0.1:9001/port=*:9001/' \
	-e 's/;username=user/username=user/' \
	-e 's/;password=123/password=123/' \
	-i /etc/supervisord.conf


EXPOSE 888 9001 1234

ENTRYPOINT ["/usr/bin/supervisord"]

