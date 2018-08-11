#!/bin/sh

docker run -v `pwd`:/var/www/html -p 9090:5000 -ti ubuntu:16.10 
