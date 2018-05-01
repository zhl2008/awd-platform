<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

require_once ('data/modules/albums/functions.php');

function albums_info() {
	global $lang;
	return array(
		'name'          => $lang['albums']['title'],
		'intro'         => $lang['albums']['descr'],
		'version'       => '0.2',
		'website'       => '',
		'icon'          => 'images/albums.png',
		'compatibility' => '1.9',
		'categories'    => albums_get_albums(TRUE)
	);
}

function albums_settings_default() {
	return array(
		'resize_image_width'  => '800',
		'resize_thumb_width'  => '200'
	);
}

function albums_admin_module_settings_beforepost() {
	global $lang;
	echo '<span class="kop2">'.$lang['albums']['title'].'</span>
		<table>
			<tr>
				<td><input name="image_width" id="image_width" type="text" size="2" value="'.module_get_setting('albums','resize_image_width').'" /></td>
				<td><label for="image_width">&emsp;'.$lang['albums']['image_width'].'</label></td>
			</tr>
			<tr>
				<td><input name="thumb_width" id="thumb_width" type="text" size="2" value="'.module_get_setting('albums','resize_thumb_width').'" /></td>
				<td><label for="thumb_width">&emsp;'.$lang['albums']['thumb_width'].'</label></td>
			</tr>
	</table><br />';
}

function albums_admin_module_settings_afterpost() {
	global $lang;

	//Check if posted settings are numeric.
	if (!is_numeric($_POST['image_width']) || !is_numeric($_POST['thumb_width'])) {
		return show_error($lang['albums']['settings_error'], 1, true);
	}

	else {
		//Compose settings array
		$settings = array(
			'resize_image_width'  => $_POST['image_width'],
			'resize_thumb_width'  => $_POST['thumb_width']
		);
		//Save settings
		module_save_settings('albums', $settings);
	}
}

//Add hook for SEO capabilities.
$album_url_prefix = '&amp;module=albums&amp;page=viewalbum&amp;album=';
run_hook('album_url_prefix', array(&$album_url_prefix));
define('ALBUM_URL_PREFIX', $album_url_prefix);
unset($album_url_prefix);
?>
