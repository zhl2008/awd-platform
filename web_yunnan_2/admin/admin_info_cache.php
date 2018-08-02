<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

define('IN_CMS','true');
include('init.php');
$action=isset($_REQUEST['action'])?fl_html(fl_value($_REQUEST['action'])):'info';
$lang=isset($_REQUEST['lang'])?fl_html(fl_value($_REQUEST['lang'])):get_lang_main();
$step=$_GET['step'];

if($step=='lang'){
$sql="select*from ".DB_PRE."lang order by lang_order desc";
$rel=$GLOBALS['mysql']->fetch_asc($sql);
$cache_str="<?php\n\$lang_cache=".var_export($rel,true).";\n?>";
cache_write(DATA_PATH.'cache/lang_cache.php',$cache_str);
unset($rel);
show_htm('语言更新完成','?step=info');
}


if($step=='info'){
	if(file_exists(DATA_PATH.'cache/lang_cache.php')){
		include(DATA_PATH.'cache/lang_cache.php');
	}
	if(empty($lang_cache)){
		show_htm('<span style="color:red">更新网站配置失败，没有添加语言</span>','?step=sys');
	}
	foreach($lang_cache as $k=>$v){
		$sql="select*from ".DB_PRE."cmsinfo where info_tag='info' and lang_tag='{$v['lang_tag']}'";
		$rel=$mysql->fetch_asc($sql);
		$info=isset($rel[0]['info_array'])?stripslashes($rel[0]['info_array']):'';
		if(empty($info)){continue;};
		$cache_str="<?php\n\$_confing=".$info.";\n?>";
		cache_write(DATA_PATH.$v['lang_tag'].'_info.php',$cache_str);
		unset($rel);
	}
	show_htm('网站配置更新完成','?step=sys');
}

if($step=='sys'){
	$sql="select*from ".DB_PRE."cmsinfo where info_tag='sys'";
	$rel=$mysql->fetch_asc($sql);
	$info=isset($rel[0]['info_array'])?stripslashes($rel[0]['info_array']):'';
	$cache_str="<?php\n\$_sys=".$info.";\n?>";
	
	cache_write(DATA_PATH.'sys_info.php',$cache_str);
	unset($rel);
	show_htm('系统配置更新完成','?step=index_info');
}

if($step=='index_info'){
	$sql="select*from ".DB_PRE."cmsinfo where info_tag='index_info'";
	$rel=$mysql->fetch_asc($sql);
	$info=isset($rel[0]['info_array'])?stripslashes($rel[0]['info_array']):'';
	$cache_str="<?php\n\$_index=".$info.";\n?>";
	cache_write(DATA_PATH.'index_info.php',$cache_str);
	unset($rel);
	show_htm('网站首页配置更新完成','admin_main.php');
}
echo PW;

?>
