<?php



/* pre-common setup, load gsconfig and get GSADMIN path */

	/* GSCONFIG definitions */
	if(!defined('GSFRONT')) define('GSFRONT',1);
	if(!defined('GSBACK'))  define('GSBACK',2);
	if(!defined('GSBOTH'))  define('GSBOTH',3);	
	if(!defined('GSSTYLEWIDE')) define('GSSTYLEWIDE','wide'); // wide style sheet
	if(!defined('GSSTYLE_SBFIXED')) define('GSSTYLE_SBFIXED','sbfixed'); // fixed sidebar

	# Check and load gsconfig
	if (file_exists('gsconfig.php')) {
		require_once('gsconfig.php');
	}

	# Apply GSADMIN env
	if (defined('GSADMIN')) {
		$GSADMIN = GSADMIN;
	} else {
		$GSADMIN = 'admin';
	}

	# setup paths 
	# @todo wtf are these for ?
	$admin_relative = $GSADMIN.'/inc/';
	$lang_relative = $GSADMIN.'/';

	$load['plugin'] = true;
	$base = true;

/* end */

# Include common.php
include($GSADMIN.'/inc/common.php');

# Hook to load page Cache
exec_action('index-header');

# get page id (url slug) that is being passed via .htaccess mod_rewrite
if (isset($_GET['id'])){ 
	$id = str_replace ('..','',$_GET['id']);
	$id = str_replace ('/','',$id);
	$id = lowercase($id);
} else {
	$id = "index";
}

// filter to modify page id request
$id = exec_filter('indexid',$id);
 // $_GET['id'] = $id; // support for plugins that are checking get?

# define page, spit out 404 if it doesn't exist
$file_404 = GSDATAOTHERPATH . '404.xml';
$user_created_404 = GSDATAPAGESPATH . '404.xml';
$data_index = null;

// apply page data if page id exists
if (isset($pagesArray[$id])) {
	$data_index = getXml(GSDATAPAGESPATH . $id . '.xml');
} 

// filter to modify data_index obj
$data_index = exec_filter('data_index',$data_index);

// page not found handling
if(!$data_index) {	
	if (isset($pagesArray['404'])) {
		// use user created 404 page
		$data_index = getXml($user_created_404);		
	} elseif (file_exists($file_404))	{
		// default 404
		$data_index = getXml($file_404);
	} else {
		// fail over
		redirect('404');
	} 	
	exec_action('error-404');
}

$title         = $data_index->title;
$date          = $data_index->pubDate;
$metak         = $data_index->meta;
$metad         = $data_index->metad;
$url           = $data_index->url;
$content       = $data_index->content;
$parent        = $data_index->parent;
$template_file = $data_index->template;
$private       = $data_index->private;	

// after fields from dataindex, can modify globals here or do whatever by checking them
exec_action('index-post-dataindex');

# if page is private, check user
if ($private == 'Y') {
	if (isset($USR) && $USR == get_cookie('GS_ADMIN_USERNAME')) {
		//ok, allow the person to see it then
	} else {
		redirect('404');
	}
}

# if page does not exist, throw 404 error
if ($url == '404') {
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
}

# check for correctly formed url
if (getDef('GSCANONICAL',true)) {
	if ($_SERVER['REQUEST_URI'] != find_url($url, $parent, 'relative')) {
		redirect(find_url($url, $parent));
	}
}

# include the functions.php page if it exists within the theme
if ( file_exists(GSTHEMESPATH .$TEMPLATE."/functions.php") ) {
	include(GSTHEMESPATH .$TEMPLATE."/functions.php");	
}

# call pretemplate Hook
exec_action('index-pretemplate');

# include the template and template file set within theme.php and each page
if ( (!file_exists(GSTHEMESPATH .$TEMPLATE."/".$template_file)) || ($template_file == '') ) { $template_file = "template.php"; }
include(GSTHEMESPATH .$TEMPLATE."/".$template_file);

# call posttemplate Hook
exec_action('index-posttemplate');

?>
