<?php
/**
 * tpshop
 * ============================================================================
 * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 采用TP5助手函数可实现单字母函数M D U等,也可db::name方式,可双向兼容
 * ============================================================================
 * 评论管理控制器
 * Date: 2015-10-20
 */

namespace app\admin\controller;

use think\AjaxPage;
use think\Page;

class Comment extends Base {


    public function index(){
        return $this->fetch();
    }

    public function detail(){
        $id = I('get.id/d');
        $res = M('comment')->where(array('comment_id'=>$id))->find();
        if(!$res){
            exit($this->error('不存在该评论'));
        }
        if(IS_POST){
            $add['parent_id'] = $id;
            $add['content'] = trim(I('post.content'));
            $add['goods_id'] = $res['goods_id'];
            $add['add_time'] = time();
            $add['username'] = 'admin';
            $add['is_show'] = 1;
            empty($add['content']) && $this->error('请填写回复内容');
            $row =  M('comment')->add($add);
            if($row){
                $this->success('添加成功');
            }else{
                $this->error('添加失败');
            }
            exit;

        }
        $reply = M('comment')->where(array('parent_id'=>$id))->select(); // 评论回复列表
         
        $this->assign('comment',$res);
        $this->assign('reply',$reply);
        return $this->fetch();
    }


    /***
     *操作商品评论
     */
    public function commentHandle(){
        $type = I('post.type');
        $ids = I('post.ids','');
        if(!in_array($type, array('del', 'show', 'hide')) || empty($ids)){
            $this->ajaxReturn(['status' => -1,'msg' => '非法操作！']);
        }
        $comment_ids = rtrim($ids,",");
        $row = false;
        if ($type == 'del') {
            //删除咨询
            $row = $row = M('comment')->where('comment_id', 'IN', $comment_ids)->whereOr('parent_id', 'IN', $comment_ids)->delete();
        }
        if ($type == 'show') {
            $row = M('comment')->where('comment_id', 'IN', $comment_ids)->save(['is_show' => 1]);
        }
        if ($type == 'hide') {
            $row = M('comment')->where('comment_id', 'IN', $comment_ids)->save(['is_show' => 0]);
        }
        if($row !== false){
            $this->ajaxReturn(['status' => 1,'msg' => '操作完成','url'=>U('Admin/Comment/index')]);
        }else{
            $this->ajaxReturn(['status' => -1,'msg' => '操作失败','url'=>U('Admin/Comment/index')]);
        }
    }

    public function ajaxindex(){
        $model = M('comment');
        $username = I('nickname','','trim');
        $content = I('content','','trim');
        $where['parent_id'] = 0;
        if($username){
            $where['username'] = $username;
        }
        if ($content) {
            $where['content'] = ['like', '%' . $content . '%'];
        }
        $count = $model->where($where)->count();
        $Page = $pager = new AjaxPage($count,16);
        $show = $Page->show();
                
        $comment_list = $model->where($where)->order('add_time DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
        if(!empty($comment_list))
        {
            $goods_id_arr = get_arr_column($comment_list, 'goods_id');
            $goods_list = M('Goods')->where("goods_id", "in" , implode(',', $goods_id_arr))->getField("goods_id,goods_name");
        }
        $this->assign('goods_list',$goods_list);
        $this->assign('comment_list',$comment_list);
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('pager',$pager);// 赋值分页输出
        return $this->fetch();
    }
    
    public function ask_list(){
    	return $this->fetch();
    }
    
    public function ajax_ask_list(){
    	$model = M('goods_consult');
    	$username = I('username','','trim');
    	$content = I('content','','trim');
    	$where=' parent_id = 0';
    	if($username){
    		$where .= " AND username='$username'";
    	}
    	if($content){
    		$where .= " AND content like '%{$content}%'";
    	}
        $count = $model->where($where)->count();        
        $Page  = $pager = new AjaxPage($count,10);
        $show  = $Page->show();            	
    	
        $comment_list = $model->where($where)->order('add_time DESC')->limit($Page->firstRow.','.$Page->listRows)->select(); 
    	if(!empty($comment_list))
    	{
    		$goods_id_arr = get_arr_column($comment_list, 'goods_id');
    		$goods_list = M('Goods')->where("goods_id", "in", implode(',', $goods_id_arr))->getField("goods_id,goods_name");
    	}
    	$consult_type = array(0=>'默认咨询',1=>'商品咨询',2=>'支付咨询',3=>'配送',4=>'售后');
    	$this->assign('consult_type',$consult_type);
    	$this->assign('goods_list',$goods_list);
    	$this->assign('comment_list',$comment_list);
    	$this->assign('page',$show);// 赋值分页输出
        $this->assign('pager',$pager);// 赋值分页输出
    	return $this->fetch();
    }
    
    public function consult_info(){
    	$id = I('id/d',0);
    	$res = M('goods_consult')->where(array('id'=>$id))->find();
    	if(!$res){
    		exit($this->error('不存在该咨询'));
    	}
    	if(IS_POST){
    		$add['parent_id'] = $id;
    		$add['content'] = I('post.content');
    		$add['goods_id'] = $res['goods_id'];
            $add['consult_type'] = $res['consult_type'];
    		$add['add_time'] = time();    		
    		$add['is_show'] = 1;   	
    		$row =  M('goods_consult')->add($add);
            if ($row) {
                $add['add_time']=date('Y-m-d H:i',$add['add_time']);
                $this->ajaxReturn(['status'=>1,'msg'=>'添加成功','resault'=>$add]);
            } else {
                $this->ajaxReturn(['status'=>1,'msg'=>'添加成功']);
            }
    		exit;    	
    	}
    	$reply = M('goods_consult')->where(array('parent_id'=>$id))->select(); // 咨询回复列表
        $this->assign('id', $id);
    	$this->assign('comment',$res);
    	$this->assign('reply',$reply);
    	return $this->fetch();
    }

    public function ask_handle()
    {
        $type = I('post.type');
        $ids = I('ids','');
        if(!in_array($type, array('del', 'show', 'hide')) || empty($ids)){
            $this->ajaxReturn(['status' => -1,'msg' => '非法操作！']);
        }
        $selected_id = rtrim($ids,",");
        $row = false;
        if ($type == 'del') {
            //删除咨询
            $row = M('goods_consult')->where('id', 'IN', $selected_id)->whereOr('parent_id', 'IN', $selected_id)->delete();
        }
        if ($type == 'show') {
            $row = M('goods_consult')->where('id', 'IN', $selected_id)->save(array('is_show' => 1));
        }
        if ($type == 'hide') {
            $row = M('goods_consult')->where('id', 'IN', $selected_id)->save(array('is_show' => 0));
        }
        if($row !== false){
            $this->ajaxReturn(['status' => 1,'msg' => '操作完成','url'=>U('Admin/Comment/ask_list')]);
        }else{
            $this->ajaxReturn(['status' => -1,'msg' => '操作失败','url'=>U('Admin/Comment/ask_list')]);
        }
    }
}