<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改会员分组</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#bs').blur(function(){
		$('#table').val($(this).val());
	});
	$('tbody').find('tr').hover(function(){
		//$(this).css('background','#ccc');
	},function(){
		//$(this).css('background','none');
	});
	$('#c_all').click(function(){
		$is_ck=$(this).attr('checked');
		if($is_ck){
			$('tbody#purview').find("input[type='checkbox']").attr({'disabled':'disabled','checked':'checked'});
		}else{
			$('tbody#purview').find("input[type='checkbox']").attr({'disabled':'','checked':''});
		}
	});
});
function all_sl(str){
		$ck=$('#'+str).attr('checked');
		if($ck){
			$('td#'+str).find('input').attr('checked','checked');
		}else{
			$('td#'+str).find('input').attr('checked','');
		}
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
		<span>修改会员分组</span>
			<div class="admin_fh"><a href="?action=member_group&lang=<?php echo $lang;?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>">返回</a></div>
		</div><!--位置-->
		
	<!--内容区-->	


<div class="order_contain">
<form name="maininfo" method="post" enctype="multipart/form-data" action="?nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>" class="form">
 <div class="order_main">
 <table cellpadding="0" cellspacing="0" width="100%">
 	<thead>
		<tr><th style="width:30%">参数说明</th><th style="width:70%">参数值</th></tr>
	</thead>
	<tbody>
	<?php
	if(empty($member_group)){
		die('还没有添加会员组');
	}
	foreach($member_group as $k=>$v){
		if($v['id']==$id){
			$arr=$v;
			break;
		}
	}
	?>
		<tr>
		  <td style="width:30%;text-align:center" class="w1"><span title="不可重复,将会在栏目、内容等地方使用" class="help">会员组名称：</span></td><td style="width:70%"><input name="member_group_name" value="<?php echo $arr['member_group_name'];?>" style="width:30%" /></td>
		</tr>
		<tr>
		  <td style="width:30%;text-align:center" class="w1">会员组描述：<p style="color:#999999; font-weight:normal"></p></td><td style="width:70%"><textarea name="member_group_info" style="width:50%; height:50px;"><?php echo $arr['member_group_info'];?></textarea></td>
		</tr>
		<tr>
		  <td style="width:30%;text-align:center" class="w1">是否禁用：<p style="color:#999999; font-weight:normal"></p></td><td style="width:70%"><label for="f1"><input type="radio" id="f1" name="is_disable" style="border:0" value="0" <?php if(!$arr['is_disable']){?>checked="checked"<?php }?> />开启</label><label for="f2"><input id="f2" style="border:0" type="radio" name="is_disable" value="1" <?php if($arr['is_disable']){?>checked="checked"<?php }?> />禁用</label></td>
		</tr>
		</tbody>
 </table>
 </div>
<div class="order_btn">
<input type="hidden" name="action" value="save_membergroup_edit"/><input type="hidden" name="id" value="<?php echo $id;?>"  />
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
