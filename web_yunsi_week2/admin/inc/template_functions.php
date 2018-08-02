<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }

	
	
/**
 * Get Template
 *
 * @since 1.0
 *
 * @param string $name Name of template file to get
 * @param string $title Title to place on page
 * @return string
 */
function get_template($name, $title='** Change Me - Default Page Title **') {
	ob_start();
	$file = "template/" . $name . ".php";
	include($file);
	$template = ob_get_contents();
	ob_end_clean(); 
	echo $template;
}

/**
 * Filename ID
 *
 * Generates HTML code to place on the body tag of a page
 *
 * @since 1.0
 * @uses myself
 *
 * @return string
 */
function filename_id() {
	$path = myself(FALSE);
	$file = basename($path,".php");	
	echo "id=\"". $file ."\"";	
}

/**
 * Get Filename ID
 *
 * Returns the filename of the current file, minus .php
 *
 * @since 1.0
 * @uses myself
 *
 * @return string
 */
function get_filename_id() {
	$path = myself(FALSE);
	$file = basename($path,".php");	
	return $file;	
}

/**
 * Delete Pages File
 *
 * Deletes pages data file afer making backup
 *
 * @since 1.0
 * @uses GSBACKUPSPATH
 * @uses GSDATAPAGESPATH
 *
 * @param string $id File ID to delete
 */
function delete_file($id) {

	$bakfilepath = GSBACKUPSPATH . 'pages' . DIRECTORY_SEPARATOR;
	$bakfile = $bakfilepath . $id .'.bak.xml';

	$filepath = GSDATAPAGESPATH;
	$file = $filepath . $id .'.xml';

	if(filepath_is_safe($file,$filepath)){
		$successbak = copy($file, $bakfile);
		$successdel = unlink($file);
		if($successdel && $successbak) return 'success';
	}
	return 'error';
}

/**
 * Check Permissions
 *
 * Returns the CHMOD value of a particular file or path
 *
 * @since 2.0
 *
 * @param string $path File and/or path
 */
function check_perms($path) { 
  clearstatcache(); 
  $configmod = substr(sprintf('%o', fileperms($path)), -4);  
	return $configmod;
} 

/**
 * Delete Zip File
 *
 * @since 1.0
 * @uses GSBACKUPSPATH
 *
 * @param string $id Zip filename to delete
 * @return string
 */
function delete_zip($id) { 
	$filepath = GSBACKUPSPATH . 'zip' . DIRECTORY_SEPARATOR;
	$file = $filepath . $id;

	if(filepath_is_safe($file,$filepath)){
		$success =  unlink($file);
		if($success) return 'success';
	}
	return 'error';
} 

/**
 * Delete Uploaded File
 *
 * @since 1.0
 * @uses GSTHUMBNAILPATH
 * @uses GSDATAUPLOADPATH
 *
 * @param string $id Uploaded filename to delete
 * @param string $path Path to uploaded file folder
 * @return string
 */
function delete_upload($id, $path = "") { 
	$filepath = GSDATAUPLOADPATH . $path;
	$file =  $filepath . $id;

	if(path_is_safe($filepath,GSDATAUPLOADPATH) && filepath_is_safe($file,$filepath)){
		$status = unlink(GSDATAUPLOADPATH . $path . $id);
		if (file_exists(GSTHUMBNAILPATH.$path."thumbnail.". $id)) {
			unlink(GSTHUMBNAILPATH.$path."thumbnail.". $id);
		}
		if (file_exists(GSTHUMBNAILPATH.$path."thumbsm.". $id)) {
			unlink(GSTHUMBNAILPATH.$path."thumbsm.". $id);
		}
		if($status) return 'success';
	}	

	return 'error';
} 

/**
 * Delete Cache Files
 *
 * @since 3.1.3
 * @uses GSCACHEPATH
 *
 * @returns deleted count on success, null if there are any errors
 */
function delete_cache() { 
	$cachepath = GSCACHEPATH;
	
	$cnt = 0;	
	$success = null;
	
	foreach(glob($cachepath.'*.txt') as $file){
		if(unlink($file)) $cnt++;
		else $success = false;
	}	

	if($success == false) return null;
	return $cnt;
} 

/**
 * Delete Pages Backup File
 *
 * @since 1.0
 * @uses GSBACKUPSPATH
 *
 * @param string $id File ID to delete
 * @return string
 */
function delete_bak($id) { 
	unlink(GSBACKUPSPATH."pages/". $id .".bak.xml");
	return 'success';
} 

/**
 * Restore Pages Backup File
 *
 * @since 1.0
 * @uses GSBACKUPSPATH
 * @uses GSDATAPAGESPATH
 *
 * @param string $id File ID to restore
 */
function restore_bak($id) { 
	$file = GSBACKUPSPATH."pages/". $id .".bak.xml";
	$newfile = GSDATAPAGESPATH . $id .".xml";
	$tmpfile = GSBACKUPSPATH."pages/". $id .".tmp.xml";
	if ( !file_exists($newfile) ) { 
		copy($file, $newfile);
		unlink($file);
	} else {
		copy($file, $tmpfile);
		copy($newfile, $file);
		copy($tmpfile, $newfile);
		unlink($tmpfile);
	}
	exec_action('page-restored');
	generate_sitemap();
} 

/**
 * Create Random Password
 *
 * @since 1.0
 *
 * @return string
 */
function createRandomPassword() {
    $chars = "Ayz23mFGHBxPQefgnopRScdqrTU4CXYZabstuDEhijkIJKMNVWvw56789";
    srand((double)microtime()*1000000);
    $i = 0;
    $pass = '' ;
    while ($i <= 5) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }
    return $pass;
}

/**
 * File Type Category
 *
 * Returns the category of an file based on its extension
 *
 * @since 1.0
 * @uses i18n_r
 *
 * @param string $ext
 * @return string
 */
function get_FileType($ext) {

	$ext = lowercase($ext);
	if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'pct' || $ext == 'gif' || $ext == 'bmp' || $ext == 'png' ) {
		return i18n_r('IMAGES') .' Images';
	} elseif ( $ext == 'zip' || $ext == 'gz' || $ext == 'rar' || $ext == 'tar' || $ext == 'z' || $ext == '7z' || $ext == 'pkg' ) {
		return i18n_r('FTYPE_COMPRESSED');
	} elseif ( $ext == 'ai' || $ext == 'psd' || $ext == 'eps' || $ext == 'dwg' || $ext == 'tif' || $ext == 'tiff' || $ext == 'svg' ) {
		return i18n_r('FTYPE_VECTOR');
	} elseif ( $ext == 'swf' || $ext == 'fla' ) {
		return i18n_r('FTYPE_FLASH');	
	} elseif ( $ext == 'mov' || $ext == 'mpg' || $ext == 'avi' || $ext == 'mpeg' || $ext == 'rm' || $ext == 'wmv' ) {
		return i18n_r('FTYPE_VIDEO');
	} elseif ( $ext == 'mp3' || $ext == 'wav' || $ext == 'wma' || $ext == 'midi' || $ext == 'mid' || $ext == 'm3u' || $ext == 'ra' || $ext == 'aif' ) {
		return i18n_r('FTYPE_AUDIO');
	} elseif ( $ext == 'php' || $ext == 'phps' || $ext == 'asp' || $ext == 'xml' || $ext == 'js' || $ext == 'jsp' || $ext == 'sql' || $ext == 'css' || $ext == 'htm' || $ext == 'html' || $ext == 'xhtml' || $ext == 'shtml' ) {
		return i18n_r('FTYPE_WEB');
	} elseif ( $ext == 'mdb' || $ext == 'accdb' || $ext == 'pdf' || $ext == 'xls' || $ext == 'xlsx' || $ext == 'csv' || $ext == 'tsv' || $ext == 'ppt' || $ext == 'pps' || $ext == 'pptx' || $ext == 'txt' || $ext == 'log' || $ext == 'dat' || $ext == 'text' || $ext == 'doc' || $ext == 'docx' || $ext == 'rtf' || $ext == 'wks' ) {
		return i18n_r('FTYPE_DOCUMENTS');
	} elseif ( $ext == 'exe' || $ext == 'msi' || $ext == 'bat' || $ext == 'download' || $ext == 'dll' || $ext == 'ini' || $ext == 'cab' || $ext == 'cfg' || $ext == 'reg' || $ext == 'cmd' || $ext == 'sys' ) {
		return i18n_r('FTYPE_SYSTEM');
	} else {
		return i18n_r('FTYPE_MISC');
	}
}

/**
 * Create Backup Pages File
 *
 * @since 1.0
 * @uses tsl
 *
 * @param string $file
 * @param string $filepath
 * @param string $bakpath
 * @return bool
 */
function createBak($file, $filepath, $bakpath) {
	$bakfile = $bakpath . $file .".bak";
	if ( file_exists(tsl($filepath) . $file) ) {
		copy($filepath . $file, $bakfile);
	}
	
	if ( file_exists($bakfile) ) {
		return true;
	} else {
		return false;
	} 
}

/**
 * ISO Timestamp
 *
 * @since 1.0
 *
 * @param string $dateTime
 * @return string
 */
function makeIso8601TimeStamp($dateTime) {
    if (!$dateTime) {
        $dateTime = date('Y-m-d H:i:s');
    }
    if (is_numeric(substr($dateTime, 11, 1))) {
        $isoTS = substr($dateTime, 0, 10) ."T".substr($dateTime, 11, 8) ."+00:00";
    } else {
        $isoTS = substr($dateTime, 0, 10);
    }
    return $isoTS;
}

/**
 * Ping Sitemaps
 *
 * @since 1.0
 *
 * @param string $url_xml XML sitemap
 * @return bool
 */
function pingGoogleSitemaps($url_xml) {
   $status = 0;
   $google = 'www.google.com';
   $bing 	 = 'www.bing.com';
   $ask 	 = 'submissions.ask.com';
   if( $fp=@fsockopen($google, 80) ) {
      $req =  'GET /webmasters/sitemaps/ping?sitemap=' .
              urlencode( $url_xml ) . " HTTP/1.1\r\n" .
              "Host: $google\r\n" .
              "User-Agent: Mozilla/5.0 (compatible; " .
              PHP_OS . ") PHP/" . PHP_VERSION . "\r\n" .
              "Connection: Close\r\n\r\n";
      fwrite( $fp, $req );
      while( !feof($fp) ) {
         if( @preg_match('~^HTTP/\d\.\d (\d+)~i', fgets($fp, 128), $m) ) {
            $status = intval( $m[1] );
            break;
         }
      }
      fclose( $fp );
   }
   
   if( $fp=@fsockopen($bing, 80) ) {
      $req =  'GET /webmaster/ping.aspx?sitemap=' .
              urlencode( $url_xml ) . " HTTP/1.1\r\n" .
              "Host: $bing\r\n" .
              "User-Agent: Mozilla/5.0 (compatible; " .
              PHP_OS . ") PHP/" . PHP_VERSION . "\r\n" .
              "Connection: Close\r\n\r\n";
      fwrite( $fp, $req );
      while( !feof($fp) ) {
         if( @preg_match('~^HTTP/\d\.\d (\d+)~i', fgets($fp, 128), $m) ) {
            $status = intval( $m[1] );
            break;
         }
      }
      fclose( $fp );
   }
   
   if( $fp=@fsockopen($ask, 80) ) {
      $req =  'GET /ping?sitemap=' .
              urlencode( $url_xml ) . " HTTP/1.1\r\n" .
              "Host: $ask\r\n" .
              "User-Agent: Mozilla/5.0 (compatible; " .
              PHP_OS . ") PHP/" . PHP_VERSION . "\r\n" .
              "Connection: Close\r\n\r\n";
      fwrite( $fp, $req );
      while( !feof($fp) ) {
         if( @preg_match('~^HTTP/\d\.\d (\d+)~i', fgets($fp, 128), $m) ) {
            $status = intval( $m[1] );
            break;
         }
      }
      fclose( $fp );
   }
   
   return( $status );
}

/**
 * Undo
 *
 * @since 1.0
 * @uses tsl
 *
 * @param string $file filename to undo
 * @param string $filepath filepath to undo
 * @param string $bakpath path to the backup file
 * @return bool
 */
function undo($file, $filepath, $bakpath) {
	$undo_file = $filepath . $file;
	$bak_file  = tsl($bakpath) . $file .".bak";
	$tmp_file = tsl($bakpath) . $file .".tmp";
	copy($undo_file, $tmp_file); // rename original to temp shuttle
	copy($bak_file, $undo_file); // copy backup
	copy($tmp_file, $bak_file);  // save original as backup
	unlink($tmp_file); 			 // remove temp shuttle file
	
	if (file_exists($tmp_file)) {
		return false;
	} else {
		return true;
	}
}

/**
 * File Size
 *
 * @since 1.0
 *
 * @param string $s 
 * @return string
 */
function fSize($s) {
	$size = '<span>'. ceil(round(($s / 1024), 1)) .'</span> KB'; // in kb
	if ($s >= "1000000") {
		$size = '<span>'. round(($s / 1048576), 1) .'</span> MB'; // in mb
	}
	if ($s <= "999") {
		$size = '<span>&lt; 1</span> KB'; // in kb
	}
	
	return $size;
}

/**
 * Validate Email Address
 *
 * @since 1.0
 *
 * @param string $email 
 * @return bool
 */
function check_email_address($email) {
    if (function_exists('filter_var')) {
    	// PHP 5.2 or higher
    	return (!filter_var((string)$email,FILTER_VALIDATE_EMAIL)) ? false: true;
    } else {
    	// old way
	    if (!preg_match("/[^@]{1,64}@[^@]{1,255}$/", $email)) {
	        return false;
	    }
	    $email_array = explode("@", $email);
	    $local_array = explode(".", $email_array[0]);
	    for ($i = 0; $i < sizeof($local_array); $i++) {
	        if (!preg_match("/(([A-Za-z0-9!#$%&'*+\/\=?^_`{|}~-][A-Za-z0-9!#$%&'*+\/\=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/", $local_array[$i])) {
	            return false;
	        }
	    }
	    if (!preg_match("/\[?[0-9\.]+\]?$/", $email_array[1])) {
	        $domain_array = explode(".", $email_array[1]);
	        if (sizeof($domain_array) < 2) {
	            return false; // Not enough parts to domain
	        }
	        for ($i = 0; $i < sizeof($domain_array); $i++) {
	            if (!preg_match("/(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/", $domain_array[$i])) {
	                return false;
	            }
	        }
	    }
	    return true;
	  }
}

/**
 * Do Regex
 *
 * @since 1.0
 *
 * @param string $text Text to perform regex on
 * @param string $regex Regex format to use
 * @return bool
 */
function do_reg($text, $regex) {
	if (preg_match($regex, $text)) {
		return true;
	} else {
		return false;
	}
}

/**
 * Validate XML
 *
 * @since 1.0
 * @uses i18n_r
 * @uses getXML
 *
 * @param string $file File to validate
 * @return string
 */
function valid_xml($file) {
	$xmlv = getXML($file);
	global $i18n;
	if (is_object($xmlv)) {
		return '<span class="OKmsg" >'.i18n_r('XML_VALID').' - '.i18n_r('OK').'</span>';
	} else {
		return '<span class="ERRmsg" >'.i18n_r('XML_INVALID').' - '.i18n_r('ERROR').'!</span>';
	}
}

/**
 * Generate Salt
 *
 * Returns a new unique salt
 * @updated 3.0
 *
 * @return string
 */
function generate_salt() {
	return substr(sha1(mt_rand()),0,22);
}

/**
 * Get Admin Path
 *
 * Gets the path of the admin directory
 *
 * @since 1.0
 * @uses $GSADMIN
 * @uses GSROOTPATH
 * @uses tsl
 *
 * @return string
 */
function get_admin_path() {
	global $GSADMIN;
	return tsl(GSROOTPATH . $GSADMIN);
}

/**
 * Get Root Install Path
 *
 * Gets the path of the root installation directory
 *
 * @since 1.0
 *
 * @return string
 */
function get_root_path() {
  $pos = strrpos(dirname(__FILE__),DIRECTORY_SEPARATOR.'inc');
  $adm = substr(dirname(__FILE__), 0, $pos);
  $pos2 = strrpos($adm,DIRECTORY_SEPARATOR);
  return tsl(substr(__FILE__, 0, $pos2));
}



/**
 * Check Current Menu
 *
 * Checks to see if a menu item matches the current page
 *
 * @since 1.0
 *
 * @param string $text
 * @return string
 */
function check_menu($text) {
	if(get_filename_id()===$text){
		echo 'class="current"';
	}
}


function passhash($p) {
	if(defined('GSLOGINSALT') && GSLOGINSALT != '') { 
		$logsalt = sha1(GSLOGINSALT);
	} else { 
		$logsalt = null; 
	}
	
	return sha1($p . $logsalt);
}

/**
 * Get Available Pages
 *
 * Lists all available pages for plugin/api use
 *
 * @since 2.0
 * @uses GSDATAPAGESPATH
 * @uses find_url
 * @uses getXML
 * @uses subval_sort
 *
 * @return array|string Type 'string' in this case will be XML 
 */
function get_available_pages() {
    $menu_extract = '';
    
	global $pagesArray;
    
    $pagesSorted = subval_sort($pagesArray,'title');
    if (count($pagesSorted) != 0) { 
      $count = 0;
      foreach ($pagesSorted as $page) {
      	if ($page['private']!='Y'){
        $text = (string)$page['menu'];
        $pri = (string)$page['menuOrder'];
        $parent = (string)$page['parent'];
        $title = (string)$page['title'];
        $slug = (string)$page['url'];
        $menuStatus = (string)$page['menuStatus'];
        $private = (string)$page['private'];
				$pubDate = (string)$page['pubDate'];
        
        $url = find_url($slug,$parent);
        
        $specific = array("slug"=>$slug,"url"=>$url,"parent_slug"=>$parent,"title"=>$title,"menu_priority"=>$pri,"menu_text"=>$text,"menu_status"=>$menuStatus,"private"=>$private,"pub_date"=>$pubDate);
        
        $extract[] = $specific;
      } 
      } 
      return $extract;
    }
}

  
/**
 * Update Slugs
 *
 * @since 2.04
 * @uses $url
 * @uses GSDATAPAGESPATH
 * @uses XMLsave
 *
 */
function updateSlugs($existingUrl, $newurl=null){
	global $pagesArray;
	getPagesXmlValues();
      
      if (!$newurl){
      	global $url;
      } else {
      	$url = $newurl;
      }

	foreach ($pagesArray as $page){
		if ( $page['parent'] == $existingUrl ){
			$thisfile = @file_get_contents(GSDATAPAGESPATH.$page['filename']);
        		$data = simplexml_load_string($thisfile);
            		$data->parent=$url;
            		XMLsave($data, GSDATAPAGESPATH.$page['filename']);
        }
      }
}

          
/**
 * Get Link Menu Array
 * 
 * get an array of menu links sorted by heirarchy and indented
 * 
 * @uses $pagesSorted
 *
 * @since  3.3.0
 * @param string $parent
 * @param array $array
 * @param int $level
 * @return array menuitems title,url,parent
 */
function get_link_menu_array($parent='', $array=array(), $level=0) {
	
	global $pagesSorted;
	
	$items=array();
	// $pageList=array();

	foreach ($pagesSorted as $page) {
		if ($page['parent']==$parent){
			$items[(string)$page['url']]=$page;
		}	
	}	

	if (count($items)>0){
		foreach ($items as $page) {
		  	$dash="";
		  	if ($page['parent'] != '') {
	  			$page['parent'] = $page['parent']."/";
	  		}
			for ($i=0;$i<=$level-1;$i++){
				if ($i!=$level-1){
	  				$dash .= utf8_encode("\xA0\xA0"); // outer level
          } else {
					$dash .= '- '; // inner level
            }   
          } 
			array_push($array, array( $dash . $page['title'], find_url($page['url'], $page['parent'])));
			// recurse submenus
			$array=get_link_menu_array((string)$page['url'], $array,$level+1);	 
        }
      }
	return $array;
} 

/**
 * List Pages Json
 *
 * This is used by the CKEditor link-local plugin function: ckeditor_add_page_link()
 *
 * @author Joshas: mailto:joshas@gmail.com
 *
 * @since 3.0
 * @uses $pagesArray
 * @uses subval_sort
 * @uses GSDATAPAGESPATH
 * @uses getXML
 *
 * @returns array
 */
function list_pages_json() {
	GLOBAL $pagesArray,$pagesSorted;

	$pagesArray_tmp = array();
	$count = 0;
	foreach ($pagesArray as $page) {
		if ($page['parent'] != '') { 
			$parentTitle = returnPageField($page['parent'], "title");
			$sort = $parentTitle .' '. $page['title'];		
			} else {
			$sort = $page['title'];
			}
		$page = array_merge($page, array('sort' => $sort));
		$pagesArray_tmp[$count] = $page;
			$count++;
			}
	$pagesSorted = subval_sort($pagesArray_tmp,'sort');

	$links = exec_filter('editorlinks',get_link_menu_array());
	return json_encode($links);
		}

/**
 * @deprecated since 3.3.0
 * moved to ckeditor config.js
 */
function ckeditor_add_page_link(){
	echo "
	<script type=\"text/javascript\">
	//<![CDATA[
	// DEPRECATED FUNCTION!
	//]]>
	</script>";
}


/**
 * Recursive list of pages
 *
 * Returns a recursive list of items for the main page
 *
 * @author Mike
 *
 * @since 3.0
 * @uses $pagesSorted
 *
 * @param string $parent
 * @param string $menu
 * @param int $level
 * 
 * @returns string
 */
function get_pages_menu($parent, $menu,$level) {
	global $pagesSorted;
	
	$items=array();
	foreach ($pagesSorted as $page) {
		if ($page['parent']==$parent){
			$items[(string)$page['url']]=$page;
		}	
	}	
	if (count($items)>0){
		foreach ($items as $page) {
		  	$dash="";
		  	if ($page['parent'] != '') {
	  			$page['parent'] = $page['parent']."/";
	  		}
			for ($i=0;$i<=$level-1;$i++){
				if ($i!=$level-1){
	  				$dash .= '<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
				} else {
					$dash .= '<span>&nbsp;&nbsp;&ndash;&nbsp;&nbsp;&nbsp;</span>';
				}
			} 
			$menu .= '<tr id="tr-'.$page['url'] .'" >';
			if ($page['title'] == '' ) { $page['title'] = '[No Title] &nbsp;&raquo;&nbsp; <em>'. $page['url'] .'</em>'; }
			if ($page['menuStatus'] != '' ) { $page['menuStatus'] = ' <sup>['.i18n_r('MENUITEM_SUBTITLE').']</sup>'; } else { $page['menuStatus'] = ''; }
			if ($page['private'] != '' ) { $page['private'] = ' <sup>['.i18n_r('PRIVATE_SUBTITLE').']</sup>'; } else { $page['private'] = ''; }
			if ($page['url'] == 'index' ) { $homepage = ' <sup>['.i18n_r('HOMEPAGE_SUBTITLE').']</sup>'; } else { $homepage = ''; }
			$menu .= '<td class="pagetitle">'. $dash .'<a title="'.i18n_r('EDITPAGE_TITLE').': '. var_out($page['title']) .'" href="edit.php?id='. $page['url'] .'" >'. cl($page['title']) .'</a><span class="showstatus toggle" >'. $homepage . $page['menuStatus'] . $page['private'] .'</span></td>';
			$menu .= '<td style="width:80px;text-align:right;" ><span>'. shtDate($page['pubDate']) .'</span></td>';
			$menu .= '<td class="secondarylink" >';
			$menu .= '<a title="'.i18n_r('VIEWPAGE_TITLE').': '. var_out($page['title']) .'" target="_blank" href="'. find_url($page['url'],$page['parent']) .'">#</a>';
			$menu .= '</td>';
			if ($page['url'] != 'index' ) {
				$menu .= '<td class="delete" ><a class="delconfirm" href="deletefile.php?id='. $page['url'] .'&amp;nonce='.get_nonce("delete", "deletefile.php").'" title="'.i18n_r('DELETEPAGE_TITLE').': '. var_out($page['title']) .'" >&times;</a></td>';
			} else {
				$menu .= '<td class="delete" ></td>';
			}
			$menu .= '</tr>';
			$menu = get_pages_menu((string)$page['url'], $menu,$level+1);	  	
		}
	}
	return $menu;
}

/**
 * Recursive list of pages for Dropdown menu
 *
 * Returns a recursive list of items for the main page
 *
 * @author Mike
 *
 * @since 3.0
 * @uses $pagesSorted
 *
 * @param string $parent
 * @param string $menu
 * @param int $level
 * 
 * @returns string
 */
function get_pages_menu_dropdown($parentitem, $menu,$level) {
	
	global $pagesSorted;
	global $parent; 
	
	$items=array();
	foreach ($pagesSorted as $page) {
		if ($page['parent']==$parentitem){
			$items[(string)$page['url']]=$page;
		}	
	}	
	if (count($items)>0){
		foreach ($items as $page) {
		  	$dash="";
		  	if ($page['parent'] != '') {
	  			$page['parent'] = $page['parent']."/";
	  		}
			for ($i=0;$i<=$level-1;$i++){
				if ($i!=$level-1){
	  				$dash .= '<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
				} else {
					$dash .= '<span>&nbsp;&nbsp;&ndash;&nbsp;&nbsp;&nbsp;</span>';
				}
			} 
			if ($parent == (string)$page['url']) { $sel="selected"; } else { $sel=""; }
			$menu .= '<option '.$sel.' value="'.$page['url'] .'" >'.$dash.$page['url'].'</option>';
			$menu = get_pages_menu_dropdown((string)$page['url'], $menu,$level+1);	  	
		}
	}
	return $menu;
}

/**
 * Get API Details
 *
 * Returns the contents of an API url request
 *
 * This is needed because of the "XmlHttpRequest error: Origin null is not allowed by Access-Control-Allow-Origin"
 * error that javascript gets when trying to access outside domains sometimes. 
 *
 * @since 3.1
 * @uses GSADMININCPATH
 * @uses GSCACHEPATH
 *
 * @param string $type, default is 'core'
 * @param array $args, default is empty
 * @param  bool $cached force cached check only, do not use curl
 * 
 * @returns string
 */

function get_api_details($type='core', $args=null, $cached = false) {
	GLOBAL $debugApi,$nocache,$nocurl;

	include(GSADMININCPATH.'configuration.php');

	if($cached){
		debug_api_details("API REQEUSTS DISABLED, using cache files only");
	}

	# core api details
	if ($type=='core') {
		# core version request, return status 0-outdated,1-current,2-bleedingedge
		$fetch_this_api = $api_url .'?v='.GSVERSION;
	}
	else if ($type=='plugin' && $args) {
		# plugin api details. requires a passed plugin i
		$apiurl = $site_link_back_url.'api/extend/?file=';
		$fetch_this_api = $apiurl.$args;
	}
	else if ($type=='custom' && $args) {
	# custom api details. requires a passed url
		$fetch_this_api = $args;
	} else return;
	
	// get_execution_time();
	debug_api_details("type: " . $type. " " .$args);
	debug_api_details("address: " . $fetch_this_api);

	# debug_api_details(debug_backtrace());

	if(!isset($api_timeout) or (int)$api_timeout<100) $api_timeout = 500; // default and clamp min to 100ms
	debug_api_details("timeout: " .$api_timeout);

	# check to see if cache is available for this
	$cachefile = md5($fetch_this_api).'.txt';
	$cacheExpire = 39600; // 11 minutes

	if(!$nocache || $cached) debug_api_details('cache file check - ' . $fetch_this_api.' ' .$cachefile);
	else debug_api_details('cache check: disabled');

	$cacheAge = file_exists(GSCACHEPATH.$cachefile) ? filemtime(GSCACHEPATH.$cachefile) : '';


	// api disabled and no cache file exists
	if($cached && empty($cacheAge)){
		debug_api_details('cache file does not exist - ' . GSCACHEPATH.$cachefile);
		debug_api_details();
		return '{"status":-1}';
	}

	if (!$nocache && !empty($cacheAge) && (time() - $cacheExpire) < $cacheAge ) {
		debug_api_details('cache file time - ' . $cacheAge . ' (' . (time() - $cacheAge) . ')' );
		# grab the api request from the cache
		$data = file_get_contents(GSCACHEPATH.$cachefile);
		debug_api_details('returning cache file - ' . GSCACHEPATH.$cachefile);
	} else {	
		# make the api call
		if (function_exists('curl_init') && function_exists('curl_exec') && !$nocurl) {

			// USE CURL
			$ch = curl_init();
			
			// define missing curlopts php<5.2.3
			if(!defined('CURLOPT_CONNECTTIMEOUT_MS')) define('CURLOPT_CONNECTTIMEOUT_MS',156);
			if(!defined('CURLOPT_TIMEOUT_MS')) define('CURLOPT_TIMEOUT_MS',155);			
			
			// min cURL 7.16.2
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, $api_timeout); // define the maximum amount of time that cURL can take to connect to the server 
			curl_setopt($ch, CURLOPT_TIMEOUT_MS, $api_timeout); // define the maximum amount of time cURL can execute for.
			curl_setopt($ch, CURLOPT_NOSIGNAL, 1); // prevents SIGALRM during dns allowing timeouts to work http://us2.php.net/manual/en/function.curl-setopt.php#104597
			curl_setopt($ch, CURLOPT_HEADER, false); // ensures header is not in output
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL, $fetch_this_api);

			if($debugApi){
				// $verbose = fopen(GSDATAOTHERPATH .'logs/curllog.txt', 'w+');			
				$verbose = tmpfile();				
				// curl_setopt($ch, CURLOPT_WRITEHEADER, $verbose );
				curl_setopt($ch, CURLOPT_HEADER, true); 
				curl_setopt($ch, CURLOPT_VERBOSE, true);
				curl_setopt($ch, CURLOPT_STDERR, $verbose );
				curl_setopt($ch, CURLINFO_HEADER_OUT, true);								
			}
				
			$data = curl_exec($ch);

			if($debugApi){
				debug_api_details("using curl");
				debug_api_details("curl version: ");
				debug_api_details(print_r(curl_version(),true));	
			
				debug_api_details("curl info:");
				debug_api_details(print_r(curl_getinfo($ch),true));
			
				if (!$data) {
					debug_api_details("curl error number:" .curl_errno($ch));
					debug_api_details("curl error:" . curl_error($ch));
				}

				debug_api_details("curl Verbose: ");
				debug_api_details(!rewind($verbose) . nl2br(htmlspecialchars(stream_get_contents($verbose))) );
				fclose($verbose);
				
				// output header and response then remove header from data
				$dataparts = explode("\r\n",$data);
				debug_api_details("curl Data: ");
				debug_api_details($data);
				$data = end($dataparts);

			}	

			curl_close($ch);

		} else if(ini_get('allow_url_fopen')) {  
			// USE FOPEN
			debug_api_details("using fopen");			
			$timeout = $api_timeout / 1000; // ms to float seconds
			// $context = stream_context_create();
			// stream_context_set_option ( $context, array('http' => array('timeout' => $timeout)) );
			$context = stream_context_create(array('http' => array('timeout' => $timeout))); 
			$data = @file_get_contents($fetch_this_api,false,$context);	
			debug_api_details("fopen data: " .$data);		
		} else {
			debug_api_details("No api methods available");
			debug_api_details();						
			return;
		}	
	
		// debug_api_details("Duration: ".get_execution_time());	

		$response = json_decode($data);		
		debug_api_details('JSON:');
		debug_api_details(print_r($response,true),'');

		// if response is invalid set status to -1 error
		// and we pass on our own data, it is also cached to prevent constant rechecking

		if(!$response){
			$data = '{"status":-1}';
		}
		
		debug_api_details($data);

		file_put_contents(GSCACHEPATH.$cachefile, $data);
		chmod(GSCACHEPATH.$cachefile, 0644);
		debug_api_details();		
		return $data;
	}
	debug_api_details();	
	return $data;
}

function debug_api_details($msg = null ,$prefix = "API: "){
	GLOBAL $debugApi;
	if(!$debugApi) return;
	if(!isset($msg)) $msg = str_repeat('-',80);
	debugLog($prefix.$msg);
}


function get_gs_version() {
	include(GSADMININCPATH.'configuration.php');
	return GSVERSION;
}


/**
 * Creates Sitemap
 *
 * Creates sitemap.xml in the site's root.
 */
function generate_sitemap() {
	
	if(getDef('GSNOSITEMAP',true)) return;

	// Variable settings
	global $SITEURL;
	$path = GSDATAPAGESPATH;
	
	global $pagesArray;
	getPagesXmlValues(false);
	$pagesSorted = subval_sort($pagesArray,'menuStatus');
	
	if (count($pagesSorted) != 0)
	{ 
		$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset></urlset>');
		$xml->addAttribute('xsi:schemaLocation', 'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd', 'http://www.w3.org/2001/XMLSchema-instance');
		$xml->addAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
		
		foreach ($pagesSorted as $page)
		{	
			if ($page['url'] != '404')
			{		
			if ($page['private'] != 'Y')
			{
				// set <loc>
				$pageLoc = find_url($page['url'], $page['parent']);
				
				// set <lastmod>
					$tmpDate = date("Y-m-d H:i:s", strtotime($page['pubDate']));
				$pageLastMod = makeIso8601TimeStamp($tmpDate);
				
				// set <changefreq>
				$pageChangeFreq = 'weekly';
				
				// set <priority>
				if ($page['menuStatus'] == 'Y') {
					$pagePriority = '1.0';
				} else {
					$pagePriority = '0.5';
				}
				
				//add to sitemap
				$url_item = $xml->addChild('url');
				$url_item->addChild('loc', $pageLoc);
				$url_item->addChild('lastmod', $pageLastMod);
				$url_item->addChild('changefreq', $pageChangeFreq);
				$url_item->addChild('priority', $pagePriority);
			}
		}
		}
		
		//create xml file
		$file = GSROOTPATH .'sitemap.xml';
		$xml = exec_filter('sitemap',$xml);
		XMLsave($xml, $file);
		exec_action('sitemap-aftersave');
	}
	
	if (!defined('GSDONOTPING')) {
		if (file_exists(GSROOTPATH .'sitemap.xml')){
			if( 200 === ($status=pingGoogleSitemaps($SITEURL.'sitemap.xml')))	{
				#sitemap successfully created & pinged
				return true;
			} else {
				error_log(i18n_r('SITEMAP_ERRORPING'));
				return i18n_r('SITEMAP_ERRORPING');
			}
		} else {
			error_log(i18n_r('SITEMAP_ERROR'));
			return i18n_r('SITEMAP_ERROR');
		}
	} else {
		#sitemap successfully created - did not ping
		return true;
	}
}


/**
 * Creates tar.gz Archive 
 */
function archive_targz() {
	if(!function_exists('exec')) {
    return false;
    exit;
	}
	$timestamp = gmdate('Y-m-d-Hi_s');
	$saved_zip_file_path = GSBACKUPSPATH.'zip/';
	$saved_zip_file = $timestamp .'_archive.tar.gz';	
	$script_contents = "tar -cvzf ".$saved_zip_file_path.$saved_zip_file." ".GSROOTPATH.".htaccess ".GSROOTPATH."gsconfig.php ".GSROOTPATH."data ".GSROOTPATH."plugins ".GSROOTPATH."theme ".GSROOTPATH."admin/lang > /dev/null 2>&1";
	exec($script_contents, $output, $rc);
	if (file_exists($saved_zip_file_path.$saved_zip_file)) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if a page is a public admin page
 * @return boolean true if page is non protected admin page
 */
function isAuthPage(){
	$page = get_filename_id(); 
	return $page == 'index' || $page == 'resetpassword';
}

/**
 * returns a query string with only the allowed keys
 * @since  3.3.0
 * 
 * @param  array $allowed array of querystring keys to keep
 * @return string built query string
 */
function filter_queryString($allowed = array()){
	parse_str($_SERVER['QUERY_STRING'], $query_string);
	$qstring_filtered = array_intersect_key($query_string, array_flip($allowed));
	$new_qstring = http_build_query($qstring_filtered,'','&amp;');
	return $new_qstring;
}


/**
 * Get String Excerpt
 *
 * @since 3.3.2
 *
 * @uses mb_strlen
 * @uses mb_strrpos
 * @uses mb_substr
 * @uses strip_tags
 * @uses strIsMultibyte
 * @uses cleanHtml
 * @uses preg_repalce PCRE compiled with "--enable-unicode-properties"
 *
 * @param string $n Optional, default is 200.
 * @param bool $striphtml Optional, default true, true will strip html from $content
 * @param string $ellipsis 
 * @param bool $break	break words, default: do not break words find whitespace and puntuation
 * @param bool $cleanhtml attempt to clean up html IF strip tags is false, default: true
 * @return string
 */
function getExcerpt($str, $len = 200, $striphtml = true, $ellipsis = '...', $break = false, $cleanhtml = true){
	$str = $striphtml ? trim(strip_tags($str)) : $str;
	$len = $len++; // zero index bump

	// setup multibyte function names
	$prefix = strIsMultibyte($str) ?  'mb_' : '';
	list($substr,$strlen,$strrpos) = array($prefix.'substr',$prefix.'strlen',$prefix.'strrpos');

	// string is shorter than truncate length, return
	if ($strlen($str) < $len) return $str;

	// if not break, find last word boundary before truncate to avoid splitting last word
	// solves for unicode whitespace \p{Z} and punctuation \p{P} and a 1 character lookahead hack,
	// replaces punc with space so it handles the same for obtaining word boundary index
	// REQUIRES that PCRE is compiled with "--enable-unicode-properties, 
	// @todo detect or supress requirement, perhaps defined('PREG_BAD_UTF8_OFFSET_ERROR'), translit puntuation only might be an alternative
	debugLog(defined('PREG_BAD_UTF8_OFFSET_ERROR'));
	if(!$break) $excerpt = preg_replace('/\n|\p{Z}|\p{P}+$/u',' ',$substr($str, 0, $len+1)); 

	$lastWordBoundaryIndex = !$break ? $strrpos($excerpt, ' ') : $len;
	$str = $substr($str, 0, $lastWordBoundaryIndex); 

	if(!$striphtml && $cleanhtml) return trim(cleanHtml($str)) . $ellipsis;
	return trim($str) . $ellipsis;	
}

/**
 * check if a string is multbyte
 * @since 3.3.2
 * 
 * @uses mb_check_encoding
 * 
 * @param  string $str string to check
 * @return bool      true if multibyte
 */
function strIsMultibyte($str){
	return function_exists('mb_check_encoding') && ! mb_check_encoding($str, 'ASCII') && mb_check_encoding($str, 'UTF-8');
}

/**
 * clean Html fragments by loading and saving from DOMDocument
 * Will only clean html body fragments,unexpected results with full html doc or containing head or body
 * which are always stripped
 * 
 * @note supressing errors on libxml functions to prevent parse errors on not well-formed content
 * @since 3.3.2
 * @param  string $str string to clean up
 * @param  array $strip_tags optional elements to remove eg. array('style')
 * @return string      return well formed html , with open tags being closed and incomplete open tags removed
 */
function cleanHtml($str,$strip_tags = array()){
	// setup encoding, required for proper dom loading
	// @note
	// $dom_document = new DOMDocument('1.0', 'utf-8'); // this does not deal with transcoding issues, loadhtml will treat string as ISO-8859-1 unless the doc specifies it 
	// $dom_document->loadHTML(mb_convert_encoding($str, 'HTML-ENTITIES', 'UTF-8')); // aternate option that might work...
	
	$dom_document = new DOMDocument();
	$charsetstr = '<meta http-equiv="content-type" content="text/html; charset=utf-8">';
	@$dom_document->loadHTML($charsetstr.$str);
	
	foreach($strip_tags as $tag){
    	$elem = $dom_document->getElementsByTagName($tag);
    	while ( ($node = $elem->item(0)) ) {
        	$node->parentNode->removeChild($node);
	    }
	}

	// strip dom tags that we added, and ones that savehtml adds
	// strip doctype, head, html, body tags
	$html_fragment = preg_replace('/^<!DOCTYPE.+?>|<head.*?>(.*)?<\/head>/', '', str_replace( array('<html>', '</html>', '<body>', '</body>'), array('', '', '', ''), @$dom_document->saveHTML()));	
	return $html_fragment;
}	


?>
