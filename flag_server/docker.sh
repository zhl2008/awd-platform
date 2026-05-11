#!/bin/sh

docker run -v `pwd`:/var/www/html -p 8080:80 -d  --name flag_server -ti zhl2008/web_14.04 /var/www/html/run.sh
