<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

//if(!file_exists("../data/install.lock")||!file_exists("../data/confing.php")){header("location:../install/index.php");exit();}
define('CMS',true);
require_once('../includes/init.php');
require_once('../includes/fun.php');
require_once('../includes/lib.php');
$action=isset($_REQUEST['action'])?trim($_REQUEST['action']):'book';
$lang=isset($_REQUEST['lang'])?htmlspecialchars(fl_value($_REQUEST['lang'])):get_main_lang();
if(file_exists(LANG_PATH.'lang_'.$lang.'.php')){include(LANG_PATH.'lang_'.$lang.'.php');}//语言包缓存,数组$language
if(file_exists(DATA_PATH.'cache_cate/cate_list_'.$lang.'.php')){include(DATA_PATH.'cache_cate/cate_list_'.$lang.'.php');}//当前语言下的栏目
$_confing=get_confing($lang);
$tpl->template_dir=(IS_MB)?TP_PATH.$_confing['phone_template'].'/':TP_PATH.$_confing['web_template'].'/';//设置模板
$tpl->template_lang=$lang;//语言
$tpl->template_is_cache=0;//缓存	
$tpl->assign('lang',$lang);
$book_focus='focus';
//留言页
if($action=='book'){
	$pr_id = intval($_GET['pr_id']);
	if(!empty($pr_id)){
		$arc_rel=$mysql->fetch_asc("select title from ".DB_PRE."maintb where id=".$pr_id);
		$arc_title=$arc_rel[0]['title'];
	}
	$page=empty($_GET['page'])?1:intval($_GET['page']);
	$pagesize=15;
	$pagenum=($page-1)*$pagesize;
	$query='&lang='.$lang;
	$total_num=$GLOBALS['mysql']->fetch_rows("select id from ".DB_PRE."book as m where verify=1 and lang='".$lang."'");
	$total_page=ceil($total_num/$pagesize);
	$sql="select*from ".DB_PRE."book where verify=1 and lang='".$lang."' order by addtime desc limit {$pagenum},{$pagesize}";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	if(!empty($rel)){
		foreach($rel as $k=>$v){
			if($v['book_type']==1){
				$rel[$k]['book_type']="投诉";
			}elseif($v['book_type']==2){
				$rel[$k]['book_type']="询问";
			}elseif($v['book_type']==3){
				$rel[$k]['book_type']="售后";
			}else{
				$rel[$k]['book_type']="留言";
			}
			if(!empty($v['pr_id'])){
				$pr_rel=$mysql->fetch_asc("select title from ".DB_PRE."maintb where id=".$v['pr_id']);
				$rel[$k]['pr_title']=$pr_rel[0]['title'];
				unset($pr_rel);
			}
		}
	}
	//防垃圾信息变量
	$book_code=time().rand(0,1000);
	session_start();
	$_SESSION['book_code']=$book_code;
	$tpl->assign('book_code',$book_code);
	$tpl->assign('title',$arc_title);
	$tpl->assign('pr_id',$pr_id);
	$tpl->assign('book',$rel);
	$tpl->assign('page',page(CMS_SELF.'book/book.php',$page,$query,$total_num,$total_page,'',1));
	$tpl->display('book');//载入模板
}	
//添加留言
elseif($action=='add'){
	//是否开启留言本
	$is_use=$mysql->get_row("select is_book from ".DB_PRE."book_info where id=1");
	if(!$is_use){die("<script type=\"text/javascript\">alert('".$language['book_msg1']."');history.go(-1);</script>");}
	$book_code=$_POST['book_code'];
	if($book_code!=$_SESSION['code']){die("<script type=\"text/javascript\">alert('{$language['member_msg2']}');history.go(-1);</script>");}
	$book_name=fl_html($_POST['book_name']);
	$book_title=fl_html($_POST['book_title']);
	$mail=fl_html($_POST['mail']);
	$book_type=intval($_POST['book_type']);
	$book_content=fl_html($_POST['book_content']);
	$pr_id=intval($_POST['pr_id']);
	if(empty($book_title)){die("<script type=\"text/javascript\">alert('".$language['book_msg2']."');history.go(-1);</script>");}
	if(empty($book_content)){die("<script type=\"text/javascript\">alert('".$language['book_msg3']."');history.go(-1);</script>");}
	$book_name=empty($book_name)?(empty($_SESSION['member_user'])?'游客':$_SESSION['member_user']):cn_substr($book_name,50);
	$book_title=$book_title;
	$book_content=$book_content;
	$addtime=time();
	//是否开启审核
	$is_verify=$mysql->get_row("select book_verify from ".DB_PRE."book_info where id=1");
	$verify=($is_verify)?0:1;
	$sql="insert into ".DB_PRE."book (book_name,book_title,book_content,mail,book_type,pr_id,addtime,verify,lang) values ('{$book_name}','{$book_title}','{$book_content}','{$mail}',{$book_type},{$pr_id},'{$addtime}',{$verify},'{$lang}')";
	$mysql->query($sql);
	//发送邮件
	if(!empty($_sys['mail_feed'])){
	if(in_array('3',$_sys['mail_feed'])){
		$html='<style type="text/css">';
		$html.='.title{font-size:14px;}';
		$html.='.body,.huifu_body{margin:5px 0; font-size:14px; line-height:24px;}';
		$html.='.huifu{font-size:14px; }';
		$html.='span{font-size:14px; font-weight:bold;}';
		$html.='</style>';
		$html.='<div class="title"><span>标题：</span>'.$book_title.'</div>';
		$html.='<div class="title"><span>时间：</span>'.date('Y-m-d H:m:s',$addtime).'</div>';
		$html.='<div class="body"><span>内容：</span>'.$book_content.'</div>';
		$html.='<div>--------------------------------------------------------------------------------------------------------</div>';
		$html.=$_sys['mail_jw'];
		$_sys['mail_js'] = empty($_sys['mail_js'])?$_sys['mail_mail']:$_sys['mail_js'];
		if($html){
			beescms_smtp_mail($_sys['mail_js'],'','留言:'.$book_title,$hmtl);
		}	
	}
	}
	die("<script type=\"text/javascript\">alert('".$language['book_msg4']."');location.href='".CMS_SELF."book/book.php?lang=".$lang."';</script>");
}
?>
