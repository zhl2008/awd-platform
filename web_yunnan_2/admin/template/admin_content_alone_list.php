<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>单页内容管理</title>
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
		<span>单页内容列表</span>
			<div class="lang">
			<ul>
			 <?php
 $cache_file=DATA_PATH."cache/lang_cache.php";
 $cache_arr=read_cache($cache_file,'lang_cache');
 if(!empty($cache_arr)){
 foreach($cache_arr as $k=>$v){
  if(!$v['lang_is_use']){continue;}
 ?>
 <li><a href="?action=content_list&lang=<?php echo $v['lang_tag'];?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>" class="<?php if($GLOBALS['lang']==$v['lang_tag']){echo 'hover';}?>"><?php echo $v['lang_name'];?></a></li>
 <?php
 }
 }
 ?>
			</ul>
		</div><!--语言-->	
		</div><!--位置-->
		
	<!--内容区-->	

<div class="order_contain">
<form name="maininfo" method="post" action="" class="form">
 <div class="order_main">
 <table cellpadding="0" cellspacing="0" width="100%">
 	<thead>
		<tr><th style="width:5%">选择</th><th style="width:70%">栏目</th><th style="width:25%">操作</th></tr>
	</thead>
	<tbody id="show_list">
	<?php
	
			$table=DB_PRE.$c_arr['channel_table'];
			$channel=$c_arr['channel_name'];
	
	if(empty($table)||empty($channel)){
		msg('参数发生错误，不存在相关频道');
	}
	$maintb=DB_PRE."maintb";
	$page = intval($_GET['page']);
	$page=empty($page)?1:$page;
	$pagesize=30;
	$pagenum=($page-1)*$pagesize;
	$filt="m.cate_channel=1";
	$query='&action=content_list&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav.'&lang='.$lang;
	$filt.=" and m.lang='{$lang}'";
	$total_num=$GLOBALS['mysql']->fetch_rows("select m.id from ".DB_PRE."category as m where {$filt}");
	$total_page=ceil($total_num/$pagesize);
	$sql="select m.id,m.cate_name from ".DB_PRE."category as m where {$filt} order by m.id desc limit {$pagenum},{$pagesize}";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	if(!empty($rel)){
	foreach($rel as $key=>$value){
	$sql="select count(id) as num,id from ".DB_PRE."maintb where category={$value['id']} and channel=1 GROUP BY id order by id desc";
	$is_content=$mysql->fetch_asc($sql);
	?>
		<tr><td style="width:5%; text-align:center"><input type="checkbox" style="border:0" value="<?php echo $value['id'];?>" name="all[]" /></td><td style="width:70%; text-align:center"><?php echo $value['cate_name'];?></td><td style="width:25%; text-align:center">
		<?php
		if($is_content[0]['num']){
		?>
		<a href="?action=edit_content&lang=<?php echo $lang;?>&cate=<?php echo $value['id'];?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>" style="padding:0 3px;">修改</a>|<a style="padding-left:8px;" href="javascript:if(confirm('确定要删除么,删除后将不可恢复!')){location.href='?action=del&lang=<?php echo $lang;?>&id=<?php echo $is_content[0]['id'];?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>';}">删除</a>
		<?php
		}else{
		?>
		<a href="?action=add_alone&lang=<?php echo $lang;?>&cate=<?php echo $value['id'];?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>" style="padding:0 3px; color:#FF0000">添加</a>
		<?php
		}
		?>
		</td></tr>
		<?php }
		}?>
		</tbody>
 </table>
 </div>
 <div class="page page_fy">
 	<ul>
		<?php echo page('admin_content_alone',$page,$query,$total_num,$total_page);?>
	</ul>
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
