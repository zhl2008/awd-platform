<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

define('IN_CMS','true');
include('init.php');
$action=isset($_REQUEST['action'])?fl_html(fl_value($_REQUEST['action'])):'sys';

//系统设置页
if($action=='sys'){
	if(file_exists(DATA_PATH.'sys_info.php')){
		include(DATA_PATH.'sys_info.php');
	}
	include('template/admin_sys.php');
}
//处理设置
elseif($action=='add_sys'){
	if(!check_purview('sys_info')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	if(!isset($_POST['submit'])){msg('<span style="color:red">请从表单提交</span>');}
	unset($_POST['action'],$_POST['submit']);
	foreach($_POST as $k=>$v){
		$info[$k]=$v;
	}
	$sql="update ".DB_PRE."cmsinfo set info_array='".addslashes(var_export($info,'true'))."' where id=1 and info_tag='sys'";
	$GLOBALS['mysql']->query($sql);
	$file=DATA_PATH.'sys_info.php';
	$str="<?php\n\$_sys=".var_export($info,true).";\n?>";
	creat_inc($file,$str);
	msg('系统信息配置成功','?'.$nav_query.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);	
	
}
echo PW;
?>
