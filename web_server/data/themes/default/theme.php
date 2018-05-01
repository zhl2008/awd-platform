<?php 
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo LANG; ?>">
<head>
<?php theme_meta(true); ?>
</head>
<body>
<div id="container">
	<div id="header">
		<h1 title="<?php theme_sitetitle(); ?>"><?php theme_sitetitle(); ?></h1>
		<?php theme_menu('ul', 'li', 'active', 1); ?>
	</div>
	<div id="content">
		<h2 title="<?php theme_pagetitle(); ?>"><?php theme_pagetitle(); ?></h2>
		<?php theme_content(); ?>
		<?php theme_area('main'); ?>
	</div>
	<div id="footer">
		<?php theme_area('footer'); ?>
		<a href="<?php echo SITE_URL; ?>/login.php">admin</a> | powered by HeartSky&anmp;c014</a>
	</div>
</div>
</body>
</html>
