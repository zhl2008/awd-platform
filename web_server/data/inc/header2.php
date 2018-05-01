<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

//First set character encoding.
header('Content-Type:text/html;charset=utf-8');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo LANG; ?>" lang="<?php echo LANG; ?>">
<head>
<title>EasyCMS <?php echo VERSION; ?> - <?php echo $titelkop; ?></title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<?php
if (DIRECTION_RTL) {
	echo '<link href="data/styleadmin-rtl.css" rel="stylesheet" type="text/css" media="screen" />';
}
else {
	echo '<link href="data/styleadmin.css" rel="stylesheet" type="text/css" media="screen" />';
}

//Include TinyMCE, but not on the login page.
if (!strpos($_SERVER['SCRIPT_FILENAME'], 'login.php') && file_exists('data/modules/tinymce')) {
	require_once ('data/modules/tinymce/tinymce.php');
	tinymce_display_code();
}
?>
<link rel="icon" type="image/vnd.microsoft.icon" href="data/image/favicon.ico" />
<meta name="robots" content="noindex" />
<script type="text/javascript">
function refresh() {
	window.location.reload(false);
}
</script>
</head>

<body>
<div id="menuheader">
	<h1>EasyCMS</h1>
	<ul id="menu2">
		<li><?php echo $titelkop; ?></li>
	</ul>
</div>
<div id="content">
