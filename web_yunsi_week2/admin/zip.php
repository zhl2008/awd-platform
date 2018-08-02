<?php


// Setup inclusions
$load['plugin'] = true;


// Include common.php
include('inc/common.php');
login_cookie_check();

// check validity of request
if ($_REQUEST['s'] === $SESSIONHASH) {
	
	
	# fix from hameau 
	//$timestamp = date('Y-m-d-Hi');
	$timestamp = gmdate('Y-m-d-Hi_s');
	$zipcreated = true;
	
	set_time_limit (0);
	ini_set("memory_limit","800M"); 

	$saved_zip_file = GSBACKUPSPATH.'zip/'. $timestamp .'_archive.zip';	
	
	$sourcePath = str_replace('/', DIRECTORY_SEPARATOR, GSROOTPATH);
	if (!class_exists ( 'ZipArchive' , false)) {
		include('inc/ZipArchive.php');
	}
	if (class_exists ( 'ZipArchive' , false)) {
	
		$archiv = new ZipArchive();
		$archiv->open($saved_zip_file, ZipArchive::CREATE);
		$dirIter = new RecursiveDirectoryIterator($sourcePath);
		$iter = new RecursiveIteratorIterator($dirIter,
			         	RecursiveIteratorIterator::LEAVES_ONLY,
			        	RecursiveIteratorIterator::CATCH_GET_CHILD
			    	);
		
		foreach($iter as $element) {
		    /* @var $element SplFileInfo */
		    $dir = str_replace($sourcePath, '', $element->getPath()) . DIRECTORY_SEPARATOR;
		    if ( strstr($dir, $GSADMIN.DIRECTORY_SEPARATOR ) || strstr($dir, 'backups'.DIRECTORY_SEPARATOR )) {
  				#don't archive these folders
				} else if ($element->getFilename() != '..') { // FIX: if added to ignore parent directories
				  if ($element->isDir()) {
				     $archiv->addEmptyDir($dir);
			    } elseif ($element->isFile()) {
			        $file         = $element->getPath() .
			                        DIRECTORY_SEPARATOR  . $element->getFilename();
			        $fileInArchiv = $dir . $element->getFilename();
			        // add file to archive 
			        $archiv->addFile($file, $fileInArchiv);
			    }
			  }
		}
		
		$archiv->addFile(GSROOTPATH.'.htaccess', '.htaccess' );
		$archiv->addFile(GSROOTPATH.'gsconfig.php', 'gsconfig.php' );
		
		// save and close 
		$status = $archiv->close();
		if (!$status) {
			$zipcreated = false;
		}
		
	} else {
		$zipcreated = false;	
	}
	if (!$zipcreated) {
		$zipcreated = archive_targz();
	}
	if (!$zipcreated) {
		redirect('archive.php?nozip');
	} 
	
	// redirect back to archive page with a success
	redirect('archive.php?done');

} else {
	# page accessed directly - send back to archives page
	redirect('archive.php');
}

exit;
