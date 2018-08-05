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
 * Class tenpay
 * @package Home\Payment
 */

class tenpay extends Model
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
        
        $paymentPlugin = M('Plugin')->where("code='tenpay' and  type = 'payment' ")->find(); // 找到支付插件的配置
        $config_value = unserialize($paymentPlugin['config_value']); // 配置反序列化                
        $this->alipay_config['partner'] = $config_value['partner'];// 
        $this->alipay_config['key']  = $config_value['key'];//         
    }    
    /**
     * 生成支付代码
     * @param   array   $order      订单信息
     * @param   array   $config_value    支付方式信息
     */
    function get_code($order, $config_value)
    {                           
            require_once ("classes/RequestHandler.class.php");                     
            //4位随机数
            $randNum = rand(1000, 9999);
          
            /* 创建支付请求对象 */
            $reqHandler = new RequestHandler();
            $reqHandler->init();
            $reqHandler->setKey($this->alipay_config['key']);
            $reqHandler->setGateUrl("https://gw.tenpay.com/gateway/pay.htm");

            //----------------------------------------
            //设置支付参数 
            //----------------------------------------
            $reqHandler->setParameter("partner", $this->alipay_config['partner']);
            $reqHandler->setParameter("out_trade_no", $order['order_sn']);//商户订单号
            $reqHandler->setParameter("total_fee", ($order['order_amount'] * 100));  //总金额
            $reqHandler->setParameter("notify_url", SITE_URL.U('Payment/notifyUrl',array('pay_code'=>'tenpay'))); //服务器异步通知页面路径 //必填，不能修改
            $reqHandler->setParameter("return_url",  SITE_URL.U('Payment/returnUrl',array('pay_code'=>'tenpay')));//页面跳转同步通知页面路径            
            $reqHandler->setParameter("body", "TPshop 商城");
            $reqHandler->setParameter("bank_type", "DEFAULT");  	  //银行类型，默认为财付通
            //用户ip
            $reqHandler->setParameter("spbill_create_ip", $_SERVER['REMOTE_ADDR']);//客户端IP
            $reqHandler->setParameter("fee_type", "1");               //币种
            $reqHandler->setParameter("subject","TPshop商品");          //商品名称，（中介交易时必填）

            //系统可选参数
            $reqHandler->setParameter("sign_type", "MD5");  	 	  //签名方式，默认为MD5，可选RSA
            $reqHandler->setParameter("service_version", "1.0"); 	  //接口版本号
            $reqHandler->setParameter("input_charset", "utf-8");   	  //字符集
            $reqHandler->setParameter("sign_key_index", "1");    	  //密钥序号

            //业务可选参数
            /*
            $reqHandler->setParameter("attach", "");             	  //附件数据，原样返回就可以了
            $reqHandler->setParameter("product_fee", "");        	  //商品费用
            $reqHandler->setParameter("transport_fee", "0");      	  //物流费用
            $reqHandler->setParameter("time_start", date("YmdHis"));  //订单生成时间
            $reqHandler->setParameter("time_expire", "");             //订单失效时间
            $reqHandler->setParameter("buyer_id", "");                //买方财付通帐号
            $reqHandler->setParameter("goods_tag", "");               //商品标记
            $reqHandler->setParameter("trade_mode","1");              //交易模式（1.即时到帐模式，2.中介担保模式，3.后台选择（卖家进入支付中心列表选择））
            $reqHandler->setParameter("transport_desc","");              //物流说明
            $reqHandler->setParameter("trans_type","1");              //交易类型
            $reqHandler->setParameter("agentid","");                  //平台ID
            $reqHandler->setParameter("agent_type","");               //代理模式（0.无代理，1.表示卡易售模式，2.表示网店模式）
            $reqHandler->setParameter("seller_id","");                //卖家的商户号
            */
            
            //请求的URL
            $reqUrl = $reqHandler->getRequestURL();

            //获取debug信息,建议把请求和debug信息写入日志，方便定位问题
            /**/
            $debugInfo = $reqHandler->getDebugInfo();
            //echo "<br/>" . $reqUrl . "<br/>";
            //echo "<br/>" . $debugInfo . "<br/>";
            
            $html_text = "<form style='display:none' id='tenpaysubmit' name='tenpaysubmit' action='".$reqHandler->getGateUrl()."' method='post'>";

            $params = $reqHandler->getAllParameters();
            foreach($params as $k => $v) {
                    $html_text .= "<input type=\"hidden\" name=\"{$k}\" value=\"{$v}\" />\n";
            }
            $html_text .= "<input type='submit' value='财付通支付'>"; //submit按钮控件请不要含有name属性
            $html_text .= "</form>";
            $html_text .= "<script>document.forms['tenpaysubmit'].submit();</script>";
            return $html_text;
            

    }
    
    /**
     * 服务器点对点响应操作给支付接口方调用
     * 
     */
    function response() {
        require ("classes/ResponseHandler.class.php");
        require ("classes/RequestHandler.class.php");
        require ("classes/client/ClientResponseHandler.class.php");
        require ("classes/client/TenpayHttpClient.class.php");
        require ("classes/function.php");

        /* 创建支付应答对象 */
        $resHandler = new ResponseHandler();
        $resHandler->setKey($this->alipay_config['key']);
        //判断签名
        if ($resHandler->isTenpaySign()) {
            //通知id
            $notify_id = $resHandler->getParameter("notify_id");
            //通过通知ID查询，确保通知来至财付通
            //创建查询请求
            $queryReq = new RequestHandler();
            $queryReq->init();
            $queryReq->setKey($this->alipay_config['key']);
            $queryReq->setGateUrl("https://gw.tenpay.com/gateway/simpleverifynotifyid.xml");
            $queryReq->setParameter("partner", $this->alipay_config['partner']);
            $queryReq->setParameter("notify_id", $notify_id);
            //通信对象
            $httpClient = new TenpayHttpClient();
            $httpClient->setTimeOut(5);
            //设置请求内容
            $httpClient->setReqContent($queryReq->getRequestURL());

            //后台调用
            if ($httpClient->call()) {
                //设置结果参数
                $queryRes = new ClientResponseHandler();
                $queryRes->setContent($httpClient->getResContent());
                $queryRes->setKey($this->alipay_config['key']);
                if ($resHandler->getParameter("trade_mode") == "1") {
                    //判断签名及结果（即时到帐）
                    //只有签名正确,retcode为0，trade_state为0才是支付成功
                    if ($queryRes->isTenpaySign() && $queryRes->getParameter("retcode") == "0" && $resHandler->getParameter("trade_state") == "0") {
                        log_result("即时到帐验签ID成功");
                        //取结果参数做业务处理
                        $out_trade_no = $resHandler->getParameter("out_trade_no");
                        //财付通订单号
                        $transaction_id = $resHandler->getParameter("transaction_id");
                        //金额,以分为单位
                        $total_fee = $resHandler->getParameter("total_fee");
                        //如果有使用折扣券，discount有值，total_fee+discount=原请求的total_fee
                        $discount = $resHandler->getParameter("discount");

                        //------------------------------
                        //处理业务开始
                        //------------------------------
                        //处理数据库逻辑
                        //注意交易单不要重复处理
                        //注意判断返回金额
                        
						//用户在线充值
						if (stripos($out_trade_no, 'recharge') !== false)
							$order_amount = M('recharge')->where(['order_sn' => $out_trade_no, 'pay_status' => 0])->value('account');
						else						
	                        $order_amount = M('order')->where(['order_sn'=>"$out_trade_no"])->value('order_amount');
                               if((string)($order_amount * 100) != (string)$total_fee) 
                                      exit('fail'); //验证失败                                                       
                        
                        update_pay_status($out_trade_no,array('transaction_id'=>$transaction_id)); // 修改订单支付状态
                        //------------------------------
                        //处理业务完毕
                        //------------------------------
                        log_result("即时到帐后台回调成功");
                        echo "success";
                    } else {
                        //错误时，返回结果可能没有签名，写日志trade_state、retcode、retmsg看失败详情。
                        //echo "验证签名失败 或 业务错误信息:trade_state=" . $resHandler->getParameter("trade_state") . ",retcode=" . $queryRes->                         getParameter("retcode"). ",retmsg=" . $queryRes->getParameter("retmsg") . "<br/>" ;
                        log_result("即时到帐后台回调失败");
                        echo "fail";
                    }
                } elseif ($resHandler->getParameter("trade_mode") == "2") {
                    //判断签名及结果（中介担保）
                    //只有签名正确,retcode为0，trade_state为0才是支付成功
                    if ($queryRes->isTenpaySign() && $queryRes->getParameter("retcode") == "0") {
                        log_result("中介担保验签ID成功");
                        //取结果参数做业务处理
                        $out_trade_no = $resHandler->getParameter("out_trade_no");
                        //财付通订单号
                        $transaction_id = $resHandler->getParameter("transaction_id");
                        //金额,以分为单位
                        $total_fee = $resHandler->getParameter("total_fee");
                        //如果有使用折扣券，discount有值，total_fee+discount=原请求的total_fee
                        $discount = $resHandler->getParameter("discount");

                        //------------------------------
                        //处理业务开始
                        //------------------------------
                        //处理数据库逻辑
                        //注意交易单不要重复处理
                        //注意判断返回金额                        

                        log_result("中介担保后台回调，trade_state=" + $resHandler->getParameter("trade_state"));
                        switch ($resHandler->getParameter("trade_state")) {
                            case "0": //付款成功
                                break;
                            case "1": //交易创建
                                break;
                            case "2": //收获地址填写完毕
                                break;
                            case "4": //卖家发货成功
                                break;
                            case "5": //买家收货确认，交易成功
                                break;
                            case "6": //交易关闭，未完成超时关闭
                                break;
                            case "7": //修改交易价格成功
                                break;
                            case "8": //买家发起退款
                                break;
                            case "9": //退款成功
                                break;
                            case "10": //退款关闭			
                                break;
                            default:
                                //nothing to do
                                break;
                        }
                        //------------------------------
                        //处理业务完毕
                        //------------------------------
						
							//用户在线充值
							if (stripos($out_trade_no, 'recharge') !== false)
								$order_amount = M('recharge')->where(['order_sn' => $out_trade_no, 'pay_status' => 0])->value('account');
							else						
		                        $order_amount = M('order')->where(['order_sn'=>"$out_trade_no"])->value('order_amount');
                               if((string)($order_amount * 100) != (string)$total_fee) 
                                      exit('fail'); //验证失败                                 
                        update_pay_status($out_trade_no,array('transaction_id'=>$transaction_id)); // 修改订单支付状态
                        echo "success";
                    } else {
                        //错误时，返回结果可能没有签名，写日志trade_state、retcode、retmsg看失败详情。
                        //echo "验证签名失败 或 业务错误信息:trade_state=" . $resHandler->getParameter("trade_state") . ",retcode=" . $queryRes->             										       getParameter("retcode"). ",retmsg=" . $queryRes->getParameter("retmsg") . "<br/>" ;
                        log_result("中介担保后台回调失败");
                        echo "fail";
                    }
                }
                //获取查询的debug信息,建议把请求、应答内容、debug信息，通信返回码写入日志，方便定位问题
                /*
                  echo "<br>------------------------------------------------------<br>";
                  echo "http res:" . $httpClient->getResponseCode() . "," . $httpClient->getErrInfo() . "<br>";
                  echo "query req:" . htmlentities($queryReq->getRequestURL(), ENT_NOQUOTES, "GB2312") . "<br><br>";
                  echo "query res:" . htmlentities($queryRes->getContent(), ENT_NOQUOTES, "GB2312") . "<br><br>";
                  echo "query reqdebug:" . $queryReq->getDebugInfo() . "<br><br>" ;
                  echo "query resdebug:" . $queryRes->getDebugInfo() . "<br><br>";
                 */
            } else {
                //通信失败
                echo "fail";
                //后台调用通信失败,写日志，方便定位问题
                echo "<br>call err:" . $httpClient->getResponseCode() . "," . $httpClient->getErrInfo() . "<br>";
            }
        } else {
            echo "<br/>" . "认证签名失败" . "<br/>";
            echo $resHandler->getDebugInfo() . "<br>";
        }
    }

    /**
     * 页面跳转响应操作给支付接口方调用
     */
    function respond2()
    {
        require_once ("classes/ResponseHandler.class.php");
        require_once ("classes/function.php");
        //require_once ("tenpay_config.php");  
        log_result("进入前台回调页面");

        /* 创建支付应答对象 */
        $resHandler = new ResponseHandler();
        $resHandler->setKey($this->alipay_config['key']);        
        //判断签名
        if($resHandler->isTenpaySign()) {
                //通知id
                $notify_id = $resHandler->getParameter("notify_id");
                //商户订单号
                $out_trade_no = $resHandler->getParameter("out_trade_no");
                //财付通订单号
                $transaction_id = $resHandler->getParameter("transaction_id");
                //金额,以分为单位
                $total_fee = $resHandler->getParameter("total_fee");
                //如果有使用折扣券，discount有值，total_fee+discount=原请求的total_fee
                $discount = $resHandler->getParameter("discount");
                //支付结果
                $trade_state = $resHandler->getParameter("trade_state");
                //交易模式,1即时到账
                $trade_mode = $resHandler->getParameter("trade_mode");
                if("1" == $trade_mode ) {
                        if( "0" == $trade_state){ 
                                //------------------------------
                                //处理业务开始
                                //------------------------------

                                //注意交易单不要重复处理
                                //注意判断返回金额

                                //------------------------------
                                //处理业务完毕
                                //------------------------------	
                                
                                return array('status'=>1,'order_sn'=>$out_trade_no);//跳转至成功页面
                                //echo "<br/>" . "即时到帐支付成功" . "<br/>";

                        } else {
                                //当做不成功处理
                                return array('status'=>0,'order_sn'=>$out_trade_no);//跳转至失败页面    
                                //echo "<br/>" . "即时到帐支付失败" . "<br/>";
                        }
                }elseif( "2" == $trade_mode  ) {
                        if( "0" == $trade_state) {

                                //------------------------------
                                //处理业务开始
                                //------------------------------

                                //注意交易单不要重复处理
                                //注意判断返回金额

                                //------------------------------
                                //处理业务完毕
                                //------------------------------	
                                return array('status'=>1,'order_sn'=>$out_trade_no);//跳转至成功页面
                                //echo "<br/>" . "中介担保支付成功" . "<br/>";

                        } else {
                                //当做不成功处理
                                return array('status'=>0,'order_sn'=>$out_trade_no);//跳转至失败页面    
                                //echo "<br/>" . "中介担保支付失败" . "<br/>";
                        }
                }

        } else {
                return array('status'=>0,'order_sn'=>$out_trade_no);//跳转至失败页面
                //echo "<br/>" . "认证签名失败" . "<br/>";
                //echo $resHandler->getDebugInfo() . "<br>";
        }        
        
    }
    
}