#!/bin/sh

new: stop rm build run

restart: stop
	make start

start: 
	@docker start livestream

stop: 
	@docker stop livestream

rm: stop
	@docker rm livestream

build:
	@docker build -t hpp/livestream .

run: stop rm 
	@docker run -d --name livestream -p 88:88 -p 1935:1935 -v `pwd`/html:/opt/flvs -v `pwd`/html:/opt/nginx163/html hpp/livestream

bash:
	@docker exec -it livestream bash

# ffmpeg -f video4linux2 -s 1280x720 -i /dev/video0 -f alsa -i pulse -acodec aac -vcodec libx264 -preset ultrafast -vprofile baseline -vlevel 1.0 -s 1280x720 -b:v 1024k -r 25 -pix_fmt yuv420p -strict -2 -f flv rtmp://localhost/live/usbcam1

# ffmpeg -f video4linux2 -s 640x320 -i /dev/video0 -f alsa -i pulse -acodec aac -vcodec libx264 -preset ultrafast -vprofile baseline -vlevel 1.0 -s 640x320 -b:v 64k -r 12 -pix_fmt yuv420p -strict -2 -f flv rtmp://localhost/live/usbcam1
