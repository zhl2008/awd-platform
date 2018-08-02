<?php
namespace app\user\controller;
use clt\UsersLogic;
class LoginApi extends Common{
    public $config;
    public $oauth;
    public $class_obj;
    public function _initialize(){
        parent::_initialize();
        $this->oauth = input('param.oauth');
        //获取配置
        $data = db('plugin')->where(['code'=>$this->oauth,'type'=>'login'])->find();

        $this->config = unserialize($data['config_value']); // 配置反序列化
        if(!$this->oauth){
            $this->error('非法操作',url('index/index'));
        }
        include_once  "plugins/login/{$this->oauth}/{$this->oauth}.class.php";
        $class = $this->oauth;
        $this->class_obj  = new $class($this->config); //实例化对应的登陆插件
    }

    public function login(){
        if(!$this->oauth){
            $this->error('非法操作',url('index/index'));
        }
        include_once  "plugins/login/{$this->oauth}/{$this->oauth}.class.php";
        $this->class_obj->login();
    }

    public function callback(){
        $data = $this->class_obj->respon();
        $logic = new UsersLogic();
        if(session('user')){
            $data = $logic->oauth_bind($data);
        }else{
            $data = $logic->thirdLogin($data);
            if($data['status'] != 1){
                $this->error($data['msg']);
            }
            session('user',$data['result']);
        }
        $this->success($data['msg'],url('user/index/index'));
    }
}