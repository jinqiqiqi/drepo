FROM centos
MAINTAINER Eric King <jinqiqiqi@gamil.com>


###### static lines
# RUN curl https://bintray.com/sbt/rpm/rpm | tee /etc/yum.repos.d/bintray-sbt-rpm.repo
ADD ./conf/CentOS-Base.repo /etc/yum.repos.d/CentOS-Base.repo

RUN rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7 && yum clean all && yum -y update 

RUN yum install -y wget supervisor java unzip

RUN wget -c https://download.elastic.co/elasticsearch/release/org/elasticsearch/distribution/tar/elasticsearch/2.3.4/elasticsearch-2.3.4.tar.gz -O /opt/elasticsearch-2.3.4.tar.gz

RUN tar zxvf /opt/elasticsearch-2.3.4.tar.gz -C /opt/

RUN sed -e 's/#\ network\.host\:\ 192\.168\.0\.1/network\.host\:\ \_site\_/' \
	-i /opt/elasticsearch-2.3.4/config/elasticsearch.yml

# RUN /opt/elasticsearch-2.3.4/bin/plugin install analysis-smartcn
ADD ./conf/elasticsearch-analysis-ik-1.9.4.zip /opt/
RUN /opt/elasticsearch-2.3.4/bin/plugin install file:/opt/elasticsearch-analysis-ik-1.9.4.zip

RUN sed -e 's/custom\/single_word_low_freq.dic/custom\/single_word.dic;custom\/sougou.dic/' -i /opt/elasticsearch-2.3.4/config/analysis-ik/IKAnalyzer.cfg.xml

RUN rm /opt/elasticsearch-2.3.4.tar.gz /opt/elasticsearch-analysis-ik-1.9.4.zip

WORKDIR /opt/elasticsearch-2.3.4/

ADD ./conf/hpp.ini /etc/supervisord.d/hpp.ini
EXPOSE 9200 9300

VOLUME /opt/elasticsearch-2.3.4/config/

RUN sed -e 's/nodaemon=false/nodaemon=true/' \
	-e 's/;\[inet_http_server\]/\[inet_http_server\]/' \
	-e 's/;port=127.0.0.1:9001/port=*:9001/' \
	-e 's/;username=user/username=user/' \
	-e 's/;password=123/password=123/' \
	-i /etc/supervisord.conf



ENTRYPOINT ["/usr/bin/supervisord"]



