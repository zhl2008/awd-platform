<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

define('IN_CMS','true');
include('init.php');
$action=isset($_REQUEST['action'])?fl_html(fl_value($_REQUEST['action'])):'flash_ad_info';
$lang=isset($_REQUEST['lang'])?fl_html(fl_value($_REQUEST['lang'])):get_lang_main();

//主广告配置界面
if($action=='flash_ad_info'){
$cate_id = empty($_REQUEST['cate_id'])?1:intval($_REQUEST['cate_id']);
$rel_cate = $mysql->fetch_asc("select*from ".DB_PRE."flash_ad_cate order by id asc");
$rel=$GLOBALS['mysql']->fetch_asc("select*from ".DB_PRE."flash_info where lang='".$lang."' and cate_id=".$cate_id);
include('template/admin_flash_ad_info.php');
}

//处理配置信息
elseif($action=='add'){
if(empty($lang)){
	msg('<span style="color:red">参数传递错误,请重新操作</span>','?action=flash_ad_info');
}
$cate_id = intval($_POST['cate_id']);
if(empty($cate_id)){msg('<span style="color:red">分类不正确，请重新操作</span>');}
$flash_width=empty($_POST['flash_ad_width'])?900:intval($_POST['flash_ad_width']);
$flash_height=empty($_POST['flash_ad_height'])?60:intval($_POST['flash_ad_height']);
$flash_style=$_POST['flash_ad_style'];
$rel=$GLOBALS['mysql']->fetch_rows('select id from '.DB_PRE."flash_info where lang='".$lang."' and cate_id=".$cate_id);
if(empty($rel)){
	$sql="insert into ".DB_PRE."flash_info (flash_width,flash_height,flash_style,lang,cate_id) values ('{$flash_width}','{$flash_height}',{$flash_style},'{$lang}',{$cate_id})";
}else{
	$sql="update ".DB_PRE."flash_info set flash_width='{$flash_width}',flash_height='{$flash_height}',flash_style={$flash_style} where lang='{$lang}' and cate_id={$cate_id}";
}
$GLOBALS['mysql']->query($sql);
msg('【'.$lang.'】语言主广告设置完成','?action=flash_ad_info&lang='.$lang.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}
echo PW;
?>
