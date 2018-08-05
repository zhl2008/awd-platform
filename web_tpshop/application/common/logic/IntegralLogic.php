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
 * Author: dyr
 * Date: 2016-08-09
 */

namespace app\common\logic;

use app\common\model\Users;
use app\common\model\Order;
use app\common\model\SpecGoodsPrice;
use think\Model;
use think\Db;


/**
 * 积分商品
 * Class IntegralLogic
 * @package app\common\logic
 */
class IntegralLogic extends Model
{
    private $goods;
    private $specGoodsPrice;
    private $buyNum;
    private $user;
    private $address;
    private $shippingCode;
    private $userMoney;

    private $structure;//返回的订单数据

    public function setGoods($goods){
        $this->goods = $goods;
    }

    public function setSpecGoodsPrice($specGoodsPrice){
        $this->specGoodsPrice = $specGoodsPrice;
    }

    public function setBuyNum($buyNum){
        $this->buyNum = $buyNum;
    }

    public function setUser($user){
        $this->user = $user;
    }

    public function setAddress($address){
        $this->address = $address;
    }
    public function setShippingCode($shippingCode){
        $this->shippingCode = $shippingCode;
    }
    public function setUserMoney($userMoney){
        $this->userMoney = $userMoney;
    }

    public function buy()
    {
        if (empty($this->user)) {
            return ['status' => 0, 'msg' => '请登录'];
        }
        if (empty($this->goods)) {
            return ['status' => 0, 'msg' => '非法操作'];
        }
        if ($this->goods['is_on_sale'] != 1) {
            return ['status' => 0, 'msg' => '商品已下架'];
        }
        if ($this->goods['exchange_integral'] <= 0) {
            return ['status' => 0, 'msg' => '该商品不属于积分兑换商品'];
        }
        if ($this->goods['store_count'] == 0) {
            return ['status' => 0, 'msg' => '商品库存为零'];
        }
        if ($this->buyNum > $this->goods['store_count']) {
            return ['status' => 0, 'msg' => '商品库存不足，剩余' . $this->goods['store_count'] . '份'];
        }
        $total_integral = $this->goods['exchange_integral'] * $this->buyNum;
        $urlParam = ['goods_id' => $this->goods['goods_id'], 'goods_num' => $this->buyNum];
        if (empty($this->specGoodsPrice)) {
            $goods_spec_list = SpecGoodsPrice::all(['goods_id' => $this->goods['goods_id']]);
            if (count($goods_spec_list) > 0) {
                return ['status' => 0, 'msg' => '请传递规格参数', 'result' => ['url' => U('Goods/goodsInfo', ['id' => $this->goods['goods_id']])]];
            }
            //没有规格
        } else {
            //有规格
            $urlParam['item_id'] = $this->specGoodsPrice['item_id'];
            if ($this->buyNum > $this->specGoodsPrice['store_count']) {
                return ['status' => 0, 'msg' => '该商品规格库存不足，剩余' . $this->specGoodsPrice['store_count'] . '份'];
            }
        }
        $integral_use_enable = tpCache('shopping.integral_use_enable');
        //购买设置必须使用积分购买，而用户的积分不足以支付
        if ($total_integral > $this->user['pay_points'] && $integral_use_enable == 1) {
            return ['status' => 0, 'msg' => "你的账户可用积分为:" . $this->user['pay_points']];
        }
        return ['status' => 1, 'msg' => '购买成功', 'result' => ['url' => U('Cart/integral', $urlParam)]];//返回购买链接
    }

    public function order()
    {
        $buyCheck = $this->buy();
        $this->structure = [
            'shipping_price' => 0, // 物流费
            'user_money' => 0, // 使用用户余额
            'integral_money' => 0, // 总积分支付的金额
            'total_integral' => 0, // 总积分支付
            'simple_goods_price'=> 0,//单个商品价格
            'goods_price' => 0,// 总商品价格
            'order_amount'=>0,
            'goods_shipping'=>0
        ];
        if($buyCheck['status'] !== 1){
            $buyCheck['result'] = $this->structure;
            return $buyCheck;
        }

        if (empty($this->specGoodsPrice)) {
            //没有规格
            $this->structure['simple_goods_price'] = $this->goods['shop_price'];
        } else {
            //有规格
            $this->structure['simple_goods_price'] = $this->specGoodsPrice['price'];
        }
        $this->structure['goods_price'] = $this->structure['simple_goods_price'] * $this->buyNum;
        // 如果没有设置满额包邮 或者 额度达不到包邮 则计算物流费
        $free_price = tpCache('shopping.freight_free');
        if ($this->goods['is_free_shipping'] == 0 &&($free_price <= 0 || $this->structure['goods_price'] < $free_price)){
            $GoodsLogic = new GoodsLogic();
            $this->structure['shipping_price'] = $GoodsLogic->getFreight($this->shippingCode, $this->address['province'], $this->address['city'], $this->address['district'],$this->goods['weight'] * $this->buyNum);
        }

        if($this->userMoney > $this->user['user_money']){
            return ['status' => -6, 'msg' => "你的账户可用余额为:" . $this->user['user_money'], 'result' => ''];
        }
        $total_integral = $this->goods['exchange_integral'] * $this->buyNum;//需要兑换的总积分
        if($total_integral <= $this->user['pay_points']){
            $this->structure['total_integral'] = $this->goods['exchange_integral'] * $this->buyNum;//需要兑换的总积分
            $point_rate = tpCache('shopping.point_rate'); //兑换比例
            $this->structure['integral_money'] = $this->structure['total_integral'] / $point_rate;//总积分兑换成的金额
        }else{
            $this->structure['total_integral'] = 0;//需要兑换的总积分
            $this->structure['integral_money'] = 0;//总积分兑换成的金额
        }

        $exchange_integral_money = $this->structure['goods_price'] - $this->structure['integral_money'] + $this->structure['shipping_price'];//要需要支付的金额
        $user_money = ($this->userMoney > $exchange_integral_money) ? $exchange_integral_money : $this->userMoney;
        $this->structure['order_amount'] = $this->structure['goods_price'] + $this->structure['shipping_price'] - $this->structure['integral_money'] - $user_money;
        $this->structure['user_money'] = $user_money;
        $buyCheck['result'] = $this->structure;
        return $buyCheck;
    }

    public function addOrder($invoice_title,$user_note){
        $shipping = Db::name('plugin')->where("code",$this->shippingCode)->cache(true,TPSHOP_CACHE_TIME)->find();
        $OrderLogic = new OrderLogic();
        $order_sn = $OrderLogic->get_order_sn(); // 获取生成订单号
        $orderData = [
            'order_sn'         =>$order_sn, // 订单编号
            'user_id'          =>$this->user['user_id'], // 用户id
            'consignee'        =>$this->address['consignee'], // 收货人
            'province'         =>$this->address['province'],//'省份id',
            'city'             =>$this->address['city'],//'城市id',
            'district'         =>$this->address['district'],//'县',
            'twon'             =>$this->address['twon'],// '街道',
            'address'          =>$this->address['address'],//'详细地址',
            'mobile'           =>$this->address['mobile'],//'手机',
            'zipcode'          =>$this->address['zipcode'],//'邮编',
            'email'            =>$this->address['email'],//'邮箱',
            'shipping_code'    =>$shipping['code'],//'物流编号',
            'shipping_name'    =>$shipping['name'], //'物流名称',
            'invoice_title'    =>$invoice_title, //'发票抬头',
            'user_note'        =>$user_note, //'给卖家留言',
            'goods_price'      =>$this->structure['goods_price'],//积分商品价格',
            'shipping_price'   =>$this->structure['shipping_price'],//物流价格,
            'user_money'       =>$this->structure['user_money'], // 当前订单使用的余额数量
            'integral'         =>$this->structure['total_integral'], // 使用的积分数量
            'integral_money'   =>$this->structure['integral_money'],//使用积分抵多少钱,
            'total_amount'     =>$this->structure['goods_price'] + $this->structure['shipping_price'],// 订单总额 = 商品总价 + 物流费
            'order_amount'     =>$this->structure['order_amount'],//'应付款金额',
            'add_time'         =>time(), // 下单时间
        ];
        $order = new Order();
        $order->data($orderData);
        $order->save();

        // 记录订单操作日志
        $action_info = array(
            'order_id'        =>$order['order_id'],
            'action_user'     =>0,
            'action_note'     => '您提交了订单，请等待系统确认',
            'status_desc'     =>'提交订单',
            'log_time'        =>time(),
        );
        Db::name('order_action')->add($action_info);
        $orderGoodsData = [
            'order_id'  => $order['order_id'],
            'goods_id'  => $this->goods['goods_id'],// 商品id
            'goods_name'  => $this->goods['goods_name'],// 商品名称
            'goods_sn'  => $this->goods['goods_sn'],// 商品货号
            'goods_num'  => $this->buyNum,// 购买数量
            'market_price'  => $this->goods['market_price'],// 市场价
            'goods_price'  => $this->structure['simple_goods_price'],// 商品价
            'member_goods_price'  => $this->structure['simple_goods_price'],// 会员折扣价
            'cost_price'  => $this->goods['cost_price'],// 成本价
            'give_integral'  => $this->goods['give_integral'],// 购买商品赠送积分
        ];
        if(empty($this->specGoodsPrice)){
            $orderGoodsData['sku'] = $this->goods['sku'];// 商品条码
        }else{
            $orderGoodsData['spec_key'] = $this->specGoodsPrice['key'];// 商品规格
            $orderGoodsData['spec_key_name'] = $this->specGoodsPrice['key_name'];// 商品规格名称
            $orderGoodsData['sku'] = $this->specGoodsPrice['sku'];
        }
        Db::name("order_goods")->insert($orderGoodsData);
        if(tpCache('shopping.reduce') == 1) {
            minus_stock($order);//下单减库存
        }
        // 如果应付金额为0  可能是余额支付 + 积分 + 优惠券 这里订单支付状态直接变成已支付
        if ($this->structure['order_amount'] == 0) {
            update_pay_status($order_sn); // 这里刚刚下的订单必须从主库里面去查
        }

        // 3 扣除积分 扣除余额
        $user = Users::get($this->user['user_id']);
        if($this->structure['total_integral'] > 0){
            $user->pay_points = $user->pay_points - $this->structure['total_integral'];// 用户的积分减
        }

        if($this->structure['user_money'] > 0){
            $user->user_money = $user->user_money - $this->structure['user_money'];// 用户的余额减
        }

        if($this->structure['total_integral'] > 0 || $this->structure['user_money'] > 0){
            $user->save();
            $accountLogData = [
                'user_id'=>$user['user_id'],
                'user_money'=>-$this->structure['user_money'],
                'pay_points'=>-$this->structure['total_integral'],
                'change_time'=>time(),
                'desc'=>'下单消费',
                'order_sn'=>$order_sn,
                'order_id'=>$order['order_id'],
            ];
            Db::name("account_log")->add($accountLogData);
        }

        //分销开关全局
        $distribut_switch = tpCache('distribut.switch');
        if($distribut_switch  == 1 && file_exists(APP_PATH.'common/logic/DistributLogic.php'))
        {
            $distributLogic = new \app\common\logic\DistributLogic();
            $distributLogic->rebateLog($order); // 生成分成记录
        }
        // 如果有微信公众号 则推送一条消息到微信
        $oauth_users = M('OauthUsers')->where(['user_id'=>$this->user['user_id'] , 'oauth'=>'weixin' , 'oauth_child'=>'mp'])->find();
        if($oauth_users)
        {
            $wx_user = Db::name('wx_user')->find();
            $jsSdk = new JssdkLogic($wx_user['appid'],$wx_user['appsecret']);
            $wx_content = "你刚刚下了一笔订单:{$order['order_sn']} 尽快支付,过期失效!";
            $jsSdk->push_msg($oauth_users['openid'],$wx_content);
        }

        //用户下单, 发送短信给商家
        $res = checkEnableSendSms("3");
        $sender = tpCache("shop_info.mobile");
        if($res && $res['status'] ==1 && !empty($sender)){
            $params = array('consignee'=>$order['consignee'] , 'mobile' => $order['mobile']);
            sendSms("3", $sender, $params);
        }
        return array('status'=>1,'msg'=>'提交订单成功','result'=>$order['order_id']); // 返回新增的订单id
    }

}