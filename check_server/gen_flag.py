#!/usr/bin/env python

import requests

port = 9999
time_span = 2 * 60
record_path = '../flag_server/xxxxxxxx_flag'


hosts = open('host.lists').readlines()
passwds = open('../pass.txt').readlines()


password_list = {}
host_list = {}

for passwd in passwds:
	teamno,password = passwd.strip().split(':')
	password_list[teamno] = password

for host in hosts:
	teamno,host = host.strip().split(':')
	host_list[teamno] = host


while True:
	open(record_path,'w').write()
	for teamno in host_list:
		flag = hashlib.md5().hexdigest(password_list[teamno] +  host_list[teamno] +  str(int(time.time())/time_span))

		url_1 = 'http://' + host + ':' + port + '/' + password_list[teamno] + '/' + flag
		try:
			r = requests.get(url_1)
		except Exception,e:
			print '[!] error:' + str(e)
		open(record_path,'a').write(host_list[teamno] + ':' + password_list[teamno] + "\n" )
		print '[*] flag for %s update to %s!' % (host_list[teamno],password_list[teamno])

