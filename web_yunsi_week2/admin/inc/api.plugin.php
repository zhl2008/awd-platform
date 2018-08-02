<?php


# get correct id for plugin
$thisfileapi=basename(__FILE__, ".php");


# register plugin
register_plugin(
	$thisfileapi,
	'Website API',
	'0.1',
	'Chris Cagle',
	'http://www.developer.com/',
	'Connect to your site from an external application',
	'settings',
	'gsapi_display_cp'
);

# activate hooks
add_action('settings-sidebar','createSideMenu',array($thisfileapi, i18n_r('API_CONFIGURATION'))); 

function gsapi_display_cp() {
	$thisdatafile = GSDATAOTHERPATH.'appid.xml';
	
	# if form as submitted
	if (isset($_POST['submit'])) {
		if (isset($_POST['regenerate'])) {
			$api_key = strtoupper(substr(md5(uniqid(rand(), true)),0,10));
		} else {
			$api_key = $_POST['apikey'];
		}
		if (isset($_POST['status'])) {
			$api_status = $_POST['status'];
		} else {
			$api_status = null;
		}
		
		$xml = new SimpleXMLExtended('<?xml version="1.0" encoding="UTF-8"?><item></item>');
		$xml->addChild('status', $api_status);
		$xml->addChild('key', $api_key);
		XMLsave($xml, $thisdatafile);
	}
	
	# if the api file does not exist
	if (!file_exists($thisdatafile)) {
		$xml = new SimpleXMLExtended('<?xml version="1.0" encoding="UTF-8"?><item></item>');
		$xml->addChild('status', 'false');
		$xml->addChild('key', strtoupper(substr(md5(uniqid(rand(), true)),0,10)) );
		XMLsave($xml, $thisdatafile);
	}
	
	# get data to show in control panel
	$api=getXML($thisdatafile);
	$enabled_status = null;
	if ($api->status == 'true') {
		$enabled_status = 'checked';
	} 
	
	?>
	<script>
		jQuery(document).ready(function() { 
			$('a[rel="regenerate"]').live("click", function($e) {
				$e.preventDefault();
				$('#regeneratewrap').slideToggle();
			});
			$('a.cancel[rel="regenerate"]').live("click", function($e) {
				$e.preventDefault();
				$('#regenerate').attr('checked', false);
			});
		});
	</script>
	<style>
		#regeneratewrap {padding:10px 10px 0 10px;background:#f6f6f6;border:1px solid #e5e5e5;margin-bottom:20px;}
		code#apicode {font-size:26px;font-weight:bold;color:#cc0000;}
	</style>
	<h3>website <?php i18n('API_CONFIGURATION'); ?></h3>
	
	<form method="post" action="<?php	echo $_SERVER ['REQUEST_URI']?>">
	<p>
		<label><input type="checkbox" name="status" value="true" <?php echo $enabled_status; ?> /> &nbsp; <?php i18n('API_ENABLE'); ?> *</label>
	</p>	
	<p>
		<code id="apicode">
			<?php echo $api->key; ?>
			<input type="hidden" name="apikey" value="<?php echo $api->key; ?>" />
		</code> &nbsp;&nbsp; <small><a href="#" rel="regenerate" ><?php i18n('API_REGENKEY'); ?></a></small>
	</p>
	<div class="toggle" id="regeneratewrap"  >
		<p><strong><?php i18n('API_CONFIRM'); ?></strong><br /><?php i18n('API_REGEN_DISCLAIMER'); ?> <a href="#" class="cancel" rel="regenerate" ><?php i18n('CANCEL'); ?></a></p>
		<p><label><?php i18n('API_REGENKEY'); ?>: &nbsp; <input type="checkbox" id="regenerate" name="regenerate" value="true" /></label></p>
	</div>
	<p class="submit"><input type="submit" id="submit" class="submit" name="submit" value="<?php i18n('BTN_SAVESETTINGS'); ?>" /></p>
	</form>
	<p><span class="hint">* <?php i18n('API_DISCLAIMER'); ?></span></p>

	<?php
}