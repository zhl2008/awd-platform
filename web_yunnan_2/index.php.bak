<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

//if(!file_exists("data/install.lock")||!file_exists("data/confing.php")){header("location:install/index.php");exit();}
define('CMS',true);
require_once('includes/init.php');
require_once('includes/fun.php');
require_once('includes/lib.php');
if(file_exists(DATA_PATH.'index_info.php')){include(DATA_PATH.'index_info.php');}//首页配置缓存
$lang=isset($_GET['lang'])?$_GET['lang']:'';
$index_lang='';//默认首页语言
if(!empty($lang_cache)){
 foreach($lang_cache as $k=>$v){
 	if($_index['index_lang']==$v['id']){
		$index_lang = $v['lang_tag'];
	}
 }
}

//语言是否使用
if(!empty($lang)){
	$is_lang_use=0;
	if(!empty($lang_cache)){
	foreach($lang_cache as $k=>$v){
 		if(($lang==$v['lang_tag'])&&!empty($v['lang_is_use'])){
			$is_lang_use=1;//已经使用
		}
 	}
	}
	if(empty($is_lang_use)){
		$lang = $index_lang;
	}
}


if(($lang == $index_lang)&&empty($_index['flash_is'])){
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: index.php");
}



//开启flash
if(!empty($_index['flash_is'])&&empty($lang)){
	$lang = $index_lang;
	$fl_file=(IS_MB)?CMS_PATH.'template/flash_phone.html':CMS_PATH.'template/flash.html';
	if(!$fl_file){die($language['msg_info']);}
	if(file_exists(LANG_PATH.'lang_'.$lang.'.php')){include(LANG_PATH.'lang_'.$lang.'.php');}//语言包缓存,数组$language
	if(file_exists(DATA_PATH.'cache_cate/cate_list_'.$lang.'.php')){include(DATA_PATH.'cache_cate/cate_list_'.$lang.'.php');}//当前语言下的栏目
	//默认首页语言网站配置
	$_confing=get_confing($lang);
	$tpl->template_dir=TP_PATH.'/';
	$tpl->template_lang=$lang;
	if($_confing['is_cache']){
		$tpl->template_is_cache=1;//缓存
		$tpl->template_time=$_confing['cache_time']?$_confing['cache_time']:30;//开启缓存但不存在缓存时间使用30秒
	}else{
		$tpl->template_is_cache=0;
	}
	$tpl->display('flash');

//关闭flash引导页	
}else{
//载入语言页
	
	$lang = empty($lang)?$index_lang:$lang;
	if(!empty($lang_cache)){
		foreach($lang_cache as $l_k=>$l_v){
			if($l_v['lang_tag']==$lang){
			$lang_name=$l_v['lang_name'];
			break;
			}
		}
	}
	if(file_exists(LANG_PATH.'lang_'.$lang.'.php')){include(LANG_PATH.'lang_'.$lang.'.php');}//语言包缓存,数组$language
	if(file_exists(DATA_PATH.'cache_cate/cate_list_'.$lang.'.php')){include(DATA_PATH.'cache_cate/cate_list_'.$lang.'.php');}//当前语言下的栏目
	//网站配置文件
	$_confing=get_confing($lang);

	$index_focus="focus";
	//获取第一个关键词作为相关内容调用
	$key_arr = empty($_confing['web_keywords'])?'':explode(',',$_confing['web_keywords']);
	$relave_key = $key_arr[0];
	//指向首页
	
		$tpl->template_dir=(IS_MB)?TP_PATH.$_confing['phone_template'].'/':TP_PATH.$_confing['web_template'].'/';
		$tpl->template_lang=$lang;
		if($_confing['is_cache']){
			$tpl->template_is_cache=1;//缓存
			$tpl->template_time=$_confing['cache_time']?$_confing['cache_time']:30;//开启缓存但不存在缓存时间使用30秒
		}else{
			$tpl->template_is_cache=0;
		}
		$tpl->display('index');
	
	
}

?>
