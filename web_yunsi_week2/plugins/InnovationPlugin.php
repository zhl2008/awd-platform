<?php


# get correct id for plugin
$thisfile_innov=basename(__FILE__, ".php");
$innovation_file=GSDATAOTHERPATH .'InnovationSettings.xml';

# add in this plugin's language file
i18n_merge($thisfile_innov) || i18n_merge($thisfile_innov, 'en_US');

# register plugin
register_plugin(
	$thisfile_innov, 								# ID of plugin, should be filename minus php
	i18n_r($thisfile_innov.'/INNOVATION_TITLE'), 	# Title of plugin
	'1.2', 											# Version of plugin
	'Chris Cagle',									# Author of plugin
	'http://chriscagle.me', 						# Author URL
	i18n_r($thisfile_innov.'/INNOVATION_DESC'), 	# Plugin Description
	'theme', 										# Page type of plugin
	'innovation_show'  								# Function that displays content
);

$hidemenu = true;

# hooks
# enable side menu is theme is innovation or on theme page and enabling innovation, handle plugin exec before global is set
if(	!$hidemenu || (
	( $TEMPLATE == "Innovation" || 	( get_filename_id() == 'theme' && isset($_POST['template']) && $_POST['template'] == 'Innovation') ) &&
	!( $TEMPLATE == "Innovation" && get_filename_id() == 'theme' && isset($_POST['template']) && $_POST['template'] != 'Innovation') )
) {
	add_action('theme-sidebar','createSideMenu',array($thisfile_innov, i18n_r($thisfile_innov.'/INNOVATION_TITLE'))); 
}

$services = array(
	'facebook',
	'googleplus',
	'twitter',
	'linkedin',
	'tumblr',
	'instagram',
	'youtube',
	'vimeo',
	'github'
);

# get XML data
if (file_exists($innovation_file)) {
	$innovation_data = getXML($innovation_file);
}

function innovation_show() {
	global $services,$innovation_file, $innovation_data, $thisfile_innov;
	$success=$error=null;
	
	// submitted form
	if (isset($_POST['submit'])) {		
		foreach($services as $var){			
			if ($_POST[$var] != '') {
				if (validate_url($_POST[$var])) {
					$resp[$var] = $_POST[$var];
				} else {
					$error .= i18n_r($thisfile_innov.'/'.strtoupper($var).'_ERROR').' ';
				}
			}			
		}
		
		# if there are no errors, save data
		if (!$error) {
			$xml = @new SimpleXMLElement('<item></item>');
			foreach($services as $var){			
				if(isset($resp[$var])) $xml->addChild($var, $resp[$var]);
			}
							
			if (! $xml->asXML($innovation_file)) {
				$error = i18n_r('CHMOD_ERROR');
			} else {
				$innovation_data = getXML($innovation_file);
				$success = i18n_r('SETTINGS_UPDATED');
			}
		}
	}
	
	?>
	<h3><?php i18n($thisfile_innov.'/INNOVATION_TITLE'); ?></h3>
	
	<?php 
	if($success) { 
		echo '<p style="color:#669933;"><b>'. $success .'</b></p>';
	} 
	if($error) { 
		echo '<p style="color:#cc0000;"><b>'. $error .'</b></p>';
	}
	?>
	
	<form method="post" action="<?php	echo $_SERVER ['REQUEST_URI']?>">
		
		<?php 
			foreach($services as $var){
				$value = '';
				if(isset($innovation_data->$var)) $value = $innovation_data->$var;
				echo '<p><label for="inn_'.$var.'" >' . i18n($thisfile_innov.'/'.strtoupper($var).'_URL') .'</label><input id="inn_'.$var.'" name="'.$var.'" class="text" value="'.$value.'" type="url" /></p>';
			}
		?>

		<p><input type="submit" id="submit" class="submit" value="<?php i18n('BTN_SAVESETTINGS'); ?>" name="submit" /></p>
	</form>
	
	<?php
}
