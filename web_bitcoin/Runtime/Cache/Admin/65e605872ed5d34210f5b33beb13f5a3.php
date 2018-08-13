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


<div id="main-content">
	<div id="top-alert" class="fixed alert alert-error" style="display: none;">
		<button class="close fixed" style="margin-top: 4px;">&times;</button>
		<div class="alert-content">警告内容</div>
	</div>
	<div id="main" class="main">
		<div class="main-title-h">
			<span class="h1-title">用户管理   </span>
										1=>苹果电脑  2=>华为手机  3=>1000元  4=>小米手环  5=>100元 6=>10元   7=>1元  8=>谢谢参与  9=>1元
										  10=>谢谢参与 						 
		</div>
		<div class="cf">
			<div class="fl">
				<select style="width: 160px; float: left; margin-right: 10px;" name="awardid" class="ids form-control">
					<option value="0"> 无奖品</option>
					<option value="1">苹果电脑</option>
					<option value="2">华为手机</option>
					<option value="3">1000元现金</option>
					<option value="4">小米手环</option>
					<option value="5">100元现金</option>
					<option value="6">10元现金</option>
					<option value="7">1元现金</option>
					<option value="9">1元现金</option>
				</select>
				<button class="ajax-post btn  btn-info " url="<?php echo U('User/status',array('type'=>'award'));?>" target-form="ids">设置奖项</button>
<a class="btn btn-success  " href="<?php echo U('User/edit');?>">新 增</a>


				<button class="ajax-post btn  btn-info " url="<?php echo U('User/status',array('type'=>'idauth'));?>" target-form="ids">通过认证</button>
				<button class="ajax-post btn  btn-warning  ajax-post" url="<?php echo U('User/status',array('type'=>'notidauth'));?>" target-form="ids">取消认证</button>

				<button class="ajax-post btn  btn-info " url="<?php echo U('User/status',array('type'=>'resume'));?>" target-form="ids">启 用</button>
				<button class="ajax-post btn  btn-warning  ajax-post" url="<?php echo U('User/status',array('type'=>'forbid'));?>" target-form="ids">禁 用</button>
				<button class="btn ajax-post confirm btn-danger " url="<?php echo U('User/status',array('type'=>'del'));?>" target-form="ids">删 除</button>
				
			</div>

			<div class="search-form fr cf">
				<div class="sleft">
					<form name="formSearch" id="formSearch" method="get" name="form1">
						<select style="width: 160px; float: left; margin-right: 10px;" name="status" class="form-control">
							<option value=""
							<?php if(empty($_GET['status'])): ?>selected<?php endif; ?>
							>全部状态</option>
							
							
							<option value="6"
							<?php if(($_GET['status']) == "6"): ?>selected<?php endif; ?>
							>等待认证</option>
							
							<option value="5"
							<?php if(($_GET['status']) == "5"): ?>selected<?php endif; ?>
							>通过认证</option>
							
							
							<option value="3"
							<?php if(($_GET['status']) == "3"): ?>selected<?php endif; ?>
							>已中奖</option>
							
							<option value="4"
							<?php if(($_GET['status']) == "4"): ?>selected<?php endif; ?>
							>未中奖</option>
							
							<option value="1"
							<?php if(($_GET['status']) == "1"): ?>selected<?php endif; ?>
							>冻结状态</option>
							<option value="2"
							<?php if(($_GET['status']) == "2"): ?>selected<?php endif; ?>
							>正常状态</option>
							
							

							
						</select>
						<select style=" width: 160px; float: left; margin-right: 10px;" name="field" class="form-control">
							<option value="awardid"
							<?php if(empty($_GET['field'])): ?>selected<?php endif; ?>
							>奖品ID</option>
							<option value="username"
							<?php if(($_GET['field']) == "username"): ?>selected<?php endif; ?>
							>用户名</option>
							<option value="moble"
							<?php if(($_GET['field']) == "moble"): ?>selected<?php endif; ?>
							>手机号码</option>
							<option value="truename"
							<?php if(($_GET['field']) == "truename"): ?>selected<?php endif; ?>
							>真实姓名</option>
							<option value="idcard"
							<?php if(($_GET['field']) == "idcard"): ?>selected<?php endif; ?>
							>身份证号</option>
						</select>
						<input type="text" name="name" class="search-input form-control  " value="<?php echo ($_GET['name']); ?>" placeholder="请输入查询内容" style="">
						<a class="sch-btn" href="javascript:;" id="search"> <i class="btn-search"></i> </a>
					</form>
					<script>
						//搜索功能
						$(function () {
							$('#search').click(function () {
								$('#formSearch').submit();
							});
						});
						//回车搜索
						$(".search-input").keyup(function (e) {
							if (e.keyCode === 13) {
								$("#search").click();
								return false;
							}
						});
					</script>
				</div>
			</div>
		</div>
		<div class="data-table table-striped">
			<table class="">
				<thead>
				<tr>
					<th class="row-selected row-selected">
						<input class="check-all" type="checkbox"/>
					</th>
					<th class="">ID</th>
					<th class="">手机号码</th>
					<th class="">身份证</th>
					<th class="">真实姓名</th>
					<th class="">实名认证</th>
					<th class="">1代推荐人</th>
					<th class="" style="display:none;">2代推荐人</th>
					<th class="" style="display:none;">3代推荐人</th>
					<th class="">指定奖品</th>
					<th class="">是否中奖</th>
					<th class="">注册时间</th>
					<th class="">状态</th>
					<th class="">操作</th>
				</tr>
				</thead>
				<tbody>
				<?php if(!empty($list)): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
							<td>
								<input class="ids" type="checkbox" name="id[]" value="<?php echo ($vo["id"]); ?>"/>
							</td>
							<td><?php echo ($vo["id"]); ?></td>
							<td><?php echo ($vo["moble"]); ?></td>
							<td>
								<?php if(($vo["idcardimg1"]) != ""): ?><font color='green'>已上传</font>
								<?php else: ?>
									<font color='red'>未上传</font><?php endif; ?>
							</td>
							<td><?php echo ($vo["truename"]); ?></td>
							<td>
							
								<?php if(($vo["idcardauth"]) == "0"): ?><font color='red'>未通过</font><?php endif; ?>
								<?php if(($vo["idcardauth"]) == "1"): ?>已通过<?php endif; ?>
							
							
							</td>
							<td>
								<a href="<?php echo U('User/index?name='.$vo['invit_1'].'&field=id');?>"><?php echo ($vo['invit_1']); ?></a>
							</td>
							<td style="display:none;">
								<a href="<?php echo U('User/index?name='.$vo['invit_2'].'&field=id');?>"><?php echo ($vo['invit_2']); ?></a>
							</td>
							<td style="display:none;">
								<a href="<?php echo U('User/index?name='.$vo['invit_3'].'&field=id');?>"><?php echo ($vo['invit_3']); ?></a>
							</td>
							<td>
								<?php echo ($vo["awardname"]); ?>
							</td>
							<td>
								<?php if(($vo["awardstatus"]) == "0"): ?>未中<?php endif; ?>
								<?php if(($vo["awardstatus"]) == "1"): ?><font color=red>已中</font><?php endif; ?>
							</td>
							<td><?php echo (addtime($vo["addtime"])); ?></td>
							<td>
								<?php if(($vo["status"]) == "0"): ?>冻结<?php endif; ?>
								<?php if(($vo["status"]) == "1"): ?>正常<?php endif; ?>
							</td>
							<td>
								<a href="<?php echo U('User/edit?id='.$vo['id']);?>" class="btn btn-primary btn-xs" >编辑</a>
							</td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
					<?php else: ?>
					<td colspan="12" class="text-center">Oh! 暂时还没有内容!</td><?php endif; ?>
				</tbody>
			</table>
			<div class="page">
				<div><?php echo ($page); ?></div>
			</div>
		</div>
	</div>
</div>






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
		highlight_subnav("<?php echo U('User/index');?>");
	</script>