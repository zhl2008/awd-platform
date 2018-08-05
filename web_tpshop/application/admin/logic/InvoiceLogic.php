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
 * Date: 2017-10-23
 */


namespace app\admin\logic;

use think\Db;
use think\Model;

class InvoiceLogic extends Model
{
        //发票创建
	function create_Invoice($order){
            
            $data=[];             
            $data['order_id']        = $order['order_id'];  //订单id
            $data['user_id']         = $order['user_id'];   //用户id            
            $data['invoice_rate']    = $order['invoice_id'];//发票税率            
          
            $data['atime']           = time();              //创建时间
            $data['ctime']           = $order['invoice_id'];//开票时间   
            $data['invoice_money']   = $order['order_amount'];//发票金额  
            //
            //是否开发票
            $invoiceinfo=M('user_extend')->where(['user_id'=>$order['user_id']])->find();
            
            if($invoiceinfo['invoice_desc']!='不开发票'){
                 //$data['invoice_type']    = $invoiceinfo['invoice_id'];//0普通发票1电子发票2增值税发票
                $data['invoice_desc']    = $invoiceinfo['invoice_desc'];//发票内容
                $data['taxpayer']        = $invoiceinfo['taxpayer'];//纳税人识别号
                $data['invoice_title']   = $invoiceinfo['invoice_title'];// 发票抬头
                $data['invoice_desc']    = $invoiceinfo['invoice_desc'];//发票内容
                
                M('invoice')->add($data);
            }
        }

}