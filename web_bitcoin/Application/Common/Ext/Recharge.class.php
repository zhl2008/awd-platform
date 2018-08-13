<?php

namespace Common\Ext;

class Recharge
{
	private $appkey;
	private $openid;
	private $telCheckUrl = 'http://op.juhe.cn/ofpay/mobile/telcheck';
	private $telQueryUrl = 'http://op.juhe.cn/ofpay/mobile/telquery';
	private $submitUrl = 'http://op.juhe.cn/ofpay/mobile/onlineorder';
	private $staUrl = 'http://op.juhe.cn/ofpay/mobile/ordersta';

	public function __construct($appkey, $openid)
	{
		$this->appkey = $appkey;
		$this->openid = $openid;
	}

	public function telcheck($mobile, $pervalue)
	{
		$params = 'key=' . $this->appkey . '&phoneno=' . $mobile . '&cardnum=' . $pervalue;
		$content = $this->juhecurl($this->telCheckUrl, $params);
		$result = $this->_returnArray($content);

		if ($result['error_code'] == '0') {
			return true;
		}
		else {
			return false;
		}
	}

	public function telquery($mobile, $pervalue)
	{
		$params = 'key=' . $this->appkey . '&phoneno=' . $mobile . '&cardnum=' . $pervalue;
		$content = $this->juhecurl($this->telQueryUrl, $params);
		return $this->_returnArray($content);
	}

	public function telcz($mobile, $pervalue, $orderid)
	{
		$sign = md5($this->openid . $this->appkey . $mobile . $pervalue . $orderid);
		$params = array('key' => $this->appkey, 'phoneno' => $mobile, 'cardnum' => $pervalue, 'orderid' => $orderid, 'sign' => $sign);
		$content = $this->juhecurl($this->submitUrl, $params, 1);
		return $this->_returnArray($content);
	}

	public function sta($orderid)
	{
		$params = 'key=' . $this->appkey . '&orderid=' . $orderid;
		$content = $this->juhecurl($this->staUrl, $params);
		return $this->_returnArray($content);
	}

	public function _returnArray($content)
	{
		return json_decode($content, true);
	}

	public function juhecurl($url, $params = false, $ispost = 0)
	{
		$httpInfo = array();
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($ch, CURLOPT_USERAGENT, 'JuheData');
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		if ($ispost) {
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
			curl_setopt($ch, CURLOPT_URL, $url);
		}
		else if ($params) {
			curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
		}
		else {
			curl_setopt($ch, CURLOPT_URL, $url);
		}

		$response = curl_exec($ch);

		if ($response === false) {
			return false;
		}

		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$httpInfo = array_merge($httpInfo, curl_getinfo($ch));
		curl_close($ch);
		return $response;
	}
}

?>