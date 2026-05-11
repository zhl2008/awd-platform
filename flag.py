#!/usr/bin/env python3

from http.server import SimpleHTTPRequestHandler
import socketserver

'''
	this script is supposed to run on the gamebox, it record the flag sent
	by the server, and record it to local file system, the normal request
	should be looks like /you_should_not_guess_the_key/04df0f74b98693195d93ac695d51e837
'''


PORT = 9999
key = 'you_should_not_guess_the_key'
flag_path = '/flag'
time_span = 2 * 60

class MyHandler(SimpleHTTPRequestHandler):
    def do_GET(self):
        request = self.path.split('/')
        self.send_response(200)
        self.send_header('Content-type', 'text/html')
        self.end_headers()
        if len(request) == 3 and request[1] == key and len(request[2]) == 32:
            flag = request[2]
            with open(flag_path, 'w') as fp:
                fp.write(flag)
            self.wfile.write(b'hello haozigege!')
        else:
            self.wfile.write(b'get out! hacker!')

Handler = MyHandler
httpd = socketserver.TCPServer(("", PORT), Handler)

print("serving at port", PORT)
httpd.serve_forever()
