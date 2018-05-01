<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

require_once ('data/modules/blog/functions.php');

function blog_info() {
	global $lang;
	return array(
		'name'          => $lang['blog']['title'],
		'intro'         => $lang['blog']['descr'],
		'version'       => '0.2',
		'website'       => '',
		'icon'          => 'images/blog.png',
		'compatibility' => '1.9.8',
		'categories'    => blog_get_categories(TRUE)
	);
}

function blog_settings_default() {
	return array(
		'allow_reactions'	=> true,
		'truncate_posts'	=> '500',
		'posts_per_page'	=> '15',
		'post_date'	=> 'd/m/Y',
		'post_time'	=> 'G:i'
	);
}

function blog_admin_module_settings_beforepost() {
	global $lang;
	echo '<span class="kop2">'.$lang['blog']['title'].'</span>
		<table>
			<tr>
				<td><input type="checkbox" name="allow_reactions" id="allow_reactions" value="true" '; if (module_get_setting('blog','allow_reactions') == 'true') { echo 'checked="checked" '; } echo '/></td>
				<td><label for="allow_reactions">&emsp;'.$lang['blog']['allow_reactions'].'</label></td>
			</tr>
			<tr>
				<td><input name="truncate_posts" id="truncate_posts" type="text" size="2" value="'.module_get_setting('blog','truncate_posts').'" /></td>
				<td><label for="truncate_posts">&emsp;'.$lang['blog']['truncate_posts'].'</label></td>
			</tr>
			<tr>
				<td><input name="posts_per_page" id="posts_per_page" type="text" size="2" value="'.module_get_setting('blog','posts_per_page').'" /></td>
				<td><label for="posts_per_page">&emsp;'.$lang['blog']['posts_per_page'].'</label></td>
			</tr>
			<tr>
				<td>
					<select name="post_date" id="post_date" />';
						$date_options = array ('d/m/Y','d-m-Y','d.m.Y','m/d/Y','m-d-Y','m.d.Y','Y/m/d','d-m-y','F j, Y');
						foreach ($date_options as $option) {
							echo '<option value="'.$option.'"';
							if (module_get_setting('blog', 'post_date') == $option)
								echo ' selected="selected"';
							echo '>'.date($option).'</option>'."\n";
						}
						unset($option);
					echo '</select>
				</td>
				<td><label for="post_date">&emsp;'.$lang['blog']['post_date'].'</label></td>
			</tr>
			<tr>
				<td>
					<select name="post_time" id="post_time" />';
						$time_options = array ('G:i','H:i:s','g:i a','g:i A','g:i:s a','g:i:s A');
						foreach ($time_options as $option) {
							echo '<option value="'.$option.'"';
							if (module_get_setting('blog', 'post_time') == $option)
								echo ' selected="selected"';
							echo '>'.date($option).'</option>'."\n";
						}
						unset($option);
					echo '</select>
				</td>
				<td><label for="post_time">&emsp;'.$lang['blog']['post_time'].'</label></td>
			</tr>
	</table><br />';
}

function blog_admin_module_settings_afterpost() {
	global $lang;

	//truncate_posts should be numeric.
	if (!is_numeric($_POST['truncate_posts']) || !is_numeric($_POST['posts_per_page']))
		return show_error($lang['blog']['numeric_error'], 1, true);

	if (empty($_POST['posts_per_page']))
		return show_error($lang['blog']['posts_per_page_error'], 1, true);

	else {
		//Compose settings array
		$settings = array(
			'allow_reactions' => (isset($_POST['allow_reactions'])) ? 'true' : 'false',
			'truncate_posts' => $_POST['truncate_posts'],
			'posts_per_page' => $_POST['posts_per_page'],
			'post_date' => $_POST['post_date'],
			'post_time' => $_POST['post_time']
		);
		//Save settings
		module_save_settings('blog', $settings);
	}
}

//Add hook for SEO capabilities.
$blog_url_prefix = '&amp;module=blog&amp;page=viewpost&amp;post=';
run_hook('blog_url_prefix', array(&$blog_url_prefix));
define('BLOG_URL_PREFIX', $blog_url_prefix);
unset($blog_url_prefix);
?>
