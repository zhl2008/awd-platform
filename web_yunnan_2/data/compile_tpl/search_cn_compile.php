<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="description" content="search">
<meta name="keywords" content="search">
<title>search_<?php echo webinfo('web_name');?></title>
<link href="<?php cmspath('template');?>/images/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php cmspath('template');?>/images/jquery.js"></script>
<script type="text/javascript" src="<?php cmspath('template');?>/images/nav.js"></script>
</head>
<body>
<?php $this->display('head',1,1);?>

<div class="contain">
	<div class="ct_left">
	
		<div class="div_list">
			<div class="div_list_body">
				<?php $this->display('left_nav',1,1);?>
			</div>
		</div><!--区域-->
		
		<div class="div_list">
			<div class="div_list_body">
				<h2 class="title"><span>联系方式</span></h2>
				<div class="div_list_ct">
					<div class="contact" style="height:auto">
						<?php echo get_block_content('contact_us');?>
					</div>
				</div>
			</div>
		</div><!--区域-->
		
	</div><!--左边-->
	<div class="ct_right">
		
		<div class="div_list">
			<div class="div_list_body">
				<h2 class="title"><span>当前位置:&nbsp;搜索</span></h2>
				<div class="content_ct">
					<div class="content_ct2">
					
					<div class="search_title">
	搜索<span style="color:red; font-weight:bold"><?php echo get_web_param('key');?></span>的结果如下<a href="<?php cmspath('index');?>">返回首页</a>
	</div>
<?php if(!get_search()){?>
	<div class="search_content">
		<h2>没有相关内容</h2>
	</div>
<?php }else{?>	
	<?php 
 $fun_return=get_search();if(isset($fun_return)&&is_array($fun_return)){
foreach($fun_return as $v){?>
	<div class="search_content">
	<?php if($v['is_pic']){?>
		<div style="padding:8px 10px 8px 0"><a href="<?php echo $v['url'];?>" target="_blank"><img src="<?php echo $v['thumb_pic'];?>" border="0" width="150" height="150"/></a></div>
		<?php }?>
		<h2><a href="<?php echo $v['url'];?>" target="_blank"><?php echo $v['title'];?></a></h2>
		<p><?php echo $v['info'];?></p>
	<div class="clear"></div>
	</div><!--搜索内容-->
	<?php 
}
}?>
<?php }?>	
	<div class="page_fy">
		<?php echo get_search_page();?>
	</div><!--分页-->
					
					</div>
				</div>
			</div>
		</div>
		
		
		<div class="div_list">
			<div class="div_list_body">
				<h2 class="title"><span>推荐产品</span></h2>
				<div class="div_list_ct">
					<?php $tj_pr=get_tpl_cate_content($tpl_id='3',$limit='0,4',$order_type='',$filter='',$pic='no',$order='',$lang='');?>
					<ul class="tj_pr_list" id="colee1">
					<?php 
 $fun_return=$tj_pr['contents'];if(isset($fun_return)&&is_array($fun_return)){
foreach($fun_return as $v){?>
						<li>
							<p><a href="<?php echo $v['url'];?>"><img src="<?php echo $v['thumb_pic'];?>" border="0" alt="<?php echo $v['title'];?>" /></a></p>
							<p class="tj_title"><a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>"><?php echo $v['title'];?></a></p>
						</li>
					<?php 
}
}?>	
					</ul>
					<div class="clear"></div>
				</div>
			</div>
		</div><!--区域-->
		
		
	</div><!--右边-->
	<div class="clear"></div>
</div>



<?php $this->display('foot',1,1);?>
</body>
</html>