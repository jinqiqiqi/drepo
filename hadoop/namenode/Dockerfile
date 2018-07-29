FROM centos

MAINTAINER Eric King <jinqiqiqi@gmail.com>

# init the repo and basic installations
RUN ["rpm", "--import", "/etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7"]
RUN yum install -y epel-release && yum clean all
RUN ["rpm", "--import", "/etc/pki/rpm-gpg/RPM-GPG-KEY-EPEL-7"]
RUN yum install -y supervisor axel

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
COPY ./conf/id_rsa.pub /root/.ssh/authorized_keys
COPY ./conf/id_rsa /root/.ssh/id_rsa
RUN chmod -R 600 /root/.ssh/ && mkdir /var/run/sshd && /usr/sbin/sshd-keygen

# register sshd as a backend service
COPY ./conf/sshd.ini /etc/supervisord.d/sshd.ini

# install ntp to sync date and time
RUN yum install -y wget ntp ntpdate && ln -sf /usr/share/zoneinfo/Asia/Shanghai /etc/localtime
# RUN /usr/sbin/ntpdate -u pool.ntp.org

# init clouder-manager.repo and install cloudera manager
ADD ./packages/cloudera-manager-centos7-cm5.12.0_x86_64.tar.gz /opt/
COPY ./packages/mysql-connector-java-5.1.42.jar /opt/cm-5.12.0/share/cmf/lib/
COPY ./packages/CDH-5.12.0-1.cdh5.12.0.p0.29-el7.parcel /opt/cloudera/parcel-repo/CDH-5.12.0-1.cdh5.12.0.p0.29-el7.parcel
COPY ./packages/CDH-5.12.0-1.cdh5.12.0.p0.29-el7.parcel.sha1 /opt/cloudera/parcel-repo/CDH-5.12.0-1.cdh5.12.0.p0.29-el7.parcel.sha
COPY ./packages/manifest.json /opt/cloudera/parcel-repo/manifest.json

RUN yum install -y which psmisc




RUN useradd --system --home=/opt/cm-5.12.0/run/cloudera-scm-server/ --no-create-home --shell=/bin/false --comment "Cloudera SCM User" cloudera-scm
RUN mkdir /var/lib/cloudera-scm-server 
# RUN mkdir /opt/cloudera/parcel-repo

# /opt/cm-5.12.0/etc/cloudera-scm-agent/config.ini
# RUN . /etc/profile && /opt/cm-5.12.0/share/cmf/schema/scm_prepare_database.sh mysql cloudera_manager -h172.19.0.2 -uroot -p123123 --scm-host namenode root 123123
# /opt/cm-5.12.0/etc/init.d/cloudera-scm-agent status 
# /opt/cm-5.12.0/etc/init.d/cloudera-scm-server status

# settings for exposing ports
EXPOSE 22 7180 

# entrypoint command
ENTRYPOINT ["/usr/bin/supervisord"]