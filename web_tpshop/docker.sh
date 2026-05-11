#!/bin/sh

docker run -v `pwd`:/var/www/html -p 9090:80  -ti zhl2008/web_14.04 
