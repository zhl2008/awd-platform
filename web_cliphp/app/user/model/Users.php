<?php
namespace app\user\model;

use think\Model;

class Users extends Model
{
    public function login($data){
        $user=db('users')->where('email',$data['email'])->find();
        if($user){
            if($user['password'] == md5($data['password'])){
                session('nickname',$user['nickname']);
                session('uid',$user['user_id']);
                return 1; //信息正确
            }else{
                return -1; //密码错误
            }
        }else{
            return -1; //用户不存在
        }
    }
}