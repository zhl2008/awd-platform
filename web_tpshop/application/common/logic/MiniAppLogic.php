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
 */

namespace app\common\logic;

/**
 * 小程序相关操作
 */
class MiniAppLogic
{
    private $config = []; //小程序配置
    private $errorMsg = '';  //错误字符串信息
    private $debug = false;   //是否开启调试
            
    public function __construct() 
    {
        $this->config = tpCache('miniapp');
    }
    
    public function getError() 
    {
        return $this->errorMsg;
    }
    
    private function setError($error)
    {
        if (!is_string($error)) {
            $error = json_encode($error, JSON_UNESCAPED_UNICODE);
        }
        $this->errorMsg = $error;
    }
    
    public function isDedug()
    {
        return $this->debug;
    }
    
    public function logDebugFile($content)
    {
        if (!$this->debug) {
            return;
        }
        if (!is_string($content)) {
            $content = json_encode($content, JSON_UNESCAPED_UNICODE);
        }
        file_put_contents("./miniapp.log", date('Y-m-d H:i:s').' -- '.$content."\n", FILE_APPEND);
    }
    
    /**
     * http请求
     * @param type $url
     * @param type $method
     * @param type $fields
     * @return 
     */
    private function httpRequest($url, $method = 'GET', $fields = [])
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

        $method = strtoupper($method);
        if ($method == 'GET' && !empty($fields)) {
            is_array($fields) && $fields = http_build_query($fields);
            $url = $url . (strpos($url,"?")===false ? "?" : "&") . $fields;
        }
        curl_setopt($ch, CURLOPT_URL, $url);

        if ($method != 'GET') {
            curl_setopt($ch, CURLOPT_POST, true);
            if (!empty($fields)) {
                if (is_array($fields)) {
                    $hadFile = false;
                    /* 支持文件上传 */
                    if (class_exists('\CURLFile')) {
                        curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
                        foreach ($fields as $key => $value) {
                            if ($this->isPostHasFile($value)) {
                                $fields[$key] = new \CURLFile(realpath(ltrim($value, '@')));
                                $hadFile = true;
                            }
                        }
                    } elseif (defined('CURLOPT_SAFE_UPLOAD')) {
                        if ($this->isPostHasFile($value)) {
                            curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
                            $hadFile = true;
                        }
                    }
                }
                $fields = (!$hadFile && is_array($fields)) ? http_build_query($fields) : $fields;
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            }
        }

        /* 关闭https验证 */
        if ("https" == substr($url, 0, 5)) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        $content = curl_exec($ch);
        curl_close($ch);

        return $content;
    }
    
    private function isPostHasFile($value)
    {
        if (is_string($value) && strpos($value, '@') === 0 && is_file(realpath(ltrim($value, '@')))) {
            return true;
        }
        return false;
    }
    
    private function requestAndCheck($url, $method = 'GET', $fields = [])
    {
        $return = $this->httpRequest($url, $method, $fields);
        if ($return === false) {
            $this->setError("http请求出错！");
            return false;
        }

        $wxdata = json_decode($return, true);
        $this->debug && $this->logDebugFile(['url' => $url,'fields' => $fields,'wxdata' => $wxdata]);
        if (isset($wxdata['errcode']) && $wxdata['errcode'] != 0) {
            if ($this->debug) {
                $this->setError("微信错误代码：{$wxdata['errcode']};<br>错误信息：{$wxdata['errmsg']}<br>请求链接：$url");
            } else {
                $this->setError("操作失败，微信错误码：{$wxdata['errcode']};");
            }
            return false;
        }

        if (strtoupper($method) === 'GET' && empty($wxdata)) {
            if ($this->debug) {
                $this->setError("微信http请求返回为空！请求链接：$url");
            } else {
                $this->setError("微信http请求返回为空！操作失败");
            }
            return false;
        }
        //返回{openid,expires_id,session_key,unionid}
        return $wxdata;
    }
    
    /**
     * 获取小程序session信息
     * @param string $code 登录码
     */
    public function getSessionInfo($code)
    {
        $wxPay = M('plugin')->where(array('type'=>'payment','code'=>'miniAppPay'))->find();
        $wxPayVal = unserialize($wxPay['config_value']);
        $appId = $wxPayVal['appid'];
        $appSecret = $wxPayVal['appsecret'];
        if (!$appId || !$appSecret) {
            $this->setError('后台还未配置小程序');
            return false;
        }
        
        $fields = [
            'appid' => $appId,
            'secret' => $appSecret,
            'js_code' => $code,
            'grant_type' => 'authorization_code'
        ];
        $url = 'https://api.weixin.qq.com/sns/jscode2session';
        $return = $this->requestAndCheck($url, 'GET', $fields);
        if ($return === false) {
            return false;
        }
        
        return $return;
    }
    
}