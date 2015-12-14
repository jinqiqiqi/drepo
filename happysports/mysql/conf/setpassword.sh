#!/bin/sh
/usr/libexec/mysqld --user=mysql --basedir=/usr --datadir=/var/lib/mysql --plugin-dir=/usr/lib64/mysql/plugin --log-error=/var/log/mariadb/mariadb.log --pid-file=/var/run/mariadb/mariadb.pid --socket=/var/lib/mysql/mysql.sock &
sleep 5

if [ -z $MYSQL_USER  ]; then
	export MYSQL_HOST=%
	export MYSQL_USER=root
	export MYSQL_PASS=Shanghai!1
fi

echo "host: ${MYSQL_HOST}"
echo "user: ${MYSQL_USER}"
echo "pass: ${MYSQL_PASS}"

echo "term: ${TERM}"

mysql -h 127.0.0.1 -uroot -e  "GRANT ALL ON *.* TO '${MYSQL_USER}'@'$MYSQL_HOST' IDENTIFIED BY '${MYSQL_PASS}' WITH GRANT OPTION; FLUSH PRIVILEGES"