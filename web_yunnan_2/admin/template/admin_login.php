<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理登陆</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$('#code').click(function(){
$(this).attr('src','admin_code.php?tag='+new Date().getTime());
});
});
</script>
<style type="text/css">
body{background:#75cbfa url('template/images/login_bg.gif') repeat-x left top;}
</style>
</head>

<body>
<div class="login">
<div class="login_bg">
<div class="login_bg2">
<div class="login_title">
<form name="login" action="?action=ck_login" method="post">
<div class="login_left">
<p><label>用户名：</label><input name="user" value="" class="f" /></p><div class="clear"></div>
<p><label>密码：</label><input type="password" name="password" value="" class="f" /></p><div class="clear"></div>
<?php
		if(!empty($_sys['safe_open'])){
		foreach($_sys['safe_open'] as $k=>$v){
		if($v=='3'){
		?>
<p><label>验证码：</label><span class="f" style="margin:0; padding:0; display:block"><input name="code" value="" style="width:50px; display:block; float:left; margin-right:3px; display:inline"/><img style="display:block; float:left; cursor:pointer" src="admin_code.php" border="0" id="code"/></span></p><div class="clear"></div>
<?php }
}
}
?>
</div>
<div class="login_right"><input type="hidden" name="submit" value="true" /><input type="image" name="submit" src="template/images/login_btn.gif" /></div>
<div class="clear"></div>
</form>
</div>
</div>
</div>
</div>

</body>
</html>
