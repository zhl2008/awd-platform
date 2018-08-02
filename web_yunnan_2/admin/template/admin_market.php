<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>客服列表</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.q').find('ul li').click(function(){
		$index=$('.q').find('ul li').index(this);
		$('#tb').find('div').eq($index).show().siblings().hide();
	});
	$('#show_list').find('tr').hover(function(){
		$(this).find('td').css('background','#ccffcc');
	},function(){
		$(this).find('td').css('background','');
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
			
			$action = "ajax_order";
			$.ajax({
				type:'POST',
				url:'admin_market.php',
				data:'action='+$action+'&order_id='+$(this).val()+'&id='+$(this).attr('id'),
				success:function(msg){
					
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
	
	//ajax设置开启
	$('.table_info1').find('.is_use').click(function(){
		$is_use=$(this).attr('rel');
		$id=$(this).attr('id');
		if($is_use==1){$is_use=0;}else{$is_use=1;}
		$(this).load('admin_market.php',{'lang':'<?php echo $lang;?>','action':'ajax_use','is_use':$is_use,'id':$id},function(msg){});
  		$(this).attr('rel',$is_use);
		if($is_use==1){
			$(this).removeClass('list_off').addClass('list_on');
			$(this).attr('title','开启');
		}else{
			$(this).removeClass('list_on').addClass('list_off');
			$(this).attr('title','关闭');
		}

		
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
		<span>网站客服列表</span>
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
 		
		<!--开始表单-->
		<div class="order_contain">
<form name="maininfo" method="post" enctype="multipart/form-data" class="form">
<div class="order_main">
 <table cellpadding="0" cellspacing="0" width="100%" class="table_info1">
 	<thead>
		<tr><th class="w1" style="width:5%">排序</th><th class="w2" style="width:25%">客服名称</th><th class="w3 r" style="width:15%">客服类型</th><th style="width:25%">客服号码</th><th style="width:10%">状态</th><th style="width:20%">操作</th></tr>
	</thead>
	<tbody id="show_list">
	<?php
	if(!empty($rel)){
	foreach($rel as $k=>$v){
	?>
		<tr>
		 <td style="width:5%;text-align:center"><div id="order_num"><span id="<?php echo $v['id'];?>"><?php echo $v['market_order'];?></span></div></td><td style="width:25%;text-align:center"><?php echo $v['market_name'];?></td><td style="width:15%; text-align:center">
		 <?php
		 if($v['market_type']=='1'){
		 	echo 'QQ客服';
		 }elseif($v['market_type']=='2'){
		 	echo '淘宝(阿里)客服';
		 }elseif($v['market_type']=='3'){
		 	echo 'MSN客服';
		 }elseif($v['market_type']=='4'){
		 	echo 'Skype客服';
		 }elseif($v['market_type']=='5'){
		 	echo '联系电话';
		 }elseif($v['market_type']=='6'){
		 	echo '联系手机';
		 }
		 ?></td><td style="width:25%; text-align:center"><?php echo $v['market_num'];?></td><td style="width:10%; text-align:center">
		 <?php
		 if($v['market_is']){
		 	echo '<span class="is_use list_on" id="'.$v['id'].'" rel="'.$v['market_is'].'" title="开启"></span>';
		 }else{
		 	echo '<span class="is_use list_off" id="'.$v['id'].'" rel="'.$v['market_is'].'" title="关闭"></span>';
		 }
		 ?>
		 </td><td style="width:20%; text-align:center"><a href="?action=edit&lang=<?php echo $lang;?>&id=<?php echo $v['id'];?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>">修改</a>|<a href="javascript:if(confirm('确定要删除么')){location.href='?action=del&id=<?php echo $v['id'];?>&lang=<?php echo $lang;?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>';}">删除</a></td>
		</tr>
	<?php
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
