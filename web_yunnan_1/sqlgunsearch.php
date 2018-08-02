<?php
/**
* Author:sqlgun
* Email:sqlgun@qq.com
* Date: 2011-6-8
* http://hi.baidu.com/sqlgun
*/
define('GUY','true');
require 'common.inc.php';
global $_system;

if(isset($_POST['key'])){
	$_key=trim($_POST['key']);
}else{
	echo '<script type="text/javascript">alert("非法访问!");location.href="index.php";</script>';
}

if(isset($_GET['page'])){
	$_page=$_GET['page'];
	if(empty($_page)|| !is_numeric($_page)||$_page<0|| ($_page>0 && $_page<1)){
		$_page=1;
	}else{
		$_page=intval($_page);
	}	
}else{
	$_page=1;
}
$_pagenums=$_system['pagenums'];
$_pageopen=($_page-1)*$_pagenums;
echo "select id from news where title like '%$_key%'";
$_result=mysql_query("select id from news where title like '%$_key%'");
$_nums=mysql_num_rows($_result);
$_pages=ceil($_nums/$_pagenums);
$_results=mysql_query("select id,title,date from news  where title like '%$_key%' order by date DESC limit $_pageopen,$_pagenums");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>全部新闻　<?php echo $_system['name']?></title>
<link rel="stylesheet" type="text/css" href="css/css.css" />
<link rel="stylesheet" type="text/css" href="css/sqlgunclass.css" />
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
<div id="indexin21">
<p>全部新闻：</p>
</div> 
<ul>
<?php 
while(!!$_rows=mysql_fetch_array($_results)){
?>
<li><span><?php echo $_rows['date'] ?></span><a href="sqlgunnews.php?id=<?php echo $_rows['id'] ?>"><?php echo $_rows['title'] ?></a></li>
<?php }?>
</ul>
<div id="indexin22">
<ul>
<li><?php echo $_page?>/<?php echo $_pages?>页</li>
<li>共<?php echo $_nums?>条新闻</li>
<?php 
if($_page==1){?>
<li>首页</li>
<li>上一页</li>	
<?php }else{?>
<li><a href="?page=1">首页</a></li>
<li><a href="?page=<?php echo $_page-1?>">上一页</a></li>		
<?php }
?>

<?php 
if($_page==$_pages|| $_nums==0){?>
<li>下一页</li>
<li>尾页</li>	
<?php }else{?>
<li><a href="?page=<?php echo $_page+1?>">下一页</a></li>
<li><a href="?page=<?php echo $_pages?>">尾页</a></li>		
<?php }
?>
</ul>
</div>
</div>
</div>
</div>
<?php
require 'foot.php';
?>
<?php 
mysql_free_result($_results);
mysql_close();
?>
</body>
</html>
