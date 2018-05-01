<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

require_once 'data/modules/albums/functions.php';
require_once 'data/inc/lib/SmartImage.class.php';

function albums_pages_admin() {
	global $lang, $var1, $var2;

	$module_page_admin[] = array(
		'func'  => 'albums',
		'title' => $lang['albums']['title']
	);
	$module_page_admin[] = array(
		'func'  => 'editalbum',
		'title' => $lang['albums']['edit_album']
	);
	$module_page_admin[] = array(
		'func'  => 'deletealbum',
		'title' => $lang['albums']['delete_album']
	);
	$module_page_admin[] = array(
		'func'  => 'editimage',
		'title' => $lang['albums']['edit_image']
	);
	$module_page_admin[] = array(
		'func'  => 'deleteimage',
		'title' => $lang['albums']['delete_image']
	);
	$module_page_admin[] = array(
		'func'  => 'imageup',
		'title' => $lang['albums']['change_order']
	);
	$module_page_admin[] = array(
		'func'  => 'imagedown',
		'title' => $lang['albums']['change_order']
	);
	return $module_page_admin;
}

function albums_page_admin_albums() {
	global $cont1, $lang;
	?>
		<p>
			<strong><?php echo $lang['albums']['message']; ?></strong>
		</p>
		<span class="kop2"><?php echo $lang['albums']['edit_albums']; ?></span>
		<?php
		albums_admin_show_albums(ALBUMS_DIR);
		?>
			<br /><br />
			<label class="kop2" for="cont1"><?php echo $lang['albums']['new_album']; ?></label>
			<form method="post" action="">
				<span class="kop4"><?php echo $lang['albums']['choose_name']; ?></span><br />
				<input name="cont1" id="cont1" type="text" />
				<input type="submit" name="submit" value="<?php echo $lang['general']['save']; ?>" />
			</form>
		<?php
		//When form is submitted.
		if (isset($_POST['submit'])) {
			if (!empty($cont1) && file_exists(ALBUMS_DIR.'/'.seo_url($cont1)))
				show_error($lang['albums']['name_exist'], 1);

			elseif (!empty($cont1)) {
				//Sanitize album name and list it in array for saving.
				$album_name = sanitize($cont1);
				$data['album_name'] = $album_name;
				
				//Make the album url safe to use.
				$cont1 = seo_url($cont1);

				//Create and chmod directories.
				mkdir(ALBUMS_DIR.'/'.$cont1);
				chmod(ALBUMS_DIR.'/'.$cont1, 0777);
				mkdir(ALBUMS_DIR.'/'.$cont1.'/thumb');
				chmod(ALBUMS_DIR.'/'.$cont1.'/thumb', 0777);

				//Create album file.
				save_file(ALBUMS_DIR.'/'.$cont1.'.php', $data);

				redirect('?module=albums', 0);
			}
		}
	?>
		<p>
			<a href="?action=modules">&lt;&lt;&lt; <?php echo $lang['general']['back']; ?></a>
		</p>
	<?php
}

function albums_page_admin_editalbum() {
	global $cont1, $cont2, $cont3, $lang, $var1;

	//Let's process the image...
	if (isset($_POST['submit'])) {
		//If file is jpeg, pjpeg, png or gif: Accept.
		if (in_array($_FILES['imagefile']['type'], array('image/jpeg', 'image/pjpeg', 'image/png', 'image/gif'))) {
			//Define some variables
			$extpos = strrpos($_FILES['imagefile']['name'], '.');
			if ($extpos === false) $extpos = strlen($_FILES['imagefile']['name']);
			$image_filename = substr($_FILES['imagefile']['name'], 0, $extpos);
			$ext = substr($_FILES['imagefile']['name'], $extpos + 1);
			$image_filename = seo_url($image_filename);
			$fullimage = ALBUMS_DIR.'/'.$var1.'/'.$image_filename.'.'.strtolower($ext);
			$thumbimage = ALBUMS_DIR.'/'.$var1.'/thumb/'.$image_filename.'.'.strtolower($ext);

			//Check if the image name already exists.
			$images = read_dir_contents(ALBUMS_DIR.'/'.$var1.'/thumb', 'files');
			if ($images) {
				foreach ($images as $image) {
					$extpos = strrpos($image, '.');
					if ($extpos === false) $extpos = strlen($image);
					$namepart = substr($image, 0, $extpos);
					if ($namepart == $image_filename) {
						$name_exist = true;
						break;
					}
				}
			}

			//Don't do anything, if the name already exists.
			if (isset($name_exist))
				$error = show_error($lang['albums']['image_exist'], 1, true);
				
			//If we somehow can't copy the image, show an error.
			elseif (!copy($_FILES['imagefile']['tmp_name'], $fullimage) || !copy($_FILES['imagefile']['tmp_name'], $thumbimage))
				$error = show_error($lang['general']['upload_failed'], 1, true);

			else {
				//Compress the big image.
				$image_width = module_get_setting('albums','resize_image_width');
				$image = new SmartImage($fullimage);
				//Only resize if resize_image_width is not disabled (or set to 1, which would produce errors).
				if ($image_width != '0' && $image_width != '1') {
					list($width, $height) = getimagesize($fullimage);
					$imgratio = $width / $height;
					if ($imgratio > 1) {
						$newwidth = $image_width;
						$newheight = $image_width / $imgratio;
					}
					else {
						$newheight = $image_width;
						$newwidth = $image_width * $imgratio;
					}
					$image->resize($newwidth, $newheight);
				}
				$image->saveImage($fullimage, $cont3);
				$image->close();
				chmod($fullimage, 0777);

				//Then make a thumb from the image.
				$thumb_width = module_get_setting('albums','resize_thumb_width');
				//If resize_thumb_width is set to 0 or 1, we need to grab the default width (otherwise it would produce errors).
				if ($thumb_width == '0' || $thumb_width == '1') {
					$albums_default_settings = albums_settings_default();
					$thumb_width = $albums_default_settings['resize_thumb_width'];
				}

				//Resize thumb.
				$thumb = new SmartImage($thumbimage);
				list($width, $height) = getimagesize($thumbimage);
				$imgratio = $width / $height;
				if ($imgratio > 1) {
					$newwidth = $thumb_width;
					$newheight = $thumb_width / $imgratio;
				}
				else {
					$newheight = $thumb_width;
					$newwidth = $thumb_width * $imgratio;
				}
				$thumb->resize($newwidth, $newheight);
				$thumb->saveImage($thumbimage, $cont3);
				$thumb->close();
				chmod($thumbimage, 0777);

				//Find the number.
				$images = read_dir_contents(ALBUMS_DIR.'/'.$var1.'/thumb', 'files');

				if ($images)
					$number = count($images);
				else
					$number = 1;

				//Sanitize data.
				$cont1 = sanitize($cont1);
				$cont2 = sanitize($cont2);
				$cont2 = nl2br($cont2);

				//Compose the data.
				$data['name'] = $cont1;
				$data['info'] = $cont2;

				//Then save the image information.
				save_file(ALBUMS_DIR.'/'.$var1.'/'.$number.'.'.$image_filename.'.'.strtolower($ext).'.php', $data);
			}
		}

		//Block unknown image types.
		else {
			//FIXME: Maybe a better error message?
			$error = show_error($lang['general']['upload_failed'], 1, true);
		}
	}
	
	//Check if album exists.
	if (file_exists(ALBUMS_DIR.'/'.$var1)) {
		//Introduction text.
		?>
			<p>
				<strong><?php echo $lang['albums']['album_message1']; ?></strong>
			</p>
			<p>
				<span class="kop2"><?php echo $lang['albums']['new_image']; ?></span>
				<span class="kop4"><?php echo $lang['albums']['album_message2']; ?></span>
			</p>
			<?php
			if (isset($error))
				echo $error;
			?>
			<form method="post" action="" enctype="multipart/form-data">
				<p>
					<label class="kop2" for="cont1"><?php echo $lang['general']['title']; ?></label>
					<input name="cont1" id="cont1" type="text" />
				</p>
				<p>
					<label class="kop2" for="cont2"><?php echo $lang['general']['description']; ?></label>
					<textarea cols="50" rows="5" name="cont2" id="cont2"></textarea>
				</p>
				<p>
					<input type="file" name="imagefile" id="imagefile" />
					<label class="kop4" for="cont3"><?php echo $lang['albums']['quality']; ?></label>
					<input name="cont3" id="cont3" type="text" size="3" value="85" />
				</p>
				<input type="submit" name="submit" value="<?php echo $lang['general']['save']; ?>" />
			</form>
			<br />
		<?php
		//Edit images.
		?>
		<span class="kop2"><?php echo $lang['albums']['edit_images']; ?></span>
		<?php
		albums_admin_show_images($var1);
	}
	?>
		<br />
		<p>
			<a href="?module=albums">&lt;&lt;&lt; <?php echo $lang['general']['back']; ?></a>
		</p>
	<?php
}

function albums_page_admin_deletealbum() {
	global $var1;

	//Check if an album was defined, and if the album exists.
	if (isset($var1) && file_exists(ALBUMS_DIR.'/'.$var1)) {
		recursive_remove_directory(ALBUMS_DIR.'/'.$var1);
		unlink(ALBUMS_DIR.'/'.$var1.'.php');
	}

	redirect('?module=albums', 0);
}

function albums_page_admin_editimage() {
	global $cont1, $cont2, $lang, $var1, $var2;

	//Check if an image was defined, and if the image exists.
	if (isset($var2) && file_exists(ALBUMS_DIR.'/'.$var1.'/'.albums_get_php_filename($var1, $var2))) {
		//Include the image-information.
		include (ALBUMS_DIR.'/'.$var1.'/'.albums_get_php_filename($var1, $var2));
		?>
		<form name="form1" method="post" action="">
			<p>
				<label class="kop2" for="cont1"><?php echo $lang['general']['title']; ?></label>
				<input name="cont1" id="cont1" type="text" value="<?php echo $name; ?>" />
			</p>
			<p>
				<label class="kop2" for="cont2"><?php echo $lang['general']['description']; ?></label>
				<textarea cols="50" rows="5" name="cont2" id="cont2"><?php echo str_replace('<br />', '', $info); ?></textarea>
			</p>
			<?php show_common_submits('?module=albums&amp;page=editalbum&amp;var1='.$var1); ?>
		</form>
		<?php
		//When the information is posted:
		if (isset($_POST['save'])) {
			//Sanitize data.
			$cont1 = sanitize($cont1);
			$cont2 = sanitize($cont2);
			$cont2 = nl2br($cont2);

			//Then save the image information.
			$data['name'] = $cont1;
			$data['info'] = $cont2;

			save_file(ALBUMS_DIR.'/'.$var1.'/'.albums_get_php_filename($var1, $var2), $data);

			redirect('?module=albums&page=editalbum&var1='.$var1, 0);
		}
	}
}

function albums_page_admin_deleteimage() {
	global $var1, $var2;

	//Check if an image was defined, and if the image exists.
	if (isset($var1, $var2) && file_exists(ALBUMS_DIR.'/'.$var1.'/'.albums_get_php_filename($var1, $var2))) {
		//Find the extension of the image before we delete anything.
		$parts =  explode('.', albums_get_php_filename($var1, $var2));

		//First, delete the php file.
		unlink(ALBUMS_DIR.'/'.$var1.'/'.albums_get_php_filename($var1, $var2));

		//And then delete the image and the thumb.
		unlink(ALBUMS_DIR.'/'.$var1.'/'.$parts[1].'.'.$parts[2]);
		unlink(ALBUMS_DIR.'/'.$var1.'/thumb/'.$parts[1].'.'.$parts[2]);

		//Finally, reorder the images.
		albums_reorder_images($var1);
	}

	redirect('?module=albums&page=editalbum&var1='.$var1, 0);
}

function albums_page_admin_imageup() {
global $lang, $var1, $var2;

//Check if images exist.
if (isset($var1, $var2) && file_exists(ALBUMS_DIR.'/'.$var1.'/'.albums_get_php_filename($var1, $var2))) {
	$current_parts =  explode('.', albums_get_php_filename($var1, $var2));

	//We can't higher the first image, so we have to check.
	if ($current_parts[0] == 1) {
		show_error($lang['albums']['already_top'], 2);
		redirect('?module=albums&page=editalbum&var1='.$var1, 2);
		include_once ('data/inc/footer.php');
		exit;
	}

	$files = read_dir_contents(ALBUMS_DIR.'/'.$var1, 'files');

	//Now we need to find the name of the other image, so we can switch numbers.
	foreach ($files as $file) {
		$file_parts = explode('.', $file);
		if ($current_parts[0] - 1 == $file_parts[0]) {
		$prior_parts = $file_parts;
		break;
		}
	}
	unset($file);

	//Switch the numbers.
	$current_image_new = $prior_parts[0].'.'.$current_parts[1].'.'.$current_parts[2].'.php';
	$prior_image_new = $current_parts[0].'.'.$prior_parts[1].'.'.$prior_parts[2].'.php';

	//And finaly, rename the files.
	rename(ALBUMS_DIR.'/'.$var1.'/'.implode('.', $current_parts), ALBUMS_DIR.'/'.$var1.'/'.$current_image_new);
	rename(ALBUMS_DIR.'/'.$var1.'/'.implode('.', $prior_parts), ALBUMS_DIR.'/'.$var1.'/'.$prior_image_new);

	//Show message.
	show_error($lang['general']['changing_rank'], 3);
}

//Redirect.
redirect('?module=albums&page=editalbum&var1='.$var1, 0);
}

function albums_page_admin_imagedown() {
	global $lang, $var1, $var2;

	//Check if images exist.
	if (isset($var1, $var2) && file_exists(ALBUMS_DIR.'/'.$var1.'/'.albums_get_php_filename($var1, $var2))) {
		$current_parts =  explode('.', albums_get_php_filename($var1, $var2));

		$files = read_dir_contents(ALBUMS_DIR.'/'.$var1, 'files');
		$number_of_files = 0;

		//Count the number of PHP files.
		foreach ($files as $file) {
			$file_parts = explode('.', $file);
			if (isset($file_parts[3]))
				$number_of_files++;
		}

		//We can't lower the last image, so we have to check.
		if ($number_of_files == $current_parts[0]) {
			show_error($lang['albums']['already_last'], 2);
			redirect('?module=albums&page=editalbum&var1='.$var1, 2);
			include_once ('data/inc/footer.php');
			exit;
		}

		//Now we need to find the name of the other image, so we can switch numbers.
		foreach ($files as $file) {
			$file_parts = explode('.', $file);
			if ($current_parts[0] + 1 == $file_parts[0]) {
				$next_parts = $file_parts;
				break;
			}
		}
		unset($file);

		//Switch the numbers.
		$current_image_new = $next_parts[0].'.'.$current_parts[1].'.'.$current_parts[2].'.php';
		$next_image_new = $current_parts[0].'.'.$next_parts[1].'.'.$next_parts[2].'.php';

		//And finally, rename the files.
		rename(ALBUMS_DIR.'/'.$var1.'/'.implode('.', $current_parts), ALBUMS_DIR.'/'.$var1.'/'.$current_image_new);
		rename(ALBUMS_DIR.'/'.$var1.'/'.implode('.', $next_parts), ALBUMS_DIR.'/'.$var1.'/'.$next_image_new);

		//Show message.
		show_error($lang['general']['changing_rank'], 3);
	}

	//Redirect.
	redirect('?module=albums&page=editalbum&var1='.$var1, 0);
}
?>
