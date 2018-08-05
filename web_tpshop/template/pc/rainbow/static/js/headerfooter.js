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

//图片懒加载
$("img.lazy").lazyload({
  placeholder : "images/white.gif", //用图片提前占位
    // placeholder,值为某一图片路径.此图片用来占据将要加载的图片的位置,待图片加载时,占位图则会隐藏
  effect: "fadeIn", // 载入使用何种效果
    // effect(特效),值有show(直接显示),fadeIn(淡入),slideDown(下拉)等,常用fadeIn
  threshold: 20, // 提前开始加载
    // threshold,值为数字,代表页面高度.如设置为200,表示滚动条在离目标位置还有200的高度时就开始加载图片,可以做到不让用户察觉
  //event: 'click',  // 事件触发时才加载
    // event,值有click(点击),mouseover(鼠标划过),sporty(运动的),foobar(…).可以实现鼠标莫过或点击图片才开始加载,后两个值未测试…
  //container: $("#container"),  // 对某容器中的图片实现效果
    // container,值为某容器.lazyload默认在拉动浏览器滚动条时生效,这个参数可以让你在拉动某DIV的滚动条时依次加载其中的图片
  //failure_limit : 10 // 图片排序混乱时
     // failure_limit,值为数字.lazyload默认在找到第一张不在可见区域里的图片时则不再继续加载,但当HTML容器混乱的时候可能出现可见区域内图片并没加载出来的情况,failurelimit意在加载N张可见区域外的图片,以避免出现这个问题.
	vertical_only: false,
	no_fake_img_loader:true
});
//首页和商品列表不共用
$("img.lazy-list").lazyload({
	placeholder : "images/white.gif",
	effect: "fadeIn",
	threshold: 20,
	vertical_only: false,
	no_fake_img_loader:true
});

//侧边栏
$(function(){
	$('.shop-car').click(function(){//购物车
		if($('.shop-car-sider').hasClass('sh-hi')){
			$('.shop-car-sider').animate({left:'35px',opacity:'hide'},'normal',function(){
				$('.shop-car-sider').removeClass('sh-hi');
				$('.shop-car .tab-cart-tip-warp-box').css('background-color','');
				$('.shop-car .tab-icon-tip').removeClass('jsshow');
			});
		}else{
			$('.shop-car-sider').animate({left:'-280px',opacity:'show'},'normal',function(){
				$('.shop-car-sider').addClass('sh-hi');
				$('.shop-car .tab-cart-tip-warp-box').css('background-color','#e23435');
				$('.shop-car .tab-icon-tip').addClass('jsshow');
			});
		}
		
	})
	$(".comebacktop").click(function () {//回到顶部
	    var speed=300;//滑动的速度
	    $('body,html').animate({ scrollTop: 0 }, speed);
	    return false;
	});
});