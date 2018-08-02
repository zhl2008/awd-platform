<?php


// Setup inclusions
$load['plugin'] = true;

// Include common.php
include('inc/common.php');

if (!defined('GSIMAGEWIDTH')) {
	$width = 200; //New width of image  	
} else {
	$width = GSIMAGEWIDTH;
}
	
if ($_POST['sessionHash'] === $SESSIONHASH) {
	if (!empty($_FILES)){
		
		$tempFile  = $_FILES['Filedata']['tmp_name'];
		
		$file      = $_FILES['Filedata']['name'];
		$extension = pathinfo($file,PATHINFO_EXTENSION);

  		$name      = pathinfo($file,PATHINFO_FILENAME);
		$name      = clean_img_name(to7bit($name));

		$targetPath = (isset($_POST['path'])) ? GSDATAUPLOADPATH.$_POST['path']."/" : GSDATAUPLOADPATH;
		$targetFile =  str_replace('//','/',$targetPath) . $name . '.'.$extension;
		
		//validate file
		if (validate_safe_file($tempFile, $_FILES["Filedata"]["name"])) {
			move_uploaded_file($tempFile, $targetFile);
			if (defined('GSCHMOD')) {
				chmod($targetFile, GSCHMOD);
			} else {
				chmod($targetFile, 0644);
			}
			exec_action('file-uploaded');
		} else {
			die(i18n_r('ERROR_UPLOAD') . ' - ' . i18n_r('BAD_FILE'));
			// invalid file
		}
		 
		$path = (isset($_POST['path'])) ? $_POST['path']."/" : "";			
		require('inc/imagemanipulation.php');	
		genStdThumb(isset($_POST['path']) ? $_POST['path']."/" : '',$name.'.'.$extension);	

		die('1');
		// success
	} else {
		die(i18n_r('ERROR_UPLOAD') . ' - ' . i18n_r('MISSING_FILE'));
		// nothing sent
	}
} else {
	die(i18n_r('ERROR_UPLOAD') . ' - ' . i18n_r('API_ERR_AUTHFAILED'));
	// Wrong session hash!
}

die('END');