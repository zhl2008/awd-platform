#!/bin/sh

docker run -v `pwd`:/var/www/html -p 9090:8080  -ti web_14.04 
