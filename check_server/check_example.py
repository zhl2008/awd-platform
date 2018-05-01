#!/usr/bin/env python
# -*- coding:utf8 -*-
'''
1.login module
2.message module
3.admin add module
4.calc module
5.cgi module
6.db_admin module
7.count module

'''

import hashlib
import time
from config1 import *
import httplib

def http(method,host,port,url,data,headers):
    con=httplib.HTTPConnection(host,port,timeout=20)
    if method=='post' or method=='POST':
        headers['Content-Length']=len(data)
        con.request("POST",url,data,headers=headers)
    else:
    headers['Content-Length'] = 0
        con.request("GET",url,headers=headers)
    res = con.getresponse()
    if res.getheader('set-cookie'):
    headers['Cookie'] = headers['Cookie']+';'+res.getheader('set-cookie')
    a = res.read()
    con.close()
    return a


class check():
    def __init__(self):
    print "checking host: "+host

    def login_check(self):
    http('get',host,80,'/ez_web/admin/index.php','',headers)
    if 'success' in http('get',host,80,'/ez_web/cgi-bin/proxy.cgi?uname='+web_admin+'&passwd='+web_admin_pass+'&target=login.cgi','',headers):
       print "login check success"
       return True
    print "login check error"
    return False

    def message_check(self):
    if 'success' in http('get',host,80,'/ez_web/cgi-bin/proxy.cgi?message=<script>alert("flag")</script>&target=message.cgi','',headers):
        print "message check success"
        return True
    print "message check error"
    return False


    def add_admin_check(self):
    global web_admin
    global web_admin_pass
    web_admin = 'haozi_'+hashlib.md5('_salt_'+str(time.time())).hexdigest()
    web_admin_pass = hashlib.md5(web_admin).hexdigest()
    if 'success' in http('get',host,80,'/ez_web/cgi-bin/proxy.cgi?uname='+web_admin+'&passwd='+web_admin_pass+'&target=add_admin.cgi','',headers) and self.login_check():
        print "add admin success"
        return True
    print "add admin error"
    return False

    def cgi_check(self):
    if 'haozi' in http('get',host,80,'/ez_web/cgi-bin/skin_api.cgi','',headers):
        print "cgi check ok"
        return True
    print "cgi check error"
    return False

    def count_check(self):
    tmp = http('get',host,80,'/ez_web/admin/count.php','',headers)
    if int(tmp)+1 == int(http('get',host,80,'/ez_web/admin/count.php','',headers)):
        print "count check success"
        return True
    print "count check error"
    return False

    def calc_check(self):
    if "212.2641509434" in http('get',host,80,'/ez_web/cgi-bin/proxy.cgi?armor=6&level=3&target=calc.cgi&options=e','',headers):
        print "calc check success"
        return True
    print "calc check error"
    return False

    def db_admin_check(self):
    if "table {border-collapse: collapse; border-spacing: 0;}" in http('get',host,80,'/ez_web/admin/db_admin.php','',headers):
        print "db_admin check success"
        return True
    print "db_admin check error"
    return False


hosts = open('hosts.list','r').readlines()

def server_check():
    try:
    a = check()
    if not a.login_check():
        return False
    if not a.message_check():
        return False
    if not a.add_admin_check():
        return False
    if not a.cgi_check():
        return False
    if not a.count_check():
        return False
    if not a.calc_check():
        return False
    if not a.db_admin_check():
        return False
    return True
    except Exception,e:
    print e
    return False

for host in hosts:
    print "---------------------------------------------------------------"
    host = host[:-1]
    if server_check():
    print "Host: "+host+" seems ok"
    else:
    print "Host: "+host+" seems down"

