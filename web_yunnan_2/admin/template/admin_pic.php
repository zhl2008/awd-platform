<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>图片列表</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#show_list').find('tr').hover(function(){
		$(this).find('td').css('background','#F0F2F4');
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
		<span>上传图片列表</span>
			
		</div><!--位置-->
		
	<!--内容区-->	

<div class="caozuo_nav" style="width:97%; margin:0 auto">
<p style="line-height:24px;">图片alt只能配合标签输出</p>
<div class="clear"></div>
</div><!--小操作导航-->

<div class="order_contain">
<form name="form" id="form1" method="post" action="" >
<div class="list_sl_btn">
	<ul>
	<li><select name="pic_nav" style="width:200px; margin-top:2px;">
	<option value="">请选择分类</option>
	<?php
		if(!empty($nav_rel)){
			foreach($nav_rel as $key=>$value){
				$ck='';
				if($value['id']==$pic_nav){$ck='selected=selected';}
				echo "<option value=\"{$value['id']}\" {$ck}>{$value['cate_name']}</option>";
			}
		}
	?>
	</select></li>
	<li><input type="button" name="sousuo" value="搜索" class="go" onclick="javascript:this.form.action='?action=pic_list&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>';this.form.submit();" /></li>
	</ul>
</div>

 <div class="order_main">
 <table cellpadding="0" cellspacing="0" width="100%">
 	<thead>
		<tr><th style="width:15%">图片</th><th style="width:30%">图片alt</th><th style="width:20%">上传时间</th><th style="width:5%">缩略图</th><th style="width:10%">格式</th><th style="width:20%">操作</th></tr>
	</thead>
	<tbody id="show_list">
	<?php
	if(!empty($rel)){
	foreach($rel as $k=>$v){
	$pic=$v['pic_path'].$v['pic_name'].'.'.$v['pic_ext'];
	$img=CMS_SELF.$pic;
	?>
	<tr><td style="width:15%;text-align:center" align="center"><a target="_blank" href="<?php echo $img;?>"><img src="<?php echo $img;?>" style="padding:1px; border:1px solid #ddd" width="50" height="50" border="0" /></a></td><td style="width:25%;text-align:center" align="center"><?php echo $v['pic_alt'];?></td><td scope="width:20%;text-align:center" align="center"><?php echo date('Y-m-d H:m:s',$v['pic_time']);?></td><td style="width:5%; text-align:center"><?php echo ($v['pic_thumb'])?'有':'<span style="color:red">无</span>';?></td><td style="width:10%; text-align:center"><?php echo $v['pic_ext'];?></td><td style="width:20%;text-align:center" align="center"><a href="javascript:if(confirm('确定要删除么？删除后不可恢复')){location.href='admin_pic.php?action=del&id=<?php echo $v['id'];?>&pic_nav=<?php echo $pic_nav;?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>';}">删除</a>&nbsp;|&nbsp;<a href="?action=edit_pic&id=<?php echo $v['id'];?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>">修改</a>&nbsp;|&nbsp;<a href="javascript:if(confirm('确定要删除么？')){location.href='admin_pic.php?action=del_thumb&id=<?php echo $v['id'];?>&pic_nav=<?php echo $pic_nav;?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>';}">删除缩略图</a></td></tr>
	<?php
	}
	}
	?>

		
		</tbody>
 </table>
 </div>
<div class="page page_fy">
 	<ul>
		<?php 
		$query='&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav;
		echo page('admin_pic',$page,$query,$total_num,$total_page);?>
	</ul>
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
