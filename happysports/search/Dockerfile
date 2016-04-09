FROM centos
MAINTAINER Eric King <jinqiqiqi@gamil.com>


###### static lines
# RUN curl https://bintray.com/sbt/rpm/rpm | tee /etc/yum.repos.d/bintray-sbt-rpm.repo
ADD ./conf/CentOS-Base.repo /etc/yum.repos.d/CentOS-Base.repo

RUN rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7 && yum clean all && yum -y update 

RUN yum install -y wget supervisor java

RUN wget -c https://download.elastic.co/elasticsearch/release/org/elasticsearch/distribution/tar/elasticsearch/2.3.1/elasticsearch-2.3.1.tar.gz -O /opt/elasticsearch-2.3.1.tar.gz

RUN tar zxvf /opt/elasticsearch-2.3.1.tar.gz -C /opt/

RUN sed -e 's/#\ network\.host\:\ 192\.168\.0\.1/network\.host\:\ \_site\_/' \
	-i /opt/elasticsearch-2.3.1/config/elasticsearch.yml

ADD ./conf/hpp.ini /etc/supervisord.d/hpp.ini
EXPOSE 9200 9300

RUN sed -e 's/nodaemon=false/nodaemon=true/' \
	-e 's/;\[inet_http_server\]/\[inet_http_server\]/' \
	-e 's/;port=127.0.0.1:9001/port=*:9001/' \
	-e 's/;username=user/username=user/' \
	-e 's/;password=123/password=123/' \
	-i /etc/supervisord.conf

ENTRYPOINT ["/usr/bin/supervisord"]

