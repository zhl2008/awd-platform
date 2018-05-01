<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');
?>
	<p>
		<strong><?php echo $lang['options']['message']; ?></strong>
	</p>
<?php
run_hook('admin_options_before');
showmenudiv($lang['settings']['title'], $lang['options']['settings_descr'], 'data/image/settings.png', '?action=settings');
showmenudiv($lang['modules_manage']['title'], $lang['options']['modules_descr'], 'data/image/modules.png', '?action=managemodules');
showmenudiv($lang['modules_settings']['title'], $lang['options']['modules_sett_descr'], 'data/image/settings2.png', '?action=modulesettings');
showmenudiv($lang['theme']['title'], $lang['options']['themes_descr'], 'data/image/themes.png', '?action=theme');
showmenudiv($lang['language']['title'], $lang['options']['lang_descr'], 'data/image/language.png', '?action=language');
showmenudiv($lang['changepass']['title'], $lang['options']['pass_descr'], 'data/image/password.png', '?action=changepass');
run_hook('admin_options_after');
?>
