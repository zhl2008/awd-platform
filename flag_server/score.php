<?php

require 'config.php';
if(isset($_REQUEST['key'])){
    if($_REQUEST['key']!==$key) die('error: wrong key');
}else{
    die('error: empty key');
}


if(isset($_REQUEST['write'])){
    if(isset($_REQUEST['score'])){
	$scores = explode('|' , $_REQUEST['score']);		
	$raw_scores = explode('|' , file_get_contents($record));
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
	file_put_contents($record,$res);
	echo 'success';
    }else{
	die('error: empty score');
    }
}else{
    echo file_get_contents($record);
}
