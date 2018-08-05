<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:38:"./template/pc/rainbow/index/index.html";i:1509985968;s:40:"./template/pc/rainbow/public/header.html";i:1509985968;s:40:"./template/pc/rainbow/public/footer.html";i:1512529514;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>首页-<?php echo $tpshop_config['shop_info_store_title']; ?></title>
    <meta name="keywords" content="<?php echo $tpshop_config['shop_info_store_keyword']; ?>"/>
    <meta name="description" content="<?php echo $tpshop_config['shop_info_store_desc']; ?>"/>
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/base.css"/>
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/index.css"/>
    <script src="__STATIC__/js/jquery-1.11.3.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="__PUBLIC__/js/global.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $tpshop_config['shop_info_store_logo']; ?>" media="screen"/>
</head>
<body class="gray_f5">
<!--header-s-->
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/base.css"/>
<div class="tpshop-tm-hander">
	<div class="top-hander clearfix">
		<div class="w1224 pr clearfix">
			<div class="fl">
			    <?php if(strtolower(ACTION_NAME) != 'goodsinfo'): ?>
                      <link rel="stylesheet" href="__STATIC__/css/location.css" type="text/css"><!-- 收货地址，物流运费 -->
                      <div class="sendaddress pr fl">
                          <span>送货至：</span>
                          <!-- <span>深圳<i class="share-a_a1"></i></span>-->
                          <span>
                              <ul class="list1">
                                  <li class="summary-stock though-line">
                                      <div class="dd" style="border-right:0px;width:200px;">
                                          <div class="store-selector add_cj_p">
                                              <div class="text"><div></div><b></b></div>
                                              <div onclick="$(this).parent().removeClass('hover')" class="close"></div>
                                          </div>
                                      </div>
                                  </li>
                              </ul>
                          </span>
                      </div>
                      <script src="__STATIC__/js/location.js"></script>
                <?php endif; ?>
				<div class="fl nologin">
					<a class="red" href="<?php echo U('Home/user/login'); ?>">登录</a>
					<a href="<?php echo U('Home/user/reg'); ?>">注册</a>
				</div>
				<div class="fl islogin hide">
					<a class="red userinfo" href="<?php echo U('Home/user/index'); ?>"></a>
					<a  href="<?php echo U('Home/user/logout'); ?>"  title="退出" target="_self">安全退出</a>
				</div>
			</div>
			<ul class="top-ri-header fr clearfix">
				<li><a target="_blank" href="<?php echo U('Home/Order/order_list'); ?>">我的订单</a></li>
				<li class="spacer"></li>
				<li><a target="_blank" href="<?php echo U('Home/User/visit_log'); ?>">我的浏览</a></li>
				<li class="spacer"></li>
				<li><a target="_blank" href="<?php echo U('Home/User/goods_collect'); ?>">我的收藏</a></li>
				<li class="spacer"></li>
				<li>客户服务</li>
				<li class="spacer"></li>
				<li class="hover-ba-navdh">
					<div class="nav-dh">
						<span>网站导航</span>
						<i class="share-a_a1"></i>
					</div>
					<ul class="conta-hv-nav clearfix">
						<li>
							<a href="#">优惠活动</a>
						</li>
						<li>
							<a href="#">预售活动</a>
						</li>
						<li>
							<a href="#">拍卖活动</a>
						</li>
						<li>
							<a href="#">兑换中心</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<div class="nav-middan-z w1224 clearfix">
		<a class="ecsc-logo" href="#">
            <img src="<?php echo $tpshop_config['shop_info_store_logo']; ?>" style="width: 159px;height: 58px;">
        </a>
		<div class="ecsc-search">
			<form id="searchForm" name="" method="get" action="<?php echo U('Home/Goods/search'); ?>" class="ecsc-search-form">
				<input autocomplete="off" name="q" id="q" type="text" value="<?php echo \think\Request::instance()->param('q'); ?>" class="ecsc-search-input" placeholder="请输入搜索关键字...">
				<button type="submit" class="ecsc-search-button">搜索</button>
    			<div class="candidate p">
                    <ul id="search_list"></ul>
                </div>
                <script type="text/javascript">
                    ;(function($){
                        $.fn.extend({
                            donetyping: function(callback,timeout){
                                timeout = timeout || 1e3;
                                var timeoutReference,
                                        doneTyping = function(el){
                                            if (!timeoutReference) return;
                                            timeoutReference = null;
                                            callback.call(el);
                                        };
                                return this.each(function(i,el){
                                    var $el = $(el);
                                    $el.is(':input') && $el.on('keyup keypress',function(e){
                                        if (e.type=='keyup' && e.keyCode!=8) return;
                                        if (timeoutReference) clearTimeout(timeoutReference);
                                        timeoutReference = setTimeout(function(){
                                            doneTyping(el);
                                        }, timeout);
                                    }).on('blur',function(){
                                        doneTyping(el);
                                    });
                                });
                            }
                        });
                    })(jQuery);

                    $('.ecsc-search-input').donetyping(function(){
                        search_key();
                    },500).focus(function(){
                        var search_key = $.trim($('#q').val());
                        if(search_key != ''){
                            $('.candidate').show();
                        }
                    });
                    $('.candidate').mouseleave(function(){
                        $(this).hide();
                    });

                    function searchWord(words){
                        $('#q').val(words);
                        $('#searchForm').submit();
                    }
                    function search_key(){
                        var search_key = $.trim($('#q').val());
                        if(search_key != ''){
                            $.ajax({
                                type:'post',
                                dataType:'json',
                                data: {key: search_key},
                                url:"<?php echo U('Home/Api/searchKey'); ?>",
                                success:function(data){
                                    if(data.status == 1){
                                        var html = '';
                                        $.each(data.result, function (n, value) {
                                            html += '<li onclick="searchWord(\''+value.keywords+'\');"><div class="search-item">'+value.keywords+'</div><div class="search-count">约'+value.goods_num+'个商品</div></li>';
                                        });
                                        html += '<li class="close"><div class="search-count">关闭</div></li>';
                                        $('#search_list').empty().append(html);
                                        $('.candidate').show();
                                    }else{
                                        $('#search_list').empty();
                                    }
                                }
                            });
                        }
                    }
                </script>
			</form>
			<div class="keyword clearfix">
				<?php if(is_array($tpshop_config['hot_keywords']) || $tpshop_config['hot_keywords'] instanceof \think\Collection || $tpshop_config['hot_keywords'] instanceof \think\Paginator): if( count($tpshop_config['hot_keywords'])==0 ) : echo "" ;else: foreach($tpshop_config['hot_keywords'] as $k=>$wd): ?>
				<a class="key-item" href="<?php echo U('Home/Goods/search',array('q'=>$wd)); ?>" target="_blank"><?php echo $wd; ?></a>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
		<div class="u-g-cart fr" id="hd-my-cart">
			<a href="<?php echo U('Home/Cart/index'); ?>">
			<div class="c-n fl">
				<i class="share-shopcar-index"></i>
				<span>我的购物车</span>
				<em class="shop-nums" id="cart_quantity"></em>
			</div>
			</a>
			<div class="u-fn-cart" id="show_minicart">
				<div class="minicartContent" id="minicart">
				</div>
			</div>
		</div>
	</div>
	<div class="nav w1224 clearfix">
		<div class="categorys home_categorys">
			<div class="dt">
				<a href="" target="_blank"><i class="share-a_a2"></i>全部商品分类</a>
			</div>
			<!--全部商品分类-s-->
			<div class="dd">
				<div class="cata-nav" id="cata-nav">
				<?php if(is_array($goods_category_tree) || $goods_category_tree instanceof \think\Collection || $goods_category_tree instanceof \think\Paginator): $kr = 0; $__LIST__ = $goods_category_tree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($kr % 2 );++$kr;?>
					<div class="item">
						<?php if($v[level] == 1): ?>
						<div class="item-left">
							<h3 class="cata-nav-name">
								<div class="cata-nav-wrap">
									<i class="ico ico-nav-<?php echo $kr-1; ?>"></i>
									<a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v[id])); ?>" title="<?php echo $v[name]; ?>"><?php echo $v[mobile_name]; ?></a>
								</div>
								<!--<a href="" >手机店</a>-->
							</h3>
						</div>
						<?php endif; ?>
						<div class="cata-nav-layer">
							<div class="cata-nav-left">
								<div class="cata-layer-title">
									<?php if(is_array($v['hot_cate']) || $v['hot_cate'] instanceof \think\Collection || $v['hot_cate'] instanceof \think\Paginator): if( count($v['hot_cate'])==0 ) : echo "" ;else: foreach($v['hot_cate'] as $key=>$hc): ?>
									<a class="layer-title-item" href=""><?php echo $hc['name']; ?><i class="ico ico-arrow-right">></i></a>
									<?php endforeach; endif; else: echo "" ;endif; ?>
								</div>
								<div class="subitems">
									<?php if(is_array($v['tmenu']) || $v['tmenu'] instanceof \think\Collection || $v['tmenu'] instanceof \think\Paginator): if( count($v['tmenu'])==0 ) : echo "" ;else: foreach($v['tmenu'] as $k2=>$v2): if($v2[parent_id] == $v['id']): ?>
										<dl class="clearfix">
											<dt><a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v2[id])); ?>" target="_blank"><?php echo $v2[name]; ?></a></dt>
											<dd class="clearfix">
												<?php if(is_array($v2['sub_menu']) || $v2['sub_menu'] instanceof \think\Collection || $v2['sub_menu'] instanceof \think\Paginator): if( count($v2['sub_menu'])==0 ) : echo "" ;else: foreach($v2['sub_menu'] as $k3=>$v3): if($v3[parent_id] == $v2['id']): ?>
													<a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v3[id])); ?>" target="_blank"><?php echo $v3[name]; ?></a>
													<?php endif; endforeach; endif; else: echo "" ;endif; ?>
											</dd>
										</dl>
									<?php endif; endforeach; endif; else: echo "" ;endif; ?>
								</div>
							</div>
							<div class="advertisement_down">
								<?php $pid =10+$kr;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1512529200 and end_time > 1512529200 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("5")->select();
if(is_array($ad_position) && !in_array($pid,array_keys($ad_position)) && $pid)
{
  M("ad_position")->insert(array(
         "position_id"=>$pid,
         "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ",
         "is_open"=>1,
         "position_desc"=>CONTROLLER_NAME."页面",
  ));
  delFile(RUNTIME_PATH); // 删除缓存
  \think\Cache::clear();  
}


$c = 5- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && I("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "ad_code" => "/public/images/not_adv.jpg",
          "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid",
          "title"   =>"暂无广告图片",
          "not_adv" => 1,
          "target" => 0,
      );  
    }
}
foreach($result as $key=>$v3):       
    
    $v3[position] = $ad_position[$v3[pid]]; 
    if(I("get.edit_ad") && $v3[not_adv] == 0 )
    {
        $v3[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v3[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v3[ad_id]";        
        $v3[title] = $ad_position[$v3[pid]][position_name]."===".$v3[ad_name];
        $v3[target] = 0;
    }
    ?>
								<a href="<?php echo $v3[ad_link]; ?>" <?php if($v3['target'] == 1): ?>target="_blank"<?php endif; ?>>
									<img class="w-100" src="<?php echo $v3[ad_code]; ?>" title="<?php echo $v3[title]; ?>"/>
								</a>
								<?php endforeach; ?>
							</div>
							<?php $pid =51;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1512529200 and end_time > 1512529200 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
if(is_array($ad_position) && !in_array($pid,array_keys($ad_position)) && $pid)
{
  M("ad_position")->insert(array(
         "position_id"=>$pid,
         "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ",
         "is_open"=>1,
         "position_desc"=>CONTROLLER_NAME."页面",
  ));
  delFile(RUNTIME_PATH); // 删除缓存
  \think\Cache::clear();  
}


$c = 1- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && I("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "ad_code" => "/public/images/not_adv.jpg",
          "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid",
          "title"   =>"暂无广告图片",
          "not_adv" => 1,
          "target" => 0,
      );  
    }
}
foreach($result as $key=>$az):       
    
    $az[position] = $ad_position[$az[pid]]; 
    if(I("get.edit_ad") && $az[not_adv] == 0 )
    {
        $az[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $az[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$az[ad_id]";        
        $az[title] = $ad_position[$az[pid]][position_name]."===".$az[ad_name];
        $az[target] = 0;
    }
    ?>
							<a href="<?php echo $az[ad_link]; ?>" class="cata-nav-rigth" <?php if($az['target'] == 1): ?>target="_blank"<?php endif; ?>>
								<img class="w-100" src="<?php echo $az[ad_code]; ?>" title="<?php echo $az[title]; ?>" />
							</a>
							<?php endforeach; ?>
						</div>
					</div>
					<?php endforeach; endif; else: echo "" ;endif; ?>					
				</div>
				<script>
					$('#cata-nav').find('.item').hover(function () {
						$(this).addClass('nav-active').siblings().removeClass('nav-active');
					},function () {
						$(this).removeClass('nav-active');
					})
				</script>
			</div>
			<!--全部商品分类-e-->
		</div>
		<ul class="navitems clearfix" id="navitems">
			<li <?php if(CONTROLLER_NAME == 'Index'): ?>class="selected"<?php endif; ?>><a href="<?php echo U('Index/index'); ?>">首页</a></li>
			<?php
                                   
                                $md5_key = md5("SELECT * FROM `__PREFIX__navigation` where is_show = 1 ORDER BY `sort` DESC");
                                $result_name = $sql_result_v = S("sql_".$md5_key);
                                if(empty($sql_result_v))
                                {                            
                                    $result_name = $sql_result_v = \think\Db::query("SELECT * FROM `__PREFIX__navigation` where is_show = 1 ORDER BY `sort` DESC"); 
                                    S("sql_".$md5_key,$sql_result_v,86400);
                                }    
                              foreach($sql_result_v as $k=>$v): ?>
			<li <?php if($_SERVER['REQUEST_URI']==str_replace('&amp;','&',$v[url])){ echo "class='selected'";}?>>
       			<a href="<?php echo $v[url]; ?>" <?php if($v[is_new] == 1): ?>target="_blank" <?php endif; ?> ><?php echo $v[name]; ?></a>
       		</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>

<!--header-e-->
<div id="myCarousel" class="carousel clearfix">
	<ul class="carousel-inner">
        <?php $pid =2;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1512529200 and end_time > 1512529200 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("5")->select();
if(is_array($ad_position) && !in_array($pid,array_keys($ad_position)) && $pid)
{
  M("ad_position")->insert(array(
         "position_id"=>$pid,
         "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ",
         "is_open"=>1,
         "position_desc"=>CONTROLLER_NAME."页面",
  ));
  delFile(RUNTIME_PATH); // 删除缓存
  \think\Cache::clear();  
}


$c = 5- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && I("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "ad_code" => "/public/images/not_adv.jpg",
          "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid",
          "title"   =>"暂无广告图片",
          "not_adv" => 1,
          "target" => 0,
      );  
    }
}
foreach($result as $key=>$v1):       
    
    $v1[position] = $ad_position[$v1[pid]]; 
    if(I("get.edit_ad") && $v1[not_adv] == 0 )
    {
        $v1[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v1[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v1[ad_id]";        
        $v1[title] = $ad_position[$v1[pid]][position_name]."===".$v1[ad_name];
        $v1[target] = 0;
    }
    ?>
		<li class="item" style="background:<?php echo $v1['bgcolor']; ?>;">
			<a class="item-pic" href="<?php echo $v1[ad_link]; ?>" <?php if($v1['target'] == 1): ?>target="_blank"<?php endif; ?>>
			<img class="w-100" src="<?php echo $v1[ad_code]; ?>" title="<?php echo $v1[title]; ?>" alt="<?php echo $v1[title]; ?>"></a>
		</li>
		<?php endforeach; ?>
	</ul>
	<div class="pagination">

	</div>
	<a class="carousel-control left-btn t-all" href="javascript:;" data-slide="prev"></a>
	<a class="carousel-control right-btn t-all" href="javascript:;" data-slide="next"></a>
	<script>
		$(function() {
			function banner() {
				var windowWidth=$(window).width();  //获取轮播图的宽度（这里是全屏）
				window.onresize=function(){  //屏幕大小改变时 自适应
					windowWidth=$(window).width();
					$_banner.css({'width':windowWidth*(length+2),left:-windowWidth});
					$_banner.find('.item').css('width',windowWidth);
				};
				var $_bannerWrap=$('#myCarousel');
				var $_banner=$_bannerWrap.find('.carousel-inner');
				var length=$_banner.find('.item').length;
				var first=$_banner.find('.item').eq(0).clone();
				var last=$_banner.find('.item:last').clone();
				var timer; //定时器
				$_banner.append(first);
				$_banner.prepend(last);
				//初始化 轮播图列表宽度和列表项宽度
				$_banner.css({'width':windowWidth*(length+2),left:-windowWidth});
				$_banner.find('.item').css('width',windowWidth);

				var $_pagination=$_bannerWrap.find('.pagination');
				for(var i=0;i<length;i++){  //自动增加白色索引点击点
					$_pagination.append('<span class="pagination-item"></span>');
				}
				var iNow=1; //索引记录标志
				hoverActive(iNow); //初始化状态标记
				$_bannerWrap.find('.left-btn').click(function () {
					clearInterval(timer);
					iNow--;
					bannerRun();
				});
				$_bannerWrap.find('.right-btn').click(function () {
					clearInterval(timer);
					iNow++;
					bannerRun();
				});
				$_pagination.find('.pagination-item').click(function () {
					iNow=$(this).index()+1;
					$_banner.finish().animate({left:-iNow*windowWidth},500);
					hoverActive(iNow);
				});
				function bannerAutoRun(){  //轮播图自动循环播放 间隔4秒
					timer=setInterval(function() {
						iNow++;
						bannerRun();
					},4000)
				}
				bannerAutoRun();

				//移动上面去停止，移动出来继续轮播
				function hoverChangeRun(ele){
					ele.hover(function(){
						clearInterval(timer);
					},function () {
						bannerAutoRun();
					});
				}
				hoverChangeRun($_banner.find('.item-pic'));
				hoverChangeRun($_pagination.find('.pagination-item'));
				hoverChangeRun($_bannerWrap.find('.carousel-control'));

				function hoverActive(index){ //切换时改变状态
					$_banner.find('.item').eq(index).addClass('slide-active').siblings().removeClass('slide-active');
					$_pagination.find('.pagination-item').eq(index-1).addClass('active').siblings().removeClass('active');
				}
				function bannerRun(){ //点击切换图片
					if(iNow>length){
						$_banner.finish().animate({left:-iNow*windowWidth},300,function(){
							$_banner.css({left:-1*windowWidth});
						});
						iNow=1;
					}else if(iNow<1){
						$_banner.finish().animate({left:-iNow*windowWidth},500,function(){
							$_banner.css({left:-length*windowWidth});
						});
						iNow=length;
					}else{
						$_banner.finish().animate({left:-iNow*windowWidth},300);
					}
					hoverActive(iNow);
				}
			}
			banner();
		})
	</script>
	<div class="banner-right-box">
	<?php $pid =52;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1512529200 and end_time > 1512529200 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("2")->select();
if(is_array($ad_position) && !in_array($pid,array_keys($ad_position)) && $pid)
{
  M("ad_position")->insert(array(
         "position_id"=>$pid,
         "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ",
         "is_open"=>1,
         "position_desc"=>CONTROLLER_NAME."页面",
  ));
  delFile(RUNTIME_PATH); // 删除缓存
  \think\Cache::clear();  
}


$c = 2- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && I("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "ad_code" => "/public/images/not_adv.jpg",
          "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid",
          "title"   =>"暂无广告图片",
          "not_adv" => 1,
          "target" => 0,
      );  
    }
}
foreach($result as $key=>$vb):       
    
    $vb[position] = $ad_position[$vb[pid]]; 
    if(I("get.edit_ad") && $vb[not_adv] == 0 )
    {
        $vb[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $vb[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$vb[ad_id]";        
        $vb[title] = $ad_position[$vb[pid]][position_name]."===".$vb[ad_name];
        $vb[target] = 0;
    }
    ?>
		<a class="banner-right-item t-all" href="<?php echo $vb[ad_link]; ?>"><img src="<?php echo $vb[ad_code]; ?>" alt="<?php echo $vb[title]; ?>" /></a>
	<?php endforeach; ?>
	</div>
</div>

<div class="adv3 w1224 clearfix">
	<?php $pid =50;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1512529200 and end_time > 1512529200 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("3")->select();
if(is_array($ad_position) && !in_array($pid,array_keys($ad_position)) && $pid)
{
  M("ad_position")->insert(array(
         "position_id"=>$pid,
         "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ",
         "is_open"=>1,
         "position_desc"=>CONTROLLER_NAME."页面",
  ));
  delFile(RUNTIME_PATH); // 删除缓存
  \think\Cache::clear();  
}


$c = 3- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && I("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "ad_code" => "/public/images/not_adv.jpg",
          "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid",
          "title"   =>"暂无广告图片",
          "not_adv" => 1,
          "target" => 0,
      );  
    }
}
foreach($result as $key=>$vr):       
    
    $vr[position] = $ad_position[$vr[pid]]; 
    if(I("get.edit_ad") && $vr[not_adv] == 0 )
    {
        $vr[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $vr[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$vr[ad_id]";        
        $vr[title] = $ad_position[$vr[pid]][position_name]."===".$vr[ad_name];
        $vr[target] = 0;
    }
    ?>
	<a class="recommend-brand t-all" href="<?php echo $vr[ad_link]; ?>">
		<img class="w-100" src="<?php echo $vr[ad_code]; ?>" alt="<?php echo $vr[title]; ?>" title="<?php echo $vr[title]; ?>"/>
	</a>
	<?php endforeach; ?>
</div>

<?php $pid =49;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1512529200 and end_time > 1512529200 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
if(is_array($ad_position) && !in_array($pid,array_keys($ad_position)) && $pid)
{
  M("ad_position")->insert(array(
         "position_id"=>$pid,
         "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ",
         "is_open"=>1,
         "position_desc"=>CONTROLLER_NAME."页面",
  ));
  delFile(RUNTIME_PATH); // 删除缓存
  \think\Cache::clear();  
}


$c = 1- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && I("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "ad_code" => "/public/images/not_adv.jpg",
          "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid",
          "title"   =>"暂无广告图片",
          "not_adv" => 1,
          "target" => 0,
      );  
    }
}
foreach($result as $key=>$v5):       
    
    $v5[position] = $ad_position[$v5[pid]]; 
    if(I("get.edit_ad") && $v5[not_adv] == 0 )
    {
        $v5[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v5[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v5[ad_id]";        
        $v5[title] = $ad_position[$v5[pid]][position_name]."===".$v5[ad_name];
        $v5[target] = 0;
    }
    ?>
	<a href="<?php echo $v5[ad_link]; ?>" class="adver_line">
		<img class="w-100" src="<?php echo $v5[ad_code]; ?>" alt="<?php echo $v5[title]; ?>"/>
	</a>
<?php endforeach; if(is_array($cateList) || $cateList instanceof \think\Collection || $cateList instanceof \think\Paginator): if( count($cateList)==0 ) : echo "" ;else: foreach($cateList as $k=>$v): ?>
<div class="floor floor<?php echo $k+1; ?> w1224">
	<div class="floor-top">
		<h3 class="floor-title"><?php echo $v[name]; ?></h3>
		<div class="floor-nav-list clearfix">
			<?php if(is_array($v[tmenu]) || $v[tmenu] instanceof \think\Collection || $v[tmenu] instanceof \think\Paginator): if( count($v[tmenu])==0 ) : echo "" ;else: foreach($v[tmenu] as $k2=>$v2): ?>
			<a class="floor-nav-item" href="<?php echo U('Home/Goods/goodsList',array('id'=>$v2[id])); ?>"><?php echo $v2[name]; ?></a>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		<a class="nav-more-btn" href="<?php echo U('Home/Goods/goodsList',array('id'=>$v[id])); ?>">更多<i>></i></a>
	</div>
	<div class="floor-main">
		<div class="floor-brand">
			<?php $pid =10+$k;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1512529200 and end_time > 1512529200 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
if(is_array($ad_position) && !in_array($pid,array_keys($ad_position)) && $pid)
{
  M("ad_position")->insert(array(
         "position_id"=>$pid,
         "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ",
         "is_open"=>1,
         "position_desc"=>CONTROLLER_NAME."页面",
  ));
  delFile(RUNTIME_PATH); // 删除缓存
  \think\Cache::clear();  
}


$c = 1- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && I("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "ad_code" => "/public/images/not_adv.jpg",
          "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid",
          "title"   =>"暂无广告图片",
          "not_adv" => 1,
          "target" => 0,
      );  
    }
}
foreach($result as $key=>$vl):       
    
    $vl[position] = $ad_position[$vl[pid]]; 
    if(I("get.edit_ad") && $vl[not_adv] == 0 )
    {
        $vl[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $vl[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$vl[ad_id]";        
        $vl[title] = $ad_position[$vl[pid]][position_name]."===".$vl[ad_name];
        $vl[target] = 0;
    }
    ?>
			<a class="brand-big" href="<?php echo $vl[ad_link]; ?>"><img class="w-100" src="<?php echo $vl[ad_code]; ?>" alt="<?php echo $vl[title]; ?>" /></a>
			<?php endforeach; $pid =20+$k;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1512529200 and end_time > 1512529200 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
if(is_array($ad_position) && !in_array($pid,array_keys($ad_position)) && $pid)
{
  M("ad_position")->insert(array(
         "position_id"=>$pid,
         "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ",
         "is_open"=>1,
         "position_desc"=>CONTROLLER_NAME."页面",
  ));
  delFile(RUNTIME_PATH); // 删除缓存
  \think\Cache::clear();  
}


$c = 1- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && I("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "ad_code" => "/public/images/not_adv.jpg",
          "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid",
          "title"   =>"暂无广告图片",
          "not_adv" => 1,
          "target" => 0,
      );  
    }
}
foreach($result as $key=>$vs):       
    
    $vs[position] = $ad_position[$vs[pid]]; 
    if(I("get.edit_ad") && $vs[not_adv] == 0 )
    {
        $vs[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $vs[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$vs[ad_id]";        
        $vs[title] = $ad_position[$vs[pid]][position_name]."===".$vs[ad_name];
        $vs[target] = 0;
    }
    ?>
			<a class="brand-samll" href="<?php echo $vs[ad_link]; ?>"><img class="w-100" src="<?php echo $vs[ad_code]; ?>" alt="<?php echo $vs[title]; ?>" /></a>
			<?php endforeach; ?>
		</div>
		<div class="floor-goods-list">
			<?php if(is_array($v[hot_goods]) || $v[hot_goods] instanceof \think\Collection || $v[hot_goods] instanceof \think\Paginator): if( count($v[hot_goods])==0 ) : echo "" ;else: foreach($v[hot_goods] as $gk=>$g): ?>
			<a class="floor-goods-item" href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$g[goods_id])); ?>">
				<div class="googs-title ellipsis-1"><?php echo getSubstr($g[goods_name],0,20); ?></div>
				<div class="googs-price ellipsis-1">￥<?php echo $g[shop_price]; ?></div>
				<div class="goods-pic"><img class="w-100" src="<?php echo goods_thum_images($g[goods_id],400,400); ?>" alt=""></div>
			</a>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		<div class="floor-recommend">
			<div class="floor-recommend-title">热门推荐</div>
			<div class="floor-recommend-wrap">
				<div class="floor-recommend-list">
					<?php if(is_array($v[recommend_goods]) || $v[recommend_goods] instanceof \think\Collection || $v[recommend_goods] instanceof \think\Paginator): if( count($v[recommend_goods])==0 ) : echo "" ;else: foreach($v[recommend_goods] as $gk=>$rg): ?>
					<a class="floor-recommend-item" href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$rg[goods_id])); ?>">
						<div class="floor-recommend-pic">
							<img class="w-100" src="<?php echo goods_thum_images($rg[goods_id],200,200); ?>" alt="" />
						</div>
						<div class="floor-recommend-cont">
							<div class="recommend-goods-name ellipsis-1"><?php echo getSubstr($rg[goods_name],0,15); ?></div>
							<div class="recommend-goods-des ellipsis-1"><?php echo $rg[goods_remark]; ?></div>
							<div class="recommend-goods-price  recommend-goods-des">￥ <?php echo $rg[shop_price]; ?></div>
						</div>
					</a>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
			<a class="recommend-more-btn" href="<?php echo U('Home/Goods/goodsList',array('id'=>$v[id])); ?>">更多 <i>></i></a>
		</div>
	</div>
</div>
<?php endforeach; endif; else: echo "" ;endif; ?>
<div class="tpshop-service">
	<ul class="w1224 clearfix">
		<li>
			<i class="ico ico-day7"></i>
			<p class="service">7天无理由退货</p>
		</li>
		<li>
			<i class="ico ico-day15"></i>
			<p class="service">15天免费换货</p>
		</li>
		<li>
			<i class="ico ico-quality"></i>
			<p class="service">正品行货 品质保障</p>
		</li>
		<li>
			<i class="ico ico-service"></i>
			<p class="service">专业售后服务</p>
		</li>
	</ul>
</div>
<div class="footer">
	<div class="w1224 clearfix" style="padding-bottom: 10px;">
		<div class="left-help-list clearfix">
			<div class="clearfix">
				<?php
                                   
                                $md5_key = md5("select * from `__PREFIX__article_cat` where cat_id < 6");
                                $result_name = $sql_result_v = S("sql_".$md5_key);
                                if(empty($sql_result_v))
                                {                            
                                    $result_name = $sql_result_v = \think\Db::query("select * from `__PREFIX__article_cat` where cat_id < 6"); 
                                    S("sql_".$md5_key,$sql_result_v,86400);
                                }    
                              foreach($sql_result_v as $k=>$v): ?>
					<dl>
						<dt><?php echo $v[cat_name]; ?></dt>
						<?php
                                   
                                $md5_key = md5("select * from `__PREFIX__article` where cat_id = $v[cat_id]  and is_open=1 limit 5");
                                $result_name = $sql_result_v2 = S("sql_".$md5_key);
                                if(empty($sql_result_v2))
                                {                            
                                    $result_name = $sql_result_v2 = \think\Db::query("select * from `__PREFIX__article` where cat_id = $v[cat_id]  and is_open=1 limit 5"); 
                                    S("sql_".$md5_key,$sql_result_v2,86400);
                                }    
                              foreach($sql_result_v2 as $k2=>$v2): ?>
						<dd><a href="<?php echo U('Home/Article/detail',array('article_id'=>$v2[article_id])); ?>"><?php echo $v2[title]; ?></a></dd>
						<?php endforeach; ?>
					</dl>
				<?php endforeach; ?>
			</div>
			<div class="friendship-links">
	            <span>友情链接 : </span>
                <?php
                                   
                                $md5_key = md5("select * from `__PREFIX__friend_link` where is_show=1");
                                $result_name = $sql_result_v = S("sql_".$md5_key);
                                if(empty($sql_result_v))
                                {                            
                                    $result_name = $sql_result_v = \think\Db::query("select * from `__PREFIX__friend_link` where is_show=1"); 
                                    S("sql_".$md5_key,$sql_result_v,86400);
                                }    
                              foreach($sql_result_v as $k=>$v): ?>
                    <a href="<?php echo $v[link_url]; ?>" <?php if($v['target'] == 1): ?>target="_blank"<?php endif; ?> ><?php echo $v[link_name]; ?></a>
                <?php endforeach; ?>
	        </div>	
		</div>
		<div class="right-contact-us">
			<h3 class="title">联系我们</h3>
			<span class="phone"><?php echo $tpshop_config['shop_info_phone']; ?></span>
			<p class="tips">周一至周日8:00-18:00<br />(仅收市话费)</p>
			<div class="qr-code-list clearfix">
				<a class="qr-code" href="javascript:;"><img class="w-100" src="__STATIC__/images/qrcode.png" alt="" /></a>
				<a class="qr-code qr-code-tpshop" href="javascript:;"><img class="w-100" src="__STATIC__/images/qrcode.png" alt="" /></a>
			</div>
		</div>
	</div>
    <div class="mod_copyright p">
        <div class="grid-top">
            <a href="javascript:void (0);">关于我们</a><span>|</span>
            <a href="javascript:void (0);">联系我们</a><span>|</span>
            <?php
                                   
                                $md5_key = md5("select * from `__PREFIX__article` where cat_id = 5 and is_open=1");
                                $result_name = $sql_result_v = S("sql_".$md5_key);
                                if(empty($sql_result_v))
                                {                            
                                    $result_name = $sql_result_v = \think\Db::query("select * from `__PREFIX__article` where cat_id = 5 and is_open=1"); 
                                    S("sql_".$md5_key,$sql_result_v,86400);
                                }    
                              foreach($sql_result_v as $k=>$v): ?>
                <a href="<?php echo U('Home/Article/detail',array('article_id'=>$v[article_id])); ?>"><?php echo $v[title]; ?></a>
                <span>|</span>
            <?php endforeach; ?>
        </div>
        <p>Copyright © 2016-2025 hxb  备案号:<?php echo $tpshop_config['shop_info_record_no']; ?></p>
        <p class="mod_copyright_auth">
            <a class="mod_copyright_auth_ico mod_copyright_auth_ico_1" href="" target="_blank">经营性网站备案中心</a>
            <a class="mod_copyright_auth_ico mod_copyright_auth_ico_2" href="" target="_blank">可信网站信用评估</a>
            <a class="mod_copyright_auth_ico mod_copyright_auth_ico_3" href="" target="_blank">网络警察提醒你</a>
            <a class="mod_copyright_auth_ico mod_copyright_auth_ico_4" href="" target="_blank">诚信网站</a>
            <a class="mod_copyright_auth_ico mod_copyright_auth_ico_5" href="" target="_blank">中国互联网举报中心</a>
        </p>
    </div>
</div>
<style>
    .mod_copyright {
        border-top: 1px solid #EEEEEE;
    }
    .grid-top {
        margin-top: 20px;
        text-align: center;
    }
    a {
        text-decoration: none;
        color: #666;
    }
    a {
        background: transparent;
    }
    .grid-top span {
        margin: 0 10px;
        color: #ccc;
    }
    .mod_copyright > p {
        margin-top: 10px;
        color: #666;
        text-align: center;
    }
    .mod_copyright_auth_ico {
        overflow: hidden;
        display: inline-block;
        margin: 0 3px;
        width: 103px;
        height: 32px;
        background-image: url(__STATIC__/images/ico_footer.png);
        line-height: 1000px;
    }
    .mod_copyright_auth_ico_1 {
        background-position: 0 -151px;
    }
    .mod_copyright_auth_ico_2 {
        background-position: -104px -151px;
    }
    .mod_copyright_auth_ico_3 {
        background-position: 0 -184px;
    }
    .mod_copyright_auth_ico_4 {
        background-position: -104px -184px;
    }
    .mod_copyright_auth_ico_5 {
        background-position: 0 -217px;
    }
</style>


<!--楼层导航-s-->
<ul class="floor-nav" id="floor-nav">
<?php if(is_array($cateList) || $cateList instanceof \think\Collection || $cateList instanceof \think\Paginator): if( count($cateList)==0 ) : echo "" ;else: foreach($cateList as $k=>$v): ?>
	<li>
		<span><?php echo $k+1; ?>F</span>
		<span><?php echo $v['mobile_name']; ?></span>
	</li>
<?php endforeach; endif; else: echo "" ;endif; ?>
</ul>

<!--楼层导航-e-->
<!--侧边栏-s-->
<div class="slidebar-right">
	<a class="slidebar-item ico-slidebar1" target="_blank" href="tencent://message/?uin=<?php echo $tpshop_config['shop_info_qq2']; ?>&amp;Site=TPshop商城&amp;Menu=yes" >
		<div class="sbar-hover-txt">客服服务</div>
	</a>
	<a class="slidebar-item ico-slidebar2" target="_blank" href="javascript:;" >
		<div class="sbar-hover-txt">关注微信</div>
		<div class="sbar-hover-pic">
			<div class="qrcode-wrap"><img class="w-100" src="__STATIC__/images/qrcode.png" alt="" /></div>
			<p class="qrcode-des">扫码关注官方微信,先人一步知晓促销活动</p>
		</div>
	</a>
	<a class="slidebar-item ico-slidebar3" target="_blank" href="javascript:;" >
		<div class="sbar-hover-txt">手机商城</div>
		<div class="sbar-hover-pic">
			<div class="qrcode-wrap"><img class="w-100" src="__STATIC__/images/qrcode.png" alt="" /></div>
			<p class="qrcode-des">扫码下载手机商城,随时随地享受优惠购物</p>
		</div>
	</a>
	<a class="slidebar-item ico-slidebar4 t-all" target="_blank" href="javascript:;" >
		<div class="sbar-hover-txt">回到顶部</div>
	</a>
</div>
<script>
function init(){  //初始化函数
    //首页商品分类显示
    $('.categorys .dd').show();

    //自动楼层居中设置
    $('#floor-nav').css('margin-top',(-41*$('#floor-nav').find('li').length+1)/2);

    //推荐列表自动滚动
    carouselList('.floor-recommend-wrap','.floor-recommend-list','.floor-recommend-item');

    //右侧边栏
    rightBar();

    //楼层导航切换
    sidebarRollChange();
}

function rightBar(){  //右侧边栏
    var $_slidebar4 = $('.ico-slidebar4');
    $(window).scroll(function(){
        if($(window).scrollTop()>100){
            $_slidebar4.css('height',40);
        }else{
            $_slidebar4.css('height',0);
        }
    })
    $_slidebar4.click(function () {
        $('html,body').animate({'scrollTop':0},500)
    });
}
function carouselList(wrap,list,item,timeWait,timeRun){ //推荐列表滚动
    /*
     * wrap：包裹容器
     * list：列表容器
     *item：列表单元
     *timeWait：停顿时间(单位ms,可不传参数，默认3秒)
     *timeRun：运动时间(单位ms,可不传参数，默认0.5秒)
     * */
    if(timeWait===undefined||typeof timeWait!="number"){
        timeWait=3000;
    }
    if(timeRun===undefined||typeof timeRun!="number"){
        timeRun=500;
    }
    $(wrap).each(function(){
        var length=$(this).find(item).length;
        if(length<3){
            return;
        }
        var html=$(this).find(list).html();
        $(this).find(list).html(html+html);
        var num=1;
        var _this=this;
        function interval(){
            clearInterval($(_this)[0].timer);
            $(_this)[0].timer=setInterval(function(){
                num++;
                if(num==length){
                    $(_this).find(list).animate({top:-108*num},timeRun,function (){
                        $(_this).find(list).css('top',0);
                    });
                    num=0;
                }else{
                    $(_this).find(list).animate({top:-108*num},timeRun);
                }
            },timeWait);
        }
        interval();
        $(this).find(item).hover(function (){
            clearInterval($(_this)[0].timer);
        },function (){
            interval();
        })
    });
}
function sidebarRollChange() {  //楼层切换
    var $_floorList=$('.floor');
    var $_sidebar=$('#floor-nav');
    $_sidebar.find('li').click(function(){ //点击切换楼层
        $('html,body').animate({'scrollTop':$_floorList.eq($(this).index()).offset().top},500)
    });
    $(window).scroll(function(){
        var scrollTop=$(window).scrollTop();
        if(scrollTop<$_floorList.eq(0).offset().top-$(window).height()/2){
            $_sidebar.hide();
            return;
        }
        $_sidebar.show();  //左边侧边栏显示
        for(var j=0,k=$_floorList.length;j<k;j++){ /*滚动改变侧边栏的状态*/
            if(scrollTop>$_floorList.eq(j).offset().top-$(window).height()/2){
                $_sidebar.find('li').eq(j).addClass('floor-nav-ac').siblings().removeClass('floor-nav-ac');
            }
        }
    })
}

init();
</script>
<script src="__STATIC__/js/common.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>
