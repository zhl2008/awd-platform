<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

function contactform_info() {
	global $lang;
	return array(
		'name'          => $lang['contactform']['module_name'],
		'intro'         => $lang['contactform']['module_intro'],
		'version'       => '0.2',
		'website'       => '',
		'icon'          => 'images/contactform.png',
		'compatibility' => '1.9.8'
	);
}
?>
