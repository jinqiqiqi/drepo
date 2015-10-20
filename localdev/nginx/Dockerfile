FROM centos
MAINTAINER Eric King <jinqiqiqi@gamil.com>

ADD ./CentOS-Base.repo /etc/yum.repos.d/CentOS-Base.repo
ADD ./nginx.repo /etc/yum.repos.d/nginx.repo
RUN ["rpm", "--import", "/etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7"]


RUN ["yum", "clean", "all"]
RUN ["yum", "-y", "update"]
RUN ["yum", "install", "-y", "nginx"]
RUN ["yum", "clean", "all"]

RUN ["mv", "/etc/nginx/conf.d/default.conf", "/etc/nginx/conf.d/default.conf.bak"]
RUN ["mv", "/etc/nginx/nginx.conf", "/etc/nginx/nginx.conf.bak"]
ADD ./conf/default.conf /etc/nginx/conf.d/default.conf
ADD ./conf/nginx.conf /etc/nginx/nginx.conf


VOLUME ["/usr/share/nginx/html/", "/var/log/nginx/"]

# WORKDIR /usr/share/nginx/html/

EXPOSE 80
ENTRYPOINT ["nginx"]
