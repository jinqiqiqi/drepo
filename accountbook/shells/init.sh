#!/bin/sh

/usr/bin/mysqld_safe --user=mysql &

sleep 5

echo ">>> Trying to add user to mysql."
mysql -e "grant all privileges on *.* to '${MYSQL_USER}'@'localhost' identified by '${MYSQL_PASS}' with grant option; flush privileges;"

echo " [done.] "