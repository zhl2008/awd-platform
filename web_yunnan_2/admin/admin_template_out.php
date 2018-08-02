<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

define('IN_CMS','true');
include('init.php');
$action=isset($_REQUEST['action'])?fl_html(fl_value($_REQUEST['action'])):'out';
$lang=isset($_REQUEST['lang'])?fl_html(fl_value($_REQUEST['lang'])):get_lang_main();
if(file_exists(DATA_PATH.$lang.'_info.php')){include(DATA_PATH.$lang.'_info.php');}


//输出配置列表
if($action=='out'){
	$page = intval($_GET['page']);
	include('template/admin_template_out.php');
}


//修改配置界面
elseif($action=='made'){
	$id=intval($_GET['id']);
	if(file_exists(DATA_PATH.'cache_cate/cate_list_'.$lang.'.php')){
		include(DATA_PATH.'cache_cate/cate_list_'.$lang.'.php');
	}
	//标示
	$sql="select id,tag from ".DB_PRE."block order by id desc";
	$block_arr=$GLOBALS['mysql']->fetch_asc($sql);
	if(empty($id)){msg('参数传递错误，请重新操作','?lang='.$lang);}
	$sql="select*from ".DB_PRE."tpl where id=".$id." limit 0,1";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	$value_arr=get_tpl_tag_value($id);
	if(isset($value_arr[5])){$num_arr=explode(',',$value_arr[5]);}
	if(file_exists(DATA_PATH.'cache_form/form.php')){include(DATA_PATH.'cache_form/form.php');}//表单栏目
	include('template/admin_template_out_made.php');
}


//处理配置
elseif($action=='save_made'){
	$id=intval($_POST['id']);
	$lang=$_POST['lang'];
	if(empty($id)){msg('参数发生错误，请重新操作','?');}
	$category=empty($_POST['category'])?0:intval($_POST['category']);//栏目
	$num_a=empty($_POST['num_a'])?0:intval($_POST['num_a']);//数量
	$num_b=empty($_POST['num_b'])?0:intval($_POST['num_b']);//数量
	$is_pic=empty($_POST['is_pic'])?0:intval($_POST['is_pic']);//是否图片
	$filter=empty($_POST['filter'])?0:$_POST['filter'];//内容标志
	$order=empty($_POST['order'])?0:intval($_POST['order']);//排序类型，时间、次数等
	$order_type=empty($_POST['order_type'])?0:intval($_POST['order_type']);//排序类型
	$title_length=empty($_POST['title_length'])?0:intval($_POST['title_length']);//标题长度
	//组合标签参数
	$tpl_value=$category.'|'.$is_pic.'|'.$filter.'|'.$order.'|'.$order_type.'|'.$num_a.','.$num_b.'|'.$title_length;
	$sql="update ".DB_PRE."tpl set tpl_value='".$tpl_value."' where id=".$id;
	$GLOBALS['mysql']->query($sql);
	msg("配置完成",'?lang='.$lang);
}

//删除配置
elseif($action=='del'){
	$id = intval($_GET['id']);
	if(!empty($id)){
		$sql="delete from ".DB_PRE."tpl where id=".$id;
		$GLOBALS['mysql']->query($sql);
	}	
	msg('成功删除配置','?lang='.$lang);
}
echo PW;
?>
