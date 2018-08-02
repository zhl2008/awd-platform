<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理后台</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript" src="template/images/admin.js"></script>
<style type="text/css">
body{


height:100%;
width:100%;
}
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
				<li><a href="#" target="_blank">官网首页</a></li>
				<li><a href="#" target="_blank">帮助手册</a></li>
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
		
		<div class="admin_position"><span>基本信息</span><p id="show_tech" style="display:none"></p></div><!--位置-->
<div class="order_contain" style="border:none">
<p class="main_title">统计信息</p>
<ul class="main_ul">
<?php if(!empty($channel)){
foreach($channel as $k=>$v){
$sql="select count(*) as n from ".DB_PRE."maintb where channel={$v['id']} group by channel";
$num=$GLOBALS['mysql']->fetch_asc($sql);
$num=empty($num[0]['n'])?0:$num[0]['n'];
$sql="select sum(hits) as ck from ".DB_PRE."maintb where channel={$v['id']} group by channel";
$sum=$GLOBALS['mysql']->fetch_asc($sql);
$sum=empty($sum[0]['ck'])?0:$sum[0]['ck'];
?>
<li><div style="float:left; width:100%"><span><?php echo $v['channel_name'];?>:</span><?php echo $num;?>篇&nbsp;累计浏览量:<?php echo $sum;?>次</div></li>
<?php
}
}
if(!empty($form)){
foreach($form as $k=>$v){
$sql="select count(*) as c from ".DB_PRE."formlist where form_id='{$v['id']}'";
$num=$GLOBALS['mysql']->fetch_asc($sql);
$sql="select count(*) as b from ".DB_PRE."formlist where form_id='{$v['id']}' and is_read=0";
$num2=$GLOBALS['mysql']->fetch_asc($sql);
?>
<li><span><?php echo $v['form_name'];?>:</span>有<?php echo $num[0]['c'];?>条表单信息&nbsp;<label <?php if($num2[0]['b']){echo 'style="color:#FF0000"';}?>><?php echo $num2[0]['b'];?>条未阅读</label>&nbsp;<a href="admin_form.php?action=form_list&id=<?php echo $v['id'];?>" target="main">阅读信息</a></li>
<?php
}
}
?>
</ul>
<div class="clear"></div>
<p class="main_title">缓存信息</p>
<ul class="main_ul">
<li><span>语言缓存:</span><?php if(file_exists(DATA_PATH."cache/lang_cache.php")){?>已生成&nbsp;&nbsp;生成时间:<?php echo date('Y-m-d H:m:s',filemtime(DATA_PATH.'cache/lang_cache.php'));?>&nbsp;<a href="admin_lang.php?action=cache_lang">建议更新缓存</a><?php }else{ echo "<label style=\"color:red\">未生成</label>&nbsp;<a href=\"admin_lang.php?action=cache_lang\">生成缓存</a>";}?></li>
<li><span>栏目缓存:</span><?php if(file_exists(DATA_PATH."cache_cate/cache_category_all.php")){?>已生成&nbsp;&nbsp;生成时间:<?php echo date('Y-m-d H:m:s',filemtime(DATA_PATH.'cache_cate/cache_category_all.php'));?>&nbsp;<a href="admin_catagory.php?action=cache_cate">建议更新缓存</a><?php }else{ echo "<label style=\"color:red\">未生成</label>&nbsp;<a href=\"admin_catagory.php?action=cache_cate\">生成缓存</a>";}?></li>
<li><span>模块缓存:</span><?php if(file_exists(DATA_PATH."cache_channel/cache_channel_all.php")){?>已生成&nbsp;&nbsp;生成时间:<?php echo date('Y-m-d H:m:s',filemtime(DATA_PATH.'cache_channel/cache_channel_all.php'));?>&nbsp;<a href="admin_channel.php?action=cache">建议更新缓存</a><?php }else{ echo "<label style=\"color:red\">未生成</label>&nbsp;<a href=\"admin_channel.php?action=cache\">生成缓存</a>";}?></li>
</ul>
<div class="clear"></div>
<p class="main_title">系统信息</p>
<ul class="main_ul">
<li><span>【操作系统】</span><?php echo PHP_OS;?></li>
<li><span>【web服务器】</span><?php echo $_SERVER['SERVER_SOFTWARE'];?></li>
<li><span>【GD】</span><?php 
$rel=gd_info();
echo $rel['GD Version'];
echo "支持图片";
echo ($rel['GIF Read Support']&&$rel['GIF Create Support'])?'gif/':'';
echo ($rel['JPG Support'])?'jpeg/':'';
echo ($rel['PNG Support'])?'png':'';
unset($rel);
?></li>
<li><span>【安全模式】</span><?php echo ini_get('safe_mode') ? '是':'否';?></li>
<li><span>【上传文件最大值(服务器)】</span><?php echo ini_get('upload_max_filesize');?></li>
<li><span>【安装日期】</span><?php echo (CMS_ADDTIME=="")?'':date("Y-m-d H:m:s",CMS_ADDTIME);?></li>
<li><span>【编码】</span>UTF-8(唯一)</li>
<li><span>【版本】</span><?php echo $version;?><a href="http://www.test.com" style="padding-left:10px;" target="_blank">查看是否有更新</a></li>
</ul>

<div class="clear"></div>

</div>

		</div>	
	</div><!--main-->
	<div class="clear"></div>
</div>
<div class="bees_admin_foot">
	<p>版权所有 © 2009-2013 test.com，并保留所有权利。</p>
	<p>powerd by test</p>
</div>


</body>
</html>