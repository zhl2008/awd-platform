<?php
namespace app\admin\controller;
use think\Db;
use think\Request;
use think\Controller;
class Debris extends Common
{
    public function index(){
        if(request()->isPost()) {
            $key = input('post.key');
            $this->assign('testkey', $key);
            $page =input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):config('pageSize');
            $list = Db::table(config('database.prefix') . 'debris')->alias('d')
                ->join(config('database.prefix') . 'debris_type dt', 'd.type_id = dt.id', 'left')
                ->field('d.*,dt.title as typename')
                ->where('d.title', 'like', "%" . $key . "%")
                ->order('d.sort')
                ->paginate(array('list_rows'=>$pageSize,'page'=>$page))
                ->toArray();
            foreach ($list['data'] as $k=>$v){
                $list['data'][$k]['addtime'] = date('Y-m-d H:i',$v['addtime']);
            }
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list['data'],'count'=>$list['total'],'rel'=>1];
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
            db('debris')->insert($data);
            $result['code'] = 1;
            $result['msg'] = '碎片添加成功!';
            $result['url'] = url('index');
            return $result;
        }else{
            $debrisTypeList=db('debris_type')->order('sort')->select();//获取所有广告位
            $this->assign('debrisTypeList',json_encode($debrisTypeList,true));

            $this->assign('title',lang('add').lang('debris'));
            $this->assign('info','null');
            return $this->fetch('form');
        }
    }
    public function edit(){
        if(request()->isPost()) {
            $data = input('post.');
            $typeId = explode(':',$data['type_id']);
            $data['type_id'] =$typeId[1];
            db('debris')->where('id',$data['id'])->update($data);
            $result['code'] = 1;
            $result['msg'] = '碎片修改成功!';
            $result['url'] = url('index');
            return $result;
        }else{
            $id=input('id');
            $info=db('debris')->where(array('id'=>$id))->find();
            $this->assign('info',json_encode($info,true));

            $debrisTypeList=db('debris_type')->order('sort')->select();//获取所有广告位
            $this->assign('debrisTypeList',json_encode($debrisTypeList,true));

            $this->assign('title',lang('edit').lang('debris'));
            return $this->fetch('form');
        }
    }
    public function del(){
        db('debris')->where('id',input('post.id'))->delete();
        return ['code'=>1,'msg'=>'删除成功！'];
    }
    public function debrisOrder(){
        $data = input('post.');
        if(db('debris')->update($data)!==false){
            return $result = ['msg' => '操作成功！','url'=>url('index'), 'code' =>1];
        }else{
            return $result = ['code'=>0,'msg'=>'操作失败！'];
        }
    }

    public function delall(){
        $map['id'] =array('in',input('param.ids/a'));
        db('debris')->where($map)->delete();

        $result['msg'] = '删除成功！';
        $result['code'] = 1;
        $result['url'] = url('index');
        return $result;
    }

    /*************************类别*************************/
    public function type(){
        if(request()->isPost()) {
            $key = input('key');
            $this->assign('testkey', $key);
            $list = db('debris_type')->where('title', 'like', "%" . $key . "%")->order('sort')->select();
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list,'rel'=>1];
        }
        return $this->fetch();
    }
    public function addType(){
        if(request()->isPost()) {
            db('debris_type')->insert(input('post.'));
            $result['code'] = 1;
            $result['msg'] = '碎片分类保存成功!';
            $result['url'] = url('type');
            return $result;
        }else{
            $this->assign('title',lang('add').'碎片分类');
            $this->assign('info','null');
            return $this->fetch('typeForm');
        }
    }
    public function editType(){
        if(request()->isPost()) {
            db('debris_type')->update(input('post.'));
            $result['code'] = 1;
            $result['msg'] = '碎片分类修改成功!';
            $result['url'] = url('type');
            return $result;
        }else{
            $id=input('param.id');
            $info=db('debris_type')->where('id',$id)->find();
            $this->assign('title',lang('edit').'碎片分类');
            $this->assign('info',json_encode($info,true));
            return $this->fetch('typeForm');
        }
    }
    public function typeOrder(){
        $debris_type=db('debris_type');
        $data = input('post.');
        if($debris_type->update($data)!==false){
            return $result = ['msg' => '操作成功！','url'=>url('type'), 'code' =>1];
        }else{
            return $result = ['code'=>0,'msg'=>'操作失败！'];
        }
    }
    public function delType(){
        $id = input('post.id');
        db('debris_type')->where(['id'=>$id])->delete();//删除广告位
        db('debris')->where(['type_id'=>$id])->delete();//删除该广告位所有广告
        return ['code'=>1,'msg'=>'删除成功！'];
    }

}