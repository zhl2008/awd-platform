// JavaScript Document
$(document).ready(function(){
$('#loading').ajaxStart(function(){
	$(this).show();
}).ajaxStop(function(){
	$(this).hide();
});
});

$(document).ready(function(){

});
//ajax检测函数
//$inpt--检测内容,$query--检测参数,$loading--显示数据
function ajax_check($inpt,$action){
	$($inpt).parent().find('.err').remove();
	$($inpt).parent().find('.ld_ok').remove();
	//$action=$($inpt).attr('id');
	$value=$($inpt).val();
	$($inpt).load('admin_ajax.php',{'action':$action,'value':$value},function($data){
		$($inpt).parent().append($data);
	});
}

//判断值
function check($n){
	$value=$($n).val();
	$rel=true;
	if($value==''){
		$rel=false;	
	}
	return $rel;
}
//点击修改值用于排序
function click_ajax(n,$id,$table,$field,$lang){
	$text=$(n).html();
	if($(n).find('input').length){
		$input=$text;
	}else{
	$input="<input name=\"click_value\" value=\""+$text+"\" style=\"width:50px;\"/>";
	}
	$(n).html('');
	$(n).append($input);
	$(n).find('input').focus().blur(function(){
		$value=$(this).val();
		if(!/^[0-9]+$/.test($value)){
			alert("只能是数字");
			return;
		}
		$(this).load('admin_ajax.php',{'action':'order','value':$value,'id':$id,'table':$table,'field':$field,'lang':$lang},function(){
																					  
		})
		$(n).html($value);
		$(this).remove();
		
		
	})
}

//开启关闭
function click_show($n,$value,$id,$table,$field,$lang,$order){
	$($n).load('admin_ajax.php',{'action':'is_show','value':$value,'id':$id,'table':$table,'field':$field,'lang':$lang,'order':$order},function(data){
		$($n).parent().html(data);
	});
}

