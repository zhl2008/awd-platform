<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

define('IN_CMS','true');
include('init.php');
$action=isset($_REQUEST['action'])?fl_html(fl_value($_REQUEST['action'])):'flash_ad';
$lang=isset($_REQUEST['lang'])?fl_html(fl_value($_REQUEST['lang'])):get_lang_main();
//主广告列表
if($action=='flash_ad'){
	$page= intval($_GET['page']);
	$cate_id = empty($_REQUEST['cate_id'])?1:intval($_REQUEST['cate_id']);
	$cate_rel = $mysql->fetch_asc("select*from ".DB_PRE."flash_ad_cate order by id asc");
	include('template/admin_flash_ad.php');
}
//添加主广告
elseif($action=='add'){
	$cate_id = intval($_GET['cate_id']);
	$rel = $mysql->fetch_asc("select*from ".DB_PRE."flash_ad_cate order by id asc");
	include('template/admin_flash_ad_add.php');
}
//处理添加的主广告
elseif($action=='save_flash_ad'){
	if(empty($_POST['pic'])){msg('<span style="color:red">图片不能为空</span>');}
	if(empty($_POST['lang'])){msg('<span style="color:red">参数传递错误，请重新操作</span>','?action=flash_ad&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);}
	$cate_id = intval($_POST['cate_id']);
	if(empty($cate_id)){msg('请选择分类');}
	$pic=cn_substr(trim($_POST['pic']),255);
	$pic_url=cn_substr(trim($_POST['pic_url']),255);
	$pic_text=cn_substr(trim($_POST['pic_text']),255);
	if(is_sq()){die("免费版只能发布3条主广告，发布更多内容请使用正式版！");}
	$pic_order=empty($_POST['pic_order'])?10:intval($_POST['pic_order']);
	$GLOBALS['mysql']->query('insert into '.DB_PRE."flash_ad (pic,pic_url,pic_text,pic_order,lang,cate_id) values ('{$pic}','{$pic_url}','{$pic_text}',{$pic_order},'{$lang}',{$cate_id})");
	msg('主广告添加完成','?cate_id='.$cate_id.'&action=flash_ad&lang='.$lang.'&nav=listflash&admin_p_nav='.$admin_p_nav);
}
//修改主广告
elseif($action=='edit'){
	$id=intval($_GET['id']);
	$cate_id = intval($_GET['cate_id']);
	if(empty($lang)||empty($id)){msg('<span style="color:red">参数传递错误，请重新操作！</span>');}
	$rel_cate = $mysql->fetch_asc("select*from ".DB_PRE."flash_ad_cate order by id asc");
	$rel=$GLOBALS['mysql']->fetch_asc('select*from '.DB_PRE.'flash_ad where id='.$id." and lang='".$lang."'");
	include('template/admin_flash_ad_edit.php');
}
//处理修改的主广告
elseif($action=='save_edit'){
	if(empty($_POST['id'])){msg('<span style="color:red">参数发生错误，请重新操作</span>');}
	if(empty($_POST['pic'])){msg('<span style="color:red">图片不能为空</span>');}
	if(empty($_POST['lang'])){msg('<span style="color:red">参数传递错误，请重新操作</span>','?action=flash_ad&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);}
	$cate_id = intval($_POST['cate_id']);
	if(empty($cate_id)){msg('<span style="color:red">请选择分类</span>');}
	$pic=cn_substr(trim($_POST['pic']),255);
	$pic_url=cn_substr(trim($_POST['pic_url']),255);
	$pic_text=cn_substr(trim($_POST['pic_text']),255);
	$pic_order=empty($_POST['pic_order'])?10:intval($_POST['pic_order']);
	$id=intval($_POST['id']);
	$GLOBALS['mysql']->query("update ".DB_PRE."flash_ad set pic='{$pic}',pic_url='{$pic_url}',pic_text='{$pic_text}',pic_order={$pic_order},cate_id={$cate_id} where id={$id}");
	msg('主广告修改成功','?action=flash_ad&lang='.$lang.'&cate_id='.$cate_id.'&nav=listflash&admin_p_nav='.$admin_p_nav);
}
//删除主广告
elseif($action=='del'){
	$id=intval($_GET['id']);
	$GLOBALS['mysql']->query('delete from '.DB_PRE.'flash_ad where id='.$id);
	msg('删除完成','?action=flash_ad&lang='.$lang.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}
//ajax修改排序
elseif($action=='ajax_order'){
	$id=intval($_POST['id']);
	$order_id=intval($_POST['order_id']);
	if(empty($id)){die('参数错误');}
	$sql="update ".DB_PRE."flash_ad set pic_order=".$order_id." where id=".$id;
	$GLOBALS['mysql']->query($sql);
}
//添加主广告分类
elseif($action=='add_cate')
{
	include('template/admin_flash_ad_cate_add.php');
}
//保存分类
elseif($action=='save_cate')
{
	$cate_name = $_POST['cate_name'];
	$cate_tpl_id = intval($_POST['cate_tpl_id']);
	
	if(empty($cate_name)){msg('名称不能为空');}
	//是否存在调用的id
	if(!empty($cate_tpl_id)){
		$sql = "select count(id) as n from ".DB_PRE."flash_ad_cate where cate_tpl_id=".$cate_tpl_id;
		$num = $mysql->fetch_asc($sql);
		if($num[0]['n']){msg('<span style="color:red">已经存在该调用id，请更改</span>');}
	}
	$sql = "insert into ".DB_PRE."flash_ad_cate (cate_name,cate_tpl_id) values ('{$cate_name}',{$cate_tpl_id})";
	$mysql->query($sql);
	msg('分类添加完成','?action=list_cate'.'&nav=list_flash_cate&admin_p_nav='.$admin_p_nav);
}
//管理分类
elseif($action == 'list_cate')
{
	include('template/admin_flash_ad_cate_list.php');
}
//修改分类
elseif($action == 'edit_cate')
{
	$id = intval($_GET['id']);
	$rel = $mysql->fetch_asc('select*from '.DB_PRE."flash_ad_cate where id=".$id);
	if(empty($rel)){msg('不存在该分类');}
	include('template/admin_flash_ad_cate_edit.php');
}
//保存修改的分类
elseif($action == 'save_cate_edit')
{
	$id = $_POST['id'];
	if(empty($id)){msg('参数传递错误，请重新操作');}
	$cate_name = $_POST['cate_name'];
	$cate_tpl_id = intval($_POST['cate_tpl_id']);
	
	if(empty($cate_name)){msg('名称不能为空');}
	//是否存在调用的id
	if(!empty($cate_tpl_id)){
		$sql = "select count(id) as n from ".DB_PRE."flash_ad_cate where id!=".$id." and cate_tpl_id=".$cate_tpl_id;
		$num = $mysql->fetch_asc($sql);
		if($num[0]['n']){msg('<span style="color:red">已经存在该调用id，请更改</span>');}
	}
	
	$sql = "update ".DB_PRE."flash_ad_cate set cate_name='{$cate_name}',cate_tpl_id={$cate_tpl_id} where id=".$id;
	$mysql->query($sql);
	msg('分类修改完成','?action=list_cate'.'&nav=list_flash_cate&admin_p_nav='.$admin_p_nav);
}
//删除分类
elseif($action == 'del_cate')
{
	$id = $_GET['id'];
	if(empty($id)){msg('参数传递错误，请重新操作');}
	if($id=='1'){msg('该分类为固定分类，不能删除');}
	//是否有内容
	$sql = "select count(id) as n from ".DB_PRE."flash_ad where cate_id =".$id;
	$rel=$mysql->fetch_asc($sql);
	if($rel[0]['n']){msg('<span style="color:red">请先删除该分类下的图片</span>');}
	$sql = 'delete from '.DB_PRE.'flash_ad_cate where id='.$id;
	$mysql->query($sql);
	msg('分类成功删除','?action=list_cate'.'&nav=list_flash_cate&admin_p_nav='.$admin_p_nav);
}
echo PW;
function is_sq(){if(!ck_ck()){$sql="SELECT COUNT(id) AS m FROM ".DB_PRE."flash_ad WHERE lang='".$GLOBALS['lang']."'";$rel=$GLOBALS['mysql']->fetch_asc($sql);if($rel[0]['m']>=3){return true;}}}
?>
