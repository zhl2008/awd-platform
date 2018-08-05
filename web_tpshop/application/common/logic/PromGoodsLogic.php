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

namespace app\common\logic;

use app\common\model\PromGoods;
use app\common\model\Goods;
use app\common\model\SpecGoodsPrice;
use think\Model;
use think\db;

/**
 * 促销商品逻辑定义
 * Class CatsLogic
 * @package admin\Logic
 */
class PromGoodsLogic extends Prom
{
    protected $promGoods;//促销活动模型
    protected $goods;//商品模型
    protected $specGoodsPrice;//商品规格模型

    public function __construct($goods, $specGoodsPrice)
    {
        parent::__construct();
        $this->goods = $goods;
        $this->specGoodsPrice = $specGoodsPrice;
        //活动和规格是一对多的关系
        if($this->specGoodsPrice){
            //活动商品有规格，活动和规格是一对多
            $this->promGoods = PromGoods::get($specGoodsPrice['prom_id']);
        }else{
            //活动商品没有规格，活动和规格是一对多
            $this->promGoods = PromGoods::get($goods['prom_id']);
        }
        if ($this->promGoods) {
            //每次初始化都检测活动是否失效，如果失效就更新活动和商品恢复成普通商品
            if ($this->checkActivityIsEnd() && $this->promGoods['is_end'] == 0) {
                if($this->specGoodsPrice){
                    Db::name('spec_goods_price')->where('item_id', $this->specGoodsPrice['item_id'])->save(['prom_type' => 0, 'prom_id' => 0]);
                    Db::name('goods')->where("goods_id", $this->specGoodsPrice['goods_id'])->save(['prom_type' => 0, 'prom_id' => 0]);
                    unset($this->specGoodsPrice);
                    $this->specGoodsPrice = SpecGoodsPrice::get($specGoodsPrice['item_id']);
                }else{
                    Db::name('goods')->where("goods_id", $this->goods['goods_id'])->save(['prom_type' => 0, 'prom_id' => 0]);
                }
                $this->promGoods->is_end = 1;
                $this->promGoods->save();
                unset($this->goods);
                $this->goods = Goods::get($goods['goods_id']);
            }
        }
    }

    public function getPromModel(){
        return $this->promGoods;
    }

    /**
     * 计算促销价格。
     * @param $Price|原价或者规格价格
     * @return float
     */
    public function getPromotionPrice($Price){
        switch ($this->promGoods['type']) {
            case 0:
                $promotionPrice = $Price * $this->promGoods['expression'] / 100;//打折优惠
                break;
            case 1:
                $promotionPrice = $Price - $this->promGoods['expression'];//减价优惠
                break;
            case 2:
                $promotionPrice = $this->promGoods['expression'];//固定金额优惠
                break;
            default:
                $promotionPrice = $Price;//原价
                break;
        }
        $promotionPrice = ($promotionPrice >0 ? $promotionPrice : 0); //防止出现负数
        return $promotionPrice;
    }

    /**
     * 活动是否正在进行
     * @return bool
     */
    public function checkActivityIsAble(){
        if(empty($this->promGoods)){
            return false;
        }
        if(time() > $this->promGoods['start_time'] && time() < $this->promGoods['end_time'] && $this->promGoods['is_end'] == 0){
            return true;
        }
        return false;
    }
    /**
     * 活动是否结束
     * @return bool
     */
    public function checkActivityIsEnd(){
        if(empty($this->promGoods)){
            return true;
        }
        if(time() > $this->promGoods['end_time']){
            return true;
        }
        return false;
    }
    /**
     * 获取商品原始数据
     * @return Goods
     */
    public function getGoodsInfo()
    {
        return $this->goods;
    }
    /**
     * 获取商品转换活动商品的数据
     * @return static
     */
    public function getActivityGoodsInfo(){
        $activityGoods = $this->goods;
        $activityGoods['activity_title'] = $this->promGoods['title'];
        $activityGoods['market_price'] = $this->goods['market_price'];
        $activityGoods['start_time'] = $this->promGoods['start_time'];
        $activityGoods['end_time'] =  $this->promGoods['end_time'];
        //有规格
        if($this->specGoodsPrice){
            $activityGoods['shop_price'] = $this->getPromotionPrice($this->specGoodsPrice['price']);
            $activityGoods['store_count'] = $this->specGoodsPrice['store_count'];
            //如果价格有变化就将市场价等于商品规格价。
            if($activityGoods['shop_price'] != $this->specGoodsPrice['price']){
                $activityGoods['market_price'] = $this->specGoodsPrice['price'];
            }
            $activityGoods['store_count'] = $this->specGoodsPrice['store_count'];
        }else{
            $activityGoods['shop_price'] = $this->getPromotionPrice($this->goods['shop_price']);
            //如果价格有变化就将市场价等于商品规格价。
            if($activityGoods['shop_price'] != $this->goods['shop_price']){
                $activityGoods['market_price'] = $this->specGoodsPrice['price'];
            }
        }
        $activityGoods['prom_detail'] =  $this->promGoods['prom_detail'];
        return $activityGoods;
    }

    /**
     * 该活动是否已经失效
     */
    public function IsAble(){
        if(empty($this->promGoods)){
            return false;
        }
        if(time() > $this->promGoods['end_time']){
            return false;
        }
        if($this->promGoods['is_end'] == 1){
            return false;
        }
        return true;
    }
    /**
     * @param $buyGoods
     * @return array
     */
    public function buyNow($buyGoods){
        if(!$this->checkActivityIsEnd() && $this->checkActivityIsAble()){
            $buyGoods['member_goods_price'] = $this->getPromotionPrice($buyGoods['member_goods_price']);
        }
        $buyGoods['prom_type'] = 1;
        $buyGoods['prom_id'] = $this->promGoods['id'];
        return array('status' => 1, 'msg' => 'success', 'result' => ['buy_goods'=>$buyGoods]);
    }
}