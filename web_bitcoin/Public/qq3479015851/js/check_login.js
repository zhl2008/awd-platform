$(function() {
    $("#account").blur(function() {
        if ($(this).val().length < 4) {
            return false
        }
        $.post(_barr.logincheck, {
            'account': $(this).val()
        },
        function(d) {
            if (d.status == 0) {
                layer.msg(d.msg)
            } else if (d.status == 1) {
                $(".google").removeClass("hide");
                $(".login").addClass("top5em")
            } else if (d.status == 2) {
                $(".captcha").removeClass("hide");
                $(".login").addClass("top5em")
            } else if (d.status == 3) {
                $(".captcha").removeClass("hide");
                $(".google").removeClass("hide");
                $(".login").addClass("top3em")
            }
        })
    });
})