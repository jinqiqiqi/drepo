
new: run

restart: stop
	make start

start: 
	@docker start dev_cakephp

stop: 
	@docker stop dev_cakephp

rm: stop
	@docker rm dev_cakephp

build:
	@docker build -t kinch/dev_cakephp .

on:
	docker run -it kinch/dev_cakephp bash

run: stop rm
	@docker run -d --name dev_cakephp -p 888:80 -p 9002:9001 -v /home/kinch/Public/cakephp:/usr/share/nginx/html/cakephp kinch/dev_cakephp

bash:
	@docker exec -it dev_cakephp bash
