<?php

/**
 * tpshop
 * ============================================================================
 * 版权所有 2017-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * author: lhb
 * Date: 2017-5-8
 */
namespace app\common\util;

/**
 * 微信公众号操作类
 */
class WechatUtil
{
    private $config = [];    //微信公众号配置
    private $errorMsg = '';  //错误字符串信息
    private $debug = false;   //是否开启调试
    private $tagsMap = null; //粉丝标签映射
    
    public function __construct($config)
    {
        $this->config = $config;
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
        file_put_contents("./wechat.log", date('Y-m-d H:i:s').' -- '.$content."\n", FILE_APPEND);
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
    
    /**
     * 专门用来检查微信接口返回值的。
     */
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
            if ($wxdata['errcode'] == 40001) {
                $this->config['web_expires'] = 0;
                M('wx_user')->where('id', $this->config['id'])->save(['web_expires' => 0]);//token错误
            }
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

        return $wxdata;
    }

    /**
     * 获取access_token
     * @param array $wechat wechar 公众号信息，查表可得
     * @return string
     */
    public function getAccessToken()
    {
        $wechat = $this->config;
        if (empty($wechat)) {
            $this->setError("公众号不存在！");
            return false;
        }
            
        //判断是否过了缓存期
        $expire_time = $wechat['web_expires'];
        if($expire_time > time()){
           return $wechat['web_access_token'];
        }
        
        $appid = $wechat['appid'];
        $appsecret = $wechat['appsecret'];
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$appsecret}";
        $return = $this->requestAndCheck($url, 'GET');
        if ($return === false) {
			print_r($return);
            return false;
        }
        
        $web_expires = time() + 7000; // 提前200秒过期
        M('wx_user')->where('id', $wechat['id'])->save(['web_access_token'=>$return['access_token'], 'web_expires'=>$web_expires]);
        $this->config['web_access_token'] = $return['access_token'];
        $this->config['web_expires'] = $web_expires;
        
        return $return['access_token'];
    }
    
    /**
     * 获取粉丝详细信息
     * @param type $openid
     * @param $access_token 如果为null，自动获取
     * @return array
     */
    public function getFanInfo($openid, $access_token=null)
    {
        if (null === $access_token) {
            $access_token = $this->getAccessToken();
            if (!$access_token) {
                return false;
            }
        }
        
        $url ="https://api.weixin.qq.com/cgi-bin/user/info?access_token={$access_token}&openid={$openid}&lang=zh_CN";
        $return = $this->requestAndCheck($url, 'GET');
        if ($return === false) {
            return false;
        }
        
        /* $wxdata[]元素：
         * subscribe	用户是否订阅该公众号标识，值为0时，代表此用户没有关注该公众号，拉取不到其余信息。
         * openid	用户的标识，对当前公众号唯一
         * nickname	用户的昵称
         * sex	用户的性别，值为1时是男性，值为2时是女性，值为0时是未知
         * city	用户所在城市
         * country	用户所在国家
         * province	用户所在省份
         * language	用户的语言，简体中文为zh_CN
         * headimgurl	用户头像，最后一个数值代表正方形头像大小（有0、46、64、96、132数值可选，0代表640*640正方形头像），用户没有头像时该项为空。若用户更换头像，原有头像URL将失效。
         * subscribe_time	用户关注时间，为时间戳。如果用户曾多次关注，则取最后关注时间
         * unionid	只有在用户将公众号绑定到微信开放平台帐号后，才会出现该字段。
         * remark	公众号运营者对粉丝的备注，公众号运营者可在微信公众平台用户管理界面对粉丝添加备注
         * groupid	用户所在的分组ID（兼容旧的用户分组接口）
         * tagid_list	用户被打上的标签ID列表
         */
        $return['sex_name'] = $this->sexName($return['sex']);
        return $return;
    }

    /**
     * sex_id 用户的性别，值为1时是男性，值为2时是女性，值为0时是未知
     */
    public function sexName($sex_id)
    {
        if ($sex_id == 1) {
            return '男';
        } else if ($sex_id == 2) {
            return '女';   
        }
        return '未知';
    }
    
    /**
     * 获取粉丝标签
     * @return type
     */
    public function getAllFanTags()
    {
        $access_token = $this->getAccessToken();
        if (!$access_token) {
            return false;
        }
        
        $url = "https://api.weixin.qq.com/cgi-bin/tags/get?access_token={$access_token}";
        $return = $this->requestAndCheck($url, 'GET');
        if ($return === false) {
            return false;
        }
        
        //$wxdata数据样例：{"tags":[{"id":1,"name":"每天一罐可乐星人","count":0/*此标签下粉丝数*/}, ...]}
        return $return['tags'];
    }
    
    /**
     * 获取所有用户标签
     * @return array
     */
    public function getAllFanTagsMap()
    {
        if ($this->tagsMap !== null) {
            return $this->tagsMap;
        }
        
        $user_tags = $this->getAllFanTags();
        if ($user_tags === false) {
            return false;
        }
        
        $this->tagsMap = [];
        foreach ($user_tags as $tag) {
            $this->tagsMap[$tag['id']] = $this->tagsMap[$tag['name']];
        }
        return $this->tagsMap;
    }
    
    /**
     * 获取粉丝标签名
     * @param string $tagid_list
     * @param array $tagsMap
     * @return array
     */
    public function getFanTagNames($tagid_list)
    {
        if ($this->tagsMap === null) {
            $tagsMap = $this->getAllFanTagsMap();
            if ($tagsMap === false) {
                return false;
            }
            $this->tagsMap = $tagsMap;
        }
        
        $tag_names = [];
        foreach ($tagid_list as $tag) {
            $tag_names[] = $this->tagsMap[$tag];
        }
        return $tag_names;
    }
 
    /**
     * 获取粉丝id列表
     * @param string $next_openid 下一次拉取的起始id的前一个id
     * @return array
     */
    public function getFanIdList($next_openid='')
    {
        $access_token = $this->getAccessToken();
        if (!$access_token) {
            return false;
        }
        
        $url ="https://api.weixin.qq.com/cgi-bin/user/get?access_token={$access_token}&next_openid={$next_openid}";//重头开始拉取，一次最多拉取10000个
        $return = $this->requestAndCheck($url, 'GET');
        if ($return === false) {
            return false;
        }
        
        //$list[]元素：
        //total	关注该公众账号的总用户数
        //count	拉取的OPENID个数，最大值为10000
        //data	列表数据，OPENID的列表
        //next_openid	拉取列表的最后一个用户的OPENID
        //样本数据：{"total":2,"count":2,"data":{"openid":["OPENID1","OPENID2"]},"next_openid":"NEXT_OPENID"}
        return $return;
    }
    
    /**
     * 设置粉丝备注
     */
    public function setFanRemark($openid, $remark)
    {
        $access_token = $this->getAccessToken();
        if (!$access_token) {
            return false;
        }
        
        $post = json_encode(['openid '=> $openid, 'remark' => $remark], JSON_UNESCAPED_UNICODE);
        $url ="https://api.weixin.qq.com/cgi-bin/user/info/updateremark?access_token={$access_token}";
        $return = $this->requestAndCheck($url, 'POST', $post);
        if ($return === false) {
            return false;
        }
        
        return true;
    }
    
    /*
     * 向一个粉丝发送消息
     */
    public function sendMsgToOne($openid, $content)
    {
        $access_token = $this->getAccessToken();
        if (!$access_token) {
            return false;
        }
        
        $url ="https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token={$access_token}";        
        $post_arr = [
                        'touser' => $openid,
                        'msgtype' => 'text',
                        'text' => ['content'=>$content]
                    ];
        $post = json_encode($post_arr, JSON_UNESCAPED_UNICODE);        
        $return = $this->requestAndCheck($url, 'POST', $post);
        if ($return === false) {
            return false;
        }
        
        return true;
    }
    
    /**
     * 指定一部分人群发消息
     * @param array or string $openids
     * @param string $content
     * @return boolean
     */
    public function sendMsgToMass($openids, $content)
    {
        $access_token = $this->getAccessToken();
        if (!$access_token) {
            return false;
        }
        
        $url ="https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token={$access_token}";
        $post_arr = [
                        'touser' => $openids,
                        'msgtype' => 'text',
                        'text' => ['content'=>$content]
                    ];
        $post = json_encode($post_arr, JSON_UNESCAPED_UNICODE);        
        $return = $this->requestAndCheck($url, 'POST', $post);
        if ($return === false) {
            return false;
        }
        
        return true;
    }
    
    /**
     * 给所有粉丝发消息
     * @param string $content
     * @return boolean
     */
    public function sendMsgToAll($content)
    {
        $access_token = $this->getAccessToken();
        if (!$access_token) {
            return false;
        }

        $url ="https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token={$access_token}";        
        $post_arr = [
                        'filter' => ['is_to_all'=>true, 'tag_id'=>0],
                        'msgtype' => 'text',
                        'text' => ['content'=>$content]
                    ];
        $post = json_encode($post_arr, JSON_UNESCAPED_UNICODE);        
        $return = $this->requestAndCheck($url, 'POST', $post);
        if ($return === false) {
            return false;
        }
        
        return true;
    }
    
    /**
     * 发送消息，自动识别id数
     * @param string or array $openids
     * @param string $content
     * @return boolean
     */
    public function sendMsg($openids, $content)
    {
        if (empty($openids)) {
            return true;
        }
        if (is_string($openids)) {
            $openids = explode(',', $openids);
        }
        
        if (count($openids) > 1) {
            $result = $this->sendMsgToMass($openids, $content);
        } else {
            $result = $this->sendMsgToOne($openids[0], $content);
        }        
        if ($result === false) {
            return false;
        }
        
        return true;
    }
    
    /**
     * 新增媒质永久素材
     * 文档：https://mp.weixin.qq.com/wiki?action=doc&id=mp1444738729
     * @parem type $path 素材地址
     * @param string $type 类型有image,voice,video,thumb
     * @param array $param 目前是video类型需要
     * @return {"media_id":MEDIA_ID,"url":URL}
     */
    public function uploadMaterial($path, $type = 'news', $param=[])
    {
        $access_token = $this->getAccessToken();
        if (!$access_token) {
            return false;
        }
        
        $post_arr = ['media' => '@'.$path];  
        if ($type == 'video') {
            $description = [
                'title' => $param['title'],
                'introduction' => $param['introduction'],
            ];
            $post_arr['description'] = json_encode($description, JSON_UNESCAPED_UNICODE);
        }
        
        $url ="https://api.weixin.qq.com/cgi-bin/material/add_material?access_token={$access_token}&type={$type}";
        $return = $this->requestAndCheck($url, 'POST', $post_arr);
        if ($return === false) {
            return false;
        }
        
        return $return;
    }
    
    /**
     * 上传图文素材。 说明：news里面的图片只能用news_image，封面用image
     * 文档：https://mp.weixin.qq.com/wiki?action=doc&id=mp1444738729
     * @param array $articles
     *  [
     *      [
     *          "title"=> TITLE,
     *          "thumb_media_id"=> THUMB_MEDIA_ID,
     *          "author"=> AUTHOR,
     *          "digest"=> DIGEST,
     *          "show_cover_pic"=> SHOW_COVER_PIC(0 / 1),
     *          "content"=> CONTENT,
     *          "content_source_url"=> CONTENT_SOURCE_URL
     *      ],
     *      //若新增的是多图文素材，则此处应还有几段articles结构(最多8段)
     *  ]
     * @return MEDIA_ID
     */
    public function uploadNews($articles)
    {
        $access_token = $this->getAccessToken();
        if (!$access_token) {
            return false;
        }
        
        $post_arr = ["articles"=>$articles];  
        $post = json_encode($post_arr, JSON_UNESCAPED_UNICODE);

        $url ="https://api.weixin.qq.com/cgi-bin/material/add_news?access_token={$access_token}";
        $return = $this->requestAndCheck($url, 'POST', $post);
        if ($return === false) {
            return false;
        }
        
        return $return['media_id'];
    }
    
    /**
     * 上传图文消息中的图片
     * 文档：https://mp.weixin.qq.com/wiki?action=doc&id=mp1444738729
     * @param type $path 图片地址
     * @return 图片的url
     */
    public function uploadNewsImage($path)
    {
        $access_token = $this->getAccessToken();
        if (!$access_token) {
            return false;
        }
        
        $post_arr = ["media"=>'@'.$path];  
        $url ="https://api.weixin.qq.com/cgi-bin/media/uploadimg?access_token={$access_token}";
        $return = $this->requestAndCheck($url, 'POST', $post_arr);
        if ($return === false) {
            return false;
        }

        return $return['url'];
    }

    /**
     * 上传临时材料（3天内有效）
     * 文档：https://mp.weixin.qq.com/wiki?action=doc&id=mp1444738726
     * @parem type $path 素材地址
     * @param string $type 类型有image,voice,video,thumb
     * @return {"type":"TYPE","media_id":"MEDIA_ID","created_at":123456789}
     */
    public function uploadTempMaterial($path, $type = 'image')
    {
        if (!($access_token = $this->getAccessToken())) {
            return false;
        }
        
        $post_arr = ['media' => '@'.$path];  
        $url ="https://api.weixin.qq.com/cgi-bin/media/upload?access_token={$access_token}&type={$type}";
        $return = $this->requestAndCheck($url, 'POST', $post_arr);
        if ($return === false) {
            return false;
        }
        
        return $return;
    }
    
    /**
     * 更新一篇图文
     * 文档：https://mp.weixin.qq.com/wiki?action=doc&id=mp1444738732&t=0.5904919423628598
     * @param string $mediaId MEDIA_ID 
     * @param array $article INDEX
       {
            "title": TITLE,
            "thumb_media_id": THUMB_MEDIA_ID,
            "author": AUTHOR,
            "digest": DIGEST,
            "show_cover_pic": SHOW_COVER_PIC(0 / 1),
            "content": CONTENT,
            "content_source_url": CONTENT_SOURCE_URL
        }
     * @param number $index 要更新的文章在图文消息中的位置（多图文消息时，此字段才有意义），第一篇为0
     * @return boolean
     */
    public function updateNews($mediaId, $article, $index = 0)
    {
        $access_token = $this->getAccessToken();
        if (!$access_token) {
            return false;
        }
        
        $post_arr = [
            'media_id' => $mediaId,
            'index' => $index,
            'articles' => $article
        ];
        $post = json_encode($post_arr, JSON_UNESCAPED_UNICODE);

        $url ="https://api.weixin.qq.com/cgi-bin/material/update_news?access_token={$access_token}";
        $return = $this->requestAndCheck($url, 'POST', $post);
        if ($return === false) {
            return false;
        }
        
        return true;
    }
    
    /**
     * 获取图文素材
     * @param type $mediaId
     * @return boolean
     */
    public function getNews($mediaId)
    {
        $wxdata = $this->getMaterial($mediaId);
        if ($wxdata === false) {
            return false;
        }
        
//    [
//        [
//        title 图文消息的标题
//        thumb_media_id	图文消息的封面图片素材id（必须是永久mediaID）
//        show_cover_pic	是否显示封面，0为false，即不显示，1为true，即显示
//        author	作者
//        digest	图文消息的摘要，仅有单图文消息才有摘要，多图文此处为空
//        content	图文消息的具体内容，支持HTML标签，必须少于2万字符，小于1M，且此处会去除JS
//        url	图文页的URL
//        content_source_url	图文消息的原文地址，即点击“阅读原文”后的URL
//        ],
//        //多图文消息有多篇文章
//     ]
        return $wxdata['news_item'];
    }
    
    /**
     * 获取媒质素材
     * @param type $mediaId
     * @return boolean
        array video返回{
         "title":TITLE,
         "description":DESCRIPTION,
         "down_url":DOWN_URL,
        }
     */
    public function getMaterial($mediaId)
    {
        $access_token = $this->getAccessToken();
        if (!$access_token) {
            return false;
        }
        
        $post_arr = ['media_id' => $mediaId];
        $post = json_encode($post_arr, JSON_UNESCAPED_UNICODE);

        $url ="https://api.weixin.qq.com/cgi-bin/material/get_material?access_token={$access_token}";
        $return = $this->requestAndCheck($url, 'POST', $post);
        if ($return === false) {
            return false;
        }
        return true;
    }
    
    /**
     * 删除素材，包括图文
     * @param type $mediaId
     * @return boolean
     */
    public function delMaterial($mediaId)
    {
        $access_token = $this->getAccessToken();
        if (!$access_token) {
            return false;
        }
        
        $post_arr = ['media_id' => $mediaId];
        $post = json_encode($post_arr, JSON_UNESCAPED_UNICODE);

        $url ="https://api.weixin.qq.com/cgi-bin/material/del_material?access_token={$access_token}";
        $return = $this->requestAndCheck($url, 'POST', $post);
        if ($return === false) {
            return false;
        }

        return true;
    }
    
    /**
     * 获取素材总数
     * @return array
        //voice_count	语音总数量
        //video_count	视频总数量
        //image_count	图片总数量
        //news_count	图文总数量
     */
    public function getMaterialCount()
    {
        $access_token = $this->getAccessToken();
        if (!$access_token) {
            return false;
        }
        
        $url ="https://api.weixin.qq.com/cgi-bin/material/get_materialcount?access_token={$access_token}";
        $return = $this->requestAndCheck($url, 'GET');
        if ($return === false) {
            return false;
        }

        return $return;
    }
    
    /**
     * 获取素材列表 
     * @param string $type 素材的类型，图片（image）、视频（video）、语音 （voice）、图文（news）
     * @param int $offset 从全部素材的该偏移位置开始返回，0表示从第一个素材 返回
     * @param int $count 返回素材的数量，取值在1到20之间
     * @return array
     */
    public function getMaterialList($type, $offset, $count)
    {
        $access_token = $this->getAccessToken();
        if (!$access_token) {
            return false;
        }
        
        $post_arr = [
            'type' => $type,
            'offset' => $offset,
            'count' => $count
        ];
        $post = json_encode($post_arr, JSON_UNESCAPED_UNICODE);
        
        $url ="https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token={$access_token}";
        $return = $this->requestAndCheck($url, 'POST', $post);
        if ($return === false) {
            return false;
        }

        /* 返回图文消息结构 */
        //{
        //  "total_count": TOTAL_COUNT,
        //  "item_count": ITEM_COUNT,
        //  "item": [{
        //      "media_id": MEDIA_ID,
        //      "content": {
        //          "news_item": [{
        //              "title": TITLE,
        //              "thumb_media_id": THUMB_MEDIA_ID,
        //              "show_cover_pic": SHOW_COVER_PIC(0 / 1),
        //              "author": AUTHOR,
        //              "digest": DIGEST,
        //              "content": CONTENT,
        //              "url": URL,
        //              "content_source_url": CONTETN_SOURCE_URL
        //          },
        //          //多图文消息会在此处有多篇文章
        //          ]
        //       },
        //       "update_time": UPDATE_TIME
        //   },
        //   //可能有多个图文消息item结构
        // ]
        //}
        
        /*其他类型*/
        //{
        //  "total_count": TOTAL_COUNT,
        //  "item_count": ITEM_COUNT,
        //  "item": [{
        //      "media_id": MEDIA_ID,
        //      "name": NAME,
        //      "update_time": UPDATE_TIME,
        //      "url":URL
        //  },
        //  //可能会有多个素材
        //  ]
        //}
        return $return;
    }
    
    /**
     * 创建临时二维码
     * @param int $expire 过期时间，单位秒，最大30天，即2592000秒
     * @param int $scene_id 场景id，用户自定义，目前支持1-100000
     * @return boolean
     */
    public function createTempQrcode($expire, $scene_id)
    {
        $access_token = $this->getAccessToken();
        if (!$access_token) {
            return false;
        }
        
        $post_arr = [
            'expire_seconds' => $expire,
            'action_name'    => 'QR_SCENE',
            'action_info'    => [
                'scene' => [
                    'scene_id' => $scene_id
                ]
            ]
        ];
        $post = json_encode($post_arr, JSON_UNESCAPED_UNICODE);
        
        $url ="https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token={$access_token}";
        $return = $this->requestAndCheck($url, 'POST', $post);
        if ($return === false) {
            return false;
        }
        
//        返回数据格式：
//        {
//            "ticket":"gQH47joAAAAAAAAAASxodHRwOi8vd2VpeGluLnFxLmNvbS9xL2taZ2Z3TVRtNzJXV1Brb3ZhYmJJAAIEZ23sUwMEmm3sUw==",
//            "expire_seconds":60,
//            "url":"http:\/\/weixin.qq.com\/q\/kZgfwMTm72WWPkovabbI"
//        }
        
        return $return;
    }
    
    /**
     * 推送消息处理接口
     * @return type
     */
    public function handleMessage()
    {
        $content = $GLOBALS['HTTP_RAW_POST_DATA'] ?: file_get_contents('php://input');
        
        $this->debug && $this->logDebugFile($content);

        $message = \app\common\util\XML::parse($content);
        if (empty($message)) {
            $this->setError('推送消息为空！');
            return false;
        }
        
        return $message;
    }
    
    /**
     * 创建文本回复消息
     * @param type $fromUser
     * @param type $toUser
     * @param type $text
     * @return type
     */
    public function createReplyMsgOfText($fromUser, $toUser, $text)
    {
        $time = time();
        $template = 
            "<xml>
            <ToUserName><![CDATA[$toUser]]></ToUserName>
            <FromUserName><![CDATA[$fromUser]]></FromUserName>
            <CreateTime>$time</CreateTime>
            <MsgType><![CDATA[text]]></MsgType>
            <Content><![CDATA[$text]]></Content>
            </xml>";
        return $template;    
    }
    
    /**
     * 创建图片回复消息
     * @param type $fromUser
     * @param type $toUser
     * @param type $mediaId
     * @return type
     */
    public function createReplyMsgOfImage($fromUser, $toUser, $mediaId)
    {
        $time = time();
        $template = 
            "<xml>
            <ToUserName><![CDATA[$toUser]]></ToUserName>
            <FromUserName><![CDATA[$fromUser]]></FromUserName>
            <CreateTime>$time</CreateTime>
            <MsgType><![CDATA[image]]></MsgType>
            <Image>
            <MediaId><![CDATA[$mediaId]]></MediaId>
            </Image>
            </xml>";
        return $template;    
    }
    
    /**
     * 创建图文回复消息
     * @param type $fromUser
     * @param type $toUser
     * @param type $articles
     * @return string
     */
    public function createReplyMsgOfNews($fromUser, $toUser, $articles)
    {
        $articles = array_slice($articles, 0, 7);//最多支持7个
        $num = count($articles);
        if (!$num) {
            return '';
        }
        
        $itemTpl = '';
        foreach ($articles as $item) {
            $itemTpl .= 
            "<item>
            <Title><![CDATA[{$item['title']}]]></Title> 
            <Description><![CDATA[{$item['description']}]]></Description>
            <PicUrl><![CDATA[{$item['picurl']}]]></PicUrl>
            <Url><![CDATA[{$item['url']}]]></Url>
            </item>";
        }
        
        $time = time();
        $template = 
            "<xml>
            <ToUserName><![CDATA[$toUser]]></ToUserName>
            <FromUserName><![CDATA[$fromUser]]></FromUserName>
            <CreateTime>$time</CreateTime>
            <MsgType><![CDATA[news]]></MsgType>
            <ArticleCount>$num</ArticleCount>
            <Articles>$itemTpl</Articles>
            </xml>";
        return $template;
    }
}