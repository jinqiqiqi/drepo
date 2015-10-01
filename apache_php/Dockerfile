FROM centos:latest
RUN rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7
RUN yum clean all && yum -y install mariadb-server
RUN mysql_install_db --user=mysql
ENV MYSQL_USER test
ENV MYSQL_PASS mypassword
ENV LC_ALL en_US.UTF-8

EXPOSE 3306

ENTRYPOINT ["mysqld_safe"]
