<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

define('ALBUMS_DIR', 'data/settings/modules/albums');
//Two constants we use in imageup.php and imagedown.php.
define('TEMP', '_temp');
define('NAME', 'image');

/**
 * Loads albums in an array. Will return FALSE if no albums exist.
 * @param bool $only_return_title If set to TRUE, only the title will be returned (seoname will be discarded).
 * @return mixed
 */
function albums_get_albums($only_return_title = FALSE) {
	$files = read_dir_contents(ALBUMS_DIR, 'files');

	if ($files) {
		natcasesort($files);
		foreach ($files as $album) {
			include(ALBUMS_DIR.'/'.$album);
			if ($only_return_title == TRUE)
				$albums[] = $album_name;
			else {
				$albums[] = array(
					'title'   => $album_name,
					'seoname' => str_replace('.php', '', $album)
				);
			}
		}
		unset($album);

		return $albums;
	}

	else
		return false;
}

/**
 * Loads images in an array. Will return FALSE if no images exist.
 * @param string $album The album to return the images from.
 * @return array The images, including information: title, info, seoname, filename and filename_image.
 */
function albums_get_images($album) {
	$files = read_dir_contents(ALBUMS_DIR.'/'.$album, 'files');
	if (!$files)
		return FALSE;

	elseif ($files) {
		natcasesort($files);
		foreach ($files as $file) {
			$parts = explode('.', $file);
			if (count($parts) == 4) {
				list($number, $fdirname, $ext, $php) = $parts;
				include_once (ALBUMS_DIR.'/'.$album.'/'.$file);
				$images[] = array(
					'title'          => $name,
					'info'           => $info,
					'seoname'        => $fdirname,
					'filename'       => $file,
					'filename_image' => $fdirname.'.'.$ext
				);
			}
		}
		unset($file);

		return $images;
	}
}

/**
 * Displays a list of albums. For use in admin center.
 */
function albums_admin_show_albums() {
	global $lang;
	$albums = albums_get_albums();

	if ($albums == FALSE)
		echo '<span class="kop4">'.$lang['general']['nothing_yet'].'</span>';

	else {
		foreach ($albums as $album) {
			?>
				<div class="menudiv">
					<span>
						<img src="<?php echo MODULE_DIR; ?>/images/albums.png" alt="" />
					</span>
					<span class="title-page"><?php echo $album['title']; ?></span>
					<span>
						<a href="?module=albums&amp;page=editalbum&amp;var1=<?php echo $album['seoname']; ?>">
							<img src="data/image/edit.png" title="<?php echo $lang['albums']['edit_album']; ?>" alt="<?php echo $lang['albums']['edit_album']; ?>" />
						</a>
					</span>
					<span>
						<a href="?module=albums&amp;page=deletealbum&amp;var1=<?php echo $album['seoname']; ?>">
							<img src="data/image/delete_from_trash.png"  title="<?php echo $lang['albums']['delete_album']; ?>" alt="<?php echo $lang['albums']['delete_album']; ?>" />
						</a>
					</span>
				</div>
			<?php
		}
		unset($albums);
	}
}

/**
 * Displays a list of images in an album. For use in admin center.
 * @param string $album The album to display the images from.
 */
function albums_admin_show_images($album) {
	global $lang, $var1;

	$images = albums_get_images($album);
	if ($images == FALSE)
		echo '<span class="kop4">'.$lang['general']['nothing_yet'].'</span><br />';

	else {
		foreach ($images as $image) {
			?>
				<div class="menudiv">
					<span>
						<a href="<?php echo MODULE_DIR; ?>/albums_getimage.php?image=<?php echo $var1.'/'.$image['filename_image']; ?>" target="_blank">
							<img src="<?php echo MODULE_DIR; ?>/albums_getimage.php?image=<?php echo $var1; ?>/thumb/<?php echo $image['filename_image']; ?>" title="<?php echo $image['title']; ?>" alt="<?php echo $image['title']; ?>" />
						</a>
					</span>
					<span class="title-page">
						<span class="kop3"><?php echo $image['title']; ?></span>
						<br />
						<span class="small"><?php echo $image['info']; ?></span>
					</span>
					<span>
						<a href="?module=albums&amp;page=editimage&amp;var1=<?php echo $var1; ?>&amp;var2=<?php echo $image['seoname']; ?>">
							<img src="data/image/edit.png" title="<?php echo $lang['albums']['edit_image']; ?>" alt="<?php echo $lang['albums']['edit_image']; ?>" />
						</a>
					</span>
					<span>
						<a href="?module=albums&amp;page=imageup&amp;var1=<?php echo $var1; ?>&amp;var2=<?php echo $image['seoname']; ?>">
							<img src="data/image/up.png" title="<?php echo $lang['albums']['change_order']; ?>" alt="<?php echo $lang['albums']['change_order']; ?>" />
						</a>
					</span>
					<span>
						<a href="?module=albums&amp;page=imagedown&amp;var1=<?php echo $var1; ?>&amp;var2=<?php echo $image['seoname']; ?>">
							<img src="data/image/down.png" title="<?php echo $lang['albums']['change_order']; ?>" alt="<?php echo $lang['albums']['change_order']; ?>" />
						</a>
					</span>
					<span>
						<a href="?module=albums&amp;page=deleteimage&amp;var1=<?php echo $var1; ?>&amp;var2=<?php echo $image['seoname']; ?>">
							<img src="data/image/delete_from_trash.png" title="<?php echo $lang['albums']['delete_image']; ?>" alt="<?php echo $lang['albums']['delete_image']; ?>" />
						</a>
					</span>
				</div>
			<?php
		}
		unset($image);
	}
}

/**
 * Displays a list of images in an album. For use on site.
 * @param string $album The album to display the images from.
 */
function albums_site_show_images($album) {
	global $lang;

	if (!file_exists(ALBUMS_DIR.'/'.$album))
		echo '<p>'.$lang['albums']['doesnt_exist'].'</p>';

	else {
		$images = albums_get_images($album);
		if ($images != FALSE) {
			foreach ($images as $image) {
				?>
				<div class="album">
					<table>
						<tr>
							<td>
								<a href="<?php echo SITE_URL; ?>/data/modules/albums/albums_getimage.php?image=<?php echo $album; ?>/<?php echo $image['filename_image']; ?>" rel="lytebox[album]" title="<?php echo $image['title']; ?>">
									<img src="<?php echo SITE_URL; ?>/data/modules/albums/albums_getimage.php?image=<?php echo $album; ?>/thumb/<?php echo $image['filename_image']; ?>" alt="<?php echo $image['title']; ?>" title="<?php echo $image['title']; ?>" />
								</a>
							</td>
							<td>
								<span class="albuminfo"><?php echo $image['title']; ?></span>
								<br />
								<i><?php echo $image['info']; ?></i>
							</td>
						</tr>
					</table>
				</div>
			<?php
			}
			unset($image);
		}
	}
}

/**
 * Gets the filename of the php-config file of an image.
 * @param string $album The album containing the image.
 * @param string $seoname The seoname of the image.
 * @return string The filename.
 */
function albums_get_php_filename($album, $seoname) {
	$files = read_dir_contents(ALBUMS_DIR.'/'.$album, 'files');
	foreach ($files as $file) {
		$parts = explode('.', $file);
		if (count($parts) == 4) {
			list($number, $fdirname, $ext, $php) = $parts;
			if ($seoname == $fdirname && file_exists(ALBUMS_DIR.'/'.$album.'/'.$fdirname.'.'.$ext))
				return $file;
		}
	}
	return false;
}

/**
 * Reorders the images in an album.
 * @param string $album The album in need of reordering.
 */
function albums_reorder_images($album) {
	$images = albums_get_images($album);

	//Only reorder if album contains images.
	if ($images != FALSE) {
		$number = 1;
		foreach ($images as $image) {
			$parts = explode('.', $image['filename']);
			if (isset($parts[3])) {
				rename(ALBUMS_DIR.'/'.$album.'/'.$image['filename'], ALBUMS_DIR.'/'.$album.'/'.$number.'.'.$parts[1].'.'.$parts[2].'.'.$parts[3]);
				$number++;
			}
		}
	}
}
?>
