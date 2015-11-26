FROM centos
MAINTAINER Eric King <jinqiqiqi@gamil.com>


###### static lines
ADD ./conf/CentOS-Base.repo /etc/yum.repos.d/CentOS-Base.repo
RUN ["rpm", "--import", "/etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7"]
RUN ["yum", "clean", "all"]
RUN ["yum", "-y", "update"]

# install wget
RUN yum -y install wget

# download and install both java and scala
RUN cd /opt/
RUN wget --no-cookies --no-check-certificate --header "Cookie: gpw_e24=http%3A%2F%2Fwww.oracle.com%2F; oraclelicense=accept-securebackup-cookie" "http://download.oracle.com/otn-pub/java/jdk/8u66-b17/jdk-8u66-linux-x64.tar.gz"
RUN wget http://downloads.typesafe.com/scala/2.11.7/scala-2.11.7.tgz

RUN tar -zxvf jdk-8u66-linux-x64.tar.gz -C /opt/
RUN tar -zxvf scala-2.11.7.tgz -C /opt/

RUN alternatives --install /usr/bin/java java /opt/jdk1.8.0_66/bin/java 2 
RUN alternatives --install /usr/bin/javaws javaws /opt/jdk1.8.0_66/bin/javaws 2 
RUN alternatives --install /usr/bin/javac javac /opt/jdk1.8.0_66/bin/javac 2 
RUN alternatives --install /usr/bin/jar jar /opt/jdk1.8.0_66/bin/jar 2 
RUN alternatives --install /usr/bin/jps jps /opt/jdk1.8.0_66/bin/jps 2

RUN alternatives --install /usr/bin/scala scala /opt/scala-2.11.7/bin/scala 2 
RUN alternatives --install /usr/bin/scalac scalac /opt/scala-2.11.7/bin/scalac 2 
RUN alternatives --install /usr/bin/scaladoc scaladoc /opt/scala-2.11.7/bin/scaladoc 2 
RUN alternatives --install /usr/bin/scalap scalap /opt/scala-2.11.7/bin/scalap 2

RUN echo "" >> /etc/profile
RUN echo "## Setting JAVA_HOME and PATH for all USERS ##" >> /etc/profile
RUN echo "export JAVA_HOME=/opt/jdk1.8.0_66" >> /etc/profile
RUN echo "export PATH=\$PATH:\$JAVA_HOME/bin" >> /etc/profile

RUN echo "" >> /etc/profile
RUN echo "## Setting JAVA_HOME and PATH for all USERS ##" >> /etc/profile
RUN echo "export SCALA_HOME=/opt/scala-2.11.7/" >> /etc/profile
RUN echo "export PATH=\$PATH:\$SCALA_HOME/bin" >> /etc/profile


RUN source /etc/profile


