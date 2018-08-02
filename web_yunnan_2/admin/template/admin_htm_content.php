<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>生成内容</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){

	$('tbody').find('tr').hover(function(){
		//$(this).css('background','#ccc');
	},function(){
		//$(this).css('background','none');
	});
	
});

function all_sl(str){
		$ck=$('#'+str).attr('checked');
		if($ck){
			$('table').find('#'+str).find('input').attr('checked','checked');
		}else{
			$('table').find('#'+str).find('input').attr('checked','');
		}
	}

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
		<span>生成内容</span>
			<div class="lang">
			<ul>
			 <?php
 $cache_file=DATA_PATH."cache/lang_cache.php";
 $cache_arr=read_cache($cache_file,'lang_cache');
 if(!empty($cache_arr)){
 foreach($cache_arr as $k=>$v){
  if(!$v['lang_is_use']){continue;}
 ?>
 <li><a href="?action=content&lang=<?php echo $v['lang_tag'];?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>" class="<?php if($GLOBALS['lang']==$v['lang_tag']){echo 'hover';}?>"><?php echo $v['lang_name'];?></a></li>
 <?php
 }
 }
 ?>
			</ul>
		</div><!--语言-->	
		</div><!--位置-->
		
	<!--内容区-->	

<div class="div_out">
 
<div class="order_contain">	
<div class="order_main">
	<form name="maininfo" method="post" action="?action=content_htm&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>" class="form">	
 <table cellpadding="0" cellspacing="0" width="100%">
 	<thead>
		<tr><th style="width:15%">参数说明</th><th style="width:65%">参数值</th></tr>
	</thead>

	<tbody>

		<tr>
		  <td style="width:15%;text-align:center" class="w1">选择栏目：<input type="checkbox" style="border:0" value="" name="all_3" id="all" onclick="all_sl('all');"  title="全选"/></td><td style="width:65%" id="all"><?php
	if(!empty($category)){
	foreach($category as $key=>$value){
	if(in_array($value['cate_tpl'],array('1','2','3'))){continue;}
	
	?>
	<label for="<?php echo $value['id'];?>"><input id="<?php echo $value['id'];?>" type="checkbox" name="cate[]" value="<?php echo $value['id'];?>" style="margin:0 5px; margin-left:8px;border:0"/><?php echo $value['cate_name'];?></label>
	<?php
	}
	}
	?>
	</td>
		</tr>
		<tr>
		  <td style="width:15%;text-align:center" class="w1">定义ID生成</td><td style="width:65%" id="all">从<input name="html_b" value="0" style="width:30px"/>到<input name="html_e" value="20" style="width:30px;"/>&nbsp;<span style="color:#000099">格式为limit 0,20 按最新发布内容排序  不勾选栏目使用该方式</span></td>
		</tr>
		<tr>
		  <td style="width:15%;text-align:center" class="w1">每组生成</td><td style="width:65%" id="all"><input name="html_num" value="20" style="width:20px;"/></td>
		</tr>
	
	</tbody>
 </table>
 	<div class="order_btn">
  <input name="lang" type="hidden" value="<?php echo $lang?>" /><input type="hidden" name="htm" value="1" /><input name="cate_is" value="1" type="hidden" /><input type="hidden" name="step" value="1" />
  <input type="submit" value="确定" name="submit"/><input type="reset" value="重置" name="reset"/>
  </div>
  	</form>
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
