<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

//Load all the modules, so we can use hooks.
//This has to be done before including other functions files.
$module_list = array();
$path = opendir('data/modules');
while (false !== ($dir = readdir($path))) {
	if ($dir != '.' && $dir != '..') {
		if (is_dir('data/modules/'.$dir))
			$module_list[] = $dir;
	}
}
closedir($path);

//Sort the modules.
natcasesort($module_list);

//Then include necessary module files for each module.
foreach ($module_list as $module) {
	if (file_exists('data/modules/'.$module.'/'.$module.'.php')) {
		require_once ('data/modules/'.$module.'/'.$module.'.php');

		//If we are on the index.php, include the needed functions.
		if (strpos($_SERVER['SCRIPT_FILENAME'], 'index.php') !== false && file_exists('data/modules/'.$module.'/'.$module.'.site.php'))
			require_once ('data/modules/'.$module.'/'.$module.'.site.php');
	}
}
unset($module);

/**
 * Run a module hook. Parameters are passed by reference.
 *
 * Hooks should be declared with the reference sign for parameters.
 * e.g. function mymodule_the_hook(&$parameter)
 *
 * The hook must be called with the parameters inside $par passed by reference.
 * e.g. run_hook('the_hook', array(&$parameter));
 *
 * @since 1.9.8
 * @package all
 * @param string $name Name of the hook.
 * @param array $par The parameters for the hook.
 */
function run_hook($name, $par = null) {
	global $module_list;
	if (empty($name)) return false;

	$messages = array();
	foreach ($module_list as $module) {
		if (file_exists('data/modules/'.$module.'/'.$module.'.php')) {
			require_once ('data/modules/'.$module.'/'.$module.'.php');
			if (function_exists($module.'_'.$name) && module_is_compatible($module)) {
				if (!isset($par)) {
					$message = call_user_func($module.'_'.$name);
				} else {
					$message = call_user_func_array($module.'_'.$name, $par);
				}
				if (isset($message)) $messages[$module] = $message;
			}
		}
	}

	return $messages;
}

/**
 * Check if module is compatible with the current version of EasyCMS.
 *
 * @since 4.6
 * @package all
 * @param string $module The module you want to check.
 * @return bool
 */
function module_is_compatible($module) {
	//Include module information.
	if (function_exists($module.'_info')) {
		//NOTE: If EasyCMS is an alpha, beta or dev version, it will always be compatible.
		if (preg_match('/(alpha|beta|dev)/', VERSION)) return true;

		$module_info = call_user_func($module.'_info');
		if (isset($module_info['compatibility'])) {
			$version_compat = explode(',', $module_info['compatibility']);

			//Now check if we have a compatible version.
			foreach ($version_compat as $version) {
				if (preg_match('/^'.$version.'/', VERSION)) {
					return true;
				}
			}
		}
	}

	return true;
}

/**
 * Checks if a module is included in a page.
 *
 * @since 1.9.8
 * @package all
 * @param string $module The module you want to check.
 * @param string $page_seoname The seoname of the page you want to check.
 * @return bool
 */
function module_is_included_in_page($module, $page_seoname) {
	$page_filename = get_page_filename($page_seoname);

	if (is_file(PAGE_DIR.'/'.$page_filename)) {
		$content = '';
		include(PAGE_DIR.'/'.$page_filename);
		if (preg_match('/\{EasyCMS show_module\('.$module.'(,[^)]*)?\)\}/', $content)) {
			return true;
		}
	}

	return false;
}

/**
 * Join two arrays at specific position.
 *
 * @since 1.9.8
 * @package all
 * @param array $array Main array.
 * @param array $data An array witch will be inserted into $array.
 * @param number $position Position where we want to insert $data into $array.
 * @return array
 */
function module_insert_at_position($array, $data, $position) {
	array_splice($array, $position - 1, 0, $data);
	return $array;
}

/**
 * Join two arrays before subject.
 *
 * @since 1.9.8
 * @package all
 * @param array $array Main array.
 * @param array $data An array witch will be inserted into $array.
 * @param string $subject Subject before witch $data will be inserted into $array.
 * @return array
 */
function module_insert_before($array, $data, $subject) {
	$search = array_search($subject, $array);

	if ($search !== false)
		return module_insert_at_position($array, $data, $search + 1);
	else
		return $array;
}

/**
 * Join two arrays after subject.
 *
 * @since 1.9.8
 * @package all
 * @param array $array Main array.
 * @param array $data An array witch will be inserted into $array.
 * @param string $subject Subject after witch $data will be inserted into $array.
 * @return array
 */
function module_insert_after($array, $data, $subject) {
	$search = array_search($subject, $array);

	if ($search !== false)
		return module_insert_at_position($array, $data, $search + 2);
	else
		return $array;
}

/**
 * Save module settings in configuration file.
 *
 * @since 1.9.8
 * @package all
 * @param string $module The module for which the settings need to be saved.
 * @param array $settings Settings in array.
 */
function module_save_settings($module, $settings) {
	if (module_is_compatible($module)) {
		foreach ($settings as $setting => $value) {
			$settings[$setting] = sanitize($value);
		}
		save_file('data/settings/'.$module.'.settings.php', $settings);
	}
}

/**
 * Returns the current value of a module setting. If no setting has been saved, the default value will be returned.
 *
 * @since 1.9.8
 * @package all
 * @param string $module The module.
 * @param string $setting The setting from which to obtain the value.
 */
function module_get_setting($module, $setting) {
	if (module_is_compatible($module)) {

		//First retrieve default module settings.
		$default_settings = call_user_func($module.'_settings_default');

		if (isset($default_settings[$setting])) {
			//Load default setting
			$$setting = $default_settings[$setting];
			//Check if a saved setting is available
			if (file_exists('data/settings/'.$module.'.settings.php')) {
				include('data/settings/'.$module.'.settings.php');
			}
			return $$setting;
		} else {
			trigger_error('Module setting '.$setting.' does not exist in module '.$module.'.', E_USER_WARNING);
		}
	}
}
?>
