<?php
/**
* Author:sqlgun
* Email:sqlgun@qq.com
* Date: 2011-5-28
* http://hi.baidu.com/sqlgun
*/
if(!defined('GUY')){
	exit('getout!');
}

function echoalert($_info) {
	echo"<script type='text/javascript'>alert('$_info');</script>";
}

function echoalerthistory($_info){
	echo"<script type='text/javascript'>alert('$_info');history.back();</script>;";
}

function tree($_id,$_num){

$_results=mysql_query("select id,class from class where uptypeid='{$_id}'");
while(!!$_row=mysql_fetch_array($_results,MYSQL_ASSOC)){
echo "<option value='".$_row['class']."'>".str_repeat('　',$_num)."|-{$_row['class']}</option>";
tree($_row['id'],$_num+1);
}
}

function trees($_id,$_num){

$_results=mysql_query("select id,class from class where uptypeid='{$_id}'");
while(!!$_row=mysql_fetch_array($_results,MYSQL_ASSOC)){
echo "<option value='".$_row['id']."'>".str_repeat('　',$_num)."|-{$_row['class']}</option>";
trees($_row['id'],$_num+1);
}
}

?>