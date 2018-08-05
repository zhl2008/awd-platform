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
 * Author: dyr
 * Date: 2016-08-23
 */

namespace app\common\model;

use think\Model;
use think\Db;

/**
 * @package Home\Model
 */
class Order extends Model
{

    //获取订单商品
    public function OrderGoods()
    {
        return $this->hasMany('OrderGoods','order_id','order_id');
    }
    /**
     * 获取订单状态对应的中文
     * @param $value
     * @param $data
     * @return mixed
     */
    public function getOrderStatusDetailAttr($value, $data)
    {
        $data_status_arr = C('ORDER_STATUS_DESC');
        // 货到付款
        if ($data['pay_code'] == 'cod') {
            if (in_array($data['order_status'], array(0, 1)) && $data['shipping_status'] == 0)
                return $data_status_arr['WAITSEND']; //'待发货',
        } else // 非货到付款
        {
            if ($data['pay_status'] == 0 && $data['order_status'] == 0)
                return $data_status_arr['WAITPAY']; //'待支付',
            if ($data['pay_status'] == 1 && in_array($data['order_status'], array(0, 1)) && $data['shipping_status'] != 1)
                return $data_status_arr['WAITSEND']; //'待发货',
        }
        if (($data['shipping_status'] == 1) && ($data['order_status'] == 1))
            return $data_status_arr['WAITRECEIVE']; //'待收货',
        if ($data['order_status'] == 2 && $data['is_comment']==1 ){
            return $data_status_arr['FINISH']; //'待评价',
        }
        if ($data['order_status'] == 2  ){
            return $data_status_arr['WAITCCOMMENT']; //'待评价',
        }
        if ($data['order_status'] == 3)
            return $data_status_arr['CANCEL']; //'已取消',
        if ($data['order_status'] == 4)
            return $data_status_arr['FINISH']; //'已完成',
        return $data_status_arr['OTHER'];
    }

    /**
     *  只有在订单为拼团才有用:order_prom_type = 6
     */
    public function teamActivity()
    {
        return $this->hasOne('TeamActivity', 'team_id', 'order_prom_id');
    }

    public function teamFollow(){
        return $this->hasOne('TeamFollow','order_id','order_id');
    }

    public function teamFound(){
        return $this->hasOne('TeamFound','order_id','order_id');
    }
    /**
     * 获取订单状态的 显示按钮
     * @param $value
     * @param $data
     * @return mixed
     */
    public function getOrderButtonAttr($value, $data)
    {
        /**
         *  订单用户端显示按钮
         * 去支付     AND pay_status=0 AND order_status=0 AND pay_code ! ="cod"
         * 取消按钮  AND pay_status=0 AND shipping_status=0 AND order_status=0
         * 确认收货  AND shipping_status=1 AND order_status=0
         * 评价      AND order_status=1
         * 查看物流  if(!empty(物流单号))
         */
        $btn_arr = array(
            'pay_btn' => 0, // 去支付按钮
            'cancel_btn' => 0, // 取消按钮
            'receive_btn' => 0, // 确认收货
            'comment_btn' => 0, // 评价按钮
            'shipping_btn' => 0, // 查看物流
            'return_btn' => 0, // 退货按钮 (联系客服)
        );
        // 三个月(90天)内的订单才可以进行有操作按钮. 三个月(90天)以外的过了退货 换货期, 即便是保修也让他联系厂家, 不走线上
        if(time() - $data['add_time'] > (86400 * 90))
        {
            return $btn_arr;
        }
        // 货到付款
        if ($data['pay_code'] == 'cod') {
            if (($data['order_status'] == 0 || $data['order_status'] == 1) && $data['shipping_status'] == 0) // 待发货
            {
                $btn_arr['cancel_btn'] = 1; // 取消按钮 (联系客服)
            }
            if ($data['shipping_status'] == 1 && $data['order_status'] == 1) //待收货
            {
                $btn_arr['receive_btn'] = 1;  // 确认收货
                $btn_arr['return_btn'] = 1; // 退货按钮 (联系客服)
            }
        } // 非货到付款
        else {
            if ($data['pay_status'] == 0 && $data['order_status'] == 0) // 待支付
            {
                $btn_arr['pay_btn'] = 1; // 去支付按钮
                $btn_arr['cancel_btn'] = 1; // 取消按钮
            }
            if ($data['pay_status'] == 1 && $data['order_status']<2 && $data['shipping_status'] == 0) // 待发货
            {
                $btn_arr['cancel_btn'] = 1; // 取消按钮
            }
            if ($data['pay_status'] == 1 && $data['order_status'] == 1 && $data['shipping_status'] == 1) //待收货
            {
                $btn_arr['receive_btn'] = 1;  // 确认收货
            }
        }
        if ($data['order_status'] == 4) {
            $btn_arr['return_btn'] = 1; // 退货按钮 (联系客服)
        }
        if ($data['order_status'] == 2) {
            if ($data['is_comment'] == 0) $btn_arr['comment_btn'] = 1;  // 评价按钮
            $btn_arr['return_btn'] = 1; // 退货按钮 (联系客服)
        }
        if ($data['shipping_status'] > 0 && $data['order_status'] == 1) {
            $btn_arr['shipping_btn'] = 1; // 查看物流
        }
        if ($data['shipping_status'] == 2 && $data['order_status'] == 1) // 部分发货
        {
            $btn_arr['return_btn'] = 1; // 退货按钮 (联系客服)
        }
        if($data['order_status'] == 3 && ($data['pay_status'] == 1 || $data['pay_status'] == 4)){
        	$btn_arr['cancel_info'] = 1; // 取消订单详情
        }

        return $btn_arr;
    }
    public function getVirtualOrderButtonAttr($value, $data){
        $vr_order_code = Db::name('vr_order_code')->where(['order_id'=>$data['order_id']])->find();
        $Virtual_btn_arr = array(
            'pay_btn' => 0, // 去支付按钮
            'cancel_btn' => 0, // 取消按钮
            'receive_btn' => 0, // 确认收货
            'comment_btn' => 0, // 评价按钮
        );
        if ($data['pay_status'] == 0 && $data['order_status'] == 0) {   // 待支付
            $Virtual_btn_arr['pay_btn'] = 1; // 去支付按钮
            $Virtual_btn_arr['cancel_btn'] = 1; //未支付取消按钮
        }
        if(!empty($vr_order_code)){
            if ($data['pay_status']==1 && $data['order_status']<2 && $vr_order_code['vr_state']!=1 && $vr_order_code['refund_lock']<1)
            {
                if ($vr_order_code['vr_indate'] > time() ) {
                    $Virtual_btn_arr['cancel_btn'] = 2; // 已支付取消按钮
                }
                if ($vr_order_code['vr_indate'] < time() && $vr_order_code['vr_invalid_refund'] == 1)
                {
                    $Virtual_btn_arr['cancel_btn'] = 2; // 已支付取消按钮
                    M('vr_order_code')->where(array('order_id'=>$data['order_id']))->update(['vr_state'=>2]);
                }
                $Virtual_btn_arr['receive_btn'] = 1;
            }
            if ($data['order_status'] == 2) {
                if ($data['is_comment'] == 0) $Virtual_btn_arr['comment_btn'] = 1;  // 评价按钮
            }
        }
        return $Virtual_btn_arr;
    }
    public function getAddressRegionAttr($value, $data){
        $regions = Db::name('region')->where('id', 'IN', [$data['province'], $data['city'], $data['district'],$data['twon']])->order('level desc')->select();
        $address = '';
        if($regions){
            foreach($regions as $regionKey=>$regionVal){
                $address = $regionVal['name'] . $address;
            }
        }
        return $address;
    }


    public function getPayStatusDetailAttr($value, $data)
    {
        $pay_status = config('PAY_STATUS');
        return $pay_status[$data['pay_status']];
    }

    public function getShippingStatusDetailAttr($value, $data)
    {
        $shipping_status = config('SHIPPING_STATUS');
        return $shipping_status[$data['shipping_status']];
    }
}