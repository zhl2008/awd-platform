<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

define('IN_CMS','true');
include('init.php');
$action=isset($_REQUEST['action'])?fl_html(fl_value($_REQUEST['action'])):'index';
$lang=isset($_REQUEST['lang'])?fl_html(fl_value($_REQUEST['lang'])):'';
//首页配置界面
if($action=='index'){
	if(file_exists(DATA_PATH.'index_info.php')){
		include(DATA_PATH.'index_info.php');
	}
	$index_info=isset($_index)?$_index:array('flash_is'=>0);
	if(file_exists(DATA_PATH.'cache/lang_cache.php')){
		include(DATA_PATH.'cache/lang_cache.php');
	}
	include('template/admin_index_info.php');
}
//处理首页配置
elseif($action=='save_index'){
	if(!check_purview('index_info')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	if(!isset($_POST['submit'])){
		msg('<span style="color:red">请从表单提交</span>');
	}
	unset($_POST['action'],$_POST['submit']);
	$info=array();
	foreach($_POST as $k=>$v){
		$info[$k]=$v;
	}
	//是否存在
	if($GLOBALS['mysql']->fetch_rows("select id from ".DB_PRE."cmsinfo where info_tag='index_info'")){
$sql="update ".DB_PRE."cmsinfo set info_array='".addslashes(var_export($info,'true'))."' where info_tag='index_info'";
}else{
$sql="insert into ".DB_PRE."cmsinfo (info_tag,info_array,info_name) values ('index_info','".addslashes(var_export($info,true))."','首页配置')";
}
$GLOBALS['mysql']->query($sql);
$s="<?php\n\$_index=".var_export($info,true).";\n?>";
$file=DATA_PATH.'index_info.php';
creat_inc($file,$s);
	msg('网站配置成功');	
}
echo PW;
?>