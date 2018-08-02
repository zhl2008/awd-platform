<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加网站内容模型</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript" src="template/images/ck_form.js"></script>
<script type="text/javascript" src="template/images/admin.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#bs').blur(function(){
		$('#table').val($(this).val());
		var $val=$(this).val();
		$list_php=$val+'/'+$val+'.php';
		$content_php=$val+'/show_'+$val+'.php';
		$('#list_php').val($list_php);
		$('#content_php').val($content_php);
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
		<span>添加内容模型</span>
			
		</div><!--位置-->
		
	<!--内容区-->	

<div class="order_contain">
<form name="maininfo" method="post" enctype="multipart/form-data" action="admin_channel.php?nav=listmodel&admin_p_nav=<?php echo $admin_p_nav;?>" class="form" >
 <div class="order_main">
 <table cellpadding="0" cellspacing="0" width="100%" class="table_info1">
 	<thead>
		<tr><th style="width:30%">参数说明</th><th style="width:70%">参数值</th></tr>
	</thead>
	<tbody>
		<tr>
		  <td style="width:30%;text-align:center" class="w1"><span title="模型的中文名称，在后台管理，前台发布等均使用此名字" class="help">模型名称：</span></td><td style="width:70%"><input name="channel_name" value="" style="width:50%" reg="[^0]" title="模型名称" /><span name="easyTip">不能为空</span></td>
		</tr>
		<tr>
		  <td style="width:30%;text-align:center" class="w1"><span title="不可重复,用于操作模型，必须为小写英文和数字,填写后不可更改" class="help">模型标识：</span></td><td style="width:70%"><input name="channel_mark" value="" style="width:20%" reg="^\w+$" title="模型标示" id="bs" onblur="javascript:ajax_check(this,'check_channel');" /><span id="loading" style="display:none"></span><span name="easyTip">只能为字母、数字或_组合</span></td>
		</tr>
		<tr>
		  <td style="width:30%;text-align:center" class="w1"><span title="不可重复,必须为小写英文、数字或_" class="help">模型数据表:</span></td><td style="width:70%"><?php echo DB_PRE;?><input id="table" name="channel_table" value="" style="width:15%" reg="^\w+$" title="数据表" onblur="javascript:ajax_check(this,'check_table');" /><span id="loading" style="display:none"></span><span name="easyTip">只能为字母、数字或_组合</span></td>
		</tr>
		<tr>
		  <td style="width:30%;text-align:center" class="w1"><span title="只能使用数字,数字越大排在越前" class="help">模型排序:</span></td><td style="width:70%"><input name="channel_order" value="10" style="width:20%" /></td>
		</tr>
		<tr>
		  <td style="width:30%;text-align:center" class="w1"><span title="处理次级页面的程序" class="help">列表页程序:</span></td><td style="width:70%"><input name="channel_list_php" id="list_php" value="" style="width:40%" /></td>
		</tr>
		<tr>
		  <td style="width:30%;text-align:center" class="w1"><span title="处理最终页面的程序" class="help">内容页程序:</span></td><td style="width:70%"><input name="channel_content_php" id="content_php" value="" style="width:40%" /></td>
		</tr>
		<tr>
		  <td style="width:30%;text-align:center" class="w1">发布内容是否审核：</td><td style="width:70%"><label for="f1"><input id="f1" style="border:none" type="radio" name="is_verify" value="0" checked="checked" />否</label><label for="f2"><input id="f2" type="radio" style="border:none" name="is_verify" value="1"  />是</label></td>
		</tr>
		<tr>
		  <td style="width:30%;text-align:center" class="w1">是否开启：</td><td style="width:70%"><label for="f3"><input id="f3" style="border:none" type="radio" name="is_disable" value="1" />否</label><label for="f4"><input id="f4" type="radio" style="border:none" name="is_disable" value="0" checked="checked" />是</label></td>
		</tr>
		<tr>
		  <td style="width:30%;text-align:center" class="w1"><span title="固定的模型不能删除" class="help"></span>是否固定：</td><td style="width:70%"><label for="f5"><input id="f5" style="border:none" type="radio" name="is_del" value="0" checked="checked"/>否</label><label for="f6"><input id="f6" type="radio" style=" border:none" name="is_del" value="1"  />是</label></td>
		</tr>
		
	</tbody>
 </table>
 </div>
<div class="order_btn">
<input type="hidden" name="action" value="save_channel"/>
  <input type="submit" value="确定" name="submit"/><input type="reset" style="margin:0 10px;" value="重置" name="reset"/>
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
