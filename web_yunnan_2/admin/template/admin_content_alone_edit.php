<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>单页内容修改</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript" src="template/images/ck_form.js"></script>
<script type="text/javascript" src="template/images/dialog-min.js"></script>
<link type="text/css" href="template/images/dialog/dialog.css" rel="stylesheet" />
<script type="text/javascript">
$(document).ready(function(){
	$('.info_qh').find('ul li').click(function(){
		$index=$('.info_qh').find('ul li').index(this);
		$(this).addClass('on').siblings().removeClass('on');
		$('#tb').find('#table_div').eq($index).show().siblings().hide();
	});
	
});

function ck_show_url(n,id){
	$ck=$(n).attr('checked');
	if($ck){
		$(id).show();
	}else{
		$(id).hide();
	}
}


//删除多图
function del_pic($pic,$n){
	if($pic==""){alert('不存在该图片,删除失败');return false;}
	$r_m='#pic_'+$pic;
	$($r_m).remove();
}

//处理相册alt
function change_alt(n,id){
	$text=$(n).prev('#alt').val();
	$.ajax({
	type:"GET",
	url:"admin_ajax.php",
	data:"action=change_pic_alt&id="+id+"&val="+$text,
	dataType:"html",
	success:function(){
		alert('修改完成');
	}
	});
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
		<span>修改单页内容</span>
			<div class="admin_fh"><a href="?action=content_list&lang=<?php echo $lang;?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>">返回</a></div>
		</div><!--位置-->
		
	<!--内容区-->			
		
<div class="order_contain">
<form name="maininfo" method="post" action="?nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>" class="form" enctype="multipart/form-data">
 <div class="order_main">
  <div class="info_qh" style="margin-top:20px;">
 <ul>
  <li class="on">基本设置</li>
  <li>高级设置</li>
 </ul>
 <div class="clear"></div>
</div>
<div id="tb">
 <div id="table_div" style="display:block">
 <table cellpadding="0" cellspacing="0" width="100%" class="table_info1">
 	<thead>
		<tr><th style="width:20%">参数说明</th><th style="width:80%">参数值</th></tr>
	</thead>
	<tbody>
		<tr>
		  <td style="width:20%;text-align:center" class="w1">标题：</td><td style="width:80%"><input name="title" title="标题" reg="[^0]" value="<?php echo htmlspecialchars($field_value['title']);?>" style="width:50%" /><span name="easyTip">不能为空</span></td>
		</tr>
		<tr>
		  <td style="width:20%;text-align:center" class="w1">来源：<p style="color:#999999; font-weight:normal"></p></td><td style="width:80%"><input name="source" value="<?php echo $field_value['source'];?>" style="width:30%" /></td>
		</tr>
		<tr>
		  <td style="width:20%;text-align:center" class="w1">作者：<p style="color:#999999; font-weight:normal"></p></td><td style="width:80%"><input name="author" value="<?php echo $field_value['author'];?>" style="width:30%" /></td>
		</tr>
		<tr>
		  <td style="width:20%;text-align:center" class="w1"><span title="请选择发布栏目,使用频道模板的栏目不可发布" class="help">发布栏目：</span></td><td style="width:80%">
		   <?php
		 	echo $cate_name;
		 ?>
		  </td>
		</tr>
		<tr>
		  <td style="width:20%;text-align:center" class="w1"><span title="使用html编辑器时才能使用该功能" class="help"></span>html编辑器选项:</td><td style="width:80%"><label for="f1"><input id="f1" name="down_file" type="checkbox" style="border:0; margin-top:3px;" value="1"  checked="checked"/>下载网络图片</label><label for="f2"><input id="f2" name="first_pic" type="checkbox" style="border:0; margin-top:3px;" value="1"  checked="checked"/>使用第一张图片作为缩略图</label><label for="f3"><input id="f3" name="pic_watermark" type="checkbox" style="border:0; margin-top:3px;" value="1"  checked="checked"/>图片是否加水印</label><label for="f4"><input id="f4" name="is_info" type="checkbox" value="1"  checked="checked" style="margin-top:3px;"/>提取一部分内容作为描述</label></td>
		</tr>
		
		
		<?php
		echo content_fields($channel_id,$field_value,'true');
		?>
		
		</tbody>
	</table>
		</div>
		
		<div id="table_div" style="display:none">
		 <table cellpadding="0" cellspacing="0" width="100%" class="table_info1">
		<thead>
		<tr><th style="width:20%">参数说明</th><th style="width:80%">参数值</th></tr>
	</thead>
	<tbody id="tb2">
		<tr>
		  <td style="width:20%;text-align:center" class="w1">页面关键字(SEO)：</td><td style="width:80%"><input name="key_words" value="<?php echo $field_value['keywords'];?>" style="width:50%" />使用,分割</td>
		</tr>
		<tr>
		  <td style="width:20%;text-align:center" class="w1">页面描述(SEO)：<p style="color:#999999; font-weight:normal"></p></td><td style="width:80%"><textarea name="info" style="width:50%; height:50px;"><?php echo $field_value['info'];?></textarea></td>
		</tr>
		<tr>
		  <td class="w1" style="width:20%;text-align:center">发布时间:</td><td style="width:80%"><input style="width:30%" value="<?php echo date('Y-m-d H:m:s',time());?>" name="addtime" /></td>
		</tr>
	
		</tbody>
 </table>
 </div>
 </div>
 </div>
<div class="order_btn">
<input type="hidden" name="action" value="save_edit_content"/><input name="lang" value="<?php echo $lang;?>"  type="hidden"/><input type="hidden" value="<?php echo $field_value['category'];?>" name="cate_id" />
  <input type="submit" value="确定" name="submit"/><input type="reset" style="margin:0 10px;" value="重置" name="reset"/>
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


<script type="text/javascript">
var $href;
$href = $('#more_pic').attr('href');
$('#more_pic').wBox({title:'缩略图',requestType: "iframe",target:$href,iframeWH:{width:800,height:400}});
$file_href = $('#upload_file').attr('href');
$('#upload_file').wBox({title:'附件',requestType: "iframe",target:$file_href,iframeWH:{width:800,height:400}});
</script>
</body>
</html>
