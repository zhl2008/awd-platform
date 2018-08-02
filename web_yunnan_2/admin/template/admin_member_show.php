<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>查看会员</title>
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

</script>
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
		<span>查看会员</span>
			<div class="admin_fh"><a href="?action=member&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>">返回</a></div>
		</div><!--位置-->
		
	<!--内容区-->	


<div class="order_contain">	
<form name="maininfo" method="post" enctype="multipart/form-data" class="form">
<div class="order_main">
 <table cellpadding="0" cellspacing="0" width="100%">
 	<thead>
		<tr><th style="width:15%">参数说明</th><th style="width:85%">参数值</th></tr>
	</thead>
	<tbody>
	
		<tr>
		  <td style="width:15%;text-align:center" class="w1">登录用户名：</td><td style="width:85%"><?php echo $rel_mb[0]['member_user'];?></td>
		</tr>
		<tr>
		  <td style="width:15%;text-align:center" class="w1">用户昵称：</td><td style="width:85%"><?php echo $rel_mb[0]['member_nich'];?></td>
		</tr>
		<tr>
		  <td style="width:15%;text-align:center" class="w1">用户组：<p style="color:#999999; font-weight:normal"></p></td><td style="width:85%"><?php if(empty($member_group)){ echo "还没有添加用户组"; }else{?><select name="member_purview" disabled="disabled">
		  <?php 
		  $str='';
		  foreach($member_group as $k=>$v){
		  	if($v['is_disable']){
				continue;
			}
			$ck=($v['id']==$rel_mb[0]['member_purview'])?'selected="selected"':'';
		  	$str.="<option value=\"{$v['id']}\" {$ck}>{$v['member_group_name']}</option>";
		  }
		  echo $str;
		  ?>
		  </select><?php }?></td>
		</tr>
		<tr>
		  <td style="width:15%;text-align:center" class="w1">用户姓名：</td><td style="width:85%"><?php echo empty($rel_mb[0]['member_name'])?"未填写":$rel_mb[0]['member_name'];?></td>
		</tr>
		<tr>
		  <td style="width:15%;text-align:center" class="w1">性别：</td><td style="width:85%">
		  <?php 
		  if($rel_mb[0]['member_sex']==0){
		  echo "保密";
		  }elseif($rel_mb[0]['member_sex']==1){
		  echo "男";
		  }elseif($rel_mb[0]['member_sex']==2){
		  echo "女";
		  }?>
		  </td>
		</tr>
		<tr>
		  <td style="width:15%;text-align:center" class="w1">出生日期：</td><td style="width:85%"><?php echo empty($rel_mb[0]['member_birth'])?"未填写":$rel_mb[0]['member_birth'];?></td>
		</tr>
		<tr>
		  <td style="width:15%;text-align:center" class="w1">电子邮箱:</td><td style="width:85%"><?php echo empty($rel_mb[0]['member_mail'])?"未填写":$rel_mb[0]['member_mail'];?></td>
		</tr>
		<tr>
		  <td style="width:15%;text-align:center" class="w1">固定电话：</td><td style="width:85%"><?php echo empty($rel_mb[0]['member_tel'])?"未填写":$rel_mb[0]['member_tel'];?></td>
		</tr>
		<tr>
		  <td style="width:15%;text-align:center" class="w1">手机：</td><td style="width:85%"><?php echo empty($rel_mb[0]['member_phone'])?"未填写":$rel_mb[0]['member_phone'];?></td>
		</tr>
		<tr>
		  <td style="width:15%;text-align:center" class="w1">QQ：</td><td style="width:85%"><?php echo empty($rel_mb[0]['member_qq'])?"未填写":$rel_mb[0]['member_qq'];?></td>
		</tr>
		<tr>
		  <td style="width:15%;text-align:center" class="w1">是否禁用：<p style="color:#999999; font-weight:normal"></p></td><td style="width:85%"><?php echo ($rel_mb[0]['is_disable'])?"<span style=\"color:red\">锁定</span>":"正常";?></td>
		</tr>
		<tr>
		  <td style="width:15%;text-align:center" class="w1">注册时间：</td><td style="width:85%"><?php echo empty($rel_mb[0]['member_addtime'])?'':date("Y-m-d H:m:s",$rel_mb[0]['member_addtime']);?></td>
		</tr>
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

</body>
</html>
