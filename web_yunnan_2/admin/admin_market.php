<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

define('IN_CMS','true');
include('init.php');
$action=isset($_REQUEST['action'])?fl_html(fl_value($_REQUEST['action'])):'market';
$lang=isset($_REQUEST['lang'])?fl_html(fl_value($_REQUEST['lang'])):get_lang_main();
if(file_exists(DATA_PATH.$lang.'_info.php')){include(DATA_PATH.$lang.'_info.php');}

if($action=='market'){
	$rel=$GLOBALS['mysql']->fetch_asc("select*from ".DB_PRE."market where lang='".$lang."' order by market_order asc");
	include('template/admin_market.php');
}
//添加客服界面
elseif($action=='add'){
	include('template/admin_market_add.php');
}
//处理添加的客服
elseif($action=='save_add'){
	$market_name=$_POST['market_name'];
	$market_type=$_POST['market_type'];
	$market_order=$_POST['market_order'];
	$market_is=$_POST['market_is'];
	$market_num=$_POST['market_num'];
	if(empty($lang)){msg('<span style="color:red">参数发生错误，请重新操作</span>');}
	if(empty($market_name)){msg('<span style="color:red">客服名称不能为空</span>');}
	if(empty($market_type)){msg('<span style="color:red">请选择客服类型</span>');}
	if(empty($market_num)){msg('<span style="color:red">客服号码不能为空</span>');}
	if(strlen($market_name)>60||strlen($market_num)>60){
		msg('<span style="color:red">添加写内容过长，请缩短填写</span>');
	}
	if(empty($market_order)){msg('<span style="color:red">排序不能为空</span>');}
	$sql="insert into ".DB_PRE."market (market_name,market_type,market_num,market_order,market_is,lang) values ('".trim($market_name)."',".intval($market_type).",'".trim($market_num)."','".intval($market_order)."',".intval($market_is).",'".$lang."')";
	$GLOBALS['mysql']->query($sql);
	msg('客服【'.$market_name.'】添加完成','?lang='.$lang.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}
//修改客服
elseif($action=='edit'){
	$id=intval($_GET['id']);
	if(empty($id)){msg('<span style="color:red">参数发生错误,请重新操作</span>');}
	$rel=$GLOBALS['mysql']->fetch_asc("select*from ".DB_PRE."market where id=".$id);
	include('template/admin_market_edit.php');
}
//处理修改的客服
elseif($action=='save_edit'){
	$id=intval($_POST['id']);
	$market_name=$_POST['market_name'];
	$market_type=$_POST['market_type'];
	$market_order=$_POST['market_order'];
	$market_is=$_POST['market_is'];
	$market_num=$_POST['market_num'];
	if(empty($id)){msg('<span style="color:red">参数发生错误，请重新操作</span>');}
	if(empty($market_name)){msg('<span style="color:red">客服名称不能为空</span>');}
	if(empty($market_type)){msg('<span style="color:red">请选择客服类型</span>');}
	if(empty($market_num)){msg('<span style="color:red">客服号码不能为空</span>');}
	if(strlen($market_name)>60||strlen($market_num)>60){
		msg('<span style="color:red">添加写内容过长，请缩短填写</span>');
	}
	if(empty($market_order)){msg('<span style="color:red">排序不能为空</span>');}
	$sql="update ".DB_PRE."market set market_name='".trim($market_name)."',market_type=".intval($market_type).",market_num='".$market_num."',market_order='".intval($market_order)."',market_is='".$market_is."' where id=".$id;
	$GLOBALS['mysql']->query($sql);
	msg('客服【'.$market_name.'】修改成功','?lang='.$lang.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}
//删除客服
elseif($action=='del'){
	$id=intval($_GET['id']);
	if(empty($id)){msg('<span style="color:red">参数发生错误，请重新操作</span>');}
	$GLOBALS['mysql']->query("delete from ".DB_PRE."market where id=".$id);
	msg('客服删除成功','?lang='.$lang.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}
//ajax修改排序
elseif($action=='ajax_order'){
	$id=intval($_POST['id']);
	$order_id=intval($_POST['order_id']);
	if(empty($id)){die('参数错误');}
	$sql="update ".DB_PRE."market set market_order='".$order_id."' where id=".$id;
	$GLOBALS['mysql']->query($sql);
}
//ajax修改使用
elseif($action=='ajax_use'){
	$id=intval($_POST['id']);
	$is_use=intval($_POST['is_use']);
	if(empty($id)){exit;}
	$sql="update ".DB_PRE."market set market_is=".$is_use." where id=".$id;
	$GLOBALS['mysql']->query($sql);
}
echo PW;
?>
