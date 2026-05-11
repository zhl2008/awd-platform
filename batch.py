#!/usr/bin/env python3

import time
import os
import hashlib
import shutil
import sys

def copy_dir(src, dest):
    shutil.copytree(src, dest)


def chmod_recursive(path, mode):
    os.chmod(path, mode)
    for root, dirs, files in os.walk(path):
        for name in dirs:
            os.chmod(os.path.join(root, name), mode)
        for name in files:
            os.chmod(os.path.join(root, name), mode)

def generate_pass(teamno):
    salt = 'yunsi_security'
    raw = salt + str(time.time()) + str(teamno)
    passwd = hashlib.md5(raw.encode('utf-8')).hexdigest()
    with open('pass.txt', 'a') as fp:
        fp.write('team' + str(teamno) + ':ctf:' + passwd + "\n")
    return passwd

def generate_run_sh(teamno, password):
    content = """#!/bin/sh
cd /var/www/html
service ssh start
a2enmod rewrite
service apache2 start
service mysql start
python3 flag.py &  2>&1 1>/dev/null
useradd ctf
echo ctf:%s | chpasswd
sleep 2
mysql -uroot -proot < *.sql
if [ -x "extra.sh" ]; then 
./extra.sh
fi
/bin/bash""" % password
    return content

def generate_docker_sh(teamno, my_port, my_image):
    content = """#!/bin/sh
docker run -p %d:%d  -p %d:22 -v `pwd`:/var/www/html -d  --name team%d -ti %s /var/www/html/run.sh 
"""% (8800 + teamno,my_port, 2200 + teamno,teamno,my_image)
    return content

def generate_flag_py(teamno, password):
    with open('flag.py') as fp:
        content = fp.read().replace('you_should_not_guess_the_key', password)
    return content

def generate_host_list(team_number):
    with open('./check_server/host.lists', 'w') as fp:
        for i in range(team_number):
            fp.write('team%d:172.17.0.%d\n' % (i + 1, i + 2))

def generate_flag_run_sh(team_number):
    content = '''#!/bin/sh
cd /var/www/html
service apache2 stop
service apache2 start
python3 new.py %d
/bin/bash''' % team_number
    return content

def generate_flag_config(team_number):
    content = '''<?php

$team_number = %d;
$user_list = [];
$token_list = array();
$ip_list = array();
for ($i=1; $i <= $team_number; $i++) { 
    array_push($user_list,'team'.$i);
    $token_list['team'.$i] = $i - 1;
    $ip_list['172.17.0.'.($i+1)] = $i - 1;
}

$key = '744def038f39652db118a68ab34895dc';
$time_file = './time.txt';
$min_time_span = 120;
$record = './score.txt';


// var_dump($user_list);
// var_dump($token_list);
// var_dump($ip_list);''' % team_number
    return content


def main():
    if len(sys.argv) not in (3, 4, 5):
        raise SystemExit('Usage: python3 batch.py <web_dir> <team_number> [port] [image]')
    src_dir = sys.argv[1]
    team_number = int(sys.argv[2])
    if len(sys.argv) == 3:
        my_port = 80
        my_image = 'zhl2008/web_14.04'
    elif len(sys.argv) == 4:
        my_port = int(sys.argv[3])
        my_image = 'zhl2008/web_14.04'
    elif len(sys.argv) == 5:
        my_port = int(sys.argv[3])
        my_image = sys.argv[4]

    open('./check_server/pass.txt', 'w').write("")
    open('pass.txt', 'w').write('')

    with open('./flag_server/run.sh', 'w') as fp:
        fp.write(generate_flag_run_sh(team_number))

    with open('./flag_server/config.php', 'w') as fp:
        fp.write(generate_flag_config(team_number))

    generate_host_list(team_number)
    
    for i in range(team_number):

        password = generate_pass(i + 1)

        team_dir = 'team' + str(i + 1)
        copy_dir(src_dir, team_dir)
        print('[*] copy %s' % team_dir)

        chmod_recursive(team_dir, 0o777)
        print('[*] chmod all ')

        with open(team_dir + '/run.sh', 'w') as fp:
            fp.write(generate_run_sh(i + 1, password))
        print('[*] write run.sh %s' % team_dir)

        with open(team_dir + '/docker.sh', 'w') as fp:
            fp.write(generate_docker_sh(i + 1, my_port, my_image))
        print('[*] write docker.sh %s' % team_dir)

        with open(team_dir + '/flag.py', 'w') as fp:
            fp.write(generate_flag_py(i + 1, password))
        print('[*] write flag.py %s' % team_dir)

        os.chmod('%s/run.sh' % team_dir, 0o700)
        os.chmod('%s/docker.sh' % team_dir, 0o700)
        os.chmod('%s/flag.py' % team_dir, 0o700)
        print('[*] chmod run.sh & docker.sh %s' % team_dir)

        #open('./check_server/pass.txt','a').write("%s:%s\n" %(team_dir,password))

    shutil.copyfile('pass.txt', './check_server/pass.txt')
if __name__ == '__main__':
    main()
	
