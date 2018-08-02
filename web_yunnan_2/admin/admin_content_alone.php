<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

define('IN_CMS','true');
include('init.php');
$action=isset($_REQUEST['action'])?fl_html(fl_value($_REQUEST['action'])):'alone';
$lang=isset($_REQUEST['lang'])?fl_html(fl_value($_REQUEST['lang'])):get_lang_main();
if(file_exists(DATA_PATH.$lang.'_info.php')){include(DATA_PATH.$lang.'_info.php');}

//添加单页
if($action=='add_alone'){
	if(!check_purview('content_create')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$cate = intval($_REQUEST['cate']);
	
	if(!empty($channel)){
	foreach($channel as $k=>$v){
		if($v['channel_mark']=='alone'){
			$channel_id=$v['id'];
			$is_disable=$v['is_disable'];
		}
	}
	}
	//是否开启
	if($is_disable){
		msg('<span style="color:red">单页模型没有开启，请先在内容模型开启单页</span>');
	}
	include("template/admin_content_alone.php");
}

//保存单页内容
elseif($action=='save_content'){
	if(!check_purview('content_create')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$is_add=$_POST['is_add'];
	$channel_id = intval($_POST['channel_id']);
	$cate_id = intval($_POST['cate_id']);
	$title = $_POST['title'];
	//$filter = $_POST['filter_g'];
	$thumb = $_POST['thumb'];
	$key_words = $_POST['key_words'];
	$info = $_POST['info'];
	$author = $_POST['author'];
	$source = $_POST['source'];
	$category = $_POST['category'];
	$addtime = $_POST['addtime'];
	$top = intval($_POST['top']);
	$purview = intval($_POST['purview']);
	$is_html = intval($_POST['is_html']);
	$fields = $_POST['fields'];
	$is_info = $_POST['is_info'];
	$first_pic = $_POST['first_pic'];
	$down_file = $_POST['down_file'];
	//$g_url = $_POST['g_url'];
	$pic_watermark = $_POST['pic_watermark'];
	$cache_time = intval($_POST['cache_time']);
	

	$is_add=stripslashes($is_add);
	if(!isset($channel_id)||empty($channel_id)){
		msg('<span style="color:red">不存在相关频道,请选择频道再添加内容</span>');
	}
	if(empty($cate_id)){
		msg('<span style="color:red">不存在相关栏目,请选择栏目再添加内容</span>');
	}
	if($GLOBALS['mysql']->fetch_rows("select id from ".DB_PRE."maintb where category=".$cate_id)){
		msg('<span style="color:red">该栏目已经添加过内容，请到单页内容管理中修改</span>');
	}
	if(empty($GLOBALS['title'])||!isset($GLOBALS['title'])){
		msg('<span style="color:red">标题不能为空</span>');
	}
	$title=empty($_sys['web_content_title'])?cn_substr($title,60):cn_substr($title,intval($_sys['web_content_title']));
	if(file_exists(DATA_PATH."cache_channel/cache_channel_all.php")){
		include(DATA_PATH."cache_channel/cache_channel_all.php");
	}
	if(empty($channel)){
		msg('<span style="color:red">没有找到当前操作的频道,请更新频道缓存或重新添加频道</span>');
	}
	foreach($channel as $key=>$value){
		if($value['id']==$channel_id){
			$table=DB_PRE.$value['channel_table'];//取得附加表
			$verify=$value['is_verify'];
		}
	}
	
	$hits=($_sys['is_hits'])?$_sys['is_hits']:rand(1,500);
	$addtime=empty($addtime)?time():strtotime($addtime);
	$is_html=($is_html=='1')?1:0;
	
	
	//下载图片
	if($down_file&&!empty($fields['content'])){
	$body=$fields['content'];
	$body = stripslashes($body); 
	
	preg_match_all('/(src|SRC)=[\"|\'|]?(http:\/\/(.*)\.(gif|jpg|jpeg|bmp|png))/isU',$body,$pic_arr);
	$pic_arr=$pic_arr[2];
	$cms_path=CMS_SELF;
	if(!empty($pic_arr)){
		set_time_limit(0); 
		$pic_time=date('Ymd');
		$pic_dir="../upload/img/".$pic_time.'/';
		if(!file_exists($pic_dir)){@mkdir($pic_dir,0777);}
		$i=0;
		foreach($pic_arr as $k=>$v){
			$pic_ext=strrchr($v,".");
			$pic_file=$pic_dir.date('YmdHis').$pic_ext;
			$get_url_pic=@file_get_contents($v);
			$fp= @fopen($pic_file,"w");
			@fwrite($fp,$get_url_pic);
			@fclose($fp);
			$pic_path=str_replace('../',$cms_path,$pic_file);
			$v=str_replace('/','\/',$v);
			$body=preg_replace('/'.$v.'/',$pic_path,$body);
			//添加水印
			if($_sys['image_is'][0]&&$pic_watermark){
	    		create_img_sy($_sys,$pic_file);
			}	
				//缩略图
			if($first_pic&&$i==0&&empty($thumb)){
				$thumb=pic_thumb($pic_file,$_sys['thump_width'],$_sys['thump_height'],$pic_dir);
			}
			$i=$i+1; 
		}
	}
	$body=addslashes($body);
	$fields['content']=$body;
	}//处理编辑器
	
	$info=($is_info&&empty($info))?cn_substr(strip_tags($fields['content']),240):cn_substr($info,240);
	$cache_time=empty($cache_time)?30:$cache_time;//缓存时间
	//添加主表
	$main_sql="insert into ".DB_PRE."maintb (title,tbpic,keywords,info,author,source,hits,category,channel,addtime,updatetime,top,purview,is_html,lang,verify,cache_time) values ('{$title}','{$thumb}','{$key_words}','{$info}','{$author}','{$source}',{$hits},{$cate_id},{$channel_id},'{$addtime}','{$addtime}',{$top},{$purview},{$is_html},'{$lang}',{$verify},'{$cache_time}')";
	$GLOBALS['mysql']->query($main_sql);
	$last_id=$GLOBALS['mysql']->insert_id();
	
	//处理附加字段
	
	$sql_value=$last_id;
	$sql_field='id';
	if($fields){
		foreach($fields as $key=>$value){
			$sql_field.=','.$key;
			if(is_array($value)){
			$value_str='';
				foreach($value as $k=>$v){
					$value_str.=$v.',';
				}
				$value=$value_str;
			}
			$sql_value.=",'".$value."'";
			
		}
	}
	
	$sql_else="insert into {$table} ({$sql_field}) values ({$sql_value})";
	if(!$link=$GLOBALS['mysql']->query_error($sql_else)){
		$GLOBALS['mysql']->query("delete from ".DB_PRE."maintb where id=".$last_id);
		msg('<span style="color:red">添加频道附加表表发生错误</span>'.$GLOBALS['mysql']->get_error());
	}
	//设置栏目已有内容
	$GLOBALS['mysql']->query("update ".DB_PRE."category set is_content=1 where id=".$cate_id);
	//更新栏目列表
	$sql="select c.id,c.cate_channel,c.cate_html,c.is_content,c.cate_nav,c.cate_fold_name,c.cate_order,c.cate_hide,c.cate_tpl,c.cate_name,c.lang,c.cate_parent,COUNT(s.id) as haschild from ".DB_PRE."category as c left join ".DB_PRE."category as s on c.id=s.cate_parent where c.lang='".$GLOBALS['lang']."' group by c.id order by c.cate_order,c.id desc";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	$str="<?php\n\$cate_list=".var_export($rel,true).";\n?>";
	$file=DATA_PATH.'cache_cate/cate_list_'.$GLOBALS['lang'].'.php';
	creat_inc($file,$str);
	$GLOBALS['cache']->cache_category_all();
	msg('内容添加成功','?action=content_list&lang='.$lang.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}


//修改单页内容
elseif($action=='edit_content'){
	if(!check_purview('content_edit')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$cate = intval($_GET['cate']);

	$channel_id=1;
	$a_arr=$GLOBALS['mysql']->fetch_asc('select m.*,e.* from '.DB_PRE."alone as e left join ".DB_PRE."maintb as m on e.id=m.id where m.category=".$cate);
	
	$field_value=$a_arr[0];
	$cate_name=$GLOBALS['mysql']->get_row("select cate_name from ".DB_PRE."category where id=".$field_value['category']);
	
	include('template/admin_content_alone_edit.php');
}

//处理修改的单页内容
elseif($action=='save_edit_content'){
	if(!check_purview('content_edit')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}

	$channel_id = 1;
	$cate_id = intval($_POST['cate_id']);
	$title = $_POST['title'];
	//$filter = $_POST['filter_g'];
	$thumb = $_POST['thumb'];
	$key_words = $_POST['key_words'];
	$info = $_POST['info'];
	$author = $_POST['author'];
	$source = $_POST['source'];
	$category = $_POST['category'];
	$addtime = $_POST['addtime'];
	$top = intval($_POST['top']);
	$purview = intval($_POST['purview']);
	$is_html = intval($_POST['is_html']);
	$fields = $_POST['fields'];
	$is_info = $_POST['is_info'];
	$first_pic = $_POST['first_pic'];
	$down_file = $_POST['down_file'];
	//$g_url = $_POST['g_url'];
	$pic_watermark = $_POST['pic_watermark'];
	$cache_time = intval($_POST['cache_time']);
	

	if(empty($GLOBALS['title'])||!isset($GLOBALS['title'])){
		msg('<span style="color:red">标题不能为空</span>');
	}
	if(empty($cate_id)){msg('<span style="color:red">参数传递错误!</span>');}
	//判断内容id
	$id_arr=$mysql->fetch_asc("select id from ".DB_PRE."maintb where category=".$cate_id);
	$id=$id_arr[0]['id'];
	$title=empty($_sys['web_content_title'])?cn_substr($title,60):cn_substr($title,intval($_sys['web_content_title']));
	$table=DB_PRE.'alone';
	$addtime=empty($addtime)?time():strtotime($addtime);
	$is_html=($is_html=='1')?1:0;
	
	//下载图片
	if($down_file&&!empty($fields['content'])){
	$body=$fields['content'];
	$body = stripslashes($body); 
	preg_match_all('/(src|SRC)=[\"|\'|]?(http:\/\/(.*)\.(gif|jpg|jpeg|bmp|png))/isU',$body,$pic_arr);
	$pic_arr=$pic_arr[2];
	$cms_path=str_replace(ADMINDIR.'/admin_content_alone.php','',$_SERVER['PHP_SELF']);
	if(!empty($pic_arr)){
		set_time_limit(0); 
		$pic_time=date('Ymd');
		$pic_dir="../upload/img/".$pic_time.'/';
		if(!file_exists($pic_dir)){@mkdir($pic_dir,0777);}
		$i=0;
		foreach($pic_arr as $k=>$v){
			$pic_ext=strrchr($v,".");
			$pic_file=$pic_dir.date('YmdHis').$pic_ext;
			$get_url_pic=@file_get_contents($v);
			$fp= @fopen($pic_file,"w");
			@fwrite($fp,$get_url_pic);
			@fclose($fp);
			$pic_path=str_replace('../',$cms_path,$pic_file);
			$v=str_replace('/','\/',$v);
			$body=preg_replace('/'.$v.'/',$pic_path,$body);
			
	   //添加水印
			if($_sys['image_is'][0]&&$pic_watermark){
	    		create_img_sy($_sys,$pic_file);
			}	
				//缩略图
			if($first_pic&&$i==0&&empty($thumb)){
				$thumb=pic_thumb($pic_file,$_sys['thump_width'],$_sys['thump_height'],$pic_dir);
			}
			$i=$i+1; 
		}
	}
	$body=addslashes($body);
	$fields['content']=$body;
	}//编辑器处理
   $info=($is_info&&empty($info))?cn_substr(strip_tags($fields['content']),255):cn_substr($info,240);
	$cache_time=empty($cache_time)?30:$cache_time;//缓存时间
	//主表
	 $main_sql="update ".DB_PRE."maintb set title='{$title}',tbpic='{$thumb}',keywords='{$key_words}',info='{$info}',author='{$author}',source='{$source}',category={$cate_id},top={$top},purview={$purview},is_html={$is_html},cache_time='{$cache_time}',updatetime='{$addtime}' where id={$id}";
	$GLOBALS['mysql']->query($main_sql);
	
	//处理附加字段
	$field_sql='';
	if(!empty($fields)){
	foreach($fields as $k=>$v){
		$f_value=$v;
		if(is_array($v)){
			$f_value=implode(',',$v);
		}
		$field_sql.=",{$k}='{$f_value}'";		
	}
	$field_sql=substr($field_sql,1);
	$field_sql="update {$table} set {$field_sql} where id={$id}";
	if(!$link=$GLOBALS['mysql']->query_error($field_sql)){
		msg('<span style="color:red">修改频道表发生错误</span>'.$GLOBALS['mysql']->get_error());
	}
	}
	msg('内容修改成功,<a href="admin_content_alone.php?action=content_list&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav.'">返回内容列表</a>',"admin_content_alone.php?action=content_list&lang=".$lang.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
	
}


//管理单页内容
elseif($action=='content_list'){
	global $id,$page,$cate,$lang;
	
	if(file_exists(DATA_PATH."cache/lang_cache.php")){include(DATA_PATH."cache/lang_cache.php");}
	foreach($channel as $key=>$value){
		if($value['channel_mark']=='alone'){
		$c_arr=$value;
		}
	}
	if($c_arr['is_disable']){
		msg('<span style="color:red">单页频道没有开启,请先开启单页频道</span>');
	}
	$id=$c_arr['id'];
	include('template/admin_content_alone_list.php');
}

//删除单页
elseif($action == 'del')
{
	if(!check_purview('content_edit')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$id = intval($_GET['id']);
	
	$table = 'alone';
	$GLOBALS['mysql']->query('delete from '.DB_PRE."maintb where id={$id}");
	$GLOBALS['mysql']->query('delete from '.DB_PRE."{$table} where id={$id}");
	msg('内容删除完成','admin_content_alone.php?action=content_list&lang='.$lang.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}
echo PW;
?>
