<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站系统设置</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript" src="template/images/admin.js"></script>
<script type="text/javascript" src="template/images/box/thickbox.js"></script>
<link type="text/css" href="template/images/box/thickbox.css" rel="stylesheet" />
<script type="text/javascript">
$(document).ready(function(){
	$('.info_qh').find('ul li').click(function(){
		$index=$('.info_qh').find('ul li').index(this);
		$(this).addClass('on').siblings().removeClass('on');
		$('#tb').find('div').eq($index).show().siblings().hide();
	});
			
});

function mark_text(){
	$('#pic_mark').hide();
	$('#text_mark').show();
}
function mark_pic(){
	$('#text_mark').hide();
	$('#pic_mark').show();
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
		<span>网站系统设置</span>
			
		</div><!--位置-->
		
	<!--内容区-->	

<div class="order_contain">
		<form name="maininfo" method="post" class="form">
		<div class="order_main">
	<div class="info_qh" style="margin-top:20px;">
 <ul>
  <li class="on">附件设置</li>
  <li>图片水印</li>
  <li>邮箱设置</li>
  <li>验证安全</li>
  <li>其它设置</li>
 </ul>
 <div class="clear"></div>
</div>
<div id="tb">
 <div id="sys1" style="display:block">
 <table cellpadding="0" cellspacing="0" width="100%" class="table_info1">
 	<thead>
		<tr><th class="w1">参数说明</th><th class="w2">参数值</th><th class="w3">变量名</th></tr>
	</thead>
	<tbody>
		<tr>
		  <td class="w1">允许上传的文件类型(用|分割):</td><td class="w2"><textarea name="web_upload_file" style="width:95%; height:50px;"><?php echo $_sys['web_upload_file'];?></textarea></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1">缩略图默认宽度(px):</td><td class="w2"><input type="text" name="thump_width" style="width:30%" value="<?php echo $_sys['thump_width'];?>"/></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1">缩略图默认高度(px):</td><td class="w2"><input type="text" name="thump_height" style="width:30%" value="<?php echo $_sys['thump_height'];?>"/></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1">允许上传文件的最大值:</td><td class="w2"><input type="text" name="upload_size" style="width:50%" value="<?php echo empty($_sys['upload_size'])?'20':$_sys['upload_size'];?>"/>M</td><td class="w3"></td>
		</tr>
    </tbody>
 </table>
 </div>
 
 
 
 <div id="sys2" style="display:none">
 <table cellpadding="0" cellspacing="0" class="table_info1" width="100%">
 	<thead>
		<tr><th class="w1">参数说明</th><th class="w2">参数值</th><th class="w3">变量名</th></tr>
	</thead>
	<tbody>
		<tr>
		  <td class="w1">开启水印:</td><td class="w2"><label for="f7"><input id="f7" type="radio" value="1" name="image_is[]" style="margin:0 5px; border:none" <?php if($_sys['image_is'][0]){?>checked="checked"<?php }?>/>是</label><label for="f8"><input id="f8" style="margin:0 5px; border:none" type="radio" value="0" name="image_is[]" <?php if(!$_sys['image_is'][0]){?>checked="checked"<?php }?>/>否</label></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1">运程下载图片开启水印:</td><td class="w2"><label for="f9"><input id="f9" type="radio" value="1" name="image_url_is[]" style="margin:0 5px; border:none" <?php if($_sys['image_url_is'][0]){?>checked="checked"<?php }?>/>是</label><label for="f10"><input id="f10" style="margin:0 5px; border:none" type="radio" value="0" name="image_url_is[]" <?php if(!$_sys['image_url_is'][0]){?>checked="checked"<?php }?>/>否</label></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1">水印类型:</td><td class="w2"><label for="f11"><input id="f11" type="radio" value="0" name="image_type[]" style="margin:0 5px; border:none" <?php if(!$_sys['image_type'][0]){?>checked="checked"<?php }?> onclick="mark_text();"/>文字</label><label for="f12"><input id="f12" style="margin:0 5px; border:none" type="radio" value="1" name="image_type[]" <?php if($_sys['image_type'][0]){?>checked="checked"<?php }?> onclick="mark_pic();"/>图片</label></td><td class="w3"></td>
		</tr>
		<tbody id="text_mark" style="display:<?php if(!$_sys['image_type'][0]){echo"";}else{echo "none";}?>">
		<tr>
		  <td class="w1"><span title="目前不支持中文,使用中文请使用图片水印" class="help">水印文字(文字水印):</span></td><td class="w2"><input type="text" name="image_text" value="<?php echo $_sys['image_text'];?>" style="width:50%"/></td><td class="w3">&nbsp;</td>
		</tr>
		<tr>
		  <td class="w1"><span title="0-255之间的数值,用,分割" class="help">文字颜色(文字水印):</span></td><td class="w2"><input type="text" name="image_text_color" value="<?php echo $_sys['image_text_color'];?>" style="width:50%"/></td><td class="w3">&nbsp;</td>
		</tr>
		<tr>
		  <td class="w1">文字大小(文字水印):</td><td class="w2"><input type="text" name="image_text_size" value="<?php echo $_sys['image_text_size'];?>" style="width:50%"/></td><td class="w3">&nbsp;</td>
		</tr>
		</tbody>
		<tbody id="pic_mark" style="display:<?php if($_sys['image_type'][0]){echo"";}else{echo "none";}?>">
		<tr>
		  <td class="w1">水印图片:</td><td class="w2"><img src="<?php echo CMS_SELF.'upload/'.$_sys['pic'];?>" border="0"/></td><td class="w3">&nbsp;</td>
		</tr>
		<tr>
		  <td class="w1">上传水印图片:</td><td class="w2"><input style="width:200px; display:block; float:left" name="pic" value="<?php echo $_sys['pic'];?>"  id="pic_path"/>通过ftp上传图片到upload下覆盖mark_logo.gif</td><td class="w3">&nbsp;</td>
		</tr>
		</tbody>
		<tr>
		  <td class="w1">水印位置</td><td class="w2"><table cellpadding="0" cellspacing="0" width="60%">
		  	<tr>
				<td width="20%"><label for="f13"><input id="f13" type="radio" style="border:0" name="image_position[]" value="1" <?php if($_sys['image_position'][0]==1){?>checked="checked"<?php }?>/>顶部居左</label></td><td width="20%"><label for="f14"><input id="f14" type="radio" style="border:0" name="image_position[]" value="2" <?php if($_sys['image_position'][0]==2){?>checked="checked"<?php }?>/>顶部居中</label></td><td width="20%"><label for="f15"><input id="f15" type="radio" style="border:0" name="image_position[]" value="3" <?php if($_sys['image_position'][0]==3){?>checked="checked"<?php }?>/>顶部居右</label></td>
			</tr>
			<tr>
				<td width="20%"><label for="f16"><input id="f16" type="radio" name="image_position[]" value="4" style="border:0" <?php if($_sys['image_position']==4){?>checked="checked"<?php }?>/>中部居左</label></td><td width="20%"><label for="f17"><input id="f17" type="radio" name="image_position[]" value="5" style="border:0" <?php if($_sys['image_position'][0]==5){?>checked="checked"<?php }?>/>中部居中</label></td><td width="20%"><label for="f18"><input id="f18" type="radio" name="image_position[]" value="6" style="border:0" <?php if($_sys['image_position'][0]==6){?>checked="checked"<?php }?>/>中部居右</label></td>
			</tr>
			<tr>
				<td width="20%"><label for="f19"><input id="f19" type="radio" name="image_position[]" value="7" style="border:0" <?php if($_sys['image_position'][0]==7){?>checked="checked"<?php }?>/>底部居左</label></td><td width="20%"><label for="f20"><input id="f20" type="radio" name="image_position[]" value="8" style="border:0" <?php if($_sys['image_position'][0]==8){?>checked="checked"<?php }?>/>底部居中</label></td><td width="20%"><label for="f21"><input id="f21" type="radio" name="image_position[]" value="9" style="border:0" <?php if($_sys['image_position'][0]==9){?>checked="checked"<?php }?>/>底部居右</label></td>
			</tr>
		  </table></td><td class="w3"></td>
		</tr>
	</tbody>
 </table>
 
 </div>
 
 <div id="sys3" style="display:none">
 <table cellpadding="0" cellspacing="0" width="100%" class="table_info1">
 	<thead>
		<tr><th class="w1">参数说明</th><th class="w2">参数值</th><th class="w3">变量名</th></tr>
	</thead>
	<tbody>
	<tr>
		  <td class="w1">邮件发送类型:</td><td class="w2"><input type="radio" name="mail_type[]" value="1" checked="checked"/>SMTP协议发送<span style="color:#FF0000">(邮件功能操作的时候请耐性等待)</span></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1">邮件服务器地址:</td><td class="w2"><input type="text" name="mail_host" value="<?php echo empty($_sys['mail_host'])?'smtp.163.com':$_sys['mail_host'];?>"/></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1">邮件发送端口:</td><td class="w2"><input type="text" name="mail_pot" style="width:30%" value="<?php echo empty($_sys['mail_pot'])?'25':$_sys['mail_pot'];?>"/>一般不用修改</td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1">发送邮箱:</td><td class="w2"><input type="text" name="mail_mail" style="width:50%" value="<?php echo $_sys['mail_mail'];?>"/>建议使用新注册(不常用)邮箱发送</td><td class="w3"></td>
		<tr>
		  <td class="w1">发送邮箱帐号:</td><td class="w2"><input type="text" name="mail_user" style="width:50%" value="<?php echo $_sys['mail_user'];?>"/></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1">发送邮箱密码:</td><td class="w2"><input type="password" name="mail_pw" style="width:50%" value="<?php echo $_sys['mail_pw'];?>"/></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1">接送邮箱:</td><td class="w2"><input type="text" name="mail_js" style="width:50%" value="<?php echo $_sys['mail_js'];?>"/>接收反馈信息，建议填写常用邮箱，为空使用发送邮箱接收</td><td class="w3"></td>
		<tr>
		  <td class="w1">邮件结尾说明:</td><td class="w2"><textarea name="mail_jw" style="width:95%; height:50px;"><?php echo empty($_sys['mail_jw'])?'BEESCMS企业网站管理系统 http://www.test.com':$_sys['mail_jw'];?></textarea></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1">接收反馈设置:</td><td class="w2"><label for="m1"><input id="m1" type="checkbox" value="1" name="mail_feed[]" style="border:none; margin-top:3px"  
		  <?php if(!empty($_sys['mail_feed'])){
		  		foreach($_sys['mail_feed'] as $k=>$v){
				if($v=='1'){
		  ?>checked="checked"
		  <?php 
		  }
		  }
		  }?>
		  />表单反馈</label><label for="m2"><input id="m2" style="border:none;margin-top:3px" type="checkbox" value="2" name="mail_feed[]"  
		   <?php if(!empty($_sys['mail_feed'])){
		  		foreach($_sys['mail_feed'] as $k=>$v){
				if($v=='2'){
		  ?>checked="checked"
		  <?php 
		  }
		  }
		  }?>
		  />会员反馈</label>
		  <label for="m3"><input id="m3" style="border:none;margin-top:3px" type="checkbox" value="3" name="mail_feed[]"  
		   <?php if(!empty($_sys['mail_feed'])){
		  		foreach($_sys['mail_feed'] as $k=>$v){
				if($v=='3'){
		  ?>checked="checked"
		  <?php 
		  }
		  }
		  }?>
		  />留言反馈</label></td><td class="w3"></td>
		</tr>
    </tbody>
 </table>
 </div>
 
 <div id="sys4" style=" display:none">
 
  <table cellpadding="0" cellspacing="0" class="table_info1" width="100%">
 	<thead>
		<tr><th class="w1">参数说明</th><th class="w2">参数值</th><th class="w3">变量名</th></tr>
	</thead>
	<tbody>
		<tr>
		  <td class="w1">开启系统验证码:</td><td class="w2">
		 <label for="f24"><input id="f24" style="border:none" type="checkbox" value="3" name="safe_open[]"  
		   <?php if(!empty($_sys['safe_open'])){
		  		foreach($_sys['safe_open'] as $k=>$v){
				if($v=='3'){
		  ?>checked="checked"
		  <?php 
		  }
		  }
		  }?>
		  />管理登录</label></td><td class="w3"></td>
		</tr>
	</tbody>
 </table>
 
 </div>
 
 <div id="sys5" style="display:none">
 <table cellpadding="0" cellspacing="0" class="table_info1" width="100%">
 	<thead>
		<tr><th class="w1">参数说明</th><th class="w2">参数值</th><th class="w3">变量名</th></tr>
	</thead>
	<tbody>
		<tr>
		  <td class="w1">内容标题最大长度(10-240之间):</td><td class="w2"><input type="text" name="web_content_title" style="width:30%" value="<?php echo isset($_sys['web_content_title'])&&!empty($_sys['web_content_title'])?$_sys['web_content_title']:'180';?>"/></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1">内容自动摘要长度(10-240之间):</td><td class="w2"><input type="text" name="web_content_info" style="width:30%" value="<?php echo isset($_sys['web_content_info'])&&!empty($_sys['web_content_info'])?$_sys['web_content_info']:'200';?>"/></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1">默认点击数:<p style="color:#999999; font-weight:normal">为空或0为1-500间的随机数</p></td><td class="w2"><input type="text" name="is_hits" style="width:30%" value="<?php echo $_sys['is_hits'];?>"/></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1">过滤词语（词语会被替换成***）用|分开:</td><td class="w2"><textarea name="fialt_words" style="width:95%; height:50px;"><?php echo $_sys['fialt_words'];?></textarea></td><td class="w3"></td>
		</tr>
		
		
    </tbody>
 </table>
 </div>
 
</div>
		</div>
		<div class="order_btn">
			<input type="hidden" name="action" value="add_sys"/><input type="hidden" name="nav" value="<?php echo $admin_nav;?>"/><input type="hidden" value="<?php echo $admin_p_nav;?>" name="admin_p_nav"/>
  			<input type="submit" value="确定" name="submit" class="go"/><input type="reset" style="margin:0 10px;" class="go" value="重置" name="reset"/>
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