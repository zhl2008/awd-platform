<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

//Check if chosen language is valid, and then save data.
if (isset($_POST['save'], $cont1) && $cont1 != '0' && file_exists('data/inc/lang/'.$cont1) && $cont1 != $langpref) {
	save_language($cont1);

	//Redirect user.
	show_error($lang['language']['saved'], 3);
	redirect('?action=options', 2);
	include_once ('data/inc/footer.php');
	exit;
}

//Introduction text.
?>
<p>
	<strong><?php echo $lang['language']['choose']; ?></strong>
</p>
<form action="" method="post">
	<p>
		<select name="cont1">
			<option selected="selected" value="0"><?php echo $lang['general']['choose']; ?></option>
			<?php read_lang_files(LANG_FILE); ?>
		</select>
	</p>
	<?php show_common_submits('?action=options'); ?>
</form>
