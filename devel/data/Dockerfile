FROM centos
MAINTAINER Eric King <jinqiqiqi@gamil.com>


###### static lines
ADD ./conf/CentOS-Base.repo /etc/yum.repos.d/CentOS-Base.repo

RUN rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7 && yum clean all && yum -y update && yum install -y supervisor wget unzip

VOLUME ["/usr/share/nginx/html/", "/var/lib/mysql/", "/var/lib/redis/", "/var/log/nginx/", "/var/log/php-fpm/", "/var/log/redis/", "/var/log/mysql/", "/var/lib/mls/"]
# EXPOSE 6379

ENTRYPOINT ["/usr/bin/tail", "-f", "/var/log/lastlog"]

