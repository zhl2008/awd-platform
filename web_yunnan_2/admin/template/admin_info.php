<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站配置</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript" src="template/images/admin.js"></script>
<script type="text/javascript" src="template/images/dialog-min.js"></script>
<script type="">
$(document).ready(function(){
	$('#web_name').change(function(){
		$value = $(this).val();
		$value2=$('#web_index_name').val();
		if($value2==''){
			$('#web_index_name').val($value);
		}
	});
});
</script>

<link type="text/css" href="template/images/dialog/dialog.css" rel="stylesheet" />

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
		<span>基本设置</span>
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

	
		
		
		<!--开始表单-->
		<div class="order_contain">
		<form name="maininfo" method="post" enctype="multipart/form-data" class="form">
		<div class="order_main">
	<table cellpadding="0" cellspacing="0" width="100%" class="table_info1">
		<thead>
		<tr><th class="w1">参数说明</th><th class="w2">参数值</th><th class="w3 r">变量名</th></tr>
	</thead>
	<tbody>
		<tr>
		  <td class="w1">网站全站标题:</td><td class="w2"><input id="web_name" type="text" name="web_name" style="width:80%" value="<?php echo isset($_confing['web_name'])?$_confing['web_name']:'';?>"/></td><td class="w3">尽量短点，带产品或服务关键词</td>
		</tr>
		<tr>
		  <td class="w1">首页标题:</td><td class="w2"><input id="web_index_name" type="text" name="web_index_name" style="width:80%" value="<?php echo isset($_confing['web_index_name'])?$_confing['web_index_name']:'';?>"/></td><td class="w3">适度，不要长也不要短，带产品或服务关键词</td>
		</tr>
		<tr>
		  <td class="w1">开启伪静态:</td><td class="w2"><label for="yes"><input id="yes" style="border:0; margin-top:3px;" type="radio" value="1" name="web_rewrite[]" <?php $web_rewrite=isset($_confing['web_rewrite'])?$_confing['web_rewrite']:0; if ($web_rewrite==1){?>checked="checked"<?php }?>/>是</label><label for="no"><input id="no" type="radio" value="0" style="border:0; margin-top:3px;" name="web_rewrite[]" <?php if ($web_rewrite==0){?>checked="checked"<?php }?>/>否</label></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1">开启缓存:</td><td class="w2"><label for="yes2"><input id="yes2" type="radio" style="border:0; margin-top:3px;" name="is_cache[]" <?php if($_confing['is_cache'][0]){?>checked="checked"<?php }?> value="1"/>是</label><label for="no2"><input id="no2" style="border:0; margin-top:3px;" type="radio" name="is_cache[]" <?php if(!$_confing['is_cache'][0]){?>checked="checked"<?php }?> value="0" />否</label></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1">默认缓存时间:</td><td class="w2"><input type="text" name="cache_time" style="width:100px" value="<?php if($_confing['cache_time']){echo $_confing['cache_time'];}else{echo '30';}?>" />秒</td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1">网站logo:<p style="color:#FF0000">大小：<?php echo $tpl_confing['logo_size'];?></p></td><td class="w2"><input name="web_logo" value="<?php echo $_confing['web_logo'];?>" style="width:30%; display:block; float:left; margin-top:55px;" id="thumb" />
		 <p style="margin-top:55px;" class="admin_up_pic"><a href="#" id="cate_pic1_btn">上传图片</a></p><span id="show_thumb" class="admin_show_pic"><a href="#" id="cate_pic1_btn1"><img src="<?php if($_confing['web_logo']){ echo '../upload/'.$_confing['web_logo'];}else{?>../upload/no_pc.gif<?php }?>"  height="120" width="120"/></a></span></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1"><span title="更换模板会清空现有模板配置" class="help">当前语言PC网站模板:</span></td><td class="w2"><p style="float:left; width:30%; margin-top:50px;">template/<input type="text" id="tpl" name="web_template" style="width:100px;" value="<?php echo isset($_confing['web_template'])&&!empty($_confing['web_template'])?$_confing['web_template']:'default';?>"/></p>
		   <p style="margin-top:55px;" class="admin_up_pic"><a href="#" class="sl_tpl">选择模板</a></p><span id="show_tpl" class="admin_show_pic"><a href="<?php echo isset($_confing['web_template'])&&!empty($_confing['web_template'])?'../template/'.$_confing['web_template'].'/thumb.gif':'../upload/no_pc.gif';?>" target="_blank"><img src="<?php echo isset($_confing['web_template'])&&!empty($_confing['web_template'])?'../template/'.$_confing['web_template'].'/thumb.gif':'../upload/no_pc.gif';?>"  height="120" width="120"/></a></span>
		  </td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1"><span title="更换模板会清空现有模板配置" class="help">手机模板:</span></td><td class="w2"><p style="float:left; width:30%; margin-top:50px;">template/<input type="text" id="tp2" name="phone_template" style="width:100px;" value="<?php echo isset($_confing['phone_template'])&&!empty($_confing['phone_template'])?$_confing['phone_template']:'default_phone';?>"/></p>
		   <p style="margin-top:55px;" class="admin_up_pic"><a href="#" class="sl_tp2">选择模板</a></p><span id="show_tp2" class="admin_show_pic"><a href="<?php echo isset($_confing['phone_template'])&&!empty($_confing['phone_template'])?'../template/'.$_confing['phone_template'].'/thumb.gif':'../upload/no_pc.gif';?>" target="_blank"><img src="<?php echo isset($_confing['phone_template'])&&!empty($_confing['phone_template'])?'../template/'.$_confing['phone_template'].'/thumb.gif':'../upload/no_pc.gif';?>"  height="120" width="120"/></a></span>
		  </td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1"><span title="支持html代码" class="help">网站页脚信息:</span></td><td class="w2"><textarea name="web_powerby" style="width:95%; height:50px;"><?php echo isset($_confing['web_powerby'])?$_confing['web_powerby']:'';?></textarea></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1"><span title="支持html代码" class="help">网站统计代码:</span></td><td class="w2"><textarea name="web_tongji" style="width:95%; height:50px;"><?php echo isset($_confing['web_tongji'])?$_confing['web_tongji']:'';?></textarea></td><td class="w3">百度搜‘站长统计’，申请获取代码放到这里</td>
		</tr>
		<tr>
		  <td class="w1">首页默认关键字(SEO):</td><td class="w2"><input type="text" name="web_keywords" style="width:80%" value="<?php echo isset($_confing['web_keywords'])?$_confing['web_keywords']:'';?>"/></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1">首页默认描述(SEO):</td><td class="w2"><textarea name="web_description" style="width:95%; height:50px;"><?php echo isset($_confing['web_description'])?$_confing['web_description']:'';?></textarea></td><td class="w3">尽量突出网站的产品或服务特色</td>
		</tr>
		<tr>
		  <td class="w1"><span title="支持html代码" class="help">营销客服代码(如53KF代码):</span></td><td class="w2"><textarea name="web_yinxiao" style="width:95%; height:50px;"><?php echo isset($_confing['web_yinxiao'])?$_confing['web_yinxiao']:'';?></textarea></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1">热门搜索(用|分开):</td><td class="w2"><input type="text" style="width:95%;" value="<?php echo $_confing['hot_key'];?>" name="hot_key" /></td><td class="w3">搜索功能使用，需要模板支持</td>
		</tr>
		<tr>
		  <td class="w1">全局标签(用|分开):</td><td class="w2"><input type="text" style="width:95%;" value="<?php echo $_confing['all_key'];?>" name="all_key" /></td><td class="w3">需要模板支持</td>
		</tr>
	</tbody>
	 </table>
		</div>
		<div class="order_btn">
			<input type="hidden" name="action" value="add_inc"/><input type="hidden" name="lang" value="<?php echo $lang;?>"/><input type="hidden" name="nav" value="<?php echo $admin_nav;?>"/><input type="hidden" name="admin_p_nav" value="<?php echo $admin_p_nav;?>"/>
  			<input type="submit" value="确定" name="submit" class="go"/><input type="reset" class="go" value="重置" name="reset"/>
 		</div>
		
		<div class="ie8-height"></div>
		</form>
		</div>
		<!--结束表单-->
				<script type="text/javascript">
$('.sl_tpl').wBox({title:'选择模板',requestType: "iframe",target:"admin_sl_tpl.php?get=tpl",iframeWH:{width:800,height:400}});
$('.sl_tp2').wBox({title:'选择模板',requestType: "iframe",target:"admin_sl_tpl.php?get=tp2",iframeWH:{width:800,height:400}});
$('#cate_pic1_btn').wBox({title:'栏目图片',requestType: "iframe",target:"admin_pic_upload.php?type=radio&get=thumb",iframeWH:{width:800,height:400}});
</script>

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