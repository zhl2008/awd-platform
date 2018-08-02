<?php
/**
* Author:sqlgun
* Email:sqlgun@qq.com
* Date: 2011-5-30
* http://hi.baidu.com/sqlgun
*/
define('GUY','true');
require '../common.inc.php';
require 'check_login.php';   #检查登录
if(isset($_GET['action'])&&$_GET['action']=='add'){
	$_html=array();
	$_html['title']=htmlspecialchars(trim($_POST['title']));
	$_html['uid']=htmlspecialchars($_POST['uid']);	
	$_html['birth']=htmlspecialchars(trim($_POST['birth']));
	$_html['content']=htmlspecialchars(trim($_POST['content']));
	
	mysql_query("insert into news(title,uid,birth,content,date) values('{$_html['title']}','{$_html['uid']}','{$_html['birth']}','{$_html['content']}',now())");	
	echoalert('添加成功!');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/addnews.css" />
<title>添加新闻</title>
<script charset="utf-8" src="kindedit/kindeditor.js"></script><script>        KE.show({                id : 'editor_id'        });</script>
</head>
<body>
<div id="addnews">
<p>添加新闻</p>
<form method="post" action="?action=add">
<ul>
<li>所属分类：<select name="uid">
<?php 
$_result=mysql_query("select id,class from class where typeid=1");

while(!!$_rows=mysql_fetch_array($_result,MYSQL_ASSOC)){?>
	<option value="<?php echo $_rows['id']?>"><?php echo $_rows['class']?></option>
<?php
trees($_rows['id'],1);
}
?>
</select>
</li>
<li class="li1">新闻标题：<input type="text" name="title" /></li>
<li>新闻来源：<input type="text" name="birth" /></li>
<li >新闻内容：</li>
<li class="li2"><textarea id="editor_id"  name="content" >欢迎使用sqlgunnews新闻发布系统</textarea></li>
<li class="li3"><input type="submit" value="提交" /></li>
</ul>
</form>
</div>
<?php 
mysql_free_result($_result);
mysql_close();
?>
</body>
</html>
