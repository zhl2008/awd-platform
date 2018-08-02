<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

@ini_set('session.use_trans_sid', 0);
@ini_set('session.auto_start',    0);
@ini_set('session.use_cookies',   1);
error_reporting(E_ALL & ~E_NOTICE);
$dir_name=str_replace('\\','/',dirname(__FILE__));
$admindir=substr($dir_name,strrpos($dir_name,'/')+1);
define('CMS_PATH',str_replace($admindir,'',$dir_name));
define('INC_PATH',CMS_PATH.'includes/');
define('DATA_PATH',CMS_PATH.'data/');
include(INC_PATH.'fun.php');
include(DATA_PATH.'confing.php');
include(INC_PATH.'mysql.class.php');
if(file_exists(DATA_PATH.'sys_info.php')){
include(DATA_PATH.'sys_info.php');
}
@header("Content-type: text/html; charset=utf-8"); 
$mysql=new mysql(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME,DB_CHARSET,DB_PCONNECT);
session_start();
$s_code=empty($_SESSION['code'])?'':$_SESSION['code'];
$_SESSION['login_in']=empty($_SESSION['login_in'])?'':$_SESSION['login_in'];
$_SESSION['admin']=empty($_SESSION['admin'])?'':$_SESSION['admin'];
if($_SESSION['login_in']&&$_SESSION['admin']){header("location:admin.php");}
$action=empty($_GET['action'])?'login':$_GET['action'];

if($action=='login'){
	global $_sys;
	include('template/admin_login.php');
}
//判断登录
elseif($action=='ck_login'){
	global $submit,$user,$password,$_sys,$code;
	$submit=$_POST['submit'];
	$user=fl_html(fl_value($_POST['user']));
	$password=fl_html(fl_value($_POST['password']));
	$code=$_POST['code'];
	if(!isset($submit)){
		msg('请从登陆页面进入');
	}
	if(empty($user)||empty($password)){
		msg("密码或用户名不能为空");
	}
	if(!empty($_sys['safe_open'])){
		foreach($_sys['safe_open'] as $k=>$v){
		if($v=='3'){
			if($code!=$s_code){msg("验证码不正确！");}
		}
		}
		}
	check_login($user,$password);
	
}

elseif($action=='out'){
	login_out();
}
?>
