function isEmail(str) {
    return new RegExp("^\\w+((-\\w+)|(\\.\\w+))*\\@[A-Za-z0-9]+((\\.|-)[A-Za-z0-9]+)*\\.[A-Za-z0-9]+$").test(str);
}
//初始化邮件Url
function initEmailLoginUrl(email) {
    var loginUrl = getEmailLoginUrl(email);
    if (loginUrl != null) {
        $("#emailLogin").attr("href", loginUrl);
        $("#emailLogin").show();
    } else {
        $("#emailLogin").hide();
    }
}
var emailLoginUrlArrar = ['@gmail.com=http://mail.google.com/',
    '@163.com=http://mail.163.com/',
    '@126.com=http://mail.126.com/',
    '@hotmail.com=http://www.hotmail.com/',
    '@sina.com=http://mail.sina.com/',
    '@vip.sina.com=http://mail.sina.com/',
    '@tom.com=http://mail.tom.com/',
    '@qq.com=http://mail.qq.com/',
    '@139.com=http://mail.10086.cn/',
    '@msn.com=https://login.live.com/login.srf',
    '@sohu.com=http://mail.sohu.com/'];

function getEmailLoginUrl(email) {

    email = email.toLowerCase();
    if (email == "" || !isEmail(email)) {
        return null;
    }
    var index = email.indexOf("@");
    var emailSurfix = email.substring(index, email.length);
    for (var i = 0; i < emailLoginUrlArrar.length; i++) {
        if (emailLoginUrlArrar[i].indexOf(emailSurfix) == 0) {
            return emailLoginUrlArrar[i].split("=")[1];
        }
    }
    return null;
}

function getKey() {
    return  $("#authKey").val();
}


var oldNick = $("#nicknameInput").val();
(function () {
    var reviseNickname = $('.reg-nickname-revise'),
        regNickname = $('#changeNickname');
    var usernamePrompt = {
        onFocus: "4-20位字符，可由中文、英文、数字及“_”、“-”组成",
        succeed: "",
        isNull: "请输入用户昵称",
        error: {
            beUsed: "此昵称已被使用，请更换",
            badLength: "昵称长度只能在4-20位字符之间",
            badFormat: "昵称只能由中文、英文、数字及“_”、“-”组成",
            fullNumberName: "昵称不能全为数字",
            bannedWord: "昵称包含了非法词"
        }
    }
    regNickname.click(function () {
        var self = $(this);
        $("#username_error").empty();
        self.parent().hide();
        reviseNickname.show().focus();
        return false;
    });
    //focus
    reviseNickname.find('.text').focus(function () {
        $(this).addClass('hover');
        if ($('#username_error').length <= 0) {
            var div = $('<div id="username_error"></div>');
            $(this).parent().append(div);
        }
        var uError = $('#username_error');
        uError.html(usernamePrompt.onFocus);
        uError.addClass('focus').removeClass('error');
    });
    reviseNickname.find('.text').blur(function () {
        $(this).removeClass('hover');
        var uError = $('#username_error');
        uError.html('');
    });
    //nickname save
    reviseNickname.find('.j_save').click(function () {
        nicknameParentNode = regNickname.parent();
        var nickName = reviseNickname.find('.text').val();
        var username = $.trim(nickName);
        if (username == oldNick) {
            $("#orgNick").html(username);
            nicknameParentNode.show();
            reviseNickname.hide();
            oldNick = username;
            return;
        }
        var div = $('#username_error');
        if (div.length <= 0) {
            var div = $('<div id="username_error"></div>');
            $(this).parent().append(div);
        }

        if (!userCheck(username)) {
            return;
        }
        div.html("<span style='color:#999'>检验中……</span>");
        $.getJSON("../validate/newNickname?nickname=" + escape(username) + "&k=" + getKey() + "&r=" + Math.random(), function (date) {
            if (date.success == 1) {
                $("#orgNick").html(username);
                $("#safeNick").html(date.safeNick);
                nicknameParentNode.show();
                reviseNickname.hide();
                hello();
                oldNick = username;
            }
            if (date.success == 0) {
                div.html(usernamePrompt.error.beUsed.replace("{1}", username));
                return;
            }
            if (date.success == -5) {
                div.html(usernamePrompt.error.bannedWord);
                return;
            }
            if (date.success == -1) {
                div.html("系统异常，请稍后再试");
                return;
            }
            if (date.success == -4) {
                window.location.href = "http://reg.jd.com/reg/expire";
                return;
            }
        })
    });

    function badFormat(str) {
        return new RegExp("^[A-Za-z0-9_\\-\\u4e00-\\u9fa5]+$").test(str);
    }

    // 用户名验证
    function userCheck(username) {
        var div = $('#username_error');
        var reg = /^[A-Za-z0-9_\\-\\u4e00-\\u9fa5]+$/; //用户名
        var fullNumber = /^[0-9]+$/ //数字
        div.removeClass('focus').addClass('error');
        if (username == "") {
            div.html(usernamePrompt.isNull);
            return false;
        }
        var len = betweenLength(username.replace(/[^\x00-\xff]/g, "**"), 4, 20);
        if (!len) {
            div.html(usernamePrompt.error.badLength);
            return false;
        }
        else if (badFormat(username) == false) {
            div.html(usernamePrompt.error.badFormat);
            return false;
        }
        else if (fullNumber.test(username)) {
            div.html(usernamePrompt.error.fullNumberName);
            return false;
        }
        return true;
    }

    // max and min length
    function betweenLength(str, _min, _max) {
        return (str.length >= _min && str.length <= _max);
    }

    $('#emailStr').focus(function () {

        $("#emailStr").removeClass().addClass("text focus-color");
        $("#email_error").html("");
        $("#email_focus").html("完成验证后，您可以用该邮箱登录京东，找回密码。");
    });
    $('#emailStr').blur(function () {
        $("#email_focus").html("");
        var content = $("#emailStr").val();
        if (content == "请输入您常用的电子邮箱") {
            $("#emailStr").removeClass().addClass("text");
        }
    });
    $('#sendEmail').click(function () {
        sendEmail();
    });
    function strTrim(str) {
        return str.replace(/(^\s*)|(\s*$)/g, "");
    }

    function mobileCodeError(content) {
        $("#smsFocusMessage").removeClass().addClass("sms-tips mobileError").html(content);
        $("#smsFocusDiv").removeClass().addClass("item");
    }

    $('#mobileCode').focus(function () {
        $("#smsErrorDiv").removeClass().addClass("item hide");
        $("#smsErrorMessage").html("");
    });
    // 手机验证
    $('#moblie').bind('focus', function () {
        $("#smsErrorDiv").removeClass().addClass("item hide");
        $("#smsErrorMessage").text("");
        $("#smsFocusDiv").removeClass().addClass("item");
        $("#smsFocusMessage").removeClass().addClass("sms-tips mobileFocus").text("完成验证后，您可以用该手机号登录京东，找回密码。");
    });

    $('#moblie').bind('blur', function () {
        $("#smsFocusDiv").removeClass().addClass("item hide");
        $("#smsFocusMessage").text("");
    });
    $('#send-sms').click(function () {
        var mobile = $('#moblie').val();
        if (mobile == "") {
            mobileCodeError("请输入手机号");
            return;
        }
        mobile = strTrim(mobile);
        var isMobile = new RegExp("^0?(13|15|17|18|14)[0-9]{9}$").test(mobile);
        if (!isMobile || mobile.length > 11) {
            mobileCodeError("手机号码格式有误，请输入正确的手机号。");
            return;
        }
        var self = $(this);
        var data = 'mobile=' + mobile + "&k=" + $("#k").val() + '&r=' + Math.random();
        $.ajax({
            type: "POST",
            url: "../notify/regValidateCode",
            data: data,
            success: function (result) {
                if (result) {
                    var obj = eval(result);
                    if (obj.rs == 1 || obj.remain) {
                        $("#smsErrorMessage").text("");
                        $("#smsFocusDiv").removeClass().addClass("item hide");
                        $("#smsErrorDiv").removeClass().addClass("item hide");
                        if (obj.remain) {
                            $("#successMes").empty().html(obj.remain);
                        } else {
                            $("#successMes").empty().html("验证码已发送，请查收短信。");
                        }
                        $('#sms-box').show();
                        $('#validateMobileDiv').removeClass().addClass("sms-btn");
                        $("#mobileCode").empty();
                        $('#moblie').attr("disabled", "disabled");
                        $('#send-sms').attr("disabled", "disabled");
                        var i = 120;
                        self.removeClass().addClass('reg-btn1').val(i + '秒后重新获取');
                        var timer = setInterval(function () {
                            i--;
                            self.val(i + '秒后重新获取');
                            if (i <= 0) {
                                clearInterval(timer);
                                self.addClass('reg-btn2').val('获取短信验证码');
                                $("#successMes").empty();
                                $('#moblie').attr("disabled", "");
                                $('#send-sms').attr("disabled", "");

                            }
                        }, 1000);
                    }
                    if (obj.rs == -1) {
                        mobileCodeError("手机号码格式有误，请输入正确的手机号。");
                    }
                    if (obj.rs == -5) {
                        window.location.href = "http://reg.jd.com/reg/expire";
                        //mobileCodeError("链接已失效，您可以前往<a href='http://safe.jd.com/user/paymentpassword/safetyCenter.action'>安全中心</a>继续验证。");
                    }
                    if (obj.rs == -7) {
                        mobileCodeError("您已验证过手机，请到<a href='http://safe.jd.com/user/paymentpassword/safetyCenter.action' class='emreg-nickname'>账户安全</a>里查看。");
                    }
                    if (obj.info) {
                        mobileCodeError(obj.info);
                    }
                    if (obj.rs == -2) {
                        mobileCodeError("网络繁忙，请稍后重新获取验证码");
                    }
                }
            }
        });
    });

    function clientError(content) {
        $("#smsErrorMessage").html(content);
        $("#smsErrorDiv").removeClass().addClass("item");
        $("#smsErrorDiv").show();
    }

    var flg = false;
    $('#toValidate').click(function () {
        var mobile = $('#moblie').val();
        mobile = $.trim(mobile);
        if (mobile == "") {
            clientError("请输入手机号")
            return false;
        }
        var mobileCode = $('#mobileCode').val();
        mobileCode = $.trim(mobileCode);
        if (mobileCode == "") {
            clientError("请输入验证码")
            return false;
        }
        var k = $("#k").val();
        var data = 'mobile=' + mobile + "&mobileCode=" + mobileCode + "&k=" + k + '&r=' + Math.random();
        $.getJSON("../reg/validateMobile?" + data, function (result) {
                if (result.success == 1) {
                    window.location.href = "http://reg.jd.com/reg/best?ret=" + result.ret;
                    return;
                }
                if (result.success == -1) {
                    window.location.href = "http://www.jd.com"
                    return;
                }
                if (result.success == -2) {
                    clientError("验证码不正确或已过期");
                    return;
                }
                if (result.success == -3) {
                    clientError("手机被占用");
                    return;
                }
                if (result.success == -4) {
                    clientError("系统异常，请稍后再试");
                    return;
                }
                if (result.success == -5) {
                    clientError("您已验证过手机，请到<a href='http://safe.jd.com/user/paymentpassword/safetyCenter.action' class='emreg-nickname'>账户安全</a>里查看。");
                    return;
                }
                if (result.success == -7) {
                    window.location.href = "http://reg.jd.com/reg/expire";
                    return;
                }
            }
        );
    });
})();

//休眠
function sleep(numberMillis) {
    var now = new Date();
    var exitTime = now.getTime() + numberMillis;
    while (true) {
        now = new Date();
        if (now.getTime() > exitTime)    return;
    }
}

//重新发送邮件
function reSendEmail(email, key) {
    $('#reSendEmailSuccess').hide();
    sleep(500);
    $('#reSendEmailSuccess').removeClass().empty();
    email = $.trim(email);
    if (email == "" || (isEmail(email) == false)) {
        $("#reSendEmailSuccess").removeClass().addClass('check-email-error');
        $("#reSendEmailSuccess").html("请输入有效的邮箱地址");
        return;
    }
    var unbind = $("#state").val();
    $.getJSON("../notifyuser/email?email=" + (email) + "&k=" + key + "&state=" + unbind+ "&r=" + Math.random(), function (result) {
        if (result.success == 1) {
            $('#reSendEmailSuccess').removeClass().empty().html('验证邮件已重新发送');
            $('#reSendEmailSuccess').show();
            initEmailLoginUrl(email);
        }
        if (result.success == 0) {
            $('#reSendEmailSuccess').removeClass().addClass('error').empty().html('该邮箱已被使用，请更换其它邮箱');
            $('#reSendEmailSuccess').show();
        }
        if (result.success == -1) {
            $('#reSendEmailSuccess').removeClass().addClass('error').empty().html('系统异常，请稍后再试 ！');
            $('#reSendEmailSuccess').show();
        }
        if (result.success == -2) {
            $('#reSendEmailSuccess').removeClass().addClass('error').empty().html('您申请发送验证邮件的次数超限，请于24小时后重试！');
            $('#reSendEmailSuccess').show();
        }

        if (result.success == -3) {
            window.location.href = "http://reg.jd.com/reg/expire";
            return;
        }
        if (result.success == -4) {
            $('#reSendEmailSuccess').removeClass().addClass('error').empty().html('该邮箱已注册过京东');
            $('#reSendEmailSuccess').show();
            return;
        }

        if (result.success == -5) {
            $('#reSendEmailSuccess').removeClass().addClass('error').empty().html('请输入有效的邮箱地址');
            $('#reSendEmailSuccess').show();
            return;
        }
        $('#reSendEmailSuccess').show();
        //setTimeout(hideEmailSendResult, 5000);
    });
}