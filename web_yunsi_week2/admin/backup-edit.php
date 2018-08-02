<?php

 
# setup
$load['plugin'] = true;
include('inc/common.php');
$userid = login_cookie_check();

# get page url to display
if ($_GET['id'] != '') {
	$id = $_GET['id'];
	$file = $id .".bak.xml";
	$path = GSBACKUPSPATH .'pages/';
	
	if(!filepath_is_safe($path.$file,$path)) die();

	$data = getXML($path . $file);
	$title = htmldecode($data->title);
	$pubDate = $data->pubDate;
	$parent = $data->parent;
	$metak = htmldecode($data->meta);
	$metad = htmldecode($data->metad);
	$url = $data->url;
	$content = htmldecode($data->content);
	$private = $data->private;
	$template = $data->template;
	$menu = htmldecode($data->menu);
	$menuStatus = $data->menuStatus;
	$menuOrder = $data->menuOrder;
} else {
	redirect('backups.php?upd=bak-err');
}

if ($private != '' ) { $private = '<span style="color:#cc0000">('.i18n_r('PRIVATE_SUBTITLE').')</span>'; } else { $private = ''; }
if ($menuStatus == '' ) { $menuStatus = i18n_r('NO'); } else { $menuStatus = i18n_r('YES'); }

// are we going to do anything with this backup?
if ($_GET['p'] != '') {
	$p = $_GET['p'];
} else {
	redirect('backups.php?upd=bak-err');
}

if ($p == 'delete') {
	// check for csrf
	if (!defined('GSNOCSRF') || (GSNOCSRF == FALSE) ) {
		$nonce = $_GET['nonce'];
		if(!check_nonce($nonce, "delete", "backup-edit.php")) {
			die("CSRF detected!");
		}
	}
	delete_bak($id);
	redirect("backups.php?upd=bak-success&id=".$id);
} 

elseif ($p == 'restore') {
	// check for csrf
	if (!defined('GSNOCSRF') || (GSNOCSRF == FALSE) ) {
		$nonce = $_GET['nonce'];
		if(!check_nonce($nonce, "restore", "backup-edit.php")) {
			die("CSRF detected!");	
		}
	}
	if (isset($_GET['new'])) {
		updateSlugs($_GET['new'], $id);
		restore_bak($id);
		$existing = GSDATAPAGESPATH . $_GET['new'] .".xml";
		$bakfile = GSBACKUPSPATH."pages/". $_GET['new'] .".bak.xml";
		if(!filepath_is_safe($existing,GSDATAPAGESPATH)) die();
		copy($existing, $bakfile);
		unlink($existing);
		redirect("edit.php?id=". $id ."&old=".$_GET['new']."&upd=edit-success&type=restore");
	} else {
		restore_bak($id);
		redirect("edit.php?id=". $id ."&upd=edit-success&type=restore");
	}
	
	
}

get_template('header', cl($SITENAME).' &raquo; '. i18n_r('BAK_MANAGEMENT').' &raquo; '.i18n_r('VIEWPAGE_TITLE')); 

?>
	
<?php include('template/include-nav.php'); ?>

<div class="bodycontent clearfix">
	
	<div id="maincontent">
		<div class="main" >
		<h3 class="floated"><?php i18n('BACKUP_OF');?> &lsquo;<em><?php echo $url; ?></em>&rsquo;</h3>
		
		<div class="edit-nav" >
			 <a href="backup-edit.php?p=restore&amp;id=<?php echo var_out($id); ?>&amp;nonce=<?php echo get_nonce("restore", "backup-edit.php"); ?>" 
			 	accesskey="<?php echo find_accesskey(i18n_r('ASK_RESTORE'));?>" ><?php i18n('ASK_RESTORE');?></a> 
			 <a href="backup-edit.php?p=delete&amp;id=<?php echo var_out($id); ?>&amp;nonce=<?php echo get_nonce("delete", "backup-edit.php"); ?>" 
			 	title="<?php i18n('DELETEPAGE_TITLE'); ?>: <?php echo var_out($title); ?>?" 
			 	id="delback" 
			 	accesskey="<?php echo find_accesskey(i18n_r('ASK_DELETE'));?>" 
			 	class="delconfirm noajax" ><?php i18n('ASK_DELETE');?></a>
			<div class="clear"></div>
		</div>
		
		<table class="simple highlight" >
		<tr><td class="title" ><?php i18n('PAGE_TITLE');?>:</td><td><b><?php echo cl($title); ?></b> <?php echo $private; ?></td></tr>
		<tr><td class="title" ><?php i18n('BACKUP_OF');?>:</td><td>
			<?php 
			if(isset($id)) {
					echo '<a target="_blank" href="'. find_url($url, $parent) .'">'. find_url($url, $parent) .'</a>'; 
			} 
			?>
		</td></tr>
		<tr><td class="title" ><?php i18n('DATE');?>:</td><td><?php echo lngDate($pubDate); ?></td></tr>
		<tr><td class="title" ><?php i18n('TAG_KEYWORDS');?>:</td><td><em><?php echo $metak; ?></em></td></tr>
		<tr><td class="title" ><?php i18n('META_DESC');?>:</td><td><em><?php echo $metad; ?></em></td></tr>
		<tr><td class="title" ><?php i18n('MENU_TEXT');?>:</td><td><?php echo $menu; ?></td></tr>
		<tr><td class="title" ><?php i18n('PRIORITY');?>:</td><td><?php echo $menuOrder; ?></td></tr>
		<tr><td class="title" ><?php i18n('ADD_TO_MENU');?></td><td><?php echo $menuStatus; ?></td></tr>
		</table>
		
		<textarea id="codetext" wrap='off' style="background:#f4f4f4;padding:4px;width:635px;color:#444;border:1px solid #666;" readonly ><?php echo strip_decode($content); ?></textarea>

		</div>
		
		<?php if ($HTMLEDITOR != '') { ?>
		<script type="text/javascript" src="template/js/ckeditor/ckeditor.js<?php echo getDef("GSCKETSTAMP",true) ? "?t=".getDef("GSCKETSTAMP") : ""; ?>"></script>
		<script type="text/javascript">
		<?php if(getDef("GSCKETSTAMP",true)) echo "CKEDITOR.timestamp = '".getDef("GSCKETSTAMP") . "';\n"; ?>
		var editor = CKEDITOR.replace( 'codetext', {
			skin : 'getsimple',
			language : '<?php echo $EDLANG; ?>',
			defaultLanguage : '<?php echo $EDLANG; ?>',
			<?php if (file_exists(GSTHEMESPATH .$TEMPLATE."/editor.css")) { 
				$fullpath = suggest_site_path();
			?>
			contentsCss: '<?php echo $fullpath; ?>theme/<?php echo $TEMPLATE; ?>/editor.css',
			<?php } ?>
			entities : false,
			// uiColor : '#FFFFFF',
			height: '<?php echo $EDHEIGHT; ?>',
			baseHref : '<?php echo $SITEURL; ?>',
			toolbar : [['Source']],
			removePlugins: 'image,link,elementspath,resize'
		});
		// set editor to read only mode
		editor.on('mode', function (ev) {
			if (ev.editor.mode == 'source') {
				$('#cke_contents_codetext .cke_source').attr("readonly", "readonly");
			}
			else {
				var bodyelement = ev.editor.document.$.body;
				bodyelement.setAttribute("contenteditable", false);
			}		
		});
		</script>
		
		<?php } ?>
		
	</div>
	
	<div id="sidebar" >
		<?php include('template/sidebar-backups.php'); ?>
	</div>

</div>
<?php get_template('footer'); ?>
