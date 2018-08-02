<?php
namespace app\admin\controller;
use think\Db;
use clt\Leftnav;
use app\admin\model\Admin;
use app\admin\model\AuthGroup;
use app\admin\model\authRule;
use think\Validate;
class Auth extends Common
{
    //管理员列表
    public function adminList(){
        if(request()->isPost()){
            $val=input('val');
            $url['val'] = $val;
            $this->assign('testval',$val);
            $map='';
            if($val){
                $map['username|email|tel']= array('like',"%".$val."%");
            }
            if (session('aid')!=1){
                $map['admin_id']=session('aid');
            }
            $list=Db::table(config('database.prefix').'admin')->alias('a')
                ->join(config('database.prefix').'auth_group ag','a.group_id = ag.group_id','left')
                ->field('a.*,ag.title')
                ->where($map)
                ->select();
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list,'rel'=>1];
        }
        return view();
    }

    public function adminAdd(){
        if(request()->isPost()){
            $data = input('post.');
            $check_user = Admin::get(['username'=>$data['username']]);
            if ($check_user) {
                return $result = ['code'=>0,'msg'=>'用户已存在，请重新输入用户名!'];
            }
            $data['pwd'] = input('post.pwd', '', 'md5');
            $data['add_time'] = time();
            $data['ip'] = request()->ip();
            //验证
            $msg = $this->validate($data,'Admin');
            if($msg!='true'){
                return $result = ['code'=>0,'msg'=>$msg];
            }
            //单独验证密码
            $checkPwd = Validate::is(input('post.pwd'),'require');
            if (false === $checkPwd) {
                return $result = ['code'=>0,'msg'=>'密码不能为空！'];
            }
            //添加
            if (Admin::create($data)) {
                return ['code'=>1,'msg'=>'管理员添加成功!','url'=>url('adminList')];
            } else {
                return ['code'=>0,'msg'=>'管理员添加失败!'];
            }
        }else{
            $auth_group=db('auth_group')->select();
            $this->assign('authGroup',json_encode($auth_group,true));
            $this->assign('title',lang('add').lang('admin'));
            $this->assign('info','null');
            $this->assign('selected', 'null');
            return view('adminForm');
        }
    }
    //删除管理员
    public function adminDel(){
        $admin_id=input('post.admin_id');
        if (session('aid')==1){
            Admin::destroy(['admin_id'=>$admin_id]);
            return $result = ['code'=>1,'msg'=>'删除成功!'];
        }else{
            return $result = ['code'=>0,'msg'=>'您没有删除管理员的权限!'];
        }
    }
    //修改管理员状态
    public function adminState(){
        $id=input('post.id');
        $is_open=input('post.is_open');
        if (empty($id)){
            $result['status'] = 0;
            $result['info'] = '用户ID不存在!';
            $result['url'] = url('adminList');
            return $result;
        }
        db('admin')->where('admin_id='.$id)->update(['is_open'=>$is_open]);
        $result['status'] = 1;
        $result['info'] = '用户状态修改成功!';
        $result['url'] = url('adminList');
        return $result;
    }
    //更新管理员信息
    public function adminEdit(){
        if(request()->isPost()){
            $data = input('post.');
            $pwd=input('post.pwd');

            $map['admin_id'] = array('neq',input('post.admin_id'));
            $where['admin_id'] = input('post.admin_id');
            if(input('post.username')){
                $map['username'] = input('post.username');
                $check_user = Admin::get($map);
                if ($check_user) {
                    return $result = ['code'=>0,'msg'=>'用户已存在，请重新输入用户名!'];
                }
            }
            if ($pwd){
                $data['pwd']=input('post.pwd','','md5');
            }else{
                unset($data['pwd']);
            }
            $msg = $this->validate($data,'Admin');
            if($msg!='true'){
                return $result = ['code'=>0,'msg'=>$msg];
            }
            Admin::update($data);
            session('username',$data['username']);
            $avatar = $data['avatar']==''?'/static/admin/images/0.jpg':$data['avatar'];
            session('avatar',$avatar);
            return $result = ['code'=>1,'msg'=>'管理员修改成功!','url'=>url('adminList')];
        }else{
            $auth_group = AuthGroup::all();
            $info = Admin::get(['admin_id'=>input('admin_id')]);
            $selected = db('auth_group')->where('group_id',$info['group_id'])->find();
            $this->assign('selected',json_encode($selected,true));
            $this->assign('info', $info->toJson());
            $this->assign('authGroup',json_encode($auth_group,true));
            $this->assign('title',lang('edit').lang('admin'));
            return view('adminForm');
        }
    }
    /*-----------------------用户组管理----------------------*/
    //用户组管理
    public function adminGroup(){
        if(request()->isPost()){
            $list = AuthGroup::all();
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list,'rel'=>1];
        }
        return view();
    }
    //删除管理员分组
    public function groupDel(){
        AuthGroup::destroy(['group_id'=>input('id')]);
        return $result = ['code'=>1,'msg'=>'删除成功!'];
    }
    //添加分组
    public function groupAdd(){
        if(request()->isPost()){
            $data=input('post.');
            $data['addtime']=time();
            AuthGroup::create($data);
            $result['msg'] = '用户组添加成功!';
            $result['url'] = url('adminGroup');
            $result['code'] = 1;
            return $result;
        }else{
            $this->assign('title','添加用户组');
            $this->assign('info','null');
            return $this->fetch('groupForm');
        }
    }
    //修改分组
    public function groupEdit(){
        if(request()->isPost()) {
            $data=input('post.');
            AuthGroup::update($data);
            $result = ['code'=>1,'msg'=>'用户组修改成功!','url'=>url('adminGroup')];
            return $result;
        }else{
            $id = input('id');
            $info = AuthGroup::get(['group_id'=>$id]);
            $this->assign('info', json_encode($info,true));
            $this->assign('title','编辑用户组');
            return $this->fetch('groupForm');
        }
    }
    //分组配置规则
    public function groupAccess(){
        $nav = new Leftnav();
        $admin_rule=db('auth_rule')->field('id,pid,title')->order('sort asc')->select();
        $rules = db('auth_group')->where('group_id',input('id'))->value('rules');
        $arr = $nav->auth($admin_rule,$pid=0,$rules);
        $arr[] = array(
            "id"=>0,
            "pid"=>0,
            "title"=>"全部",
            "open"=>true
        );
        $this->assign('data',json_encode($arr,true));
        return $this->fetch();
    }
    public function groupSetaccess(){
        $rules = input('post.rules');
        if(empty($rules)){
            return array('msg'=>'请选择权限!','code'=>0);
        }
        $data = input('post.');
        if(AuthGroup::update($data)){
            return array('msg'=>'权限配置成功!','url'=>url('adminGroup'),'code'=>1);
        }else{
            return array('msg'=>'保存错误','code'=>0);
        }
    }

    /********************************权限管理*******************************/
    public function adminRule(){
        if(request()->isPost()){
            $nav = new Leftnav();
            $arr = cache('authRuleList');
            if(!$arr){
                $authRule = authRule::all(function($query){
                    $query->order('sort', 'asc');
                });
                $arr = $nav->menu($authRule);
                cache('authRuleList', $arr, 3600);
            }
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$arr,'rel'=>1];
        }
        return view();
    }
    public function ruleAdd(){
        if(request()->isPost()){
            $data = input('post.');
            $data['addtime'] = time();
            authRule::create($data);
            cache('authRule', NULL);
            cache('authRuleList', NULL);
            return $result = ['code'=>1,'msg'=>'权限添加成功!','url'=>url('adminRule')];
        }else{
            $nav = new Leftnav();
            $arr = cache('authRuleList');
            if(!$arr){
                $authRule = authRule::all(function($query){
                    $query->order('sort', 'asc');
                });
                $arr = $nav->menu($authRule);
                cache('authRuleList', $arr, 3600);
            }
            $this->assign('admin_rule',$arr);//权限列表
            return $this->fetch();
        }
    }
    public function ruleOrder(){
        $auth_rule=db('auth_rule');
        $data = input('post.');
        if($auth_rule->update($data)!==false){
            cache('authRuleList', NULL);
            cache('authRule', NULL);
            return $result = ['code'=>1,'msg'=>'排序更新成功!','url'=>url('adminRule')];
        }else{
            return $result = ['code'=>0,'msg'=>'排序更新失败!'];
        }
    }
    //设置权限菜单显示或者隐藏
    public function ruleState(){
        $id=input('post.id');
        $menustatus=input('post.menustatus');
        if(db('auth_rule')->where('id='.$id)->update(['menustatus'=>$menustatus])!==false){
            cache('authRule', NULL);
            cache('authRuleList', NULL);
            return ['status'=>1,'msg'=>'设置成功!'];
        }else{
            return ['status'=>0,'msg'=>'设置失败!'];
        }
    }
    //设置权限是否验证
    public function ruleTz(){
        $id=input('post.id');
        $authopen=input('post.authopen');
        if(db('auth_rule')->where('id='.$id)->update(['authopen'=>$authopen])!==false){
            cache('authRule', NULL);
            cache('authRuleList', NULL);
            return ['status'=>1,'msg'=>'设置成功!'];
        }else{
            return ['status'=>0,'msg'=>'设置失败!'];
        }
    }
    public function ruleDel(){
        authRule::destroy(['id'=>input('param.id')]);
        cache('authRule', NULL);
        cache('authRuleList', NULL);
        return $result = ['code'=>1,'msg'=>'删除成功!'];
    }

    public function ruleEdit(){
        if(request()->isPost()) {
            $datas = input('post.');
            if(authRule::update($datas)) {
                cache('authRule', NULL);
                cache('authRuleList', NULL);
                return json(['code' => 1, 'msg' => '保存成功!', 'url' => url('adminRule')]);
            } else {
                return json(['code' => 0, 'msg' =>'保存失败！']);
            }
        }else{
            $admin_rule = authRule::get(function($query){
                $query->where(['id'=>input('id')])->field('id,href,title,icon,sort,menustatus');
            });
            $this->assign('rule',$admin_rule);
            return $this->fetch();
        }
    }
}