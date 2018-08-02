<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

define('CMS',true);
require_once('../includes/init.php');
$lang = $_REQUEST['lang'];
$fields=$_POST['fields'];
//表单验证码
$feed_code=$_POST['feed_code'];
if(empty($feed_code)){die("<script type=\"text/javascript\">alert('{$language['member_msg2']}');history.go(-1);</script>");}
if($feed_code!=$_SESSION['code']){die("<script type=\"text/javascript\">alert('{$language['member_msg2']}');history.go(-1);</script>");}	

if(empty($fields)||empty($form_id)){die($language['order_msg1']);}
if(file_exists(LANG_PATH.'lang_'.$lang.'.php')){include(LANG_PATH.'lang_'.$lang.'.php');}//语言包缓存,数组$language
if(file_exists(DATA_PATH.'cache_form/form.php')){include(DATA_PATH.'cache_form/form.php');}
if(!empty($form)){
	foreach($form as $k=>$v){
		if($v['id']==$form_id&&!$v['is_disable']){
			$form=$v;
		}
	}
}
if(file_exists(DATA_PATH.'cache_form/field.php')){include(DATA_PATH.'cache_form/field.php');}
$fd=array();
if(!empty($field)){
	foreach($field as $k=>$v){
		if($v['form_id']==$form_id&&$v['field_type']!='checkbox'){
			$fd[]=$v['field_name'];
		}
	}
}
$sql_field='';
$sql_value='';
if(!empty($fields)){
foreach($fields as $key=>$value){
			if(!is_array($value)){
			if(!in_array($key,$fd)){die($language['order_msg1']);}
			}
			$sql_field.=','.$key;
			if(is_array($value)){
				foreach($value as $k=>$v){
					$value_str.=$v.',';
				}
				$value=$value_str;
			}
			$sql_value.=",'".fl_html($value)."'";			
}
}else{
	die($language['order_msg2']);
}
$table=$form['form_mark'];
$tables=$mysql->show_tables();
	if(!in_array(DB_PRE.$table,$tables)){
		die($language['order_msg3']);
	}
$addtime=time();
$ip=fl_value(get_ip());
$ip=fl_html($ip);
$member_id=empty($_SESSION['id'])?0:$_SESSION['id'];
$arc_id=empty($f_id)?0:intval($_POST['f_id']);
$sql="insert into ".DB_PRE."formlist (form_id,form_time,form_ip,member_id,arc_id) values ({$form_id},{$addtime},'{$ip}','{$member_id}','{$arc_id}')";
$mysql->query($sql);
$last_id=$mysql->insert_id();
$sql_field='id'.$sql_field;
$sql_value=$last_id.$sql_value;
$sql="insert into ".DB_PRE."{$table} ({$sql_field}) values ({$sql_value})";
$mysql->query($sql);


//发送邮件
if(!empty($_sys['mail_feed'])){
if(in_array('1',$_sys['mail_feed'])){
	$table=$form['form_mark'];
	if(!empty($table)){
		$rel=$GLOBALS['mysql']->fetch_asc("select*from ".DB_PRE."{$table} where id={$last_id}");
		$rel_arr=$rel[0];

		if(file_exists(DATA_PATH.'cache_form/field.php')){include(DATA_PATH.'cache_form/field.php');}
		
		$hmtl='<table cellpadding="0" cellspacing="0" width="100%">';
 		$hmtl.='<thead>';
		$hmtl.='<tr><th style="width:20%">参数说明</th><th style="width:80%">参数值</th></tr>';
		$hmtl.='</thead>';
		$hmtl.='<tbody>';
		unset($rel_arr['id']);
		if(!empty($rel_arr)){
			foreach($rel_arr as $key=>$value){
				$f_name="<span style=\"clear:red\">不存在该说明</span>";
				if(!empty($field)){
					foreach($field as $k=>$v){
						if($v['field_name']==$key){
							$f_name=$v['use_name'];
						}
					}
				}
				$hmtl.='<tr>';
		  		$hmtl.='<td style="width:20%; text-align:center">'.$f_name.'</td><td style="width:80%">'.$value.'</td>';
				$hmtl.='</tr>';
			}	
		}			
		$hmtl.='</tbody>';
 		$hmtl.='</table>';
		$hmtl.='<div>--------------------------------------------------------------------------------------------------------</div>';
		$hmtl.=$_sys['mail_jw'];
		
	}	
	$_sys['mail_js'] = empty($_sys['mail_js'])?$_sys['mail_mail']:$_sys['mail_js'];
	if($hmtl){
		beescms_smtp_mail($_sys['mail_js'],'','产品订单',$hmtl);
	}	
}	
}
echo "<script type=\"text/javascript\">alert('".$language['order_msg4']."');history.go(-1);</script>";
?>
