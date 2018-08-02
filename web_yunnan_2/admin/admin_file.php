<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

define('IN_CMS','true');
include('init.php');
$action=isset($_REQUEST['action'])?fl_html(fl_value($_REQUEST['action'])):'file_list';
$lang=isset($_REQUEST['lang'])?fl_html(fl_value($_REQUEST['lang'])):get_lang_main();


//附件列表
if($action=='file_list'){
	if(!check_purview('file_manage')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$maintb=DB_PRE."upfiles";
	$page=empty($_GET['page'])?1:intval($_GET['page']);
	$pagesize=20;
	$pagenum=($page-1)*$pagesize;
	$query='&type='.$type.'&get='.$get;
	$order='order by m.id desc';
	$total_num=$GLOBALS['mysql']->fetch_rows("select m.id from {$maintb} as m ");
	$total_page=ceil($total_num/$pagesize);
	$sql="select m.* from {$maintb} as m {$order} limit {$pagenum},{$pagesize}";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	include('template/admin_file.php');
}


//删除文件
elseif($action=='del'){
	if(!check_purview('file_manage')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$id=intval($_GET['id']);
	if(empty($id)){msg('参数发生错误，请重新操作！');}
	$sql="select file_path from ".DB_PRE."upfiles where id=".$id;
	$rel=$mysql->fetch_asc($sql);
	$file=CMS_PATH.$rel[0]['file_path'];
	//删除文件
	@unlink($file);
	//删除数据
	$mysql->query("delete from ".DB_PRE."upfiles where id=".$id);
	msg('文件删除成功！','?');
}

//复制目录
elseif($action=='edit_file'){
	if(!check_purview('file_manage')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$id = intval($_GET['id']);
	if(empty($id)){msg('参数发生错误，请重新操作');}
	$sql="select * from ".DB_PRE."upfiles where id=".$id;
	$rel=$mysql->fetch_asc($sql);
	include('template/admin_file_edit.php');
}

//处理修改的文件
elseif($action=='save_edit'){
	if(!check_purview('file_manage')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$id=intval($_POST['id']);
	if(empty($id)){msg('参数发生错误,请重新操作');}
	$file_info=$_POST['file_info'];
	$hits=empty($_POST['hits'])?0:intval($_POST['hits']);
	//更新图片信息
	$sql="update ".DB_PRE."upfiles set file_info='".$file_info."',hits=".$hits." where id=".$id;
	$mysql->query($sql);
	msg('文件更新成功！','?');
}
echo PW;
?>
