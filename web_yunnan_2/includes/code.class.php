<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/
session_start();
class code{
private $width,$height;
private $code_num;
public $code_str;
var $img;
function code($width,$height){
	$this->width=$width;
	$this->height=$height;
	$this->code_str="";
	$this->img="";
}

function out_img(){

	$this->create_code();
	
	$this->create_img();
	
	header("Content-type:image/gif");
	@imagepng($this->img);
}

function create_code(){
	for($i=1;$i<=4;$i++){
		$this->code_str[$i]=dechex(rand(1,15));
		$this->code_num.=$this->code_str[$i];
	}
	
	$_SESSION['code'] = $this->code_num;
}

function create_img(){
	$this->img=@imagecreate($this->width,$this->height);
	$bg = imagecolorallocate($this->img,238,238,238);
	$str_bg = imagecolorallocate($this->img,255,255,255);
	for($i=0;$i<100;$i++){
		$pxcolor = imagecolorallocate($this->img, rand(0,255), rand(0,255), rand(0,255));
		imagesetpixel($this->img,rand(2,$this->width),rand(2,$this->height),$pxcolor);
	}
	for($n=1;$n<=4;$n++){
		$str_color = imagecolorallocate ($this->img, rand(0,255), rand(0,128), rand(0,255));  
		//if($n){$x=20*($n-1)}
		$x=($this->width/4)-5;
		$y=$this->height-12;
		imagestring($this->img,5,rand($x*($n-1)+5,$x*$n),rand(3,$y),$this->code_str[$n],$str_color);
	}
}

function return_code(){
	return $this->code_str;
}
}

?>
