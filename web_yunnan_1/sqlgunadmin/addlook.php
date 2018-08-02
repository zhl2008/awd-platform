<?php
/**
* Author:sqlgun
* Email:sqlgun@qq.com
* Date: 2011-6-2
* http://hi.baidu.com/sqlgun
*/
define('GUY','true');
require '../common.inc.php';
require 'check_login.php';   #检查登录

if(isset($_GET['del'])&&$_GET['del']=='del'){
	mysql_query("delete from news where id='{$_GET['id']}'");
	echo'<script type="text/javascript"> alert("删除记录成功!");location.href="addlook.php"; </script>';	
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
$_pagenum=15;
$_results=mysql_query("select id from news");
$_num=mysql_num_rows($_results);
$_pages=ceil($_num/$_pagenum);
$_pageopen=($_page-1)*$_pagenum;
$_result=mysql_query("select * from news order by date DESC limit $_pageopen,$_pagenum");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/addlook.css" />
<title>新闻列表</title>
</head>

<body>
<div id="addlook">
<p>新闻列表</p>
<table>
<tr>
<th>编号</th><th>新闻分类</th><th>新闻标题</th><th>新闻来源</th><th>发布时间</th><th>操作</th>
</tr>
<?php 

while(!!$_rows=mysql_fetch_array($_result,MYSQL_ASSOC)){
?>
<tr>
<td><?php echo $_rows['id'] ?></td><td><?php 
$_results=mysql_query("select class from class where id='{$_rows['uid'] }'");
$_row=mysql_fetch_array($_results);
echo $_row['class']?></td><td><?php echo $_rows['title'] ?></td><td><?php echo $_rows['birth'] ?></td><td><?php echo $_rows['date'] ?></td><td><a href="modifynews.php?id=<?php echo $_rows['id']?>">修改</a>　<a href="?id=<?php echo $_rows['id']?>&del=del">删除</a></td>
</tr>
<?php 	
}?>
</table>
<ul>
<li><?php echo $_page?>/<?php echo $_pages?>页</li>
<li>共有<?php echo $_num?>条新闻</li>
<?php if($_page==1){
echo'<li>首页</li>';
echo'<li>上一页</li>';	
}else{
echo'<li><a href="?">首页</a></li>';
echo'<li><a href="?page='.($_page-1).'">上一页</a></li>';
}
?>
<?php if($_page==$_pages){
echo'<li>下一页</li>';	
echo'<li>尾页</li>';
}else{
echo'<li><a href="?page='.($_page+1).'">下一页</a></li>';	
echo'<li><a href="?page='.$_pages.'">尾页</a></li>';	
}
 ?>
</ul>
</div>
</body>
</html>
