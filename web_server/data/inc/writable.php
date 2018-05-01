<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');
?>

	<p>
		<strong><?php echo $lang['writable']['check']; ?></strong>
	</p>
	<?php
		//Writable checks.
		foreach (array('images', 'files', 'data/modules', 'data/trash', 'data/themes', 'data/themes/default', 'data/themes/oldstyle', 'data/settings', 'data/settings/langpref.php') as $check)
			check_writable($check);
		unset($check);
	?>
	<p>
		<a href="javascript:refresh()"><?php echo $lang['install']['refresh']; ?></a>
	</p>
