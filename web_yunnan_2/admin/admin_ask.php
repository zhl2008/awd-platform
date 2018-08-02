<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/
define('IN_CMS','true');
include('init.php');
$action=isset($_REQUEST['action'])?fl_html(fl_value($_REQUEST['action'])):'ask';
$lang=isset($_REQUEST['lang'])?fl_html(fl_value($_REQUEST['lang'])):get_lang_main();


//咨询列表
if($action=='ask'){
if(!check_purview('user_ask')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
include('template/admin_ask.php');
}

//咨询回复界面
elseif($action=='reply'){
if(!check_purview('user_ask')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
$id = intval($_GET['id']);
if(empty($id)){msg("<span style=\"color:red\">参数错误</span>","?");}
$rel_rp=$GLOBALS['mysql']->fetch_asc("select*from ".DB_PRE."ask where id={$id}");
include('template/admin_ask_reply.php');
}


//咨询处理
elseif($action=='save_reply'){
if(!check_purview('user_ask')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
$id = intval($_POST['id']);
$reply = $_POST['reply'];
$member_id = $_POST['member_id'];
$is_mail = $_POST['is_mail'];
$replytime = $_POST['replytime'];
if(empty($id)){msg("<span style=\"color:red\">参数错误</span>","?");}
$replytime=empty($replytime)?time():$replytime;
$sql="update ".DB_PRE."ask set reply='{$reply}',replytime='{$replytime}' where id={$id}";
$GLOBALS['mysql']->query($sql);
//发送邮件

if(in_array('2',$_sys['mail_feed'])){
	if($is_mail){
		$m_rel = $mysql->fetch_asc('select member_mail from '.DB_PRE.'member where id='.$member_id);
		$m_mail = $m_rel[0]['member_mail'];
	}
	if($m_mail){
		$rel = $mysql->fetch_asc('select*from '.DB_PRE.'ask where id='.$id);
		$html='<style type="text/css">';
		$html.='.title{font-size:14px; font-weight:bold;}';
		$html.='.body,.huifu_body{margin:5px 0; font-size:14px; line-height:24px;}';
		$html.='.huifu{font-size:14px; font-weight:bold;}';
		$html.='</style>';
		$html.='<div class="title">'.$rel[0]['title'].'</div>';
		$html.='<div class="body">'.$rel[0]['content'].'</div>';
		$html.='<div class="huifu">回复(Reply):</div>';
		$html.='<div class="huifu_body">'.$rel[0]['reply'].'</div>';
		$html.='<div>--------------------------------------------------------------------------------------------------------</div>';
		$html.=$_sys['mail_jw'];
		$_sys['mail_js'] = empty($_sys['mail_js'])?$_sys['mail_mail']:$_sys['mail_js'];
		if($html){
			beescms_smtp_mail($_sys['mail_js'],'','回复(Reply):'.$rel[0]['title'],$hmtl);
		}	
	}	
}
msg("咨询回复成功","?lang=".$lang.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}

//删除咨询
elseif($action=='del'){
if(!check_purview('user_ask')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
$id = intval($_GET['id']);
$GLOBALS['mysql']->query("delete from ".DB_PRE."ask where id={$id}");
msg("咨询删除完成","?lang=".$lang.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}

echo PW;
?>