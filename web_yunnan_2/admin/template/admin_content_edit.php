<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>内容修改</title>
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
	/*
	$('#title').change(function(){
		$value = $(this).val();
		$('#html_url').val($value);
	});
	*/
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
	$(n).load('admin_ajax.php',{'action':'change_pic_alt','id':id,'val':$text},function($data){
		if($data){alert('修改完成');}
	})
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
		<span>修改内容</span>
			<div class="admin_fh"><a href="?action=content_list&id=<?php echo $channel_id;?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>">返回</a></div>
		</div><!--位置-->
		
	<!--内容区-->					
<div class="order_contain">
<form name="maininfo" method="post" action="admin_content.php?nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>" class="form" enctype="multipart/form-data">
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
 <table cellpadding="0" cellspacing="0" width="100%">
 	<thead>
		<tr><th style="width:20%">参数说明</th><th style="width:80%">参数值</th></tr>
	</thead>
	<tbody>
		<tr>
		  <td style="width:20%;text-align:center" class="w1">内容标题：</td><td style="width:80%">
		  <input name="title" title="标题" reg="[^0]" value="<?php echo htmlspecialchars($field_value['title']);?>" style="width:40%; float:left; <?php 
		  if($field_value['title_color']){ echo "color:".$field_value['title_color'].";";}
		  if($field_value['title_style']==1){
		   echo "font-weight:bold;";
		  }else if($field_value['title_style']==2){
		  	echo "font-style:italic;";
		  }else if($field_value['title_style']==3){
		  	echo "text-decoration:underline;";
		  }
		  ?>" id="title" />
		  <input name="title_color" id="title_color" value="<?php echo $field_value['title_color'];?>" type="hidden" />
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
<option value="0" <?php if($field_value['title_style']==0){ echo 'selected="selected"';}?>>标题样式</option>
<option value="1" <?php if($field_value['title_style']==1){ echo 'selected="selected"';}?>>加粗</option>
<option value="2" <?php if($field_value['title_style']==2){ echo 'selected="selected"';}?>>斜体</option>
<option value="3" <?php if($field_value['title_style']==3){ echo 'selected="selected"';}?>>下划线</option>
</select><span name="easyTip">不能为空</span>
		  </td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center"><span title="" class="help">副标题:</span></td><td style="width:80%">
		  <input type="text" name="small_title" style="width:40%" title="" value="<?php echo $field_value['small_title'];?>"/>
		  </td>
		</tr>
		<tr>
		<?php
		$filter=explode(',',$field_value['filter']);
		?>
		  <td style="width:20%;text-align:center" class="w1">内容区分标志：</td><td style="width:80%"><label for="f1"><input id="f1" name="filter[]" value="a" style="border:0; margin-top:3px;" type="checkbox" <?php if(in_array('a',$filter)){?>checked="checked"<?php }?> />头条</label><label for="f2"><input id="f2" type="checkbox" value="b" style="border:0; margin-top:3px;" name="filter[]" <?php if(in_array('b',$filter)){?>checked="checked"<?php }?> />推荐</label><label for="f3"><input id="f3" type="checkbox" value="c" style="border:0; margin-top:3px;" name="filter[]" <?php if(in_array('c',$filter)){?>checked="checked"<?php }?> />图片</label><label for="f4"><input id="f4" type="checkbox" value="g" style="border:0; margin-top:3px;" <?php if($field_value['is_url']){echo "checked=\"checked\"";}?> onclick="ck_show_url(this,'#g_url');" name="filter_g" />跳转</label></td>
		</tr>
		<tr id="g_url" <?php if($field_value['is_url']){ echo "style=\"\"";}else{echo "style=\"display:none\"";}?>>
		  <td style="width:20%;text-align:center" class="w1"><span title="勾选跳转,将会转入跳转网址" class="help">跳转网址：</span></td><td style="width:80%"><input name="g_url" value="<?php echo $field_value['url_add'];?>" style="width:20%" /></td>
		</tr>
		
		<tr>
		  <td style="width:20%;text-align:center" class="w1">来源：<p style="color:#999999; font-weight:normal"></p></td><td style="width:80%"><input name="source" value="<?php echo $field_value['source'];?>" style="width:30%" /></td>
		</tr>
		<tr>
		  <td style="width:20%;text-align:center" class="w1">作者：<p style="color:#999999; font-weight:normal"></p></td><td style="width:80%"><input name="author" value="<?php echo $field_value['author'];?>" style="width:30%" /></td>
		</tr>
		<tr>
		  <td style="width:20%;text-align:center" class="w1">内容展示缩略图：</td><td style="width:80%">
<input name="thumb" value="<?php echo $field_value['tbpic'];?>" style="width:30%; display:block; float:left; margin-top:55px;" id="thumb" />
		  <p style="margin-top:55px;" class="admin_up_pic"><a href="#" id="content_pic">上传图片</a></p><span id="show_thumb" class="admin_show_pic"><a href="#" id="content_pic1"><img src="../upload/<?php if($field_value['tbpic']){echo $field_value['tbpic'];}else{ echo 'no_pc.gif';}?>"  height="120" width="120"/></a></span>
		  </td>
		</tr>
		<tr>
		  <td style="width:20%;text-align:center" class="w1"><span title="请选择发布栏目,使用频道模板的栏目不可发布" class="help"></span>发布栏目：</td><td style="width:80%">
		  <select name="category" id="cate" reg="[^0]">
		  <option value="">请选择栏目</option>
		  <?php get_post_catelist($lang,$channel_id,$cate);?>
		  </select><span name="easyTip">不能为空</span>
		  </td>
		</tr>
		<?php
		if($channel_id=='-9'){
		?>
		<tr>
		  <td style="width:20%;text-align:center" class="w1">选择表单：</td><td style="width:80%">
		 <?php echo get_form_list($field_value['form_id']);?>
		 </td>
		</tr>
		<?php
		}
		?>
		<tr>
		  <td style="width:20%;text-align:center" class="w1"><span title="使用html编辑器时才能使用该功能" class="help"></span>html编辑器选项:</td><td style="width:80%"><label for="f5"><input id="f5" name="down_file" type="checkbox" style="border:0; margin-top:3px;" value="1"  checked="checked"/>下载网络图片</label><label for="f6"><input id="f6" name="first_pic" type="checkbox" style="boder:0; margin-top:3px;" value="1"  checked="checked"/>使用第一张图片作为缩略图</label><label for="f7"><input id="f7" name="pic_watermark" type="checkbox" style="border:0; margin-top:3px;" value="1"  checked="checked"/>图片是否加水印</label><label for="f8"><input id="f8" name="is_info" type="checkbox" style="border:0; margin-top:3px;" value="1"  checked="checked"/>提取一部分内容作为描述</label><p style="color:red">(编辑器功能只有字段名为content,字段类型为html编辑器的字段可以使用)</p></td>
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
		<tbody>
		<tr>
		  <td style="width:20%;text-align:center" class="w1">内容标签：</td><td style="width:80%"><input name="content_key" value="<?php echo $field_value['content_key'];?>" style="width:50%" />使用|分割<em style="font-style:normal; color:#FF0000">(需要模板支持)</em></td>
		</tr>
		<tr>
		  <td style="width:20%;text-align:center" class="w1">页面关键字(SEO)：</td><td style="width:80%"><input name="key_words" value="<?php echo $field_value['keywords'];?>" style="width:50%" />使用,分割</td>
		</tr>
		<tr>
		  <td style="width:20%;text-align:center" class="w1">页面描述(SEO)：<p style="color:#999999; font-weight:normal"></p></td><td style="width:80%"><textarea name="info" style="width:50%; height:50px;"><?php echo $field_value['info'];?></textarea></td>
		</tr>
		
		<tr>
		  <td class="w1" style="width:20%;text-align:center">置顶:</td><td style="width:80%">
		  	<label for="f20"><input id="f20" name="top" type="radio" value="0" style="border:0"  <?php if($field_value['top']==0){?>checked="checked"<?php }?>/>否</label><label for="f21"><input id="f21" name="top" style="border:0" type="radio" value="1" <?php if($field_value['top']==1){?>checked="checked"<?php }?>/>是</label>
		  </td>
		</tr>
		<tr>
		  <td class="w1" style="width:20%;text-align:center">发布时间:</td><td style="width:80%"><input style="width:30%" value="<?php echo date('Y-m-d H:m:s',time());?>" name="updatetime" /></td>
		</tr>
		</tbody>
 </table>
 </div>
 </div>
 </div>
<div class="order_btn">
<input type="hidden" name="action" value="save_edit_content"/><input type="hidden" value="<?php echo $id;?>" name="id" /><input type="hidden" name="channel_id" value="<?php echo $channel_id;?>" /><input name="lang" value="<?php echo $lang;?>"  type="hidden"/><input type="hidden" name="addtime" value="<?php echo $field_value['addtime'];?>" />
  <input type="submit" value="确定" name="submit" /><input type="reset" value="重置" style="margin:0 10px;" name="reset"/>
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

var $href;
$href = $('#more_pic').attr('href');

$('#more_pic').wBox({title:'缩略图',requestType: "iframe",target:$href,iframeWH:{width:800,height:400}});
$file_href = $('#upload_file').attr('href');
$('#upload_file').wBox({title:'附件',requestType: "iframe",target:$file_href,iframeWH:{width:800,height:400}});
</script>
</body>
</html>
