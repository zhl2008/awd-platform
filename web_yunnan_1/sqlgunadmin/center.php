<?php
/**
* Author:sqlgun
* Email:sqlgun@qq.com
* Date: 2011-5-25
* http://hi.baidu.com/sqlgun
*/
header('content-type:text/html;charset=utf-8');
require 'check_login.php';   #检查登录
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/center.css" />
<title>center</title>
</head>
<body>
<table>
	<tr>
    <td width="8" bgcolor="#353c44"></td>	
	<td width="147"><iframe width="100%" height="100%"  frameborder="0" src="left.php"></iframe></td>
	<td width="10" bgcolor="#add2da"></td>
	<td >
	<iframe name="main" width="100%" height="100%" scrolling="no" frameborder="0" src="right.php"></iframe>
	</td>
    <td width="8" bgcolor="#353c44"></td>	
	</tr>
</table>
</body>
</html>
