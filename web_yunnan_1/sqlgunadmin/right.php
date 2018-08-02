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
<link rel="stylesheet" type="text/css" href="css/right.css" />
<title>right</title>
</head>

<body>
<div id="right">
<div id="daohang">
	<p>基本信息列表</p>
	<ul>
	<li class="li1">添加</li>
	<li class="li2">删除</li>
	<li class="li3">编辑</li>
	</ul>
</div>
<div id="about">
<p>欢迎使用sqlgun新闻发布系统，作者联系方式:sqlgun@qq.com http://hi.baidu.com/sqlgun</p>
<p>现有功能：新闻无限分类，html编辑器发帖，在系统配置里面可以设定前台部分参数等。</p>
</div>
</div>
</body>
</html>
