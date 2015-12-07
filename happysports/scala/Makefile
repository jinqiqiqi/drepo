
new: run

restart: stop
	make start

start: 
	@docker start dev_hppscala

stop: 
	@docker stop dev_hppscala

rm: stop
	@docker rm dev_hppscala

build:
	@docker build -t kinch/dev_hppscala .

on:
	docker run -it kinch/dev_hppscala bash

new: 
	
run: stop rm
	# for linux
	@docker run -d --name dev_hppscala -p 9999:1234 -v /home/kinch/Public/mls:/opt/mls kinch/dev_hppscala

	# for mac
	# @docker run -d --name dev_hppscala -p 80:80 -p 9002:9001 -p 9999:1234 -v /User/kinch/Public/cakephp:/usr/share/nginx/html/cakephp kinch/dev_hppscala

bash:
	@docker exec -it dev_hppscala bash
