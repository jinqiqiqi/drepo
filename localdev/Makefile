#!/bin/sh

ps:
	docker ps -a
start:
	make start-mysql
	make start-php
	make start-nginx

start-mysql:
	docker start hppmysql

start-php:
	docker start hppphp

start-nginx:
	docker start hppnginx


stop:
	make stop-mysql
	make stop-php
	make stop-nginx

stop-mysql:
	docker stop hppmysql

stop-php:
	docker stop hppphp

stop-nginx:
	docker stop hppnginx

rm:
	make rm-mysql
	make rm-php
	make rm-nginx

rm-mysql:
	docker rm hppmysql

rm-php:
	docker rm hppphp

rm-nginx:
	docker rm hppnginx


build:
	make build-mysql
	make build-php
	make build-nginx

build-mysql:
	docker build -t hpp/mysql ./mysql
build-php:
	docker build -t hpp/php ./php
build-nginx:
	docker build -t hpp/nginx ./nginx

run:
	make run-mysql
	make run-php
	make run-nginx

run-mysql:
	docker run -d --name hppmysql -p 3306:3306 hpp/mysql

run-php:
	docker run -d --name hppphp -p 9000:9000 -v ./:/usr/share/nginx/html hpp/php


run-nginx:
	docker run -d --name hppnginx --link hppphp:php --link hppmysql:mysql --volumes-from hppphp -p 80:80 hpp/nginx
