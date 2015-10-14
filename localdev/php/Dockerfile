FROM centos
MAINTAINER Eric King <jinqiqiqi@gamil.com>

ADD ./CentOS-Base.repo /etc/yum.repos.d/CentOS-Base.repo
RUN ["rpm", "--import", "/etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7"]


RUN ["yum", "clean", "all"]
RUN ["yum", "-y", "update"]
RUN ["yum", "install", "-y", "php-mysql", "php-fpm", "php-gd", "php-mbstring"]
RUN ["yum", "clean", "all"]
RUN sed -e 's/127.0.0.1:9000/9000/' \
		-e '/allowed_clients/d' \
		-e 's/catch_workers_output/;catch_workers_output/' \
		-e '/\[error_log\]/d' \
		-e 's/;chroot\ =/chroot\ =\ \/usr\/share\/nginx\/html/' \
		-i /etc/php-fpm.d/www.conf

VOLUME ["/usr/share/nginx/html/"]
WORKDIR /usr/share/nginx/html/

EXPOSE 9000
ENTRYPOINT ["/usr/sbin/php-fpm"]
