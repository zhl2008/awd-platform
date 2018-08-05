/**
 *  该公共js文件需要放在public/global.js下面，因为需要getCookie方法
 */
$(function(){
	get_cart_num();
	user_login_or_no();
})
/****购物车 start****/
function get_cart_num() {
	var cart_cn = getCookie('cn');
	if (cart_cn == '') {
		$.ajax({
			type: "GET",
			url: "/index.php?m=Home&c=Cart&a=header_cart_list",//+tab,
			success: function (data) {
				cart_cn = getCookie('cn');
				$('#cart_quantity').html(cart_cn);
				$('#tab_cart_num').html(cart_cn);
			}
		});
	}
	$('#tab_cart_num').html(cart_cn);
	$('#cart_quantity').html(cart_cn);
	$('#miniCartRightQty').html(cart_cn);
}


var header_cart_list_over = 0;
$('#hd-my-cart').hover(function () {
	$('#show_minicart').show();
	if (header_cart_list_over == 1)
		return false;
	header_cart_list_over = 1;
	$.ajax({
		type: "GET",
		url: "/index.php?m=Home&c=Cart&a=header_cart_list",//+tab,
		success: function (data) {
			$("#hd-my-cart > #show_minicart").html(data);
			get_cart_num();
		}
	});
}, function () {
	$('#show_minicart').hide();
	(typeof(t) == "undefined") || clearTimeout(t);
	t = setTimeout(function () {
		header_cart_list_over = 0; /// 标识鼠标已经离开
	}, 2000);
});


// ajax 刷新购物车的商品
function header_cart_del(ids) {
	var id_arr = new Array();
	id_arr = ids.toString().split(","); //字符分割
	$.ajax({
		type: "POST",
		url: "/index.php?m=Home&c=Cart&a=delete",
		data: {cart_ids: id_arr},
		dataType: 'json',
		success: function (data) {
			if (data.status == 1) {
				header_cart_list_over = 0; /// 标识鼠标已经离开
				$("#hd-my-cart").trigger('mouseenter');	 // 无法触发 hover 改为 trigger('mouseenter');
                ajax_side_cart_list()  //解决侧边栏购物车点击删除后不能立即更新 lxl
			}
		}
	});
}
//侧边栏购物车
function ajax_side_cart_list() {
	$.ajax({
		type: "GET",
		url: "/index.php?m=Home&c=Cart&a=header_cart_list&template=ajax_side_cart_list",//+tab,
		success: function (data) {
			cart_cn = getCookie('cn');
			$('#cart_quantity').html(cart_cn);
			$('#tab_cart_num').html(cart_cn);
			$('.shop-car-sider').html(data);
		}
	});
}
/*******购物车 end********/

/*******用户登录变化class****/
function user_login_or_no()
{
	var uname = getCookie('uname');
	if (uname == '') {
		$('.islogin').remove();
		$('.nologin').show();
	} else {
		$('.nologin').remove();
		$('.islogin').show();
		$('.userinfo').html(decodeURIComponent(uname).substring(0,5));
	}
}

/*******ajax 图片懒加载****/
function lazy_ajax()
{
	$(".lazy").lazyload({
		placeholder : "images/white.gif",
		effect: "fadeIn",
		threshold: 20,
		vertical_only: false,
		no_fake_img_loader:true
	});
}
