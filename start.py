#!/usr/bin/env python3

import sys
import subprocess

if len(sys.argv) != 3:
    raise SystemExit('Usage: python3 start.py <base_dir> <team_number>')

base_dir = sys.argv[1]
teamno = int(sys.argv[2])

def start_flag():
    subprocess.check_call(['sh', 'docker.sh'], cwd='flag_server')
    print('[*] start docker flag_server')

def gen_host_lists():
    res = ''
    for i in range(teamno):
        res += "team%d:172.17.0.%d\n" % (i + 1, i + 2)
    with open('check_server/host.lists', 'w') as fp:
        fp.write(res)
	

def start_check():
    gen_host_lists()
    subprocess.check_call(['sh', 'docker.sh'], cwd='check_server')
    print('[*] start docker check_server')

def start_team(teamno):
    team_dir = 'team' + str(teamno)
    subprocess.check_call(['sh', 'docker.sh'], cwd='%s/%s' % (base_dir, team_dir))
    print('[*] start docker %s' % team_dir)

if __name__ == '__main__':
    for i in range(teamno):
        start_team(i + 1)
    
    start_check()
    start_flag()
