<?php
/**
 * tpshop 货到付款插件
 * ============================================================================
 * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: IT宇宙人
 * Date: 2015-09-09
 */

//namespace plugins\payment\alipay;
use think\Model; 
use think\Request;
/**
 * 支付 逻辑定义
 * Class AlipayPayment
 * @package Home\Payment
 */

class cod extends Model
{    
    public $tableName = 'plugin'; // 插件表            
    
    /**
     * 析构流函数
     */
    public function  __construct() {   
        parent::__construct();        
    }    
    /**
     * 生成支付代码
     * @param   array   $order      订单信息
     * @param   array   $config_value    支付方式信息
     */
    function get_code($order, $config_value)
    {       
            //header("Location:".U('/Home/User/order_detail',array('id'=>$order['order_id'])));
            //exit();
            $url = SITE_URL.U('Payment/returnUrl',array('pay_code'=>'cod','order_sn'=>$order['order_sn']));
            return "<script>location.href='".$url."';</script>";         
    }         
    
    /**
     * 页面跳转响应操作给支付接口方调用
     */
    function respond2()
    {                  
        return array('status'=>1,'order_sn'=>input('order_sn'));
    }
    
    
}