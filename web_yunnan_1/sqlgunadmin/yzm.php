<?php
/**
* Author:sqlgun
* Email:sqlgun@qq.com
* Date: 2011-5-24
* http://hi.baidu.com/sqlgun
*/
session_start();
header('content-type:image/gif;');
for($i=0;$i<4;$i++){
	$_code.=dechex(mt_rand(0,15));
}
$_SESSION['code']=$_code;
$_img=imagecreatetruecolor(38,15);
$_blue=imagecolorallocate($_img,20,66,111);
imagefill($_img,0,0,$_blue);
$_white=imagecolorallocate($_img,255,255,255);
imagestring($_img,5,0,0,$_SESSION['code'],$_white);
imagegif($_img);
imagedestroy($_img);
?>