<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/


/*
*转义函数
*
*@param   $value   array || string
*@return  array || string
*/
function addsl($value)
{
    if (empty($value))
    {
        return $value;
    }
    else
    {	
        return is_array($value) ? array_map('addsl', $value) : addslashes($value);
    }
}


/*
*
*跳转页面操作
*
*/
function go_url($fun){
	if(!function_exists($fun)){
		err('没有相关操作');
	}
	$fun();
}

/*
*
*判断数字
*
*/
function is_num($str){
	if(strlen($str)>0){
	return preg_match('/[\d]/',$str);
	}
}

function check_str($str,$ereg){
	if(empty($str)){
		return false;
	}else{
		return preg_match($ereg,$str);
	}
	
}

/*
*自动返回操作信息
*$url-返回地址    $message-详细信息
*return $string
*/
function msg($message,$url="javascript:window.history.back(-1);",$is_time=1,$break='true',$tpl='template/message.php'){
	$message="<p style=\"font-weight:bold;color:#1566B3\">".$message."</p>";
	$message.="<p>页面将在<span id=\"is_time\"></span>秒后自动返回</p>";
	if(!empty($url)){
		$message.="<p id=\"time_url\"><a href=\"".$url."\">返回上一页</a></p>";
		$message.=($is_time)?"<script type=\"text/javascript\">time_go();</script>":'';
	}
	//$message.="</div></div>";
	include($tpl);
	if($break){
		exit;
	}
}
//错误信息
function err($message,$url="javascript:history.go(-1);",$break='true',$tpl='template/message.php'){
	
	$message="<div style=\"font-size:12px;\"><p>".$message."</p>";
	if(!empty($url)){
		$message.="<p id=\"time_url\"><a href=\"".$url."\" style=\"text-decration:none\">返回</a>";
	}
	$tpl=CMS_PATH.ADMINDIR.'/'.$tpl;
	$message.="</div>";
	die($message);
}
//生成html提示
function show_htm($message,$url="javascript:history.go(-1);",$is_time=1,$break='true',$tpl='template/show_htm.php'){
	$message="<p>".$message."</p>";
	$message.="<p>页面将在<span id=\"is_time\"></span>秒后自动更新,如果没反应点击下面链接</p>";
	if(!empty($url)){
		$message.="<p id=\"time_url\"><a href=\"".$url."\">返回</a>";
		$message.=($is_time)?"<script type=\"text/javascript\">time_go();</script>":'';
	}
	include($tpl);
	if($break){
		exit;
	}
}

function copy_lang($lang){
	if(isset($lang)){
		if(!$fp=@fopen(LANG_PATH.'lang_cn.php','r')){
			msg('基本语言包不能操作，请检查是否有操作文件的权限','javascript:history.go(-1);');
		}
		$fl=fread($fp,filesize(LANG_PATH.'lang_cn.php'));
		unset($fp);
		$fp2=@fopen(LANG_PATH.'lang_'.$lang.'.php','w');
		return fwrite($fp2,$fl);
	}
}
//生成配置文件
function creat_inc($fl,$str){
	if(file_exists($fl)){@unlink($fl);}
	if(!$fp=@fopen($fl,'w')){
		msg('文件打开失败,请检查是否有足够的权限操作文件');
	}
	flock($fp,LOCK_EX);
	if(!fwrite($fp,$str)){
		msg('写入文件失败,请检查是否有足够的权限操作文件');
	}
	flock($fp,LOCK_UN);
	unset($fp);
}

//判断文件可写
function check_dir_write($path){
	if(!file_exists($path)){return false;}
	$file=$path.'write.txt';
	if(!$fp=@fopen($file,'w')){return false;}
	if(!@fwrite($fp,'write')){return false;}
	fclose($fp);
	@unlink($file);
	return true;
}
function image_type($arr){
	return is_array($arr)?array_map('image_type',$arr):'image/'.$arr;
}

function cate_list($parent,$arr){
	if(isset($arr['p'.$parent])){
		echo "<div id=\"catagory\"><p class=\"left\"><span class=\"exp\"></span><input type=\"checkbox\" style=\"\" name=\"sel[]\"/><span class=\"cata\">{$arr['p'.$parent]['cate_name']}</span></p><p class=\"right\"><span class=\"caozuo\"><a href=\"?action=child&parent=11\">增加下级栏目</a>|<a href=\"\">本栏目内容</a>|<a href=\"\">修改</a>|<a href=\"\">移动栏目</a>|<a href=\"\">删除</a></span><input style=\"width:20px;\" name=\"order\" value=\"11\"/></p><div style=\"clear:both\"></div></div>";
		cate_list($arr['p'.$parent]['id'],$arr);	
	}
}

function del_cate_child($parent,$lang){
	$num=$GLOBALS['mysql']->fetch_rows("select id from ".DB_PRE."category where cate_parent=".$parent." and lang='".$lang."'");
	if(!empty($num)){
	msg('请先删除下级栏目');
		/*foreach($num as $key=>$value){
			del_cate_child($value['id'],$lang);
			$GLOBALS['mysql']->query("delete from ".DB_PRE."category where id=".$value['id']." and lang='".$lang."'");
		}*/
	}
		/*if(file_exists(DATA_PATH.'cache_cate/cache_category'.$parent.'_'.$lang.'.php')){
				unlink(DATA_PATH.'cache_cate/cache_category'.$parent.'_'.$lang.'.php');
			}*/

}

function content_fields($id,$v_arr='',$edit='false'){
	if(file_exists(DATA_PATH."cache_channel/cache_fields.php")){
		include(DATA_PATH."cache_channel/cache_fields.php");
	}
	$str="";
	//取出频道下的字段
	if(!empty($field)){
		foreach($field as $key=>$value){
			if($value['is_disable']){continue;}
			$v=$value['field_value'];
			if(!empty($v_arr)){
				$v=isset($v_arr[$value['field_name']])?$v_arr[$value['field_name']]:'';
			}
			if($value['channel_id']==$id){
				if(!in_array($value['field_type'],array('checkbox','radio'))){
				$help=empty($value['info'])?"":"<span title=\"{$value['field_info']}\" class=\"help\">&nbsp;</span>";
				$field_box=($value['field_type']=='select')?$value['field_type']($value['field_name'],$value['field_value'],$v):$value['field_type']($value['field_name'],$v);
				$str.="<tr><td class=\"w1\" style=\"width:20%;text-align:center\">{$help}{$value['use_name']}:</td><td style=\"width:80%\">".$field_box."</td></tr>";
				}else{
				if($edit=='false'){$v='';}
				$str.="<tr><td class=\"w1\" style=\"width:20%\"><span title=\"{$value['field_info']}\" class=\"help\"></span>{$value['use_name']}:</td><td style=\"width:80%\">".$value['field_type']($value['field_name'],$value['field_value'],$v)."</td></tr>";
				}
			}
		}
	}
	return $str;
}


//表单
function form_fields($id,$path='',$edit='false'){
	if(file_exists(DATA_PATH."cache_form/field.php")){
		include(DATA_PATH."cache_form/field.php");
	}
	if(file_exists(DATA_PATH."cache_form/form.php")){
		include(DATA_PATH."cache_form/form.php");
	}
	if(!empty($form)){
	foreach($form as $k=>$v){
		if($v['id']==$id){
			if($v['is_disable']){return;}
		$form=$v;break;
		}
	}
	}
	global $content,$cat_id,$pr_id,$lang;
	$str='';
	$f_id=empty($content['id'])?$cat_id:$content['id'];
	unset($content);
	if(!empty($field)){
	//获取提交的页面
	if(!empty($pr_id)){
		$arc_rel=$GLOBALS['mysql']->fetch_asc("select title from ".DB_PRE."maintb where id=".$pr_id);
		$arc_title=$arc_rel[0]['title'];
	}
	if($arc_title){$f_id=$pr_id;}
	$js='';
	$opt='';
		foreach($field as $key=>$value){
			$v=$value['field_value'];
			if(!empty($v_arr)){
				$v=$v_arr[$value['field_name']];
			}
			
			if($value['form_id']==$id){
				$note='';
				if(!$value['is_empty']){
				if($value['field_type']=='text'||$value['field_type']=='textarea'){
					$note="<span style=\"color:red\">*</span>";
					$js.="if(document.getElementById('".$value['field_name']."').value==''){alert('".$value['use_name']."不能为空');return false;}";
				}
				}
				if(!in_array($value['field_type'],array('checkbox','radio'))){
				$help=empty($value['info'])?"":"<span title=\"{$value['field_info']}\" class=\"help\"></span>";
				$opt.="<tr><td class=\"w1\" id=\"w30\">{$help}{$value['use_name']}:</td></tr><tr><td id=\"w70\">".$value['field_type']($value['field_name'],$v,1)."{$note}</td></tr>";
				}else{
				if($edit=='false'){$v='';}
				$opt.="<tr><td class=\"w1\" id=\"w30\"><span title=\"{$value['field_info']}\" class=\"help\"></span>{$value['use_name']}:</td></tr><tr><td id=\"w70\">".$value['field_type']($value['field_name'],$value['field_value'],$v)."{$note}</td></tr>";
				}
			}
		}
	$str.="<script type=\"text/javascript\">function check_form(){";
	$str.=$js;
	$str.="}</script>";
	$str.="<form action=\"{$path}mx_form/order_save.php\" class=\"order_form\" name=\"form_form\" method=\"post\" onsubmit=\"return check_form();\">";
	$str.="<input type=\"hidden\" name=\"form_id\" value=\"{$id}\"/>";
	$str.="<p>{$form['form_name']}</p>";
	$str.="<table width=\"100%\" border=\"0\" ceillpadding=\"0\" ceillspacing=\"0\">";
	if($arc_title){	
		//$str.="<tr><td id=\"w30\" class=\"w1\">产品（职位）：</td><td id=\"w70\">{$arc_title}</td></tr>";
	}
	$str.=$opt;	
	$str.="<tr><td id=\"w30\" class=\"w1\">".$GLOBALS['language']['code']."</td></tr><tr><td id=\"w70\" style=\"text-align:left\"><input name=\"feed_code\" value=\"\" style=\"width:100px; height:25px; line-height:25px; display:block; float:left; margin-right:3px; display:inline\"/><img src=\"".CMS_SELF."includes/code.php\" name=\"code\" border=\"0\" id=\"form_code\" style=\"display:block; float:left; cursor:pointer\"/>&nbsp;<em id=\"refresh_code\">".$GLOBALS['language']['code_info']."</em></td></tr>";
	$str.="<tr><td id=\"w70\" class=\"w_go\"><input type=\"hidden\" value=\"{$lang}\" name=\"lang\"/><input type=\"hidden\" value=\"{$f_id}\" name=\"f_id\"/><input type=\"submit\" name=\"submit\" class=\"pt_go\" value=\"提交\"/><input type=\"reset\" name=\"reset\" class=\"pt_reset\" value=\"重置\"/></td></tr>";
	$str.="<script type=\"text/javascript\">
$(document).ready(function(){
	$('#refresh_code').click(function(){
	$('#form_code').attr('src','".CMS_SELF."includes/code.php?tag='+new Date().getTime());
	});
});
</script>";
	$str.="</table></form>";
	}
	return $str;
}

function text($f_name,$f_value,$style=0){
	$s=($style)?'':"style=\"width:50%\"";
	$str="<input name=fields[{$f_name}] id=\"{$f_name}\" {$s} value=\"{$f_value}\" />";
	return $str;
}
function textarea($f_name,$f_value,$style=0){
	$s=($style)?'':"style=\"width:50%; height:50px;\"";
	$str="<textarea name=\"fields[{$f_name}]\" id=\"{$f_name}\" {$s}>{$f_value}</textarea>";
	return $str;
}
function html($f_name,$f_value){

	$str=$GLOBALS['CKEditor']->editor("fields[".$f_name."]", $f_value,$GLOBALS['fck_config']);
	 return $str;

}

//单图上传
function upload_pic($f_name,$f_value){
		$pic_str=empty($f_value)?'../upload/no_pc.gif':'../upload/'.$f_value;
		$str='<input name="fields['.$f_name.']" value="'.$f_value.'" style="width:30%; display:block; float:left; margin-top:55px;" id="'.$f_name.'" />
		  <p style="margin-top:55px;" class="admin_up_pic"><a href="admin_pic_upload.php?type=radio&get='.$f_name.'" id="pic_'.$f_name.'">选择图片</a></p><span id="show_'.$f_name.'" class="admin_show_pic"><img src="'.$pic_str.'"  height="120" width="120"/></span><script type="text/javascript">$(\'#pic_'.$f_name.'\').wBox({title:\'附件\',requestType: "iframe",target:$(\'#pic_'.$f_name.'\').attr(\'href\'),iframeWH:{width:800,height:400}});</script>';
	return $str;
}
//多图上传
function upload_pic_more($f_name,$f_value){
    $pic="";
	$str="";
	if(!empty($f_value)){$value=explode(',',$f_value);$n=count($value);}
	if(!empty($value)){
	$i=0;
	foreach($value as $k=>$v){
	if(empty($v)){continue;}
	if($n==$i){break;}
	$pic_rel=$GLOBALS['mysql']->fetch_asc("select * from ".DB_PRE."uppics where id=".$v);
	$pic_path=$pic_rel[0]['pic_path'].$pic_rel[0]['pic_name'].'.'.$pic_rel[0]['pic_ext'];
	$pic.="<input type=\"hidden\" name=\"fields[{$f_name}][]\" value=\"\"/><li id=\"pic_{$pic_rel[0]['id']}\"><a href=\"../".$pic_path."\" target=\"_blank\"><img src=\"../".$pic_path."\" border=\"0\" height=\"120\" width=\"120\"/><input type=\"hidden\" name=\"fields[{$f_name}][]\" value=\"".$v."\"/></a><p><input type=\"text\" style=\"width:100px;\" name=\"alt\" id=\"alt\" value=\"".$pic_rel[0]['pic_alt']."\"/><img src=\"template/images/c_alt.gif\" style=\"border:0;cursor:point;\" onclick=\"change_alt(this,'".$v."')\" border=\"0\"/></p><span onclick=\"javascript:del_pic('".$v."',this);\">删除</span></li>";
	$i=$i+1;
	}
	}
	
		$str='<div class="lang_sl_btn"><a href="admin_pic_upload.php?type=checkbox&get='.$f_name.'&lang='.$GLOBALS['lang'].'&keepThis=true&TB_iframe=true&height=400&width=800" id="more_pic'.$f_name.'">选择或上传产品图片</a></div><script type="text/javascript">$(\'#more_pic'.$f_name.'\').wBox({title:\'缩略图\',requestType: "iframe",target:$(\'#more_pic'.$f_name.'\').attr(\'href\'),iframeWH:{width:800,height:400}});</script>';
		$str.="<ul class=\"m_show_pic\" id=\"show_pic".$f_name."\">{$pic}</ul>";
	return $str;
}
function upload_file($f_name,$f_value){
	$str="<input name=\"fields[{$f_name}]\" value=\"{$f_value}\" style=\"width:30%;margin-right:8px;\" id=\"{$f_name}\"/><span id=\"{$f_name}_size\" style=\"color:red\"></span>";
		$str.='<span class="lang_sl_btn"><a id="upload_file_'.$f_name.'" href="admin_file_upload.php?get='.$f_name.'&lang='.$GLOBALS['lang'].'">选择或上传文件</a></span><script type="text/javascript">$(\'#upload_file_'.$f_name.'\').wBox({title:\'附件\',requestType: "iframe",target:$(\'#upload_file_'.$f_name.'\').attr(\'href\'),iframeWH:{width:800,height:400}});</script>';
	return $str;
}
function select($f_name,$f_value,$e_value=""){
	if(!empty($f_value)){
		$value=preg_split('/\n/',$f_value);
	
	$str="<select id=\"{$f_name}\" name=\"fields[{$f_name}]\">";
	foreach($value as $key=>$val){
		$ck='';
		if($e_value==$val){$ck="selected=\"selected\"";}
		$str.="<option value=\"{$val}\" {$ck}>{$val}</option>";
	}
	$str.="</select>";
	}
	return $str;
}
function radio($f_name,$f_value,$e_value=""){
	$str='';
	if(!empty($f_value)){
		$value=preg_split('/\n/',$f_value);
	foreach($value as $key=>$val){
		$ck="";
		if($key==0){$ck="checked=\"checked\"";}
		if($e_value==$val){$ck="checked=\"checked\"";}
		$str.="<input type=\"radio\" value=\"{$val}\" name=\"fields[{$f_name}]\" {$ck} style=\"margin:0 5px;border:0\"/>{$val}";
	}
	}
	return $str;
}
/*
*$f_name-字段名,$f_value-字段默认值,$e_value-字段填写值,修改的时候使用
*/
function checkbox($f_name,$f_value,$e_value=","){
	if(!empty($f_value)){
		$value=preg_split('/\n/',$f_value);
		$e=preg_split('/\n/',$e_value);
	foreach($value as $key=>$val){
		$ck="";
		if(in_array($val,$e)){$ck="checked=\"checked\"";}
		$str.="<input type=\"checkbox\" value=\"{$val}\" name=\"fields[{$f_name}][]\" {$ck} style=\"margin:0 5px;border:0\"/>{$val}";
	}
	}
	return $str;
}
//生成频道列表
function get_channel_list($id=''){
	global $channel;
	$str="<select id=\"channel\" name=\"cate_channel\">";
		if(!empty($channel)){
		foreach($channel as $key=>$value){
			if($value['is_disable']){continue;}
			if(empty($id)){
			$ck=($value['channel_mark']=='article')?"selected=\"selected\"":"";
			}else{
			$ck=($value['id']==$id)?"selected=\"selected\"":"";
			}
			$str.="<option title=\"{$value['channel_mark']}\" value=\"{$value['id']}\" {$ck}>{$value['channel_name']}</option>";
		}
		}

	$str.="</select>";
	return $str;
}
/*
*修改栏目模型名称
*/
function cate_xg_channel($id=''){
	global $channel;
	if(!empty($channel)){
		foreach($channel as $key=>$value){
			if($value['id']==$id){
				echo $value['channel_name'].'<input type="hidden" value="'.$value['id'].'" name="cate_channel"/>';
			}
		}
	}	
}

//生成栏目列表
function get_catelist($channel_id,$lang){
	$fl_path=DATA_PATH."cache_cate/cache_category".$channel_id."_".$lang.".php";
	$str="<select name=\"category\"><option value=\"\">请选择栏目</option>";
	if(file_exists($fl_path)){
		include($fl_path);
		if(!empty($fl_path)){
		foreach($category as $key=>$value){
			if($value['cate_tpl']==2){
				continue;
			}
			if($value['cate_tpl']==1){
				$str.="<option value=\"index\">{$value['cate_name']}(频道页,不可发布内容)</option>";
			}
			$str.="<option value=\"{$value['id']}\">{$value['cate_name']}</option>";
		}
		}
	}
	$str.="</select>";
	return $str;
}

//缓存频道栏目
function cache_channel_category($lang){
	$fl_path=DATA_PATH."cache_channel/cache_channel_".$lang.".php";
	if(file_exists($fl_path)){
	include($fl_path);
	if(!empty($channel)){
		foreach($channel as $key=>$value){
			$GLOBALS['cache']->cache_channel_cate($value['id']);
		}
	}
	}
}

//发布内容栏目列表
function get_post_catelist($lang,$channel,$cate_id=''){
	$file=DATA_PATH."cache_cate/cate_list_".$lang.".php";
	if(file_exists($file)){
		include($file);
	}
	//过滤频道下顶级栏目
	if(!empty($cate_list)){
		foreach($cate_list as $k=>$v){
			//if($v['cate_channel']==$channel){
				$cate[]=$v;
			//}
		}
	}
	
	//取出栏目
	if(!empty($cate)){
		foreach($cate as $k=>$v){
		//if($v['cate_tpl']=='2'){continue;}
		//if(in_array($v['cate_name'],$filt)){continue;}
		
		if($v['cate_parent']==0){
		$ck=($cate_id==$v['id'])?"selected=\"selected\"":"";
		if($v['cate_channel']==$channel){
			echo "<option ";
			if($v['cate_tpl']==1){
				echo "value=\"index\">{$v['cate_name']}(不能发布内容)";
			}elseif($v['cate_hide']){
				echo "value=\"{$v['id']}\" {$ck}>{$v['cate_name']}(隐藏栏目不会显示)";
			}else{
				echo "value=\"{$v['id']}\" {$ck}>{$v['cate_name']}";
				echo "</option>";
			}
		}	
			//unset($cate[$k]);
			get_post_catechild($cate,$v['haschild'],$v['id'],$level=0,$cate_id,$channel);
		}
		}
		//return $str;
	}
	
}

//发布栏目子栏目
function get_post_catechild($cate,$has_child,$parent,$level,$cate_id,$channel){
	if($has_child){
	$level=$level+1;
		if(!empty($cate)){
			foreach($cate as $k=>$v){
			if($v['cate_tpl']=='2'){continue;}
			$level_str=post_level($level);
			$cate_name=$level_str.$v['cate_name'];
			if($v['cate_parent']==$parent){
			$ck=($cate_id==$v['id'])?"selected=\"selected\"":"";
				if($v['cate_channel']==$channel){
				echo"<option ";
				
				if($v['cate_tpl']==1){
					echo "value=\"index\">{$cate_name}(频道栏目,不能发布内容)";
				}elseif($v['cate_hide']){
					echo "value=\"{$v['id']}\" {$ck}>{$cate_name}(隐藏栏目不会显示)";
				}else{
					echo "value=\"{$v['id']}\" {$ck}>{$cate_name}";	
				}
				echo "</option>";
				}
				//unset($GLOBALS['cate'][$k]);
				get_post_catechild($cate,$v['haschild'],$v['id'],$level,$cate_id,$channel);
			}
			}
		}
		
	}

}

function post_level($level){
	$str="——";
	for($i=0;$i<$level;$i++){
		$str.="——";
	}
	//$str=$str.'——';
	return $str;
}

function show_child_catelist($parent,$space,$channel,$cate_id){
	$fl_path=DATA_PATH."cache_cate/cache_category".$parent."_cn.php";
	if(file_exists($fl_path)){
		include($fl_path);
		if(!empty($category)){
		foreach($category as $ke=>$value){
			if($value['cate_channel']==$channel){
				if($value['cate_tpl']==1){
					$str.="<option value=\"index\">{$space}{$value['cate_name']}(频道栏目,不能发布内容)</option>";
				}elseif($value['cate_tpl']==0){
				if($cate_id==$value['id']){$ck="selected=\"selected\"";}
					$str.="<option value=\"{$value['id']}\" {$ck}>{$space}{$value['cate_name']}</option>";
				}else{
					continue;
				}
			$str.=show_child_catelist($value['id'],"&nbsp;".$space,$channel);
			}
		}
		}
	}
	return $str;
}

function show_catelist($channel,$cate_id=''){
	$fl_path=DATA_PATH."cache_cate/cache_channel".$channel."_cate.php";
	if(file_exists($fl_path)){
		include($fl_path);
		if(!empty($channel_cate)){
		foreach($channel_cate as $key=>$value){
		$arr[]=$value['id'];
		if(in_array($value['cate_parent'],$arr)){continue;}
		
			if($value['cate_tpl']==1){
				$str.="<option value=\"index\">{$value['cate_name']}(频道栏目,不能发布内容)</option>";
			}elseif($value['cate_tpl']==0){
				if($cate_id==$value['id']){$ck="selected=\"selected\"";}
				$str.="<option value=\"{$value['id']}\" {$ck}>{$value['cate_name']}</option>";
			}else{
				continue;
			}
			$space="└─";
			$str.=show_child_catelist($value['id'],"&nbsp;".$space,$channel,$cate_id);
		}
		}
	}
	return $str;
}

/*
*上传图片
*$url=远程图片,$file-上传文件,$size-允许大小,$type-上传文件类型,$thumb-缩略图,$thumb_width-缩略图宽度,$mark-水印,$mark_type-水印类型,$mark_file-水印图片或文字,$mark_width-水印宽度,$mark_height-水印高度
*return $arr-原始图和缩略图
*/
function up_img($file,$size,$type,$thumb=0,$thumb_width='',$thumb_height='',$logo=1,$pic_alt=''){
		if(file_exists(DATA_PATH.'sys_info.php')){include(DATA_PATH.'sys_info.php');}
		if(is_uploaded_file($file['tmp_name'])){
		if($file['size']>$size){
			msg('图片超过'.$size.'大小');
		}
		$pic_name=pathinfo($file['name']);//图片信息
		
		$file_type=$file['type'];
		if(!in_array(strtolower($file_type),$type)){
			msg('上传图片格式不正确');
		}
		$path_name="upload/img/";
		$path=CMS_PATH.$path_name;
		if(!file_exists($path)){
			@mkdir($path);
		}
		$up_file_name=empty($pic_alt)?date('YmdHis').rand(1,10000):$pic_alt;
		$up_file_name2=iconv('UTF-8','GBK',$up_file_name);
		$file_name=$path.$up_file_name2.'.'.$pic_name['extension'];
		
		if(file_exists($file_name)){
			msg('已经存在该图片，请更改图片名称！');//判断是否重名
		}
		
		$return_name['up_pic_size']=$file['size'];//上传图片大小
		$return_name['up_pic_ext']=$pic_name['extension'];//上传文件扩展名
		$return_name['up_pic_name']=$up_file_name;//上传图片名
		$return_name['up_pic_path']=$path_name;//上传图片路径
		$return_name['up_pic_time']=time();//上传时间
		unset($pic_name);
		//开始上传
		if(!move_uploaded_file($file['tmp_name'],$file_name)){
			msg('图片上传失败','',0);
		}
		$file_info=@getimagesize($file_name);
			switch($file_info[2]){
 			case 1:
 			$php_file=@imagecreatefromgif($file_name);
 			break;
 			case 2:
 			$php_file=@imagecreatefromjpeg($file_name);
 			break;
 			case 3:
 			$php_file=@imagecreatefrompng($file_name);
 			break;
 			}
	    //生成水印
		if($_sys['image_is'][0]&&$logo){		
			//文字
			if(!$_sys['image_type'][0]){
				$mark_img=$php_file;
				$t_color=empty($_sys['image_text_color'])?array("255","255","255"):explode(',',$_sys['image_text_color']);
				$text_color=imagecolorallocate($php_file,$t_color[0],$t_color[1],$t_color[2]);
				$text_content=empty($_sys['image_text'])?'BEESCMS':$_sys['image_text'];
				$text_size=empty($_sys['image_text_size'])?"12":$_sys['image_text_size'];
				$font=DATA_PATH."font/arial.ttf";
				$text_arr=@imagettfbbox($text_size,0,$font,$text_content);
        		$text_width=max($text_arr[2],$text_arr[4])-min($text_arr[0],$text_arr[6]);
       		 	$text_height=max($text_arr[1],$text_arr[3])-min($text_arr[5],$text_arr[7]);
				switch($_sys['image_position'][0]){
				case '1':
				$position=array("5","5");
				break;
				case '2':
				$position=array(($file_info[0]-$text_width)/2,"5");
				break;
				case '3':
				$position=array($file_info[0]-$text_width-5,"5");
				break;
				case '4':
				$position=array("5",($file_info[1]-$text_height)/2);
				break;
				case '5':
				$position=array(($file_info[0]-$text_width)/2,($file_info[1]-$text_height)/2);
				break;
				case 6:
				$position=array($file_info[0]-$text_width-5,($file_info[1]-$text_height)/2);
				break;
				case 7:
				$position=array("3",$file_info[1]-$text_height-5);
				break;
				case 8:
				$position=array(($file_info[0]-$text_width)/2,$file_info[1]-$text_height-5);
				break;
				case 9:
				$position=array($file_info[0]-$text_width-10,$file_info[1]-$text_height-10);
				break;
				}
				@imagettftext($mark_img,$text_size,0,($position[0]+$text_size),($position[1]+$text_size),$text_color,$font,$text_content);
				switch($file_info[2]){
				case 1:
				@imagegif($mark_img,$file_name);
				break;
				case 2:
				@imagejpeg($mark_img,$file_name);
				break;
				case 3:
				@imagepng($mark_img,$file_name);
				break;
				}
			}
			//图片
			if($_sys['image_type'][0]){
				$logo=CMS_PATH.'upload/'.$_sys['pic'];
				$logo_info=@getimagesize($logo);
				switch($logo_info[2]){
 				case 1:
 				$logo_file=@imagecreatefromgif($logo);
 				break;
 				case 2:
 				$logo_file=@imagecreatefromjpeg($logo);
 				break;
 				case 3:
 				$logo_file=@imagecreatefrompng($logo);
 				break;
 				}
				switch($_sys['image_position'][0]){
				case '1':
				$position=array("5","5");
				break;
				case '2':
				$position=array(($file_info[0]-$logo_info[0])/2,"5");
				break;
				case '3':
				$position=array($file_info[0]-$logo_info[0]-5,"5");
				break;
				case '4':
				$position=array("5",($file_info[1]-$logo_info[1])/2);
				break;
				case '5':
				$position=array(($file_info[0]-$logo_info[0])/2,($file_info[1]-$logo_info[1])/2);
				break;
				case 6:
				$position=array($file_info[0]-$logo_info[0]-5,($file_info[1]-$logo_info[1])/2);
				break;
				case 7:
				$position=array("3",$file_info[1]-$logo_info[1]-5);
				break;
				case 8:
				$position=array(($file_info[0]-$logo_info[0])/2,$file_info[1]-$logo_info[1]-5);
				break;
				case 9:
				$position=array($file_info[0]-$logo_info[0]-10,$file_info[1]-$logo_info[1]-10);
				break;
				}
				$logo_img=$php_file;
				@imagecopy($logo_img,$logo_file,$position[0],$position[1],0,0,$logo_info[0],$logo_info[1]);
				switch($file_info[2]){
				case 1:
				@imagegif($logo_img,$file_name);
				break;
				case 2:
				@imagejpeg($logo_img,$file_name);
				break;
				case 3:
				@imagepng($logo_img,$file_name);
				break;
				}
				
			}
		}
		//生成缩略图
		if($thumb){
			$up_file_name = $up_file_name2;
			$new_img=@imagecreatetruecolor($thumb_width,$thumb_height);
			$src_img=$php_file;
			@imagecopyresized($new_img,$src_img,0,0,0,0,$thumb_width,$thumb_height,$file_info[0],$file_info[1]);
			switch($file_info[2]){
			case 1:
			@imagegif($new_img,$path.$up_file_name.'_thumb.gif');
			$return_name['thumb']=str_replace(CMS_PATH."upload/","",$path.$up_file_name.'_thumb.gif');
			break;
			case 2:
			@imagejpeg($new_img,$path.$up_file_name.'_thumb.jpeg');
			$return_name['thumb']=str_replace(CMS_PATH."upload/","",$path.$up_file_name.'_thumb.jpeg');
			break;
			case 3:
			@imagepng($new_img,$path.$up_file_name.'_thumb.png');
			$return_name['thumb']=str_replace(CMS_PATH."upload/","",$path.$up_file_name.'_thumb.png');
			break;
			}
		}
		$return_name['pic']=str_replace(CMS_PATH."upload/","",$file_name);
		
		}
	return $return_name;
}

function up_file($file,$size,$type,$path='',$name=''){
		$return_arr=array();
		if(is_uploaded_file($file['tmp_name'])){
		if($file['size']>$size){msg('文件超过'.$size.'大小');}
		$pic_name=pathinfo($file['name']);
		$file_type=$pic_name['extension'];
		$return_arr['ext'] = $pic_name['extension'];//扩展名
		$return_arr['size'] = $file['size'];//大小
		if(!in_array($file_type,$type)){msg('上传文件格式不正确'.$file_type);}
		$path=empty($path)?CMS_PATH."upload/file/":CMS_PATH.$path.'/';
		if(!file_exists($path)){
			@mkdir($path);
		}
		$name=$pic_name['filename'].'-'.date('YmdHis');
		$name2=iconv('UTF-8','GBK',$name);

		$file_name=$path.$name2.'.'.$pic_name['extension'];
		$file_name2=$path.$name.'.'.$pic_name['extension'];
		
		if(file_exists($file_name)){
			msg('已经存在该附件，请更改附件名称！');//判断是否重名
		}
		
		unset($pic_name);
		if(!move_uploaded_file($file['tmp_name'],$file_name)){
			msg('文件上传失败');
		}
		$return_name=str_replace(CMS_PATH,"",$file_name2);
		//$return_name=CMS_SELF.$return_name;
		$return_arr['file'] = $return_name;//上传文件路径
		$return_arr['time'] = time();//上传时间
		}else{
			msg('文件不能为空');
		}
		//存储相关信息
		
	return $return_arr;
}

//缩略图
function pic_thumb($file_name,$thumb_width,$thumb_height,$path=''){
if(empty($file_name)&&empty($thumb_width)&&$thumb_height){return;}
if(empty($thumb_width)||empty($thumb_height)){return;}
$new_img=imagecreatetruecolor($thumb_width,$thumb_height);
			$file_info=getimagesize($file_name);
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
			case 15:
			$php_file=imagecreatefromwbmp($file_name);
			break;
			default:
			return;
 			}
			$src_img=$php_file;
			imagecopyresized($new_img,$src_img,0,0,0,0,$thumb_width,$thumb_height,$file_info[0],$file_info[1]);
			$th_path=$path.date('YmdHis');
			switch($file_info[2]){
			case 1:
			$thumb=$th_path.'_thumb.gif';
			imagegif($new_img,$thumb);
			return $thumb=str_replace("../upload/","",$thumb);
			break;
			case 2:
			$thumb=$th_path.'_thumb.jpeg';
			imagejpeg($new_img,$thumb);
			return $thumb=str_replace("../upload/","",$thumb);
			break;
			case 3:
			$thumb=$th_path.'_thumb.png';
			imagepng($new_img,$thumb);
			return $thumb=str_replace("../upload/","",$thumb);
			break;
			case 15:
			$thumb=$th_path.'_thumb.png';
			imagewbmp($new_img,$thumb);
			return $thumb=str_replace("../upload/","",$thumb);
			break;
			}
}


function get_cate($id){
	$rel="<span style=\"color:red\">未知错误,栏目已经被删除</span>";
	if($GLOBALS['mysql']->fetch_rows("select id from ".DB_PRE."category where id=".$id)){
	$rel=$GLOBALS['mysql']->get_row("select cate_name from ".DB_PRE."category where id=".$id);
	}
	return $rel;
}

//列表页分页函数
function page($url='',$page,$query='',$totalnum,$totalpages,$cate_id='',$ishtml=0){
	global $language,$_confing,$php_file_copy,$channel_info,$category;
	$str="";
	$op="";
	$pre_page=($page-1<0)?1:($page-1);
	$next_page=($page+1>$totalpages)?$totalpages:($page+1);
	$page_count=7;
    $offset = 3;//页码个数左右偏移量
	$url=empty($url)?$channel_info['channel_mark']:$url;//搜索页名称
	if($_confing['web_rewrite']&&!$ishtml){
		//静态分页
		
		$cate_info=get_cate_info($cate_id,$category);
		
		$str.=($page>1)?'<a href="'.CMS_URL.$url.'-'.$cate_id.'.html">'.$language['pagehome'].'</a>':'<span class="off">'.$language['pagehome'].'</span>';
		if($page>1){
			
			if(($page-1)==1){
				$str.='<a class="p" href="'.CMS_URL.$url.'-'.$cate_id.'.html">'.$language['pagapre'].'</a>';
			}else{
				$str.='<a class="p" href="'.CMS_URL.$url.'-'.$cate_id.'-p'.$pre_page.'.html">'.$language['pagapre'].'</a>';
			}
		}else{
			$str.='<span class="off">'.$language['pagapre'].'</span>';
		}
		
		
		if($totalpages>$page_count){
			if($page<=$offset){
				$page_star=1;
				$page_end=$page_count;
			}else{
				if($page+$offset>=$totalpages+1){
					$page_star=$totalpages-$page_count+1;
					$page_end=$totalpages;
				}else{
					$page_star=$page-$offset;
					$page_end=$page+$offset;
				}
			}
		}else{
			$page_star=1;
			$page_end=$totalpages;
		}
		
		for($i=$page_star;$i<=$page_end;$i++){
			$class=($page==$i)?"focus":"";
			if($i==$page_star&&$i!=1){$str.='...';}
			if($i==1){
				$str.='<a class="'.$class.'" href="'.CMS_URL.$url.'-'.$cate_id.'.html">1</a>';
			}else{
				$str.='<a class="'.$class.'" href="'.CMS_URL.$url.'-'.$cate_id.'-p'.$i.'.html">'.$i.'</a>';
			}
			if($i==$page_end&&$i!=$totalpages){$str.='...';}
		}
		
		for($i=1;$i<=$totalpages;$i++){
			$op.=($i==1)?"<option value=\"".$url.'-'.$cate_id.".html\" {$sel}>{$i}</option>":"<option value=\"".$url.'-'.$cate_id."-p{$i}.html\" {$sel}>{$i}</option>";
		}
		
		if($page<$totalpages){
			$str.='<a class="p" href="'.CMS_URL.$url.'-'.$cate_id.'-p'.$next_page.'.html">'.$language['pagenext'].'</a>';
		}else{
			$str.='<span class="off">'.$language['pagenext'].'</span>';
		}
		$str.=($page<$totalpages)?'<a href="'.CMS_URL.$url.'-'.$cate_id.'-p'.$totalpages.'.html">'.$language['pageend'].'</a>':'<span class="off">'.$language['pageend'].'</span>';
		$str.="<span>{$language['pagego']}<select style=\"width:40px;\" onchange=\"location.href=this.options[this.selectedIndex].value;\">".$op."</select></span>";
		$str.="<span>{$language['pages']}{$totalnum}{$language['pagesize']},{$language['page']}{$page}/{$totalpages}</span>";
	}else{
		$url=$url.'.php';
		//动态分页
		$str.=($page>1)?'<a class="p" href="'.$url.'?page=1'.$query.'">'.$language['pagehome'].'</a>':'<span class="off">'.$language['pagehome'].'</span>';
		$str.=($page>1)?'<a class="p" href="'.$url.'?page='.$pre_page.$query.'">'.$language['pagapre'].'</a>':'<span class="off">'.$language['pagapre'].'</span>';
		
		if($totalpages>$page_count){
			if($page<=$offset){
				$page_star=1;
				$page_end=$page_count;
			}else{
				if($page+$offset>=$totalpages+1){
					$page_star=$totalpages-$page_count+1;
					$page_end=$totalpages;
				}else{
					$page_star=$page-$offset;
					$page_end=$page+$offset;
				}
			}
		}else{
			$page_star=1;
			$page_end=$totalpages;
		}
			
		
		for($i=$page_star;$i<=$page_end;$i++){
			$class=($page==$i)?"focus":"";
			if($i==$page_star&&$i!=1){$str.='...';}
			$str.='<a class="'.$class.'" href="'.$url.'?page='.$i.$query.'">'.$i.'</a>';
			if($i==$page_end&&$i!=$totalpages){$str.='...';}
		}
		
		for($i=1;$i<=$totalpages;$i++){
			$op.="<option value=\"?page={$i}{$query}\" {$sel}>{$i}</option>";
		}
		
		$str.=($page<$totalpages)?'<a class="p" href="'.$url.'?page='.$next_page.$query.'">'.$language['pagenext'].'</a>':'<span class="off">'.$language['pagenext'].'</span>';
		$str.=($page<$totalpages)?'<a class="p" href="'.$url.'?page='.$totalpages.$query.'">'.$language['pageend'].'</a>':'<span class="off">'.$language['pageend'].'</span>';
		$str.="<span>{$language['pagego']}<select style=\"width:40px;\" onchange=\"location.href=this.options[this.selectedIndex].value;\">".$op."</select></span>";
		$str.="<span>{$language['pages']}{$totalnum}{$language['pagesize']},{$language['page']}{$page}/{$totalpages}</span>";
	}
	return $str;
}

function check_login($user,$password){
	$rel=$GLOBALS['mysql']->fetch_asc("select id,admin_name,admin_password,admin_purview,is_disable from ".DB_PRE."admin where admin_name='".$user."' limit 0,1");	
	$rel=empty($rel)?'':$rel[0];
	if(empty($rel)){
		msg('不存在该管理用户','login.php');
	}
	$password=md5($password);
	if($password!=$rel['admin_password']){
		msg("输入的密码不正确");
	}
	if($rel['is_disable']){
		msg('该账号已经被锁定,无法登陆');
	}
	
	$_SESSION['admin']=$rel['admin_name'];
	$_SESSION['admin_purview']=$rel['admin_purview'];
	$_SESSION['admin_id']=$rel['id'];
	$_SESSION['admin_time']=time();
	$_SESSION['login_in']=1;
	$_SESSION['login_time']=time();
	$ip=fl_value(get_ip());
	$ip=fl_html($ip);
	$_SESSION['admin_ip']=$ip;
	unset($rel);
	header("location:admin.php");
}

function is_login(){
	if($_SESSION['login_in']==1&&$_SESSION['admin']){
		if(time()-$_SESSION['login_time']>3600){
			login_out();
		}else{
			$_SESSION['login_time']=time();
			@session_regenerate_id();
		}
		return 1;
	}else{
		$_SESSION['admin']='';
		$_SESSION['admin_purview']='';
		$_SESSION['admin_id']='';
		$_SESSION['admin_time']='';
		$_SESSION['login_in']='';
		$_SESSION['login_time']='';
		$_SESSION['admin_ip']='';
		return 0;
	}

}

function login_out(){
	$_SESSION['admin']='';
	$_SESSION['login_in']=0;
	$_SESSION['purview']='';
	if(!empty($_SESSION['admin_ip'])&&!empty($_SESSION['admin_time'])&&!empty($_SESSION['admin_id'])){
	$GLOBALS['mysql']->query("update ".DB_PRE."admin set admin_ip='".$_SESSION['admin_ip']."',admin_time='".$_SESSION['admin_time']."' where id=".$_SESSION['admin_id']);
	}
	$_SESSION['login_time']='';
	$_SESSION['admin_time']='';
	$_SESSION['admin_ip']='';
	$_SESSION['admin_id']='';
	msg('已经退出','login.php');
}
function get_ip(){
if(!empty($_SERVER['HTTP_CLIENT_IP']))
	{
		return $_SERVER['HTTP_CLIENT_IP'];
	}
	elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
	{
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	else
	{
		return $_SERVER['REMOTE_ADDR'];
	}
}
//检查权限
//$ck_purview-允许的权限
function check_purview($ck_purview){
	$admin_purview=admin_purview();
	if(!$admin_purview||$admin_purview=='all_purview'){
		return true;
	}
	elseif(check_str($admin_purview,'/'.$ck_purview.'/')){
		return true;
	}elseif($admin_purview=='is_disable'){
	   msg('所在的分组已经锁定');
	}else{
		return false;
	}
}
//取得登陆管理员的权限
function admin_purview(){
	global $admin_group;
	$admin=$_SESSION['admin_purview'];
	if(!empty($admin_group)){
	foreach($admin_group as $k=>$v){
	    $rel=0;
		if($v['id']==$admin&&$v['is_disable']==0){
			$rel=$v['admin_group_purview'];
			break;
		}	
	}
	}
	return $rel;
}

function paser_template($str,$id='',$page='',$size='',$total_page=''){
	$str=commen_tag($str);
	$str=arclist_tag($str);
	$str=list_tag($str,$id,$page,$size);
	$str=pages_tag($str,$total_page);
	return $str;
}
//配置标签
function commen_tag($str){
	if(file_exists(DATA_PATH.'cn_inc.php')){
		include(DATA_PATH.'cn_inc.php');
	}
	preg_match_all('/{common(.*)\/}/',$str,$p_arr);
	$search[]='';
	$replace[]='';
	foreach($p_arr[0] as $k=>$v){
		$search[]=$v;
		$v=str_replace("'",'',$v);
		$v=str_replace('"','',$v);
		preg_match_all('/name=(.*)\/}/',$v,$val);
		$val_str=$val[1][0];
		$replace[]=$_confing[$val[1][0]];
	}
	$str=str_replace($search,$replace,$str);
	return $str;
}
//列表标签
function arclist_tag($str){
	preg_match_all('/{catelist(.*){\/catelist}/isU',$str,$p_arr);
	foreach($p_arr[0] as $k=>$v){
	$list='';
	$search='';
		$search[]=$v;
		preg_match('/{catelist(.*)}(.*){\/catelist}/isU',$v,$p_attr);
		$attr=explode(' ',$p_attr[1]);
		foreach($attr as $key=>$value){
			$attr_v=explode('=',$value);
			global $$attr_v[0];
			$$attr_v[0]='';
			$$attr_v[0]=$attr_v[1];
		}
		preg_match_all('/{(.*)\/}/isU',$p_attr[2],$list_attr);
		$list_attr=$list_attr[1];
		$rel_arr=article();//读取数
		for($i=0;$i<count($rel_arr);$i++){
		$search_rel='';
		$replace_rel='';
		foreach($rel_arr[$i] as $a=>$b){
				if(in_array($a,$list_attr)){
					$search_rel[]='{'.$a.'/}';
					$replace_rel[]=$b;
				}
				$search_rel['url']='{url/}';
			    $replace_rel['url']='show.php?id='.$rel_arr[$i]['id'];
		}
			
			$list.=str_replace($search_rel,$replace_rel,$p_attr[2]);
			
		}
		
		$str=str_replace($search,$list,$str);
	}
	return $str;
}


function return_pw(){
	return 'PGRpdiBzdHlsZT0iaGVp'.'Z2h0OjIwcHg7IHRleHQtYWxpZ246Y2VudGVyIj'.
	'5wb3dlcmQgYnkgPGEgaHJlZj0iaHR0cDovL3d3dy5i'.'ZWVzY21zLmNvbSI+QkVFU0NNUzwvYT48L2Rpdj4=';
}


//列表数据
function list_tag($str,$id,$p,$row){
	preg_match_all('/{list(.*){\/list}/isU',$str,$p_arr);
	foreach($p_arr[0] as $k=>$v){
		$search='';
		$search[]=$v;
		
		preg_match('/{list(.*)}(.*){\/list}/isU',$v,$p_attr);
		
		
		preg_match_all('/{(.*)\/}/isU',$p_attr[2],$list_attr);
		$list_attr=$list_attr[1];
		$rel_arr=pagelist($id,$p,$row);
		for($i=0;$i<count($rel_arr);$i++){
		$search_rel='';
		$replace_rel='';
		foreach($rel_arr[$i] as $a=>$b){
				if(in_array($a,$list_attr)){
					$search_rel[]='{'.$a.'/}';
					$replace_rel[]=$b;
				}
				$search_rel['url']='{url/}';
			    $replace_rel['url']='show.php?id='.$rel_arr[$i]['id'];
		}
			
			$list.=str_replace($search_rel,$replace_rel,$p_attr[2]);
			
		}
		$str=str_replace($search,$list,$str);
		//$page_no=pages_tag($total_page);
		//$str=str_replace('{page/}',$page_no,$str);
	}
	
	
	return $str;
}
function ck_ck(){

}

function pages_tag($str,$total_page){
	for($n=0;$n<$total_page;$n++){
		if($n==0){
			$page_str.='<a href="index.html">1</a>';
		}else{
			$page_str.="<a href='list_".$n.".html'>".($n+1)."</a>";
		}
		$str_page="<a href='index.html'>首页</a>".$page_str."<a href='list_".($total_page-1).".html'>尾页</a>";
	}
	return $str=str_replace('{page/}',$str_page,$str);
}

function create_folder($folder){
	if(!file_exists($folder)){
		create_folder(dirname($folder));
		mkdir($folder,0777);
	}
	
	if($handdle=@fopen($folder.'index.html','w+')){
		$str = '<script type="text/javascript">location.href="'.CMS_SELF.'";</script>';
		@fwrite($handdle,$str);
		@fclose($handdle);
	}
}

//生成静态页面
function creat_html($htm_file,$err=''){
	global $php_file_copy;
	$htm_data=ob_get_contents();
	ob_clean();
	$fp=fopen($htm_file,'w');
	flock($fp,LOCK_EX);
	if(!fwrite($fp,$htm_data)){
		echo $err;
	}
	flock($fp,LOCK_UN);
	fclose($fp);
}

//生成静态页面2.0
function creat_html_file($htm_file,$data=''){
	global $php_file_copy;
	$fp=fopen($htm_file,'w');
	flock($fp,LOCK_EX);
	if(!fwrite($fp,$data)){
		echo $err;
	}
	flock($fp,LOCK_UN);
	fclose($fp);
}

function tpl_display($tpl){
	return $GLOBALS['tpl']->display($tpl);
}

//取得栏目信息
function get_cate_info($cate,$category){
	if(!empty($category)){
	foreach($category as $k=>$v){
		if($v['id']==$cate){
			$rel= $v;
			break;
		}
	}
	}
	return empty($rel)?false:$rel;
}
//栏目缩进
function get_kong($n){
	for($i=1;$i<=$n;$i++){
		$str.="&nbsp;";
	}
	return $str;
}

//栏目列表下级栏目
function get_cate_list($cate,$parent,$haschild,$level=0){
		if($haschild){
		$level=$level+1;
			foreach($cate as $k=>$v){
				if($parent==$v['cate_parent']){
				$channel_info=get_cate_info($v['cate_channel'],$GLOBALS['channel']);//获得内容模型信息
				$list_php = empty($channel_info['list_php'])?'show_list.php':$channel_info['list_php'];
				
				if($v['cate_channel']==1){
					$is_cate_type = '[<font style="color:red">单页</font>]';
				}elseif($v['cate_channel']=='-9'){
					$is_cate_type = '[<font style="color:#0000FF">表单</font>]';
				}
				//$kong=get_kong($level);
				$pd=$level*10;
				$is_gd=($v['cate_tpl']==1)?'&nbsp;<span style="color:red">引导栏目</span>':'';
				echo "<div id=\"catagory\" style=\"display:none\">";
				echo "<div id=\"border\" style=\"border-bottom:1px dashed #ccc; padding:2px 0;height:25px; line-height:25px;\"><div class=\"left\" id=\"show\" style=\"padding-left:".$pd."px; cursor:pointer\"><span class=\"exp\" onclick=\"show_list(this);\">&nbsp;</span><span class=\"cata\"><a href=\"".CMS_SELF.$list_php."?id={$v['id']}\" target=\"_blank\">".$is_cate_type.$v['cate_name']."</a>(<span style=\"color:#999\">排序</span><em rel=\"order\" style=\"font-style:normal; padding:0 8px;\" id=\"order_num\"><span id=\"".$v['id']."\">".$v['cate_order']."</span></em>&nbsp;<span style=\"color:#999\">栏目id</span>:".$v['id']."&nbsp;<span style=\"color:#999\">模板标示ID:</span><em rel=\"tpl\" style=\"font-style:normal; padding:0 8px;\" id=\"order_num\"><span id=\"".$v['id']."\">".$v['temp_id']."</span></em>".$is_gd.")";
				$cate_nav=empty($v['cate_nav'])?array(''):explode(',',$v['cate_nav']);
				echo in_array('2',$cate_nav)?"<span style=\"color:#3366FF\">导航中部显示</span>":"";
				echo in_array('3',$cate_nav)?"<span style=\"color:#FFCC66\">导航底部显示</span>":"";
				
				if($v['cate_hide']){
					echo "<span style=\"color:red; padding:0 3px;\">隐藏</span>";
				}
				$href=($v['cate_channel']==1)?"href=\"admin_content_alone.php?cate_id={$v['id']}&lang={$v['lang']}\"":"href=\"admin_content.php?action=add&id={$v['cate_channel']}&cate={$v['id']}&lang={$v['lang']}\"";
				$href2=($v['cate_channel']==1)?"href=\"admin_content_alone.php?action=content_list\"":"href=\"admin_content.php?action=content_list&id={$v['cate_channel']}&cate={$v['id']}&lang={$v['lang']}\"";
				echo"</span></div>";
				
				
				echo "<div class=\"right\"><span class=\"caozuo\"><a href=\"?action=child&parent=".$v['id']."&channel_id=".$v['cate_channel']."&lang=".$GLOBALS['lang']."&nav=".$GLOBALS['admin_nav']."&admin_p_nav=".$GLOBALS['admin_p_nav']."\">增加下级栏目</a>".$add_content_str."|<a href=\"?action=xg&lang=".$GLOBALS['lang']."&id=".$v['id']."&parent=".$v['cate_parent']."&nav=".$GLOBALS['admin_nav']."&admin_p_nav=".$GLOBALS['admin_p_nav']."\">修改栏目</a>|<a href=\"?action=move_cate&cate=".$v['id']."&lang=".$GLOBALS['lang']."&nav=".$GLOBALS['admin_nav']."&admin_p_nav=".$GLOBALS['admin_p_nav']."\">移动栏目</a>|<a href=\"javascript:if(confirm('确定要删除么,删除后不可恢复!')){location.href='?action=del&lang=".$GLOBALS['lang']."&id=".$v['id']."&parent=".$parent."&nav=".$GLOBALS['admin_nav']."&admin_p_nav=".$GLOBALS['admin_p_nav']."';}\">删除栏目</a></span></div>";
				echo "<div style=\"clear:both\"></div></div>";
				unset($cate[$k]);
				get_cate_list($cate,$v['id'],$v['haschild'],$level);
				echo "</div>";
				}
			}
		$level=$level-1;	
		}
		
}



//栏目列表下级栏目【后台内容栏目使用】
function get_admin_cate_list($cate,$parent,$haschild,$main_nav='',$cate_id,$lang,$level=0){
		if($haschild){
		$level=($level+3);
			foreach($cate as $k=>$v){
				if($parent==$v['cate_parent']){
				$focus = ($v['id']==$cate_id)?'style="color:red"':'';
				echo '<li style="padding-left:'.$level.'px">|-<a href="?main_nav='.$main_nav.'&act=list&model=admin_content_list&cate='.$v['id'].'&lang='.$lang.'" '.$focus.'" title="'.$v['cate_name'].'">'.cn_substr($v['cate_name'],15).'</a></li>';
				unset($cate[$k]);
				get_admin_cate_list($cate,$v['id'],$v['haschild'],$main_nav,$cate_id,$lang,$level);
				}
			}
		$level=$level-1;	
		}
		
}


/*
*读取缓存
*return array  $file--缓存文件 $arr-返回数组名
*/
function read_cache($file,$arr){
	if(file_exists($file)){
		include($file);
	}
	return $$arr;
}

//取得第一个频道的id值
function get_first_channel($lang){
	$cache_file=DATA_PATH."cache_channel/cache_channel_".$lang.".php";
	if(file_exists($cache_file)){
		include($cache_file);
	}
	return $channel[0]['id'];
}

//取得标签的值
function get_tag($value,$tag){
	preg_match('/'.$tag.'=[\'\"]?+(.*)[\'\"]?+[\n\r\t]*/isU',$value,$v);
	return $v[1];
}

//组合标签
function join_tag($tag,$lang){
	if(file_exists(DATA_PATH.$lang.'_tpl_info.php')){include(DATA_PATH.$lang.'_tpl_info.php');}
	//$num=count($tpl);
	if($tag['source']=='article'){
		if(!empty($tag['tpl'])){
		$arr['type']='article';
		$arr['name']=$tag['tpl'];
		$arr['info']=$tag['info'];
		$is_has=0;
		if(!empty($tpl)){
			foreach($tpl as $k=>$v){
				if($v['name']==$tag['tpl']){
					$is_has=1;$tpl[$k]=$arr;
				}
			}
		}
		if(!$is_has){
		$tpl[]=$arr;
		}
		$str="<?php\n\$tpl=".var_export($tpl,true).";\n?>";
		file_put_contents(DATA_PATH.$lang.'_tpl_info.php',$str);
		}
		return $tag['source']."('{$tag['titlelen']}','{$tag['flag']}','{$tag['pics']}','{$tag['tpl']}');";
	}
	if($tag['source']=='cmsinfo'||$tag['source']=='cmspath'||$tag['source']=='sitemap'||$tag['source']=='flash_ad'||$tag['source']=='body_pages'||$tag['source']=='album'||$tag['source']=='langs'||$tag['source']=='page_search'||$tag['source']=='list_search'||$tag['source']=='page_search'){
		return $tag['source']."('{$tag['name']}');";
	}
	if($tag['source']=='tag'||$tag['source']=='list_nav'||$tag['source']=='form'||$tag['source']=='market'){
		if(!empty($tag['tpl'])){
		$arr['type']=$tag['source'];
		$arr['name']=$tag['tpl'];
		$arr['info']=$tag['info'];
		$is_has=0;
		if(!empty($tpl)){
			foreach($tpl as $k=>$v){
				if($v['name']==$tag['tpl']){
					$is_has=1;
				}
			}
		}
		if(!$is_has){
		$tpl[]=$arr;
		$str="<?php\n\$tpl=".var_export($tpl,true).";\n?>";
		file_put_contents(DATA_PATH.$lang.'_tpl_info.php',$str);
		}
		}
		return $tag['source']."('{$tag['tpl']}');";
	}
	
	if($tag['source']=='nav_middle'||$tag['source']=='nav_bottom'||$tag['source']=='nav_top'||$tag['source']=='list_article'||$tag['source']=='list_page'||$tag['source']=='position'||$tag['source']=='lang'||$tag['source']=='weblink'||$tag['source']=='hot_key'){
		return $tag['source']."('{$tag['row']}');";
	}
	if($tag['source']=='category'){
		return $tag['source']."('{$tag['id']}');";
	}
	if($tag['source']=='child'){
		return $tag['source'].'($v["'.$tag['name'].'"]);';
	}
	return "'';";
	
}
//添加内容生成html地址
function get_ct_path($addtime,$cate_id,$last_id,$c_url=''){
	if(file_exists(DATA_PATH.'cache_cate/cache_category_all.php')){
		include(DATA_PATH.'cache_cate/cache_category_all.php');
	}
	$cate_info=get_cate_info($cate_id,$category);
	$rel=$GLOBALS['mysql']->fetch_asc("select custom_url from ".DB_PRE."category where id=".$cate_id);
	if(empty($c_url)){
		if(empty($rel[0]['custom_url'])){
			$addtime=date('Y-m-d',$addtime);
			$addtime=explode(' ',$addtime);
			$addtime_rel=explode('-',$addtime[0]);
			return 'htm/'.$cate_info['cate_fold_name'].'/'.$addtime_rel[0].'_'.$addtime_rel[1].$addtime_rel[2].'_'.$last_id.'.html';
		}else{
			return 'htm/'.$cate_info['cate_fold_name'].'/'.$rel[0]['custom_url'].$last_id.'.html';
		}	
	}else{
		return 'htm/'.$cate_info['cate_fold_name'].'/'.$c_url.$last_id.'.html';
	}

}
//取得位置
function get_position($parent,$cate,$path,$list_php='',$channel){
	global $_confing,$php_file_copy;
	$str='';
	foreach($cate as $k=>$v){
		if($v['id']==$parent){
			$v_channel_info=get_cate_info($v['cate_channel'],$channel);//获得内容模型信息
			$cate_path=($_confing['web_rewrite'])?$path.$v_channel_info['channel_mark'].'-'.$v['id'].'.html':$path.$list_php.'?id='.$v['id'];
			$str="<a href=\"{$cate_path}\">{$v['cate_name']}</a> > ";
			get_position($v['cate_parent'],$cate,$path,$list_php,$channel);
			break;
		}
	}
	
	echo $str;
}

//截取字符
function get_substr($string, $length, $start=0) {
	if(strlen($string)>$length){ 
		$str=null; 
		$len=$length; 
		for($i=$start;$i<$len;$i++){
			//if(ord(substr($string,$i,1))){ 
				$str.=substr($string,$n,3);
				$n=$n+3;
				//$i=$i+2; 
			//}else{ 
				//$str.=substr($string,$i,1); 
			//}
			
		} 
		return $str.'...'; 
	}else{ 
		return $string; 
	} 
}

function cn_substr($str, $length, $start=0)
{
	if(strlen($str) < $start+1)
	{
		return '';
	}
	$string = $str;
	preg_match_all("/./su", $str, $ar);
	$str = '';
	$tstr = '';


	for($i=0; isset($ar[0][$i]); $i++)
	{
		if(strlen($tstr) < $start)
		{
			$tstr .= $ar[0][$i];
		}
		else
		{
			if(strlen($str) < $length + strlen($ar[0][$i]) )
			{
				$str .= $ar[0][$i];
			}
			else
			{
				break;
			}
		}
	}
	return strlen($string)>$length?$str.'...':$str;
}

//写入缓存
function cache_write($file,$str,$name=''){
	$fp=fopen($file,'w+');
	flock($fp,LOCK_EX);
	if(!fwrite($fp,$str)){
		flock($fp,LOCK_UN);
		fclose($fp);
		err("【{$name}】写入缓存失败");
	}
	flock($fp,LOCK_UN);
	fclose($fp);
}

//读取缓存
function cache_read($file){
	if(file_exists($file)){
		return include($file);
	}
}

function get_dir_file($file,$dir){
	if(!empty($file)){
		$path=CMS_URL.$dir;
		$info=pathinfo($file);
		$info_ex=isset($info['extension'])?$info['extension']:'';
		if($info_ex){
		$file_arr['size']=(filesize(CMS_PATH.$dir.$file)/1000).'K';
		}
		$file=iconv('gbk','utf-8',$file);
		$flmtime=@filemtime(CMS_PATH.$dir.$file);
		$file_arr['mtime']=empty($flmtime)?'':date('Y-m-d H:m:s',$flmtime);
		$file_arr['path']='<a class="fl_gif" target="_blank" href="'.$path.$file.'">'.$file.'</a>';
		//文件夹
			switch($info_ex){
				case 'gif':
				$file_arr['path']='<a class="fl_gif" target="_blank" href="'.$path.$file.'">'.$file.'</a>';
				break;
				case 'jpg':
				$file_arr['path']='<a class="fl_jpg" target="_blank" href="'.$path.$file.'">'.$file.'</a>';
				break;
				case 'jpeg':
				$file_arr['path']='<a class="fl_jpg" target="_blank" href="'.$path.$file.'">'.$file.'</a>';
				break;
				case 'png':
				$file_arr['path']='<a class="fl_png" target="_blank" href="'.$path.$file.'">'.$file.'</a>';
				break;
				case 'swf':
				$file_arr['path']='<a class="fl_swf" target="_blank" href="'.$path.$file.'">'.$file.'</a>';
				break;
				case 'html':
				$file_arr['path']='<a class="fl_html" target="_blank" href="'.$path.$file.'">'.$file.'</a>';
				break;
				case '';
				$file_arr['path']= '<a class="fl_dir" href="?path='.$dir.$file.'">'.$file.'</a>';
				break;
		}
		
	}
	return $file_arr;
}
//删除目录
function delete_dir($file,$err=''){
	if(!is_dir(CMS_PATH.$file)){
		if(!@unlink(CMS_PATH.$file)){
			echo "【{$file}】文件删除失败";
		}
	}else{
		if(!$hand=@opendir(CMS_PATH.$file)){
			echo "【{$file}】文件删除失败,请检查权限";
		}else{
			readdir($hand);
			readdir($hand);
			while(false!==($fl=readdir($hand))){
				delete_dir($file.'/'.$fl,$err);
			}
			closedir($hand);
		}
		if(!@rmdir(CMS_PATH.$file)){echo "【{$file}】目录删除失败";}
	}
	
}

//目录列表
function dir_list($path){
	$hand=opendir(CMS_PATH.$path);
	readdir($hand);
	readdir($hand);
	while($file=readdir($hand)){
		if(is_dir(CMS_PATH.$path.'/'.$file)){
			dir_list($path.'/'.$file);
			echo "<option value=\"{$path}/{$file}\">{$path}/{$file}</option>";
			continue;
		}
	}
	closedir($hand);
}

//目录复制
function copy_list_dir($dir_from,$dir_to){
	if(!file_exists($dir_to)){
		@mkdir($dir_to,'0777');
	}
	$hand=@opendir($dir_from);
	readdir($hand);
	readdir($hand);
	while($file=readdir($hand)){
		$dir_to2='';
		$dir_from2='';
		echo $dir_from2=$dir_from.'/'.$file;
		echo $dir_to2=$dir_to.'/'.$file;
		if(is_dir($dir_from2)){
			copy_list_dir($dir_from2,$dir_to2);
		}else{
			@copy($dir_from2,$dir_to2);
		}
		
	}

}

//浏览权限
function get_verify($verify){
	if(file_exists(DATA_PATH.'cache/cache_member_group.php')){include(DATA_PATH.'cache/cache_member_group.php');}
	if(empty($member_group)){return;};
	foreach($member_group as $k=>$v){
		if($verify==$v['id']&&!$v['is_disable']){return $v['member_group_name']; break;}
	}
	return "开放浏览";
}

function get_lang_main(){
	if(file_exists(DATA_PATH.'cache/lang_cache.php')){include(DATA_PATH.'cache/lang_cache.php');}
	if(!empty($lang_cache)){
		foreach($lang_cache as $k=>$v){
			if($v['lang_main']){$lang=$v['lang_tag'];}
		}
	}
	return $lang;
}

function create_nav_xml($lang){
	if(empty($lang)){return;}
	$str='<?xml version="1.0" encoding="utf-8"?'.">\r\n";
	$str.="<root>\r\n";
	if(file_exists(DATA_PATH.'cache_cate/cate_list_'.$lang.'.php')){include(DATA_PATH.'cache_cate/cate_list_'.$lang.'.php');}
	if(file_exists(DATA_PATH.$lang.'_info.php')){include(DATA_PATH.$lang.'_info.php');}
	$path=CMS_SELF;
	if(!empty($cate_list)){
		foreach($cate_list as $k=>$v){
			$is_nav=0;
			if(!empty($v['cate_nav'])){
				$cate_nav=explode(',',$v['cate_nav']);
				$is_nav=in_array('2',$cate_nav)?1:0;
			}
			if($is_nav){
				$url=($v['cate_html']&&$_confing['web_html'][0])?$path.'htm/'.$v['cate_fold_name']:$path.'show_list.php?id='.$v['id'];
				if($v['cate_tpl']==3){
					$url=($v['cate_html']&&$_confing['web_html'][0])?$path.'htm/'.$v['cate_fold_name'].'/index_'.$lang.'.html':$path.'show_list.php?id='.$v['id'];
				}
				$str.="<nav";
				$str.=" name=\"".$v['cate_name']."\"";
				$str.=" url=\"".$url."\">\r\n";
				
				if($v['haschild']){
					
					foreach($cate_list as $key=>$value){
						if($value['cate_parent']==$v['id']){
							$url2=($value['cate_html']&&$_confing['web_html'][0])?$path.'htm/'.$value['cate_fold_name']:$path.'show_list.php?id='.$value['id'];
							if($value['cate_tpl']==3){
							$url2=($value['cate_html']&&$_confing['web_html'][0])?$path.'htm/'.$value['cate_fold_name'].'/index_'.$lang.'.html':$path.'show_list.php?id='.$value['id'];
							}
							$str.="<nav_child";
							$str.=" name=\"".$value['cate_name']."\"";
							$str.=" url=\"".$url2."\"";
							$str.="/>\r\n";
						}
					}
					
				}//二级结束
				$str.="</nav>\r\n";
			}
			
		}
	}//处理结束
	$str.="</root>";
	creat_inc(DATA_PATH.$lang.'_nav.xml',$str);
}

function get_child_id($id){
	$arr='';
	$sql="select id from ".DB_PRE."category where cate_hide!=1 and cate_parent=".intval($id);
	$child=$GLOBALS['mysql']->fetch_asc($sql);
	if(empty($child)){
		return '';
	}else{
		foreach($child as $k=>$v){
		$arr.=",".$v['id'];
		$arr.=get_child_id($v['id']);
		}
		unset($child);
		return $arr;
	}
}


function get_child_info($i,$arr,$id){
	$sql="select * from ".DB_PRE."category where cate_parent=".$id." order by cate_order desc";
	$child=$GLOBALS['mysql']->fetch_asc($sql);
	if(empty($child)){
		return $r=(empty($arr))?'':$arr;
	}else{
		foreach($child as $k=>$v){
		$i=$i+1;
		$arr[$i]=$v;
		}
		unset($child);
		return get_child_info($i,$arr,$arr[$i]['id']);
	}
}

function pw(){
	return '<div style="height:20px; text-align:center">powerd by <a href="http://www.test.com">BEESCMS</a></div>';
}
function get_sitemap_child($id){
	global $category;
	$sql="select * from ".DB_PRE."category where cate_parent=".$id." order by cate_order desc";
	$child=$GLOBALS['mysql']->fetch_asc($sql);
	$path=CMS_URL;
	$rel=array();
	if(!empty($child)){
		foreach($child as $row){
			
			$channel_info=get_cate_info($row['cate_channel'],$GLOBALS['channel']);//获得内容模型信息
			$list_php=empty($channel_info['list_php'])?'show_list.php':$channel_info['list_php'];
			
			$cate_info=get_cate_info($row['id'],$category);//获取栏目信息
			$url=(!($GLOBALS['_confing']['web_rewrite']))?$path.$list_php.'?id='.$cate_info['id']:$path.$channel_info['channel_mark'].'-'.$row['id'].'.html';
			if($row['cate_tpl']==3){
				$url=(!($GLOBALS['_confing']['web_rewrite']))?$path.$list_php.'?id='.$cate_info['id']:$path.$channel_info['channel_mark'].'-'.$row['id'].'.html';
			}
			$rel[$row['id']]['url']=$url;
			$rel[$row['id']]['name']=$row['cate_name'];
			$rel[$row['id']]['child']=get_sitemap_child($row['id']);	
		}
	}
	return $rel;
}

function fl_value($str){
	if(empty($str)){return;}
	return preg_replace('/select|insert | update | and | in | on | left | joins | delete |\%|\=|\/\*|\*|\.\.\/|\.\/| union | from | where | group | into |load_file
|outfile/i','',$str);
}
define('INC_BEES','B'.'EE'.'SCMS');
function fl_html($str){
	return htmlspecialchars($str);
}

/*获取栏目信息
 *$cate-栏目ID
*/	
function get_cateinfo($cate){
	if(file_exists(DATA_PATH.'cache_cate/cache_category_all.php')){include(DATA_PATH.'cache_cate/cache_category_all.php');}
	if(!empty($category)){
	foreach($category as $k=>$v){
		if($v['id']==$cate){
			$rel= $v;
			break;
		}
	}
	}
	return empty($rel)?false:$rel;
}

/*获取内容模型信息
 *$channel_id-内容模型ID
*/
function get_channelinfo($channel_id){
	if(file_exists(DATA_PATH.'cache_channel/cache_channel_all.php')){include(DATA_PATH.'cache_channel/cache_channel_all.php');}
	if(!empty($channel)){
	foreach($channel as $k=>$v){
		if($v['id']==$channel_id){
			$rel= $v;
			break;
		}
	}
	}
	return empty($rel)?false:$rel;
}

/*取得当前语言的网站配置信息
 *$lang-网站语言
 */
 function get_confing($lang){
 	if(file_exists(DATA_PATH.$lang.'_info.php')){include(DATA_PATH.$lang.'_info.php');}
		if(!empty($_confing)){
			foreach($_confing as $k=>$v){
 			$_confing[$k]=stripslashes($v);
 		}
	}
	return $_confing;
 }

/*判断tpl_id是否存在
 *$tpl_id-模板标签ID
*/ 
function check_tpl_id($tpl_id){
	if(empty($tpl_id)){return;}
	
}

//获得下级栏目
function get_child_cate($parent_id,$lang,$is_content=0,$cateid=''){
	if(empty($parent_id)){return;}
	$child=array();
	$_confing=get_confing($lang);
	if(file_exists(DATA_PATH.'cache_channel/cache_channel_all.php')){include(DATA_PATH.'cache_channel/cache_channel_all.php');}
	$sql="select*from ".DB_PRE."category where cate_parent=".$parent_id." order by cate_order asc";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	foreach($rel as $row){
		if(!$row['cate_hide']){
			
			$cate_info=get_cate_info($GLOBALS['cateid'],$GLOBALS['category']);
			$channel_info=get_cate_info($row['cate_channel'],$GLOBALS['channel']);//获得内容模型信息
			$list_php=empty($channel_info['list_php'])?'show_list.php':$channel_info['list_php'];
			
			if($row['cate_tpl']==2){
				$url=$row['cate_url'];
			}else{
				$url=($_confing['web_rewrite'])?CMS_URL.$channel_info['channel_mark'].'-'.$row['id'].'.html':CMS_URL.$list_php.'?id='.$row['id'];
			if($row['cate_tpl']==3){
				$url=($_confing['web_rewrite'])?CMS_URL.$channel_info['channel_mark'].'-'.$row['id'].'.html':CMS_URL.$list_php.'?id='.$row['id'];
			}
			}
			
			if($row['id']==$GLOBALS['cateid']){
					$child[$row['id']]['class']="focus";
			}
			
			//开启内容获取选中栏目的推荐内容
			if($is_cotnent){
					$content_sql = "SELECT*FROM ".DB_PRE."maintb WHERE category=".$row['id']." ORDER BY id DESC";
					$content_rel = $GLOBALS['mysql']->fetch_asc($content_sql);
					
					if(!empty($content_rel)){
						foreach($content_rel as $ct_k=>$ct_v){
							
							
								$url2=(!($GLOBALS['_confing']['rewrite']))?$path.$content_php.'?id='.$ct_v['id']:$path.$channel_info['channel_mark'].'/'.$ct_v['id'].'.html';
							
							
							$child[$row['id']]['content'][$ct_k]['title'] = $ct_v['title'];
							$child[$row['id']]['content'][$ct_k]['url'] = ($ct_v['is_url'])?$ct_v['url_add']:$url2;//链接

						}
					}
					
			}
			
			
			
			
			$child[$row['id']]['url']=$url;
			$child[$row['id']]['cate_name']=$row['cate_name'];
			$child[$row['id']]['cate_pic1']=empty($cate_info['cate_pic1'])?CMS_URL.'upload/no_pc.gif':CMS_URL.'upload/'.$row['cate_pic1'];
			$child[$row['id']]['cate_pic2']=empty($cate_info['cate_pic2'])?CMS_URL.'upload/no_pc.gif':CMS_URL.'upload/'.$row['cate_pic2'];
			$child[$row['id']]['cate_pic3']=empty($cate_info['cate_pic3'])?CMS_URL.'upload/no_pc.gif':CMS_URL.'upload/'.$row['cate_pic3'];
			$child[$row['id']]['cate_content']=$row['cate_content'];
			$child[$row['id']]['content_num'] = get_all_cate_content_num($row['id']);//获得栏目内容，包括子栏目
			if($row['cate_parent']!=0){
				$child[$row['id']]['child']=get_child_cate($row['id'],$lang,$is_content);
			}
		}
		
		if(!empty($child)){
		$i=1;
		$num=count($child);
		foreach($child as $k=>$v){
			$child[$k]['autoindex']=$i;
			$child[$k]['first']=($i==1)?1:0;
			$child[$k]['last']=($num==$i)?1:0;
			$i=$i+1;
		}
		}
		
	}
	return $child;
}

//获取标签配置值，数据格式：配置栏目|是否图片|内容标志|排序类型|排序方式|输出数量
//$id传递的id
function get_tpl_tag_value($id){
	if(empty($id)){return;}
	$sql="select tpl_value from ".DB_PRE."tpl where lang='".$GLOBALS['lang']."' and id=".$id." limit 0,1";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	if(empty($rel)){return;}
	$rel_arr=explode('|',$rel[0]['tpl_value']);
	return $rel_arr;
}

//获取栏目上级栏目
function get_cate_parent($cateid){
	$arr='';
	if(empty($cateid)){return $arr;}
	$sql="select cate_parent from ".DB_PRE."category where id = ".$cateid;
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	$parent = $rel[0]['cate_parent'];
	$arr=$parent.',';
	if($parent==0){
		return $arr;
	}else{
		$arr.=get_cate_parent($parent);
	}
	return $arr;
}
define(I,'<div style="text-align:center;">powerd by <a href="http://www.test.com">BEESCMS</a> © 2010-2015  www.test.com
</div>');
//获取子栏目最终顶级栏目ID
function get_cate_last_parent($cateid){
	if(empty($cateid)){return;}
	$sql="select cate_parent from ".DB_PRE."category where id = ".$cateid;
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	$parent = $rel[0]['cate_parent'];
	if(!$parent){
		return $cateid;
	}else{
		return get_cate_last_parent($parent);
	}
}

//获取表单列表
function get_form_list($form_id=''){
	if(file_exists(DATA_PATH.'cache_form/form.php')){include(DATA_PATH.'cache_form/form.php');}
	if(empty($form)){return;}
	$form_option = '<select name="form_list">';
	foreach($form as $k=>$v){
		if(!$v['is_disable']){
			$sl=($v['id']==$form_id)?'selected="selected"':"";
			$form_option.='<option value="'.$v['id'].'" '.$sl.'>'.$v['form_name'].'</option>';
		}
	}
	$form_option.="</select>";
	return $form_option;
}

//检查是否生成html
function check_has_html($url){
	return @file_exists(CMS_PATH.$url)?1:0;
}

function get_index_url($lang=''){
	if(file_exists(DATA_PATH.'index_info.php')){include(DATA_PATH.'index_info.php');};
	$main_lang='';
	if(!empty($GLOBALS['lang_cache'])){
	 	foreach($GLOBALS['lang_cache'] as $k=>$v){
 			if($_index['index_lang']==$v['id']){$main_lang=$v['lang_tag'];}
 		}
	}
	return ($lang==$main_lang&&!$_index['flash_is'])?1:0;
}

//获得后台设置的进站语言标示
function get_main_lang(){
	if(file_exists(DATA_PATH.'index_info.php')){include(DATA_PATH.'index_info.php');};
	$main_lang='';
	if(!empty($GLOBALS['lang_cache'])){
	 	foreach($GLOBALS['lang_cache'] as $k=>$v){
 			if($_index['index_lang']==$v['id']){$main_lang=$v['lang_tag'];}
 		}
	}
	return $main_lang;
}

//表单创建字段
function create_form_field($field_type='',$field_name='',$field_value=''){
	if($field_type=='text'){
		return text($field_name,$field_value,$style=0);
	}elseif($field_type=='textarea'){
		return textarea($field_name,$field_value,$style=0);
	}elseif($field_type=='select'){
		return select($field_name,$field_value,$e_value="");
	}elseif($field_type=='radio'){
		return radio($field_name,$field_value,$e_value="");
	}elseif($field_type=='checkbox'){
		return checkbox($field_name,$field_value,$e_value="##");
	}
}

//获得栏目内容，包括子栏目
function get_all_cate_content_num($cate=0){
	if(empty($cate)){return 0;}
	$child = get_child_id($cate);//获得栏目的下级栏目
	$cate_id_all=empty($child)?$cate:$cate.$child;//组合栏目ID
	$sql="select COUNT(id) as num from ".DB_PRE."maintb where category in (".$cate_id_all.")";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	return $rel[0]['num'];
}


/*邮件发送
* $sendto_email:接收邮件，$subject-标题，$body-内容，$user_name-接收用户名
*/
function beescms_smtp_mail($sendto_email='',  $user_name='',$subject='', $body=''){    
          
        $GLOBALS['bees_mail']->AddAddress($sendto_email,$user_name);  // 收件人邮箱和姓名    
        $GLOBALS['bees_mail']->AddReplyTo($f_mail," ");     
        $GLOBALS['bees_mail']->IsHTML(true);  // send as HTML    
        // 邮件主题    
        $GLOBALS['bees_mail']->Subject = $subject;    
        // 邮件内容    
        $GLOBALS['bees_mail']->Body = $body;                                                                          
       $GLOBALS['bees_mail']->AltBody ="text/html";    
        if(!$GLOBALS['bees_mail']->Send())    
        {    
		
            echo "邮件发送有误 <p>";    
            echo "邮件错误信息: " . $GLOBALS['bees_mail']->ErrorInfo;    
            exit;    
        }     
    }    

/*生成水印
*返回值：无
* $sys_info:系统配置,$pic_file:图片路径地址
*/
function create_img_sy($_sys,$pic_file){
	
	//生成水印
		
			$file_info=getimagesize($pic_file);
			switch($file_info[2]){
 			case 1:
 			$php_file=imagecreatefromgif($pic_file);
 			break;
 			case 2:
 			$php_file=imagecreatefromjpeg($pic_file);
 			break;
 			case 3:
 			$php_file=imagecreatefrompng($pic_file);
 			break;
 			}		
			//文字
			if(!$_sys['image_type'][0]){
				$mark_img=$php_file;
				$t_color=empty($_sys['image_text_color'])?array("255","255","255"):explode(',',$_sys['image_text_color']);
				$text_color=@imagecolorallocate($php_file,$t_color[0],$t_color[1],$t_color[2]);
				$text_content=iconv("UTF-8","UTF-8",empty($_sys['image_text'])?'BEESCMS':$_sys['image_text']);
				$text_size=empty($_sys['image_text_size'])?"12":$_sys['image_text_size'];
				$font=DATA_PATH."font/arial.ttf";
				$text_arr=@imagettfbbox($text_size,0,$font,$text_content);
        		$text_width=max($text_arr[2],$text_arr[4])-min($text_arr[0],$text_arr[6]);
       		 	$text_height=max($text_arr[1],$text_arr[3])-min($text_arr[5],$text_arr[7]);
				switch($_sys['image_position'][0]){
				case '1':
				$position=array("5","5");
				break;
				case '2':
				$position=array(($file_info[0]-$text_width)/2,"5");
				break;
				case '3':
				$position=array($file_info[0]-$text_width-5,"5");
				break;
				case '4':
				$position=array("5",($file_info[1]-$text_height)/2);
				break;
				case '5':
				$position=array(($file_info[0]-$text_width)/2,($file_info[1]-$text_height)/2);
				break;
				case 6:
				$position=array($file_info[0]-$text_width-5,($file_info[1]-$text_height)/2);
				break;
				case 7:
				$position=array("3",$file_info[1]-$text_height-5);
				break;
				case 8:
				$position=array(($file_info[0]-$text_width)/2,$file_info[1]-$text_height-5);
				break;
				case 9:
				$position=array($file_info[0]-$text_width-10,$file_info[1]-$text_height-10);
				break;
				}
				imagettftext($mark_img,$text_size,0,($position[0]+$text_size),($position[1]+$text_size),$text_color,$font,$text_content);
				switch($file_info[2]){
				case 1:
				imagegif($mark_img,$pic_file);
				break;
				case 2:
				imagejpeg($mark_img,$pic_file);
				break;
				case 3:
				imagepng($mark_img,$pic_file);
				break;
				}
			}
			//图片
			if($_sys['image_type'][0]){
				$logo=CMS_PATH.'upload/'.$_sys['pic'];
				$logo_info=getimagesize($logo);
				switch($logo_info[2]){
 				case 1:
 				$logo_file=imagecreatefromgif($logo);
 				break;
 				case 2:
 				$logo_file=imagecreatefromjpeg($logo);
 				break;
 				case 3:
 				$logo_file=imagecreatefrompng($logo);
 				break;
 				}
				switch($_sys['image_position'][0]){
				case '1':
				$position=array("5","5");
				break;
				case '2':
				$position=array(($file_info[0]-$logo_info[0])/2,"5");
				break;
				case '3':
				$position=array($file_info[0]-$logo_info[0]-5,"5");
				break;
				case '4':
				$position=array("5",($file_info[1]-$logo_info[1])/2);
				break;
				case '5':
				$position=array(($file_info[0]-$logo_info[0])/2,($file_info[1]-$logo_info[1])/2);
				break;
				case 6:
				$position=array($file_info[0]-$logo_info[0]-5,($file_info[1]-$logo_info[1])/2);
				break;
				case 7:
				$position=array("3",$file_info[1]-$logo_info[1]-5);
				break;
				case 8:
				$position=array(($file_info[0]-$logo_info[0])/2,$file_info[1]-$logo_info[1]-5);
				break;
				case 9:
				$position=array($file_info[0]-$logo_info[0]-10,$file_info[1]-$logo_info[1]-10);
				break;
				}
				$logo_img=$php_file;
				imagecopy($logo_img,$logo_file,$position[0],$position[1],0,0,$logo_info[0],$logo_info[1]);
				switch($file_info[2]){
				case 1:
				imagegif($logo_img,$pic_file);
				break;
				case 2:
				imagejpeg($logo_img,$pic_file);
				break;
				case 3:
				imagepng($logo_img,$pic_file);
				break;
				}
				
			}
	
}



//判断访问的设备环境
function is_mb()   
{   
  $_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';   
  $mobile_browser = '0';   
  if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))   
	$mobile_browser++;   
  if((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') !== false))   
	$mobile_browser++;   
  if(isset($_SERVER['HTTP_X_WAP_PROFILE']))   
	$mobile_browser++;   
  if(isset($_SERVER['HTTP_PROFILE']))   
	$mobile_browser++;   
  $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4));   
  $mobile_agents = array(   
		'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',   
		'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',   
		'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',   
		'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',   
		'newt','noki','oper','palm','pana','pant','phil','play','port','prox',   
		'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',   
		'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',   
		'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',   
		'wapr','webc','winw','winw','xda','xda-'  
		);   
  if(in_array($mobile_ua, $mobile_agents))   
	$mobile_browser++;   
  if(strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false)   
	$mobile_browser++;   
  // Pre-final check to reset everything if the user is on Windows   
  if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false)   
	$mobile_browser=0;   
  // But WP7 is also Windows, with a slightly different characteristic   
  if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false)   
	$mobile_browser++;   
  if($mobile_browser>0){   
	return 1;   
  }else{ 
	return 0;
	}	   
}	


?>
