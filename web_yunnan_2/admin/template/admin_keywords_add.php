<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>关键词列表</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.q').find('ul li').click(function(){
		$index=$('.q').find('ul li').index(this);
		$('#tb').find('div').eq($index).show().siblings().hide();
	});
});
</script>
<?php
	$tech_num = (count($tech_arr)-1);
	$show_tech = $tech_arr[rand(0,$tech_num)];
?>
<script type="text/javascript">
	$(document).ready(function(){
		$str = '<?php echo $show_tech;?>';
		$('#show_tech').html("<em>小提示：</em>"+$str).fadeIn('slow');
	});
</script>
</head>

<body>
<div class="admin_position"><span>当前位置 > 添加内链</span><p id="show_tech" style="display:none"></p></div><!--位置-->
<div class="admin_fh"><a href="?">返回</a></div>	
		
<div class="order_contain">			
<form name="maininfo" method="post" enctype="multipart/form-data" action="?" class="form">
<div class="order_main">
 <table cellpadding="0" cellspacing="0" width="100%">
 	<thead>
		<tr><th class="w1">参数说明</th><th class="w2">参数值</th><th class="w3 r">变量名</th></tr>
	</thead>
	<tbody>
		<tr>
		  <td class="w1" style="text-align:center">关键词:</td><td class="w2"><input type="text" name="key_words" style="width:80%" value="<?php echo isset($_confing['web_name'])?$_confing['web_name']:'';?>"/></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">链接地址:</td><td class="w2"><input type="text" name="words_url" style="width:80%" value="http://"/></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">排序:</td><td class="w2"><input type="text" name="words_order" style="width:20%" value="1"/></td><td class="w3"></td>
		</tr>
	</tbody>
 </table>
 </div>

<div class="order_btn">
<input type="hidden" name="action" value="save_words"/><input type="hidden" name="lang" value="<?php echo $lang;?>"/>
  <input type="submit" value="确定" name="submit" class="go"/><input type="reset" style="margin:0 10px;" class="go" value="重置" name="reset"/>
 </div>
</form>
</div>

</body>
</html>
