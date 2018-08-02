<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

define('IN_CMS','true');
include('init.php');
$action=isset($_REQUEST['action'])?fl_html(fl_value($_REQUEST['action'])):'list';
$lang=isset($_REQUEST['lang'])?fl_html(fl_value($_REQUEST['lang'])):get_lang_main();
if(file_exists(DATA_PATH.$lang.'_info.php')){include(DATA_PATH.$lang.'_info.php');}


//链接界面
if($action=='list'){
if(!check_purview('content_create')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$page = intval($_REQUEST['page']);
	$verify = $_REQUEST['verify'];
	$order = $_REQUEST['order'];
	$key=empty($_REQUEST['key'])?'':$_REQUEST['key'];
 include('template/admin_content_link.php');
}
echo PW;
?>