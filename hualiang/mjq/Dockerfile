FROM centos
MAINTAINER Eric King <jinqiqiqi@gamil.com>


###### static lines
# RUN curl https://bintray.com/sbt/rpm/rpm | tee /etc/yum.repos.d/bintray-sbt-rpm.repo
# ADD ./conf/CentOS-Base.repo /etc/yum.repos.d/CentOS-Base.repo
RUN yum install -y epel-release

RUN rpm -ivh http://rpms.remirepo.net/enterprise/remi-release-7.rpm
RUN rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-EPEL-7 /etc/pki/rpm-gpg/RPM-GPG-KEY-remi /etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7
RUN yum clean all
RUN yum -y update 

RUN yum install -y php56 php56-build php56-php php56-php-ast php56-php-bcmath php56-php-cli php56-php-common php56-php-dba php56-php-dbg php56-php-devel php56-php-embedded php56-php-enchant php56-php-fpm php56-php-gd php56-php-gmp php56-php-imap php56-php-interbase php56-php-intl php56-php-json php56-php-ldap php56-php-libvirt php56-php-libvirt-doc php56-php-litespeed php56-php-lz4 php56-php-mbstring php56-php-mcrypt php56-php-mysqlnd  php56-php-odbc php56-php-opcache php56-php-pdo php56-php-pdo-dblib php56-php-pear php56-php-pecl-amqp php56-php-pecl-apcu php56-php-pecl-apcu-bc php56-php-pecl-apcu-devel php56-php-pecl-env php56-php-pecl-ev php56-php-pecl-event php56-php-pecl-gender php56-php-pecl-geoip php56-php-pecl-http php56-php-pecl-http-devel php56-php-pecl-inotify php56-php-pecl-json-post php56-php-pecl-libsodium php56-php-pecl-lua php56-php-pecl-mailparse php56-php-pecl-memcache php56-php-pecl-memcached php56-php-pecl-mysql php56-php-pecl-oauth php56-php-pecl-pcs php56-php-pecl-pcs-devel php56-php-pecl-pq php56-php-pecl-redis php56-php-pecl-scrypt php56-php-pecl-solr2 php56-php-pecl-stats php56-php-pecl-uploadprogress php56-php-pecl-uuid php56-php-pecl-varnish php56-php-pecl-xattr php56-php-pecl-yaml php56-php-pecl-zip php56-php-pgsql php56-php-process php56-php-snmp php56-php-soap  php56-php-tidy php56-php-xml php56-php-xmlrpc php56-runtime composer supervisor nginx
# composer

ADD ./conf/book.conf /etc/nginx/conf.d/book.conf
ADD ./conf/book.ini /etc/supervisord.d/book.ini

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

	# -e 's/session.name = PHPSESSID/session.name = ACCOUNTBOOK_SESSION/' \
	# -e 's/session.save_handler = files/session.save_handler = redis/' \
	# -e 's/;session.save_path = "\/tmp"/session.save_path = "tcp:\/\/redis:6379?weight=1\&timeout=60\&database=15"/' \

	-i /etc/opt/remi/php56/php.ini

RUN sed -e 's/127.0.0.1:9000/9000/' \
		-e '/allowed_clients/d' \
		-e '/catch_workers_output/s/^;//' \
		-e '/error_log/d' \

		# -e 's/php_value\[session.save_handler\] = files/php_value\[session.save_handler\] = redis/' \
		# -e 's/php_value\[session.save_path\] = \/var\/lib\/php\/session/php_value\[session.save_path\] = "tcp:\/\/redis:6379?weight=1\&timeout=60\&database=10\&prefix=ACCOUNTBOOK_SESSION"/' \
		-i /etc/opt/remi/php56/php-fpm.d/www.conf


RUN echo "php_value[session.name] = \"MJQ_SESSION\"" >> /etc/opt/remi/php56/php-fpm.d/www.conf
RUN echo "php_value[session.gc_maxlifetime] = 3600" >> /etc/opt/remi/php56/php-fpm.d/www.conf

RUN ln -sf /usr/bin/php56 /usr/bin/php


RUN mkdir "/usr/share/nginx/src"

WORKDIR /usr/share/nginx/html

EXPOSE 80
EXPOSE 9000

ENTRYPOINT ["/usr/bin/supervisord"]

