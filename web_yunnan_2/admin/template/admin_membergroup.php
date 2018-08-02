<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员分组列表</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#show_list').find('tr').hover(function(){
		$(this).find('td').css('background','#ccffcc');
	},function(){
		$(this).find('td').css('background','');
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
		<span>会员分组列表</span>
			
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
			if(empty($member_group)){
			die("还没有添加分组");
			}else{
			foreach($member_group as $k=>$v){
		?>
		<tr>
		<td style="width:10%;text-align:center"><?php echo $v['id'];?></td><td style="width:20%;text-align:center"><?php echo $v['member_group_name'];?></td><td style="width:40%;text-align:center"><?php echo $v['member_group_info'];?></td><td style="width:10%;text-align:center"><?php if($v['is_disable']){?>禁用<?php }else{?>开启<?php }?></td><td style="width:20%;text-align:center"><a href="admin_member.php?action=membergroup_edit&id=<?php echo $v['id'];?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>" style="padding:0 2px;">修改</a>|<?php if($v['id']==1){echo "<span style=\"color:red\">不可删除</span>";}else{?><a href="javascript:if(confirm('确定要删除么？删除后不可恢复')){location.href='admin_member.php?action=membergroup_del&id=<?php echo $v['id'];?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>';}" style="padding:0 2px;">删除</a><?php }?></td>
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


</body>
</html>
