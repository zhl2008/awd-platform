#!/bin/bash

ln -s /app/bin/bee /bin/bee
ln -s /app/go/bin/go /usr/bin/go
ln -s /flag /app/src/gotsctf2018/flag
source ./myenv
cd src/gotsctf2018/
service apache2 stop
su -c "bee run" ctf
