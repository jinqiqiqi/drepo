FROM ubuntu
MAINTAINER Eric King <jinqiqiqi@gamil.com>


# ADD ./conf/CentOS-Base.repo /etc/yum.repos.d/CentOS-Base.repo

# RUN rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7

# RUN yum clean all && yum -y update 

# # RUN yum install -y eple-release 
# RUN yum install -y python-devel libevent-devel python-pip gcc xz-devel swig
# # pyliblzma


# RUN pip install docker-registry[bugsnag,newrelic,cors]
RUN apt-get update

RUN apt-get -y install build-essential python-dev libevent-dev python-pip liblzma-dev swig libssl-dev

RUN pip install docker-registry