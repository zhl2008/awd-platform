<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

if (isset($_POST['save'])) {
	//Include old password.
	require_once ('data/settings/pass.php');

	//SHA512-encrypt posted passwords.
	if (!empty($cont1))
		$cont1 = hash('sha512', $cont1);

	//Check if the old password entered is correct. If it isn't, do:
	if ($ww != $cont1)
		$error = show_error($lang['changepass']['cant_change'], 1, true);

	elseif (empty($cont2))
		$error = show_error($lang['changepass']['empty'], 1, true);

	elseif ($cont2 = $cont3)
		$error = show_error($lang['changepass']['different'], 1, true);

	//If the old password entered is correct, save it.
	else {
			save_password($cont2);
			redirect('?action=options', 2);
			include_once ('data/inc/footer.php');
			exit;
	}
}
?>
<p>
	<strong><?php echo $lang['changepass']['message']; ?></strong>
</p>
<?php
if (isset($error))
	echo $error;
?>
<form method="post" action="">
	<p>
		<label class="kop2" for="cont1"><?php echo $lang['changepass']['old']; ?></label>
		<input name="cont1" id="cont1" type="password"/>
	</p>
	<p>
		<label class="kop2" for="cont2"><?php echo $lang['changepass']['new']; ?></label>
		<input name="cont2" id="cont2" type="password" />
	</p>
	<p>
		<label class="kop2" for="cont3"><?php echo $lang['changepass']['repeat']; ?></label>
		<input name="cont3" id="cont3" type="password" />
	</p>
	<?php show_common_submits('?action=options'); ?>
</form>
