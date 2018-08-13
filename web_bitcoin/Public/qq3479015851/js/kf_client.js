$(document).ready(function() {
    $(".side ul li").hover(function() {
        $(this).find(".sidebox").stop().animate({
            "width": "200px"
        },
        200).css({
            "opacity": "1",
            "filter": "Alpha(opacity=100)",
            "background": "#e74e19"
        })
    },
    function() {
        $(this).find(".sidebox").stop().animate({
            "width": "84px"
        },
        200).css({
            "opacity": "0.8",
            "filter": "Alpha(opacity=80)",
            "background": "#5e5e5e"
        })
    });
    $(".im_client").click(function() {
        var openUrl = "http://btc9.udesk.cn/im_client?web_plugin_id=23806";
        var iWidth = 536;
        var iHeight = 566;
        var iTop = (window.screen.availHeight - 30 - iHeight) / 2;
        var iLeft = (window.screen.availWidth - 10 - iWidth) / 2;
        window.open(openUrl, "", "height=" + iHeight + ",scrollbars=yes, width=" + iWidth + ", top=" + iTop + ", left=" + iLeft)
    })
});
function goTop() {
    $('html,body').animate({
        'scrollTop': 0
    },
    500)
}