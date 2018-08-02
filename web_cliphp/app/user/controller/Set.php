<?php
namespace app\user\controller;
use think\Input;
class Set extends Common{
    public function index(){
        if(request()->isPost()){
            $data = input('post.');
            $user = db('users');
            $oldEmail = $user->where(['id'=>$data['id']])->value('email');
            if($oldEmail != $data['eamil']){
                $data['email_validated'] = 0;
            }
            if (db('users')->update($data)!==false) {
                $result['msg'] = '编辑资料成功!';
                $result['status'] = 1;
            } else {
                $result['msg'] = '编辑资料失败!';
                $result['status'] = 0;
            }
            return $result;
        }else{
            $province = db('Region')->where ( array('pid'=>1) )->select ();
            $this->assign('province',$province);
            $city = db('Region')->where ( array('pid'=>$this->userInfo['province']) )->select ();
            $this->assign('city',$city);
            $district = db('Region')->where ( array('pid'=>$this->userInfo['city']) )->select ();
            $this->assign('district',$district);
            $this->assign('title','基本设置');
            return $this->fetch();
        }
    }
    public function getRegion(){
        $Region=db("region");
        $map['pid'] = input("pid");
        $list=$Region->where($map)->select();
        return $list;
    }
    public function avatar(){
        $data = input('post.');
        db('users')->where(['id'=>session('user.id')])->update($data);
        return true;
    }
    /**
     * 修改密码
     * @param $old_password  旧密码
     * @param $new_password  新密码
     * @param $confirm_password 确认新 密码
     */
    public function repass(){
        $old_password  = input('post.nowpass');
        $new_password = input('post.pass');
        $confirm_password = input('post.repass');

        if(strlen($new_password) < 6)
            return array('status'=>0,'msg'=>'密码不能低于6位字符');
        if($new_password != $confirm_password)
            return array('status'=>0,'msg'=>'两次密码输入不一致');
        //验证原密码
        if(($this->userInfo['password'] != '' && md5($old_password) != $this->userInfo['password']))
            return array('status'=>0,'msg'=>'密码验证失败');
        if(db('users')->where("id", session('user.id'))->update(array('password'=>md5($new_password)))!==false){

            return array('status'=>1,'msg'=>'修改成功','action'=>url('index'));
        }else{
            return array('status'=>0,'msg'=>'修改失败');
        }
    }
    public function unbind(){
        $data['oauth']='';
        $data['openid']='';
        $data['token']='';
        db('users')->where("id", session('user.id'))->update($data);
        return array('status'=>1,'msg'=>'QQ已解绑','action'=>url('index'));
    }
}