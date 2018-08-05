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
 * Author: Dyr
 * Date: 2017-05-11
 */
namespace app\common\logic;
/**
 * 商品活动工厂类
 * Class CatsLogic
 * @package admin\Logic
 */
class GoodsPromFactory
{
    /**
     * @param $goods|商品实例
     * @param $spec_goods_price|规格实例
     * @return FlashSaleLogic|GroupBuyLogic|PromGoodsLogic
     */
    public function makeModule($goods, $spec_goods_price)
    {
        switch ($goods['prom_type']) {
            case 1:
                return new FlashSaleLogic($goods, $spec_goods_price);
            case 2:
                return new GroupBuyLogic($goods, $spec_goods_price);
            case 3:
                return new PromGoodsLogic($goods, $spec_goods_price);
            case 6:
                return new TeamActivityLogic($goods, $spec_goods_price);
        }
    }

    /**
     * 检测是否符合商品活动工厂类的使用
     * @param $promType |活动类型
     * @return bool
     */
    public function checkPromType($promType)
    {
        if (in_array($promType, array_values([1, 2, 3, 6]))) {
            return true;
        } else {
            return false;
        }
    }

}
