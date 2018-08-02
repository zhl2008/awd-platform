<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

define('IN_CMS','true');
include('init.php');
$action=isset($_REQUEST['action'])?fl_html(fl_value($_REQUEST['action'])):'admin';
$lang=isset($_REQUEST['lang'])?fl_html(fl_value($_REQUEST['lang'])):get_lang_main();


//管理员列表
if($action=='admin'){
	$page = intval($_GET['page']);
	if(file_exists(DATA_PATH."cache/cache_admin_group.php")){
		include(DATA_PATH."cache/cache_admin_group.php");
	}
	$page=empty($page)?1:$page;
	$page_size=10;
	$page_num=($page-1)*$page_size;
	$total_num=$GLOBALS['mysql']->fetch_rows("select id from ".DB_PRE."admin");
	$total_page=ceil($total_num/$page_size);
	$total_page=(!$total_page)?1:$total_page;
	$query='nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav;
	$rel=$GLOBALS['mysql']->fetch_asc("select*from ".DB_PRE."admin order by id desc limit ".$page_num.','.$page_size);
	include('template/admin_admin.php');
}

//添加管理员界面
elseif($action=='add'){
	if(!check_purview('admin_manage')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	if(file_exists(DATA_PATH."cache/cache_admin_group.php")){
		include(DATA_PATH."cache/cache_admin_group.php");
	}
	include('template/admin_admin_add.php');
}

//修改管理员界面
elseif($action=='admin_edit'){
	if(!check_purview('admin_manage')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$id = intval($_GET['id']);
	
	$rel=$GLOBALS['mysql']->fetch_asc("select*from ".DB_PRE."admin where id=".$id);
	$rel=$rel[0];
	if(file_exists(DATA_PATH."cache/cache_admin_group.php")){
		include(DATA_PATH."cache/cache_admin_group.php");
	}
	include('template/admin_admin_edit.php');
}

//处理修改的管理员
elseif($action=='save_admin_edit'){
	if(!check_purview('admin_manage')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$id = intval($_POST['id']);
	$admin_password_ago = $_POST['admin_password_ago'];
	$admin_password = $_POST['admin_password'];
	$admin_password_tow = $_POST['admin_password_tow'];
	$admin_nich = $_POST['admin_nich'];
	$purview = intval($_POST['purview']);
	$admin_admin = $_POST['admin_admin'];
	$admin_mail = $_POST['admin_mail'];
	$admin_tel = $_POST['admin_tel'];
	$is_disable = intval($_POST['is_disable']);
	
	
	$rel=$GLOBALS['mysql']->fetch_asc('select admin_password,admin_purview from '.DB_PRE."admin where id=".$id);
	$password=isset($rel[0]['admin_password'])?$rel[0]['admin_password']:'';
	if(empty($password)){
		msg('<span style="color:red">参数错误,找不到原始密码</span>');
	}
	if(empty($purview)){
		msg('<span style="color:red">请选择用户组</span>');
	}
	$rel_purview=isset($rel[0]['admin_purview'])?$rel[0]['admin_purview']:'';
	if($rel_purview==1){
	if($purview!=1){
		$admin_num=$GLOBALS['mysql']->fetch_rows("select id from ".DB_PRE."admin where admin_purview=1");
		if($admin_num==1){err('<span style="color:red">请先添加一个超级管理员，才能修改该管理员</span>');}
	}
	}
	$table=DB_PRE."admin";
	
	$ps_sql="";
	if(!empty($admin_password)||!empty($admin_password_tow)){
	if($admin_password!=$admin_password_tow){msg('<span style="color:red">输入的两次新密码不一样</span>');}
	if($password!=md5($admin_password_ago)){msg('<span style="color:red">输入的旧密码不正确</span>');}
	$admin_password=md5($admin_password);
	$ps_sql="admin_password='{$admin_password}',";
	}
	$sql="update {$table} set ".$ps_sql."admin_nich='{$admin_nich}',admin_purview={$purview},admin_admin='{$admin_admin}',admin_mail='{$admin_mail}',admin_tel='{$admin_tel}',is_disable={$is_disable} where id={$id}";
	$GLOBALS['mysql']->query($sql);
	msg('修改成功','admin_admin.php?nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
	
}

//处理添加的管理员
elseif($action=='save_admin'){
	if(!check_purview('admin_manage')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$admin_name = $_POST['admin_name'];
	$admin_password = $_POST['admin_password'];
	$admin_password2 = $_POST['admin_password2'];
	$admin_nich = $_POST['admin_nich'];
	$purview = intval($_POST['purview']);
	$admin_admin = $_POST['admin_admin'];
	$admin_mail = $_POST['admin_mail'];
	$admin_tel = $_POST['admin_tel'];
	$is_disable = intval($_POST['is_disable']);
	if(strlen($admin_name)<3){
		msg('<span style="color:red">用户名长度必须大于3</span>');
	}
	if(strlen($admin_password)<3){
		msg('<span style="color:red">用户密码长度必须大于3</span>');
	}
	
	
	if(!check_str($admin_name,'/^[a-z0-9][a-z0-9]*$/')){
		msg('<span style="color:red">用户名必须由字母和数字组成</span>');
	}
	if(!check_str($admin_password,'/^[a-z0-9!@#$%][a-z0-9!@#$%]*$/')){
		msg('<span style="color:red">用户密码包含其它不允许的字符</span>');
	}
	if($admin_password!=$admin_password2){msg('<span style="color:red">两次密码不一样</span>');}
	if(empty($admin_nich)){
		msg('<span style="color:red">用户昵称不能为空</span>');
	}
	if(empty($purview)){
		msg('<span style="color:red">请选择用户组</span>');
	}
	$table=DB_PRE."admin";
	$admin_password=md5($admin_password);
	$sql="insert into {$table} (admin_name,admin_password,admin_nich,admin_purview,admin_admin,admin_mail,admin_tel,is_disable) values ('{$admin_name}','{$admin_password}','{$admin_nich}',$purview,'{$admin_admin}','{$admin_mail}','{$admin_tel}',{$is_disable})";
	$GLOBALS['mysql']->query($sql);
	msg('用户'.$admin_name.'添加成功','?nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}

//删除管理员
elseif($action=='admin_del'){
	if(!check_purview('admin_manage')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$id = intval($_GET['id']);

	$rel=$GLOBALS['mysql']->fetch_asc('select admin_purview,admin_name from '.DB_PRE."admin where id=".$id);
	$purview=isset($rel[0]['admin_purview'])?$rel[0]['admin_purview']:'';
	$user=isset($rel[0]['admin_name'])?$rel[0]['admin_name']:'';
	if($purview==1){
	$admin_num=$GLOBALS['mysql']->fetch_rows("select id from ".DB_PRE."admin where admin_purview=1");
	if($admin_num==1){err('<span style="color:red">请先添加一个超级管理员</span>');}
	}
	if($user==$_SESSION['admin']){msg('<span style="color:red">不能删除正在使用的管理员【'.$_SESSION['admin'].'】</span>');}
	$GLOBALS['mysql']->query("delete from ".DB_PRE."admin where id=".$id);
	msg('<span style="color:red">管理用户删除成功</span>','?');
}

//管理组列表
elseif($action=='admin_group'){
if(file_exists(DATA_PATH."cache/cache_admin_group.php")){
		include(DATA_PATH."cache/cache_admin_group.php");
	}
	include('template/admin_admingroup.php');
}

//添加管理分组界面
elseif($action=='add_admin_group'){
	if(!check_purview('admin_group')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	include('template/admin_admingroup_ad.php');
}

//处理添加的管理分组
elseif($action=='save_admingroup'){
if(!check_purview('admin_group')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$admin_group_name = $_POST['admin_group_name'];
	$admin_group_info = $_POST['admin_group_info'];
	$c_all = $_POST['c_all'];
	$is_disable = intval($_POST['is_disable']);
	$q = $_POST['q'];
	if(empty($admin_group_name)||strlen($admin_group_name)<1){
		msg('<span style="color:red">管理员分组名不能为空</span>');
	}

	if(empty($q)&&empty($c_all)){
		msg('<span style="color:red">请选择组所拥有的权限</span>');
	}
	$p_str=empty($q)?'':$q;
	if(is_array($p_str)){
	$p_str=implode(',',$p_str);
	}
	if(!empty($c_all)){
		$p_str='all_purview';
	}
	$sql="insert into ".DB_PRE."admin_group (admin_group_name,admin_group_info,admin_group_purview,is_disable) values ('".$admin_group_name."','".$admin_group_info."','".$p_str."',".$is_disable.")";
	$GLOBALS['mysql']->query($sql);
	$GLOBALS['cache']->cache_admin_group();
	msg('管理分组添加成功','admin_admin.php?action=admin_group&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}

//管理分组缓存
elseif($action=='cache_admin_group'){
	$GLOBALS['cache']->cache_admin_group();
	msg("管理员分组缓存完成");
}

//修改管理组界面
elseif($action=='admin_group_edit'){
	if(!check_purview('admin_group')){msg('操作失败,你的权限不足!');}
	$id = intval($_GET['id']);
	
	if(file_exists(DATA_PATH."cache/cache_admin_group.php")){
		include(DATA_PATH."cache/cache_admin_group.php");
	}
	if(empty($admin_group)){
		msg('<span style="color:red">还没有添加分组</span>','admin_admin.php?action=add_admin_group');
	}
	foreach($admin_group as $k=>$v){
		if($v['id']==$id){
			$arr[]=$v;
		}
	}
	$arr=$arr[0];
	$p=explode(',',$arr['admin_group_purview']);
	include('template/admin_admingroup_edit.php');
}

//处理修改的管理组
elseif($action=='save_admingroup_edit'){
	if(!check_purview('admin_group')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$admin_group_name = $_POST['admin_group_name'];
	$admin_group_info = $_POST['admin_group_info'];
	$c_all = $_POST['c_all'];
	$is_disable = intval($_POST['is_disable']);
	$q = $_POST['q'];
	$id = intval($_POST['id']);
	if(empty($admin_group_name)||strlen($admin_group_name)<1){
		msg('<span style="color:red">管理员分组名不能为空</span>');
	}
	if(empty($q)&&empty($c_all)){
		msg('<span style="color:red">请选择组所拥有的权限</span>');
	}
	$p_str=empty($q)?'':$q;
	if(is_array($p_str)){
	$p_str=implode(',',$p_str);
	}
	if(!empty($c_all)){
		$p_str='all_purview';
	}
	$sql="update ".DB_PRE."admin_group set admin_group_name='".$admin_group_name."',admin_group_info='".$admin_group_info."',admin_group_purview='".$p_str."',is_disable=".$is_disable." where id=".$id;
	$GLOBALS['mysql']->query($sql);
	$GLOBALS['cache']->cache_admin_group();
	msg('管理分组修改成功','admin_admin.php?action=admin_group&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}

//删除管理组
elseif($action=='admin_group_del'){
	if(!check_purview('admin_group')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$id = intval($_GET['id']);
	
	$GLOBALS['mysql']->query("delete from ".DB_PRE."admin_group where id=".$id);
	$GLOBALS['cache']->cache_admin_group();
	msg('管理分组删除成功','admin_admin.php?action=admin_group&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}

echo PW;
?>
