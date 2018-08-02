<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>主广告图片修改</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript" src="template/images/dialog-min.js"></script>
<link type="text/css" href="template/images/dialog/dialog.css" rel="stylesheet" />
<script type="text/javascript">
$(document).ready(function(){
	$('.q').find('ul li').click(function(){
		$index=$('.q').find('ul li').index(this);
		$('#tb').find('div').eq($index).show().siblings().hide();
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
		<span>主广告图片修改</span>
			<div class="admin_fh"><a href="?cate_id=<?php echo $cate_id;?>&lang=<?php echo $lang;?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>">返回</a></div>
		</div><!--位置-->
		
	<!--内容区-->	


		
<div class="order_contain">	
<form name="maininfo" method="post" enctype="multipart/form-data" action="?nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>" class="form">
<div class="order_main">
 <table cellpadding="0" cellspacing="0" width="100%" class="table_info1">
 	<thead>
		<tr><th class="w1">参数说明</th><th class="w2">参数值</th><th class="w3 r">变量名</th></tr>
	</thead>
	<tbody>
		<tr>
		  <td class="w1" style="text-align:center">分类:</td><td class="w2"><select name="cate_id">
		  <option value="">请选择分类</option>
		  <?php
		  if($rel_cate){
		  		foreach($rel_cate as $row){
		  ?>
		   <option value="<?php echo $row['id'];?>" <?php if($row['id'] == $cate_id){ echo 'selected="selected"';}?>><?php echo $row['cate_name'];?></option>
		  <?php
		  		}
			}	
		  ?>
		  </select></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">图片地址:</td><td class="w2">
		  <input name="pic" value="<?php echo $rel[0]['pic'];?>" style="width:30%; display:block; float:left; margin-top:55px;" id="pic_path" /><p style="margin-top:55px;" class="admin_up_pic"><a href="#" id="flash_pic">上传图片</a></p><span id="show_pic_path" class="admin_show_pic"><?php if($rel[0]['pic']){?><a href="../upload/<?php echo $rel[0]['pic'];?>" target="_blank"><img src="../upload/<?php echo $rel[0]['pic'];?>"  height="120" width="120" border="0"/></a><?php }else{?><a href="#" id="flash_pic"><img src="../upload/no_pc.gif"  height="120" width="120"/></a> <?php }?></span></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">链接地址:</td><td class="w2"><input type="text" name="pic_url" style="width:80%" value="<?php echo empty($rel[0]['pic_url'])?'http://':$rel[0]['pic_url'];?>"/></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">图片描述:</td><td class="w2"><input type="text" name="pic_text" style="width:80%" value="<?php echo $rel[0]['pic_text'];?>"/></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">排序:</td><td class="w2"><input type="text" name="pic_order" style="width:20%" value="<?php echo empty($rel[0]['pic_order'])?10:$rel[0]['pic_order'];?>"/></td><td class="w3"></td>
		</tr>
	</tbody>
 </table>
 </div>

<div class="order_btn">
<input type="hidden" name="action" value="save_edit"/><input type="hidden" name="lang" value="<?php echo $rel[0]['lang'];?>"/><input type="hidden" name="id" value="<?php echo $rel[0]['id'];?>" />
  <input type="submit" value="确定" name="submit" /><input type="reset" style="margin:0 10px;" value="重置" name="reset"/>
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
<script type="text/javascript">
$('#flash_pic').wBox({title:'主广告图片',requestType: "iframe",target:"admin_pic_upload.php?type=radio&get=pic_path",iframeWH:{width:800,height:400}});
$('#flash_pic2').wBox({title:'主广告图片',requestType: "iframe",target:"admin_pic_upload.php?type=radio&get=pic_path",iframeWH:{width:800,height:400}});
</script>
</body>
</html>
