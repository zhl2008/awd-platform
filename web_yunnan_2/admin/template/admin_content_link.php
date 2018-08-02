<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>内容管理</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#show_list').find('tr').hover(function(){
		$(this).find('td').css('background','#ccffcc');
	},function(){
		$(this).find('td').css('background','');
	});
	$('#sl_link').click(function(){
	$r=$('#tb').find('#all').filter(':checked');
	$url=$('#text_url_'+$r.val()).val();
	$text=$('#text_'+$r.val()).val();
	//$return='<a href="'+$url+'" target="_blank">'+$text+'</a>';
	//callback($return);
	$return=$url+'||'+$text;
	window.returnValue=$return;
	window.close();
	/*
	for(i=0;i<$r.size();i++){
		if($r.eq(i).attr('checked')){
			alert($r.eq(i).val());
		}
	}
	*/
		//callback('ceshi');
	});
});

</script>
</head>

<body>
<base target="_self">
<div class="admin_position"><span>当前位置 > 主广告管理</span></div><!--位置-->

<div class="order_contain">	
<form name="form" id="form1" method="post" action="" class="form">
<div class="list_sl_btn">
	<ul>
	<li><select name="order" style="margin-top:2px;">
	<option value="">排序</option>
	<option value="addtime" <?php if($order=='addtime'){echo 'selected="selected"';}?>>时间排序</option>
	<option value="hits" <?php if($order=='hits'){echo 'selected="selected"';}?>>点击排序</option>
	</select></li>
	<li><select name="verify" style="margin-top:2px;">
	<option value="0" <?php if(!intval($verify)){echo 'selected="selected"';}?>>审核</option>
	<option value="1" <?php if(intval($verify)){echo 'selected="selected"';}?>>未审核</option>
	</select></li>
	<li>关键字：<input type="text" name="key" value="<?php echo $key;?>" /></li>
	<li><input type="button" name="sousuo" value="搜索" class="go" onclick="javascript:this.form.action='admin_content_link.php?lang=<?php echo $lang;?>';this.form.submit();" /></li>
</div>

<?php
if(!empty($key)){
?>
<div class="order_main" id="tb">
 <table cellpadding="0" cellspacing="0" width="100%">
 	<thead>
		<tr><th style="width:5%">选择</th><th style="width:35%">文章标题</th><th style="width:10%">添加时间</th><th style="width:20%">所属栏目</th><th style="width:10%">浏览权限</th><th style="width:5%">点击</th><th style="width:10%">状态</th><th style="width:5%">发布人</th></tr>
	</thead>
	<tbody id="show_list">
	<?php
	$maintb=DB_PRE."maintb";
	$page=empty($page)?1:$page;
	$pagesize=8;
	$pagenum=($page-1)*$pagesize;
	$filt="m.lang='{$lang}'";
	$query='&lang='.$lang.'&order='.$order.'&key='.$key.'&verify='.$verify;
	$filt.=empty($verify)?'':' and m.verify='.$verify;
	$filt.=empty($key)?'':" and m.title like '%".$key."%'";
	$order=empty($order)?'order by m.id desc':'order by m.'.$order.' desc';
	$total_num=$GLOBALS['mysql']->fetch_rows("select m.id from {$maintb} as m where {$filt}");
	$total_page=ceil($total_num/$pagesize);
	$sql="select m.* from {$maintb} as m where {$filt}  {$order} limit {$pagenum},{$pagesize}";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	if(!empty($rel)){
	foreach($rel as $key=>$value){
	//标题样式
	$channel_info=get_cate_info($value['channel'],$channel);//获得内容模型信息
	$content_php=empty($channel_info['content_php'])?'show_content.php':$channel_info['content_php'];
			if($value['title_color']||$value['title_style']){
			$font_style='<font style="';
			$font_style.=empty($value['title_color'])?'':'color:'.$value['title_color'].';';
			if($value['title_style']==1){
			$font_style.='font-weight:bold;';
			}elseif($value['title_style']==2){
				$font_style.='font-style:italic;';
			}elseif($value['title_style']==3){
				$font_style.='text-decoration:underline;';
			}
			$font_style.='">';
			$font_style.=$value['title'];
			$font_style.="</font>";
			$value['style_title']=$font_style;//样式标题
			}else{
			$value['style_title']=$value['title'];
			}
			//开启生成检查是否生成
			$is_has_html='';
			$href_url=CMS_SELF.$content_php."?id={$value['id']}";
			if($_confing['web_html']){
				$is_has_html = @file_exists(CMS_PATH.$value['url'])?'<span style="color:#006600">已生成</span>':'<span style="color:#FF0000">未生成</span>';
				$href_url=CMS_SELF.$value['url'];
			}
			//内容状态
			$fl_arr=empty($value['filter'])?'':explode(',',$value['filter']);
			$fl_str='';
	?>
		<tr><td style="width:5%;text-align:center"><input type="radio" id="all" <?php if(!$key){echo 'checked="checked"';}?> style="border:0" value="<?php echo $value['id'];?>" name="all[]" /><input type="hidden" id="text_url_<?php echo $value['id'];?>" name="text_url" value="<?php echo $href_url;?>"/></td><td style="width:35%"><?php echo "(<a href=\"{$href_url}\" target=\"_blank\">查看</a>{$value['id']}){$is_has_html}<input type=\"text\" style=\"width:180px\" title=\"{$value['title']}\" id=\"text_{$value['id']}\" value=\"{$value['title']}\"/>";?></td><td style="width:10%; text-align:center"><?php echo date('Y-m-d',$value['addtime']);?></td><td style="width:10%;text-align:center"><?php echo get_cate($value['category']);?></td><td style="width:10%;text-align:center"><?php echo get_verify($value['purview']);?></td><td style="width:5%;text-align:center"><?php echo $value['hits'];?></td><td style="width:10%;text-align:center"><?php if($value['verify']){echo "<span style=\"color:red\">未审核</span>";}else{echo "已审核";}?></td><td style="width:5%;text-align:center"><?php echo $value['author'];?></td></tr>
		<?php }
		}
		?>
		</tbody>
 </table>
 </div>
<?php
}
?> 
 <div class="page_fy page">
 	<ul>
		<?php echo page('admin_content_link',$page,$query,$total_num,$total_page);?>
	</ul>
 </div>
<div class="order_btn">
<input type="hidden" value="<?php echo $id;?>" name="id" /><input type="hidden" value="<?php echo $lang;?>" name="lang" />
  <input type="button" name="all" value="确定" id="sl_link" style="margin:0 10px 0 0;" class="go" />
 </div>
</form>
</div><!--内容切换-->

</body>
</html>
