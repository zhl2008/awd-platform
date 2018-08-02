<?php
/**
* Author:sqlgun
* Email:sqlgun@qq.com
* Date: 2011-6-7
* http://hi.baidu.com/sqlgun
*/
define('GUY','true');
require 'common.inc.php';
if(isset($_GET['id'])){
	$_html['id']=$_GET['id'];
	if(empty($_html['id']) || !is_numeric($_html['id']) || $_html['id']<0 || ($_html['id']>0 && $_html['id']<1)){
	echo '<script type="text/javascript">alert("非法访问!");location.href="index.php";</script>';
	exit;
	}else{
	$_html['id']=intval($_html['id']);	
	}
}else{
	echo '<script type="text/javascript">alert("非法访问!");location:index.php;</script>';
	exit;	
}
$_result=mysql_query("select title,hits from news where id='{$_html['id']}'");
$_rows=mysql_fetch_array($_result);
$_html['title']=$_rows['title'];
$_html['hits']=$_rows['hits'];

global $_system;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_html['title'] ?>　<?php echo $_system['name']?></title>
<link rel="stylesheet" type="text/css" href="css/css.css" />
<link rel="stylesheet" type="text/css" href="css/sqlgunnews.css" />
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
<dl>
<?php 
$_result=mysql_query("select title,birth,date,content from news where id='{$_html['id']}'");
$_rows=mysql_fetch_array($_result);
$_a='/onmousemove="(.*)"/';
$_b='';
?>
<dt><?php echo $_rows['title']?></dt>
<dd class="dd1"><?php echo $_rows['date']?></dd>
<dd class="dd1"><?php echo $_rows['birth']?></dd>
<dd class="dd2"><?php echo preg_replace($_a,$_b,$_rows['content'])?></dd>
</dl>
<?php 
mysql_query("update news set hits='{$_html['hits']}'+1 where id='{$_html['id']}'")
?>
</div>
</div>
</div>
<?php
require 'foot.php';
?>
<?php 
mysql_close();
?>
</body>
</html>
