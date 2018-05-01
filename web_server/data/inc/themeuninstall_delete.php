<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

//Check if we defined a module to uninstall
if (isset($var1))
	recursive_remove_directory('data/themes/'.$var1);
 
redirect('?action=themeuninstall', 0);
?>
