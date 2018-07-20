#!/usr/bin/env python


import os


os.system("docker ps | awk '{print $1}' | xargs docker stop ")
os.system("docker ps -a | awk '{print $1}' | xargs docker rm")
os.system('rm -rf team*')
