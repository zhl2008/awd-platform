<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

define('IN_CMS','true');
include('init.php');
$action=isset($_REQUEST['action'])?fl_html(fl_value($_REQUEST['action'])):'template';
$lang=isset($_REQUEST['lang'])?fl_html(fl_value($_REQUEST['lang'])):get_lang_main();
$get=$_GET['get'];
//模板风格列表

	if(!check_purview('tpl_manage')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$path=empty($path)?'template'.'/':$path;
	if(!$file_hand=@opendir(CMS_PATH.$path)){
		err("模板目录打开失败,请检查【{$lang}】语言模板目录【{$_confing['web_template']}】");
	}
	if(file_exists(DATA_PATH.$lang.'_info.php')){include(DATA_PATH.$lang.'_info.php');}
	include('template/admin_sl_tpl.php');

?>
