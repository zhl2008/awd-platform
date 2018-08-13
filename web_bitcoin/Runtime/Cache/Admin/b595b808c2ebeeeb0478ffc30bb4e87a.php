<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>网站后台管理系统</title>
	<link href="/Public/Admin/images/favicon.ico" type="image/x-icon" rel="shortcut icon">
	<!-- Loading Bootstrap -->
	<link href="/Public/Admin/css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/Public/Admin/css/base.css" media="all">
	<link rel="stylesheet" type="text/css" href="/Public/Admin/css/common.css" media="all">
	<link rel="stylesheet" type="text/css" href="/Public/Admin/css/module.css">
	<link rel="stylesheet" type="text/css" href="/Public/Admin/css/style.css" media="all">
	<link rel="stylesheet" type="text/css" href="/Public/Admin/css/default_color.css" media="all">
	<script type="text/javascript" src="/Public/Admin/js/jquery.min.js"></script>
	<script type="text/javascript" src="/Public/layer/layer.js"></script>
	<link href="/Public/Admin/css/flat-ui.css" rel="stylesheet">
	<script src="/Public/Admin/js/flat-ui.min.js"></script>
	<script src="/Public/Admin/js/application.js"></script>
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="navbar-header">
		<a class="navbar-brand" style="width: 200px;text-align: center;" href="#">网站后台管理系统</a>
	</div>
	<div class="navbar-collapse collapse">
		<ul class="nav navbar-nav">
			<!-- 主导航 -->
			<?php if(is_array($__MENU__["main"])): $i = 0; $__LIST__ = $__MENU__["main"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li
				<?php if(($menu["class"]) == "current"): ?>class="active"<?php endif; ?>
				> <a href="<?php echo (U($menu["url"])); ?>">
				<?php if(empty($menu["ico_name"])): ?><span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					<?php else: ?>
					<span class="glyphicon glyphicon-<?php echo ($menu["ico_name"]); ?>" aria-hidden="true"></span><?php endif; ?>
				<?php echo ($menu["title"]); ?> </a></li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
		<ul class="nav navbar-nav navbar-right" style="margin-right: 20px;">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <?php echo session('admin_username');?><b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					<li class="center">
						<a href="/" target="_blank">
							<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> 前台首页 </a>
					</li>
					<li class="center">
						<a href="javascript:void(0);" onClick="lockscreen()">
							<span class="glyphicon glyphicon-lock" aria-hidden="true"></span> 锁屏休息 </a>
					</li>
					<li>
						<a href="<?php echo U('Tools/index');?>">
							<span class="glyphicon glyphicon-leaf" aria-hidden="true"></span> 清除缓存 </a>
					</li>
					<li>
						<a href="<?php echo U('User/setpwd');?>">
							<span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> 修改密码 </a>
					</li>
					<li>
						<a href="<?php echo U('Login/loginout');?>">
							<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> 退出后台 </a>
					</li>
				</ul>
			</li>
		</ul>
	</div><!--/.nav-collapse -->
</div>
<!-- 边栏 -->
<div class="sidebar">
	<!-- 子导航 -->
	
		<div id="subnav" class="subnav" style="
    max-height: 94%;
    overflow-x: hidden;
    overflow-y: auto;
    ">
			<?php if(!empty($_extra_menu)): ?> <?php echo extra_menu($_extra_menu,$__MENU__); endif; ?>
			<?php if(is_array($__MENU__["child"])): $i = 0; $__LIST__ = $__MENU__["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub_menu): $mod = ($i % 2 );++$i;?><!-- 子导航 -->
				<?php if(!empty($sub_menu)): if(!empty($key)): ?><h3><i class="icon icon-unfold"></i><?php echo ($key); ?></h3><?php endif; ?>
					<ul class="side-sub-menu">
						<?php if(is_array($sub_menu)): $i = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li>
								<a class="item" href="<?php echo (U($menu["url"])); ?>">
									<?php if(empty($menu["ico_name"])): ?><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
										<?php else: ?>
										<span class="glyphicon glyphicon-<?php echo ($menu["ico_name"]); ?>" aria-hidden="true"></span><?php endif; ?>
									<?php echo ($menu["title"]); ?> </a>
							</li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul><?php endif; ?>
				<!-- /子导航 --><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
	
	<!-- /子导航 -->
</div>
<!-- /边栏 -->
<?php if(($versionUp) == "1"): ?><div id="main-contenta" class="zuocoin_up">
		<div id="top-alerta" class="fixed alert alert-success" style="    position: static!important; margin-bottom: 0px;    margin: 10px;  background-color: rgba(26, 188, 156, 0.19);    ">
			<button class="close fixed" style="margin-top: 2px; position: static!important; ">&times;</button>
			<div class="alert-contenta">有新版本 <a href="<?php echo U('Cloud/index');?>" class="dropdown-toggle" > 立即去升级 </a></div>
		</div>
	</div>

	<script type="text/javascript" charset="utf-8">
		/**顶部警告栏*/
		var top_alert = $('#top-alerta');
		top_alert.find('.close').on('click', function () {
			top_alert.removeClass('block').slideUp(200);
			// content.animate({paddingTop:'-=55'},200);
		});
	</script><?php endif; ?>


<link href="/Public/Admin/index_css/style.css" rel="stylesheet">
<link href="/Public/Admin/index_js/morris.js-0.4.3/morris.css" rel="stylesheet">
<script src="/Public/Admin/index_js/morris.js-0.4.3/morris.min.js" type="text/javascript"></script>
<script src="/Public/Admin/index_js/morris.js-0.4.3/raphael-min.js" type="text/javascript"></script>
<div id="main-content">
    <div id="top-alert" class="fixed alert alert-error" style="display: none;">
        <button class="close fixed" style="margin-top: 4px;">&times;</button>
        <div class="alert-content">警告内容</div>
    </div>
    <section class="wrapper">
        <!--state overview start-->
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol terques">
                        <i class="glyphicon glyphicon-user"></i>
                    </div>
                    <div class="value">
                        <h1 class="count" style="font-size: 12px;"><?php echo ($arr['reg_sum']); ?></h1>

                        <p>注册总人数</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol red">
                        <i class="glyphicon glyphicon-signal"></i>
                    </div>
                    <div class="value">
                        <h1 class=" count2" style="font-size: 12px;"><?php echo ($arr['cny_num']); ?></h1>

                        <p>人民币总计</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol yellow">
                        <i class="glyphicon glyphicon-tower"></i>
                    </div>
                    <div class="value">
                        <h1 class=" count3" style="font-size: 12px;"><?php echo ($arr['trance_mum']); ?></h1>

                        <p>累计交易额</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol blue">
                        <i class="glyphicon glyphicon-list-alt"></i>
                    </div>
                    <div class="value">
                        <h1 class=" count4" style="font-size: 12px;"><?php echo ($arr['art_sum']); ?></h1>

                        <p>文章总数</p>
                    </div>
                </section>
            </div>
        </div>
        <div id="morris">
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading text-warning">
                            用户注册报表(30天)
                        </header>
                        <div class="panel-body">
                            <div id="hero-bar" class="graph"></div>
                        </div>
                    </section>
                </div>
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading text-success">
                            系统 充值/提现 统计图(30天)
                        </header>
                        <div class="panel-body">
                            <div id="hero-graph" class="graph"></div>
                        </div>
                    </section>
                </div>
            </div>
            <style>
                .version a {
                    animation: myfirst 2s;
                    -moz-animation: myfirst 2s; /* Firefox */
                    -webkit-animation: myfirst 2s; /* Safari and Chrome */
                    -o-animation: myfirst 2s; /* Opera */
                }

                @keyframes myfirst {
                    from {
                        color: #2f4154;
                    }
                    to {
                        color: green;
                    }
                }

                @-moz-keyframes myfirst /* Firefox */
                {
                    from {
                        color: #2f4154;
                    }
                    to {
                        color: green;
                    }
                }

                @-webkit-keyframes myfirst /* Safari and Chrome */
                {
                    from {
                        color: #2f4154;
                    }
                    to {
                        color: green;
                    }
                }

                @-o-keyframes myfirst /* Opera */
                {
                    from {
                        color: #2f4154;
                    }
                    to {
                        color: green;
                    }
                }
            </style>
            <div class="row">
                <div class="col-lg-6">
                    <div class="container-span">
                        <div class="span4" style="width: 100%;margin-left: 0;">
                            <div class="columns-mod">
                                <div class="bd" style="background-color: #fff">
                                    <div class="sys-info">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="container-span">
                        <div class="span4" style="width: 100%;margin-left: 0;">
                            <div class="columns-mod">
                                <div class="bd" style="background-color: #fff">
                                    <div class="sys-info">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    var Script = function () {
        $(function () {
            show_cztx(<?php echo ($cztx); ?>);
            show_reg(<?php echo ($reg); ?>);

            //系统 充值/提现 统计图
            function show_cztx(data) {
                Morris.Line({
                    element: 'hero-graph',
                    data: data,
                    xkey: 'date',
                    ykeys: [
                        'charge',
                        'withdraw'
                    ],
                    labels: [
                        '充值',
                        '提现'
                    ],
                    lineColors: [
                        '#8075c4',
                        '#6883a3'
                    ],
                    xLabels: 'day',
                    postUnits: ' 元'
                });
            }

            //用户注册报表
            function show_reg(data) {
                Morris.Bar({
                    element: 'hero-bar',
                    data: data,
                    xkey: 'date',
                    ykeys: ['sum'],
                    labels: ['人数'],
                    barRatio: 0.4,
                    xLabelAngle: 35,
                    hideHover: 'auto',
                    barColors: ['#6883a3'],
                    xLabels: 'day',
                    postUnits: ' 人',
                });
            }

            //市场交易报表
            function show_trance(data) {
                Morris.Area({
                    element: 'hero-area',
                    data: [
                        {date: '2016-02-24', btc: 2666, msc: null, ltc: 2647},
                        {date: '2016-02-25', btc: 2778, msc: 2294, ltc: 2441},
                        {date: '2016-02-26', btc: 4912, msc: 1969, ltc: 2501},
                        {date: '2016-02-27', btc: 3767, msc: 3597, ltc: 5689},
                        {date: '2016-02-28', btc: 3767, msc: 3597, ltc: 5689},
                        {date: '2016-02-29', btc: 3767, msc: 3597, ltc: 5689},
                        {date: '2016-02-30', btc: 3767, msc: 3597, ltc: 5689},
                        {date: '2016-02-31', btc: 3767, msc: 3597, ltc: 5689},
                        {date: '2016-03-1', btc: 3767, msc: 3597, ltc: 5689},
                        {date: '2016-03-2', btc: 3767, msc: 3597, ltc: 5689},
                    ],

                    xkey: 'date',
                    ykeys: [
                        'btc',
                        'msc',
                        'ltc'
                    ],
                    labels: [
                        '比特币',
                        '动说币',
                        '莱特币'
                    ],
                    hideHover: 'auto',
                    lineWidth: 1,
                    pointSize: 10,
                    lineColors: [
                        '#4a8bc2',
                        '#ff6c60',
                        '#a9d86e'
                    ],
                    fillOpacity: 0.5,
                    smooth: true,
                    postUnits: ' 元',
                    xLabels: 'day',
                });
            }

            //市场活跃报表
            function show_active() {
                Morris.Donut({
                    element: 'hero-donut',
                    data: [
                        {label: '人民币', value: 10450},
                        {label: '人民币总计', value: 8440},
                    ],
                    colors: [
                        '#41cac0',
                        '#ff6c60',
                        '#FF6C60'
                    ],
                    formatter: function (y) {
                        return y + "总之"
                    }
                });
            }
        });

    }();
</script>






<script type="text/javascript" src="/Public/Admin/js/common.js"></script>
<script type="text/javascript">
	+function(){
		//$("select").select2({dropdownCssClass: 'dropdown-inverse'});//下拉条样式
		layer.config({
			extend: 'extend/layer.ext.js'
		});

		var $window = $(window), $subnav = $("#subnav"), url;
		$window.resize(function(){
			//$("#main").css("min-height", $window.height() - 90);
		}).resize();

		/* 左边菜单高亮 */
		url = window.location.pathname + window.location.search;

		url = url.replace(/(\/(p)\/\d+)|(&p=\d+)|(\/(id)\/\d+)|(&id=\d+)|(\/(group)\/\d+)|(&group=\d+)/, "");
		$subnav.find("a[href='" + url + "']").parent().addClass("current");

		/* 左边菜单显示收起 */
		$("#subnav").on("click", "h3", function(){
			var $this = $(this);
			$this.find(".icon").toggleClass("icon-fold");
			$this.next().slideToggle("fast").siblings(".side-sub-menu:visible").
			prev("h3").find("i").addClass("icon-fold").end().end().hide();
		});

		$("#subnav h3 a").click(function(e){e.stopPropagation()});

		/* 头部管理员菜单 */
		$(".user-bar").mouseenter(function(){
			var userMenu = $(this).children(".user-menu ");
			userMenu.removeClass("hidden");
			clearTimeout(userMenu.data("timeout"));
		}).mouseleave(function(){
			var userMenu = $(this).children(".user-menu");
			userMenu.data("timeout") && clearTimeout(userMenu.data("timeout"));
			userMenu.data("timeout", setTimeout(function(){userMenu.addClass("hidden")}, 100));
		});

		/* 表单获取焦点变色 */
		$("form").on("focus", "input", function(){
			$(this).addClass('focus');
		}).on("blur","input",function(){
			$(this).removeClass('focus');
		});
		$("form").on("focus", "textarea", function(){
			$(this).closest('label').addClass('focus');
		}).on("blur","textarea",function(){
			$(this).closest('label').removeClass('focus');
		});

		// 导航栏超出窗口高度后的模拟滚动条
		var sHeight = $(".sidebar").height();
		var subHeight  = $(".subnav").height();
		var diff = subHeight - sHeight; //250
		var sub = $(".subnav");
		if(diff > 0){
//			$(window).mousewheel(function(event, delta){
//				if(delta>0){
//					if(parseInt(sub.css('marginTop'))>-10){
//						sub.css('marginTop','0px');
//					}else{
//						sub.css('marginTop','+='+10);
//					}
//				}else{
//					if(parseInt(sub.css('marginTop'))<'-'+(diff-10)){
//						sub.css('marginTop','-'+(diff-10));
//					}else{
//						sub.css('marginTop','-='+10);
//					}
//				}
//			});
		}
	}();

	//导航高亮
	function highlight_subnav(url){
		$('.side-sub-menu').find('a[href="'+url+'"]').closest('li').addClass('current');
	}

	function lockscreen(){
		layer.prompt({
			title: '输入一个锁屏密码',
			formType: 1,
			btn: ['锁屏','取消'] //按钮
		}, function(pass){
			if(!pass){
				layer.msg('需要输入一个密码!');
			}else{
				$.post("<?php echo U('Login/lockScreen');?>",{pass:pass},function(data){
					layer.msg(data.info);
					layer.close();
					if(data.status){
						window.location.href = "<?php echo U('Login/lockScreen');?>";
					}
				},'json');
			}
		});
	}
</script>




<div style="display:none;">

<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1261321738'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s4.cnzz.com/z_stat.php%3Fid%3D1261321738%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));</script>

</div>








</body>
</html>

    <script type="text/javascript" charset="utf-8">
        //导航高亮
        highlight_subnav("<?php echo U('Index/index');?>");
    </script>