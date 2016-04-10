FROM centos
MAINTAINER Eric King <jinqiqiqi@gamil.com>


###### static lines
# RUN curl https://bintray.com/sbt/rpm/rpm | tee /etc/yum.repos.d/bintray-sbt-rpm.repo
ADD ./conf/CentOS-Base.repo /etc/yum.repos.d/CentOS-Base.repo

RUN rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7 && yum clean all && yum -y update 

RUN yum install -y python-devel libevent-devel python-pip gcc xz-devel 
# python-pip swig pyliblzma gcc

RUN yum install -y swig
RUN yum install -y m2crypto docker-registry


RUN pip install docker-registry[bugsnag,newrelic,cors]