<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

define('IN_CMS','true');
include('init.php');
$action=isset($_REQUEST['action'])?fl_html(fl_value($_REQUEST['action'])):'info';
$lang=isset($_REQUEST['lang'])?fl_html(fl_value($_REQUEST['lang'])):get_lang_main();


//网站配置
if($action=='info'){
if(file_exists(DATA_PATH.$lang.'_info.php')){
	include(DATA_PATH.$lang.'_info.php');
}
if(file_exists(TP_PATH.$_confing['web_template'].'/tpl_confing.php')){include(TP_PATH.$_confing['web_template'].'/tpl_confing.php');}
if(!empty($_confing)){
foreach($_confing as $k=>$v){
	$_confing[$k]=stripslashes($v);
}
}
include('template/admin_info.php');
}

//处理配置信息
elseif($action=='add_inc'){
if(!check_purview('web_info')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
if(empty($lang)){
	msg('<span style="color:red">参数传递错误,请重新操作</span>');
}
if(file_exists(DATA_PATH.$lang.'_info.php')){include(DATA_PATH.$lang.'_info.php');}
unset($_POST['action'],$_POST['submit'],$_POST['lang']);
foreach($_POST as $k=>$v){
	//if(in_array($k,array('web_powerby','web_beian','web_yinxiao'))){$v=htmlspecialchars($v);}
	if(is_array($v)){
	$info[$k]=$v[0];
	}else{
	$info[$k]=$v;
	}
}
//更换模板清除现有配置
$web_template=$_POST['web_template'];
if($web_template!=$_confing['web_template']){
	//清除缓存编译文件
	$GLOBALS['tpl']->del_cache();
}
//更换模板清除现有配置
$phone_template=$_POST['phone_template'];
if($phone_template!=$_confing['phone_template']){
	//清除缓存编译文件
	$GLOBALS['tpl']->del_cache();
}
if($GLOBALS['mysql']->fetch_rows("select id from ".DB_PRE."cmsinfo where lang_tag='".$lang."' and info_tag='info'")){
$sql="update ".DB_PRE."cmsinfo set info_array='".addslashes(var_export($info,'true'))."' where lang_tag='".$lang."' and info_tag='info'";
}else{
$sql="insert into ".DB_PRE."cmsinfo (info_tag,info_array,info_name,lang_tag) values ('info','".addslashes(var_export($info,true))."','网站配置','".$lang."')";
}
$GLOBALS['mysql']->query($sql);
if(!empty($info)){
$s="<?php\n\$_confing=".var_export($info,true).";\n?>";
}
$file=DATA_PATH.$lang.'_info.php';
creat_inc($file,$s);
	msg('网站配置成功','?lang='.$lang.'&'.$nav_query.'nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}
echo PW;
?>
