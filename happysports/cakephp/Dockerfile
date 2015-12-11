FROM centos
MAINTAINER Eric King <jinqiqiqi@gamil.com>


###### static lines
# RUN curl https://bintray.com/sbt/rpm/rpm | tee /etc/yum.repos.d/bintray-sbt-rpm.repo
ADD ./conf/CentOS-Base.repo /etc/yum.repos.d/CentOS-Base.repo

RUN ["rpm", "--import", "/etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7"]
RUN yum clean all
RUN yum -y update

RUN yum install -y php php-mbstring php-intl phpMyAdmin php-fpm php-mbstring php-mysql php-gd php-imap php-soap php-xmlrpc php-pecl-redis redis mariadb-server supervisor nginx wget unzip

# 初始化数据库
RUN mysql_install_db --user=mysql

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

	-e 's/session.name = PHPSESSID/session.name = HAPPYSPORTS_SESSION/' \
	-e 's/session.save_handler = files/session.save_handler = redis/' \
	-e 's/;session.save_path = "\/tmp"/session.save_path = "tcp:\/\/localhost:6379?weight=1\&timeout=60\&database=10"/' \

	-i /etc/php.ini

RUN sed -e 's/127.0.0.1:9000/9000/' \
		-e '/allowed_clients/d' \
		-e '/catch_workers_output/s/^;//' \
		-e '/error_log/d' \

		-e 's/php_value\[session.save_handler\] = files/php_value\[session.save_handler\] = redis/' \
		-e 's/php_value\[session.save_path\] = \/var\/lib\/php\/session/php_value\[session.save_path\] = "tcp:\/\/localhost:6379?weight=1\&timeout=60\&database=10\&prefix=HAPPYSPORTS_SESSION"/' \
		-i /etc/php-fpm.d/www.conf

RUN sed -e 's/\[mysqld\]/\[mysqld\]\nlower_case_table_names=1\n/' \
		-i /etc/my.cnf

RUN echo "php_value[session.name] = \"HAPPYSPORTS_SESSION\"" >> /etc/php-fpm.d/www.conf
RUN echo "php_value[session.gc_maxlifetime] = 3600" >> /etc/php-fpm.d/www.conf


# download installer packages on-line.
RUN wget -c --tries=35 --no-cookies --no-check-certificate --header "Cookie: gpw_e24=http%3A%2F%2Fwww.oracle.com%2F; oraclelicense=accept-securebackup-cookie" "http://download.oracle.com/otn-pub/java/jdk/8u66-b17/jdk-8u66-linux-x64.tar.gz" -O /opt/jdk-8u66-linux-x64.tar.gz
RUN wget -c --tries=35 http://downloads.typesafe.com/scala/2.11.7/scala-2.11.7.tgz -O /opt/scala-2.11.7.tgz
RUN wget -c --tries=35 https://dl.bintray.com/sbt/native-packages/sbt/0.13.8/sbt-0.13.8.tgz -O /opt/sbt-0.13.8.tgz

RUN tar -zxf /opt/jdk-8u66-linux-x64.tar.gz -C /opt/
RUN tar -zxf /opt/scala-2.11.7.tgz -C /opt/
RUN tar -zxf /opt/sbt-0.13.8.tgz -C /opt/


RUN alternatives --install /usr/bin/java java /opt/jdk1.8.0_66/bin/java 2 
RUN alternatives --install /usr/bin/javaws javaws /opt/jdk1.8.0_66/bin/javaws 2 
RUN alternatives --install /usr/bin/javac javac /opt/jdk1.8.0_66/bin/javac 2 
RUN alternatives --install /usr/bin/jar jar /opt/jdk1.8.0_66/bin/jar 2 
RUN alternatives --install /usr/bin/jps jps /opt/jdk1.8.0_66/bin/jps 2
RUN alternatives --install /usr/bin/javap javap /opt/jdk1.8.0_66/bin/javap 2

RUN alternatives --install /usr/bin/scala scala /opt/scala-2.11.7/bin/scala 2 
RUN alternatives --install /usr/bin/scalac scalac /opt/scala-2.11.7/bin/scalac 2 
RUN alternatives --install /usr/bin/scaladoc scaladoc /opt/scala-2.11.7/bin/scaladoc 2 
RUN alternatives --install /usr/bin/scalap scalap /opt/scala-2.11.7/bin/scalap 2

RUN alternatives --install /usr/bin/sbt sbt /opt/sbt/bin/sbt 2

RUN echo "" >> /etc/profile
RUN echo "## Setting JAVA_HOME and PATH for all USERS ##" >> /etc/profile
RUN echo "export JAVA_HOME=/opt/jdk1.8.0_66" >> /etc/profile
RUN echo "export PATH=\$PATH:\$JAVA_HOME/bin" >> /etc/profile

RUN echo "" >> /etc/profile
RUN echo "## Setting SCALA_HOME and PATH for all USERS ##" >> /etc/profile
RUN echo "export SCALA_HOME=/opt/scala-2.11.7/" >> /etc/profile
RUN echo "export PATH=\$PATH:\$SCALA_HOME/bin" >> /etc/profile



RUN source /etc/profile


EXPOSE 80 9001 1234 3306 6379 9000

ENTRYPOINT ["/usr/bin/supervisord"]

