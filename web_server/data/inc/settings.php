<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

//Include old settings, to display them.
require_once ('data/settings/options.php');

//If form has been submitted.
if (isset($_POST['save'])) {
	//Check if a sitetitle has been entered.
	if (empty($cont1))
		$error = show_error($lang['settings']['fill_name'], 1, true);

	//Check if emailaddress is valid.
	elseif (!preg_match('/^.+@.+\..{2,4}$/', $cont2))
		$error = show_error($lang['settings']['email_invalid'], 1, true);

	else {
		//If XHTML-ruleset is not on, turn it off.
		if (!isset($cont3))
			$cont3 = 'false';

		//Then, save the settings.
		save_options($cont1, $cont2);

		show_error($lang['settings']['changing_settings'], 3);
		redirect('?action=options', 0);
		include_once ('data/inc/footer.php');
		exit;
	}
}
?>
<p>
	<strong><?php echo $lang['settings']['message']; ?></strong>
</p>
<?php
if (isset($error))
	echo $error;
?>
<?php run_hook('admin_settings_before'); ?>
<form method="post" action="">
	<p>
		<label class="kop2" for="cont1"><?php echo $lang['general']['change_title']; ?></label>
		<span class="kop4"><?php echo $lang['settings']['choose_title']; ?></span>
		<br />
		<input name="cont1" id="cont1" type="text" value="<?php echo $sitetitle; ?>" />
	</p>
	<p>
		<label class="kop2" for="cont2"><?php echo $lang['settings']['email']; ?></label>
		<span class="kop4"><?php echo $lang['settings']['email_descr']; ?></span>
		<br />
		<input name="cont2" id="cont2" type="text" value="<?php echo $email; ?>" />
	</p>
	<?php show_common_submits('?action=options'); ?>
</form>
