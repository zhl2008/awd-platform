<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>欢迎登录网站后台管理系统</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link href="/Public/Admin/images/favicon.ico" type="image/x-icon" rel="shortcut icon">
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/login.css" media="all">
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/default_color.css" media="all">
</head>
<body id="login-page">
<div id="main-content">

    <div class="login-body">
        <div class="login-main pr">
            <form action="<?php echo U('Login/index');?>" method="post" class="login-form">
                <h3 class="welcome">网站后台管理系统</h3>

                <div id="itemBox" class="item-box">
                    <div class="item">
                        <i class="icon-login-user"></i> <input type="text" name="username" placeholder="请填写用户名"
                                                               autocomplete="off"/>
                    </div>
                    <span class="placeholder_copy placeholder_un">请填写用户名</span>

                    <div class="item b0">
                        <i class="icon-login-pwd"></i> <input type="password" name="password" placeholder="请填写密码"
                                                              autocomplete="off"/>
                    </div>
                    <span class="placeholder_copy placeholder_pwd">请填写密码</span>

                    <div class="item verifycode">
                        <i class="icon-login-verifycode"></i> <input type="text" name="verify" placeholder="请填写验证码"
                                                                     autocomplete="off">
                        <a class="reloadverify" title="换一张" href="javascript:void(0)">换一张？</a>
                    </div>
                    <span class="placeholder_copy placeholder_check">请填写验证码</span>

                    <div>
                        <img class="verifyimg reloadverify" alt="点击切换" src="<?php echo U('Verify/code');?>" style="height: 50px;">
                    </div>
                </div>
                <div class="login_btn_panel">
                    <button class="login-btn" type="submit">
                        <span class="in"><i class="icon-loading"></i>登 录 中 ...</span> <span class="on">登 录</span>
                    </button>
                    <div class="check-tips"></div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="/Public/Admin/js/jquery.min.js"></script>
<script type="text/javascript">
    var random_bg = Math.floor(Math.random() * 10 + 1);
    var bg = 'url(/Public/Admin/images/bg_' + random_bg + '.jpg)';
    $("body").css("background-image", bg);


    /* 登陆表单获取焦点变色 */
    $(".login-form").on("focus", "input", function () {
        $(this).closest('.item').addClass('focus');
    }).on("blur", "input", function () {
        $(this).closest('.item').removeClass('focus');
    });

    //表单提交
    $(document).ajaxStart(function () {
        $("button:submit").addClass("log-in").attr("disabled", true);
    }).ajaxStop(function () {
        $("button:submit").removeClass("log-in").attr("disabled", false);
    });

    $("form").submit(function () {
        var self = $(this);
        $.post(self.attr("action"), self.serialize(), success, "json");
        return false;

        function success(data) {
            if (data.status) {
                window.location.href = data.url;
            } else {
                self.find(".check-tips").text(data.info);
                //刷新验证码
                $(".reloadverify").click();
            }
        }
    });

    $(function () {
        //初始化选中用户名输入框
        $("#itemBox").find("input[name=username]").focus();
        //刷新验证码
        var verifyimg = $(".verifyimg").attr("src");
        $(".reloadverify").click(
                function () {
                    if (verifyimg.indexOf('?') > 0) {
                        $(".verifyimg").attr("src",
                                verifyimg + '&random=' + Math.random());
                    } else {
                        $(".verifyimg").attr(
                                "src",
                                verifyimg.replace(/\?.*$/, '') + '?'
                                + Math.random());
                    }
                });

        //placeholder兼容性
        //如果支持
        function isPlaceholer() {
            var input = document.createElement('input');
            return "placeholder" in input;
        }

        //如果不支持
        if (!isPlaceholer()) {
            $(".placeholder_copy").css({
                display: 'block'
            })
            $("#itemBox input").keydown(function () {
                $(this).parents(".item").next(".placeholder_copy").css({
                    display: 'none'
                })
            })
            $("#itemBox input").blur(
                    function () {
                        if ($(this).val() == "") {
                            $(this).parents(".item").next(
                                    ".placeholder_copy").css({
                                display: 'block'
                            })
                        }
                    })

        }
    });
</script>
</body>
</html>