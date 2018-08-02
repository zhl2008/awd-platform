<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }

function Innovation_Parent_Link($name) {
	$file = GSDATAPAGESPATH . $name .'.xml';
	if (file_exists($file)) {
		$p = getXML($file);
		$title = $p->title;
		$parent = $p->parent;
		$slug = $p->slug;
		echo '<a href="'. find_url($name,'') .'">'. $title .'</a> &nbsp;&nbsp;&#149;&nbsp;&nbsp; ';
	}
}

/**
 * Innovation Settings
 *
 * This defines variables based on the theme plugin's settings
 *
 * @return bool
 */
function Innovation_Settings() {
	$file = GSDATAOTHERPATH . 'InnovationSettings.xml';
	if (file_exists($file)) {
		$p = getXML($file);
		return $p;
	} else {
		return false;
	}
}
