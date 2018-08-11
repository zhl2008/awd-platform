#!/bin/bash

ln /var/www/html -s /web
cd /web/project
service apache2 stop
service mysql stop
su -c "source /var/www/html/bin/activate;python manage.py runserver 0.0.0.0:8080" ctf


