var param = {};

/**   
*    
* @Description 发送post请求 当有拦截器返回信息进行处理
* @param url 请求地址
* @param param 请求参数
* @param callBack 成功后回调方法
* @Author Yang Cheng
* @Date: 2012-2-17 18：00  
* @Version  1.0
*    
*/ 
$.shovePost = function(url,param,callBack){
	url = url+"?shoveDate"+new Date().getTime();
	$.post(url,param,function(data){
		if(data == "noLogin"){
			window.location.href="login.html";
			return;
		}
		if(data=="network"){
		   window.location.href="weihui.jsp";
		  return;
		}
		if(data=="virtual"){
		   window.location.href="noPermission.action";
		  return;
		}
		if(data == "pagejump"){
			window.location.href="adminMessage.action";
			return;
		}
		callBack(data);
	});
}

/**   
*    
* @Description 跳转页面方法
* @param i 跳转页数
* @Author Yang Cheng
* @Date: 2012-2-17 18：10
* @Version  1.0
*    
*/
function doJumpPage(i){
	//if(i==""){
	//	alert("输入格式不正确12!");
	//	return;
	//}
	if(isNaN(i)){
		alert("输入格式不正确!");
		return;
	}
	$("#pageNum").val(i);
	param["pageBean.pageNum"]=i;
	//回调页面方法
	initListInfo(param);
}

function checkbox_All_Reverse(obj,itemName){
	$("input[name=" + itemName + "]").attr("checked",obj.checked);
}

//表格隔行变色
function trEvenColor(){
	$("#tableTr tr:even").css("background-color","#f9f9f9");
}

function setCookies(cookieName,value,days){
	$.cookie(cookieName, value, { expires: days });
}
function getCookies(cookieName){
	return $.cookie(cookieName);
}

 function getFlexObject(movieName) {   
    return document[movieName];   
}

$(function(){
	trEvenColor();
})

function hideAndShow(str){
	$(str).hide();
	$(str).show();
}
