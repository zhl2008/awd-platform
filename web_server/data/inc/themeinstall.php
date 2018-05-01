<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');
?>
<p>
	<strong><?php echo $lang['theme_install']['message']; ?></strong>
</p>
<div class="menudiv" style="display: inline-block; margin-top: 0;">
	<span>
		<img src="data/image/install.png" alt="" />
	</span>
	<form method="post" action="" enctype="multipart/form-data" style="display: inline-block;">
		<input type="file" name="sendfile" />
		<input type="submit" name="submit" value="<?php echo $lang['general']['upload']; ?>" />
	</form>
</div>
<p>
	<a href="?action=theme" title="<?php echo $lang['general']['back']; ?>">&lt;&lt;&lt; <?php echo $lang['general']['back']; ?></a>
</p>
<?php
if (isset($_POST['submit'])) {
	//If no file has been sent.
	if (!$_FILES['sendfile'])
		echo $lang['general']['upload_failed'];

	else {
		//Some data.
		$dir = 'data/themes'; //Where we will save and extract the file.
		$maxfilesize = 1000000; //Max size of file.
		$filename = $_FILES['sendfile']['name']; //Determine filename.

		//Check if we're dealing with a file with tar.gz or zip in filename.
		if (!strpos($filename, '.tar.gz') && !strpos($filename, '.zip'))
			show_error($lang['general']['not_valid_file'], 1);

		else {
			//Check if file isn't too big.
			if ($_FILES['sendfile']['size'] > $maxfilesize)
				show_error($lang['theme_install']['too_big'], 1, true);

			else {
				//Save theme-file.
				copy($_FILES['sendfile']['tmp_name'], $dir.'/'.$filename) or die ($lang['general']['upload_failed']);
				if (strpos($filename, '.tar.gz')) {
					//Then load the library for extracting the tar.gz-file.
					require_once ('data/inc/lib/tarlib.class.php');

					//Load the tarfile.
					$tar = new TarLib($dir.'/'.$filename);

					//And extract it.
					$tar->Extract(FULL_ARCHIVE, $dir);
					//After extraction: delete the tar.gz-file.
					unlink($dir.'/'.$filename);
				}
				else { //if not tar.gz then this file must be zip
					//Then load the library for extracting the zip-file.
					require_once ('data/inc/lib/unzip.class.php');

					//Load the zipfile.
					$zip=new UnZIP($dir.'/'.$filename);
					//And extract it.
					$zip->extract();

					//After extraction: delete the zip-file.
					unlink($dir.'/'.$filename);

					//If there is a subdirectory like: theme/theme
					$theme = str_replace('.zip', '', $filename);
					if (is_dir('data/themes/'.$theme.'/'.$theme) && file_exists('data/themes/'.$theme.'/'.$theme.'/info.php')) {
						rename('data/themes/'.$theme, 'data/themes/_157#93_');
						rename('data/themes/_157#93_/'.$theme, 'data/themes/'.$theme);
						rmdir('data/themes/_157#93_');
					}
				}
					//Display successmessage.
					//TODO: Use show_error().
					?>
						<div class="menudiv">
							<span>
								<img src="data/image/install.png" alt="" />
							</span>
							<span>
								<span class="kop3"><?php echo $lang['theme_install']['success']; ?></span>
								<br />
								<?php echo $lang['theme_install']['return']; ?>
							</span>
						</div>
					<?php
			}
		}
	}
}
?>
