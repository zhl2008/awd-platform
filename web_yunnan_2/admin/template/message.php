<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>操作信息</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript">
var $time=0;
var $totaltime=5;
$is_time=$totaltime;
function time_go(){
	$is_time=$is_time-1;
	$time=$time+1;
	$('#is_time').html($is_time);
	if($time==$totaltime){
		$url=$('#time_url').find('a').attr('href');
		location.href=$url;
	}
	if($time<$totaltime){
		setTimeout("time_go()",1000);
	}
}
</script>
<style type="text/css">
body{backgroud:#f8f8f8}
</style>
</head>

<body>
<div class="msg_body">
	<div class="msg_lan">操作信息</div><!--当前位置-->
	<div class="msg_contain">
		<?php echo $message;?>
	</div>
</div>

</body>
</html>
