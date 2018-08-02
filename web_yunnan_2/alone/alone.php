<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

//if(!file_exists("../data/install.lock")||!file_exists("../data/confing.php")){header("location:install/index.php");exit();}
define('CMS',true);
require_once('../includes/init.php');
require_once('../includes/fun.php');
require_once('../includes/lib.php');
$id=intval($_GET['id']);
$cate_info=get_cate_info($id,$category);
if(empty($cate_info)){header('location:../index.php');}
$lang=$cate_info['lang'];
if(file_exists(LANG_PATH.'lang_'.$lang.'.php')){include(LANG_PATH.'lang_'.$lang.'.php');}//语言包缓存,数组$language
if(file_exists(DATA_PATH.'cache_cate/cate_list_'.$lang.'.php')){include(DATA_PATH.'cache_cate/cate_list_'.$lang.'.php');}//当前语言下的栏目
$_confing=get_confing($lang);//配置信息
$channel_info=get_cate_info($cate_info['cate_channel'],$channel);
$cat_id=$cate_info['id'];
$cateid=$cat_id;
$parent_id=get_cate_last_parent($cat_id);//获取最终顶级栏目
$tpl->template_dir=(IS_MB)?TP_PATH.$_confing['phone_template'].'/':TP_PATH.$_confing['web_template'].'/';//设置模板
$tpl->template_lang=$lang;
if($_confing['is_cache']){
	$tpl->template_is_cache=1;//缓存
	$tpl->template_time=$_confing['cache_time']?$_confing['cache_time']:30;//开启缓存但不存在缓存时间使用30秒
}else{
	$tpl->template_is_cache=0;
}
//单页频道
$page=empty($page)?1:intval($page);
//文章分页
$arc_id=$mysql->fetch_asc("select id from ".DB_PRE."maintb where category={$cat_id}");
$arc_id=isset($arc_id[0]['id'])?$arc_id[0]['id']:'';
//存在内容
//if(!empty($arc_id)){
$channel_table = $channel_info['channel_table'];
$content=get_content($arc_id,$channel_info['channel_table'],$cate_info['id']);
$content=$content[0];
//获取第一个关键词作为相关产品调用
$key_arr = empty($content['keywords'])?'':explode(',',$content['keywords']);
$relave_key = $key_arr[0];
if($content['verify']){die($language['msg_info8']."<a href=\"index.php?lang={$lang}\">【Back】</a>");}//判断权限
$view_is=isset($_SESSION['purview'])?$_SESSION['purview']:'';
if($content['purview']!=$view_is&&$content['purview']){die($language['msg_info8']."【<a href=\"index.php?lang={$lang}\">back</a>】");}//判断权限
				$body_content=$content['content'];
				$content_arr=preg_split('/<div style=\"page-break-after: always[;]*\">\s*<span style=\"display: none[;]*\">&nbsp;<\/span><\/div>/i',$body_content);
				$content_arr_num=count($content_arr);
				$content_arr_num=($content_arr_num>1)?$content_arr_num:0;
				$ishtml=1;
				$id=$cate_info['id'];
				if($content_arr_num){
					for($i=0;$i<$content_arr_num;$i++){
					if($page==($i+1)){
						$content_focus=$i;
						$content['content']=$content_arr[$i];
						$content['title']=$content['title'].'('.($i+1).')';
						$content['style_title']=$content['style_title'].'('.($i+1).')';
						$tpl_rel=explode('.',$cate_info['cate_tpl_list']);
						$tpl->display($tpl_rel[0]);//载入模板
					}
					}
				}else{
				$tpl_rel=explode('.',$cate_info['cate_tpl_list']);
				$tpl->display($tpl_rel[0]);//载入模板
				}

?>
