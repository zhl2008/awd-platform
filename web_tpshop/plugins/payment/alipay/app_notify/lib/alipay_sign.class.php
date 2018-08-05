<?php

/**
 * 旧版支付宝支付签名
 */
class AlipaySign {
	//应用ID
	public $appId;
    
    public $partner;
	
	//私钥文件路径
	public $rsaPrivateKeyFilePath;

	//私钥值
	public $rsaPrivateKey;

	//网关
	public $gatewayUrl = "https://openapi.alipay.com/gateway.do";
	//返回数据格式
	public $format = "json";
	//api版本
	public $apiVersion = "1.0";

	// 表单提交字符集编码
	public $postCharset = "UTF-8";

	//使用文件读取文件格式，请只传递该值
	public $alipayPublicKey = null;

	//使用读取字符串格式，请只传递该值
	public $alipayrsaPublicKey;

	private $fileCharset = "UTF-8";

	//签名类型
	public $signType = "RSA";

	public $encryptKey;

	public $encryptType = "AES";

    public $notifyUrl = '';

	public function generateSign($params, $signType = "RSA") {
		return $this->sign($this->getSignContent($params), $signType);
	}

	public function rsaSign($params, $signType = "RSA") {
		return $this->sign($this->getSignContent($params), $signType);
	}

	public function getSignContent($params) {
		//ksort($params);

		$stringToBeSigned = "";
		$i = 0;
		foreach ($params as $k => $v) {
			if (false === $this->checkEmpty($v) && "@" != substr($v, 0, 1)) {

				// 转换成目标字符集
				//$v = $this->characet($v, $this->postCharset);

				if ($i == 0) {
					$stringToBeSigned .= "$k" . "=" . "$v";
				} else {
					$stringToBeSigned .= "&" . "$k" . "=" . "$v";
				}
				$i++;
			}
		}

		unset ($k, $v);
		return $stringToBeSigned;
	}

	protected function sign($data, $signType = "RSA") {
		if($this->checkEmpty($this->rsaPrivateKeyFilePath)){
			$priKey=$this->rsaPrivateKey;
			$res = !$priKey ? '' : 
                "-----BEGIN RSA PRIVATE KEY-----\n" .
				wordwrap($priKey, 64, "\n", true) .
				"\n-----END RSA PRIVATE KEY-----";
		}else {
			$priKey = file_get_contents($this->rsaPrivateKeyFilePath);
			$res = openssl_get_privatekey($priKey);
		}

		($res) or die('您使用的私钥格式错误，请检查RSA私钥配置'); 

		if ("RSA2" == $signType) {
			openssl_sign($data, $sign, $res, OPENSSL_ALGO_SHA256);
		} else {
			openssl_sign($data, $sign, $res);
		}

		if(!$this->checkEmpty($this->rsaPrivateKeyFilePath)){
			openssl_free_key($res);
		}
		$sign = base64_encode($sign);
		return $sign;
	}

    /**
     * 老版本支付宝签名
     * @param type $biz_content
     * @param type $notify_url
     * @return type
     */
	public function execute($subject, $body, $price , $orderSn)
    {
		$params = $this->getOrderInfo($subject, $body, $price , $orderSn);
        
        $sign = $this->generateSign($params, $this->signType);
        $sign = urlencode($sign);
        $params['sign'] = '"'.$sign.'"';
        $params['sign_type'] = '"'.$this->signType.'"';
        
        $request = '';
        foreach ($params as $k => $v) {
            $request .= "$k=$v&";
        }
        $request = rtrim($request, '&');
		
        return $request;
	}

    public function getOrderInfo($subject, $body, $price , $orderSn) 
    {
        // 签约合作者身份ID
        $params['partner'] = $this->partner;

        // 签约卖家支付宝账号
        $params['seller_id'] = $this->seller_id;

        // 商户网站唯一订单号
        $params['out_trade_no'] = $orderSn;

        // 商品名称
        $params['subject'] = $subject;

        // 商品详情
        $params['body'] = $body;

        // 商品金额
        $params['total_fee'] = $price;

        // 服务器异步通知页面路径
        $params['notify_url'] = $this->notifyUrl;

        // 服务接口名称， 固定值
        $params['service'] = "mobile.securitypay.pay";

        // 支付类型， 固定值
        $params['payment_type'] = "1";

        // 参数编码， 固定值
        $params['_input_charset'] = "utf-8";

        // 设置未付款交易的超时时间
        // 默认30分钟，一旦超时，该笔交易就会自动被关闭。
        // 取值范围：1m～15d。
        // m-分钟，h-小时，d-天，1c-当天（无论交易何时创建，都在0点关闭）。
        // 该参数数值不接受小数点，如1.5h，可转换为90m。
        $params['it_b_pay'] = "30m";

        // extern_token为经过快登授权获取到的alipay_open_id,带上此参数用户将使用授权的账户进行支付
        // orderInfo += "&extern_token=" + "\"" + extern_token + "\"";

        // 支付宝处理完请求后，当前页面跳转到商户指定页面的路径，可空
        $params['return_url'] = "m.alipay.com";

        // 调用银行卡支付，需配置此参数，参与签名， 固定值 （需要签约《无线银行卡快捷支付》才能使用）
        // orderInfo += "&paymethod=\"expressGateway\"";
        
        foreach ($params as &$param) {
            $param = '"'.$param.'"';
        }
        return $params;
    }
    

	/**
	 * 转换字符集编码
	 * @param $data
	 * @param $targetCharset
	 * @return string
	 */
	function characet($data, $targetCharset) {
		
		if (!empty($data)) {
			$fileType = $this->fileCharset;
			if (strcasecmp($fileType, $targetCharset) != 0) {
				$data = mb_convert_encoding($data, $targetCharset, $fileType);
				//				$data = iconv($fileType, $targetCharset.'//IGNORE', $data);
			}
		}


		return $data;
	}

	/**
	 * 校验$value是否非空
	 *  if not set ,return true;
	 *    if is null , return true;
	 **/
	protected function checkEmpty($value) {
		if (!isset($value))
			return true;
		if ($value === null)
			return true;
		if (trim($value) === "")
			return true;

		return false;
	}
}