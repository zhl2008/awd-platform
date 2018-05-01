<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

//Images
recursive_remove_directory('data/trash/images', true);

//Pages
recursive_remove_directory('data/trash/pages', true);

//Redirect
redirect('?action=trashcan', 0);
?>
