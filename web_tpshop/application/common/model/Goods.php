<?php
/**
 * tpshop
 * ============================================================================
 * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * Author: IT宇宙人
 * Date: 2015-09-09
 */
namespace app\common\model;
use think\Model;
class Goods extends Model {
    public function FlashSale()
    {
        return $this->hasOne('FlashSale','id','prom_id');
    }

    public function PromGoods()
    {
        return $this->hasOne('PromGoods','id','prom_id')->cache(true,10);
    }
    public function GroupBuy()
    {
        return $this->hasOne('GroupBuy','id','prom_id');
    }
    public function getDiscountAttr($value, $data)
    {
        if ($data['market_price'] == 0) {
            $discount = 10;
        } else {
            $discount = round($data['shop_price'] / $data['market_price'], 2) * 10;
        }
        return $discount;
    }
}
