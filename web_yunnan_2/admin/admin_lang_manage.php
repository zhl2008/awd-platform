<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

define('IN_CMS','true');
include('init.php');
$action=isset($action)?$action:'edit';
if(!isset($lang)){
	msg('<span style="color:red">参数为空,请重新操作</span>','javascript:history.go(-1);');
}

go_url($action);

function edit(){
	$lang_path=LANG_PATH.'lang_'.$GLOBALS['lang'].'.php';
	if(!file_exists($lang_path)){
		msg('<span style="color:red">找不到该'.$GLOBALS['lang'].'语言的语言包，请重新安装</span>','javascript:history.go(-1);');
	}
	include($lang_path);
	include('template/admin_lang_manage.php');
}

function add_save(){
	if(!isset($GLOBALS['submit'])){
		msg('<span style="color:red">请从表单提交</span>','admin_lang.php');
	}
	if(!isset($_POST)){
		msg('<span style="color:red">请填写语言后提交</span>','javascript:history.go(-1);');
	}
	foreach($_POST as $key=>$value){
		if(in_array($key,array('action','lang','submit'))){
			continue;
		}
		$lang[$key]=$value;
	}
	$str="<?php\n\$lang=".var_export($lang,true).";\n?>";
	if(!file_exists(LANG_PATH.'lang_'.$GLOBALS['lang'].'.php')){
		msg('<span style="color:red">找不到'.$GLOBALS['lang'].'语言的语言包，请重新安装</span>','javascript:history.go(-1);');
	}
	if(!$fp=@fopen(LANG_PATH.'lang_'.$GLOBALS['lang'].'.php','w')){
		msg('<span style="color:red">语言文件打开失败，请检查是否有足够的文件操作权限</span>','javascript:history.go(-1);');
	}
	flock($fp,LOCK_EX);
	if(!fwrite($fp,$str)){
		flock($fp,LOCK_UN);
		msg('<span style="color:red">写入语言文件失败,请重新操作</span>');
	}
	msg('语言修改成功','admin_lang.php');
	
}
echo PW;
?>
