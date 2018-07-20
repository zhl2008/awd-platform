#!/usr/bin/env python

import requests
import hashlib
import time

port = 9999
time_span = 2 * 60
record_path = './flag_server/xxxxxxxx_flag'


hosts = open('host.lists').readlines()
passwds = open('./pass.txt').readlines()


password_list = {}
host_list = {}

for passwd in passwds:
	teamno,user,password = passwd.strip().split(':')
	password_list[teamno] = password

for host in hosts:
	teamno,host = host.strip().split(':')
	host_list[teamno] = host


while True:
	open(record_path,'w').write('')
	for teamno in host_list:
		flag = hashlib.md5(password_list[teamno] +  host_list[teamno] +  str(int(time.time())/time_span)).hexdigest()

		url_1 = 'http://' + host_list[teamno] + ':' + str(port) + '/' + password_list[teamno] + '/' + flag
		try:
			r = requests.get(url_1)
		except Exception,e:
			print '[!] error:' + str(e)
		open(record_path,'a').write(host_list[teamno] + ':' + flag + "\n" )
		print '[*] flag for %s update to %s!' % (host_list[teamno],flag)

	time.sleep(time_span)
