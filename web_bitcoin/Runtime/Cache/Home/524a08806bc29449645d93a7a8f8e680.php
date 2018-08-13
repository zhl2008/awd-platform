<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title><?php echo C('web_title');?></title>
<meta name="Keywords" content="<?php echo C('web_keywords');?>">
<meta name="Description" content="<?php echo C('web_description');?>">
<meta name="author" content="comfile">
<meta name="coprright" content="comfile">
<link rel="shortcut icon" href="/favicon.ico"/>
<link rel="stylesheet" href="/comfile/css/font-awesome.min.css">
<link rel="stylesheet" href="/comfile/css/style.css" id="theme"/>
<link rel="stylesheet" href="/comfile/css/common.css"/>
<script type="text/javascript" src="/comfile/js/jquery.min.js"></script>
<script type="text/javascript" src="/comfile/js/jquery.cookies.2.2.0.js"></script>
<script type="text/javascript" src="/comfile/js/layer.js"></script>
<script type="text/javascript" src="/comfile/js/posfixed.js"></script>
<script type="text/javascript" src="/comfile/js/dot.min.js"></script>
<link rel="stylesheet" href="/comfile/css/slider.css">
<script type="text/javascript" src="/comfile/js/slider.js"></script>
</head>
<body lang="zh-CN">
<!--[if lt IE 10]>
<div id="kie-bar" class="kie-bar ">
    您现在使用的浏览器版本过低，可能会导致浏览效果和信息的缺失。 建议立即升级到
    <a href="http://rj.baidu.com/soft/detail/14917.html" target="_blank" title="免费升级至IE8浏览器">IE 10+</a> 或
    <a href="http://rj.baidu.com/soft/detail/14744.html" target="_blank" title="免费升级至360安全浏览器">谷歌浏览器</a> 或
    <a href="http://rj.baidu.com/soft/detail/17451.html" target="_blank" title="免费升级至360安全浏览器">360安全浏览器</a> ，安全更放心！
</div><![endif]-->
<div id="roebx_header" style=" display:none;z-index: 999;min-width: 1200px;width:100%;" ;>
    <div class="header">
        <div class="header-content">
            <ul class="trade-status">

                <li style="padding: 0px 10px 0px 0px;">
                    <i class="fa fa-home fa-lg left move mr5"></i> 
					<span><?php echo C('top_name');?></span>
                </li>
            </ul>
            <ul class="user-status">
				
				<?php if(($_SESSION['userId']) > "0"): ?><li>
                    <i class="fa fa-user fa-lg left move mr5"></i>
                    <a href="/finance/" id="user_top" class="move"><?php echo (session('userName')); ?></a>
                    <div id="mywallet_list" class="mywallet_list" style="display: none;">
                        <div class="clear">
                            <ul class="freeze_list">
                                <h4>可用人民币</h4>
                                <li style=" padding: 0;">
                                    <a href="javascript:void(0)">
                                        <img src="/Upload/coin/cny.png" width="18" class="left mt5 mr5">
                                        <span class="fz_14"><?php echo ($userCoin_top['cny']*1); ?></span></a>
                                </li>
                            </ul>
                            <ul class="freeze_list">
                                <h4>冻结人民币</h4>
                                <li style=" padding: 0;">
                                    <a href="javascript:void(0)">
                                        <img src="/Upload/coin/cny.png" width="18" class="left mt5 mr5">
                                        <span class="fz_14"><?php echo ($userCoin_top['cnyd']*1); ?></span></a>
                                </li>
                            </ul>
                            <ul class="balance_list">
                                <h4>人民币总资产:</h4>
                                <li style=" padding: 0;">
                                    <a href="javascript:void(0)">
                                        <img src="/Upload/coin/cny.png" width="18" class="left mt5 mr5 ">
                                        <span class="fz_14"><?php echo ($userCoin_top['allcny']*1); ?></span></a>
                                </li>
                            </ul>
                        </div>
                        <div class="mywallet_btn_box">
                            <a href="/Finance/mycz.html" class="texts">人民币充值</a>
                            <a href="/Finance/mytx.html" class="texts">人民币提现</a>
                            <a href="/Finance/index.html" class="texts">财务中心</a>
                            <a href="/User/index.html" class="texts">安全中心</a>
                        </div>
                        <i class="fa fa-caret-up move" style="position: absolute;top: -21px;right: 34px;font-size: 28px;"></i>
                        <div class="nocontent"></div>
                    </div>
                </li>
                <li>
                    <a href="<?php echo U('Login/loginout');?>" class="">退出</a>
                </li>
				<?php else: ?>
				
                <li>
                    <i class="fa fa-user left move fz_16"></i> <a href="<?php echo U('Login/register');?>" class="ma-l move"> 注册</a>
                </li>

                <li>
                    <a href="javascript:loginpop();" class="darker">登录</a>
                </li><?php endif; ?>
				
				
				
				
				
				
				
				
				
            </ul>
        </div>
    </div>
</div>
<style>
.header-mark {
    position: relative;
    top: 0;
    left: 0;
    z-index: 1000;
    opacity: .25;
    filter: alpha(opacity = 25);
    background: #000;
    width: 100%;
    height: 78px;
}

.common-nav a, .crumbs-content a {
    color: #fff;
}

.common-nav{
	position:absolute;
	top:0px;
	left:0px;
	z-index:9999999999;width:100%;
	background-color:#015FD9;

}

li.active > a{
	color:#da2e22;
}

</style>
<div class="header-mark"></div>
<div class="common-nav">
    <div class="nav-bar">
        <div class="logo" style="margin-top: 12px;">
            <a href="/" class="xiaozhu-logo"> 
				<img src="/Upload/public/<?php echo ($C['web_logo']); ?>" alt=""/>
			</a>         
		</div>
        <div class="nav-content">
            <ul class="common-nav-list">
                <li id="index_box">
                    <a href="/">首页</a>
                </li>
                <li id="trade_box">
                    <a href="#" id="trade_top" class="darker">交易中心                    
						<i class="fa fa-angle-down"></i> 
					</a>
                    
					
					
					
                   <script id="trade_list_tpl" type="text/x-dot-template">
                        <ul id="trade-nav-tabs">
                            {{ for(var k in it) { }}
                            <li class="trade-tab {{? k == 0}}current{{?}}">
                                {{=it[k]['title']}}
                            </li>
                            {{ } }}
                        </ul>
                        <div id="trade-nav-body">
                            {{ for(var k in it) { }} {{? k == 0}}
                            <dl style="display: block">
                                {{??}}
                                <dl style="display: none">
                                    {{?}} {{ for(var kk in it[k]['data']) { }}
                                    <dd>
                                        <a style="color:#000;" href="/trade/index/market/{{=kk}}"><img src="/upload/coin/{{=it[k]['data'][kk]['img']}}" style="width: 18px;vertical-align: -4px;margin-right: 5px;">{{=it[k]['data'][kk]['title']}}</a>
                                    </dd>
                                    {{ } }}
                                </dl>
                                {{ } }}
                            </dl>
                        </div>
                        <i class="fa fa-caret-up move" style="position: absolute;top: -21px;left: 18px;font-size: 28px;"></i>
                        <div class="nocontent"></div>
                    </script>

                    <div id="trade_list" class="deal_list " style="left:1px;     top: 80px;">
                    </div>
                    </li>
					
					
					
					<?php if(is_array($daohang)): $i = 0; $__LIST__ = $daohang;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li id="<?php echo ($vo['name']); ?>_box">
							<a href="/<?php echo ($vo['url']); ?>"><?php echo ($vo['title']); ?></a>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>	

					<?php if(($_SESSION['userId']) > "0"): ?><li id="">
							<a href="/login/loginout.html">退出</a>
						</li><?php endif; ?>
					
						
				</ul>
        </div>
    </div>
</div>
<script>
    $('#trade_top').hover(function () {
        $('#trade_list').show();
    }, function () {
        $('#trade_list').hide();
    });
    $('#trade_tops').hover(function () {
        $('#trade_lists').show();
    }, function () {
        $('#trade_lists').hide();
    });
    $('#trade_list').hover(function () {
        $('#trade_list').show();
    }, function () {
        $('#trade_list').hide();
    });
    $('#trade_lists').hover(function () {
        $('#trade_lists').show();
    }, function () {
        $('#trade_lists').hide();
    });
    $.post("/ajax/top_coin_menu?t=" + Math.random(), function (data) {
        if (data) {
            var interText = doT.template($("#trade_list_tpl").text());
            var interTexts = doT.template($("#trade_list_tpls").text());
            $("#trade_list").html(interText(data));
            $("#trade_lists").html(interTexts(data));
            var $li = $('#trade-nav-tabs > li');
            var $lis = $('#trade-nav-tabss > li');
            var $ul = $('#trade-nav-body > dl');
            var $uls = $('#trade-nav-bodys > dl');
            $li.mouseover(function () {
                var $this = $(this);
                var $t = $this.index();
                $li.removeClass();
                $this.addClass('current');
                $ul.css('display', 'none');
                $ul.eq($t).css('display', 'block');
            })
            $lis.mouseover(function () {
                var $this = $(this);
                var $t = $this.index();
                $lis.removeClass();
                $this.addClass('current');
                $uls.css('display', 'none');
                $uls.eq($t).css('display', 'block');
            })
        }
    }, "json");
    $('#game_top').hover(function () {
        $('#game_list').show();
    }, function () {
        $('#game_list').hide();
    });
    $('#game_list').hover(function () {
        $('#game_list').show();
    }, function () {
        $('#game_list').hide();
    });
    $('#user_top').hover(function () {
        $('#mywallet_list').show();
    }, function () {
        $('#mywallet_list').hide();
    });
    $('#mywallet_list').hover(function () {
        $('#mywallet_list').show();
    }, function () {
        $('#mywallet_list').hide();
    });
</script>
<script>
    $(document).ready(function () {
        $("#roebx_header").posfixed({});
    });
</script>

<!-- top 结束  -->


<div class="autobox">
	<div class="now">
		<i class="fa fa-home fa-lg move mr5"></i><a href="/" class="">首页 </a>&gt; 注册账户	</div>
	<div class="login_step">
		<ul class="order clear">
			<li><i class="fa fa-circle  fz_40 move"><span>1</span></i> 用户注册				<div class="order_line"></div>
			</li>
			<li><i class="fa fa-circle  fz_40"><span>2</span></i>交易密码				<div class="order_line"></div>
			</li>
			<li><i class="fa fa-circle  fz_40"><span>3</span></i>实名认证				<div class="order_line"></div>
			</li>
			<li><i class="fa fa-circle  fz_40"><span>4</span></i>成功</li>
		</ul>
	</div>
	<div class="reg_box ">
		<div class="mt50">
			<div id="reg_index" class="reg_wrap">
				<div class="reg_input_box reg-fb" id="email_reg">
					<div class="reg_title">手机号：</div>
					<input type="text" id="mobles" class="texts" style="display: none;"> 
					<input type="text" id="moble" class="texts wh300 hg40" placeholder="请输入手机号码" onblur="check_moble()" style="padding-left: 40px;    width: 295px;"/>
					<link rel="stylesheet" href="/comfile/css/intlTelInput.css">
					<script src="/comfile/js/intlTelInput.js"></script>
					<script>
						$("#mobles").intlTelInput({
							autoHideDialCode: false,
							defaultCountry: "cn",
							nationalMode: false,
							preferredCountries: ['cn', 'us', 'hk', 'tw', 'mo'],
						});
					</script>
					<a class="move" onclick="new_sends()">点击发送验证码</a>
				</div>
				<div class="reg_input_box reg-fb">
					<div class="reg_title">验证码：</div>
					<input id="moble_verify" type="text" class="texts w300 hg40" placeholder="请输入验证码"> <span id="reg_moble" class="" style="position: absolute;
    left: 210px;top: 2px;"></span>
				</div>
				<div class="reg_input_box reg-fb">
					<div class="reg_title">密码：</div>
					<input type="password" id="password" class="texts w300 hg40" placeholder="请输入登陆密码" style="line-height: 34px;"/>
				</div>
				<!-- <div class="reg_input_box reg-fb">
					<div class="reg_title">邀请码：</div>
					<input id="invit" type="text" class="texts w300 hg40" placeholder="没有可不填" value=""/>
				</div> -->
				<div class="reg_radio_box">
					<label> <input type="checkbox" id="regweb" checked="checked" style="vertical-align: -2px;"> 注册即视为同意 <a href="javascript:void(0)" class="move" onclick="regWeb();">用户注册协议</a></label>
				</div>
				<div class="formbody">
					<input type="button" class="btns2 w300 hg40" onclick="reg_up();" value="立即注册">
				</div>
			</div>
		</div>
	</div>
</div>
<div class="all_mask_loginbox" id="step1" style="display: none;width:420px;">
	<div class="login_title pl20">验证手机</div>
	<form id="form-login" class="mask_wrap login-fb">
		<div class="login_text zin80">
			<div class="mask_wrap_title">图形验证码：</div>
			<input type="text" id="verify" value="" class="texts" style="width: 98px; box-shadow: none;"/>
			<span style="vertical-align: -14px;line-height: 20px;">
				<img id="verify_up" class="codeImg reloadverify" src="<?php echo U('Verify/code');?>" title="换一张" onclick="this.src=this.src+'?t='+Math.random()" width="100" height="34">
			</span>
		</div>
		<div class="login_text zin80">
			<div class="mask_wrap_title">获取验证码：</div>
						<input type="button" value="发送短信验证码" class="btns" onclick="moble_reg('sms')" style="width: 100px;font-size: 12px;"/>
								</div>
	</form>
	<div class="mask_wrap_close" onclick="showB()"><i class="fa fa-times fz_20 move" aria-hidden="true"></i></div>
</div>
<div id="step2" class="all_mask" style="height: 0px;display: none;"></div>
<script>
	$(function () {
		var height = $(document).height();
		if (height < 1000) {
			height = 1000;
		}
		$('#step2').height(height);
		$("#moble").focus();
	});
	function regWeb() {
		layer.open({
			type: 2,
			skin: 'layui-layer-rim', // 边框
			area: ['800px', '600px'], // 宽高
			title: '用户注册协议', // 标题
			content: "<?php echo U('Login/webreg');?>"
		});
	}
	function showB() {
		$("#step1").hide();
		$("#step2").hide();
		$("#verify").focus();
	}
	function check_moble() {
		var moble  = $('#moble').val();
		var mobles = $('#mobles').val();
		if (moble == "" || moble == null) {
			layer.tips("请输入手机号", '#moble', {tips: 2});
			return false;
		}
		$.post("/login/check_moble.html", {
			moble: moble,
			mobles: mobles,
			token: ""
		}, function (data) {
			if (data.status == 1) {
				$("#step1").show();
				$("#step2").show();
				$("#verify").focus();
				$('#reg_moble').html('<a class="move" onclick="new_send()">点击发送验证码</a>');
			} else {
				layer.tips(data.info, '#moble', {tips: 2});
				return false;
			}
		}, 'json');
	}
	function verify_ups() {
		$('#verify_up').attr('src', "/ajax/verify.html?t=" + Math.random());
	}
	function new_send() {
		$("#step1").show();
		$("#step2").show();
		$("#verify").focus();
	}
	function new_sends() {
		var moble  = $('#moble').val();
		var mobles = $('#mobles').val();
		if (moble == "" || moble == null) {
			layer.tips("请输入手机号", '#moble', {tips: 2});
			return false;
		}
		$.post("/login/check_moble.html", {
			moble: moble,
			mobles: mobles,
			token: ""
		}, function (data) {
			if (data.status == 1) {
				$("#step1").show();
				$("#step2").show();
				$("#verify").focus();
			} else {
				layer.tips(data.info, '#moble', {tips: 2});
				return false;
			}
		}, 'json');
	}
	function moble_reg(type) {
		var moble  = $("#moble").val();
		var mobles = $("#mobles").val();
		var verify = $("#verify").val();
		if (moble == "" || moble == null) {
			layer.tips("请输入手机号码", '#moble', {tips: 2});
			return false;
		}
		if (verify == "" || verify == null) {
			layer.tips("请输入图形验证码", '#verify', {tips: 2});
			return false;
		}
		$.post("/login/real.html", {
			moble: moble,
			mobles: mobles,
			type: type,
			verify: verify,
			token: ""
		}, function (data) {
			if (data.status == 1) {
				layer.msg(data.info, {icon: 1});
				$("#step1").hide();
				$("#step2").hide();
				$("#moble_verify").focus();
				$('#moble').attr("disabled", "disabled");
				$('#mobles').attr("disabled", "disabled");
				var obj      = $('#reg_moble');
				var wait     = 60;
				var interval = setInterval(function () {
					obj.html("<a>" + wait + "秒可再次发送" + "</a>");
					wait--;
					if (wait < 0) {
						clearInterval(interval);
						$(".reloadverify").click();
						$("#verify").val('');
						obj.html('<a class="move" onclick="new_send()">点击重新发送</a>');
					}
					;
				}, 1000);
			} else {
				$(".reloadverify").click();
				layer.msg(data.info, {icon: 2});
				if (data.url) {
					window.location = data.url;
				}
			}
		}, "json");
	}
	function reg_up() {
		var moble        = $("#moble").val();
		var mobles       = $("#mobles").val();
		var moble_verify = $("#moble_verify").val();
		var password     = $("#password").val();
		var invit        = $("#invit").val();
		if (moble == "" || moble == null) {
			layer.tips("请输入手机号", '#moble', {tips: 2});
			return false;
		}
		if (moble_verify == "" || moble_verify == null) {
			layer.tips("请输入验证码", '#moble_verify', {tips: 2});
			return false;
		}
		if (password == "" || password == null) {
			layer.tips("请输入密码", '#password', {tips: 2});
			return false;
		}
		if (!$("#regweb").is(':checked')) {
			layer.tips("请勾选用户注册协议", '#regweb', {tips: 3});
			return false;
		}
		$.post("/login/upregister.html", {
			moble: moble,
			mobles: mobles,
			moble_verify: moble_verify,
			password: password,
			invit: invit,
			token: ""
		}, function (data) {
			if (data.status == 1) {
				layer.msg(data.info, {icon: 1});
				$.cookies.set('move_moble', moble);
				$.cookies.set('move_mobles', mobles);
					window.location = '/Login/paypassword';
			} else {
				layer.msg(data.info, {icon: 2});
				if (data.url) {
					window.location = data.url;
				}
			}
		}, "json");
	}
</script>










<div class="clear">
</div>
<div class="boxs mt40">
    <footer id="footer" class="footer">
        <section class="main">
            <div class="about_me">
                <div class="wx">
                    <a href="javascript:" class="footer_wx_icon">
					<img src="/Upload/public/<?php echo ($C['web_logo']); ?>"/>
					</a>
                </div>
            </div>
            <div class="layout_center">

                
			<?php if(is_array($footerArticleType)): $i = 0; $__LIST__ = $footerArticleType;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="list"><label><?php echo ($vo['title']); ?></label>
					<ul>
						<?php if(is_array($footerArticle[$vo['name']])): $i = 0; $__LIST__ = $footerArticle[$vo['name']];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vvo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Article/type',array('id'=>$vvo['id']));?>" style="overflow: hidden;"><?php echo ($vvo['title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
						<li><a href="<?php echo U('Article/type',array('id'=>$vo['id']));?>" style="overflow: hidden;    text-align: left;">更多</a></li>
					</ul>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
				
				
				
				<div class="contact_us">
                    <div class="contact_us_text0" style="text-align: left;">全国免费咨询电话 :</div>
                    <div class="contact_us_text1" style="text-align: left;margin-top: 10px;margin-bottom: 12px;">
                       <?php echo C('contact_moble');?>                 </div>
                    <div class="contact_us_text2" style="text-align: left;margin-bottom: 5px;">
                        工作日:9:00-19:00
                    </div>
                    <div class="contact_us_text2" style="text-align: left;margin-bottom: 5px;">
                        节假日:9:00-18:00
                    </div>
                    
					
					<?php $_result=C('contact_qqun');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div>
							<a href="#" class="contact_us_text3"><span>会员群号 :<?php echo ($i); ?>群：<?php echo ($v); ?></span></a>
						</div><?php endforeach; endif; else: echo "" ;endif; ?>	
					
					
					
                                    </div>
            </div>
        </section>
    </footer>
    <div class="footer_bottom">
	
		<div style="margin-bottom: 5px;width:1200px;margin:0 auto;">
			<span class="text-danger">风险提示：比特币等数字资产交易具有极高的风险（预挖、暴涨暴跌、庄家操控、团队解散、技术缺陷等），据国家五部委《关于防范比特币风险的通知》，<?php echo ($C['web_name']); ?>网仅为数字资产的爱好者提供一个自由的网上交换平台，对币的投资价值不承担任何审查、担保、赔偿的责任，您需要完全对自己的投资损失承担责任，如果您不能接受，请不要进行交易！谢谢！</span>
		</div>
	
        <div class="autobox" style="height: 40px;margin-top: 5px;">
			<span style="display: inline-block;color:#A6A9AB;">
			CopyRight© 2007-2017 <?php echo ($C['web_name']); ?>交易平台 All Rights Reserved &nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="http://www.miitbeian.gov.cn/publish/query/indexFirst.action" target="_blank"><?php echo ($C['web_icp']); ?></a>
			<span style="margin-left:10px; color:#A6A9AB"><!--放统计代码  --></span>
			</span>
			
			<span style="float: right;">
			<a href="http://www.gov.cn/" target="_blank" class="margin10" style="margin-left:5px;"> <img
                    src="/Upload/footer/footer_1.png"> </a>
			<a href="http://www.szfw.org/" target="_blank" class="margin10" style="margin-left:5px;"> <img
                    src="/Upload/footer/footer_2.png"> </a>
			<a href="http://www.miibeian.gov.cn/" target="_blank" class="margin10" style="margin-left:5px;"><img
                    src="/Upload/footer/footer_3.png"> </a>
			<a href="http://www.cyberpolice.cn/" target="_blank" class="margin10" style="margin-left:5px;"><img
                    src="/Upload/footer/footer_4.png"> </a>
		</span>
        </div>
    </div>
</div>


<style>

.sidetool{box-sizing:border-box;position: fixed;right:20px;top:40%;z-index: 333;}
.sidetool li span{position:absolute;right:40px;top:0;text-align:center;overflow:hidden;visibility:hidden;width:0px;height:40px;background:#ff6709;line-height:40px;color:#fff;transition: width .25s ease-in-out .1s;}
.sidetool li:hover span{box-sizing:border-box;width: 120px;visibility: visible;}
.sidetool li span.sqrcode i{display:block;visibility:hidden;opacity: 0;transition:all .3s ease-in 0;position: absolute;bottom:-5px;font-style:normal;font-size:12px;width: 100%;text-align: center;}
.sidetool li:hover span.sqrcode i{opacity:1;visibility: visible;}
.sidetool li:hover span.sqrcode{width: 120px;height: 140px;padding:12px 0;}
.sidetool ul>li{box-shadow: 0 0 5px rgba(0,0,0,.12);margin:1px 0;position:relative;padding-top:10%;width: 40px;height: 40px;background-color: #fff;box-sizing:border-box;}
.sidetool ul>li:hover{background-color: #ff6709;}
.sidetool ul>li>a{box-sizing:border-box;display: inline-block;width: 100%;height: 100%;}
.sidetool .sidetool-item{margin:5px auto;width: 52%;transition:all .3s ease-in 0s;
    height: 60%;display: block;background:url('/Public/Home/kefu/sidebar.png') no-repeat;background-position: 0 0;}
.sidetool .sidetool-item.qq{background-position: 0 0;}
.sidetool .sidetool-item.mobile{
    background-position: 0 -169px;}
.sidetool ul>li:hover .sidetool-item.mobile{
    background-position: 0 -194px;}
.sidetool ul>li:hover .sidetool-item.qq{background-position: 0 -24px;}
.sidetool .sidetool-item.wechat{background-position: 0 -127px;}
.sidetool ul>li:hover .sidetool-item.wechat{background-position: 0 -147px;}
.sidetool .sidetool-item.tel{background-position: 0 -87px;}
.sidetool ul>li:hover .sidetool-item.tel{background-position: 0 -107px;}
.sidetool .sidetool-item.qrc{background-position: 0 -48px;}
.sidetool ul>li:hover .sidetool-item.qrc{background-position: 0 -68px;}

.jubi-lts-an:hover{
	background:#eb5200;
}
.jubi-lts-an:hover p{
	color: #fff;
}
.jubi-lts-an:hover i.jubi-lts-ant{
	background-position: 0px -16px;
}

.jubi-lts-an {
    width: 40px;
    height: 83px;
    background: #fff;
    box-shadow: 0 0 5px rgba(0,0,0,.12);
    position: fixed;
    bottom: 20px;
    right: 20px;
    cursor: pointer;
    border-radius: 2px;
    z-index: 10;
    -webkit-transition: -webkit-transform 0.6s cubic-bezier(0.2, 1, 0.3, 1);
    transition: transform 0.6s cubic-bezier(0.2, 1, 0.3, 1);
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    padding-top: 7px;
    box-sizing: border-box;
}

 .jubi-lts-an i.jubi-lts-ant {
    width: 19px;
    height: 17px;
    display: block;
    background-image: url('/Public/Home/kefu/jubi-lts-logo.png');
    background-position: 0px 0px;
    background-size: 19px;
    margin: 0px auto 4px;
    transition: all .3s ease-in 0s;
}

.jubi-lts-an P {
    font-size: 14px;
    color: #eb5200;
    width: 19px;
    text-align: center;
    margin: 0px auto;
    line-height: 15px;
}
 
 </style>

  <div id="kf1" class="sidetool hidden-xs">
   <ul>
    <li><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo C('contact_qq')[0];?>&site=qq&menu=yes" target="_blank"><i class="sidetool-item qq"></i></a><span style="cursor:pointer;" onclick="javascript:window.open('http://wpa.qq.com/msgrd?v=3&uin=<?php echo C('contact_qq')[0];?>&site=qq&menu=yes');">QQ在线客服</span></li>
    <li><a href="#" onclick="javascript:return false;"><i class="sidetool-item wechat"></i></a><span class="sqrcode"><img src="/upload/public/<?php echo C('contact_weixin_img');?>" alt="" /><i>微信群号</i></span></li>
    <li><a href="#" onclick="javascript:return false;"><i class="sidetool-item mobile"></i></a><span class="sqrcode"><img width="100" style="background-color: #fff;" src="/upload/public/<?php echo C('contact_app_img');?>" alt="" /><i>访问手机版</i></span></li>
    <li><a href=""><i class="sidetool-item tel"></i></a><span><?php echo C('contact_moble');?></span></li>
   </ul>
  </div>
  










<div id="all_mask" class="all_mask" style="height: 0px; display: none;"></div>
<div id="all_mask_loginbox" class="all_mask_loginbox" style="display: none;">
    <div class="login_title pl20">
        <span onclick="saoma()" style="text-align: center;margin-left: 15px;color: #1a81d6;cursor:pointer;">会员登录</span>
		
		
		<?php if(($_SESSION['qq3479015851_already']) == "1"): ?><font color="#ff0000" size="1px;">您的账户在其它地方登录，请重新登录</font><?php endif; ?>
	</div>
    <form id="form-login" class="mask_wrap login-fb">
        <div class="login_text zin90">
            <div class="mask_wrap_title">账户：</div>
            <input type="text" id="login_mobles" class="texts" style="display: none;">
            <input type="text" id="login_moble" class="texts hg40 w250" placeholder="请输入手机号码"
                   style="padding-left: 42px;" value=""/>
            <link rel="stylesheet" href="/comfile/css/intltelinput.css">
            <script src="/comfile/js/intltelinput.js"></script>
            <script>
                $("#login_mobles").intlTelInput({
                    autoHideDialCode: false,
                    defaultCountry: "cn",
                    nationalMode: false,
                    preferredCountries: ['cn', 'us', 'hk', 'tw', 'mo'],
                });
            </script>
        </div>
        <div class="login_text zin80">
            <div class="mask_wrap_title">密码：</div>
            <input id="login_password" class="texts hg40 w250" type="password" placeholder="请输入登录密码">
        </div>
        <div class="login_text zin80">
            <div class="mask_wrap_title">验证码：</div>
            <input type="text" id="login_verify" value="" class="texts w145 hg40" placeholder="请输入验证码"/>
			<span style="vertical-align: -17px;line-height: 20px;">
				<img id="login_verify_up" class="codeImg reloadverify hg40" src="<?php echo U('Verify/code');?>"
                     title="换一张" onclick="this.src=this.src+'?t='+Math.random()" width="100" height="34">
			</span>
        </div>
        <div class="login_button">
            <input type="button" value="登录" onclick="footer_login();" class="btns2  hg40 w250">
        </div>
        <div class="login-footer wwxwwx" style="border-bottom-left-radius: 3px; border-bottom-right-radius: 3px;">
			<span style="color: #CCC; float: right; margin-right: 25px;">
			<a style="font-size: 14px;" href="<?php echo U('Login/register');?>">免费注册</a>｜<a href="<?php echo U('Login/findpwd');?>" style="font-size: 14px;">忘记密码</a>
			</span>
        </div>
    </form>
    <div class="mask_wrap_close" onclick="wrapClose()"><i class="fa fa-times fz_20 move" aria-hidden="true"></i></div>
</div>




<style>
.th-lts-con-t {
    width: 100%;
    background: #fff;
}

.th-lts-con-t h1 {
    height: 30px;
    line-height: 30px;
    width: 100%;
    background: #f8f8f8;
    font-size: 12px;
    color: #333;
    padding-left: 10px;
    box-sizing: border-box;
    font-weight: normal;
    letter-spacing: 1px;
}


.buyonesellone {
    border: 1px solid #d5d5d5;
    background-color: #ffffff;
}

#marqueebox1 {
    height: 450px;
    max-height: 450px;
    overflow-x: hidden;
    overflow-y: auto;
	z-index:999px;
}

#marqueebox1 li{
    font-size:14px;
    text-align:left;
    padding:1px;
    padding-left:5px;
}

#marqueebox1 li:hover{
    background:#ebf4fe;
}


#marqueebox1{
    height:630px;
    max-height:625px;
    overflow-x:hidden;
    overflow-y:auto;
}

#marqueebox1 li{
    font-size:14px;
    text-align:left;
    padding:1px;
    padding-left:5px;
}

#marqueebox1 li:hover{
    background:#ebf4fe;
}

#marqueebox1 img{
    margin-bottom:-3px;
}

#marqueebox2{
    height:30px;
    border-top:1px solid #d5d5d5;
}

#marqueebox2 img{
    padding:2px;
    margin-left:2px;
    margin-top:2px;
    margin-bottom:-2px;
    border:#d5d5d5 solid 1px;
}

#marqueebox2 li a{
    font-size:14px;
}

#marqueebox2 input{
    width:192px;
    height:22px;
    color:#333333;
    border:#d5d5d5 solid 1px;
    background:#ffffff;
    font-size:12px;
    border-radius:3px;
    padding:1px;
    margin:2px;
}

#marqueebox2 input:hover{
    border:#e55600 solid 1px;
}

#marqueebox2 .tijiao{
    width:58px;
    height:26px;
    border:#e55600 solid 1px;
    font-size:12px;
    border-radius:10px;
    outline:none;
    border-radius:3px;
    padding:1px;
    margin:2px;
    color:#ffffff;
    background:#e55600;
}

#marqueebox2 .tijiao:hover{
    color:#ffffff;
    background:#ff660b;
}

</style>


<div style="width:0;height:0;clear:both;"></div>
 <div class="right" style="position:fixed;right:0px;bottom:0px;z-index:999;display:none;opacity:100;" id="trade_moshi_liaotian_1">
	<div class="coinBox buyonesellone">
		<div class="coinBoxBody buybtcbody2">
			<div class="th-lts-con-t"> <h1>聊天室 <span onclick="javacript:$('#trade_moshi_liaotian_1').hide();$('#kf1').show();$('#chat1').show();" style="float:right;cursor:pointer;">关闭</span></h1>
			
			</div>
			
			
			<div id="marqueebox1" style="height:450px;max-height: 450px;" class="">
				<ul id="chat_content">
				</ul>
			</div>
			<div id="marqueebox2">
				<ul class="clearfix">
					<li id="face" class="left"><a href="javascript:void(0);" class="face faceBtn" id="face1">
						<img src="/Public/Home/images/face.gif" width="20">
					</a></li>
					<li id="msg" class="left">
					<input type="text" name="msg" class="text" id="chat_text"></li>
					<li id="send" class="right"><input class="tijiao" type="button" value="发送"
													   onclick="upChat()"></li>
				</ul>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="/Public/Home/js/jquery.qqFace.js"></script>

<script type="text/javascript">
    //@他
    function atChat(_this) {
        $("#chat_text").val('@' + $(_this).html() + ' :');
    }
    // 回车提交聊天
    $("#chat_text").keyup(function (e) {
        if (e.keyCode === 13) {
            upChat();
            return false;
        }
    });
    // 提交聊天
    function upChat() {
        var content = $("#chat_text").val();
        if (content == "" || content == null) {
            layer.tips('请输入内容', '#chat_text', {tips: 3});
            return false;
        }
        $.post("/Ajax/upChat", {content: content}, function (data) {
            if (data.status == 1) {
                $("#chat_text").val('');
                getChat();
            } else {
                layer.tips(data.info, '#chat_text', {tips: 3});
                return false;
            }
        }, 'json');
    }
    //表情盒子的ID//给那个控件赋值//表情存放的路径
    $('#face1').qqFace({id: 'facebox1', assign: 'chat_text', path: '/Upload/face/'});


    function getChat() {
        //if (trade_moshi == 2) {
            $.getJSON("/Ajax/getChat?t=" + Math.random(), function (data) {
                if (data) {


                    var list = '';
                    for (i = 0; i < data.length; i++) {
                        list += '<li><a href="javascript:void(0);" onclick="atChat(this)">' + data[i][1] + '</a>：' + data[i][2] + '</li>';
					}
                    list = list.replace(/\[\/#([0-9]*)\]/g, '<img src="/Upload/face/$1.gif"  width="18">');

                    if ($("#chat_content").html() != list) {
                        $("#chat_content").html(list);
                        $("#marqueebox1").scrollTop(40000);
                    }


                }
            });
            setTimeout('getChat()', 5000);
        //}
    }

	
	getChat();

</script>	































<script>
    $(document).ready(function () {
        $("#leftsead a").hover(function () {
            if ($(this).prop("className") == "youhui") {
                $(this).children("img.hides").show();
            } else {
                $(this).children("div.hides").show();
                $(this).children("img.shows").hide();
                $(this).children("div.hides").animate({marginRight: '0px'}, '0');
            }
        }, function () {
            if ($(this).prop("className") == "youhui") {
                $(this).children("img.hides").hide();
            } else {
                $(this).children("div.hides").animate({marginRight: '-163px'}, 0, function () {
                    $(this).hide();
                    $(this).next("img.shows").show();
                });
            }
        });
        $("#top_btn").click(function () {
            if (scroll == "off") return;
            $("html,body").animate({scrollTop: 0}, 600);
        });
    });
</script>

<script>
    $(function () {
        var userid = "";
        if (window.location.hash == '#login') {
            if (!userid) {
                loginpop();
            }
        }

        if (window.location.hash == '#goole') {
            goolepop();
        }
        if (window.location.hash == '#yidi') {
            yidipop();
        }
        var move_moble = $.cookies.get('move_moble');
        if (move_moble != '' && move_moble != null) {
            $("#login_moble").val(move_moble);
        }
    });

	
    function loginpop() {
        var height = $(document).height();
        if (height < 1000) {
            height = 1000;
        }
        $('.all_mask').css({'height': height});
        $('.all_mask').show();
        $('#all_mask_loginbox').show();
    }
    function goolepop() {
        var height = $(document).height();
        if (height < 1000) {
            height = 1000;
        }
        $('.all_mask').css({'height': height});
        $('.all_mask').show();
        $('#all_mask_goolebox').show();
    }
    function yidipop() {
        var height = $(document).height();
        if (height < 1000) {
            height = 1000;
        }
        $('.all_mask').css({'height': height});
        $('.all_mask').show();
        $('#all_mask_yidibox').show();
    }

    function wrapClose() {
        $('.all_mask').hide();
        $('.all_mask_loginbox').hide();
    }
    function footer_login() {
        var moble = $("#login_moble").val();
        var mobles = $("#login_mobles").val();
        var password = $("#login_password").val();
        var verify = $("#login_verify").val();
        if (moble == "" || moble == null) {
            layer.tips('请输入手机号', '#login_moble', {tips: 2});
            return false;
        }
        if (password == "" || password == null) {
            layer.tips('请输入登录密码', '#login_password', {tips: 2});
            return false;
        }
        if (verify == "" || verify == null) {
            layer.tips('请输入验证码', '#login_verify', {tips: 2});
            return false;
        }
        $.post("/login/submit.html", {
            moble: moble,
            mobles: mobles,
            password: password,
            verify: verify,
            login_token: "",
        }, function (data) {
            if (data.status == 1) {
                $.cookies.set('move_moble', moble);
                layer.msg(data.info, {icon: 1});
                if (data.url) {
                    window.location = data.url;
                } else {
                    window.location = "/";
                }
            } else {
                $("#login_verify_up").click();
                layer.msg(data.info, {icon: 2});
                if (data.url) {
                    window.location = data.url;
                }
            }
        }, "json");
    }
    function footer_goole() {
        var password = $("#goole_password").val();
        if (password == "" || password == null) {
            layer.tips('请输入谷歌密码', '#goole_password', {tips: 2});
            return false;
        }
        $.post("/login/goole.html", {
            password: password,
        }, function (data) {
            if (data.status == 1) {
                layer.msg(data.info, {icon: 1});
                if (data.url) {
                    window.location = data.url;
                } else {
                    window.location = '/';
                }
            } else {
                layer.msg(data.info, {icon: 2});
                if (data.url) {
                    window.location = data.url;
                }
            }
        }, "json");
    }
    function footer_yidi() {
        var password = $("#yidi_password").val();
        if (password == "" || password == null) {
            layer.tips('请输入短信验证码', '#yidi_password', {tips: 2});
            return false;
        }
        $.post("/login/yidi.html", {
            password: password,
        }, function (data) {
            if (data.status == 1) {
                layer.msg(data.info, {icon: 1});
                if (data.url) {
                    window.location = data.url;
                } else {
                    window.location = '/';
                }
            } else {
                layer.msg(data.info, {icon: 2});
                if (data.url) {
                    window.location = data.url;
                }
            }
        }, "json");
    }
</script>


</body>

<?php if(($_SESSION['qq3479015851_already']) == "1"): ?><script>
		loginpop();
	</script><?php endif; ?>


<script>
    $(document).ready(function () {
        $.each($(".mv-hide"), function () {
            eval($(this).html());
        });
    });
</script>
</html>