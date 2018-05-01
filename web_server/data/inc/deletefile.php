<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

if($var1 !== 'upload.php') {
	//Check if image exists.
	if (file_exists('files/'.$var1)) {
		// Delete files
		unlink('files/'.$var1);
		
		//Redirect user.
		show_error($lang['trashcan']['moving_item'], 3);
		redirect('?action=files', 0);
	}
}
else {
	show_error($lang['general']['404'], 1);
}
?>
