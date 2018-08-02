
<script type="text/javascript">
$(document).ready(function(){
	$('#show_list').find('tr').hover(function(){
		$(this).find('td').css('background','#ccffcc');
	},function(){
		$(this).find('td').css('background','');
	});
	

	$('.admin_small_nav').find('li').find('span').toggle(function(){
	$(this).next('div').show();
		$(this).removeClass('on');
		
	},function(){
		$(this).next('div').hide();
		$(this).addClass('on');
	});
});	
</script>


<ul>
				<li class="top">
				<span <?php if($admin_p_nav=='main_info'){echo 'class=""';}else{echo 'class="on"';}?>><em>首页</em></span>
				<div id="child" <?php if($admin_p_nav=='main_info'){echo 'style="display:block"';}else{echo 'style="display:none"';}?>>
					<div class="bees_child">
						<p><a <?php if($admin_nav=='main'){echo 'class="focus"';}?> href="admin_main.php?nav=main&admin_p_nav=main_info">程序首页</a></p>
					</div>
				</div>
				</li>
				<li class="top">
				<span <?php if($admin_p_nav=='allsys'){echo 'class=""';}else{echo 'class="on"';}?>><em>网站设置</em></span>
				<div id="child" <?php if($admin_p_nav=='allsys'){echo 'style="display:block"';}else{echo 'style="display:none"';}?>>
					<div class="bees_child">
						<p><a <?php if($admin_nav=='websys'){echo 'class="focus"';}?> href="admin_info.php?nav=websys&admin_p_nav=allsys&lang=<?php echo $lang;?>">基本设置</a></p>
						<p><a <?php if($admin_nav=='syssys'){echo 'class="focus"';}?> href="admin_sys.php?nav=syssys&admin_p_nav=allsys&lang=<?php echo $lang;?>">系统设置</a></p>
						<p><a <?php if($admin_nav=='indexsys'){echo 'class="focus"';}?> href="admin_index.php?nav=indexsys&admin_p_nav=allsys&lang=<?php echo $lang;?>">首页设置</a></p>
					</div>
				</div>
				</li>
				<li class="top">
				<span <?php if($admin_p_nav=='marketsys'){echo 'class=""';}else{echo 'class="on"';}?>><em>客服幻灯</em></span>
				<div id="child" <?php if($admin_p_nav=='marketsys'){echo 'style="display:block"';}else{echo 'style="display:none"';}?>>
					<div class="bees_child">
						<p><a <?php if($admin_nav=='addmarket'){echo 'class="focus"';}?> href="admin_market.php?action=add&nav=addmarket&admin_p_nav=marketsys&lang=<?php echo $lang;?>">添加客服</a></p>
						<p><a <?php if($admin_nav=='listmarket'){echo 'class="focus"';}?> href="admin_market.php?nav=listmarket&admin_p_nav=marketsys&lang=<?php echo $lang;?>">管理客服</a></p>
						<p><a <?php if($admin_nav=='addmainflash'){echo 'class="focus"';}?> href="admin_flash_ad.php?action=add&nav=addmainflash&admin_p_nav=marketsys&lang=<?php echo $lang;?>">添加主广告图片</a></p>
						<p><a <?php if($admin_nav=='listflash'){echo 'class="focus"';}?> href="admin_flash_ad.php?nav=listflash&admin_p_nav=marketsys&lang=<?php echo $lang;?>">管理主广告</a></p>
						<p><a <?php if($admin_nav=='add_flash_cate'){echo 'class="focus"';}?> href="admin_flash_ad.php?action=add_cate&nav=add_flash_cate&admin_p_nav=marketsys&lang=<?php echo $lang;?>">添加主广告分类</a></p>
						<p><a <?php if($admin_nav=='list_flash_cate'){echo 'class="focus"';}?> href="admin_flash_ad.php?action=list_cate&nav=list_flash_cate&admin_p_nav=marketsys&lang=<?php echo $lang;?>">管理主广告分类</a></p>
						<p><a <?php if($admin_nav=='flash_ad_info'){echo 'class="focus"';}?> href="admin_flash_ad_info.php?nav=flash_ad_info&admin_p_nav=marketsys&lang=<?php echo $lang;?>">主广告配置</a></p>
					</div>
				</div>
				</li>
				
				<li class="top">
				<span <?php if($admin_p_nav=='cate'){echo 'class=""';}else{echo 'class="on"';}?>><em>网站栏目</em></span>
				<div id="child" <?php if($admin_p_nav=='cate'){echo 'style="display:block"';}else{echo 'style="display:none"';}?>>
					<div class="bees_child">
						<p><a <?php if($admin_nav=='addcate'){echo 'class="focus"';}?> href="admin_catagory.php?action=category_add&nav=addcate&admin_p_nav=cate&lang=<?php echo $lang;?>">添加栏目</a></p>
						<p><a <?php if($admin_nav=='add_alone_cate'){echo 'class="focus"';}?> href="admin_catagory.php?action=add_alone_cate&nav=add_alone_cate&admin_p_nav=cate&lang=<?php echo $lang;?>">添加单页栏目</a></p>
						<p><a <?php if($admin_nav=='listcate'){echo 'class="focus"';}?> href="admin_catagory.php?action=catagory&nav=listcate&admin_p_nav=cate&lang=<?php echo $lang;?>">管理栏目</a></p>
						
					</div>
				</div>
				</li>
				<li class="top">
				<span <?php if($admin_p_nav=='content'){echo 'class=""';}else{echo 'class="on"';}?>><em>内容管理</em></span>
				<div id="child" <?php if($admin_p_nav=='content'){echo 'style="display:block"';}else{echo 'style="display:none"';}?>>
					<div class="bees_child">
						
						<?php
			if(!empty($admin_nav_c_arr)){
				foreach($admin_nav_c_arr as $v){
			?>
						<p><a <?php if($admin_nav=='add_channel_'.$v['channel_mark']){echo 'class="focus"';}?> href="admin_content.php?action=add&id=<?php echo $v['id'];?>&nav=add_channel_<?php echo $v['channel_mark'];?>&admin_p_nav=content&lang=<?php echo $lang;?>" style="color:green;">添加<?php echo $v['channel_name'];?></a></p>
						<p><a <?php if($admin_nav=='list_channel_'.$v['channel_mark']){echo 'class="focus"';}?> href="admin_content.php?action=content_list&id=<?php echo $v['id'];?>&nav=list_channel_<?php echo $v['channel_mark'];?>&admin_p_nav=content&lang=<?php echo $lang;?>" style="color:#9f8d11;">管理<?php echo $v['channel_name'];?></a></p>
					<?php
				}
			}
			?>	
						<p><a <?php if($admin_nav=='alone'){echo 'class="focus"';}?> href="admin_content_alone.php?action=content_list&nav=alone&admin_p_nav=content&lang=<?php echo $lang;?>">单页内容管理</a></p>
						<p><a <?php if($admin_nav=='add_block'){echo 'class="focus"';}?> href="admin_content_tag.php?nav=add_block&admin_p_nav=content&lang=<?php echo $lang;?>">添加片段内容</a></p>
						<p><a <?php if($admin_nav=='list_block'){echo 'class="focus"';}?> href="admin_content_tag.php?action=content_list&nav=list_block&admin_p_nav=content&lang=<?php echo $lang;?>">管理片段内容</a></p>
						
						<p><a <?php if($admin_nav=='pic_list'){echo 'class="focus"';}?> href="admin_pic.php?nav=pic_list&admin_p_nav=content&lang=<?php echo $lang;?>">上传图片管理</a></p>
						<p><a <?php if($admin_nav=='file_list'){echo 'class="focus"';}?> href="admin_file.php?nav=file_list&admin_p_nav=content&lang=<?php echo $lang;?>">上传附件管理</a></p>
					</div>
				</div>
				</li>
				<li class="top">
				<span <?php if($admin_p_nav=='tpl'){echo 'class=""';}else{echo 'class="on"';}?>><em>模板管理</em></span>
				<div id="child" <?php if($admin_p_nav=='tpl'){echo 'style="display:block"';}else{echo 'style="display:none"';}?>>
					<div class="bees_child">
						<p><a <?php if($admin_nav=='tpl_style'){echo 'class="focus"';}?> href="admin_template.php?action=mb_list&nav=tpl_style&admin_p_nav=tpl&lang=<?php echo $lang;?>">模板风格</a></p>
						
						
					</div>
				</div>
				</li>
				<li class="top">
				<span <?php if($admin_p_nav=='feeds'){echo 'class=""';}else{echo 'class="on"';}?>><em>留言表单</em></span>
				<div id="child" <?php if($admin_p_nav=='feeds'){echo 'style="display:block"';}else{echo 'style="display:none"';}?>>
					<div class="bees_child">
						<p><a <?php if($admin_nav=='list_order'){echo 'class="focus"';}?> href="admin_form.php?action=form_list&nav=list_order&admin_p_nav=feeds&lang=<?php echo $lang;?>">表单管理</a></p>
						
						<p><a <?php if($admin_nav=='list_book'){echo 'class="focus"';}?> href="admin_book.php?nav=list_book&admin_p_nav=feeds&lang=<?php echo $lang;?>">管理留言</a></p>
						<p><a <?php if($admin_nav=='set_book'){echo 'class="focus"';}?> href="admin_book.php?action=made&nav=set_book&admin_p_nav=feeds&lang=<?php echo $lang;?>">留言本设置</a></p>
					</div>
				</div>
				</li>
				<li class="top">
				<span <?php if($admin_p_nav=='user'){echo 'class=""';}else{echo 'class="on"';}?>><em>会员管理员</em></span>
				<div id="child" <?php if($admin_p_nav=='user'){echo 'style="display:block"';}else{echo 'style="display:none"';}?>>
					<div class="bees_child">
						<p><a <?php if($admin_nav=='add_admin_user'){echo 'class="focus"';}?> href="admin_admin.php?action=add&nav=add_admin_user&admin_p_nav=user&lang=<?php echo $lang;?>">添加管理员</a></p>
						<p><a <?php if($admin_nav=='list_admin_user'){echo 'class="focus"';}?> href="admin_admin.php?nav=list_admin_user&admin_p_nav=user&lang=<?php echo $lang;?>">管理员管理</a></p>
						<p><a <?php if($admin_nav=='add_admin_group'){echo 'class="focus"';}?> href="admin_admin.php?action=add_admin_group&nav=add_admin_group&admin_p_nav=user&lang=<?php echo $lang;?>">添加管理员分组</a></p>
						<p><a <?php if($admin_nav=='list_admin_group'){echo 'class="focus"';}?> href="admin_admin.php?action=admin_group&nav=list_admin_group&admin_p_nav=user&lang=<?php echo $lang;?>">管理员分组管理</a></p>
						<p><a <?php if($admin_nav=='add_web_user'){echo 'class="focus"';}?> href="admin_member.php?action=add&nav=add_web_user&admin_p_nav=user&lang=<?php echo $lang;?>">添加会员</a></p>
						<p><a <?php if($admin_nav=='list_web_user'){echo 'class="focus"';}?> href="admin_member.php?nav=list_web_user&admin_p_nav=user&lang=<?php echo $lang;?>">会员管理</a></p>
						<p><a <?php if($admin_nav=='add_web_group'){echo 'class="focus"';}?> href="admin_member.php?action=member_group_add&nav=add_web_group&admin_p_nav=user&lang=<?php echo $lang;?>">添加会员分组</a></p>
						<p><a <?php if($admin_nav=='list_web_group'){echo 'class="focus"';}?> href="admin_member.php?action=member_group&nav=list_web_group&admin_p_nav=user&lang=<?php echo $lang;?>">会员分组管理</a></p>
						
						
					</div>
				</div>
				</li>
				
				<li class="top">
				<span <?php if($admin_p_nav=='tools'){echo 'class=""';}else{echo 'class="on"';}?>><em>工具</em></span>
				<div id="child" <?php if($admin_p_nav=='tools'){echo 'style="display:block"';}else{echo 'style="display:none"';}?>>
					<div class="bees_child">
						<p><a <?php if($admin_nav=='add_link'){echo 'class="focus"';}?> href="admin_link.php?action=add&nav=add_link&admin_p_nav=tools&lang=<?php echo $lang;?>">添加链接</a></p>
						<p><a <?php if($admin_nav=='list_link'){echo 'class="focus"';}?> href="admin_link.php?action=link_list&nav=list_link&admin_p_nav=tools&lang=<?php echo $lang;?>">管理链接</a></p>
						<p><a <?php if($admin_nav=='backup_db'){echo 'class="focus"';}?> href="admin_db.php?nav=backup_db&admin_p_nav=tools&lang=<?php echo $lang;?>">备份数据</a></p>
						<p><a <?php if($admin_nav=='re_db'){echo 'class="focus"';}?> href="admin_db.php?action=import&nav=re_db&admin_p_nav=tools&lang=<?php echo $lang;?>">恢复数据</a></p>
						<p><a <?php if($admin_nav=='all_cache'){echo 'class="focus"';}?> href="admin_all_cache.php?nav=all_cache&admin_p_nav=tools&lang=<?php echo $lang;?>">更新缓存</a></p>
						
					</div>
				</div>
				</li>
				
				<li class="top">
				<span <?php if($admin_p_nav=='langsys'){echo 'class=""';}else{echo 'class="on"';}?>><em>开发选项</em></span>
				<div id="child" <?php if($admin_p_nav=='langsys'){echo 'style="display:block"';}else{echo 'style="display:none"';}?>>
					<div class="bees_child">
						<p><a <?php if($admin_nav=='addlang'){echo 'class="focus"';}?> href="admin_lang.php?action=add&nav=addlang&admin_p_nav=langsys&lang=<?php echo $lang;?>">添加网站语言</a></p>
						<p><a <?php if($admin_nav=='listlang'){echo 'class="focus"';}?> href="admin_lang.php?action=lang&nav=listlang&admin_p_nav=langsys&lang=<?php echo $lang;?>">管理网站语言</a></p>
						<p><a <?php if($admin_nav=='add_lang_lang'){echo 'class="focus"';}?> href="admin_lang.php?action=add_lang&nav=add_lang_lang&admin_p_nav=langsys&lang=<?php echo $lang;?>">添加语言变量</a></p>
						<p><a <?php if($admin_nav=='list_lang_lang'){echo 'class="focus"';}?> href="admin_lang.php?action=edit&nav=list_lang_lang&admin_p_nav=langsys&lang=<?php echo $lang;?>">管理语言包</a></p>
						<p><a <?php if($admin_nav=='addmodel'){echo 'class="focus"';}?> href="admin_channel.php?action=add&nav=addmodel&admin_p_nav=langsys&lang=<?php echo $lang;?>">添加内容模型</a></p>
						<p><a <?php if($admin_nav=='listmodel'){echo 'class="focus"';}?> href="admin_channel.php?nav=listmodel&admin_p_nav=langsys&lang=<?php echo $lang;?>">管理内容模型</a></p>
						<p><a <?php if($admin_nav=='order_model'){echo 'class="focus"';}?> href="admin_form.php?action=add&nav=order_model&admin_p_nav=langsys&lang=<?php echo $lang;?>">添加表单模型</a></p>
						<p><a <?php if($admin_nav=='list_order_model'){echo 'class="focus"';}?> href="admin_form.php?nav=list_order_model&admin_p_nav=langsys&lang=<?php echo $lang;?>">管理表单模型</a></p>
						<p><a <?php if($admin_nav=='add_pic_cate'){echo 'class="focus"';}?> href="admin_pic.php?action=add_cate&nav=add_pic_cate&admin_p_nav=langsys&lang=<?php echo $lang;?>">添加图片分类</a></p>
						<p><a <?php if($admin_nav=='pic_cate_list'){echo 'class="focus"';}?> href="admin_pic.php?action=cate_list&nav=pic_cate_list&admin_p_nav=langsys&lang=<?php echo $lang;?>">管理图片分类</a></p>
						<p><a <?php if($admin_nav=='list_tpl'){echo 'class="focus"';}?> href="admin_template.php?nav=list_tpl&admin_p_nav=langsys&lang=<?php echo $lang;?>">模板页管理</a></p>
						<p><a <?php if($admin_nav=='tpl_tag'){echo 'class="focus"';}?> href="http://www.test.com/help" target="_blank">模板标签</a></p>
					</div>
				</div>
				</li>
			</ul>