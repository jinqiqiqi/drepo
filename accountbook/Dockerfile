FROM centos
MAINTAINER Eric King <jinqiqiqi@gamil.com>


###### static lines
ADD ./conf/CentOS-Base.repo /etc/yum.repos.d/CentOS-Base.repo
RUN ["rpm", "--import", "/etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7"]
RUN ["yum", "clean", "all"]
RUN ["yum", "-y", "update"]


RUN yum -y install nginx php-fpm phpmyadmin mariadb-server



# ADD ./shells/build.sh /opt/shells/build.sh
# RUN chmod +x /opt/shells/build.sh
# RUN /opt/shells/build.sh


RUN ["mysql_install_db", "--user=mysql", "--datadir=/var/lib/mysql/"]

ADD ./init.sh /opt/shells/init.sh
RUN chmod +x /opt/shells/init.sh && /opt/shells/init.sh

ADD ./conf/book.conf /etc/nginx/conf.d/book.conf
RUN sed -e 's/daemonize = no/daemonize = yes/' -i /etc/php-fpm.conf
# RUN echo "daemon off;" >> /etc/nginx/nginx.conf
VOLUME ["/usr/share/nginx/html/"]

EXPOSE 80
# ENTRYPOINT ["/usr/sbin/nginx"]

CMD nginx && php-fpm && mysqld_safe 


