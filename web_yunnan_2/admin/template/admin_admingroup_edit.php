<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员分组</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	if($('#c_all').attr('checked')){
		$('tbody#purview').find("input[type='checkbox']").attr({'disabled':'disabled','checked':'checked'});
	}
	$('#bs').blur(function(){
		//$('#table').val($(this).val());
	});
	$('tbody').find('tr').hover(function(){
		//$(this).css('background','#ccc');
	},function(){
		$(this).css('background','none');
	});
	$('#c_all').click(function(){
		$is_ck=$(this).attr('checked');
		if($is_ck){
			$('tbody#purview').find("input[type='checkbox']").attr({'disabled':'disabled','checked':'checked'});
		}else{
			$('tbody#purview').find("input[type='checkbox']").attr({'disabled':'','checked':''});
		}
	});
});
function all_sl(str){
		$ck=$('#'+str).attr('checked');
		if($ck){
			$('td#'+str).find('input').attr('checked','checked');
		}else{
			$('td#'+str).find('input').attr('checked','');
		}
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
		<span>修改管理员分组</span>
			<div class="admin_fh"><a href="?action=admin_group&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>">返回</a></div>
		</div><!--位置-->
		
	<!--内容区-->	

<div class="order_contain">
<form name="maininfo" method="post" enctype="multipart/form-data" action="admin_admin.php?nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>" class="form">
 <div class="order_main">
 <table cellpadding="0" cellspacing="0" width="100%">
 	<thead>
		<tr><th style="width:15%">参数说明</th><th style="width:85%">参数值</th></tr>
	</thead>
	<tbody>
	
		<tr>
		  <td style="width:15%;text-align:center" class="w1"><span title="不可重复" class="help">管理组名称：</span></td><td style="width:85%"><input name="admin_group_name" value="<?php echo $arr['admin_group_name'];?>" style="width:30%" /></td>
		</tr>
		<tr>
		  <td style="width:15%; text-align:center" class="w1">管理组描述：<p style="color:#999999; font-weight:normal"></p></td><td style="width:85%"><textarea name="admin_group_info" style="width:50%; height:50px;"><?php echo $arr['admin_group_info'];?></textarea></td>
		</tr>
		<tr>
		  <td style="width:15%; text-align:center" class="w1">可进行任意操作：<input type="checkbox"  style="border:0" value="all_purview" name="c_all" id="c_all" <?php if(in_array('all_purview',$p)){?>checked="checked"<?php }?> /><p style="color:#999999; font-weight:normal"></p></td><td style="width:85%">勾选任意操作下面的就可以不勾选</td>
		</tr>
		</tbody>
<tbody id="purview">		
		<tr>
		  <td style="width:15%;text-align:center" class="w1">网站配置：<input type="checkbox" value="1" style="border:0" name="all" id="all_1" onclick="all_sl('all_1');" /><p style="color:#999999; font-weight:normal"></p></td><td style="width:85%" id="all_1"><input type="checkbox" value="web_info" <?php if(in_array('web_info',$p)){?>checked="checked"<?php }?> name="q[]"  style="margin:0 5px;border:0; margin-left:8px;"/>站点设置<span style="color:#666666">web_info</span><input type="checkbox" value="sys_info" <?php if(in_array('sys_info',$p)){?>checked="checked"<?php }?> name="q[]"  style="margin:0 5px; margin-left:8px;border:0"/>系统设置<span style="color:#666666">safe_info</span><input type="checkbox" value="index_info" <?php if(in_array('index_info',$p)){?>checked="checked"<?php }?> name="q[]"  style="margin:0 5px; margin-left:8px;border:0"/>首页配置<span style="color:#666666">index_info</span></td>
		</tr>
		<tr>
		  <td style="width:15%;text-align:center" class="w1">语言管理：<input type="checkbox" value="1" style="border:0" name="all_10" id="all_10" onclick="all_sl('all_10');" /><p style="color:#999999; font-weight:normal"></p></td><td style="width:85%" id="all_10"><input type="checkbox" value="lang_add" <?php if(in_array('lang_add',$p)){?>checked="checked"<?php }?> name="q[]"  style="margin:0 5px;border:0; margin-left:8px;"/>添加语言<span style="color:#666666">lang_add</span><input type="checkbox" value="lang_edit" <?php if(in_array('lang_edit',$p)){?>checked="checked"<?php }?> name="q[]"  style="margin:0 5px; margin-left:8px;border:0"/>修改语言<span style="color:#666666">lang_edit</span><input type="checkbox" value="lang_del" <?php if(in_array('lang_del',$p)){?>checked="checked"<?php }?> name="q[]"  style="margin:0 5px; margin-left:8px;border:0"/>删除语言<span style="color:#666666">lang_del</span><input type="checkbox" value="lang_lang" <?php if(in_array('lang_lang',$p)){?>checked="checked"<?php }?> name="q[]"  style="margin:0 5px; margin-left:8px;border:0"/>语言包管理<span style="color:#666666">lang_lang</span></td>
		</tr>
		<tr>
		  <td style="width:15%;text-align:center" class="w1">内容模型管理：<input type="checkbox" value="" style="border:0" name="all_2" id="all_2" onclick="all_sl('all_2');" /><p style="color:#999999; font-weight:normal"></p></td><td style="width:85%" id="all_2"><input type="checkbox" value="pannel_create" <?php if(in_array('pannel_create',$p)){?>checked="checked"<?php }?> name="q[]"  style="margin:0 5px; margin-left:8px;border:0"/>创建内容模型<span style="color:#666666">pannel_create</span><input type="checkbox" value="pannel_del" <?php if(in_array('pannel_del',$p)){?>checked="checked"<?php }?> name="q[]"  style="margin:0 5px; margin-left:8px;border:0"/>删除内容模型<span style="color:#666666">pannel_del</span><input type="checkbox" value="pannel_edit" <?php if(in_array('pannel_edit',$p)){?>checked="checked"<?php }?> name="q[]"  style="margin:0 5px; margin-left:8px;border:0"/>修改内容模型<span style="color:#666666">pannel_edit</span><input type="checkbox" value="field_create" name="q[]" <?php if(in_array('field_create',$p)){?>checked="checked"<?php }?>  style="margin:0 5px; margin-left:8px;border:0"/>创建字段<span style="color:#666666">filed_create</span><input type="checkbox" value="field_edit" <?php if(in_array('field_edit',$p)){?>checked="checked"<?php }?> name="q[]"  style="margin:0 5px; margin-left:8px;border:0"/>修改字段<span style="color:#666666">filed_edit</span><input type="checkbox" value="field_del" <?php if(in_array('field_del',$p)){?>checked="checked"<?php }?> name="q[]"  style="margin:0 5px; margin-left:8px;border:0"/>删除字段<span style="color:#666666">filed_del</span></td>
		</tr>
		<tr>
		  <td style="width:15%; text-align:center" class="w1">内容操作：<input type="checkbox" value="" style="border:0" name="all_3" id="all_3" onclick="all_sl('all_3');" /><p style="color:#999999; font-weight:normal"></p></td><td style="width:85%" id="all_3"><input type="checkbox" value="cate_create" name="q[]"  <?php if(in_array('cate_create',$p)){?>checked="checked"<?php }?> style="margin:0 5px; margin-left:8px;border:0"/>创建栏目<span style="color:#666666">cate_create</span><input type="checkbox" value="cate_edit" <?php if(in_array('cate_edit',$p)){?>checked="checked"<?php }?>  name="q[]"  style="margin:0 5px; margin-left:8px;border:0"/>修改栏目<span style="color:#666666">cate_edit</span><input type="checkbox" value="cate_del" <?php if(in_array('cate_del',$p)){?>checked="checked"<?php }?> name="q[]"  style="margin:0 5px; margin-left:8px;border:0"/>删除栏目<span style="color:#666666">cate_del</span><input type="checkbox" value="cate_move" <?php if(in_array('cate_move',$p)){?>checked="checked"<?php }?> name="q[]"  style="margin:0 5px; margin-left:8px;border:0"/>移动栏目<span style="color:#666666">cate_move</span><input type="checkbox" value="content_create" <?php if(in_array('content_create',$p)){?>checked="checked"<?php }?> name="q[]"  style="margin:0 5px; margin-left:8px;border:0"/>发布内容<span style="color:#666666">content_create</span><input type="checkbox" value="content_edit" <?php if(in_array('content_edit',$p)){?>checked="checked"<?php }?> name="q[]"  style="margin:0 5px; margin-left:8px;border:0"/>修改内容<span style="color:#666666">content_edit</span><input type="checkbox" value="content_del" <?php if(in_array('content_del',$p)){?>checked="checked"<?php }?> name="q[]"  style="margin:0 5px; margin-left:8px;border:0"/>删除内容<span style="color:#666666">content_del</span><input type="checkbox" value="content_verify" <?php if(in_array('content_verify',$p)){?>checked="checked"<?php }?> name="q[]"  style="margin:0 5px; margin-left:8px;border:0"/>审核内容<span style="color:#666666">content_verify</span><input type="checkbox" value="file_manage" name="q[]" <?php if(in_array('file_manage',$p)){?>checked="checked"<?php }?>  style="margin:0 5px; margin-left:8px;border:0"/>上传附件管理<span style="color:#666666">file_manage</span></td>
		</tr>
		<tr>
		  <td style="width:15%;text-align:center" class="w1">模板管理:<input type="checkbox" value="" style="border:0" name="all_4" id="all_4" onclick="all_sl('all_4');" /><p style="color:#999999; font-weight:normal"></p></td><td style="width:85%" id="all_4"><input type="checkbox" value="tpl_manage" <?php if(in_array('tpl_manage',$p)){?>checked="checked"<?php }?> name="q[]"  style="margin:0 5px; margin-left:8px;border:0"/>模板管理<span style="color:#666666">tpl_manage</span></td>
		</tr>
		<tr>
		  <td style="width:15%; text-align:center" class="w1">会员管理:<input type="checkbox" value="" style="border:0" name="all_5" id="all_5" onclick="all_sl('all_5');" /><p style="color:#999999; font-weight:normal"></p></td><td style="width:85%" id="all_5"><input type="checkbox" value="user_group" <?php if(in_array('user_group',$p)){?>checked="checked"<?php }?> name="q[]"  style="margin:0 5px; margin-left:8px;border:0"/>管理会员组<span style="color:#666666">user_group</span><input type="checkbox" value="user_manage"  <?php if(in_array('user_manage',$p)){?>checked="checked"<?php }?> name="q[]"  style="margin:0 5px; margin-left:8px;border:0"/>管理会员<span style="color:#666666">user_manage</span><input type="checkbox" value="admin_group"  <?php if(in_array('admin_group',$p)){?>checked="checked"<?php }?> name="q[]"  style="margin:0 5px; margin-left:8px;border:0"/>管理管理员组<span style="color:#666666">admin_group</span><input type="checkbox" value="admin_manage"  <?php if(in_array('admin_manage',$p)){?>checked="checked"<?php }?> name="q[]"  style="margin:0 5px; margin-left:8px;border:0"/>管理管理员<span style="color:#666666">admin_manage</span></td>
		</tr>
		<tr>
		  <td style="width:15%;text-align:center" class="w1">表单管理：<input type="checkbox" value="" style="border:0" name="all_6" id="all_6" onclick="all_sl('all_6');" /><p style="color:#999999; font-weight:normal"></p></td><td style="width:85%" id="all_6"><input type="checkbox" value="form_create" <?php if(in_array('form_create',$p)){?>checked="checked"<?php }?> name="q[]"  style="margin:0 5px; margin-left:8px;border:0"/>创建表单模型<span style="color:#666666">form_create</span><input type="checkbox" value="form_del" name="q[]" <?php if(in_array('form_del',$p)){?>checked="checked"<?php }?>  style="margin:0 5px; margin-left:8px;border:0"/>删除表单模型<span style="color:#666666">form_del</span><input type="checkbox" value="form_edit" <?php if(in_array('form_edit',$p)){?>checked="checked"<?php }?> name="q[]"  style="margin:0 5px; margin-left:8px;border:0"/>修改表单模型<span style="color:#666666">form_edit</span><input type="checkbox" value="form_field_create" name="q[]" <?php if(in_array('form_field_create',$p)){?>checked="checked"<?php }?>  style="margin:0 5px; margin-left:8px;border:0"/>创建表单字段<span style="color:#666666">form_filed_create</span><input type="checkbox" value="form_field_edit" <?php if(in_array('form_field_edit',$p)){?>checked="checked"<?php }?> name="q[]"  style="margin:0 5px; margin-left:8px;border:0"/>修改表单字段<span style="color:#666666">form_filed_edit</span><input type="checkbox" value="form_field_del" name="q[]" <?php if(in_array('form_field_del',$p)){?>checked="checked"<?php }?>  style="margin:0 5px; margin-left:8px;border:0"/>删除表单字段<span style="color:#666666">form_filed_del</span><input type="checkbox" value="form_list" <?php if(in_array('form_list',$p)){?>checked="checked"<?php }?> name="q[]"  style="margin:0 5px; margin-left:8px;border:0"/>管理表单反馈<span style="color:#666666">form_list</span></td>
		</tr>
		<tr>
		  <td style="width:15%;text-align:center" class="w1">咨询管理:<input type="checkbox" value="" style="border:0" name="all_7" id="all_7" onclick="all_sl('all_7');" /><p style="color:#999999; font-weight:normal"></p></td><td style="width:85%" id="all_7"><input type="checkbox" value="user_ask" <?php if(in_array('user_ask',$p)){?>checked="checked"<?php }?> name="q[]"  style="margin:0 5px; margin-left:8px;border:0"/>咨询管理<span style="color:#666666">user_ask</span></td>
		</tr>
		<tr>
		  <td style="width:15%;text-align:center" class="w1">友情链接管理:<input type="checkbox" value="" style="border:0" name="all_8" id="all_8" onclick="all_sl('all_8');" /><p style="color:#999999; font-weight:normal"></p></td><td style="width:85%" id="all_8"><input type="checkbox" value="link_add" <?php if(in_array('link_add',$p)){?>checked="checked"<?php }?> name="q[]"  style="margin:0 5px; margin-left:8px;border:0"/>添加友情链接<span style="color:#666666">link_add</span><input type="checkbox" value="link_edit" name="q[]" <?php if(in_array('link_edit',$p)){?>checked="checked"<?php }?>  style="margin:0 5px; margin-left:8px;border:0"/>修改友情链接<span style="color:#666666">link_edit</span><input type="checkbox" value="link_del" <?php if(in_array('link_del',$p)){?>checked="checked"<?php }?> name="q[]"  style="margin:0 5px; margin-left:8px;border:0"/>删除友情链接<span style="color:#666666">link_del</span></td>
		</tr>
		<tr>
		  <td style="width:15%;text-align:center" class="w1">数据管理:<input type="checkbox" value="" style="border:0" name="all_9" id="all_9" onclick="all_sl('all_9');" /><p style="color:#999999; font-weight:normal"></p></td><td style="width:85%" id="all_9"><input type="checkbox" value="data_backup" <?php if(in_array('data_backup',$p)){?>checked="checked"<?php }?> name="q[]"  style="margin:0 5px; margin-left:8px;border:0"/>数据备份<span style="color:#666666">data_backup</span><input type="checkbox" value="data_import" name="q[]" <?php if(in_array('data_import',$p)){?>checked="checked"<?php }?>  style="margin:0 5px; margin-left:8px;border:0"/>数据还原<span style="color:#666666">data_import</span></td>
		</tr>
		<tr>
		  <td style="width:15%; text-align:center" class="w1">是否禁用：<p style="color:#999999; font-weight:normal"></p></td><td style="width:85%"><input type="radio" name="is_disable" style="border:0" value="0" <?php if(!$arr['is_disable']){?>checked="checked"<?php }?> />开启<input style="border:0" type="radio" name="is_disable" value="1" <?php if($arr['is_disable']){?>checked="checked"<?php }?> />禁用</td>
		</tr>
		
	</tbody>
 </table>
 </div>
<div class="order_btn">
<input type="hidden" name="action" value="save_admingroup_edit"/><input type="hidden" value="<?php echo $id;?>" name="id" />
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
