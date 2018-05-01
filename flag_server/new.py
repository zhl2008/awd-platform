#!/usr/bin/env python
import sys

team_number = int(sys.argv[1])
time_content = '|'.join(['0'] * (team_number * team_number))
score_content = '|'.join(['0'] * team_number)
open('score.txt','w').write(score_content)
open('time.txt','w').write(time_content)
open('result.txt','w').write('')
