<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

/**
 * Recursively delete an entire directory.
 *
 * @since 4.6
 * @package all
 * @param string $directory The dir you want to remove.
 * @param bool $empty Should the dir remain empty?
 * @return bool
 */
function recursive_remove_directory($directory, $empty = false)	{
	if (substr($directory, -1) == '/')
		$directory = substr($directory, 0, -1);

	if (!file_exists($directory) || !is_dir($directory))
		return false;

	elseif (is_readable($directory)) {
		$handle = opendir($directory);

		while (false !== ($item = readdir($handle))) {
			if ($item != '.' && $item != '..') {
				$path = $directory.'/'.$item;
				if (is_dir($path))
					recursive_remove_directory($path);
				else
					unlink($path);
			}
		}
		closedir($handle);
		if (!$empty) {
			if (!rmdir($directory))
				return false;
		}
	}
	return true;
}

/**
 * Returns all themes in an array.
 *
 * @since 1.9.8
 * @package all
 * @return array Themes, including title and dir.
 */
function get_themes() {
	$dirs = read_dir_contents('data/themes', 'dirs');
	if ($dirs) {
		natcasesort($dirs);
		foreach ($dirs as $dir) {
			if (file_exists('data/themes/'.$dir.'/info.php')) {
				include_once ('data/themes/'.$dir.'/info.php');
				$themes[] = array(
					'title'   => $themename,
					'dir' => $dir
				);
			}
		}
		return $themes;
	}
	else
		return false;
}

/**
 * Get the site title from the options, and return it.
 *
 * @since 4.6
 * @package all
 * @return string The site title.
 */
function get_sitetitle() {
	if (file_exists('data/settings/options.php')) {
		global $sitetitle;
		return $sitetitle;
	}
}

/**
 * Redirect the user to a given address after a number of seconds.
 *
 * @since 4.6
 * @package all
 * @param string $url The redirect address.
 * @param integer $time The number of seconds before the redirect.
 */
function redirect($url, $time) {
	//Replace &amp; with &.
	$url = str_replace('&amp;', '&', $url);

	//Then, urlencode the entire url.
	$url = urlencode($url);

	//Then undo that for ? chars.
	$url = str_replace('%3F', '?', $url);
	//And undo that for = chars.
	$url = str_replace('%3D', '=', $url);
	//And undo that for & chars.
	$url = str_replace('%26', '&', $url);
	//And undo that for / chars.
	$url = str_replace('%2F', '/', $url);
	//And undo that for : chars.
	$url = str_replace('%3A', ':', $url);

	//Finally generate the metatag for redirecting
	echo '<meta http-equiv="refresh" content="'.$time.'; url='.$url.'" />';
}

/**
 * Read files or directories in a directory, and return the names in an array.
 *
 * @since 4.6
 * @package all
 * @param string $directory The directory where the files are in.
 * @param string $mode Set to 'dirs' or 'files', to return directories or files respectively.
 * @return array The directories or files.
 */
function read_dir_contents($directory, $mode) {
	if (!is_dir($directory))
		return false;

	$path = opendir($directory);
	while (false !== ($file = readdir($path))) {
		if ($file != '.' && $file != '..') {
			if (is_file($directory.'/'.$file))
				$files[] = $file;

			elseif (is_dir($directory.'/'.$file))
				$dirs[] = $file;
		}
	}
	closedir($path);

	if ($mode == 'files' && isset($files))
		return $files;
	elseif ($mode == 'dirs' && isset($dirs))
		return $dirs;
	else
		return false;
}

/**
 * Universal function for saving files.
 *
 * @since 1.9.8
 * @package all
 * @param string $file Full patch to the file.
 * @param mixed $content The data to save. If it's an array, it will create the structure for you.
 * @param int $chmod With leading zero! If set to FALSE, no chmod operation is performed.
 */
function save_file($file, $content, $chmod = 0777) {
	$data = fopen($file, 'w');

	//If it's an array, we have to create the structure.
	if (is_array($content) && !empty($content)) {
		$final_content = '<?php'."\n";
		foreach ($content as $var => $value) {
			$final_content .= '$'.$var.' = \''.$value.'\';'."\n";
		}
		$final_content .= '?>';

		fputs($data, $final_content);
	}

	else
		fputs($data, $content);

	fclose($data);
	if ($chmod != FALSE)
		chmod($file, $chmod);
}

/**
 * Sanitize a variable, to make it ready for saving in a file.
 *
 * @since 1.9.8
 * @package all
 * @param string $var The variable to sanitize.
 * @param boolean $html Should it convert HTML too? Defaults to true.
 * @return string The sanitized variable.
 */
function sanitize($var, $html = true) {
	$var = str_replace('\\', '\\\\', $var);
	$var = str_replace('\'', '\\\'', $var);

	if ($html == true)
		$var = htmlspecialchars($var, ENT_COMPAT, 'UTF-8', false);

	return $var;
}

/**
 * Displays or returns an error, notice or success message.
 *
 * @since 1.9.8
 * @package all
 * @param string $message The message to display.
 * @param integer $level <b>1:</b> error, <b>2:</b> notice and <b>3:</b> success.
 * @param bool $return Should it return the error?
 * @return string <b>NOTE:</b> Only returns when $return is true.
 */
function show_error($message, $level, $return = false) {
	switch ($level) {
		case 1:
			$class = 'error';
			break;
		case 2:
			$class = 'notice';
			break;
		case 3:
			$class = 'success';
			break;
		default:
			$class = 'notice';
	}

	$value = '<div class="'.$class.'">'.$message.'</div>';

	if ($return == true)
		return $value;
	else
		echo $value;
}

/**
 * Convert a given string to a SEO safe URL.
 *
 * @since 1.9.8
 * @package all
 * @param string $url String to convert to a SEO URL.
 * @return string A SEO safe URL.
 */
function seo_url($url) {
	require ('data/inc/lib/url_replace.php');
	//replace some non-ASCII international characters with their ASCII substitute
	$url = strtr($url, $lang_url_replace);
	//replace all sequences of characters that would have to be urlencoded (incl. "-" and ".", excl. intl. chars) to a single "-"
	$url = preg_replace('/[^0-9A-Za-z_\x80-\xFF]+/', '-', $url);
	//remove "-" from the beginning and end of the string
	$url = trim($url, '-');
	//only use lower case
	$url = strtolower($url);

	return $url;
}

/**
 * Get the seoname of a page.
 *
 * @since 1.9.8
 * @package all
 * @param string $filename The filename
 * @return string The seoname
 */
function get_page_seoname($filename) {
	//Remove PAGE_DIR from the filename, if present.
	if (strpos($filename, PAGE_DIR.'/') === 0) $filename = substr($filename, strlen(PAGE_DIR) + 1);

	if (file_exists(PAGE_DIR . '/' . $filename)) {
		$seoname = explode('.', basename($filename));
		if (isset($seoname[1])) {
			$pos = strrpos($filename, '/');
			if ($pos !== false) {
				return substr($filename, 0, $pos) . '/' . $seoname[1];
			} else {
				return $seoname[1];
			}
		}
	}

	return false;
}

/**
 * Get the filename of a page.
 *
 * @since 1.9.8
 * @package all
 * @param string $seoname The seoname
 * @return string The filename
 */
function get_page_filename($seoname) {
	//Remove PAGE_DIR from the seoname, if present.
	if (strpos($seoname, PAGE_DIR.'/') === 0) $seoname = substr($seoname, strlen(PAGE_DIR) + 1);

	$path = '';
	$pos = strrpos($seoname, '/');
	if ($pos !== false) {
		$path = substr($seoname, 0, $pos);
	}

	//Read the pages.
	$pages = read_dir_contents(PAGE_DIR . '/' . $path, 'files');

	//Are there any pages?
	if ($pages != false) {
		$page = basename($seoname);
		foreach ($pages as $filename) {
			if (strpos($filename, '.' . $page . '.')) {
				return ($path != '' ? $path . '/' : '') . $filename;
			}
		}
	}

	return false;
}

/**
 * Get the parent directory a sub page is located in.
 *
 * @since 1.9.8
 * @package all
 * @param string $page The page seoname.
 * @return string The parent directory (full location, eg. 'home/about/pricing').
 */
function get_sub_page_dir($page) {
	//Don't do anything if it's not a sub-page.
	$pos = strrpos($page, '/');
	if ($pos !== false && file_exists(PAGE_DIR.'/'.get_page_filename($page))) {
		return substr($page, 0, $pos);
	}

	return false;
}

function link_database() {
	@$db = new mysqli('localhost','username','password','news');

	if($db->connect_errno) {
		echo "Error: Could not connect to database.Please try again later.";
		exit;
	} else{
		return $db;
	}

}

/**
 * Get the parents of a page. NOTE: does not check if pages actually exist.
 *
 * @since 1.9.8
 * @package all
 * @param string $seoname The seoname of the page.
 * @return array Seonames of parents, in an array. If $seoname doesn't have parents (if it is a top page), return FALSE.
 */
function get_page_parents($seoname) {
	if (strpos($seoname, '/') !== false && file_exists(PAGE_DIR.'/'.get_page_filename($seoname))) {
		$parents = preg_split('|\/|', $seoname);
		unset($parents[count($parents)-1]);
		return $parents;
	}
	else
		return false;
}
?>
