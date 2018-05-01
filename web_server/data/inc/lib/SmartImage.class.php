<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

/**
 * Smart, easy and simple Image Manipulation
 * 
 * @author Alessandro Coscia, Milano, Italy, php_staff@yahoo.it
 * http://www.codicefacile.it/smartimage
 * @copyright LGPL
 * @version 0.9.6
 *
 */
class SmartImage {
	/**
	 * Source file (path)
	 */
	private $src;

	/**
	 * GD image's identifier
	 */
	private $gdID;

	/**
	 * Image info
	 */
	private $info;

	/**
	 * Initialize image
	 *
	 * @param string $src
   * @param boolean $big
	 * @return SmartImage
	 */
	public function SmartImage($src, $bigImageSize=false) {
    // In case of very big images (more than 1Mb)
    if ($bigImageSize)
      $this->setMemoryForBigImage($src);
    
	// set data
	$this->src = $src;
	$this->info = getimagesize($src);
	
    // open file
	if ( $this->info[2] == 2 )		$this->gdID = imagecreatefromjpeg($this->src);
	elseif ( $this->info[2] == 1 )	$this->gdID = imagecreatefromgif($this->src);
	elseif ( $this->info[2] == 3 ) 	$this->gdID = imagecreatefrompng($this->src);
	
	}
  
  /**
   * Set memory in case of very big images (more than 1Mb)
   * new SmartImage($src, true) to activate this function
   * Works with (PHP 4 >= 4.3.2, PHP 5) if compiled with --enable-memory-limit
   *   or PHP>=5.2.1
   * Thanks to Andrvm and to Bascunan for this feature
   */
	private function setMemoryForBigImage($filename) {
    $imageInfo    = getimagesize($filename);
	  $memoryNeeded = round(($imageInfo[0] * $imageInfo[1] * $imageInfo['bits'] * $imageInfo['channels'] / 8 + Pow(2, 16)) * 1.65);
	   
	  $memoryLimit = (int) ini_get('memory_limit')*1048576;
	
	  if ((memory_get_usage() + $memoryNeeded) > $memoryLimit) {
		 ini_set('memory_limit', ceil((memory_get_usage() + $memoryNeeded + $memoryLimit)/1048576).'M');
		 return (true);
    }
	  else return(false);
	}

	/**
	 * Resize an image
	 *
	 * @param integer $w
	 * @param integer $h
	 * @param boolean $cutImage
	 * @return boolean Everything is ok?
	 */
	public function resize($width, $height, $cutImage = false) {
		if ($cutImage)
		return $this->resizeWithCut($width, $height);
		else
		return $this->resizeNormal($width, $height);
	}

	/**
	 * Resize an image without cutting it, only do resize
	 * saving proportions and adapt it to the smaller dimension
	 *
	 * @param integer $w
	 * @param integer $h
	 */
	private function resizeNormal($w, $h) {
		// set data
		$size = $this->info;
		$im = $this->gdID;
		$newwidth = $size[0];
		$newheight = $size[1];

		if( $newwidth > $w ){
			$newheight = ($w / $newwidth) * $newheight;
			$newwidth = $w;
		}
		if( $newheight > $h ){
			$newwidth = ($h / $newheight) * $newwidth;
			$newheight = $h;
		}

		$new = imagecreatetruecolor($newwidth, $newheight);
		$result = imagecopyresampled($new, $im, 0, 0, 0, 0, $newwidth, $newheight, $size[0], $size[1]);

		@imagedestroy($im);
		$this->gdID = $new;
		$this->updateInfo();

		return $result;
	}

	/**
	 * Resize an image cutting it, do resize
	 * adapt it resizing and cutting the original image
	 *
	 * @param integer $w
	 * @param integer $h
	 */
	private function resizeWithCut($w, $h){
		// set data
		$size = $this->info;
		$im = $this->gdID;

		if( $size[0]>$w or $size[1]>$h ){
			$centerX = $size[0]/2;
			$centerY = $size[1]/2;

			$propX = $w / $size[0];
			$propY = $h / $size[1];

			if( $propX < $propY ){
				$src_x = $centerX - ($w*(1/$propY)/2);
				$src_y = 0;
				$src_w = ceil($w * 1/$propY);
				$src_h = $size[1];
			}
			else {
				$src_x = 0;
				$src_y = $centerY - ($h*(1/$propX)/2);
				$src_w = $size[0];
				$src_h = ceil($h * 1/$propX);
			}

			// Resize
      $new = imagecreatetruecolor($w, $h);
			$result = imagecopyresampled($new, $im, 0, 0, $src_x, $src_y, $w, $h, $src_w, $src_h);
			
			@imagedestroy($im);
		}
		else{
			$new = $im;
		}

		$this->gdID = $new;
		$this->updateInfo();

		return $result;
	}
	
	/**
	 * Add a Water Mark to the image
	 * (filigrana)
	 *
	 * @param string $from
	 * @param string $waterMark
	 */
	public function addWaterMarkImage($waterMark, $opacity = 35, $x = 5, $y = 5){
		// set data
		$size = $this->info;
		$im = $this->gdID;

		// set WaterMark's data	
		$waterMarkSM = new SmartImage($waterMark);
		$imWM = $waterMarkSM->getGDid();
	
		// Add it!
		// In png watermark images we ignore the opacity (you have to set it in the watermark image)
		if ($waterMarkSM->info[2] == 3)
			imageCopy($im, $imWM, $x, $y, 0, 0, imagesx($imWM), imagesy($imWM));
		else
			imageCopyMerge($im, $imWM, $x, $y, 0, 0, imagesx($imWM), imagesy($imWM), $opacity);
		$waterMarkSM->close();
	
		$this->gdID = $im;
	}
  
	/**
	 * Rotate of $degrees
	 *
	 * @param integer $degrees
	 */  
  public function rotate($degrees=180) {
    $this->gdID = imagerotate($this->gdID, $degrees, 0);
    $this->updateInfo();
  }

	/**
	 * Show Image
	 *
	 * @param integer 0-100 $jpegQuality
	 */
	public function printImage($jpegQuality = 100) {
		$this->outPutImage('', $jpegQuality);
	}

	/**
	 * Save the image on filesystem
	 *
	 * @param string $destination
	 * @param integer 0-100 $jpegQuality
	 */
	public function saveImage($destination, $jpegQuality = 100) {
		$this->outPutImage($destination, $jpegQuality);
	}

	/**
	 * Output an image
	 * accessible throught printImage() and saveImage()
	 *
	 * @param unknown_type $dest
	 * @param unknown_type $jpegQuality
	 */
	private function outPutImage($dest = '', $jpegQuality = 100) {
		$size = $this->info;
		$im = $this->gdID;
		// select mime
		if (!empty($dest))
			list($size['mime'], $size[2]) = $this->findMime($dest);
		
		// if output set headers
		if (empty($dest))	header('Content-Type: ' . $size['mime']);
		
		// output image
		if( $size[2] == 2 )			imagejpeg($im, $dest, $jpegQuality);
		elseif ( $size[2] == 1 )	imagegif($im, $dest);
		elseif ( $size[2] == 3 )	imagepng($im, $dest);
	}

	/**
	 * Mime type for a file
	 *
	 * @param string $file
	 * @return string
	 */
	private function findMime($file) {
		$file .= ".";
		$bit = explode(".", $file);
		$ext = $bit[count($bit)-2];
		if ($ext == 'jpg')		return array('image/jpeg', 2);
		elseif ($ext == 'jpeg')	return array('image/jpeg', 2);
		elseif ($ext == 'gif')	return array('image/gif', 1);
		elseif ($ext == 'png')	return array('image/png', 3);
		else return array('image/jpeg', 2);
	}

	/**
	 * Get the GD identifier
	 *
	 * @return GD Identifier
	 */
	public function getGDid() {
		return $this->gdID;
	}
  
	/**
	 * Get actual Image Size
	 *
	 * @return array('x' = integer, 'y' = integer)
	 */
	public function getSize() {
    $size = $this->info;
		return array('x' => $size[0], 'y' => $size[1]);
	}
	
	/**
	 * Set GD identifier
	 *
	 * @param GD Identifier $value
	 */
	public function setGDid($value) {
		$this->gdID = $value;
	}

	/**
	 * Free memory
	 */
	public function close() {
		@imagedestroy($this->gdID);
	}
	
	/**
	 * Update info class's variable
	 */
	private function updateInfo() {
		$info = $this->info;
		$im = $this->gdID;
		
		$info[0] = imagesx($im);
		$info[1] = imagesy($im);
		
		$this->info = $info;
	}
  
}

?>
