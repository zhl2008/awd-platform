<?php



/**
 * Headers
 */

// charset utf-8
header('content-type: text/html; charset=utf-8');

// headers for backend
if(!isset($base)){
	// no-cache headers
	$timestamp = gmdate("D, d M Y H:i:s") . " GMT";
	header("Expires: " . $timestamp);
	header("Last-Modified: " . $timestamp);
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
}

define('IN_GS', TRUE); // GS enviroment flag

// GS Debugger
global $GS_debug; // GS debug trace array
if(!isset($GS_debug)) $GS_debug = array();	

/**
 * Debug Console Log
 *
 * @since 3.1
 *
 * @param $txt string
 */
function debugLog($txt = '') {
	global $GS_debug;
	array_push($GS_debug,$txt);
}

/**
 * Set PHP enviroment
 */
if(function_exists('mb_internal_encoding')) mb_internal_encoding("UTF-8"); // set multibyte encoding

/**
 *  GSCONFIG definitions
 */

if(!defined('GSFRONT')) define('GSFRONT',1);
if(!defined('GSBACK'))  define('GSBACK',2);
if(!defined('GSBOTH'))  define('GSBOTH',3);
if(!defined('GSSTYLEWIDE')) define('GSSTYLEWIDE','wide'); // wide style sheet
if(!defined('GSSTYLE_SBFIXED')) define('GSSTYLE_SBFIXED','sbfixed'); // fixed sidebar

/**
 * Bad stuff protection
 */
include_once('security_functions.php');

if (version_compare(PHP_VERSION, "5")  >= 0) {
	foreach ($_GET as &$xss) $xss = antixss($xss);
}

/**
 * Basic file inclusions
 */
include('basic.php');
include('template_functions.php');
include('logging.class.php');

define('GSROOTPATH', get_root_path());

if(!is_frontend()){
	if (file_exists(GSROOTPATH . 'gsconfig.php')) {
		require_once(GSROOTPATH . 'gsconfig.php');
	}

	if (defined('GSADMIN')) {
		$GSADMIN = GSADMIN;
	} else {
		$GSADMIN = 'admin';
	}
}

// definition defaults

if(!defined('GSUPLOADSLC'))	define('GSUPLOADSLC',true);

if(!defined('GSNOFRAME')) define('GSNOFRAME',true);
if(!defined('GSNOFRAMEDEFAULT')) define('GSNOFRAMEDEFAULT','SAMEORIGIN');

// Add X-Frame-Options to HTTP header, so that page can only be shown in an iframe of the same site.
if(getDef('GSNOFRAME') !== false){
	if(getDef('GSNOFRAME') === GSBOTH) header_xframeoptions();
	else if((getDef('GSNOFRAME') === true || getDef('GSNOFRAME') === GSBACK) && !is_frontend()) header_xframeoptions();
	else if(getDef('GSNOFRAME') === GSFRONT && is_frontend()) header_xframeoptions();
}

/**
 * Define some constants
 */
define('GSADMINPATH', get_admin_path());
define('GSADMININCPATH', GSADMINPATH. 'inc/');
define('GSPLUGINPATH', GSROOTPATH. 'plugins/');
define('GSLANGPATH', GSADMINPATH. 'lang/');
define('GSDATAPATH', GSROOTPATH. 'data/');
define('GSDATAOTHERPATH', GSROOTPATH. 'data/other/');
define('GSDATAPAGESPATH', GSROOTPATH. 'data/pages/');
define('GSDATAUPLOADPATH', GSROOTPATH. 'data/uploads/');
define('GSTHUMBNAILPATH', GSROOTPATH. 'data/thumbs/');
define('GSBACKUPSPATH', GSROOTPATH. 'backups/');
define('GSTHEMESPATH', GSROOTPATH. 'theme/');
define('GSUSERSPATH', GSROOTPATH. 'data/users/');
define('GSBACKUSERSPATH', GSROOTPATH. 'backups/users/');
define('GSCACHEPATH', GSROOTPATH. 'data/cache/');
define('GSAUTOSAVEPATH', GSROOTPATH. 'data/pages/autosave/');

$reservedSlugs = array($GSADMIN,'data','theme','plugins','backups');

require_once(GSADMININCPATH.'configuration.php');

/**
 * Debugging
 */
if ( isDebug() ) {
	error_reporting(-1);
	ini_set('display_errors', 1);
} else if( getDef('GSSUPPRESSERRORS',true) ||  getDef('SUPPRESSERRORS',true) ) {
	error_reporting(0);
	ini_set('display_errors', 0);
}
ini_set('log_errors', 1);
ini_set('error_log', GSDATAOTHERPATH .'logs/errorlog.txt');


/**
 * Variable check to prevent debugging going off
 * @todo some of these may not even be needed anymore
 */
$admin_relative = (isset($admin_relative)) ? $admin_relative : '';
$lang_relative = (isset($lang_relative)) ? $lang_relative : '';
$load['login'] = (isset($load['login'])) ? $load['login'] : '';
$load['plugin'] = (isset($load['plugin'])) ? $load['plugin'] : '';



/**
 * Pull data from storage
 */
 
/** grab website data */
$thisfilew = GSDATAOTHERPATH .'website.xml';
if (file_exists($thisfilew)) {
	$dataw = getXML($thisfilew);
	$SITENAME = stripslashes($dataw->SITENAME);
	$SITEURL = $dataw->SITEURL;
	$TEMPLATE = $dataw->TEMPLATE;
	$PRETTYURLS = $dataw->PRETTYURLS;
	$PERMALINK = $dataw->PERMALINK;
} else {
	$SITENAME = '';
	$SITEURL = '';
} 


/** grab user data */
if (isset($_COOKIE['GS_ADMIN_USERNAME'])) {
	$cookie_user_id = _id($_COOKIE['GS_ADMIN_USERNAME']);
	if (file_exists(GSUSERSPATH . $cookie_user_id.'.xml')) {
		$datau = getXML(GSUSERSPATH  . $cookie_user_id.'.xml');
		$USR = stripslashes($datau->USR);
		$HTMLEDITOR = $datau->HTMLEDITOR;
		$TIMEZONE = $datau->TIMEZONE;
		$LANG = $datau->LANG;
	} else {
		$USR = null;
	}
} else {
	$USR = null;
}

/**
 * Language control
 */
if(!isset($LANG) || $LANG == '') {
	$filenames = glob(GSLANGPATH.'*.php');	
	$cntlang = count($filenames);
	if ($cntlang == 1) {
		// assign lang to only existing file
		$LANG = basename($filenames[0], ".php");
	} elseif($cntlang > 1 && in_array(GSLANGPATH .'en_US.php',$filenames)) {
		// fallback to en_US if it exists
		$LANG = 'en_US';
	} elseif(isset($filenames[0])) {
		// fallback to first lang found
		$LANG=basename($filenames[0], ".php");
	}
}

i18n_merge(null); // load $LANG file into $i18n

// Merge in default lang to avoid empty lang tokens
// if GSMERGELANG is undefined or false merge en_US else merge custom
if(getDef('GSMERGELANG', true) !== false and !getDef('GSMERGELANG', true) ){
	if($LANG !='en_US')	i18n_merge(null,"en_US");
} else{
	// merge GSMERGELANG defined lang if not the same as $LANG
	if($LANG !=getDef('GSMERGELANG') ) i18n_merge(null,getDef('GSMERGELANG'));	
}	

/** 
 * Init Editor globals
 * @uses $EDHEIGHT
 * @uses $EDLANG
 * @uses $EDTOOL js array string | php array | 'none' | ck toolbar_ name
 * @uses $EDOPTIONS js obj param strings, comma delimited
 */

if(!defined('GSCKETSTAMP')) define('GSCKETSTAMP',get_gs_version()); // ckeditor asset querystring for cache control
if (defined('GSEDITORHEIGHT')) { $EDHEIGHT = GSEDITORHEIGHT .'px'; } else {	$EDHEIGHT = '500px'; }
if (defined('GSEDITORLANG'))   { $EDLANG = GSEDITORLANG; } else {	$EDLANG = i18n_r('CKEDITOR_LANG'); }
if (defined('GSEDITORTOOL') and !isset($EDTOOL)) { $EDTOOL = GSEDITORTOOL; }
if (defined('GSEDITOROPTIONS') and !isset($EDOPTIONS) && trim(GSEDITOROPTIONS)!="" ) $EDOPTIONS = GSEDITOROPTIONS; 

if(!isset($EDTOOL)) $EDTOOL = 'basic'; // default gs toolbar

if($EDTOOL == "none") $EDTOOL = null; // toolbar to use cke default
$EDTOOL = returnJsArray($EDTOOL);
// if($EDTOOL === null) $EDTOOL = 'null'; // not supported in cke 3.x
// at this point $EDTOOL should always be a valid js nested array ([[ ]]) or escaped toolbar id ('toolbar_id')

/**
 * Timezone setup
 */

// set defined timezone from config if not set on user
if( (!isset($TIMEZONE) || trim($TIMEZONE) == '' ) && defined('GSTIMEZONE') ){
	$TIMEZONE = GSTIMEZONE;
}

if(isset($TIMEZONE) && function_exists('date_default_timezone_set') && ($TIMEZONE != "" || stripos($TIMEZONE, '--')) ) { 
	date_default_timezone_set($TIMEZONE);
}


/**
 * Variable Globalization
 */
global $SITENAME, $SITEURL, $TEMPLATE, $TIMEZONE, $LANG, $SALT, $i18n, $USR, $PERMALINK, $GSADMIN, $components, $EDTOOL, $EDOPTIONS, $EDLANG, $EDHEIGHT;

/** grab authorization and security data */
if (defined('GSUSECUSTOMSALT')) {
	// use GSUSECUSTOMSALT
	$SALT = sha1(GSUSECUSTOMSALT);
} 
else {
	// use from authorization.xml
	if (file_exists(GSDATAOTHERPATH .'authorization.xml')) {
		$dataa = getXML(GSDATAOTHERPATH .'authorization.xml');
		$SALT = stripslashes($dataa->apikey);
	} else {
		if($SITEURL !='' && get_filename_id() != 'install' && get_filename_id() != 'setup' && get_filename_id() != 'update' && get_filename_id() != 'style'){
			die(i18n_r('KILL_CANT_CONTINUE')."<br/>".i18n_r('MISSING_FILE').": "."authorization.xml");
		}
	}
}
$SESSIONHASH = sha1($SALT . $SITENAME);


/**
 * $base is if the site is being viewed from the front-end
 */
if(isset($base)) {
	include_once(GSADMININCPATH.'theme_functions.php');
}

function serviceUnavailable(){
	GLOBAL $base;
	if(isset($base)){
		header('HTTP/1.1 503 Service Temporarily Unavailable');
		header('Status: 503 Service Temporarily Unavailable');
		header('Retry-After: 7200'); // in seconds
		i18n('SERVICE_UNAVAILABLE');
		die();
	}
}

/**
 * Check to make sure site is already installed
 */
if (get_filename_id() != 'install' && get_filename_id() != 'setup' && get_filename_id() != 'update') {
	$fullpath = suggest_site_path();
	
	# if there is no SITEURL set, then it's a fresh install. Start installation process
	# siteurl check is not good for pre 3.0 since it will be empty, so skip and run update first.
	if ($SITEURL == '' &&  get_gs_version() >= 3.0)	{
		serviceUnavailable();
		redirect($fullpath . $GSADMIN.'/install.php');
	} 
	else {	
		# if an update file was included in the install package, redirect there first	
		if (file_exists(GSADMINPATH.'update.php') && !isset($_GET['updated']) && !getDef('GSDEBUGINSTALL'))	{
			serviceUnavailable();
			redirect($fullpath . $GSADMIN.'/update.php');
		}
	}

	if(!getDef('GSDEBUGINSTALL',true)){	
		# if you've made it this far, the site is already installed so remove the installation files
		$filedeletionstatus=true;
		if (file_exists(GSADMINPATH.'install.php'))	{
			$filedeletionstatus = unlink(GSADMINPATH.'install.php');
		}
		if (file_exists(GSADMINPATH.'setup.php'))	{
			$filedeletionstatus = unlink(GSADMINPATH.'setup.php');
		}
		if (file_exists(GSADMINPATH.'update.php'))	{
			$filedeletionstatus = unlink(GSADMINPATH.'update.php');
		}
		if (!$filedeletionstatus) {
			$error = sprintf(i18n_r('ERR_CANNOT_DELETE'), '<code>/'.$GSADMIN.'/install.php</code>, <code>/'.$GSADMIN.'/setup.php</code> or <code>/'.$GSADMIN.'/update.php</code>');
		}
	}	

}

/**
 * Include other files depending if they are needed or not
 */
include_once(GSADMININCPATH.'cookie_functions.php');
if(isset($load['plugin']) && $load['plugin']){
	# remove the pages.php plugin if it exists. 	
	if (file_exists(GSPLUGINPATH.'pages.php'))	{
		unlink(GSPLUGINPATH.'pages.php');
	}
	include_once(GSADMININCPATH.'plugin_functions.php');
	if(get_filename_id()=='settings' || get_filename_id()=='load') {
		/* this core plugin only needs to be visible when you are viewing the 
		settings page since that is where its sidebar item is. */
		if (defined('GSEXTAPI') && GSEXTAPI==1) {
			include_once('api.plugin.php');
		}
	}
	# include core plugin for page caching
	include_once('caching_functions.php');
	
	# main hook for common.php
	exec_action('common');
	
}
if(isset($load['login']) && $load['login']){ 	include_once(GSADMININCPATH.'login_functions.php'); }
?>
