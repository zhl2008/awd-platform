<?php
/**
* Author:sqlgun
* Email:sqlgun@qq.com
* Date: 2011-5-26
* http://hi.baidu.com/sqlgun
*/
header('content-type:text/html;charset=utf-8');
require 'check_login.php';   #检查登录
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/left.css" />
<script type="text/javascript" src="js/js.js"></script>
<title>left</title>
</head>

<body>
<ul id="left">
	<li><a href="#">新闻发布管理</a>
		<ul>
			<li class="leftin"><a href="addnews.php" target="main">发布新闻</a></li>
			<li class="leftin"><a href="addlook.php" target="main">修改新闻</a></li>	
		</ul>
	</li>
	<li><a href="#">新闻分类管理</a>
		<ul>
			<li class="leftin"><a href="addclass.php" target="main">添加分类</a></li>
			<li class="leftin"><a href="addclass.php" target="main">修改分类</a></li>				
		</ul>	
	</li>	
	<li><a href="#" >系统配置管理</a>

		<ul>
			<li class="leftin"><a href="addsystem.php" target="main">系统参数</a></li>	
            <li class="leftin"><a href="downlog.html" target="main">系统日志下载</a></li>	
		</ul>	
	
	</li>
	<li><a href="login.html">用户权限管理</a>
	
		<ul>
			<li class="leftin"><a href="addadmin.php" target="main">添加管理员</a></li>
			<li class="leftin"><a href="changpasswd.php" target="main">修改/删除管理员</a></li>		
		</ul>		
	</li>	
	<li><a href="logout.php">退出</a></li>
</ul>
</body>
</html>
