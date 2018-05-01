#!/bin/sh

docker run -p 8888:80 -v `pwd`:/var/www/html  -ti web_14.04
