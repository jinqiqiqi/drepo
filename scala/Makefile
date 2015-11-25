
new: run

restart: stop
	make start

start: 
	@docker start scala_dev

stop: 
	@docker stop scala_dev

rm: stop
	@docker rm scala_dev

build:
	@docker build -t kinch/scala_dev .

on:
	docker run -it kinch/scala_dev bash

run: stop rm 
	@docker run -d --name scala_dev kinch/scala_dev
	# @docker run -d --name scala_dev -p 80:80 -v /home/kinch/Public/book/newMem:/usr/share/nginx/html/ -v /home/kinch/Public/book/mysql_data:/var/lib/mysql kinch/scala_dev

bash:
	@docker exec -it scala_dev bash