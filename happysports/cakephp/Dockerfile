FROM centos
MAINTAINER Eric King <jinqiqiqi@gamil.com>


###### static lines
# RUN curl https://bintray.com/sbt/rpm/rpm | tee /etc/yum.repos.d/bintray-sbt-rpm.repo
ADD ./conf/CentOS-Base.repo /etc/yum.repos.d/CentOS-Base.repo

RUN rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7 && yum clean all && yum -y update 
RUN yum install -y php php-mbstring php-intl phpMyAdmin php-fpm php-mbstring php-mysql php-gd php-imap php-soap php-xmlrpc php-pecl-redis supervisor nginx wget unzip

ADD ./conf/hpp.conf /etc/nginx/conf.d/hpp.conf
ADD ./conf/hpp.ini /etc/supervisord.d/hpp.ini

RUN echo "daemon off;">> /etc/nginx/nginx.conf

RUN sed -e 's/nodaemon=false/nodaemon=true/' \
	-e 's/;\[inet_http_server\]/\[inet_http_server\]/' \
	-e 's/;port=127.0.0.1:9001/port=*:9001/' \
	-e 's/;username=user/username=user/' \
	-e 's/;password=123/password=123/' \
	-i /etc/supervisord.conf

RUN sed -e 's/daemonize = no/daemonize = yes/' \
	-e 's/;date.timezone =/date.timezone = "Asia\/Shanghai"/' \
	-e 's/display_errors = Off/display_errors = On/' \
	-e 's/upload_max_filesize = 2M/upload_max_filesize = 10M/' \

	-e 's/session.name = PHPSESSID/session.name = HAPPYSPORTS_SESSION/' \
	-e 's/session.save_handler = files/session.save_handler = redis/' \
	-e 's/;session.save_path = "\/tmp"/session.save_path = "tcp:\/\/redis:6379?weight=1\&timeout=60\&database=15"/' \

	-i /etc/php.ini

RUN sed -e 's/127.0.0.1:9000/9000/' \
		-e '/allowed_clients/d' \
		-e '/catch_workers_output/s/^;//' \
		-e '/error_log/d' \

		-e 's/php_value\[session.save_handler\] = files/php_value\[session.save_handler\] = redis/' \
		-e 's/php_value\[session.save_path\] = \/var\/lib\/php\/session/php_value\[session.save_path\] = "tcp:\/\/redis:6379?weight=1\&timeout=60\&database=10\&prefix=HAPPYSPORTS_SESSION"/' \
		-i /etc/php-fpm.d/www.conf


RUN echo "php_value[session.name] = \"HAPPYSPORTS_SESSION\"" >> /etc/php-fpm.d/www.conf
RUN echo "php_value[session.gc_maxlifetime] = 3600" >> /etc/php-fpm.d/www.conf

EXPOSE 80

ENTRYPOINT ["/usr/bin/supervisord"]

