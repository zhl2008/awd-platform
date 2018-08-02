<?php
/**
* Author:sqlgun
* Email:sqlgun@qq.com
* Date: 2011-5-22
* http://hi.baidu.com/sqlgun
*/
session_start();
define('GUY','true');
require '../common.inc.php';
if($_GET['action']=='login'){
/* 	if($_SESSION['code']!=$_POST['yzm']){
	echo'<script type="text/javascript"> alert("验证码错误!");location.href="login.php"; </script>';	
	exit;	
	} */
	if(empty($_POST['admin'])){
	echo'<script type="text/javascript"> alert("请输入用户账号再登录!");location.href="login.php"; </script>';			
		exit;
	}
	if(empty($_POST['password'])){
	echo'<script type="text/javascript"> alert("请输入用户密码再登录!");location.href="login.php"; </script>';			
		exit;
	}	
	$_html=array();
	$_html['admin']=trim($_POST['admin']);
	$_html['password']=md5(trim($_POST['password']));	
	$_result=@mysql_query("select * from admin where admin='{$_html[admin]}' and password='{$_html['password']}'")or die('登录错误');
	if(!!$_rows=mysql_fetch_array($_result)){
		setcookie('login',md5($_rows['admin']));
        $_SESSION['user']=md5($_rows['admin']);
		header('location:index.php');
	}else{
		echoalerthistory('登录账号信息错误!');
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet"  type="text/css" href="css/login.css" />
<title>Sqlgun系列后台管理平台登录</title>
</head>

<body>
<div id="login">
	<div id="load">
		<dl>
		<dt></dt>
			<dd class="center">
			<form method="post" action="login.php?action=login">
				<ul>
					<li class="li1"></li>
					<li class="li2">
						<ul>
							<li>　用户　<input name="admin" type="text" /></li>
							<li>　密码　<input name="password" type="password" /></li>
							<li>验证码　<input class="yzm" name="yzm" type="text" />
											 <span><img src="yzm.php" /></span>
							</li>
						</ul>
					</li>
					<li class="li3"></li>
					<li class="li4">
						<ul>
							<li><input class="lli1" type="submit" value="" /></li>
							<li><input class="lli2" type="reset" value="" /></li>
						</ul>
					</li>
					<li class="li5"></li>
				</ul>
			</form>
			</dd>
			<dd class="end"></dd>	
		</dl>
	</div>
</div>
<?php 
mysql_close();
?>
</body>
</html>
