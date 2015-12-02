FROM centos
MAINTAINER Eric King <jinqiqiqi@gamil.com>


###### static lines
# RUN curl https://bintray.com/sbt/rpm/rpm | tee /etc/yum.repos.d/bintray-sbt-rpm.repo
ADD ./conf/CentOS-Base.repo /etc/yum.repos.d/CentOS-Base.repo

RUN ["rpm", "--import", "/etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7"]
RUN ["yum", "clean", "all"]
RUN ["yum", "-y", "update"]

RUN yum install -y php php-mbstring php-intl phpMyAdmin nginx php-composer-installers php-fpm php-mbstring php-mysql php-gd supervisor php-imap php-soap php-xmlrpc php-pecl-redis redis mariadb-server wget unzip

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

### installing for java

RUN cd /opt/
RUN wget --no-cookies --no-check-certificate --header "Cookie: gpw_e24=http%3A%2F%2Fwww.oracle.com%2F; oraclelicense=accept-securebackup-cookie" "http://download.oracle.com/otn-pub/java/jdk/8u66-b17/jdk-8u66-linux-x64.tar.gz"
RUN wget http://downloads.typesafe.com/scala/2.11.7/scala-2.11.7.tgz
RUN wget http://downloads.typesafe.com/akka/akka_2.11-2.4.1.zip
RUN wget https://dl.bintray.com/sbt/native-packages/sbt/0.13.9/sbt-0.13.9.tgz

RUN tar -zxf jdk-8u66-linux-x64.tar.gz -C /opt/
RUN tar -zxf scala-2.11.7.tgz -C /opt/
RUN unzip akka_2.11-2.4.1.zip -d /opt/
RUN tar -zxf sbt-0.13.9.tgz -C /opt/

RUN alternatives --install /usr/bin/java java /opt/jdk1.8.0_66/bin/java 2 
RUN alternatives --install /usr/bin/javaws javaws /opt/jdk1.8.0_66/bin/javaws 2 
RUN alternatives --install /usr/bin/javac javac /opt/jdk1.8.0_66/bin/javac 2 
RUN alternatives --install /usr/bin/jar jar /opt/jdk1.8.0_66/bin/jar 2 
RUN alternatives --install /usr/bin/jps jps /opt/jdk1.8.0_66/bin/jps 2

RUN alternatives --install /usr/bin/scala scala /opt/scala-2.11.7/bin/scala 2 
RUN alternatives --install /usr/bin/scalac scalac /opt/scala-2.11.7/bin/scalac 2 
RUN alternatives --install /usr/bin/scaladoc scaladoc /opt/scala-2.11.7/bin/scaladoc 2 
RUN alternatives --install /usr/bin/scalap scalap /opt/scala-2.11.7/bin/scalap 2

RUN alternatives --install /usr/bin/akka akka /opt/akka-2.4.0/bin/akka 2
RUN alternatives --install /usr/bin/akka-cluster akka-cluster /opt/akka-2.4.0/bin/akka-cluster 2

RUN alternatives --install /usr/bin/sbt sbt /opt/sbt/bin/sbt 2

RUN echo "" >> /etc/profile
RUN echo "## Setting JAVA_HOME and PATH for all USERS ##" >> /etc/profile
RUN echo "export JAVA_HOME=/opt/jdk1.8.0_66" >> /etc/profile
RUN echo "export PATH=\$PATH:\$JAVA_HOME/bin" >> /etc/profile

RUN echo "" >> /etc/profile
RUN echo "## Setting SCALA_HOME and PATH for all USERS ##" >> /etc/profile
RUN echo "export SCALA_HOME=/opt/scala-2.11.7/" >> /etc/profile
RUN echo "export PATH=\$PATH:\$SCALA_HOME/bin" >> /etc/profile


RUN echo "" >> /etc/profile
RUN echo "## Setting AKKA_HOME and PATH for all USERS ##" >> /etc/profile
RUN echo "export AKKA_HOME=/opt/akka-2.4.0/" >> /etc/profile
RUN echo "export PATH=\$PATH:\$AKKA_HOME/bin" >> /etc/profile



RUN source /etc/profile

EXPOSE 888 9001

ENTRYPOINT ["/usr/bin/supervisord"]

