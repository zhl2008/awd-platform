<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>搜索语言包语言</title>
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
<style type="text/css">
body{margin:20px;}
</style>
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
		<span>搜索语言包语言</span>
			
		</div><!--位置-->
		
	<!--内容区-->	

<div class="caozuo_nav">
<ul>
 <li class="<?php if($GLOBALS['action']=='add'){echo 'hover';}?>"><a href="?action=add">添加语言</a></li>
 <li class="<?php if($GLOBALS['action']=='lang'){echo 'hover';}?>"><a href="?action=lang">管理语言</a></li>
 <li class="<?php if($GLOBALS['action']=='add_lang'){echo 'hover';}?>"><a href="?action=add_lang">添加语言包语言</a></li>
 <li class="<?php if($GLOBALS['action']=='cache_lang'){echo 'hover';}?>"><a href="?action=cache_lang">更新语言缓存</a></li>
</ul>
<div class="clear"></div>
</div><!--小操作导航-->
<div class="lang_search">
<form name="lang_search" method="post" action="admin_lang.php?action=search&lang=<?php echo $lang;?>">
语言变量<select name="search_type"><option value="0" <?php if(!$type){echo 'selected="selected"';}?>>按变量</option><option value="1" <?php if($type){echo 'selected="selected"';}?>>按值</option></select><input type="text" name="key" class="key" value="<?php echo $key;?>" /><input type="submit" class="go" name="lang_submit" value="搜索" />
</form>
</div><!--语言搜索-->
<div class="n_info">
	<p><span style="color:#FF0000"><b>当前语言：</b><?php echo $lang_rel[0]['lang_name'];?></span></p>
</div>

<div class="div_out" id="tb">
 <table cellpadding="0" cellspacing="0" width="100%">
 	<thead>
		<tr><th class="w1" style="width:20%">语言变量</th><th class="w2" style="width:60%">参数值</th><th class="w3" style="width:20%">操作</th></tr>
	</thead>
	<tbody id="show_list">
	<?php
	$maintb=DB_PRE."lang_lang";
	$page=empty($_GET['page'])?1:$_GET['page'];
	$pagesize=20;
	$pagenum=($page-1)*$pagesize;
	$filt=empty($type)?"m.lang_tag like '%".$key."%'":"m.lang_value like '%".$key."%'";
	$filt.=" and m.lang='".$lang."'";
	$query='&lang='.$lang.'&action=search&key='.$key;
	$total_num=$GLOBALS['mysql']->fetch_rows("select m.id from {$maintb} as m where {$filt}");
	$total_page=ceil($total_num/$pagesize);
	$sql="select m.* from {$maintb} as m where {$filt} limit {$pagenum},{$pagesize}";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	if(empty($rel)){die('没有改语言');}
	if(!empty($rel)){
	foreach($rel as $key => $value){
	?>

	
		<tr>
		  <td class="w1" style="text-align:center;width:20%"><?php echo $value['lang_tag']?>:</td><td class="w2" style="width:60%"><?php echo $value['lang_value'];?></td><td class="w3" style="width:20%; text-align:center"><a href="?action=lang_lang_edit&id=<?php echo $value['id'];?>&lang=<?php echo $lang;?>" style="padding-right:15px;">修改</a><a href="javascript:if(confirm('确定要删除么?')){location.href='?action=del_lang_lang&id=<?php echo $value['id'];?>&lang=<?php echo $lang;?>';}">删除</a></td>
		</tr>
		

	<?php
	}
	}
	?>	
	</tbody>
 </table>
 </div>
 <div class="page page_fy">
 	<ul>
		<?php echo page('admin_lang',$page,$query,$total_num,$total_page);?>
	</ul>
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
