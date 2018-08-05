<?php
//namespace Vendor\Wxpay;
require_once "WxPayDataBase.class.php";
/**
 *
 * 下载对账单输入对象
 * @author widyhu
 *
 */
class WxPayDownloadBill extends WxPayDataBase
{
	/**
	 * 设置微信分配的公众账号ID
	 * @param string $value
	 **/
	public function SetAppid($value)
	{
		$this->values['appid'] = $value;
	}
	/**
	 * 获取微信分配的公众账号ID的值
	 * @return 值
	 **/
	public function GetAppid()
	{
		return $this->values['appid'];
	}
	/**
	 * 判断微信分配的公众账号ID是否存在
	 * @return true 或 false
	 **/
	public function IsAppidSet()
	{
		return array_key_exists('appid', $this->values);
	}


	/**
	 * 设置微信支付分配的商户号
	 * @param string $value
	 **/
	public function SetMch_id($value)
	{
		$this->values['mch_id'] = $value;
	}
	/**
	 * 获取微信支付分配的商户号的值
	 * @return 值
	 **/
	public function GetMch_id()
	{
		return $this->values['mch_id'];
	}
	/**
	 * 判断微信支付分配的商户号是否存在
	 * @return true 或 false
	 **/
	public function IsMch_idSet()
	{
		return array_key_exists('mch_id', $this->values);
	}


	/**
	 * 设置微信支付分配的终端设备号，填写此字段，只下载该设备号的对账单
	 * @param string $value
	 **/
	public function SetDevice_info($value)
	{
		$this->values['device_info'] = $value;
	}
	/**
	 * 获取微信支付分配的终端设备号，填写此字段，只下载该设备号的对账单的值
	 * @return 值
	 **/
	public function GetDevice_info()
	{
		return $this->values['device_info'];
	}
	/**
	 * 判断微信支付分配的终端设备号，填写此字段，只下载该设备号的对账单是否存在
	 * @return true 或 false
	 **/
	public function IsDevice_infoSet()
	{
		return array_key_exists('device_info', $this->values);
	}


	/**
	 * 设置随机字符串，不长于32位。推荐随机数生成算法
	 * @param string $value
	 **/
	public function SetNonce_str($value)
	{
		$this->values['nonce_str'] = $value;
	}
	/**
	 * 获取随机字符串，不长于32位。推荐随机数生成算法的值
	 * @return 值
	 **/
	public function GetNonce_str()
	{
		return $this->values['nonce_str'];
	}
	/**
	 * 判断随机字符串，不长于32位。推荐随机数生成算法是否存在
	 * @return true 或 false
	 **/
	public function IsNonce_strSet()
	{
		return array_key_exists('nonce_str', $this->values);
	}

	/**
	 * 设置下载对账单的日期，格式：20140603
	 * @param string $value
	 **/
	public function SetBill_date($value)
	{
		$this->values['bill_date'] = $value;
	}
	/**
	 * 获取下载对账单的日期，格式：20140603的值
	 * @return 值
	 **/
	public function GetBill_date()
	{
		return $this->values['bill_date'];
	}
	/**
	 * 判断下载对账单的日期，格式：20140603是否存在
	 * @return true 或 false
	 **/
	public function IsBill_dateSet()
	{
		return array_key_exists('bill_date', $this->values);
	}


	/**
	 * 设置ALL，返回当日所有订单信息，默认值SUCCESS，返回当日成功支付的订单REFUND，返回当日退款订单REVOKED，已撤销的订单
	 * @param string $value
	 **/
	public function SetBill_type($value)
	{
		$this->values['bill_type'] = $value;
	}
	/**
	 * 获取ALL，返回当日所有订单信息，默认值SUCCESS，返回当日成功支付的订单REFUND，返回当日退款订单REVOKED，已撤销的订单的值
	 * @return 值
	 **/
	public function GetBill_type()
	{
		return $this->values['bill_type'];
	}
	/**
	 * 判断ALL，返回当日所有订单信息，默认值SUCCESS，返回当日成功支付的订单REFUND，返回当日退款订单REVOKED，已撤销的订单是否存在
	 * @return true 或 false
	 **/
	public function IsBill_typeSet()
	{
		return array_key_exists('bill_type', $this->values);
	}
}



?>