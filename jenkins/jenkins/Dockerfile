FROM jenkins:latest

MAINTAINER jinqiqiqi "jinqiqiqi@gmail.com"
MAINTAINER version "online"

USER jenkins

VOLUME ["/var/jenkins_home"]

EXPOSE 8080 50000

COPY conf/plugins.txt /usr/share/jenkins/plugins.txt

RUN /usr/local/bin/plugins.sh /usr/share/jenkins/plugins.txt

WORKDIR /var/jenkins_home/