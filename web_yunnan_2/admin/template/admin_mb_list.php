<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>模板管理</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#show_list').find('tr').hover(function(){
		$(this).find('td').css('background','#ccffcc');
	},function(){
		$(this).find('td').css('background','');
	});
	

	$('.mb_list').find('li').hover(function(){
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
		if(!confirm('确定要使用该模板么！')){
			return;
		}
		$(this).siblings().removeClass('on');
		$(this).addClass('on');
		$(this).parent().find('.is_tmp').hide();
		$(this).find('.is_tmp').show();
		$(this).find('input').attr('checked','checked');
		$.ajax({
			type:'POST',
			url:'admin_template.php',
			data:'action=ajax_mb&lang=<?php echo $lang;?>&mb_dir='+$(this).find('input').val(),
			success:function(msg){
				//alert(msg);
			}
		});
	});
});
</script>
</head>

<body>
<div class="admin_head">
	<div class="admin_logo"><img src="template/images/admin_logo.gif" border="0"/></div>
	<div class="admin_head_rigt">
		<div class="admin_info">
		管理员<label><?php echo $rel_admin[0]['admin_name'];?></label>欢迎回来</span><span>上次登陆时间:<label style="font-weight:normal"><?php echo empty($rel_admin[0]['admin_time'])?'':date('Y-m-d H:m:s',$rel_admin[0]['admin_time']);?></label></span><span>上次登陆IP:<label style="font-weight:normal"><?php echo $rel_admin[0]['admin_ip']; unset($rel_admin);?></label></span><span>本次登陆IP:<label style="font-weight:normal"><?php echo get_ip();?></label><label style="font-weight:bold; padding-left:8px;"><a href="http://www.test.com/alone/alone.php?id=7" target="_blank" style="padding-right:5px; color:#fff">网站建设</a><a href="http://www.test.com/article/article.php?id=23" target="_blank" style="padding-right:5px; color:#fff">模板下载</a><a href="http://www.test.com/alone/alone.php?id=7" target="_blank" style="padding-right:5px; color:#fff">授权服务</a><a href="http://www.169host.com" target="_blank" style="padding-right:5px; color:#fff">域名空间</a></label>
		</div><!--登录的一些信息-->
		<div class="admin_head_nav">
			
			<ul class="out_nav">
				<li><a href="admin_cache.php?action=del_cache_file">清除缓存</a></li>
				<li><a href="../index.php" target="_blank">网站主页</a></li>
				<li><a href="http://www.test.com" target="_blank">官网首页</a></li>
				<li><a href="http://www.test.com/help" target="_blank">帮助手册</a></li>
				<li><a href="login.php?action=out">退出登录</a></li>
			</ul>
			<div class="clear"></div>
		</div><!--主导航-->
	</div>
	<div class="clear"></div>	
</div>

<div class="bees_admin_main">
	
	<div class="bees_admin_left_nav">
		<div class="admin_contain_left">
		
		<div class="admin_small_nav">
			
			<?php include('admin_nav.php')?>
			
			
		</div>
	</div><!--左边-->
	</div><!--nav-->
	
	<div class="bees_main_right">
		<div class="bees_main_content">
		
		<div class="admin_position">
		<span>基本设置</span>
			<div class="lang">
			<ul>
			 <?php
 $cache_file=DATA_PATH."cache/lang_cache.php";
 $cache_arr=read_cache($cache_file,'lang_cache');
 if(!empty($cache_arr)){
 foreach($cache_arr as $k=>$v){
  if(!$v['lang_is_use']){continue;}
 ?>
 <li><a href="?action=mb_list&lang=<?php echo $v['lang_tag'];?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>" class="<?php if($GLOBALS['lang']==$v['lang_tag']){echo 'hover';}?>"><?php echo $v['lang_name'];?></a></li>
 <?php
 }
 }
 ?>
			</ul>
		</div><!--语言-->	
		</div><!--位置-->
		
	<!--内容区-->	

<div class="div_out">

<div class="order_contain" style="border:0; margin-top:20px;">
 <div class="order_main">
 
 <ul class="mb_list">
 <?php
 	while(false!=($file=readdir($file_hand))){
	$info=pathinfo($file);
	if(!empty($info['extension'])||$file=='.'||$file=='..'){continue;}
	//获取图片和配置说明
		$temp_dir=CMS_PATH.'template'.'/'.$info['basename'].'/';
 ?>
 	<li <?php if($_confing['web_template']==$info['basename']){?>class="on"<?php }else{?>class=""<?php }?>>
	<div class="is_tmp" <?php if($_confing['web_template']==$info['basename']){?>style="display:block"<?php }else{?>style="display:none"<?php }?>></div>
	<input type="radio" style="display:none" name="sl_tmp" value="<?php echo $file; ?>" <?php if($_confing['web_template']==$info['basename']){?>checked="checked"<?php }?> />
	<?php
		if(file_exists($temp_dir.'thumb.gif')){
	?>
	<p><img src="<?php echo '../template/'.$info['basename'].'/thumb.gif';?>" border="0" width="200" height="200"/></p>
	<?php
		}else{
	?>
	<p><img src="../upload/no_pc.gif" border="0" width="200" height="200"/></p>
	<?php
		}
		if(file_exists($temp_dir.'info.html')){
	?>
	<p><span>名称：<?php echo $file;?></p>
	<p class="info"></span><span>使用</span><span><a href="<?php echo '../template/'.$info['basename'].'/index.php';?>" class="thickbox">配置说明</a></span></p>
	<?php
		}else{
	?>
	<p><span>名称：<?php echo $file;?></p>
	<?php
		}
		echo '</li>';
	}
	?>	
 </ul>
 <div class="clear"></div>
 
 </div>

</div>

<!--内容区-->

		</div>	
	</div><!--main-->
	<div class="clear"></div>
</div>
<div class="bees_admin_foot">
	<p>版权所有 © 2009-2013 test.com，并保留所有权利。</p>
</div>	



</body>
</html>
