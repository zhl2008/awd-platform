<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

if(!defined('CMS')){die('Hacking attempt');}
error_reporting(E_ALL & ~E_NOTICE);
define('CMS_PATH',str_replace('includes','',str_replace('\\','/',dirname(__FILE__))));
define('INC_PATH',CMS_PATH.'includes/');
define('DATA_PATH',CMS_PATH.'data/');
define('LANG_PATH',CMS_PATH.'languages/');
define('MB_PATH',CMS_PATH.'member/');
define('TP_PATH',CMS_PATH.'template/');
@ini_set('date.timezone','Asia/Shanghai');
@ini_set('display_errors',1);
@ini_set('session.use_trans_sid', 0);
@ini_set('session.auto_start',    0);
@ini_set('session.use_cookies',   1);
@ini_set('memory_limit',          '64M');
@ini_set('session.cache_expire',  180);
session_start();
header("Content-type: text/html; charset=utf-8"); 
@include(INC_PATH.'fun.php');
define('IS_MB',is_mb());

unset($HTTP_ENV_VARS, $HTTP_POST_VARS, $HTTP_GET_VARS, $HTTP_POST_FILES, $HTTP_COOKIE_VARS);
if (!get_magic_quotes_gpc())
{
    if (isset($_REQUEST))
    {
        $_REQUEST  = addsl($_REQUEST);
    }
    $_COOKIE   = addsl($_COOKIE);
	$_POST = addsl($_POST);
	$_GET = addsl($_GET);
}
if (isset($_REQUEST)){$_REQUEST  = fl_value($_REQUEST);}
    $_COOKIE   = fl_value($_COOKIE);
	$_GET = fl_value($_GET);
@extract($_POST);
@extract($_GET);
@extract($_COOKIE);
@include(DATA_PATH.'confing.php');
$cms_url='http://'.$_SERVER['HTTP_HOST'].CMS_SELF;
define('CMS_URL',$cms_url);
if(file_exists(DATA_PATH.'sys_info.php')){include(DATA_PATH.'sys_info.php');}//系统设置缓存,数组$_sys

include(INC_PATH.'mail.php');
$bees_mail = new PHPMailer();    
$bees_mail->IsSMTP();                  // send via SMTP    
$bees_mail->Host = $_sys['mail_host'];   // SMTP servers    
$bees_mail->Port       = $_sys['mail_pot'];   
$bees_mail->SMTPAuth = true;           // turn on SMTP authentication    
$bees_mail->Username = $_sys['mail_user'];     // SMTP username    
$bees_mail->Password = $_sys['mail_pw']; // SMTP password    
$bees_mail->From = $_sys['mail_mail'];      // 发件人邮箱    
$bees_mail->FromName =  '未知';  // 发件人    
$bees_mail->CharSet = "UTF-8";     
$bees_mail->Encoding = "base64";  



@include(INC_PATH.'mysql.class.php');
$mysql=new mysql(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME,DB_CHARSET,DB_PCONNECT);
//载入缓存文件
if(file_exists(DATA_PATH.'cache/lang_cache.php')){include(DATA_PATH.'cache/lang_cache.php');}//语言缓存，数组$lang_cache
if(file_exists(DATA_PATH.'cache_cate/cache_category_all.php')){include(DATA_PATH.'cache_cate/cache_category_all.php');}//所有栏目缓存,数组$category
if(file_exists(DATA_PATH.'cache_channel/cache_channel_all.php')){include(DATA_PATH.'cache_channel/cache_channel_all.php');}//所有内容模型缓存,数组$channel
@include(INC_PATH.'tpl.class.php');
$tpl=new tpl(DATA_PATH.'cache_template/',DATA_PATH.'compile_tpl/',30);


?>
