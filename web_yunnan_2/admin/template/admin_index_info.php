<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站首页配置</title>
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
		<span>网站首页设置</span>
			
		</div><!--位置-->
		
	<!--内容区-->	

	<div class="order_contain">
<form name="maininfo" method="post" enctype="multipart/form-data" action="?" class="form">
		<div class="order_main">
 <table cellpadding="0" cellspacing="0" width="100%" class="table_info1">
 	<thead>
		<tr><th class="w1">参数说明</th><th class="w2">参数值</th><th class="w3">变量名</th></tr>
	</thead>
	<tbody>
		<tr>
		  <td class="w1"><span title="开启该功能，首先进入的是引导页" class="help">开启flash引导页：</span></td><td class="w2"><label for="is_flash"><input type="radio" value="1" name="flash_is" id="is_flash" style="margin:0 5px; border:none" <?php if($index_info['flash_is'][0]){?>checked="checked"<?php }?>/>是</label><label for="is_flash1"><input style="margin:0 5px; border:none" id="is_flash1" type="radio" value="0" name="flash_is" <?php if(!$index_info['flash_is'][0]){?>checked="checked"<?php }?>/>否</label>&nbsp;<span class="cms_info">flash动画上传到template目录下，修改flash.html中的路径</span></td><td class="w3"></td>
		</tr>
		
		<tr>
		  <td class="w1">进入网站语言：</td><td class="w2"><select name="index_lang">
		  <?php
		  if($lang_cache){
		  	foreach($lang_cache as $k=>$v){
			  if(!$v['lang_is_use']){continue;}
				$ck='';
				if($v['id']==$index_info['index_lang']){$ck="selected=\"selected\"";}
				echo "<option value=\"{$v['id']}\" {$ck}>{$v['lang_name']}</option>";
			}
		  }
		  ?>
		  
		  </select></td><td class="w3"></td>
		</tr>
		
	</tbody>
 </table>
 </div>
<div class="order_btn">
<input type="hidden" name="action" value="save_index"/><input type="hidden" name="nav" value="<?php echo $admin_nav;?>"/><input type="hidden" name="admin_p_nav" value="<?php echo $admin_p_nav;?>"/>
  <input type="submit" value="确定" class="go" name="submit"/><input type="reset" class="go" value="重置" name="reset"/>
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
