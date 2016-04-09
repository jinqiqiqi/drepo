FROM centos
MAINTAINER Eric King <jinqiqiqi@gamil.com>


###### static lines
# RUN curl https://bintray.com/sbt/rpm/rpm | tee /etc/yum.repos.d/bintray-sbt-rpm.repo
ADD ./conf/CentOS-Base.repo /etc/yum.repos.d/CentOS-Base.repo

RUN rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7 && yum clean all && yum -y update 

RUN yum install -y wget supervisor java

RUN wget -c https://download.elastic.co/elasticsearch/release/org/elasticsearch/distribution/tar/elasticsearch/2.3.1/elasticsearch-2.3.1.tar.gz -O /opt/elasticsearch-2.3.1.tar.gz

RUN tar zxvf /opt/elasticsearch-2.3.1.tar.gz -C /opt/

ADD ./conf/hpp.ini /etc/supervisord.d/hpp.ini
EXPOSE 9200 9300

ENTRYPOINT ["/usr/bin/supervisord"]

