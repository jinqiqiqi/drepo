FROM centos
MAINTAINER Eric King <jinqiqiqi@gamil.com>


###### static lines
# RUN curl https://bintray.com/sbt/rpm/rpm | tee /etc/yum.repos.d/bintray-sbt-rpm.repo
ADD ./conf/CentOS-Base.repo /etc/yum.repos.d/CentOS-Base.repo

RUN rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7 && yum clean all && yum -y update 
RUN yum install -y wget unzip axel supervisor

# RUN yum install -y supervisor wget unzip

# RUN sed -e 's/nodaemon=false/nodaemon=true/' \
# 	-e 's/;\[inet_http_server\]/\[inet_http_server\]/' \
# 	-e 's/;port=127.0.0.1:9001/port=*:9001/' \
# 	-e 's/;username=user/username=user/' \
# 	-e 's/;password=123/password=123/' \
# 	-i /etc/supervisord.conf

### installing for java


# RUN wget -c --tries=20 --no-cookies --no-check-certificate --header "Cookie: gpw_e24=http%3A%2F%2Fwww.oracle.com%2F; oraclelicense=accept-securebackup-cookie" "http://download.oracle.com/otn-pub/java/jdk/8u66-b17/jdk-8u66-linux-x64.tar.gz"
# RUN wget -c --tries=20 https://www.reucon.com/cdn/java/jdk-8u66-linux-x64.tar.gz
RUN axel -n 10 -a http://ftp.heanet.ie/mirrors/funtoo/distfiles/oracle-java/jdk-8u66-linux-x64.tar.gz
RUN axel -n 10 -a http://downloads.typesafe.com/scala/2.11.7/scala-2.11.7.tgz
RUN wget -c --tries=20 https://dl.bintray.com/sbt/native-packages/sbt/0.13.8/sbt-0.13.8.tgz

RUN tar -zxf jdk-8u66-linux-x64.tar.gz -C /opt/ && tar -zxf scala-2.11.7.tgz -C /opt/ && tar -zxf sbt-0.13.8.tgz -C /opt/

RUN alternatives --install /usr/bin/java java /opt/jdk1.8.0_66/bin/java 2 
RUN alternatives --install /usr/bin/javaws javaws /opt/jdk1.8.0_66/bin/javaws 2 
RUN alternatives --install /usr/bin/javac javac /opt/jdk1.8.0_66/bin/javac 2 
RUN alternatives --install /usr/bin/javap javap /opt/jdk1.8.0_66/bin/javap 2 
RUN alternatives --install /usr/bin/jar jar /opt/jdk1.8.0_66/bin/jar 2 
RUN alternatives --install /usr/bin/jps jps /opt/jdk1.8.0_66/bin/jps 2

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

RUN sed -e 's/nodaemon=false/nodaemon=true/' \
	-e 's/;\[inet_http_server\]/\[inet_http_server\]/' \
	-e 's/;port=127.0.0.1:9001/port=*:9001/' \
	-e 's/;username=user/username=user/' \
	-e 's/;password=123/password=123/' \
	-i /etc/supervisord.conf

WORKDIR /var/lib/mls/
EXPOSE 1234

ENTRYPOINT ["/usr/bin/supervisord"]

