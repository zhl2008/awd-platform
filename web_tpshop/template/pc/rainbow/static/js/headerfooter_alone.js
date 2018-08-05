//搜索切换
$(function(){
	$('.sc-icon-right').click(function(){
		$('#dp').parent().show();
	})
	$('#dp').parent().click(function(){
		var su_dp = $('#dp').text();
		var sd =$('#sp').text();
		$('#dp').html(sd);
		$('#sp').html(su_dp);
		$('#dp').parent().hide();
	})
})
//导航下划线跟随
$(function() {
	var speed = 380;
    $('#nav ul li').click(function() {
     var pl = $(this).position().left;
     var liw = $(this).width();
     $('.wrap-line').stop().animate({
         left: pl,
         width: liw
     }, speed);
    })
});
//鼠标滑过延迟
(function($){
    $.fn.hoverDelay = function(options){
        var defaults = {
            hoverDuring: 200,
            outDuring: 200,
            hoverEvent: function(){
                $.noop();
            },
            outEvent: function(){
                $.noop();    
            }
        };
        var sets = $.extend(defaults,options || {});
        var hoverTimer, outTimer, that = this;
        return $(this).each(function(){
            $(this).hover(function(){
                clearTimeout(outTimer);
                hoverTimer = setTimeout(function(){sets.hoverEvent.apply(that)}, sets.hoverDuring);
            },function(){
                clearTimeout(hoverTimer);
                outTimer = setTimeout(function(){sets.outEvent.apply(that)}, sets.outDuring);
            });    
        });
    }      
})(jQuery);

//侧边栏 (单首页)
$(function(){
	//鼠标滑过二维码显示隐藏
	$('.slidebar_alo li').hover(function(){
		$(this).find('.rtipscont').animate({
			opacity:"1",
			left:"-182px"
		})
	},function(){
		$(this).find('.rtipscont').animate({
			opacity:"0",
			left:"0px"
		})
	})
	$(".slidebar_alo .re_top").click(function () {//回到顶部
	    var speed=300;//滑动的速度
	    $('body,html').animate({ scrollTop: 0 }, speed);
	    return false;
	});
	//回到顶部显示隐藏
	$(window).scroll(function ()
	{
		var st = $(this).scrollTop();
		if(st == 0){
			$('.re_top').hide(300)
		}else{
			$('.re_top').show(300)
		}
	});
});
