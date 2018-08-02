<?php 

 
// Setup inclusions
$load['plugin'] = true;

// Include common.php
include('inc/common.php');

# check if all variables are set
if(isset($_GET['file'])) {
	
	$file = removerelativepath($_GET['file']);

	$extention = pathinfo($file,PATHINFO_EXTENSION);
	header("Content-disposition: attachment; filename=".$file);
	
	# set content headers
	if ($extention == 'gz') {
		header("Content-type: application/x-gzip");
	} elseif ($extention == 'mpg') {
		header("Content-type: video/mpeg");
	} elseif ($extention == 'jpg' || $extention == 'jpeg' ) {
		header("Content-type: image/jpeg");
	} elseif ($extention == 'txt' || $extention == 'log' ) {
		header("Content-type: text/plain");
	} elseif ($extention == 'xml' ) {
		header("Content-type: text/xml");
	} elseif ($extention == 'js' ) {
		header("Content-type: text/javascript");
	} elseif ($extention == 'pdf' ) {
		header("Content-type: text/pdf");
	} elseif ($extention == 'css' ) {
		header("Content-type: text/css");
	} else {
        header("Content-type: application/octet-stream");
    }
	
	# plugin hook
	exec_action('download-file');
	
	# get file
	if (file_exists($file)) {		
		readfile($file, 'r');
	}
	exit;
	
} else {
	echo 'No such file found';
	die;
}

exit;