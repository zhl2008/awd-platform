<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

define('IN_CMS','true');
include('init.php');
$action=isset($_REQUEST['action'])?fl_html(fl_value($_REQUEST['action'])):'lang';
$lang=isset($_REQUEST['lang'])?fl_html(fl_value($_REQUEST['lang'])):'';
//语言列表
if($action=='lang'){
	if(file_exists(DATA_PATH.'cache/lang_cache.php')){
		include(DATA_PATH.'cache/lang_cache.php');
	}else{
		$lang_cache='';
	}
	include('template/admin_lang.php');
}
//添加语言界面
elseif($action=='add'){
	if(!check_purview('lang_add')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	include('template/admin_lang_add.php');
}
//保存语言
elseif($action=='add_save'){
	if(!check_purview('lang_add')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$submit=$_POST['submit'];
	$lang_name=$_POST['lang_name'];
	$lang_order=$_POST['lang_order'];
	$lang_tag=$_POST['lang_tag'];
	$lang_is_use=intval($_POST['lang_is_use']);
	$lang_is_open=intval($_POST['lang_is_open']);
	$lang_is_url=intval($_POST['lang_is_url']);
	$lang_url=$_POST['lang_url'];
	$lang_is_fix=intval($_POST['lang_is_fix']);
	if(!isset($submit)){
		msg('<span style="color:red">请填写完后提交表单</span>','admin_lang.php?action=add');
	}
	if(empty($lang_name)){
		msg('<span style="color:red">语言名称不能为空</span>','javascript:history.go(-1);');
	}
	if(strlen($lang_name)>60){msg('<span style="color:red">语言名称太长，请缩短</span>');}
	$lang_order=isset($lang_order)?intval($lang_order):0;
	if(strlen($lang_order)>60){msg('<span style="color:red">语言排序太长，请缩短</span>');}
	if(!isset($lang_tag)){
		msg('<span style="color:red">语言标示不能为空</span>','javascript:history.go(-1);');
	}
	if(!check_str($lang_tag,'/^[a-z][a-z_]*$/')){
		msg('<span style="color:red">语言标示只能使用字母和下划线，字母开头</span>','javascript:history.go(-1);');
	}
	if(strlen($lang_tag)>60){msg('<span style="color:red">语言标示太长，请缩短</span>');}
	$lang_tag_is=$GLOBALS['mysql']->fetch_rows("select id from ".DB_PRE."lang where lang_tag='".$lang_tag."'");//是否存在相同标示
	if($lang_tag_is){
		msg("语言标示【{$lang_tag}】已经存在，请更换");
	}
	if(isset($lang_url)){
		if(!check_str($lang_url,'/^http:\/\/.*$/')){
			msg('<span style="color:red">转向地址必须以http://开头</span>',"javascript:history.go(-1);");
		}
		//$lang_url=str_replace('http://','',$lang_url);
	}
	//添加语言包，默认使用简体中文语言包
	$lang_lang_rel=$GLOBALS['mysql']->fetch_asc("select*from ".DB_PRE."lang_lang where lang='cn' ");
	if(!empty($lang_lang_rel)){
		foreach($lang_lang_rel as $lang_k=>$lang_v){
			$lang_lang_tag=$lang_v['lang_tag'];
			$lang_lang_value=$lang_v['lang_value'];
			$GLOBALS['mysql']->query("insert into ".DB_PRE."lang_lang (lang_tag,lang_value,lang) values ('{$lang_lang_tag}','{$lang_lang_value}','{$lang_tag}')");
		}
	}
	

	$sql="insert into ".DB_PRE."lang (lang_name,lang_order,lang_tag,lang_is_use,lang_is_open,lang_is_url,lang_url,lang_is_fix) values ('{$lang_name}',{$lang_order},'{$lang_tag}',{$lang_is_use},{$lang_is_open},{$lang_is_url},'{$lang_url}',{$lang_is_fix})";
	$GLOBALS['mysql']->query($sql);
	//更新语言包缓存
	$sql="select lang_tag,lang_value from ".DB_PRE."lang_lang where lang='{$lang_tag}' order by id desc";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	$language=array();
	if(!empty($rel)){
	foreach($rel as $k=>$v){
		$language[$v['lang_tag']]=$v['lang_value'];
	}
	unset($rel);
	}
	$lang_file=LANG_PATH.'lang_'.$lang_tag.'.php';
	$str="<?php\n\$language=".var_export($language,true).";\n?>";
	creat_inc($lang_file,$str);
	//更新缓存
	$sql="select*from ".DB_PRE."lang order by lang_order desc";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	
		$cache_file=DATA_PATH.'cache/lang_cache.php';
		$str="<?php\n\$lang_cache=".var_export($rel,true).";\n?>";
		creat_inc($cache_file,$str);
	
	msg($lang_name.'语言添加成功','admin_lang.php?nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}

//导出语言包
elseif($action == 'import_lang')
{
	if(!check_purview('lang_lang')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$lang = $_GET['lang'];
	include('template/admin_lang_import.php');
}

//开始导出
elseif($action == 'save_import')
{
	if(!check_purview('lang_lang')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$lang = $_POST['lang'];
	if(empty($lang))
	{
		msg('参数发生错误！请重新操作！');
	}
	//获取语言变量
	$sql = "select lang_tag,lang_value from ".DB_PRE."lang_lang where lang = '".$lang."'";
	$rel = $GLOBALS['mysql']->fetch_asc($sql);
	if(!empty($rel))
	{
		$arr_str="<?php\n\$lang_arr = ".var_export($rel,true).";\n?>";
	}
	$file=DATA_PATH.'backup/'.'lang_arr_'.$lang.'.php';
	creat_inc($file,$arr_str);
	msg('语言包导出完成！请到data/backup目录下下载导出文件！','?action=lang&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}

//导入语言包
elseif($action == 'backup_lang')
{
	if(!check_purview('lang_lang')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$lang = $_GET['lang'];
	include('template/admin_lang_backup.php');
}

//开始导入
elseif($action == 'save_backup')
{
	if(!check_purview('lang_lang')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$lang = $_POST['lang'];
	if(empty($lang))
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
	
	//删除现有语言包
	$is_del = intval($_POST['is_del']);
	if($is_del)
	{
		$GLOBALS['mysql']->query("delete from ".DB_PRE."lang_lang where lang = '".$lang."'");
	}
	
	//导入
	if(!empty($lang_arr))
	{	
		foreach($lang_arr as $v)
		{
			//同一语言存在相同语言变量则跳过
			$n=$GLOBALS['mysql']->fetch_rows("select id from ".DB_PRE."lang_lang where lang_tag='".$v['lang_tag']."' and lang='".$lang."'");
			if($n){continue;}
			$sql="insert into ".DB_PRE."lang_lang (lang_tag,lang_value,lang) values ('".$v['lang_tag']."','".$v['lang_value']."','{$lang}')";
			$GLOBALS['mysql']->query($sql);
		}
	}
	
	//写入缓存
	$sql="select lang_tag,lang_value from ".DB_PRE."lang_lang where lang='".$lang."' order by id desc";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	$language=array();
	if(!empty($rel))
	{
		foreach($rel as $k=>$v)
		{
			$language[$v['lang_tag']]=$v['lang_value'];
		}
	}
	
	$lang_file=LANG_PATH.'lang_'.$lv['lang_tag'].'.php';
	$str="<?php\n\$language=".var_export($language,true).";\n?>";
	creat_inc($lang_file,$str);
	
	msg('导入完成，可以删除文件!','?action=lang&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
	
}

//管理语言包界面
elseif($action=='edit'){
if(!check_purview('lang_lang')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
$type=intval($_REQUEST['search_type']);
$key=trim($_REQUEST['key']);
if(!isset($GLOBALS['lang'])){
	msg('<span style="color:red">参数为空,请重新操作</span>','javascript:history.go(-1);');
}
if(file_exists(DATA_PATH.'cache/lang_cache.php')){include(DATA_PATH.'cache/lang_cache.php');}
include('template/admin_lang_manage.php');
}

//搜索语言包
elseif($action=='search'){
if(!check_purview('lang_lang')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
$type=intval($_POST['search_type']);
$key=trim($_REQUEST['key']);
if(!isset($GLOBALS['lang'])){
	msg('<span style="color:red">参数为空,请重新操作</span>','javascript:history.go(-1);');
}
/*
if(empty($key)){
	msg('<span style="color:red">语言变量不能为空</span>','javascript:history.go(-1);');
}
*/
if(file_exists(DATA_PATH.'cache/lang_cache.php')){include(DATA_PATH.'cache/lang_cache.php');}
include('template/admin_lang_manage.php');
}
//处理语言修改
elseif($action=='edit_save'){
if(!check_purview('lang_lang')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
if(!isset($lang)){
	msg('<span style="color:red">参数为空,请重新操作</span>','javascript:history.go(-1);');
}
$submit=$_POST['submit'];
	if(!isset($submit)){
		msg('<span style="color:red">请从表单提交</span>','admin_lang.php');
	}
	if(!isset($_POST)){
		msg('<span style="color:red">请填写语言后提交</span>','javascript:history.go(-1);');
	}
	foreach($_POST as $key=>$value){
		if(in_array($key,array('action','lang','submit'))){
			continue;
		}
		$lang[$key]=$value;
	}
	$str="<?php\n\$language=".var_export($lang,true).";\n?>";
	if(!file_exists(LANG_PATH.'lang_'.$lang.'.php')){
		msg('<span style="color:red">找不到'.$lang.'语言的语言包，请重新安装</span>','javascript:history.go(-1);');
	}
	if(!$fp=@fopen(LANG_PATH.'lang_'.$lang.'.php','w')){
		msg('<span style="color:red">语言文件打开失败，请检查是否有足够的文件操作权限</span>','javascript:history.go(-1);');
	}
	flock($fp,LOCK_EX);
	if(!fwrite($fp,$str)){
		flock($fp,LOCK_UN);
		msg('<span style="color:red">写入语言文件失败,请重新操作</span>');
	}
	msg('语言修改成功','admin_lang.php');
	
}
//语言修改界面
elseif($action=='lang_edit'){
	if(!check_purview('lang_edit')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	if(!isset($GLOBALS['lang'])){
		die('<span style="color:red">参数不正确，请重新操作!</span>');
	}
	if(file_exists(DATA_PATH.'cache/lang_cache.php')){
		include(DATA_PATH.'cache/lang_cache.php');
	}
	if(!empty($lang_cache)){
		foreach($lang_cache as $k=>$v){
			if($v['lang_tag']==$GLOBALS['lang']){
				$arr_lang=$v;
			}
		}
	}
	if(empty($arr_lang)){
		msg('<span style="color:red">不存在该语言请重新添加或更新语言缓存</span>');
	}
	include('template/admin_lang_edit.php');
}
//保存语言修改
elseif($action=='lang_save_edit'){
	if(!check_purview('lang_edit')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$submit=$_POST['submit'];
	$lang_name=$_POST['lang_name'];
	$lang_order=$_POST['lang_order'];
	$lang_is_use=intval($_POST['lang_is_use']);
	$lang_is_open=intval($_POST['lang_is_open']);
	$lang_is_url=intval($_POST['lang_is_url']);
	$lang_url=$_POST['lang_url'];
	$lang_is_fix=intval($_POST['lang_is_fix']);
	if(!isset($GLOBALS['lang'])){
		msg('<span style="color:red">参数错误，请重新操作！</span>');
	}
	if(!isset($GLOBALS['submit'])){
		msg('<span style="color:red">请从表单提交</span>','admin_lang.php');
	}
	if(empty($lang_name)){
		msg('<span style="color:red">语言名称不能为空</span>','javascript:history.go(-1);');
	}
	if(strlen($lang_name)>60){msg('<span style="color:red">语言名称太长，请缩短</span>');}
	$lang_order=isset($lang_order)?intval($lang_order):0;
	if(strlen($lang_order)>60){msg('<span style="color:red">语言名称太长，请缩短</span>');}
	if(!$lang_is_use){
		$sql="select lang_main from ".DB_PRE."lang where lang_tag='".$lang."'";
		$rel=$GLOBALS['mysql']->fetch_asc($sql);
		if($rel[0]['lang_main']){msg("默认语言不能关闭使用");}
	}
	if(isset($lang_url)){
		if(!check_str($lang_url,'/^http:\/\/.*$/')){
			msg('<span style="color:red">转向地址必须以http://开头</span>',"javascript:history.go(-1);");
		}
	}
	$sql="update ".DB_PRE."lang set lang_name='$lang_name',lang_order=$lang_order,lang_is_use=$lang_is_use,lang_is_open=$lang_is_open,lang_is_url=$lang_is_url,lang_url='$lang_url' where lang_tag='".$GLOBALS['lang']."'";
	$GLOBALS['mysql']->query($sql);
	//更新缓存
	$sql="select*from ".DB_PRE."lang order by lang_order desc";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	
		$cache_file=DATA_PATH.'cache/lang_cache.php';
		$str="<?php\n\$lang_cache=".var_export($rel,true).";\n?>";
		creat_inc($cache_file,$str);
	
	
	msg("【{$lang_name}】语言修改成功",'admin_lang.php?nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}
//删除语言
elseif($action=='lang_dl'){
if(!check_purview('lang_del')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	if(!isset($GLOBALS['lang'])){
		msg('<span style="color:red">参数错误,请重新操作</span>');
	}
	if(file_exists(DATA_PATH."cache/lang_cache.php")){
		include(DATA_PATH."cache/lang_cache.php");
	}
	if(empty($lang_cache)){
		err('<span style="color:red">请先添加语言或更新语言缓存</span>');
	}
	foreach($lang_cache as $k=>$v){
		if($v['lang_tag']==$GLOBALS['lang']){
			$lang_fix=$v['lang_is_fix'];
		}
	}
	if($lang_fix){
		err("【".$GLOBALS['lang']."】语言为固定语言不能删除");
	}
	//判断是否有内容
	$has_cate=$GLOBALS['mysql']->fetch_rows("select id from ".DB_PRE."category where lang='{$lang}'");
	if($has_cate){msg('<span style="color:red">删除失败！该语言下有内容请先删除该语言的栏目等相关内容</span>');}
	$lang_file=LANG_PATH.'lang_'.$GLOBALS['lang'].'.php';
	if(file_exists($lang_file)){
		@unlink($lang_file);
	}
	$GLOBALS['mysql']->query("delete from ".DB_PRE."lang_cate");
	$GLOBALS['mysql']->query("delete from ".DB_PRE."lang_lang where lang='{$lang}'");
	$sql="delete from ".DB_PRE."lang where lang_tag='".$GLOBALS['lang']."'";
	$GLOBALS['mysql']->query($sql);
	//删除相关缓存文件
	if(file_exists(DATA_PATH.$lang.'_info.php')){include(DATA_PATH.$lang.'_info.php');}
if(!empty($_confing)){
 foreach($_confing as $k=>$v){
 	$_confing[$k]=stripslashes($v);
 }
}
	if(file_exists(DATA_PATH.$lang.'_info.php')){@unlink(DATA_PATH.$lang.'_info.php');}
	
	//更新缓存
	$sql="select*from ".DB_PRE."lang order by lang_order desc";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	
		$cache_file=DATA_PATH.'cache/lang_cache.php';
		$str="<?php\n\$lang_cache=".var_export($rel,true).";\n?>";
		creat_inc($cache_file,$str);
	msg('<span style="color:red">操作成功!语言标识为'.$GLOBALS['lang'].'的语言已经删除!</span>','admin_lang.php?nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
	
}

//更新语言缓存
elseif($action=='cache_lang'){
	$sql="select*from ".DB_PRE."lang order by lang_order desc";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
		$cache_file=DATA_PATH.'cache/lang_cache.php';
		$str="<?php\n\$lang_cache=".var_export($rel,true).";\n?>";
		creat_inc($cache_file,$str);
	msg('语言缓存更新完成','admin_main.php');
}
//设置操作主语言
elseif($action=='lang_main'){
	$lang_id=$_POST['lang_id'];
	if(empty($lang_id)){msg('<span style="color:red">参数发生错误,请重新操作</span>');}
	if(file_exists(DATA_PATH.'cache/lang_cache.php')){include(DATA_PATH.'cache/lang_cache.php');}
	if(!empty($lang_cache)){
		foreach($lang_cache as $k=>$v){
			if($v['lang_main']==1){$id=$v['id'];}
			if($v['id']==$lang_id){$lang_is_use=$v['lang_is_use'];$lang_name=$v['lang_name'];};
		}
	}
	if(!$lang_is_use){msg("请先开启【{$lang_name}】语言",'?',0);}
	if(!empty($id)){$GLOBALS['mysql']->query("update ".DB_PRE."lang set lang_main=0 where id=".$id);}
	$GLOBALS['mysql']->query("update ".DB_PRE."lang set lang_main=1 where id=".$lang_id);
	//更新缓存
	$sql="select*from ".DB_PRE."lang order by lang_order desc";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	$cache_file=DATA_PATH.'cache/lang_cache.php';
	$str="<?php\n\$lang_cache=".var_export($rel,true).";\n?>";
	creat_inc($cache_file,$str);
	unset($rel);
	msg('默认语言设置完成','?nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}
//添加语言包语言
elseif($action=='add_lang'){
	if(!check_purview('lang_lang')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	if(file_exists(DATA_PATH.'cache/lang_cache.php')){include(DATA_PATH.'cache/lang_cache.php');}
	include('template/admin_lang_lang.php');
}
//处理添加的语言包语言
elseif($action=='save_add_lang'){
	if(!check_purview('lang_lang')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	if(file_exists(DATA_PATH.'cache/lang_cache.php')){include(DATA_PATH.'cache/lang_cache.php');}//载入语言包缓存
	$lang_tag=$_POST['lang_tag'];
	$lang_value=$_POST['lang_value'];
	if(empty($lang_tag)){msg('<span style="color:red">语言变量不能为空</span>');}
	if(!check_str($lang_tag,'/^[a-z_A-Z0-9]*$/')){msg('<span style="color:red">语言变量只能是字母数字和下划线组成</span>');}
	
	if(!empty($lang_cache)){
		foreach($lang_cache as $lk=>$lv){
			if(empty($lang_value[$lv['lang_tag']])){$lang_value[$lv['lang_tag']]='没有内容';}
			$n=$GLOBALS['mysql']->fetch_rows("select id from ".DB_PRE."lang_lang where lang_tag='".$lang_tag."' and lang='".$lv['lang_tag']."'");
			if($n){continue;}
			$sql="insert into ".DB_PRE."lang_lang (lang_tag,lang_value,lang) values ('{$lang_tag}','{$lang_value[$lv['lang_tag']]}','{$lv['lang_tag']}')";
			$GLOBALS['mysql']->query($sql);
			//写入缓存
			$sql="select lang_tag,lang_value from ".DB_PRE."lang_lang where lang='".$lv['lang_tag']."' order by id desc";
			$rel=$GLOBALS['mysql']->fetch_asc($sql);
			$language=array();
			if(!empty($rel)){
				foreach($rel as $k=>$v){
					$language[$v['lang_tag']]=$v['lang_value'];
				}
			}
	
			$lang_file=LANG_PATH.'lang_'.$lv['lang_tag'].'.php';
			$str="<?php\n\$language=".var_export($language,true).";\n?>";
			creat_inc($lang_file,$str);
		}
	}
	msg('语言变量添加完成','?action=add_lang&lang='.$lang.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}
//修改语言包语言
elseif($action=='lang_lang_edit'){
	$id=intval($_GET['id']);
	if(empty($lang)||empty($id)){msg('<span style="color:red">参数传递错误，请重新操作</span>');}
	$rel=$GLOBALS['mysql']->fetch_asc("select*from ".DB_PRE."lang_lang where id=".$id);
	include('template/admin_lang_lang_edit.php');
}
//处理修改的语言包语言
elseif($action=='save_lang_lang_edit'){
	$id=intval($_POST['id']);
	$lang_value=$_POST['lang_value'];
	if(empty($lang)){msg('<span style="color:red">参数发生错误，请重新操作</span>');}
	if(strlen($lang_value)>60){msg('<span style="color:red">变量值太长，请缩短</span>');}
	$sql="update ".DB_PRE."lang_lang set lang_value='{$lang_value}' where id=".$id;
	$GLOBALS['mysql']->query($sql);
	//写入缓存
	$sql="select lang_tag,lang_value from ".DB_PRE."lang_lang where lang='{$lang}' order by id desc";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	$language=array();
	if(!empty($rel)){
	foreach($rel as $k=>$v){
		$language[$v['lang_tag']]=$v['lang_value'];
	}
	}
	$lang_file=LANG_PATH.'lang_'.$lang.'.php';
	$str="<?php\n\$language=".var_export($language,true).";\n?>";
	creat_inc($lang_file,$str);
	msg('语言变量修改完成','?action=edit&lang='.$lang.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}
//删除语言包语言
elseif($action=='del_lang_lang'){
	if(!check_purview('lang_lang')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$id=$_GET['id'];
	if(empty($lang)||empty($id)){msg('<span style="color:red">参数发生错误，请重新操作</span>');}
	$GLOBALS['mysql']->query("delete from ".DB_PRE."lang_lang where id=".intval($id));
	//写入缓存
	$sql="select lang_tag,lang_value from ".DB_PRE."lang_lang where lang='{$lang}' order by id desc";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	$language=array();
	if(!empty($rel)){
	foreach($rel as $k=>$v){
		$language[$v['lang_tag']]=$v['lang_value'];
	}
	}
	$lang_file=LANG_PATH.'lang_'.$lang.'.php';
	$str="<?php\n\$language=".var_export($language,true).";\n?>";
	creat_inc($lang_file,$str);
	msg('语言变量删除完成','?action=edit&lang='.$lang.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}
echo PW;
?>
