<?php
/**
* Author:sqlgun
* Email:sqlgun@qq.com
* Date: 2011-6-1
* http://hi.baidu.com/sqlgun
*/
define('GUY','true');
require '../common.inc.php';
require 'check_login.php';   #检查登录
if($_GET['action']=='add'){
	
	if(empty($_POST['admin']) || empty($_POST['password'])){
		echoalerthistory('账号/密码不得为空!');
		exit;
	}
	$_html=array();
	$_html['admin']=trim($_POST['admin']);
	$_html['password']=md5(trim($_POST['password']));	
	
	mysql_query("insert into admin(admin,password) values('{$_html['admin']}','{$_html['password']}')");	
	echoalerthistory('添加成功!');
}
if($_GET['action']=='modify'){
	if(empty($_POST['admin']) || empty($_POST['password'])){
		echoalerthistory('账号/密码不得为空!');
		exit;
	}	

	if($_POST['admin']!=$_COOKIE['username']){
		echoalerthistory('你只能修改自己的账号和密码!');
		exit;		
	}
	$_html=array();
	$_html['admin']=trim($_POST['admin']);
	$_html['password']=md5(trim($_POST['password']));	
		
	@mysql_query("update admin set admin='{$_html['admin']}',password='{$_html['password']}' 
	where admin='{$_COOKIE['username']}' ")or die('修改有错误!');
	echoalerthistory('修改成功!');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/addadmin.css"/>
<title>添加/修改管理员</title>
</head>

<body>
<div id="addadmin">
<p>添加管理员</p>
<form method="post" action="?action=add">
<ul>
<li>账号：<input type="text" name="admin" /></li>
<li>密码：<input type="password" name="password" /></li>
<li><input type="submit" value="添加" /></li>
</ul>
</form>
</div>
<div id="modify">
<p>修改管理员</p>
<form method="post" action="?action=modify">
<ul>
<li>账号：<input type="text" name="admin" value="<?php echo $_COOKIE['username']?>" /></li>
<li>密码：<input type="password" name="password" /></li>
<li><input type="submit" value="修改" /></li>
</ul>
</form>
</div>
<?php 
mysql_close();
?>
</body>
</html>
