<?php

require 'config.php';
$now_time = time();
$submit_lock_file = './submit.lock';

function check_time($attack_uid,$victim_uid){
    global $time_file;
    global $min_time_span;
    global $now_time;
    global $team_number;
    $old_times = explode('|' , file_get_contents($time_file));
    $id = $attack_uid * $team_number + $victim_uid;
    if ($now_time - $old_times[$id] < $min_time_span){
	die("error: submit too quick ". ($min_time_span + $old_times[$id] - $now_time). " seconds left");
    }else{
	return True;
    }
}

function update_time($attack_uid,$victim_uid){
    global $time_file;
    global $now_time;
    global $team_number;
    $old_times = explode('|' , file_get_contents($time_file));
    $id = $attack_uid * $team_number + $victim_uid;
    $old_times[$id] = $now_time;
    $now_times = $old_times;
    file_put_contents($time_file,implode('|' , $now_times));
}

if(isset($_REQUEST['token'])){
    $token = $_REQUEST['token'];
    $ip = isset($_REQUEST['test_ip'])?$_REQUEST['test_ip']:$_SERVER['REMOTE_ADDR'];
    if(!array_key_exists($token , $token_list)){
	die('error: no such token');
    }
    if(!array_key_exists($ip , $ip_list)){
	die('error: no such ip '.$ip);
    }
    $attack_id = $token_list[$token];
    $victim_id = $ip_list[$ip];
    if($attack_id === $victim_id){
	die('error: do not attack yourself');
    }
    for($i=0;$i<$team_number;$i++){
	$scores[$i] = 0;
    }
    $scores[$attack_id] = 2;
    $scores[$victim_id] = -2; 
    $lock_fp = fopen($submit_lock_file, 'c');
    if(!$lock_fp) die('error: cannot open submit lock');
    flock($lock_fp, LOCK_EX);
    check_time($attack_id,$victim_id);
    update_time($attack_id,$victim_id);
    flock($lock_fp, LOCK_UN);
    fclose($lock_fp);
    $score = implode('|',$scores);
    file_put_contents('result.txt',$user_list[$attack_id] . ' => ' . $user_list[$victim_id]."\n", FILE_APPEND);
    $cmd = 'curl "127.0.0.1/score.php?key='.$key.'&write=1&score='.$score.'"';
    system($cmd);
 
}else{
    die("error: empty token");
}
