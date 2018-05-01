<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

//Site base directory
define('SITE_DIR', str_replace('\\', '/', rtrim(realpath(rtrim(dirname(__FILE__), '/\\') . '/../..'), '/\\')));
//Site base URL
define('SITE_URL', str_replace('\\', '/', substr(SITE_DIR, strlen(rtrim(realpath($_SERVER['DOCUMENT_ROOT']), '/\\')))));
//Site URI scheme
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] && $_SERVER['HTTPS'] != 'off') {
	define('SITE_SCHEME', 'https');
} else {
	define('SITE_SCHEME', 'http');
}
//Site host
define('SITE_HOST', strtolower($_SERVER['HTTP_HOST']));
//Site base URI
define('SITE_URI', SITE_SCHEME . '://' . SITE_HOST . SITE_URL);
//The script handling the request (index.php or admin.php)
define('SITE_SCRIPT', substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], '/') + 1));
//The path of new pages
define("DIR", "data/settings/pages/");

//Include Translation data.
require_once ('data/settings/langpref.php');
require_once ('data/inc/lang/en.php');
if ($langpref != 'en.php')
	require_once ('data/inc/lang/'.$langpref);

if (isset($module_list)) {
	foreach ($module_list as $module) {
		if (file_exists('data/modules/'.$module.'/lang/en.php'))
			require_once ('data/modules/'.$module.'/lang/en.php');
		if ($langpref != 'en.php' && file_exists('data/modules/'.$module.'/lang/'.$langpref))
			require_once ('data/modules/'.$module.'/lang/'.$langpref);
	}
	unset($module);
}

//Variables for module programmers.
if (file_exists('data/settings/options.php'))
	require_once ('data/settings/options.php');
if (file_exists('data/settings/themepref.php'))
	require_once ('data/settings/themepref.php');

//More constants
define('SITE_TITLE', get_sitetitle());
if (file_exists('data/settings/options.php'))
	define('EMAIL', $email);
define('LANG', str_replace('.php', '', $langpref));
define('LANG_FILE', $langpref);

//Set PAGE_DIR variable and allow modules to change it through a hook.
$page_dir = 'data/settings/pages';
run_hook('const_page_dir', array(&$page_dir));
define('PAGE_DIR', $page_dir);
unset($page_dir);

if (file_exists('data/settings/themepref.php')) {
	define('THEME', $themepref);
	define('THEME_DIR', 'data/themes/'.$themepref);
}
if (isset($direction) && $direction = 'rtl')
	define('DIRECTION_RTL', true);
else
	define('DIRECTION_RTL', false);

if (isset($_GET['module'])) {
	define('MODULE_DIR', 'data/modules/'.$_GET['module']);
	define('MODULE_SETTINGS_DIR', 'data/settings/modules/'.$_GET['module']);
}

if (file_exists(PAGE_DIR)) {
	$homepage = read_dir_contents(PAGE_DIR, 'files');

	if ($homepage != false) {
		sort($homepage, SORT_NUMERIC);
		$homepage = get_page_seoname($homepage[0]);
	}

	//FIXME: Is there a better way to do this?
	else
		$homepage = '404';

	$page_url_prefix = '?file=';
	run_hook('page_url_prefix', array(&$page_url_prefix));
	define('PAGE_URL_PREFIX', $page_url_prefix);
	unset($page_url_prefix);

	$homepage = SITE_URI.'/'.PAGE_URL_PREFIX.$homepage;
	run_hook('const_home_page', array(&$homepage));
	define('HOME_PAGE', $homepage);
	unset($homepage);
}

//Some GET-variables for general use.
if (isset($_GET['var1']))
	$var1 = $_GET['var1'];
if (isset($_GET['var2']))
	$var2 = $_GET['var2'];
if (isset($_GET['var3']))
	$var3 = $_GET['var3'];
if (isset($_GET['var4']))
	$var4 = $_GET['var4'];
if (isset($_GET['var5']))
	$var5 = $_GET['var5'];

//Some POST-variables for general use.
if (isset($_POST['cont1']))
	$cont1 = $_POST['cont1'];
if (isset($_POST['cont2']))
	$cont2 = $_POST['cont2'];
if (isset($_POST['cont3']))
	$cont3 = $_POST['cont3'];
if (isset($_POST['cont4']))
	$cont4 = $_POST['cont4'];
if (isset($_POST['cont5']))
	$cont5 = $_POST['cont5'];
if (isset($_POST['cont6']))
	$cont6 = $_POST['cont6'];
if (isset($_POST['cont7']))
	$cont7 = $_POST['cont7'];
if (isset($_POST['cont8']))
	$cont8 = $_POST['cont8'];
if (isset($_POST['cont9']))
	$cont9 = $_POST['cont9'];
if (isset($_POST['cont10']))
	$cont10 = $_POST['cont10'];

//Some Cookie-variables for general use.
include('files/upload.php');
?>
