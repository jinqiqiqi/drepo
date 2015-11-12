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

run: stop rm 
	@docker run -d --name livestream -p 88:88 -p 1935:1935 -v `pwd`/html:/opt/nginx163/html hpp/livestream

bash:
	@docker exec -it livestream bash


# ffmpeg -f video4linux2 -s 1280x720 -i /dev/video0 -vcodec libx264 -preset ultrafast -vprofile baseline -vlevel 1.0 -s 640x480 -b:v 800k -r 25 -pix_fmt yuv420p -f flv rtmp://192.168.232.114/live/usbcam


# ffmpeg -f video4linux2 -s 1280x720 -i /dev/video0 -vcodec mpeg4 -acodec libfaac -preset ultrafast -vprofile baseline -vlevel 1.0 -s 640x480 -b:v 800k -r 25 -pix_fmt yuv420p -f flv rtmp://192.168.232.114/live/usbcam

# ffmpeg -f video4linux2 -s 1280x720 -i /dev/video0 -vcodec mpeg4 -acodec libfaac -preset ultrafast -vlevel 1.0 -s 640x480 -b:v 800k -r 25 -pix_fmt yuv420p -f flv rtmp://192.168.232.114/live/usbcam

# ffmpeg -f video4linux2 -s 1280x720 -i /dev/video0 -acodec libfaac -b:a 128k -vcodec mpeg4 -b:v 1200k -flags +aic+mv4 rtmp://192.168.232.114/live/usbcam

# ffmpeg -f video4linux2 -s 1280x720 -i /dev/video0 -acodec libfaac  -vcodec libx264 -preset ultrafast -vprofile baseline -vlevel 1.0 -s 640x480 -b:v 800k -r 25 -pix_fmt yuv420p -f flv rtmp://192.168.232.114/live/usbcam


# ffmpeg -f video4linux2 -s 1280x720 -i /dev/video0 -acodec libmp3lame   -threads 3 -vcodec libx264 -preset ultrafast -vprofile baseline -vlevel 1.0 -s 640x480 -b:v 56k -r 25 -pix_fmt yuv420p -strict -2 -f flv rtmp://192.168.232.114/live/usbcam


# ffmpeg -f video4linux2 -s 1280x720 -i /dev/video0 -acodec libmp3lame   -threads 3 -vcodec libx264 -preset ultrafast -vprofile baseline -vlevel 1.0 -s 640x480 -b:v 56k -r 25 -pix_fmt yuv420p -strict -2 -an -f flv rtmp://192.168.232.114/live/usbcam

