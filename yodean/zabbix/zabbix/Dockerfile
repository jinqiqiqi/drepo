FROM centos:6.8
MAINTAINER Eric King <jinqiqiqi@gamil.com>

RUN rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-6 && yum clean all && yum -y update && yum install -y wget unzip

RUN rpm -ivh https://dl.fedoraproject.org/pub/epel/epel-release-latest-6.noarch.rpm http://repo.zabbix.com/zabbix/2.2/rhel/6/x86_64/zabbix-release-2.2-1.el6.noarch.rpm && rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-EPEL-6 /etc/pki/rpm-gpg/RPM-GPG-KEY-ZABBIX

RUN yum install -y mysql-server zabbix22 zabbix22-proxy zabbix22-web-mysql zabbix22-proxy-mysql zabbix22-agent zabbix22-web zabbix22-server zabbix22-server-mysql 

RUN sed -e 's/post_max_size\ =\ 8M/post_max_size\ =\ 16M/' \
	-e 's/max_execution_time\ =\ 30/max_execution_time\ =\ 300/' \
	-e 's/max_input_time\ =\ 60/max_input_time\ =\ 300/' \
	-e 's/;date.timezone\ =/date.timezone\ =\ Asia\/Shanghai/' \
	-i /etc/php.ini
	

# RUN mkdir -p /etc/supervisord.d/

# ADD ./conf/zabbix.ini /etc/supervisord.d/zabbix.ini

EXPOSE 80

ENTRYPOINT ["/usr/sbin/httpd", "-D", "FOREGROUND"]

