<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>输出配置</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.q').find('ul li').click(function(){
		$index=$('.q').find('ul li').index(this);
		$('#tb').find('div').eq($index).show().siblings().hide();
	});
	$('#show_list').find('tbody').hover(function(){
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
<div class="admin_position"><span>当前位置 > 输出设置</span><p id="show_tech" style="display:none"></p></div><!--位置-->

<div class="lang">
			<ul>
			 <?php
 $cache_file=DATA_PATH."cache/lang_cache.php";
 $cache_arr=read_cache($cache_file,'lang_cache');
 if(!empty($cache_arr)){
 foreach($cache_arr as $k=>$v){
  if(!$v['lang_is_use']){continue;}
 ?>
 <li><a href="?lang=<?php echo $v['lang_tag'];?>" class="<?php if($GLOBALS['lang']==$v['lang_tag']){echo 'hover';}?>"><?php echo $v['lang_name'];?></a></li>
 <?php
 }
 }
 ?>
		</ul>
</div><!--语言-->

<div class="caozuo_nav" style="width:97%; margin:0 auto">
<p style="line-height:24px;">该部分内容要配合模板标签和函数使用</p>
<div class="clear"></div>
</div><!--小操作导航-->

<div class="order_contain">
 <div class="order_main">
 <table cellpadding="0" cellspacing="0" width="100%"  id="show_list">
 	<thead>
		<tr><th class="w1" style="width:15%">位置说明</th><th class="w2" style="width:15%">输出类型</th><th class="w3 r" style="width:45%">输出说明</th><th style="width:15%">操作</th></tr>
	</thead>
	
	<?php
	$page=empty($page)?1:$page;
	$pagesize=15;
	$pagenum=($page-1)*$pagesize;
	$query="&lang=".$lang."&action=out";
	$total_num=$GLOBALS['mysql']->fetch_rows("select id from ".DB_PRE."tpl where lang='".$lang."'");
	$total_page=ceil($total_num/$pagesize);
	$sql="select*from ".DB_PRE."tpl where lang='".$lang."' order by id desc limit {$pagenum},{$pagesize}";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	if(!empty($rel)){
	foreach($rel as $k=>$v){
	?>
	<tbody>
		<tr>
		  <td class="w1" style="text-align:center;width:15%"><?php echo $v['tpl_name'];?></td>
		  <td class="w2" style="width:15%; text-align:center"><?php 
		  $type=$v['tpl_tag'];
		  switch ($type){
		  	case 'loop':
			echo '内容列表loop';
			break;
			case 'block':
			echo '标示内容block';
			break;
			case 'form':
			echo '表单form';
			break;
		  }?></td><td class="w3" style="width:45%; text-align:center">
		  <?php echo isset($v['tpl_info'])?$v['tpl_info']:'';?>
		  </td>
		  <td style="width:15%; text-align:center"><a href="?action=made&id=<?php echo $v['id'];?>&lang=<?php echo $lang;?>">修改配置</a>|<a href="javascript:if(confirm('确定要删除么')){location.href='?action=del&id=<?php echo $v['id'];?>';}">删除</a></td>
		</tr>
		</tbody>
	<?php
	}
	}
	?>	
	
 </table>
 </div>
 <div class="page page_fy">
		<?php echo page('admin_template_out',$page,$query,$total_num,$total_page);?>
 </div>
</div>


</body>
</html>
