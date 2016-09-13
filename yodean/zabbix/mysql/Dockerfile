FROM centos:6.8
MAINTAINER Eric King <jinqiqiqi@gamil.com>

RUN rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-6 && yum clean all && yum -y update && yum install -y wget unzip

RUN rpm -ivh https://dl.fedoraproject.org/pub/epel/epel-release-latest-6.noarch.rpm && rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-EPEL-6

RUN yum install -y mysql-server

VOLUME ["/var/lib/mysql/"]

EXPOSE 3306

CMD ["/usr/bin/mysqld_safe"]

