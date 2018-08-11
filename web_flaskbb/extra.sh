#!/bin/bash

su -c "source /var/www/html/bin/activate;flaskbb --config flaskbb.cfg run --debugger --reload --host 0.0.0.0" ctf
