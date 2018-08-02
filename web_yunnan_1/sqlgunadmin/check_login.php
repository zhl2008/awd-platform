<?php
session_start();
if(!isset($_COOKIE['login'])||$_COOKIE['login']==""){
	echo'<script type="text/javascript"> alert("非法登录!");location.href="login.php"; </script>';	
	exit;
}
if($_COOKIE['login']!=$_SESSION['user']){
	echo'<script type="text/javascript"> alert("非法登录!");location.href="login.php"; </script>';	
	exit;    
}
?>