FROM centos:latest
RUN yum clean all && yum -y update
RUN yum -y install php-fpm php-mbstring php-mysql php-gd && yum clean all
RUN sed -e 's/127.0.0.1:9000/9000/' \
		-e '/allowed_clients/d' \
		-e '/catch_workers_output/s/^;//' \
		-e '/error_log/d' \
		-i /etc/php-fpm.d/www.conf
RUN mkdir -p /var/www/html
EXPOSE 9003
ENTRYPOINT /usr/sbin/php-fpm --nodaemonize