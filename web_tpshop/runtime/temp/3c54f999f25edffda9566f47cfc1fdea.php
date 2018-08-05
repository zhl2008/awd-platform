<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:48:"./template/pc/rainbow/cart/header_cart_list.html";i:1509985968;}*/ ?>
<?php if(empty($cartList) || (($cartList instanceof \think\Collection || $cartList instanceof \think\Paginator ) && $cartList->isEmpty())): ?>
	<!--为空时-s-->
	<div class="empty-c">
		<span class="ma"><i class="c-i oh"></i>亲，购物车中没有商品哟~</span>
	</div>
	<!--为空时-e-->
<?php else: ?>
	<!--有商品时-s-->
	<div class="mn-c-m">
		<div class="mn-c-box">
		 	<?php if(is_array($cartList) || $cartList instanceof \think\Collection || $cartList instanceof \think\Paginator): $i = 0; $__LIST__ = $cartList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cart): $mod = ($i % 2 );++$i;?>
				<div class="c-store" >
					<div class="c-store-tt"><?php echo date("Y-m-d H:i:s",$cart['add_time']); ?></div>
					<!--<div class="c-sale-b">-->
						<!--<span class="i">[满减]</span>满299元减50元-->
					<!--</div>-->
					<div class="c-item clearfix">
						<div class="del js_delete" onclick="header_cart_del(<?php echo $cart[id]; ?>);">×</div>
						<a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$cart[goods_id])); ?>" class="goods-pic fl">
							<img src="<?php echo goods_thum_images($cart['goods_id'],50,50); ?>" alt="" title="<?php echo $cart[goods_name]; ?>">
						</a>
						<div class="goods-cont fl">
							<a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$cart[goods_id])); ?>" class="goods-name"><?php echo $cart[goods_name]; ?></a>
							<!--数额加减-->
							   <!--<p class="num fl js_mini_num">-->
								   <!--<a href="javascript:void(0);" class="reduce reduce_gray fl"></a>-->
								   <!--<input type="text" autocomplete="off" value="1">-->
								   <!--<a href="javascript:void(0);" class="add  fr"></a>-->
							   <!--</p>-->
							<p class="num fl">*<?php echo $cart[goods_num]; ?>件</p>
							<p class="red fr">￥<?php echo $cart[member_goods_price]; ?></p>
						</div>
					</div>
				</div>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		<div class="mn-c-total">
			<div class="c-t">
				<p class="t-n fl"><span class="red" id="total_qty"><?php echo $cartPriceInfo[goods_num]; ?></span>件</p>
				<p class="t-p red fr"><em>￥</em><span id="total_pay"><?php echo $cartPriceInfo[total_fee]; ?></span></p>
			</div>
			<a href="<?php echo U('Home/Cart/index'); ?>" class="c-btn">去购物车结算 &gt;&gt;</a>
		</div>
	</div>
	<!--有商品时-e-->
<?php endif; ?>
<script>
   $(".cart_quantity").text('<?php echo $cartPriceInfo[goods_num]; ?>'); // 购物车的总数量
</script>