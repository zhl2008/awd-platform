<?php
/**
 * tpshop 支付宝插件
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

class alipay extends Model
{    
    public $tableName = 'plugin'; // 插件表        
    public $alipay_config = array();// 支付宝支付配置参数
    
    /**
     * 析构流函数
     */
    public function  __construct() {           
        parent::__construct();     
        unset($_GET['pay_code']);   // 删除掉 以免被进入签名
        unset($_REQUEST['pay_code']);// 删除掉 以免被进入签名
        
        $paymentPlugin = M('Plugin')->where("code='alipay' and  type = 'payment' ")->find(); // 找到支付插件的配置
        $config_value = unserialize($paymentPlugin['config_value']); // 配置反序列化        
        $this->alipay_config['alipay_pay_method']= $config_value['alipay_pay_method']; // 1 使用担保交易接口  2 使用即时到帐交易接口s
        $this->alipay_config['partner']       = $config_value['alipay_partner'];//合作身份者id，以2088开头的16位纯数字
        $this->alipay_config['seller_email']  = $config_value['alipay_account'];//收款支付宝账号，一般情况下收款账号就是签约账号
        $this->alipay_config['key']	      = $config_value['alipay_key'];//安全检验码，以数字和字母组成的32位字符
        $this->alipay_config['sign_type']     = strtoupper('MD5');//签名方式 不需修改
        $this->alipay_config['input_charset'] = strtolower('utf-8');//字符编码格式 目前支持 gbk 或 utf-8
        $this->alipay_config['cacert']        = getcwd().'\\cacert.pem'; //ca证书路径地址，用于curl中ssl校验 //请保证cacert.pem文件在当前文件夹目录中
        $this->alipay_config['transport']     = 'http';//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
        
    }    
    /**
     * 生成支付代码
     * @param   array   $order      订单信息
     * @param   array   $config_value    支付方式信息
     */
    function get_code($order, $config_value)
    {         
             // 接口类型
            $service = array(             
                 1 => 'create_partner_trade_by_buyer', //使用担保交易接口
                 2 => 'create_direct_pay_by_user', //使用即时到帐交易接口
                 );
            //构造要请求的参数数组，无需改动
            $body = $config_value['body'];
            !$body && $body = "TPshop商品" ;
            $parameter = array(
                        "service" => $service[$this->alipay_config['alipay_pay_method']],   // 1 使用担保交易接口  2 使用即时到帐交易接口 
                        "partner" => trim($this->alipay_config['partner']),
                        "seller_email" => trim($this->alipay_config['seller_email']),
                        "payment_type"	=> 1, // 默认值为：1（商品购买）。
                        "notify_url"	=> SITE_URL.U('Payment/notifyUrl',array('pay_code'=>'alipay')) , //服务器异步通知页面路径 //必填，不能修改
                        "return_url"	=> SITE_URL.U('Payment/returnUrl',array('pay_code'=>'alipay')),  //页面跳转同步通知页面路径
                        "out_trade_no"	=> $order['order_sn'], //商户订单号                        
                        "subject"	=> $body, //订单名称 可以中文
                        "total_fee"	=> $order['order_amount'], //付款金额
                        "_input_charset"=> trim(strtolower($this->alipay_config['input_charset'])) //字符编码格式 目前支持 gbk 或 utf-8
                    );
            //  如果是支付宝网银支付    
            if(!empty($config_value['bank_code']))
            {            
                $parameter["paymethod"] = 'bankPay'; // 若要使用纯网关，取值必须是bankPay（网银支付）。如果不设置，默认为directPay（余额支付）。
                $parameter["defaultbank"] = $config_value['bank_code'];
                $parameter["service"] = 'create_direct_pay_by_user';
            }        
            //建立请求
            require_once("lib/alipay_submit.class.php");            
            $alipaySubmit = new AlipaySubmit($this->alipay_config);
            $html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
            return $html_text;         
    }
    
    /**
     * 服务器点对点响应操作给支付接口方调用
     * 
     */
    function response()
    {                
        require_once("lib/alipay_notify.class.php");  // 请求返回
        //计算得出通知验证结果
        $alipayNotify = new AlipayNotify($this->alipay_config); // 使用支付宝原生自带的累 和方法 这里只是引用了一下 而已
        $verify_result = $alipayNotify->verifyNotify();        
            if($verify_result) //验证成功
            {
                    $order_sn = $out_trade_no = $_POST['out_trade_no']; //商户订单号                    
                    $trade_no = $_POST['trade_no']; //支付宝交易号                   
                    $trade_status = $_POST['trade_status']; //交易状态                   

					//用户在线充值
					if (stripos($order_sn, 'recharge') !== false)
						$order_amount = M('recharge')->where(['order_sn' => $order_sn, 'pay_status' => 0])->value('account');
					else
	                    $order_amount = M('order')->where(['order_sn'=>"$order_sn"])->value('order_amount');
                    if($order_amount!=$_POST['price'])
                        exit("fail"); //验证失败                    
                    
                    // 支付宝解释: 交易成功且结束，即不可再做任何操作。
                    if($_POST['trade_status'] == 'TRADE_FINISHED') 
                    {                         
                          update_pay_status($order_sn,array('transaction_id'=>$trade_no)); // 修改订单支付状态
                    }
                    //支付宝解释: 交易成功，且可对该交易做操作，如：多级分润、退款等。
                    elseif ($_POST['trade_status'] == 'TRADE_SUCCESS') 
                    { 
                         update_pay_status($order_sn,array('transaction_id'=>$trade_no)); // 修改订单支付状态
                    }
                    echo "success"; // 告诉支付宝处理成功
            }
            else 
            {                
                echo "fail"; //验证失败                                
            }
    }
    
    /**
     * 页面跳转响应操作给支付接口方调用
     */
    function respond2()
    {
        require_once("lib/alipay_notify.class.php");  // 请求返回
        //计算得出通知验证结果
        $alipayNotify = new AlipayNotify($this->alipay_config);
        $verify_result = $alipayNotify->verifyReturn();
        
            if($verify_result) //验证成功
            {
                    $order_sn = $out_trade_no = $_GET['out_trade_no']; //商户订单号
                    $trade_no = $_GET['trade_no']; //支付宝交易号                   
                    $trade_status = $_GET['trade_status']; //交易状态
                    
                    if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') 
                    {                           
                       return array('status'=>1,'order_sn'=>$order_sn);//跳转至成功页面
                    }
                    else {                        
                       return array('status'=>0,'order_sn'=>$order_sn); //跳转至失败页面
                    }                       
            }
            else 
            {                     
                return array('status'=>0,'order_sn'=>$_GET['out_trade_no']);//跳转至失败页面
            }
    }
    
    //支付宝批量付款到支付宝账户有密接口接口
    // 支付宝批量申请提现转款
    function transfer($data){
    header("Content-type: text/html; charset=utf-8");
exit("请联系TPshop官网客服购买高级版支持此功能");
    }
    // 批量申请提现转账回调
    function transfer_response(){
    	require_once("lib/alipay_notify.class.php");  // 请求返回
    	//计算得出通知验证结果
    	$alipayNotify = new AlipayNotify($this->alipay_config); // 使用支付宝原生自带的类和方法 这里只是引用了一下 而已
    	$verify_result = $alipayNotify->verifyNotify();
    	if($verify_result){
    		//返回数据格式：0315001^gonglei1@163.com^龚本林^20.00^S^null^200810248427067^20081024143652|
    		$success_details = $_POST['success_details'];
    		if($success_details){
    			$sdata = explode('|', $success_details);
    			foreach ($sdata as $val){
    				$pay_arr = explode('^', $val);
    				$pay_id[] = $pay_arr[0];
    			}
    			$withdrawals = M('withdrawals')->where(array('id'=>array('in',$pay_id)))->select();
    			foreach ($withdrawals as $wd){
    				accountLog($wd['user_id'], ($wd['money'] * -1), 0,"平台处理用户提现申请");
    				$rdata = array('type'=>1,'money'=>$wd['money'],'log_type_id'=>$wd['id'],'user_id'=>$wd['user_id']);
    				expenseLog($rdata);
    			}
    			M('withdrawals')->where(array('id'=>array('in',$pay_id)))->save(array('pay_time'=>strtotime($pay_arr[7]),'status'=>2,'pay_code'=>$pay_arr[6]));
    		}else{
    			//失败数据格式：0315006^xinjie_xj@163.com^星辰公司1^20.00^F^TXN_RESULT_TRANSFER_OUT_CAN_NOT_EQUAL_IN^200810248427065^20081024143651|
    			//格式为：流水号^收款方账号^收款账号姓名^付款金额^失败标识(F)^失败原因^支付宝内部流水号^完成时间。
    			//批量付款数据中转账失败的详细信息
    			$fail_details = $_POST['fail_details'];
    			$fdata = explode('|', $fail_details);
    			foreach ($fdata as $val){
    				$pay_arr = explode('^', $val);
    				$update = array('error_code'=>$pay_arr[5],'pay_time'=>strtotime($pay_arr[7]),'status'=>3,'pay_code'=>$pay_arr[6]);
    				M('withdrawals')->where(array('id'=>$pay_arr[0]))->save($update);
    			}
    		}
    		echo "success"; //告诉支付宝处理成功
    	}else{
    		$verify_result = print_r($verify_result);
    		error_log($verify_result,3,'pay.log');
    	}
    }
    
    //支付宝即时到账批量退款有密接口接口
    // 支付宝退款原路退回
    public function payment_refund($data){
    header("Content-type: text/html; charset=utf-8");
exit("请联系TPshop官网客服购买高级版支持此功能");
    }
    // 退款原路回调
    public function  refund_respose(){
    	require_once("lib/alipay_notify.class.php");  // 请求返回
    	//计算得出通知验证结果
    	$alipayNotify = new AlipayNotify($this->alipay_config); // 使用支付宝原生自带的类和方法 这里只是引用了一下 而已
    	$verify_result = $alipayNotify->verifyNotify();
    	if($verify_result){
    		$batch_no = $_POST['batch_no'];
    		//批量退款数据中转账成功的笔数
    		$success_num = $_POST['success_num'];
    		if(intval($success_num)>0)
    		{
    			//返回成功数据格式：2014040311001004370000361525^80^SUCCESS$jax_chuanhang@alipay.com^2088101003147483^0.01^SUCCESS
    			$result_details = $_POST['result_details'];
    			$res = explode('^', $result_details);
    			$batch_no =  $_POST['batch_no'];
    		    $rec_str = substr($batch_no,12);
    			if($res[2] == 'SUCCESS'){
    				$rec_id = substr($rec_str,1);
    				if(stripos($rec_str,'r') !== false){
    					updateRefundGoods($rec_id);//订单商品售后退款原路退回
    				}else{
   						updateRefundOrder($rec_id);//订单整单申请原路退款
    				}
    			}
    		}
    		echo "success"; //告诉支付宝处理成功
    	}else{
    		$verify_result = print_r($verify_result);
    		error_log($verify_result,3,'pay.log');
    	}
    }
    
    
}