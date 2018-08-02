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
$type= $_GET['type'];
$pic_nav=empty($_GET['pic_nav'])?1:intval($_GET['pic_nav']);
if(file_exists(DATA_PATH.'sys_info.php')){include(DATA_PATH.'sys_info.php');}//系统设置
$type_pic="gif|jpeg|png|jpg|bmp";//图片类型
//图片分类，不包含下载
$cate_rel=$mysql->fetch_asc("select*from ".DB_PRE."uppic_cate order by id asc");
if(!empty($cate_rel)){
	$cate_str='<select name="pic_cate">';
		foreach($cate_rel as $k_c=>$k_v){
			if($k_v['id']==2){continue;}
			$cate_str.='<option value="'.$k_v['id'].'">'.$k_v['cate_name'].'</option>';
		}
	$cate_str.='</select>&nbsp;';	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>图片上传</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$('#up_q_list').find('li').click(function(){
		$index=$('#up_q_list').find('li').index(this);
		$(this).addClass('on').siblings().removeClass('on');
		$('.up_contain').find('.xc_contain').eq($index).show().siblings().hide();
	});
$('.pic_list_ct').find('li').hover(function(){
	$(this).find('.pic_cz').show();
	$(this).addClass('on');
},function(){
	$(this).find('.pic_cz').hide();
	if(!$(this).find('#pic_sl').attr('checked')){
	$(this).removeClass('on');
	}
});

$('.pic_list_ct').find('li').click(function(){
<?php if($type=='radio'){?>
	$('.pic_list_ct').find('#pic_sl').attr('checked','');
	$('.pic_list_ct').find('em').hide();
	$('.pic_list_ct').find('li').removeClass('on');
	$(this).find('#pic_sl').attr('checked','checked');
	$(this).find('em').show();
	$(this).addClass('on');
<?php
}else{
?>
	var is_ck=$(this).find('#pic_sl').attr('checked');
	if(is_ck){
		$(this).removeClass('on');
		$(this).find('em').hide();
		$(this).find('#pic_sl').attr('checked','');
	}else{
		$(this).addClass('on');
		$(this).find('em').show();
		$(this).find('#pic_sl').attr('checked','checked');
	}	
<?php
}
?>
});

$('#add_num').click(function(){
	$str='<div class="pic"><p><input type="file" name="up[]" />&nbsp;图片说明(alt)：<input type="text" style="width:100px;" name="pic_alt[]" /></p></div>';
	$num=$('#num').val();
	if($num>5){$num=5;}
	$str_p="";
	for($i=1;$i<=$num;$i++){
		$str_p=$str_p+$str;
	}
	$('#pic_contain').html($str_p);
});

//单图
$('#sl').click(function(){
$num=$('.pic_list_ct').find('#pic_sl').size();
var $pic_val='';
for(i=0;i<$num;i++){
	$pic_sl=$('.pic_list_ct').find('#pic_sl').eq(i);
	$alt=$('.pic_list_ct').find('#alt').eq(i);
	if($pic_sl.attr('checked')){
		$pic_val=$pic_sl.val();
		//缩略图
		$pic_thumb=$pic_sl.parent().find('#pic_thumb').val();
		$pic_alt=$alt.val();
	}
}
$cl_thumb=$('#is_pic_thumb').attr('checked');//勾选缩略图
if($cl_thumb){
	if($pic_thumb){
		$pic_val=$pic_thumb;
	}else{
		alert('选择图片没有缩略图');
		return;
	}
}
<?php
if($method=='fck'){
?>
if($pic_val==''){
	alert('还没有选择图片！');
	return;
}
back_img='../upload/'+$pic_val;
window.returnValue=back_img+'||'+$pic_alt;
window.close();
<?php
}else{
?>
if($pic_val!=''){
$get='#<?php echo $get;?>';
$show_str='<a target="_blank" href="../upload/'+$pic_val+'" ><img src="../upload/'+$pic_val+'"  height="120" width="120"/></a>';
$(window.parent.document).find($get).val($pic_val).focus();
$(window.parent.document).find('#show_<?php echo $get;?>').html($show_str);
}
<?php }?>
});

//多图
$('#sl_ck').click(function(){
	$num=$('.pic_list_ct').find('#pic_sl').size();
	var $pic_rel='';
	var $show_pic='';
for(i=0;i<$num;i++){
	$pic_sl=$('.pic_list_ct').find('#pic_sl').eq(i);
	if($pic_sl.attr('checked')){
		$pic_rel=$pic_sl.attr('rel');
		$pic_val=$pic_sl.val();
		//取得alt
		$pic_alt=$pic_sl.next('#alt').val();
		$show_pic=$show_pic+'<li id="pic_'+$pic_rel+'"><a href="../upload/'+$pic_val+'" target="_blank"><img src="../upload/'+$pic_val+'" border="0" height="120" width="120"/></a><p><input type="text" style="width:100px;" name="alt" id="alt" value="'+$pic_alt+'"/><img src="template/images/c_alt.gif" style="border:0;cursor:point;" onclick="change_alt(this,\''+$pic_rel+'\')" border="0"/></p><input type="hidden" name="fields[<?php echo $get;?>][]" value="'+$pic_rel+'"/><span onclick="del_pic(\''+$pic_rel+'\',this);">删除</span></li>';
	}
}
$get='#<?php echo $get;?>';
$(self.parent.document).find($get).val($show_pic);
$(self.parent.document).find('.form').find('ul#show_pic<?php echo $get;?>').append($show_pic);
$(self.parent.document).find('#title').focus();
});

});

function check_is_thumb(n){
	$p=$(n).parent('p');
	if($(n).attr('checked')){
		$p.find('#is_thumb').val('1');
	}else{
		$p.find('#is_thumb').val('0');
	}
}

</script>

<style type="text/css">
body{background:#fff; margin:5px;}
.pic{margin-top:3px; border:1px solid #ccc; padding:8px; background:#FFFFFF}
.pic p{line-height:25px; line-height:25px;}
.pic_list_ct{margin:10px 0;}
.pic_list_ct li{width:80px; padding:1px; border:2px solid #ddd; position:relative; height:80px; display:block; float:left; margin-bottom:10px; margin-right:10px; display:inline; cursor:pointer}
.pic_list_ct li.on{border:2px solid #ff8215;}
.pic_list_ct li .pic_cz{height:15px; background:#fff; width:100%;position:absolute; left:0; top:0; z-index:100; padding-top:5px;filter:alpha(opacity=80);-moz-opacity:0.8;-khtml-opacity: 0.8; opacity: 0.8;}
.pic_list_ct li a{width:10px; height:10px; display:block; float:left; margin-left:5px; display:inline;background:url(template/images/c_alt.gif) no-repeat left top; }
.pic_list_ct li em{display:block; width:9px; height:9px; background:url(template/images/input_ok.gif) no-repeat right bottom; position:absolute; right:1px; bottom:1px;}
.pic_list li_ct label{display:block; height:20px; line-height:20px;}
.sl_pic{margin-top:10px; height:25px; background:#FFFFFF; border:1px solid #ccc; padding:5px;}
.sl_pic span{padding-left:8px; color:#0000FF}
</style>
<base target="_self"/>
</head>

<body>
<!--处理上传的图片-->
<?php
$submit=$_POST['uppic'];
if($submit){
$up=$_POST['up'];
$pic_alt=$_POST['pic_alt'];
$is_alt = $_POST['is_alt'];
$is_thumb=$_POST['is_thumb'];
$thumb_width=$_POST['thumb_width'];
$thumb_height=$_POST['thumb_height'];
$up_is_thumb=intval($is_thumb);
$up_thumb_width=empty($thumb_width)?$_sys['thump_width']:intval($thumb_width);
$up_thumb_height=empty($thumb_height)?$_sys['thump_height']:intval($thumb_height);
$pic_cate=$_POST['pic_cate'];
if(is_array($_FILES['up']['tmp_name'])){
foreach($_FILES['up']['tmp_name'] as $k=>$v){
if(empty($v)){continue;}
$value_arr=array('');
$pic_info=array('');
//有图上传图片
if(is_uploaded_file($v)){
		$pic_info['tmp_name']=$v;
		$pic_info['size']=$_FILES['up']['size'][$k];
		$pic_info['type']=$_FILES['up']['type'][$k];
		$pic_info['name']=$_FILES['up']['name'][$k];
		$pic_name_alt=empty($is_alt)?'':$pic_alt[$k];
		$is_up_size = $_sys['upload_size']*1000*1000;
		$value_arr=up_img($pic_info,$is_up_size,array('image/gif','image/jpeg','image/png','image/jpg','image/bmp','image/pjpeg','image/x-png'),$up_is_thumb,$up_thumb_width,$up_thumb_height,$logo=1,$pic_name_alt);
		//处理上传后的图片信息
		$pic_name=$value_arr['up_pic_name'];//图片名称空
		$pic_ext=$value_arr['up_pic_ext'];//图片扩展名
		$pic_title = $pic_alt[$k];//图片描述
		$pic_size = $value_arr['up_pic_size'];//图片大小
		$pic_path = $value_arr['up_pic_path'];//上传路径
		$pic_time = $value_arr['up_pic_time'];//上传时间
		$pic_thumb = iconv('GBK','UTF-8',$value_arr['thumb']);//缩略图
		$cate = empty($pic_cate)?1:$pic_cate;//图片栏目
		//入库
$sql="insert into ".DB_PRE."uppics (pic_name,pic_ext,pic_alt,pic_size,pic_path,pic_time,pic_thumb,pic_cate) values ('".$pic_name."','".$pic_ext."','".$pic_title."','".$pic_size."','".$pic_path."','".$pic_time."','".$pic_thumb."',".$cate.")";
$mysql->query($sql);
}

}//循环结束
}

}

?>
<!--处理结束-->
<div class="up_qh">
	<span>选择您要添加的图片</span>
	<ul id="up_q_list">
		<li class="on">图片管理</li>
		<li>图片上传</li>
	</ul>
	<div class="clear"></div>
</div>
<div class="up_contain">

<div class="xc_contain">

<!--图片列表-->
<div class="sl_pic_thumb">
	<input type="checkbox" value="1" name="is_thumb" id="is_pic_thumb" /><label for="is_pic_thumb">&nbsp;缩略图&nbsp;(勾选该选项将会优先使用缩略图)</label>
</div>
<!--图片分类-->
<div class="pic_nav" style="margin-top:10px;">
<ul>
<?php
if(!empty($cate_rel)){
foreach($cate_rel as $nav_k=>$nav_v){
$query='type='.$type.'&get='.$get.'&method='.$method.'&pic_nav='.$nav_v['id'];
?>
	<li ><a class="<?php if($nav_v['id']==$pic_nav){echo 'hover';}?>" href="?<?php echo $query;?>"><?php echo $nav_v['cate_name'];?></a></li>
<?php
}
}
?>
</ul>
<div class="clear"></div>
</div>
<?php
$maintb=DB_PRE."uppics";
$query='&type='.$type.'&get='.$get.'&method='.$method.'&pic_nav='.$pic_nav;
$page=empty($_GET['page'])?1:intval($_GET['page']);
$pagesize=24;
$pagenum=($page-1)*$pagesize;
$order='order by m.id desc';
$total_num=$GLOBALS['mysql']->fetch_rows("select m.id,m.pic_cate from {$maintb} as m where m.pic_cate=".$pic_nav);
$total_page=ceil($total_num/$pagesize);
$sql="select m.* from {$maintb} as m left join ".DB_PRE."uppic_cate as n on m.pic_cate=n.id where m.pic_cate={$pic_nav} {$order} limit {$pagenum},{$pagesize}";
$rel=$GLOBALS['mysql']->fetch_asc($sql);
if(!empty($rel)){
?>
<ul class="pic_list_ct">
<?php
foreach($rel as $k=>$v){
$pic=$v['pic_path'].$v['pic_name'].'.'.$v['pic_ext'];
$img=CMS_SELF.$pic;
$img_thumb = empty($v['pic_thumb'])?CMS_SELF.'upload/no_pc.gif':CMS_SELF.'upload/'.$v['pic_thumb'];
?>
<li>
<img src="<?php echo $img_thumb;?>" border="0" width="80" height="80" title="【图片名称】：<?php echo $v['pic_name']?> 
【图片说明】：<?php echo $v['pic_alt']?> 
【上传时间】：<?php echo date('Y-m-d H:m:s',$v['pic_time']);?> 
【格式】：<?php echo $v['pic_ext'];?> " alt="【图片名称】：<?php echo $v['pic_name']?> 
【图片说明】：<?php echo $v['pic_alt']?> 
【上传时间】：<?php echo date('Y-m-d H:m:s',$v['pic_time']);?> 
【格式】：<?php echo $v['pic_ext'];?> " /> 
<label><input style="display:none" <?php if($type=='radio'){?>type="radio"<?php }elseif($type=='checkbox'){?> type="checkbox"<?php }?> rel="<?php echo $v['id'];?>" id="pic_sl" value="<?php echo str_replace('upload/','',$pic);?>" name="pic_sl"/><input type="hidden" name="alt" id="alt" value="<?php echo $v['pic_alt'];?>" /><input type="hidden" id="pic_val" value="<?php echo str_replace('upload/','',$pic);?>" /><input type="hidden" id="pic_thumb" name="pic_thumb" value="<?php echo str_replace('upload/','',$v['pic_thumb']);?>" /></label>
<div class="pic_cz" style="display:none"><a title="查看" class="xg_link" href="<?php echo '../'.$pic;?>" target="_blank"></a></div>
<em style="display:none"></em>
</li>
<?php
}
?>
</ul>
<?php
}
?>
<div class="page page_fy" style="clear:both">
 	<ul>
		<?php echo page('admin_pic_upload.php',$page,$query,$total_num,$total_page);?>
	</ul>
 </div>
<div class="ok_btn">
<input type="button" class="wBox_close" name="sl_pic" <?php if($type=='radio'){?>id="sl"<?php }elseif($type=='checkbox'){?> id="sl_ck"<?php }?> value="确定"  />
</div>
	
</div><!--区块-->

<div class="xc_contain" style="display:none">

<form name="up" action="" method="post" enctype="multipart/form-data">
<div class="pic_fl"><label>选择分类：</label><?php echo $cate_str;?></div>
<div class="pic_fl"><p><label>缩略图：</label><label style="width:30px; padding-top:10px;"><input type="checkbox" onclick="check_is_thumb(this);" value="1" name="thumb" style="margin:0 5px;" checked="checked" /><input type="hidden" name="is_thumb" value="1" id="is_thumb"/></label></p><p>&nbsp;&nbsp;宽<input name="thumb_width" id="thumb_width" value="<?php echo $_sys['thump_width'];?>" style="margin:0 5px; width:30px;" />px&nbsp;&nbsp;高<input name="thumb_height" id="thumb_height" style="margin:0 5px; width:30px;" value="<?php echo $_sys['thump_height'];?>" />px </p></div>
<div class="pic_fl"><label>alt命名：</label><input type="radio" name="is_alt" value="1"/>是&nbsp;&nbsp;<input type="radio" name="is_alt" value="0" checked="checked"/>否&nbsp;&nbsp;&nbsp;用alt的值命名图片名称，一些语言可能无法读取到图片</div>
<div class="pic_fl"><label>增加上传图片：</label><input name="num" value="3" id="num" style="width:30px;padding:2px 0;" />&nbsp;&nbsp;&nbsp;(最多5张图片同时上传!允许上传的图片类型:<?php echo $type_pic;?>)</div>
<div class="pic_f1"><input type="button" id="add_num" style="float:none; margin-left:110px;" class="go" value="增加" /></div>
<div id="pic_contain">
<div class="pic">
	<p>
	<input type="file" name="up[]" />&nbsp;图片说明(alt)：<input type="text" name="pic_alt[]" style="width:100px;" /></p>
</div>
</div>
<p style="margin-top:10px"><input type="submit" value="上传" name="uppic" /></p>
</form>

</div><!--图片上传-->

</div>
</body>
</html>
