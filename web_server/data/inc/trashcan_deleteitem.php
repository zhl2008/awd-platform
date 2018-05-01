<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

//Page
if ($var2 == 'page' && file_exists('data/trash/pages/'.$var1.'.php'))
	unlink('data/trash/pages/'.$var1.'.php');

//Image
if ($var2 == 'image' && file_exists('data/trash/images/'.$var1))
	unlink('data/trash/images/'.$var1);

//File
if ($var2 == 'file' && file_exists('data/trash/files/'.$var1))
	unlink('data/trash/files/'.$var1);

//Redirect
show_error($lang['trashcan']['deleting'], 3);
redirect('?action=trashcan', 0);
?>
