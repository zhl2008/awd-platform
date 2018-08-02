
<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

/*
*
*cache 缓存类
*/

class cache
{
	function cache(){
		$this->fp='';
		$this->cp='';
		$this->return_copy();
	}
	
	//获取文件指针
	function fp_file($fl){
		if(!$this->fp=@fopen($fl,'w+')){
			die($fl.'文件不能创建,请检查是否有足够的文件操作权限');
		}
	}
	//判断文件是否可操作
	function is_wr($fl){
		if(!is_writable($fl)){
			die('请检查是否有足够的权限操作文件!');
		}
	}
	//判断文件是否存在
	function is_fl($fl){
	    if(!file_exists($fl)){
			die($fl.'文件不存在');
		}
	}
	
	/*
	*替换内容生成文件缓存
	*$fl-文件名,$ps-参数数组,$arr-配置数组，$f-过滤数组,$arr_str-配置数组名
	*return void
	*/
	function cache_inc($fl,$ps,$arr,$f=array(),$arr_str){
		$this->is_fl($fl);
		$this->is_wr($fl);
		//$this->fp_file($fl);
		include($fl);
		foreach($ps as $key=>$val){
			if(in_array($key,$f)){
		    	continue;
	        }
			if(is_array($value)){
		    	$value=intval($value[0]);
	   		}
			$arr_str[$key]=$value;
		}
		$str="<?php\n$arr_str=".var_export($arr_str,true).";\n?>";
		if(file_put_contents($lang_inc,$s)){
			die('网站配置成功');
		}
	}
	
	function cache_category_all(){
		$rel=$GLOBALS['mysql']->fetch_asc("select*from ".DB_PRE."category order by cate_order,id desc");
		$fl=DATA_PATH.'cache_cate/cache_category_all.php';
		$this->fp_file($fl);
		$str="<?php\n\$category=".var_export($rel,'true').";?>";
		flock($this->fp,LOCK_EX);
		if(!fwrite($this->fp,$str)){
			flock($this->fp,LOCK_UN);
			fclose($this->fp);
			return false;
		}
		flock($this->fp,LOCK_UN);
		fclose($this->fp);
		return true;
	}
	
	//栏目缓存
	function category_array($parent=0){
	$rel=$GLOBALS['mysql']->fetch_asc('select id,cate_name,cate_order,lang,cate_parent from '.DB_PRE.'category where cate_parent='.$parent.' order by id desc');
	if(isset($rel)){
	foreach($rel as $key=>$value){
			$rel['p'.$value['id']]=$this->category_array($value['id']);
	}
	}
	return $rel;
     }
	function return_copy(){
		return 'PGRpdiBzdHlsZT0iaGVp'.'Z2h0OjIwcHg7IHRleHQtYWxpZ246Y2VudGVyIj'.
	'5wb3dlcmQgYnkgPGEgaHJlZj0iaHR0cDovL3d3dy5i'.'ZWVzY21zLmNvbSI+QkVFU0NNUzwvYT48L2Rpdj4=';
	}
	//更新顶级栏目下子栏目 
	function cache_category($parent,$lang){
		$rel=$GLOBALS['mysql']->fetch_asc('select * from '.DB_PRE.'category where cate_parent='.$parent.' order by id desc');
		$fl=DATA_PATH.'cache_cate/cache_category'.$parent.'_'.$lang.'.php';
		$this->fp_file($fl);
		$str="<?php\n\$category=".var_export($rel,'true').";?>";
		flock($this->fp,LOCK_EX);
		if(!fwrite($this->fp,$str)){
			flock($this->fp,LOCK_UN);
			fclose($this->fp);
			return false;
		}
		flock($this->fp,LOCK_UN);
		fclose($this->fp);
		return true;
	} 
	//更新顶级栏目
	function cache_category_child($parent=0,$lang){
		$rel=$GLOBALS['mysql']->fetch_asc('select id from '.DB_PRE.'category where cate_parent='.$parent.' order by id desc');
		if(!empty($rel)){
		foreach($rel as $key=>$value){
		$rel_child=$GLOBALS['mysql']->fetch_asc('select * from '.DB_PRE.'category where cate_parent='.$value['id'].' order by id desc');
		if($rel_child!=''){
		$fl=DATA_PATH.'cache_cate/cache_category'.$value['id'].'_'.$lang.'.php';
		$this->fp_file($fl);
		$str="<?php\n\$category=".var_export($rel_child,'true').";?>";
		flock($this->fp,LOCK_EX);
		if(!fwrite($this->fp,$str)){
			flock($this->fp,LOCK_UN);
			fclose($this->fp);
			return false;
		}
		flock($this->fp,LOCK_UN);
		fclose($this->fp);
		$this->cache_category_child($value['id'],$lang);
		}
		}
		}
		return true;
	}
	function mk_folder($folder){
		if(!file_exists($folder)){
			if(!@mkdir($folder)){
				msg('文件夹创建失败，请检查是否有足够的权限');
			}
		}
	}
	//频道缓存
	function channel_cache(){
		$this->mk_folder(DATA_PATH.'cache_channel');
		$fl_path=DATA_PATH.'cache_channel/cache_channel_all.php';
		$arr=$GLOBALS['mysql']->fetch_asc("select*from ".DB_PRE."channel order by channel_order,id desc");

			$this->fp_file($fl_path);
			flock($this->fp,LOCK_EX);
			$str="<?php\n\$channel=".var_export($arr,'true').";\n?>";
			if(!fwrite($this->fp,$str)){
				flock($this->fp,LOCK_UN);
				fclose($this->fp);
				msg('缓存失败，写入文件发生错误,请检查是否有权限写入文件');
			}
			flock($this->fp,LOCK_UN);
			fclose($this->fp);
			return true;
		
	}
	
	//根据频道id缓存顶级栏目
	function cache_channel_cate($id){
		$rel=$GLOBALS['mysql']->fetch_asc("select*from ".DB_PRE."category where cate_channel=".$id." order by id asc");
		$str="<?php\n\$channel_cate=".var_export($rel,'true').";\n?>";
		$fl_path=DATA_PATH."cache_cate/cache_channel".$id."_cate.php";
		$this->fp_file($fl_path);
		flock($this->fp,LOCK_EX);
		if(!fwrite($this->fp,$str)){
			flock($this->fp,LOCK_UN);
			fclose($this->fp);
			msg('缓存失败，写入文件发生错误，请检查是否有权限写入文件');
		}
			flock($this->fp,LOCK_UN);
			fclose($this->fp);
			return true;
	}
	
	//字段缓存
	function cache_fields(){
		$arr=$GLOBALS['mysql']->fetch_asc("select*from ".DB_PRE."auto_fields order by field_order,id desc");
		$fl_path=DATA_PATH."cache_channel/cache_fields.php";

			$this->fp_file($fl_path);
			flock($this->fp,LOCK_EX);
			$str="<?php\n\$field=".var_export($arr,'true').";?>";
			if(!fwrite($this->fp,$str)){
				flock($this->fp,LOCK_UN);
				fclose($this->fp);
				msg('缓存失败，写入文件发生错误，请检查是否有权限写入文件');
			}
			flock($this->fp,LOCK_UN);
			fclose($this->fp);
			return true;
		
	}
	
	//管理员组缓存
	function cache_admin_group(){
		$arr=$GLOBALS['mysql']->fetch_asc("select*from ".DB_PRE."admin_group order by id desc");
		$fl_path=DATA_PATH."cache/cache_admin_group.php";
		$this->fp_file($fl_path);
		flock($this->fp,LOCK_EX);
		$str="<?php\n\$admin_group=".var_export($arr,'true').";?>";
		if(!fwrite($this->fp,$str)){
			flock($this->fp,LOCK_UN);
			fclose($this->fp);
			msg('缓存失败，写入文件发生错误，请检查是否有权限写入文件');
		}
		flock($this->fp,LOCK_UN);
		fclose($this->fp);
		return true;
	}
	
	//会员组缓存
	function cache_member_group(){
		$arr=$GLOBALS['mysql']->fetch_asc("select*from ".DB_PRE."member_group order by id desc");
		$fl_path=DATA_PATH."cache/cache_member_group.php";
		$this->fp_file($fl_path);
		flock($this->fp,LOCK_EX);
		$str="<?php\n\$member_group=".var_export($arr,'true').";?>";
		if(!fwrite($this->fp,$str)){
			flock($this->fp,LOCK_UN);
			fclose($this->fp);
			msg('缓存失败，写入文件发生错误，请检查是否有权限写入文件');
		}
		flock($this->fp,LOCK_UN);
		fclose($this->fp);
		return true;
	}
	
	//缓存
	function cache_all($sql,$fl,$arr_name){
		$arr=$GLOBALS['mysql']->fetch_asc($sql);
		$this->fp_file($fl);
		flock($this->fp,LOCK_EX);
		$str="<?php\n\$".$arr_name."=".var_export($arr).";?>";
		if(!fwrite($this->fp,$str)){
			flock($this->fp,LOCK_UN);
			fclose($this->fp);
			msg('缓存失败，写入文件发生错误，请检查是否有权限写入文件');
		}
		flock($this->fp,LOCK_UN);
		fclose($this->fp);
		return true;
	}
	

}
?>