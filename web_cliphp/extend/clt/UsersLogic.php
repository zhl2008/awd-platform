<?php
namespace clt;
use think\Model;
use think\Page;
use think\db;
/**
 * 分类逻辑定义
 * Class CatsLogic
 * @package clt
 */
class UsersLogic extends Model
{
    //绑定账号
    public function oauth_bind($data = array()){
    	$user = session('user');
    	if(!empty($data['openid'])){
    		if(db('users')->where(array('openid'=>$data['openid']))->count()>0){
    			return array('status'=>0,'msg'=>'您的'.$data['oauth'].'账号已经绑定过账号');
    		}else{
    			 db('users')->where(array('id'=>$user['id']))->update(array('oauth'=>$data['oauth'],'openid'=>$data['openid'],'token'=>$data['token']));
    			 return array('status'=>1,'msg'=>'绑定成功');
    		}
    	}else{
    		return array('status'=>0,'msg'=>'您的账号已绑定过，请不要重复绑定');
    	}
    }
    /*
     * 第三方登录
     */
    public function thirdLogin($data=array()){
        $openid = $data['openid']; //第三方返回唯一标识
        $oauth = $data['oauth']; //来源
        if(!$openid || !$oauth){
            return array('status'=>-1,'msg'=>'参数有误','result'=>'');
        }
        //获取用户信息
        if(isset($data['unionid'])){
        	$map['unionid'] = $data['unionid'];
        	$user = get_user_info($data['unionid'],4,$oauth);
        }else{
        	$user = get_user_info($openid,3,$oauth);
        }
        if(!$user){
            //账户不存在 注册一个
            $map['password'] = '';
            $map['openid'] = $openid;
            $map['username'] = $data['username'];
            $map['reg_time'] = time();
            $map['oauth'] = $oauth;
            $map['avatar'] = $data['avatar'];
            $map['sex'] = empty($data['sex']) ? 0 : $data['sex'];
            $map['token'] = md5(time().mt_rand(1,99999));
            $userId = db('users')->insertGetId($map);
            $user = db('users')->where("id",$userId)->find();
        }else{
            $user['token'] = md5(time().mt_rand(1,999999999));
            db('users')->where("id", $user['id'])->update(array('token'=>$user['token'],'last_login'=>time()));
        }
        return array('status'=>1,'msg'=>'登录成功','result'=>$user);
    }

    /**
     * 邮箱或手机绑定
     * @param $email_mobile  邮箱或者手机
     * @param int $type  1 为更新邮箱模式  2 手机
     * @param int $user_id  用户id
     * @return bool
     */
    public function update_email_mobile($email_mobile,$user_id,$type=1){
        //检查是否存在邮件
        if($type == 1)
            $field = 'email';
        if($type == 2)
            $field = 'mobile';
        $condition['id'] = array('neq',$user_id);
        $condition[$field] = $email_mobile;

        $is_exist = db('users')->where($condition)->find();
        if($is_exist)
            return false;
        unset($condition[$field]);
        $condition['id'] = $user_id;
        $validate = $field.'_validated';
        db('users')->where($condition)->update(array($field=>$email_mobile,$validate=>1));
        return true;
    }





}