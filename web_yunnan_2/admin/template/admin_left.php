<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理栏目</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('h2').click(function(){
		$rel=$(this).attr('rel');
		$('ul').slideUp('fast');
		$('#'+$rel).slideDown('fast');
	});
});
</script>
<style type="text/css">
body{background:#a8d0f2}
</style>
</head>

<body>
<div class="left_contain">
 <div class="left_top">
 	<p><a href="admin_main.php" target="main" style="padding-right:8px; color:#FFFFFF">系统首页</a><a href="../index.php" target="_blank" style="padding-right:8px; color:#FFFFFF">网站主页</a></p>
 </div>
 <h2 rel="id1_ul"><p><span>网站设置</span></p></h2>
 <ul id="id1_ul" style="display:none">
  <li><a href="admin_info.php" target="main" title="添加修改网站主页、网站标题、主关键字、网站描述、网站模板和页脚信息的基本配置">站点设置</a></li>
  <li><a href="admin_sys.php" target="main" title="对上传图片及其水印、上传文件、会员注册以及内容显示的一些设置">系统设置</a></li>
  <li><a href="admin_lang.php" target="main" title="添加或删除网站的语言，对语言包进行管理，每种语言对应改语言的数据，删除语言会删除当前语言的数据">语言设置</a></li>
  <li><a href="admin_index.php" target="main" title="通过网址访问你的网站时进入的页面，可以设置哪种语言或开启flash引导页">首页设置</a></li>
  <li><a href="admin_market.php" target="main" title="添加和管理QQ、阿里旺旺、手机等联系方式">电话/客服</a></li>
  <li><a href="admin_keywords.php" target="main" title="设置的关键词在内容中出现时会自动加上对应关键词的网址">关键词设置</a></li>
  <li><a href="admin_flash_ad.php" target="main" title="导航下面的flash滚动图片的管理">首页主广告管理</a></li>
  <li><a href="admin_flash_ad_info.php" target="main" title="导航下面的flash显示修改">首页主广告设置</a></li>
  <li><a href="admin_info_cache.php?step=lang" target="main" title="一般不用更新，网站升级转移过程中缓存文件丢失可以通过更新生成">更新配置缓存</a></li>
 </ul>
 <h2 rel="id2_ul"><p><span>内容管理</span></p></h2>
 <ul id="id2_ul" >
  <li><a href="admin_catagory.php" target="main" title="网站栏目的添加管理，要先添加栏目才能添加内容，不同模型的栏目添加不同的内容，显示内容的模板在‘高级设置’中修改">栏目管理</a></li>
  <li><a href="admin_content.php?action=add" target="main" title="添加网站的内容，不同的模型会读取不同的栏目">添加内容</a></li>
  <li><a href="admin_content_alone.php" target="main" title="添加单独的页面，如关于我们等单页面内容，需要先添加单页模型的栏目">添加单页内容</a></li>
  <li><a href="admin_content_tag.php" target="main" title="添加一些片段内容，如首页公司简介、联系方式等，片段内容可以全站使用，通过标识调用，片段内容不分语言，不同的语言要添加不同的内容调用">添加片段内容</a></li>
  <li><a href="admin_content.php?action=content_list" target="main" title="新闻、产品、招聘、下载以及自定义模型的内容管理">内容管理</a></li>
  <li><a href="admin_content_alone.php?action=content_list" target="main" title="使用单页模型的内容管理">单页内容管理</a></li>
  <li><a href="admin_content_tag.php?action=content_list" target="main" title="首页公司简介、联系方式等片段内容的管理">片段内容管理</a></li>
  <li><a href="admin_pic.php" target="main" title="产品图片及其内容缩略图的管理">上传图片管理</a></li>
  <li><a href="admin_file.php" target="main" title="编辑器上传图片、远程图片及其它上传附件的管理">上传附件管理</a></li>
 </ul>
 <h2 rel="id3_ul"><p><span>模型管理</span></p></h2>
 <ul id="id3_ul" style="display:none">
  <li><a href="admin_channel.php?action=add&lang=cn" target="main" title="添加自定义的内容模型">添加模型</a></li>
  <li><a href="admin_channel.php" target="main" title="管理现有和已经添加的内容模型，删除模型会删除模型中的数据">管理模型</a></li>
  <li><a href="admin_channel.php?action=cache" target="main">更新模型缓存</a></li>
 </ul>
 <h2 rel="id4_ul"><p><span>用户管理</span></p></h2>
 <ul id="id4_ul" style="display:none">
  <li><a href="admin_admin.php" target="main" title="对后台管理员增加和管理">管理员管理</a></li>
  <li><a href="admin_admin.php?action=admin_group" target="main" title="根据需要设置不同管理员的权限">管理员分组</a></li>
  <li><a href="admin_member.php" target="main" title="注册和后台添加的会员管理">会员管理</a></li>
  <li><a href="admin_member.php?action=member_group" target="main" title="设置会员的权限">会员分组</a></li>
 </ul>
 <h2 rel="id5_ul"><p><span>模板生成管理</span></p></h2>
 <ul id="id5_ul" style="display:none">
 <li><a href="admin_template_out.php" target="main" title="模板中使用了输出设置标签可以在这里设置输出的内容，不用到模板中修改">输出配置</a></li>
  <li><a href="admin_template.php" target="main" title="可以对模板在线修改，一般用于修改小部分问题，如修改栏目ID及其一些文字等">模板管理</a></li>
  <li><a href="admin_htm.php" target="main">生成首页</a></li>
  <li><a href="admin_htm.php?action=cate" target="main">生成栏目页</a></li>
  <li><a href="admin_htm.php?action=content" target="main">生成内容页</a></li>
  <li><a href="admin_htm.php?action=alone" target="main">生成单页内容</a></li>
  <li><a href="admin_htm.php?action=map" target="main">生成网站地图</a></li>
 </ul>
 <h2 rel="id6_ul"><p><span>表单管理</span></p></h2>
 <ul id="id6_ul" style="display:none">
  <li><a href="admin_form.php?action=add" target="main" title="新增加表单">添加表单模型</a></li>
  <li><a href="admin_form.php" target="main" title="对现有表单及其增加的表单管理">管理表单模型</a></li>
  <li><a href="admin_form.php?action=form_list" target="main" title="管理通过表单反馈回来的用户信息">管理表单</a></li>
 </ul>
 <h2 rel="id7_ul"><p><span>咨询管理</span></p></h2>
 <ul id="id7_ul" style="display:none">
  <li><a href="admin_ask.php" target="main" title="管理会员咨询内容">咨询管理</a></li>
 </ul>
 <h2 rel="id8_ul"><p><span>友情链接</span></p></h2>
 <ul id="id8_ul" style="display:none">
  <li><a href="admin_link.php?action=add" target="main">添加链接</a></li>
  <li><a href="admin_link.php?action=link_list" target="main">管理链接</a></li>
 </ul>
 <h2 rel="id9_ul"><p><span>数据管理</span></p></h2>
 <ul id="id9_ul" style="display:none">
  <li><a href="admin_db.php" target="main">备份数据</a></li>
  <li><a href="admin_db.php?action=import" target="main">恢复数据</a></li>
 </ul>
 <h2 rel="id10_ul"><p><span>留言管理</span></p></h2>
 <ul id="id10_ul" style="display:none">
  <li><a href="admin_book.php?action=made" target="main" title="设置留言本显示及其审核">设置</a></li>
  <li><a href="admin_book.php" target="main" title="对留言进行管理">管理留言</a></li>
 </ul>
 <div class="left_top" style="height:100px;border-bottom:1px solid #aaa;">
 	
 </div>
</div>
</body>
</html>
