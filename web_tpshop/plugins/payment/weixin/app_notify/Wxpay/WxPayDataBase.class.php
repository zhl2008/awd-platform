<?php
//namespace Vendor\Wxpay;

require_once "WxPayConfig.class.php";
/**
 *
 * 数据对象基础类，该类中定义数据类最基本的行为，包括：
 * 计算/设置/获取签名、输出xml格式的参数、从xml读取数据对象等
 * @author widyhu
 *
 */
class WxPayDataBase
{
	protected $values = array();
	/**
	 * 设置签名，详见签名生成算法
	 * @param string $value
	 **/
	public function SetSign()
	{
		$sign = $this->MakeSign();
		$this->values['sign'] = $sign;
		return $sign;
	}

	/**
	 * 获取签名，详见签名生成算法的值
	 * @return 值
	 **/
	public function GetSign()
	{
		return $this->values['sign'];
	}

	/**
	 * 判断签名，详见签名生成算法是否存在
	 * @return true 或 false
	 **/
	public function IsSignSet()
	{
		return array_key_exists('sign', $this->values);
	}

	/**
	 * 输出xml字符
	 * @throws Exception
	 **/
	public function ToXml()
	{
		if(!is_array($this->values)
				|| count($this->values) <= 0)
		{
			echo"数组数据异常！";
		}

		$xml = "<xml>";
		foreach ($this->values as $key=>$val)
		{
			if (is_numeric($val)){
				$xml.="<".$key.">".$val."</".$key.">";
			}else{
				$xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
			}
		}
		$xml.="</xml>";
		return $xml;
	}

	/**
	 * 将xml转为array
	 * @param string $xml
	 * @throws Exception
	 */
	public function FromXml($xml)
	{
		if(!$xml){
			echo "xml数据异常！";
		}
		//将XML转为array
		//禁止引用外部xml实体
		libxml_disable_entity_loader(true);
		$this->values = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
		return $this->values;
	}

	/**
	 * 格式化参数格式化成url参数
	 */
	public function ToUrlParams()
	{
		$buff = "";
		foreach ($this->values as $k => $v)
		{
			if($k != "sign" && $v != "" && !is_array($v)){
				$buff .= $k . "=" . $v . "&";
			}
		}

		$buff = trim($buff, "&");
		return $buff;
	}

	/**
	 * 生成签名
	 * @return 签名，本函数不覆盖sign成员变量，如要设置签名需要调用SetSign方法赋值
	 */
	public function MakeSign()
	{
		//签名步骤一：按字典序排序参数
		ksort($this->values);
		$string = $this->ToUrlParams();
		//签名步骤二：在string后加入KEY
		$string = $string . "&key=".WxPayConfig::$KEY;
		//签名步骤三：MD5加密
		$string = md5($string);
		//签名步骤四：所有字符转为大写
		$result = strtoupper($string);
		return $result;
	}

	/**
	 * 获取设置的值
	 */
	public function GetValues()
	{
		return $this->values;
	}
}
