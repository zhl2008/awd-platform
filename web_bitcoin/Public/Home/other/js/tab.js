function selectTag(showContent,selfObj,name){
    /*// 操作标签
     var tag = document.getElementById("tn_change").getElementsByTagName("li");
     var taglength = tag.length;
     for(i=0; i<taglength; i++){
     tag[i].className = "";
     }
     selfObj.parentNode.className = name;
     // 操作内容
     for(i=0; j=document.getElementById("tagContent"+i); i++){
     j.style.display = "none";
     }
     document.getElementById(showContent).style.display = "block";*/

    var index = showContent.replace('tagContent','');

    if(index == 0){
        $('#tn_change li').eq(0).addClass('selectTagbuy');
        $('#tn_change li').eq(1).removeClass('selectTagsell');
        $('#tn_change li').eq(2).removeClass('selectTagtrust');
    }else if(index == 1){
        $('#tn_change li').eq(0).removeClass('selectTagbuy');
        $('#tn_change li').eq(1).addClass('selectTagsell');
        $('#tn_change li').eq(2).removeClass('selectTagtrust');
    }else if(index == 2){
        $('#tn_change li').eq(0).removeClass('selectTagbuy');
        $('#tn_change li').eq(1).removeClass('selectTagsell');
        $('#tn_change li').eq(2).addClass('selectTagtrust');
    }

    $('#tagContent'+index).show().siblings().hide();
}


$(function(){
    //头部交易中心；
    $('.nav li:eq(1)').css({'position':'relative'}).find('a').css({'width':'120px','text-align':'left','text-indent':'18px','background':'url(/static/newfront/images/huadownsj.png) 93px 32px no-repeat'})
    $('.nav li:eq(1) a').mouseover(function(){
        $(this).css({'background':'url(../images/huaupsj.png) #f4f4f4 93px 34px no-repeat'});
        $(this).next().show();
    })
    $('.nav li:eq(1)').mouseout(function(){
        $(this).find('a').css({'background':'url(../images/huadownsj.png) 93px 32px no-repeat'});
        $(this).find('.typeList').hide();
    })


    $('.typeList p').each(function(){
        $(this).mouseover(function(){
            $(this).css({'color':'#f8b72d'});
            $(this).parent().show();
            $(this).parent().prev().css({'background':'url(../images/huaupsj.png) transparent 93px 34px no-repeat'});
        }).mouseout(function(){
            $(this).css({'color':'#666'});
            $(this).parent().hide();
        })
    })

    // 顶部左侧成交信息mouseover事件
    $('.topheaderleft').mouseenter(function(){
        $('.hideinfoslide').show();
        $('.toprightsj').addClass('active');
    }).mouseleave(function(){
        $('.hideinfoslide').hide();
        $('.toprightsj').removeClass('active');
    });

    // 顶部右侧语言选择mouseenter事件
    $('.toplanguage').mouseenter(function(){
        $('.hselectlang').show();
        $(this).addClass('active');
    }).mouseleave(function(){
        $('.hselectlang').hide();
        $(this).removeClass('active');
    });
    // 语言选择的点击事件
    $('.hselectlang li a').each(function(){
        $(this).click(function(){
            var oSrc = $(this).find('img').attr('src');
            $('.toplanguage').find('.hcurimg').attr('src',oSrc);
            $('.hselectlang').hide();
        })
    })
    // 网站导航的mouseenter事件
    $('.topwapmap').mouseenter(function(){
        $('.wapmaplist').show();
        $('.topwapmap').css({'background-color':'#fff'});
    }).mouseleave(function(){
        $('.wapmaplist').hide();
        $('.topwapmap').css({'background-color':'#000'});
    });

    // 用户信息鼠标事件
    $('.topinfo').mouseenter(function(){
        $(this).css({'background-color':'#fff'});
        $('.infoEmail').addClass('active');
        $('.infoHideDiv').show();
    }).mouseleave(function(){
        $(this).css({'background-color':'#000'});
        $('.infoEmail').removeClass('active');
        $('.infoHideDiv').hide();
    });


    $('.has_huobitype li:even').css({'background':'#fafafa'})
    // 我的资产
    $('.hello').mouseenter(function(){
        $('.hhide_asinfolist').show();
        $('.hshow_asinfort').addClass('active');
    }).mouseleave(function(){
        $('.hhide_asinfolist').hide();
        $('.hshow_asinfort').removeClass('active');
    });
});