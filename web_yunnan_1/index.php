<?php
/**
* Author:sqlgun
* Email:sqlgun@qq.com
* Date: 2011-6-5
* http://hi.baidu.com/sqlgun
*/
define('GUY','true');
require 'common.inc.php';
global $_system;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_system['name']?>首页</title>
<link rel="stylesheet" type="text/css" href="css/css.css" />
<link rel="stylesheet" type="text/css" href="css/index.css" />
</head>

<body>
<?php 
require 'head.php';
?>
<div id="index">
<div id="indexin">
<div id="indexin1">
<ul>
<li class="li1">最新新闻</li>
<?php 
$_result=mysql_query("select id,title from news order by date DESC limit 0,{$_system['newsnums']}");
while(!!$_rows=mysql_fetch_array($_result)){?>
<li><a href="sqlgunnews.php?id=<?php echo $_rows['id']?>"><?php echo mb_substr($_rows['title'],0,17,'utf-8') ?></a></li>
<?php	
}
?>
</ul>
<ul>
<li class="li1">热门新闻</li>
<?php 
$_result=mysql_query("select id,title from news order by hits DESC limit 0,{$_system['hotnums']}");
while(!!$_rows=mysql_fetch_array($_result)){?>
<li><a href="sqlgunnews.php?id=<?php echo $_rows['id']?>"><?php echo mb_substr($_rows['title'],0,17,'utf-8') ?></a></li>
<?php	
}
?>
</ul>
</div>
<div id="indexin2">
<p class="p1"><span>welcome to use sqlgun 新闻发布系统</span></p>
<dl>
<?php 
$_result=mysql_query("select id,title,date,content from news order by date DESC limit 1");
$_rows=mysql_fetch_array($_result);
$_a='/<img(.*)\/>/';
$_b='';
?>
<dt><?php echo $_rows['title']?></dt>
<dd class="dd1"><?php echo $_rows['date']?></dd>
<dd class="dd2"><a href="sqlgunnews.php?id=<?php echo $_rows['id']?>"><?php echo mb_substr(preg_replace($_a,$_b,$_rows['content']),0,350,'utf-8')?></a></dd>
</dl>
</div>
</div>
</div>
<?php
require 'foot.php';
?>
<?php 
mysql_free_result($_result);
mysql_close();
?>
</body>
</html>
