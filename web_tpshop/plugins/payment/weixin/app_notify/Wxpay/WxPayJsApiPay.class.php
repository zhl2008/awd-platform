<?php
//namespace Vendor\Wxpay;
require_once "WxPayDataBase.class.php";
/**
 *
 * 提交JSAPI输入对象
 * @author widyhu
 *
 */
class WxPayJsApiPay extends WxPayDataBase
{
	/**
	 * 设置微信分配的公众账号ID
	 * @param string $value
	 **/
	public function SetAppid($value)
	{
		$this->values['appId'] = $value;
	}
	/**
	 * 获取微信分配的公众账号ID的值
	 * @return 值
	 **/
	public function GetAppid()
	{
		return $this->values['appId'];
	}
	/**
	 * 判断微信分配的公众账号ID是否存在
	 * @return true 或 false
	 **/
	public function IsAppidSet()
	{
		return array_key_exists('appId', $this->values);
	}


	/**
	 * 设置支付时间戳
	 * @param string $value
	 **/
	public function SetTimeStamp($value)
	{
		$this->values['timeStamp'] = $value;
	}
	/**
	 * 获取支付时间戳的值
	 * @return 值
	 **/
	public function GetTimeStamp()
	{
		return $this->values['timeStamp'];
	}
	/**
	 * 判断支付时间戳是否存在
	 * @return true 或 false
	 **/
	public function IsTimeStampSet()
	{
		return array_key_exists('timeStamp', $this->values);
	}

	/**
	 * 随机字符串
	 * @param string $value
	 **/
	public function SetNonceStr($value)
	{
		$this->values['nonceStr'] = $value;
	}
	/**
	 * 获取notify随机字符串值
	 * @return 值
	 **/
	public function GetReturn_code()
	{
		return $this->values['nonceStr'];
	}
	/**
	 * 判断随机字符串是否存在
	 * @return true 或 false
	 **/
	public function IsReturn_codeSet()
	{
		return array_key_exists('nonceStr', $this->values);
	}


	/**
	 * 设置订单详情扩展字符串
	 * @param string $value
	 **/
	public function SetPackage($value)
	{
		$this->values['package'] = $value;
	}
	/**
	 * 获取订单详情扩展字符串的值
	 * @return 值
	 **/
	public function GetPackage()
	{
		return $this->values['package'];
	}
	/**
	 * 判断订单详情扩展字符串是否存在
	 * @return true 或 false
	 **/
	public function IsPackageSet()
	{
		return array_key_exists('package', $this->values);
	}

	/**
	 * 设置签名方式
	 * @param string $value
	 **/
	public function SetSignType($value)
	{
		$this->values['signType'] = $value;
	}
	/**
	 * 获取签名方式
	 * @return 值
	 **/
	public function GetSignType()
	{
		return $this->values['signType'];
	}
	/**
	 * 判断签名方式是否存在
	 * @return true 或 false
	 **/
	public function IsSignTypeSet()
	{
		return array_key_exists('signType', $this->values);
	}

	/**
	 * 设置签名方式
	 * @param string $value
	 **/
	public function SetPaySign($value)
	{
		$this->values['paySign'] = $value;
	}
	/**
	 * 获取签名方式
	 * @return 值
	 **/
	public function GetPaySign()
	{
		return $this->values['paySign'];
	}
	/**
	 * 判断签名方式是否存在
	 * @return true 或 false
	 **/
	public function IsPaySignSet()
	{
		return array_key_exists('paySign', $this->values);
	}
}




?>