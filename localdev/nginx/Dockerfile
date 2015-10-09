FROM centos
MAINTAINER Eric King <jinqiqiqi@gamil.com>

ADD ./CentOS-Base.repo /etc/yum.repos.d/CentOS-Base.repo
ADD ./nginx.repo /etc/yum.repos.d/nginx.repo
RUN ["rpm", "--import", "/etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7"]


RUN ["yum", "clean", "all"]
RUN ["yum", "-y", "update"]
RUN ["yum", "install", "-y", "nginx"]
RUN ["yum", "clean", "all"]
# RUN sed -e 's/127.0.0.1:9000/9000/' \
# 		-e '/allowed_clients/d' \
# 		-e '/catch_workers_output/s/^;//' \
# 		-e '/\[error_log\]/d' \
# 		-i /etc/php-fpm.d/www.conf

VOLUME ["/usr/share/nginx/html"]


EXPOSE 9000
ENTRYPOINT ["/usr/sbin/php-fpm", "--nodaemonize"]
