FROM centos
MAINTAINER Eric King <jinqiqiqi@gamil.com>

ADD ./CentOS-Base.repo /etc/yum.repos.d/CentOS-Base.repo
RUN ["rpm", "--import", "/etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7"]


RUN ["yum", "clean", "all"]
RUN ["yum", "-y", "update"]
# RUN ["yum", "install", "-y", "mariadb-devel"]
RUN ["yum", "install", "-y", "mariadb-server"]
RUN ["yum", "clean", "all"]
RUN ["mysql_install_db", "--user=mysql", "--datadir=/var/lib/mysql/"]

VOLUME ["/var/lib/mysql"]

EXPOSE 3306
ENTRYPOINT ["/usr/bin/mysqld_safe"]