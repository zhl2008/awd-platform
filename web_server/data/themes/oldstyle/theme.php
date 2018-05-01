<?php 
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!'); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php theme_meta(); ?>
</head>

<body>
<div class="head">
	<div class="header">
		<div class="headerkop"><?php theme_sitetitle(); ?></div>
		<div class="menu">
			<?php theme_menu('ul', 'li', 'active', 0); ?>
		</div>
	</div>

	<div class="content">
		<div class="submenu">
				<?php theme_menu('ul', 'li', 'active', 1, true); ?>
		</div>
		<div class="kop"><?php theme_pagetitle(); ?></div>
		<div class="txt">
			<?php theme_content(); ?>
			<?php theme_area('main'); ?>
		</div>
		<div style="clear: both;"> </div>
		<div class="footer">
			<?php theme_area('footer'); ?>
			>> <a href="<?php echo SITE_URL; ?>/login.php">admin</a>
			<br />powered by <a href="">HeartSky&anmp;c014</a>
		</div>
	</div>
</div>
</body>
</html>
