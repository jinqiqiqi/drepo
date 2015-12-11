
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

new: 
	
run: stop rm
	# for linux
	docker run -d --name dev_cakephp -p 80:80 -p 9002:9001 -p 1234:1234 -p 3306:3306 -v /home/kinch/Public/mls:/opt/mls -v /home/kinch/Public/cakephp:/usr/share/nginx/html/cakephp kinch/dev_cakephp

	# for mac
	# docker run -d --name dev_cakephp -p 80:80 -p 9002:9001 -v /User/kinch/Public/cakephp:/usr/share/nginx/html/cakephp kinch/dev_cakephp

bash:
	@docker exec -it dev_cakephp bash
