<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>输出配置修改</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.q').find('ul li').click(function(){
		$index=$('.q').find('ul li').index(this);
		$('#tb').find('div').eq($index).show().siblings().hide();
	});
	$('#show_list').find('tbody tr').hover(function(){
		$(this).find('td').css('background','#ccffcc');
	},function(){
		$(this).find('td').css('background','');
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
<div class="admin_position"><span>当前位置 > 修改输出设置</span><p id="show_tech" style="display:none"></p></div><!--位置-->
<div class="admin_fh"><a href="?lang=<?php echo $lang;?>">返回</a></div>

<div class="order_contain">		
<form name="maininfo" method="post" enctype="multipart/form-data" action="?action=save_made" class="form">
 <div class="order_main">
 <table cellpadding="0" cellspacing="0" width="100%" id="show_list">
 	<thead>
		<tr><th class="w1">参数说明</th><th class="w2">参数值</th><th class="w3 r">变量名</th></tr>
	</thead>
	<tbody>
		<tr>
		  <td class="w1" style="text-align:center">语言标示:</td><td class="w2"><?php echo $rel[0]['lang'];?></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">配置位置:</td><td class="w2"><?php echo $rel[0]['tpl_name']?></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">配置说明:</td><td class="w2"><?php echo $rel[0]['tpl_info']?></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">配置标签:</td><td class="w2"><?php echo $rel[0]['tpl_tag']?></td><td class="w3"></td>
		</tr>
		<?php
		if($rel[0]['tpl_tag']=='loop'){
		?>
		<tr>
		  <td class="w1" style="text-align:center">输出栏目:</td><td class="w2">
		  <select name="category"><option value="">选择栏目</option>
		  <?php
		  if(!empty($cate_list)){
		  	foreach($cate_list as $c_k=>$c_v){
				if($c_v['cate_hide']){continue;}
				$sl=($value_arr[0]==$c_v['id'])?'selected="selected"':'';
				echo "<option value=\"{$c_v['id']}\" {$sl}>{$c_v['cate_name']}</option>";
			}
		  }
		  ?>
		  </select>
		  </td><td class="w3"></td>
		</tr>
		<tr>
		 <td class="w1" style="text-align:center; color:#0000CC; background:#F3F3F3">以下设置只有<span style="color:red">内容列表</span>可以使用</td><td class="w2" style="background:#F3F3F3">&nbsp;</td><td class="w3" style="background:#F3F3F3">&nbsp;</td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">输出数量:</td><td class="w2">从<input type="text" name="num_a" value="<?php echo isset($num_arr[0])?$num_arr[0]:0;?>" style="width:30px" />到<input name="num_b" value="<?php echo isset($num_arr[1])?$num_arr[1]:10;?>" style="width:30px;" /></td><td class="w3">填写数字</td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">标题长度:</td><td class="w2"><input type="text" name="title_length" value="<?php echo isset($value_arr[6])?$value_arr[6]:0;?>" style="width:50px;" /></td><td class="w3">填写数字,0为输出原始长度</td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">输出图片:</td><td class="w2"><input type="radio" value="0" name="is_pic" <?php if(!$value_arr[1]){echo 'checked="checked"';}else{echo '';}?> />否<input type="radio" value="1" name="is_pic" <?php if($value_arr[1]){echo 'checked="checked"';}else{ echo '';}?> />是</td><td class="w3">需要标签支持</td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">内容标示:</td><td class="w2"><select name="filter">
		  <option value="0" <?php if($value_arr[2]=='0'){echo 'selected="selected"';}?>>不选择</option>
		  <option value="a" <?php if($value_arr[2]=='a'){echo 'selected="selected"';}?>>头条</option>
		  <option value="b" <?php if($value_arr[2]=='b'){echo 'selected="selected"';}?>>推荐</option>
		  <option value="c" <?php if($value_arr[2]=='c'){echo 'selected="selected"';}?>>图片</option>
		  </select></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">排序类型:</td><td class="w2"><select name="order">
		  <option value="1" <?php if($value_arr[3]=='1'){echo 'selected="selected"';}?>>更新时间</option>
		  <option value="2" <?php if($value_arr[3]=='2'){echo 'selected="selected"';}?>>ID排序</option>
		  <option value="3" <?php if($value_arr[3]=='3'){echo 'selected="selected"';}?>>发布时间</option>
		  <option value="4" <?php if($value_arr[3]=='4'){echo 'selected="selected"';}?>>点击次数</option>
		  </select></td><td class="w3"></td>
		</tr>
		<tr>
		  <td class="w1" style="text-align:center">排序方式:</td><td class="w2"><select name="order_type">
		  <option value="0" <?php if($value_arr[4]=='0'){echo 'selected="selected"';}?>>升序</option>
		  <option value="1" <?php if($value_arr[4]=='1'){echo 'selected="selected"';}?>>降序</option>
		  </select></td><td class="w3"></td>
		</tr>
		<?php
		}elseif($rel[0]['tpl_tag']=='block'){
		?>
		<tr>
		  <td class="w1" style="text-align:center">输出标示栏目:</td><td class="w2"><select name="category"><option value="">请选择添加的标示</option>
		  <?php
		  $tag=isset($value_arr[0])?$value_arr[0]:'';
		  	if(!empty($block_arr)){
				foreach($block_arr as $t_k=>$t_v){
				$sl=($tag==$t_v['id'])?'selected="selected"':'';
					echo "<option value=\"{$t_v['id']}\" {$sl}>{$t_v['tag']}</option>";
				}
			}
		  ?>
		  </select></td><td class="w3"></td>
		</tr>
		<?php
		}elseif($rel[0]['tpl_tag']=='form'){
		?>
		<tr>
		  <td class="w1" style="text-align:center">输出表单:</td><td class="w2"><select name="category"><option value="">请选择表单</option>
		   <?php
		   $form_focus=isset($value_arr[0])?$value_arr[0]:'';
		  if(!empty($form)){
		  	foreach($form as $f_k=>$f_v){
			$sl=($form_focus==$f_v['id'])?'selected="selected"':'';
				echo "<option value=\"{$f_v['id']}\" {$sl}>{$f_v['form_name']}</option>";
			}
		  }
		  ?>
		  </select></td><td class="w3"></td>
		</tr>
		<?php
		}
		?>
	</tbody>
 </table>

 </div>
<div class="order_btn">
<input type="hidden" name="lang" value="<?php echo $lang;?>"/><input type="hidden" name="id" value="<?php echo $rel[0]['id'];?>" />
  <input type="submit" value="确定" name="submit" class="go"/><input type="reset" style="margin:0 10px;" class="go" value="重置" name="reset"/>
 </div>
</form>
</div>

</body>
</html>
