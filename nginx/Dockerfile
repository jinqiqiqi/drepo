FROM ubuntu
MAINTAINER Eric Kinch "jinqiqiqi@gmail.com"
ENV REFERSHED_AT 2015-09-23
RUN apt-get update
RUN apt-get -y -q install nginx
RUN mkdir -p /var/www/html
ADD nginx/global.conf /etc/nginx/conf.d/
ADD nginx/nginx.conf /etc/nginx/nginx.conf
EXPOSE 80
