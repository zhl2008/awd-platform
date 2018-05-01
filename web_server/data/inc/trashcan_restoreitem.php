<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

//If we want to restore a page.
if ($var2 == 'page' && file_exists('data/trash/pages/'.$var1.'.php')) {

	//We can't restore the page if there is a page with the same name.
	if (get_page_filename($var1) != false) {
		show_error($lang['trashcan']['same_page_name'], 1);
		redirect('?action=trashcan', 3);
	}

	else {
		$pages = read_dir_contents(PAGE_DIR, 'files');

		if ($pages == false)
			$next_number = 1;
		else
			$next_number = count($pages) + 1;

		rename('data/trash/pages/'.$var1.'.php', PAGE_DIR.'/'.$next_number.'.'.$var1.'.php');

		//Redirect.
		show_error($lang['trashcan']['restoring'], 3);
		redirect('?action=trashcan', 1);
	}
}

//If we want to restore an file.
elseif ($var2 == 'file' && file_exists('data/trash/files/'.$var1)) {
	//First check if there isn't an image with the same name.
	if (!file_exists('files/'.$var1)) {
		copy('data/trash/files/'.$var1, 'files/'.$var1);
		chmod('files/'.$var1, 0777);
		unlink('data/trash/files/'.$var1);
	}

	//If there already is an image with the same name.
	else {
		list($filename, $extension) = explode('.', $var1);
		$filename = $filename.'_copy';
		copy('data/trash/files/'.$var1, 'files/'.$filename.'.'.$extension);
		chmod('files/'.$filename.'.'.$extension, 0777);
		unlink('data/trash/files/'.$var1);
	}

	//Redirect.
	show_error($lang['trashcan']['restoring'], 3);
	redirect('?action=trashcan', 1);
}
//If we want to restore an image.
elseif ($var2 == 'image' && file_exists('data/trash/images/'.$var1)) {
	//First check if there isn't an image with the same name.
	if (!file_exists('images/'.$var1)) {
		copy('data/trash/images/'.$var1, 'images/'.$var1);
		chmod('images/'.$var1, 0777);
		unlink('data/trash/images/'.$var1);
	}

	//If there already is an image with the same name.
	else {
		list($filename, $extension) = explode('.', $var1);
		$filename = $filename.'_copy';
		copy('data/trash/images/'.$var1, 'images/'.$filename.'.'.$extension);
		chmod('images/'.$filename.'.'.$extension, 0777);
		unlink('data/trash/images/'.$var1);
	}

	//Redirect.
	show_error($lang['trashcan']['restoring'], 3);
	redirect('?action=trashcan', 1);
}
?>
