#!/bin/sh

ps:
	@echo All containers: 
	@docker ps -a

restart-php: stop-php 
	make start-php

restart-mysql: stop-mysql 
	make start-mysql

restart-nginx: stop-nginx 
	make start-nginx


start: start-mysql start-php start-nginx

start-mysql:
	docker start hppmysql

start-php:
	docker start hppphp

start-nginx:
	docker start hppnginx


stop: stop-mysql stop-php stop-nginx

stop-mysql:
	docker stop hppmysql

stop-php:
	docker stop hppphp

stop-nginx:
	docker stop hppnginx

rm: rm-mysql rm-php rm-nginx

rm-mysql:
	docker rm hppmysql

rm-php:
	docker rm hppphp

rm-nginx:
	docker rm hppnginx


build: build-mysql build-php build-nginx

build-mysql:
	docker build -t hpp/mysql ./mysql
build-mq:
	docker build -t hpp/mq ./rabbitmq
build-php:
	docker build -t hpp/php ./php
build-nginx:
	docker build -t hpp/nginx ./nginx

run: run-mysql run-php run-nginx

run-mysql:
	docker run -d --name hppmysql -p 3306:3306 hpp/mysql

run-php:
	docker run -d --name hppphp -p 9000:9000 -v ./:/usr/share/nginx/html hpp/php


run-nginx:
	docker run -d --name hppnginx --link hppphp:php --link hppmysql:mysql --volumes-from hppphp -p 80:80 hpp/nginx

bash-nginx:
	docker exec -it hppnginx bash

bash-mysql:
	docker exec -it hppmysql bash

bash-php:
	docker exec -it hppphp bash
