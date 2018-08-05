<?php
//namespace Vendor\Wxpay;
//require_once "";
 //include( "WxPayConfig.class.php");


//require_once "WxPay.Data.php";
require_once "WxPayResults.class.php";

/**
 *
 * 接口访问类，包含所有微信支付API列表的封装，类中方法为static方法，
 * 每个接口有默认超时时间（除提交被扫支付为10s，上报超时时间为1s外，其他均为6s）
 * @author widyhu
 *
 */
class WxPayApi
{




	/**
	 *
	 * 统一下单，WxPayUnifiedOrder中out_trade_no、body、total_fee、trade_type必填
	 * appid、mchid、spbill_create_ip、nonce_str不需要填入
	 * @param WxPayUnifiedOrder $inputObj
	 * @param int $timeOut
	 * @throws Exception
	 * @return 成功时返回，其他抛异常
	 */
	public static function unifiedOrder($inputObj, $timeOut = 6)
	{
		$url = "https://api.mch.weixin.qq.com/pay/unifiedorder";
		//检测必填参数
		if(!$inputObj->IsOut_trade_noSet()) {
			throw new Exception("缺少统一支付接口必填参数out_trade_no！");
		}else if(!$inputObj->IsBodySet()){
			throw new Exception("缺少统一支付接口必填参数body！");
		}else if(!$inputObj->IsTotal_feeSet()) {
			throw new Exception("缺少统一支付接口必填参数total_fee！");
		}else if(!$inputObj->IsTrade_typeSet()) {
			throw new Exception("缺少统一支付接口必填参数trade_type！");
		}

		//关联参数
		if($inputObj->GetTrade_type() == "JSAPI" && !$inputObj->IsOpenidSet()){
			throw new Exception("统一支付接口中，缺少必填参数openid！trade_type为JSAPI时，openid为必填参数！");
		}
		if($inputObj->GetTrade_type() == "NATIVE" && !$inputObj->IsProduct_idSet()){
			throw new Exception("统一支付接口中，缺少必填参数product_id！trade_type为JSAPI时，product_id为必填参数！");
		}

		//异步通知url未设置，则使用配置文件中的url
		//if(!$inputObj->IsNotify_urlSet()){
			//$inputObj->SetNotify_url(WxPayConfig::NOTIFY_URL);//异步通知url
		//}
            
		//$inputObj->SetAppid(WxPayConfig::APPID);//公众账号ID
		//$inputObj->SetMch_id(WxPayConfig::MCHID);//商户号
		//$inputObj->SetSpbill_create_ip($_SERVER['REMOTE_ADDR']);//终端ip
		//$inputObj->SetSpbill_create_ip("1.1.1.1");
		//$inputObj->SetNonce_str(self::getNonceStr());//随机字符串

		//签名
		$inputObj->SetSign();
		$xml = $inputObj->ToXml();
		//print_r($xml);
		//exit();
		$startTimeStamp = self::getMillisecond();//请求开始时间
		$response = self::postXmlCurl($xml, $url, false, $timeOut);

		$result = WxPayResults::Init($response);
        //再签名
        $traceType = $inputObj->GetTrade_type();
        if ($traceType == 'APP') {
            $result = self::AppReSign($inputObj, $result);
        } elseif ($traceType == 'JSAPI') {
            if ($result['return_code'] !== 'SUCCESS') {
                ajaxReturn(['status' => -1, 'msg' => $result['return_msg'], 'result' => $result]);
            } 
            $result = self::JsApiReSign($result);
        } else {
            throw new Exception("交易类型不支持:" + $traceType);
        }
        
		return $result;
	}
    
    public static function AppReSign($inputObj, $result)
    {
        // 统一下单接口返回正常的prepay_id，再按签名规范重新生成签名后，将数据传输给APP。
		// 参与签名的字段名为appId，partnerId，prepayId，nonceStr，timeStamp，package。注意：package的值格式为Sign=WXPay
		
		/*****
								Array
						(
							[appid] => wxe60de18d2b51ea4b
							[mch_id] => 1255431001
							[nonce_str] => e6pt2euRawZmAaoH
							[prepay_id] => wx2015073115154392e30247180128688652
							[result_code] => SUCCESS
							[return_code] => SUCCESS
							[return_msg] => OK
							[sign] => 04451BF2E2004C3C532C78F1D3933FB0
							[trade_type] => APP
						)
		*****/
		
		//print_r($result);
		//exit();
		$time_stamp = time();
		$pack	= 'Sign=WXPay';
		//$pack	= 'io.dcloud.h50a170fe';
		//输出参数列表
		$prePayParams =array();
		$prePayParams['appid']		=$result['appid'];
		$prePayParams['partnerid']	=$result['mch_id'];
		$prePayParams['prepayid']	=$result['prepay_id'];
		$prePayParams['noncestr']	=$result['nonce_str'];
		$prePayParams['package']	=$pack;
		$prePayParams['timestamp']	=$time_stamp;
		//$prePayParams['return_code']	="";
		$prePayParams['result_code']	=$result['result_code'];
		$prePayParams['return_code']	=$result['return_code'];
		$prePayParams['user_ip']	=   $inputObj->GetSpbill_create_ip();
		unset($prePayParams['user_ip']);
		unset($prePayParams['return_code']);
		unset($prePayParams['result_code']);
		/****               Array
							(
								[appid] => wxe60de18d2b51ea4b
								[partnerid] => 1255431001
								[prepayid] => wx20150731171527defd39db240466898359
								[noncestr] => jcwkHR9el4qkI8Wo
								[package] => Sign=WXPay
								[timestamp] => 1438334130
							)
							
			**************/				
							
		//print_r($prePayParams);
		//exit();
		//echo json_encode($prePayParams);
		$result = WxPayResults::InitFromArray($prePayParams,true)->GetValues();
		//self::reportCostTime($url, $startTimeStamp, $result);//上报请求花费时间
		//print_r($result);
		//exit();
        return $result;
    }

    public static function JsApiReSign($result)
    {
        //示例：
        //paySign = MD5(appId=wxd678efh567hg6787&nonceStr=5K8264ILTKCH16CQ2502SI8ZNMTM67VS
        //&package=prepay_id=wx2017033010242291fcfe0db70013231072&signType=MD5
        //&timeStamp=1490840662&key=qazwsxedcrfvtgbyhnujmikolp111111)
        // = 22D9B4E54AB1950F51E0649E8810ACD6
        
		/*****
        Array(
            [appid] => wxe60de18d2b51ea4b
            [mch_id] => 1255431001
            [nonce_str] => e6pt2euRawZmAaoH
            [prepay_id] => wx2015073115154392e30247180128688652
            [result_code] => SUCCESS
            [return_code] => SUCCESS
            [return_msg] => OK
            [sign] => 04451BF2E2004C3C532C78F1D3933FB0
            [trade_type] => APP
        )
		*****/
        
		//输出参数列表
		$prePayParams =array();
		$prePayParams['appId']		= $result['appid'];
        $prePayParams['nonceStr']	= $result['nonce_str'];
        $prePayParams['package']	= 'prepay_id='.$result['prepay_id'];
        $prePayParams['signType']   = 'MD5';
        $prePayParams['timeStamp']  = time();
        
		$result = WxPayResults::InitFromArray($prePayParams, true)->GetValues();
        
        return $result;
    }
    
	/**
	 *
	 * 查询订单，WxPayOrderQuery中out_trade_no、transaction_id至少填一个
	 * appid、mchid、spbill_create_ip、nonce_str不需要填入
	 * @param WxPayOrderQuery $inputObj
	 * @param int $timeOut
	 * @throws Exception
	 * @return 成功时返回，其他抛异常
	 */
	public static function orderQuery($inputObj, $timeOut = 6)
	{
		$url = "https://api.mch.weixin.qq.com/pay/orderquery";
		//检测必填参数
		if(!$inputObj->IsOut_trade_noSet() && !$inputObj->IsTransaction_idSet()) {
			throw new Exception("订单查询接口中，out_trade_no、transaction_id至少填一个！");
		}
		$inputObj->SetAppid(WxPayConfig::$APPID);//公众账号ID
		$inputObj->SetMch_id(WxPayConfig::$MCHID);//商户号
		$inputObj->SetNonce_str(self::getNonceStr());//随机字符串

		$inputObj->SetSign();//签名
		$xml = $inputObj->ToXml();

		$startTimeStamp = self::getMillisecond();//请求开始时间
		$response = self::postXmlCurl($xml, $url, false, $timeOut);
		$result = WxPayResults::Init($response);
		self::reportCostTime($url, $startTimeStamp, $result);//上报请求花费时间

		return $result;
	}

	/**
	 *
	 * 关闭订单，WxPayCloseOrder中out_trade_no必填
	 * appid、mchid、spbill_create_ip、nonce_str不需要填入
	 * @param WxPayCloseOrder $inputObj
	 * @param int $timeOut
	 * @throws Exception
	 * @return 成功时返回，其他抛异常
	 */
	public static function closeOrder($inputObj, $timeOut = 6)
	{
		$url = "https://api.mch.weixin.qq.com/pay/closeorder";
		//检测必填参数
		if(!$inputObj->IsOut_trade_noSet()) {
			throw new Exception("订单查询接口中，out_trade_no必填！");
		}
		$inputObj->SetAppid(WxPayConfig::$APPID);//公众账号ID
		$inputObj->SetMch_id(WxPayConfig::$MCHID);//商户号
		$inputObj->SetNonce_str(self::getNonceStr());//随机字符串

		$inputObj->SetSign();//签名
		$xml = $inputObj->ToXml();

		$startTimeStamp = self::getMillisecond();//请求开始时间
		$response = self::postXmlCurl($xml, $url, false, $timeOut);
		$result = WxPayResults::Init($response);
		self::reportCostTime($url, $startTimeStamp, $result);//上报请求花费时间

		return $result;
	}

	/**
	 *
	 * 申请退款，WxPayRefund中out_trade_no、transaction_id至少填一个且
	 * out_refund_no、total_fee、refund_fee、op_user_id为必填参数
	 * appid、mchid、spbill_create_ip、nonce_str不需要填入
	 * @param WxPayRefund $inputObj
	 * @param int $timeOut
	 * @throws Exception
	 * @return 成功时返回，其他抛异常
	 */
	public static function refund($inputObj, $timeOut = 6)
	{
		$url = "https://api.mch.weixin.qq.com/secapi/pay/refund";
		//检测必填参数
		if(!$inputObj->IsOut_trade_noSet() && !$inputObj->IsTransaction_idSet()) {
			throw new Exception("退款申请接口中，out_trade_no、transaction_id至少填一个！");
		}else if(!$inputObj->IsOut_refund_noSet()){
			throw new Exception("退款申请接口中，缺少必填参数out_refund_no！");
		}else if(!$inputObj->IsTotal_feeSet()){
			throw new Exception("退款申请接口中，缺少必填参数total_fee！");
		}else if(!$inputObj->IsRefund_feeSet()){
			throw new Exception("退款申请接口中，缺少必填参数refund_fee！");
		}else if(!$inputObj->IsOp_user_idSet()){
			throw new Exception("退款申请接口中，缺少必填参数op_user_id！");
		}
		$inputObj->SetAppid(WxPayConfig::$APPID);//公众账号ID
		$inputObj->SetMch_id(WxPayConfig::$MCHID);//商户号
		$inputObj->SetNonce_str(self::getNonceStr());//随机字符串

		$inputObj->SetSign();//签名
		$xml = $inputObj->ToXml();
		$startTimeStamp = self::getMillisecond();//请求开始时间
		$response = self::postXmlCurl($xml, $url, true, $timeOut);
		$result = WxPayResults::Init($response);
		self::reportCostTime($url, $startTimeStamp, $result);//上报请求花费时间

		return $result;
	}

	/**
	 *
	 * 查询退款
	 * 提交退款申请后，通过调用该接口查询退款状态。退款有一定延时，
	 * 用零钱支付的退款20分钟内到账，银行卡支付的退款3个工作日后重新查询退款状态。
	 * WxPayRefundQuery中out_refund_no、out_trade_no、transaction_id、refund_id四个参数必填一个
	 * appid、mchid、spbill_create_ip、nonce_str不需要填入
	 * @param WxPayRefundQuery $inputObj
	 * @param int $timeOut
	 * @throws Exception
	 * @return 成功时返回，其他抛异常
	 */
	public static function refundQuery($inputObj, $timeOut = 6)
	{
		$url = "https://api.mch.weixin.qq.com/pay/refundquery";
		//检测必填参数
		if(!$inputObj->IsOut_refund_noSet() &&
			!$inputObj->IsOut_trade_noSet() &&
			!$inputObj->IsTransaction_idSet() &&
			!$inputObj->IsRefund_idSet()) {
			throw new Exception("退款查询接口中，out_refund_no、out_trade_no、transaction_id、refund_id四个参数必填一个！");
		}
		$inputObj->SetAppid(WxPayConfig::$APPID);//公众账号ID
		$inputObj->SetMch_id(WxPayConfig::$MCHID);//商户号
		$inputObj->SetNonce_str(self::getNonceStr());//随机字符串

		$inputObj->SetSign();//签名
		$xml = $inputObj->ToXml();

		$startTimeStamp = self::getMillisecond();//请求开始时间
		$response = self::postXmlCurl($xml, $url, false, $timeOut);
		$result = WxPayResults::Init($response);
		self::reportCostTime($url, $startTimeStamp, $result);//上报请求花费时间

		return $result;
	}

	/**
	 * 下载对账单，WxPayDownloadBill中bill_date为必填参数
	 * appid、mchid、spbill_create_ip、nonce_str不需要填入
	 * @param WxPayDownloadBill $inputObj
	 * @param int $timeOut
	 * @throws Exception
	 * @return 成功时返回，其他抛异常
	 */
	public static function downloadBill($inputObj, $timeOut = 6)
	{
		$url = "https://api.mch.weixin.qq.com/pay/downloadbill";
		//检测必填参数
		if(!$inputObj->IsBill_dateSet()) {
			throw new Exception("对账单接口中，缺少必填参数bill_date！");
		}
		$inputObj->SetAppid(WxPayConfig::$APPID);//公众账号ID
		$inputObj->SetMch_id(WxPayConfig::$MCHID);//商户号
		$inputObj->SetNonce_str(self::getNonceStr());//随机字符串

		$inputObj->SetSign();//签名
		$xml = $inputObj->ToXml();

		$response = self::postXmlCurl($xml, $url, false, $timeOut);
		if(substr($response, 0 , 5) == "<xml>"){
			return "";
		}
		return $response;
	}

	/**
	 * 提交被扫支付API
	 * 收银员使用扫码设备读取微信用户刷卡授权码以后，二维码或条码信息传送至商户收银台，
	 * 由商户收银台或者商户后台调用该接口发起支付。
	 * WxPayWxPayMicroPay中body、out_trade_no、total_fee、auth_code参数必填
	 * appid、mchid、spbill_create_ip、nonce_str不需要填入
	 * @param WxPayWxPayMicroPay $inputObj
	 * @param int $timeOut
	 */
	public static function micropay($inputObj, $timeOut = 10)
	{
		$url = "https://api.mch.weixin.qq.com/pay/micropay";
		//检测必填参数
		if(!$inputObj->IsBodySet()) {
			throw new Exception("提交被扫支付API接口中，缺少必填参数body！");
		} else if(!$inputObj->IsOut_trade_noSet()) {
			throw new Exception("提交被扫支付API接口中，缺少必填参数out_trade_no！");
		} else if(!$inputObj->IsTotal_feeSet()) {
			throw new Exception("提交被扫支付API接口中，缺少必填参数total_fee！");
		} else if(!$inputObj->IsAuth_codeSet()) {
			throw new Exception("提交被扫支付API接口中，缺少必填参数auth_code！");
		}

		$inputObj->SetSpbill_create_ip($_SERVER['REMOTE_ADDR']);//终端ip
		$inputObj->SetAppid(WxPayConfig::$APPID);//公众账号ID
		$inputObj->SetMch_id(WxPayConfig::$MCHID);//商户号
		$inputObj->SetNonce_str(self::getNonceStr());//随机字符串

		$inputObj->SetSign();//签名
		$xml = $inputObj->ToXml();

		$startTimeStamp = self::getMillisecond();//请求开始时间
		$response = self::postXmlCurl($xml, $url, false, $timeOut);
		$result = WxPayResults::Init($response);
		self::reportCostTime($url, $startTimeStamp, $result);//上报请求花费时间

		return $result;
	}

	/**
	 *
	 * 撤销订单API接口，WxPayReverse中参数out_trade_no和transaction_id必须填写一个
	 * appid、mchid、spbill_create_ip、nonce_str不需要填入
	 * @param WxPayReverse $inputObj
	 * @param int $timeOut
	 * @throws Exception
	 */
	public static function reverse($inputObj, $timeOut = 6)
	{
		$url = "https://api.mch.weixin.qq.com/secapi/pay/reverse";
		//检测必填参数
		if(!$inputObj->IsOut_trade_noSet() && !$inputObj->IsTransaction_idSet()) {
			echo"撤销订单API接口中，参数out_trade_no和transaction_id必须填写一个！";
		}

		$inputObj->SetAppid(WxPayConfig::$APPID);//公众账号ID
		$inputObj->SetMch_id(WxPayConfig::$MCHID);//商户号
		$inputObj->SetNonce_str(self::getNonceStr());//随机字符串

		$inputObj->SetSign();//签名
		$xml = $inputObj->ToXml();

		$startTimeStamp = self::getMillisecond();//请求开始时间
		$response = self::postXmlCurl($xml, $url, true, $timeOut);
		$result = WxPayResults::Init($response);
		self::reportCostTime($url, $startTimeStamp, $result);//上报请求花费时间

		return $result;
	}

	/**
	 *
	 * 测速上报，该方法内部封装在report中，使用时请注意异常流程
	 * WxPayReport中interface_url、return_code、result_code、user_ip、execute_time_必填
	 * appid、mchid、spbill_create_ip、nonce_str不需要填入
	 * @param WxPayReport $inputObj
	 * @param int $timeOut
	 * @throws Exception
	 * @return 成功时返回，其他抛异常
	 */
	public static function report($inputObj, $timeOut = 1)
	{
		$url = "https://api.mch.weixin.qq.com/payitil/report";
		//检测必填参数
		if(!$inputObj->IsInterface_urlSet()) {
			echo "接口URL，缺少必填参数interface_url！";
		} if(!$inputObj->IsReturn_codeSet()) {
			echo"返回状态码，缺少必填参数return_code！" ;
		} if(!$inputObj->IsResult_codeSet()) {
			echo"业务结果，缺少必填参数result_code！";
		} if(!$inputObj->IsUser_ipSet()) {
			echo "访问接口IP，缺少必填参数user_ip！";
		} if(!$inputObj->IsExecute_time_Set()) {
			echo "接口耗时，缺少必填参数execute_time_！";
		}
		$inputObj->SetAppid(WxPayConfig::$APPID);//公众账号ID
		$inputObj->SetMch_id(WxPayConfig::$MCHID);//商户号
		$inputObj->SetUser_ip($_SERVER['REMOTE_ADDR']);//终端ip
		$inputObj->SetTime(date("YmdHis"));//商户上报时间
		$inputObj->SetNonce_str(self::getNonceStr());//随机字符串

		$inputObj->SetSign();//签名
		$xml = $inputObj->ToXml();

		$startTimeStamp = self::getMillisecond();//请求开始时间
		$response = self::postXmlCurl($xml, $url, false, $timeOut);
		return $response;
	}
    
    /**
     * 
     * @param type $inputObj
     * @param type $timeOut
     * @return type
     */
    public static function miniAppReport($inputObj, $timeOut = 1)
	{
		$url = "https://api.mch.weixin.qq.com/payitil/report";
		//检测必填参数
		if(!$inputObj->IsInterface_urlSet()) {
			echo "接口URL，缺少必填参数interface_url！";
		} if(!$inputObj->IsReturn_codeSet()) {
			echo"返回状态码，缺少必填参数return_code！" ;
		} if(!$inputObj->IsResult_codeSet()) {
			echo"业务结果，缺少必填参数result_code！";
		} if(!$inputObj->IsUser_ipSet()) {
			echo "访问接口IP，缺少必填参数user_ip！";
		} if(!$inputObj->IsExecute_time_Set()) {
			echo "接口耗时，缺少必填参数execute_time_！";
		}
		$inputObj->SetAppid(WxPayConfig::$APPID);//公众账号ID
		$inputObj->SetMch_id(WxPayConfig::$MCHID);//商户号
		$inputObj->SetUser_ip($_SERVER['REMOTE_ADDR']);//终端ip
		$inputObj->SetTime(date("YmdHis"));//商户上报时间
		$inputObj->SetNonce_str(self::getNonceStr());//随机字符串

		$inputObj->SetSign();//签名
		$xml = $inputObj->ToXml();

		$startTimeStamp = self::getMillisecond();//请求开始时间
		$response = self::postXmlCurl($xml, $url, false, $timeOut);
		return $response;
	}

	/**
	 *
	 * 生成二维码规则,模式一生成支付二维码
	 * appid、mchid、spbill_create_ip、nonce_str不需要填入
	 * @param WxPayBizPayUrl $inputObj
	 * @param int $timeOut
	 * @throws Exception
	 * @return 成功时返回，其他抛异常
	 */
	public static function bizpayurl($inputObj, $timeOut = 6)
	{
		if(!$inputObj->IsProduct_idSet()){
			throw new Exception("生成二维码，缺少必填参数product_id！");
		}

		$inputObj->SetAppid(WxPayConfig::$APPID);//公众账号ID
		$inputObj->SetMch_id(WxPayConfig::$MCHID);//商户号
		$inputObj->SetTime_stamp(time());//时间戳
		$inputObj->SetNonce_str(self::getNonceStr());//随机字符串

		$inputObj->SetSign();//签名

		return $inputObj->GetValues();
	}

	/**
	 *
	 * 转换短链接
	 * 该接口主要用于扫码原生支付模式一中的二维码链接转成短链接(weixin://wxpay/s/XXXXXX)，
	 * 减小二维码数据量，提升扫描速度和精确度。
	 * appid、mchid、spbill_create_ip、nonce_str不需要填入
	 * @param WxPayShortUrl $inputObj
	 * @param int $timeOut
	 * @throws Exception
	 * @return 成功时返回，其他抛异常
	 */
	public static function shorturl($inputObj, $timeOut = 6)
	{
		$url = "https://api.mch.weixin.qq.com/tools/shorturl";
		//检测必填参数
		if(!$inputObj->IsLong_urlSet()) {
			throw new Exception("需要转换的URL，签名用原串，传输需URL encode！");
		}
		$inputObj->SetAppid(WxPayConfig::$APPID);//公众账号ID
		$inputObj->SetMch_id(WxPayConfig::$MCHID);//商户号
		$inputObj->SetNonce_str(self::getNonceStr());//随机字符串

		$inputObj->SetSign();//签名
		$xml = $inputObj->ToXml();

		$startTimeStamp = self::getMillisecond();//请求开始时间
		$response = self::postXmlCurl($xml, $url, false, $timeOut);
		$result = WxPayResults::Init($response);
		self::reportCostTime($url, $startTimeStamp, $result);//上报请求花费时间

		return $result;
	}

 	/**
 	 *
 	 * 支付结果通用通知
 	 * @param function $callback
 	 * 直接回调函数使用方法: notify(you_function);
 	 * 回调类成员函数方法:notify(array($this, you_function));
 	 * $callback  原型为：function function_name($data){}
 	 */
	public static function notify($callback, &$msg)
	{
		//获取通知的数据
		//$xml = $GLOBALS['HTTP_RAW_POST_DATA'];
		$xml = file_get_contents('php://input');
		//如果返回成功则验证签名
		try {
			$result = WxPayResults::Init($xml);
		} catch (Exception $e){
			$msg = $e->errorMessage();
			return false;
		}

		return call_user_func($callback, $result);
	}

	/**
	 *
	 * 产生随机字符串，不长于32位
	 * @param int $length
	 * @return 产生的随机字符串
	 */
	public static function getNonceStr($length = 32)
	{
		$chars = "abcdefghijklmnopqrstuvwxyz0123456789";
		$str ="";
		for ( $i = 0; $i < $length; $i++ )  {
			$str .= substr($chars, mt_rand(0, strlen($chars)-1), 1);
		}
		return $str;
	}

	/**
	 * 直接输出xml
	 * @param string $xml
	 */
	public static function replyNotify($xml)
	{
		echo $xml;
	}

	/**
	 *
	 * 上报数据， 上报的时候将屏蔽所有异常流程
	 * @param string $usrl
	 * @param int $startTimeStamp
	 * @param array $data
	 */
	private static function reportCostTime($url, $startTimeStamp, $data)
	{
		//如果不需要上报数据
		if(WxPayConfig::REPORT_LEVENL == 0){
			return;
		}
		//如果仅失败上报
		if(WxPayConfig::REPORT_LEVENL == 1 &&
			 array_key_exists("return_code", $data) &&
			 $data["return_code"] == "SUCCESS" &&
			 array_key_exists("result_code", $data) &&
			 $data["result_code"] == "SUCCESS")
		 {
		 	return;
		 }

		//上报逻辑
		$endTimeStamp = self::getMillisecond();
		$objInput = new WxPayReport();
		$objInput->SetInterface_url($url);
		$objInput->SetExecute_time_($endTimeStamp - $startTimeStamp);
		//返回状态码
		if(array_key_exists("return_code", $data)){
			$objInput->SetReturn_code($data["return_code"]);
		}
		//返回信息
		if(array_key_exists("return_msg", $data)){
			$objInput->SetReturn_msg($data["return_msg"]);
		}
		//业务结果
		if(array_key_exists("result_code", $data)){
			$objInput->SetResult_code($data["result_code"]);
		}
		//错误代码
		if(array_key_exists("err_code", $data)){
			$objInput->SetErr_code($data["err_code"]);
		}
		//错误代码描述
		if(array_key_exists("err_code_des", $data)){
			$objInput->SetErr_code_des($data["err_code_des"]);
		}
		//商户订单号
		if(array_key_exists("out_trade_no", $data)){
			$objInput->SetOut_trade_no($data["out_trade_no"]);
		}
		//设备号
		if(array_key_exists("device_info", $data)){
			$objInput->SetDevice_info($data["device_info"]);
		}

		try{
			self::report($objInput);
		} catch (Exception $e){
			//不做任何处理
		}
	}

	/**
	 * 以post方式提交xml到对应的接口url
	 *
	 * @param string $xml  需要post的xml数据
	 * @param string $url  url
	 * @param bool $useCert 是否需要证书，默认不需要
	 * @param int $second   url执行超时时间，默认30s
	 * @throws Exception
	 */
	private static function postXmlCurl($xml, $url, $useCert = false, $second = 30)
	{
		$ch = curl_init();
		//设置超时
		curl_setopt($ch, CURLOPT_TIMEOUT, $second);

		//如果有配置代理这里就设置代理
		if(WxPayConfig::CURLOPT_PROXY != "0.0.0.0"
			&& WxPayConfig::CURLOPT_PROXYPORT != 0){
			curl_setopt($ch,CURLOPT_PROXY, WxPayConfig::CURLOPT_PROXY);
			curl_setopt($ch,CURLOPT_PROXYPORT, WxPayConfig::CURLOPT_PROXYPORT);
		}
		curl_setopt($ch,CURLOPT_URL, $url);
		// curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,TRUE);
		// curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,2);//严格校验
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
		curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);//严格校验
		//设置header
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		//要求结果为字符串且输出到屏幕上
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

		if($useCert == true){
			//设置证书
			//使用证书：cert 与 key 分别属于两个.pem文件
			curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
			curl_setopt($ch,CURLOPT_SSLCERT, WxPayConfig::SSLCERT_PATH);
			curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
			curl_setopt($ch,CURLOPT_SSLKEY, WxPayConfig::SSLKEY_PATH);
		}
		//post提交方式
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
		//运行curl
		$data = curl_exec($ch);
		//返回结果
		if($data){
			curl_close($ch);
			return $data;
		} else {
			$error = curl_errno($ch);
			curl_close($ch);
			echo "curl出错，错误码:".$error;
		}
	}

	/**
	 * 获取毫秒级别的时间戳
	 */
	private static function getMillisecond()
	{
		//获取毫秒的时间戳
		$time = explode ( " ", microtime () );
		$time = $time[1] . ($time[0] * 1000);
		$time2 = explode( ".", $time );
		$time = $time2[0];
		return $time;
	}
}

