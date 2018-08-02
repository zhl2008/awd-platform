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
$_result=mysql_query("select class from class where id='{$_html['id']}'");
$_rows=mysql_fetch_array($_result);
$_html['class']=$_rows['class'];


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
$_result=mysql_query("select id from news where uid='{$_html['id']}' or uid in (select id from class where uptypeid='{$_html['id']}') ");
$_nums=mysql_num_rows($_result);
$_pages=ceil($_nums/$_pagenums);
$_results=mysql_query("select id,title,date from news where uid='{$_html['id']}' or uid in (select id from class where uptypeid='{$_html['id']}') limit $_pageopen,$_pagenums");

function tre($_id,$_num){

$_results=mysql_query("select id,class from class where uptypeid='{$_id}'");
while(!!$_row=mysql_fetch_array($_results,MYSQL_ASSOC)){
echo "<li><a href=sqlgunclass.php?id=".$_row['id'].">".str_repeat('　',$_num)."|-".$_row['class']."</a></li>";
tre($_row['id'],$_num+1);
}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_html['class'] ?>　<?php echo $_system['name']?></title>
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
<li class="li1">新闻分类</li>
<?php 
$_result=mysql_query("select id,class from class where uptypeid='{$_html['id']}'");
$_number=mysql_num_rows($_result);
if($_number==0){
echo "<li>没有分类</li>";
}else{
	while(!!$_rows=mysql_fetch_array($_result)){ 
	echo "<li><a href=sqlgunclass.php?id=".$_rows['id'].">".$_rows['class']."</a></li>";
	tre($_rows['id'],1);		
	}
}
?>
</ul>
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
<p>当前新闻分类：<?php echo $_html['class'] ?></p>
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
<li><a href="?id=<?php echo $_html['id']?>&page=1">首页</a></li>
<li><a href="?id=<?php echo $_html['id']?>&page=<?php echo $_page-1?>">上一页</a></li>		
<?php }
?>

<?php 
if($_page==$_pages|| $_nums==0){?>
<li>下一页</li>
<li>尾页</li>	
<?php }else{?>
<li><a href="?id=<?php echo $_html['id']?>&page=<?php echo $_page+1?>">下一页</a></li>
<li><a href="?id=<?php echo $_html['id']?>&page=<?php echo $_pages?>">尾页</a></li>		
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
