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
<link rel="stylesheet" href="/comfile/css/index.css"/>
<div class="banner-box"  id="banner_qq_3479015851" >
	<div class="banner-tag-box">
	
		<?php if(($_SESSION['userId']) > "0"): ?><div class="banner-tag login-banner-tag">
				<div class="user-base">
						<span class="user-base-sp">
							Hi,<a href="#" target="_blank"><?php echo (session('userName')); ?></a>
						</span>
					<div class="user-info-block">
						<table>
							<tr>
								<td>可用 CNY</td>
								<td>冻结</td>
								<td>总资产</td>
							</tr>
							<tr>
								<td><?php echo ($userCoin_top['cny']); ?></td>
								<td><?php echo ($userCoin_top['cnyd']); ?></td>
								<td><?php echo ($userCoin_top['allcny']); ?></td>
							</tr>
						</table>
					</div>
				</div>
				<ul class="clearfix">
					<div class="user-info-fina">
						<a href="/Finance/mycz.html">CNY充值</a> <a href="/Finance/mytx.html">CNY提现</a>
						<a href="/User/index.html" class="w82">安全中心</a>
					</div>
				</ul>
				<a href="/Finance/index.html" target="_blank" class="green-link-btn">去财务中心</a>
				<!-- <a href="/Finance/mytj.html" target="_blank" class="transparent-link-btn">
					<i class="icon-hot-tag"></i> 推荐好友拿奖励 </a> -->
			</div>

	
		<?php else: ?>
            <div class="banner-tag visitor-banner-tag">
                <div class="topest-profit" style="margin:5px 0 0 0;">
                    <div class="modal-header" style="border:none;text-align:center;padding:0px;">

                        <h3 style="font-size:18px;">
                            风险提示
                        </h3>
                    </div>
                    <div class="modal-body" style="font-size:18px;width: 350px;">
                        <div style="font-size:13px;text-align:left;margin: 0px 0 0 0">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;数字货币交易具有极高的风险（预挖、暴涨暴跌、庄家操控、团队解散、技术缺陷等），
                            据国家五部委《关于防范比特币风险的通知》，<?php echo ($C['web_name']); ?>仅为数字货币的爱好者提供一个自由的网上交换平台，
                            对币的投资价值不承担任何审查、担保、赔偿的责任，如果您不能接受，请不要进行交易！谢谢！
                        </div>
                    </div>
                </div>
                <a href="javascript:loginpop();" class="red-link-btn">立即登录 </a>
                <a href="/Login/register.html" class="red-link-btn" target="_blank"> 立即注册 </a>
            </div><?php endif; ?>
		
		
		
		
	</div>
	<div id="slider_index"
     class="slider" style="height:400px;">
    <div class="slider-loading" data-u="loading">
        <div class="slider-loading-a"></div>
        <div class="slider-loading-b"></div>
    </div>
    <div class="slider-body" data-u="slides">
	
	
		<?php if(is_array($indexAdver)): $i = 0; $__LIST__ = $indexAdver;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div  onclick="window.location.href='<?php echo ($vo['url']); ?>'">
				<a src="" style=""><img data-u="image" title="" alt="" src="/Upload/ad/<?php echo ($vo["img"]); ?>"/>
				</a>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>	
		
    </div>
			
			
        <div id="slider-body-navigator_index"
         class="sbn-3" data-u="navigator" style="position: absolute;
        bottom: 16px;" data-autocenter="1">
        <div data-u="prototype" style=""></div>
    </div>
            <span id="slider-body-arrow-l_index" data-u="arrowleft"
          class="slider-body-arrowleft-1" data-autocenter="2"></span>
    <span id="slider-body-arrow-r_index" data-u="arrowright"
          class="slider-body-arrowright-1" data-autocenter="2"></span>
    </div>
<textarea class="mv-hide" style="display: none;">
    slider_run("slider_index", [{"$Duration":1200,"x":0.3,"$SlideOut":true,"$Easing":{},"$Opacity":2}]);
</textarea></div>
<div class="tradeBox hg40" style=" width: 1200px;margin: 0 auto;   background: #FFF;">
	<div class="slideHd hg40" style="width: 1200px;margin: 0 auto;background: #FFF;">
		<ul class="active hg40  trade_qu_list" style="height: 40px;line-height: 40px;">

				<?php if(is_array($qq3479015851_jiaoyiqu)): $i = 0; $__LIST__ = $qq3479015851_jiaoyiqu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li  class="trade_moshi trade_qu_pai   
					<?php if(($key) == "0"): ?>current<?php endif; ?>
					" data="<?php echo ($key); ?>" onclick="trade_qu(this)">
					<a> <?php echo ($v); ?> </a></li><?php endforeach; endif; else: echo "" ;endif; ?>	
				
		</ul>
	</div>
</div>
<div class="price_today">
	<div class="autobox">
		<ul class="price_today_ull">
			<li data-sort="0" style="cursor: default;">交易市场</li>
			<li class="click-sort" data-sort="1" data-flaglist="0" data-toggle="0">最新成交价 <i
					class="cagret cagret-down"></i> <i class="cagret cagret-up"></i>
			</li>
			<li class="click-sort" data-sort="2" data-flaglist="0" data-toggle="0">买一价 <i
					class="cagret cagret-down"></i> <i class="cagret cagret-up"></i>
			</li>
			<li class="click-sort" data-sort="3" data-flaglist="0" data-toggle="0">卖一价 <i
					class="cagret cagret-down"></i> <i class="cagret cagret-up"></i>
			</li>
			<li class="click-sort" data-sort="6" data-flaglist="0" data-toggle="0">24H成交量 <i
					class="cagret cagret-down"></i> <i class="cagret cagret-up"></i>
			</li>
			<li class="click-sort" data-sort="4" data-flaglist="0" data-toggle="0">24H成交额				
			<i class="cagret cagret-down"></i> <i class="cagret cagret-up"></i>
			</li>
			<li class="click-sort" data-sort="7" data-flaglist="0" data-toggle="0">24H涨跌 <i
					class="cagret cagret-down"></i> <i class="cagret cagret-up"></i>
			</li>
			<li data-sort="0">价格趋势(3日)</li>
			<li data-sort="0" style="width: 150px; text-align: center; text-indent: 0.5em;">操作</li>
		</ul>
	</div>
</div>

<ul class="price_today_ul" id="price_today_ul" style="margin: 0px auto;width: 1200px;background: #FFF;box-shadow: 2px 2px 4px #D7DAE0;">

</ul>
<script src="/comfile/js/jquery.flot.js"></script>
<script>
	$('.price_today_ull > .click-sort').each(function () {
		$(this).click(function () {
			click_sortList(this);
		})
	})
	function allcoin_callback(priceTmp) {
		for (var i in priceTmp) {
			var c = priceTmp[i][8];
			if (typeof (trends[c]['data']) && typeof (trends[c]['data']) != 'null') {
				if (typeof (trends[c]) != 'undefined' && typeof (trends[c]['data']) != 'undefined') {
					$.plot($("#" + c + "_plot"), [{shadowSize: 0, data: trends[c]['data']}], {
						grid: {borderWidth: 0},
						xaxis: {mode: "time", ticks: false},
						yaxis: {tickDecimals: 0, ticks: false},
						colors: ['#f99f83']
					});
				}
			}
		}
	}
	function click_sortList(sortdata) {
		var a = $(sortdata).attr('data-toggle');
		var b = $(sortdata).attr('data-sort');
		$(".price_today_ull > li").find('.cagret-up').css('border-bottom-color', '#848484');
		$(".price_today_ull > li").find('.cagret-down').css('border-top-color', '#848484');
		$(".price_today_ull > li").attr('data-flaglist', 0).attr('data-toggle', 0);
		$(".price_today_ull > li").css('color', '');
		$(sortdata).css('color', '#1a81d6');
		if (a == 0) {
			priceTmp = priceTmp.sort(sortcoinList('dec', b));
			$(sortdata).find('.cagret-down').css('border-top-color', '#1a81d6');
			$(sortdata).find('.cagret-up').css('border-bottom-color', '#848484');
			$(sortdata).attr('data-flaglist', 1).attr('data-toggle', 1)
		}
		else if (a == 1) {
			$(sortdata).attr('data-toggle', 0).attr('data-flaglist', 2);
			;
			$(sortdata).find('.cagret-up').css('border-bottom-color', '#1a81d6');
			$(sortdata).find('.cagret-down').css('border-top-color', '#848484');
			priceTmp = priceTmp.sort(sortcoinList('asc', b));
		}
		renderPage(priceTmp);
		change_line_bg('price_today_ul', 'li');
		allcoin_callback(priceTmp);
	}
	function trends() {
		$.getJSON('/ajax/index_b_trends?t=' + rd(), function (d) {
			trends = d;
			allcoin();
		});
	}
	function allcoin(cb) {
		var trade_qu_id = $('.trade_qu_list .current').attr('data');
		$.get('/ajax/allcoin_a/id/' + trade_qu_id + '?t=' + rd(), cb ? cb : function (data) {
			var d;
			if (data.status == 1) {
				d = data.url;
			}
			ALLCOIN  = d;
			var t    = 0;
			var img  = '';
			priceTmp = [];
			for (var x in d) {
				if (typeof(trends[x]) != 'undefined' && parseFloat(trends[x]['yprice']) > 0) {
					rise1 = (((parseFloat(d[x][4]) + parseFloat(d[x][5])) / 2 - parseFloat(trends[x]['yprice'])) * 100) / parseFloat(trends[x]['yprice']);
					rise1 = rise1.toFixed(2);
				} else {
					rise1 = 0;
				}
				img = d[x].pop();
				d[x].push(rise1);
				d[x].push(x);
				d[x].push(img);
				priceTmp.push(d[x]);
			}
			$('.price_today_ull > .click-sort').each(function () {
				var listId = $(this).attr('data-sort');
				if ($(this).attr('data-flaglist') == 1 && $(this).attr('data-sort') !== 0) {
					priceTmp = priceTmp.sort(sortcoinList('dec', listId))
				} else if ($(this).attr('data-flaglist') == 2 && $(this).attr('data-sort') !== 0) {
					priceTmp = priceTmp.sort(sortcoinList('asc', listId))
				}
			});
			renderPage(priceTmp);
			allcoin_callback(priceTmp);
			change_line_bg('price_today_ul', 'li');
			t = setTimeout('allcoin()', 5000);
		}, 'json');
	}
	function rd() {
		return Math.random()
	}
	function renderPage(ary) {
		var html = '';
		for (var i in ary) {
			var coinfinance = 0;
			if (typeof FINANCE == 'object') coinfinance = parseFloat(FINANCE.data[ary[i][8] + '_balance']);
			html += '<li><dl class="autobox clear"><dt><a href="/trade/index/market/' + ary[i][8] + '/">' +
					'<img src="/upload/coin/' + ary[i][9] + '" style="vertical-align: middle;margin-right: 5px;width: 19px;margin-left: 12px;">' + ary[i][0] + '</a></dt><dd class="orange" style="text-indent: 1.6em;">' + ary[i][1] + '</dd><dd style="text-indent: 1.6rem;">' + ary[i][2] + '</dd><dd style="text-indent: 1.6rem;">' + ary[i][3] + '</dd><dd class="w142" style="    text-indent: 1.6rem;">' + formatCount(ary[i][6]) + '</dd><dd class="w142" style="    text-indent: 2.5rem;">' + formatCount(ary[i][4]) + '</dd><dd class="w142 ' + (ary[i][7] >= 0 ? 'buy' : 'sell') + '" style="    text-indent: 2.0rem;">' + (parseFloat(ary[i][7]) < 0 ? '' : '+') + ((parseFloat(ary[i][7]) < 0.01 && parseFloat(ary[i][7]) > -0.01) ? "0.00" : (parseFloat(ary[i][7])).toFixed(2)) + '%</dd><dd id="' + ary[i][8] + '_plot"  style="width:150px;height:35px;"></dd><dd class="w102" style="width:150px;text-align: center;text-indent: 0.5em;"><input type="button" value=去交易 class="btns2" onclick="top.location=\'/trade/index/market/' + ary[i][8] + '/\'" /></dd></dl></li>'
		}
		$('#price_today_ul').html(html);
	}
	function formatCount(count) {
		var countokuu = (count / 100000000).toFixed(3)
		var countwan  = (count / 10000).toFixed(3)
		if (count > 100000000)
			return countokuu.substring(0, countokuu.lastIndexOf('.') + 3) + '亿'
		if (count > 10000)
			return countwan.substring(0, countwan.lastIndexOf('.') + 3) + '万'
		else
			return count
	}
	function change_line_bg(id, tag, nobg) {
		var oCoin_list = $('#' + id);
		var oC_li      = oCoin_list.find(tag);
		var oInp       = oCoin_list.find('input');
		var oldCol     = null;
		var newCol     = null;
		if (!nobg) {
			for (var i = 0; i < oC_li.length; i++) {
				oC_li.eq(i).css('background-color', i % 2 ? '#f8f8f8' : '#fff');
			}
		}
		oCoin_list.find(tag).hover(function () {
			oldCol = $(this).css('backgroundColor');
			$(this).css('background-color', '#eaedf4');
		}, function () {
			$(this).css('background-color', oldCol);
		})
	}
	function sortcoinList(order, sortBy) {
		var ordAlpah = (order == 'asc') ? '>' : '<';
		var sortFun  = new Function('a', 'b', 'return parseFloat(a[' + sortBy + '])' + ordAlpah + 'parseFloat(b[' + sortBy + '])? 1:-1');
		return sortFun;
	}
	function trade_qu(o){
		$('.trade_qu_pai').removeClass('current');
		$(o).addClass('current');
		allcoin();
	}
	trends();
</script>
<div class="index_news mt20 index_news1" style="    padding-bottom: 0px;">
	<div style="padding: 20px 20px;border-color: #FFD0B7;">
		<p><span style="color: rgb(227, 108, 9);"><span style="font-size: 16px;">风险提示&nbsp;</span>数字货币交易具有极高的风险（预挖、暴涨暴跌、庄家操控、团队解散、技术缺陷等），据国家五部委《关于防范比特币风险的通知》，<?php echo ($C['web_name']); ?>交易平台仅为数字货币的爱好者提供一个自由的网上交换平台，对币的投资价值不承担任何审查、担保、赔偿的责任，如果您不能接受，请不要进行交易！</span></p>	</div>
</div>
<!-- <div class="tag-box">
	<div class="hotest-tag-list tag-list-transfer"> -->
<!-- <div class="safety_tips">
	<h3 style="font-weight:bold">专业的安全保障</h3>
	<div class="autobox">
		<ul class="safety_tips_ul clear">
			<li id="li1" onmouseover="change(1)" onmouseout="changes(1)">
				<img id="img1" src="/comfile/images/safe_1.jpg" alt="" width="70" height="70"/>
				<h4>系统可靠</h4>
				<p>银行级用户数据加密、动态身份验证，多级风险识别控制，保障交易安全</p>
			</li>
			<li id="li2" onmouseover="change(2)" onmouseout="changes(2)">
				<img id="img2" src="/comfile/images/safe_2.jpg" alt="" width="70" height="70"/>
				<h4>资金安全</h4>
				<p>钱包多层加密，离线存储于银行保险柜，资金第三方托管，确保安全</p>
			</li>
			<li id="li3" onmouseover="change(3)" onmouseout="changes(3)">
				<img id="img3" src="/comfile/images/safe_3.jpg" alt="" width="70" height="70"/>
				<h4>快捷方便</h4>
				<p>充值即时、提现迅速，每秒万单的高性能交易引擎，保证一切快捷方便</p>
			</li>
			<li id="li4" onmouseover="change(4)" onmouseout="changes(4)">
				<img id="img4" src="/comfile/images/safe_4.jpg" alt="" width="70" height="70"/>
				<h4>服务专业</h4>
				<p>专业的客服团队，400电话和24小时在线QQ，VIP一对一专业服务</p>
			</li>
		</ul>
	</div>
</div> -->
<!-- 		</div>
	</div> -->


<style>
	.shadow{  
	   padding-top:5px;
	   margin-left:5px;
	   -webkit-box-shadow: #666 0px 0px 10px;  
	   -moz-box-shadow: #666 0px 0px 10px;  
	   box-shadow: #666 0px 0px 10px; 
	}  
</style>
	
<script>

function change(id){
	$("#li"+id).attr("class","shadow");
	newimg = $("#img"+id).attr("src").replace("safe_"+id, "safe_"+id+"1");
	$("#img"+id).attr("src",newimg);
}

function changes(id){
	$("#li"+id).attr("class","");
	newimg = $("#img"+id).attr("src").replace("safe_"+id+"1", "safe_"+id);
	$("#img"+id).attr("src",newimg);
}



 //for(var i =0;i<imgsafe.length;i++){
//	imgsafe[i].onmouseover = function(){
//		imgsafe[i].attr("src").replace("safe_"+(i+1), "safe_"+(i+1)+"1");
//	}
	
//	imgsafe[i].onmouseout = function(){
//		imgsafe[i].attr("src").replace("safe_"+(i+1)+"1", "safe_"+(i+1));
//	}
	
//} 


</script>	
	
	
<div class="index_news mt20">
	<div class="index_media ml35 mt20">
		<ul class="index_media_ul index_media_me">
			<li class="index_media_li active"><?php echo ($indexArticleType[1]['title']); ?></li>
			<li class="index_media_li1">
				<a href="/Article/index/id/<?php echo ($indexArticleType[1]['id']); ?>" target="_blank">更多+</a></li>
		</ul>
		<div class="index_media_con">
			<div class="index_media_tab">
				<ul class="index_media_ul1">
				<?php if(is_array($indexArticle[1])): $i = 0; $__LIST__ = $indexArticle[1];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="index_media_li7"><i class="index_media_gt">&gt;</i>
						<a href="<?php echo U('Article/detail','id='.$vo['id']);?>" target="_blank" class="index_media_a"><?php echo ($vo['title']); ?></a>
						<label><?php echo (date('Y-m-d',$vo['addtime'])); ?></label>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
																																							</ul>
			</div>
		</div>
	</div>
	<div class="index_media index_media1 ml35 mt20">
		<ul class="index_media_ul index_media_ul2">
			<li class="index_media_li active"><?php echo ($indexArticleType[0]['title']); ?></li>
			<li class="index_media_li1 index_media_li3">
				<a href="/Article/index/id/<?php echo ($indexArticleType[0]['id']); ?>" target="_blank">更多+</a>
			</li>
		</ul>
		<div class="index_media_con1">
			<div class="index_media_tab index_media_tab1 " style="width: 420px;">
			
			<?php if(is_array($indexArticle[0])): $i = 0; $__LIST__ = $indexArticle[0];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><ul class="index_media_ul1 index_media_ul3">
					<li class="index_media_li4"><i class="index_media_gt">&gt;</i>
						<a href="<?php echo U('Article/detail','id='.$vo['id']);?>" target="_blank" class="index_media_a index_media_a1"><?php echo ($vo['title']); ?> </a>
					</li>
					<li class="index_media_li5"><label><?php echo (date('Y-m-d',$vo['addtime'])); ?></label></li>
				</ul><?php endforeach; endif; else: echo "" ;endif; ?>
																																			</div>
		</div>
	</div>
</div>

	



<style>

.content {width:1100px;overflow:hidden;margin:0px auto 0;}
.content_l {width:665px;overflow:hidden;float:left;}
.content_r {width:310px;overflow:hidden;float:right;}
.title {font-size:16px;height:32px;line-height:32px;}
/*links*/
#links {width:1100px;height:54px;overflow:hidden;float:left;margin:0 10px;}
#links ul {height:42px;padding-top:11px;overflow:hidden;width:2000px;}
#links li {float:left;width:90px;margin:0 10px;display:inline;}
#links img {display:block;width:90px;height:32px;overflow:hidden;}
#links a:hover img {opacity:0.8;filter:alpha(opacity=80);}

.slideContainer{position: relative;z-index:0;}

</style>	

	
<div class="index_news mt20 index_news1 "   style="    margin-bottom: -20px;">
	<ul class="index_media_ul index_media_ul4 ml35">
		<li class="index_media_li active">合作伙伴</li>
	</ul>

	
	
	
<div class="content links">
    <div class="links_list">
        <div id="links">
            <ul id="slideContainer" class="slideContainer" >
                
				
				
	<?php if(is_array($indexLink)): $i = 0; $__LIST__ = $indexLink;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
			<a href="<?php echo ($vo['url']); ?>" alt="<?php echo ($vo['title']); ?>" title="<?php echo ($vo['title']); ?>" target="_blank" >
				<img src="/Upload/link/<?php echo ($vo['img']); ?>">
			</a>
		</li><?php endforeach; endif; else: echo "" ;endif; ?>	
				
				
            </ul>
        </div>
    </div>  
</div>
	
	
	
	
	
	
	
	
	
	
	
</div>



<script type="text/javascript">

//c的值为每次滚动数
                var slideContainer = $('#slideContainer'), c = 1, s_w = 110 * c, counts_l = 0, counts_r = 0, maxCounts = slideContainer.find('li').size() - 0, gameOver = true, slideCounts = 10, sTimer;

                function link_next_event() {
                    if (gameOver) {
                        gameOver = false;
                        counts_r++;
                        slideContainer.animate({
                            left: '-=' + s_w
                        }, 500, function() {
                            gameOver = true;
                            slideContainer.animate({
                                left: '+=' + s_w
                            }, 0);
                            slideContainer.find('li:lt(' + c + ')').clone().appendTo(slideContainer);
                            slideContainer.find('li:lt(' + c + ')').remove();
                        });
                    }
                }

                lastCLiHtml();
                slideContainer.find('li:gt(' + (maxCounts - 1) + ')').remove();
                function lastCLiHtml() {
                    var html = '';
                    slideContainer.find('li:gt(' + (maxCounts - c - 1) + ')').each(function() {
                        html += '<li>' + $(this).html() + '</li>';
                    });
                    slideContainer.html(html + slideContainer.html()).css({
                        'margin-left': -s_w + 'px'
                    });
                }

                var l_hover = false, m_hover = false, r_hover = false;
                $('#links').on({
                    'mouseover': function() {
                        m_hover = true;
                        clearInterval(sTimer);
                    },
                    'mouseout': function() {
                        m_hover = false;
                        isStartGo();
                    }
                });


                setInverterTimer();
                function setInverterTimer() {
                    clearInterval(sTimer);
                    sTimer = setInterval(function() {
                        link_next_event();
                    }, 2000);
                }

                function isStartGo() {
                    var st = setTimeout(function() {
                        if (!l_hover && !m_hover && !r_hover) {
                            setInverterTimer();
                        }
                    }, 1000);
                }
  
</script>














<script>
	$('#index_box').addClass('active');
</script>


<script src="/Public/Home/js/canva.index.js?version=201612131123"></script>


<style>


.modal-open {
    overflow: hidden;
}
.modal {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 10000;
    display: none;
    overflow: hidden;
    -webkit-overflow-scrolling: touch;
    outline: 0;
}
.modal.fade .modal-dialog {
    -webkit-transition: -webkit-transform .3s ease-out;
    -o-transition:      -o-transform .3s ease-out;
    transition:         transform .3s ease-out;
    -webkit-transform: translate(0, -25%);
    -ms-transform: translate(0, -25%);
    -o-transform: translate(0, -25%);
    transform: translate(0, -25%);
}
.modal.in .modal-dialog {
    -webkit-transform: translate(0, 0);
    -ms-transform: translate(0, 0);
    -o-transform: translate(0, 0);
    transform: translate(0, 10%);
    /*transform: translate(0, 0);*/
}
.modal-open .modal {
    overflow-x: hidden;
    overflow-y: auto;
}
.modal-dialog {
    position: relative;
    width: auto;
    margin: 10px;
}
.modal-content {
    position: relative;
    background-color: #fff;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    border: 1px solid #999;
    border: 1px solid rgba(0, 0, 0, .2);
    border-radius: 6px;
    outline: 0;
    -webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, .5);
    box-shadow: 0 3px 9px rgba(0, 0, 0, .5);
}
.modal-backdrop {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1040;
    background-color: #000;
}
.modal-backdrop.fade {
    filter: alpha(opacity=0);
    opacity: 0;
}
.modal-backdrop.in {
    filter: alpha(opacity=50);
    opacity: .5;
}
.modal-header {
    min-height: 16.42857143px;
    padding: 15px;
}
.modal-header .close {
    margin-top: -2px;
}
.modal-title {
    margin: 0;
    line-height: 1.42857143;
}
.modal-body {
    position: relative;
    padding: 15px;
}
.modal-footer {
    padding: 5px 0 20px 0;
    text-align: center;
}
.modal-footer .btn + .btn {
    margin-bottom: 0;
    margin-left: 5px;
}
.modal-footer .btn-group .btn + .btn {
    margin-left: -1px;
}
.modal-footer .btn-block + .btn-block {
    margin-left: 0;
}
.modal-scrollbar-measure {
    position: absolute;
    top: -9999px;
    width: 50px;
    height: 50px;
    overflow: scroll;
}
@media (min-width: 768px) {
    .modal-dialog {
        width: 600px;
        margin: 0px auto;
    }
    .modal-content {
        -webkit-box-shadow: 0 5px 15px rgba(0, 0, 0, .5);
        box-shadow: 0 5px 15px rgba(0, 0, 0, .5);
    }
    .modal-sm {
        width: 300px;
    }
}
@media (min-width: 992px) {
    .modal-lg {
        width: 900px;
    }
}

.modal-footer:before,
.modal-footer:after {
    display: table;
    content: " ";
}
.modal-footer:after {
    clear: both;
}



</style>



<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="text-align: center;display: none;padding-right: 16px;">
	<div class="modal-dialog" style="width:640px;text-align:center;">
		<div id="autoCenter" class="modal-content" style="padding: 5px 30px 10px; height: auto; margin-top: 164px;">
			
			
			<div class="modal-header" style="border:none;text-align:left;margin-left:20px;">
				
				<h3 class="modal-title" id="myModalLabel" style="font-size:18px;">
					<?php echo ($C['web_name']); ?>提醒您:
				</h3>
			</div>
			<div class="modal-body" style="font-size:18px;width: 550px;margin-top:-30px;">
				<div class="paragraph paragraph_news" style="font-size:14px;text-indent:2em;line-height: 30px;text-align:left;">
                       <?php echo ($C['web_waring']); ?>
				</div>
			</div>
			<div class="modal-footer" style="border:none;">
				<button type="button" style="cursor:pointer;font-family:Microsoft YaHei !important;font-size:18px;background: #f60;width:200px;height:40px;border:0px;color:white" class="btn btn-warning" data-dismiss="modal" id="yes_sure">我已了解以上风险
				</button>
			</div>
		</div>
	</div>
</div>

<div class="modal-backdrop fade in" style="display:none;"></div>

<script>

	$("#yes_sure").click(function(){
		$('#myModal').css('display','none');
		$('.modal-backdrop').css('display','none');
		$.cookies.set('move_waring', 1);
	});

	$(function () {
        var waring = $.cookies.get('move_waring');
        if (!waring) {
			$('#myModal').css('display','block');
			$('.modal-backdrop').css('display','block');
			$.cookies.set('move_waring', 1,{ hoursToLive: 24 });
        }
    });


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