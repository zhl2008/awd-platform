<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

define('IN_CMS','true');
include('init.php');
$up_type=empty($up_type)?'pic':$up_type;
if(file_exists(DATA_PATH.'sys_info.php')){
	include(DATA_PATH.'sys_info.php');
}
$type_pic=empty($_sys['web_upload_image'])?"gif|jpeg|png|jpg|bmp|pjpeg":$_sys['web_upload_image'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>多图上传</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$('#add_num').click(function(){
	$str='<p style="line-height:25px;"><input type="file" name="up[]" /></p>';
	$num=$('#num').val();
	if($num>5){$num=5;}
	$str_p="";
	for($i=1;$i<=$num;$i++){
		$str_p=$str_p+$str;
	}
	$('#up_p').html($str_p);
});

});
</script>
<style type="text/css">
body{background:#edf2fa; margin:20px;}
</style>
</head>

<body>
<?php
if(isset($submit)){
$num=count($_FILES['up']['name']);

$path=CMS_PATH."upload/img/".date('Ymd').'/';
$pic_path="img/".date('Ymd').'/';
if(!file_exists($path)){mkdir($path);}
$size=empty($_sys['upload_size'])?'20':$_sys['upload_size'];
$size = $size*1000*1000;
$sys_type=array();
$sys_type=explode('|',$_sys['web_upload_image']);
if(!empty($sys_type)){
	foreach($sys_type as $k=>$v){
		$sys_type[$k]='image/'.$v;
	}
}
$sys_type[]='image/x-png';
$sys_type[]='image/pjpeg';
$type=empty($_sys['web_upload_image'])?array('image/gif','image/jpeg','image/x-png','image/png','image/jpg','image/bmp','image/pjpeg'):$sys_type;
for($i=0;$i<=$num;$i++){
	if(!is_uploaded_file($_FILES['up']['tmp_name'][$i])){continue;}
	if($_FILES['up']['size'][$i]>$size){echo '第'.($i+1).'张图片超过'.$size.'大小'."【<a href=\"javascript:history.go(-1);\">返回</a>】";continue;}
	$pic_name=pathinfo($_FILES['up']['name'][$i]);//图片信息
	$file_type=$_FILES['up']['type'][$i];	
	if(!in_array(strtolower($file_type),$type)){echo '第'.($i+1).'张图片格式不正确'."【<a href=\"javascript:history.go(-1);\">返回</a>】";continue;}
	$file_name=date('YmdHis').$i.'.'.$pic_name['extension'];
	$file_path=$path.$file_name;
	unset($pic_name);
	if(!move_uploaded_file($_FILES['up']['tmp_name'][$i],$file_path)){echo '第'.($i+1).'张图片上传失败';continue;}else{$up_str.=$pic_path.$file_name.'\n';$show_pic.="<li id=\"pic_{$i}\"><a href=\"".CMS_SELF."upload/".$pic_path.$file_name."\" target=\"_blank\"><img src=\"".CMS_SELF."upload/".$pic_path.$file_name."\" border=\"0\" height=\"120\" width=\"120\"/><input type=\"hidden\" name=\"fields[{$get}][]\" value=\"".$pic_path.$file_name."\"/></a><span onclick=\"del_pic(\'".$pic_path.$file_name."\',this);\">删除</span></li>";}
}
echo "<script type=\"text/javascript\">$(window.opener.document).find('#{$get}').val('{$up_str}');$(window.opener.document).find('.form').find('ul#show_pic').append('{$show_pic}');self.close();</script>";
}
?>
<form name="up" action="?" method="post" enctype="multipart/form-data">
	<input type="hidden" value="<?php echo $get;?>"  name="get"/>
	<p style="color:red;line-height:25px;height:25px;">(允许上传的图片类型:<?php echo $type_pic;?>)</p>
	<p style="line-height:25px;"><input name="num" value="3" id="num" style="width:30px;padding:2px 0;" />&nbsp;&nbsp;&nbsp;<input type="button" id="add_num" class="go" value="增加" /></p>
	<div id="up_p">
	<p style="line-height:25px;"><input type="file" name="up[]" />&nbsp;&nbsp;&nbsp;</p>
	</div>
	<input type="submit" value="上传" name="submit" />
</form>
</body>
</html>
