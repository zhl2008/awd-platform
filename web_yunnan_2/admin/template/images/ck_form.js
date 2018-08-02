/*
	Copyright (C) 2009 - 2012
	Email:		wangking717@qq.com
	WebSite:	Http://wangking717.javaeye.com/
	Author:		wangking
*/
$(function(){
	$("[name='easyTip']").each(function(){
		$(this).addClass("onShow");
	});
	$("[reg]").blur(function(){
		validate($(this));
	});
	
	$("[reg]").click(function(){
		$(this).nextAll("[name='easyTip']").eq(0).removeClass();
		$(this).nextAll("[name='easyTip']").eq(0).addClass("onFocus");				   
	});
	
	$("form").submit(function(){
		var isSubmit = true;
		$("[reg]").each(function(){
			if(!validate($(this))){
				isSubmit = false;
			}
		});
		return isSubmit;
	});
	
});

function validate(obj){
	var reg = new RegExp(obj.attr("reg"));
	var objValue = obj.attr("value");
	var tipObj = obj.nextAll("[name='easyTip']").eq(0);
	tipObj.removeClass();
	if(!reg.test(objValue)){
		tipObj.addClass("onError");
		return false;
	}else{
		tipObj.addClass("onCorrect");
		return true;
	}
}