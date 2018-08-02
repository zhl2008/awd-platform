<?php
/**
* Author:sqlgun
* Email:sqlgun@qq.com
* Date: 2011-5-30
* http://hi.baidu.com/sqlgun
*/
define('GUY','true');
require '../common.inc.php';
require 'check_login.php';   #检查登录
if($_GET['action']=='add'){
	$_html=array();
	$_html['name']=htmlspecialchars(trim($_POST['name']));
	$_html['pagenums']=htmlspecialchars($_POST['pagenums']);	
	$_html['newsnums']=htmlspecialchars($_POST['newsnums']);	
	$_html['hotnums']=htmlspecialchars($_POST['hotnums']);			
	$_html['copy']=htmlspecialchars(trim($_POST['copy']));
	
	mysql_query("update system set name='{$_html['name']}',
	pagenums='{$_html['pagenums']}',
	newsnums='{$_html['newsnums']}',
	hotnums='{$_html['hotnums']}',
	copy='{$_html['copy']}'");	
	echoalert('添加修改成功!');
}

$_result=mysql_query("select * from system");
$_rows=mysql_fetch_array($_result);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/addsystem.css" />
<title>添加系统参数</title>
</head>
<body>
<div id="addnews">
<p>添加系统参数</p>
<form method="post" action="?action=add">
<ul>
<li>网站　名称：<input type="text" name="name" value="<?php echo $_rows['name']?>" /></li>
<li class="li1">每页新闻数：<input type="text" name="pagenums" value="<?php echo $_rows['pagenums']?>" /></li>
<li class="li1">最新新闻数：<input type="text" name="newsnums" value="<?php echo $_rows['newsnums']?>" /></li>
<li class="li1">热门新闻数：<input type="text" name="hotnums" value="<?php echo $_rows['newsnums']?>" /></li>
<li >底部　版权：<input type="text" name="copy" value="<?php echo $_rows['copy']?>" /></li>
<li class="li3"><input type="submit" value="提交" /></li>
</ul>
</form>
</div>
<?php 
mysql_close();
?>
</body>
</html>
