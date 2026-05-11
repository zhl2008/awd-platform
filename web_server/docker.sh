#!/bin/sh

docker run -p 8888:80 -v `pwd`:/var/www/html  -ti zhl2008/web_14.04
