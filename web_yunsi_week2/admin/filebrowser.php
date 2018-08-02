<?php


// Setup inclusions
include('inc/common.php');

$filesSorted=null;$dirsSorted=null;

$path = (isset($_GET['path'])) ? "../data/uploads/".$_GET['path'] : "../data/uploads/";
$subPath = (isset($_GET['path'])) ? $_GET['path'] : "";
if(!path_is_safe($path,GSDATAUPLOADPATH)) die();
$returnid = isset($_GET['returnid']) ? var_out($_GET['returnid']) : "";
$func = (isset($_GET['func'])) ? var_out($_GET['func']) : "";
$path = tsl($path);
// check if host uses Linux (used for displaying permissions
$isUnixHost = (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' ? false : true);
$CKEditorFuncNum = isset($_GET['CKEditorFuncNum']) ? var_out($_GET['CKEditorFuncNum']) : '';
$sitepath = suggest_site_path();
$fullPath = $sitepath . "data/uploads/";
$type = isset($_GET['type']) ? var_out($_GET['type']) : '';

global $LANG;
$LANG_header = preg_replace('/(?:(?<=([a-z]{2}))).*/', '', $LANG);
?>
<!DOCTYPE html>
<html lang="<?php echo $LANG_header; ?>">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"  />
	<title><?php echo i18n_r('FILE_BROWSER'); ?></title>
	<link rel="shortcut icon" href="favicon.png" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="template/style.php?v=<?php echo GSVERSION; ?>" media="screen" />
	<style>
		.wrapper, #maincontent, #imageTable { width: 100% }
	</style>
	<script type='text/javascript'>	
		 
	function submitLink($funcNum, $url) {
        <?php if (isset($_GET['returnid'])){ ?>
            if(window.opener){
            	window.opener.document.getElementById('<?php echo $returnid; ?>').focus();
                window.opener.document.getElementById('<?php echo $returnid; ?>').value=$url;
            }
        <?php 
			if (isset($_GET['func'])){
		?>
				if(window.opener){
					if(typeof window.opener.<?php echo $func; ?> == 'function') {
						window.opener.<?php echo $func; ?>('<?php echo $returnid; ?>');
					}
				}		
		<?php 
			}
		}
		 else { ?>
            if(window.opener){
                window.opener.CKEDITOR.tools.callFunction($funcNum, $url);
            }
        <?php } ?>
        window.close();
    }
	</script>
</head>
<body id="filebrowser" >	
 <div class="wrapper">
  <div id="maincontent">
	<div class="main" style="border:none;">
		<h3><?php echo i18n('UPLOADED_FILES'); ?><span id="filetypetoggle">&nbsp;&nbsp;/&nbsp;&nbsp;<?php echo ($type == 'images' ? i18n('IMAGES') : i18n('SHOW_ALL') ); ?></span></h3>
<?php
	$count="0";
	$dircount="0";
	$counter = "0";
	$totalsize = 0;
	$filesArray = array();
	$dirsArray = array();

	$filenames = getFiles($path);
	if (count($filenames) != 0) { 
		foreach ($filenames as $file) {
			if ($file == "." || $file == ".." || $file == ".htaccess" ){
			// not a upload file
			} elseif (is_dir($path . $file)) {
			$dirsArray[$dircount]['name'] = $file;
			$dircount++;
			} else {
				$filesArray[$count]['name'] = $file;
				$ext = substr($file, strrpos($file, '.') + 1);
				$extention = get_FileType($ext);
				$filesArray[$count]['type'] = $extention;
				clearstatcache();
				$ss = @stat($path . $file);
				$filesArray[$count]['date'] = @date('M j, Y',$ss['mtime']);
				$filesArray[$count]['size'] = fSize($ss['size']);
				$totalsize = $totalsize + $ss['size'];
				$count++;
			}
		}
		$filesSorted = subval_sort($filesArray,'name');
		$dirsSorted = subval_sort($dirsArray,'name');
	}

	$pathParts=explode("/",$subPath);
	$urlPath="";

	echo '<div class="h5">/ <a href="?CKEditorFuncNum='.$CKEditorFuncNum.'&amp;type='.$type.'">uploads</a> / ';
	foreach ($pathParts as $pathPart){
		if ($pathPart!=''){
			$urlPath.=$pathPart."/";
			echo '<a href="?path='.$urlPath.'&amp;CKEditorFuncNum='.$CKEditorFuncNum.'&amp;type='.$type.'&amp;func='.$func.'">'.$pathPart.'</a> / ';
		}
	}
	echo "</div>";

	echo '<table class="highlight" id="imageTable">';

	if (count($dirsSorted) != 0) {       
		foreach ($dirsSorted as $upload) {
			echo '<tr class="All" >';  
			echo '<td class="" colspan="5">';
			$adm = substr($path . $upload['name'] ,  16); 
			if ($returnid!='') {
				$returnlink = '&returnid='.$returnid;
			} else {
				$returnlink='';
			}
			if ($func!='') {
				$funct = '&func='.$func;
			} else {
				$funct='';
			}
			echo '<img src="template/images/folder.png" width="11" /> <a href="filebrowser.php?path='.$adm.'&amp;CKEditorFuncNum='.$CKEditorFuncNum.'&amp;type='.$type.$returnlink.'&amp;'.$funct.'" title="'. $upload['name'] .'"  ><strong>'.$upload['name'].'</strong></a>';
			echo '</td>';
			echo '</tr>';
		}
	}

	if (count($filesSorted) != 0) { 			
		foreach ($filesSorted as $upload) {
			$upload['name'] = rawurlencode($upload['name']);
			$thumb = null; $thumbnailLink = null;
			$subDir = ($subPath == '' ? '' : $subPath.'/');
			$selectLink = 'title="'.i18n_r('SELECT_FILE').': '. htmlspecialchars($upload['name']) .'" href="javascript:void(0)" onclick="submitLink('.$CKEditorFuncNum.',\''.$fullPath.$subDir.$upload['name'].'\')"';

			if ($type == 'images') {
				if ($upload['type'] == i18n_r('IMAGES') .' Images') {
					# get internal thumbnail to show beside link in table
					$thumb = '<td class="imgthumb" style="display:table-cell" >';
					$thumbLink = $urlPath.'thumbsm.'.$upload['name'];
					if (file_exists('../data/thumbs/'.$thumbLink)) {
						$imgSrc='<img src="../data/thumbs/'. $thumbLink .'" />';
					} else {
						$imgSrc='<img src="inc/thumb.php?src='. $urlPath . $upload['name'] .'&amp;dest='. $thumbLink .'&amp;x=65&amp;f=1" />';
					}
					$thumb .= '<a '.$selectLink.' >'.$imgSrc.'</a>';
					$thumb .= '</td>';
					
					# get external thumbnail link
					$thumbLinkExternal = 'data/thumbs/'.$urlPath.'thumbnail.'.$upload['name'];
					if (file_exists('../'.$thumbLinkExternal)) {
					$thumbnailLink = '<span>&nbsp;&ndash;&nbsp;&nbsp;</span><a href="javascript:void(0)" onclick="submitLink('.$CKEditorFuncNum.',\''.$sitepath.$thumbLinkExternal.'\')">'.i18n_r('THUMBNAIL').'</a>';
					}
				}
				else { continue; }
			}

			$counter++;	

			echo '<tr class="All '.$upload['type'].'" >';
			echo ($thumb=='' ? '<td style="display: none"></td>' : $thumb);
			echo '<td><a '.$selectLink.' class="primarylink">'.htmlspecialchars($upload['name']) .'</a>'.$thumbnailLink.'</td>';
			echo '<td style="width:80px;text-align:right;" ><span>'. $upload['size'] .'</span></td>';

			// get the file permissions.
			if ($isUnixHost && isDebug() && function_exists('posix_getpwuid')) {
				$filePerms = substr(sprintf('%o', fileperms($path.$upload['name'])), -4);
				$fileOwner = posix_getpwuid(fileowner($path.$upload['name']));
				echo '<td style="width:70px;text-align:right;"><span>'.$fileOwner['name'].'/'.$filePerms.'</span></td>';
			}

			echo '<td style="width:85px;text-align:right;" ><span>'. shtDate($upload['date']) .'</span></td>';
			echo '</tr>';
		}

	}
	echo '</table>';
	echo '<p><em><b>'. $counter .'</b> '.i18n_r('TOTAL_FILES').' ('. fSize($totalsize) .')</em></p>';
?>	
	</div>
  </div>
 </div>	
</body>
</html>
