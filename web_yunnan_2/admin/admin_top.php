<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

define('IN_CMS','true');
include('init.php');
if(empty($_SESSION['login_in'])||empty($_SESSION['admin'])){msg("请先登录",'login.php');}
$sql="select*from ".DB_PRE."admin where admin_name='{$_SESSION['admin']}'";
$rel=$mysql->fetch_asc($sql);
include('template/admin_top.php');
?>