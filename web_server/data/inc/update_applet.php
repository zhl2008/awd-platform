<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

//First get the day of the year.
$dayofyear = date('z');

//If the updatecheckfile existst, include it.
if (file_exists('data/settings/update_lastcheck.php'))
	include_once ('data/settings/update_lastcheck.php');

//We want to check for updates if:
//1: Updatecheckfile doesn't exist.
//2: Updatecheckfile exists, but last check was not today.
//3: Updatecheckfile exists, but the last checked EasyCMS version is not the same as the current.
if (!file_exists('data/settings/update_lastcheck.php') || (file_exists('data/settings/update_lastcheck.php') && $lastcheck != $dayofyear) || (file_exists('data/settings/update_lastcheck.php') && $cms_version != VERSION)) {
	//Iniate CURL to fetch update-info,
	//but only if CURL-extension is loaded.
	if (extension_loaded('curl')) {
		// Set up url for checking version 
		// TODO: Add options in settings for checking pre-release
		// For normal release
		$url = '';
		// Also for pre-release

		// Initialize session and set URL.
		$geturl = curl_init();
		curl_setopt($geturl, CURLOPT_URL, $url);
		// Dont check ssl certifical
		curl_setopt($geturl, CURLOPT_SSL_VERIFYPEER, false);
		// Go redirect
		curl_setopt($geturl, CURLOPT_FOLLOWLOCATION, true);
		// Return data
		curl_setopt($geturl, CURLOPT_RETURNTRANSFER, true);
			
		// Get the response and close the channel.
		$response = curl_exec($geturl);
		curl_close($geturl);

		// Find latest release
		preg_match('/\<span class\=\"css-truncate-target\"\>(.*)\<\/span\>/', $response, $match);

		// Current latest release string
		$update_available = strip_tags($match[0]);
		
		// Remove v char if we are using normal releases
		$update_available = str_replace('v', '', $update_available);
		
		// Unset data
		unset($match, $response);
	}

	//If CURL isn't loaded, save an error-status.
	else
		$update_available = 'error';

	$data = '<?php'."\n"
	.'$lastcheck = \''.$dayofyear.'\';'."\n"
	.'$lastupdatestatus = \''.$update_available.'\';'."\n"
	.'$cms_version = \''.VERSION.'\';'."\n"
	.'?>';
	save_file('data/settings/update_lastcheck.php', $data);
}

//If update-file exists and we already checked for updates today, use old updatecheck result.
else
	$update_available = $lastupdatestatus;

//Then determine which icon we need to show... and show it.
switch(check_update_version($update_available)) {
	case 'yes':
		$update_note = '<a href="/" target="_blank"><img src="data/image/update-available.png" alt="" /> '.$lang['update']['available'].'</a>';
		break;
	case 'urgent':
		$update_note = '<a href="/" target="_blank"><img src="data/image/update-available-urgent.png" alt="" /> '.$lang['update']['urgent'].'</a>';
		break;
	case 'error':
		$update_note = '<img src="data/image/error.png" alt="" /> '.$lang['update']['failed'];
		break;
	case 'no':
		$update_note = '<img src="data/image/update-no.png" alt="" /> '.$lang['update']['up_to_date'];
		break;
}
	
?>
<li>
	<?php echo $update_note; ?>
</li>
