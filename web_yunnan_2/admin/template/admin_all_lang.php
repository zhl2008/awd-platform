<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>选择语言栏目</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$('.go').click(function(){
	$li=$('.list_cate').find('li');
	$str='';
	for(var i=0;i<$li.size();i++){
	$inp=$li.eq(i).find('input');
	if($inp.attr('checked')){
		$cate_id=$li.eq(i).find('input').val();
		$cate_name=$li.eq(i).find('label').text();
		$str=$str+'<li id="li_'+$cate_id+'"><img onclick="remove_cate('+$cate_id+');" src="template/images/close.gif" height="16" width="16" border="0"/><label>'+$cate_name+'</label><div class="clear"></div><input type="hidden" name="lang_cate[]" value="'+$cate_id+'|<?php echo $cate_lang;?>"/></li>';
	}	
	}
	$(window.parent.document).find('#sl_cate_show').append($str);
	$(window.parent.document).find('#title').focus();
}).addClass('wBox_close');

$('#tb').find('li').hover(function(){
	$(this).addClass('on');
},function(){
	$(this).removeClass('on');
});
});

</script>
<style type="text/css">
body{margin:20px;}
.list_cate{margin-top:15px;}
.list_cate li{display:block; float:left; padding:5px 8px; border:1px solid #fff}
.list_cate li.on{background:#FFFFCC; border:1px solid #FFFF66}
.list_cate li a{color:#FFFFFF}
.position h2{font-weight:normal; height:30px; line-height:30px;}
.lang_btn{}
.lang_btn li,.lang_btn li a{display:block; height:23px; width:54px; float:left}
.lang_btn li a{background:url('template/images/btn_bg1.gif') no-repeat left center; text-align:center; line-height:23px;}
.info_qh span{display:block; height:33px; line-height:33px; float:left; width:80px; text-align:center}
</style>
</head>

<body style="background:#FFFFFF">
 <div class="info_qh" style="margin-top:20px;">
 <span>查找语言栏目</span>
 <ul style="margin-left:10px; display:inline">
 <?php
	if(!empty($lang_cache)){
		foreach($lang_cache as $lk=>$lv){
		$i=0;
?>
  <li class="<?php if($GLOBALS['cate_lang']==$lv['lang_tag']){echo 'on';}?>"><a href="?lang=<?php echo $lang;?>&id=<?php echo $channel_id;?>&cate_lang=<?php echo $lv['lang_tag'];?>"><?php echo $lv['lang_name'];?></a></li>
<?php
$i++;
		}
	}	
?>

 </ul>
 <div class="clear"></div>
</div>
<div id="tb">
 <div id="sys1" style="display:block">
<form name="maininfo" method="post" enctype="multipart/form-data" class="form">
<div class="div_out" id="tb">
<p>
<span id="loading" style="display:none"></span>
 </p>
	<ul class="list_cate">
	<?php
	if(!empty($rel)){
		foreach($rel as $rk=>$rv){
		if($rv['cate_tpl']==1){continue;}
	?>
		<li><label for="test<?php echo $rv['id'];?>"><input type="checkbox" id="test<?php echo $rv['id'];?>" class="lang_cate" name="lang_cate[]" value="<?php echo $rv['id'];?>"/><?php echo $rv['cate_name'];?></label></li>
	<?php
		}
	}else{
		echo '还没有添加栏目';
	}	
	?>
	</ul>
	<div class="clear"></div>
 </div>
</form>
</div>
<div class="order_btn">
	 <input type="button" value="确定" style="margin:0 10px 0 0;" class="go" id="go"/>
 </div>

</body>
</html>
