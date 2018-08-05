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
use think\Model;
class GoodsActivityLogic extends Model {
    /**
     * 预售状态读取器
     * @param $goods_activity_item
     * @return string
     */
    public function getPreStatusAttr($goods_activity_item){
        switch ($goods_activity_item['is_finished'])
        {
            case 0:
                if($goods_activity_item['start_time'] > time()){
                    $goods_activity_status = '未开始';
                }else if($goods_activity_item['start_time'] <= time() && $goods_activity_item['end_time'] > time() && ($goods_activity_item['act_count'] < $goods_activity_item['restrict_amount'])){
                    $goods_activity_status = '预售中';
                }else{
                    $goods_activity_status = '结束未处理';
                }
                break;
            case 1:
                $goods_activity_status = '成功结束';
                break;
            case 2:
                $goods_activity_status = '失败结束';
                break;
            default:
                $goods_activity_status = '';
        }
        return $goods_activity_status;
    }

    /**
     * 预售商品的订购数量和订单数量
     * @param $goods_activity_id
     * @param null $goods_id
     * @return array
     */
    public function getPreCountInfo($goods_activity_id,$goods_id=null)
    {
        if(empty($goods_id)){
            $goods_id = M('goods_activity')->where(array('act_id'=>$goods_activity_id))->getField('goods_ids');
        }
        $condition = array(
            'o.order_prom_type' => 4,
            'o.order_prom_id' => $goods_activity_id,
            'g.goods_id' => $goods_id,
            'o.order_status' => 0,
            'pay_status' => array(array('eq', 1), array('eq', 2), 'or')
        );
        $info = M('order_goods')
            ->alias('g')
            ->field('count(*) as total_order,sum(g.goods_num) as total_goods')
            ->join('__ORDER__ o', 'o.order_id = g.order_id')
            ->where($condition)
            ->select();
        if(empty($info) || $info[0]['total_order'] == 0){
            $res = array('total_order'=>0,'total_goods'=>0);
        }else{
            $res = $info[0];
        }
        return $res;
    }

    /**
     * 获取预售商品的价格包含定金
     * @param $total_goods
     * @param $price_ladder
     * @return mixed
     */
    public function getPrePrice($total_goods,$price_ladder)
    {
        $price_ladder = array_values(array_sort($price_ladder,'amount','asc'));
        $price_ladder_count = count($price_ladder);
        if($price_ladder_count == 1){
            return $price_ladder[0]['price'];
        }
        for ($i = 0; $i < $price_ladder_count; $i++) {
            if($i == 0 && $price_ladder[$i]['amount'] >= $total_goods){
                return $price_ladder[$i]['price'];
            }
            if($i == ($price_ladder_count - 1)){
                return $price_ladder[$i]['price'];
            }
            if($total_goods >= $price_ladder[$i]['amount'] && $total_goods < $price_ladder[$i+1]['amount']){
                return $price_ladder[$i]['price'];
            }
        }
    }

    /**
     * 获取预售商品的数量ing
     * @param $total_goods
     * @param $price_ladder
     * @return mixed
     */
    public function getPreAmount($total_goods,$price_ladder)
    {
        $price_ladder = array_values(array_sort($price_ladder,'amount','asc'));
        $price_ladder_count = count($price_ladder);
        if($price_ladder_count == 1){
            return $price_ladder[0]['amount'];
        }
        for ($i = 0; $i < $price_ladder_count; $i++) {
            if($i == 0 && $price_ladder[$i]['amount'] >= $total_goods){
                return $price_ladder[$i]['amount'];
            }
            if($i == ($price_ladder_count - 1)){
                return $price_ladder[$i]['amount'];
            }
            if($total_goods >= $price_ladder[$i]['amount'] && $total_goods < $price_ladder[$i+1]['amount']){
                return $price_ladder[$i]['amount'];
            }
        }
    }

    public function getPerByGoodsId($goods_id,$act_type=1)
    {
        $res = M('goods_activity')->where(array('goods_id'=>$goods_id,'act_type'=>$act_type));
        return $res;
    }
}
