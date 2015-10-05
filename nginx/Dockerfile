FROM centos:updated
MAINTAINER Eric Kinch "jinqiqiqi@gmail.com"
ENV REFERSHED_AT 2015-09-23

RUN ["yum", "-y", "install", "nginx"]
RUN mkdir -p /var/www/html
ADD nginx/global.conf /etc/nginx/conf.d/
ADD nginx/nginx.conf /etc/nginx/nginx.conf
EXPOSE 80
