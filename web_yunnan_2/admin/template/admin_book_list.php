<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>留言管理</title>
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
function set_act(){
alert($('#form1').find('#all').val());
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
		<span>留言管理</span>
			<div class="lang">
			<ul>
			 <?php
 $cache_file=DATA_PATH."cache/lang_cache.php";
 $cache_arr=read_cache($cache_file,'lang_cache');
 if(!empty($cache_arr)){
 foreach($cache_arr as $k=>$v){
  if(!$v['lang_is_use']){continue;}
 ?>
 <li><a href="?lang=<?php echo $v['lang_tag'];?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>" class="<?php if($GLOBALS['lang']==$v['lang_tag']){echo 'hover';}?>"><?php echo $v['lang_name'];?></a></li>
 <?php
 }
 }
 ?>
			</ul>
		</div><!--语言-->	
		</div><!--位置-->
		
	<!--内容区-->	

<div class="div_out">

<div class="order_contain">
<form name="form" id="form1" method="post" action="" class="form">
<div class="order_main">
 <table cellpadding="0" cellspacing="0" width="100%">
 	<thead>
		<tr><th style="width:5%">选择</th><th style="width:25%">留言标题</th><th style="width:15%">添加时间</th><th style="width:10%">回复</th><th style="width:30%">留言内容</th><th style="width:5%">审核</th><th style="width:10%">操作</th></tr>
	</thead>
	<tbody id="show_list">
	<?php
	
	$maintb=DB_PRE."book";
	$page=empty($_GET['page'])?1:intval($_GET['page']);
	$pagesize=20;
	$pagenum=($page-1)*$pagesize;
	$filt="m.lang='{$lang}'";
	$query='&lang='.$lang.'&verify='.$verify.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav;
	$filt.=empty($verify)?'':' and m.verify='.$verify;
	$order="order by addtime desc";
	$total_num=$GLOBALS['mysql']->fetch_rows("select m.id from {$maintb} as m where {$filt}");
	$total_page=ceil($total_num/$pagesize);
	$sql="select m.* from {$maintb} as m where {$filt} {$order} limit {$pagenum},{$pagesize}";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	if(!empty($rel)){
	foreach($rel as $key=>$value){
	?>
		<tr><td style="width:5%;text-align:center"><input type="checkbox" id="all" style="border:0" value="<?php echo $value['id'];?>" name="all[]" /></td><td style="width:25%"><?php echo "({$value['id']})<a href=\"?action=reply&id={$value['id']}&nav={$admin_nav}&admin_p_nav={$admin_p_nav}\">{$value['book_title']}</a>";?></td><td style="width:15%; text-align:center"><?php echo date('Y-m-d H:m:s',$value['addtime']);?></td><td style="width:10%;text-align:center"><?php if($value['reply']){echo "<span style=\"color:green\">已回复</span>";}else{echo "<span style=\"color:red\">未回复</span>";}?></td><td style="width:30%;text-align:center"><?php echo cn_substr($value['book_content'],100);?></td><td style="width:5%;text-align:center"><?php if(!$value['verify']){echo "<span style=\"color:red\">未审核</span>";}else{echo "<font style=\"color:green\">已审核</span>";}?></td><td style="width:10%;text-align:center"><a href="javascript:if(confirm('确定要删除么,删除后将不可恢复!')){location.href='?action=del&lang=<?php echo $lang;?>&id=<?php echo $value['id'];?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>';}" style="padding:0 3px;">删除</a>|<a href="?action=reply&lang=<?php echo $lang;?>&id=<?php echo $value['id'];?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>" style="padding:0 3px;">回复</a><a href="?action=show&id=<?php echo $value['id'];?>"></a></td></tr>
		<?php }
		}
		?>
		</tbody>
 </table>
 </div>
 <div class="page page_fy">
		<?php echo page('admin_book',$page,$query,$total_num,$total_page);?>
 </div>
<div class="order_btn">
<input type="hidden" value="<?php echo $id;?>" name="id" /><input type="hidden" value="<?php echo $lang;?>" name="lang" />
  <input type="button" name="all" value="全选" id="sl_all" style="margin:0 10px 0 0;" class="go" /><input type="reset" style="margin:0 10px 0 0;" class="go" value="重置" name="reset"/><input type="button" onclick="javascript:this.form.action='?action=verify&lang=<?php echo $lang;?>';this.form.submit();" value="审核" name="verify" style="margin:0 10px 0 0;" class="go" /><input type="button" onclick="javascript:if(confirm('确定要删除么,删除后将不可恢复!')){this.form.action='admin_book.php?action=del_all&lang=<?php echo $lang;?>';this.form.submit();}" value="删除" name="button" style="margin:0 10px 0 0;" class="go"/>
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
