#!/usr/bin/env python3


import glob
import re
import shutil
import subprocess


CONTAINER_RE = re.compile(r'^(team[0-9]+|check_server|flag_server)$')


def docker_names(args):
    output = subprocess.check_output(args).decode('utf-8').splitlines()
    return [line.strip() for line in output if CONTAINER_RE.match(line.strip())]


def cleanup_containers():
    names = docker_names([
        'docker', 'ps', '-a',
        '--format', '{{.Names}}',
    ])
    if not names:
        return
    running = docker_names([
        'docker', 'ps',
        '--format', '{{.Names}}',
    ])
    if running:
        subprocess.call(['docker', 'stop'] + running)
    subprocess.call(['docker', 'rm'] + names)


def cleanup_team_dirs():
    for path in glob.glob('team*'):
        if path[4:].isdigit():
            shutil.rmtree(path)


if __name__ == '__main__':
    cleanup_containers()
    cleanup_team_dirs()
