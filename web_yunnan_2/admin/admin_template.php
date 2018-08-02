<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

define('IN_CMS','true');
include('init.php');
$action=isset($_REQUEST['action'])?fl_html(fl_value($_REQUEST['action'])):'template';
$lang=isset($_REQUEST['lang'])?fl_html(fl_value($_REQUEST['lang'])):get_lang_main();


//模板列表
if($action=='template'){
	if(!check_purview('tpl_manage')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$path = $_REQUEST['path'];
	$step = $_REQUEST['step'];
	if(file_exists(DATA_PATH.$lang.'_info.php')){
		include(DATA_PATH.$lang.'_info.php');
	}
	if(empty($_confing['web_template'])){
		err("请先在网站配置栏目配置【{$lang}】语言模板目录");
	}
	$path=empty($path)?'template'.'/'.$_confing['web_template']:$path;
	if(!$file_hand=@opendir(CMS_PATH.$path)){
		err("模板目录打开失败,请检查【{$lang}】语言模板目录【{$_confing['web_template']}】");
	}
	
	include("template/admin_template.php");
	
}


//模板修改界面
elseif($action=='xg'){
	if(!check_purview('tpl_manage')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$file = $_GET['file'];
	$path=CMS_PATH.$file;
	if(!$fp=@fopen($path,'r+')){err('<span style="color:red">模板打开失败,请确定【'.$file.'】模板是否存在</span>');}
	flock($fp,LOCK_EX);
	$str=@fread($fp,filesize($path));
	$str = str_replace("&","&amp;",$str);
	$str= str_replace(array("'",'"',"<",">"),array("&#39;","&quot;","&lt;","&gt;"),$str);
	flock($fp,LOCK_UN);
	fclose($fp);
	include('template/admin_template_xg.php');
}

//处理模板修改
elseif($action=='save_template'){
	if(!check_purview('tpl_manage')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$template = $_POST['template'];
	$file = $_POST['file'];
	$template=stripslashes($template);
	$path=CMS_PATH.$file;
	//判断文件是否存在
	if(!file_exists($path)){msg('不存在该文件，请重新操作');}
	if(!$fp=@fopen($path,'w+')){err('<span style="color:red">模板打开失败,请确定【'.$file.'】模板是否存在</span>');}
	flock($fp,LOCK_EX);
	fwrite($fp,$template);
	flock($fp,LOCK_UN);
	fclose($fp);
	msg('【'.$file.'】模板修改完成','?nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}

//模板风格列表
elseif($action=='mb_list'){
	if(!check_purview('tpl_manage')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$path=empty($path)?'template'.'/':$path;
	if(!$file_hand=@opendir(CMS_PATH.$path)){
		err("模板目录打开失败,请检查【{$lang}】语言模板目录【{$_confing['web_template']}】");
	}
	if(file_exists(DATA_PATH.$lang.'_info.php')){include(DATA_PATH.$lang.'_info.php');}
	include('template/admin_mb_list.php');
}

//ajax设置模板
elseif($action=='ajax_mb'){
	if(!check_purview('tpl_manage')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$mb_dir=$_POST['mb_dir'];
	echo $lang;
	if(file_exists(DATA_PATH.$lang.'_info.php')){include(DATA_PATH.$lang.'_info.php');}
	
	//更换模板清除现有配置
	if($mb_dir!=$_confing['web_template']){
		//清除缓存编译文件
		$GLOBALS['tpl']->del_cache();
	}
	
	$_confing['web_template']=$mb_dir;
	
	if($GLOBALS['mysql']->fetch_rows("select id from ".DB_PRE."cmsinfo where lang_tag='".$lang."' and info_tag='info'")){
		$sql="update ".DB_PRE."cmsinfo set info_array='".addslashes(var_export($_confing,'true'))."' where lang_tag='".$lang."' and info_tag='info'";
	}else{
		$sql="insert into ".DB_PRE."cmsinfo (info_tag,info_array,info_name,lang_tag) values ('info','".addslashes(var_export($_confing,true))."','网站配置','".$lang."')";
	}
	$GLOBALS['mysql']->query($sql);
	$s="<?php\n\$_confing=".var_export($_confing,true).";\n?>";
	$file=DATA_PATH.$lang.'_info.php';
	creat_inc($file,$s);	
}
echo PW;
?>
