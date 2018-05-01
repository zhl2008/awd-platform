<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

//Save the theme-data.
if (isset($_POST['save'], $cont1) && file_exists('data/themes/'.$cont1)) {
	save_theme($cont1);

	//Redirect user
	show_error($lang['theme']['saved'], 3);
	redirect('?action=options', 2);
	include_once ('data/inc/footer.php');
	exit;
}
?>
<div class="rightmenu">
	<div class="menudiv">
		<span>
			<img src="data/image/install.png" alt="<?php echo $lang['theme_install']['title']; ?>" title="<?php echo $lang['theme_install']['title']; ?>" />
		</span>
		<span class="kop3">
			<a href="?action=themeinstall" title="<?php echo $lang['theme_install']['title']; ?>"><?php echo $lang['theme_install']['title']; ?></a>
		</span>
	</div>
	<div class="menudiv">
		<span><img src="data/image/delete.png" alt="<?php echo $lang['theme_uninstall']['title']; ?>" title="<?php echo $lang['theme_uninstall']['title']; ?>" /></span>
		<span class="kop3">
			<a href="?action=themeuninstall" title="<?php echo $lang['theme_uninstall']['title']; ?>"><?php echo$lang['theme_uninstall']['title']; ?></a>
		</span>
	</div>
</div>
<p>
	<strong><?php echo $lang['theme']['choose']; ?></strong>
</p>
<?php run_hook('admin_theme_before'); ?>
<form action="" method="post">
	<p>
		<select name="cont1">
			<?php
			$themes = get_themes();
				if ($themes) {
					foreach ($themes as $theme) {
						if ($theme['dir'] == THEME)
							echo'<option value="'.$theme['dir'].'" selected="selected">'.$theme['title'].'</option>';
						else
							echo '<option value="'.$theme['dir'].'">'.$theme['title'].'</option>';
					}
				}
				unset($theme);
			?>
		</select>
	</p>
	<?php show_common_submits('?action=options'); ?>
</form>
