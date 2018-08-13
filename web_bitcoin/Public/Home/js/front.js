$(function(){
	$(".pageNum a").click(function(){	
		$(this).addClass("pageNum_curr").siblings().removeClass("pageNum_curr");
	});
	$(".abnav_ul li").click(function(){	
		$(this).children().addClass("li_curr").parent().siblings().children().removeClass("li_curr");
	});
	$(".nav_ul li").click(function(){
		$(this).addClass("nav_curr").siblings().removeClass("nav_curr");
	});
	
	/*选项卡切换*/
	$(".top_content").first().show().nextAll().hide();
	$(".top_loan li").click(function(){
		$(this).addClass("top_loan_hover").siblings().removeClass("top_loan_hover");
		$(".top_content").eq($(".top_loan li").index($(this))).show().siblings().hide();
	});
	
	/*借款进度*/
	//alert($(".pro_wrap").next().text());
	
	$(".loan_pros").each(function(){
		var pro_width = $(this).parent().width();
		var per = parseInt($(this).parent().next().text());
		var prog = (per/100)*pro_width;
		$(this).css("width",prog+"px");
		if(prog == pro_width){
			$(this).css("background","green");
		}
	});
	
});