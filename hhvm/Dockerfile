FROM centos:latest

MAINTAINER Eric King <jinqiqiqi@gamil.com>

RUN rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7 && yum clean all && yum update -y && yum install -y epel-release && rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-EPEL-7

RUN yum install -y  cmake cmake3 cpp enca gcc-c++ git glog-devel gperf libjpeg-turbo-devel lib{edit,curl,xml2,xslt}-devel lib{xslt,event,yaml,vpx,png,zip,icu,mcrypt,memcached,cap,dwarf}-devel make mariadb mariadb-server ocaml oniguruma-devel openssl-devel psmisc zeromq-devel {binutils,boost,jemalloc,numactl}-devel {fastlz,double-conversion,re2}-devel {fribidi,libc-client,glib2}-devel {ImageMagick,sqlite,tbb,bzip2,openldap,readline,elfutils-libelf,gmp,lz4,pcre}-devel {unixODBC,expat,mariadb}-devel GeoIP-devel

RUN rpm -ivh http://mirrors.linuxeye.com/hhvm-repo/7/x86_64/hhvm-3.14.4-1.el7.centos.x86_64.rpm http://mirrors.linuxeye.com/hhvm-repo/7/x86_64/hhvm-devel-3.14.4-1.el7.centos.x86_64.rpm

