<?php
/**
 * tpshop
 * ============================================================================
 * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 采用TP5助手函数可实现单字母函数M D U等,也可db::name方式,可双向兼容
 * ============================================================================
 * Author: lhb
 * Date: 2017-06-17
 */

namespace app\common\logic;

/**
 * Description of SmsLogic
 *
 * 短信类
 */
class SmsLogic 
{
    private $config;
    
    public function __construct() 
    {
        $this->config = tpCache('sms') ?: [];
    }

    /**
     * 发送短信逻辑
     * @param unknown $scene
     */
    public function sendSms($scene, $sender, $params, $unique_id=0)
    {
        $smsTemp = M('sms_template')->where("send_scene", $scene)->find();    //用户注册.
        $code = !empty($params['code']) ? $params['code'] : false;
        $consignee = !empty($params['consignee']) ? $params['consignee'] : false;
        $user_name = !empty($params['user_name']) ? $params['user_name'] : false;
        $mobile = !empty($params['mobile']) ? $params['mobile'] : false;
        $order_id = $params['order_id']; 
        if(empty($unique_id)){
            $session_id = session_id();
        }else{
            $session_id = $unique_id;
        }
        $smsParams = array(
            1 => "{\"code\":\"$code\"}",                                                                                                          //1. 用户注册 (验证码类型短信只能有一个变量)
            2 => "{\"code\":\"$code\"}",                                                                                                          //2. 用户找回密码 (验证码类型短信只能有一个变量)
            3 => "{\"consignee\":\"$consignee\",\"phone\":\"$mobile\"}",                                                       //3. 客户下单
            4 => "{\"order_id\":\"$order_id\"}",                                                                                                //4. 客户支付
            5 => "{\"user_name\":\"$user_name\",\"consignee\":\"$consignee\"}",                                           //5. 商家发货
            6 => "{\"code\":\"$code\"}",                                                                                                           //6. 修改手机号码 (验证码类型短信只能有一个变量)
        );
        
        $smsParam = $smsParams[$scene];

        //提取发送短信内容
        $scenes = C('SEND_SCENE');
        $msg = $scenes[$scene][1];
        $params_arr = json_decode($smsParam);
        foreach ($params_arr as $k => $v) {
            $msg = str_replace('${' . $k . '}', $v, $msg);
        }

        //发送记录存储数据库
        $log_id = M('sms_log')->insertGetId(array('mobile' => $sender, 'code' => $code, 'add_time' => time(), 'session_id' => $session_id, 'status' => 0, 'scene' => $scene, 'msg' => $msg));
        if ($sender != '' && check_mobile($sender)) {//如果是正常的手机号码才发送
            try {
                $resp = $this->realSendSms($sender, $smsTemp['sms_sign'], $smsParam, $smsTemp['sms_tpl_code']);
            } catch (\Exception $e) {
                $resp = ['status' => -1, 'msg' => $e->getMessage()];
            }
            if ($resp['status'] == 1) {
                M('sms_log')->where(array('id' => $log_id))->save(array('status' => 1)); //修改发送状态为成功
            }else{
                M('sms_log')->where(array('id' => $log_id))->update(array('error_msg'=>$resp['msg'])); //发送失败, 将发送失败信息保存数据库
            }
            return $resp;
        } else {
           return $result = ['status' => -1, 'msg' => '接收手机号不正确['.$sender.']'];
        }
        
    }

    private function realSendSms($mobile, $smsSign, $smsParam, $templateCode)
    {
        $type = (int)$this->config['sms_platform'] ?: 0;
        switch($type) {
            case 0:
                $result = $this->sendSmsByAlidayu($mobile, $smsSign, $smsParam, $templateCode);
                break;
            case 1:
                $result = $this->sendSmsByAliyun($mobile, $smsSign, $smsParam, $templateCode);
                break;
            default:
                $result = ['status' => -1, 'msg' => '不支持的短信平台'];
        }
        
        return $result;
    }
    
    /**
     * 发送短信（阿里大于）
     * @param $mobile  手机号码
     * @param $code    验证码
     * @return bool    短信发送成功返回true失败返回false
     */
    private function sendSmsByAlidayu($mobile, $smsSign, $smsParam, $templateCode)
    {
        //时区设置：亚洲/上海
        date_default_timezone_set('Asia/Shanghai');
        //这个是你下面实例化的类
        vendor('Alidayu.TopClient');
        //这个是topClient 里面需要实例化一个类所以我们也要加载 不然会报错
        vendor('Alidayu.ResultSet');
        //这个是成功后返回的信息文件
        vendor('Alidayu.RequestCheckUtil');
        //这个是错误信息返回的一个php文件
        vendor('Alidayu.TopLogger');
        //这个也是你下面示例的类
        vendor('Alidayu.AlibabaAliqinFcSmsNumSendRequest');

        $c = new \TopClient;
        //App Key的值 这个在开发者控制台的应用管理点击你添加过的应用就有了
        $c->appkey = $this->config['sms_appkey'];
        //App Secret的值也是在哪里一起的 你点击查看就有了
        $c->secretKey = $this->config['sms_secretKey'];
        //这个是用户名记录那个用户操作
        $req = new \AlibabaAliqinFcSmsNumSendRequest;
        //代理人编号 可选
        $req->setExtend("123456");
        //短信类型 此处默认 不用修改
        $req->setSmsType("normal");
        //短信签名 必须
        $req->setSmsFreeSignName($smsSign);
        //短信模板 必须
        $req->setSmsParam($smsParam);
        //短信接收号码 支持单个或多个手机号码，传入号码为11位手机号码，不能加0或+86。群发短信需传入多个号码，以英文逗号分隔，
        $req->setRecNum("$mobile");
        //短信模板ID，传入的模板必须是在短信平台“管理中心-短信模板管理”中的可用模板。
        $req->setSmsTemplateCode($templateCode); // templateCode

        $c->format = 'json';
        //发送短信
        $resp = $c->execute($req);
        //短信发送成功返回True，失败返回false
        if ($resp && $resp->result) {
            return array('status' => 1, 'msg' => $resp->sub_msg);
        } else {
            return array('status' => -1, 'msg' => $resp->msg . ' ,sub_msg :' . $resp->sub_msg . ' subcode:' . $resp->sub_code);
        }
    }

    /**
     * 发送短信（阿里云短信）
     * @param $mobile  手机号码
     * @param $code    验证码
     * @return bool    短信发送成功返回true失败返回false
     */
    private function sendSmsByAliyun($mobile, $smsSign, $smsParam, $templateCode)
    {
        include_once './vendor/aliyun-php-sdk-core/Config.php';
        include_once './vendor/Dysmsapi/Request/V20170525/SendSmsRequest.php';
        
        $accessKeyId = $this->config['sms_appkey'];
        $accessKeySecret = $this->config['sms_secretKey'];
        
        //短信API产品名
        $product = "Dysmsapi";
        //短信API产品域名
        $domain = "dysmsapi.aliyuncs.com";
        //暂时不支持多Region
        $region = "cn-hangzhou";

        //初始化访问的acsCleint
        $profile = \DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);
        \DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", $product, $domain);
        $acsClient= new \DefaultAcsClient($profile);

        $request = new \Dysmsapi\Request\V20170525\SendSmsRequest;
        //必填-短信接收号码
        $request->setPhoneNumbers($mobile);
        //必填-短信签名
        $request->setSignName($smsSign);
        //必填-短信模板Code
        $request->setTemplateCode($templateCode);
        //选填-假如模板中存在变量需要替换则为必填(JSON格式)
        $request->setTemplateParam($smsParam);
        //选填-发送短信流水号
        //$request->setOutId("1234");

        //发起访问请求
        $resp = $acsClient->getAcsResponse($request);
        
        //短信发送成功返回True，失败返回false
        if ($resp && $resp->Code == 'OK') {
            return array('status' => 1, 'msg' => $resp->Code);
        } else {
            return array('status' => -1, 'msg' => $resp->Message . '. Code: ' . $resp->Code);
        }
    }    
}
