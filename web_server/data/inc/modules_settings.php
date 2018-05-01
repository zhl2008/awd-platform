<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

if (isset($_POST['save'])) {
	//Run hook and fetch errors (if any).
	$errors = run_hook('admin_module_settings_afterpost');

	if (empty($errors)) {
		show_error($lang['settings']['changing_settings'], 3);
		redirect('?action=options', 0);
	}
}
?>

<p>
	<strong><?php echo $lang['modules_settings']['message']; ?></strong>
</p>

<?php
//Show errors (if any).
if (!empty($errors)) {
	foreach ($errors as $error)
		echo $error;
}
?>

<form method="post" action="">
	<?php run_hook('admin_module_settings_beforepost'); ?>
	<?php show_common_submits('?action=options'); ?>
</form>
