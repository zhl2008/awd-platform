<?php
//namespace Vendor\Wxpay;
require_once "Exception.class.php";
/*
*
 * 
 * 微信支付API异常类
 * @author widyhu
 *
 */
class WxPayException extends Exception {

//public function __construct($message, $code = 0) {
// 自定义的代码
// 确保所有变量都被正确赋值
//parent::__construct($message, $code);
//} 

/* public function __toString() {
return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
}  */



	public function errorMessage()
	{
		return $this->getMessage();
	} 
}
