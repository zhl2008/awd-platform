<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

//Check if we defined a module to uninstall
if (isset($var1)) {
	// recursive_remove_directory('data/modules/'.$var1);
	show_error($lang['general']['404'], 1);
}
 
redirect('?action=managemodules', 0);
?>
