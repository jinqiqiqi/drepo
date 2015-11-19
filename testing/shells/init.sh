# #!/bin/sh

mysqld_safe &

sleep 5

echo ">>> start to add user"
mysql -e "grant all privileges on *.* to 'test'@'localhost' identified by 'test' with grant option; flush privileges; select * from mysql.user;"
echo ">>> add user finished"

echo " [] "