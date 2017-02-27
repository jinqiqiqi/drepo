FROM centos
MAINTAINER Eric King <jinqiqiqi@gmail.com>

RUN rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7 && yum clean all && yum update -y && yum install -y git pyOpenSSL

RUN git clone https://github.com/jinqiqiqi/XX-Net.git /opt/XX-Net/

WORKDIR /opt/XX-Net/

EXPOSE 8085 8086 8087 1080 

ENTRYPOINT ["/opt/XX-Net/start"]
