#!/bin/sh


docker run -v `pwd`:/var/www/html -v `pwd`/../flag_server:/var/www/html/flag_server   -d --name check_server -ti web_14.04:latest /var/www/html/run.sh 
