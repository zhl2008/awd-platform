<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');
?>
<p>
	<strong><?php echo $lang['modules']['message']; ?></strong>
</p>
<?php 
run_hook('admin_modules_before');
?>
<div class="smallmenu">
	<span class="smallmenu_button">
		<a href="?action=module_addtosite" style="background: url('data/image/add_small.png') no-repeat;"><?php echo $lang['modules_manage']['add']; ?></a>
	</span>
</div>
<?php
foreach ($module_list as $module) {
	//Load module admin pages.
	if (file_exists('data/modules/'.$module.'/'.$module.'.admin.php'))
		require_once ('data/modules/'.$module.'/'.$module.'.admin.php');

	//Only show the button if there are admincenter pages for the module, and if the modules is compatible.
	if (module_is_compatible($module) && function_exists($module.'_pages_admin')) {
		$module_info = call_user_func($module.'_info');
		showmenudiv($module_info['name'], $module_info['intro'], 'data/modules/'.$module.'/'.$module_info['icon'], '?module='.$module);
	}
}
unset($module);
?>
