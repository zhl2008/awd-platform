#!/bin/sh

docker run -v `pwd`:/var/www/html -p 9090:8080  -ti ubuntu:16.10 
