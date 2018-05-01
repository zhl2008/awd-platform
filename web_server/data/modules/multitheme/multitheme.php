<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

function multitheme_info() {
	global $lang;
	return array(
		'name'          => $lang['multitheme']['module_name'],
		'intro'         => $lang['multitheme']['module_intro'],
		'version'       => '0.1',
		'website'       => '',
		'icon'          => '../../image/themes.png',
		'compatibility' => '1.9.8'
	);
}

function multitheme_admin_save_page_beforepost() {
	global $lang, $p_theme;

	echo '<tr>';
	echo '<td><label for="theme">'.$lang['multitheme']['page_edit'].' </label></td>';
	echo '<td><select name="theme" id="theme">';
	$themes = get_themes();
	if ($themes) {
		foreach ($themes as $theme) {
			if (isset($p_theme)) {
				if ($theme['dir'] == $p_theme)
					echo'<option value="'.$theme['dir'].'" selected="selected">'.$theme['title'].'</option>';
				else
					echo '<option value="'.$theme['dir'].'">'.$theme['title'].'</option>';
			}
			else {
				if ($theme['dir'] == THEME)
					echo'<option value="'.$theme['dir'].'" selected="selected">'.$theme['title'].'</option>';
				else
					echo '<option value="'.$theme['dir'].'">'.$theme['title'].'</option>';
			}
		}
	}
	echo '</select></td>';
	echo '</tr>';
}

function multitheme_admin_save_page_afterpost($module_additional_data) {
	if (isset($_POST['theme']) && $_POST['theme'] != THEME) {
		$module_additional_data['p_theme'] = sanitize($_POST['theme']);
	}
}

function multitheme_site_theme($page_theme) {
	if (defined('CURRENT_PAGE_FILENAME') && file_exists(PAGE_DIR.'/'.CURRENT_PAGE_FILENAME)) {
		include (PAGE_DIR.'/'.CURRENT_PAGE_FILENAME);
		if (isset($p_theme) && $p_theme != THEME && file_exists('data/themes/'.$p_theme))
			$page_theme = $p_theme;
	}
}
?>
