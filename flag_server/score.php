<?php

require 'config.php';
if(isset($_REQUEST['key'])){
    if($_REQUEST['key']!==$key) die('error: wrong key');
}else{
    die('error: empty key');
}


if(isset($_REQUEST['write'])){
    if(isset($_REQUEST['score'])){
	$fp = fopen($record, 'c+');
	if(!$fp) die('error: cannot open score file');
	flock($fp, LOCK_EX);
	$raw = stream_get_contents($fp);
	$scores = explode('|' , $_REQUEST['score']);
	$raw_scores = explode('|' , trim($raw));
	$length = count($raw_scores);
	$res = '';
	for($i = 0; $i < $length ; $i++){
		$scores[$i] += $raw_scores[$i];
		if($i == 0){
			$res .= $scores[$i];
		}else{
			$res .= '|' . $scores[$i];
		}
	}
	ftruncate($fp, 0);
	rewind($fp);
	fwrite($fp, $res);
	fflush($fp);
	flock($fp, LOCK_UN);
	fclose($fp);
	echo 'success';
    }else{
	die('error: empty score');
    }
}else{
    echo file_get_contents($record);
}
