<?php


# Setup inclusions
$load['plugin'] = true;

ob_start();
include('inc/common.php');

# end it all :'(
kill_cookie($cookie_name);
exec_action('logout');

# send back to login screen
redirect('index.php?logout');
ob_end_flush();

?>