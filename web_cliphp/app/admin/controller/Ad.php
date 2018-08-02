<?php
namespace app\admin\controller;
use think\Db;
use think\Request;
use think\Controller;
class Ad extends Common
{
    public function _initialize(){
        parent::_initialize();
    }
    //广告列表
    public function index(){
        if(request()->isPost()) {
            $key = input('post.key');
            $this->assign('testkey', $key);
            $page =input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):config('pageSize');
            $list = Db::table(config('database.prefix') . 'ad')->alias('a')
                ->join(config('database.prefix') . 'ad_type at', 'a.type_id = at.type_id', 'left')
                ->field('a.*,at.name as typename')
                ->where('a.name', 'like', "%" . $key . "%")
                ->order('a.sort')
                ->paginate(array('list_rows'=>$pageSize,'page'=>$page))
                ->toArray();
            foreach ($list['data'] as $k=>$v){
                $list['data'][$k]['addtime'] = date('Y-m-d H:i',$v['addtime']);
            }
            return ['code'=>0,'msg'=>'获取成功!','data'=>$list['data'],'count'=>$list['total'],'rel'=>1];
        }
        return $this->fetch();
    }
    public function add(){
        if(request()->isPost()) {
            //构建数组
            $data = input('post.');
            $data['addtime'] = time();
            $typeId = explode(':',$data['type_id']);
            $data['type_id'] =$typeId[1];
            db('ad')->insert($data);
            $result['code'] = 1;
            $result['msg'] = '广告添加成功!';
            cache('adList', NULL);
            $result['url'] = url('index');
            return $result;
        }else{
            $adtypeList=db('ad_type')->order('sort')->select();
            $this->assign('adtypeList',json_encode($adtypeList,true));

            $this->assign('title',lang('add').lang('ad'));
            $this->assign('info','null');
            return $this->fetch('form');
        }
    }
    public function edit(){
        if(request()->isPost()) {
            $data = input('post.');
            $typeId = explode(':',$data['type_id']);
            $data['type_id'] =$typeId[1];
            db('ad')->update($data);
            $result['code'] = 1;
            $result['msg'] = '广告修改成功!';
            cache('adList', NULL);
            $result['url'] = url('index');
            return $result;
        }else{
            $adtypeList=db('ad_type')->order('sort')->select();
            $ad_id=input('ad_id');
            $adInfo=db('ad')->where(array('ad_id'=>$ad_id))->find();
            $this->assign('adtypeList',json_encode($adtypeList,true));
            $this->assign('info',json_encode($adInfo,true));
            $this->assign('title',lang('edit').lang('ad'));
            return $this->fetch('form');
        }
    }
    //设置广告状态
    public function editState(){
        $id=input('post.id');
        $open=input('post.open');
        if(db('ad')->where('ad_id='.$id)->update(['open'=>$open])!==false){
            return ['status'=>1,'msg'=>'设置成功!'];
        }else{
            return ['status'=>0,'msg'=>'设置失败!'];
        }
    }
    public function adOrder(){
        $ad=db('ad');
        $data = input('post.');
        if($ad->update($data)!==false){
            cache('adList', NULL);
            return $result = ['msg' => '操作成功！','url'=>url('index'), 'code' =>1];
        }else{
            return $result = ['code'=>0,'msg'=>'操作失败！'];
        }
    }
    public function del(){
        db('ad')->where(array('ad_id'=>input('ad_id')))->delete();
        cache('adList', NULL);
        return ['code'=>1,'msg'=>'删除成功！'];
    }
    public function delall(){
        $map['ad_id'] =array('in',input('param.ids/a'));
        db('ad')->where($map)->delete();
        cache('adList', NULL);
        $result['msg'] = '删除成功！';
        $result['code'] = 1;
        $result['url'] = url('index');
        return $result;
    }

    /***************************位置*****************************/
    //位置
    public function type(){
        if(request()->isPost()) {
            $key = input('key');
            $this->assign('testkey', $key);
            $list = db('ad_type')->where('name', 'like', "%" . $key . "%")->order('sort')->select();
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list,'rel'=>1];
        }
        return $this->fetch();
    }
    public function typeOrder(){
        $ad_type=db('ad_type');
        $data = input('post.');
        if($ad_type->update($data)!==false){
            return $result = ['msg' => '操作成功！','url'=>url('type'), 'code' =>1];
        }else{
            return $result = ['code'=>0,'msg'=>'操作失败！'];
        }
    }
    public function addType(){
        if(request()->isPost()) {
            db('ad_type')->insert(input('post.'));
            $result['code'] = 1;
            $result['msg'] = '广告位保存成功!';
            $result['url'] = url('type');
            return $result;
        }else{
            $this->assign('title',lang('add').lang('ad').'位');
            $this->assign('info','null');
            return $this->fetch('typeForm');
        }
    }
    public function editType(){
        if(request()->isPost()) {
            db('ad_type')->update(input('post.'));
            $result['code'] = 1;
            $result['msg'] = '广告位修改成功!';
            $result['url'] = url('type');
            return $result;
        }else{
            $type_id=input('param.type_id');
            $info=db('ad_type')->where('type_id',$type_id)->find();
            $this->assign('title',lang('edit').lang('ad').'位');
            $this->assign('info',json_encode($info,true));
            return $this->fetch('typeForm');
        }
    }
    public function delType(){
        $map['type_id'] = input('param.type_id');
        db('ad_type')->where($map)->delete();//删除广告位
        db('ad')->where($map)->delete();//删除该广告位所有广告
        return ['code'=>1,'msg'=>'删除成功！'];
    }
}