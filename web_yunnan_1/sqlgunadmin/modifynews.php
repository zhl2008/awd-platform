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
if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])){
	$_result=mysql_query("select * from news where id='{$_GET['id']}'");
	$_rows=mysql_fetch_array($_result);
	define('ROWS',$_rows['uid']);
}else{
	echoalerthistory('非法提交!');
}


function tre($_id,$_num){

$_resultt=mysql_query("select id,class from class where uptypeid='{$_id}'");
while(!!$_roww=mysql_fetch_array($_resultt,MYSQL_ASSOC)){
	if(ROWS==$_roww['id']){
echo "<option value='".$_roww['id']."' selected='selected'>".str_repeat('　',$_num)."|-{$_roww['class']}</option>";}else{
echo "<option value='".$_roww['id']."'>".str_repeat('　',$_num)."|-{$_roww['class']}</option>";	
	}
tre($_roww['id'],$_num+1);
}
}

if($_GET['action']=='modify'){
	$_html=array();
	$_html['title']=htmlspecialchars(trim($_POST['title']));
	$_html['uid']=htmlspecialchars($_POST['uid']);	
	$_html['birth']=htmlspecialchars(trim($_POST['birth']));
	$_html['content']=htmlspecialchars(trim($_POST['content']));
	
	mysql_query("update news set 
	title='{$_html['title']}',uid='{$_html['uid']}',
	birth='{$_html['birth']}',content='{$_html['content']}',date=now() where id='{$_GET['id']}'");	
	echo'<script type="text/javascript"> alert("修改成功！");location.href="addlook.php";</script>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/addnews.css" />
<title>修改新闻</title>
<script charset="utf-8" src="kindedit/kindeditor.js"></script><script>        KE.show({                id : 'editor_id'        });</script>
</head>
<body>
<div id="addnews">
<p>修改新闻</p>
<form method="post" action="?action=modify&id=<?php echo $_GET['id'] ?>">
<ul>
<li>所属分类：<select name="uid">
<?php 
$_results=mysql_query("select id,class from class where typeid=1");

while(!!$_row=mysql_fetch_array($_results,MYSQL_ASSOC)){?>
	<option value="<?php echo $_row['id']?>" <?php 
	if(ROWS==$_row['id']){
	echo 'selected="selected"';
	}
	?>><?php echo $_row['class']?></option>

<?php
tre($_row['id'],1);
}
?>
</select>
</li>
<li class="li1">新闻标题：<input type="text" name="title" value="<?php echo $_rows['title']?>"/></li>
<li>新闻来源：<input type="text" name="birth" value="<?php echo $_rows['birth']?>" /></li>
<li >新闻内容：</li>
<li class="li2"><textarea id="editor_id"  name="content"><?php echo $_rows['content']?></textarea></li>
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
