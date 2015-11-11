FROM centos
MAINTAINER Eric King <jinqiqiqi@gamil.com>


###### static lines
ADD ./conf/CentOS-Base.repo /etc/yum.repo.d/CentOS-Base.repo
RUN ["rpm", "--import", "/etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7"]
RUN ["yum", "clean", "all"]
RUN ["yum", "-y", "update"]

RUN yum -y install pcre* openssl* gcc* wget unzip cmake git ffmpeg-devel

RUN yum -y install libX11-devel libGL-devel libv4l-devel pulseaudio-libs-devel x264-devel freetype-devel fontconfig-devel libXcomposite-devel libXinerama-devel qt5-qtbase-devel qt5-qtx11extras-devel libcurl-devel 

###### dynamic lines
ADD ./src/nginx-1.6.3.tar.gz /opt/src/
ADD ./src/nginx-rtmp-module.tar.gz /opt/src/

ADD ./shells/build.sh /opt/shells/build.sh
RUN chmod +x /opt/shells/build.sh
# ADD ./shells/run.sh /opt/shells/run.sh

RUN /opt/shells/build.sh




# VOLUME ["/usr/share/nginx/html/"]
# WORKDIR /usr/share/nginx/html/

EXPOSE 88
EXPOSE 99
# ENTRYPOINT ["/usr/sbin/php-fpm"]
