<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

define('IN_CMS','true');
include('init.php');
$action=isset($_REQUEST['action'])?fl_html(fl_value($_REQUEST['action'])):'lang_cache';
$lang=isset($_REQUEST['lang'])?fl_html(fl_value($_REQUEST['lang'])):get_lang_main();

if($action == 'lang_cache'){
	include('template/admin_all_cache.php');
}
//开始缓存
elseif($action == 'cache'){
	//语言缓存【公共】
	$sql="select*from ".DB_PRE."lang order by lang_order desc";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	$cache_str="<?php\n\$lang_cache=".var_export($rel,true).";\n?>";
	cache_write(DATA_PATH.'cache/lang_cache.php',$cache_str);
	//配置缓存
	$sql="select*from ".DB_PRE."cmsinfo where info_tag='info' and lang_tag='{$lang}'";
	$rel=$mysql->fetch_asc($sql);
	$info=isset($rel[0]['info_array'])?stripslashes($rel[0]['info_array']):'';
	if(!empty($info)){
		$cache_str="<?php\n\$_confing=".$info.";\n?>";
		cache_write(DATA_PATH.$lang.'_info.php',$cache_str);
	}	
	//系统缓存【公共】
	$sql="select*from ".DB_PRE."cmsinfo where info_tag='sys'";
	$rel=$mysql->fetch_asc($sql);
	$info=isset($rel[0]['info_array'])?stripslashes($rel[0]['info_array']):'';
	$cache_str="<?php\n\$_sys=".$info.";\n?>";
	cache_write(DATA_PATH.'sys_info.php',$cache_str);
	//首页配置缓存【公共】
	$sql="select*from ".DB_PRE."cmsinfo where info_tag='index_info'";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	$info=isset($rel[0]['info_array'])?stripslashes($rel[0]['info_array']):'';
	$s="<?php\n\$_index=".$info.";\n?>";
	$file=DATA_PATH.'index_info.php';
	creat_inc($file,$s);
	//栏目缓存
	$GLOBALS['cache']->cache_category_all();
	$GLOBALS['cache']->cache_category(0,$lang);
	$GLOBALS['cache']->cache_category_child(0,$lang);
	cache_channel_category($lang);
	$sql="select c.id,c.list_num,c.cate_pic1,c.cate_pic2,c.cate_pic3,c.cate_content,c.temp_id,c.custom_url,c.cate_channel,c.cate_fold_name,c.cate_nav,c.cate_is_open,c.cate_html,c.cate_url,c.cate_order,c.cate_hide,c.cate_tpl,c.cate_name,c.lang,c.cate_parent,c.is_content,COUNT(s.id) as haschild from ".DB_PRE."category as c left join ".DB_PRE."category as s on c.id=s.cate_parent where c.lang='".$lang."' group by c.id order by c.cate_order,c.id desc";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	$str="<?php\n\$cate_list=".var_export($rel,true).";\n?>";
	$file=DATA_PATH.'cache_cate/cate_list_'.$lang.'.php';
	creat_inc($file,$str);
	//模型缓存【公共】
	$GLOBALS['cache']->channel_cache($GLOBALS['lang']);
	$GLOBALS['cache']->cache_fields();
	//管理员分组【公共】
	$GLOBALS['cache']->cache_admin_group();
	//会员分组【公共】
	$GLOBALS['cache']->cache_member_group();
	//表单缓存【公共】
	$form_file=DATA_PATH.'cache_form/form.php';
	$rel=$GLOBALS['mysql']->fetch_asc("select*from ".DB_PRE."form order by id desc");
	$cache_str="<?php\n\$form=".var_export($rel,true).";\n?>";
	cache_write($form_file,$cache_str,'表单模型缓存');
	//表单字段字段【公共】
	$rel=$GLOBALS['mysql']->fetch_asc("select*from ".DB_PRE."formfield order by form_order asc");
	$cache_str="<?php\n\$field=".var_export($rel,true).";\n?>";
	cache_write(DATA_PATH.'cache_form/field.php',$cache_str);
	unset($rel);
	
	show_htm($lang.'语言缓存更新完成','?lang='.$lang.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}
echo PW;
?>
