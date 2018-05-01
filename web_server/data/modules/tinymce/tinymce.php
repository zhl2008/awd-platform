<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

//Define dir constant
define('TINYMCE_DIR', 'data/modules/tinymce/lib');
//Define constant to add tinymce-class to textareas
define('WYSIWYG_TEXTAREA_CLASS', 'tinymce');

//Require functions
require_once ('data/modules/tinymce/functions.php');

function tinymce_info() {
	global $lang;
	return array(
		'name'          => $lang['tinymce']['module_name'],
		'intro'         => $lang['tinymce']['module_intro'],
		'version'       => '3.5.11',
		'website'       => '',
		'icon'          => 'images/tinymce.png',
		'compatibility' => '1.9.8'
	);
}

function tinymce_admin_head_main() {
	//Display main code.
	tinymce_display_code(); ?>
	<script type="text/javascript">
	<!--
	function insert_page_link() {
	var id = document.getElementById('insert_pages');
	var page = id.selectedIndex;
	var file = id.options[page].value;
	var title = id.options[page].text;

	//Remove indent space.
	//@fixme Not the best way to do it, but it works.
	title = escape(title);
	title = title.replace(/%u2003/g, '');
	title = title.replace(/%A0/g, '');
	title = unescape(title);

	tinyMCE.execCommand('mceInsertContent', false, '<a href="?file=' + file + '" title="' + title + '">' + title + '<\/a>');
	}
	function insert_file_link(dir) {
	var id = document.getElementById('insert_files');
	var sel_opt = id.selectedIndex;
	var file = id.options[sel_opt].value;
	var title = id.options[sel_opt].text;

	//Remove indent space.
	//@fixme Not the best way to do it, but it works.
	title = escape(title);
	title = title.replace(/%u2003/g, '');
	title = title.replace(/%A0/g, '');
	title = unescape(title);

	tinyMCE.execCommand('mceInsertContent', false, '<a href="' + dir + '/' + file + '" title="' + title + '">' + title + '<\/a>');
	}

	function insert_image_link(dir) {
	var id = document.getElementById('insert_images');
	var image = id.selectedIndex;
	var file = id.options[image].text;

	tinyMCE.execCommand('mceInsertContent', false, '<img src="' + dir + '/' + file + '" alt="" \/>');
	}

	function insert_module(dir) {
	var id = document.getElementById('insert_modules');
	var module = id.selectedIndex;
	var code = id.options[module].value;

	tinyMCE.execCommand('mceInsertContent', false, '<div class="module_' + code.replace(' ', '_') + '">{EasyCMS show_module(' + code + ')}</div>');
	}
	</script>
	<?php
}
?>
