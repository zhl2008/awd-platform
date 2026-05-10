#!/usr/bin/env python3

import requests
import hashlib
import time

port = 9999
time_span = 2 * 60
record_path = './flag_server/xxxxxxxx_flag'


with open('host.lists') as fp:
    hosts = fp.readlines()
with open('./pass.txt') as fp:
    passwds = fp.readlines()


password_list = {}
host_list = {}

for passwd in passwds:
    teamno, user, password = passwd.strip().split(':')
    password_list[teamno] = password

for host in hosts:
    teamno, host = host.strip().split(':')
    host_list[teamno] = host


while True:
    open(record_path, 'w').write('')
    for teamno in host_list:
        raw = password_list[teamno] + host_list[teamno] + str(int(time.time()) // time_span)
        flag = hashlib.md5(raw.encode('utf-8')).hexdigest()

        url_1 = 'http://' + host_list[teamno] + ':' + str(port) + '/' + password_list[teamno] + '/' + flag
        try:
            requests.get(url_1)
        except Exception as e:
            print('[!] error:' + str(e))
        with open(record_path, 'a') as fp:
            fp.write(host_list[teamno] + ':' + flag + "\n")
        print('[*] flag for %s update to %s!' % (host_list[teamno], flag))

    time.sleep(time_span)
