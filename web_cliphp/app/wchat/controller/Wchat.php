<?php
/**
 * Wchat.php
 * Niushop商城系统
 */

namespace app\wchat\controller;
use think\Controller;
use clt\WchatOauth;

class Wchat extends Controller
{
    public $wchat;
    public $weixin_service;
    public $author_appid;
    public $instance_id;
    public $style;
    public $token;
    public function _initialize()
    {
        parent::_initialize();
        $this->wchat = new WchatOauth(); // 微信公众号相关类
        $this->instance_id = 0;
        $value = db('wx_config')->where([ 'key' => 'SHOPWCHAT'])->value('value');
        $value = json_decode($value,true);
        $this->token = $value['token'];
        define("TOKEN", $this->token);
        $this->getMessage();
    }

    /**
     * ************************************************************************微信公众号消息相关方法 开始******************************************************
     */
    /**
     * 关联公众号微信
     */
    public function relateWeixin()
    {
        $sign = input('signature', '');
        if (defined("TOKEN") && isset($sign)) {
            $signature = $sign;
            $timestamp = input('timestamp');
            $nonce = input('nonce');
            $token = TOKEN;
            $tmpArr = array(
                $token,
                $timestamp,
                $nonce
            );
            sort($tmpArr, SORT_STRING);
            $tmpStr = implode($tmpArr);
            $tmpStr = sha1($tmpStr);
            if ($tmpStr == $signature) {
                $echostr = input('echostr', '');
                if (!empty($echostr)) {
                    echo $echostr;
                }
                return 1;
            } else {
                return 0;
            }
        }
    }

    public function templatemessage()
    {
        $media_id = input('media_id',0);
        $info = $this->getWeixinMediaDetailByMediaId($media_id);
        if (! empty($info["media_parent"])) {
            $this->assign("info", $info);
            return view();
        } else {
            echo "图文消息没有查询到";
        }
    }

    public function getWeixinMediaDetailByMediaId($media_id){
        $weixin_media_item =db('wx_media_item');
        $item_list = $weixin_media_item->where(['id' => $media_id])->find();
        if (!empty($item_list)) {
            // 主表
            $weixin_media = db('wx_media');
            $weixin_media_info["media_parent"] = $weixin_media->where(["media_id" => $item_list["media_id"] ])->find();

            // 微信配置
            $weixin_auth = db('wx_auth');
            $weixin_media_info["weixin_auth"] = $weixin_auth->where(["instance_id" => $weixin_media_info["media_parent"]["instance_id"]])->find();
            $weixin_media_info["media_item"] = $item_list;
            // 更新阅读次数
            $res = $weixin_media_item->where(["id" => $media_id])->update(["hits" => ($item_list["hits"] + 1)]);
            return $weixin_media_info;
        }
        return null;
    }

    /**
     * 微信开放平台模式(需要对消息进行加密和解密)
     * 微信获取消息以及返回接口
     */
    public function getMessage()
    {
	libxml_disable_entity_loader (false);
        $from_xml = file_get_contents('php://input');
        if (empty($from_xml)) {
            return;
        }
        $signature = input('msg_signature', '');
        $signature = input('timestamp', '');
        $nonce = input('nonce', '');
        $url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'];
        $ticket_xml = $from_xml;
        $postObj = simplexml_load_string($ticket_xml, 'SimpleXMLElement', LIBXML_NOCDATA);
        $this->instance_id = 0;
        if (!empty($postObj->MsgType)) {
            switch ($postObj->MsgType) {
                case "text":
                    //用户发的消息   存入表中
                    //$this->addUserMessage((string)$postObj->FromUserName, (string) $postObj->Content, (string) $postObj->MsgType);
                    $resultStr = $this->MsgTypeText($postObj);
                    break;
                case "event":
                    $resultStr = $this->MsgTypeEvent($postObj);
                    break;
                default:
                    $resultStr = "";
                    break;
            }
        }
        if (!empty($resultStr)) {
            echo $resultStr;
        } else {
            echo '';
        }
    }

    /**
     * 文本消息回复格式
     *
     * @param unknown $postObj
     * @return Ambigous <void, string>
     */
    private function MsgTypeText($postObj)
    {
        $funcFlag = 0; // 星标
        $wchat_replay = $this->wchat->getWhatReplay($this->instance_id, (string)$postObj->Content);

        // 判断用户输入text
        if (!empty($wchat_replay)) { // 关键词匹配回复
            $contentStr = $wchat_replay; // 构造media数据并返回
        } elseif ($postObj->Content == "uu") {
            $contentStr = "shopId：" . $this->instance_id;
        } elseif ($postObj->Content == "TESTCOMPONENT_MSG_TYPE_TEXT") {
            $contentStr = "TESTCOMPONENT_MSG_TYPE_TEXT_callback"; // 微店插件功能 关键词，预留口
        } elseif (strpos($postObj->Content, "QUERY_AUTH_CODE") !== false) {
            $get_str = str_replace("QUERY_AUTH_CODE:", "", $postObj->Content);
            $contentStr = $get_str . "_from_api"; // 微店插件功能 关键词，预留口
        } else {
            $content = $this->wchat->getDefaultReplay($this->instance_id);
            if (!empty($content)) {
                $contentStr = $content;
            } else {
                $contentStr = '欢迎！';
            }
        }
        if (is_array($contentStr)) {
            $resultStr = $this->wchat->event_key_news($postObj, $contentStr);
        } elseif (!empty($contentStr)) {
            $resultStr = $this->wchat->event_key_text($postObj, $contentStr);
        } else {
            $resultStr = '';
        }
        return $resultStr;
    }

    /**
     * 事件消息回复机制
     */
    // 事件自动回复 MsgType = Event
    private function MsgTypeEvent($postObj)
    {
        $contentStr = "";
        switch ($postObj->Event) {
            case "subscribe": // 关注公众号 添加关注回复
                $content = $this->wchat->getSubscribeReplay($this->instance_id);
                if (!empty($content)) {
                    $contentStr = $content;
                }
                // 构造media数据并返回
                break;
            case "unsubscribe": // 取消关注公众号
                break;
            case "VIEW": // VIEW事件 - 点击菜单跳转链接时的事件推送
                // $this->wchat->weichat_menu_hits_view($postObj->EventKey); //菜单计数
                $contentStr = "";
                break;
            case "SCAN": // SCAN事件 - 用户已关注时的事件推送
                $contentStr = "";
                break;
            case "CLICK": // CLICK事件 - 自定义菜单事件
                $menu_detail = $this->wchat->getWeixinMenuDetail($postObj->EventKey);
                $media_info = $this->wchat->getWeixinMediaDetail($menu_detail['media_id']);
                $contentStr = $this->wchat->getMediaWchatStruct($media_info); // 构造media数据并返回
                break;
            default:
                break;
        }
        // $contentStr = $postObj->Event."from_callback";//测试接口正式部署之后注释不要删除
        if (is_array($contentStr)) {
            $resultStr = $this->wchat->event_key_news($postObj, $contentStr);
        } else {
            $resultStr = $this->wchat->event_key_text($postObj, $contentStr);
        }
        return $resultStr;
    }
}
