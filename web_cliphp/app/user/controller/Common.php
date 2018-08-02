<?php
namespace app\user\controller;
use think\Input;
use think\Controller;
class Common extends Controller{
    protected $userInfo;
    public function _initialize(){
        $this->userInfo=db('users')->alias('u')
            ->join(config('database.prefix').'user_level ul','u.level = ul.level_id','left')
            ->where(['u.id'=>session('user.id')])
            ->field('u.*,ul.level_name')
            ->find();
        $this->assign('userInfo',$this->userInfo);
    }
    public function _empty(){
        return $this->error('空操作，返回上次访问页面中...');
    }
    //退出登陆
    public function logout(){
        session('user',null);
        $this->redirect('login/index');
    }
}