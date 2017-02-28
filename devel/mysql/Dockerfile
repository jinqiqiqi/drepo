FROM centos
MAINTAINER Eric King <jinqiqiqi@gamil.com>


###### static lines
# RUN curl https://bintray.com/sbt/rpm/rpm | tee /etc/yum.repos.d/bintray-sbt-rpm.repo
ADD ./conf/CentOS-Base.repo /etc/yum.repos.d/CentOS-Base.repo

RUN rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7 && yum clean all && yum -y update && yum install -y mariadb-server

# 初始化数据库
RUN sed -e 's/\[mysqld\]/\[mysqld\]\nlower_case_table_names=1\ncharacter_set_server=utf8\ncollation_server=utf8_general_ci\nmax_allowed_packet=90M\n/' \
		-e 's/!includedir\ \/etc\/my.cnf.d/!includedir\ \/etc\/my\.cnf\.d\n\n\[client\]\ndefault\-character\-set=utf8\n\[mysql\]\ndefault\-character\-set=utf8\n/' \
		-i /etc/my.cnf

RUN mysql_install_db --user=mysql

# ENV MYSQL_HOST=% MYSQL_USER=root MYSQL_PASS=Shanghai!1

# ADD ./conf/setpassword.sh /opt/setpassword.sh
# RUN chmod u+x /opt/setpassword.sh
# RUN /opt/setpassword.sh



EXPOSE 3306

CMD ["/usr/libexec/mysqld", "--user=mysql", "--basedir=/usr", "--datadir=/var/lib/mysql", "--plugin-dir=/usr/lib64/mysql/plugin", "--log-error=/var/log/mysql/error_mysql.log", "--pid-file=/var/run/mariadb/mariadb.pid", "--socket=/var/lib/mysql/mysql.sock"]

# CMD ["/usr/bin/top", "-b"]
