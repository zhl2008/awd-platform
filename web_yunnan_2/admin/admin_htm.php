<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

define('IN_CMS','true');
include('init.php');
include(INC_PATH.'lib.php');
$tpl=new tpl(TP_PATH,DATA_PATH.'cache_tpl/');
$action=isset($_REQUEST['action'])?fl_html(fl_value($_REQUEST['action'])):'htm';
$lang=isset($_REQUEST['lang'])?fl_html(fl_value($_REQUEST['lang'])):get_lang_main();
//网站配置
$_confing=get_confing($lang);
if(file_exists(DATA_PATH.'sys_info.php')){include(DATA_PATH.'sys_info.php');}
//首页配置
if(file_exists(DATA_PATH.'index_info.php')){include(DATA_PATH.'index_info.php');}
//载入语言包
if(file_exists(LANG_PATH.'lang_'.$lang.'.php')){include(LANG_PATH.'lang_'.$lang.'.php');}
$tpl->template_dir=TP_PATH.$_confing['web_template'].'/';
$tpl->template_lang=$lang;
$tpl->template_is_cache=0;

if(file_exists(DATA_PATH.'cache/lang_cache.php')){include(DATA_PATH.'cache/lang_cache.php');}
if(file_exists(DATA_PATH.'cache_cate/cache_category_all.php')){include(DATA_PATH.'cache_cate/cache_category_all.php');}//栏目缓存
if(file_exists(DATA_PATH.'cache_channel/cache_channel_all.php')){include(DATA_PATH.'cache_channel/cache_channel_all.php');}//模型缓存
if(file_exists(DATA_PATH.'cache_cate/cate_list_'.$lang.'.php')){include(DATA_PATH.'cache_cate/cate_list_'.$lang.'.php');}//当前语言下的栏目
@set_time_limit(0);

if($action=='htm'){
	include('template/admin_htm_index.php');
}elseif($action=='index'){
//生成首页
	//global $lang,$_confing,$_index,$language,$tpl;
	if(!$_confing['web_html'][0]){err('<span style="color:red">请先开启【'.$lang.'】语言的html生成</span>');}
	$index_url=get_index_url($lang);//设定访问的语言
	ob_start();
	$index_focus="focus";
	$index_fl=($index_url)?CMS_PATH.'index.html':CMS_PATH.'index_'.$lang.'.html';
	$tpl->display('index');
	creat_html($index_fl);
	$index_fl=($index_url)?CMS_SELF.'index.html':CMS_SELF.'index_'.$lang.'.html';
	err('首页生成完成【<a target="_blank" href="'.$index_fl.'">浏览'.$lang.'语言首页</a>】');

//栏目生成界面	
}elseif($action=='cate'){
	global $lang;
	if(file_exists(DATA_PATH.'cache_cate/cate_list_'.$lang.'.php')){
		include(DATA_PATH.'cache_cate/cate_list_'.$lang.'.php');
	}
	include('template/admin_htm_cate.php');


//生成栏目	
}elseif($action=='cate_htm'){
	
	if(!$_confing['web_html'][0]){err('<span style="color:red">请先开启【'.$lang.'】语言的html生成</span>');}
	//初始化,首次更新写入缓存
	if($_POST['cate_is']){
		if(empty($_POST['cate'])){
			msg('<span style="color:red">请先选择栏目</span>');
		}
		$cate = $_POST['cate'];
		//写入缓存
		$cate_str="<?php \n\$cate_arr=".var_export($cate,true).";\n?>";
		cache_write(DATA_PATH.'cache_tpl/arr_tpl.php',$cate_str,'生成栏目');
		$msg['all']=count($cate);
		$msg['ago']=0;
		$msg_str="<?php \n\$msg=".var_export($msg,true).";\n?>";
		cache_write(DATA_PATH.'cache_tpl/msg_tpl.php',$msg_str);
	}
	//读取缓存
	if(file_exists(DATA_PATH.'cache_tpl/arr_tpl.php')){
		include(DATA_PATH.'cache_tpl/arr_tpl.php');
	}
	//更新信息缓存
	if(file_exists(DATA_PATH.'cache_tpl/msg_tpl.php')){
		include(DATA_PATH.'cache_tpl/msg_tpl.php');
	}
	
	
	if(!empty($cate_arr)){
	for($i=1;$i<=5;$i++){
		if(empty($cate_arr)){break;}
		$cate=array_shift($cate_arr);//取出栏目ID
		$cateid=$cate;
		$cate_info=get_cate_info($cate,$category);
		
		//获取第一个关键词作为相关内容调用
		$key_arr = empty($cate_info['cate_key_seo'])?'':explode(',',$cate_info['cate_key_seo']);
		$relave_key = $key_arr[0];
		//判断模板存在
		if(!file_exists(TP_PATH.$_confing['web_template']."/{$cate_info['cate_tpl_list']}")){
			continue;//不存在模板则跳过
		}else{
			$fl_dir=CMS_PATH;
			//create_folder($fl_dir);
			$cat_id=$cate_info['id'];
			$parent_id=get_cate_last_parent($cat_id);//获取最终顶级栏目
			$child=get_child_id($cat_id);//所有下级栏目
			$list_cate=empty($child)?$cat_id:$cat_id.$child;//当前栏目及其子栏目
			$channel_info=get_cate_info($cate_info['cate_channel'],$channel);//栏目内容模型
			
			//单页栏目
			if($cate_info['cate_channel']=='1'){
				$content=$GLOBALS['mysql']->fetch_asc("select m.*,c.* from ".DB_PRE."maintb as m left join ".DB_PRE."alone as c on m.id=c.id where category={$cate}");
	$content=$content[0];
				$arc_id = $content['id'];
				$channel_table = 'alone';
				//$msg[]=empty($content)?"<p style=\"color:red\">未添加{$cate_info['cate_name']}栏目内容</p>":"";
				//文章分页
				$body_content=$content['content'];
				$content_arr=preg_split('/<div style=\"page-break-after: always[;]*\">\s*<span style=\"display: none[;]*\">&nbsp;<\/span><\/div>/i',$body_content);
				$content_arr_num=count($content_arr);
				$content_arr_num=($content_arr_num>1)?$content_arr_num:0;
				$id='index';
				if($content_arr_num){
				$ct='index';
					for($i=0;$i<$content_arr_num;$i++){
						$content_focus=$i;
						$content['content']=$content_arr[$i];
						$p=$i+1;
						$file=($i==0)?$fl_dir.iconv('UTF-8','GBK',$cate_info['cate_fold_name']).'.html':$fl_dir.iconv('UTF-8','GBK',$cate_info['cate_fold_name']).'-'.$p.'.html';
						$tpl_rel=explode('.',$cate_info['cate_tpl_list']);
						ob_start();
						$tpl->display($tpl_rel[0]);//载入模板
						creat_html($file,$err);//生成文件
					}
				}else{
				$file=$fl_dir.iconv('UTF-8','GBK',$cate_info['cate_fold_name']).'.html';
				$tpl_rel=explode('.',$cate_info['cate_tpl_list']);
				ob_start();
				$tpl->display($tpl_rel[0]);//载入模板
				creat_html($file,$err);//生成文件
				}
			}
			//表单
			elseif($cate_info['cate_channel']=='-20'){
				$id=$cate;
				$file=$fl_dir.iconv('UTF-8','GBK',$cate_info['cate_fold_name']).'.html';
				$tpl_rel=explode('.',$cate_info['cate_tpl_list']);
				ob_start();
				$tpl->display($tpl_rel[0]);//载入模板
				creat_html($file,$err);//生成文件
			}
			//列表栏目
			else
			{
			
				$table=$channel_info['channel_table'];//获得当前栏目的模型表
				$r_count=$GLOBALS['mysql']->fetch_rows("select m.id from ".DB_PRE."maintb as m left join ".DB_PRE.$table." as c on m.id=c.id where m.category in (".$list_cate.")");
				$page_size=empty($cate_info['list_num'])?'20':$cate_info['list_num'];//显示数目
				$page_count=ceil($r_count/$page_size);//总页数
				$cate_html_url=iconv('UTF-8','GBK',$cate_info['cate_fold_name']);
				if($page_count){//判断是否有内容
					for($page=1;$page<=$page_count;$page++){
						$file=$fl_dir.$cate_html_url.'-'.$page.'.html';
						if($page==1){$file=$fl_dir.$cate_html_url.'.html';}//html文件路径
							$tpl_rel=explode('.',$cate_info['cate_tpl_list']);
							ob_start();
							$tpl->display($tpl_rel[0]);//载入模板
							creat_html($file,$err);//生成文件
					}
				}else{//没有内容
					$file=$fl_dir.$cate_html_url.'.html';
					$tpl_rel=explode('.',$cate_info['cate_tpl_list']);
					ob_start();
					$tpl->display($tpl_rel[0]);//载入模板
					creat_html($file,$err);//生成文件
				}	
			}
		
		}	
		//缓存信息
		$msg['ago']=$msg['ago']+1;
	}//循环结束	
	//更新缓存
	$cate_str="<?php \n\$cate_arr=".var_export($cate_arr,true).";\n?>";
	cache_write(DATA_PATH.'cache_tpl/arr_tpl.php',$cate_str,'生成栏目');
	$msg_str="<?php \n\$msg=".var_export($msg,true).";\n?>";
	cache_write(DATA_PATH.'cache_tpl/msg_tpl.php',$msg_str);
	$cate_msg = "已经生成".$msg['ago']."，总共有".$msg['all'];
	show_htm($cate_msg,'?action=cate_htm&lang='.$lang.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
	}else{
		echo  "已经生成".$msg['ago']."，总共有".$msg['all'];
		echo '<p style="font-size:12px;">已经生成所选栏目</p><a href="?nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav.'&action=cate&lang='.$lang.'">返回</a>';
	}


//内容生成界面	
}elseif($action=='content'){
	global $lang;
	if(file_exists(DATA_PATH.'cache_cate/cate_list_'.$lang.'.php')){
		include(DATA_PATH.'cache_cate/cate_list_'.$lang.'.php');
	}
	$category=isset($cate_list)?$cate_list:'';
	include('template/admin_htm_content.php');


//生成内容	
}elseif($action=='content_htm'){

	if(!$_confing['web_html'][0]){err('请先开启【'.$lang.'】语言的html生成');}
	
	if($_POST['step']){	
		$cate= $_POST['cate'];
		if(!empty($cate)){
			//获得栏目下的所有内容
			$cate_str = implode(',',$cate);
			$rel=$GLOBALS['mysql']->fetch_asc("select id from ".DB_PRE."maintb where category in (".$cate_str.") order by id desc");
		}else{
			$rel=$mysql->fetch_asc("select count(id) as num from ".DB_PRE."maintb where channel!=1 and lang='".$lang."' GROUP BY lang");
			$num = empty($rel[0]['num'])?0:$rel[0]['num'];
			$html_start = intval($_POST['html_b']);
			$html_start = ($html_start>$num)?0:$html_start;
			$html_end = intval($_POST['html_e']);
			$html_end = ($html_end>$num)?$num:$html_end;
			$rel=$GLOBALS['mysql']->fetch_asc("select id from ".DB_PRE."maintb where channel!=1 order by id desc limit ".$html_start.",".$html_end);
		}
		

		$msg_str="<?php \n\$content_list=".var_export($rel,true).";\n?>";
		cache_write(DATA_PATH.'cache_tpl/content_tpl.php',$msg_str);
		//信息缓存
		$msg['all'] = count($rel);
		$msg['ago'] = 0;
		$msg['num'] = empty($_POST['html_num'])?20:intval($_POST['html_num']);
		$msg_str="<?php \n\$msg=".var_export($msg,true).";\n?>";
		cache_write(DATA_PATH.'cache_tpl/msg_tpl.php',$msg_str);
		
	}
		
		
	//读取信息缓存
	if(file_exists(DATA_PATH.'cache_tpl/msg_tpl.php')){
		include(DATA_PATH.'cache_tpl/msg_tpl.php');
	}
	//读取内容ID信息
	if(file_exists(DATA_PATH.'cache_tpl/content_tpl.php')){
		include(DATA_PATH.'cache_tpl/content_tpl.php');
	}
	
	if(!empty($content_list)){
	
	for($i=1;$i<=$msg['num'];$i++){
		if(empty($content_list)){break;}
		$ct_arr = array_shift($content_list);
		$ct = $ct_arr['id'];
		$cate_rel=$mysql->fetch_asc("select category from ".DB_PRE."maintb where id=".$ct);
		
		$cate_info=get_cate_info($cate_rel[0]['category'],$category);
		unset($cate_rel);
		$cateid=$cat_id=$cate_info['id'];
		$parent_id=get_cate_last_parent($cateid);//获取最终顶级栏目
		$channel_info=get_cate_info($cate_info['cate_channel'],$channel);//栏目内容模型
		$channel_table=$channel_info['channel_table'];
		$content=get_content($ct,$channel_info['channel_table'],$cateid);
		$content=$content[0];
		
		//获取第一个关键词作为相关产品调用
		$key_arr = empty($content['keywords'])?'':explode(',',$content['keywords']);
		$relave_key = $key_arr[0];
		
		//权限跳过生成
		if(!$content['purview']){
			$fl_dir=CMS_PATH.iconv('UTF-8','GBK',$cate_info['cate_fold_name']).'/';
			create_folder($fl_dir);
			if(!$content['custom_url']){
				$c_addtime=date('YmdHms',$content['addtime']);
				//$addtime_rel=explode('-',$c_addtime);
				$fl_dir=$fl_dir.$c_addtime;
			}else{
				$fl_dir=$fl_dir.iconv('UTF-8','GBK',$content['custom_url']);
			}
				
			//文章分页
			$body_content=$content['content'];
			$content_arr=preg_split('/<div style=\"page-break-after: always[;]*\">\s*<span style=\"display: none[;]*\">&nbsp;<\/span><\/div>/i',$body_content);
			$content_arr_num=count($content_arr);
			$content_arr_num=($content_arr_num>1)?$content_arr_num:0;
			$id=$content['id'];//内容id，分页使用
			$content_title=$content['title'];
			if($content_arr_num){
				for($i=0;$i<$content_arr_num;$i++){
					$content_focus=$i;//内容分页选中
					$p_title=empty($i)?$i+1:1;
					$content['content']=$content_arr[$i];
					$content['title']=$content_title;//还原标题
					$content['title']=$content['title'].'('.($i+1).')';
					$p=$i+1;
					$file=($i==0)?$fl_dir.'.html':$fl_dir.'-'.$p.'.html';
					$tpl_rel=explode('.',$cate_info['cate_tpl_content']);
					ob_start();
					$tpl->display($tpl_rel[0]);//载入模板
					creat_html($file);//生成文件
				}
			}else{
				$file=$fl_dir.'.html';
				$tpl_rel=explode('.',$cate_info['cate_tpl_content']);
				ob_start();
				$tpl->display($tpl_rel[0]);//载入模板
				creat_html($file);//生成文件
			}
			$msg['ago']=$msg['ago']+1;
		}else{
			continue;
		}	
	}//循环结束
	//更新缓存
	$msg_str="<?php \n\$content_list=".var_export($content_list,true).";\n?>";
	cache_write(DATA_PATH.'cache_tpl/content_tpl.php',$msg_str);
	//信息缓存
	$msg_str="<?php \n\$msg=".var_export($msg,true).";\n?>";
	cache_write(DATA_PATH.'cache_tpl/msg_tpl.php',$msg_str);
	$cate_msg = "已经生成".$msg['ago']."，总共有".$msg['all'];
	show_htm($cate_msg,'?action=content_htm&lang='.$lang.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
	
	}else{
		echo  "已经生成".$msg['ago']."，总共有".$msg['all']."需要生成";
		show_htm('<p>完成所有内容的生成</p>','?action=content&lang='.$lang.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav,0);
	}	
		
//网站地图	
}elseif($action=='map'){
	include('template/admin_htm_map.php');
	
//生成网站地图
}elseif($action=='save_map'){
	ob_start();
$file=CMS_PATH.$lang.'_sitemap.html';
$tpl->display('sitemap');//载入模板	 		
creat_html($file);//生成文件
err('【'.$lang.'】语言网站地图生成完成');
}
echo PW;
?>
