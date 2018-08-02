<?php
/**
* Author:sqlgun
* Email:sqlgun@qq.com
* Date: 2011-6-7
* http://hi.baidu.com/sqlgun
*/

?>
<div id="head">
<div id="head1">
<h1></h1>
<form method="post" action="sqlgunsearch.php">
<ul>
<li class="li1"><input type="text" class="input1" name="key" /></li><li class="li2"><input class="input2" type="submit" value="go"/></li>
<li class="li3">新闻搜索</li>
</ul>
</form>
</div>
<div id="head2">
<ul>
<li><a href="index.php">首页</a></li>
<?php 
$_result=mysql_query("select id,class from class where typeid='1'");
while (!!$_rows=mysql_fetch_array($_result)) {?>
<li><a href="sqlgunclass.php?id=<?php echo $_rows['id']?>"><?php echo $_rows['class']?></a></li>
<?php 
}
?>
<li><a href="sqlgunallnews.php">全部新闻</a></li>
</ul>
</div>
<div id="head3">
<ul>
<?php $_result=mysql_query("select id,class from class where typeid='2'");
while(!!$_rows=mysql_fetch_array($_result)) {?>
<li><a href="sqlgunclass.php?id=<?php echo $_rows['id']?>"><?php echo $_rows['class']?></a></li>
<?php }?>
</ul>
</div>
</div>