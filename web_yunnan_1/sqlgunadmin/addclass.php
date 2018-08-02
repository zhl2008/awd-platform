<?php
/**
* Author:sqlgun
* Email:sqlgun@qq.com
* Date: 2011-5-28
* http://hi.baidu.com/sqlgun
*/
define('GUY','true');
require '../common.inc.php';
require 'check_login.php';   #检查登录
if($_GET['action']=='addclass'){
	$_html=array();
	$_html['name']=trim($_POST['name']);	
	if($_POST['typeid']=='one'){
	mysql_query("insert into class (class,typeid,uptypeid) values('{$_html['name']}',1,0)");
	echoalerthistory('添加成功');	
	}else{
	$_result=mysql_query("select id,typeid from class where class='{$_POST['typeid']}'");	
	$_rows=mysql_fetch_array($_result,MYSQL_ASSOC);
	$_html['uptypeid']=$_rows['id'];
	$_html['typeid']=$_rows['typeid']+1;
	mysql_query("insert into class (class,typeid,uptypeid) values('{$_html['name']}','{$_html['typeid']}','{$_html['uptypeid']}')");	
	echoalerthistory('添加成功');
	}

}

if($_GET['action']=='modify'){
	if(empty($_POST['name'])){
		echoalerthistory('请填写新的分类名!');
	}
	$_html=array();
	$_html['name']=trim($_POST['name']);	
	if($_POST['typeid']=='one'){
	echoalerthistory('您没有选择要修改的分类名');	
	}else{
	$_result=mysql_query("select id from class where class='{$_POST['typeid']}'");	
	$_rows=mysql_fetch_array($_result,MYSQL_ASSOC);
	$_html['id']=$_rows['id'];
	mysql_query("update class set class='{$_html['name']}' where id='{$_html['id']}'");	
	echoalerthistory('修改成功');
	}

}
//function tree($_id,$_num){
//
//$_results=mysql_query("select id,class from class where uptypeid='{$_id}'");
//while(!!$_row=mysql_fetch_array($_results,MYSQL_ASSOC)){
//echo "<option value='".$_row['class']."'>".str_repeat('　',$_num)."|-{$_row['class']}</option>";
//tree($_row['id'],$_num+1);
//}
//}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/addclass.css" />
<title>添加新闻分类</title>
</head>

<body>
<div id="addclass">
<p>添加新闻分类(可无限分类 )</p>
<form method="post" action="?action=addclass">
<ul>
<li>添加分类名：<input type="text" name="name" /></li>
<li>所属　分类：<select name="typeid">
<option value="one">做为一级分类</option>
<?php
$_result=mysql_query("select id,class from class where typeid=1");
while (!!$_rows=mysql_fetch_array($_result,MYSQL_ASSOC)) { ?>
<option value="<?php echo $_rows['class']?>"><?php echo $_rows['class']?></option>
<?php tree($_rows['id'],1);
}
?>
</select>
</li>
<li class="li1"><input type="submit" value="添加" /></li>
</ul>
</form>
</div>
<div id="modify">
<p>修改新闻分类</p>
<form method="post" action="?action=modify">
<ul>
<li>修改分类名：<input type="text" name="name" /></li>
<li>所属　分类：<select name="typeid">
<option value="one">点击选择分类名</option>
<?php
$_result=mysql_query("select id,class from class where typeid=1");
while (!!$_rows=mysql_fetch_array($_result,MYSQL_ASSOC)) { ?>
<option value="<?php echo $_rows['class']?>"><?php echo $_rows['class']?></option>
<?php tree($_rows['id'],1);
}
?>
</select>
</li>
<li><input type="submit" value="修改" /></li>
</ul>
</form>
</div>
<?php 
mysql_free_result($_result);
mysql_close();
?>
</body>
</html>
