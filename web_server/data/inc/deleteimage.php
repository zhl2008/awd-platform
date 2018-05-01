<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

//Check if image exists.
if (file_exists('images/'.$var1)) {
	// Delete images
	unlink('images/'.$var1);

	//Redirect user.
	show_error($lang['trashcan']['moving_item'], 3);
	redirect('?action=images', 0);
}
?>
