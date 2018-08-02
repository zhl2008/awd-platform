<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:36:"/app/app/admin/view/index/index.html";i:1523640370;s:36:"/app/app/admin/view/common/head.html";i:1523640370;s:36:"/app/app/admin/view/common/foot.html";i:1523640370;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo config('sys_name'); ?>后台管理</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/public/static/plugins/layui/css/layui.css" media="all" />
    <link rel="stylesheet" href="/public/static/admin/css/global.css" media="all">
    <link rel="stylesheet" href="/public/static/common/css/font.css" media="all">
</head>
<body class="skin-<?php if(!empty($_COOKIE['skin'])){echo $_COOKIE['skin'];}else{echo '0';setcookie('skin','0');}?>">
<script>
    var ADMIN = '/public/static/admin';
    var navs = <?php echo $menus; ?>;
</script>
<div class="layui-layout layui-layout-admin">
    <div class="layui-header header">
        <div class="layui-main">
            <div class="admin-login-box">
                <a class="logo" style="left: 0;" href="<?php echo url('admin/index/index'); ?>">
                    <span style="font-size: 22px;"><?php echo config('sys_name'); ?></span>
                </a>
                <div class="admin-side-toggle fs1">
                    <span class="icon icon-menu"></span>
                </div>
                <div class="admin-side-full">
                    <span class="icon icon-enlarge"></span>
                </div>
            </div>

            <ul class="layui-nav admin-header-item" lay-filter="side-top-right">
                <li class="layui-nav-item" id="cache">
                    <a href="javascript:;"><?php echo lang('clearCache'); ?></a>
                </li>
                <li class="layui-nav-item">
                    <a href="<?php echo url('home/index/index'); ?>" target="_blank"><?php echo lang('home'); ?></a>
                </li>
                <li class="layui-nav-item">
                    <a class="name" href="javascript:;">主题</a>
                    <dl class="layui-nav-child">
                        <dd data-skin="0"><a href="javascript:;">默认</a></dd>
                        <dd data-skin="1"><a href="javascript:;">纯白</a></dd>
                        <dd data-skin="2"><a href="javascript:;">蓝白</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;" class="admin-header-user">
                        <img src="/public<?php echo session('avatar'); ?>" class="layui-nav-img" />
                        <span><?php echo session('username'); ?></span>
                    </a>
                    <dl class="layui-nav-child">
                        <dd>
                            <a href="<?php echo url('index/logout'); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i><?php echo lang('logout'); ?></a>
                        </dd>
                    </dl>
                </li>
            </ul>
            <ul class="layui-nav admin-header-item-mobile">
                <li class="layui-nav-item">
                    <a href="<?php echo url('home/index/index'); ?>" target="_blank"><?php echo lang('home'); ?></a>
                </li>
                <li class="layui-nav-item">
                    <a href="<?php echo url('index/logout'); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> <?php echo lang('logout'); ?></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="layui-side layui-bg-black" id="admin-side">
        <div class="layui-side-scroll" id="admin-navbar-side" lay-filter="side"></div>
    </div>
    <div class="layui-body" style="bottom: 0;border-left: solid 2px #1AA094;" id="admin-body">
        <div class="layui-tab admin-nav-card layui-tab-brief" lay-filter="admin-tab">
            <ul class="layui-tab-title">
                <li class="layui-this">
                    <i class="icon icon-earth" aria-hidden="true"></i>
                    <cite>控制面板</cite>
                </li>
            </ul>
            <div class="layui-tab-content" style="min-height: 150px; padding: 5px 0 0 0;">
                <div class="layui-tab-item layui-show">
                    <iframe src="<?php echo url('main'); ?>"></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="layui-footer footer footer-demo" id="admin-footer">
        <div class="layui-main">
            <p>2017 &copy;
                <a href="http://www.cltphp.com/">www.cltphp.com</a> Apache Licence 2.0
            </p>
        </div>
    </div>
    <div class="site-tree-mobile layui-hide">
        <i class="layui-icon">&#xe602;</i>
    </div>
    <div class="site-mobile-shade"></div>
    <script type="text/javascript" src="/public/static/plugins/layui/layui.js"></script>


    <script src="/public/static/admin/js/index.js"></script>
    <script>
        layui.use('layer',function(){
            var $ = layui.jquery, layer = layui.layer;
            $('#cache').click(function () {
                document.cookie="skin=;expires="+new Date().toGMTString();
                layer.confirm('确认要清除缓存？', {icon: 3}, function () {
                    $.post('<?php echo url("clear"); ?>',function (data) {
                        layer.msg(data.info, {icon: 6}, function (index) {
                            layer.close(index);
                            window.location.href = data.url;
                        });
                    });
                });
            });
        })
    </script>
</div>
</body>
</html>