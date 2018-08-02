<?php
namespace clt;
/**
 * 功能说明：微信基本功能测试编码，通过此页面可以获取通过开放平台得到的公众号会话（token）以及公众号对应的appid
 * 创建人：李广
 * 创建时间：2016-2-26
 */
class WchatOauth
{
    public $author_appid;

    public $token;
    /**
     * 构造函数
     *
     * @param unknown $shop_id
     */
    public function __construct($appid = '')
    {
        $this->author_appid = 'instanceid_0';
    }
    /**
     * ***********************************************************************基础信息*************************************************
     */
    /**
     * 公众号获取access_token
     *
     * @return unknown
     */
    private function get_access_token()
    {
        // 公众平台模式获取token
        $token = $this->single_get_access_token();
        return $token;
    }

    /**
     * 公众平台账户获取token
     */
    private function single_get_access_token()
    {
        $wchat_config = db('wx_config')->where(['key' => 'SHOPWCHAT', 'instance_id' => 0])->field('value')->find();
        if (empty($wchat_config['value'])) {
            return array(
                'value' => array(
                    'appid' => '',
                    'appsecret' => ''
                ),
                'is_use' => 1
            );
        } else {
            $wchat_config['value'] = json_decode($wchat_config['value'], true);
        }
        $url ='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$wchat_config['value']['appid'].'&secret='.$wchat_config['value']['appsecret'];
        $a = httpRequest($url,'GET');
        $strjson = json_decode($a);
        if($strjson == false || empty($strjson)) {
            return '';
        }else{
            $token = $strjson->access_token;
            if (empty($token)) {} else {
                // 注意如果是多用户需要
                cache('token-' . $this->author_appid, $token, 3600);
            }
            return $token;
        }
    }
    //创建菜单
    public function menu_create($jsonmenu)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=%s";
        $result = $this->get_url_return($url, $jsonmenu);
        return $result;
    }
    /**
     * 微信数据获取
     *
     * @param unknown $url
     * @param unknown $data
     * @param string $needToken
     * @return string|unknown
     */
    private function get_url_return($url, $data = '', $needToken = false)
    {
        // 第一次为空，则从文件中读取
        if (empty($this->token)) {
            $this->token = cache('token-' . $this->author_appid);
        }
        // 为空则重新取值
        if (empty($this->token) or $needToken) {
            $this->get_access_token();
            $this->token = cache('token-' . $this->author_appid);
        }
        $newurl = sprintf($url, $this->token);
        $curl = curl_init(); // 创建一个新url资源
        curl_setopt($curl, CURLOPT_URL, $newurl);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (! empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $AjaxReturn = curl_exec($curl);
        // curl_close();
        $strjson = json_decode($AjaxReturn);
        if (! empty($strjson->errcode)) {
            switch ($strjson->errcode) {
                case 40001:
                    return $this->get_url_return($url, $data, true); // 获取access_token时AppSecret错误，或者access_token无效
                    break;
                case 40014:
                    return $this->get_url_return($url, $data, true); // 不合法的access_token
                    break;
                case 42001:
                    return $this->get_url_return($url, $data, true); // access_token超时
                    break;
                case 45009:
                    return json_encode(array(
                        "errcode" => - 45009,
                        "errmsg" => "接口调用超过限制：" . $strjson->errmsg
                    ));
                    break;
                case 41001:
                    return json_encode(array(
                        "errcode" => - 41001,
                        "errmsg" => "缺少access_token参数：" . $strjson->errmsg
                    ));
                    break;
                default:
                    return json_encode(array(
                        "errcode" => $strjson->errcode,
                        "errmsg" => $strjson->errmsg
                    )); // 其他错误，抛出
                    break;
            }
        } else {
            return $AjaxReturn;
        }
    }
    /**
     * ***********************************************************************基础信息*************************************************
     */
    /**
     * *************************************************微信回复消息部分 开始**************************************
     */
    /**
     * 返回文本消息组装xml
     *
     * @param unknown $postObj
     * @param unknown $content
     * @param number $funcFlag
     * @return string
     */
    public function event_key_text($postObj, $content, $funcFlag = 0)
    {
        if (! empty($content)) {
            $xmlTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[text]]></MsgType>
                            <Content><![CDATA[%s]]></Content>
                            <FuncFlag>%d</FuncFlag>
                        </xml>";
            $resultStr = sprintf($xmlTpl, $postObj->FromUserName, $postObj->ToUserName, time(), $content, $funcFlag);
            return $resultStr;
        }else{
            return '';
        }
    }

    /**
     * 返回图文消息组装xml
     *
     * @param unknown $postObj
     * @param unknown $arr_item
     * @param number $funcFlag
     * @return void|string
     */
    public function event_key_news($postObj, $arr_item, $funcFlag = 0)
    {
        // 首条标题28字，其他标题39字
        if (! is_array($arr_item)) {
            return;
        }
        $itemTpl = "<item>
                        <Title><![CDATA[%s]]></Title>
                        <Description><![CDATA[%s]]></Description>
                        <PicUrl><![CDATA[%s]]></PicUrl>
                        <Url><![CDATA[%s]]></Url>
                    </item>
                ";
        $item_str = "";
        foreach ($arr_item as $item) {
            $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
        }
        $newsTpl = "<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[news]]></MsgType>
        <Content><![CDATA[]]></Content>
        <ArticleCount>%s</ArticleCount>
        <Articles>$item_str</Articles>
        <FuncFlag>%s</FuncFlag>
        </xml>";
        $resultStr = sprintf($newsTpl, $postObj->FromUserName, $postObj->ToUserName, time(), count($arr_item), $funcFlag);
        return $resultStr;
    }

    /**
     * *************************************************微信回复消息部分 结束******************************************************************************
     */

    /**
     * 功能说明：从微信选择地址 - 创建签名SHA1
     *
     * @param array $Parameters
     *            string1加密
     */
    public function sha1_sign($Parameters)
    {
        $signPars = '';
        ksort($Parameters);
        foreach ($Parameters as $k => $v) {
            if ("" != $v && "sign" != $k) {
                if ($signPars == '')
                    $signPars .= $k . "=" . $v;
                else
                    $signPars .= "&" . $k . "=" . $v;
            }
        }
        $sign = sha1($signPars);
        return $sign;
    }

    /**
     * 产生随机字符串，不长于32位
     *
     * @param int $length
     * @return 产生的随机字符串
     */
    public function get_nonce_str($length = 32)
    {
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i ++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    /**
     * 格式化参数格式化成url参数
     */
    public function to_url_param()
    {
        $buff = "";
        foreach ($this->values as $k => $v) {
            if ($k != "sign" && $v != "" && ! is_array($v)) {
                $buff .= $k . "=" . $v . "&";
            }
        }
        $buff = trim($buff, "&");
        return $buff;
    }

    /**
     * *****************获取消息*************************************************
     */
    /**
     * 获取关注回复
     *
     * @param unknown $instance_id
     * @return unknown|string
     */
    public function getSubscribeReplay($instance_id)
    {
        $weixin_flow_replay = db('wx_follow_replay');
        $info = $weixin_flow_replay->where(['instance_id'=>$instance_id])->find();
        if (! empty($info)) {
            $media_detail = $this->getWeixinMediaDetail($info['reply_media_id']);
            $content = $this->getMediaWchatStruct($media_detail);
            return $content;
        } else {
            return '';
        }
    }
    public function getWeixinMediaDetail($media_id)
    {
        $weixin_media = db('wx_media');
        $weixin_media_info = $weixin_media->where(['media_id'=>$media_id])->find();
        if (! empty($weixin_media_info)) {
            $weixin_media_item = db('wx_media_item');
            $item_list = $weixin_media_item->where(['media_id' => $media_id])->select();
            $weixin_media_info['item_list'] = $item_list;
        }
        return $weixin_media_info;
    }
    /**
     * // 构造media数据并返回
     * // media_type 消息素材类型1文本 2单图文 3多图文',(non-PHPdoc)
     *
     * @see \ata\api\IWeixin::getMediaWchatStruct()
     */
    public function getMediaWchatStruct($media_info){
        switch ($media_info['type']) {
            case "1":
                $contentStr = trim($media_info['title']);
                break;
            case "2":
                $contentStr[] = array(
                    "Title" => $media_info['item_list'][0]['title'],
                    "Description" => $media_info['item_list'][0]['summary'],
                    "PicUrl" => 'http://' . $_SERVER['HTTP_HOST'] . '/public/' . $media_info['item_list'][0]['cover'],
                    "Url" => url('templatemessage',['media_id'=>$media_info['item_list'][0]['id']],'',true)
                );
                break;
            case "3":
                $contentStr = array();
                foreach ($media_info['item_list'] as $k => $v) {
                    $contentStr[$k] = array(
                        "Title" => $v['title'],
                        "Description" => $v['summary'],
                        "PicUrl" => 'http://' . $_SERVER['HTTP_HOST'] . '/public/' . $v['cover'],
                        "Url" => url( 'templatemessage',['media_id'=>$v['id']],'',true)
                    );
                }
                break;
            default:
                $contentStr = "";
                break;
        }
        return $contentStr;
    }

    /**
     * 获取关键字回复
     *
     * @param unknown $key_words
     */
    public function getWhatReplay($instance_id, $key_words)
    {
        $weixin_key_replay = db('wx_key_replay');
        // 全部匹配
        $condition = array(
            'instance_id' => $instance_id,
            'key' => $key_words,
            'match_type' => 2
        );
        $info = $weixin_key_replay->where($condition)->find();
        if (empty($info)) {
            // 模糊匹配
            $condition = array(
                'instance_id' => $instance_id,
                'key' => array('LIKE', '%' . $key_words . '%'),
                'match_type' => 1
            );
            $info = $weixin_key_replay->where($condition)->find();
        }
        if (! empty($info)) {
            $media_detail = $this->getWeixinMediaDetail($info['reply_media_id']);
            $content = $this->getMediaWchatStruct($media_detail);
            return $content;
        } else {
            return '';
        }
    }
    /**
     * 默认回复
     * @see getDefaultReplay()
     */
    public function getDefaultReplay($instance_id){
        $weixin_default_replay = db('wx_default_replay');
        $info = $weixin_default_replay->where(['instance_id' => $instance_id])->find();
        if (!empty($info)) {
            $media_detail = $this->getWeixinMediaDetail($info['reply_media_id']);
            $content = $this->getMediaWchatStruct($media_detail);
            return $content;
        } else {
            return '';
        }
    }
    /**
     * ************************菜单点击****************************************************************
     */
    /*
     * 点击
     * @see \ata\api\IWeixin::getWeixinMenuDetail()
     */
    public function getWeixinMenuDetail($menu_id)
    {
        $weixin_menu = db('wx_menu');
        $data = $weixin_menu->where(['menu_id'=>$menu_id])->find();
        return $data;
    }
}