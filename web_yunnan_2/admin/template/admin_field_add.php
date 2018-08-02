<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加字段</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript" src="template/images/ck_form.js"></script>
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
		<span>添加模型字段</span>
			<div class="admin_fh"><a href="?nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>">返回</a></div>	
		</div><!--位置-->
		
	<!--内容区-->	
	
<div class="order_contain">

<form name="maininfo" method="post" action="admin_channel.php?nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>" class="form">
<div class="order_main">
 <table cellpadding="0" cellspacing="0" width="100%" class="table_info1">
 	<thead>
		<tr><th style="width:30%">参数说明</th><th style="width:70%">参数值</th></tr>
	</thead>
	<tbody>
		<tr>
		  <td style="width:30%;text-align:center" class="w1"><span title="发布内容时显示的提示文字" class="help">提示文字：</span></td><td style="width:70%"><input name="use_name" value="" style="width:50%" reg="[^0]" title="提示文字" /><span name="easyTip">不能为空</span></td>
		</tr>
		<tr>
		  <td style="width:30%;text-align:center" class="w1"><span title="存储数据使用，同一内容模型下不可重复,必须为英文,填写后不可更改" class="help">字段名称：</span></td><td style="width:70%"><input name="field_name" value="" style="width:50%" reg="^\w+$" title="字段名称" /><span name="easyTip">使用字母、数字或_组合</span></td>
		</tr>
		<tr>
		  <td style="width:30%;text-align:center" class="w1">字段类型：</td><td style="width:70%">
		  <p style="width:100%; float:left"><label for="f1"><input id="f1" style="border:none; margin-top:3px;" type="radio" name="field_type" value="text" checked="checked"/>文本框</label></p>
		  <p style="width:100%; float:left"><label for="f2"><input id="f2" type="radio" style="border:none; margin-top:3px;" name="field_type" value="textarea" />多行文本</label></p>
		  <p style="width:100%; float:left"><label for="f3"><input id="f3" type="radio" style="border:none; margin-top:3px;" name="field_type" value="html" />html文本</label></p>
		  <p style="width:100%; float:left"><label for="f4"><input id="f4" type="radio" style="border:none; margin-top:3px;" name="field_type" value="upload_pic" />上传图片(单图)</label></p>
		  <p style="width:100%; float:left"><label for="f5"><input id="f5" type="radio" style="border:none; margin-top:3px;" name="field_type" value="upload_pic_more" />上传图片(多图)</label></p>
		  <p style="width:100%; float:left"><label for="f6"><input id="f6" type="radio" style="border:none; margin-top:3px;" name="field_type" value="upload_file" />上传附件</label></p>
		  <p style="width:100%; float:left"><label for="f7"><input id="f7" type="radio" style="border:none; margin-top:3px;" name="field_type" value="select" />option下拉</label></p>
		  <p style="width:100%; float:left"><label for="f8"><input id="f8" type="radio" style="border:none; margin-top:3px;" name="field_type" value="radio" />radio选项</label></p>
		  <p style="width:100%; float:left"><label for="f9"><input id="f9" type="radio" style="border:none; margin-top:3px;" name="field_type" value="checkbox" />Checkbox多选</label></p>		  
		  </td>
		</tr>
		<tr>
		  <td style="width:30%;text-align:center" class="w1"><span title="选择radion,option,checkbox字段使用,分割;如a,b,c" class="help">字段默认值：</span></td><td style="width:70%">
		 <textarea name="field_value" style="width:50%; height:50px;"></textarea></td>
		</tr>
		<tr>
		  <td style="width:30%;text-align:center" class="w1"><span title="说明将会出现在表单中，表单使用名下面" class="help">字段说明：</span></td><td style="width:70%">
		 <textarea name="field_info" style="width:50%; height:50px;"></textarea></td>
		</tr>
		<tr>
		  <td style="width:30%;text-align:center" class="w1"><span title="字段排序,按排序输出" class="help">字段排序：</span></td><td style="width:70%">
		 <input name="field_order" value="10" style="width:20%" /></td>
		</tr>
		<tr>
		  <td style="width:30%;text-align:center" class="w1"><span title="固定的字段不能单独删除" class="help">是否固定：</span></td><td style="width:70%"><label for="f10"><input id="f10" style="border:none; margin-top:3px;" type="radio" name="is_del" value="0" checked="checked"/>否</label><label for="f11"><input id="f11" type="radio" style=" border:none; margin-top:3px;" name="is_del" value="1"  />是</label></td>
		</tr>
		<tr>
		  <td style="width:30%;text-align:center" class="w1">是否禁用：</td><td style="width:70%"><label for="f12"><input id="f12" style="border:none; margin-top:3px;" type="radio" name="is_disable" value="0" checked="checked"/>否</label><label for="f13"><input id="f13" type="radio" style="border:none; margin-top:3px;" name="is_disable" value="1"  />是</label></td>
		</tr>
		
	</tbody>
 </table>
 </div>
<div class="order_btn">
<input type="hidden" name="action" value="save_field"/><input type="hidden" value="<?php echo $GLOBALS['id'];?>" name="id" />
  <input type="submit" value="确定" name="submit" class="go"/><input type="reset" class="go" value="重置" name="reset"/>
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
