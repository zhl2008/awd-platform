<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改字段</title>
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
		<span>修改字段</span>
			<div class="admin_fh"><a href="?action=fields&id=<?php echo $arr[0]['channel_id'];?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>">返回</a></div>	
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
		  <td style="width:30%;text-align:center" class="w1"><span title="发布内容时显示的提示文字" class="help">提示文字：</span></td><td style="width:70%"><input name="use_name" value="<?php echo $arr[0]['use_name'];?>" style="width:50%" reg="[^0]" title="提示文字"/><span name="easyTip">不能为空</span></td>
		</tr>
		<tr>
		  <td style="width:30%;text-align:center" class="w1"><span title="存储数据使用，同一内容模型下不可重复,必须为英文,填写后不可更改" class="help">字段名称：</span></td><td style="width:70%"><input name="field_name" value="<?php echo $arr[0]['field_name'];?>" style="width:50%" disabled="disabled" /></td>
		</tr>
		<tr>
		  <td style="width:30%;text-align:center" class="w1">字段类型：</td><td style="width:70%">
		  <p style="width:100%; float:left"><label for="f1"><input id="f1" style="border:none; margin-top:3px;" type="radio" name="field_type" value="text" <?php if($arr[0]['field_type']=='text'){?>checked="checked"<?php }?>/>文本框</label></p>
		  <p style="width:100%; float:left"><label for="f2"><input id="f2" type="radio" style="border:none; margin-top:3px;" name="field_type" value="textarea" <?php if($arr[0]['field_type']=='textarea'){?>checked="checked"<?php }?> />多行文本</label></p>
		  <p style="width:100%; float:left"><label for="f3"><input id="f3" type="radio" style="border:none; margin-top:3px;" name="field_type" value="html" <?php if($arr[0]['field_type']=='html'){?>checked="checked"<?php }?>/>html文本</label></p>
		  <p style="width:100%; float:left"><label for="f4"><input id="f4" type="radio" style="border:none; margin-top:3px;" name="field_type" value="upload_pic" <?php if($arr[0]['field_type']=='upload_pic'){?>checked="checked"<?php }?> />上传图片(单图)</label></p>
		  <p style="width:100%; float:left"><label for="f5"><input id="f5" type="radio" style="border:none; margin-top:3px;" name="field_type" value="upload_pic_more" <?php if($arr[0]['field_type']=='upload_pic_more'){?>checked="checked"<?php }?> />上传图片(多图)</label></p>
		  <p style="width:100%; float:left"><label for="f6"><input id="f6" type="radio" style="border:none; margin-top:3px;" name="field_type" value="upload_file" <?php if($arr[0]['field_type']=='upload_file'){?>checked="checked"<?php }?> />上传附件</label></p>
		  <p style="width:100%; float:left"><label for="f7"><input id="f7" type="radio" style="border:none; margin-top:3px;" name="field_type" value="select"  <?php if($arr[0]['field_type']=='select'){?>checked="checked"<?php }?>/>option下拉</label></p>
		  <p style="width:100%; float:left"><label for="f8"><input id="f8" type="radio" style="border:none; margin-top:3px;" name="field_type" value="radio" <?php if($arr[0]['field_type']=='radio'){?>checked="checked"<?php }?> />radio选项</label></p>
		  <p style="width:100%; float:left"><label for="f9"><input id="f9" type="radio" style="border:none; margin-top:3px;" name="field_type" value="checkbox" <?php if($arr[0]['field_type']=='checkbox'){?>checked="checked"<?php }?> />Checkbox多选</label></p>		  
		  </td>
		</tr>
		<tr>
		  <td style="width:30%;text-align:center" class="w1"><span title="选择radion,option,checkbox字段使用,分割;如a,b,c" class="help">字段默认值：</span></td><td style="width:70%">
		 <textarea name="field_value" style="width:50%; height:50px;"><?php echo $arr[0]['field_value'];?></textarea></td>
		</tr>
		<tr>
		  <td style="width:30%;text-align:center" class="w1"><span title="说明将会出现在表单中，表单使用名下面" class="help">字段说明：</span></td><td style="width:70%">
		 <textarea name="field_info" style="width:50%; height:50px;"><?php echo $arr[0]['field_info'];?></textarea></td>
		</tr>
		<tr>
		  <td style="width:30%;text-align:center" class="w1"><span title="字段排序,按排序输出" class="help">字段排序：</span></td><td style="width:70%">
		 <input name="field_order" value="<?php echo $arr[0]['field_order'];?>" style="width:20%" /></td>
		</tr>
		<tr>
		  <td style="width:30%;text-align:center" class="w1"><span title="固定的字段不能单独删除" class="help">是否固定：</span></td><td style="width:70%"><label for="f10"><input id="f10" style="border:none; margin-top:3px;" type="radio" name="is_del" value="0" <?php if($arr[0]['is_del']){echo"disabled=\"disabled\"";}elseif(!$arr[0]['is_del']){?>checked="checked"<?php }?>/>否</label><label for="f11"><input id="f11" type="radio" style="border:none; margin-top:3px;" name="is_del" value="1"  <?php if($arr[0]['is_del']){?>disabled="disabled" checked="checked"<?php }?>/>是</label></td>
		</tr>
		<tr>
		  <td style="width:30%;text-align:center" class="w1">是否禁用：</td><td style="width:70%"><label for="f12"><input id="f12" style="border:none; margin-top:3px;" type="radio" name="is_disable" value="0" <?php if(!$arr[0]['is_disable']){?>checked="checked"<?php }?>/>否</label><label for="f13"><input id="f13" type="radio" style="border:none; margin-top:3px;" name="is_disable" value="1" <?php if($arr[0]['is_disable']){?>checked="checked"<?php }?> />是</label></td>
		</tr>
		
	</tbody>
 </table>
 </div>
<div class="order_btn">
<input type="hidden" name="action" value="save_xg_field"/><input type="hidden" value="<?php echo $GLOBALS['id'];?>" name="id" /><input type="hidden" name="channel_id" value="<?php echo $arr[0]['channel_id'];?>" /><input type="hidden" name="field" value="<?php echo $arr[0]['field_name'];?>" />
  <input type="submit" value="确定" name="submit" class="go"/><input type="reset" style="margin:0 10px;" class="go" value="重置" name="reset"/>
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
