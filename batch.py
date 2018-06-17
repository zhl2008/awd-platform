#!/usr/bin/env python

import time
import random
import os
import hashlib
import sys

def copy_dir(src,dest):
	os.system('cp -r %s %s'%(src,dest))

def generate_pass(teamno):
	salt = 'yunsi_security'
	passwd = hashlib.md5(salt + str(time.time()) + str(teamno)).hexdigest()
	open('pass.txt','a').write('team' + str(teamno) + ':ctf:' + passwd + "\n") 
	return passwd

def generate_run_sh(teamno,password):
	content = """#!/bin/sh
cd /var/www/html
service ssh start
service apache2 start
service mysql start
python flag.py &  2>&1 1>/dev/null
echo ctf:%s | chpasswd
/bin/bash""" % password
	
	return content

def generate_docker_sh(teamno):
	content = """#!/bin/sh
docker run -p %d:80  -p %d:22 -v `pwd`:/var/www/html -d  --name team%d -ti web_14.04 /var/www/html/run.sh 
"""% (8800 + teamno, 2200 + teamno,teamno)
	return content

def generate_flag_py(teamno,password):
	content = open('flag.py').read().replace('you_should_not_guess_the_key',password)
	return content

def main():
	dir = sys.argv[1]
	team_number = int(sys.argv[2])  

	open('./check_server/pass.txt','w').write("")
	open('pass.txt','w').write('')

	for i in range(team_number):

		password = generate_pass(i)

		team_dir = 'team' + str(i+1)
		copy_dir(dir,team_dir)
		print '[*] copy %s' % team_dir

		os.system('chmod 777 -R %s'%team_dir)
		print '[*] chmod all '

		open(team_dir + '/run.sh','w').write(generate_run_sh(i+1,password))
		print '[*] write run.sh %s' % team_dir

		open(team_dir + '/docker.sh','w').write(generate_docker_sh(i+1))
		print '[*] write docker.sh %s' % team_dir

		open(team_dir + '/flag.py','w').write(generate_flag_py(i+1,password))
		print '[*] write flag.py %s' % team_dir

		os.system('chmod 700 %s/run.sh %s/docker.sh %s/flag.py' % (team_dir,team_dir,team_dir))
		print '[*] chmod run.sh & docker.sh %s' % team_dir

		open('./check_server/pass.txt','a').write("%s:%s\n" %(team_dir,password))

if __name__ == '__main__':
	main()
	
