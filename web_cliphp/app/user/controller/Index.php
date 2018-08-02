<?php
namespace app\user\controller;
use think\Input;
class Index extends Common{
    public function _initialize(){
        parent::_initialize();
        if (!session('user.id')) {
            $this->redirect('login/index');
        }
    }
    public function index(){
        $this->assign('title','会员中心');
        return $this->fetch();
    }
}