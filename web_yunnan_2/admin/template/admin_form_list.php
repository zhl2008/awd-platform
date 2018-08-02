<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>表单列表</title>
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
		<span>表单列表</span>
			
		</div><!--位置-->
		
	<!--内容区-->	

<div class="order_contain">
<form name="content_list" id="content_list" method="post" action="?" class="form" enctype="multipart/form-data">
<div class="list_sl_btn">
	<ul>
	<li><select name="id" style="width:200px; margin-top:2px;">
	<option value="">请选择栏目</option>
	<?php
if(!empty($form)){
 foreach($form as $key=>$value){
 	$ck='';
 	if($value['id']==$id){$ck='selected=selected';}
	echo "<option value=\"{$value['id']}\" {$ck}>{$value['form_name']}</option>";
  }
  }
  ?>
	</select></li>
	<li><input type="button" name="sousuo" value="搜索" class="go" onclick="javascript:this.form.action='admin_form.php?action=form_list&id=<?php echo $id;?>&lang=<?php echo $lang;?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>';this.form.submit();" /></li>
	</ul>
</div>
 <div class="order_main">
 <table cellpadding="0" cellspacing="0" width="100%">
 	<thead>
		<tr><th style="width:10%">选择</th><th style="width:30%">表单名称</th><th style="width:15%">添加时间</th><th style="10%">来源页面</th><th style="15%">添加者</th><th style="width:10%">操作IP</th><th style="width:10%">查看</th><th style="width:10%">操作</th></tr>
	</thead>
	<tbody id="show_list">
	<?php
	if(file_exists(DATA_PATH.'cache_form/field.php')){include(DATA_PATH.'cache_form/field.php');}
	if(!empty($field)){
	foreach($field as $k=>$v){
		if($id==$v['form_id']){
			$field_info=$v;
		}
	}
	}
	$maintb=DB_PRE."formlist";
	$page=empty($page)?1:$page;
	$pagesize=30;
	$pagenum=($page-1)*$pagesize;
	$filt="m.form_id={$id}";
	$query='&id='.$id.'&action=form_list&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav;
	$total_num=$GLOBALS['mysql']->fetch_rows("select m.id from {$maintb} as m where {$filt}");
	$total_page=intval($total_num/$pagesize);
	$total_page=($total_page==0)?1:$total_page;
	$sql="select m.* from {$maintb} as m  where {$filt}  order by m.form_time desc limit {$pagenum},{$pagesize}";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	if(!empty($rel)){
	foreach($rel as $key=>$value){
	$member='';
	if($value['member_id']){
		$member=$GLOBALS['mysql']->get_row("select member_user from ".DB_PRE."member where id=".$value['member_id']);
	}
	$c_rel = $mysql->fetch_asc('select channel from '.DB_PRE.'maintb where id='.$value['arc_id']);
	$channel_info=get_cate_info($c_rel[0]['channel'],$channel);//获得内容模型信息
	unset($c_rel);
	?>
		<tr><td style="width:10%;text-align:center"><input type="checkbox" style="border:0" id="all" value="<?php echo $value['id'];?>" name="all[]" /></td><td style="width:30%"><?php echo "<b>{$form_name}</b>第{$value['id']}条信息";echo ($value['is_read'])?"<span style=\"color:green;padding-left:5px\">已经阅读</span>":"<span style=\"color:red;padding-left:5px\">未阅读</span>";?></td><td style="width:15%; text-align:center"><?php echo date('Y-m-d H:m:s',$value['form_time']);?></td><td style="10%;text-align:center"><?php
		echo (!$value['arc_id'])?'<span style="color:#ccc">未知</span>':'<a href="'.CMS_SELF.$channel_info['content_php'].'?id='.$value['arc_id'].'" target="_blank">查看</a>';
		?></td><td style="15%; text-align:center">
		<?php
		echo empty($member)?"游客":'<a href="admin_member.php?action=show&id='.$value['member_id'].'" target="_blank">'.$member.'</a>';
		?></td><td style="width:10%;text-align:center"><?php echo $value['form_ip'];?></td><td style="width:10%;text-align:center"><a href="?action=show_form&id=<?php echo $value['id'];?>&form_id=<?php echo $id;?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>">查看详细内容</a></td><td style="width:10%;text-align:center"><a href="javascript:if(confirm('确定要删除么,删除后将不可恢复!')){location.href='?action=del_list&form_id=<?php echo $id;?>&id=<?php echo $value['id'];?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>';}">删除</a></td></tr>
		<?php }
		}?>
		</tbody>
 </table>
 </div>
 <div class="page page_fy">
		<?php echo page('admin_form',$page,$query,$total_num,$total_page);?>
 </div>
 <div class="order_btn">
  <input type="button" name="all" value="全选" id="sl_all" style="margin:0 10px 0 0;" class="go" /> <input type="button" onclick="javascript:if(confirm('确定要删除么,删除后将不可恢复!')){this.form.action='admin_form.php?action=del_all&form_id=<?php echo $id;?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>';this.form.submit();}" name="del" value="删除" style="margin:0 10px 0 0;" class="go" /><input type="reset" style="margin:0 10px 0 0;" class="go" value="重置" name="reset"/>
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
