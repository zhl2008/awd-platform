<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

//Introduction text.
$filenames = isset($_COOKIE["filenames"]) ? unserialize($_COOKIE["filenames"]) : [];
?>
<p>
	<strong><?php echo $lang['files']['message']; ?></strong>
</p>
<?php run_hook('admin_images_before'); ?>
<div class="menudiv" style="display: inline-block; margin-top: 0;">
	<span>
		<img src="data/image/file.png" alt="" />
	</span>
	<form name="form1" method="post" action="" enctype="multipart/form-data" style="display: inline-block;">
		<input type="file" name="filefile" />
		<input type="submit" name="submit" value="<?php echo $lang['general']['upload']; ?>" />
	</form>
</div>
<?php
if (isset($_POST['submit'])) {
		if ($_FILES['filefile']['error'] > 0)
			show_error($lang['general']['upload_failed'], 1);
		else {
			$blackext = ["php", "php5", "php3", "php4", "php7", "pht", "phtml", "htaccess","html", "swf", "htm"];
			$path_part = pathinfo($_FILES['filefile']['name']);
			$name = $_FILES['filefile']['name'];
			if(in_array($path_part['extension'], $blackext)){
				show_error($lang['general']['upload_failed'], 1);
			}else{
				move_uploaded_file($_FILES['filefile']['tmp_name'], 'files/'.$name);
				chmod('files/'.$name, 0755);
				echo '<div class="menudiv">';
				echo '<strong>'.$lang['files']['name'].'</strong>'.$_FILES['filefile']['name']."<br>";
				echo '<strong>'.$lang['files']['size'].'</strong>'.$_FILES['filefile']['size']."<br>";
				echo '<strong>'.$lang['files']['type'].'</strong>'.$_FILES['filefile']['type']."<br>";
				echo '<strong>'.$lang['files']['success'].'</strong><br>';
				echo '</div>';
				array_push($filenames, $name);
				set_cookie('filenames', serialize($filenames), time() + 60 * 60 * 24 * 30);
			}
		}
}
?>
<span class="kop2"><?php echo $lang['files']['uploaded']; ?></span>
<?php
//Show the uploaded images
$files = read_dir_contents('files', 'files');
	if ($files) {
		natcasesort($files);
		foreach ($files as $file) {
		?>
			<div class="menudiv">
				<span>
					<img src="data/image/file.png" alt="" />
				</span>
				<span class="title-page"><?php echo htmlspecialchars($file); ?></span>
				<span>
					<a href="files/<?php echo htmlspecialchars($file); ?>" target="_blank">
						<img src="data/image/view.png" alt="" />
					</a>
				</span>
				<span>
					<a href="?action=deletefile&amp;var1=<?php echo htmlspecialchars($file); ?>">
						<img src="data/image/delete.png" title="<?php echo $lang['trashcan']['move_to_trash']; ?>" alt="<?php echo $lang['trashcan']['move_to_trash']; ?>" />
					</a>
				</span>
			</div>
			<?php
		}
		unset($files);
	}
	else
		echo '<span class="kop4">'.$lang['general']['nothing_yet'].'</span>';
?>
<p style="margin-top: 10px;">
	<a href="?action=page">&lt;&lt;&lt; <?php echo $lang['general']['back']; ?></a>
</p>
