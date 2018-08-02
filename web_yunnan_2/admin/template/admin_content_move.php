<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>移动内容</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript" src="template/images/form.js"></script>
<style type="text/css">
</style>
<script type="text/javascript">
$(document).ready(function(){
	$('#ex').click(function(){
		$expt=$(this).find('#expt');
		$val=$expt.text();
		if($val=='展开'){
			$('#tb2').show();
			$expt.text('收起');
		}else{
			$('#tb2').hide();
			$expt.text('展开');
		}
	});
	
});

function ck_show_url(n,id){
	$ck=$(n).attr('checked');
	if($ck){
		$(id).show();
	}else{
		$(id).hide();
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
		<span>移动内容</span>
			<div class="admin_fh"><a href="?action=content_list&id=<?php echo $channel;?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>">返回</a></div>
		</div><!--位置-->
		
	<!--内容区-->	

<div class="order_contain">
<form name="maininfo" method="post" action="?nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>" class="form" enctype="multipart/form-data">
 <div class="order_main">
 <table cellpadding="0" cellspacing="0" width="100%">
 	<thead>
		<tr><th style="width:20%">参数说明</th><th style="width:80%">参数值</th></tr>
	</thead>
	<tbody>
		<tr>
		  <td style="width:20%;text-align:center" class="w1">准备移动的内容ID：</td><td style="width:80%">
		  <?php
		  if(!empty($all)){
		  	echo $arc_id=implode(',',$all);
		  }
		  ?>
		 
		  </td>
		</tr>
		<tr>
		  <td style="width:20%;text-align:center" class="w1">移动内容到：</td><td style="width:80%">
		  <select name="move_cate">
		  <option value="0">请选择栏目</option>
		 <?php get_post_catelist($lang,$channel,$cate);?>
		  </select>栏目下
		  </td>
		</tr>

		
		
		</tbody>
 </table>
 </div>
<div class="order_btn">
<input type="hidden" name="action" value="save_move"/> <input type="hidden" value="<?php echo $arc_id;?>" name="arc_id" /><input type="hidden" value="<?php echo $lang;?>" name="lang" /><input type="hidden" value="<?php echo $channel;?>" name="channel" />
  <input type="submit" value="确定" class="go" name="submit"/><input type="reset" class="go" value="重置" name="reset"/>
 </div>
</form>
</div><!--内容切换-->

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
