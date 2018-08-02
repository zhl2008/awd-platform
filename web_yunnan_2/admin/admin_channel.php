<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

define('IN_CMS','true');
include('init.php');
$action=isset($_REQUEST['action'])?fl_html(fl_value($_REQUEST['action'])):'channel';
$lang=isset($_REQUEST['lang'])?fl_html(fl_value($_REQUEST['lang'])):get_lang_main();

//模型列表
if($action=='channel'){
	$fl_path=DATA_PATH.'cache_channel/cache_channel_all.php';
	include('template/admin_channel.php');
}

//添加模型界面
elseif($action=='add'){
	if(!check_purview('pannel_create')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	include('template/admin_channel_ad.php');
}

//模型缓存
elseif($action=='cache'){
	if(!$GLOBALS['cache']->channel_cache($GLOBALS['lang']) || !$GLOBALS['cache']->cache_fields()){
		msg("缓存更新失败，请先添加模型");	
	}
	msg("模型缓存完成",'admin_main.php?nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}


//处理添加的模型
elseif($action=='save_channel'){
	if(!check_purview('pannel_create')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$submit = $_POST['submit'];
	$channel_name = $_POST['channel_name'];
	$channel_mark = $_POST['channel_mark'];
	$channel_table = $_POST['channel_table'];
	$channel_order = intval($_POST['channel_order']);
	$is_member = intval($_POST['is_member']);
	$is_verify = intval($_POST['is_verify']);
	$is_disable = intval($_POST['is_disable']);
	$is_del = intval($_POST['is_del']);
	$list_php=$_POST['channel_list_php'];
	$content_php=$_POST['channel_content_php'];
	if(!isset($submit)){
		msg('<span style="color:red">请从表单提交</span>');
	}
	if(empty($channel_name)){
		msg('<span style="color:red">模型名不能为空</span>');
	}
	if(strlen($channel_name)>60){msg('<span style="color:red">模型名太长,请缩短</span>');}
	if(!check_str($channel_mark,'/^\w+$/')){
		msg('<span style="color:red">模型标识只能是字母、数字或_组合</span>');
	}
	if(strlen($channel_mark)>60){msg('<span style="color:red">模型标识太长,请缩短</span>');}
	if(!isset($channel_table)||empty($channel_table)){
		msg('<span style="color:red">数据表不能为空</span>');
	}
	if(strlen($channel_table)>60){msg('<span style="color:red">表名太长,请缩短</span>');}
	if($GLOBALS['mysql']->fetch_rows("select id from ".DB_PRE."channel where channel_mark='".$channel_mark."'")){
		msg('<span style="color:red">在同一种语言中已经存在相同的'.$GLOBALS['channel_mark']."标识</span>");
	}
	$channel_order=empty($channel_order)?10:$channel_order;
	if(strlen($channel_order)>60){msg('<span style="color:red">排序数字太长,请缩短</span>');}
	$tables=$GLOBALS['mysql']->show_tables();
	if(in_array(DB_PRE.$channel_table,$tables)){
		msg('<span style="color:red">数据表'.$channel_table.'已经存在,请更改</span>');
	}
	$sql="insert into ".DB_PRE."channel (channel_name,channel_mark,channel_table,is_disable,is_verify,channel_order,is_del,list_php,content_php) values ('".$channel_name."','".$channel_mark."','".$channel_table."',".$is_disable.",".$is_verify.','.$channel_order.",{$is_del},'{$list_php}','{$content_php}')";
	$GLOBALS['mysql']->query($sql);
	$table=$channel_table;
	$field="id mediumint(8) not null,primary key (id)";
	$GLOBALS['mysql']->create_tb($table,$field);
	$GLOBALS['cache']->channel_cache();
	msg('模型添加成功','admin_channel.php?nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}


//模型修改
elseif($action=='channel_xg'){
	if(!check_purview('pannel_edit')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$id = intval($_GET['id']);
	if(file_exists(DATA_PATH."cache_channel/cache_channel_all.php")){
		include(DATA_PATH."cache_channel/cache_channel_all.php");
	}
	if(!empty($channel)){
	foreach($channel as $key=>$value){
		if($value['id']==$id){
			$arr[]=$value;
		}
	}
	}
	include('template/admin_channel_xg.php');
	
}

//处理修改的模型
elseif($action=='save_xg_channel'){
	if(!check_purview('pannel_edit')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$submit = $_POST['submit'];
	$id = intval($_POST['id']);
	$channel_table_ago = $_POST['channel_table_ago'];
	$channel_name = $_POST['channel_name'];
	$channel_mark = $_POST['channel_mark'];
	$channel_table = $_POST['channel_table'];
	$channel_order = intval($_POST['channel_order']);
	$is_verify = intval($_POST['is_verify']);
	$is_disable = intval($_POST['is_disable']);
	$is_del = intval($_POST['is_del']);
	$list_php=$_POST['channel_list_php'];
	$content_php=$_POST['channel_content_php'];
	
	if(!isset($submit)){
		msg('<span style="color:red">请从表单提交</span>');
	}
	if(!isset($id)||empty($id)){
		msg('<span style="color:red">参数传递错误,请重新操作</span>','admin_channel.php?nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
	}
	if(empty($channel_name)){
		msg('<span style="color:red">模型名不能为空</span>');
	}
	$is_del=($is_del=="")?"":",is_del=".$is_del;
	$channel_order=empty($channel_order)?10:$channel_order;
	$sql="update ".DB_PRE."channel set channel_name='".$channel_name."',is_disable=".$is_disable.",channel_order=".$channel_order.",is_verify=".$is_verify."{$is_del},list_php='{$list_php}',content_php='{$content_php}' where id=".$id;
	$GLOBALS['mysql']->query($sql);
	$GLOBALS['cache']->channel_cache();
	msg('模型修改成功','admin_channel.php?nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}


//删除模型
elseif($action=='del_channel'){
	if(!check_purview('pannel_del')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$step = $_GET['step'];
	$id = intval($_GET['id']);
	$tb = $_GET['tb'];
	$cate_id = $_GET['cate_id'];
	//初始化
	if($step==1){
	if(!isset($id)||empty($id)){msg('<span style="color:red">参数传递错误,请重新操作</span>');}
	if(file_exists(DATA_PATH."cache_channel/cache_channel_all.php")){
		include(DATA_PATH."cache_channel/cache_channel_all.php");
	}
	if(empty($channel)){
		msg('<span style="color:red">请先更新模型缓存</span>','admin_channel.php');
	}
	foreach($channel as $key=>$value){
		if($value['id']==$id){
			$table=$value['channel_table'];
		}
	}
	//写入栏目缓存
	$rel=$GLOBALS['mysql']->fetch_asc("select id,cate_name,cate_fold_name,lang from ".DB_PRE."category where cate_channel={$id}");
	if(!empty($rel)){
		foreach($rel as $k=>$v){
			$rel[$k]['table']=$table;
		}
	}
	$str="<?php\n\$cate=".var_export($rel,true).";\n?>";
	cache_write(DATA_PATH.'cache_channel/cate_arr.php',$str);
	
	//信息缓存
	$str="<?php \n\$msg='';\n?>";
	cache_write(DATA_PATH.'cache_channel/msg.php',$str);
	$tb=$table;
	show_htm("开始删除栏目",'?action=del_channel&step=2&id='.$id.'&tb='.$tb.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
	}
	//取出栏目
	if($step==2){
		if(file_exists(DATA_PATH.'cache_channel/cate_arr.php')){include(DATA_PATH.'cache_channel/cate_arr.php');}
		$cate_arr=empty($cate)?'':array_shift($cate);
		$str="<?php\n\$cate=".var_export($cate,true).";\n?>";
		cache_write(DATA_PATH.'cache_channel/cate_arr.php',$str);
		//文章缓存
		if(!empty($cate_arr)){
			$news=$GLOBALS['mysql']->fetch_asc("select id,title,addtime,lang from ".DB_PRE."maintb where category=".$cate_arr['id']);
			if(!empty($news)){
				foreach($news as $k=>$v){
					$news[$k]['cate_name']=$cate_arr['cate_name'];
					$news[$k]['table']=$cate_arr['table'];
					$news[$k]['cate_fold_name']=$cate_arr['cate_fold_name'];
				}
			}
		$str="<?php\n\$news=".var_export($news,true).";\n?>";
		cache_write(DATA_PATH.'cache_channel/news_arr.php',$str);
		show_htm("开始删除栏目【{$cate_arr['cate_name']}】的文章",'?action=del_channel&step=3&id='.$id.'&cate_id='.$cate_arr['id'].'&tb='.$tb.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
		}else{
		//删除字段
		$GLOBALS['mysql']->query("delete from ".DB_PRE."auto_fields where channel_id={$id}");
		$GLOBALS['cache']->cache_fields();
			//删除模型
		$tables=$GLOBALS['mysql']->show_tables();
		if(in_array(DB_PRE.$tb,$tables)){
		$GLOBALS['mysql']->drop_table($tb);
		}
		$GLOBALS['mysql']->query("delete from ".DB_PRE."channel where id=".$id);
		$GLOBALS['cache']->channel_cache();
		msg('模型删除成功','admin_channel.php?nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
		}
		
	}
	
	//删除文章
	if($step==3){
		if(file_exists(DATA_PATH.'cache_channel/news_arr.php')){include(DATA_PATH.'cache_channel/news_arr.php');}
		$news_id=empty($news)?'':array_shift($news);
		$str="<?php\n\$news=".var_export($news,true).";\n?>";
		cache_write(DATA_PATH.'cache_channel/news_arr.php',$str);
		if(!empty($news_id)){
			$addtime_rel=explode('-',$news_id['addtime']);
			$fl=CMS_PATH.'htm/'.$news_id['cate_fold_name'].'/'.$addtime_rel[0].'/'.$addtime_rel[1].$addtime_rel[2].'/'.$news_id['id'].'.html';
			if(file_exists($fl)){@unlink($fl);}
			if(!empty($news_id['id'])){
			$GLOBALS['mysql']->query("delete from ".DB_PRE."maintb where id=".$news_id['id']);
			}
			if(!empty($news_id['id'])&&!empty($news_id['table'])){
				$GLOBALS['mysql']->query("delete from ".DB_PRE.$news_id['table']." where id=".$news_id['id']);
			}
			show_htm("已经删除栏目【{$news_id['cate_name']}】下的文章【{$news_id['title']}】",'?action=del_channel&step=3&id='.$id.'&cate_id='.$cate_id.'&tb='.$tb.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
		}else{
			$GLOBALS['mysql']->query("delete from ".DB_PRE."category where cate_parent=".$cate_id);
			$GLOBALS['mysql']->query("delete from ".DB_PRE."category where id=".$cate_id);
			$GLOBALS['cache']->cache_category_all();
			show_htm("已经删除栏目($cate_id)",'?action=del_channel&step=2&id='.$id.'&tb='.$tb.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
		}
		
	}
	
	
}

//模型字段管理
elseif($action=='fields'){
	if(!file_exists(DATA_PATH."cache_channel/cache_fields.php")){
		$GLOBALS['cache']->cache_fields();
	}
	$id = intval($_GET['id']);
	if(empty($id)){msg('<span style="color:red">参数传递错误，请重新操作!</span>');}
	include(DATA_PATH."cache_channel/cache_fields.php");
	include('template/admin_field.php');
}


//添加字段界面
elseif($action=='add_field'){
	if(!check_purview('field_create')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$id = intval($_GET['id']);
	if(empty($id)){msg('<span style="color:red">参数传递错误，请重新操作!</span>');}
	include('template/admin_field_add.php');
}

//处理添加的字段
elseif($action=='save_field'){
	if(!check_purview('field_create')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$id = intval($_POST['id']);
	$use_name = $_POST['use_name'];
	$field_name = $_POST['field_name'];
	$field_type = $_POST['field_type'];
	$field_value = $_POST['field_value'];
	$field_info = $_POST['field_info'];
	$field_order = intval($_POST['field_order']);
	$is_del = intval($_POST['is_del']);
	$is_disable = intval($_POST['is_disable']);
	$submit = $_POST['submit'];
	if(!isset($id) || empty($id)){
		msg('<span style="color:red">参数传递错误,请重新操作</span>','admin_channel.php');
	}
	if(!isset($submit)){
		msg('<span style="color:red">请从表单提交</span>');
	}
	if(empty($use_name)){
		msg('<span style="color:red">字段提示文字不能为空</span>');
	}
	if(strlen($use_name)>60){msg('<span style="color:red">字段提示文字太长,请缩短</span>');}
	if(!check_str($field_name,'/^\w+$/')){
		msg('<span style="color:red">字段名必须是字母、数字或_组合</span>');
	}
	/*
	if(strlen($field_name)>60){msg('<span style="color:red">字段名太长,请缩短</span>');}
	if(strlen($field_value)>200){msg('<span style="color:red">字段默认值太长,请缩短</span>');}
	if(strlen($field_info)>200){msg('<span style="color:red">字段说明太长,请缩短</span>');}
	*/
	$field_length=$field_length;
	if(empty($field_length)){
		$field_length=255;
	}
	$order=($field_order=="")?10:$field_order;
	if(strlen($field_order)>60){msg('<span style="color:red">字段排序数字太长,请缩短</span>');}
	if(file_exists(DATA_PATH."cache_channel/cache_channel_all.php")){
		include(DATA_PATH."cache_channel/cache_channel_all.php");
	}
	foreach($channel as $key=>$value){
		if($value['id']==$id){
			$table=$value['channel_table'];
		}
	}
	$type="varchar(".$field_length.")";
	if($field_type=="html"||$field_type=="upload_pic_more"){
		$type="text";
	}
	$sql="select*from ".DB_PRE."{$table} limit 1";
	$field_arr=$GLOBALS['mysql']->fetch_field($sql);
	if(in_array($field_name,$field_arr)){msg("已经存在{$field_name}字段,请更换字段名");}
	$GLOBALS['mysql']->add_field($table,$field_name." ".$type);
	//$table=$GLOBALS['mysql']->get_row("select channel_mark from ".DB_PRE."channel where id=".$GLOBALS['id'],"channel_mark");
	$sql="insert into ".DB_PRE."auto_fields (field_name,use_name,field_type,field_value,field_length,channel_id,field_info,is_disable,is_del,field_order) values ('".$field_name."','".$use_name."','".$field_type."','".$field_value."',".$field_length.",".$id.",'".$field_info."',".$is_disable.",".$is_del.",{$order})";
	$GLOBALS['mysql']->query($sql);
	$GLOBALS['cache']->cache_fields();
	msg('字段添加成功',"?nav=".$admin_nav.'&admin_p_nav='.$admin_p_nav);
}


//修改字段界面
elseif($action=='xg_field'){
	if(!check_purview('field_edit')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$id = intval($_GET['id']);
	if(!isset($id)||empty($id)){
		msg('<span style="color:red">参数传递错误，请重新操作</span>','admin_channel.php?nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
	}
	if(!file_exists(DATA_PATH."cache_channel/cache_fields.php")){
		$GLOBALS['cache']->cache_fields();
	}
	include(DATA_PATH."cache_channel/cache_fields.php");
	foreach($field as $key=>$value){
		if($value['id']==$id){
			$arr[]=$value;
		}
	}
	include('template/admin_xg_field.php');
}


//处理修改的字段
elseif($action=='save_xg_field'){
	if(!check_purview('field_edit')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$channel_id = intval($_POST['channel_id']);
	$field = $_POST['field'];
	$id = intval($_POST['id']);
	$use_name = $_POST['use_name'];
	$field_name = $_POST['field_name'];
	$field_type = $_POST['field_type'];
	$field_value = $_POST['field_value'];
	$field_info = $_POST['field_info'];
	$field_order = intval($_POST['field_order']);
	$is_del = isset($_POST['is_del'])?intval($_POST['is_del']):1;
	$is_disable = intval($_POST['is_disable']);
	$submit = $_POST['submit'];

	if(!isset($submit)){
		msg('<span style="color:red">请从表单提交</span>');
	}
	if(!isset($id)||empty($id)){
		msg('<span style="color:red">参数传递错误</span>','admin_channel.php');
	}
	if(empty($use_name)){
		msg('<span style="color:red">字段提示文字不能为空</span>');
	}
	
	if(empty($field_length)){
		$field_length=255;
	}
	
	if(file_exists(DATA_PATH."cache_channel/cache_channel_all.php")){
		include(DATA_PATH."cache_channel/cache_channel_all.php");
	}
	foreach($channel as $key=>$value){
		if($value['id']==$channel_id){
			$table=$value['channel_table'];
		}
	}
	$type="varchar(".$field_length.")";
	if($field_type=="html"||$field_type=="upload_pic_more"){
		$type="text";
	}
	$order=($field_order=="")?10:$field_order;
	//$GLOBALS['mysql']->xg_field($table,$field." ".$field." ".$type);
	$sql="update ".DB_PRE."auto_fields set use_name='".$use_name."',field_type='".$field_type."',field_value='".$field_value."',field_length=255,field_info='".$field_info."',is_disable=".$is_disable.",field_order={$order},is_del=".$is_del." where id=".$id;
	$GLOBALS['mysql']->query($sql);
	$GLOBALS['cache']->cache_fields();
	msg('字段添修改成功','?action=fields&id='.$channel_id.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
	
}

//导入字段
elseif($action=='import')
{
	if(!check_purview('field_del')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$channel_id = intval($_GET['id']);
	if(empty($channel_id))
	{
		msg('参数发生错误');
	}
	include('template/admin_field_import.php');
}

//开始导出字段
elseif($action == 'save_import')
{
	if(!check_purview('field_del')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$channel_id = intval($_POST['channel_id']);
	if(empty($channel_id))
	{
		msg('参数发生错误！请重新操作！');
	}
	$sql = "select field_name,use_name,field_type,field_value,field_length,field_info,is_disable,is_del,field_order from ".DB_PRE."auto_fields where channel_id = ".$channel_id;
	$rel = $GLOBALS['mysql']->fetch_asc($sql);
	if(!empty($rel))
	{
		$arr_str="<?php\n\$field_arr = ".var_export($rel,true).";\n?>";
	}
	$file=DATA_PATH.'backup/'.'field_arr_'.$channel_id.'.php';
	creat_inc($file,$arr_str);
	msg('字段field_arr.php导出完成！请到data/backup目录下下载导出文件！','?action=channel&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}

//导入字段
elseif($action=='backup')
{
	if(!check_purview('field_del')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$channel_id = intval($_GET['id']);
	if(empty($channel_id))
	{
		msg('参数发生错误');
	}
	include('template/admin_field_backup.php');
}

//开始导入字段
elseif($action=='save_backup')
{
	if(!check_purview('field_del')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$channel_id = intval($_POST['channel_id']);
	if(empty($channel_id))
	{
		msg('参数发生错误！请重新操作！');
	}
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
	//获取模型表
	if(file_exists(DATA_PATH."cache_channel/cache_channel_all.php"))
	{
		include(DATA_PATH."cache_channel/cache_channel_all.php");
	}
	foreach($channel as $key=>$value){
		if($value['id']==$channel_id){
			$table=$value['channel_table'];
		}
	}
	
	//开始导入
	if(!empty($field_arr))
	{
		foreach($field_arr as $v)
		{
			$type="varchar(".$v['field_length'].")";
			if($v['field_type']=="html"||$v['field_type']=="upload_pic_more")
			{
				$type="text";
			}
			$sql="select*from ".DB_PRE."{$table} limit 1";
			$check_field_arr=$GLOBALS['mysql']->fetch_field($sql);
			if(in_array($v['field_name'],$check_field_arr))
			{
				continue;
			}
			$GLOBALS['mysql']->add_field($table,$v['field_name']." ".$type);
			
			$sql="insert into ".DB_PRE."auto_fields (field_name,use_name,field_type,field_value,field_length,channel_id,field_info,is_disable,is_del,field_order) values ('".$v['field_name']."','".$v['use_name']."','".$v['field_type']."','".$v['field_value']."',".$v['field_length'].",".$channel_id.",'".$v['field_info']."',".$v['is_disable'].",".$v['is_del'].",'".$v['field_order']."')";
			$GLOBALS['mysql']->query($sql);
		}
	}
	$GLOBALS['cache']->cache_fields();
	
	msg('导入完成，可以删除文件!','?action=channel&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
	
}

//删除字段
elseif($action=='del_field'){
	if(!check_purview('field_del')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$id = intval($_GET['id']);
	$channel_id = intval($_GET['channel_id']);
	if(!isset($id)||empty($id) || !isset($channel_id) || empty($channel_id)){
		msg('<span style="color:red">参数传递错误,请重新操作</span>','admin_channel.php');
	}
	if(file_exists(DATA_PATH."cache_channel/cache_channel_all.php")){
		include(DATA_PATH."cache_channel/cache_channel_all.php");
	}
	if(!empty($channel)){
	foreach($channel as $key=>$value){
		if($value['id']==$channel_id){
			$table=$value['channel_table'];
		}
	}
	}
	if(file_exists(DATA_PATH."cache_channel/cache_fields.php")){
		include(DATA_PATH."cache_channel/cache_fields.php");
		if(!empty($field)){
		foreach($field as $key=>$value){
			if($value['id']==$id){
				$field=$value['field_name'];
				$is_del=$value['is_del'];
				$use_name=$value['use_name'];
			}
		}
		}
	}
	if($is_del){msg("【{$use_name}】字段不能删除");}
	if(!empty($field)&&!empty($table)){
	$GLOBALS['mysql']->drop_field($table,$field);
	$GLOBALS['mysql']->query("delete from ".DB_PRE."auto_fields where id=".$id);
	}
	$GLOBALS['cache']->cache_fields();
	msg($use_name.'字段删除成功','admin_channel.php?nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
	
}

//ajax模型修改排序
elseif($action=='ajax_order'){
	$id=intval($_POST['id']);
	$order_id=intval($_POST['order_id']);
	if(empty($id)){die('参数错误');}
	$sql="update ".DB_PRE."channel set channel_order='".$order_id."' where id=".$id;
	$GLOBALS['mysql']->query($sql);
	$GLOBALS['cache']->channel_cache();
}
//ajax修改模型使用
elseif($action=='ajax_use'){
	$id=intval($_POST['id']);
	$is_use=intval($_POST['is_use']);
	if(empty($id)){exit;}
	$sql="update ".DB_PRE."channel set is_disable=".$is_use." where id=".$id;
	$GLOBALS['mysql']->query($sql);
	$GLOBALS['cache']->channel_cache();
}
//ajax修改字段排序
elseif($action=='ajax_field_order'){
	$id=intval($_POST['id']);
	$order_id=intval($_POST['order_id']);
	if(empty($id)){die('参数错误');}
	$sql="update ".DB_PRE."auto_fields set field_order='".$order_id."' where id=".$id;
	$GLOBALS['mysql']->query($sql);
	$GLOBALS['cache']->cache_fields();
}
//ajax修改字段使用
elseif($action=='ajax_field_use'){
	$id=intval($_POST['id']);
	$is_use=intval($_POST['is_use']);
	if(empty($id)){exit;}
	$sql="update ".DB_PRE."auto_fields set is_disable=".$is_use." where id=".$id;
	$GLOBALS['mysql']->query($sql);
	$GLOBALS['cache']->cache_fields();
}
echo PW;
?>