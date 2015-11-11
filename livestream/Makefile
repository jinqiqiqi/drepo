#!/bin/sh

new: stop rm build run

restart: stop
	make start

start: 
	@docker start livestream

stop: 
	@docker stop livestream

rm: 
	@docker rm livestream

build:
	@docker build -t hpp/livestream .

run: 
	@docker run -d --name livestream -p 88:88 -p 99:99 hpp/livestream

bash:
	@docker exec -it livestream bash
