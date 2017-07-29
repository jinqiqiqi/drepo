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

# install mysql
RUN yum install -y mariadb-server && sed -e 's/\[mysqld\]/\[mysqld\]\nlower_case_table_names=1\ncharacter_set_server=utf8\ncollation_server=utf8_general_ci\n/' \
        -i /etc/my.cnf

# register mariadb as a backend service
ADD ./conf/mariadb.ini /etc/supervisord.d/mariadb.ini

#  mysql_install_db; mysql_secure_install

EXPOSE 3306

ENTRYPOINT ["/usr/bin/supervisord"]

