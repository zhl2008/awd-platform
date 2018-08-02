<?php
namespace app\user\controller;
use think\Controller;
class Login extends Controller{
    public function _initialize(){
        if (session('user.id')) {
            $this->redirect('index/index');
        }
    }
    public function index(){
        if(request()->isPost()) {
            $table = db('users');
            $username = input('username');
            $password = input('password');
            $code = input('vercode');
            if(!$this->check($code)){
                return array('code' => 0, 'msg' => '验证码错误');
            }
            if(!$username || !$password){
                return array('code'=>0,'msg'=>'请填写账号或密码');
            }
            $user = $table->where("mobile",$username)->whereOr('email',$username)->find();
            if(!$user){
                return array('code'=>0,'msg'=>'账号不存在!');
            }elseif(md5($password) != $user['password']){
                return array('code'=>0,'msg'=>'密码错误!');
            }elseif($user['is_lock'] == 1){
                return array('code'=>0,'msg'=>'账号异常已被锁定！！！');
            }else{
                $sessionUser = $table->where("id",$user['id'])->field('id,username')->find();
                session('user',$sessionUser);
                return array('code'=>1,'msg'=>'登录成功','url' => url('index/index'));
            }
        }else{
            $plugin = db('plugin')->where(['type'=>'login','status'=>1])->select();
            $this->assign('plugin', $plugin);
            $this->assign('title','会员登录');
            return $this->fetch();
        }
    }
    public function check($code){
        if (!captcha_check($code)) {
            return false;
        } else {
            return true;
        }
    }

    public function reg(){
        if(request()->isPost()) {
            $data = input('post.');
            $code = $data['vercode'];
            if(!$this->check($code)){
                return array('code' => 0, 'msg' => '验证码错误');
            }
            $is_validated = 0 ;
            if(is_email($data['email'])){
                $is_validated = 1;
                $map['email_validated'] = 1;
                $map['email'] = $data['email']; //邮箱注册
            }
            if(is_mobile_phone($data['email'])){
                $is_validated = 1;
                $map['mobile_validated'] = 1;
                $map['mobile'] = $data['email']; //手机注册
            }
            if($is_validated != 1){
                return array('code'=>0,'msg'=>'请用手机号或邮箱注册');
            }
            if(!$data['username'] || !$data['password']){
                return array('code'=>-1,'msg'=>'请输入昵称或密码');
            }
            //验证两次密码是否匹配
            if($data['password'] != $data['password2']){
                return array('code'=>-1,'msg'=>'两次输入密码不一致');
            }
            //验证是否存在用户名
            if(get_user_info($data['email'],1)||get_user_info($data['mobile'],2)){
                return array('code'=>-1,'msg'=>'账号已存在');
            }
            $map['username'] = $data['username'];
            $map['password'] = md5($data['password']);
            $map['reg_time'] = time();
            $map['token'] = md5(time().mt_rand(1,99999));
            $id = db('users')->insertGetId($map);
            if($id === false){
                return array('code'=>-1,'msg'=>'注册失败');
            }
            $user = db('users')->field('id,username')->where("id", $id)->find();
            session('user',$user);
            return array('code'=>1,'msg'=>'注册成功','result'=>$user);
        }else {
            $plugin = db('plugin')->where(['type' => 'login', 'status' => 1])->select();
            $this->assign('plugin', $plugin);
            $this->assign('title', '会员注册');
            return $this->fetch();
        }
    }

    public function forget(){
        if(request()->isPost()) {
            $sender = input('email');
            $code =input('code');
            $inValid = true;  //验证码失效
            if(!$code){
                return array('code'=>-1,'msg'=>'请输入邮件验证码');
            }
            $data = session('validate_code');
            $timeOut = $data['time'];
            if($data['code'] != $code || $data['sender']!=$sender){
                $inValid = false;
            }
            $password = input('password');
            $password2 = input('password2');
            if($password != $password2){
                return array('code'=>-1,'msg'=>'两次输入密码不一致');
            }
            if(empty($data)){
                return array('code'=>-1,'msg'=>'请先获取验证码');
            }elseif($timeOut < time()){
                return array('code'=>-1,'msg'=>'验证码已超时失效');
            }elseif(!$inValid) {
                return array('status'=>-1,'msg'=>'验证失败,验证码有误');
            }else{
                $data['is_check'] = 1; //标示验证通过
                session('validate_code',$data);
                db('users')->where(['email'=>$sender])->update(['password'=>md5($password)]);
                return array('code'=>1,'msg'=>'密码找回成功！');
            }
        }else{
            $this->assign('title','找回密码');
            return $this->fetch();
        }
    }
    /**
     * 发送邮件验证码
     * @param $sender 接收人
     * @return json
     */
    public function sendEmail(){
        if(request()->isPost()) {
            $sender = input('email');
            $sms_time_out = 180;
            //获取上一次的发送时间
            $send = session('validate_code');
            if (!empty($send) && $send['time'] > time() && $send['sender'] == $sender) {
                //在有效期范围内 相同号码不再发送
                return json(['code' => -1, 'msg' => '规定时间内,不要重复发送验证码']);
            }
            $code = mt_rand(1000, 9999);
            //检查是否邮箱格式
            if (!is_email($sender)) {
                return json(['code' => -1, 'msg' => '邮箱码格式有误']);
            }
            $send = send_email($sender, '验证码', '您好，你的验证码是：' . $code);
            if ($send) {
                $info['code'] = $code;
                $info['sender'] = $sender;
                $info['is_check'] = 0;
                $info['time'] = time() + $sms_time_out; //有效验证时间
                session('validate_code', $info);
                return json(['code' => 1, 'msg' => '验证码已发送，请注意查收']);
            }else{
                return array('code' => -1, 'msg' => '验证码发送失败,请联系管理员');
            }
        }else{
            return json(['code' => -1, 'msg' => '非法请求']);
        }
    }
}