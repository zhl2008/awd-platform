<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:48:"/var/www/html/app/admin/view/template/index.html";i:1523640370;s:45:"/var/www/html/app/admin/view/common/head.html";i:1523640370;s:45:"/var/www/html/app/admin/view/common/foot.html";i:1523640370;}*/ ?>
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
<div class="admin-main layui-anim layui-anim-upbit">
    <fieldset class="layui-elem-field layui-field-title">
        <legend>模版管理</legend>
    </fieldset>
    <div>
        <blockquote class="layui-elem-quote">
            <a href="<?php echo url('index'); ?>" class="layui-btn layui-btn-sm <?php if(input('type') == ''): ?>layui-btn-danger<?php endif; ?>">
                <i class="fa fa-file-code-o "></i> <?php echo strtoupper($viewSuffix); ?>
            </a>
            <a href="<?php echo url('index',array('type'=>'css')); ?>" class="layui-btn layui-btn-sm <?php if(input('type') == 'css'): ?>layui-btn-danger<?php endif; ?>">
                <i class="fa fa-css3"></i> CSS
            </a>
            <a href="<?php echo url('index',array('type'=>'js')); ?>" class="layui-btn layui-btn-sm <?php if(input('type') == 'js'): ?>layui-btn-danger<?php endif; ?>">
                <i class="fa fa-file-text-o"></i> JS
            </a>
            <a href="<?php echo url('images'); ?>" class="layui-btn layui-btn-sm">
            <i class="fa fa-file-image-o"></i> 媒体文件
            </a>
            <a href="<?php echo url('add'); ?>" style="float: right;" class="layui-btn layui-btn-sm layui-btn-normal">
                <i class="fa fa-plus"></i> <?php echo lang('add'); ?>模版
            </a>
        </blockquote>
        <div class="table-responsive">
            <table class="layui-table table-hover">
                <thead>
                <tr>
                    <th>文件名称</th>
                    <th>文件大小</th>
                    <th>修改时间</th>
                    <th>管理操作</th>
                </tr>
                </thead>
                <!--内容容器-->
                <tbody id="con">
                <?php if(is_array($templates) || $templates instanceof \think\Collection || $templates instanceof \think\Paginator): $i = 0; $__LIST__ = $templates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td><?php echo $v['filename']; ?></td>
                    <td><?php echo $v['filesize']; ?></td>
                    <td><?php echo date('Y-m-d h:i:s',$v['filemtime']); ?></td>
                    <td>
                        <a href="<?php echo url('edit',['file'=>$v['filename'],'type'=>input('param.type')]); ?>" class="layui-btn layui-btn-xs"><?php echo lang('edit'); ?></a>
                        <a href="javascript:;" onclick="return del('<?php echo $v['filename']; ?>')" class="layui-btn layui-btn-xs layui-btn-danger"><?php echo lang('del'); ?></a>
                    </td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<script type="text/javascript" src="/public/static/plugins/layui/layui.js"></script>


<script>
    layui.use('form',function() {
        var form = layui.form, $ = layui.jquery;
    });
    function del(file) {
        layer.confirm('你确定要删除吗？', {icon: 3}, function (index) {
            layer.close(index);
            window.location.href = "<?php echo url('delete'); ?>?file=" + file;
        });
    }
</script>