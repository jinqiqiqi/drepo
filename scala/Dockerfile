FROM centos
MAINTAINER Eric King <jinqiqiqi@gamil.com>


###### static lines
ADD ./conf/CentOS-Base.repo /etc/yum.repos.d/CentOS-Base.repo
RUN ["rpm", "--import", "/etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7"]
RUN ["yum", "clean", "all"]
RUN ["yum", "-y", "update"]


RUN yum -y install wget

RUN cd /opt/
RUN wget --no-cookies --no-check-certificate --header "Cookie: gpw_e24=http%3A%2F%2Fwww.oracle.com%2F; oraclelicense=accept-securebackup-cookie" "http://download.oracle.com/otn-pub/java/jdk/8u40-b25/jdk-8u40-linux-x64.tar.gz"
RUN wget http://downloads.typesafe.com/scala/2.11.7/scala-2.11.7.tgz

# RUN wget --no-cookies --no-check-certificate --header "Cookie: gpw_e24=http%3A%2F%2Fwww.oracle.com%2F; oraclelicense=accept-securebackup-cookie" "http://download.oracle.com/otn-pub/java/jdk/8u40-b25/jdk-8u40-linux-x64.rpm"
RUN mkdir /usr/java/
RUN tar -zxvf jdk-8u40-linux-x64.tar.gz -C /usr/java/
RUN tar -zxvf scala-2.11.7.tgz -C /opt/

RUN alternatives --install /usr/bin/java java /usr/java/jdk1.8.0_40/bin/java 2 
RUN alternatives --install /usr/bin/javaws javaws /usr/java/jdk1.8.0_40/bin/javaws 2 
RUN alternatives --install /usr/bin/javac javac /usr/java/jdk1.8.0_40/bin/javac 2 
RUN alternatives --install /usr/bin/jar jar /usr/java/jdk1.8.0_40/bin/jar 2 
RUN alternatives --install /usr/bin/jps jps /usr/java/jdk1.8.0_40/bin/jps 2

RUN alternatives --install /usr/bin/scala scala /opt/scala-2.11.7/bin/scala 2 
RUN alternatives --install /usr/bin/scalac scalac /opt/scala-2.11.7/bin/scalac 2 
RUN alternatives --install /usr/bin/scaladoc scaladoc /opt/scala-2.11.7/bin/scaladoc 2 
RUN alternatives --install /usr/bin/scalap scalap /opt/scala-2.11.7/bin/scalap 2

echo "" >> /etc/profile
echo "## Setting JAVA_HOME and PATH for all USERS ##" >> /etc/profile
echo "export JAVA_HOME=/usr/java/jdk1.8.0_40" >> /etc/profile
echo "export PATH=\$PATH:\$JAVA_HOME/bin" >> /etc/profile

echo "" >> /etc/profile
echo "## Setting JAVA_HOME and PATH for all USERS ##" >> /etc/profile
echo "export SCALA_HOME=/opt/scala-2.11.7/" >> /etc/profile
echo "export PATH=\$PATH:\$SCALA_HOME/bin" >> /etc/profile


source /etc/profile

# ENTRYPOINT ["/usr/bin/mysqld_safe"]
# CMD mysqld_safe 


