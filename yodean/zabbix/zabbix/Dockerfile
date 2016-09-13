FROM centos:6.8
MAINTAINER Eric King <jinqiqiqi@gamil.com>

RUN rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-6 && yum clean all && yum -y update && yum install -y wget unzip

RUN rpm -ivh https://dl.fedoraproject.org/pub/epel/epel-release-latest-6.noarch.rpm http://repo.zabbix.com/zabbix/2.2/rhel/6/x86_64/zabbix-release-2.2-1.el6.noarch.rpm && rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-EPEL-6 /etc/pki/rpm-gpg/RPM-GPG-KEY-ZABBIX

RUN yum install -y mysql-server zabbix22 zabbix22-proxy zabbix22-web-mysql zabbix22-proxy-mysql zabbix22-agent zabbix22-web zabbix22-server zabbix22-server-mysql 
# supervisor

# RUN sed -e '$a\\[include\]\nfiles=\/etc\/supervisord.d\/\*\.conf\n' \
# 	-e 's/nodaemon=false/nodaemon=true/' \
# 	-e 's/;http_port=127.0.0.1:9001/http_port=*:9001/' \
# 	-e 's/;port=127.0.0.1:9001/port=*:9001/' \
# 	-e 's/;user=chrism/user=root/' \
# 	-e 's/;username=chris/username=user/' \
# 	-e 's/;password=123/password=123/' \
# 	-e 's/;http_username=user/http_username=user/' \
# 	-e 's/;http_password=123/http_password=123/' \
# 	-e 's/;serverurl=/serverurl=/' \
# 	-e 's/;prompt=mysupervisor/prompt=mysupervisor/' \
# 	-i /etc/supervisord.conf
	

# RUN mkdir -p /etc/supervisord.d/

# ADD ./conf/zabbix.ini /etc/supervisord.d/zabbix.ini

EXPOSE 80 3306

ENTRYPOINT ["/usr/sbin/httpd", "-D", "FOREGROUND"]

