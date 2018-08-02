<?php
namespace app\admin\controller;
use think\Db;
use think\Request;
use think\Controller;
class Message extends Common
{
    public function index(){
        if(request()->isPost()) {
            $key=input('post.key');
            $page =input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):config('pageSize');
            $list = db('message')
                ->where('name|tel|content', 'like', "%" . $key . "%")
                ->order('addtime desc')
                ->paginate(array('list_rows'=>$pageSize,'page'=>$page))
                ->toArray();
            foreach ($list['data'] as $k=>$v){
                $list['data'][$k]['addtime'] = date('Y-m-d H:i',$v['addtime']);
            }
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list['data'],'count'=>$list['total'],'rel'=>1];
        }
        return $this->fetch();
    }
    //删除留言
    public function del(){
        $map['message_id']=input('message_id');
        db('message')->where($map)->delete();
        return $result = ['code'=>1,'msg'=>'删除成功!'];
    }
    public function delall(){
        $map['message_id'] =array('in',input('param.ids/a'));
        db('message')->where($map)->delete();
        $result['msg'] = '删除成功！';
        $result['code'] = 1;
        $result['url'] = url('index');
        return $result;
    }
}