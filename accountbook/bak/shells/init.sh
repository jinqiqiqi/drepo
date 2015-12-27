#!/bin/sh

/usr/libexec/mysqld --user=mysql --basedir=/usr --datadir=/var/lib/mysql --plugin-dir=/usr/lib64/mysql/plugin --log-error=/var/log/mariadb/mariadb.log --pid-file=/var/run/mariadb/mariadb.pid --socket=/var/lib/mysql/mysql.sock &

sleep 5

echo ">>> Trying to add user to mysql."
mysql -e "grant all privileges on *.* to '${MYSQL_USER}'@'localhost' identified by '${MYSQL_PASS}' with grant option; flush privileges;"

echo " [done.] "