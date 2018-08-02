<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>图片修改</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript" src="template/images/form.js"></script>
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
		<span>修改图片</span>
			<div class="admin_fh"><a href="?nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>">返回</a></div>
		</div><!--位置-->
		
	<!--内容区-->	

<div class="order_contain">
	<form name="add_cata" action="?nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>" method="post" class="form" enctype="multipart/form-data">
	<div class="order_main">
 <table cellpadding="0" cellspacing="0" width="100%">
 	<thead>
		<tr><th class="w1">参数</th><th style="width:80%">参数值</th></tr>
	</thead>
	<tbody>
		<tr>
		  <td class="w1" style="text-align:center">图片名称：</td><td style="width:80%"><a href="<?php echo $img;?>" target="_blank"><img src="<?php echo $img;?>" border="0" width="90" height="90" style="padding:1px; border:1px solid #ddd" /></a></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">缩略图：</td><td style="width:80%"><input type="radio" name="is_thumb" value="1" style="margin:0 5px;border:0"/>是<input type="radio" value="0" name="is_thumb" style="margin:0 5px; border:0"  checked="checked"/>否&nbsp;&nbsp;&nbsp;<span style="color:#0000CC">重新生成缩略图选择'是',只修改信息选择'否'</span></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">缩略图大小：</td><td style="width:80%"><input type="text" style="width:50px;" name="thumb_width" value="<?php echo $_sys['thump_width'];?>" />宽&nbsp;&nbsp;<input type="text" name="thumb_height" style="width:50px;" value="<?php echo $_sys['thump_height'];?>" />高&nbsp;&nbsp;&nbsp;<span style="color:#0000CC">只在生成缩略图时起作用</span></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">图片alt：</td><td style="width:80%"><input type="text" value="<?php echo $rel[0]['pic_alt'];?>" style="width:200px;" name="pic_alt" /></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">重新上传：</td><td style="width:80%"><input type="file" value="" style="width:200px;" name="new_pic" />新上传的图片会使用原图片的名称，后缀名不会更改，建议使用和原图片一样的后缀名</td>
		</tr>
		</tbody>
 </table>
 </div>
<div class="order_btn">
<input type="hidden" name="action" value="save_edit"/><input type="hidden" name="pic_cate" value="<?php echo $rel[0]['pic_cate'];?>" /><input type="hidden" name="pic_path" value="<?php echo $rel[0]['pic_path'];?>" /><input type="hidden" name="pic_name" value="<?php echo $rel[0]['pic_name'];?>" /><input type="hidden" name="pic" value="<?php echo $pic;?>" /><input type="hidden" name="pic_ext" value="<?php echo $rel[0]['pic_ext'];?>" /><input type="hidden" name="id" value="<?php echo $rel[0]['id'];?>"/><input type="hidden" value="<?php echo $rel[0]['pic_thumb'];?>" name="pic_thumb"/>
  <input type="submit" value="确定" name="xg_category" class="go"/><input type="reset" style="margin:0 10px;" class="go" value="重置" name="reset"/>
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
