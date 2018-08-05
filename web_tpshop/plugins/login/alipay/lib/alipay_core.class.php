
<?php
/* *
 * 功能：快捷登录接口接入页
 * 版本：3.3
 * 修改日期：2012-07-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

 *************************注意*************************
 * 如果您在接口集成过程中遇到问题，可以按照下面的途径来解决
 * 1、商户服务中心（https://b.alipay.com/support/helperApply.htm?action=consultationApply），提交申请集成协助，我们会有专业的技术工程师主动联系您协助解决
 * 2、商户帮助中心（http://help.alipay.com/support/232511-16307/0-16307.htm?sh=Y&info_type=9）
 * 3、支付宝论坛（http://club.alipay.com/read-htm-tid-8681712.html）
 * 如果不想使用扩展功能请把扩展功能参数赋空值。
 */
use think\Model; 
use think\Request;
class alipay extends Model{
	/**************************请求参数**************************/

	//目标服务地址
	public $target_service = "user.auth.quick.login";
	//必填
	//必填，页面跳转同步通知页面路径
	public $return_url;
	//需http://格式的完整路径，不允许加?id=123这类自定义参数

	//防钓鱼时间戳
	public $anti_phishing_key = "";
	//若要使用请调用类文件submit中的query_timestamp函数

	//客户端的IP地址
	public $exter_invoke_ip = "";
	//非局域网的外网IP地址，如：221.0.0.1
	public $parameter;
	public $alipay_config;
	/************************************************************/
	public function __construct($config){
//		$this->return_url = "http://".$_SERVER['HTTP_HOST']."/plugins/login/alipay/return_url.php";
//		$this->return_url = "http://".$_SERVER['HTTP_HOST']."/index.php/Home/ThirdLogin/callback/oauth/alipay";
		$this->return_url = "http://".$_SERVER['HTTP_HOST'].U('LoginApi/callback',array('oauth'=>'alipay'));
		

		$this->parameter = array(
			"service" => "alipay.auth.authorize",
			"partner" => trim($config['alipay_partner']),
			"target_service"	=> $this->target_service,
			"return_url"	=> $this->return_url,
			"anti_phishing_key"	=> $this->anti_phishing_key,
			"exter_invoke_ip"	=> $this->exter_invoke_ip,
			"_input_charset"	=> 'utf-8'
		);

		$this->alipay_config = array(
			'partner'=>$config['alipay_partner'],//合作身份者id，以2088开头的16位纯数字
			'key'=>$config['alipay_key'],//安全检验码，以数字和字母组成的32位字符
			'sign_type'=>'MD5',//签名方式 不需修改
			'input_charset'=>'utf-8',//字符编码格式 目前支持 gbk 或 utf-8
			'cacert'=>getcwd().'\\cacert.pem',//ca证书路径地址，用于curl中ssl校验
			'transport'=>'http',//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
		);
	}
	//构造要请求的参数数组，无需改动
	public function login(){
		require_once("lib/alipay_submit.class.php");
		$alipaySubmit = new AlipaySubmit($this->alipay_config);
		$html_text = $alipaySubmit->buildRequestForm($this->parameter,"get", "确认");
		echo $html_text;
	}

	public function respon(){
		unset($_GET['oauth']);
		require_once("lib/alipay_notify.class.php");
		$alipayNotify = new AlipayNotify($this->alipay_config);
		$verify_result = $alipayNotify->verifyReturn();
		if($verify_result) {//验证成功
			return array(
				'openid'=>$_GET['user_id'],//支付宝用户号
				'oauth'=>'alipay',
				'nickname'=>'支付宝用户',
			);
		}
		else {
			return false;
		}
	}

}


?>
