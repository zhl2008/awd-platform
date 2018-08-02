<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

define('IN_CMS','true');
include('init.php');
$lang=isset($_REQUEST['lang'])?fl_html(fl_value($_REQUEST['lang'])):get_lang_main();
$up_type=empty($_GET['up_type'])?'pic':$_GET['up_type'];
$get = $_GET['get'];
if(file_exists(DATA_PATH.'sys_info.php')){
	include(DATA_PATH.'sys_info.php');
}
$type_pic=empty($_sys['web_upload_image'])?"gif|jpeg|png|jpg|bmp|pjpeg":$_sys['web_upload_image'];
$type_file=empty($_sys['web_upload_file'])?"zip|gz|rar|iso|doc|xsl|ppt|wps|swf|mpg|mp3|rm|rmvb|wmv|wma|wav|mid|mov":$_sys['web_upload_file'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>上传</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<style type="text/css">
body{background:#edf2fa; margin:20px;}
</style>
</head>

<body>
<?php
if(isset($_FILES['up'])){
if(is_uploaded_file($_FILES['up']['tmp_name'])){
	if($up_type=='pic'){
		$is_thumb=empty($_POST['thumb'])?0:$_POST['thumb'];
		$thumb_width=empty($_POST['thumb_width'])?$_sys['thump_width']:intval($_POST['thumb_width']);
		$thumb_height=empty($_POST['thumb_height'])?$_sys['thump_height']:intval($_POST['thumb_height']);
		$logo=0;
		$is_up_size = $_sys['upload_size']*1000*1000;
		$value_arr=up_img($_FILES['up'],$is_up_size,array('image/gif','image/jpeg','image/png','image/jpg','image/bmp','image/pjpeg'),$is_thumb,$thumb_width,$thumb_height,$logo);
		$pic=$value_arr['pic'];
		if(!empty($value_arr['thumb'])){
		$pic=$value_arr['thumb'];
		}
		$str="<script type=\"text/javascript\">$(self.parent.document).find('#{$get}').val('{$pic}');self.parent.tb_remove();</script>";
		echo $str;
		exit;
	}//图片上传
}else{
die('没有上传文件或文件大小超过服务器限制大小<a href="javascript:history.back(1);">返回重新上传</a>');
}
}
?>
<form name="up" action="" method="post" enctype="multipart/form-data">
	<input type="hidden" value="<?php echo $get;?>"  name="get"/>
	<?php if($up_type=='pic'){?>
	<p style="color:red;line-height:25px;height:25px;">(允许上传的图片类型:<?php echo $type_pic;?>)</p>
	<?php }else{?>
	<p style="color:red;line-height:25px;height:25px;">(允许上传的文件类型:<?php echo $type_file;?>)</p>
	<?php }?>
	<input type="file" name="up" /><?php if($up_type=='pic'){?>&nbsp;&nbsp;<input type="checkbox" value="1" <?php if($lock){?>checked="checked"<?php }?> name="thumb" style="margin:0 5px;" />缩略图&nbsp;&nbsp;宽<input name="thumb_width" value="<?php echo $_sys['thump_width'];?>" style="margin:0 5px; width:40px;" />px&nbsp;&nbsp;高<input name="thumb_height" style="margin:0 5px; width:40px;" value="<?php echo $_sys['thump_height'];?>" />px<?php }?>&nbsp;&nbsp;&nbsp;<input type="submit" value="上传" name="submit" />
</form>
</body>
</html>
