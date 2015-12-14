FROM centos
MAINTAINER Eric King <jinqiqiqi@gamil.com>


###### static lines
# RUN curl https://bintray.com/sbt/rpm/rpm | tee /etc/yum.repos.d/bintray-sbt-rpm.repo
ADD ./conf/CentOS-Base.repo /etc/yum.repos.d/CentOS-Base.repo

RUN ["rpm", "--import", "/etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7"]
RUN yum clean all
RUN yum -y update

RUN yum install -y mariadb-server supervisor

# 初始化数据库
RUN sed -e 's/\[mysqld\]/\[mysqld\]\nlower_case_table_names=1\n/' \
		-i /etc/my.cnf

RUN mysql_install_db --user=mysql

ENV MYSQL_HOST=%
ENV MYSQL_USER=root
ENV MYSQL_PASS=Shanghai!1

ADD ./conf/setpassword.sh /opt/setpassword.sh
RUN chmod u+x /opt/setpassword.sh
RUN /opt/setpassword.sh

RUN sed -e 's/nodaemon=false/nodaemon=true/' \
	-e 's/;\[inet_http_server\]/\[inet_http_server\]/' \
	-e 's/;port=127.0.0.1:9001/port=*:9001/' \
	-e 's/;username=user/username=user/' \
	-e 's/;password=123/password=123/' \
	-i /etc/supervisord.conf

ADD ./conf/hpp.ini /etc/supervisord.d/hpp.ini

EXPOSE 3306

ENTRYPOINT ["/usr/bin/supervisord"]

