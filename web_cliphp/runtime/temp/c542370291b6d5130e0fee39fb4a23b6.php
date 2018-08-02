<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:49:"/var/www/html/app/admin/view/auth/adminGroup.html";i:1523640370;s:45:"/var/www/html/app/admin/view/common/head.html";i:1523640370;s:45:"/var/www/html/app/admin/view/common/foot.html";i:1523640370;}*/ ?>
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
        <legend>用户组列表</legend>
    </fieldset>
    <blockquote class="layui-elem-quote">
        <a href="<?php echo url('groupAdd'); ?>" class="layui-btn layui-btn-sm"><?php echo lang('add'); ?>用户组</a>
    </blockquote>
    <table class="layui-table" id="list" lay-filter="list"></table>
</div>
<script type="text/javascript" src="/public/static/plugins/layui/layui.js"></script>



<script type="text/html" id="action">
    <a href="<?php echo url('groupAccess'); ?>?id={{d.group_id}}" class="layui-btn layui-btn-xs layui-btn-normal">配置规则</a>
    <a href="<?php echo url('groupEdit'); ?>?id={{d.group_id}}" class="layui-btn layui-btn-warm layui-btn-xs"><?php echo lang('edit'); ?></a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><?php echo lang('del'); ?></a>
</script>
<script>

    layui.use('table', function() {
        var table = layui.table,$ = layui.jquery;
        table.render({
            elem: '#list',
            url: '<?php echo url("adminGroup"); ?>',
            method:'post',
            cols: [[
                {field:'group_id', title: '<?php echo lang("id"); ?>',width:80, fixed: true,sort: true},
                {field:'title', title: '用户组名', width:180},
                {field:'addtime', title: '添加时间', width:200,sort: true},
                {width:260, align:'center',toolbar:'#action'}
            ]]
        });
        table.on('tool(list)', function(obj){
            var data = obj.data;
            if(obj.event === 'del'){
                layer.confirm('你确定要删除该分组吗？', function(index){
                    loading =layer.load(1, {shade: [0.1,'#fff']});
                    $.post("<?php echo url('groupDel'); ?>",{id:data.group_id},function(res){
                        layer.close(loading);
                        layer.close(index);
                        if(res.code==1){
                            layer.msg(res.msg,{time:1000,icon:1});
                            obj.del();
                        }else{
                            layer.msg(res.msg,{time:1000,icon:2});
                        }
                    });
                });
            }
        });
    });
</script>
</body>
</html>