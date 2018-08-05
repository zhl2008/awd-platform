<?php
/**
 * tpshop
 * ============================================================================
 * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: lhb
 * Date: 2017-05-15
 */

namespace app\common\logic;

use app\common\model\CouponList;
use app\common\model\Order;
use app\common\model\OrderGoods;
use app\common\model\TeamFollow;
use app\common\model\TeamFound;
use app\common\model\Users;
use think\Db;
use think\Model;

/**
 * 拼团订单逻辑类
 */
class TeamOrderLogic extends Model
{
    protected $team;// 拼团模型
    protected $order;//订单模型
    protected $goods;//商品模型
    protected $orderGoods;//订单商品模型.
    protected $specGoodsPrice;//商品规格模型
    protected $goodsBuyNum;//购买的商品数量
    protected $user_id = 0;//user_id
    protected $user;
    protected $teamFound;//开团模型

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 设置用户ID
     * @param $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
        $this->user = Users::get($user_id);
    }

    /**
     * 设置拼团模型
     * @param $team
     */
    public function setTeam($team)
    {
        $this->team = $team;
    }

    /**
     * 设置商品模型
     * @param $goods
     */
    public function setGoods($goods)
    {
        $this->goods = $goods;
    }

    /**
     * 设置商品规格模型
     * @param $specGoodsPrice
     */
    public function setSpecGoodsPrice($specGoodsPrice)
    {
        $this->specGoodsPrice = $specGoodsPrice;
    }

    /**
     * 设置订单模型
     * @param $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * 设置订单商品模型
     * @param $orderGoods
     */
    public function setOrderGoods($orderGoods)
    {
        $this->orderGoods = $orderGoods;
    }

    /**
     * 设置购买的商品数量
     * @param $goodsBuyNum
     */
    public function setGoodsBuyNum($goodsBuyNum)
    {
        $this->goodsBuyNum = $goodsBuyNum;
    }

    /**
     * 设置开团模型
     * @param $teamFound
     */
    public function setTeamFound($teamFound){
        $this->teamFound = $teamFound;
    }

    /**
     * 下单
     * @return array
     */
    public function add()
    {
        if (empty($this->team) || $this->team['status'] != 1) {
            return ['status' => 0, 'msg' => '该商品拼团活动不存在或者已下架', 'result' => ''];
        }
        if ($this->team['is_lottery'] == 1) {
            return ['status' => 0, 'msg' => '该商品拼团活动已开奖', 'result' => ''];
        }
        if (empty($this->goods) || $this->goods['is_on_sale'] != 1) {
            return ['status' => 0, 'msg' => '该商品拼团活动不存在或者已下架', 'result' => ''];
        }
        if ($this->team['item_id'] > 0 && empty($this->specGoodsPrice)) {
            return ['status' => 0, 'msg' => '该商品拼团活动不存在或者已下架', 'result' => ''];
        }
        if ($this->goodsBuyNum <= 0) {
            return ['status' => 0, 'msg' => '至少购买一份', 'result' => ''];
        }
        if ($this->team['buy_limit'] != 0 && $this->goodsBuyNum > $this->team['buy_limit']) {
            return ['status' => 0, 'msg' => '购买数已超过该活动单次购买限制数(' . $this->team['buy_limit'] . ')', 'result' => ''];
        }
        $OrderLogic = new OrderLogic();
        $orderData = [
            'user_id' => $this->user_id,
            'order_sn' => $OrderLogic->get_order_sn(),
            'goods_price' => $this->team['team_price'] * $this->goodsBuyNum,
            'order_prom_id' => $this->team['team_id'],
            'order_prom_type' => 6,
            'add_time' => time(),
            'order_amount' => $this->team['team_price'] * $this->goodsBuyNum,
            'total_amount' => $this->team['team_price'] * $this->goodsBuyNum,
        ];
        $order = new Order();
        $order->data($orderData);
        $orderSave = $order->save();
        if ($orderSave !== false) {
            $orderGoodsData = [
                'order_id' => $order['order_id'],
                'goods_id' => $this->goods['goods_id'],
                'goods_name' => $this->goods['goods_name'],
                'goods_sn' => $this->goods['goods_sn'],
                'goods_num' => $this->goodsBuyNum,
                'market_price' => $this->goods['market_price'],
                'member_goods_price' => $this->team['team_price'],
                'cost_price' => $this->goods['cost_price'],
                'give_integral' => $this->goods['give_integral'],
                'prom_type' => 6,//拼团
                'prom_id' => $this->team['team_id'],
            ];
            if ($this->specGoodsPrice) {
                $orderGoodsData['goods_price'] = $this->specGoodsPrice['price'];
                $orderGoodsData['spec_key'] = $this->specGoodsPrice['key'];
                $orderGoodsData['spec_key_name'] = $this->specGoodsPrice['key_name'];
                $orderGoodsData['sku'] = $this->specGoodsPrice['sku'];
            } else {
                $orderGoodsData['goods_price'] = $this->goods['shop_price'];
                $orderGoodsData['sku'] = $this->goods['sku'];
            }
            $orderGoods = new OrderGoods();
            $orderGoods->data($orderGoodsData);
            $orderGoodsSave = $orderGoods->save();
            // 减少对应商品的库存.注：拼团类型为抽奖团的，先不减库存
            if($this->team['team_type'] != 2){
                minus_stock($order);//下单减库存
            }
            if (session('?user')) {
                $user = session('user');
            }else{
                $user = Db::name('users')->field('nickname,head_pic')->where('user', $this->user_id)->find();
            }

            if($this->teamFound){
                /**团员拼团s**/
                $team_follow_data = [
                    'follow_user_id' => $user['user_id'],
                    'follow_user_nickname' => $user['nickname'],
                    'follow_user_head_pic' => $user['head_pic'],
                    'follow_time' => time(),
                    'order_id' => $order['order_id'],
                    'found_id' => $this->teamFound['found_id'],
                    'found_user_id' => $this->teamFound['user_id'],
                    'team_id' => $this->team['team_id'],
                ];
                Db::name('team_follow')->insert($team_follow_data);
                /***团员拼团e***/
            }else{
                /***团长开团s***/
                $team_found_data = [
                    'found_time'=>time(),
                    'found_end_time' => time() + intval($this->team['time_limit']),
                    'user_id' => $this->user_id,
                    'team_id' => $this->team['team_id'],
                    'nickname' => $user['nickname'],
                    'head_pic' => $user['head_pic'],
                    'order_id' => $order['order_id'],
                    'need' => $this->team['needer'],
                    'price'=> $this->team['team_price'],
                    'goods_price' => $orderGoods['goods_price'],
                ];
                Db::name('team_found')->insert($team_found_data);
                /***团长开团e***/
            }
            if ($orderGoodsSave !== false) {
                return ['status' => 1, 'msg' => '提交拼团订单成功', 'result' => ['order_id' => $order['order_id']]];
            } else {
                return ['status' => 0, 'msg' => '拼团商品下单失败', 'result' => ''];
            }
        } else {
            return ['status' => 0, 'msg' => '拼团商品下单失败', 'result' => ''];
        }
    }

    /**
     * 更改订单商品购买商品数
     * @param $goodsNum
     */
    public function changeNum($goodsNum)
    {
        if ($goodsNum != $this->orderGoods['goods_num']) {
            $this->orderGoods->goods_num = $goodsNum;
            $this->order->goods_price = $this->orderGoods->member_goods_price * $goodsNum;
            $this->order->order_amount = $this->getOrderAmount();
            $this->order->total_amount = $this->getTotalAmount();
        }
    }

    /**
     * 使用优惠券
     * @param $couponId
     */
    public function useCouponById($couponId)
    {
        //使用过优惠券的订单不计算新的优惠券价钱
        if ($couponId && $this->order->coupon_price <= 0) {
            $couponLogic = new CouponLogic();
            $couponMoney = $couponLogic->getCouponMoney($this->user_id, $couponId);
            $this->order->coupon_price = $couponMoney;
            $this->order->order_amount = $this->getOrderAmount();
        }
    }

    function deductCouponById($coupon_id){
        if(!empty($coupon_id)){
            $userCoupon = CouponList::get($coupon_id);
            if($userCoupon['uid'] != $this->user_id){
                return ['status' => 0, 'msg' => '这个优惠券不属于你！', 'result' => []];
            }
            $userCoupon->uid = $this->user_id;
            $userCoupon->order_id = $this->order['order_id'];
            $userCoupon->use_time = time();
            $userCoupon->status = 1;
            $userCoupon->save();
            $userCoupon->coupon->use_num = $userCoupon->coupon->use_num + 1;// 优惠券的使用数量加一
            $userCoupon->coupon->save();
        }
    }

    /**
     * 选择物流，配送地址
     * @param $shipping_code
     * @param $UserAddress
     */
    public function useShipping($shipping_code, $UserAddress)
    {
        $this->order->consignee = $UserAddress['consignee'];
        $this->order->country = $UserAddress['country'];
        $this->order->province = $UserAddress['province'];
        $this->order->city = $UserAddress['city'];
        $this->order->district = $UserAddress['district'];
        $this->order->twon = $UserAddress['twon'];
        $this->order->address = $UserAddress['address'];
        $this->order->zipcode = $UserAddress['zipcode'];
        $this->order->email = $UserAddress['email'];
        $this->order->mobile = $UserAddress['mobile'];
        if ($shipping_code) {
            $shipping = Db::name('Plugin')->where("code", $shipping_code)->cache(true, TPSHOP_CACHE_TIME)->find();
            if ($shipping) {
                // 如果商品没有设置包邮以及商家没有设置满额包邮 或者 额度达不到包邮 则计算物流费
                $goodsLogic = new GoodsLogic();
                $free_price = tpCache('shopping.freight_free');
                if ($this->goods['is_free_shipping'] == 0 && ($free_price == 0 || $this->order['goods_price'] < $free_price)) {
                    $shippingMoney = $goodsLogic->getFreight($shipping_code, $UserAddress['province'], $UserAddress['city'], $UserAddress['district'], $this->orderGoods['goods_num'] * $this->goods['weight']);
                    $this->order->shipping_code = $shipping['code'];
                    $this->order->shipping_name = $shipping['name'];
                    $this->order->shipping_price = $shippingMoney;
                    $this->order->order_amount = $this->getOrderAmount();
                    $this->order->total_amount = $this->getTotalAmount();
                }
            }
        }
    }

    /**
     * 使用余额
     * @param $user_money
     */
    public function useUserMoney($user_money)
    {
        if ($user_money) {
            $user_money = ($user_money > $this->order->order_amount) ? $this->order->order_amount : $user_money;
            $this->order->user_money = $this->order->user_money + $user_money;
            $this->order->order_amount = $this->getOrderAmount();
        }
    }

    /**
     * 使用积分
     * @param $pay_points
     */
    public function usePayPoints($pay_points)
    {
        //使用积分
        if ($pay_points) {
            $point_rate = tpCache('shopping.point_rate'); //兑换比例
            // 积分支付 100 积分等于 1块钱
            $integral_money = $pay_points / $point_rate;
            // 假设应付 1块钱 而用户输入了 200 积分 2块钱, 那么就让 $pay_points = 1块钱 等同于强制让用户输入1块钱
            $integral_money = ($integral_money > $this->order->order_amount) ? $this->order->order_amount : $integral_money;
            $this->order->integral = $this->order->integral + ($integral_money * $point_rate); //以防用户使用过多积分的情况
            $this->order->integral_money = $this->order->integral_money + $integral_money;
            $this->order->order_amount = $this->getOrderAmount();
        }
    }

    /**
     * 返回订单模型
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * 返回订单商品模型
     * @return mixed
     */
    public function getOrderGoods()
    {
        return $this->orderGoods;
    }

    /**
     * 拼团支付后操作
     * @param $order
     * @throws \think\Exception
     */
    public function doOrderPayAfter($order){
        $teamFound = TeamFound::get(['order_id' => $order['order_id']]);
        //团长的单
        if ($teamFound) {
            $teamFound->found_time = time();
            $teamFound->found_end_time = time() + intval($this->team['time_limit']);
            $teamFound->status = 1;
            $teamFound->save();
        }else{
            //团员的单
            $teamFollow = TeamFollow::get(['order_id' => $order['order_id']]);
            if($teamFollow){
                $teamFollow->status = 1;
                $teamFollow->save();
                //更新团长的单
                $teamFollow->team_found->join = $teamFollow['team_found']['join'] + 1;//参团人数+1
                //如果参团人数满足成团条件
                if($teamFollow->team_found->join >= $teamFollow->team_found->need){
                    $teamFollow->team_found->status = 2;//团长成团成功
                    //更新团员成团成功
                    Db::name('team_follow')->where(['found_id'=>$teamFollow->team_found->found_id,'status'=>1])->update(['status'=>2]);
                }
                $teamFollow->team_found->save();
            }

        }
    }

    /**
     * 过滤拼团订单能使用的优惠券列表
     * @param $userCouponList
     * @return array
     */
    public function getCouponOrderList($userCouponList)
    {
        $userCouponArray = collection($userCouponList)->toArray();
        $couponNewList = [];
        foreach ($userCouponArray as $couponKey => $couponItem) {
            if ($this->order->goods_price >= $userCouponArray[$couponKey]['coupon']['condition']) {
                $userCouponArray[$couponKey]['coupon']['able'] = 1;
            } else {
                $userCouponArray[$couponKey]['coupon']['able'] = 0;
            }
            $couponNewList[] = $userCouponArray[$couponKey];
        }
        return $couponNewList;
    }

    /**
     * 用户积分余额消费记录
     * @param $pay_points
     * @param $user_money
     */
    public function accountLog($pay_points,$user_money){
        if($pay_points || $user_money){
            $accountLog['user_id'] = $this->user_id;
            $accountLog['user_money'] = - $user_money;
            $accountLog['pay_points'] = - $pay_points;
            $accountLog['change_time'] = time();
            $accountLog['desc'] = '下单消费';
            $accountLog['order_sn'] = $this->order['order_sn'];
            $accountLog['order_id'] = $this->order['order_id'];
            Db::name('account_log')->insert($accountLog);
        }
    }

    /**
     * 给用户推送消息
     */
    public function pushUserMsg()
    {
        $oauth_users = M('OauthUsers')->where(['user_id'=>$this->user['user_id'] , 'oauth'=>'weixin' , 'oauth_child'=>'mp'])->find();
        if ($oauth_users) {
            $wx_user = Db::name('wx_user')->where('')->find();
            $jsSdk = new JssdkLogic($wx_user['appid'], $wx_user['appsecret']);
            $wx_content = '你刚刚下了一笔订单:' . $this->order['order_sn'] . '尽快支付,过期失效!';
            $jsSdk->push_msg($oauth_users['openid'], $wx_content);
        }
    }
    /**
     *  给商家推送消息
     */
    public function pushSellerMsg(){
        $res = checkEnableSendSms("3");
        $sender = tpCache("shop_info.mobile");
        if($res && $res['status'] ==1 && !empty($sender)){
            $params = array('consignee'=>$this->order['consignee'] , 'mobile' => $this->order['mobile']);
            sendSms("3", $sender, $params);
        }
    }
    /**
     * 计算订单价
     * @return mixed
     */
    private function getOrderAmount(){
        $order_amount = round((($this->order->goods_price + $this->order->shipping_price) - ($this->order->user_money + $this->order->coupon_price + $this->order->integral_money)),2);
        return $order_amount;
    }

    private function getTotalAmount(){
        $total_amount = round(($this->order->goods_price + $this->order->shipping_price),2);
        return $total_amount;
    }


}