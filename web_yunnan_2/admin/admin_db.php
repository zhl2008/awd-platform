<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

define('IN_CMS','true');
include('init.php');
$action=isset($_REQUEST['action'])?fl_html(fl_value($_REQUEST['action'])):'backup';
$lang=isset($_REQUEST['lang'])?fl_html(fl_value($_REQUEST['lang'])):get_lang_main();



//备份数据界面
if($action=='backup'){
	if(!check_purview('data_backup')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$rel2=$GLOBALS['mysql']->fetch_asc('SHOW TABLE STATUS FROM '.DB_NAME);
	$rel=array();
	foreach($rel2 as $key=>$value){
	if(substr($value['Name'],0,strlen(DB_PRE))==DB_PRE){
		$rel[]=$value;	
	}
	}
 	include('template/admin_db_backup.php');
}

//处理备份的数据
elseif($action=='save_back'){
	if(!check_purview('data_backup')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$db = $_POST['db'];
	$init = isset($_POST['init'])?$_POST['init']:0;
	$sql_size = 1048;
	$dir = isset($_GET['dir'])?$_GET['dir']:'';
	//缓存所有表
	if($init){
		if(empty($db)){msg('请选择要备份的表');}
		$str="<?php\n\$table_arr=".var_export($db,true).";\n?>";
		$file=DATA_PATH.'cache/db_cache.php';
		creat_inc($file,$str);
		//创建备份目录
		$dir = 'db'.date(YmdHms,time());
		@mkdir(DATA_PATH.'backup/'.$dir);
	}
	@include(DATA_PATH.'cache/db_cache.php');
	$table_id = isset($_GET['table_id'])?$_GET['table_id']-1:0;
	$r_start = isset($_GET['r_start'])?$_GET['r_start']:0;
	$sql = '';
	$start = isset($r_start)?$r_start:0;
	
	for($i=$table_id;$i<count($table_arr)&& strlen($sql)<$sql_size*1000;$i++){
		$table = $table_arr[$i];
		//当前表的备份小于卷大小
		if(strlen($sql) < $sql_size*1000){
			//备份表
			if(!$start){
				$rel=$GLOBALS['mysql']->fetch_asc("SHOW CREATE TABLE `{$table}` ");
				$sql.="DROP TABLE IF EXISTS `".$table."`;\n";
				$sql.=$rel[0]['Create Table'].";\n";
			}
			//备份数据
			$offset=5;
			while(strlen($sql) < $sql_size*1000){
				$record=$GLOBALS['mysql']->fetch_asc("select*from ".$table." limit {$start},{$offset}");
				if(!empty($record)){
					$insert=array();
					foreach($record as $key=>$value){
						foreach($value as $r_k=>$r_v){
							$insert[$r_k]="'".@mysql_escape_string($r_v)."'";
						}
						$sql.="INSERT INTO `".$table."` VALUES(".implode(',',$insert).");\n";
					}
				}
				
				$start+=$offset; 
				$r_start = $start;//该表还有数据放到下一卷
				if(count($record)<$offset){$start=0;break;}	
			}
			
		}
	}
	if($sql){
		//开始分卷
		$page = isset($_GET['page'])?$_GET['page']:1;
		$rand = isset($_GET['rand'])?$_GET['rand']:date(Hms,time());
		$fl_name = 'db_backup_'.date(Ymd,time()).'_'.$rand.'_'.$page.'.sql';
		$backfile=DATA_PATH.'backup/'.$dir.'/'.$fl_name;
		@file_put_contents($backfile,$sql);
		show_htm('文件'.$fl_name.'备份完成','?action=save_back&page='.($page+1).'&r_start='.$r_start.'&table_id='.$i.'&sql_size='.$sql_size.'&rand='.$rand.'&dir='.$dir.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
	}else{
		msg("数据备份完成",'?nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
	}
}

//还原数据界面
elseif($action=='import'){
	if(!check_purview('data_import')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	include('template/admin_db_import.php');
}

//处理还原数据
elseif($action=='save_import'){
	if(!check_purview('data_import')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$fl = $_GET['fl'];
	$time = isset($_GET['time'])?$_GET['time']:'';
	$rand = isset($_GET['rand'])?$_GET['rand']:'';
	$page = isset($_GET['page'])?$_GET['page']:1;
	if(empty($fl)){err('<span style="color:red">参数传递错误,请重新操作</span>');}
	if($time&&$rand&&$page){
		$import_file =DATA_PATH.'backup/'.$fl.'/db_backup_'.$time.'_'.$rand.'_'.$page.'.sql';
		if(@file_exists($import_file))
		{
			$data=@file_get_contents($import_file);
			$data=explode(";\n",trim($data));
			
			if(!empty($data)){
				foreach($data as $k=>$v){
					$GLOBALS['mysql']->query($v);
				}
			}
			
			show_htm('卷'.$page.'导入完成','?action=save_import&fl='.$fl.'&time='.$time.'&rand='.$rand.'&page='.($page+1).'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
		}
		else
		{	
			msg("数据还原成功",'?action=import&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
		}
	}
	else
	{	
		$db_handler=@opendir(DATA_PATH.'backup/'.$fl);
		if($db_handler){
			while(false!==($d_file=readdir($db_handler))){
				if($d_file=='.'||$d_file=='..'){continue;}
				$db_file = $d_file;
			}
		}
		if(!empty($db_file)){
			$arr = explode('_',$db_file);
		}
		show_htm('准备数据恢复','?action=save_import&fl='.$fl.'&time='.$arr[2].'&rand='.$arr[3].'&page=1&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
	}	
}

//删除数据文件
elseif($action=='del'){
	if(!check_purview('data_import')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$fl = $_GET['fl'];
	if(empty($fl)){err('<span style="color:red">参数传递错误,请重新操作</span>');}
	$db_handler=@opendir(DATA_PATH.'backup/'.$fl);
	if($db_handler){
		while(false!==($d_file=readdir($db_handler))){
			@unlink(DATA_PATH.'backup/'.$fl.'/'.$d_file);
		}
	}
	@rmdir(DATA_PATH.'backup/'.$fl);
	msg($fl.'删除成功','?action=import&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}
echo PW;
?>