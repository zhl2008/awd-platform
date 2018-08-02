<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>栏目管理</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript">
function show_list(n){
$(n).parent().parent('#border').parent('#catagory').find('#catagory').toggle();
}
$(document).ready(function(){
	//ajax修改排序
	$('.table_info1').find('#order_num').click(function(){
		$has_input=$(this).find('input').size();
		if(!$has_input){	
		var $order=$(this).find('span').html();
		$id=$(this).find('span').attr('id');
		
		$(this).empty();	
		$('<input id="'+$id+'" style="width:30px;padding:0;height:18px;" value="'+$order+'"/>').bind("blur",function(){
			if(!/^[0-9]+$/.test($(this).val())){
				alert("只能是数字");
				return;
			}
			var $rel=$(this).parent().attr('rel');
			var $action='';
			if($rel=='order'){
				$action='ajax_order';
			}else if($rel=='tpl'){
				$action='ajax_tpl';
			}
			//$(this).load('admin_catagory.php',{'action':$action,'lang':'<?php echo $lang;?>','order_id':$(this).val(),'id':$(this).attr('id')},function(msg){
				
			//});
			$.ajax({
				type:'POST',
				url:'admin_catagory.php',
				data:'action='+$action+'&lang=<?php echo $lang;?>&order_id='+$(this).val()+'&id='+$(this).attr('id'),
				success:function(msg){
					if(msg==1){alert('已经存在该模板标示');}
				}
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
		<span>栏目列表</span>
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
<form name="maininfo" method="post" enctype="multipart/form-data" class="form">
<div class="order_main">
 <table cellpadding="0" cellspacing="0" width="100%" class="table_info1">
 	<thead>
		<tr><th style="text-align:left; padding-left:5px; font-weight:normal">请先添加顶级栏目,如果已经添加了栏目没显示请更新下栏目缓存<span style="padding-left:30px;"><a href="<?php echo '../template/'.$_confing['web_template'].'/tpl_info.gif';?>" target="_blank" style="font-weight:bold; color:#FF0000">查看网站配置说明</a></span><span style="padding-left:10px; color:#0000FF">默认官方模板栏目'模板标示ID'设为2和3会自动显示该栏目下的内容</span></th></tr>
	</thead>
	<tbody>

		<tr>
		<td style="border-bottom:none">
		<?php
		if(!empty($cate_list)){
		foreach($cate_list as $key=>$value){
			if($value['cate_parent']==0){
			$is_gd=($value['cate_tpl']==1)?'&nbsp;<span style="color:red">引导栏目</span>':'';
			$channel_info=get_cate_info($value['cate_channel'],$channel);//获得内容模型信息
			$list_php = empty($channel_info['list_php'])?'show_list.php':$channel_info['list_php'];
			$is_cate_type = '';
			if($value['cate_channel']==1){
				$is_cate_type = '[<font style="color:red">单页</font>]';
			}elseif($value['cate_channel']=='-9'){
				$is_cate_type = '[<font style="color:#0000FF">表单</font>]';
			}
		?>
			<div id="catagory">
			<div id="border" style="border-bottom:1px dashed #ccc; padding:2px 0; height:25px; line-height:25px; ">
				<div class="left" id="show" style="cursor:pointer"><span class="exp" onclick="show_list(this);">&nbsp;</span><span class="cata">
				<?php echo "<a href=\"".CMS_SELF.$list_php."?id={$value['id']}\" target=\"_blank\">{$is_cate_type}{$value['cate_name']}</a>(<span style=\"color:#999\">排序</span><em rel=\"order\" style=\"font-style:normal; padding:0 8px;\" id=\"order_num\"><span id=\"{$value['id']}\">{$value['cate_order']}</span></em>&nbsp;<span style=\"color:#999\">栏目id</span>:{$value['id']}&nbsp;<span style=\"color:#999\">模板标示ID:</span><em style=\"font-style:normal; padding:0 8px;\" rel=\"tpl\" id=\"order_num\"><span id=\"{$value['id']}\">{$value['temp_id']}</span></em>{$is_gd})";
				$cate_nav=empty($value['cate_nav'])?array(''):explode(',',$value['cate_nav']);
				echo in_array('2',$cate_nav)?"<span style=\"color:#3366FF\">导航中部显示</span>":"";
				echo in_array('3',$cate_nav)?"<span style=\"color:#FFCC66\">导航底部显示</span>":"";

				if($value['cate_hide']){
					echo "<span style=\"color:red; padding:0 3px;\">隐藏</span>";
				}
				$href2=($value['cate_channel']==1)?"href=\"admin_content_alone.php?action=content_list\"":"href=\"admin_content.php?action=content_list&id={$value['cate_channel']}&cate={$value['id']}&lang={$value['lang']}\"";
				?></span></div><div class="right"><span class="caozuo"><a href="?action=child&parent=<?php echo $value['id'];?>&channel_id=<?php echo $value['cate_channel'];?>&lang=<?php echo $GLOBALS['lang']?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>">增加下级栏目</a>|<a href="?action=xg&lang=<?php echo $GLOBALS['lang'];?>&id=<?php echo $value['id'];?>&parent=<?php echo $GLOBALS['parent'];?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>">修改栏目</a>|<a href="?action=move_cate&cate=<?php echo $value['id'];?>&lang=<?php echo $lang;?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>">移动栏目</a>|<a href="javascript:if(confirm('确定要删除么,删除后不可恢复!')){location.href='admin_catagory.php?action=del&lang=<?php echo $GLOBALS['lang'];?>&id=<?php echo $value['id'];?>&parent=<?php echo $GLOBALS['parent'];?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>';}  ">删除栏目</a></span></div>
				<div style="clear:both"></div>
				</div>
				<?php
				$parent_id=$value['id'];
			unset($cate_list[$key]);
			get_cate_list($cate_list,$parent_id,$value['haschild']);
				?>
				
			</div>
			
			<?php
			}
			}
			 }?>
			
		</td>
		</tr>	

	</tbody>
 </table>
 </div>
<input type="hidden" name="action" value="add_inc"/><input type="hidden" name="lang" value="<?php echo $lang;?>"/>
 </form>
 </div> <!--内容切换-->

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
