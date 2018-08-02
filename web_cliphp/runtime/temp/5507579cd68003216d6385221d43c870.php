<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:56:"/var/www/html/app/admin/view/wechat/materialmessage.html";i:1523640370;s:45:"/var/www/html/app/admin/view/common/head.html";i:1523640370;s:45:"/var/www/html/app/admin/view/common/foot.html";i:1523640370;}*/ ?>
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
<style>
    .layui-table-cell{height: auto;}
    .layui-table-cell ul li a{color: #1C8FEF;display: block;border: 1px solid #ececec;padding: 3px 8px;}
    .layui-table-cell ul li a:hover{color: #005580}
</style>
<div class="admin-main layui-anim layui-anim-upbit">
    <fieldset class="layui-elem-field layui-field-title">
        <legend>消息素材</legend>
    </fieldset>
    <div class="demoTable">
        <?php if(is_array($child_menu_list) || $child_menu_list instanceof \think\Collection || $child_menu_list instanceof \think\Paginator): if( count($child_menu_list)==0 ) : echo "" ;else: foreach($child_menu_list as $k=>$child_menu): if($child_menu['active'] == '1'): ?>
        <a href="<?php echo $child_menu['url']; ?>" class="layui-btn layui-btn-danger layui-btn-sm"><?php echo $child_menu['menu_name']; ?></a>
        <?php else: ?>
        <a href="<?php echo $child_menu['url']; ?>" class="layui-btn  layui-btn-primary layui-btn-sm"><?php echo $child_menu['menu_name']; ?></a>
        <?php endif; endforeach; endif; else: echo "" ;endif; ?>
        <a href="<?php echo url('addMedia',['url'=>'materialmessage']); ?>" class="layui-btn layui-btn-sm" style="float:right;margin-right: 15px;"><?php echo lang('add'); ?></a>
    </div>
    <table class="layui-table" id="list" lay-filter="list"></table>
</div>
<script type="text/html" id="action">
    <a href="<?php echo url('updatemedia'); ?>?media_id={{d.media_id}}" class="layui-btn layui-btn-xs">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
<script type="text/html" id="title">
    <ul>
    {{# for(var l=0; l<d.item_list.length; l++){ }}
        <li><a href="#">{{d.item_list[l]}}</a></li>
    {{# } }}
    </ul>
</script>
<script type="text/html" id="type">
    {{# if(d.type=='1'){ }}
    文本
    {{# }else if(d.type=='2'){ }}
    单图文
    {{# }else{ }}
    多图文
    {{# } }}
</script>
<script type="text/javascript" src="/public/static/plugins/layui/layui.js"></script>


<script>
    layui.use('table', function() {
        var table = layui.table, $ = layui.jquery;
        var tableIn = table.render({
            id: 'user',
            elem: '#list',
            url: "<?php echo url('materialmessage'); ?>",
            method: 'post',
            where:{'type':"<?php echo input('type'); ?>"},
            page: true,
            even:true,
            cols: [[
                {field: 'type', title: '类型', width: 100,templet:'#type'},
                {field: 'title',title: '<?php echo lang("title"); ?>', width: 320,style:'height: auto;',templet:'#title'},
                {field: 'create_time', title: '创建时间', width: 180},
                {width: 160, align: 'center', toolbar: '#action'}
            ]],
            limit: 10 //每页默认显示的数量
        });
        table.on('tool(list)', function(obj) {
            var data = obj.data;
            if (obj.event === 'del') {
                layer.confirm('您确定要删除该信息吗？', function(index){
                    var loading = layer.load(1, {shade: [0.1, '#fff']});
                    $.post("<?php echo url('deleteWeixinMedia'); ?>",{media_id:data.media_id},function(res){
                        layer.close(loading);
                        if(res.code===1){
                            layer.msg(res.msg,{time:1000,icon:1});
                            tableIn.reload();
                        }else{
                            layer.msg('操作失败！',{time:1000,icon:2});
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