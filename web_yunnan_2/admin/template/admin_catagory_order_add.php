<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加表单栏目</title>
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
		$('#tb').find('div').eq($index).show().siblings().hide();
	});
	
});



$(document).ready(function(){
var channel_list= new Array();
<?php
if(!empty($channel)){
foreach($channel as $k=>$v)
{
echo "channel_list[{$v['id']}] = \"{$v['channel_mark']}\";\r\n";
}
echo "channel_list[-9]=\"order\";\r\n";
}
?>
	$('#channel').change(function(){
		$value=channel_list[$(this).val()];
		//alert($value);
		$('#index_tpl').val('index_'+$value+'.html');
		$('#list_tpl').val('list_'+$value+'.html');
		$('#content_tpl').val($value+'_content.html');
		if($value=="alone"){
			$('#tpl').hide();
			$('#gdlm').hide();
			$('#alone').show().find('input').attr('checked','checked');
		}else{
			$('#tpl').show().find('input').eq(0).attr('checked','checked');
			$('#gdlm').show();
			$('#alone').hide();
		}
		($value=="order")?$('#order').show():$('#order').hide();
	});
});

function show_url(n){
$(n).show();
}
function hide_url(n){
$(n).hide();
}
</script>
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
		<span>添加表单栏目</span>
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

<div class="order_contain">
 <form name="add_cata" action="?" method="post" class="form">
 <div class="order_main">
 <div class="info_qh" style="margin-top:20px;">
 <ul>
  <li class="on">基本设置</li>
  <li>高级设置</li>
 </ul>
 <div class="clear"></div>
</div>
<div id="tb">
 <div id="sys1" style="display:block">
 <table cellpadding="0" cellspacing="0" width="100%" class="table_info1">
 	<thead>
		<tr><th class="w1">参数</th><th style="width:80%">参数值</th></tr>
	</thead>
	<tbody>
		<tr>
		  <td class="w1" style="text-align:center"><span title="不同的内容模型使用不同的模板和发布不同的内容" class="help">内容模型:</span></td><td style="width:80%">
		  表单栏目&nbsp;&nbsp;<input type="hidden" name="cate_channel" value="-9" />
		  </td>
		</tr>
		<tr id="order">
		  <td class="w1" style="text-align:center;" ><span title="使用表单模块需要选择表单" class="help">表单选择:</span></td><td style="width:80%">
		  <?php echo get_form_list();?>
		  </td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center"><span title="网站中显示,请不要使用其它字符做栏目名" class="help">栏目名称:</span></td><td style="width:80%"><input type="text" title="栏目名称" name="cate_name" style="width:30%; display:block; float:left" reg="[^0]" value=""/> <span name="easyTip">不能为空</span></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center"><span title="保存内容的文件名,请使用英文,建议中文使用汉语拼音的组合" class="help">栏目目录名:</span></td><td style="width:80%"><input type="text" name="cate_fold_name" style="width:30%" class="is_empty" title="栏目目录" value="" reg="^\w+$"/><em style="font-style:normal; color:#FF0000">(填写后不能更改，建议尽量使用栏目的拼音组合)</em><span name="easyTip">使用字母_数字组合</span></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center"><span title="只能使用数字" class="help">模板标示ID:</span></td><td style="width:80%"><input type="text" title="模板标示ID" name="temp_id" style="width:10%" value=""/>模板中内容调用输出使用，只能填写数字，同一种语言下的ID不能重复&nbsp;</td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">排列顺序:</td><td style="width:80%"><input type="text" name="cate_order" style="width:20%" value="10"/></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center"><span title="设置是否显示在导航上" class="help">导航显示:</span></td><td style="width:80%"><label for="f1"><input type="checkbox" value="2" name="cate_nav[]" id="f1" style="border:0; margin-top:3px;"  />中部显示</label><label for="f2"><input type="checkbox" id="f2" value="3" name="cate_nav[]" style="border:0; margin-top:3px;" />底部显示</label><span style="padding-left:50px; color:red">不勾选导航不会显示栏目</span></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">栏目使用页面:</td><td style="width:80%">
		  <p id="tpl" <?php echo ($rel[0]['id']==1)?'style="display:none"':'';?>><label for="f3" style="width:100%;"><input id="f3" type="radio" name="cate_tpl" value="0" style="border:0; margin-top:3px;" <?php echo ($rel[0]['id']==1)?'':'checked="checked"';?> onclick="hide_url('#show_url');" />列表页</label>
		  </p>
		 <p id="gdlm" <?php echo ($rel[0]['id']==1)?'style="display:none"':'';?>><label for="f4" style="width:100%;"><input id="f4" type="radio" name="cate_tpl" value="1" style="border:0; margin-top:3px;" onclick="hide_url('#show_url');" />引导栏目(不能发布内容,只作为显示)</label>
		  </p>
		  <p><label for="f6" style="width:100%;"><input id="f6" type="radio" name="cate_tpl" value="2" style="border:0; margin-top:3px;" onclick="show_url('#show_url');" />外部链接(链接到其他网站或php文件)</label></p></td>
		</tr>
		<tr id="show_url" style="display:none">
		  <td class="w1" style="text-align:center"><span title="将会进入链接地址" class="help">外部链接地址:</span></td><td style="width:80%"><input type="text" name="cate_url" style="width:30%" value="http://"/></td>
		</tr>
		</tbody>
		</table>
		</div>
		
		<div id="sys2" style="display:none">
		 <table cellpadding="0" cellspacing="0" width="100%" class="table_info1">
 	<thead>
		<tr><th class="w1">参数</th><th style="width:80%">参数值</th></tr>
	</thead>
		<tbody>
		<tr>
		  <td class="w1" style="text-align:center"><span title="隐藏的栏目前台不会显示,但仍可通过地址访问" class="help">是否隐藏栏目:</span></td><td style="width:80%"><label for="f7"><input id="f7" type="radio" name="cate_hide" value="1" style="margin:0 5px;border:0" />是</label><label for="f8"><input id="f8" type="radio" value="0" name="cate_hide" style="margin:0 5px; border:0" checked="checked"/>否</label></td>
		</tr>
		<tr style="display:none">
		  <td class="w1" style="text-align:center"><span title="需要使用{print $v['target']/}输出，并且没有target属性" class="help">是否新窗口:</span></td><td style="width:80%"><label for="f9"><input id="f9" type="radio" name="cate_is_open" value="1" style="margin:0 5px;border:0" />是</label><label for="f10"><input id="f10" type="radio" value="0" name="cate_is_open" style="margin:0 5px; border:0" checked="checked"/>否</label></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">生成html:</td><td style="width:80%"><label for="f11"><input id="f11" type="radio" name="cate_html" value="1" style="margin:0 5px;border:0" <?php if(!$_confing['web_html'][0]){echo "disabled=\"disabled\" checked=\"checked\"";}else{ echo"checked=\"checked\"";}?>/>是</label><label for="f12"><input id="f12" type="radio" value="0" name="cate_html" style="margin:0 5px;border:0" <?php if(!$_confing['web_html'][0]){echo "disabled=\"disabled\" ";}else{}?>/>否</label>&nbsp;&nbsp;<?php if(!$_confing['web_html'][0]){echo "<span style=\"color:red\">生成html先到'站点设置'中开启该语言的'生成html'功能</span>";}else{}?></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center"><span title="只能为字母、数字或_-组合" class="help">自定义内容url:</span></td><td style="width:80%">
		  <input type="text" name="custom_url" style="width:20%" title="生成内容html使用"/>为空使用默认,可定义该栏目下的内容生成html格式,格式为‘url-id.html’,单个内容的url定义在添加内容中设置
		  </td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">列表页显示数量:</td><td style="width:80%"><input type="text" name="list_num" style="width:20%" value="20"/>仅对列表页起作用</td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center"><span title="列表页使用的模板" class="help">列表页模板:</span></td><td style="width:80%"><input type="text" id="list_tpl" name="cate_tpl_list" style="width:80%" value="list_order.html"/></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center"><span title="内容页面使用的模板" class="help">内容页模板:</span></td><td style="width:80%"><input type="text" id="content_tpl" name="cate_tpl_content" style="width:80%" value="order_content.html"/></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">栏目标题(SEO):</td><td style="width:80%"><input type="text" name="cate_title_seo" style="width:80%" value=""/></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">栏目关键字(SEO):</td><td style="width:80%"><input type="text" name="cate_key_seo" style="width:80%" value=""/></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">栏目描述(SEO):</td><td style="width:80%"><textarea name="cate_info_seo" style="width:80%; height:50px"></textarea></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">栏目图片1:</td><td style="width:80%"><input name="cate_pic1" value="" style="width:30%; display:block; float:left; margin-top:55px;" id="thumb" />
		 <p style="margin-top:55px;" class="admin_up_pic"><a href="#" id="cate_pic1_btn">上传图片</a></p><span id="show_thumb" class="admin_show_pic"><a href="#" id="cate_pic1_btn1"><img src="../upload/no_pc.gif"  height="120" width="120"/></a></span>
		  </td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">栏目图片2:</td><td style="width:80%"><input name="cate_pic2" value="" style="width:30%; display:block; float:left; margin-top:55px;" id="pic2" />
		   <p style="margin-top:55px;" class="admin_up_pic"><a href="#" id="cate_pic2_btn">上传图片</a></p><span id="show_pic2" class="admin_show_pic"><a href="#" id="cate_pic2_btn1"><img src="../upload/no_pc.gif"  height="120" width="120"/></a></span>
		  </td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">栏目图片3:</td><td style="width:80%"><input name="cate_pic3" value="" style="width:30%; display:block; float:left; margin-top:55px;" id="pic3" />
		  <p style="margin-top:55px;" class="admin_up_pic"><a href="#" id="cate_pic3_btn">上传图片</a></p><span id="show_pic3" class="admin_show_pic"><a href="#" id="cate_pic3_btn1"><img src="../upload/no_pc.gif"  height="120" width="120"/></a></span>
		  </td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">栏目简介:</td><td style="width:80%"> <?php
		 echo $GLOBALS['CKEditor']->editor("cate_content", '',$fck_config);
		 ?></td>
		</tr>
		</tbody>
	
 </table>
 </div>
 </div>
 </div>
<div class="order_btn">
<input type="hidden" name="action" value="add"/><input type="hidden" name="lang" value="<?php echo $lang;?>"/>
  <input type="submit" value="确定" name="add_category" class="go"/><input type="reset" class="go" value="重置" name="reset"/>(无法提交请检查是否有遗漏或填写错误)
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
$('#cate_pic1_btn').wBox({title:'栏目图片',requestType: "iframe",target:"admin_pic_upload.php?type=radio&get=thumb",iframeWH:{width:800,height:400}});
$('#cate_pic1_btn1').wBox({title:'栏目图片',requestType: "iframe",target:"admin_pic_upload.php?type=radio&get=thumb",iframeWH:{width:800,height:400}});
$('#cate_pic2_btn').wBox({title:'栏目图片',requestType: "iframe",target:"admin_pic_upload.php?type=radio&get=pic2",iframeWH:{width:800,height:400}});
$('#cate_pic2_btn1').wBox({title:'栏目图片',requestType: "iframe",target:"admin_pic_upload.php?type=radio&get=pic2",iframeWH:{width:800,height:400}});
$('#cate_pic3_btn').wBox({title:'栏目图片',requestType: "iframe",target:"admin_pic_upload.php?type=radio&get=pic3",iframeWH:{width:800,height:400}});
$('#cate_pic3_btn1').wBox({title:'栏目图片',requestType: "iframe",target:"admin_pic_upload.php?type=radio&get=pic3",iframeWH:{width:800,height:400}});
</script>
</body>
</html>
