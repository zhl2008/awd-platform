<?php 


// Setup inclusions
$load['plugin'] = true;

// Include common.php
include('inc/common.php');

$autoSaveDraft = false; // auto save to autosave drafts

// check form referrer - needs siteurl and edit.php in it. 
if (isset($_SERVER['HTTP_REFERER'])) {
	if ( !(strpos(str_replace('http://www.', '', $SITEURL), $_SERVER['HTTP_REFERER']) === false) || !(strpos("edit.php", $_SERVER['HTTP_REFERER']) === false)) {
		echo "<b>Invalid Referer</b><br />-------<br />"; 
		echo 'Invalid Referer: ' . htmlentities($_SERVER['HTTP_REFERER'], ENT_QUOTES);
		die('Invalid Referer');
	}
}


	
if (isset($_POST['submitted'])) {

	$existingurl = isset($_POST['existing-url']) ? $_POST['existing-url'] : null;
	
	// check for csrf
	if (!defined('GSNOCSRF') || (GSNOCSRF == FALSE) ) {
		$nonce = $_POST['nonce'];
		if(!check_nonce($nonce, "edit", "edit.php")) {
			die("CSRF detected!");	
		}
	}
	
	if ( trim($_POST['post-title']) == '' )	{
		redirect("edit.php?upd=edit-error&type=".urlencode(i18n_r('CANNOT_SAVE_EMPTY')));
	}	else {
		
		$url="";$title="";$metad=""; $metak="";	$cont="";
		
		// is a slug provided?
		if ($_POST['post-id']) { 
			$url = trim($_POST['post-id']);
			if (isset($i18n['TRANSLITERATION']) && is_array($translit=$i18n['TRANSLITERATION']) && count($translit>0)) {
				$url = str_replace(array_keys($translit),array_values($translit),$url);
			}
			$url = to7bit($url, "UTF-8");
			$url = clean_url($url); //old way
		} else {
			if ($_POST['post-title'])	{ 
				$url = trim($_POST['post-title']);
				if (isset($i18n['TRANSLITERATION']) && is_array($translit=$i18n['TRANSLITERATION']) && count($translit>0)) {
					$url = str_replace(array_keys($translit),array_values($translit),$url);
				}
				$url = to7bit($url, "UTF-8");
				$url = clean_url($url); //old way
			} else {
				$url = "temp";
			}
		}
	
	
		//check again to see if the URL is empty
		if ( trim($url) == '' )	{
			$url = 'temp';
		}
		
		
		// was the slug changed on an existing page?
		if ( isset($existingurl) ) {
			if ($_POST['post-id'] != $existingurl){
				// dont change the index page's slug
				if ($existingurl == 'index') {
					$url = $existingurl;
					redirect("edit.php?id=". urlencode($existingurl) ."&upd=edit-index&type=edit");
				} else {
					exec_action('changedata-updateslug');
					updateSlugs($existingurl);
					$file = GSDATAPAGESPATH . $url .".xml";
					$existing = GSDATAPAGESPATH . $existingurl .".xml";
					$bakfile = GSBACKUPSPATH."pages/". $existingurl .".bak.xml";
					copy($existing, $bakfile);
					unlink($existing);
				} 
			} 
		}
		
		$file = GSDATAPAGESPATH . $url .".xml";
		
		// format and clean the responses
		if(isset($_POST['post-title'])) 			{	$title = var_out(xss_clean($_POST['post-title']));	}
		if(isset($_POST['post-metak'])) 			{	$metak = safe_slash_html(strip_tags($_POST['post-metak']));	}
		if(isset($_POST['post-metad'])) 			{	$metad = safe_slash_html(strip_tags($_POST['post-metad']));	}
		if(isset($_POST['post-author'])) 			{	$author = safe_slash_html($_POST['post-author']);	}
		if(isset($_POST['post-template'])) 		{ $template = $_POST['post-template']; }
		if(isset($_POST['post-parent'])) 			{ $parent = $_POST['post-parent']; }
		if(isset($_POST['post-menu'])) 				{ $menu = var_out(xss_clean($_POST['post-menu'])); }
		if(isset($_POST['post-menu-enable'])) { $menuStatus = "Y"; } else { $menuStatus = ""; }
		if(isset($_POST['post-private']) ) 		{ $private = safe_slash_html($_POST['post-private']); }
		if(isset($_POST['post-content'])) 		{	$content = safe_slash_html($_POST['post-content']);	}
		if(isset($_POST['post-menu-order'])) 	{ 
			if (is_numeric($_POST['post-menu-order'])) 
			{
				$menuOrder = $_POST['post-menu-order']; 
			} 
			else 
			{
				$menuOrder = "0";
			}
		}		
		// If saving a new file do not overwrite existing, get next incremental filename, file-count.xml
		// @todo this is a mess, new file existing file should all be determined at beginning of block and defined
		if ( (file_exists($file) && $url != $existingurl) ||  in_array($url,$reservedSlugs) ) {
			$count = "1";
			$file = GSDATAPAGESPATH . $url ."-".$count.".xml";
			while ( file_exists($file) ) {
				$count++;
				$file = GSDATAPAGESPATH . $url ."-".$count.".xml";
			}
			$url = $url .'-'. $count;
		}

		
		// if we are editing an existing page, create a backup
		if ( file_exists($file) ) 
		{
			$bakfile = GSBACKUPSPATH."pages/". $url .".bak.xml";
			copy($file, $bakfile);
		}
		
		
		$xml = new SimpleXMLExtended('<?xml version="1.0" encoding="UTF-8"?><item></item>');
		$xml->addChild('pubDate', date('r'));

		$note = $xml->addChild('title');
		$note->addCData($title);
		
		$note = $xml->addChild('url');
		$note->addCData($url);
		
		$note = $xml->addChild('meta');
		$note->addCData($metak);
		
		$note = $xml->addChild('metad');
		$note->addCData($metad);
		
		$note = $xml->addChild('menu');
		$note->addCData($menu);
		
		$note = $xml->addChild('menuOrder');
		$note->addCData($menuOrder);
		
		$note = $xml->addChild('menuStatus');
		$note->addCData($menuStatus);
		
		$note = $xml->addChild('template');
		$note->addCData($template);
		
		$note = $xml->addChild('parent');
		$note->addCData($parent);
		
		$note = $xml->addChild('content');
		$note->addCData($content);
		
		$note = $xml->addChild('private');
		$note->addCData($private);
		
		$note = $xml->addChild('author');
		$note->addCData($author);

		exec_action('changedata-save');
		if (isset($_POST['autosave']) && $_POST['autosave'] == 'true' && $autoSaveDraft == true) {
			$status = XMLsave($xml, GSAUTOSAVEPATH.$url);
		} else {
			$status = XMLsave($xml, $file);
		}
		
		//ending actions
		exec_action('changedata-aftersave');
		generate_sitemap();
		
		// redirect user back to edit page 
		if (isset($_POST['autosave']) && $_POST['autosave'] == 'true') {
			echo $status ? 'OK' : 'ERROR';
		} else {

			if(!$status) redirect("edit.php?id=". $url ."&upd=edit-error&type=edit"); 

			if ($_POST['redirectto']!='') {
				$redirect_url = $_POST['redirectto'];
			} else {
				$redirect_url = 'edit.php';
			}
			
			if(isset($existingurl)){
				if ($url == $existingurl) {
					// redirect save new file
					redirect($redirect_url."?id=". $url ."&upd=edit-success&type=edit");
				} else {
					// redirect new slug, undo for old slug
					redirect($redirect_url."?id=". $url ."&old=".$existingurl."&upd=edit-success&type=edit");
				}
			}	
			else {
				// redirect new slug
				redirect($redirect_url."?id=". $url ."&upd=edit-success&type=new"); 
			}
		}
	}
} else {
	redirect('pages.php');
}