<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:44:"/var/www/html/app/user/view/login/index.html";i:1523640370;s:44:"/var/www/html/app/user/view/common/head.html";i:1523640370;s:46:"/var/www/html/app/user/view/common/footer.html";i:1523640370;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="keywords" content="<?php echo $title; ?>">
    <meta name="description" content="<?php echo $title; ?>">
    <link rel="stylesheet" href="/public/static/plugins/layui/css/layui.css">
    <link rel="stylesheet" href="/public/static/user/css/global.css">
</head>

<body>
<div class="header">
    <div class="main">
        <a class="logo" href="<?php echo url('index/index'); ?>" title="CLTPHP">CLTPHP</a>
        <div class="nav-user">
        </div>
    </div>
</div>
<div class="main layui-clear">
    <div class="fly-panel fly-panel-user" pad20>
        <div class="layui-tab layui-tab-brief">
            <ul class="layui-tab-title">
                <li class="layui-this">登入</li>
                <li><a href="<?php echo url('reg'); ?>">注册</a></li>
            </ul>
            <div class="layui-form layui-tab-content" id="LAY_ucm" style="padding: 20px 0;">
                <div class="layui-tab-item layui-show">
                    <div class="layui-form layui-form-pane">
                        <form method="post">
                            <div class="layui-form-item">
                                <label for="username" class="layui-form-label">帐　号</label>
                                <div class="layui-input-inline">
                                    <input type="text" id="username" name="username" required lay-verify="required" placeholder="请输入邮箱或者手机号" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label for="L_pass" class="layui-form-label">密　码</label>
                                <div class="layui-input-inline">
                                    <input type="password" id="L_pass" name="password" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label for="L_vercode" class="layui-form-label">验证码</label>
                                <div class="layui-input-inline">
                                    <input type="text" id="L_vercode" name="vercode" required lay-verify="required" placeholder="请输入验证码" autocomplete="off" class="layui-input">
                                </div>
                                <div class="layui-form-mid captcha">
                                    <img src="<?php echo captcha_src(); ?>" alt="captcha" onclick="this.src=this.src+'?'+'id='+Math.random()"/>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <button type="button" class="layui-btn" lay-filter="sub" lay-submit>立即登录</button>
                                <span style="padding-left:20px;"><a href="<?php echo url('forget'); ?>">忘记密码？</a></span>
                            </div>
                            <div class="layui-form-item fly-form-app">
                                <span>或者使用社交账号登入</span>

                                <?php if(is_array($plugin) || $plugin instanceof \think\Collection || $plugin instanceof \think\Paginator): $i = 0; $__LIST__ = $plugin;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;if($v['code'] == 'qq' AND is_qq() != 1): ?>
                                <a href="<?php echo url('loginApi/login',array('oauth'=>'qq')); ?>" id="qqLogin" class="iconfont icon-qq" title="QQ登入"></a>
                                <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="footer">
    <p><a href="http://www.cltphp.com/">CLTPHP</a> 2017 &copy; <a href="http://www.cltphp.com/">cltphp.com</a></p>
    <p>
        <a href="<?php echo url('home/services/index',array('catId'=>34)); ?>" target="_blank">产品服务</a>
        <a href="<?php echo url('home/system/index',array('catId'=>33)); ?>" target="_blank">系统操作</a>
        <a href="<?php echo url('home/news/index',array('catId'=>49)); ?>" target="_blank">CLTPHP动态</a>
    </p>
</div>
<script src="/public/static/plugins/layui/layui.js"></script>



<script>
    layui.use(['form', 'layer'], function () {
        var form = layui.form,$ = layui.jquery;
        // 登录提交监听
        form.on('submit(sub)', function (data) {
            var loading = layer.load(1, {shade: [0.1, '#fff']});
            $.post("<?php echo url('index'); ?>",data.field,function(res){
                layer.close(loading);
                if(res.code > 0){
                    layer.msg(res.msg,{time:1000,icon:1},function(){
                        location.href = "<?php echo url('index/index'); ?>";
                    });
                }else{
                    layer.msg(res.msg,{time:1000,icon:2});
                }
            });
        })
    })
</script>
</body>
</html>
