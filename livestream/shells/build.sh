#!/bin/sh

cd /opt/src/nginx-1.8.0

./configure --add-module=/opt/src/nginx-rtmp-module --prefix=/opt/nginx180/
make
make install

cd /opt/src/

git clone https://github.com/jp9000/obs-studio.git
cd obs-studio

mkdir build && cd build
cmake ..
make -j4
sudo make install 