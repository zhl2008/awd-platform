<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

define('IN_CMS','true');
include('init.php');
$action=isset($_REQUEST['action'])?fl_html(fl_value($_REQUEST['action'])):'keywords';
$lang=isset($_REQUEST['lang'])?fl_html(fl_value($_REQUEST['lang'])):get_lang_main();

//关键词列表
if($action=='keywords'){
	$page=$_GET['page'];
	include('template/admin_keywords.php');
}
//添加关键词界面
elseif($action=='add'){
	include('template/admin_keywords_add.php');
}
//处理添加关键词
elseif($action=='save_words'){
	$key_words=$_POST['key_words'];
	$words_url=$_POST['words_url'];
	$words_order = intval($_POST['words_order']);
	if(empty($key_words)||empty($words_url)){msg('<span style="color:red">关键词和链接地址不能为空</span>');}
	if(empty($lang)){msg('<span style="color:red">参数传递错误，请重新操作</span>','?action=keywords');}
	$keywords=cn_substr(trim($key_words),60);
	$wordsurl=cn_substr(trim($words_url),60);
	$GLOBALS['mysql']->query('insert into '.DB_PRE."keywords (keywords,wordsurl,lang,wordsorder) values ('{$keywords}','{$wordsurl}','{$lang}','{$words_order}')");
	msg('关键词【'.$keywords.'】添加完成','?action=keywords&lang='.$lang);
}
//修改关键词
elseif($action=='edit'){
	$id=intval($_GET['id']);
	if(empty($lang)||empty($id)){msg('<span style="color:red">参数传递错误，请重新操作！</span>');}
	$rel=$GLOBALS['mysql']->fetch_asc('select*from '.DB_PRE.'keywords where id='.$id." and lang='".$lang."'");
	include('template/admin_keywords_edit.php');
}
//处理修改的关键词
elseif($action=='save_edit'){
	$id=intval($_POST['id']);
	$key_words=$_POST['key_words'];
	$words_url=$_POST['words_url'];
	$words_order = intval($_POST['words_order']);
	if(empty($id)){msg('<span style="color:red">参数发生错误，请重新操作</span>');}
	if(empty($key_words)||empty($words_url)){msg('<span style="color:red">关键词和链接地址不能为空</span>');}
	$keywords=cn_substr(trim($key_words),60);
	$wordsurl=cn_substr(trim($words_url),60);
	$GLOBALS['mysql']->query("update ".DB_PRE."keywords set keywords='{$keywords}',wordsurl='{$wordsurl}',wordsorder='{$words_order}' where id={$id}");
	msg('关键词【'.$keywords.'】修改成功','?action=keywords&lang='.$lang);
}
//删除关键词
elseif($action=='del'){
	$id=intval($_GET['id']);
	$GLOBALS['mysql']->query('delete from '.DB_PRE.'keywords where id='.$id);
	msg('删除完成','?action=keywords&lang='.$lang);
}
echo PW;
?>
