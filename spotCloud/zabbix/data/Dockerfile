FROM centos
MAINTAINER Eric King <jinqiqiqi@gamil.com>

RUN rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7 && yum clean all && yum -y update && yum install
RUN yum install -y supervisor wget unzip epel-release

RUN rpm -ivh http://repo.zabbix.com/zabbix/2.2/rhel/7/x86_64/zabbix-release-2.2-1.el7.noarch.rpm

# # ADD ./conf/hpp.ini /etc/supervisord.d/hpp.ini

# RUN sed -e 's/nodaemon=false/nodaemon=true/' \
# 	-e 's/;\[inet_http_server\]/\[inet_http_server\]/' \
# 	-e 's/;port=127.0.0.1:9001/port=*:9001/' \
# 	-e 's/;username=user/username=user/' \
# 	-e 's/;password=123/password=123/' \
# 	-i /etc/supervisord.conf

# VOLUME ["/usr/share/nginx/html/", "/var/lib/mysql/", "/var/lib/redis/", "/var/log/nginx/", "/var/log/php-fpm/", "/var/log/redis/", "/var/log/mysql/", "/var/lib/mls/", "/data/files/media/"]
# # EXPOSE 6379

# ENTRYPOINT ["/usr/bin/supervisord"]

