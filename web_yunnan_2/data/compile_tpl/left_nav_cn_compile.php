<h2 class="title"><span>产品分类</span></h2>
				<div class="al_list_ct" style="height:auto">
					<?php $tree=get_tpl_list_nav(3,1);?>
					<div id="category_tree">
			<?php 
 $fun_return=$tree;if(isset($fun_return)&&is_array($fun_return)){
foreach($fun_return as $nav){?>
    <dl>
     <dt><a class="<?php echo $nav['class'];?>" href="<?php echo $nav['url'];?>" <?php echo $nav['target'];?> title="<?php echo $nav['cate_name'];?>"><?php echo $nav['cate_name'];?>(<?php echo $nav['content_num'];?>)</a></dt>
	 <?php if($nav['child']){?>
     <dd id="nav_16">
	 <ul>
	 <?php 
 $fun_return=$nav['child'];if(isset($fun_return)&&is_array($fun_return)){
foreach($fun_return as $v){?>
	  	 <li><a class="<?php echo $v['class'];?>" href="<?php echo $v['url'];?>"><?php echo $v['cate_name'];?>(<?php echo $v['content_num'];?>)</a></li>
     <?php 
}
}?>
     </ul>
	 </dd>
	 <?php }else{?>
	 <?php if($nav['content_num']){?>
	 <dd id="nav_16">
	 <ul>
	 <?php 
 $fun_return=$nav['content'];if(isset($fun_return)&&is_array($fun_return)){
foreach($fun_return as $v){?>
	  	 <li><a class="<?php echo $v['class'];?>" href="<?php echo $v['url'];?>"><?php echo $v['title'];?></a></li>
     <?php 
}
}?>
     </ul>
	 </dd>
	 <?php }?>
	 <?php }?>
   </dl>
   <?php 
}
}?>
   
   </div><!--分页导航-->
					
					
				</div>