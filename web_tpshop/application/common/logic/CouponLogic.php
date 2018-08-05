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

use app\common\model\Coupon;
use app\common\model\CouponList;
use think\Model;
use think\Db;

/**
 * 回复
 * Class CatsLogic
 * @package common\Logic
 */
class CouponLogic extends Model
{
    /**
     * 获取发放有效的优惠券金额
     * @param type $coupon_id
     * @param type $goods_id
     * @param type $store_id
     * @param type $cat_id
     * @return boolean
     */
    public function getSendValidCouponMoney($coupon_id, $goods_id, $cat_id)
    {
        $curtime = time();
        $coupon = M('coupon')->where('id', $coupon_id)->find();
        $goods_coupon = M('goods_coupon')->where('coupon_id', $coupon_id)->where(function ($query) use ($goods_id, $cat_id) {
            $query->where('goods_id', $goods_id)->whereOr('goods_category_id',$cat_id);
        })->select();
        
        if ($goods_coupon && $coupon 
                && $coupon['send_start_time'] <= $curtime 
                && $coupon['send_end_time'] > $curtime
                && $coupon['createnum'] > $coupon['send_enum']) {
            return $coupon['money'];
        }
        return false;
    }
    /**
     * 获取用户可以使用的优惠券
     * @param $user_id|用户id
     * @param $coupon_id|优惠券id
     * @return int|mixed
     */
    public function getCouponMoney($user_id, $coupon_id)
    {
        if ($coupon_id == 0) {
            return 0;
        }
        $couponList = M('CouponList')->where("uid", $user_id)->where('id', $coupon_id)->find(); // 获取用户的优惠券
        if (empty($couponList)) {
            return 0;
        }
        $coupon = M('Coupon')->where("id", $couponList['cid'])->find(); // 获取 优惠券类型表
        $coupon['money'] = $coupon['money'] ? $coupon['money'] : 0;
        return $coupon['money'];
    }

    /**
     * 根据优惠券代码获取优惠券金额
     * @param $couponCode|优惠券代码
     * @param $orderMoney|订单金额
     * @return array
     */
    public function getCouponMoneyByCode($couponCode,$orderMoney)
    {
        $couponList = M('CouponList')->where("code", $couponCode)->find(); // 获取用户的优惠券
        if(empty($couponList))
            return array('status'=>-9,'msg'=>'优惠券码不存在','result'=>'');
        if($couponList['order_id'] > 0){
            return array('status'=>-20,'msg'=>'该优惠券已被使用','result'=>'');
        }
        $coupon = M('Coupon')->where("id", $couponList['cid'])->find(); // 获取优惠券类型表
        if(time() < $coupon['use_start_time'])
            return array('status'=>-13,'msg'=>'该优惠券开始使用时间'.date('Y-m-d H:i:s',$coupon['use_start_time']),'result'=>'');
        if(time() > $coupon['use_end_time'])
            return array('status'=>-10,'msg'=>'优惠券已经过期'.date('Y-m-d H:i:s',$coupon['use_start_time']),'result'=>'');
        if($orderMoney < $coupon['condition'])
            return array('status'=>-11,'msg'=>'金额没达到优惠券使用条件','result'=>'');
        if($couponList['order_id'] > 0)
            return array('status'=>-12,'msg'=>'优惠券已被使用','result'=>'');

        return array('status'=>1,'msg'=>'','result'=>$coupon['money']);
    }
    
    /**
     * 获取购物车中的优惠券
     * $type: 0可用，1不可用
     * $size: 每页的数量，null表示所有
     */
    public function getCartCouponList($user_id, $type, $cartList, $p = 1, $size = null)
    {
        //商品优惠总价
        $cartTotalPrice = array_sum(array_map(function($val){
            return $val['total_fee'];
        }, $cartList));
        
        $now = time();
        $where = "c1.status=1 AND c2.uid={$user_id} AND c1.use_end_time>{$now}";
        if (!$type) {
            $where .= " AND c1.use_start_time<{$now} AND c1.condition<={$cartTotalPrice}";
        } else {
            $where .= " AND (c1.use_start_time>{$now} OR c1.condition>{$cartTotalPrice}) ";
        }
        
        $query = Db::name('coupon')->alias('c1')
                ->field('c1.name,c1.money,c1.condition,c1.use_end_time, c2.*')
                ->join('__COUPON_LIST__ c2','c2.cid=c1.id AND c2.status=0', 'LEFT')
                ->where($where);
        if ($size) {
            return $query->page($p, $size)->select();
        }
        return $query->select();
    }

    /**
     * 获取用户可用的优惠券
     * @param $user_id|用户id
     * @param array $goods_ids|限定商品ID数组
     * @param array $goods_cat_id||限定商品分类ID数组
     * @return array
     */
    public function getUserAbleCouponList($user_id, $goods_ids = array(), $goods_cat_id = array())
    {
        $CouponList = new CouponList();
        $Coupon = new Coupon();
        $userCouponArr = [];
        $userCouponList = $CouponList->where('uid', $user_id)->where('status', 0)->select();//用户优惠券
        if(!$userCouponList){
            return $userCouponArr;
        }
        $userCouponId = get_arr_column($userCouponList, 'cid');
        $couponList = $Coupon->with('GoodsCoupon')
            ->where('id', 'IN', $userCouponId)
            ->where('status', 1)
            ->where('use_start_time', '<', time())
            ->where('use_end_time', '>', time())
            ->select();//检查优惠券是否可以用
        foreach ($userCouponList as $userCoupon => $userCouponItem) {
            foreach ($couponList as $coupon => $couponItem) {
                if ($userCouponItem['cid'] == $couponItem['id']) {
                    //全店通用
                    if ($couponItem['use_type'] == 0) {
                        $tmp = $userCouponItem;
                        $tmp['coupon'] = $couponItem;
                        $userCouponArr[] = $tmp;
                    }
                    //限定商品
                    if ($couponItem['use_type'] == 1 && !empty($couponItem['goods_coupon'])) {
                        foreach ($couponItem['goods_coupon'] as $goodsCoupon => $goodsCouponItem) {
                            if (in_array($goodsCouponItem['goods_id'], $goods_ids)) {
                                $tmp = $userCouponItem;
                                $tmp['coupon'] = array_merge($couponItem->toArray(), $goodsCouponItem->toArray());
                                $userCouponArr[] = $tmp;
                                break;
                            }
                        }
                    }
                    //限定商品类型
                    if ($couponItem['use_type'] == 2 && !empty($couponItem['goods_coupon'])) {
                        foreach ($couponItem['goods_coupon'] as $goodsCoupon => $goodsCouponItem) {
                            if (in_array($goodsCouponItem['goods_category_id'], $goods_cat_id)) {
                                $tmp = $userCouponItem;
                                $tmp['coupon'] = array_merge($couponItem->toArray(), $goodsCouponItem->toArray());
                                $userCouponArr[] = $tmp;
                                break;
                            }
                        }
                    }
                }
            }
        }
        return $userCouponArr;
    }

    /**
     * 优惠券兑换
     * @param type $user_id
     * @param type $coupon_code
     * @return json
     */
    public function exchangeCoupon($user_id, $coupon_code)
    {
        if ($user_id == 0){
            return ['status' => -100, 'msg' => "登录超时请重新登录!", 'result' => null];
        }
        if (!$coupon_code) {
            return ['status' => '0', 'msg' => '请输入优惠券券码', 'result' => ''];
        }
        $coupon_list = Db::name('coupon_list')->where('code', $coupon_code)->find();
        if (empty($coupon_list)){
            return ['status' => 0, 'msg' => '优惠券码不存在', 'result' => ''];
        }
        if ($coupon_list['order_id'] > 0) {
            return ['status' => 0, 'msg' => '该优惠券已被使用', 'result' => ''];
        }
        if ($coupon_list['uid'] > 0) {
            return ['status' => 0, 'msg' => '该优惠券已兑换', 'result' => ''];
        }
        $coupon = Coupon::get($coupon_list['cid']); // 获取优惠券类型表
        if (time() < $coupon['use_start_time']) {
            return ['status' => 0, 'msg' => '该优惠券开始使用时间' . date('Y-m-d H:i:s', $coupon['use_start_time']), 'result' => ''];
        }
        if (time() > $coupon['use_end_time'] || $coupon['status'] == 2) {
            return ['status' => 0, 'msg' => '优惠券已失效或过期', 'result' => ''];
        }
        $do_exchange = Db::name('coupon_list')->where('id',$coupon_list['id'])->update(['uid'=>$user_id]);
        if ($do_exchange !== false) {
            return ['status' => 1, 'msg' => '兑换成功',
                'result' => ['coupon' => $coupon->append(['is_expiring','use_start_time_format_dot','use_end_time_format_dot'])->toArray(), 'coupon_list'=>$coupon_list]];
        } else {
            return ['status' => 0, 'msg' => '兑换失败', 'result' => ''];
        }
    }
}