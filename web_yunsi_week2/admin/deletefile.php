<?php 


// Setup inclusions
$load['plugin'] = true;

// Include common.php
include('inc/common.php');
login_cookie_check();



// check for csrf
if (!defined('GSNOCSRF') || (GSNOCSRF == FALSE) ) {
	$nonce = $_GET['nonce'];
	if(!check_nonce($nonce, "delete", "deletefile.php")) {
		die("CSRF detected!");
	}
}
	
// are we deleting pages?
if (isset($_GET['id'])) { 
	$id = $_GET['id'];
	
	if ($id == 'index') {
		redirect('pages.php?upd=edit-error&type='.urlencode(i18n_r('HOMEPAGE_DELETE_ERROR')));
	} else {	
		updateSlugs($id);
		$status = delete_file($id);
		generate_sitemap();
		exec_action('page-delete');
		redirect("pages.php?upd=edit-".$status."&id=". $id ."&type=delete");
	}
} 

// are we deleting archives?
if (isset($_GET['zip'])) { 
	$zip = $_GET['zip'];
	$status = delete_zip($zip);
	
	redirect("archive.php?upd=del-". $status ."&id=". $zip);
} 

// are we deleting uploads?
if (isset($_GET['file'])) {
	$path = (isset($_GET['path'])) ? $_GET['path'] : "";
	$file = $_GET['file'];
	$status = delete_upload($file, $path);
	
	redirect("upload.php?upd=del-".$status."&id=". $file . "&path=" . $path);
} 


// are we deleting a folder?
if (isset($_GET['folder'])) {
	$path = (isset($_GET['path'])) ? $_GET['path'] : "";
	$folder = $_GET['folder'];
	$target = GSDATAUPLOADPATH . $path . $folder;
	if (path_is_safe($target,GSDATAUPLOADPATH) && file_exists($target)) {
		rmdir($target);
		// delete thumbs folder
		rmdir(GSTHUMBNAILPATH . $path . $folder);
		redirect("upload.php?upd=del-success&id=". $folder . "&path=".$path);
	}
} 
