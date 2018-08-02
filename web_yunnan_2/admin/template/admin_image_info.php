<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加语言包</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<style type="text/css">
body{margin:20px;}
</style>
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
			
			<?php include('admin_nav.php')?>
			
			
		</div>
	</div><!--左边-->
	</div><!--nav-->
	
	<div class="bees_main_right">
		<div class="bees_main_content">
		
		<div class="admin_position">
		<span> 管理员分组列表</span>
			
		</div><!--位置-->
		
	<!--内容区-->	

<div class="order_contain">
<form name="maininfo" method="post" enctype="multipart/form-data" action="#" class="form">
 <div class="order_main">
 <table cellpadding="0" cellspacing="0" width="100%">
 	<thead>
		<tr><th style="width:10%">组ID</th><th style="width:20%">组名称</th><th style="width:40%">组描述</th><th style="width:10%">状态</th><th style="width:20%">操作</th></tr>
	</thead>
	<tbody style="text-align:center" id="show_list">
		<?php
			if(empty($admin_group)){
			die("还没有添加分组");
			}else{
			foreach($admin_group as $k=>$v){
		?>
		<tr>
		<td style="width:10%;text-align:center"><?php echo $v['id'];?></td><td style="width:20%;text-align:center"><?php echo $v['admin_group_name'];?></td><td style="width:40%;text-align:center"><?php echo $v['admin_group_info'];?></td><td style="width:10%"><?php if($v['is_disable']){?>禁用<?php }else{?>开启<?php }?></td><td style="width:20%;text-align:center"><a href="admin_admin.php?action=admin_group_edit&id=<?php echo $v['id'];?>" style="padding:0 2px;">修改</a>|<a href="javascript:if(confirm('确定要删除么？删除后不可恢复')){location.href='admin_admin.php?action=admin_group_del&id=<?php echo $v['id'];?>';}" style="padding:0 2px;">删除</a></td>
		</tr>
		<?php
		}
		}
		?>
	</tbody>
 </table>
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



<div class="div_out">
 <div class="position"><h2>当前位置 > 语言管理 > 添加语言</h2></div>
 <div class="lang"><a href="?lang=cn">中文语言</a><a href="?lang=en">English</a></div>
</div><!--导航-->
<form name="maininfo" method="post" enctype="multipart/form-data" action="admin_info.php" class="form" style="margin-top:20px;">
<div class="div_out" id="tb">
 <table cellpadding="0" cellspacing="0" width="100%">
 	<thead>
		<tr><th class="w1">参数说明</th><th class="w2">参数值</th><th class="w3">变量名</th></tr>
	</thead>
	<tbody>
		<tr>
		  <td class="w1">上传图片开启水印:</td><td class="w2"><input type="radio" value="1" name="image_is[]" style="margin:0 5px; border:none" <?php if($image_info['image_is']){?>checked="checked"<?php }?>/>是<input style="margin:0 5px; border:none" type="radio" value="0" name="image_is[]" <?php if(!$image_info['image_is']){?>checked="checked"<?php }?>/>否</td><td class="w3">$image_is</td>
		</tr>
		<tr>
		  <td class="w1">运程下载图片开启水印:</td><td class="w2"><input type="radio" value="1" name="image_url_is[]" style="margin:0 5px; border:none" <?php if($image_info['image_url_is']){?>checked="checked"<?php }?>/>是<input style="margin:0 5px; border:none" type="radio" value="0" name="image_url_is[]" <?php if(!$image_info['image_url_is']){?>checked="checked"<?php }?>/>否</td><td class="w3">$image_url_is</td>
		</tr>
		<tr>
		  <td class="w1">水印类型:</td><td class="w2"><input type="radio" value="0" name="image_type[]" style="margin:0 5px; border:none" <?php if(!$image_info['image_type']){?>checked="checked"<?php }?>/>文字<input style="margin:0 5px; border:none" type="radio" value="1" name="image_type[]" <?php if($image_info['image_type']){?>checked="checked"<?php }?>/>图片</td><td class="w3">$image_type</td>
		</tr>
		<tr>
		  <td class="w1">水印大小(图片水印):</td><td class="w2">高<input type="text" value="<?php echo $image_info['image_height'];?>" name="image_height" style="width:10%; margin:0 5px; "/>宽<input style="margin:0 5px; width:10%;" type="text" value="<?php echo $image_info['image_width'];?>" name="image_width"/></td><td class="w3">$image_width,$image_height</td>
		</tr>
		<tr>
		  <td class="w1">文字(文字水印):</td><td class="w2"><input type="text" name="image_text" value="<?php echo $image_info['image_text'];?>" style="width:50%"/></td><td class="w3">$image_is</td>
		</tr>
		<tr>
		  <td class="w1">水印图片:</td><td class="w2"><img src="<?php echo '../'.$image_info['pics'];?>" border="0"/></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1">上传水印图片:</td><td class="w2"><input type="file" name="pic" /></td><td class="w3">$pic</td>
		</tr>
		<tr>
		  <td class="w1">水印位置</td><td class="w2"><table cellpadding="0" cellspacing="0" width="60%">
		  	<tr>
				<td width="20%"><input type="radio" name="image_position[]" value="1" <?php if($image_info['image_position']==1){?>checked="checked"<?php }?>/>顶部居左</td><td width="20%"><input type="radio" name="image_position[]" value="2" <?php if($image_info['image_position']==2){?>checked="checked"<?php }?>/>顶部居中</td><td width="20%"><input type="radio" name="image_position[]" value="3" <?php if($image_info['image_position']==3){?>checked="checked"<?php }?>/>顶部居右</td>
			</tr>
			<tr>
				<td width="20%"><input type="radio" name="image_position[]" value="4" <?php if($image['image_position']==4){?>checked="checked"<?php }?>/>中部居左</td><td width="20%"><input type="radio" name="image_position[]" value="5" <?php if($image_info['image_position']==5){?>checked="checked"<?php }?>/>中部居中</td><td width="20%"><input type="radio" name="image_position[]" value="6" <?php if($image_info['image_position']==6){?>checked="checked"<?php }?>/>中部居右</td>
			</tr>
			<tr>
				<td width="20%"><input type="radio" name="image_position[]" value="7" <?php if($image_info['image_position']==7){?>checked="checked"<?php }?>/>底部居左</td><td width="20%"><input type="radio" name="image_position[]" value="8" <?php if($image_info['image_position']==8){?>checked="checked"<?php }?>/>底部居中</td><td width="20%"><input type="radio" name="image_position[]" value="9" <?php if($image_info['image_position']==9){?>checked="checked"<?php }?>/>底部居右</td>
			</tr>
		  </table></td><td class="w3">$image_position</td>
		</tr>
	</tbody>
 </table>
 </div>
 <div class="btn" style="margin-top:10px">
<input type="hidden" name="action" value="save_image"/><input type="hidden" name="lang" value="<?php echo $GLOBALS['lang'];?>"/><input type="hidden" name="pics" value="<?php echo $image_info['pics'];?>"/>
  <input type="submit" value="确定" name="submit" style="width:15%"/><input type="reset" style="margin:0 10px; width:15%" value="重置" name="reset"/>
 </div>
</form>

</body>
</html>
