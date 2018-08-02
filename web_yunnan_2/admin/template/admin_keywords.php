<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>关键词列表</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript" src="template/images/box/thickbox.js"></script>
<link type="text/css" href="template/images/box/thickbox.css" rel="stylesheet" />
<script type="text/javascript">
$(document).ready(function(){
	$('.q').find('ul li').click(function(){
		$index=$('.q').find('ul li').index(this);
		$('#tb').find('div').eq($index).show().siblings().hide();
	});
	$('#sl_all').click(function(){
		$('table').find('#all').attr('checked','checked');
	});
	$('#show_list').find('tr').hover(function(){
		$(this).find('td').css('background','#ccffcc');
	},function(){
		$(this).find('td').css('background','');
	});
});
</script>
</head>

<body>



<div class="admin_position"><span>当前位置 > 内链管理</span><p id="show_tech" style="display:none"></p></div><!--位置-->
<div class="lang">
			<ul>
 				<li><a href="?action=add&lang=<?php echo $lang;?>" class="hover">添加内链</a></li>
			</ul>
		</div><!--按钮-->
		
<div class="order_contain">			
<form name="maininfo" method="post" enctype="multipart/form-data" class="form">
<div class="order_main">
 <table cellpadding="0" cellspacing="0" width="100%">
 	<thead>
		<tr><th class="w1" style="width:30%">关键词</th><th class="w2" style="width:40%">链接地址</th><th class="w2" style="width:10%">排序</th><th class="w3 r" style="20%">操作</th></tr>
	</thead>
	<tbody id="show_list">
	<?php
	$maintb=DB_PRE."keywords";
	$page=empty($page)?1:$page;
	$pagesize=20;
	$pagenum=($page-1)*$pagesize;
	$filt="m.lang='{$lang}'";
	$query='&lang='.$lang.'&action=keywords';
	$order='order by m.wordsorder desc';
	$total_num=$GLOBALS['mysql']->fetch_rows("select m.id from {$maintb} as m where {$filt}");
	$total_page=ceil($total_num/$pagesize);
	$sql="select m.* from {$maintb} as m where {$filt} {$order} limit {$pagenum},{$pagesize}";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	if(!empty($rel)){
	foreach($rel as $key=>$value){
	?>
		<tr>
		  <td class="w1" style="text-align:center; width:30%"><?php echo $value['keywords'];?></td><td class="w2" style="width:50%; text-align:center"><?php echo $value['wordsurl'];?></td><td class="w2" style="width:10%; text-align:center"><?php echo $value['wordsorder'];?></td><td class="w3" style="text-align:center; width:20%"><a href="?action=edit&lang=<?php echo $lang;?>&id=<?php echo $value['id'];?>">修改</a>|<a href="javascript:if(confirm('确定要删除么,删除后将不可恢复!')){location.href='?action=del&lang=<?php echo $lang;?>&id=<?php echo $value['id'];?>';}">删除</a></td>
		</tr>
	<?php
	}
	}
	?>	
	</tbody>
 </table>
 </div>
 </form>

<div class="page page_fy">
 	<ul>
		<?php echo page('admin_keywords',$page,$query,$total_num,$total_page);?>
	</ul>
 </div>
 
</div>

</body>
</html>
