<?php

 
# setup inclusions
$load['plugin'] = true;
include('inc/common.php');

# variable settings
$userid 	= login_cookie_check();
$file 		= "components.xml";
$path 		= GSDATAOTHERPATH;
$bakpath 	= GSBACKUPSPATH .'other/';
$update 	= ''; $table = ''; $list='';

# check to see if form was submitted
if (isset($_POST['submitted'])){
	$value = $_POST['val'];
	$slug = $_POST['slug'];
	$title = $_POST['title'];
	$ids = $_POST['id'];
	
	// check for csrf
	if (!defined('GSNOCSRF') || (GSNOCSRF == FALSE) ) {
		$nonce = $_POST['nonce'];	
		if(!check_nonce($nonce, "modify_components")) {
			die("CSRF detected!");
		}
	}

	# create backup file for undo           
	createBak($file, $path, $bakpath);
	
	# start creation of top of components.xml file
	$xml = new SimpleXMLExtended('<?xml version="1.0" encoding="UTF-8"?><channel></channel>');
	if (count($ids) != 0) { 
		
		$ct = 0; $coArray = array();
		foreach ($ids as $id)		{
			if ($title[$ct] != null) {
				if ( $slug[$ct] == null )	{
					$slug_tmp = to7bit($title[$ct], 'UTF-8');
					$slug[$ct] = clean_url($slug_tmp); 
					$slug_tmp = '';
				}
				
				$coArray[$ct]['id'] = $ids[$ct];
				$coArray[$ct]['slug'] = $slug[$ct];
				$coArray[$ct]['title'] = safe_slash_html($title[$ct]);
				$coArray[$ct]['value'] = safe_slash_html($value[$ct]);
				
			}
			$ct++;
		}
		
		$ids = subval_sort($coArray,'title');
		
		$count = 0;
		foreach ($ids as $comp)	{
			# create the body of components.xml file
			$components = $xml->addChild('item');
			$c_note = $components->addChild('title');
			$c_note->addCData($comp['title']);
			$components->addChild('slug', $comp['slug']);
			$c_note = $components->addChild('value');
			$c_note->addCData($comp['value']);
			$count++;
		}
	}
	exec_action('component-save');
	XMLsave($xml, $path . $file);
	redirect('components.php?upd=comp-success');
}

# if undo was invoked
if (isset($_GET['undo'])) { 
	
	# check for csrf
	$nonce = $_GET['nonce'];	
	if(!check_nonce($nonce, "undo")) {
		die("CSRF detected!");
	}
	
	# perform the undo
	undo($file, $path, $bakpath);
	redirect('components.php?upd=comp-restored');
}

# create components form html
$data = getXML($path . $file);
$componentsec = $data->item;
$count= 0;
if (count($componentsec) != 0) {
	foreach ($componentsec as $component) {
		$table .= '<div class="compdiv" id="section-'.$count.'"><table class="comptable" ><tr><td><b title="'.i18n_r('DOUBLE_CLICK_EDIT').'" class="editable">'. stripslashes($component->title) .'</b></td>';
		$table .= '<td style="text-align:right;" ><code>&lt;?php get_component(<span class="compslugcode">\''.$component->slug.'\'</span>); ?&gt;</code></td><td class="delete" >';
		$table .= '<a href="#" title="'.i18n_r('DELETE_COMPONENT').': '. cl($component->title).'?" class="delcomponent" rel="'.$count.'" >&times;</a></td></tr></table>';
		$table .= '<textarea name="val[]">'. stripslashes($component->value) .'</textarea>';
		$table .= '<input type="hidden" class="compslug" name="slug[]" value="'. $component->slug .'" />';
		$table .= '<input type="hidden" class="comptitle" name="title[]" value="'. stripslashes($component->title) .'" />';
		$table .= '<input type="hidden" name="id[]" value="'. $count .'" />';
		exec_action('component-extras');
		$table .= '</div>';
		$count++;
	}
}
	# create list to show on sidebar for easy access
	$listc = ''; $submitclass = '';
	if($count > 1) {
		$item = 0;
		foreach($componentsec as $component) {
			$listc .= '<a id="divlist-' . $item . '" href="#section-' . $item . '" class="component">' . $component->title . '</a>';
			$item++;
		}
	} elseif ($count == 0) {
		$submitclass = 'hidden';
		
	}

get_template('header', cl($SITENAME).' &raquo; '.i18n_r('COMPONENTS')); 

?>
	
<?php include('template/include-nav.php'); ?>

<div class="bodycontent clearfix">
	
	<div id="maincontent">
	<div class="main">
	<h3 class="floated"><?php echo i18n('EDIT_COMPONENTS');?></h3>
	<div class="edit-nav" >
		<a href="#" id="addcomponent" accesskey="<?php echo find_accesskey(i18n_r('ADD_COMPONENT'));?>" ><?php i18n('ADD_COMPONENT');?></a>
		<div class="clear"></div>
	</div>
	
	<form class="manyinputs" action="<?php myself(); ?>" method="post" accept-charset="utf-8" >
		<input type="hidden" id="id" value="<?php echo $count; ?>" />
		<input type="hidden" id="nonce" name="nonce" value="<?php echo get_nonce("modify_components"); ?>" />

		<div id="divTxt"></div> 
		<?php echo $table; ?>
		<p id="submit_line" class="<?php echo $submitclass; ?>" >
			<span><input type="submit" class="submit" name="submitted" id="button" value="<?php i18n('SAVE_COMPONENTS');?>" /></span> &nbsp;&nbsp;<?php i18n('OR'); ?>&nbsp;&nbsp; <a class="cancel" href="components.php?cancel"><?php i18n('CANCEL'); ?></a>
		</p>
	</form>
	</div>
	</div>
	
	<div id="sidebar">
		<?php include('template/sidebar-theme.php'); ?>
		<?php if ($listc != '') { echo '<div class="compdivlist">'.$listc .'</div>'; } ?>
	</div>

</div>
<?php get_template('footer'); ?>