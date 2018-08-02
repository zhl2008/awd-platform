<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

define('IN_CMS','true');
include('init.php');
$action=isset($_REQUEST['action'])?fl_html(fl_value($_REQUEST['action'])):'pic_list';
$lang=isset($_REQUEST['lang'])?fl_html(fl_value($_REQUEST['lang'])):get_lang_main();


//获取数据库图片列表
if($action=='pic_list'){
	if(!check_purview('file_manage')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	//图片分类
	$pic_nav=isset($_REQUEST['pic_nav'])?intval($_REQUEST['pic_nav']):1;
	$pic_nav_sql=(!$pic_nav)?'':'where m.pic_cate='.$pic_nav;
	$nav_rel=$mysql->fetch_asc("select*from ".DB_PRE."uppic_cate order by id asc");
	$maintb=DB_PRE."uppics";
	$page=empty($_GET['page'])?1:intval($_GET['page']);
	$pagesize=10;
	$pagenum=($page-1)*$pagesize;
	$query='&type='.$type.'&pic_nav='.$pic_nav;
	$order='order by m.id desc';
	$total_num=$GLOBALS['mysql']->fetch_rows("select m.id,m.pic_cate from {$maintb} as m where m.pic_cate=".$pic_nav);
	$total_page=ceil($total_num/$pagesize);
	$sql="select m.* from {$maintb} as m left join ".DB_PRE."uppic_cate as n on m.pic_cate=n.id {$pic_nav_sql} {$order} limit {$pagenum},{$pagesize}";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	include('template/admin_pic.php');
}

//修改图片
elseif($action=='edit_pic'){
	if(!check_purview('file_manage')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$id = intval($_GET['id']);
	if(empty($id)){msg('参数发生错误，请重新操作');}
	$sql="select * from ".DB_PRE."uppics where id=".$id;
	$rel=$mysql->fetch_asc($sql);
	$pic=$rel[0]['pic_path'].$rel[0]['pic_name'].'.'.$rel[0]['pic_ext'];
	$img=CMS_SELF.$pic;
	include('template/admin_pic_edit.php');
}

//处理修改的图片
elseif($action=='save_edit'){
	$id=intval($_POST['id']);
	if(empty($id)){msg('参数发生错误,请重新操作');}
	$is_thumb=intval($_POST['is_thumb']);
	$thumb_width=intval($_POST['thumb_width']);
	$thumb_width=empty($thumb_width)?$_sys['thump_width']:$thumb_width;
	$thumb_height=intval($_POST['thumb_height']);
	$thumb_height=empty($thumb_height)?$_sys['thumb_height']:$thumb_height;
	$pic_alt=$_POST['pic_alt'];//图片alt
	$pic_thumb=$_POST['pic_thumb'];//图片缩略图
	$pic_thumb = iconv('UTF-8','GBK',$pic_thumb);
	$pic_ext=$_POST['pic_ext'];//图片后缀名
	$file_name=CMS_PATH.$_POST['pic'];//上传图片路径
	$file_name = iconv('UTF-8','GBK',$file_name);
	$pic_name=$_POST['pic_name'];//图片名称
	$pic_name = iconv('UTF-8','GBK',$pic_name);
	$pic_path=$_POST['pic_path'];//图片所在目录
	$pic_cate=$_POST['pic_cate'];//图片类别
	$new_pic=$_FILES['new_pic'];
	$return_thumb='';//缩略图
	if(file_exists(DATA_PATH.'sys_info.php')){include(DATA_PATH.'sys_info.php');}
	//是否重新上传图片
	if(is_uploaded_file($new_pic['tmp_name'])){
		//判断大小
		if($new_pic['size']>$_sys['upload_size']){msg('图片太大，请缩小');}
		//判断格式
		if(!in_array(strtolower($new_pic['type']),array('image/gif','image/jpeg','image/png','image/jpg','image/bmp','image/pjpeg'))){msg('上传图片格式不正确');}
		//图片信息
		$new_pic_info=pathinfo($new_pic['name']);
		//替换图片
		$new_pic_name=CMS_PATH.$pic_path.$pic_name.'.'.$new_pic_info['extension'];
		//删除原来图片
		//@unlink($file_name);
		//上传图片
		@move_uploaded_file($new_pic['tmp_name'],$new_pic_name);
		//对文件重新赋值，方便生成缩略图
		$file_name=$new_pic_name;
		//更新数据库
		$new_pic_sql=",pic_ext='".$new_pic_info['extension']."',pic_size='".$new_pic['size']."'";
	}

	
	if($is_thumb){//开启缩略图
		$file_info=@getimagesize($file_name);
		if(empty($file_info)){msg('图片不存在，操作失败');}
		//删除以前的缩略图
		if($pic_thumb){@unlink(CMS_PATH.'upload/'.$pic_thumb);}
		$path=CMS_PATH.$pic_path;//缩略图片路径，和上传大图放一起
		switch($file_info[2]){
 			case 1:
 			$php_file=imagecreatefromgif($file_name);
 			break;
 			case 2:
 			$php_file=imagecreatefromjpeg($file_name);
 			break;
 			case 3:
 			$php_file=imagecreatefrompng($file_name);
 			break;
 		}
		$new_img=imagecreatetruecolor($thumb_width,$thumb_height);
		$src_img=$php_file;
		imagecopyresized($new_img,$src_img,0,0,0,0,$thumb_width,$thumb_height,$file_info[0],$file_info[1]);
		switch($file_info[2]){
			case 1:
			imagegif($new_img,$path.$pic_name.'_thumb.gif');
			$return_thumb=str_replace(CMS_PATH,"",$path.$pic_name.'_thumb.gif');
			break;
			case 2:
			imagejpeg($new_img,$path.$pic_name.'_thumb.jpeg');
			$return_thumb=str_replace(CMS_PATH,"",$path.$pic_name.'_thumb.jpeg');
			break;
			case 3:
			imagepng($new_img,$path.$pic_name.'_thumb.png');
			$return_thumb=str_replace(CMS_PATH,"",$path.$pic_name.'_thumb.png');
			break;
		}
		$return_thumb=empty($return_thumb)?$return_thumb:str_replace('upload/','',$return_thumb);
		
	}//缩略图
	//更新图片信息
	$return_thumb = empty($return_thumb)?'':iconv('GBK','UTF-8',$return_thumb);
	$thumb_sql=empty($return_thumb)?'':",pic_thumb='".$return_thumb."'";
	$sql="update ".DB_PRE."uppics set pic_alt='".$pic_alt."'".$thumb_sql.$new_pic_sql." where id=".$id;
	$mysql->query($sql);
	msg('图片更新成功！','?pic_nav='.$pic_cate.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}

//删除图片
elseif($action=='del'){
	if(!check_purview('file_manage')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$id=intval($_GET['id']);
	$pic_nav=intval($_GET['pic_nav']);
	if(empty($id)){msg('参数发生错误，请重新操作！');}
	$sql="select pic_name,pic_ext,pic_path,pic_thumb from ".DB_PRE."uppics where id=".$id;
	$rel=$mysql->fetch_asc($sql);
	$pic=CMS_PATH.$rel[0]['pic_path'].$rel[0]['pic_name'].'.'.$rel[0]['pic_ext'];
	$pic = empty($pic)?'':iconv('UTF-8','GBK',$pic);
	$pic_thumb=CMS_PATH.'upload/'.$rel[0]['pic_thumb'];
	$pic_thumb = empty($pic_thumb)?'':iconv('UTF-8','GBK',$pic_thumb);
	//删除大图和缩略图
	@unlink($pic);
	@unlink($pic_thumb);
	//删除数据
	$mysql->query("delete from ".DB_PRE."uppics where id=".$id);
	msg('图片删除成功！','?pic_nav='.$pic_nav.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}

//删除缩略图
elseif($action=='del_thumb'){
	if(!check_purview('file_manage')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$id=intval($_GET['id']);
	$pic_nav=intval($_GET['pic_nav']);
	if(empty($id)){msg('参数发生错误，请重新操作！');}
	$sql="select pic_thumb from ".DB_PRE."uppics where id=".$id;
	$rel=$mysql->fetch_asc($sql);
	$pic_thumb=CMS_PATH.'upload/'.$rel[0]['pic_thumb'];
	$pic_thumb = empty($pic_thumb)?'':iconv('UTF-8','GBK',$pic_thumb);
	@unlink($pic_thumb);
	$sql="update ".DB_PRE."uppics set pic_thumb='' where id=".$id;
	$mysql->query($sql);
	msg('缩略图删除成功！','?pic_nav='.$pic_nav.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}

//添加图片分类
elseif($action=='add_cate'){
	if(!check_purview('file_manage')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	include('template/admin_pic_cate_add.php');
}

//处理图片分类
elseif($action=='save_add_cate'){
	if(!check_purview('file_manage')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$cate_name=$_POST['cate_name'];
	if(empty($cate_name)){msg('分类名称不能为空');}
	$rel=$mysql->fetch_asc("select id from ".DB_PRE."uppic_cate where cate_name='".$cate_name."'");
	if(!empty($rel)){msg("【{$cate_name}】分类已经存在，请更改");}
	$mysql->query('insert into '.DB_PRE."uppic_cate (cate_name) values ('{$cate_name}')");
	msg('分类添加完成','?action=cate_list&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}

//分类列表
elseif($action=='cate_list'){
	if(!check_purview('file_manage')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$sql="select*from ".DB_PRE."uppic_cate order by id asc";
	$rel=$mysql->fetch_asc($sql);
	include('template/admin_pic_cate_list.php');
}

//删除分类【下载分类为固定分类，不能删除】
elseif($action=='del_cate'){
	if(!check_purview('file_manage')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$id=intval($_GET['id']);
	if(empty($id)){msg('参数发生错误，请重新操作');}
	if($id==2){msg('【下载分类】为固定分类，不能删除');}
	//判断是否有图片
	$rel=$mysql->fetch_asc('select count(id) as num from '.DB_PRE.'uppics where pic_cate='.$id);
	if(!empty($rel[0]['num'])){msg('当前分类下有分类图片，请先删除或转移该分类图片');}
	$mysql->query("delete from ".DB_PRE."uppic_cate where id=".$id);
	msg('分类删除完成','?action=cate_list&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}

//修改分类
elseif($action=='edit_cate'){
	if(!check_purview('file_manage')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$id=intval($_GET['id']);
	if(empty($id)){msg('参数发生错误，请重新操作');}
	$rel=$mysql->fetch_asc("select cate_name from ".DB_PRE."uppic_cate where id=".$id);
	include('template/admin_pic_cate_edit.php');
}

//处理分类修改
elseif($action=='save_edit_cate'){
	if(!check_purview('file_manage')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$id=intval($_POST['id']);
	if(empty($id)){msg('参数发生错误，请重新操作');}
	$cate_name=$_POST['cate_name'];
	if(empty($cate_name)){msg('分类名不能为空');}
	$sql="update ".DB_PRE."uppic_cate set cate_name='".$cate_name."' where id=".$id;
	$mysql->query($sql);
	msg('分类修改完成','?action=cate_list&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}
echo PW;

?>
