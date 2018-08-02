<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站语言列表</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript" src="template/images/admin.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#show_list').find('tr').hover(function(){
		$(this).find('td').css('background','#F0F2F4');
	},function(){
		$(this).find('td').css('background','');
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
		<span>网站语言列表</span>
			
		</div><!--位置-->
		
	<!--内容区-->	

<div class="order_contain" style="padding-bottom:200px;">
<form name="maininfo" method="post" enctype="multipart/form-data" class="form">
 <div class="order_main">
 <table cellpadding="0" cellspacing="0" width="100%" style="text-align:center">
 	<thead>
		<tr><th style="width:10%;"><span title="鼠标点击数字进行排序" class="help"></span>排序</th><th style="width:20%;">语言名称</th><th style="width:20%;">标示</th><th style="width:10%">是否开启</th><th style="width:10%;">是否外部链接</th><th style="width:30%">操作</th></tr>
	</thead>
	<tbody id="show_list">
	<?php
	if(empty($lang_cache)){
	echo "还没有添加语言";
	exit;
	}
	foreach($lang_cache as $key =>$value){
	?>
		<tr>
		<td style="width:10%;"><?php echo $value['lang_order'];?></td><td style="width:20%; text-align:left"><label for="f_<?php echo $value['id'];?>"><input id="f_<?php echo $value['id'];?>" type="radio" style="border:0" name="lang_id" value="<?php echo $value['id'];?>" <?php if($value['lang_main']){ echo 'checked=checked';}?>/><?php echo $value['lang_name'];?><?php if($value['lang_main']){echo "(默认)";}?></label></td><td style="width:20%; text-align:center"><?php echo $value['lang_tag'];?></td><td style="width:10%; text-align:center"><?php if($value['lang_is_use']){ echo "是";}else{ echo "<span style=\"color:red\">否</span>";}?></td><td style="width:10%; text-align:center"><?php if($value['lang_is_url']){ echo "是";}else{ echo "否";}?></td><td style="width:30%; text-align:center"><a style="padding:0 5px;" href="admin_lang.php?action=lang_edit&lang=<?php echo $value['lang_tag'];?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>">修改</a>|<a href="?action=import_lang&lang=<?php echo $value['lang_tag'];?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>">导出语言包</a>|<a href="?action=backup_lang&lang=<?php echo $value['lang_tag'];?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>">导入语言包</a><?php if(!$value['lang_is_fix']){?>|<a href="javascript:if(confirm('确定要删除么,删除后不可恢复!')){location.href='admin_lang.php?action=lang_dl&lang=<?php echo $value['lang_tag'];?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>';}" style="padding:0 5px;">删除</a><?php }?></td>
		</tr>	
	<?php
	}
	?>
	</tbody>
 </table>
 </div>
  <div class="btn" style="margin-top:8px; margin-bottom:10px; margin-left:100px;">
<input type="hidden" name="action" value="lang_main"/>
 <input type="submit" value="设为后台默认语言" style="margin:0 10px 0 0;"/>
 </div>
</form>
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
