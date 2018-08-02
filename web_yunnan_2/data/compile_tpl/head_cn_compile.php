<div class="head">
	<div class="head_left"><a href="<?php cmspath('index');?>"><img src="<?php cmspath('cms');?>upload/<?php echo webinfo('web_logo');?>" border="0"/></a></div>
	<div class="head_right">
		<div class="head_lang">
			<?php 
 $fun_return=lang();if(isset($fun_return)&&is_array($fun_return)){
foreach($fun_return as $v){?>
		<a href="<?php echo $v['url'];?>" <?php echo $v['class'];?> <?php echo $v['target'];?>><?php echo $v['lang_name'];?></a>
		<?php 
}
}?>
		</div>
		<div class="head_search">
			<form name="form1" action="<?php cmspath('search');?>">
				<div class="s_margin"><input name="key" class="key" id="key" style="color:#CCCCCC" value="请输入产品关键字"  type="text"/><input type="image" src="<?php cmspath('template');?>/images/search_btn.gif" class="find" /><input type="hidden" value="<?php echo get_web_param('lang');?>" name="lang" />
		<div class="clear"></div>
		</div>
			</form>
		</div><!--search-->
	</div>
</div>
<div class="nav">
	<ul>
		<li class="<?php echo get_web_param('index_focus');?>"><a href="<?php cmspath('index');?>">首页</a></li>
		<?php 
 $fun_return=nav_middle();if(isset($fun_return)&&is_array($fun_return)){
foreach($fun_return as $nav_child){?> 
		<li class="<?php echo $nav_child['class'];?>"><a href="<?php echo $nav_child['url'];?>" <?php echo $nav_child['target'];?>><?php echo $nav_child['cate_name'];?></a></li>
		<?php 
}
}?>
	</ul>
</div>

<div class="ct_bg">
<div class="flash">
	<?php echo flash_ad('');?>
</div>
