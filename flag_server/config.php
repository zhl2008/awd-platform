<?php

$team_number = 5;
$user_list = [];
$token_list = array();
$ip_list = array();
for ($i=1; $i <= $team_number; $i++) { 
    array_push($user_list,'team'.$i);
    $token_list['team'.$i] = $i - 1;
    $ip_list['172.17.0.'.($i+1)] = $i - 1;
}

$key = '744def038f39652db118a68ab34895dc';
$time_file = './time.txt';
$min_time_span = 120;
$record = './score.txt';


// var_dump($user_list);
// var_dump($token_list);
// var_dump($ip_list);