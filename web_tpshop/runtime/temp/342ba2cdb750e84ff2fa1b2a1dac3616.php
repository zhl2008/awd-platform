<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:46:"./template/pc/rainbow/index/ajax_favorite.html";i:1509985968;}*/ ?>
<?php if(is_array($favourite_goods) || $favourite_goods instanceof \think\Collection || $favourite_goods instanceof \think\Paginator): $i = 0; $__LIST__ = $favourite_goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
    <li>
        <div class="pad">
            <a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$v[goods_id])); ?>">
                <img class="lazy" data-original="<?php echo goods_thum_images($v['goods_id'],238,200); ?>" style="display: inline;" />
            </a>
            <div class="shop_name2">
                <a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$v[goods_id])); ?>">
                    <?php echo $v['goods_name']; ?>
                </a>
            </div>
            <div class="price-tag">
                <span class="now"><em class="li_xfo">￥</em><em><?php echo $v['shop_price']; ?></em></span>
                <span class="old"><em>￥</em><em><?php echo $v['market_price']; ?></em></span>
            </div>
        </div>
    </li>
<?php endforeach; endif; else: echo "" ;endif; ?>