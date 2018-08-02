<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/
$admin_left_nav=array(
	'index'=>array(
		'main_info'=>array('left_nav'=>'main_info','name'=>'后台首页','child'=>array(
			'index_main'    => array('left_nav'=>'index_main','name'=>'首页','url'=>'admin_main.php?'),
		)),
		),
	'sys'=>array(
		'allsys'=>array('left_nav'=>'allsys','name'=>'网站设置','child'=>array(
			'websys'    => array('left_nav'=>'websys','name'=>'站点设置','url'=>'admin_info.php?'),
			'syssys'    => array('left_nav'=>'syssys','name'=>'系统设置','url'=>'admin_sys.php?'),
			'indexsys'  => array('left_nav'=>'indexsys','name'=>'首页设置','url'=>'admin_index.php?'),
		)),
		'marketsys'=>array('left_nav'=>'marketsys','name'=>'客服设置','child'=>array(
			'addmarket'=>array('left_nav'=>'addmarket','name'=>'添加客服','url'=>'admin_market.php?action=add'),
			'listmarket'=>array('left_nav'=>'listmarket','name'=>'管理客服','url'=>'admin_market.php?')
		)),
		'mainflashsys'=>array('left_nav'=>'mainflashsys','name'=>'主广告幻灯','child'=>array(
			'addmainflash'=>array('left_nav'=>'addmainflash','name'=>'添加主广告图片','url'=>'admin_flash_ad.php?action=add'),
			'listflash'=>array('left_nav'=>'listflash','name'=>'管理主广告','url'=>'admin_flash_ad.php?'),
			'add_flash_cate'=>array('left_nav'=>'add_flash_cate','name'=>'添加主广告分类','url'=>'admin_flash_ad.php?action=add_cate'),
			'list_flash_cate'=>array('left_nav'=>'list_flash_cate','name'=>'管理主广告分类','url'=>'admin_flash_ad.php?action=list_cate'),
			'flash_ad_info'=>array('left_nav'=>'flash_ad_info','name'=>'主广告配置','url'=>'admin_flash_ad_info.php?')
		)),
		),
	'lang'=>array(
		'langsys'=>array('left_nav'=>'langsys','name'=>'语言设置','child'=>array(
			'addlang'=>array('left_nav'=>'addlang','name'=>'添加语言','url'=>'admin_lang.php?action=add'),
			'listlang'=>array('left_nav'=>'listlang','name'=>'管理语言','url'=>'admin_lang.php?action=lang'),
		)),
		'lang_lang_set'=>array('left_nav'=>'lang_lang_set','name'=>'语言包设置','child'=>array(
			'add_lang_lang'=>array('left_nav'=>'add_lang_lang','name'=>'添加语言变量','url'=>'admin_lang.php?action=add_lang'),
			'list_lang_lang'=>array('left_nav'=>'list_lang_lang','name'=>'管理语言包','url'=>'admin_lang.php?action=edit'),
		)),
	),
		
	'category'=>array(
		'cate'=>array('left_nav'=>'cate','name'=>'网站栏目','child'=>array(
			'addcate'=>array('left_nav'=>'addcate','name'=>'添加栏目','url'=>'admin_catagory.php?action=category_add'),
			'add_alone_cate'=>array('left_nav'=>'add_alone_cate','name'=>'添加单页栏目','url'=>'admin_catagory.php?action=add_alone_cate'),
			'listcate'=>array('left_nav'=>'listcate','name'=>'管理栏目','url'=>'admin_catagory.php?action=catagory'),
		)),
		'model'=>array('left_nav'=>'model','name'=>'内容模型','child'=>array(
			'addmodel'=>array('left_nav'=>'addmodel','name'=>'添加模型','url'=>'admin_channel.php?action=add'),
			'listmodel'=>array('left_nav'=>'listmodel','name'=>'管理模型','url'=>'admin_channel.php?'),
		)),
	),	
	
	'content'=>array(
	
		'block_content'=>array('left_nav'=>'block_content','name'=>'片段内容','child'=>array(
			'add_block'=>array('left_nav'=>'add_block','name'=>'添加片段内容','url'=>'admin_content_tag.php'),
			'list_block'=>array('left_nav'=>'list_block','name'=>'管理片段内容','url'=>'admin_content_tag.php?action=content_list'),
		)),
		'attach'=>array('left_nav'=>'attach','name'=>'内容附件','child'=>array(
			'add_pic_cate'=>array('left_nav'=>'add_pic_cate','name'=>'添加图片分类','url'=>'admin_pic.php?action=add_cate'),
			'pic_cate_list'=>array('left_nav'=>'pic_cate_list','name'=>'管理图片分类','url'=>'admin_pic.php?action=cate_list'),
			'pic_list'=>array('left_nav'=>'pic_list','name'=>'上传图片管理','url'=>'admin_pic.php'),
			'file_list'=>array('left_nav'=>'file_list','name'=>'上传附件管理','url'=>'admin_file.php'),
		))
	
	),
	'tpl'=>array(
		'tpl_set'=>array('left_nav'=>'tpl_set','name'=>'模板设置','child'=>array(
			'tpl_style'=>array('left_nav'=>'tpl_style','name'=>'模板风格','url'=>'admin_template.php?action=mb_list'),
			'list_tpl'=>array('left_nav'=>'list_tpl','name'=>'模板页管理','url'=>'admin_template.php?'),
			'tpl_tag'=>array('left_nav'=>'tpl_tag','name'=>'模板标签','url'=>'http://www.test.com/help?'),
		)),
	),
	'html'=>array(
		'html_set'=>array('left_nav'=>'html_set','name'=>'生成设置','child'=>array(
			'index_html'=>array('left_nav'=>'index_html','name'=>'生成首页','url'=>'admin_htm.php?'),
			'cate_html'=>array('left_nav'=>'cate_html','name'=>'生成栏目页','url'=>'admin_htm.php?action=cate'),
			'content_html'=>array('left_nav'=>'content_html','name'=>'生成内容页','url'=>'admin_htm.php?action=content'),
			'map_html'=>array('left_nav'=>'map_html','name'=>'生成网站地图','url'=>'admin_htm.php?action=map'),
		)),
	),
	'feeds'=>array(
		'order'=>array('left_nav'=>'order','name'=>'网站表单','child'=>array(
			'list_order'=>array('left_nav'=>'list_order','name'=>'表单管理','url'=>'admin_form.php?action=form_list'),
			'order_model'=>array('left_nav'=>'order_model','name'=>'添加表单模型','url'=>'admin_form.php?action=add'),
			'list_order_model'=>array('left_nav'=>'list_order_model','name'=>'管理表单模型','url'=>'admin_form.php?'),
		)),
		'ask'=>array('left_nav'=>'ask','name'=>'网站咨询','child'=>array(
			'list_ask'=>array('left_nav'=>'list_ask','name'=>'咨询管理','url'=>'admin_ask.php?'),
		)),
		'book'=>array('left_nav'=>'book','name'=>'网站留言','child'=>array(
			'list_book'=>array('left_nav'=>'list_book','name'=>'管理留言','url'=>'admin_book.php?'),
			'set_book'=>array('left_nav'=>'set_book','name'=>'留言本设置','url'=>'admin_book.php?action=made'),
		)),
	),
	'user'=>array(
		'admin_user'=>array('left_nav'=>'admin_user','name'=>'管理员','child'=>array(
			'add_admin_user'=>array('left_nav'=>'add_admin_user','name'=>'添加管理员','url'=>'admin_admin.php?action=add'),
			'list_admin_user'=>array('left_nav'=>'list_admin_user','name'=>'管理员管理','url'=>'admin_admin.php?'),
			'add_admin_group'=>array('left_nav'=>'add_admin_group','name'=>'添加分组','url'=>'admin_admin.php?action=add_admin_group'),
			'list_admin_group'=>array('left_nav'=>'list_admin_group','name'=>'管理员分组','url'=>'admin_admin.php?action=admin_group'),
		)),
		'web_user'=>array('left_nav'=>'web_user','name'=>'会员','child'=>array(
			'add_web_user'=>array('left_nav'=>'add_web_user','name'=>'添加会员','url'=>'admin_member.php?action=add'),
			'list_web_user'=>array('left_nav'=>'list_web_user','name'=>'会员管理','url'=>'admin_member.php?'),
			'add_web_group'=>array('left_nav'=>'add_web_group','name'=>'添加分组','url'=>'admin_member.php?action=member_group_add'),
			'list_web_group'=>array('left_nav'=>'list_web_group','name'=>'会员分组','url'=>'admin_member.php?action=member_group'),
		)),
	),
	'tools'=>array(
		'link'=>array('left_nav'=>'link','name'=>'友情链接','child'=>array(
			'add_link'=>array('left_nav'=>'add_link','name'=>'添加链接','url'=>'admin_link.php?action=add'),
			'list_link'=>array('left_nav'=>'list_link','name'=>'管理链接','url'=>'admin_link.php?action=link_list'),
		)),
		'db'=>array('left_nav'=>'db','name'=>'数据管理','child'=>array(
			'backup_db'=>array('left_nav'=>'backup_db','name'=>'备份数据','url'=>'admin_db.php?'),
			're_db'=>array('left_nav'=>'re_db','name'=>'恢复数据','url'=>'admin_db.php?action=import'),
		)),
		'cache'=>array('left_nav'=>'cache','name'=>'更新缓存','child'=>array(
			'all_cache'=>array('left_nav'=>'all_cache','name'=>'更新缓存','url'=>'admin_all_cache.php?'),
		)),
	)
	
)
?>
