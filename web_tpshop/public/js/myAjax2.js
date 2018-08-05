/**
 * Created by admin on 2015/9/21.
 */

/**
 *  Ajax通用提交表单
 *  @var  form表单的id属性值  form_id
 *  @var  提交地址 subbmit_url
 */

function post_form(form_id,subbmit_url){
    if(form_id == '' && subbmit_url == ''){
        alert('缺少必要参数');
        return false;
    }
    //  序列化表单值
    var data = $('#'+form_id).serialize();

    $.post(subbmit_url,data,function(result){
        var obj = $.parseJSON(result);
        if(obj.status == 0){
            alert(obj.msg);
            return false;
        }
        if(obj.status == 1){
            alert(obj.msg);
            if(obj.data.return_url){
                //  返回跳转链接
                location.href = obj.data.return_url;
            }else{
                //  刷新页面
                location.reload();
            }
            return;
        }
    })
}


/**
 * 删除
 * @returns {void}
 */
function del_fun(del_url)
{
    if(confirm("确定要删除吗?"))
        location.href = del_url;
}  


// 修改指定表的指定字段值 包括有按钮点击切换是否 或者 排序 或者输入框文字
function changeTableVal(table,id_name,id_value,field,obj)
{	
		var src = "";
		 if($(obj).hasClass('no')) // 图片点击是否操作
		 {          
				//src = '/public/images/yes.png';
				$(obj).removeClass('no').addClass('yes');
				$(obj).html("<i class='fa fa-check-circle'></i>是");
				var value = 1;
				
		 }else if($(obj).hasClass('yes')){ // 图片点击是否操作                     
				$(obj).removeClass('yes').addClass('no');
				$(obj).html("<i class='fa fa-ban'></i>否");
				var value = 0;
		 }else{ // 其他输入框操作
			 var value = $(obj).val();			 
	     }
		                                                  
		$.ajax({
				url:"/index.php?m=Admin&c=Index&a=changeTableVal&table="+table+"&id_name="+id_name+"&id_value="+id_value+"&field="+field+'&value='+value,			
				success: function(data){									
				     if(!$(obj).hasClass('no') && !$(obj).hasClass('yes'))								
					 layer.msg('更新成功', {icon: 1});     
				}
		});		
}

// 给商家用的修改某个表的某个字段  商家是需要判断当前session的
// 修改指定表的指定字段值 包括有按钮点击切换是否 或者 排序 或者输入框文字
function changeTableVal2(table,id_name,id_value,field,obj)
{	
		var src = "";
		 if($(obj).hasClass('no')) // 图片点击是否操作
		 {          
				//src = '/public/images/yes.png';
				$(obj).removeClass('no').addClass('yes');
				$(obj).html("<i class='fa fa-check-circle'></i>是");
				var value = 1;
				
		 }else if($(obj).hasClass('yes')){ // 图片点击是否操作                     
				$(obj).removeClass('yes').addClass('no');
				$(obj).html("<i class='fa fa-ban'></i>否");
				var value = 0;
		 }else{ // 其他输入框操作
			 var value = $(obj).val();			 
	     }
		                                                  
		$.ajax({
				url:"/index.php?m=Seller&c=Index&a=changeTableVal&table="+table+"&id_name="+id_name+"&id_value="+id_value+"&field="+field+'&value='+value,			
				success: function(data){	
				     if(!$(obj).hasClass('no') && !$(obj).hasClass('yes'))								
					 layer.msg('更新成功', {icon: 1});
				}
		});		
}
/*
// 修改指定表的排序字段
function updateSort(table,id_name,id_value,field,obj)
{		       
 		var value = $(obj).val();
		$.ajax({
				url:"/index.php?m=Admin&c=Index&a=changeTableVal&table="+table+"&id_name="+id_name+"&id_value="+id_value+"&field="+field+'&value='+value,			
				success: function(data){									
					layer.msg('更新成功', {icon: 1});   
				}
		});		
}

// 修改指定表的指定字段值 给商家使用的函数
function changeTableVal2(table,id_name,id_value,field,obj)
{
		var src = "";
		 if($(obj).attr('src').indexOf("cancel.png") > 0 )
		 {          
				src = '/public/images/yes.png';
				var value = 1;
				
		 }else{                    
				src = '/public/images/cancel.png';
				var value = 0;
		 }                                                 
		$.ajax({
				url:"/index.php?m=Seller&c=Index&a=changeTableVal&table="+table+"&id_name="+id_name+"&id_value="+id_value+"&field="+field+'&value='+value,			
				success: function(data){									
					$(obj).attr('src',src);           
				}
		});		
}

// 修改指定表的排序字段 给商家使用的函数
function updateSort2(table,id_name,id_value,field,obj)
{		       
 		var value = $(obj).val();
		$.ajax({
				url:"/index.php?m=Seller&c=Index&a=changeTableVal&table="+table+"&id_name="+id_name+"&id_value="+id_value+"&field="+field+'&value='+value,			
				success: function(data){									
					layer.msg('更新成功', {icon: 1});   
				}
		});		
} 
*/
 