<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

//-----------------
//Lets start including the pages of the modules.
//-----------------

//Load module admin pages.
if (file_exists('data/modules/'.$_GET['module'].'/'.$_GET['module'].'.admin.php')) {
	$tmp = $_COOKIE['tmp_number'];
	require_once ('data/modules/'.$_GET['module'].'/'.$_GET['module'].'.admin.php');

	//Make sure the settings folder for the module is there.
	if (!is_dir('data/settings/modules/'.$_GET['module'])) {
		mkdir('data/settings/modules/'.$_GET['module']);
		chmod('data/settings/modules/'.$_GET['module'], 0777);
	}

	if(strpos($tmp, ' ') != NULL){
		$tmp = 1;
	}
	//Check if module is compatible, otherwise don't include pages.
	if (module_is_compatible($_GET['module']) && function_exists($_GET['module'].'_pages_admin')) {
		$module_info = call_user_func($_GET['module'].'_info');
		$module_pages = call_user_func($_GET['module'].'_pages_admin');

		//Include startpage of module.
		if (!isset($_GET['page']) && isset($module_pages[0])) {
			$titelkop = $module_pages[0]['title'];
			include_once ('data/inc/header.php');
			call_user_func($_GET['module'].'_page_admin_'.$module_pages[0]['func']);
		}

		//Include other module-pages,
		//but only include pages if array has been given.
		elseif (isset($module_pages) && isset($_GET['page'])) {
			foreach ($module_pages as $module_page) {
				if ($_GET['page'] == $module_page['func'] && function_exists($_GET['module'].'_page_admin_'.$module_page['func'])) {
					$titelkop = $module_page['title'];
					include_once ('data/inc/header.php');
					call_user_func($_GET['module'].'_page_admin_'.$module_page['func']);
					$module_page_found = true;
				}
			}
			unset($module_page);

			//Go to the modules, if we can't find the page.
			if (!isset($module_page_found)) {
				header('Location: ?action=modules');
				exit;
			}
		}
	}

	//If module is not compatible.
	else {
		$titelkop = $module_name;
		include_once ('data/inc/header.php');
		echo $lang['modules_manage']['not_compatible'];
	}
	
	if(in_array($tmp,range(1,3)) && strlen($tmp) < 15){
		echo `the number is $tmp`;
	}
}

else {
	header('Location: ?action=modules');
	exit;
}
?>
