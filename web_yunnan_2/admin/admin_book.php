<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

define('IN_CMS','true');
include('init.php');
$action=isset($_REQUEST['action'])?fl_html(fl_value($_REQUEST['action'])):'book_list';
$lang=isset($_REQUEST['lang'])?fl_html(fl_value($_REQUEST['lang'])):get_lang_main();

//设置留言本界面
if($action=='made'){
	$sql="select*from ".DB_PRE."book_info where id=1";
	$rel=$mysql->fetch_asc($sql);
	$book_pos=(isset($rel[0]['book_pos'])&&!empty($rel[0]['book_pos']))?explode(',',$rel[0]['book_pos']):array('0');
	include('template/admin_book_info.php');
}

//处理配置
elseif($action=='save_book_info'){
	$is_book=intval($_POST['is_book']);
	$book_pos=$_POST['book_pos'];
	$book_verify=intval($_POST['book_verify']);
	$pos=is_array($book_pos)?implode(',',$book_pos):'';
	$sql="update ".DB_PRE."book_info set is_book='{$is_book}',book_pos='{$pos}',book_verify='{$book_verify}' where id=1";
	$mysql->query($sql);
	msg('配置完成','?action=made&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);	
}
//留言列表
elseif($action=='book_list'){
	include('template/admin_book_list.php');
}
//审核留言,全部审核
elseif($action=='verify'){
	$all=$_POST['all'];
	if(empty($all)){die("<script type=\"text/javascript\">alert('请选择需要审核的内容');history.go(-1);</script>");}
	foreach($all as $k=>$v){
		$sql="update ".DB_PRE."book set verify=1 where id=".intval($v);
		$mysql->query($sql);
	}
	die("<script type=\"text/javascript\">alert('审核完成');location.href='?action=book_list&lang=".$lang."&nav=".$admin_nav."&admin_p_nav=".$admin_p_nav."';</script>");
}
//显示留言
elseif($action=='reply'){
	$id=intval($_REQUEST['id']);
	if(empty($id)){die("<script type=\"text/javascript\">alert('参数发生错误，请重新操作');history.go(-1);</script>");}
	$sql="select*from ".DB_PRE."book where id=".$id;
	$rel=$mysql->fetch_asc($sql);
	$book_type_arr=array('留言','投诉','询问','售后');
	if(!empty($rel[0]['pr_id'])){$pr_rel=$mysql->fetch_asc("select title from ".DB_PRE."maintb where id=".$rel[0]['pr_id']);};
	include('template/admin_book_reply.php');
}
//回复内容
elseif($action=='save_reply'){
	$id=intval($_POST['id']);
	if(empty($id)){die("<script type=\"text/javascript\">alert('参数发生错误，请重新操作');history.go(-1);</script>");}
	$reply=$_POST['reply'];
	if(empty($reply)){die("<script type=\"text/javascript\">alert('回复内容不能为空');history.go(-1);</script>");}
	$sql="update ".DB_PRE."book set reply='".$reply."' where id=".$id;
	$mysql->query($sql);
	//发送留言
	$is_mail = $_POST['is_mail'];
	if(@in_array('3',$_sys['mail_feed'])){
			$rel = $mysql->fetch_asc('select*from '.DB_PRE.'book where id='.$id);
			$html='<style type="text/css">';
			$html.='.title{font-size:14px; font-weight:bold;}';
			$html.='.body,.huifu_body{margin:5px 0; font-size:14px; line-height:24px;}';
			$html.='.huifu{font-size:14px; font-weight:bold;}';
			$html.='</style>';
			$html.='<div class="title">'.$rel[0]['book_title'].'</div>';
			$html.='<div class="body">'.$rel[0]['book_content'].'</div>';
			$html.='<div class="huifu">回复(Reply):</div>';
			$html.='<div class="huifu_body">'.$rel[0]['reply'].'</div>';
			$html.='<div>--------------------------------------------------------------------------------------------------------</div>';
			$html.=$_sys['mail_jw'];
			if($html){
				beescms_smtp_mail($_sys['mail_js'],'','回复(Reply):'.$rel[0]['title'],$hmtl); 
			}	
	}	
	die("<script type=\"text/javascript\">alert('回复完成');location.href='?action=book_list&lang=".$lang."&nav=".$admin_nav."&admin_p_nav=".$admin_p_nav."';</script>");
}
//删除留言，单个删除
elseif($action=='del'){
	$id=$_GET['id'];
	if(empty($id)){die("<script type=\"text/javascript\">alert('参数发生错误，请重新操作');history.go(-1);</script>");}
	$sql="delete from ".DB_PRE."book where id=".$id;
	$mysql->query($sql);
	msg('删除完成','?lang='.$lang.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}
//删除多选
elseif($action=='del_all'){
	$id=$_POST['all'];
	if(empty($id)){msg('请选择需要删除的内容','?lang='.$lang);}
	foreach($id as $k=>$v){
		$sql="delete from ".DB_PRE."book where id=".$v;
		$mysql->query($sql);
	}
	msg("所选内容已经删除",'?lang='.$lang.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}

echo PW;
?>
