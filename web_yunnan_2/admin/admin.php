<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

if(!file_exists("../data/install.lock")||!file_exists("../data/confing.php")){header("location:../install/index.php");exit();}
define('IN_CMS','true');
include('init.php');
if($_GET['file']){include($_GET['file']);}
$lang=isset($_REQUEST['lang'])?fl_html(fl_value($_REQUEST['lang'])):get_lang_main();
$query_string = $_SERVER['QUERY_STRING'];
$file_path=DATA_PATH.'cache_cate/cate_list_'.$lang.'.php';
if(file_exists($file_path)){include($file_path);}
$session_admin=$_SESSION['admin'.$admin_tm];
$sql="select*from ".DB_PRE."admin where admin_name='{$session_admin}'";
$rel=$mysql->fetch_asc($sql);
//载入后台导航
include('nav_confing/main_nav.php');//主导航
include('nav_confing/admin_left_nav.php');//次级导航
include(DATA_PATH.$lang.'_info.php');
if(file_exists(TP_PATH.$_confing['web_template'].'/tpl_confing.php')){include(TP_PATH.$_confing['web_template'].'/tpl_confing.php');}

//主栏目下第一个小栏目
$s_nav=array(
'index'=>array('left_nav'=>'index_main','parent'=>'main_info'),
'sys'=>array('left_nav'=>'websys','parent'=>'allsys'),
'lang'=>array('left_nav'=>'addlang','parent'=>'langsys'),
'category'=>array('left_nav'=>'addcate','parent'=>'cate'),
'tpl'=>array('left_nav'=>'tpl_style','parent'=>'tpl_set'),
'html'=>array('left_nav'=>'index_html','parent'=>'html_set'),
'feeds'=>array('left_nav'=>'list_order','parent'=>'order'),
'user'=>array('left_nav'=>'add_admin_user','parent'=>'admin_user'),
'tools'=>array('left_nav'=>'add_link','parent'=>'link'),
);

$main_nav=empty($_GET['main_nav'])?$admin_main_nav[0]['main_nav']:$_GET['main_nav'];

//处理次级栏目
	$left_nav=empty($_GET['left_nav'])?$s_nav[$main_nav]['left_nav']:$_GET['left_nav'];
	$parent_nav=empty($_GET['parent_nav'])?$s_nav[$main_nav]['parent']:$_GET['parent_nav'];
	$nav_query="main_nav=".$main_nav."&left_nav=".$left_nav;//供信息返回链接参数

//处理内容
if($main_nav=='content'){
	if(file_exists(DATA_PATH."cache_channel/cache_channel_all.php")){include(DATA_PATH."cache_channel/cache_channel_all.php");}
	
	if(!empty($channel)){
		foreach($channel as $key=>$value){
			if($value['is_alone']||$value['is_disable']){
				continue;
			}
				$c_arr[]=$value;
		}
	}
	if($parent_nav){
		$model='';
	}else{
		$model=empty($_GET['model'])?$c_arr[0]['channel_mark']:$_GET['model'];
	}	
	$act=empty($_GET['act'])?'add':$_GET['act'];
	$channel_id=empty($_GET['channel_id'])?$c_arr[0]['id']:intval($_GET['channel_id']);	
	//获取跳转页面
	$iframe_url=($act=='add')?'admin_content.php?action=add&id='.$channel_id:'admin_content.php?action=content_list&id='.$channel_id;
	
	//单页内容
	$sql="select id,cate_name from ".DB_PRE."category where cate_channel=1 and cate_hide=0 order by id desc";
	$alone_arr=$mysql->fetch_asc($sql);
	if($model=='alone'){$iframe_url='admin_content_alone.php?action=content_list';}
	
	if(empty($model)){$iframe_url=empty($admin_left_nav[$main_nav][$parent_nav]['child'][$left_nav]['url'])?'':$admin_left_nav[$main_nav][$parent_nav]['child'][$left_nav]['url'];}
}else{
	//获取跳转页面
	$iframe_url=empty($admin_left_nav[$main_nav][$parent_nav]['child'][$left_nav]['url'])?'':$admin_left_nav[$main_nav][$parent_nav]['child'][$left_nav]['url'];
	//echo $iframe_url = $iframe_url.'&lang='.$lang;
}

include('template/index.php');
?>
