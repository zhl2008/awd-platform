<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>设置留言本</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
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
		<span>设置留言本</span>
			
		</div><!--位置-->
		
	<!--内容区-->	

<div class="order_contain">
<form name="maininfo" method="post" enctype="multipart/form-data" action="?nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>" class="form">
<div class="order_main">
 <table cellpadding="0" cellspacing="0" width="100%">
 	<thead>
		<tr><th class="w1">参数说明</th><th class="w2">参数值</th><th class="w3">变量名</th></tr>
	</thead>
	<tbody>
		<tr>
		  <td class="w1" style="text-align:center">开启留言本:</td><td class="w2"><label for="f1"><input id="f1" type="radio" value="1" name="is_book" style=" border:none" <?php if($rel[0]['is_book']){?>checked="checked"<?php }?>/>是</label><label for="f2"><input id="f2" style="border:none" type="radio" value="0" name="is_book" <?php if(!$rel[0]['is_book']){?>checked="checked"<?php }?>/>否</label></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">设置位置:</td><td class="w2"><label for="f3"><input id="f3" type="checkbox" value="1" name="book_pos[]" style="border:none" <?php if(in_array('1',$book_pos)){?>checked="checked"<?php }?>/>顶部导航</label><label for="f4"><input id="f4" style="border:none" type="checkbox" value="2" name="book_pos[]" <?php if(in_array('2',$book_pos)){?>checked="checked"<?php }?>/>底部导航</label></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">留言审核:</td><td class="w2"><label for="f5"><input id="f5" type="radio" value="1" name="book_verify" style="border:none" <?php if($rel[0]['book_verify']){?>checked="checked"<?php }?>/>是</label><label for="f6"><input id="f6" style="border:none" type="radio" value="0" name="book_verify" <?php if(!$rel[0]['book_verify']){?>checked="checked"<?php }?>/>否</label></td><td class="w3"></td>
		</tr>
	</tbody>
 </table>
 </div>
 <div class="order_btn">
<input type="hidden" name="action" value="save_book_info"/>
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
