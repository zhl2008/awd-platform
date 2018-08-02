<?php
/**
* Author:sqlgun
* Email:sqlgun@qq.com
* Date: 2011-5-23
* http://hi.baidu.com/sqlgun
*/
//header('content-type:text/html;charset=utf-8;');
define('GUY','true');
require '../common.inc.php';
require 'check_login.php';   #检查登录
global $_system;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_system['name']?>后台</title>
</head>
<frameset rows="127,*,11" frameborder="no" border="0" framespacing="0" >
<frame scrolling="no" src="top.php" />
<frame scrolling="no" src="center.php" />
<frame scrolling="no" src="bottom.php" />
</frameset>
<body>
</body>
</html>
