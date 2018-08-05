// 系统升级 js 文件
$(document).ready(function(){
	
	
	$("#a_upgrade").click(function(){
			
			var v = $("#textarea_upgrade").val();		
			
			//询问框
			layer.confirm(v, {
				area: ['580px','400px'],
				btn: ['升级','取消'] //按钮
				
			}, function(){
				layer.msg(
					'升级中...&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;请勿刷新页面', 
					{
					icon: 1,
					time: 3600000, //1小时后后自动关闭
					
					});
				//loading层
				var index = layer.load(3, {
					shade: [0.1,'#fff'] //0.1透明度的白色背景
				});				
				upgrade(); // 请求后台
				
			}, function(){	
				layer.msg('不升级可能有安全隐患', {
					time: 20000, //20s后自动关闭
					btn: ['明白了', '知道了']
				});
				return false;
			});		
					
	 
	
	});

});

function upgrade(){
	
		    $.ajax({
                type : "GET",
                url  : '/index.php?m=Admin&c=UpgradeLogic&a=OneKeyUpgrade',
				timeout : 360000, //超时时间设置，单位毫秒 设置了 1小时
                data : {},
                error: function(request) {
                        alert("服务器繁忙, 请联系管理员!");
						location.href = location.href;
                },
                success: function(v) {
					if(v=='1'){
						alert('升级成功!');
						location.href = location.href;
					}
					else{
							alert(v);						
							location.href = location.href;
						}
                }
            });   				
			
}
 
/*
$('#').click(funcion(){

});


 
*/