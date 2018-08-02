<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:48:"/var/www/html/app/admin/view/auth/adminList.html";i:1523640370;s:45:"/var/www/html/app/admin/view/common/head.html";i:1523640370;s:45:"/var/www/html/app/admin/view/common/foot.html";i:1523640370;}*/ ?>
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
        <legend><?php echo lang('admin'); ?><?php echo lang('list'); ?></legend>
    </fieldset>
    <blockquote class="layui-elem-quote">
        <a href="<?php echo url('adminAdd'); ?>" class="layui-btn layui-btn-sm"><?php echo lang('add'); ?><?php echo lang('admin'); ?></a>
    </blockquote>
    <table class="layui-table" id="list" lay-filter="list"></table>
</div>

<script type="text/javascript" src="/public/static/plugins/layui/layui.js"></script>


<script type="text/html" id="barDemo">
    <a href="<?php echo url('adminEdit'); ?>?admin_id={{d.admin_id}}" class="layui-btn layui-btn-xs"><?php echo lang('edit'); ?></a>
    {{# if(d.admin_id==1){ }}
    <a href="#" class="layui-btn layui-btn-xs layui-btn-disabled"><?php echo lang('del'); ?></a>
    {{# }else{  }}
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><?php echo lang('del'); ?></a>
    {{# } }}
</script>
<script type="text/html" id="open">
    {{# if(d.admin_id==1){ }}
        <input type="checkbox" disabled name="is_open" value="{{d.admin_id}}" lay-skin="switch" lay-text="开启|关闭" lay-filter="open" checked>
    {{# }else{  }}
        <input type="checkbox" name="is_open" value="{{d.admin_id}}" lay-skin="switch" lay-text="开启|关闭" lay-filter="open" {{ d.is_open == 1 ? 'checked' : '' }}>
    {{# } }}
</script>
<script>
    layui.use(['table','form'], function() {
        var table = layui.table,form = layui.form,$ = layui.jquery;
        var tableIn = table.render({
            elem: '#list',
            url: '<?php echo url("adminList"); ?>',
            method:'post',
            cols: [[
                {type: "checkbox", fixed: true},
                {field:'username', title: '用户名', width:80,fixed: true}
                ,{field:'email', title: '邮箱', width:200}
                ,{field:'title', title: '<?php echo lang("userGroup"); ?>', width:200}
                ,{field:'tel', title: '<?php echo lang("tel"); ?>', width:150}
                ,{field:'ip', title: '<?php echo lang("ip"); ?>',width:150}
                ,{field:'is_open', title: '<?php echo lang("status"); ?>',width:150,toolbar: '#open'}
                ,{width:160, align:'center', toolbar: '#barDemo'}
            ]]
        });
        form.on('switch(open)', function(obj){
            loading =layer.load(1, {shade: [0.1,'#fff']});
            var id = this.value;
            var is_open = obj.elem.checked===true?1:0;
            $.post('<?php echo url("adminState"); ?>',{'id':id,'is_open':is_open},function (res) {
                layer.close(loading);
                if (res.status==1) {
                    tableIn.reload();
                }else{
                    layer.msg(res.msg,{time:1000,icon:2});
                    return false;
                }
            })
        });
        table.on('tool(list)', function(obj){
            var data = obj.data;
            if(obj.event === 'del'){
                layer.confirm('<?php echo lang("Are you sure you want to delete it"); ?>', function(index){
                    $.post("<?php echo url('adminDel'); ?>",{admin_id:data.admin_id},function(res){
                        if(res.code==1){
                            layer.msg(res.msg,{time:1000,icon:1});
                            obj.del();
                        }else{
                            layer.msg(res.msg,{time:1000,icon:2});
                        }
                    });
                    layer.close(index);
                });
            }
        });

    });
</script>
</body>
</html>