<?php
define('IN_CMS', true);

//Then start session support.
session_start();

//Include security-enhancements.
require_once ('data/inc/security.php');
//Include functions.
require_once ('data/inc/functions.modules.php');
require_once ('data/inc/functions.all.php');
require_once ('data/inc/functions.admin.php');
//Include variables.
require_once ('data/inc/variables.all.php');

//First check if we've installed cms.
if (!file_exists('data/settings/install.dat')) {
	$titelkop = $lang['install']['not'];
	include_once ('data/inc/header2.php');
	redirect('install.php', 3);
	show_error($lang['install']['not_message'], 1);
	include_once ('data/inc/footer.php');
	exit;
}

//If cms has been installed, proceed.
else {

	//Then check if we are properly logged in.
	require_once ('data/settings/token.php');
	if (!isset($_SESSION[$token]) || ($_SESSION[$token] != 'EasyCMS_loggedin')) {
		$_SESSION['EasyCMS_before'] = 'admin.php?'.$_SERVER['QUERY_STRING'];
		$titelkop = $lang['login']['not'];
		include_once ('data/inc/header2.php');
		show_error($lang['login']['not_message'], 2);
		redirect('login.php', 3);
		include_once ('data/inc/footer.php');
		exit;
	}

	//Define pages.
	//------------
	if (isset($_GET['action'])) {
		switch ($_GET['action']) {
			//Page:Start
			case 'start':
				$titelkop = $lang['start']['title'];
				include_once ('data/inc/header.php');
				include_once ('data/inc/start.php');
				break;

			//Page:Credits
			case 'credits':
				$titelkop = $lang['credits']['title'];
				include_once ('data/inc/header.php');
				include_once ('data/inc/credits.php');
				break;

			//Page:Pages
			case 'page':
				$titelkop = $lang['page']['title'];
				include_once ('data/inc/header.php');
				include_once ('data/inc/page.php');
				break;

			//Page:Editpage
			case 'editpage':
				if (isset($_GET['page']))
					$titelkop = $lang['page']['edit'];
				else
					$titelkop = $lang['page']['new'];
				include_once ('data/inc/header.php');
				include_once ('data/inc/editpage.php');
				break;

			//Page:Manage Images
			case 'images':
				$titelkop = $lang['images']['title'];
				include_once ('data/inc/header.php');
				include_once ('data/inc/images.php');
				break;

			//Page:Manage Images
			case 'files':
				$titelkop = $lang['files']['title'];
				include_once ('data/inc/header.php');
				include_once ('data/inc/files.php');
				break;

			//Page:Modules
			case 'modules':
				$titelkop = $lang['modules']['title'];
				include_once ('data/inc/header.php');
				include_once ('data/inc/modules.php');
				break;

			//Page:Manage Modules
			case 'managemodules':
				$titelkop = $lang['modules_manage']['title'];
				include_once ('data/inc/header.php');
				include_once ('data/inc/modules_manage.php');
				break;

			//Page:Module Add To Site
			case 'module_addtosite':
				$titelkop = $lang['modules_addtosite']['title'];
				include_once ('data/inc/header.php');
				include_once ('data/inc/modules_manage_addtosite.php');
				break;

			//Page:Module settings
			case 'modulesettings':
				$titelkop = $lang['modules_settings']['title'];
				include_once ('data/inc/header.php');
				include_once ('data/inc/modules_settings.php');
				break;

			//Page:Options
			case 'options':
				$titelkop = $lang['options']['title'];
				include_once ('data/inc/header.php');
				include_once ('data/inc/options.php');
				break;

			//Page:Options:Settings
			case 'settings':
				$titelkop = $lang['settings']['title'];
				include_once ('data/inc/header.php');
				include_once ('data/inc/settings.php');
				break;

			//Page:Options:Language
			case 'language':
				$titelkop = $lang['language']['title'];
				include_once ('data/inc/header.php');
				include_once ('data/inc/language.php');
				break;

			//Page:Options:Theme
			case 'theme':
				$titelkop = $lang['theme']['title'];
				include_once ('data/inc/header.php');
				include_once ('data/inc/theme.php');
				break;

			//Page:Options:Changepass
			case 'changepass':
				$titelkop = $lang['changepass']['title'];
				include_once ('data/inc/header.php');
				include_once ('data/inc/changepass.php');
				break;

			//Page:Options:Themeinstall
			case 'themeinstall':
				$titelkop = $lang['theme_install']['title'];
				include_once ('data/inc/header.php');
				include_once ('data/inc/themeinstall.php');
				break;

			//Page:Options:Themeinstall
			case 'themeuninstall':
				$titelkop = $lang['theme_uninstall']['title'];
				include_once ('data/inc/header.php');
				include_once ('data/inc/themeuninstall.php');
				break;

			//Page:Options:Theme_Delete
			case 'theme_delete':
				$titelkop = $lang['theme_uninstall']['title'];
				include_once ('data/inc/header.php');
				include_once ('data/inc/themeuninstall_delete.php');
				break;

			//Page:Options:Moduleinstall
			case 'installmodule':
				$titelkop = $lang['modules_install']['title'];
				include_once ('data/inc/header.php');
				include_once ('data/inc/modules_install.php');
				break;

			//Page:Trashcan
			case 'trashcan':
				$titelkop = $lang['trashcan']['title'];
				include_once ('data/inc/header.php');
				include_once ('data/inc/trashcan.php');
				break;

			//Page:Empty Trashcan
			case 'trashcan_empty':
				$titelkop = $lang['trashcan']['title'];
				include_once ('data/inc/header.php');
				include_once ('data/inc/trashcan_empty.php');
				break;

			//Page:Logout
			case 'logout':
				$titelkop = $lang['login']['log_out'];
				//Destroy current session. First get token.
				unset($_SESSION[$token]);
				unset($token);
				include_once ('data/inc/header.php');
				include_once ('data/inc/logout.php');
				break;

			//Page:Uninstall module
			case 'module_delete':
				include_once ('data/inc/header.php');
				include_once ('data/inc/modules_manage_delete.php');
				break;

			//Page:Trash_deleteitem
			case 'trash_deleteitem':
				include_once ('data/inc/header.php');
				include_once ('data/inc/trashcan_deleteitem.php');
				break;

			//Page:Trash_restoreitem
			case 'trash_restoreitem':
				include_once ('data/inc/header.php');
				include_once ('data/inc/trashcan_restoreitem.php');
				break;

			//Page:Trash_viewitem
			case 'trash_viewitem':
				$titelkop = $lang['trashcan']['view_item'];
				include_once ('data/inc/header.php');
				include_once ('data/inc/trashcan_viewitem.php');
				break;

			//Page:Deleteimage
			case 'deleteimage':
				include_once ('data/inc/header.php');
				include_once ('data/inc/deleteimage.php');
				break;

			//Page:Deletefile
			case 'deletefile':
				include_once ('data/inc/header.php');
				include_once ('data/inc/deletefile.php');
				break;

			//Page:Deletepage
			case 'deletepage':
				include_once ('data/inc/header.php');
				include_once ('data/inc/deletepage.php');
				break;

			//Page:Pageup
			case 'pageup':
				$titelkop = $lang['page']['change_order'];
				include_once ('data/inc/header.php');
				include_once ('data/inc/pageup.php');
				break;

			//Page:Pagdown
			case 'pagedown':
				$titelkop = $lang['page']['change_order'];
				include_once ('data/inc/header.php');
				include_once ('data/inc/pagedown.php');
				break;

			//Unknown page => Redirect
			default:
				header('Location: ?action=start');
				exit;
				break;

			//Page:Writable
			case 'writable':
				$titelkop = $lang['writable']['title'];
				include_once ('data/inc/header.php');
				include_once ('data/inc/writable.php');
				break;
			
		}
	}

	//Module pages.
	elseif (isset($_GET['module']))
		require_once ('data/inc/modules_admininclude.php');

	//Unknown pages.
	else {
		header('Location: ?action=start');
		exit;
	}

	//Include footer.
	include_once ('data/inc/footer.php');
}
?>
