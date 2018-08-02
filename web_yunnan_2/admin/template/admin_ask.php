<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>咨询管理</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#sl_all').click(function(){
		$('table').find('#all').attr('checked','checked');
	});
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
		<span>咨询列表</span>
				
		</div><!--位置-->
		
	<!--内容区-->	

<div class="div_out">

<div class="order_contain">
<form name="content_list" id="content_list" method="post" action="admin_content.php" class="form" enctype="multipart/form-data">
<div class="order_main">
 <table cellpadding="0" cellspacing="0" width="100%">
 	<thead>
		<tr><th style="width:15%">标题</th><th style="width:15%">添加时间</th><th style="width:30%">咨询内容</th><th style="width:10%">咨询人</th><th style="width:5%">状态</th><th style="width:15%">回复时间</th><th style="width:10%">操作</th></tr>
	</thead>
	<tbody id="show_list">
	<?php
	$maintb=DB_PRE."ask";
	$page=empty($_GET['page'])?1:$_GET['page'];
	$pagesize=30;
	$pagenum=($page-1)*$pagesize;
	$filt="";
	$query='&action=ask&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>';
	$total_num=$GLOBALS['mysql']->fetch_rows("select m.id from {$maintb} as m");
	$total_page=ceil($total_num/$pagesize);
	$sql="select m.* from {$maintb} as m order by m.addtime desc limit {$pagenum},{$pagesize}";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	if(!empty($rel)){
	foreach($rel as $key=>$value){
	?>
		<tr><td style="width:15%; text-align:center"><a href="?action=reply&id=<?php echo $value['id'];?>&lang=<?php echo $lang;?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>"><?php echo $value['title'];?></a></td><td style="width:15%; text-align:center"><?php echo empty($value['addtime'])?'':date('Y-m-d H:m:s',$value['addtime']);?></td><td style="width:30%;text-align:center"><?php echo cn_substr($value['content'],160);?></td><td style="width:10%;text-align:center"><a href="admin_member.php?action=show&id=<?php echo $value['member'];?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>">详细查看</a></td><td style="width:5%; text-align:center"><?php echo empty($value['reply'])?'<span style="color:red">未回复</span>':"已回复";?></td><td style="width:15%;text-align:center"><?php echo empty($value['replytime'])?'':date("Y-m-d H:m:s",$value['replytime']);?></td><td style="width:10%;text-align:center"><a href="javascript:if(confirm('确定要删除么,删除后将不可恢复!')){location.href='?action=del&id=<?php echo $value['id'];?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>';}">删除</a>|<a href="?action=reply&id=<?php echo $value['id'];?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>">回复查看</a></td></tr>
		<?php }
		}?>
		</tbody>
 </table>
 </div>
 <div class="page page_fy">
		<?php echo page('admin_ask',$page,$query,$total_num,$total_page);?>
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
