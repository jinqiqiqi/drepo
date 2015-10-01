FROM centos:latest
RUN rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7
RUN yum clean all && yum -y update
RUN yum -y install openssh-server && yum clean all

RUN /usr/sbin/sshd-keygen
RUN sed -ri 's/#PermitRootLogin yes/PermitRootLogin yes/g' /etc/ssh/sshd_config
RUN mkdir -p /root/.ssh/
ADD authorized_keys /root/.ssh/authorized_keys
RUN echo "#!/bin/bash" > /root/run.sh
RUN echo "/usr/sbin/sshd -D" >> /root/run.sh
RUN chmod u+x /root/run.sh
EXPOSE 22
CMD ["/root/run.sh"]

#ENTRYPOINT /usr/sbin/php-fpm --nodaemonize