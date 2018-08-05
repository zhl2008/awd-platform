<?php
/**
 * tpshop
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
 * 参考地址 http://www.cnblogs.com/txw1958/p/weixin-js-sharetimeline.html
 * http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html  微信JS-SDK说明文档
 */
namespace app\common\logic;
use think\Model;
/**
 * 分类逻辑定义
 * Class CatsLogic
 * @package common\Logic
 */
class JssdkLogic extends Model
{
 
  private $appId;
  private $appSecret;

  public function __construct($appId, $appSecret) {
    $this->appId = $appId;
    $this->appSecret = $appSecret;
  }
  // 签名
  public function getSignPackage($url='') {
    $jsapiTicket = $this->getJsApiTicket();

    // 注意 URL 一定要动态获取，不能 hardcode.
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $url = empty($url) ? "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" : $url;

    $timestamp = time();
    $nonceStr = $this->createNonceStr();

    // 这里参数的顺序要按照 key 值 ASCII 码升序排序
    $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

    $signature = sha1($string);

    $signPackage = array(
      "appId"     => $this->appId,
      "nonceStr"  => $nonceStr,
      "timestamp" => $timestamp,
      "url"       => $url,
      "rawString" => $string,
      "signature" => $signature
      
    );
    return $signPackage; 
  }
// 随机字符串
  private function createNonceStr($length = 16) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
      $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
  }


    /**
     * 根据 access_token 获取 icket
     * @return type
     */
    public function getJsApiTicket(){        
        
        $ticket = S('ticket');
        if(!empty($ticket))
            return $ticket;
        
        $access_token = $this->get_access_token();
        $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token={$access_token}&type=jsapi";
        $return = httpRequest($url,'GET');
        $return = json_decode($return,1);        
        S('ticket',$return['ticket'],7000);
        return $return['ticket'];
    }     
      
  
    /**
     * 获取 网页授权登录access token
     * @return type
     */
    public function getAccessToken(){
        //判断是否过了缓存期
        $access_token = S('access_token');
        if(!empty($access_token))
            return $access_token;
        
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->appId}&secret={$this->appSecret}";
        $return = httpRequest($url,'GET');
        $return = json_decode($return,1);
        S('access_token',$return['access_token'],7000);        
        return $return['access_token'];
    }    
    
    // 获取一般的 access_token
    public function get_access_token(){
        //判断是否过了缓存期
        $wechat = M('wx_user')->find();
        $expire_time = $wechat['web_expires'];
        if($expire_time > time()){
           return $wechat['web_access_token'];
        }
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$wechat['appid']}&secret={$wechat['appsecret']}";
        $return = httpRequest($url,'GET');
        $return = json_decode($return,1);
        $web_expires = time() + 7000; // 提前200秒过期
        M('wx_user')->where(array('id'=>$wechat['id']))->save(array('web_access_token'=>$return['access_token'],'web_expires'=>$web_expires));
        return $return['access_token'];
    }   
    
    /*
     * 向用户推送消息
     */
    public function push_msg($openid,$content){
        $access_token = $this->get_access_token();
        $url ="https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token={$access_token}";        
        $post_arr = array(
                        'touser'=>$openid,
                        'msgtype'=>'text',
                        'text'=>array(
                                'content'=>$content,
                            )
                        );
        $post_str = json_encode($post_arr,JSON_UNESCAPED_UNICODE);        
        $return = httpRequest($url,'POST',$post_str);
        $return = json_decode($return,true);        
    }
 
    public function send_template_message($order){
    	$access_token = $this->get_access_token();
    	$url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token={$access_token}";
    	$open_id = M('users')->where(array('user_id'=>$order['user_id']))->getField('openid');
    	error_log($open_id.date('Ymd H:i:s'),3,'test.log');
    	if(!empty($open_id)){
    		$tempalte = array(
    				'touser'=>$open_id,
    				'template_id'=>'GiApFXcJXrxslu-_0S3Ynn56NP3emHVttcAieUfDEog',
    				'url' => SITE_URL.'/mobile', //点击后跳转地址
    				'topcolor'=>'#7B68EE',
    				'data' => array(
    						'first'  => array('value'=>urlencode("您好，您的订单已支付成功"),'color'=>'#743A3A'),
    						'product'=> array('value'=>urlencode($order['goods_name']),'color'=>"#173177"),
    						'price'  => array('value'=>urlencode($order['total_amount']."元"),'color'=>"#173177"),
    						'time'   => array('value'=>urlencode(date("Y年m月d日  H:i:s")),'color'=>"#173177"),
    						'remark' => array('value'=>urlencode("您的订单已提交，我们将尽快发货。祝您生活愉快"),'color'=>"#173177"),
    				));
    		$json_template = json_encode($tempalte);
    		$res = httpRequest($url,'post',urldecode($json_template));
    		return json_decode($res,true);
    	}
    }
}