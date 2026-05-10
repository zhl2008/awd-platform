#!/bin/sh
cd /var/www/html
service apache2 stop
service apache2 start
python3 new.py 5
/bin/bash
