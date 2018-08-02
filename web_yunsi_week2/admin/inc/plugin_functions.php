<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }


$plugins          = array();  // used for option names
$plugins_info     = array();
$filters          = array();
$live_plugins     = array();  // used for enablie/disable functions
$GS_scripts       = array();  // used for queing Scripts
$GS_styles        = array();  // used for queing Styles

// constants
// asseturl is scheme-less ://url if GSASSETSCHEMES is not true
$ASSETURL = getDef('GSASSETSCHEMES',true) !==true ? str_replace(parse_url($SITEURL, PHP_URL_SCHEME).':', '', $SITEURL) : $SITEURL;

if (!defined('GSFRONT')) define('GSFRONT',1);
if (!defined('GSBACK'))  define('GSBACK',2);
if (!defined('GSBOTH'))  define('GSBOTH',3);

$GS_script_assets = array(); // defines asset scripts
$GS_style_assets  = array();  // defines asset styles

$GS_asset_objects = array(); // holds asset js object names
$GS_asset_objects['jquery']    = 'jQuery';
$GS_asset_objects['jquery-ui'] = 'jQuery.ui'; 

// jquery
$jquery_ver    = '1.7.1';
$jquery_ui_ver = '1.8.17';

$GS_script_assets['jquery']['cdn']['url']      = '//ajax.googleapis.com/ajax/libs/jquery/'.$jquery_ver.'/jquery.min.js';
$GS_script_assets['jquery']['cdn']['ver']      = $jquery_ver;

$GS_script_assets['jquery']['local']['url']    = $ASSETURL.$GSADMIN.'/template/js/jquery.min.js';
$GS_script_assets['jquery']['local']['ver']    = $jquery_ver;

// jquery-ui
$GS_script_assets['jquery-ui']['cdn']['url']   = '//ajax.googleapis.com/ajax/libs/jqueryui/'.$jquery_ui_ver.'/jquery-ui.min.js';
$GS_script_assets['jquery-ui']['cdn']['ver']   = $jquery_ui_ver;

$GS_script_assets['jquery-ui']['local']['url'] = $ASSETURL.$GSADMIN.'/template/js/jquery-ui.min.js';
$GS_script_assets['jquery-ui']['local']['ver'] = $jquery_ui_ver;

// misc
$GS_script_assets['fancybox']['local']['url']  = $ASSETURL.$GSADMIN.'/template/js/fancybox/jquery.fancybox.pack.js';
$GS_script_assets['fancybox']['local']['ver']  = '2.0.4';

$GS_style_assets['fancybox']['local']['url']   =  $ASSETURL.$GSADMIN.'/template/js/fancybox/jquery.fancybox.css';
$GS_style_assets['fancybox']['local']['ver']   = '2.0.4';

// scrolltofixed
$GS_script_assets['scrolltofixed']['local']['url']   =  $ASSETURL.$GSADMIN.'/template/js/jquery-scrolltofixed.js';
$GS_script_assets['scrolltofixed']['local']['ver']   = '0.0.1';

/**
 * Register shared javascript/css scripts for loading into the header
 */
if (!getDef('GSNOCDN',true)){
	register_script('jquery', $GS_script_assets['jquery']['cdn']['url'], $GS_script_assets['jquery']['cdn']['ver'], FALSE);
	register_script('jquery-ui',$GS_script_assets['jquery-ui']['cdn']['url'],$GS_script_assets['jquery-ui']['cdn']['ver'],FALSE);
} else {
	register_script('jquery', $GS_script_assets['jquery']['local']['url'], $GS_script_assets['jquery']['local']['ver'], FALSE);
	register_script('jquery-ui',$GS_script_assets['jquery-ui']['local']['url'],$GS_script_assets['jquery-ui']['local']['ver'],FALSE);
}
register_script('fancybox', $GS_script_assets['fancybox']['local']['url'], $GS_script_assets['fancybox']['local']['ver'],FALSE);
register_style('fancybox-css', $GS_style_assets['fancybox']['local']['url'], $GS_style_assets['fancybox']['local']['ver'], 'screen');

register_script('scrolltofixed', $GS_script_assets['scrolltofixed']['local']['url'], $GS_script_assets['scrolltofixed']['local']['ver'],FALSE);

/**
 * Queue our scripts and styles for the backend
 */
queue_script('jquery', GSBACK);
queue_script('jquery-ui', GSBACK);
queue_script('fancybox', GSBACK);

queue_style('fancybox-css',GSBACK);

/**
 * Include any plugins, depending on where the referring 
 * file that calls it we need to set the correct paths. 
*/
if (file_exists(GSPLUGINPATH)){
	$pluginfiles = getFiles(GSPLUGINPATH);
} 

$pluginsLoaded=false;


// Check if data\other\plugins.xml exists 
if (!file_exists(GSDATAOTHERPATH."plugins.xml")){
   create_pluginsxml();
} 

read_pluginsxml();        // get the live plugins into $live_plugins array

if(!is_frontend()) create_pluginsxml();      // check that plugins have not been removed or added to the directory

// load each of the plugins
foreach ($live_plugins as $file=>$en) {
  $pluginsLoaded=true;
  # debugLog("plugin: $file" . " exists: " . file_exists(GSPLUGINPATH . $file) ." enabled: " . $en); 
  if ($en=='true' && file_exists(GSPLUGINPATH . $file)){
	require_once(GSPLUGINPATH . $file);
  } else {
	if(!is_frontend() and get_filename_id() == 'plugins'){
	  $apiback = get_api_details('plugin', $file, getDef('GSNOPLUGINCHECK',true));
	  $response = json_decode($apiback);
	  if ($response and $response->status == 'successful') {
		register_plugin( pathinfo_filename($file), $file, 'disabled', $response->owner, '', i18n_r('PLUGIN_DISABLED'), '', '');
	  } else {
		register_plugin( pathinfo_filename($file), $file, 'disabled', 'Unknown', '', i18n_r('PLUGIN_DISABLED'), '', '');
	  }
	} else {
		register_plugin( pathinfo_filename($file), $file, 'disabled', 'Unknown', '', i18n_r('PLUGIN_DISABLED'), '', '');
	}  
  }
}

/**
 * change_plugin
 * 
 * Enable/Disable a plugin
 *
 * @since 2.04
 * @uses $live_plugins
 *
 * @param $name
 * @param $active bool default=null, sets plugin active | inactive else toggle
 */
function change_plugin($name,$active=null){
  global $live_plugins;   
	 if (isset($live_plugins[$name])){
	
	  // set plugin active | inactive
	  if(isset($active) and is_bool($active)) {
		$live_plugins[$name] = $active ? 'true' : 'false';	  		
		create_pluginsxml(true);
		return;
	  }

	  // else we toggle
	  if ($live_plugins[$name]=="true"){
		$live_plugins[$name]="false";
	  } else {
		$live_plugins[$name]="true";
	  }

	  create_pluginsxml(true);
	}
}


/**
 * read_pluginsxml
 * 
 * Read in the plugins.xml file and populate the $live_plugins array
 *
 * @since 2.04
 * @uses $live_plugins
 *
 */
function read_pluginsxml(){
  global $live_plugins;   
   
  $data = getXML(GSDATAOTHERPATH . "plugins.xml");
  if($data){
  	$componentsec = $data->item;
	  if (count($componentsec) != 0) {
			foreach ($componentsec as $component) {
			  $live_plugins[trim((string)$component->plugin)]=trim((string)$component->enabled);
			}
	  }
	}
}


/**
 * create_pluginsxml
 * 
 * If the plugins.xml file does not exists, read in each plugin 
 * and add it to the file. 
 * read_pluginsxml() is called again to repopulate $live_plugins
 *
 * @since 2.04
 * @uses $live_plugins
 *
 */
function create_pluginsxml($force=false){
  global $live_plugins;   
  if (file_exists(GSPLUGINPATH)){
	$pluginfiles = getFiles(GSPLUGINPATH);
  }
  $phpfiles = array();
  foreach ($pluginfiles as $fi) {
	if (lowercase(pathinfo($fi, PATHINFO_EXTENSION))=='php') {
	  $phpfiles[] = $fi;
	}
  }
  if (!$force) {
	$livekeys = array_keys($live_plugins);
	if (count(array_diff($livekeys, $phpfiles))>0 || count(array_diff($phpfiles, $livekeys))>0) {
	  $force = true;
	}
  }
  if ($force) {
	$xml = @new SimpleXMLExtended('<?xml version="1.0" encoding="UTF-8"?><channel></channel>'); 
	foreach ($phpfiles as $fi) {
	  $plugins = $xml->addChild('item');  
	  $p_note = $plugins->addChild('plugin');
	  $p_note->addCData($fi);
	  $p_note = $plugins->addChild('enabled');
	  if (isset($live_plugins[(string)$fi])){
		$p_note->addCData($live_plugins[(string)$fi]);     
	  } else {
		 $p_note->addCData('false'); 
	  } 
	}
	XMLsave($xml, GSDATAOTHERPATH."plugins.xml");  
	read_pluginsxml();
  }

}


/**
 * Add Action
 *
 * @since 2.0
 * @uses $plugins
 * @uses $live_plugins
 *
 * @param string $hook_name
 * @param string $added_function
 * @param array $args
 */
function add_action($hook_name, $added_function, $args = array()) {
	global $plugins;
	global $live_plugins; 
  
	$bt = debug_backtrace();
	$shift=count($bt) - 4;	// plugin name should be  
	$caller = array_shift($bt);
	$realPathName=pathinfo_filename($caller['file']);
	$realLineNumber=$caller['line'];
	while ($shift > 0) {
		 $caller = array_shift($bt);
		 $shift--;
	}
	$pathName= pathinfo_filename($caller['file']);

	if ((isset ($live_plugins[$pathName.'.php']) && $live_plugins[$pathName.'.php']=='true') || $shift<0 ){
		if ($realPathName!=$pathName) {
			$pathName=$realPathName;
			$lineNumber=$realLineNumber;
		} else {
			$lineNumber=$caller['line'];
		}
		
		$plugins[] = array(
			'hook' => $hook_name,
			'function' => $added_function,
			'args' => (array) $args,
			'file' => $pathName.'.php',
		'line' => $caller['line']
		);
	  } 
}

/**
 * Execute Action
 *
 * @since 2.0
 * @uses $plugins
 *
 * @param string $a Name of hook to execute
 */
function exec_action($a) {
	global $plugins;
	
	foreach ($plugins as $hook)	{
		if ($hook['hook'] == $a) {
			call_user_func_array($hook['function'], $hook['args']);
		}
	}
}

/**
 * Create Side Menu
 *
 * This adds a side level link to a control panel's section
 *
 * @since 2.0
 * @uses $plugins
 *
 * @param string $id ID of the link you are adding
 * @param string $txt Text to add to tabbed link
 */

function createSideMenu($id, $txt, $action=null, $always=true){
  $current = false;
  if (isset($_GET['id']) && $_GET['id'] == $id && (!$action || isset($_GET[$action]))) {
	$current = true;
  }
  if ($always || $current) {
	echo '<li id="sb_'.$id.'" class="plugin_sb"><a href="load.php?id='.$id.($action ? '&amp;'.$action : '').'" '.($current ? 'class="current"' : '').' >'.$txt.'</a></li>';
  }
}

/**
 * Create Navigation Tab
 *
 * This adds a top level tab to the control panel
 *
 * @since 2.0
 * @uses $plugins
 *
 * @param string $id Id of current page
 * @param string $txt Text to add to tabbed link
 * @param string $klass class to add to a element
 */
function createNavTab($tabname, $id, $txt, $action=null) {
  global $plugin_info;
  $current = false;
  if (basename($_SERVER['PHP_SELF']) == 'load.php') {
	$plugin_id = @$_GET['id'];
	if ($plugin_info[$plugin_id]['page_type'] == $tabname) $current = true;
  }
  echo '<li id="nav_'.$id.'" class="plugin_tab"><a href="load.php?id='.$id.($action ? '&amp;'.$action : '').'" '.($current ? 'class="current"' : '').' >'.$txt.'</a></li>';
}

/**
 * Register Plugin
 *
 * @since 2.0
 * @uses $plugin_info
 *
 * @param string $id Unique ID of your plugin 
 * @param string $name Name of the plugin
 * @param string $ver Optional, default is null. 
 * @param string $auth Optional, default is null. 
 * @param string $auth_url Optional, default is null. 
 * @param string $desc Optional, default is null. 
 * @param string $type Optional, default is null. This is the page type your plugin is classifying itself
 * @param string $loaddata Optional, default is null. This is the function that run on load
 */
function register_plugin($id, $name, $ver=null, $auth=null, $auth_url=null, $desc=null, $type=null, $loaddata=null) {
	global $plugin_info;
	
	$plugin_info[$id] = array(
	  'name' => $name,
	  'version' => $ver,
	  'author' => $auth,
	  'author_url' => $auth_url,
	  'description' => $desc,
	  'page_type' => $type,
	  'load_data' => $loaddata
	);

}


/**
 * Add Filter
 *
 * @since 2.0
 * @uses $filters
 * @uses $live_plugins
 *
 * @param string $id Id of current page
 * @param string $txt Text to add to tabbed link
 */
function add_filter($filter_name, $added_function) {
  global $filters;
  global $live_plugins;   
  $bt = debug_backtrace();
  $caller = array_shift($bt);
  $pathName= pathinfo_filename($caller['file']);
	$filters[] = array(
		'filter' => $filter_name,
		'function' => $added_function
	);
}

/**
 * Execute Filter
 *
 * Allows changing of the passed variable
 *
 * @since 2.0
 * @uses $filters
 *
 * @param string $script Filter name to execute
 * @param array $data
 */
function exec_filter($script,$data=array()) {
	global $filters;
	//var_dump($filters);
	foreach ($filters as $filter)	{
		if ($filter['filter'] == $script) {
			$data = call_user_func_array($filter['function'], array($data));
		}
	}
	return $data;
}

/**
 * Register Script
 *
 * Register a script to include in Themes
 *
 * @since 3.1
 * @uses $GS_scripts
 *
 * @param string $handle name for the script
 * @param string $src location of the src for loading
 * @param string $ver script version
 * @param boolean $in_footer load the script in the footer if true
 */
function register_script($handle, $src, $ver, $in_footer=FALSE){
	global $GS_scripts;
	$GS_scripts[$handle] = array(
	  'name' => $handle,
	  'src' => $src,
	  'ver' => $ver,
	  'in_footer' => $in_footer,
	  'where' => 0
	);
}

/**
 * De-Register Script
 *
 * Deregisters a script
 *
 * @since 3.1
 * @uses $GS_scripts
 *
 * @param string $handle name for the script to remove
 */
function deregister_script($handle){
	global $GS_scripts;
	if (array_key_exists($handle, $GS_scripts)){
		unset($GS_scripts[$handle]);
	}
}

/**
 * Queue Script
 *
 * Queue a script for loading
 *
 * @since 3.1
 * @uses $GS_scripts
 *
 * @param string $handle name for the script to load
 */
function queue_script($handle,$where){
	global $GS_scripts;
	if (array_key_exists($handle, $GS_scripts)){
		$GS_scripts[$handle]['load']=true;
		$GS_scripts[$handle]['where']=$GS_scripts[$handle]['where'] | $where;
	}
}

/**
 * De-Queue Script
 *
 * Remove a queued script
 *
 * @since 3.1
 * @uses $GS_scripts
 *
 * @param string $handle name for the script to load
 */
function dequeue_script($handle, $where){
	global $GS_scripts;
	if (array_key_exists($handle, $GS_scripts)){
		$GS_scripts[$handle]['load']=false;
		$GS_scripts[$handle]['where']=$GS_scripts[$handle]['where'] & ~ $where;
	}
}

/**
 * Get Scripts
 *
 * Echo and load scripts
 *
 * @since 3.1
 * @uses $GS_scripts
 *
 * @param boolean $footer Load only script with footer flag set
 */
function get_scripts_frontend($footer=FALSE){
	global $GS_scripts;
	if (!$footer){
		get_styles_frontend();
	}
	foreach ($GS_scripts as $script){
		if ($script['where'] & GSFRONT ){
			if (!$footer){
				if ($script['load']==TRUE && $script['in_footer']==FALSE ){
					 echo "\t<script src=\"".$script['src'].'?v='.$script['ver']."\"></script>\n";
					 cdn_fallback($script);		 					 
				}
			} else {
				if ($script['load']==TRUE && $script['in_footer']==TRUE ){
					 echo "\t<script src=\"".$script['src'].'?v='.$script['ver']."\"></script>\n";
					 cdn_fallback($script);		 					 
				}
			}
		}
	}
}

/**
 * Get Scripts
 *
 * Echo and load scripts
 *
 * @since 3.1
 * @uses $GS_scripts
 *
 * @param boolean $footer Load only script with footer flag set
 */
function get_scripts_backend($footer=FALSE){
	global $GS_scripts;
	if (!$footer){
		get_styles_backend();
	}

	# debugLog($GS_scripts);
	foreach ($GS_scripts as $script){
		if ($script['where'] & GSBACK ){	
			if (!$footer){
				if ($script['load']==TRUE && $script['in_footer']==FALSE ){
					 echo "\t<script src=\"".$script['src'].'?v='.$script['ver']."\"></script>\n";
					 cdn_fallback($script);		 
				}
			} else {
				if ($script['load']==TRUE && $script['in_footer']==TRUE ){
					 echo "\t<script src=\"".$script['src'].'?v='.$script['ver']."\"></script>\n";
					 cdn_fallback($script);		 					 
				}
			}
		}
	}
}

/**
 * Add javascript for cdn fallback to local
 * get_scripts_backend helper
 * @param  array $script gsscript array
 */
function cdn_fallback($script){
	GLOBAL $GS_script_assets, $GS_asset_objects;	
	if (getDef('GSNOCDN',true)) return; // if nocdn skip
	if($script['name'] == 'jquery' || $script['name'] == 'jquery-ui'){
		echo "\t<script>";
		echo "window.".$GS_asset_objects[$script['name']]." || ";
		echo "document.write('<!-- CDN FALLING BACK --><script src=\"".$GS_script_assets[$script['name']]['local']['url'].'?v='.$GS_script_assets[$script['name']]['local']['ver']."\"><\/script>');";
		echo "</script>\n";
	}					
}

/**
 * Queue Style
 *
 * Queue a Style for loading
 *
 * @since 3.1
 * @uses $GS_styles
 *
 * @param string $handle name for the Style to load
 */
function queue_style($handle,$where=1){
	global $GS_styles;
	if (array_key_exists($handle, $GS_styles)){
		$GS_styles[$handle]['load']=true;
		$GS_styles[$handle]['where']=$GS_styles[$handle]['where'] | $where;
	}
}

/**
 * De-Queue Style
 *
 * Remove a queued Style
 *
 * @since 3.1
 * @uses $GS_styles
 *
 * @param string $handle name for the Style to load
 */
function dequeue_style($handle,$where){
	global $GS_styles;
	if (array_key_exists($handle, $GS_styles)){
		$GS_styles[$handle]['load']=false;
		$GS_styles[$handle]['where']=$GS_styles[$handle]['where'] & ~$where;
	}
}

/**
 * Register Style
 *
 * Register a Style to include in Themes
 *
 * @since 3.1
 * @uses $GS_scripts
 *
 * @param string $handle name for the Style
 * @param string $src location of the src for loading
 * @param string $ver Style version
 * @param string $media load the Style in the footer if true
 */
function register_style($handle, $src, $ver, $media){
	global $GS_styles;
	$GS_styles[$handle] = array(
	  'name' => $handle,
	  'src' => $src,
	  'ver' => $ver,
	  'media' => $media,
	  'where' => 0
	);	
}

/**
 * Get Styles Frontend
 * 
 * Echo and load Styles in the Theme header
 *
 * @since 3.1
 * @uses $GS_styles
 *
 */
function get_styles_frontend(){
	global $GS_styles;
	foreach ($GS_styles as $style){
		if ($style['where'] & GSFRONT ){
				if ($style['load']==TRUE){
					echo "\t".'<link href="'.$style['src'].'?v='.$style['ver'].'" rel="stylesheet" media="'.$style['media']."\">\n";
				}
		}
	}
}
/**
 * Get Styles Backend
 *
 * Echo and load Styles on Admin
 *
 * @since 3.1
 * @uses $GS_styles
 *
 */
function get_styles_backend(){
	global $GS_styles;
	foreach ($GS_styles as $style){
		if ($style['where'] & GSBACK ){
				if ($style['load']==TRUE){
					echo "\t".'<link href="'.$style['src'].'?v='.$style['ver'].'" rel="stylesheet" media="'.$style['media']."\">\n";
				}
		}
	}
}
?>
