<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

define('IN_CMS','true');
include('init.php');
$action=isset($_REQUEST['action'])?fl_html(fl_value($_REQUEST['action'])):'link_list';
$lang=isset($_REQUEST['lang'])?fl_html(fl_value($_REQUEST['lang'])):get_lang_main();


//添加链接界面
if($action=='add'){
if(!check_purview('link_add')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
 include('template/admin_link_add.php');
}

//保存添加的链接
elseif($action=='save_add'){
if(!check_purview('link_add')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
$link_url = $_POST['link_url'];
$link_name = $_POST['link_name'];
$link_logo = $_POST['link_logo'];
$link_order = intval($_POST['link_order']);
$link_info = $_POST['link_info'];
$link_mail = $_POST['link_mail'];
$link_type = intval($_POST['link_type']);

if(empty($lang)){msg("<span style=\"color:red\">【语言】参数发生错误</span>");}
if(empty($link_url)){msg("<span style=\"color:red\">【网站网址】不能为空</span>");}
if(empty($link_name)){msg("<span style=\"color:red\">【网站名称】不能为空</span>");}
$link_order=empty($link_order)?1:$link_order;

if(strlen($link_url)>60){msg('<span style=\"color:red\">网站网址太长，请缩短</span>');}
if(strlen($link_name)>60){msg('<span style=\"color:red\">网站名称太长，请缩短</span>');}
if(strlen($link_order)>60){msg('<span style=\"color:red\">排列顺序字数太长，请缩短</span>');}
if(strlen($link_info)>200){msg('<span style=\"color:red\">网站说明太长，请缩短</span>');}
if(strlen($link_mail)>60){msg('<span style=\"color:red\">站长Email太长，请缩短</span>');}

$sql="insert into ".DB_PRE."link (link_url,link_name,link_logo,link_order,link_info,link_mail,lang,addtime,link_type) values ('{$link_url}','{$link_name}','{$link_logo}',{$link_order},'{$link_info}','{$link_mail}','{$lang}','".time()."',{$link_type})";
$GLOBALS['mysql']->query($sql);
msg("【{$link_name}】网站链接添加成功","?lang=".$lang.'&nav=list_link&admin_p_nav='.$admin_p_nav);
}

//链接列表
elseif($action=='link_list'){
	include('template/admin_link_list.php');
}


//修改链接界面
elseif($action=='edit_link'){
	if(!check_purview('link_edit')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$id = intval($_GET['id']);
	if(empty($id)||empty($lang)){msg("<span style=\"color:red\">参数发生错误,请重新操作</span>");}
	$rel=$GLOBALS['mysql']->fetch_asc("select*from ".DB_PRE."link where id={$id} and lang='{$lang}'");
	if(empty($rel)){msg("不存在该链接,可能已经被删除","?lang=".$lang.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);}
	include('template/admin_link_edit.php');
}

//处理修改的链接
elseif($action=='save_edit'){
	if(!check_purview('link_edit')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	global $lang,$link_url,$link_name,$link_logo,$link_order,$link_info,$link_mail,$id;
	$link_url = $_POST['link_url'];
	$link_name = $_POST['link_name'];
	$link_logo = $_POST['link_logo'];
	$link_order = intval($_POST['link_order']);
	$link_info = $_POST['link_info'];
	$link_mail = $_POST['link_mail'];
	$link_type = intval($_POST['link_type']);
	$id = intval($_POST['id']);
	if(empty($id)||empty($lang)){msg("<span style=\"color:red\">参数发生错误,请重新操作</span>");}
	if(empty($link_url)){msg("<span style=\"color:red\">【网站网址】不能为空</span>");}
	if(empty($link_name)){msg("<span style=\"color:red\">【网站名称】不能为空</span>");}
	$link_order=empty($link_order)?1:$link_order;
	$link_info=empty($link_info)?'':cn_substr($link_info,255);
	if(strlen($link_url)>60){msg('<span style=\"color:red\">网站网址太长，请缩短</span>');}
	if(strlen($link_name)>60){msg('<span style=\"color:red\">网站名称太长，请缩短</span>');}
	if(strlen($link_order)>60){msg('<span style=\"color:red\">排列顺序字数太长，请缩短</span>');}
	if(strlen($link_mail)>60){msg('<span style=\"color:red\">站长Email太长，请缩短</span>');}
	$sql="update ".DB_PRE."link set link_url='{$link_url}',link_name='{$link_name}',link_logo='{$link_logo}',link_order={$link_order},link_info='{$link_info}',link_mail='{$link_mail}',link_type={$link_type} where id={$id} and lang='{$lang}'";
	$GLOBALS['mysql']->query($sql);
	msg("【{$link_name}】网站链接修改成功",'?action=link_list&lang='.$lang.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}

//删除链接
elseif($action=='del'){
	if(!check_purview('link_del')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$id = intval($_GET['id']);
	if(empty($id)||empty($lang)){msg("<span style=\"color:red\">参数发生错误,请重新操作</span>");}
	$GLOBALS['mysql']->query("delete from ".DB_PRE."link where id={$id} and lang='{$lang}'");
	msg("成功删除链接",'?lang='.$lang.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}
echo PW;
?>