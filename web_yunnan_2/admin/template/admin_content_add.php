<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>内容添加</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript" src="template/images/ck_form.js"></script>
<script type="text/javascript" src="template/images/dialog-min.js"></script>
<link type="text/css" href="template/images/dialog/dialog.css" rel="stylesheet" />
<style type="text/css">
.color{ position:relative; width:21px; height:18px; float:left; margin-left:5px; display:inline}
.color span{display:block;width:21px; height:18px; background:url('template/images/color.gif') no-repeat left center;}
.color_table{position:absolute; left:21px; top:18px; border:1px solid #ccc;}
.table_td{border:1px solid #fff; font-style:oblique};
</style>
<script type="text/javascript">
$(document).ready(function(){
	$('.info_qh').find('ul li').click(function(){
		$index=$('.info_qh').find('ul li').index(this);
		$(this).addClass('on').siblings().removeClass('on');
		$('#tb').find('#table_div').eq($index).show().siblings().hide();
	});
	
	$('.color span').click(function(){
				$('#select_color').show().find('td').hover(function(){
					$(this).css({'border-color':'#fff'});
				},function(){
					$(this).css({'border-color':'#ccc'});
				}).click(function(){
					$color=$(this).css('background-color');
					$('.color').css({'background':$color});
					$('#title').css({'color':$color});
					$('#title_color').val($color);
					$('#select_color').hide();
				});
			});	
	
	$('#title_type').change(function(){
		$title_type=$(this).val();
		if($title_type==1){
			$('#title').css({'font-weight':'bold'});
			$('#title').css({'font-style':'normal'});
			$('#title').css({'text-decoration':'none'});
		}else if($title_type==2){
			$('#title').css({'font-style':'italic'});
			$('#title').css({'font-weight':'normal'});
			$('#title').css({'text-decoration':'none'});
		}else if($title_type==3){
			$('#title').css({'text-decoration':'underline'});
			$('#title').css({'font-weight':'normal'});
			$('#title').css({'font-style':'normal'});
		}else{
			$('#title').css({'font-weight':'normal'});
			$('#title').css({'font-style':'normal'});
			$('#title').css({'text-decoration':'none'});
		}
	});		
	
	
	$('#title').change(function(){
		$value = $(this).val();
		$('#small_title').val($value);
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

//处理多语言栏目
function remove_cate($cate){
	$cate_li='#li_'+$cate;
	$($cate_li).remove();
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
		<span>添加内容</span>
			<div class="lang">
			<ul>
			 <?php
 $cache_file=DATA_PATH."cache/lang_cache.php";
 $cache_arr=read_cache($cache_file,'lang_cache');
 if(!empty($cache_arr)){
 foreach($cache_arr as $k=>$v){
  if(!$v['lang_is_use']){continue;}
 ?>
 <li><a href="?action=add&id=<?php echo $id;?>&lang=<?php echo $v['lang_tag'];?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>" class="<?php if($GLOBALS['lang']==$v['lang_tag']){echo 'hover';}?>"><?php echo $v['lang_name'];?></a></li>
 <?php
 }
 }
 ?>
			</ul>
		</div><!--语言-->	
		</div><!--位置-->
		
	<!--内容区-->	

<div class="order_contain">
<form name="maininfo" method="post" action="?nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>" class="form">
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
 <table cellpadding="0" cellspacing="0" width="100%" class="ad_tb table_info1">
 	<thead>
		<tr><th style="width:20%">参数说明</th><th style="width:80%">参数值</th></tr>
	</thead>
	<tbody>
		<tr>
		  <td style="width:20%; text-align:center" class="w1">内容标题：</td><td style="width:80%"><input name="title" value="" reg="[^0]" title="标题" style="width:40%; float:left" id="title" /><input name="title_color" id="title_color" value="" type="hidden" />
		  <div class="color"><span></span>
<table id="select_color" width="100" class="color_table" style="display:none" border="0" cellpadding="0" cellspacing="0">
<tr style="background:#FFFFFF; border:0">
<td style="background:#0000CC;border:1px solid #CCCCCC; padding:2px 5px;">&nbsp;</td>
<td style="background:#00CC66;border:1px solid #CCCCCC;padding:2px 5px;">&nbsp;</td>
<td style="background:#00FFCC;border:1px solid #CCCCCC;padding:2px 5px;">&nbsp;</td>
<td style="background:#996699;border:1px solid #CCCCCC;padding:2px 5px;">&nbsp;</td>
<td style="background:#CC3333;border:1px solid #CCCCCC;padding:2px 5px;">&nbsp;</td>
</tr>
<tr style="background:#FFFFFF; border:0">
<td style="background:#C0C0C0;border:1px solid #CCCCCC; padding:2px 5px;">&nbsp;</td>
<td style="background:#808080;border:1px solid #CCCCCC;padding:2px 5px;">&nbsp;</td>
<td style="background:#333333;border:1px solid #CCCCCC;padding:2px 5px;">&nbsp;</td>
<td style="background:#FE0000;border:1px solid #CCCCCC;padding:2px 5px;">&nbsp;</td>
<td style="background:#FF00FE;border:1px solid #CCCCCC;padding:2px 5px;">&nbsp;</td>
</tr>
<tr style="background:#FFFFFF; border:0">
<td style="background:#FFCD00;border:1px solid #CCCCCC; padding:2px 5px;">&nbsp;</td>
<td style="background:#993400;border:1px solid #CCCCCC;padding:2px 5px;">&nbsp;</td>
<td style="background:#FFFFFF;border:1px solid #CCCCCC;padding:2px 5px;">&nbsp;</td>
<td style="background:#99CD00;border:1px solid #CCCCCC;padding:2px 5px;">&nbsp;</td>
<td style="background:#008002;border:1px solid #CCCCCC;padding:2px 5px;">&nbsp;</td>
</tr>
<tr style="background:#FFFFFF; border:0">
<td style="background:#00CCFF;border:1px solid #CCCCCC; padding:2px 5px;">&nbsp;</td>
<td style="background:#3366FF;border:1px solid #CCCCCC;padding:2px 5px;">&nbsp;</td>
<td style="background:#0000FE;border:1px solid #CCCCCC;padding:2px 5px;">&nbsp;</td>
<td style="background:#010080;border:1px solid #CCCCCC;padding:2px 5px;">&nbsp;</td>
<td style="background:#CDFFFF;border:1px solid #CCCCCC;padding:2px 5px;">&nbsp;</td>
</tr>
<tbody>
<tr style="background:#FFFFFF; border:0">
<td style="background:#000">&nbsp;</td><td style="background:#000">&nbsp;</td><td style="background:#000">&nbsp;</td><td style="background:#000">&nbsp;</td><td style="background:#000">&nbsp;</td>
</tr>
</tbody>
</table>
</div>
<select name="title_style" id="title_type" style="float:left; margin-left:5px; display:inline">
<option value="0" selected="selected">标题样式</option>
<option value="1">加粗</option>
<option value="2">斜体</option>
<option value="3">下划线</option>
</select><span name="easyTip">不能为空</span>
		  </td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center"><span title="" class="help">副标题:</span></td><td style="width:80%">
		  <input type="text" name="small_title" id="small_title" style="width:40%" title="" value=""/>
		  </td>
		</tr>
		<tr>
		  <td style="width:20%;text-align:center" class="w1">内容区分标志：</td><td style="width:80%"><label for="f1"><input id="f1" name="filter[]" value="a" style="border:0; margin-top:3px;" type="checkbox" />头条</label><label for="f2"><input id="f2" type="checkbox" value="b" style="border:0; margin-top:3px;" name="filter[]" />推荐</label><label for="f3"><input id="f3" type="checkbox" value="c" style="border:0; margin-top:3px;" name="filter[]" />图片</label><label for="f4"><input id="f4" type="checkbox" value="g" style="border:0; margin-top:3px;" name="filter_g" onclick="ck_show_url(this,'#g_url');" />跳转</label></td>
		</tr>
		<tr id="g_url" style="display:none">
		  <td style="width:20%;text-align:center" class="w1"><span title="勾选跳转,将会转入跳转网址" class="help">跳转网址：</span></td><td style="width:80%"><input name="g_url" value="" style="width:20%" /></td>
		</tr>
		
		<tr>
		  <td style="width:20%;text-align:center" class="w1">来源：<p style="color:#ccc; font-weight:normal"></p></td><td style="width:80%"><input name="source" value="<?php echo CMS_URL;?>" style="width:30%" /></td>
		</tr>
		<tr>
		  <td style="width:20%;text-align:center" class="w1">作者：<p style="color:#ccc; font-weight:normal"></p></td><td style="width:80%"><input name="author" value="未知" style="width:30%" /></td>
		</tr>
		
		<tr style="height:50px;">
		  <td style="width:20%; height:50px;text-align:center" class="w1"><span title="默认缩略图,如果为空将会使用内容中的图片做缩略图" class="help">内容展示缩略图：</span></td><td style="width:80%;height:50px;"><input name="thumb" value="" style="width:30%; display:block; float:left; margin-top:55px;" id="thumb" />
		  <p style="margin-top:55px;" class="admin_up_pic"><a href="#" id="content_pic">上传图片</a></p><span id="show_thumb" class="admin_show_pic"><a href="#" id="content_pic1"><img src="../upload/no_pc.gif"  height="120" width="120"/></a></span>
		  
		  </td>
		</tr>
		<tr>
		  <td style="width:20%;text-align:center" class="w1"><span title="请选择发布栏目,使用频道模板的栏目不可发布" class="help">发布栏目：</span></td><td style="width:80%">
		  <select name="category" id="cate" reg="[^0]">
		  <option value="">请选择栏目</option>
		  <?php get_post_catelist($lang,$id,$cate_id);?>
		  </select><span name="easyTip">不能为空</span></td>
		</tr>
		<?php
		if($id=='-9'){
		?>
		<tr>
		  <td style="width:20%;text-align:center" class="w1">选择表单：</td><td style="width:80%">
		 <?php echo get_form_list();?>
		 </td>
		</tr>
		<?php
		}
		?>
		
		<tr>
		  <td style="width:20%;text-align:center" class="w1"><span title="使用html编辑器时才能使用该功能" class="help"></span>html编辑器选项：</td><td style="width:80%"><label for="f10"><input id="f10" name="down_file" type="checkbox" style="border:0; margin-top:3px;" value="1"  checked="checked"/>下载网络图片</label><label for="f11"><input id="f11" name="first_pic" type="checkbox" style="border:0; margin-top:3px;" value="1"  checked="checked"/>使用第一张图片作为缩略图</label><label for="f12"><input id="f12" name="pic_watermark" type="checkbox" style="border:0; margin-top:3px;" value="1"  checked="checked"/>图片是否加水印</label><label for="f13"><input id="f13" name="is_info" type="checkbox" style="border:0; margin-top:3px;" value="1"  checked="checked"/>提取一部分内容作为描述</label></td>
		</tr>
		
		
		<?php
		echo content_fields($id);
		?>
	</tbody>
	</table>
		</div>
		
		<div id="table_div" style="display:none">
		 <table cellpadding="0" cellspacing="0" width="100%" class="table_info1">
		<thead>
		<tr><th style="width:20%">参数说明</th><th style="width:80%">参数值</th></tr>
	</thead>
		<tbody>
		<tr>
		  <td style="width:20%;text-align:center" class="w1">页面关键字(SEO)：</td><td style="width:80%"><input name="key_words" value="" style="width:50%" />使用,分割</td>
		</tr>
		<tr>

		  <td style="width:20%;text-align:center" class="w1">页面描述(SEO)：<p style="color:#ccc; font-weight:normal"></p></td><td style="width:80%"><textarea name="info" style="width:50%; height:50px;"></textarea></td>
		</tr>
		<tr>
		  <td style="width:20%;text-align:center" class="w1">同时发布到其它语言：</td><td style="width:80%">
		  
		  <div class="lang_sl_btn"><a href="#" id="content_lang">选择其它语言栏目</a>
		  相同的内容可以同时发布，发布后修改翻译下文字就可以，省去图片等的操作</div><ul class="sl_cate_show" id="sl_cate_show"></ul></td>
		</tr>
		<tr>
		  <td class="w1" style="width:20%;text-align:center">内容置顶:</td><td style="width:80%">
		  	<label for="f20"><input id="f20" name="top" type="radio" value="0" style="border:0"  checked="checked"/>否</label><label for="f21"><input id="f21" name="top" style="border:0" type="radio" value="1"/>是</label>
		  </td>
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
<input type="hidden" name="action" value="save_content"/><input type="hidden" value="<?php echo $id;?>" name="id" /><input type="hidden" value="<?php echo $lang;?>" name="lang"/>
  <input type="submit" value="确定" class="go" name="submit"/><input type="reset" class="go" value="重置" name="reset"/>
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
$('#content_pic').wBox({title:'缩略图',requestType: "iframe",target:"admin_pic_upload.php?type=radio&get=thumb",iframeWH:{width:800,height:400}});
$('#content_pic1').wBox({title:'缩略图',requestType: "iframe",target:"admin_pic_upload.php?type=radio&get=thumb",iframeWH:{width:800,height:400}});
$('#content_lang').wBox({title:'选择其它语言',requestType: "iframe",target:"admin_lang_cate.php?id=<?php echo $id;?>&lang=<?php echo $lang;?>",iframeWH:{width:800,height:400}});


$file_href = $('#upload_file').attr('href');
$('#upload_file').wBox({title:'附件',requestType: "iframe",target:$file_href,iframeWH:{width:800,height:400}});
</script>
</body>
</html>
