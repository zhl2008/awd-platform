<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

define('IN_CMS','true');
include('init.php');
$action=isset($_GET['action'])?$_GET['action']:'lang_cate';
$channel_id=intval($_GET['id']);
$lang=$_GET['lang'];
if(file_exists(DATA_PATH.'cache/lang_cache.php')){include(DATA_PATH.'cache/lang_cache.php');}
if(!empty($lang_cache)){
	foreach($lang_cache as $k=>$v){
		if($v['lang_tag']==$lang){unset($lang_cache[$k]);}
	}
}
$langs=$lang_cache;
$first_lang=array_pop($langs);
$cate_lang=isset($_GET['cate_lang'])?$_GET['cate_lang']:$first_lang['lang_tag'];
if($action=='lang_cate'){
	$rel=$mysql->fetch_asc('select id,cate_name,cate_tpl from '.DB_PRE."category where lang='".$cate_lang."' and cate_channel=".$channel_id);
	include('template/admin_all_lang.php');
}
echo PW;
?>
