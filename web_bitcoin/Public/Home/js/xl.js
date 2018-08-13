// JavaScript Document
$(function() {		

		$(".nav_main > ul > li").hover(function(){
			if($(this).find(".h_menu").length>0){
			$(this).find(".h_menu").stop(false,true).slideDown(500);
			$(".bar").stop(false,true).slideDown(500);
			$(".nav-tzgg").stop(false,true).slideUp(500);}
			else{$(".bar").stop(false,true).slideUp(500);
		$(".nav-tzgg").stop(false,true).slideDown(500);		 }
		},function(){
			$(this).find(".h_menu").stop(false,true).slideUp(500);
		
		})
		$(".nav-zdh").hover(function(){},function(){
			$(".bar").stop(false,true).slideUp(500);
			$(".nav-tzgg").stop(false,true).slideDown(500);		 
			 })

		//滚动开始
		
		var sdf;
		function srollaut(){
		clearTimeout(sdf);
		if($(".nav-tzggleft").scrollTop()>=parseInt($(".nav-tzggleft ul").css("height"))-40){
			$(".nav-tzggleft").animate({scrollTop:0},"slow");
			sdf=setTimeout(srollaut,4000)
		}
		else{
			$(".nav-tzggleft").animate({scrollTop:$(".nav-tzggleft").scrollTop()+35},"slow");
			sdf=setTimeout(srollaut,4000)}
			}
		sdf=setTimeout(srollaut,3000);
		
		$(".nav-tzggleft").hover(function(){
			clearTimeout(sdf);
		},function(){
			sdf=setTimeout(srollaut,1000)
		})
		//第二个滚动效果
		//滚动开始
		
		var sdfd;
		function srollaut2(){
		clearTimeout(sdfd);
		if($(".nav-tzggright").scrollTop()>=parseInt($(".nav-tzggright ul").css("height"))-40){
			$(".nav-tzggright").animate({scrollTop:0},"slow");
			sdfd=setTimeout(srollaut2,4000)
		}
		else{
			$(".nav-tzggright").animate({scrollTop:$(".nav-tzggright").scrollTop()+35},"slow");
			sdfd=setTimeout(srollaut2,4000)}
			}
		sdfd=setTimeout(srollaut2,3000);
		
		$(".nav-tzggright").hover(function(){
			clearTimeout(sdfd);
		},function(){
			sdfd=setTimeout(srollaut2,1000)
		})
		
			
		})
function dqzt(a){
		$(".nav_main > ul > li").removeClass("nav_first");
		$(".nav_main > ul > li").eq(a).addClass("nav_first");
	}