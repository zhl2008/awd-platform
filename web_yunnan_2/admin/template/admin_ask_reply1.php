<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>咨询回复</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.q').find('ul li').click(function(){
		$index=$('.q').find('ul li').index(this);
		$('#tb').find('div').eq($index).show().siblings().hide();
	});
});
</head>

<body>

<div class="admin_head">
	<div class="admin_logo"><img src="template/images/admin_logo.gif" border="0"/></div>
	<div class="admin_head_rigt">
		<div class="admin_info">
		管理员<label><?php echo $rel[0]['admin_name'];?></label>欢迎回来</span><span>上次登陆时间:<label style="font-weight:normal"><?php echo empty($rel[0]['admin_time'])?'':date('Y-m-d H:m:s',$rel[0]['admin_time']);?></label></span><span>上次登陆IP:<label style="font-weight:normal"><?php echo $rel[0]['admin_ip']; unset($rel);?></label></span><span>本次登陆IP:<label style="font-weight:normal"><?php echo get_ip();?></label><label style="font-weight:bold; padding-left:8px;"><a href="http://www.test.com/alone/alone.php?id=7" target="_blank" style="padding-right:5px; color:#fff">网站建设</a><a href="http://www.test.com/article/article.php?id=23" target="_blank" style="padding-right:5px; color:#fff">模板下载</a><a href="http://www.test.com/alone/alone.php?id=7" target="_blank" style="padding-right:5px; color:#fff">授权服务</a><a href="http://www.169host.com" target="_blank" style="padding-right:5px; color:#fff">域名空间</a></label>
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
			
			<?php include('admin_nav.html')?>
			
			
		</div>
	</div><!--左边-->
	</div><!--nav-->
	
	<div class="bees_main_right">
		<div class="bees_main_content">
		
		<div class="admin_position">
		<span>咨询回复</span>
			<div class="admin_fh"><a href="admin_ask.php">返回列表</a></div>
		</div><!--位置-->
		
	<!--内容区-->	

<div class="order_contain">	
<form name="maininfo" method="post" enctype="multipart/form-data" class="form" action="?">
<div class="order_main">
 <table cellpadding="0" cellspacing="0" width="100%">
 	<thead>
		<tr><th class="w1" style="width:15%">参数说明</th><th class="w2" style="width:70%">参数值</th><th class="w3 r" style="width:15%">变量名</th></tr>
	</thead>
	<tbody>
		<tr>
		  <td class="w1" style="text-align:center;width:15%">咨询标题:</td><td class="w2" style="width:70%"><?php echo $rel[0]['title'];?></td><td class="w3" style="width:15%"></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center;width:15%">咨询人:</td><td class="w2" style="width:70%"><?php echo $rel[0]['title'];?></td><td class="w3" style="width:15%"></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center;width:15%">咨询内容:</td><td class="w2" style="width:70%"><?php echo $rel[0]['content'];?></td><td class="w3" style="width:15%"></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center;width:15%">咨询时间:</td><td class="w2" style="width:70%"><?php echo empty($rel[0]['addtime'])?'':date("Y-m-d H:s:m",$rel[0]['addtime']);?></td><td class="w3" style="width:15%"></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center;width:15%">回复内容:</td><td class="w2" style="width:70%"><textarea name="reply" style="width:80%; height:100px;"><?php echo $rel[0]['reply'];?></textarea></td><td class="w3" style="width:15%"></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center;width:15%">同时通过邮件回复:</td><td class="w2" style="width:70%"><label for="m1"><input id="m1" type="radio" value="1" name="is_mail"/>是</label><label for="m2"><input type="radio" id="m2" name="is_mail" checked="checked" value="0"/>否</label>&nbsp;(该功能需要先开启咨询接收邮件)</td><td class="w3" style="width:15%"></td>
		</tr>
	</tbody>
 </table>
 </div>

<div class="order_btn">
<input type="hidden" name="action" value="save_reply"/><input type="hidden" name="id" value="<?php echo $id;?>"/><input type="hidden" name="replytime" value="<?php echo $rel[0]['replytime'];?>" /><input type="hidden" name="member_id" value="<?php echo $rel[0]['member'];?>"/>
  <input type="submit" value="确定" name="submit"/><input type="reset" style="margin:0 10px;" value="重置" name="reset"/>
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
