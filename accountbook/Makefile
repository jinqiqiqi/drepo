
new: run

restart: stop
	make start

start: 
	@docker start accountbook

stop: 
	@docker stop accountbook

rm: stop
	@docker rm accountbook

build:
	@docker build -t kinch/accountbook .

run: stop rm 
	@docker run -d --name accountbook -p 80:80 -v /home/kinch/Public/book/newMem:/usr/share/nginx/html/ -v /home/kinch/Public/book/mysql_data:/var/lib/mysql kinch/accountbook

bash:
	@docker exec -it accountbook bash