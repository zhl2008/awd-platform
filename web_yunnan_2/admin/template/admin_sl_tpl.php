<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>模板风格列表</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript" src="template/images/box/thickbox.js"></script>
<link type="text/css" href="template/images/box/thickbox.css" rel="stylesheet" />
<script type="text/javascript">
$(document).ready(function(){
	$('#show_list').find('tr').hover(function(){
		$(this).find('td').css('background','#ccffcc');
	},function(){
		$(this).find('td').css('background','');
	});
	

	$('.mb_list2').find('li').hover(function(){
		$(this).addClass('on');
		$(this).find('.is_tmp').show();
	},function(){
		$is_ck=$(this).find('input').attr('checked');
		//alert($is_ck);
		if(!$is_ck){
			$(this).removeClass('on');
			$(this).find('.is_tmp').hide();
		}	
	}).click(function(){
		$(this).siblings().removeClass('on');
		$(this).addClass('on');
		$(this).parent().find('.is_tmp').hide();
		$(this).find('.is_tmp').show();
		$(this).find('input').attr('checked','checked');
		$tpl=$(this).attr('rel');
		$get='#<?php echo $get;?>';
		$show_str='<a target="_blank" href="../template/'+$tpl+'/thumb.gif" ><img src="../template/'+$tpl+'/thumb.gif"  height="120" width="120"/></a>';
		$(window.parent.document).find($get).val($tpl);
		$(window.parent.document).find('#show_<?php echo $get;?>').html($show_str);
	}).addClass('wBox_close');
});
</script>
</head>

<body>

		<div class="bees_main_content" style="background:#FFFFFF">
		
		<div class="admin_position">
		<span>模板风格列表</span>
			
		</div><!--位置-->
		
	<!--内容区-->	

<div class="div_out">

<div class="order_contain" style="border:0; margin-top:20px;">
 <div class="order_main">
 
 <ul class="mb_list2">
 <?php
 	while(false!=($file=readdir($file_hand))){
	$info=pathinfo($file);
	if(!empty($info['extension'])||$file=='.'||$file=='..'){continue;}
	//获取图片和配置说明
		$temp_dir=CMS_PATH.'template'.'/'.$info['basename'].'/';
 ?>
 	<li rel="<?php echo $file;?>">
	<div class="is_tmp" style="display:none"></div>
	<input type="radio" style="display:none" name="sl_tmp" value="<?php echo $file; ?>" <?php if($_confing['web_template']==$info['basename']){?>checked="checked"<?php }?> />
	<?php
		if(file_exists($temp_dir.'thumb.gif')){
	?>
	<p><img src="<?php echo '../template/'.$info['basename'].'/thumb.gif';?>" border="0" width="120" height="120"/></p>
	<?php
		}else{
	?>
	<p><img src="../upload/no_pc.gif" border="0" width="200" height="200"/></p>
	<?php
		}
	?>
	<p><span>名称：<?php echo $file;?></p>
	
	</li>
	<?php
		}
	?>
 </ul>
 <div class="clear"></div>
 
 </div>



<!--内容区-->
	


</body>
</html>
