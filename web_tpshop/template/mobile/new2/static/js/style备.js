/*
 * Public js
 */
//导航颜色
$(function(){
	var hes = $(window).scrollTop();
	$('header').css("opacity","1");
	if(hes != 0){
   	  	$('header').addClass('headerbg');
    }
	$(window).scroll(function(){
          var hei = $(window).scrollTop();
          var ban1 = $('header').height();
   	  	  if(hei > ban1){
   	  	  	$('header').addClass('headerbg');
   	  	  }else{
   	  	  	$('header').removeClass('headerbg');
   	  	  };

	});
});

//回到顶部
$(function(){
	$("footer .comebackTop").click(function () {
	        var speed=300;//滑动的速度
	        $('body,html').animate({ scrollTop: 0 }, speed);
	        return false;
	});
});


//底部导航
$(function(){
	$(".footer ul li a").click(function () {
	        $(this).addClass('yello').parent().siblings().find('a').removeClass('yello')
	});
});

//轮播
$(function(){
    $('#slideTpshop').swipeSlide({
        continuousScroll:true,
        speed : 3000,
        transitionType : 'cubic-bezier(0.22, 0.69, 0.72, 0.88)',
        firstCallback : function(i,sum,me){
            me.find('.dot').children().first().addClass('cur');
        },
        callback : function(i,sum,me){
            me.find('.dot').children().eq(i).addClass('cur').siblings().removeClass('cur');
        }
    });
    //圆点
    var ed = $('.mslide ul li').length - 2; 
	$('.mslide').append("<div class=" + "dot" + "></div>"); 
	for(var i = 0; i<ed ;i++){
		$('.mslide .dot').append("<span></span>"); 
	}; 
	$('.mslide .dot span:first').addClass('cur'); 
	var wid = - ($('.mslide .dot').width() / 2);
	$('.mslide .dot').css('position','absolute').css('left','50%').css('margin-left',wid);
});

//radio选中
$(function(){
	$('.radio .che').click(function(){
		$(this).toggleClass('check_t');
	})
})
$(function(){
	$('.radio .all').click(function(){
		$(this).siblings().toggleClass('check_t');
	})
})


$(function(){
	//头部菜单
	$('.classreturn .menu a:last').click(function(e){
		$('.tpnavf').toggle();
		e.stopPropagation();
	});
	$('body').click(function(){
		$('.tpnavf').hide();
	});
	//左侧导航
	$('.classlist ul li').click(function(){
		$(this).addClass('red').siblings().removeClass('red');
	});
})

//黑色遮罩层-隐藏
function undercover(){
	$('.mask-filter-div').hide();
}
//黑色遮罩层-显示
function cover(){
	$('.mask-filter-div').show();
}
//action文件导航切换
$(function(){
	$('.paihang-nv ul li').click(function(){
		$(this).addClass('ph').siblings().removeClass('ph');
	})
})
//确认收货和催单
$(function(){
	$('.receipt').click(function(){
		$('.surshko').show();
		cover();
	})
	$('.weiyi a').click(function(){
		$('.surshko').hide();
		undercover();
	})
});
$(function(){
	$('.tuid').click(function(){
		$('.cuidd').show();
		cover();
	})
	$('.weiyi a').click(function(){
		$('.cuidd').hide();
		undercover();
	})
});
//字数限制
function checkfilltextarea(tea,nums){
   var len = $(tea).val().length;
   if(len > nums){
    $(tea).val($(tea).val().substring(0,nums));
   }
   var num = nums - len;
   $("#zero").text(num);
}