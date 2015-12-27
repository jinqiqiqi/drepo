
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
	@docker run -d --name accountbook -p 80:80 -p 9001:9001 -v /Users/kinch/Public/book/newMem:/usr/share/nginx/html/ kinch/accountbook

bash:
	@docker exec -it accountbook bash