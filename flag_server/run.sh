#!/bin/sh
cd /var/www/html
service apache2 stop
service apache2 start
python new.py 5
/bin/bash