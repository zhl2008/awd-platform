#!/bin/sh


docker run -v `pwd`:/var/www/html -d --name check_server -ti web_14.04:latest 
