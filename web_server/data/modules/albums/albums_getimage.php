<?php
//Run security
foreach ($_GET as $get_value) {
	if (is_array($get_value) || preg_match('/\.\.|[\\\\:<>&="?*]/', $get_value))
		die ('A hacking attempt has been detected. For security reasons, we\'re blocking any code execution.');
}
unset($get_value);

//Define variable
$image = $_GET['image'];

//Then, check for hacking attempts (Remote Code Execution), and block them.
if (strpos($image, 'thumb') === false) {
	if (preg_match('#([.*])([/])([A-Za-z0-9.]{0,11})#', $image, $matches)) {
		if ($image != $matches[0]) {
			unset($image);
			die('A hacking attempt has been detected. For security reasons, we\'re blocking any code execution.');
		}
	}
}

elseif (strpos($image, 'thumb') !== false) {
	if (preg_match('#([.*])([/])thumb([/])([A-Za-z0-9.]{0,11})#', $image, $matches)) {
		if ($image != $matches[0]) {
			unset($image);
			die('A hacking attempt has been detected. For security reasons, we\'re blocking any code execution.');
		}
	}
}

//...if no hacking attempts found:
//Check if file exists.
if (file_exists('../../settings/modules/albums/'.$image)) {
	//Generate the image, make sure it doesn't end up in the visitors buffer.
	header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
	header('Expires: Thu, 19 Nov 1981 08:52:00 GMT');
	header('Pragma: no-cache');
	header('Content-Type: image/jpeg');
	echo readfile('../../settings/modules/albums/'.$image);
}

//If image doesn't exist, send 404 header.
else
	header('HTTP/1.0 404 Not Found');
?>
