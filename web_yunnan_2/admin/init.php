<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

if (!defined('IN_CMS'))
{
    die('Hacking attempt');
}
error_reporting(E_ALL & ~E_NOTICE);
$dir_name=str_replace('\\','/',dirname(__FILE__));
$admindir=substr($dir_name,strrpos($dir_name,'/')+1);
define('ADMINDIR',$admindir);
define('CMS_PATH',str_replace($admindir,'',$dir_name));
define('TP_PATH',CMS_PATH.'template/');
define('INC_PATH',CMS_PATH.'includes/');
define('DATA_PATH',CMS_PATH.'data/');
define('MB_PATH',CMS_PATH.'member/');
define('LANG_PATH',CMS_PATH.'languages/');
@ini_set('date.timezone','Asia/Shanghai');
@ini_set('display_errors',1);
@ini_set('session.use_trans_sid', 0);
@ini_set('session.auto_start',    0);
@ini_set('session.use_cookies',   1);
@ini_set('memory_limit',          '64M');
@ini_set('session.cache_expire',  180);
session_start();
header("Cache-control: private");
header("Content-type: text/html; charset=utf-8"); 
include(INC_PATH.'fun.php');

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
include(DATA_PATH.'confing.php');
define('CMS_URL','http://'.$_SERVER['HTTP_HOST'].CMS_SELF);
include(INC_PATH.'mysql.class.php');
$mysql=new mysql(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME,DB_CHARSET,DB_PCONNECT);
if(file_exists(DATA_PATH."cache/cache_admin_group.php")){include(DATA_PATH."cache/cache_admin_group.php");}
//检查登陆
if(!is_login()){header('location:login.php');exit;}
include(INC_PATH.'cache.class.php');
$cache=new cache();
include("version.php");
//ckeditor初始化
include('ckeditor.php');
$CKEditor = new CKEditor();
$CKEditor->basePath = '../ckeditor/';
$CKEditor->returnOutput=true;
$fck_config = array();
$fck_config['extraPlugins']='neilian';
$fck_config['width'] = '97%';//宽度
$fck_config['height'] = 400;//高度
$fck_config['toolbar'] = array(
array( 'Cut','Copy','Paste','PasteText','PasteFromWord' ),
array('Undo','Redo','-','SelectAll','RemoveFormat'),
array('Bold','Italic','Underline','Strike','-','Subscript','Superscript'),
array('NumberedList','BulletedList','-','Outdent','Indent','Blockquote'),
array('JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'),
array( 'Source','-','Preview' ),
array('Link','Unlink','Anchor','Neilian','-','Image','Flash','Table','Smiley','PageBreak'),
array('Styles','Format','Font','FontSize'),
array('TextColor','BGColor','-','Maximize', '-','About'),
);

//载入语言包(简体中文)
if(file_exists(LANG_PATH.'lang_cn.php')){include(LANG_PATH.'lang_cn.php');}
if(file_exists(DATA_PATH.'cache_cate/cache_category_all.php')){include(DATA_PATH.'cache_cate/cache_category_all.php');}//所有栏目缓存,数组$category
if(file_exists(DATA_PATH.'cache_channel/cache_channel_all.php')){include(DATA_PATH.'cache_channel/cache_channel_all.php');}//所有内容模型缓存,数组$channel
if(file_exists(DATA_PATH.'sys_info.php')){include(DATA_PATH.'sys_info.php');}//系统设置缓存,数组$_sys
if(file_exists(DATA_PATH.'cache/tech_arr.php')){include(DATA_PATH.'cache/tech_arr.php');}//系统设置缓存,数组$_sys
define('PW',pw());

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


include(INC_PATH.'tpl.class.php');
$tpl=new tpl(DATA_PATH.'cache_template/',DATA_PATH.'compile_tpl/',30);


$session_admin=$_SESSION['admin'];
$sql="select*from ".DB_PRE."admin where admin_name='{$session_admin}'";
$rel_admin=$mysql->fetch_asc($sql);
$admin_nav=empty($_REQUEST['nav'])?'main':$_REQUEST['nav'];
$admin_p_nav=empty($_REQUEST['admin_p_nav'])?'main_info':$_REQUEST['admin_p_nav'];
if(!empty($channel)){
		foreach($channel as $key=>$value){
			if($value['is_alone']||$value['is_disable']||$value['id']=='-9'){
				continue;
			}
				$admin_nav_c_arr[]=$value;
		}
}

$lang=!empty($_REQUEST['lang'])?fl_html(fl_value($_REQUEST['lang'])):get_lang_main();
?>