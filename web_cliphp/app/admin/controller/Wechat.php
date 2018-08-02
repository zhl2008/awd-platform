<?php
namespace app\admin\controller;
use clt\WchatOauth;

class Wechat extends Common{
    private $return = array();
    protected $instance_id;
    /**
     * 微信账户设置
     */
    public function config(){
        $info = db('wx_config')->where([ 'key' => 'SHOPWCHAT'])->field('value')->find();
        if (empty($info['value'])) {
            $info= array(
                'value' => array(
                    'appid' => '',
                    'appsecret' => '',
                    'token' => ''
                ),
                'is_use' => 1
            );
        } else {
            $info['value'] = json_decode($info['value'], true);
        }
        $wchat_config = $info;
        // 获取当前域名
        $domain_name = \think\Request::instance()->domain();
        $url = $domain_name . \think\Request::instance()->root();
        // 去除链接的http://头部
        $url_top = substr($url, 7);
        // 去除链接的尾部index.php
        $url_top = str_replace('/index.php', '', $url_top);
        $call_back_url = $domain_name.'/wchat/wchat/relateWeixin';
        $this->assign("url", $url_top);
        $this->assign("call_back_url", $call_back_url);
        $this->assign('wchat_config', $wchat_config["value"]);
        $this->assign('title', '公众号配置');
        return $this->fetch();
    }
    public function setWechatConfig(){
        $data = input('post.');
        $value['value'] = json_encode($data);
        $value['modify_time'] = time();
        $value['is_use'] = 1;
        db('wx_config')->where([ 'key' => 'SHOPWCHAT'])->update($value);
        return json(['code' => 1, 'msg' => '设置成功!', 'url' => url('config')]);
    }

    /**
     *微信菜单
     */
   function getInstanceWchatMenu($instance_id)
    {
        $wx_menu = db('wx_menu');
        $foot_menu = $wx_menu->where(['instance_id'=>$instance_id,'pid'=>0])->order('sort asc')->select();
        if (! empty($foot_menu)) {
            foreach ($foot_menu as $k => $v) {
                $foot_menu[$k]['child'] = '';
                $second_menu = $wx_menu->where(['instance_id'=>$instance_id,'pid'=>$v['menu_id']])->order('sort asc')->select();
                if (! empty($second_menu)) {
                    $foot_menu[$k]['child'] = $second_menu;
                    $foot_menu[$k]['child_count'] = count($second_menu);
                } else {
                    $foot_menu[$k]['child_count'] = 0;
                }
            }
        }
        return $foot_menu;
    }
    public function menu(){
        $menu_list = $this->getInstanceWchatMenu(0);
        $default_menu_info = array(); // 默认显示菜单
        $menu_list_count = count($menu_list);
        $class_index = count($menu_list);
        if ($class_index > 0) {
            if ($class_index == MAX_MENU_LENGTH) {
                $class_index = MAX_MENU_LENGTH - 1;
            }
        }
        if ($menu_list_count > 0) {
            $default_menu_info = $menu_list[$menu_list_count - 1];
        } else {
            $default_menu_info["menu_name"] = "";
            $default_menu_info["menu_id"] = 0;
            $default_menu_info["child_count"] = 0;
            $default_menu_info["media_id"] = 0;
            $default_menu_info["menu_event_url"] = "";
            $default_menu_info["menu_event_type"] = 1;
        }
        $media_detail = array();
        if ($default_menu_info["media_id"]) {
            // 查询图文消息
            $media_detail = $this->gwmd($default_menu_info["media_id"]);
            $media_detail["item_list_count"] = count($media_detail["item_list"]);
        } else {
            $media_detail["create_time"] = "";
            $media_detail["title"] = "";
            $media_detail["item_list_count"] = 0;
        }
        $default_menu_info["media_list"] = $media_detail;
        $this->assign("wx_name",$this->system['name']);
        $this->assign("pagesize",2);
        $this->assign("menu_list", $menu_list);
        $this->assign("MAX_MENU_LENGTH", MAX_MENU_LENGTH); // 一级菜单数量
        $this->assign("MAX_SUB_MENU_LENGTH", MAX_SUB_MENU_LENGTH); // 二级菜单数量
        $this->assign("menu_list_count", $menu_list_count);
        //dump($default_menu_info);
        $this->assign("default_menu_info", $default_menu_info);
        $this->assign("class_index", $class_index);
        return $this->fetch();
    }
    public function getweixinmediadetail()
    {
        $media_id = input('media_id');
        $res = $this->gwmd($media_id);
        return $res;
    }


    public function gwmd($media_id)
    {
        $wx_media = db('wx_media');
        $weixin_media_info = $wx_media->find($media_id);
        $weixin_media_info['create_time'] = toDate($weixin_media_info['create_time'],'Y-m-d H:i:s');
        if (! empty($weixin_media_info)) {
            $item_list = db('wx_media_item')->where(['media_id' => $media_id])->select();
            $weixin_media_info['item_list'] = $item_list;
        }
        return $weixin_media_info;
    }
    public function addweixinmenu(){
        $menu = input('menu');
        if (! empty($menu)) {
            $menu = json_decode($menu, true);
            $instance_id = 0;
            $menu_name = $menu["menu_name"]; // 菜单名称
            $ico = ""; // 菜图标单
            $pid = $menu["pid"]; // 父级菜单（一级菜单）
            $menu_event_type = $menu["menu_event_type"]; // '1普通url 2 图文素材 3 功能',
            $menu_event_url = $menu["menu_event_url"]; // '菜单url',
            $media_id = $menu["media_id"]; // '图文消息ID',
            $sort = $menu["sort"]; // 排序
            $res = $this->addwm($instance_id, $menu_name, $ico, $pid, $menu_event_type, $menu_event_url, $media_id, $sort);
            return $res;
        }
        return - 1;
    }
    public function addwm($instance_id, $menu_name, $ico, $pid, $menu_event_type, $menu_event_url, $media_id, $sort)
    {
        $data = array(
            'instance_id' => $instance_id,
            'menu_name' => $menu_name,
            'ico' => $ico,
            'pid' => $pid,
            'menu_event_type' => $menu_event_type,
            'menu_event_url' => $menu_event_url,
            'media_id' => $media_id,
            'sort' => $sort,
            'create_date' => time()
        );
        return db('wx_menu')->insertGetId($data);
    }
    public function updateweixinmenuname()
    {
        $wx_menu = db('wx_menu');
        $data = input('post.');
        if(! empty($data['menu_name'])){
            $retval = $wx_menu->update($data);
            return $retval;
        }
        return -1;
    }
    public function deleteWeixinMenu()
    {
        $menu_id = input('menu_id');
        if (! empty($menu_id)) {
            $res = db('wx_menu')->where("menu_id=$menu_id or pid=$menu_id")->delete();
            return $res;
        }
        return - 1;
    }
    public function updateweixinmenueventtype()
    {
        $data = input('post.');
        if (! empty($data['menu_event_type'])) {
            $retval = db('wx_menu')->update($data);
            return $retval;
        }
        return - 1;
    }
    public function updateweixinmenumessage()
    {
        $menu_event_type = request()->post('menu_event_type', '');
        $menu_id = request()->post('menu_id', '');
        $media_id = request()->post('media_id', '');
        if (! empty($menu_event_type)) {
            $retval =db('wx_menu')->where(['menu_id'=>$menu_id])->update(["media_id" => $media_id, "menu_event_type" => $menu_event_type]);
            return $retval;
        }
        return - 1;
    }
    public function updateweixinmenuurl()
    {
        $data = input('post.');
        if (! empty($data['menu_event_url'])) {
            $retval = db('wx_menu')->update($data);
            return $retval;
        }
        return - 1;
    }
    public function updateweixinmenuSort()
    {
        $menu_id_arr = input('menu_id_arr');
        if (! empty($menu_id_arr)) {
            $weixin_menu = db('wx_menu');
            $menu_id_arr = explode(",", $menu_id_arr);
            $retval = 0;
            foreach ($menu_id_arr as $k => $v) {
                $data = array(
                    'sort' => $k + 1,
                    'modify_date' => time(),
                    'menu_id'=>$v
                );
                $retval += $weixin_menu->update($data);
            }
            return $retval;
        }
        return - 1;
    }
    //ajax 加载 选择素材 弹框数据
    public function onloadMaterial()
    {
        $type = request()->post('type', 0);
        $search_text = request()->post('search_text', '');
        $page =input('page')?input('page'):1;
        $pageSize =input('limit')?input('limit'):config('pageSize');
        $condition = array();
        if ($type != 0) {$condition['type'] = $type;}
        $condition['title'] = array('like', '%' . $search_text . '%');
        $condition = array_filter($condition);
        $wx_media = db('wx_media');
        $list = $wx_media->where($condition)->order('sort')->paginate(array('list_rows'=>$pageSize,'page'=>$page))
            ->toArray();
        if (! empty($list)) {
            foreach ($list['data'] as $k => $v) {
                $item_list = db('wx_media_item')->where(['media_id' => $v['media_id']])->select();
                $list['data'][$k]['item_list'] = $item_list;
                $list['data'][$k]['create_time'] = toDate($v['create_time']);
            }
        }
        return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list['data'],'count'=>$list['total'],'rel'=>1];
    }
    /**
     * 添加 消息
     */
    public function addMedia()
    {
        if (request()->isAjax()) {
            $type = request()->post('type', '');
            $title = request()->post('title', '');
            $content = request()->post('content', '');
            $sort = 0;

            $res = $this->addWeixinMedia($title, 0, $type, $sort, $content);
            return $res;
        }
        return view('addMedia');
    }

    public function addWeixinMedia($title, $instance_id, $type, $sort, $content)
    {
        $wx_media = db('wx_media');
        $wx_media->startTrans();
        try {
            $data_media = array(
                'title' => $title,
                'instance_id' => $instance_id,
                'type' => $type,
                'sort' => $sort,
                'create_time' => time()
            );
            $media_id = $wx_media->insertGetId($data_media);
            if ($type == 1) {
                $this->addWeixinMediaItem($media_id, $title, '', '', '', '', '', '', 0);
            } else if ($type == 2) {
                    $info = explode('`|`', $content);
                    $this->addWeixinMediaItem($media_id, $info[0], $info[1], $info[2], $info[3], $info[4], $info[5], $info[6], 0);
            } else if ($type == 3) {
                $list = explode('`$`', $content);
                foreach ($list as $k => $v) {
                    $arr = Array();
                    $arr = explode('`|`', $v);
                    $this->addWeixinMediaItem($media_id, $arr[0], $arr[1], $arr[2], $arr[3], $arr[4], $arr[5], $arr[6], 0);
                }
            }
            $wx_media->commit();
            return ['code'=>1,'message'=>'添加成功！','url'=>url('menu')];
        } catch (\Exception $e) {
            $wx_media->rollback();
            return $e->getMessage();
        }
        // TODO Auto-generated method stub
    }
    public function addWeixinMediaItem($media_id, $title, $author, $cover, $show_cover_pic, $summary, $content, $content_source_url, $sort)
    {
        $weixin_media_item = db('wx_media_item');
        $data = array(
            'media_id' => $media_id,
            'title' => $title,
            'author' => $author,
            'cover' => $cover,
            'show_cover_pic' => $show_cover_pic,
            'summary' => $summary,
            'content' => $content,
            'content_source_url' => $content_source_url,
            'sort' => $sort
        );
        $retval = $weixin_media_item->insert($data);
        return $retval;
    }
    public function upload(){
        // 获取上传文件表单字段名
        $fileKey = array_keys(request()->file());
        // 获取表单上传文件
        $file = request()->file($fileKey['0']);
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            $this->return['code'] = 1;
            $this->return['message'] = '图片上传成功!';
            $path=str_replace('\\','/',$info->getSaveName());
            $this->return['data'] = '/uploads/'. $path;
        }else{
            // 上传失败获取错误信息
            $this->return['code'] =0;
            $this->return['message'] = '图片上传失败!';
            $this->return['url'] = '';
        }
        $this->ajaxFileReturn();
    }
    /**
     * 上传文件后，ajax返回信息
     *
     * 2017年6月9日 19:54:46 王永杰
     *
     * @param array $return
     */
    private function ajaxFileReturn()
    {
        if (empty($this->return['code']) || null == $this->return['code'] || "" == $this->return['code']) {
            $this->return['code'] = 0; // 错误码
        }

        if (empty($this->return['message']) || null == $this->return['message'] || "" == $this->return['message']) {
            $this->return['message'] = ""; // 消息
        }

        if (empty($this->return['data']) || null == $this->return['data'] || "" == $this->return['data']) {
            $this->return['data'] = ""; // 数据
        }
        echo json_encode($this->return);
        //return json_encode($this->return);
    }
    public function materialmessage()
    {
        if (request()->isAjax()) {
            $type = request()->post('type', 0);
            $search_text = request()->post('search_text', '');
            $page =input('page',1);
            $pageSize =input('limit',config('pageSize'));
            $condition = array();
            if ($type != 0) {$condition['type'] = $type;}
            $condition['title'] = array('like', '%' . $search_text . '%');

            $condition = array_filter($condition);
            $list = db('wx_media')->where($condition)->order('create_time desc')
                ->paginate(array('list_rows'=>$pageSize,'page'=>$page))
                ->toArray();
            if (! empty($list)) {
                foreach ($list['data'] as $k => $v) {
                    $item_list = db('wx_media_item')->where(['media_id'=>$v['media_id']])->column('title');
                    $list['data'][$k]['item_list'] = $item_list;
                    $list['data'][$k]['create_time'] = toDate($v['create_time']);
                }
            }
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list['data'],'count'=>$list['total'],'rel'=>1];
        }
        $type = input('param.type',0);
        $child_menu_list = array(
            array(
                'url' => url('materialmessage'),
                'menu_name' => "全部",
                "active" => $type == 0 ? 1 : 0
            ),
            array(
                'url' => url('materialmessage',['type'=>1]),
                'menu_name' => "文本",
                "active" => $type == 1 ? 1 : 0
            ),
            array(
                'url' => url('materialmessage',['type'=>2]),
                'menu_name' => "单图文",
                "active" => $type == 2 ? 1 : 0
            ),
            array(
                'url' => url('materialmessage',['type'=>3]),
                'menu_name' => "多图文",
                "active" => $type == 3 ? 1 : 0
            )
        );

        $this->assign('type', $type);
        $this->assign('child_menu_list', $child_menu_list);
        return view('materialmessage');
    }
    public function updatemedia(){
        if (request()->isAjax()) {
            $media_id = request()->post('media_id', 0);
            $type = request()->post('type', '');
            $title = request()->post('title', '');
            $content = request()->post('content', '');
            $sort = 0;
            $res = $this->updateWeixinMedia($media_id, $title, 0, $type, $sort, $content);
            return json($res);
        }
        $media_id = input('media_id', 0);
        $weixin_media = db('wx_media');
        $weixin_media_info = $weixin_media->where(['media_id'=>$media_id])->find();
        if (! empty($weixin_media_info)) {
            $weixin_media_item = db('wx_media_item');
            $item_list = $weixin_media_item->where(['media_id' => $media_id])->select();
            $weixin_media_info['item_list'] = $item_list;
        }
        $this->assign('info', $weixin_media_info);
        return view();
    }
    public function updateWeixinMedia($media_id, $title, $instance_id, $type, $sort, $content)
    {
        $weixin_media = db('wx_media');
        $weixin_media->startTrans();
        try {
            // 先修改 图文消息表
            $data_media = array(
                'title' => $title,
                'instance_id' => $instance_id,
                'type' => $type,
                'sort' => $sort,
                'create_time' => time()
            );
            $weixin_media->where(['media_id' => $media_id])->update($data_media);
            // 修改 图文消息内容的时候 先删除了图文消息内容再添加一次
            $weixin_media_item = db('wx_media_item');
            $weixin_media_item->where(['media_id'=>$media_id])->delete();
            if ($type == 1) {
                $this->addWeixinMediaItem($media_id, $title, '', '', '', '', '', '', 0);
            } else if ($type == 2) {
                $info = explode('`|`', $content);
                $this->addWeixinMediaItem($media_id, $info[0], $info[1], $info[2], $info[3], $info[4], $info[5], $info[6], 0);
            } else if ($type == 3) {
                $list = explode('`$`', $content);
                foreach ($list as $k => $v) {
                    $arr = Array();
                    $arr = explode('`|`', $v);
                    $this->addWeixinMediaItem($media_id, $arr[0], $arr[1], $arr[2], $arr[3], $arr[4], $arr[5], $arr[6], 0);
                }
            }
            $weixin_media->commit();
            return ['code'=>1,'message'=>'修改成功！'];
        } catch (\Exception $e) {
            $weixin_media->rollback();
            return $e->getMessage();
        }
    }
    public function deleteweixinmediadetail(){
        $id = input('id', '');
        $res = 0;
        if (! empty($id)) {
            $weixin_media_item = db('wx_media_item');
            $res = $weixin_media_item->where("id=$id")->delete();
            return $res;
        }
        return $res;
    }
    public function updatemenutoweixin(){
        $this->instance_id=0;
        $result = $this->updateInstanceMenuToWeixin($this->instance_id);
        $auth_info = $this->getInstanceWchatConfig($this->instance_id);
        $res='';
        if (! empty($auth_info['value']['appid']) && ! empty($auth_info['value']['appsecret'])) {
            $wchat_auth = new WchatOauth();
            $res = $wchat_auth->menu_create($result);
            if (! empty($res)) {
                $res = json_decode($res, true);
                if ($res['errcode'] == 0) {
                    $retval = 1;
                } else {
                    $retval = $res['errmsg'];
                }
            } else {
                $retval = 0;
            }
        } else {
            $retval = "当前未配置微信授权";
        }
        return ['code' => $retval,'wxcode'=>$res['errcode'], 'message' => '操作成功'];
    }

    public function getInstanceWchatConfig($instance_id)
    {
        $info = db('wx_config')->where(['key' => 'SHOPWCHAT', 'instance_id' => $instance_id])->field('value')->find();
        if (empty($info['value'])) {
            return array(
                'value' => array(
                    'appid' => '',
                    'appsecret' => ''
                ),
                'is_use' => 1
            );
        } else {
            $info['value'] = json_decode($info['value'], true);
            return $info;
        }
    }
    public function updateInstanceMenuToWeixin($instance_id)
    {
        $menu = array();
        $menu_list = $this->getInstanceWchatMenu($instance_id);
        if (! empty($menu_list)) {

            foreach ($menu_list as $k => $v) {
                if (! empty($v)) {
                    $menu_item = array(
                        'name' => ''
                    );
                    $menu_item['name'] = $v['menu_name'];

                    // $menu_item['sub_menu'] = array();
                    if (! empty($v['child'])) {

                        foreach ($v['child'] as $k_child => $v_child) {
                            if (! empty($v_child)) {
                                $sub_menu = array();
                                $sub_menu['name'] = $v_child['menu_name'];
                                // $sub_menu['sub_menu'] = array();
                                if ($v_child['menu_event_type'] == 1) {
                                    $sub_menu['type'] = 'view';
                                    $sub_menu['url'] = $v_child['menu_event_url'];
                                } else {
                                    $sub_menu['type'] = 'click';
                                    $sub_menu['key'] = $v_child['menu_id'];
                                }

                                $menu_item['sub_button'][] = $sub_menu;
                            }
                        }
                    } else {
                        if ($v['menu_event_type'] == 1) {
                            $menu_item['type'] = 'view';
                            $menu_item['url'] = $v['menu_event_url'];
                        } else {
                            $menu_item['type'] = 'click';
                            $menu_item['key'] = $v['menu_id'];
                        }
                    }
                    $menu[] = $menu_item;
                }
            }
        }
        $menu_array = array();
        $menu_array['button'] = array();
        foreach ($menu as $k => $v) {
            $menu_array['button'][] = $v;
        }
        // 汉字不编码
        $menu_array = json_encode($menu_array);
        // 链接不转义
        $menu_array = preg_replace_callback("/\\\u([0-9a-f]{4})/i", create_function('$matches', 'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");'), $menu_array);
        return $menu_array;
    }

    /*******************************回复设置********************************/
    /**
     * 关键字 回复
     */
    public function keyReplayList()
    {
        $page =input('page')?input('page'):1;
        $pageSize =input('limit')?input('limit'):config('pageSize');
        $list = db('wx_key_replay')->order('sort')->paginate(array('list_rows'=>$pageSize,'page'=>$page))->toArray();
        if (! empty($list)) {
            foreach ($list['data'] as $k => $v) {

                $list['data'][$k]['match_type'] = $v['match_type']==2?'全部匹配':'模糊匹配';
                $list['data'][$k]['create_time'] = toDate($v['create_time']);
            }
        }
        return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list['data'],'count'=>$list['total'],'rel'=>1];
    }


    public function replay(){
        $type = input('type', 1);
        $child_menu_list = array(
            array(
                'url' => url('replay',['type'=>1]),
                'menu_name' => "关注时回复",
                "active" => $type == 1 ? 1 : 0
            ),
            array(
                'url' => url('replay',['type'=>2]),
                'menu_name' => "关键字回复",
                "active" => $type == 2 ? 1 : 0
            ),
            array(
                'url' => url('replay',['type'=>3]),
                'menu_name' => "默认回复",
                "active" => $type == 3 ? 1 : 0
            )
        );
        $this->assign('child_menu_list', $child_menu_list);
        $this->assign('type', $type);
        if ($type == 1) {
            $info = db('wxFollowReplay')->where(['instance_id' => 0])->find();
            if ($info['reply_media_id'] > 0) {
                $weixin_media_info = db('wx_media')->where(['media_id'=>$info['reply_media_id']])->find();
                if (! empty($weixin_media_info)) {
                    $item_list = db('wx_media_item')->where(['media_id'=>$info['reply_media_id']])->select();
                    $weixin_media_info['item_list'] = $item_list;
                }
                $info['media_info'] = $weixin_media_info;
            }
            $this->assign('info', $info);
        } else if ($type == 2) {
        } else if ($type == 3) {
            $info = db('wx_default_replay')->where(['instance_id' => 0])->find();
            if ($info['reply_media_id'] > 0) {
                $weixin_media_info = db('wx_media')->where(['media_id' => $info['reply_media_id']])->find();
                if (!empty($weixin_media_info)) {
                    $item_list = db('wx_media_item')->where(['media_id' => $info['reply_media_id']])->select();
                    $weixin_media_info['item_list'] = $item_list;
                }
                $info['media_info'] = $weixin_media_info;
            }
            $this->assign('info', $info);
        }
        return view();
    }
    /**
     * 添加 或 修改 关注时回复
     */
    public function addorupdatefollowreply()
    {
        $id = input('id',0);
        $replay_media_id = input('media_id', 0);
        if($id==0){
            if ($replay_media_id > 0) {
                $res = $this->addFollowReplay(0, $replay_media_id, 0);
            } else {
                return ['code'=>0,'msg'=>'添加失败'];
            }
        }else{
            if ($replay_media_id > 0) {
                $res = $this->updateFollowReplay($id, 0, $replay_media_id, 0);
            } else {
                return ['code'=>0,'msg'=>'修改失败'];
            }
        }
        return $res;
    }
    public function addFollowReplay($instance_id, $replay_media_id, $sort)
    {
        $data = array(
            'instance_id' => $instance_id,
            'reply_media_id' => $replay_media_id,
            'sort' => $sort,
            'create_time' => time()
        );
        $id = db('wx_follow_replay')->insertGetId($data);
        if($id){
            return ['code'=>$id,'msg'=>'添加成功'];
        }else{
            return ['code'=>0,'msg'=>'添加失败'];
        }

    }
    public function updateFollowReplay($id, $instance_id, $replay_media_id, $sort)
    {
        $data = array(
            'instance_id' => $instance_id,
            'reply_media_id' => $replay_media_id,
            'sort' => $sort,
            'modify_time' => time()
        );
        if(db('wx_follow_replay')->where(['id' => $id])->update($data)!==false){
            return ['code'=>1,'msg'=>'修改成功'];
        }else{
            return ['code'=>0,'msg'=>'修改失败'];
        }
    }
    /**
     * 删除 回复
     * @return unknown[]
     */
    public function delReply()
    {
        $type = request()->post('type', '');
        if ($type == '') {
            return ['code'=>0];
        } else {
            if ($type == 1) {
                db('wx_follow_replay')->where(['instance_id'=>0])->delete();
                return ['code'=>1,'msg'=>'删除成功！','url'=>url('replay',['type'=>1])];
            } else if ($type == 3) {
                // 删除 默认回复
                db('wx_default_replay')->where(['instance_id'=>0])->delete();
                return ['code'=>1,'msg'=>'删除成功！','url'=>url('replay',['type'=>3])];
            }
        }
    }
    /**
     * 添加 或 修改 默认回复
     */
    public function addOrUpdateDefaultReply()
    {
        $id = input('id',0);
        $replay_media_id = input('media_id', 0);
        if ($id == 0) {
            if ($replay_media_id > 0) {
                $res = $this->addDefaultReplay(0, $replay_media_id, 0);
            } else {
                return ['code'=>0,'msg'=>'添加失败'];
            }
        } else{
            if ($replay_media_id > 0) {
                $res = $this->updateDefaultReplay($id, 0, $replay_media_id, 0);
            } else {
                return ['code'=>0,'msg'=>'修改失败'];
            }
        }
        return $res;
    }
    public function updateDefaultReplay($id, $instance_id, $replay_media_id, $sort)
    {
        $data = array(
            'instance_id' => $instance_id,
            'reply_media_id' => $replay_media_id,
            'sort' => $sort,
            'modify_time' => time()
        );
        if(db('wx_default_replay')->where(['id' => $id])->update($data)!==false){
            return ['code'=>1,'msg'=>'修改成功'];
        }else{
            return ['code'=>0,'msg'=>'修改失败'];
        }
    }
    public function addDefaultReplay($instance_id, $replay_media_id, $sort)
    {
        $data = array(
            'instance_id' => $instance_id,
            'reply_media_id' => $replay_media_id,
            'sort' => $sort,
            'create_time' => time()
        );
        $id = db('wx_default_replay')->insertGetId($data);
        if($id){
            return ['code'=>$id,'msg'=>'添加成功'];
        }else{
            return ['code'=>0,'msg'=>'添加失败'];
        }
    }

    /**
     * 添加 或 修改 关键字 回复
     */
    public function addorupdatekeyreplay()
    {
        if (request()->isAjax()) {
            $id = input('id');
            $key = input('key', '');
            $match_type = input('match_type', 1);
            $replay_media_id = input('media_id', 0);
            $sort = 0;
            if ($id > 0) {
                $res = $this->updateKeyReplay($id, 0, $key, $match_type, $replay_media_id, $sort);
            }else{
                $res = $this->addKeyReplay(0, $key, $match_type, $replay_media_id, $sort);
            }
            return $res;
        }
        $id = input('id',0);
        $this->assign('id', $id);
        $info = array(
            'key' => '',
            'match_type' => 1,
            'reply_media_id' => 0,
            'madie_info' => array()
        );
        if ($id > 0) {
            $info = db('wx_key_replay')->where(['id'=>$id])->find();
            if ($info['reply_media_id'] > 0) {
                $weixin_media_info = db('wx_media')->where(['media_id'=>$info['reply_media_id']])->find();
                if (! empty($weixin_media_info)) {
                    $item_list = db('wx_media_item')->where(['media_id' =>$info['reply_media_id']])->select();
                    $weixin_media_info['item_list'] = $item_list;
                }
                $info['media_info'] = $weixin_media_info;
            }
        }
        $secend_menu['module_name'] = "编辑回复";
        $this->assign("title", "编辑回复");
        $child_menu_list = array(
            array(
                'url' => "Wchat/addOrUpdateKeyReplay.html?id=" . $id,
                'menu_name' => "编辑回复",
                "active" => 1
            )
        );
        if (! empty($id)) {
            $this->assign("secend_menu", $secend_menu);
            $this->assign('child_menu_list', $child_menu_list);
        }
        $this->assign('info', $info);
        return view();
    }
    public function updateKeyReplay($id, $instance_id, $key, $match_type, $replay_media_id, $sort)
    {
        $data = array(
            'instance_id' => $instance_id,
            'key' => $key,
            'match_type' => $match_type,
            'reply_media_id' => $replay_media_id,
            'sort' => $sort,
            'create_time' => time()
        );
        if(db('wx_key_replay')->where(['id' => $id])->update($data)!==false){
            return ['code'=>1,'msg'=>'修改成功'];
        }else{
            return ['code'=>0,'msg'=>'修改失败'];
        }
    }
    public function addKeyReplay($instance_id, $key, $match_type, $replay_media_id, $sort)
    {
        $data = array(
            'instance_id' => $instance_id,
            'key' => $key,
            'match_type' => $match_type,
            'reply_media_id' => $replay_media_id,
            'sort' => $sort,
            'create_time' => time()
        );
        $id = db('wx_key_replay')->insertGetId($data);
        if($id){
            return ['code'=>$id,'msg'=>'添加成功'];
        }else{
            return ['code'=>0,'msg'=>'添加失败'];
        }
    }
    /**
     * 删除图文消息
     *
     * @return number
     */
    public function deleteWeixinMedia(){
        $media_id = input('media_id', '');
        db('wx_media')->where(['media_id'=>$media_id])->delete();
        return ['code'=>1,'msg'=>'删除成功'];
    }
    /**
     * 删除 回复
     *
     * @return unknown[]
     */
    public function delKeyReply()
    {
        $id = input('id');
        db('wx_key_replay')->where(['id'=>$id])->delete();
        return ['code'=>1,'msg'=>'删除成功'];

    }
}