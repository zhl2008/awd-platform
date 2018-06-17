#!/usr/bin/env python

import SimpleHTTPServer
import SocketServer
import hashlib
import time

'''
	this script is supposed to run on the gamebox, it record the flag sent
	by the server, and record it to local file system, the normal request
	should be looks like /you_should_not_guess_the_key/04df0f74b98693195d93ac695d51e837
'''


PORT = 9999
key = 'you_should_not_guess_the_key'
flag_path = '/flag'
time_span = 2 * 60

# generate,record the flag and check the flag
# class my_handler(SimpleHTTPServer.SimpleHTTPRequestHandler):
# 	def do_GET(self):
# 		request = self.path.split('/')
# 		self.send_response(200)
# 		self.send_header('Content-type', 'text/html')
# 		self.end_headers()
# 		if len(request) == 3 and request[1] == key and len(request[2]) == 32:
# 			flag = request[2]
# 			real_flag = hashlib.md5(key + str(int(time.time())/time_span) ).hexdigest()
# 			open(flag_path,'w').write(real_flag)
# 			if flag == real_flag:
# 				self.wfile.write('ok')
# 			else:
# 				self.wfile.write('error')
# 		else:
# 			self.wfile.write('get out! hacker!') 

# record the flag
class my_handler(SimpleHTTPServer.SimpleHTTPRequestHandler):
    def do_GET(self):
	request = self.path.split('/')
	self.send_response(200)
	self.send_header('Content-type', 'text/html')
	self.end_headers()
	if len(request) == 3 and request[1] == key and len(request[2]) == 32:
	    flag = request[2]
	    open(flag_path,'w').write(flag)
	    self.wfile.write('hello haozigege!')
	else:
	    self.wfile.write('get out! hacker!') 

Handler = my_handler
httpd = SocketServer.TCPServer(("", PORT), Handler)

print "serving at port", PORT
httpd.serve_forever()
