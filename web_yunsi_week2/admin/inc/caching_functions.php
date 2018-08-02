<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }


$pagesArray = array();

add_action('index-header','getPagesXmlValues',array(false));      // make $pagesArray available to the front 
add_action('header', 'getPagesXmlValues',array(get_filename_id() != 'pages'));  // make $pagesArray available to the back
add_action('page-delete', 'create_pagesxml',array(true));         // Create pages.array if page deleted
add_action('page-restored', 'create_pagesxml',array(true));        // Create pages.array if page undo
add_action('changedata-aftersave', 'create_pagesxml',array(true));     // Create pages.array if page is updated

/**
 * Get Page Content
 *
 * Retrieve and display the content of the requested page. 
 * As the Content is not cahed the file is read in.
 *
 * @since 2.0
 * @param $page - slug of the page to retrieve content
 *
 */
function getPageContent($page,$field='content'){   
	$thisfile = file_get_contents(GSDATAPAGESPATH.$page.'.xml');
	$data = simplexml_load_string($thisfile);
	$content = stripslashes(htmlspecialchars_decode($data->$field, ENT_QUOTES));
	if ($field=='content'){
		$content = exec_filter('content',$content);
	}
	echo $content;
}

/**
 * Get Page Field
 *
 * Retrieve and display the requested field from the given page. 
 *
 * @since 3.1
 * @param $page - slug of the page to retrieve content
 * @param $field - the Field to display
 * 
 */
function getPageField($page,$field){   
	global $pagesArray;
	if(!$pagesArray) getPagesXmlValues();	
	
	if ($field=="content"){
	  getPageContent($page);  
	} else {
		if (array_key_exists($field, $pagesArray[(string)$page])){
	  		echo strip_decode($pagesArray[(string)$page][(string)$field]);
		} else {
			getPageContent($page,$field);
		}
	} 
}

/**
 * Echo Page Field
 *
 * Retrieve and display the requested field from the given page. 
 *
 * @since 3.1
 * @param $page - slug of the page to retrieve content
 * @param $field - the Field to display
 * 
 */
function echoPageField($page,$field){
	getPageField($page,$field);
}


/**
 * Return Page Content
 *
 * Return the content of the requested page. 
 * As the Content is not cahed the file is read in.
 *
 * @since 3.1
 * @param $page - slug of the page to retrieve content
 * @param $raw false - if true return raw xml
 * @param $nofilter false - if true skip content filter execution
 *
 */
function returnPageContent($page, $field='content', $raw = false, $nofilter = false){   
	$thisfile = file_get_contents(GSDATAPAGESPATH.$page.'.xml');
	$data = simplexml_load_string($thisfile);
	if(!$data) return;
	$content = $data->$field;
	if(!$raw) $content = stripslashes(htmlspecialchars_decode($content, ENT_QUOTES));
	if ($field=='content' and !$nofilter){
		$content = exec_filter('content',$content);
	}
  	return $content;
}

/**
 * Get Page Field
 *
 * Retrieve and display the requested field from the given page. 
 * If the field is "content" it will call returnPageContent()
 *
 * @since 3.1
 * @param $page - slug of the page to retrieve content
 * @param $field - the Field to display
 * 
 */
function returnPageField($page,$field){   
	global $pagesArray;
	if(!$pagesArray) getPagesXmlValues();	

	if ($field=="content"){
	  $ret=returnPageContent($page); 
	} else {
		if (isset($pagesArray[(string)$page]) && array_key_exists($field, $pagesArray[(string)$page])){
	  		$ret=strip_decode(@$pagesArray[(string)$page][(string)$field]);
		} else {
			$ret = returnPageContent($page,$field);
		}
	} 
	return $ret;
}


/**
 * Get Page Children
 *
 * Return an Array of pages that are children of the requested page/slug
 *
 * @since 3.1
 * @param $page - slug of the page to retrieve content
 * 
 * @returns - Array of slug names 
 * 
 */
function getChildren($page){
	global $pagesArray;
	if(!$pagesArray) getPagesXmlValues();		
	$returnArray = array();
	foreach ($pagesArray as $key => $value) {
	    if ($pagesArray[$key]['parent']==$page){
	      $returnArray[]=$key;
	    }
	}
	return $returnArray;
}

/**
 * Get Page Children - returns multi fields
 *
 * Return an Array of pages that are children of the requested page/slug with optional fields.
 *
 * @since 3.1
 * @param $page - slug of the page to retrieve content
 * @param options - array of optional fields to return
 * 
 * @returns - Array of slug names and optional fields. 
 * 
 */

function getChildrenMulti($page,$options=array()){
	global $pagesArray;
	if(!$pagesArray) getPagesXmlValues();		
	$count=0;
	$returnArray = array();
	foreach ($pagesArray as $key => $value) {
	    if ($pagesArray[$key]['parent']==$page){
	      	$returnArray[$count]=array();
			$returnArray[$count]['url']=$key;
	    	foreach ($options as $option){
	    		$returnArray[$count][$option]=returnPageField($key,$option);
	    	}
			$count++;
		}
	}
	return $returnArray;
}

/**
 * Get Cached Pages XML Values
 *
 * Loads the Cached XML data into the Array $pagesArray
 * If the file does not exist it is created the first time. 
 *
 * @since 3.1
 *  
 */
function getPagesXmlValues($chkcount=false){
  global $pagesArray;

   // debugLog(__FUNCTION__.": chkcount - " .(int)$chkcount);
   
   // if page cache not load load it
   if(!$pagesArray){
		$pagesArray=array();
		$file=GSDATAOTHERPATH."pages.xml";
		if (file_exists($file)){
			// load the xml file and setup the array. 
			// debugLog(__FUNCTION__.": load pages.xml");
			$thisfile = file_get_contents($file);
			$data = simplexml_load_string($thisfile);
			$pages = $data->item;
			  foreach ($pages as $page) {
			    $key=$page->url;
			    $pagesArray[(string)$key]=array();
			    foreach ($page->children() as $opt=>$val) {
			        $pagesArray[(string)$key][(string)$opt]=(string)$val;
			    }
			  }
		}
		else {
			// no page cache, regen and then load it
			// debugLog(__FUNCTION__.": pages.xml not exist");			
   		 	if(create_pagesxml(true)) getPagesXmlValues(false);
   		 	return;
  		}
  	}

  	// if checking cache sync, regen cache if pages differ.
	if ($chkcount==true){
		$path = GSDATAPAGESPATH;
		$dir_handle = @opendir($path) or die("getPageXmlValues: Unable to open $path");
		$filenames = array();
		while ($filename = readdir($dir_handle)) {
			$ext = substr($filename, strrpos($filename, '.') + 1);
			if ($ext=="xml"){
		  		$filenames[] = $filename;
			}
		}
		if (count($pagesArray)!=count($filenames)) {
			// debugLog(__FUNCTION__.": count differs regen pages.xml");
			if(create_pagesxml(true)) getPagesXmlValues(false);
		}
	}
  
}

/**
 * Create the Cached Pages XML file
 *
 * Reads in each page of the site and creates a single XML file called 
 * data/pages/pages.array 
 *
 * @since 3.1
 *  
 */
function create_pagesxml($flag){
global $pagesArray;

$success = '';

// debugLog("create_pagesxml: " . $flag);
if ((isset($_GET['upd']) && $_GET['upd']=="edit-success") || $flag===true || $flag=='true'){
  $pagesArray = array();
  // debugLog("create_pagesxml proceeding");
  $menu = '';
  $filem=GSDATAOTHERPATH."pages.xml";

  $path = GSDATAPAGESPATH;
  $dir_handle = @opendir($path) or die("create_pagesxml: Unable to open $path");
  $filenames = array();
  while ($filename = readdir($dir_handle)) {
    $ext = substr($filename, strrpos($filename, '.') + 1);
    if ($ext=="xml"){
      $filenames[] = $filename;
    }
  }
  
  $count=0;
  $xml = new SimpleXMLExtended('<?xml version="1.0" encoding="UTF-8"?><channel></channel>');  
  if (count($filenames) != 0) {
    foreach ($filenames as $file) {
      if ($file == "." || $file == ".." || is_dir(GSDATAPAGESPATH.$file) || $file == ".htaccess"  ) {
        // not a page data file
      } else {
        $thisfile = file_get_contents($path.$file);
        $data = simplexml_load_string($thisfile);
        
        if(!$data){
        	// handle corrupt page xml
        	debugLog("page $file is corrupt");
        	continue;
        }
        
        $count++;   
        $id=$data->url;
        
    	$pages = $xml->addChild('item');
        // $pages->addChild('url', $id);
        // $pagesArray[(string)$id]['url']=(string)$id;            
                
        foreach ($data->children() as $item => $itemdata) {
                if ($item!="content"){
                        $note = $pages->addChild($item);
                $note->addCData($itemdata);
                $pagesArray[(string)$id][$item]=(string)$itemdata;
                }
        }
                
        $note = $pages->addChild('slug');
        $note->addCData($id);
        $pagesArray[(string)$id]['slug']=(string)$id;
                
        $pagesArray[(string)$id]['filename']=$file;
        $note = $pages->addChild('filename'); 
        $note->addCData($file);
			  
      } // else
    } // end foreach
  }   // endif      
  if ($flag===true || $flag == 'true'){

  	// Plugin Authors should add custom fields etc.. here
  	$xml = exec_filter('pagecache',$xml);

    // sanity check in case the filter does not come back properly or returns null
    if($xml){ 
    	$success = XMLsave($xml,$filem);
  	}	
  	// debugLog("create_pagesxml saved: ". $success);
  	exec_action('pagecache-aftersave');
  	return $success;
  }
}
}



?>