<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

if ($var2 == 'page' && file_exists('data/trash/pages/'.$var1.'.php')) {
	include ('data/trash/pages/'.$var1.'.php');
	?>
		<div class="menudiv" style="padding: 15px; margin: 25px;">
			<span class="kop2"><?php echo $title; ?></span>
			<br />
			<?php echo $content; ?>
		</div>
	<?php
}

if ($var2 == 'image' && file_exists('data/trash/images/'.$var1)) {
?>
	<img src="data/trash/images/<?php echo $var1; ?>" alt="" />
<?php
}
if ($var2 == 'file' && file_exists('data/trash/files/'.$var1)) {
?>
	<a href="data/trash/files/<?php echo $var1; ?>" alt="" />Download</a>
<?php
}
?>
<p>
	<a href="?action=trashcan">&lt;&lt;&lt; <?php echo $lang['general']['back']; ?></a>
</p>
