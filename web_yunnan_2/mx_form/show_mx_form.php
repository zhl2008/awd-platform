<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

//if(!file_exists("../data/install.lock") || !file_exists("../data/confing.php")){header("location:../install/index.php"); exit();}
define('CMS', true);
require_once('../includes/init.php');
require_once('../includes/fun.php');
require_once('../includes/lib.php');
$id = isset($_GET['id']) ? intval($_GET['id']) : '';
if(empty($id)){header('location:../index.php');}
if(!$mysql -> fetch_rows("select id from ".DB_PRE."maintb where id={$id}")){header('location:../index.php');}//是否存在内容

$cate=$mysql->get_row("select category from ".DB_PRE."maintb where id={$id}");//取得内容栏目
$cat_id=$cateid=$cate;//栏目id值
$parent_id=get_cate_last_parent($cat_id);//获取最终顶级栏目
$cate_info=get_cate_info($cate,$category);//获得栏目信息
$lang=$cate_info['lang'];//通过栏目获得当前语言
if(file_exists(DATA_PATH.'cache_cate/cate_list_'.$lang.'.php')){include(DATA_PATH.'cache_cate/cate_list_'.$lang.'.php');}//当前语言下的栏目
if(file_exists(LANG_PATH.'lang_'.$lang.'.php')){include(LANG_PATH.'lang_'.$lang.'.php');}//语言包缓存,数组$language
$_confing=get_confing($lang);//当前语言网站设置
$channel_info=get_cate_info($cate_info['cate_channel'],$channel);//获得内容模型信息
$channel_table=$channel_info['channel_table'];//内容模型表
$content=get_content($id,$channel_info['channel_table'],$cate_info['id']);//获得内容
$content=$content[0];
//获取第一个关键词作为相关产品调用
$key_arr = empty($content['keywords'])?'':explode(',',$content['keywords']);
$relave_key = $key_arr[0];

$view_is=isset($_SESSION['member_purview'])?$_SESSION['member_purview']:'';//访问权限
if($content['purview']!=$view_is&&$content['purview']){die($language['msg_info7']."【<a href=\"index.php?lang={$lang}\">back</a>】");}
if($content['verify']){die($language['msg_info8']."<a href=\"index.php?lang={$lang}\">【Back】</a>");}

$tpl->template_dir=(IS_MB)?TP_PATH.$_confing['phone_template'].'/':TP_PATH.$_confing['web_template'].'/';//设置模板
$tpl->template_lang=$lang;//语言
$cache_time=$content['cache_time']?$content['cache_time']:$_confing['cache_time'];//缓存时间
//网站是否开启缓存
if($_confing['is_cache']){
	$tpl->template_is_cache=1;//缓存
	$tpl->template_time=$cache_time?$cache_time:30;//开启缓存但不存在缓存时间使用30秒
}else{
	$tpl->template_is_cache=0;
}
$page=empty($page)?1:intval($page);
//文章分页，通过编辑器分页使用
$body_content=$content['content'];
$content_arr=preg_split('/<div style=\"page-break-after: always[;]*\">\s*<span style=\"display: none[;]*\">&nbsp;<\/span><\/div>/i',$body_content);
$content_arr_num=count($content_arr);
$content_arr_num=($content_arr_num>1)?$content_arr_num:0;
if($content_arr_num){
	for($i=0;$i<$content_arr_num;$i++){
		if($page==($i+1)){
			$content_focus=$i;
			$content['content']=$content_arr[$i];
			$content['title']=$content['title'].'('.($i+1).')';
			$content['style_title']=$content['style_title'].'('.($i+1).')';
			$tpl_rel=explode('.',$cate_info['cate_tpl_content']);
			$tpl->display($tpl_rel[0]);//载入缓存文件
		}
	}
}else{
	$tpl_rel=explode('.',$cate_info['cate_tpl_content']);
	$tpl->display($tpl_rel[0]);//载入缓存文件
}


?>
