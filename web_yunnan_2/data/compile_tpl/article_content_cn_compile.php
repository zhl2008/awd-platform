<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="description" content="<?php echo content('info');?>">
<meta name="keywords" content="<?php echo content('keywords');?>">
<title><?php echo content('small_title');?>_<?php echo cateinfo('cate_title_seo');?>_<?php echo webinfo('web_name');?></title>
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
				<h2 class="title"><span>当前位置:&nbsp;<?php position(); ?></span></h2>
				<div class="content_ct">
					<div class="content_ct2">
						<div class="arc_title" style="<?php echo content('style');?>"><?php echo content('title');?></div>
						<div class="add_info"><p class="info"><span>点击次数:<script language="javascript" src="<?php cmspath('includes');?>/hits.php?id=<?php echo content('id');?>"></script></span><span>更新时间:<?php echo date('Y-m-d H:m:s',content('updatetime'));?></span><span><a href="javascript:window.print()">【打印】</a></span><span><a href="javascript:self.close()">【关闭】</a></span></p></div>
						
						 <div class="arc_body">
 <table width='100%'>
	<tr><td><?php echo content('content');?></td></tr>
  </table>
  </div>
  <div class="page_fy" style="float:none;margin-left:300px;">
    <?php echo body_pages();?>
  </div>
  <?php $bq=get_content_key();?>
  <?php if($bq){?>
  <div class="bq">
  相关标签：<?php 
 $fun_return=$bq;if(isset($fun_return)&&is_array($fun_return)){
foreach($fun_return as $v){?>
  <a href="<?php echo $v['url'];?>" target="_blank"><?php echo $v['name'];?></a>
  <?php 
}
}?>
  </div>
  <?php }?>
 <div class="arc_link" style="clear:both">
 <?php $prev=content('prev');?>
 <?php if($prev){?><span>上一篇：<a href="<?php echo $prev['url'];?>"><?php echo $prev['title'];?></a></span><?php }else{?><span>上一篇：没有了</span><?php }?>
  <?php $next=content('next');?>
 <?php if($next){?><span>下一篇：<a href="<?php echo $next['url'];?>"><?php echo $next['title'];?></a></span><?php }else{?><span>下一篇：没有了</span><?php }?>
 </div>
 
 
 <div class="fx">
 
 <div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more">分享到：</a><a title="分享到QQ空间" href="#" class="bds_qzone" data-cmd="qzone">QQ空间</a><a title="分享到新浪微博" href="#" class="bds_tsina" data-cmd="tsina">新浪微博</a><a title="分享到腾讯微博" href="#" class="bds_tqq" data-cmd="tqq">腾讯微博</a><a title="分享到人人网" href="#" class="bds_renren" data-cmd="renren">人人网</a><a title="分享到微信" href="#" class="bds_weixin" data-cmd="weixin">微信</a></div>
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"1","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{"bdSize":16}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
 </div>		

					
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