FROM centos

MAINTAINER Eric King <jinqiqiqi@gmail.com>

# init the repo and basic installations
RUN ["rpm", "--import", "/etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7"]
RUN yum install -y epel-release && yum clean all
RUN ["rpm", "--import", "/etc/pki/rpm-gpg/RPM-GPG-KEY-EPEL-7"]
RUN yum install -y supervisor axel unzip

# setting the userinfo for supervisor
RUN sed -e 's/nodaemon=false/nodaemon=true/' \
    -e 's/;\[inet_http_server\]/\[inet_http_server\]/' \
    -e 's/;port=127.0.0.1:9001/port=*:9001/' \
    -e 's/;username=user/username=user/' \
    -e 's/;password=123/password=123/' \
    -i /etc/supervisord.conf

# download the jdk
RUN axel -n 10 -a http://ftp.heanet.ie/mirrors/funtoo/distfiles/oracle-java/jdk-8u131-linux-x64.tar.gz --output=/opt/jdk-8u131-linux-x64.tar.gz

# install jdk
RUN tar -zxf /opt/jdk-8u131-linux-x64.tar.gz -C /opt/
RUN alternatives --install /usr/bin/java java /opt/jdk1.8.0_131/bin/java 2 
RUN alternatives --install /usr/bin/javaws javaws /opt/jdk1.8.0_131/bin/javaws 2 
RUN alternatives --install /usr/bin/javac javac /opt/jdk1.8.0_131/bin/javac 2 
RUN alternatives --install /usr/bin/javap javap /opt/jdk1.8.0_131/bin/javap 2 
RUN alternatives --install /usr/bin/jar jar /opt/jdk1.8.0_131/bin/jar 2 
RUN alternatives --install /usr/bin/jps jps /opt/jdk1.8.0_131/bin/jps 2

# setting jdk
RUN echo "" >> /etc/profile
RUN echo "## Setting JAVA_HOME and PATH for all USERS ##" >> /etc/profile
RUN echo "export JAVA_HOME=/opt/jdk1.8.0_131" >> /etc/profile
RUN echo "export CLASSPATH=.:\$JAVA_HOME/lib/dt.jar:\$JAVA_HOME/lib/tools.jar" >> /etc/profile
RUN echo "export PATH=\$PATH:\$JAVA_HOME/bin" >> /etc/profile

# install sshd-server
RUN yum install -y openssh-server openssh-clients initscripts
RUN sed -ri 's/#PermitRootLogin yes/PermitRootLogin yes/g' /etc/ssh/sshd_config
ADD ./conf/id_rsa.pub /root/.ssh/authorized_keys
ADD ./conf/id_rsa /root/.ssh/id_rsa
RUN chmod -R 600 /root/.ssh/ && mkdir /var/run/sshd && /usr/sbin/sshd-keygen

# register sshd as a backend service
ADD ./conf/sshd.ini /etc/supervisord.d/sshd.ini

ENTRYPOINT ["/usr/bin/supervisord"]