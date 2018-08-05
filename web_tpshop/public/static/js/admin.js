$(function() {
    //操作提示缩放动画
    $("#checkZoom").toggle(
        function() {
            $("#explanation").animate({
                color: "#FFF",
                backgroundColor: "#4FD6BE",             
                width: "80",
                height: "20",				              
            },300);
            $("#explanationZoom").hide();
        },
        function() {
            $("#explanation").animate({
                color: "#2CBCA3",
                backgroundColor: "#EDFBF8",
                width: "99%",
                height: "20",
            },300,function() {
                $(this).css('height', '100%');
            });
            $("#explanationZoom").show();
        }
    );

    //自定义radio样式
    $(".cb-enable").click(function(){
        var parent = $(this).parents('.onoff');
        $('.cb-disable',parent).removeClass('selected');
        $(this).addClass('selected');
        $('.checkbox',parent).attr('checked', true);
    });
    $(".cb-disable").click(function(){
        var parent = $(this).parents('.onoff');
        $('.cb-enable',parent).removeClass('selected');
        $(this).addClass('selected');
        $('.checkbox',parent).attr('checked', false);
    });
    

    // 显示隐藏预览图 start
    $('.show_image').hover(
        function(){
            $(this).next().css('display','block');
        },
        function(){
            $(this).next().css('display','none');
        }
    );

    // 全选 start
    $('.checkall').click(function(){
        $('.checkall').attr('checked',$(this).attr('checked') == 'checked');
        $('.checkitem').each(function(){
            $(this).attr('checked',$('.checkall').attr('checked') == 'checked');
        });
    });
    
    
    $("#btnGet").click(function () {
        $("body,html").animate({ scrollTop: 480 }, 800);
    });
    var isPostback = 'False';
    /* BACK TO TOP */
        if (isPostback == "False") {
            /* 窗体滚动事件 */
            $(window).scroll(function () {
                //判断滚动条的垂直位置是否大于0，说白了就是：判断滚动条是否在顶部
                if ($(window).scrollTop() <= 0) {
                    $("#goTop").stop(true, false).animate({ bottom: "-156px" }, 500); //动画隐藏ID="doTop"的这个层
                } else {
                    $("#goTop").stop(true, false).animate({ bottom: "30px" }, 500);  //动画显示ID="doTop"的这个层
                }
            });
            /* 此方法可以不加，这里加这个的目的是去除在IE下点击出现的虚线框 */
            $("button").click(function () {
                if (this.focus) {
                    this.blur();
                }
            })
            /* 点击返回顶部箭头的事件 */
            $("#btntop").click(function () {
                $("body,html").animate({ scrollTop: 0 }, 500); //返回顶部，用JQ的animate动画
            });
            /* 点击返回底部箭头的事件 */
            $("#btnbottom").click(function () {
                $("body,html").animate({ scrollTop: document.body.clientHeight }, 500); //返回底部，用JQ的animate动画
            });
            var adsId = '14406';
            if (adsId == "13868" || adsId == "14406") {
                setTimeout('$(".slidePopupBox").slideUp("slow")', 1500);
            } else {
                $(".slidePopupBox").hide();
            }
        } else {
            $(".slidePopupBox").hide();
        }
        
        
        // 高级搜索边栏动画
		$('#searchBarOpen').click(function() {
            $('.ncap-search-ban-s').animate({'right': '-40px'},200,
            function() {
                $('.ncap-search-bar').animate({'right': '0'},300);
            });
        });
        $('#searchBarClose').click(function() {
            $('.ncap-search-bar').animate({'right': '-240px'}, 300,
            function() {
                $('.ncap-search-ban-s').animate({'right': '0'},  200);
            });            
        });
		// 搜索项目过多时出现滚动条
    	$('#searchCon').height($(window).height()-90).perfectScrollbar();
        
});


/* 火狐下取本地全路径 */
function getFullPath(obj)
{
    if(obj)
    {
        // ie
        if (window.navigator.userAgent.indexOf("MSIE")>=1)
        {
            obj.select();
            if(window.navigator.userAgent.indexOf("MSIE") == 25){
                obj.blur();
            }
            return document.selection.createRange().text;
        }
        // firefox
        else if(window.navigator.userAgent.indexOf("Firefox")>=1)
        {
            if(obj.files)
            {
                //return obj.files.item(0).getAsDataURL();
                return window.URL.createObjectURL(obj.files.item(0)); 
            }
            return obj.value;
        }
        return obj.value;
    }
}

$(function(){
	$(".bDiv").scroll(function(){
	    var bdiv = $(".bDiv").scrollLeft();
	    $('.hDiv').css('overflow','auto').scrollLeft(bdiv);
	});
})