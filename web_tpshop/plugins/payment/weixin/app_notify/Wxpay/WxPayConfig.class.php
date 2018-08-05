<?php
//namespace Vendor\Wxpay;
/**
 *    配置账号信息
 */
use Think\Controller;
class WxPayConfig
{
    //保存类实例的静态成员变量

    public static $_instance;

    public static $APPID;
    public static $MCHID;
    public static $KEY;
    public static $APPSECRET = '';
    public static $NOTIFY_URL;

    //private标记的构造方法
    private function __construct($trade_type)
    {
        $code = '';
        if (!$trade_type || $trade_type == "APP") {
            $code = 'appWeixinPay';
        } elseif ($trade_type == 'JSAPI') {
            $code = 'miniAppPay';
        }
        $wxPay = M('plugin')->where(array('type'=>'payment','code'=>$code))->find();
        $wxPayVal = unserialize($wxPay['config_value']);
        self::$APPID = $wxPayVal['appid'];
        self::$MCHID = $wxPayVal['mchid'];
        self::$KEY = $wxPayVal['key'];
        self::$APPSECRET = $wxPayVal['appsecret'];
        $http = (!$_SERVER['HTTPS'] || $_SERVER['HTTPS'] == 'off') ? "http://" : "https://";
        self::$NOTIFY_URL = $http.$_SERVER["SERVER_NAME"].U('Api/Wxpay/notify');
    }

    //创建__clone方法防止对象被复制克隆
    public function __clone()
    {
        trigger_error('Clone is not allow!', E_USER_ERROR);
    }
    //单例方法,用于访问实例的公共的静态方法
    public static function getInstance($trade_type)
    {
        if (!(self::$_instance instanceof self)) {

            self::$_instance = new self($trade_type);

        }
        return self::$_instance;
    }
    public function test()
    {
        echo '调用方法成功';
    }
    //=======【基本信息设置】=====================================
    //
    /**
     * TODO: 修改这里配置为您自己申请的商户信息
     * 微信公众号信息配置
     *
     * APPID：应用APPID（必须配置，开户邮件中可查看）
     *
     * MCHID：微信支付商户号（必须配置，开户邮件中可查看）
     *
     * KEY：API密钥，参考开户邮件设置（必须配置，登录商户平台自行设置）
     * 设置地址：https://pay.weixin.qq.com/index.php/account/api_cert
     *
     */
//    const APPID = 'wx3ffebc5714c70a6f';
//    const MCHID = '1394181802';
//    const KEY = 'A1L0TMIKCJZ4O86XHB5PF29E3UWVDSGR';
//    const NOTIFY_URL = "www.xx.com/index.php/Api/Wxpay/notify";

    //=======【证书路径设置】=====================================
    /**
     * TODO：设置商户证书路径
     * 证书路径,注意应该填写绝对路径（仅退款、撤销订单时需要，可登录商户平台下载，
     * API证书下载地址：https://pay.weixin.qq.com/index.php/account/api_cert，下载之前需要安装商户操作证书）
     * @var path
     */
    const SSLCERT_PATH = '../../cert/apiclient_cert.pem';
    const SSLKEY_PATH = '../../cert/apiclient_key.pem';

    //=======【curl代理设置】===================================
    /**
     * TODO：这里设置代理机器，只有需要代理的时候才设置，不需要代理，请设置为0.0.0.0和0
     * 本例程通过curl使用HTTP POST方法，此处可修改代理服务器，
     * 默认CURL_PROXY_HOST=0.0.0.0和CURL_PROXY_PORT=0，此时不开启代理（如有需要才设置）
     * @var unknown_type
     */
    // const CURL_PROXY_HOST ="0.0.0.0";//"10.152.18.220"
    const CURLOPT_PROXY = '0.0.0.0';//"10.152.18.220"
    // const CURL_PROXY_PORT = 0;//8080;
    const CURLOPT_PROXYPORT = 0;//8080;

    //=======【上报信息配置】===================================
    /**
     * TODO：接口调用上报等级，默认紧错误上报（注意：上报超时间为【1s】，上报无论成败【永不抛出异常】，
     * 不会影响接口调用流程），开启上报之后，方便微信监控请求调用的质量，建议至少
     * 开启错误上报。
     * 上报等级，0.关闭上报; 1.仅错误出错上报; 2.全量上报
     * @var int
     */
    const REPORT_LEVENL = 1;
}
