// JavaScript Document

$(document).ready(function(){
	$('form').find('input').blur(function(){
		$(this).parent().find('.err').remove();
		if($(this).is('.is_empty')){
			//alert('11');
			if(this.value==''){
				$str="<span class=\"err\">不能为空或含有其它字符</span>";
				$(this).parent().append($str);
			}
		}
	});
	
	$('form').submit(function(){
		$('input').trigger('blur');
		if($('form').find('#cate').val()==''){
			alert('栏目不能为空');
			return false;
		}
		$err=$('.err',this).length;
		if($err){
			var $err_array=[];
			$('.err').each(function(){
				$st_name=$(this).parent().find('input').attr('title');
				$err_str="【"+$st_name+"】"+$(this).text();
				$err_array.push($err_str);
			});
			alert($err_array.join('\n'));
			return false;
		}
	});

});


