<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

/**
 * Get the page title.
 *
 * @since 4.6
 * @package site
 * @return string The page title.
 */
function get_pagetitle() {
	global $lang, $module;

	//Check if we want to get the title for a page, and check whether the page exists.
	if (defined('CURRENT_PAGE_FILENAME')) {
		if (strpos(CURRENT_PAGE_FILENAME, '/') !== false) {
			$parts = explode('/', CURRENT_PAGE_FILENAME);
			$count = count($parts);
			unset($parts[$count -1]);

			$pages = $parts;
			include (PAGE_DIR.'/'.CURRENT_PAGE_FILENAME);
			$titles[] = $title;

			foreach ($parts as $part) {
				$page = implode('/', $pages);
				include (PAGE_DIR.'/'.get_page_filename($page));
				$titles[] = $title;
				$pages = explode('/', $page);
				$count = count($pages);
				unset($pages[$count -1]);
			}
			unset($part);

			//Reverse array for more logical breadcrumb-order.
			$titles = array_reverse($titles);

			$page_title = trim(implode(' &middot; ', $titles));
		}

		else {
			include (PAGE_DIR.'/'.CURRENT_PAGE_FILENAME);
			$page_title = $title;
		}
	}

	//Get the title if we are looking at a module page.
	if (defined('CURRENT_PAGE_FILENAME') && defined('CURRENT_MODULE_DIR') && function_exists(CURRENT_MODULE_DIR.'_pages_site')) {
		$module_page_site = call_user_func(CURRENT_MODULE_DIR.'_pages_site');
		if (!empty($module_page_site)) {
			foreach ($module_page_site as $module_page) {
				if ($module_page['func'] == CURRENT_MODULE_PAGE) {
					$page_title = $page_title.' &middot; '.$module_page['title'];
				}
			}
			unset($module_page);
		}
	}

	//If page doesn't exist, display error.
	elseif (!defined('CURRENT_PAGE_FILENAME'))
		$page_title = $lang['general']['404'];

	return $page_title;
}

/**
 * Display data for in <head>. For use in themes.
 *
 * @since 4.6
 * @package site
 * @param bool $reset_css If set to true, includes reset CSS-file provided by EasyCMS. Defaults to false.
 */
function theme_meta($reset_css = false) {
	//Get page-info (for meta-information)
	if (defined('CURRENT_PAGE_FILENAME')) {
		if (file_exists(PAGE_DIR.'/'.CURRENT_PAGE_FILENAME))
			include (PAGE_DIR.'/'.CURRENT_PAGE_FILENAME);
	}
	$stylefile = 'style';


	//Allow modules to manipulate theme
	$page_theme = THEME;
	run_hook('site_theme', array(&$page_theme));

	//Allow modules to manipulate CSS-filename
	run_hook('site_theme_css', array(&$stylefile));

	//Check which CSS-file we need to use (LTR or RTL)
	if (DIRECTION_RTL)
		$cssfile = SITE_URL.'/data/themes/'.$page_theme.'/'.$stylefile.'-rtl.css';
	else
		$cssfile = SITE_URL.'/data/themes/'.$page_theme.'/'.$stylefile.'.css';

	echo '<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />'."\n";
	echo '<meta name="generator" content="EasyCMS '.VERSION.'" />'."\n";
	echo '<title>'.PAGE_TITLE.' - '.SITE_TITLE.'</title>'."\n";
	if ($reset_css)
		echo '<link href="'.SITE_URL.'/data/reset.css" rel="stylesheet" type="text/css" />'."\n";
	echo '<link href="'.$cssfile.'" rel="stylesheet" type="text/css" />'."\n";

	//If we are not looking at a module: include metatag information
	if (defined('CURRENT_PAGE_FILENAME')) {
		if (isset($keywords) && !empty($keywords))
			echo '<meta name="keywords" content="'.$keywords.'" />'."\n";
		if (isset($description) && !empty($description))
			echo '<meta name="description" content="'.$description.'" />'."\n";
	}

	//If RTL, set direction to RTL in CSS
	if (DIRECTION_RTL)
		echo '<style type="text/css">body {direction:rtl;}</style>'."\n";

	run_hook('theme_meta');
}

/**
 * Display site title. For use in themes.
 *
 * @since 4.6
 * @package site
 */
function theme_sitetitle() {
	echo SITE_TITLE;
}

/**
 * Display a page menu. For use in themes.
 *
 * @since 1.9.8
 * @package site
 * @param string $block The HTML block-level element for the menu. Usually "ul".
 * @param string $inline The HTML inline-level element for the menu. Usually "li".
 * @param string $active_id HTML id given to inline element if the menu-link is the link of the currently viewed page. Defaults to null.
 * @param integer $level Defines which page levels should be displayed. By default shows only top pages ($level = 0). When set to 1, also displays subpages, when set to 2 also displays subsubpages, etc.
 * @param bool $only_subpages If set to true, will display only subpages of the current top page. Defaults to false.
 */
function theme_menu($block, $inline, $active_id = null, $level = 0, $only_subpages = false) {
	if ($only_subpages) {
		$parents = get_page_parents(CURRENT_PAGE_SEONAME);
		if ($parents)
			$parent_page = $parents[0];
		else
			$parent_page = CURRENT_PAGE_SEONAME;
		unset($parents);

		$dir = PAGE_DIR.'/'.$parent_page;
	}

	else
		$dir = PAGE_DIR;

	theme_menu_data($block, $inline, $active_id, $level, $dir);
}

/**
 * Generates page menu. Only for internal use. For themes, use theme_menu().
 *
 * @since 1.9.8
 * @package site
 */
function theme_menu_data($block, $inline, $active_id, $level, $dir) {
	//If specified directory does not exist, just return.
	if (!is_dir($dir))
		return;

	$files = read_dir_contents($dir, 'files');

	if ($files) {
		//Sort the array.
		natcasesort($files);

		echo '<'.$block.'>';

		foreach ($files as $file) {
			include ($dir.'/'.$file);

			$file = get_page_seoname($dir.'/'.$file);
			//Only display in menu if page isn't hidden by user.
			if (isset($hidden) && $hidden == 'no') {

				//Get parents of the currently displayed page
				$parents = get_page_parents(CURRENT_PAGE_SEONAME);
				//Strip parents from $file, but only if it's a sub page
				if (strpos($file, '/') !== false && file_exists(PAGE_DIR.'/'.get_page_filename($file))) {
					$file_levels = preg_split('|\/|', $file);
					$file_stripped = $file_levels[count($file_levels)-1];
				}
				else
					$file_stripped = $file;

				//Show an active inline for current page...
				if ($active_id && CURRENT_PAGE_SEONAME == $file)
					echo '<'.$inline.' class="'.$active_id.'" id="'.$active_id.'">';
				//... and all parents of currently displayed page.
				elseif ($active_id && $parents && array_search($file_stripped, $parents) !== false)
					echo '<'.$inline.' class="'.$active_id.'">';
				//For other pages, show a normal inline.
				else
					echo '<'.$inline.'>';
				//Unset parents array
				unset($parents);

				//Display link
				echo '<a href="'.SITE_URL.'/'.PAGE_URL_PREFIX.$file.'" title="'.$title.'">'.$title.'</a>';

				preg_match_all('|\/|', $file, $page_level);
				$page_level = count($page_level[0]);

				if ($level > $page_level && is_dir(PAGE_DIR.'/'.$file))
					theme_menu_data($block, $inline, $active_id, $level, PAGE_DIR.'/'.$file);

				echo '</'.$inline.'>';
			}
		}
		unset($file);

		echo '</'.$block.'>';
	}
}

/**
 * Display page title. For use in themes.
 *
 * @since 4.6
 * @package site
 */
function theme_pagetitle() {
	echo PAGE_TITLE;
}

/**
 * Displays page content. For use in themes.
 *
 * @since 4.6
 * @package site
 */
function theme_content() {
	//Get needed variables
	global $lang;

	//Show "not found" error message if something was missing
	if (defined('CURRENT_NOTFOUND')) {
		echo $lang['general']['not_found'];
	}

	//Get the contents only if we are looking at a normal page.
	elseif (defined('CURRENT_PAGE_SEONAME') && !defined('CURRENT_MODULE_DIR')) {
		//Check if page exists
		if (defined('CURRENT_PAGE_FILENAME')) {
			include (PAGE_DIR.'/'.CURRENT_PAGE_FILENAME);
			run_hook('theme_content_before');
			run_hook('theme_content', array(&$content));

			//Check for module tags in content
			$regex = '/\{EasyCMS (.*?)\}/';
			if (preg_match($regex, $content)) {
				//Split content in chunks.
				$content = preg_split($regex, $content, null, PREG_SPLIT_DELIM_CAPTURE);
				foreach ($content as $value) {
					//Check if chunk is a show_module command
					if (preg_match('/show_module\((.*?)\)/', $value, $matches)) {
						$module_to_include = $matches[1];
						unset ($matches);

						//Check if we need to pass a variable to the module.
						if (strpos($module_to_include, ',')) {
							$module_to_include = explode(',', $module_to_include);
							if (module_is_compatible($module_to_include[0]) && function_exists($module_to_include[0].'_theme_main'))
								call_user_func_array($module_to_include[0].'_theme_main', array(null, $module_to_include[1]));
							unset($module_to_include);
						}
						//If we don't need to pass a variable, include module in regular way.
						else {
							//Check if module is compatible, and the function exists.
							if (module_is_compatible($module_to_include) && function_exists($module_to_include.'_theme_main'))
								call_user_func_array($module_to_include.'_theme_main', array(null, null));
							unset($module_to_include);
						}
					}
					//If chunk is not any module command, just display it.
					else
						echo $value;
				}
			}
			//No module tags? Display content without any change.
			else
				echo $content;

			run_hook('theme_content_after');
		}

		//If page doesn't exist, show error message.
		else
			echo $lang['general']['not_found'];
	}

	//If we are looking at a module page, call the module function.
	elseif (defined('CURRENT_PAGE_SEONAME') && defined('CURRENT_MODULE_DIR')) {
		$module_page_site = call_user_func(CURRENT_MODULE_DIR.'_pages_site');
		if (!empty($module_page_site)) {
			foreach ($module_page_site as $module_page) {
				if ($module_page['func'] == CURRENT_MODULE_PAGE)
					call_user_func(CURRENT_MODULE_DIR.'_page_site_'.$module_page['func']);
			}
			unset($module_page);
		}
	}

	//If we want to execute module in page which doesn't have the module included, show 404 error.
	else
		echo $lang['general']['not_found'];
}

/**
 * Defines area in which modules can be inserted through the administration center. For use in themes.
 *
 * @since 1.9.8
 * @package site
 * @param string $place Name of the area. For example "footer", or "header".
 */
function theme_area($place) {
	//Include info of theme (to see which modules we should include etc), but only if file exists.
	if (file_exists('data/settings/themes/'.THEME.'/moduleconf.php')) {
		include ('data/settings/themes/'.THEME.'/moduleconf.php');

		//Get the array and sort it.
		foreach ($space as $area => $number) {
			//Sort the array, so that the modules will be displayed in correct order.
			natcasesort($number);
			foreach ($number as $module => $order) {
				//If the area where the module should be displayed is the same as the area we're currently...
				//...processing: include the module.
				if ($area == $place) {
					//Check if module is compatible, and the function exists.
					if (module_is_compatible($module) && function_exists($module.'_theme_main'))
							call_user_func_array($module.'_theme_main', array($place, null));
				}
			}
		}
		unset($area);
	}
}
?>
