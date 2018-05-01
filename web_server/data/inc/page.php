<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');
?>
<p>
	<strong><?php echo $lang['page']['message']; ?></strong>
</p>
<?php
//Run hook.
run_hook('admin_pages_before');
//New page button.
showmenudiv($lang['page']['new'], null, 'data/image/newpage.png', '?action=editpage');
//Manage images button.
showmenudiv($lang['images']['title'], null, 'data/image/image.png', '?action=images');
//Manage files button.
showmenudiv($lang['files']['title'], null, 'data/image/file.png', '?action=files');

//Show pages.
$pages = get_pages();

if ($pages) {
	foreach ($pages as $page)
		show_page_box($page);
	unset($page);
}
?>
