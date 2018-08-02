<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

define('IN_CMS','true');
include('init.php');
//权限判断
$method=empty($_GET['method'])?'':$_GET['method'];
$get = $_GET['get'];
if(file_exists(DATA_PATH.'sys_info.php')){include(DATA_PATH.'sys_info.php');}//系统设置
$type_file=empty($_sys['web_upload_file'])?"zip|gz|rar|iso|doc|xsl|ppt|wps|swf|mpg|mp3|rm|rmvb|wmv|wma|wav|mid|mov":$_sys['web_upload_file'];
@ini_set('max_execution_time',  90);
@ini_set('file_uploads',  'On');
@ini_set('max_input_time', '90' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>文件上传</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){

//单图
$('#sl').click(function(){
$file_val=$('#show_list').find('#file_rd').filter(':checked').val();
$file_val_arr = $file_val.split('|||');
<?php
if($method=='fck'){
?>
back_file=$file_val_arr[0];
window.returnValue=back_file;
window.close();
<?php
}else{
?>
$get='#<?php echo $get;?>';
$(self.parent.document).find($get).val($file_val_arr[0]).focus();
$(self.parent.document).find($get+'_size').html($file_val_arr[1]+'KB');
<?php }?>
});



});


</script>

<style type="text/css">
body{background:#edf2fa; margin:20px;}
.pic{margin-top:3px; border:1px solid #ccc; padding:8px; background:#FFFFFF}
.pic p{line-height:25px; line-height:25px;}
.pic_list_ct{margin:10px 0;}
.pic_list_ct li{width:80px; height:100px; display:block; float:left; margin-bottom:10px; margin-right:10px; display:inline}
.pic_list li_ct label{display:block; height:20px; line-height:20px;}
.sl_pic{margin-top:10px; height:25px; background:#FFFFFF; border:1px solid #ccc; padding:5px;}
.sl_pic span{padding-left:8px; color:#0000FF}
</style>
</head>

<body>
<base target="_self">
<?php
$submit=$_POST['uppic'];
if($submit){
$up=$_POST['up'];
$file_info=fl_html($_POST['file_info']);
$value_arr=array('');
$type=explode('|',$type_file);
//有文件
if(is_uploaded_file($_FILES['up']['tmp_name'])){
		
		$is_up_size = $_sys['upload_size']*1000*1000;
		$value_arr=up_file($_FILES['up'],$is_up_size,$type);
		//处理上传后的图片信息
		$file_path=$value_arr['file'];//文件保存路径
		$file_ext=$value_arr['ext'];//文件扩展名
		$file_size = empty($value_arr['size'])?0:$value_arr['size'];//文件大小
		$file_time = $value_arr['time'];//上传时间
		//入库
$sql="insert into ".DB_PRE."upfiles (file_info,file_ext,file_size,file_path,file_time) values ('".$file_info."','".$file_ext."',".$file_size.",'".$file_path."','".$file_time."')";
$mysql->query($sql);
}




}
?>
<form name="up" action="" method="post" enctype="multipart/form-data">
<p style="line-height:25px;">(允许上传的文件类型:<?php echo $type_file;?>)</p>
<div id="pic_contain">
<div class="pic">
	<p><input type="file" name="up" />&nbsp;文件说明：<input type="text" name="file_info" /></p>
</div>
</div>
<p style="margin-top:10px"><input type="submit" value="上传" name="uppic" /></p>
</form>

<!--图片列表-->
<div class="sl_pic">
<input type="button" name="sl_pic" id="sl" class="wBox_close" value="确定选择"  /><span style="padding-left:15px;">选择好文件后，确定按钮</span>
</div>
<?php
$maintb=DB_PRE."upfiles";
$page=empty($_GET['page'])?1:intval($_GET['page']);
$pagesize=20;
$pagenum=($page-1)*$pagesize;
$query='&get='.$get.'&method='.$method;
$order='order by m.id desc';
$total_num=$GLOBALS['mysql']->fetch_rows("select m.id from {$maintb} as m ");
$total_page=ceil($total_num/$pagesize);
$sql="select m.* from {$maintb} as m {$order} limit {$pagenum},{$pagesize}";
$rel=$GLOBALS['mysql']->fetch_asc($sql);
if(!empty($rel)){
?>

 <div class="order_main">
 <table cellpadding="0" cellspacing="0" width="100%" class="table_info1">
 	<thead>
		<tr><th style="5%">选择</th><th style="width:10%">ID</th><th style="width:25%">文件大小</th><th style="width:30%">文件地址</th><th style="width:15%">格式</th><th style="15%">上传时间</th></tr>
	</thead>
	<tbody id="show_list">
	
	<?php
foreach($rel as $k=>$v){
?>
	<tr><td style="width:5%; text-align:center"><input name="sl_rd" id="file_rd" type="radio" <?php if(!$k){echo 'checked="checked"';}?> value="<?php echo '../'.$v['file_path'].'|||'.($v['file_size']/1000);?>"/></td><td style="width:10%;text-align:center" align="center"><?php echo $v['id'];?></td><td style="width:25%;text-align:center" align="center"><?php echo ($v['file_size']/1000).'KB';?></td><td scope="width:25%;text-align:center" align="center"><?php echo $v['file_path'];?></td><td style="width:15%; text-align:center"><?php echo $v['file_ext'];?></td><td style="width:15%; text-align:center"><?php echo date('Y-m-d H:m:s',$v['file_time']);?></td></tr>
<?php
}
?>
		
		</tbody>
 </table>
 </div>

<?php
}
?>
<div class="page page_fy" style="clear:both">
 	<ul>
		<?php echo page('admin_file_upload.php',$page,$query,$total_num,$total_page);?>
	</ul>
 </div>
</body>
</html>
