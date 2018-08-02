<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

define('IN_CMS','true');
include('init.php');
$action=isset($_REQUEST['action'])?fl_html(fl_value($_REQUEST['action'])):'content';
$lang=isset($_REQUEST['lang'])?fl_html(fl_value($_REQUEST['lang'])):get_lang_main();

//添加标示内容界面
if($action=='content'){
	if(!check_purview('content_create')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	include('template/admin_content_tag.php');
}

//处理添加的标示内容
elseif($action=='save_content'){
	if(!check_purview('content_create')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$tag_name=$_POST['tag_name'];
	$tag = $_POST['tag'];
	$content = $_POST['content'];
	$lang=$_POST['lang'];
	if(empty($tag)){
		msg('<span style="color:red">标示名称不能为空</span>');
	}

	$tag_num=$GLOBALS['mysql']->fetch_rows("select id from ".DB_PRE."block where tag='{$tag}' and lang='{$lang}'");
	if($tag_num){msg('<span style="color:red">【'.$tag.'】内容已经存在，请更换</span>');}
	$tag=empty($_sys['web_content_title'])?cn_substr($tag,60):cn_substr($tag,intval($_sys['web_content_title']));
	
	$sql="insert into ".DB_PRE."block (tag_name,tag,content,lang) values ('{$tag_name}','{$tag}','{$content}','{$lang}')";
	$GLOBALS['mysql']->query($sql);
	msg("【{$tag}】内容添加完成",'?action=content_list&lang='.$lang.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}


//标示内容列表
elseif($action=='content_list'){
	$id = $_REQUEST['id'];
	$lang=isset($_REQUEST['lang'])?fl_html(fl_value($_REQUEST['lang'])):get_lang_main();
	include('template/admin_content_tag_list.php');
}

//修改标示内容界面
elseif($action=='edit_content'){
	if(!check_purview('content_edit')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$id = intval($_GET['id']);
	$lang = $_GET['lang'];
	if(empty($id)){
		msg('<span style="color:red">不存在相关内容</span>');
	}
	$arr=$GLOBALS['mysql']->fetch_asc("select*from ".DB_PRE."block where id={$id}");
	include('template/admin_content_tag_edit.php');
}

//处理修改的标示内容
elseif($action=='save_edit'){
	if(!check_purview('content_edit')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$id = intval($_POST['id']);
	$tag_name=$_POST['tag_name'];
	$content = $_POST['content'];
	$lang = $_POST['lang'];

	$sql="update ".DB_PRE."block set content='{$content}',tag_name='{$tag_name}',lang='{$lang}' where id={$id}";
	$GLOBALS['mysql']->query($sql);
	msg("内容修改完成",'?action=content_list&lang='.$lang.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}

//删除标示内容
elseif($action=='del'){	
	if(!check_purview('content_del')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$id = intval($_GET['id']);

	$GLOBALS['mysql']->query("delete from ".DB_PRE."block where id={$id}");
	msg('成功删除','admin_content_tag.php?action=content_list&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}
echo PW;
?>