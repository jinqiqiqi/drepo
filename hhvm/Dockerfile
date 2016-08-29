FROM centos:latest

# maintainer
MAINTAINER Eric King <jinqiqiqi@gamil.com>

# init repository and key
RUN rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7 && yum clean all && yum update -y && yum install -y epel-release && rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-EPEL-7

# install dependencies for hhvm
RUN yum install -y  cmake cmake3 cpp enca gcc-c++ git glog-devel gperf libjpeg-turbo-devel lib{edit,curl,xml2,xslt}-devel lib{xslt,event,yaml,vpx,png,zip,icu,mcrypt,memcached,cap,dwarf}-devel make mariadb mariadb-server ocaml oniguruma-devel openssl-devel psmisc zeromq-devel {binutils,boost,jemalloc,numactl}-devel {fastlz,double-conversion,re2}-devel {fribidi,libc-client,glib2}-devel {ImageMagick,sqlite,tbb,bzip2,openldap,readline,elfutils-libelf,gmp,lz4,pcre}-devel {unixODBC,expat,mariadb}-devel GeoIP-devel

# checkout the hhvm code and build it.
RUN mkdir -p /opt/src/hhvm && git clone https://github.com/facebook/hhvm.git --depth=1 /opt/src/hhvm
RUN cd /opt/src/hhvm/ && git submodule update --init --recursive
RUN cd /opt/src/hhvm/ && cmake3 .
RUN cd /opt/src/hhvm/ && make
RUN cd /opt/src/hhvm/ && make install

