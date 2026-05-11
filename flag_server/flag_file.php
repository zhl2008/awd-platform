<?php

require 'config.php';
#require 'pass.php';
$now_time = time();
$flag_file = 'xxxxxxxx_flag';
$submitted_file = './submitted.txt';
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

function match_flag($flag,$flag_file){
    $flags = explode("\n",file_get_contents($flag_file));
    foreach ($flags as $real_flag) {
        if(trim($real_flag) === ''){
            continue;
        }
	$tmp = explode(":",$real_flag);
        if(count($tmp) < 2){
            continue;
        }
	$host = $tmp[0];
	$real_flag = $tmp[1];
        if($flag==$real_flag){
            return $host;
        }
    }
    return '';

}

function get_submission_key($attack_id,$victim_id,$flag){
    return sha1($attack_id.'|'.$victim_id.'|'.$flag);
}

function check_duplicate_submission($submission_key){
    global $submitted_file;
    $submitted = file_exists($submitted_file) ? file_get_contents($submitted_file) : '';
    if(strpos($submitted, $submission_key."\n") !== false){
        die('error: duplicate flag');
    }
}

function record_submission($submission_key){
    global $submitted_file;
    file_put_contents($submitted_file, $submission_key."\n", FILE_APPEND);
}

if(isset($_REQUEST['token']) && isset($_REQUEST['flag'])){
    $token = $_REQUEST['token'];
    $flag = $_REQUEST['flag'];
    //$ip = isset($_REQUEST['test_ip'])?$_REQUEST['test_ip']:$_SERVER['REMOTE_ADDR'];
    if(!array_key_exists($token , $token_list)){
	die('error: no such token');
    }
    $ip = match_flag($flag,$flag_file);
    if(!$ip){
	die('error: no such flag');
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
    $submission_key = get_submission_key($attack_id,$victim_id,$flag);
    check_duplicate_submission($submission_key);
    check_time($attack_id,$victim_id);
    record_submission($submission_key);
    update_time($attack_id,$victim_id);
    flock($lock_fp, LOCK_UN);
    fclose($lock_fp);
    $score = implode('|',$scores);
    file_put_contents('result.txt',$user_list[$attack_id] . ' => ' . $user_list[$victim_id]."\n", FILE_APPEND);
    $cmd = 'curl "127.0.0.1/score.php?key='.$key.'&write=1&score='.$score.'"';
    system($cmd);
 
}else {
    die("error: empty token or empty target");
}
