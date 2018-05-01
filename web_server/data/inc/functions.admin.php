<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

/**
 * Outputs HTML option-elements for use in form for language selection. Not suited for use in modules.
 *
 * @since 4.6
 * @package admin
 * @param string $not_this_file Language file to exclude from form.
 */
function read_lang_files($not_this_file) {
	$files = read_dir_contents('data/inc/lang', 'files');
	if ($files) {
		natcasesort($files);
		foreach ($files as $file) {
			include ('data/inc/lang/'.$file);
			?>
				<option value='<?php echo $file; ?>' <?php echo ($file == $not_this_file) ? 'selected' : ''; ?>><?php echo $language; ?></option>
			<?php
		}
		unset($file);
	}
}

/**
 * Shows a menu for inserting images in TinyMCE.
 *
 * @since 4.6
 * @package admin
 * @param string $dir Directory where images are stored in.
 */
function show_image_insert_box($dir) {
	global $lang;

	$images = read_dir_contents($dir, 'files');
	if ($images) {
	?>
		<div class="menudiv">
			<span>
				<img src="data/image/image.png" alt="" />
			</span>
			<span>
				<select id="insert_images">
					<?php
					natcasesort($images);
					foreach ($images as $image) {
					?>
						<option><?php echo $image; ?></option>
					<?php
					}
					unset($image);
					?>
				</select>
				<br />
				<a href="#" onclick="insert_image_link('<?php echo $dir; ?>');return false;"><?php echo $lang['general']['insert_image']; ?></a>
			</span>
		</div>
	<?php
	}
}

/**
 * Shows a menu for inserting files in TinyMCE.
 *
 * @since 1.9.8
 * @package admin
  * @param string $dir Directory where files are stored in.
 */
function show_file_insert_box($dir) {
	global $lang;

	$files = read_dir_contents($dir, 'files');
	if ($files) {
	?>
		<div class="menudiv">
			<span>
				<img src="data/image/file.png" alt="" />
			</span>
			<span>
				<select id="insert_files">
					<?php
					natcasesort($files);
					foreach ($files as $file) {
					?>
						<option><?php echo $file; ?></option>
					<?php
					}
					unset($file);
					?>
				</select>
				<br />
				<a href="#" onclick="insert_file_link('<?php echo $dir; ?>');return false;"><?php echo $lang['general']['insert_file']; ?></a>
			</span>
		</div>
	<?php
	}
}

/**
 * Shows a menu for inserting module inclusion code in TinyMCE.
 *
 * @since 1.9.8
 * @package admin
 */
function show_module_insert_box() {
	global $lang, $module_list;

	//Load module info and site-functions.
	foreach ($module_list as $module) {
	if (file_exists('data/modules/'.$module.'/'.$module.'.site.php'))
		require_once ('data/modules/'.$module.'/'.$module.'.site.php');
	}
	unset($module);

	$module_data = null;
	
	foreach ($module_list as $module) {
		if (module_is_compatible($module) && function_exists($module.'_theme_main')) {
				$module_data .= '<option value="'.$module.'">'.$module.'</option>';
				//Check if we need to display categories for the module
				$module_info = call_user_func($module.'_info');
				if (isset($module_info['categories']) && is_array($module_info['categories'])) {
					foreach ($module_info['categories'] as $category)
						$module_data .= '<option value="'.$module.','.$category.'">&nbsp;&nbsp;&nbsp;'.$category.'</option>';
				}
		}
	}
	if (isset($module_data)) {
	?>
	<div class="menudiv">
		<span>
			<img src="data/image/modules.png" alt="" />
		</span>
		<span>
			<select id="insert_modules">
			<?php
				echo $module_data;
			?>
			</select>
			<br />
			<a href="#" onclick="insert_module();return false;"><?php echo $lang['general']['insert_module']; ?></a>
		</span>
	</div>
	<?php
	}
}

/**
 * Shows a menu for inserting links to pages in TinyMCE.
 *
 * @since 4.6
 * @package admin
 */
function show_link_insert_box() {
	global $lang;

	$files = get_pages();
	if ($files) {
	?>
		<div class="menudiv">
			<span>
				<img src="data/image/page.png" alt="" />
			</span>
			<span>
				<select id="insert_pages">
					<?php
					foreach ($files as $file) {
							require PAGE_DIR.'/'.$file;
							$file = get_page_seoname($file);

							preg_match_all('|\/|', $file, $indent);
							$indent = count($indent[0]);

							if (!empty($indent))
								$indent = str_repeat('&nbsp;&nbsp;&nbsp;', $indent);
							else
								$indent = null;
							?>
								<option value="<?php echo $file; ?>"><?php echo $indent.$title; ?></option>
							<?php
					}
					unset($file);
					?>
				</select>
				<br />
				<a href="#" onclick="insert_page_link(); return false;"><?php echo $lang['page']['insert_link']; ?></a>
			</span>
		</div>
	<?php
	}
}

/**
 * Returns array with all pages.
 *
 * @since 1.9.8
 * @package admin
 * @param string $patch Directory where pages are located. Set to PAGE_DIR by default.
 * @return array All pages in an array.
 */
function get_pages($patch = PAGE_DIR, &$pages = null) {
	$files = read_dir_contents($patch, 'files');
	if ($files) {
		sort($files, SORT_NUMERIC);
		foreach ($files as $file) {
			$pages[] = $patch.'/'.$file;
			if (is_dir(PAGE_DIR.'/'.get_page_seoname($patch.'/'.$file)))
				get_pages(PAGE_DIR.'/'.get_page_seoname($patch.'/'.$file), $pages);
		}
		unset($file);

		foreach ($pages as $key => $page)
			$pages[$key] = str_replace(PAGE_DIR.'/', '', $page);

		return $pages;
	}

	return false;
}

/**
 * Shows a page box for a page. Not suited for use in modules.
 *
 * @since 4.6
 * @package admin
 * @param string $file Full filename of the page (no seoname).
 */
function show_page_box($file) {
	global $lang;

	include_once (PAGE_DIR.'/'.$file);
	$file = get_page_seoname($file);

	//Find the margin.
	preg_match_all('|\/|', $file, $margin);
	if (!empty($margin[0]))
		$margin = count($margin[0]) * 20 + 10;
	else
		$margin = 0;

	//We have to check for RTL.
	if (DIRECTION_RTL)
		$direction = 'right';
	else
		$direction = 'left'
	?>
		<div class="menudiv" <?php if ($margin != 0) echo 'style="margin-'.$direction.': '.$margin.'px;"'; ?>>
			<span>
				<img src="data/image/page.png" alt="" />
			</span>
			<span class="title-page"><?php echo $title; ?></span>
			<?php run_hook('admin_page_list_before', array(&$file)); ?>
			<span>
				<a href="?action=editpage&amp;page=<?php echo $file; ?>">
					<img src="data/image/edit.png" title="<?php echo $lang['page']['edit']; ?>" alt="<?php echo $lang['page']['edit']; ?>" />
				</a>
			</span>
			 <?php run_hook('admin_page_list_inside', array(&$file)); ?>
			<span>
				<a href="?action=pageup&amp;var1=<?php echo $file; ?>">
					<img src="data/image/up.png" title="<?php echo $lang['page']['change_order']; ?>" alt="<?php echo $lang['page']['change_order']; ?>" />
				</a>
			</span>
			<span>
				<a href="?action=pagedown&amp;var1=<?php echo $file; ?>">
					<img src="data/image/down.png" title="<?php echo $lang['page']['change_order']; ?>" alt="<?php echo $lang['page']['change_order']; ?>" />
				</a>
			</span>
			<span>
				<a href="?action=deletepage&amp;var1=<?php echo $file; ?>">
					<img src="data/image/delete.png" title="<?php echo $lang['trashcan']['move_to_trash']; ?>" alt="<?php echo $lang['trashcan']['move_to_trash']; ?>" />
				</a>
			</span>
			<?php run_hook('admin_page_list_after'); ?>
		</div>
	<?php
}

/**
 * Shows a subpage selection form. Used for saving pages.
 *
 * @since 1.9.8
 * @package admin
 * @param string $name HTML name given to select-element.
 * @param string $current_page Seoname of page that needs to be selected. Defaults to null.
 */
function show_subpage_select($name, $current_page = null) {
	global $lang;

	$pages = get_pages();
	echo '<select name="'.$name.'" id="'.$name.'">';
	echo '<option value="">'.$lang['general']['none'].'</option>';

	if ($pages) {
		foreach ($pages as $page) {
			//You should not be able to add a page as a sub-page of itself.
			if (is_null($current_page) || (strpos($page, get_page_filename($current_page)) === false && strpos(get_page_seoname($page), $current_page.'/') === false)) {
				include (PAGE_DIR.'/'.$page);

				preg_match_all('|\/|', $page, $indent);
				$indent = count($indent[0]);

				if (!empty($indent))
					$indent = str_repeat('&nbsp;&nbsp;&nbsp;', $indent);
				else
					$indent = null;

				if (get_page_seoname($page) == get_sub_page_dir($current_page) || (isset($_POST[$name]) && $_POST[$name] == get_page_seoname($page).'/'))
					$selected = ' selected="selected"';
				else
					$selected = null;

				echo '<option value="'.get_page_seoname($page).'/"'.$selected.'>'.$indent.$title.'</option>';
			}
		}
		unset($page);
	}
	echo '</select>';
}

/**
 * Reorders pages, to ensure there are no gaps in page numbering.
 *
 * @since 1.9.8
 * @package admin
 * @param string $patch Complete directory in which pages should be reordered.
 */
function reorder_pages($patch) {
	$pages = read_dir_contents($patch, 'files');

	//Only reorder if there are any files.
	if ($pages) {
		sort($pages, SORT_NUMERIC);

		$number = 1;
		foreach ($pages as $page) {
			$parts = explode('.', $page);
			rename($patch.'/'.$page, $patch.'/'.$number.'.'.$parts[1].'.'.$parts[2]);
			$number++;
		}
	}
}

/**
 * Shows common submit buttons for forms. By default shows a 'Save'-button and a 'Cancel'-button.
 *
 * @since 1.9.8
 * @package admin
 * @param string $url The URL to which the 'Cancel'-button redirects.
 * @param bool $exit If set to true, adds a 'Save and Exit'-button, with name="save_exit". Defaults to false.
 */
function show_common_submits($url, $exit = false) {
	global $lang;
	?>
		<input <?php if ($exit) echo 'class="save"'; ?> type="submit" name="save" value="<?php echo $lang['general']['save']; ?>" title="<?php echo $lang['general']['save']; ?>" />
		<?php if ($exit): ?>
		<input type="submit" name="save_exit" value="<?php echo $lang['general']['save_exit']; ?>" title="<?php echo $lang['general']['save_exit']; ?>" />
		<?php endif; ?>
		<a class="cancel" href="<?php echo $url; ?>" title="<?php echo $lang['general']['cancel']; ?>"><?php echo $lang['general']['cancel']; ?></a>
	<?php
}

/**
 * Generates and echoes HTML-code for a menu div. For use in admin center.
 *
 * @since 4.6
 * @package admin
 * @param string $title Title of the menu item.
 * @param string $text Descriptive text of menu item.
 * @param string $image Image of menu item.
 * @param string $url URL for link.
 * @param bool $blank If set to true, opens the link in a new page or tab. Defaults to false.
 * @param string $more Optionally show more information in menu div. Defaults to null.
 */
function showmenudiv($title, $text, $image, $url, $blank = false, $more = null) {
?>
	<div class="menudiv">
		<span>
			<a href="<?php echo $url; ?>" <?php if ($blank == true) echo ' target="_blank"'; ?>><img src="<?php echo $image; ?>" alt="" /></a>
		</span>
		<span>
			<span>
				<a href="<?php echo $url; ?>" <?php if ($blank == true) echo 'target="_blank"'; ?>><?php echo $title; ?></a>
			</span>
			<?php if ($more != null): ?>
				<span class="more"><?php echo $more; ?></span>
			<?php endif; ?>
			<br />
			<?php if ($text != null) echo $text; ?>
		</span>
	</div>
<?php
}

/**
 * Counts number of items in trash can (pages and images).
 *
 * @since 4.6
 * @package admin
 * @return integer The number of items in trash can.
 */
function count_trashcan() {
	//Pages
	$count_pages_array = glob('data/trash/pages/*.*');
	if (isset($count_pages_array) && !empty($count_pages_array))
		$count_pages = count($count_pages_array);
	else
		$count_pages = null;

	//Images
	$count_images_array = glob('data/trash/images/*.*');
	if (isset($count_images_array) && !empty($count_images_array))
		$count_images = count($count_images_array);
	else
		$count_images = null;
	
	//files
	$count_files_array = glob('data/trash/files/*.*');
	if (isset($count_files_array) && !empty($count_files_array))
		$count_files = count($count_files_array);
	else
		$count_files = null;

	//Combine all numbers...;
	return $count_pages + $count_images + $count_files;
}

/**
 * Checks specified file for permission to write and echoes status. For use in installer.
 *
 * @since 4.6
 * @package admin
 * @param string $file The file to check.
 */
function check_writable($file) {
	//Translation data.
	global $lang;
	if (is_writable($file)) {
	?>
		<span>
			<img src="data/image/update-no.png" width="15" height="15" alt="<?php echo $lang['install']['good']; ?>" />
		</span>
		<span>&nbsp;/<?php echo $file; ?></span>
		<br />
	<?php
	}
	else {
	?>
		<span>
			<img src="data/image/error.png" width="15" height="15" alt="<?php echo $lang['install']['false']; ?>" />
		</span>
		<span>chmod 777 <?php echo $file; ?></span>
		<br />
	<?php
	}
}

/**
 * Saves an empty file ('data/settings/install.dat') to indicate that EasyCMS has been sucessfully installed. For use in installer.
 *
 * @since 4.6
 * @package admin
 */
function install_done() {
	save_file('data/settings/install.dat', '');
}

/**
 * Hashes and saves login password.
 *
 * @since 4.6
 * @package admin
 * @param string $password The password (plain text).
 */
function save_password($password) {
	echo 'You can\'t do that';
}

/**
 * Saves general options (site title and email address).
 *
 * @since 1.9.8
 * @package admin
 * @param string $title The site title.
 * @param string $email The email address.
 */
function save_options($title, $email) {
	$title = sanitize($title);
	$email = sanitize($email);
	$data = '<?php'."\n"
	.'$sitetitle = \''.$title.'\';'."\n"
	.'$email = \''.$email.'\';'."\n"
	.'?>';
	save_file('data/settings/options.php', $data);
}

/**
 * Saves language setting.
 *
 * @since 4.6
 * @package admin
 * @param string $language The language file that should be used (for example 'en.php').
 */
function save_language($language) {
	save_file('data/settings/langpref.php', array('langpref' => $language), FALSE);
}

/**
 * Saves theme setting.
 *
 * @since 4.6
 * @package admin
 * @param string $theme The theme dir that should be used (for example 'default').
 */
function save_theme($theme) {
	save_file('data/settings/themepref.php', array('themepref' => $theme));
}

/**
 * Save a page with a lot of options.
 *
 * @since 1.9.8
 * @package admin
 * @param mixed $title if string - The title, if array title => The title, seo_name => The seo_name.
 * @param string $content The content.
 * @param string $hidden Should it be hidden ('yes' or 'no')?
 * @param string $subpage Specifies the parent page, if the saved page should be a sub page. Default to null.
 * @param string $description Description of the page. Defaults to null.
 * @param string $keywords Keywords of the page. Defaults to null.
 * @param array $module_additional_data Additional data variable, can be edited by modules through hooks (admin_save_page_module_additional_data). Defaults to null.
 * @param string $current_seoname Current seoname of the page, if we are editing a page. Defaults to null.
 * @return string Seoname of the saved page.
 */
function save_page($title, $content, $hidden, $subpage = null, $description = null, $keywords = null, $module_additional_data = null, $current_seoname = null) {
	//Run a few hooks.
	run_hook('admin_save_page', array(&$title, &$content));
	run_hook('admin_save_page_meta', array(&$description, &$keywords));
	run_hook('admin_save_page_module_additional_data', array(&$module_additional_data));
	
	//Configure title and seo_name
	if (is_array($title)) {
		if (!empty($title['seo_name'])) {
			$seo_title = $title['seo_name'];
			$title = $title['title'];
		}
		else {
			$seo_title = seo_url($title['title']);
			$title = $title['title'];
		}
	}
	else
		$seo_title = seo_url($title);
	
	//Check if the seo url  is empty.
	if (empty($seo_title))
		return false;

	//Check if a page already exists with the name.
	if ((!isset($current_seoname) || $current_seoname != $subpage.$seo_title) && get_page_filename($subpage.$seo_title) != false)
		return false;

	//Do we want to create a new page?
	if (!isset($current_seoname)) {
		//Check if we want a sub-page.
		if (!empty($subpage)) {
			//We need to make sure that the dir exists, and if not, create it.
			if (!file_exists(PAGE_DIR.'/'.rtrim($subpage, '/'))) {
				mkdir(PAGE_DIR.'/'.rtrim($subpage, '/'));
				chmod(PAGE_DIR.'/'.rtrim($subpage, '/'), 0777);
			}
			$pages = read_dir_contents(PAGE_DIR.'/'.rtrim($subpage, '/'), 'files');
		}

		else
			$pages = read_dir_contents(PAGE_DIR, 'files');

		//Are there any pages?
		if ($pages == false)
			$number = 1;
		else
			$number = count($pages) + 1;

		$newfile = $subpage.$number.'.'.$seo_title;
	}

	//Then we want to edit a page.
	else {
		$filename = get_page_filename($current_seoname); //the old file name

		//Is it a sub-page, or do we want to make it one?
		if (strpos($current_seoname, '/') !== false || !empty($subpage)) {
			$page_name = explode('/', $subpage);
			$count = count($page_name);
			unset($page_name[$count]);

			$dir = get_sub_page_dir($current_seoname);
			$filename_array = str_replace($dir.'/', '', $filename);
			$filename_array = explode('.', $filename_array);

			$newfilename = implode('/', $page_name).'/'.$filename_array[0].'.'.$seo_title;
			$newdir = get_sub_page_dir($newfilename);

			//We need to make sure that the dir exists, and if not, create it.
			if (!file_exists(PAGE_DIR.'/'.$newdir)) {
				mkdir(PAGE_DIR.'/'.$newdir);
				chmod(PAGE_DIR.'/'.$newdir, 0777);
			}

			//If the name isn't the same as before, we have to find the correct number.
			if ($newfilename.'.php' != $filename) {
				//If the sub-folder is the same, use the same number as before.
				if ($dir.'/' == $newdir)
					$number = $filename_array[0];

				else {
					$pages = read_dir_contents(PAGE_DIR.'/'.$newdir, 'files');

					if ($pages) {
						$count = count($pages);
						$number = $count + 1;
					}
					else
						$number = 1;
				}

				$newfile = implode('/', $page_name).$number.'.'.$seo_title;
			}
		}

		//If not, just create the new filename.
		else {
			$filename_array = explode('.', $filename);
			$newfile = $filename_array[0].'.'.$seo_title;
		}
	}

	//Save the title, content and hidden status.
	$data = '<?php'."\n"
	.'$title = \''.sanitize($title).'\';'."\n"
	.'$seoname = \''.sanitize($seo_title).'\';'."\n"
	.'$content = \''.sanitize($content, true).'\';'."\n"
	.'$hidden = \''.$hidden.'\';';

	//Save the description and keywords, if any.
	if ($description != null)
		$data .= "\n".'$description = \''.sanitize($description).'\';';
	if ($keywords != null)
		$data .= "\n".'$keywords = \''.sanitize($keywords).'\';';

	//If modules have supplied additional data, save it.
	if ($module_additional_data != null && is_array($module_additional_data)) {
		foreach ($module_additional_data as $var => $value) {
			$data .= "\n".'$'.$var.' = \''.$value.'\';';
		}
	}

	$data .= "\n".'?>';

	//Save the file.
	save_file(PAGE_DIR.'/'.$newfile.'.php', $data);

	//Do a little cleanup if we are editing a page.
	if (isset($current_seoname)) {
		//Check if the title is different from what we started with.
		if ($newfile.'.php' != $filename) {
			//If there are sub-pages, rename the folder.
			if (file_exists(PAGE_DIR.'/'.get_page_seoname($filename)))
				rename(PAGE_DIR.'/'.get_page_seoname($filename), PAGE_DIR.'/'.get_page_seoname($newfile.'.php'));

			//Remove the old file.
			unlink(PAGE_DIR.'/'.$filename);

			//If there are no files in the old dir, delete it.
			if (isset($dir) && read_dir_contents(PAGE_DIR.'/'.$dir, 'files') == false)
				rmdir(PAGE_DIR.'/'.$dir);

			//If there are pages, we need to reorder them.
			elseif (isset($dir))
				reorder_pages(PAGE_DIR.'/'.$dir);
			else
				reorder_pages(PAGE_DIR);
		}
	}

	//Return the seoname.
	return get_page_seoname($newfile.'.php');
}

/**
 * Showing an admin menu.
 *
 * @since 1.9.8
 * @package admin
 * @param array $links The array with links parameters.
 */
function show_admin_menu($links) {
	foreach ($links as $link) {
		?>
			<li>
				<a href="<?php echo $link['href']; ?>" title="<?php echo $link['text']; ?>" <?php if (isset($link['target'])) echo 'target="'.$link['target'].'"'; ?>>
					<img src="<?php echo $link['img']; ?>" alt="" />
					<?php echo $link['text']; ?>
				</a>
			<?php
			if(isset($link['submenu'])) {
				?>
				<ul class="submenu">
					<?php show_admin_menu($link['submenu']); ?>
				</ul>
			<?php
			}
			?>
			</li>
			<?php
	}
	unset ($link);

}

/**
 * Checking if there is an update version available
 *
 * @since 1.9.8
 * @package admin
 * @param string $version The available version.
 * @return string yes, urgent, no, error
 */
function check_update_version($version) {
	switch(substr_count($version, '.')) {
		case '0':
			$version .= '.0.0';
			break;
		case '1':
			$version .= '.0';
			break;
	}
	list($v1, $v2, $v3) = explode('.', $version);
	list($p1, $p2, $p3) = explode('.', VERSION);
	
	if ($v1 > $p1 || $v2 > $p2)
		return 'urgent';
	elseif ($v3 > $p3)
		return 'yes';
	else
		return 'no';
	
	// If there are no other posibility return error
	return 'error';
	
}
?>
