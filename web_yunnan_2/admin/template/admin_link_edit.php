<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改友情链接</title>
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
		<span>修改友情链接</span>
			<div class="admin_fh"><a href="?action=link_list&lang=<?php echo $lang;?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>">返回</a></div>	
		</div><!--位置-->
		
	<!--内容区-->	


<div class="order_contain">
<form name="maininfo" method="post" enctype="multipart/form-data" class="form" action="?nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>">
<div class="order_main">
 <table cellpadding="0" cellspacing="0" width="100%">
 	<thead>
		<tr><th class="w1">参数说明</th><th class="w2">参数值</th><th class="w3 r">变量名</th></tr>
	</thead>
	<tbody>
		<tr>
		  <td class="w1" style="text-align:center">网站网址:</td><td class="w2"><input type="text" name="link_url" style="width:80%" value="<?php echo $rel[0]['link_url'];?>"/></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">网站名称:</td><td class="w2"><input type="text" name="link_name" style="width:80%" value="<?php echo $rel[0]['link_name'];?>"/></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">链接类型:</td><td class="w2"><label for="f1"><input id="f1" type="radio" name="link_type" <?php if($rel[0]['link_type']==0){?>checked="checked"<?php }?> style="border:none; margin-top:3px;" value="0" />文字</label><label for="f2"><input id="f2" type="radio" <?php if($rel[0]['link_type']==1){?>checked="checked"<?php }?> name="link_type" style="border:none; margin-top:3px;" value="1" />图片</label></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">网站LOGO(88*31):</td><td class="w2"><input name="link_logo" value="<?php echo $rel[0]['link_logo'];?>" style="width:30%; display:block; float:left; margin-top:55px;" id="pic_path" />
		  <p style="margin-top:55px;" class="admin_up_pic"><a href="#" id="link_pic">上传图片</a></p><span id="show_pic_path" class="admin_show_pic"><?php if($rel[0]['link_logo']){?><a href="../upload/<?php echo $rel[0]['link_logo'];?>" target="_blank"><img src="../upload/<?php echo $rel[0]['link_logo'];?>"  height="120" width="120" border="0"/></a><?php }else{?><a href="#" id="link_pic2"><img src="../upload/no_pc.gif"  height="120" width="120"/></a> <?php }?></span>
		  </td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">排列顺序:</td><td class="w2"><input type="text" name="link_order" style="width:10%" value="<?php echo $rel[0]['link_order'];?>"/></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">网站说明:</td><td class="w2"><textarea name="link_info" style="width:80%; height:100px;"><?php echo $rel[0]['link_info'];?></textarea></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">站长Email:</td><td class="w2"><input type="text" name="link_mail" style="width:80%" value="<?php echo $rel[0]['link_mail'];?>"/></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">链接位置:</td><td class="w2">首页</td><td class="w3"></td>
		</tr>
		
	</tbody>
 </table>
 </div>

<div class="order_btn">
<input type="hidden" name="action" value="save_edit"/><input type="hidden" name="lang" value="<?php echo $lang;?>"/><input type="hidden" name="id" value="<?php echo $id;?>" />
  <input type="submit" value="修改" name="submit" class="go"/><input type="reset" class="go" value="重置" name="reset"/>
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
$('#link_pic').wBox({title:'链接图片',requestType: "iframe",target:"admin_pic_upload.php?type=radio&get=pic_path",iframeWH:{width:800,height:400}});
$('#link_pic2').wBox({title:'链接图片',requestType: "iframe",target:"admin_pic_upload.php?type=radio&get=pic_path",iframeWH:{width:800,height:400}});
</script>
</body>
</html>
