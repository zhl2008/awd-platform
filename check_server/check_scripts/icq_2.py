#!/usr/bin/env python
# -*- coding:utf8 -*-
import hashlib
import base64

debug = True
headers = {"User-Agent":"Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36"}

import time
import httplib
import urllib2
import ssl 
import sys

def http(method,host,port,url,data,headers):
    con=httplib.HTTPConnection(host,port,timeout=2)
    if method=='post' or method=='POST':
        headers['Content-Length']=len(data)
        headers['Content-Type']='application/x-www-form-urlencoded'  
        con.request("POST",url,data,headers=headers)
    else:
        headers['Content-Length'] = 0    
        con.request("GET",url,headers=headers)
    res = con.getresponse()
    if res.getheader('set-cookie'):
        #headers['Cookie'] = res.getheader('set-cookie')
        pass
    if res.getheader('Location'):
	pass
        #print "Your 302 direct is: "+res.getheader('Location')
    a = res.read()
    con.close()
    return a


def https(method,host,port,url,data,headers):
    url = 'https://' + host + ":" + str(port) + url
    req = urllib2.Request(url,data,headers)
    response = urllib2.urlopen(req)
    return response.read()


class check():
    def __init__(self,host,port):
	#print "checking host: "+host
	pass

    def index_check(self):
	res = http('get',host,port,'/index.php?file=news&cid=1&page=1&test=eval','',headers)
	if '您好，欢迎来到币创网网-专业数字资产交易平台' in res:
	    return True
	if debug:
	    print "[fail!] index_fail"
	return False
	

    def test_check(self):
	res = http('get',host,port,'/Article/index','',headers)
	if '官方公告' in res:
	    return True
	if debug:
	    print "[fail!] test_fail"
	return False


    def flag_check(self):
	headers['Cookie'] = ''
	data = base64.b64encode('eval($b($c($d($b($c($d($b($c($d($b($c($d("BcHJglAwAADQD2Uo0UsOPUtNR8UYVqkb1RhYcKT2r+975tP9ze/G4hhpcgKyhlHNeFY+VLqnCNUBq55lTggTDCQuMEAPeGsrZK35BnUpXBriUPk9VDxp4pL3x7iYj3YH5nIa0/qxXMRMsvmVjX7vkjjs0YYadh5onm96ALwKbaxC1cZgZt5MxBQAi7XfekgpnF0oRBHRVIaznEZaDjbMBJxLXlnLHEIqhMhPofY0PhV3WPsfvYhn7Prhxzc7tw1NLDh7XuS7O3ODKMbAvU1/vAx1kJDp9n59kK7eA84Sw1WUeZfpZTp9AQ==")))))))))))));');
	res = http('post',host,port,'/home/index/flag?len=32',data,headers)
	if 'OK' in res:
	    return True
	if debug:
	    print "[fail!] flag_fail"
	return False
	

    def login_check(self):
	headers['Cookie'] = 'PHPSESSID=ujg0tpds1u9d23b969f2duj5c7;'
	headers['X-Requested-With'] = 'XMLHttpRequest'
	res = http('post',host,port,'/admin/login/index.html','username=admin&password=admin&verify=7480',headers)
	if '"status":1' in res:
	    return True
	if debug:
	    print "[fail!] login_fail"
	return False

    def admin_check(self):
	data = 'eval(666)'
	headers['Cookie'] = 'PHPSESSID=ujg0tpds1u9d23b969f2duj5c7;'
    	res = http('get',host,port,'/admin/tools/database?type=export',data,headers)
	tmp = http('get',host,port,'/admin/login/loginout.html','',headers)
	if 'qq3479015851_article_type' in res:
	    return True
	if debug:
	    print "[fail!] admin_fail"
	return False
    

def server_check(host,port):
    try:
	a = check(host,port)
	if not a.index_check():
	    return False
	if not a.test_check():
	    return False
	if not a.login_check():
	    return False	
	if not a.flag_check():
	    return False	
	if not a.admin_check():
	    return False
	return True
    except Exception,e:
	print e
	return False

if __name__ == "__main__":
    if len(sys.argv) == 3:
	host=sys.argv[1]
	port=sys.argv[2]
	if server_check(host,port):
	    print 'ok'
    else:
        sys.exit()
 
