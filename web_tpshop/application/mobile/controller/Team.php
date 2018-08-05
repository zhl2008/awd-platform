<?php
/**
 * tpshop
 * ============================================================================
 * * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * $Author: IT宇宙人 2015-08-10 $
 */
namespace app\mobile\controller;

use app\common\logic\CouponLogic;
use app\common\logic\GoodsLogic;
use app\common\logic\TeamFoundLogic;
use app\common\logic\TeamOrderLogic;
use app\common\model\Goods;
use app\common\model\Order;
use app\common\model\OrderGoods;
use app\common\model\ShippingArea;
use app\common\model\TeamActivity;
use app\common\model\TeamFollow;
use app\common\model\TeamFound;
use app\common\model\UserAddress;
use think\Db;
use think\Page;


class Team extends MobileBase
{
    public $user_id = 0;
    public $user = array();
    /**
     * 构造函数
     */
    public function  __construct()
    {
        parent::__construct();
        if (session('?user')) {
            $user = session('user');
            $user = M('users')->where("user_id", $user['user_id'])->find();
            session('user', $user);  //覆盖session 中的 user
            $this->user = $user;
            $this->user_id = $user['user_id'];
            $this->assign('user', $user); //存储用户信息
        }
    }

    /**
     * 拼团首页
     * @return mixed
     */
    public function index()
    {
        $goods_category = Db::name('goods_category')->where(['level' => 1, 'is_show' => 1])->select();
        $this->assign('goods_category', $goods_category);
        return $this->fetch();
    }

    public function category()
    {
        $id = input('id/d');//一级分类ID
        $tid = input('tid/d');//二级分类ID
        $two_all_ids = input('tid/s');//二级分类全部id
        $goods_category_level_one = Db::name('goods_category')->where(['id' => $id])->find();
        $goods_category_level_two = Db::name('goods_category')->where(['parent_id' => $goods_category_level_one['id']])->select();//二级分类
        $goods_where = ['cat_id1' => $id];
        if($tid){
            $goods_where['cat_id2'] = $tid;
        }
        if($goods_category_level_two){
            $goods_category_level_two_arr = get_arr_column($goods_category_level_two,'id');
            $two_all_ids = implode(',',$goods_category_level_two_arr);
        }
        $this->assign('goods_category_level_one', $goods_category_level_one);
        $this->assign('goods_category_level_two', $goods_category_level_two);
        $this->assign('two_all_ids', $two_all_ids);
        return $this->fetch();
    }


    /**
     * 拼团首页列表
     */
    public function AjaxTeamList(){
        $p = Input('p',1);
        $id = input('id/d');//一级分类ID
        $tid = input('tid/d');//二级分类ID
        $two_all_ids = input('two_all_ids/s');//二级分类全部id
        $goods_where = [];
        if($id && $two_all_ids){
            $category_three_ids = Db::name('goods_category')->where(['parent_id' => ['in',$two_all_ids]])->getField('id',true);//三级分类id
            $goods_where['cat_id'] = ['in',$category_three_ids];
        }
        if($tid){
            $category_three_ids = Db::name('goods_category')->where(['parent_id' => $tid])->getField('id',true);//三级分类id
            $goods_where['cat_id'] = ['in',$category_three_ids];
        }
        $team_where = ['t.status' => 1, 't.is_lottery' => 0, 'g.is_on_sale' => 1];
        if(count($goods_where) > 0){
            $goods_ids = Db::name('goods')->where($goods_where)->getField('goods_id', true);
            if(!empty($goods_ids)){
                $team_where['t.goods_id'] = ['IN', $goods_ids];
            }else{
                $this->ajaxReturn(['status' => 1, 'msg' => '获取成功','result'=>'']);
            }
        }
        $TeamActivity = new TeamActivity();
        $list = $TeamActivity->alias('t')->join('__GOODS__ g', 'g.goods_id = t.goods_id')
            ->with('specGoodsPrice,goods')->where($team_where)->group('t.goods_id')->order('t.team_id desc')->page($p, 10)->select();
        $this->ajaxReturn(['status' => 1, 'msg' => '获取成功','result'=>$list]);
    }

    public function info(){
        $team_id = input('team_id');
        $goods_id = input('goods_id');
        if(empty($goods_id)){
            $this->error('参数错误', U('Mobile/Team/index'));
        }
        $TeamActivity = new TeamActivity();
        $Goods = new Goods();
        $goods = $Goods->where(['is_on_sale'=>1,'goods_id'=>$goods_id])->find();
        $teamList = $TeamActivity->where('goods_id', $goods_id)->select();
        if (empty($teamList)) {
            $this->error('该商品拼团活动不存在或者已被删除', U('Mobile/Team/index'));
        }
        if(empty($goods)){
            $this->error('此商品不存在或者已下架', U('Mobile/Team/index'));
        }
        foreach($teamList as $teamKey=>$teamVal){
            if($team_id && $teamVal['team_id'] == $team_id){
                $team = $teamVal;
                break;
            }
        }
        if(empty($team)){
            $team = $teamList[0];
        }
        $user_id = cookie('user_id');
        if($user_id){
            $collect = Db::name('goods_collect')->where(array("goods_id"=>$goods_id ,"user_id"=>$user_id))->count();
            $this->assign('collect',$collect);
        }
        $spec_goods_price = Db::name('spec_goods_price')->where("goods_id",$goods_id)->getField("key,price,store_count,item_id,prom_id"); // 规格 对应 价格 库存表
        if($spec_goods_price){
            foreach($spec_goods_price as $specKey=>$specVal){
                $spec_goods_price[$specKey]['team_id'] = 0;
                $spec_goods_price[$specKey]['key_array'] = explode('_', $spec_goods_price[$specKey]['key']);
                foreach($teamList as $teamKey=>$teamVal){
                    if($specVal['item_id'] == $teamVal['item_id'] && $specVal['prom_id'] == $teamVal['team_id'] && $teamVal['status'] == 1){
                        $spec_goods_price[$specKey]['team_id'] = $teamVal['team_id'];
                        continue;
                    }
                }
            }
        }
        $this->assign('spec_goods_price', json_encode($spec_goods_price,true));
        $goods_images_list = Db::name('goods_images')->where("goods_id" , $goods_id)->select(); // 商品图册
        $this->assign('goods_images_list',$goods_images_list);//商品缩略图
        $goodsLogic = new GoodsLogic();
        $commentStatistics = $goodsLogic->commentStatistics($goods_id);// 获取某个商品的评论统计
        $filter_spec = $goodsLogic->get_spec($goods_id);
        $this->assign('filter_spec', $filter_spec);//规格参数
        $this->assign('commentStatistics',$commentStatistics);//评论概览
        $this->assign('goods',$goods);
        $this->assign('team', $team);//商品拼团活动主体
        $this->assign('team_id', $team_id);//商品拼团活动主体
        return $this->fetch();
    }

    public function ajaxCheckTeam(){
        $team_id = input('team_id');
        $goods_id = input('goods_id');
        if(empty($goods_id) || empty($team_id) ){
            $this->ajaxReturn(['status'=>0,'msg'=>'参数错误']);
        }
        $TeamActivity = new TeamActivity();
        $team = $TeamActivity->append(['bd_url,front_status_desc,bd_pic,lottery_url'])->with('specGoodsPrice,goods')->where('team_id',$team_id)->find();
        if (empty($team)) {
            $this->ajaxReturn(['status'=>0,'msg'=>'该商品拼团活动不存在或者已被删除']);
        }
        if(empty($team['goods'])){
            $this->ajaxReturn(['status'=>0,'msg'=>'此商品不存在或者已下架']);
        }
        $teamInfo = $team->append(['bd_url','front_status_desc','bd_pic'])->toArray();
        $this->ajaxReturn(['status'=>1,'msg'=>'此商品拼团活动可以购买','result'=>['team'=>$teamInfo]]);

    }

    public function ajaxTeamFound()
    {
        $goods_id = input('goods_id');
        $TeamActivity = new TeamActivity();
        $TeamFound = new TeamFound();
        $team_ids = $TeamActivity->where(['goods_id'=>$goods_id,'status'=>1,'is_lottery'=>0])->getField('team_id',true);
        //活动正常，抽奖团未开奖才获取商品拼团活动拼单
        if (count($team_ids) > 0) {
            $teamFounds = $TeamFound->with('order,teamActivity')->where(['team_id' => ['IN',$team_ids], 'status' => 1])->order('found_id desc')->select();
            if($teamFounds) {
                $teamFounds = collection($teamFounds)->append(['surplus'])->toArray();
            }
            $this->ajaxReturn(['status' => 1, 'msg' => '获取成功', 'result' => ['teamFounds' => $teamFounds]]);
        } else {
            $this->ajaxReturn(['status' => 0, 'msg' => '没有相关记录', 'result' => []]);
        }
    }

    /**
     * 下单
     */
    public function addOrder()
    {
        C('TOKEN_ON', false);
        $team_id = input('team_id/d');
        $goods_num = input('goods_num/d');
        $found_id = input('found_id/d');//拼团id，有此ID表示是团员参团,没有表示团长开团
        if ($this->user_id == 0) {
            $this->ajaxReturn(['status' => -101, 'msg' => '购买拼团商品必须先登录', 'result' => '']);
        }
        if (empty($team_id)) {
            $this->ajaxReturn(['status' => 0, 'msg' => '参数错误', 'result' => '']);
        }
        if(empty($goods_num)){
            $this->ajaxReturn(['status' => 0, 'msg' => '至少购买一份', 'result' => '']);
        }
        $team = TeamActivity::get($team_id);
        if($found_id){
            $teamFound = TeamFound::get(['found_id' => $found_id, 'status' => 1]);
            if(empty($teamFound)) {
                $this->ajaxReturn(['status' => 0, 'msg' => '该拼单数据不存在或已失效', 'result' => '']);
            }
            if($teamFound['user_id'] == $this->user_id){
                $this->ajaxReturn(['status' => 0, 'msg' => '不能自己开团自己拼', 'result' => '']);
            }
            if($team['team_type'] == 2){
                //抽奖团，只能拼一次团
                $teamFollow = new TeamFollow();
                $teamYouSelfFollow = $teamFollow->where(['follow_user_id' => $this->user_id, 'team_id' => $team['team_id'], 'status' => ['in', '1,2']])->find();
                if($teamYouSelfFollow){
                    $this->ajaxReturn(['status' => 0, 'msg' => '你已经参与过该拼团活动。', 'result' => '']);
                }
            }
            $teamFoundLogic = new TeamFoundLogic();
            $teamFoundLogic->setTeam($team);
            $teamFoundLogic->setTeamFound($teamFound);
            $IsCanFollow = $teamFoundLogic->TeamFoundIsCanFollow();
            if($IsCanFollow['status'] != 1){
                $this->ajaxReturn(['status' => 0, 'msg' => $IsCanFollow['msg'], 'result' => '']);
            }
        }
        $teamOrderLogic = new TeamOrderLogic();
        if (!empty($teamFound)) {
            $teamOrderLogic->setTeamFound($teamFound);
        }
        $teamOrderLogic->setTeam($team);
        $teamOrderLogic->setGoods($team->goods);
        $teamOrderLogic->setSpecGoodsPrice($team->specGoodsPrice);
        $teamOrderLogic->setUserId($this->user_id);
        $teamOrderLogic->setGoodsBuyNum($goods_num);
        $result = $teamOrderLogic->add();
        $this->ajaxReturn($result);
    }

    /**
     * 结算页
     * @return mixed
     */
    public function order()
    {
        $order_id = input('order_id/d',0);
        $address_id = input('address_id/d');
        if(empty($this->user_id)){
            $this->redirect("User/login");
            exit;
        }
        $Order = new Order();
        $OrderGoods = new OrderGoods();
        $order = $Order->where(['order_id'=>$order_id,'user_id'=>$this->user_id])->find();
        if(empty($order)){
            $this->error('订单不存在或者已取消', U("Mobile/Order/order_list"));
        }
        if ($address_id) {
            $address_where = ['address_id' => $address_id];
        } else {
            $address_where = ["user_id" => $this->user_id];
        }
        $address = Db::name('user_address')->where($address_where)->order(['is_default'=>'desc'])->find();
        if(empty($address)){
            header("Location: ".U('Mobile/User/add_address',array('source'=>'team','order_id'=>$order_id)));
            exit;
        }else{
            $this->assign('address',$address);
        }
        $order_goods = $OrderGoods->with('goods')->where(['order_id' => $order_id])->find();
        // 如果已经支付过的订单直接到订单详情页面. 不再进入支付页面
        if($order['pay_status'] == 1){
            $order_detail_url = U("Mobile/Order/order_detail",array('id'=>$order_id));
            header("Location: $order_detail_url");
        }
        if($order['order_status'] == 3 ){   //订单已经取消
            $this->error('订单已取消',U("Mobile/Order/order_list"));
        }
        //微信浏览器
        if(strstr($_SERVER['HTTP_USER_AGENT'],'MicroMessenger')){
            $plugin_where = ['type'=>'payment','status'=>1,'code'=>'weixin'];
        }else{
            $plugin_where = ['type'=>'payment','status'=>1,'scene'=>1];
        }
        $pluginList = Db::name('plugin')->where($plugin_where)->select();
        $paymentList = convert_arr_key($pluginList, 'code');
        //不支持货到付款
        foreach ($paymentList as $key => $val) {
            $val['config_value'] = unserialize($val['config_value']);
            //判断当前浏览器显示支付方式
            if (($key == 'weixin' && !is_weixin()) || ($key == 'alipayMobile' && is_weixin())) {
                unset($paymentList[$key]);
            }
        }
        $ShippingArea = new ShippingArea();
        $shipping_area= $ShippingArea->alias('sa')->join('__PLUGIN__ p','sa.shipping_code = p.code')->with('plugin')
            ->where(['sa.is_default' => 1,'p.type'=>'shipping','p.status'=>1])->group("sa.shipping_code")->cache(true, TPSHOP_CACHE_TIME)->select();
        //订单没有使用过优惠券
        if($order['coupon_price'] <= 0){
            $couponLogic = new CouponLogic();
            $TeamOrderLogic = new TeamOrderLogic();
            $userCouponList = $couponLogic->getUserAbleCouponList($this->user_id, [$order_goods['goods_id']], [$order_goods['goods']['cat_id']]);//用户可用的优惠券列表
            $TeamOrderLogic->setOrder($order);
            $userCartCouponList = $TeamOrderLogic->getCouponOrderList($userCouponList);
            $this->assign('userCartCouponList', $userCartCouponList);
        }
        $this->assign('paymentList', $paymentList);
        $this->assign('order', $order);
        $this->assign('order_goods', $order_goods);
        $this->assign('shipping_area',$shipping_area);
        return $this->fetch();
    }
    /**
     * 获取订单详细
     */
    public function getOrderInfo(){
        $order_id = input('order_id/d');
        $shipping_code = input('shipping_code/s');//配送方式
        $goods_num = input('goods_num/d');
        $coupon_id = input('coupon_id/d');
        $address_id = input('address_id/d');
        $user_money = input('user_money/f');
        $pay_points = input('pay_points/d');
        $pay_pwd = trim(input("paypwd")); //  支付密码
        $user_note = trim(input("user_note")); //  用户备注
        $act = input('post.act','');
        if(empty($this->user_id)){
            $this->ajaxReturn(['status'=>0,'msg'=>'登录超时','result'=>['url'=>U("User/login")]]);
        }
        if(empty($order_id)){
            $this->ajaxReturn(['status'=>0,'msg'=>'参数错误','result'=>[]]);
        }
        //获取订单,检查订单
        $Order = new Order();
        $order = $Order->where(['order_id' => $order_id, 'order_prom_type' => 6, 'user_id' => $this->user_id])->find();
        if(empty($order)){
            $this->ajaxReturn(['status'=>0,'msg'=>'该订单已关闭或者不存在','result'=>['url'=>U("Mobile/Order/order_list")]]);
        }
        $orderInfo = $order->toArray();
        if(empty($order['province'])){
            if(empty($address_id)){
                $this->ajaxReturn(['status' => 0, 'msg' => '请选择地址', 'result' => ['url' => U('Mobile/User/add_address', array('source' => 'team', 'order_id' => $order_id))]]);
            }
            //获取用户地址，检查用户地址
            $UserAddress = new UserAddress();
            $userAddress = $UserAddress->where(['address_id'=>$address_id,'user_id'=>$this->user_id])->find();
            if(empty($userAddress)){
                $this->ajaxReturn(['status' => -1, 'msg' => '请选择地址', 'result' => []]);
            }
        }

        if(empty($shipping_code) && empty($order['shipping_code'])){
            $this->ajaxReturn(['status' => 0, 'msg' => '请选择配送方式','result'=>[]]);
        }

        if($order['pay_status'] == 1){
            $order_detail_url = U("Mobile/Order/order_detail",array('id'=>$order_id));
            $this->ajaxReturn(['status'=>0,'msg'=>'该订单已支付成功','result'=>['url'=>$order_detail_url]]);
        }

        //获取订单商品,检查订单商品
        $OrderGoods = new OrderGoods();
        $orderGoods = $OrderGoods->with('goods')->where(['order_id' => $order_id, 'prom_type' => 6])->find();
        if (empty($orderGoods)) {
            $this->ajaxReturn(['status' => 0, 'msg' => '该订单失效或不存在', 'result' => []]);
        }

        //获取拼团活动,检查活动
        $TeamActivity = new TeamActivity();
        $team = $TeamActivity->with('goods,specGoodsPrice')->where(['team_id'=>$orderGoods['prom_id']])->find();
        if(empty($team)){
            $this->ajaxReturn(['status' => 0, 'msg' => '订单失效或不存在', 'result' => []]);
        }

        //付款前检验库存
        (empty($team['specGoodsPrice'])) ? $store_num = $team['goods']['store_count'] : $store_num = $team['specGoodsPrice']['store_count'];//获取商品库存
        if($goods_num > $store_num){
            $this->ajaxReturn(['status' => 0, 'msg' => '商品库存不足,仅剩'.$store_num.'份', 'result' => []]);
        }

        //检查购买数
        if($team['buy_limit'] != 0 && $goods_num > $team['buy_limit']){
            $this->ajaxReturn(['status' => 0, 'msg' => '购买数已超过该活动单次购买限制数('.$team['buy_limit'].'个)', 'result' => []]);
        }

        //已经使用优惠券/积分/余额支付的订单不能更改数量
        if($orderGoods['goods_num'] != $goods_num && $order['order_amount'] != $order['total_amount']){
            $this->ajaxReturn(['status' => 0, 'msg' => '使用优惠券/积分/余额支付的订单不能更改数量', 'result' => []]);
        }

        //使用余额,检查使用余额条件
        if($user_money && $user_money > $this->user['user_money']){
            $this->ajaxReturn(['status' => 0, 'msg' => '你的账户可用余额为:'.$this->user['user_money'].'元', 'result' => []]);
        }

        //使用积分检查,检查使用积分条件
        if($pay_points){
            $use_percent_point = tpCache('shopping.point_use_percent');     //最大使用限制: 最大使用积分比例, 例如: 为50时, 未50% , 那么积分支付抵扣金额不能超过应付金额的50%
            if($use_percent_point == 0){
                $this->ajaxReturn(['status' => 0, 'msg' => '该笔订单不能使用积分', 'result' => []]);
            }
            if ($pay_points > $this->user['pay_points']){
                $this->ajaxReturn(['status' => 0, 'msg' => '你的账户可用积分为:'.$this->user['pay_points'], 'result' => []]);
            }
            $min_use_limit_point = tpCache('shopping.point_min_limit'); //最低使用额度: 如果拥有的积分小于该值, 不可使用
            if ($min_use_limit_point > 0 && $pay_points < $min_use_limit_point) {
                $this->ajaxReturn(['status' => 0, 'msg' => '您使用的积分必须大于'.$min_use_limit_point.'才可以使用', 'result' => []]);
            }
        }
        //获取拼单信息，并检查拼单,是否能拼
        $TeamFoundLogic = new TeamFoundLogic();
        $teamFollow = TeamFollow::get(['order_id' => $order_id, 'follow_user_id' => $this->user_id]);
        if ($teamFollow) {
            $teamFound = $teamFollow->teamFound;
            if (empty($teamFound)) {
                $this->ajaxReturn(['status' => 0, 'msg' => '团长的单不翼而飞了', 'result' => []]);
            } else {
                $TeamFoundLogic->setTeam($team);
                $TeamFoundLogic->setTeamFound($teamFound);
                $IsCanFollow = $TeamFoundLogic->TeamFoundIsCanFollow();
                if($IsCanFollow['status'] != 1){
                    $this->ajaxReturn(['status' => 0, 'msg' => $IsCanFollow['msg'], 'result' => '']);
                }
            }
        }
        $couponLogic = new CouponLogic();
        $TeamOrderLogic = new TeamOrderLogic();
        $TeamOrderLogic->setUserId($this->user_id);
        $TeamOrderLogic->setOrder($order);
        $TeamOrderLogic->setOrderGoods($orderGoods);
        $TeamOrderLogic->setGoods($orderGoods->goods);
        $TeamOrderLogic->changeNum($goods_num); //购买数量
        $TeamOrderLogic->useCouponById($coupon_id); //使用优惠券
        if(empty($order['shipping_code']) && empty($order['province'])){
            $TeamOrderLogic->useShipping($shipping_code, $userAddress); //选择物流
        }
        $TeamOrderLogic->useUserMoney($user_money);//使用余额
        $TeamOrderLogic->usePayPoints($pay_points);//使用积分
        $finalOrder = $TeamOrderLogic->getOrder();
        $finalOrderGoods = $TeamOrderLogic->getOrderGoods();
        // 确认订单
        if ($act == 'submit_order') {
            if($user_money>0 || $pay_points){
                if($this->user['is_lock'] == 1){
                    $this->ajaxReturn(['status' => 0, 'msg' => '账号异常已被锁定，不能使用积分或余额支付！', 'result' => []]);// 用户被冻结不能使用余额支付
                }
                if(empty($this->user['paypwd'])){
                    $this->ajaxReturn(['status' => 0, 'msg' => '请先设置支付密码！', 'result' => []]);
                }
                if(empty($pay_pwd)){
                    $this->ajaxReturn(['status' => 0, 'msg' => '请输入支付密码！', 'result' => []]);
                }
                if(encrypt($pay_pwd) != $this->user['paypwd']){
                    $this->ajaxReturn(['status' => 0, 'msg' => '支付密码错误！', 'result' => []]);
                }
            }
            $finalOrder->user_note = $user_note;
            $finalOrder->save();
            $finalOrderGoods->save();
            $TeamOrderLogic->deductCouponById($coupon_id);//扣除优惠券
            $integral = $finalOrder->integral - (int)$orderInfo['integral'];
            if($integral > 0){
                Db::name('users')->where('user_id',$this->user_id)->setDec('pay_points',$integral);//扣除积分
            }
            $user_money = $finalOrder->user_money - (float)$orderInfo['user_money'];
            if($user_money > 0){
                Db::name('users')->where('user_id',$this->user_id)->setDec('user_money',$user_money);//扣除余额
            }
            $TeamOrderLogic->accountLog($integral, $user_money); //记录log 日志
            $TeamOrderLogic->pushUserMsg();// 如果有微信公众号 则推送一条消息到微信
            $TeamOrderLogic->pushSellerMsg();//用户下单, 发送短信给商家
            // 如果应付金额为0  可能是余额支付 + 积分 + 优惠券 这里订单支付状态直接变成已支付
            $msg = '确认订单成功';
            if ($finalOrder['order_amount'] == 0) {
                update_pay_status($finalOrder['order_sn']); // 这里刚刚下的订单必须从主库里面去查
                $msg = '支付成功';
            }
            $this->ajaxReturn(['status' => 1, 'msg' => $msg, 'result' => ['order_amount'=>$finalOrder['order_amount']]]);
        }else{
            $userCouponList = $couponLogic->getUserAbleCouponList($this->user_id, [$orderGoods['goods_id']], [$orderGoods['goods']['cat_id']]);//用户可用的优惠券列表
            $userCartCouponList = $TeamOrderLogic->getCouponOrderList($userCouponList);
            $result = [
                'order'=>$finalOrder,
                'order_goods'=>$finalOrderGoods,
                'couponList'=>$userCartCouponList
            ];
            $this->ajaxReturn(['status' => 1, 'msg' => '计算成功', 'result' => $result]);
        }

    }

    /**
     * 拼团分享页
     * @return mixed
     */
    public function found()
    {
        $found_id = input('id');
        if (empty($found_id)) {
            $this->error('参数错误', U('Mobile/Team/index'));
        }
        $teamFound = TeamFound::get($found_id);
        $teamFollow = $teamFound->teamFollow()->where('status','IN', [1,2])->select();
        $team = $teamFound->teamActivity;

        if(time() - $teamFound['found_time'] > $team['time_limit']){
            //时间到了
            if($teamFound['join'] < $teamFound['need']){
                //人数没齐
                $teamFound->status = 3;//成团失败
                $teamFound->save();
                //更新团员成团失败
                Db::name('team_follow')->where(['found_id'=>$found_id,'status'=>1])->update(['status'=>3]);
            }
        }
        $this->assign('teamFollow', $teamFollow);//团员
        $this->assign('team', $team);//活动
        $this->assign('teamFound', $teamFound);//团长
        return $this->fetch();
    }

    public function ajaxGetMore(){
        $p = input('p/d',0);
        $TeamActivity = new TeamActivity();
        $team = $TeamActivity->with('goods')->where(['status'=>1])->page($p,4)->order(['is_recommend'=>'desc','sort'=>'desc'])->select();
        if(empty($team)){
            $this->ajaxReturn(['status'=>0,'msg'=>'已显示完所有记录']);
        }else{
            $result = collection($team)->append(['virtual_sale_num'])->toArray();
            $this->ajaxReturn(['status'=>1,'msg'=>'','result'=>$result]);
        }
    }

    public function lottery(){
        $team_id = input('team_id/d',0);
        $team_lottery = Db::name('team_lottery')->where('team_id',$team_id)->select();
        $TeamActivity = new TeamActivity();
        $team = $TeamActivity->with('specGoodsPrice,goods')->where('team_id',$team_id)->find();
        $this->assign('team',$team);
        $this->assign('team_lottery',$team_lottery);
        return $this->fetch();
    }

}