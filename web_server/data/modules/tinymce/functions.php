<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

function tinymce_display_code() { ?>
	<script type="text/javascript" src="<?php echo TINYMCE_DIR; ?>/tiny_mce.js"></script>
	<?php run_hook('tinymce_scripts'); ?>
	<script type="text/javascript">
	//<![CDATA[
	tinyMCE.init({
		mode : "textareas",
		editor_selector : "tinymce",
		entity_encoding : "raw",
		<?php
		//Check if we need to set the direction to rtl.
		if (DIRECTION_RTL)
			echo 'directionality : "rtl",'."\n";
		//Set the language
		if (file_exists(TINYMCE_DIR.'/langs/'.LANG.'.js'))
			echo 'language : "'.LANG.'",'."\n";
		else
			echo 'language : "en",'."\n";
		?>
		theme : "advanced",
		width : "600px",
		plugins : "table,media,paste,safari<?php run_hook('tinymce_plugins'); ?>",
		<?php run_hook('tinymce_options'); ?>
		<?php
		$buttons = array(
			'bold', 'italic', 'underline', 'strikethrough', 
			'separator', 'justifyleft', 'justifycenter', 'justifyright', 'justifyfull',
			'separator', 'formatselect', 'fontsizeselect'
		);
		run_hook('tinymce_buttons1', array(&$buttons));
		$number = count($buttons);
		?>
		theme_advanced_buttons1 : "<?php foreach ($buttons as $key => $button) {echo $button; if (($number - 1) != $key) echo ',';}?>",
		<?php
		$buttons = array(
			'cut', 'copy', 'paste', 'pastetext', 'pasteword',
			'separator', 'undo', 'redo',
			'separator', 'bullist', 'numlist', 'outdent', 'indent',
			'separator', 'link', 'unlink', 'anchor', 'image', 'media',
			'separator', 'table', 'hr', 'forecolor', 'backcolor',
			'separator', 'code', 'cleanup'
		);
		run_hook('tinymce_buttons2', array(&$buttons));
		$number = count($buttons);
		?>
		theme_advanced_buttons2 : "<?php foreach ($buttons as $key => $button) {echo $button; if (($number - 1) != $key) echo ',';}?>",
		<?php
		$buttons = array();
		run_hook('tinymce_buttons3', array(&$buttons));
		$number = count($buttons);
		?>
		theme_advanced_buttons3 : "<?php foreach ($buttons as $key => $button) {echo $button; if (($number - 1) != $key) echo ',';}?>",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_path_location : "bottom",
		theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : false
	})
	//]]>
	</script>
	<?php
}
?>
