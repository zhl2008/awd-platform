<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

//Introduction text.
?>
<p>
	<strong><?php echo $lang['images']['message']; ?></strong>
</p>
<?php run_hook('admin_images_before'); ?>
<div class="menudiv" style="display: inline-block; margin-top: 0;">
	<span>
		<img src="data/image/image.png" alt="" />
	</span>
	<form name="form1" method="post" action="" enctype="multipart/form-data" style="display: inline-block;">
		<input type="file" name="imagefile" />
		<input type="submit" name="submit" value="<?php echo $lang['general']['upload']; ?>" />
	</form>
</div>
<?php
if (isset($_POST['submit'])) {
	//Check if the file is JPG, PNG or GIF.
	if (in_array($_FILES['imagefile']['type'], array('image/pjpeg', 'image/jpeg','image/png', 'image/gif'))) {
		if ($_FILES['imagefile']['error'] > 0)
			show_error($lang['general']['upload_failed'], 1);
		else {
			move_uploaded_file($_FILES['imagefile']['tmp_name'], 'images/'.$_FILES['imagefile']['name']);
			chmod('images/'.$_FILES['imagefile']['name'], 0666);
			?>
				<div class="menudiv">
					<strong><?php echo $lang['images']['name']; ?></strong> <?php echo $_FILES['imagefile']['name']; ?>
					<br />
					<strong><?php echo $lang['images']['size']; ?></strong> <?php echo $_FILES['imagefile']['size'].' '.$lang['images']['bytes']; ?>
					<br />
					<strong><?php echo $lang['images']['type']; ?></strong> <?php echo $_FILES['imagefile']['type']; ?>
					<br />
					<strong><?php echo $lang['images']['success']; //TODO: Need to show this message another place, and with show_error(). ?></strong>
				</div>
			<?php
		}
	}
}

//Display list of uploaded pictures.
?>
<span class="kop2"><?php echo $lang['images']['uploaded']; ?></span>
<?php
//Show the uploaded images
$images = read_dir_contents('images', 'files');
	if ($images) {
		natcasesort($images);
		foreach ($images as $image) {
		?>
			<div class="menudiv">
				<span>
					<img src="data/image/image.png" alt="" />
				</span>
				<span class="title-page"><?php echo htmlspecialchars($image); ?></span>
				<span>
					<a href="images/<?php echo htmlspecialchars($image); ?>" target="_blank">
						<img src="data/image/view.png" alt="" />
					</a>
				</span>
				<span>
					<a href="?action=deleteimage&amp;var1=<?php echo htmlspecialchars($image); ?>">
						<img src="data/image/delete.png" title="<?php echo $lang['trashcan']['move_to_trash']; ?>" alt="<?php echo $lang['trashcan']['move_to_trash']; ?>" />
					</a>
				</span>
			</div>
			<?php
		}
		unset($images);
	}
	else
		echo '<span class="kop4">'.$lang['general']['nothing_yet'].'</span>';
?>
<p style="margin-top: 10px;">
	<a href="?action=page">&lt;&lt;&lt; <?php echo $lang['general']['back']; ?></a>
</p>
