<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

define('IN_CMS','true');
include('init.php');
$action=isset($_REQUEST['action'])?fl_html(fl_value($_REQUEST['action'])):'form';
$lang=isset($_REQUEST['lang'])?fl_html(fl_value($_REQUEST['lang'])):get_lang_main();

//添加表单模型界面
if($action=='add'){
	if(!check_purview('form_create')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	include('template/admin_form_ad.php');
}

//处理添加的表单模型
elseif($action=='save_form'){
	if(!check_purview('form_create')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$form_name = $_POST['form_name'];
	$form_mark = $_POST['form_mark'];
	$is_disable = intval($is_disable);
	if(empty($form_name)||empty($form_mark)){
		msg('<span style="color:red">名称或标示不能为空!</span>');
	}
	if(!check_str($form_mark,'/^\w+$/')){
		msg('<span style="color:red">频道标识只能是字母、数字或_组合</span>');
	}
	if(strlen($form_name)>60){msg('<span style="color:red">模型名称太长,请缩短</span>');}
	if(strlen($form_mark)>8){msg('<span style="color:red">模型标识超过10个字数，请缩短</span>');}
	$tables=$GLOBALS['mysql']->show_tables();
	if(in_array(DB_PRE.$form_mark,$tables)){
		msg('<span style="color:red">数据表'.$form_mark.'已经存在,请更改标示</span>');
	}
	$sql="insert into ".DB_PRE."form (form_name,form_mark,is_disable) values ('{$form_name}','{$form_mark}',{$is_disable})";
	$GLOBALS['mysql']->query($sql);
	//附加表
	$table=$form_mark;
	$field="id mediumint(8) not null,primary key (id)";
	$GLOBALS['mysql']->create_tb($table,$field);
	//更新缓存
	if(!is_dir(DATA_PATH.'cache_form')){
		@mkdir(DATA_PATH.'cache_form',0777);
	}
	$form_file=DATA_PATH.'cache_form/form.php';
	$rel=$GLOBALS['mysql']->fetch_asc("select*from ".DB_PRE."form order by id desc");
	$cache_str="<?php\n\$form=".var_export($rel,true).";\n?>";
	cache_write($form_file,$cache_str);
	msg("【{$form_name}】表单模型添加完成",'?nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}


//表单模型列表
elseif($action=='form'){
	if(file_exists(DATA_PATH.'cache_form/form.php')){include(DATA_PATH.'cache_form/form.php');}
	include('template/admin_form.php');
}

//表单模型修改界面
elseif($action=='form_xg'){
	if(!check_purview('form_edit')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$id = intval($_GET['id']);
	if(empty($id)){
		msg('<span style="color:red">参数传递错误,不存在该表单模型</span>');
	}
	if(file_exists(DATA_PATH.'cache_form/form.php')){
		include(DATA_PATH.'cache_form/form.php');
	}
	if(empty($form)){msg('<span style="color:red">请先更新缓存</span>');}
	foreach($form as $k=>$v){
		if($id==$v['id']){$rel=$v; break;}
	}
	include('template/admin_form_xg.php');
}

//处理修改的表单模型
elseif($action=='save_xg_form'){
	if(!check_purview('form_edit')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$form_name = $_POST['form_name'];
	$is_disable = intval($_POST['is_disable']);
	$id = intval($_POST['id']);
	$submit = $_POST['submit'];
	if(empty($submit)||empty($id)){msg('<span style="color:red">请从表单提交</span>');}
	if(empty($form_name)){msg("名称不能为空");}
	if(strlen($form_name)>60){msg('<span style="color:red">模型名称太长,请缩短</span>');}
	$sql="update ".DB_PRE."form set form_name='{$form_name}',is_disable={$is_disable} where id={$id}";
	$GLOBALS['mysql']->query($sql);
	//更新缓存
	$form_file=DATA_PATH.'cache_form/form.php';
	$rel=$GLOBALS['mysql']->fetch_asc("select*from ".DB_PRE."form order by id desc");
	$cache_str="<?php\n\$form=".var_export($rel,true).";\n?>";
	cache_write($form_file,$cache_str);
	msg("【{$form_name}】表单模型修改成功",'?nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}

//删除表单模型
elseif($action=='del_form'){
	if(!check_purview('form_del')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$id = intval($_GET['id']);
	if(empty($id)){msg('<span style="color:red">参数发生错误，请重新操作</span>');}
	if(file_exists(DATA_PATH.'cache_form/form.php')){include(DATA_PATH.'cache_form/form.php');}
	if(!empty($form)){
		foreach($form as $k=>$v){
			if($v['id']==$id){
				$form_table=$v['form_mark'];
				$form_name=$v['form_name'];
			}
		}
	}
	$tables=$GLOBALS['mysql']->show_tables();
	if(in_array(DB_PRE.$form_table,$tables)){
	if($GLOBALS['mysql']->fetch_rows("select id from ".DB_PRE."{$form_table}")){
		msg('<span style="color:red">请先删除【'.$form_name.'】表单模型下的信息</span>');
	}
	}
	if(file_exists(DATA_PATH.'cache_form/field.php')){include(DATA_PATH.'cache_form/field.php');}
	if(!empty($field)){
		foreach($field as $k=>$v){
			if($v['form_id']==$id){
				msg('<span style="color:red">请先删除【'.$form_name.'】表单模型下的字段</span>');
			}
		}
	}
	
	//删除表
	if(in_array(DB_PRE.$form_table,$tables)){
	$GLOBALS['mysql']->drop_table($form_table);
	}
	$sql="delete from ".DB_PRE."form where id={$id}";
	$GLOBALS['mysql']->query($sql);
	//更新缓存
	$form_file=DATA_PATH.'cache_form/form.php';
	$rel=$GLOBALS['mysql']->fetch_asc("select*from ".DB_PRE."form order by id desc");
	$cache_str="<?php\n\$form=".var_export($rel,true).";\n?>";
	cache_write($form_file,$cache_str);
	msg('表单模型删除成功','?nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}

//表单模型缓存
elseif($action=='cache'){
	if(!is_dir(DATA_PATH.'cache_form')){
		@mkdir(DATA_PATH.'cache_form',0777);
	}
	$form_file=DATA_PATH.'cache_form/form.php';
	$rel=$GLOBALS['mysql']->fetch_asc("select*from ".DB_PRE."form order by id desc");
	$cache_str="<?php\n\$form=".var_export($rel,true).";\n?>";
	cache_write($form_file,$cache_str,'表单模型缓存');
	unset($rel);
	//更新字段
	$rel=$GLOBALS['mysql']->fetch_asc("select*from ".DB_PRE."formfield order by form_order asc");
	$cache_str="<?php\n\$field=".var_export($rel,true).";\n?>";
	cache_write(DATA_PATH.'cache_form/field.php',$cache_str);
	unset($rel);
	msg('表单模型缓存成功','?');
}

//表单模型字段列表
elseif($action=='fields'){
	$id = intval($_GET['id']);
	if(file_exists(DATA_PATH.'cache_form/field.php')){include(DATA_PATH.'cache_form/field.php');}
	include('template/admin_form_field.php');
}

//添加表单模型字段
elseif($action=='add_field'){
	if(!check_purview('form_field_create')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
 	$id = intval($_GET['id']);
	include('template/admin_form_field_add.php');
}

//处理添加的字段
elseif($action=='save_field'){
	if(!check_purview('form_field_create')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$use_name = $_POST['use_name'];
	$field_name = $_POST['field_name'];
	$field_type = $_POST['field_type'];
	$field_value = $_POST['field_value'];
	$field_length = intval($_POST['field_length']);
	$field_info = $_POST['field_info'];
	$form_order = intval($_POST['form_order']);
	$is_empty = intval($_POST['is_empty']);
	$is_disable = intval($_POST['is_disable']);
	$id = intval($_POST['id']);
	if(empty($use_name)||empty($field_name)){msg('<span style="color:red">提示文字或字段名称不能为空</span>');}
	if(strlen($use_name)>60){msg('<span style="color:red">提示文字长度太长,请缩短</span>');}
	if(strlen($field_name)>15){msg('<span style="color:red">字段名称不能超过15个字符,请缩短</span>');}
	if(strlen($field_value)>200){msg('<span style="color:red">字段类型太长,请缩短</span>');}
	if(strlen($field_info)>200){msg('<span style="color:red">字段说明太长,请缩短</span>');}
	if(strlen($form_order)>200){msg('<span style="color:red">字段排序字数太长,请缩短</span>');}
	if($GLOBALS['mysql']->fetch_rows('select id from '.DB_PRE."formfield where field_name='".$field_name."' and form_id=".$id." order by id desc")){
		msg($field_name.'<span style="color:red">字段名已经存在,请使用其它字段名</span>');
	}
	//添加表字段
	if(file_exists(DATA_PATH.'cache_form/form.php')){include(DATA_PATH.'cache_form/form.php');}
	if(!empty($form)){
		foreach($form as $k=>$v){
			if($v['id']==$id){
				$form_table=$v['form_mark'];
			}
		}
	}
	
	$field_length=255;
	$type="varchar(".$field_length.")";
	$GLOBALS['mysql']->add_field($form_table,$field_name." ".$type);
	
	$sql="insert into ".DB_PRE."formfield (field_name,use_name,field_type,field_value,field_length,form_id,field_info,is_disable,form_order,is_empty) values ('{$field_name}','{$use_name}','{$field_type}','{$field_value}',{$field_length},{$id},'{$field_info}',$is_disable,$form_order,$is_empty)";
	$GLOBALS['mysql']->query($sql);
	//更新缓存
	if(!is_dir(DATA_PATH.'cache_form')){@mkdir(DATA_PATH.'cache_form',0777);}
	$rel=$GLOBALS['mysql']->fetch_asc("select*from ".DB_PRE."formfield order by form_order asc");
	$cache_str="<?php\n\$field=".var_export($rel,true).";\n?>";
	cache_write(DATA_PATH.'cache_form/field.php',$cache_str);
	msg("【{$use_name}】字段添加完成",'?action=fields&id='.$id.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}


//修改字段界面
elseif($action=='xg_field'){
	if(!check_purview('form_field_edit')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$id = intval($_GET['id']);
	if(!isset($id)||empty($id)){
		msg('<span style="color:red">参数传递错误，请重新操作</span>','?');
	}
	if(file_exists(DATA_PATH."cache_form/field.php")){
		include(DATA_PATH.'cache_form/field.php');
	}
	if(!empty($field)){
		foreach($field as $k=>$v){
			if($v['id']==$id){
				$arr[0]=$v;
			}
		}
	}
	include('template/admin_form_field_xg.php');
}


//处理修改的字段
elseif($action=='save_xg_field'){
	if(!check_purview('form_field_edit')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$use_name = $_POST['use_name'];
	$field_type = $_POST['field_type'];
	$field_value = $_POST['field_value'];
	$field_length = intval($_POST['field_length']);
	$field_info = $_POST['field_info'];
	$form_order = intval($_POST['form_order']);
	$is_empty = intval($_POST['is_empty']);
	$is_disable = intval($_POST['is_disable']);
	$id = intval($_POST['id']);
	$form_id = intval($_POST['form_id']);
	$field = $_POST['field'];
	$submit = $_POST['submit'];
	if(!isset($submit)){
		msg('<span style="color:red">请从表单提交</span>');
	}
	if(!isset($id)||empty($id)){
		msg('<span style="color:red">参数传递错误</span>','?');
	}
	if(empty($use_name)){
		msg('<span style="color:red">字段提示文字不能为空</span>');
	}
	if(strlen($use_name)>60){msg('<span style="color:red">提示文字长度太长,请缩短</span>');}
	if(strlen($field_value)>200){msg('<span style="color:red">字段类型太长,请缩短</span>');}
	if(strlen($field_info)>200){msg('<span style="color:red">字段说明太长,请缩短</span>');}
	if(strlen($form_order)>200){msg('<span style="color:red">字段排序字数太长,请缩短</span>');}
	
	$field_length=255;
	//修改表字段
	if(file_exists(DATA_PATH.'cache_form/form.php')){include(DATA_PATH.'cache_form/form.php');}
	if(!empty($form)){
		foreach($form as $k=>$v){
			if($v['id']==$form_id){
				$form_table=$v['form_mark'];
			}
		}
	}
	$type="varchar(".$field_length.")";
	$GLOBALS['mysql']->xg_field($form_table,$field." ".$field." ".$type);
	
	$sql="update ".DB_PRE."formfield set use_name='{$use_name}',field_type='{$field_type}',field_value='{$field_value}',field_length={$field_length},field_info='{$field_info}',is_disable={$is_disable},form_order={$form_order},is_empty={$is_empty} where id={$id}";
	$GLOBALS['mysql']->query($sql);
	//更新缓存
	if(!is_dir(DATA_PATH.'cache_form')){@mkdir(DATA_PATH.'cache_form',0777);}
	$rel=$GLOBALS['mysql']->fetch_asc("select*from ".DB_PRE."formfield order by form_order asc");
	$cache_str="<?php\n\$field=".var_export($rel,true).";\n?>";
	cache_write(DATA_PATH.'cache_form/field.php',$cache_str);
	msg("【{$use_name}】字段修改成功",'?action=fields&id='.$form_id.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}

//导出字段
elseif($action == 'import'){
	if(!check_purview('form_field_del')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$form_id = intval($_GET['id']);
	if(empty($form_id)){msg('参数发生错误！请重新操作！');}
	include('template/admin_form_field_import.php');
}

//处理导出字段
elseif($action == 'save_import'){
	if(!check_purview('form_field_del')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$form_id = intval($_POST['form_id']);
	if(empty($form_id)){msg('参数发生错误！请重新操作！');}
	$sql = "select field_name,use_name,field_type,field_value,field_length,field_info,is_disable,form_order,is_empty from ".DB_PRE."formfield where form_id=".$form_id;
	$rel = $mysql->fetch_asc($sql);
	if(!empty($rel))
	{
		$arr_str="<?php\n\$field_arr = ".var_export($rel,true).";\n?>";
	}
	$file=DATA_PATH.'backup/'.'form_field_'.$form_id.'.php';
	creat_inc($file,$arr_str);
	msg('字段导出完成！请到data/backup目录下下载导出文件！','?action=form&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}

//导入字段界面
elseif($action == 'backup'){
	if(!check_purview('form_field_del')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$form_id = intval($_GET['id']);
	if(empty($form_id)){msg('参数发生错误！请重新操作！');}
	include('template/admin_form_field_backup.php');
}

//开始导入字段
elseif($action == 'save_backup'){
	if(!check_purview('form_field_del')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$form_id = intval($_POST['form_id']);
	if(empty($form_id)){msg('参数发生错误！请重新操作！'.$form_id);}
	//判断是否存在文件
	$file_name = $_POST['file_name'];
	if(empty($file_name))
	{
		msg('文件名不能为空!');
	}
	$file_path = DATA_PATH.'backup/'.$file_name.'.php';
	if(!file_exists($file_path))
	{
		msg('不存在导入文件，请检查data/backup目录下是否存在文件');
	}	
	include($file_path);
	//修改表字段
	if(file_exists(DATA_PATH.'cache_form/form.php')){include(DATA_PATH.'cache_form/form.php');}
	if(!empty($form)){
		foreach($form as $k=>$v){
			if($v['id']==$form_id){
				$table=$v['form_mark'];
			}
		}
	}
	
	//开始导入
	if(!empty($field_arr))
	{
		foreach($field_arr as $v)
		{
			$type="varchar(".$v['field_length'].")";
			$sql="select*from ".DB_PRE."{$table} limit 1";
			$check_field_arr=$GLOBALS['mysql']->fetch_field($sql);
			if(in_array($v['field_name'],$check_field_arr))
			{
				continue;
			}
			$GLOBALS['mysql']->add_field($table,$v['field_name']." ".$type);
			
			$sql="insert into ".DB_PRE."formfield (field_name,use_name,field_type,field_value,field_length,form_id,field_info,is_disable,form_order,is_empty) values ('".$v['field_name']."','".$v['use_name']."','".$v['field_type']."','".$v['field_value']."',".$v['field_length'].",".$form_id.",'".$v['field_info']."',".$v['is_disable'].",'".$v['form_order']."','".$v['is_empty']."')";
			$GLOBALS['mysql']->query($sql);
		}
	}
	
	//更新缓存
	$rel=$GLOBALS['mysql']->fetch_asc("select*from ".DB_PRE."formfield order by form_order asc");
	$cache_str="<?php\n\$field=".var_export($rel,true).";\n?>";
	cache_write(DATA_PATH.'cache_form/field.php',$cache_str);
	msg('导入完成，可以删除文件!','?action=form&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}

//删除字段
elseif($action=='del_field'){
	if(!check_purview('form_field_del')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$id = intval($_GET['id']);
	$form_id = intval($_GET['form_id']);
	if(empty($id)||empty($form_id)){msg('<span style="color:red">不存在该字段,删除失败</span>');}
	//删除表子字段
	if(file_exists(DATA_PATH.'cache_form/form.php')){include(DATA_PATH.'cache_form/form.php');}
	if(!empty($form)){
		foreach($form as $k=>$v){
			if($v['id']==$form_id){
				$form_table=$v['form_mark'];
			}
		}
	}
	if(file_exists(DATA_PATH.'cache_form/field.php')){include(DATA_PATH.'cache_form/field.php');}
	if(!empty($field)){
		foreach($field as $k=>$v){
			if($v['id']==$id){
				$field=$v['field_name'];
			}
		}
	}
	$GLOBALS['mysql']->drop_field($form_table,$field);
	
	$GLOBALS['mysql']->query("delete from ".DB_PRE."formfield where id={$id}");
	//更新缓存
	if(!is_dir(DATA_PATH.'cache_form')){@mkdir(DATA_PATH.'cache_form',0777);}
	$rel=$GLOBALS['mysql']->fetch_asc("select*from ".DB_PRE."formfield order by form_order asc");
	$cache_str="<?php\n\$field=".var_export($rel,true).";\n?>";
	cache_write(DATA_PATH.'cache_form/field.php',$cache_str);
	msg('字段删除成功','?action=fields&id='.$form_id.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}	

//ajax修改字段排序
elseif($action=='ajax_field_order'){
	$id=intval($_POST['id']);
	$order_id=intval($_POST['order_id']);
	if(empty($id)){die('参数错误');}
	$sql="update ".DB_PRE."formfield set form_order='".$order_id."' where id=".$id;
	$GLOBALS['mysql']->query($sql);
	//更新缓存
	if(!is_dir(DATA_PATH.'cache_form')){@mkdir(DATA_PATH.'cache_form',0777);}
	$rel=$GLOBALS['mysql']->fetch_asc("select*from ".DB_PRE."formfield order by form_order asc");
	$cache_str="<?php\n\$field=".var_export($rel,true).";\n?>";
	cache_write(DATA_PATH.'cache_form/field.php',$cache_str);
}
//ajax修改字段使用
elseif($action=='ajax_field_use'){
	$id=intval($_POST['id']);
	$is_use=intval($_POST['is_use']);
	if(empty($id)){exit;}
	$sql="update ".DB_PRE."formfield set is_disable=".$is_use." where id=".$id;
	$GLOBALS['mysql']->query($sql);
	//更新缓存
	if(!is_dir(DATA_PATH.'cache_form')){@mkdir(DATA_PATH.'cache_form',0777);}
	$rel=$GLOBALS['mysql']->fetch_asc("select*from ".DB_PRE."formfield order by form_order asc");
	$cache_str="<?php\n\$field=".var_export($rel,true).";\n?>";
	cache_write(DATA_PATH.'cache_form/field.php',$cache_str);
}

//前台提交表单列表
elseif($action=='form_list'){
	if(!check_purview('form_list')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$id = intval($_REQUEST['id']);
	if(file_exists(DATA_PATH.'cache_form/form.php')){include(DATA_PATH.'cache_form/form.php');}
	$id=empty($id)?$form[0]['id']:$id;
	if(!empty($form)){
		foreach($form as $k=>$v){
			if($v['id']=$id){
				$form_info=$v;
			}
		}
	}
	include('template/admin_form_list.php');
}

//查看前台表单
elseif($action=='show_form'){
	if(!check_purview('form_list')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$id = intval($_GET['id']);
	$form_id = intval($_GET['form_id']);
	if(empty($id)){msg('<span style="color:red">不存在当前表单</span>');}
	if(file_exists(DATA_PATH.'cache_form/form.php')){include(DATA_PATH.'cache_form/form.php');}
	if(!empty($form)){
		foreach($form as $k=>$v){
			if($v['id']==$form_id){
				$form_info=$v;
			}
		}
	}
	$table=$form_info['form_mark'];
	if(empty($table)){err('<span style="color:red">不存在表单模型</span>');}
	$rel=$GLOBALS['mysql']->fetch_asc("select*from ".DB_PRE."{$table} where id={$id}");
	$rel2=$GLOBALS['mysql']->fetch_asc("select*from ".DB_PRE."formlist where id={$id}");
	$rel_arr=$rel[0];
	if(file_exists(DATA_PATH.'cache_form/field.php')){include(DATA_PATH.'cache_form/field.php');}
	include('template/admin_show_form.php');	
}

//删除表单信息
elseif($action=='del_list'){
	if(!check_purview('form_list')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$id = intval($_GET['id']);
	$form_id = intval($_GET['form_id']);
	if(empty($id)||empty($form_id)){msg('<span style="color:red">参数发生错误,删除失败</span>');}
	if(file_exists(DATA_PATH.'cache_form/form.php')){include(DATA_PATH.'cache_form/form.php');}
	if(!empty($form)){
		foreach($form as $k=>$v){
			if($v['id']==$form_id){$table=$v['form_mark'];}
		}
	}
	$GLOBALS['mysql']->query("delete from ".DB_PRE."formlist where id={$id}");
	$GLOBALS['mysql']->query("delete from ".DB_PRE."{$table} where id={$id}");
	msg('表单信息成功删除','?action=form_list&id='.$form_id.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}

//ajax修改模型使用
elseif($action=='ajax_use'){
	$id=intval($_POST['id']);
	$is_use=intval($_POST['is_use']);
	if(empty($id)){exit;}
	$sql="update ".DB_PRE."form set is_disable=".$is_use." where id=".$id;
	$GLOBALS['mysql']->query($sql);
	//更新缓存
	$form_file=DATA_PATH.'cache_form/form.php';
	$rel=$GLOBALS['mysql']->fetch_asc("select*from ".DB_PRE."form order by id desc");
	$cache_str="<?php\n\$form=".var_export($rel,true).";\n?>";
	cache_write($form_file,$cache_str);
}

//删除所有表单
elseif($action=='del_all'){
	if(!check_purview('form_list')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$form_id = intval($_GET['form_id']);
	$id = $_POST['all'];
	if(empty($id)){msg('请选择需要删除的表单！');}
	if(empty($form_id)){msg('<span style="color:red">参数发生错误,删除失败</span>');}
	if(file_exists(DATA_PATH.'cache_form/form.php')){include(DATA_PATH.'cache_form/form.php');}
	if(!empty($form)){
		foreach($form as $k=>$v){
			if($v['id']==$form_id){$table=$v['form_mark'];}
		}
	}
	foreach($id as $k_1=>$v_1){
		$GLOBALS['mysql']->query("delete from ".DB_PRE."formlist where id={$v_1}");
		$GLOBALS['mysql']->query("delete from ".DB_PRE."{$table} where id={$v_1}");
	}
	msg('表单成功删除！','?action=form_list&id='.$form_id.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}
echo PW;
?>
