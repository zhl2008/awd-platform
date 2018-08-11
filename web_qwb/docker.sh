#!/bin/sh

docker run -p 9090:80 -v `pwd`:/var/www/html/  -ti web_14.04 /var/www/html/run.sh 
