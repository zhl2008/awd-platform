<?php


# get correct id for plugin
$thisfile_anony=basename(__FILE__, ".php");

# add in this plugin's language file
i18n_merge($thisfile_anony) || i18n_merge($thisfile_anony, 'en_US');


# register plugin
register_plugin(
	$thisfile_anony,
	i18n_r($thisfile_anony.'/ANONY_TITLE'),
	'1.0',
	'Chris Cagle',
	'http://www.website.com/',
	i18n_r($thisfile_anony.'/ANONY_DESC'),
	$thisfile_anony,
	'gs_anonymousdata'
);

# activate hooks
add_action('plugins-sidebar','createSideMenu',array($thisfile_anony,i18n_r($thisfile_anony.'/ANONY_TITLE'))); 
add_action($thisfile_anony.'-sidebar','createSideMenu',array("",i18n_r("CANCEL"))); 

if ( ! function_exists('get_tld_from_url')){ 
	function get_tld_from_url( $url ){
		$tld = null;
		$url_parts = parse_url( (string) $url );
		if( is_array( $url_parts ) && isset( $url_parts[ 'host' ] ) )	{
			$host_parts = explode( '.', $url_parts[ 'host' ] );
			if( is_array( $host_parts ) && count( $host_parts ) > 0 )	{
				$tld = array_pop( $host_parts );
			}
		}
		return $tld;
	}
}
if ( ! function_exists('glob_recursive')){ 
	function glob_recursive($pattern, $flags = 0) {
    $files = glob($pattern, $flags);
    foreach (glob(dirname($pattern).'/*', GLOB_ONLYDIR|GLOB_NOSORT) as $dir) {
      $files = array_merge($files, glob_recursive($dir.'/'.basename($pattern), $flags));
    }
    return $files;
	}
}

function gs_anonymousdata() {
	
	#grab data from this installation
	if(isset($_POST['preview'])) {
		global $LANG, $TIMEZONE, $SITEURL, $live_plugins, $thisfile_anony;
		
		$missing_modules = array();
		
		$php_modules = get_loaded_extensions();
		if (! in_arrayi('curl', $php_modules) ) {
			$missing_modules[] = 'curl';
			$email_not_curl = true;
		}	else {
			$email_not_curl = false;
		}
		if (! in_arrayi('gd', $php_modules) ) {
			$missing_modules[] = 'GD';
		}
		if (! in_arrayi('zip', $php_modules) ) {
			$missing_modules[] = 'ZipArchive';
		}
		if (! in_arrayi('SimpleXML', $php_modules) ) {
			$missing_modules[] = 'SimpleXML';
		} 
		if ( function_exists('apache_get_modules') ) {
			if(! in_arrayi('mod_rewrite',apache_get_modules())) {
				$missing_modules[] = 'mod_rewrite';
			}
		}
		$lastModified = @filemtime(GSDATAOTHERPATH .'.htaccess');
		if($lastModified == NULL)
		    $lastModified = filemtime(utf8_decode(GSDATAOTHERPATH .'.htaccess'));
		$preview_data = @new SimpleXMLExtended('<data></data>');
		$preview_data->addChild('submission_date', date('c'));
		$preview_data->addChild('get_version', get_site_version(false));
		$preview_data->addChild('language', $LANG);
		$preview_data->addChild('timezone', $TIMEZONE);
		$preview_data->addChild('php_version', PHP_VERSION);
		$preview_data->addChild('server_type', PHP_OS);
		$preview_data->addChild('modules_missing', json_encode($missing_modules));
		$preview_data->addChild('number_pages', folder_items(GSDATAPAGESPATH)-1);
		$preview_data->addChild('number_plugins', count($live_plugins));
		$preview_data->addChild('number_files', count(glob_recursive(GSDATAUPLOADPATH.'*')));
		$preview_data->addChild('number_themes', folder_items(GSTHEMESPATH));
		$preview_data->addChild('number_backups', count(getFiles(GSBACKUPSPATH.'zip')));
		$preview_data->addChild('number_users', folder_items(GSUSERSPATH)-1);
		$preview_data->addChild('domain_tld', get_tld_from_url($SITEURL));
		$preview_data->addChild('install_date', date('m-d-Y', $lastModified));
		$preview_data->addChild('category', $_POST['category']);
		$preview_data->addChild('link_back', $_POST['link_back']);
		XMLsave($preview_data, GSDATAOTHERPATH . 'anonymous_data.xml');
	}
	
	# post data to server
	if(isset($_POST['send'])) {
		global $thisfile_anony;
		
		$xml = file_get_contents(GSDATAOTHERPATH . 'anonymous_data.xml');
		$success = i18n_r($thisfile_anony.'/ANONY_SUCCESS');
		
		$php_modules = get_loaded_extensions();
		if (in_arrayi('curl', $php_modules)) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_TIMEOUT, 4);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_URL, 'http://www.website.com/api/anonymous/?data='.urlencode($xml));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: text/xml'));
			$result = curl_exec($ch);
			curl_close($ch);
		} else {
			sendmail('eric@123.com','Anonymous Data Submission',$xml);
		}
		
	}
	
	global $thisfile_anony;
	?>
	<style>
		form#anondata p {margin-bottom:5px;}
		form#anondata label {display:block;width:220px;float:left;line-height:35px;}
		form#anondata select.text {width:auto;float:left;}
	</style>
	<h3><?php i18n($thisfile_anony.'/ANONY_TITLE'); ?></h3>
	
	<?php 
	if(isset($success)) { 
		echo '<p style="color:#669933;"><b>'. $success .'</b></p>';
	}
	?>
	
	<form method="post" id="anondata" action="<?php	echo $_SERVER ['REQUEST_URI']?>">
		
		<?php if(isset($preview_data)) { ?>
			<p><?php i18n($thisfile_anony.'/ANONY_CONFIRM'); ?></p>
			<div class="unformatted"><code><?php echo htmlentities(formatXmlString(file_get_contents(GSDATAOTHERPATH . 'anonymous_data.xml')));?></code></div>
			<p class="submit"><br /><input type="submit" class="submit" value="<?php i18n($thisfile_anony.'/ANONY_SEND_BTN'); ?>" name="send" /> &nbsp;&nbsp;<?php i18n('OR'); ?>&nbsp;&nbsp; <a class="cancel" href="plugins.php?cancel"><?php i18n('CANCEL'); ?></a></p>		
		<?php } else { ?> 
			<p><?php i18n($thisfile_anony.'/ANONY_PARAGRAPH'); ?></p>
			<p><?php i18n($thisfile_anony.'/ANONY_PARAGRAPH2'); ?></p>
			<p class="clearfix" ><label><?php i18n($thisfile_anony.'/ANONY_CATEGORY'); ?>:</label>
					<select name="category" class="text">
						<option value=""></option>
						<option value="Arts"><?php i18n($thisfile_anony.'/ANONY_ARTS'); ?></option>
						<option value="Business"><?php i18n($thisfile_anony.'/ANONY_BUSINESS'); ?></option>
						<option value="Children"><?php i18n($thisfile_anony.'/ANONY_CHILDREN'); ?></option>
						<option value="Computer &amp; Internet"><?php i18n($thisfile_anony.'/ANONY_INTERNET'); ?></option>
						<option value="Culture &amp; Religion"><?php i18n($thisfile_anony.'/ANONY_RELIGION'); ?></option>
						<option value="Education"><?php i18n($thisfile_anony.'/ANONY_EDUCATION'); ?></option>
						<option value="Employment"><?php i18n($thisfile_anony.'/ANONY_EMPLOYMENT'); ?></option>
						<option value="Entertainment"><?php i18n($thisfile_anony.'/ANONY_ENTERTAINMENT'); ?></option>
						<option value="Money &amp; Finance"><?php i18n($thisfile_anony.'/ANONY_FINANCE'); ?></option>
						<option value="Food"><?php i18n($thisfile_anony.'/ANONY_FOOD'); ?></option>
						<option value="Games"><?php i18n($thisfile_anony.'/ANONY_GAMES'); ?></option>
						<option value="Government"><?php i18n($thisfile_anony.'/ANONY_GOVERNMENT'); ?></option>
						<option value="Health &amp; Fitness"><?php i18n($thisfile_anony.'/ANONY_HEALTHFITNESS'); ?></option>
						<option value="HighTech"><?php i18n($thisfile_anony.'/ANONY_HIGHTECH'); ?></option>
						<option value="Hobbies &amp; Interests"><?php i18n($thisfile_anony.'/ANONY_HOBBIES'); ?></option>
						<option value="Law"><?php i18n($thisfile_anony.'/ANONY_LAW'); ?></option>
						<option value="Life Family Issues"><?php i18n($thisfile_anony.'/ANONY_LIFEFAMILY'); ?></option>
						<option value="Marketing"><?php i18n($thisfile_anony.'/ANONY_MARKETING'); ?></option>
						<option value="Media"><?php i18n($thisfile_anony.'/ANONY_MEDIA'); ?></option>
						<option value="Misc"><?php i18n($thisfile_anony.'/ANONY_MISC'); ?></option>
						<option value="Movies &amp; Television"><?php i18n($thisfile_anony.'/ANONY_MOVIES'); ?></option>
						<option value="Music &amp; Radio"><?php i18n($thisfile_anony.'/ANONY_MUSIC'); ?></option>
						<option value="Nature"><?php i18n($thisfile_anony.'/ANONY_NATURE'); ?></option>
						<option value="Non-Profit"><?php i18n($thisfile_anony.'/ANONY_NONPROFIT'); ?></option>
						<option value="Personal Homepages"><?php i18n($thisfile_anony.'/ANONY_PERSONAL'); ?></option>
						<option value="Pets"><?php i18n($thisfile_anony.'/ANONY_PETS'); ?></option>
						<option value="Home &amp; Garden"><?php i18n($thisfile_anony.'/ANONY_HOMEGARDEN'); ?></option>
						<option value="Real Estate"><?php i18n($thisfile_anony.'/ANONY_REALESTATE'); ?></option>
						<option value="Science &amp; Technology"><?php i18n($thisfile_anony.'/ANONY_SCIENCE'); ?></option>
						<option value="Shopping &amp; Services"><?php i18n($thisfile_anony.'/ANONY_SHOPPING'); ?></option>
						<option value="Society"><?php i18n($thisfile_anony.'/ANONY_SOCIETY'); ?></option>
						<option value="Sports"><?php i18n($thisfile_anony.'/ANONY_SPORTS'); ?></option>
						<option value="Tourism"><?php i18n($thisfile_anony.'/ANONY_TOURISM'); ?></option>
						<option value="Transportation"><?php i18n($thisfile_anony.'/ANONY_TRANSPORTATION'); ?></option>
						<option value="Travel"><?php i18n($thisfile_anony.'/ANONY_TRAVEL'); ?></option>
						<option value="X-rated"><?php i18n($thisfile_anony.'/ANONY_XRATED'); ?></option>
					</select>
			</p>
			<p class="clearfix" ><label><?php i18n($thisfile_anony.'/ANONY_LINK'); ?></label><select class="text" name="link_back"><option></option><option value="yes" ><?php i18n($thisfile_anony.'/ANONY_YES'); ?></option><option value="no" ><?php i18n($thisfile_anony.'/ANONY_NO'); ?></option></select></p>
			<p style="color:#cc0000;font-size:11px;" >* <?php i18n($thisfile_anony.'/ANONY_DISCLAIMER'); ?></p>
			<p class="submit"><br /><input type="submit" class="submit" value="<?php i18n($thisfile_anony.'/ANONY_PREVIEW_BTN'); ?>" name="preview" /> &nbsp;&nbsp;<?php i18n('OR'); ?>&nbsp;&nbsp; <a class="cancel" href="plugins.php?cancel"><?php i18n('CANCEL'); ?></a></p>
		<?php  } ?>
	</form>

	<?php

}