<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

if (isset($_GET['file'])) {
	if (!empty($_GET['file']) && get_page_filename($_GET['file']) != false) {
		/**
		* Defines the filename of the current page. NOTE: is only defined if the requested page exists.
		*/
		define('CURRENT_PAGE_FILENAME', get_page_filename($_GET['file']));
	}
	/**
	* Defines the seoname of the requested page. NOTE: is also defined if the requested page does not exist.
	*/
	define('CURRENT_PAGE_SEONAME', $_GET['file']);
}

//Name of directory of current module.
if (isset($_GET['module']))
	define('CURRENT_MODULE_DIR', $_GET['module']);

//Name of current module page.
if (isset($_GET['page']))
	define('CURRENT_MODULE_PAGE', $_GET['page']);

//Page title.
define('PAGE_TITLE', get_pagetitle());
?>
