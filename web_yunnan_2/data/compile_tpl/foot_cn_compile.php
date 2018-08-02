</div>
<div class="foot">
	<div class="foot_nav">
		<?php 
 $fun_return=nav_bottom();if(isset($fun_return)&&is_array($fun_return)){
foreach($fun_return as $v){?>
  <a href="<?php echo $v['url'];?>" title="<?php echo $v['cate_name'];?>"><?php echo $v['cate_name'];?></a><?php if(!$v['last']){?>|<?php }?>
  <?php 
}
}?>
	</div>
	<div class="foot_pw">
		<?php echo webinfo('web_powerby');?>
	</div>
</div>
<?php echo webinfo('web_yinxiao');?>
<?php $this->display('kefu1',1,1);?>