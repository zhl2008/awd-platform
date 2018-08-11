#!/bin/bash

service apache2 stop
su -c "export PATH=/app/node/bin:$PATH; node server.js --port=8080" ctf
