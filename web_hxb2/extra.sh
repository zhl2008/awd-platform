#!/bin/bash

ln /var/www/html -s /web
cd /web/project
su -c "source /var/www/html/bin/activate;python manage.py runserver 0.0.0.0:8080" ctf


