<?php
include('common.php');
login_cookie_check();



// Below are default values (if parameter is not passed)

// save to file (true) or output to browser (false)
$save_to_file = true;

// Quality for JPEG and PNG.
// 0 (worst quality, smaller file) to 100 (best quality, bigger file)
// Note: PNG quality is only supported starting PHP 5.1.2
$image_quality = 65;

// resulting image type (1 = GIF, 2 = JPG, 3 = PNG)
// enter code of the image type if you want override it
// or set it to -1 to determine automatically
$image_type = -1;

// maximum thumb side size
$max_x = 65;
$max_y = 130;

// cut image before resizing. Set to 0 to skip this.
$cut_x = 0;
$cut_y = 0;

// Folder where source images are stored (thumbnails will be generated from these images).
// MUST end with slash.
$images_folder = GSDATAUPLOADPATH;

// Folder to save thumbnails, full path from the root folder, MUST end with slash.
// Only needed if you save generated thumbnails on the server.
// Sample for windows:     c:/wwwroot/thumbs/
// Sample for unix/linux:  /home/site.com/htdocs/thumbs/
$thumbs_folder = GSTHUMBNAILPATH;


///////////////////////////////////////////////////
/////////////// DO NOT EDIT BELOW
///////////////////////////////////////////////////

$to_name = '';

if (isset($_REQUEST['f'])) {
  $save_to_file = intval($_REQUEST['f']) == 1;
}

if (isset($_REQUEST['src'])) {
  $from_name = str_replace('../','', urldecode($_REQUEST['src']));
}
else {
  die("Source file name must be specified.");
}

if (isset($_REQUEST['dest'])) {
  $to_name = str_replace('../','', urldecode($_REQUEST['dest']));
}
else if ($save_to_file) {
  die("Thumbnail file name must be specified.");
}

if (isset($_REQUEST['q'])) {
  $image_quality = intval($_REQUEST['q']);
}

if (isset($_REQUEST['t'])) {
  $image_type = intval($_REQUEST['t']);
}

if (isset($_REQUEST['x'])) {
  $max_x = intval($_REQUEST['x']);
}

if (isset($_REQUEST['y'])) {
  $max_y = intval($_REQUEST['y']);
}

$path_parts = pathinfo($from_name);

// travesal protection
if(!filepath_is_safe(GSDATAUPLOADPATH.$from_name,GSDATAUPLOADPATH,true)) die('invalid src image');
if(!path_is_safe(GSTHUMBNAILPATH.dirname($to_name),GSTHUMBNAILPATH,true)) die('invalid dest image');

if (!file_exists($images_folder)) die('Images folder does not exist (update $images_folder in the script)');
if ($save_to_file && !file_exists($thumbs_folder)) die('Thumbnails folder does not exist (update $thumbs_folder in the script)');

$dirs=explode('/' ,$path_parts['dirname']);
$folder=$thumbs_folder;
foreach ($dirs as $dir){
	$folder.=DIRECTORY_SEPARATOR.$dir;
	if (!is_dir($folder)){
		mkdir ($folder); 
	}
}

// Allocate all necessary memory for the image.
// Special thanks to Alecos for providing the code.
ini_set('memory_limit', '100M');

// include image processing code
include('image.class.php');

$img = new Zubrag_image;

// initialize
$img->max_x        = $max_x;
$img->max_y        = $max_y;
$img->cut_x        = $cut_x;
$img->cut_y        = $cut_y;
$img->quality      = $image_quality;
$img->save_to_file = $save_to_file;
$img->image_type   = $image_type;

// generate thumbnail
$img->GenerateThumbFile($images_folder . $from_name, $thumbs_folder . $to_name);

?>
