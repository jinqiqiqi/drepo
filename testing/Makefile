
new: run

restart: stop
	make start

start: 
	@docker start testing

stop: 
	@docker stop testing

rm: stop
	@docker rm testing

build:
	@docker build -t kinch/testing .

on:
	docker run -it kinch/testing bash

run: stop rm 
	@docker run -d --name testing -p 80:80 -v /home/kinch/Public/book/newMem:/usr/share/nginx/html/ -v /home/kinch/Public/book/mysql_data:/var/lib/mysql kinch/testing

bash:
	@docker exec -it testing bash