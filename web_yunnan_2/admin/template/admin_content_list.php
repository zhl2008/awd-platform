<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>内容管理</title>
<link rel="stylesheet" type="text/css" href="template/admin.css"/>
<script type="text/javascript" src="template/images/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#sl_all').click(function(){
		$('table').find('#all').attr('checked','checked');
	});
	$('#show_list').find('tr').hover(function(){
		$(this).find('td').css('background','#F0F2F4');
	},function(){
		$(this).find('td').css('background','');
	});
});
function set_act(){
alert($('#form1').find('#all').val());
}
</script>
</head>

<body>
<div class="admin_head">
	<div class="admin_logo"><img src="template/images/admin_logo.gif" border="0"/></div>
	<div class="admin_head_rigt">
		<div class="admin_info">
		管理员<label><?php echo $rel_admin[0]['admin_name'];?></label>欢迎回来</span><span>上次登陆时间:<label style="font-weight:normal"><?php echo empty($rel_admin[0]['admin_time'])?'':date('Y-m-d H:m:s',$rel_admin[0]['admin_time']);?></label></span><span>上次登陆IP:<label style="font-weight:normal"><?php echo $rel_admin[0]['admin_ip']; unset($rel_admin);?></label></span><span>本次登陆IP:<label style="font-weight:normal"><?php echo get_ip();?></label><label style="font-weight:bold; padding-left:8px;"><a href="http://www.test.com/alone/alone.php?id=7" target="_blank" style="padding-right:5px; color:#fff">网站建设</a><a href="http://www.test.com/article/article.php?id=23" target="_blank" style="padding-right:5px; color:#fff">模板下载</a><a href="http://www.test.com/alone/alone.php?id=7" target="_blank" style="padding-right:5px; color:#fff">授权服务</a><a href="http://www.169host.com" target="_blank" style="padding-right:5px; color:#fff">域名空间</a></label>
		</div><!--登录的一些信息-->
		<div class="admin_head_nav">
			
			<ul class="out_nav">
				<li><a href="admin_cache.php?action=del_cache_file">清除缓存</a></li>
				<li><a href="../index.php" target="_blank">网站主页</a></li>
				<li><a href="http://www.test.com" target="_blank">官网首页</a></li>
				<li><a href="http://www.test.com/help" target="_blank">帮助手册</a></li>
				<li><a href="login.php?action=out">退出登录</a></li>
			</ul>
			<div class="clear"></div>
		</div><!--主导航-->
	</div>
	<div class="clear"></div>	
</div>

<div class="bees_admin_main">
	
	<div class="bees_admin_left_nav">
		<div class="admin_contain_left">
		
		<div class="admin_small_nav">
			
			<?php include('admin_nav.php')?>
			
			
		</div>
	</div><!--左边-->
	</div><!--nav-->
	
	<div class="bees_main_right">
		<div class="bees_main_content">
		
		<div class="admin_position">
		<span>内容列表</span>
			<div class="lang">
			<ul>
			 <?php
 $cache_file=DATA_PATH."cache/lang_cache.php";
 $cache_arr=read_cache($cache_file,'lang_cache');
 if(!empty($cache_arr)){
 foreach($cache_arr as $k=>$v){
  if(!$v['lang_is_use']){continue;}
 ?>
 <li><a href="?action=content_list&id=<?php echo $id;?>&lang=<?php echo $v['lang_tag'];?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>" class="<?php if($GLOBALS['lang']==$v['lang_tag']){echo 'hover';}?>"><?php echo $v['lang_name'];?></a></li>
 <?php
 }
 }
 ?>
			</ul>
		</div><!--语言-->	
		</div><!--位置-->
		
	<!--内容区-->	

<div class="order_contain">
<form name="form" id="form1" method="post" action="" class="form">
<div class="list_sl_btn">
	<ul>
	<li><select name="cate2" style="width:200px; margin-top:2px;">
	<option value="">请选择栏目</option>
	<?php
		if(!empty($cate_list)){
			$cate_arr=array();
			foreach($cate_list as $k=>$v){
				if($v['cate_channel']==$id){
				$cate_arr[]=$cate_list[$k];
				}
			}
		}
		if(!empty($cate_arr)){
			foreach($cate_arr as $key=>$value){
				$ck='';
				if($value['id']==$cate2){$ck='selected=selected';}
				echo "<option value=\"{$value['id']}\" {$ck}>{$value['cate_name']}</option>";
			}
		}
	?>
	</select></li>
	<li><select name="order_type" style="margin-top:2px;">
	<option value="">排序</option>
	<option value="addtime" <?php if($order=='addtime'){echo 'selected="selected"';}?>>时间排序</option>
	<option value="hits" <?php if($order=='hits'){echo 'selected="selected"';}?>>点击排序</option>
	</select></li>
	<li><select name="verify" style="margin-top:2px;">
	<option value="0" <?php if(!intval($verify)){echo 'selected="selected"';}?>>审核</option>
	<option value="1" <?php if(intval($verify)){echo 'selected="selected"';}?>>未审核</option>
	</select></li>
	<li>关键字：<input type="text" name="key_words" value="<?php echo $key_words;?>" /></li>
	<li><input type="button" name="sousuo" value="搜索" class="go" onclick="javascript:this.form.action='admin_content.php?action=content_list&lang=<?php echo $lang;?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>';this.form.submit();" /></li>
	</ul>
</div>

 <div class="order_main">
 <table cellpadding="0" cellspacing="0" width="100%">
 	<thead>
		<tr><th style="width:5%">选择</th><th style="width:30%">文章标题</th><th style="width:10%">添加时间</th><th style="width:10%">所属频道</th><th style="width:10%">所属栏目</th><th style="width:10%">浏览权限</th><th style="width:5%">点击</th><th style="width:5%">状态</th><th style="width:5%">发布人</th><th style="width:10%">操作</th></tr>
	</thead>
	<tbody id="show_list">
	<?php
	foreach($c_arr as $k=>$v){
		if($id==$v['id']){
			$table=DB_PRE.$v['channel_table'];
			$channel=$v['channel_name'];
			$content_php=empty($v['content_php'])?'show_content.php':$v['content_php'];
		}
	}
	if(empty($table)||empty($channel)){
		msg('参数发生错误，不存在相关频道');
	}
	$maintb=DB_PRE."maintb";
	$page=empty($page)?1:$page;
	$pagesize=30;
	$pagenum=($page-1)*$pagesize;
	$filt="m.channel={$id} and m.lang='{$lang}'";
	$query='&id='.$id.'&lang='.$lang.'&action=content_list&order='.$order.'&keywords='.$keywords.'&cate2='.$cate2.'&verify='.$verify.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav;
	$cate=empty($cate2)?$cate:$cate2;
	$child=get_child_id($cate);
	$a_category=empty($child)?$cate:$cate.$child;
	if(!empty($cate)){
		$filt.=" and m.category in ({$a_category})";
		$query.='&cate='.$cate;
		unset($cate);
	}
	$filt.=empty($verify)?'':' and m.verify='.$verify;
	$filt.=empty($key_words)?'':" and m.title like '%".$key_words."%'";
	$order=empty($order)?'order by m.id desc':'order by m.'.$order.' desc';
	$total_num=$GLOBALS['mysql']->fetch_rows("select m.id from {$maintb} as m where {$filt}");
	$total_page=ceil($total_num/$pagesize);
	$sql="select e.*,m.* from {$table} as e left join {$maintb} as m on e.id=m.id where {$filt}  {$order} limit {$pagenum},{$pagesize}";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	if(!empty($rel)){
	foreach($rel as $key=>$value){
	//标题样式
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
			$url = CMS_SELF.$content_php."?id=".$value['id'];
			//开启生成检查是否生成
			$is_has_html='';
			if($_confing['web_html']){
				$cate_info=get_cate_info($value['category'],$category);
				$html_url = empty($value['custom_url'])?date('YmdHms',$value['addtime']):$value['custom_url'];//内容静态页面	
				$url = $cate_info['cate_fold_name'].'/'.$html_url.'.html';
				$url_ck = iconv('UTF-8','GBK',$url);
				$is_has_html = @file_exists(CMS_PATH.$url_ck)?'<span style="color:#006600">已生成</span>':'<span style="color:#FF0000">未生成</span>';
				$url = CMS_SELF.$url;
			}
			//内容状态
			$fl_arr=empty($value['filter'])?'':explode(',',$value['filter']);
			$fl_str='';
			if($value['top']=='1'){$fl_str.='<span style="color:#3300CC">置顶</span>';}
			if(!empty($fl_arr)){
				foreach($fl_arr as $f_k=>$f_v){
					if($f_v=='a'){
						$fl_str.='<span style="color:#FF0000">[头条]</span>';
					}elseif($f_v=='b'){
						$fl_str.='<span style="color:#0099CC">[推荐]</span>';
					}elseif($f_v=='c'){
						$fl_str.='<span style="color:#00FF00">[图片]</span>';
					}
				}
			}
	?>
		<tr><td style="width:5%;text-align:center"><input type="checkbox" id="all" style="border:0" value="<?php echo $value['id'];?>" name="all[]" /></td><td style="width:30%"><?php echo "({$value['id']}){$is_has_html}{$fl_str}<a href=\"".$url."\" target=\"_blank\">{$value['style_title']}</a>";?></td><td style="width:10%; text-align:center"><?php echo date('Y-m-d',$value['addtime']);?></td><td style="width:10%;text-align:center"><?php echo $channel;?></td><td style="width:10%;text-align:center"><a href="?action=content_list&id=<?php echo $value['channel'];?>&cate=<?php echo $value['category'];?>&lang=<?php echo $lang;?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>"><?php echo get_cate($value['category']);?></a></td><td style="width:10%;text-align:center"><?php echo get_verify($value['purview']);?></td><td style="width:5%;text-align:center"><?php echo $value['hits'];?></td><td style="width:5%;text-align:center"><?php if($value['verify']){echo "<span style=\"color:red\">未审核</span>";}else{echo "已审核";}?></td><td style="width:5%;text-align:center"><?php echo $value['author'];?></td><td style="width:10%;text-align:center"><a href="javascript:if(confirm('确定要删除么,删除后将不可恢复!')){location.href='?action=del&lang=<?php echo $lang;?>&id=<?php echo $value['id'];?>&channel_id=<?php echo $value['channel'];?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>';}" style="padding:0 3px;">删除</a>|<a href="?action=edit_content&lang=<?php echo $lang;?>&id=<?php echo $value['id'];?>&channel_id=<?php echo $value['channel'];?>&cate=<?php echo $value['category'];?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>" style="padding:0 3px;">修改</a></td></tr>
		<?php }
		}
		?>
		</tbody>
 </table>
 </div>
 <div class="page_fy page">
		<?php echo page('admin_content',$page,$query,$total_num,$total_page,'','1');?>
 </div>
<div class="order_btn">
<input type="hidden" value="<?php echo $id;?>" name="id" /><input type="hidden" value="<?php echo $lang;?>" name="lang" />
  <input type="button" name="all" value="全选" id="sl_all" style="margin:0 10px 0 0;" class="go" /><input type="reset" style="margin:0 10px 0 0;" class="go" value="重置" name="reset"/><input type="button" onclick="javascript:if(confirm('确定要删除么,删除后将不可恢复!')){this.form.action='admin_content.php?action=del_all&step=2&lang=<?php echo $lang;?>&channel_id=<?php echo $value[channel];?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>';this.form.submit();}" value="删除" name="button" style="margin:0 10px 0 0;" class="go"/><input type="button" onclick="javascript:this.form.action='?action=verify&step=2&lang=<?php echo $lang;?>&channel_id=<?php echo $value[channel];?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>';this.form.submit();" value="审核" name="verify" style="margin:0 10px 0 0;" class="go" /><input type="button" value="添加内容" name="add" onclick="javascript:location.href='?action=add&lang=<?php echo $GLOBALS['lang'];?>&id=<?php echo $id;?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>';" style="margin:0 10px 0 0;" class="go"/><input type="button" value="批量转移" name="move" onclick="javascript:this.form.action='?action=arc_move&channel=<?php echo $id;?>&lang=<?php echo $lang;?>&nav=<?php echo $admin_nav;?>&admin_p_nav=<?php echo $admin_p_nav;?>';this.form.submit();" style="margin:0 10px 0 0;" class="go"/>
 </div>
</form>
</div><!--内容切换-->
<!--内容区-->

		</div>	
	</div><!--main-->
	<div class="clear"></div>
</div>
<div class="bees_admin_foot">
	<p>版权所有 © 2009-2013 test.com，并保留所有权利。</p>
</div>	


</body>
</html>
