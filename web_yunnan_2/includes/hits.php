<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/
define('CMS',true);
define('CMS_PATH',str_replace('includes','',str_replace('\\','/',dirname(__FILE__))));
include('init.php');
$mysql=new mysql(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME,DB_CHARSET,DB_PCONNECT);
$id=intval($_GET['id']);
if(empty($id)){
	exit;
}
$mysql->query("update ".DB_PRE."maintb set hits=hits+1 where id={$id}");
$hits=$mysql->get_row("select hits from ".DB_PRE."maintb where id={$id}");
echo "document.write('{$hits}');";
?>
