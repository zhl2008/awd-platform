<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="description" content="<?php echo webinfo('web_description');?>">
<meta name="keywords" content="<?php echo webinfo('web_keywords');?>">
<title><?php if(webinfo('web_index_name')){?><?php echo webinfo('web_index_name');?><?php }else{?><?php echo webinfo('web_name');?><?php }?></title>
<link href="<?php cmspath('template');?>/images/style.css" rel="stylesheet" type="text/css">
<link href="<?php cmspath('template');?>/images/skin.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php cmspath('template');?>/images/jquery.js"></script>
<script type="text/javascript" src="<?php cmspath('template');?>/images/nav.js"></script>
<script type="text/javascript" src="<?php cmspath('template');?>/images/Xslider.js"></script>
<script type="text/javascript" src="<?php cmspath('template');?>/images/slides.min.jquery.js"></script>
<script type="text/javascript">

$(function(){
	
	$(".productshow").Xslider({
		unitdisplayed:3,
		numtoMove:1,
		autoscroll:3000,  
		loop:"cycle"
	});
	
	$(function(){
			$('#slides').slides({
				preload: true,
				preloadImage: 'img/loading.gif',
				play: 5000,
				pause: 2500,
				hoverPause: true
			});
		});
	
	$("a").focus(function(){this.blur();});
})

</script>
</head>
<body>
<?php $this->display('head',1,1);?>

<div class="contain">
	<div class="ct_left">
	
		<div class="div_list">
			<div class="div_list_body">
				<h2 class="title"><span>成功案例</span></h2>
				<div class="al_list_ct">
					
					
					<div id="slides">
				<div class="slides_container">
				<?php $index_al=get_tpl_cate_content($tpl_id='3',$limit='0,5',$order_type='',$filter='',$pic='no',$order='',$lang='');?>
				<?php 
 $fun_return=$index_al['contents'];if(isset($fun_return)&&is_array($fun_return)){
foreach($fun_return as $v){?>
					<a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank"><img border="0" src="<?php echo $v['thumb_pic'];?>" width="200" height="170" alt="<?php echo $v['title'];?>"></a>
				<?php 
}
}?>	
					
				</div>
				
			</div>
					
					
					
				</div>
			</div>
		</div><!--区域-->
		
		<div class="div_list">
			<div class="div_list_body">
				<h2 class="title"><span>联系方式</span></h2>
				<div class="div_list_ct">
					<div class="contact">
						<?php echo get_block_content('contact_us');?>
					</div>
				</div>
			</div>
		</div><!--区域-->
		
	</div><!--左边-->
	<div class="ct_right">
		<div class="index_right_top">
			<div class="index_about">
				<div class="div_list">
			<div class="div_list_body">
				<h2 class="title"><span>公司简介</span></h2>
				<div class="index_about_ct">
					<div class="index_about_ct2">
						<?php echo get_block_content('about_us');?>	
					</div>
				</div>
			</div>
		</div><!--区域-->
				
			</div><!--about-->
			<div class="index_news">
				<div class="div_list">
			<div class="div_list_body">
				<h2 class="title"><span>新闻动态</span></h2>
				<div class="index_news_list_ct">
				<?php $index_news=get_tpl_cate_content($tpl_id='2',$limit='0,7',$order_type='',$filter='',$pic='no',$order='',$lang='');?>
					<ul>
					<?php 
 $fun_return=$index_news['contents'];if(isset($fun_return)&&is_array($fun_return)){
foreach($fun_return as $v){?>
						<li><a href="<?php echo $v['url'];?>"><?php echo $v['title'];?></a></li>
					<?php 
}
}?>	
					</ul>
				</div>
			</div>
		</div>
			</div><!--news-->
			<div class="clear"></div>
		</div>
		
		<div class="index_pr">
			<div class="div_list">
			<div class="div_list_body">
				<h2 class="title"><span>产品中心</span></h2>
				<div class="pr_list_ct">
					<?php $pr=get_tpl_cate_content($tpl_id='4',$limit='0,15',$order_type='id',$filter='',$pic='no',$order='desc',$lang='');?>
					<div class="productshow">
	<div class="scrollcontainer">
		<ul>
		<?php 
 $fun_return=$pr['contents'];if(isset($fun_return)&&is_array($fun_return)){
foreach($fun_return as $v){?>
			<li><a href="<?php echo $v['url'];?>"><img src="<?php echo $v['thumb_pic'];?>" border="0" style="border:1px solid #ddd" width="170" height="170" /></a><p><a href="<?php echo $v['url'];?>"><?php echo $v['style_title'];?></a></p></li>
			<?php 
}
}?>
		</ul>
	</div>
	<a class="abtn aleft" href="#left">左移</a>
	<a class="abtn aright" href="#right">右移</a>
</div>
					
				</div>
			</div>
		</div><!--区域-->
		</div><!--pr-->
		
	</div><!--右边-->
	<div class="clear"></div>
	
	<div class="link">
		<div class="div_list">
			<div class="div_list_body">
				<h2 class="title"><span>友情链接</span></h2>
				<div class="link_contain">
					<?php 
 $fun_return=get_link();if(isset($fun_return)&&is_array($fun_return)){
foreach($fun_return as $v){?>
					<a href="<?php echo $v['link_url'];?>"><?php echo $v['link_name'];?></a>
<?php 
}
}?>
				</div>
			</div>
		</div>		
	</div>
	
</div>

<?php $this->display('foot',1,1);?>
</body>
</html>