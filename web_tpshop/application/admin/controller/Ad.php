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
 * Author: 当燃      
 * Date: 2015-09-21
 */

namespace app\admin\controller;
use think\Db;
use think\Page;
use app\admin\logic\GoodsLogic;
use app\admin\model\Goods;

class Ad extends Base{
    public function ad(){       
        $act = I('get.act','add');
        $ad_id = I('get.ad_id/d');
        $is_app_ad = I('get.is_app_ad/d');//是否APP广告
         
        $ad_info = array();
        if($ad_id){
            $ad_info = D('ad')->where('ad_id',$ad_id)->find();
            $ad_info['start_time'] = date('Y-m-d',$ad_info['start_time']);
            $ad_info['end_time'] = date('Y-m-d',$ad_info['end_time']);            
        }
        if($act == 'add')          
           $ad_info['pid'] = $this->request->param('pid');
 
        
        
        if($is_app_ad == 1){
            $cat_list = M('goods_category')->where("parent_id = 0")->select(); // 已经改成联动菜单
            $this->assign('cat_list',$cat_list);
            
            if($ad_info && $ad_info['media_type'] == 3){//如果广告类型是商品,则查找商品的名称 
               $ad_info['goods_name'] = M('goods')->where('goods_id' , $ad_info['ad_link'])->getField("goods_name");
            }else if($ad_info && $ad_info['media_type'] == 4){//如果广告类型是商品分类,则拆解分类
                $cat_ids = explode('_',$ad_info['ad_link']); 
                $ad_info['cat_id1'] = $cat_ids[0];
                $ad_info['cat_id2'] = $cat_ids[1];
                $ad_info['cat_id3'] = $cat_ids[2];
            }
        }
        
        $position = D('ad_position')->select();
        $this->assign('info',$ad_info);
        $this->assign('act',$act);
        $this->assign('position',$position);
        return $this->fetch();
    }
    
    public function adList(){
        
        delFile(RUNTIME_PATH.'html'); // 先清除缓存, 否则不好预览
        
      
        
            
        $Ad =  M('ad');         
        $pid = I('pid',0);
        if($pid){
            $where['pid'] = $pid;
        	$this->assign('pid',I('pid'));
        }
        $keywords = I('keywords/s',false,'trim');
        if($keywords){
            $where['ad_name'] = array('like','%'.$keywords.'%');
        }
        $count = $Ad->where($where)->count();// 查询满足要求的总记录数
        $Page = $pager = new Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        $res = $Ad->where($where)->order('pid desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $list = array();
        if($res){
        	$media = array('图片','文字','flash');
        	foreach ($res as $val){
        		$val['media_type'] = $media[$val['media_type']];        		
        		$list[] = $val;
        	}
        }
                                     
        $ad_position_list = M('AdPosition')->getField("position_id,position_name,is_open");                        
        $this->assign('ad_position_list',$ad_position_list);//广告位 
        $show = $Page->show();// 分页显示输出
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('pager',$pager);     

        //判断API模块存在
        if(is_dir(APP_PATH."/api")) $this->assign('is_exists_api',1);
       
        
        return $this->fetch();
    }
    
    public function position(){
        $act = I('get.act','add');
        $position_id = I('get.position_id/d');
        $info = array();
        if($position_id){
            $info = D('ad_position')->where('position_id',$position_id)->find();
        }
        $this->assign('info',$info);
        $this->assign('act',$act);
        return $this->fetch();
    }

    public function positionList()
    {
        $count = Db::name('ad_position')->count();// 查询满足要求的总记录数
        $Page = $pager = new Page($count, 10);// 实例化分页类 传入总记录数和每页显示的记录数
        $list = Db::name('ad_position')->order('position_id DESC')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $show = $Page->show();
        $this->assign('list', $list);
        $this->assign('page', $show);
        $this->assign('pager', $Page);
        return $this->fetch();
    }
    
    public function adHandle(){
    	$data = I('post.');
    	$data['start_time'] = strtotime($data['begin']);
    	$data['end_time'] = strtotime($data['end']);
    	
    	$media_type = $data['media_type'];
    	if($media_type == 3){//商品
    	    $data['ad_link'] = $data['goods_id'];
    	}else if($media_type == 4){//分类
    	    $data['ad_link'] = $data['cat_id1'].'_'.$data['cat_id2'].'_'.$data['cat_id3'];
    	}
 
    	if($data['act'] == 'add'){
    		$r = D('ad')->add($data);
    	}
    	if($data['act'] == 'edit'){
    		$r = D('ad')->where('ad_id', $data['ad_id'])->save($data);
    	}
    	
    	if($data['act'] == 'del'){
            $r = D('ad')->where('ad_id', $data['del_id'])->delete();
            if($r){
                $this->ajaxReturn(['status'=>1,'msg'=>"操作成功",'url'=>U('Admin/Ad/adList')]);
            }else{
                $this->ajaxReturn(['status'=>-1,'msg'=>"操作失败"]);
            }
    	}
    	$referurl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : U('Admin/Ad/adList');
        // 不管是添加还是修改广告 都清除一下缓存
        delFile(RUNTIME_PATH.'html'); // 先清除缓存, 否则不好预览
        \think\Cache::clear();
    	if($r){
    		$this->success("操作成功",U('Admin/Ad/adList'));
    	}else{
    		$this->error("操作失败",$referurl);
    	}
    }
    
    public function positionHandle(){
        $data = I('post.');
        if($data['act'] == 'add'){
            $r = M('ad_position')->add($data);
        }
        
        if($data['act'] == 'edit'){
        	$r = M('ad_position')->where('position_id',$data['position_id'])->save($data);
        }
        
        if($data['act'] == 'del'){
        	if(M('ad')->where('pid',$data['position_id'])->count()>0){
        		$this->error("此广告位下还有广告，请先清除",U('Admin/Ad/positionList'));
        	}else{
        		$r = M('ad_position')->where('position_id', $data['position_id'])->delete();
        		if($r) exit(json_encode(1));
        	}
        }
        $referurl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : U('Admin/Ad/positionList');
        if($r){
        	$this->success("操作成功",$referurl);
        }else{
        	$this->error("操作失败",$referurl);
        }
    }
    
/**
     * APP端编辑广告需要选择的商品
     * @return \think\mixed
     */
    public function search_goods()
    {
        $goods_id = I('goods_id/d');
        $brand_id = I('brand_id/d');
        $keywords = I('keywords');
        $goods_id = I('goods_id');
        $cat_id = I('cat_id/d'); 
        $intro = input('intro');//推荐/新品
    
        $GoodsLogic = new GoodsLogic();
        $brandList = $GoodsLogic->getSortBrands();
        $categoryList = $GoodsLogic->getSortCategory();
          
        $where = ['is_on_sale' => 1,
            'prom_type' => 0,
            'is_virtual'=>0,
            'store_count'=>['gt',0] 
        ];  //搜索条件
        
        if (!empty($goods_id)) {
            $where['goods_id'] = array('notin', $goods_id);
        }
        
        if ($cat_id) {
            $this->assign('cat_id', $cat_id);
            $grandson_ids = getCatGrandson($cat_id);
            $where['cat_id'] = ['in',implode(',', $grandson_ids)];
        }
    
        if ($brand_id) {
            $this->assign('brand_id', $brand_id);
            $where['brand_id'] = $brand_id;
        }
        if ($keywords) {
            $this->assign('keywords', $keywords);
            $where['goods_name|keywords'] = array('like', '%' . $keywords . '%');
        }
        if($intro){
            $where[I('intro')] = 1;
        }
        $Goods = new Goods();
        $count = $Goods->where($where)->count();
        $Page = new Page($count, 10);
        $goodsList = $Goods->where($where)->order('goods_id DESC')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $show = $Page->show();//分页显示输出
        $this->assign('page', $show);//赋值分页输出
        $this->assign('goodsList', $goodsList);
        $this->assign('categoryList', $categoryList);
        $this->assign('brandList', $brandList);
        return $this->fetch();
    }
    
    public function changeAdField(){
        $field = $this->request->request('field');
    	$data[$field] = I('get.value');
    	$data['ad_id'] = I('get.ad_id');
    	M('ad')->save($data); // 根据条件保存修改的数据
    }
    
    public function ad_app_home(){
       
        return $this->fetch();
    }
    
	
    
    
    /**
     * 编辑广告中转方法
     */
    public function editAd()
    { 
        $img_url = I('img_url');
        $pid = I('pid/d',0); 
        \think\Cache::clear();        
        $request_url = urldecode(I('request_url'));
        $request_url = urldecode($request_url);
        $request_url = U($request_url,array('edit_ad'=>1,'img_url'=>$img_url,'pid'=>$pid));
  
        echo "<script>location.href='".$request_url."';</script>";
        exit;                
    }
}