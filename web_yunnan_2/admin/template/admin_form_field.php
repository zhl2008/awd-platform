<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>字段管理</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#show_list').find('tr').hover(function(){
		$(this).find('td').css('background','#ccffcc');
	},function(){
		$(this).find('td').css('background','');
	});
	
	//ajax设置开启
	$('.table_info1').find('.is_use').click(function(){
		$is_use=$(this).attr('rel');
		$id=$(this).attr('id');
		if($is_use==1){$is_use=0;}else{$is_use=1;}
		$(this).load('admin_form.php',{'lang':'<?php echo $lang;?>','action':'ajax_field_use','is_use':$is_use,'id':$id},function(msg){});
  		$(this).attr('rel',$is_use);
		if($is_use==0){
			$(this).removeClass('list_off').addClass('list_on');
			$(this).attr('title','开启');
		}else{
			$(this).removeClass('list_on').addClass('list_off');
			$(this).attr('title','关闭');
		}
	});
	
	//ajax修改排序
	$('.table_info1').find('#order_num').click(function(){
		$has_input=$(this).find('input').size();
		if(!$has_input){	
		$order=$(this).find('span').html();
		$id=$(this).find('span').attr('id');
		$(this).empty();	
		$('<input id="'+$id+'" style="width:30px;padding:1px 0" value="'+$order+'"/>').bind("blur",function(){
			if(!/^[0-9]+$/.test($(this).val())){
				alert("只能是数字");
				return;
			}
			$(this).load('admin_form.php',{'action':'ajax_field_order','order_id':$(this).val(),'id':$(this).attr('id')},function(msg){

			});
			$('<span id="'+$(this).attr('id')+'">'+$(this).val()+'</span>').appendTo($(this).parent());
			$(this).remove();
		}).appendTo($(this));
		}
	}).hover(function(){
		$(this).addClass('on_order');
	},function(){
		$(this).removeClass('on_order');
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
		<span>表单模型字段列表</span>
			<div class="admin_fh"><a href="?action=form&lang=<?php echo $lang;?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>">返回</a></div>
		</div><!--位置-->
		
	<!--内容区-->	


<div class="order_contain">
<form name="maininfo" method="post" enctype="multipart/form-data" action="?" class="form">
 <div class="order_main">
 <table cellpadding="0" cellspacing="0" width="100%" class="table_info1">
 	<thead>
		<tr><th style="width:15%">排序</th><th style="width:20%">提示文字</th><th style="width:20%">字段名</th><th style="width:10%">数据类型</th><th style="width:10%">状态</th><th style="width:15%">操作</th></tr>
	</thead>
	<tbody style="text-align:center" id="show_list">
	<?php
		if(!empty($field)){
			foreach($field as $key=>$value){
				if($value['form_id']==$GLOBALS['id']){
	?>
		<tr>
		<td style="width:15%; text-align:center">
		<div id="order_num"><span id="<?php echo $value['id'];?>"><?php echo $value['form_order'];?></span></div>
		</td>
		<td style="width:20%;text-align:center"><?php echo $value['use_name'];?></td><td style="width:20%;text-align:center"><?php echo $value['field_name'];?></td><td style="width:20%;text-align:center"><?php echo $value['field_type'];?></td><td style="width:10%;text-align:center">

		<?php
		 if(!$value['is_disable']){
		 	echo '<span class="is_use list_on" id="'.$value['id'].'" rel="'.$value['is_disable'].'" title="开启"></span>';
		 }else{
		 	echo '<span class="is_use list_off" id="'.$value['id'].'" rel="'.$value['is_disable'].'" title="关闭"></span>';
		 }
		 ?>
		
		</td><td style="width:30%;text-align:center"><a href="admin_form.php?action=xg_field&id=<?php echo $value['id'];?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>">修改</a>|<a href="javascript:if(confirm('确定要删除么？删除后不可恢复!')){location.href='admin_form.php?action=del_field&id=<?php echo $value['id'];?>&form_id=<?php echo $value['form_id'];?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>';}">删除</a></td>
		</tr>
	<?php
				}
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
