/**
 @Name: 用户模块
 */
layui.define(['form','fly','element','upload'], function(exports){
  var $=layui.jquery,layer = layui.layer,laytpl = layui.laytpl,form = layui.form,fly = layui.fly,element = layui.element,upload= layui.upload;

  var gather = {}, dom = {
    mine: $('#LAY_mine')
    ,mineview: $('.mine-view')
    ,minemsg: $('#LAY_minemsg')
    ,infobtn: $('#LAY_btninfo')
  };

  //我的相关数据
  var elemUC = $('#LAY_uc'), elemUCM = $('#LAY_ucm');
  gather.minelog = {};
  gather.mine = function(index, type, url){
    var view = function(res){
      var html = laytpl(tpl[0]).render(res);
      dom.mine.children().eq(index).find('span').html(res.count);
      elemUCM.children().eq(index).find('ul').html(res.rows.length === 0 ? '<div class="fly-msg">没有相关数据</div>' : html);
    };
  };

  if(elemUC[0]){
    layui.each(dom.mine.children(), function(index, item){
      var othis = $(item)
      gather.mine(index, othis.data('type'), othis.data('url'));
    });
  }

  //Hash地址的定位
  var layid = location.hash.replace(/^#/, '');
  element.tabChange('user', layid);
  
  element.on('tab(user)', function(elem){
    location.hash = ''+ $(this).attr('lay-id');
  });


  //上传图片
  if($('.upload-img')[0]){
      var avatarAdd = $('.avatar-add');
      //缩略图上传
      upload.render({
          elem: '#avatar'
          ,url: '/user/upFiles/upload'
          ,accept: 'images' //普通文件
          ,exts: 'jpg|png|gif' //只允许上传压缩文件
          ,before: function(){
              avatarAdd.find('.loading').show();
          }
          ,done: function(res){
              if(res.code === 1){
                  $.post('/user/set/avatar/', {
                      avatar: res.url
                  }, function(res){
                      location.reload();
                  });
              } else {
                  layer.msg(res.msg, {icon: 5});
              }
              avatarAdd.find('.loading').hide();
          },
          error: function(){
              avatarAdd.find('.loading').hide();
          }
      });
  }

  //提交成功后刷新
  fly.form['set-mine'] = function(data, required){
    layer.msg('修改成功', {
      icon: 1
      ,time: 1000
      ,shade: 0.1
    }, function(){
      location.reload();
    });
  };

  //帐号绑定
  $('.acc-unbind').on('click', function(){
    var othis = $(this), type = othis.attr('type');
    layer.confirm('整的要解绑'+ ({
      qq_id: 'QQ'
      ,weibo_id: '微博'
    })[type] + '吗？', {icon: 5}, function(){
      fly.json('/user/set/unbind', {
        type: type
      }, function(res){
        if(res.status === 1){
          layer.alert('已成功解绑。', {
            icon: 1
            ,end: function(){
              location.reload();
            }
          });
        } else {
          layer.msg(res.msg);
        }
      });
    });
  });
  dom.minemsg[0] && gather.minemsg();

  exports('user', null);
  
});