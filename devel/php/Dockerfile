FROM centos
MAINTAINER Eric King <jinqiqiqi@gamil.com>


###### static lines
# RUN curl https://bintray.com/sbt/rpm/rpm | tee /etc/yum.repos.d/bintray-sbt-rpm.repo
# ADD ./conf/CentOS-Base.repo /etc/yum.repos.d/CentOS-Base.repo

RUN rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7 && yum install -y epel-release deltarpm

RUN rpm -ivh http://rpms.remirepo.net/enterprise/remi-release-7.rpm && rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-EPEL-7 /etc/pki/rpm-gpg/RPM-GPG-KEY-remi && yum clean all && yum -y update

RUN yum install -y php71 php71-build php71-php php71-php-ast php71-php-bcmath php71-php-cli php71-php-common php71-php-dba php71-php-dbg php71-php-devel php71-php-embedded php71-php-enchant php71-php-fpm php71-php-gd php71-php-gmp php71-php-imap php71-php-interbase php71-php-intl php71-php-json php71-php-ldap php71-php-libvirt php71-php-libvirt-doc php71-php-litespeed php71-php-lz4 php71-php-mbstring php71-php-mcrypt php71-php-mysqlnd  php71-php-odbc php71-php-opcache php71-php-pdo php71-php-pdo-dblib php71-php-pear php71-php-pecl-amqp php71-php-pecl-apcu php71-php-pecl-apcu-bc php71-php-pecl-apcu-devel php71-php-pecl-env php71-php-pecl-ev php71-php-pecl-event php71-php-pecl-gender php71-php-pecl-geoip php71-php-pecl-http php71-php-pecl-http-devel php71-php-pecl-inotify php71-php-pecl-json-post php71-php-pecl-libsodium php71-php-pecl-lua php71-php-pecl-mailparse php71-php-pecl-memcache php71-php-pecl-memcached php71-php-pecl-mysql php71-php-pecl-oauth php71-php-pecl-pcs php71-php-pecl-pcs-devel php71-php-pecl-pq php71-php-pecl-redis php71-php-pecl-scrypt php71-php-pecl-solr2 php71-php-pecl-stats php71-php-pecl-uploadprogress php71-php-pecl-uuid php71-php-pecl-varnish php71-php-pecl-xattr php71-php-pecl-yaml php71-php-pecl-zip php71-php-pgsql php71-php-process php71-php-snmp php71-php-soap php71-php-sqlsrv php71-php-tidy php71-php-xml php71-php-xmlrpc php71-runtime

RUN sed -e 's/daemonize = no/daemonize = yes/' \
	-e 's/;date.timezone =/date.timezone = "Asia\/Shanghai"/' \
	-e 's/display_errors = Off/display_errors = On/' \
	-e 's/expose_php = On/expose_php = Off/' \
	-e 's/allow_url_fopen = Off/allow_url_fopen = On/' \
	-e 's/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=1/' \

	-e 's/session.name = PHPSESSID/session.name = HAPPYSPORTS_SESSION/' \
	-e 's/session.save_handler = files/session.save_handler = redis/' \
	-e 's/;session.save_path = "\/tmp"/session.save_path = "tcp:\/\/redis:6379?weight=1\&timeout=60\&database=15"/' \

	-i /etc/opt/remi/php71/php.ini

RUN sed -e 's/127.0.0.1:9000/9000/' \
		-e '/allowed_clients/d' \
		-e '/catch_workers_output/s/^;//' \
		-e '/error_log/d' \

		-e 's/php_value\[session.save_handler\] = files/php_value\[session.save_handler\] = redis/' \
		-e 's/php_value\[session.save_path\]    = \/var\/opt\/remi\/php71\/lib\/php\/session/php_value\[session.save_path\] = "tcp:\/\/redis:6379?weight=1\&timeout=60\&database=10\&prefix=HAPPYSPORTS_SESSION"/' \
		-i /etc/opt/remi/php71/php-fpm.d/www.conf


RUN echo "php_value[session.name] = \"HAPPYSPORTS_SESSION\"" >> /etc/opt/remi/php71/php-fpm.d/www.conf
RUN echo "php_value[session.gc_maxlifetime] = 3600" >> /etc/opt/remi/php71/php-fpm.d/www.conf

RUN ln -s /usr/bin/php71 /usr/bin/php

EXPOSE 9000

ENTRYPOINT ["/opt/remi/php71/root/usr/sbin/php-fpm", "-FR"]

