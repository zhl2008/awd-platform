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
 * Date: 2015-12-11
 */
namespace app\admin\controller;
use think\AjaxPage;
use think\Page;
use think\Db;
use think\Loader;

class Coupon extends Base {
    /**----------------------------------------------*/
     /*                优惠券控制器                  */
    /**----------------------------------------------*/
    /*
     * 优惠券类型列表
     */
    public function index(){
        //获取优惠券列表
        
    	$count =  M('coupon')->count();
    	$Page = new Page($count,10);
        $show = $Page->show();
        $lists = M('coupon')->order('add_time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('lists',$lists);
        $this->assign('pager',$Page);// 赋值分页输出
        $this->assign('page',$show);// 赋值分页输出   
        $this->assign('coupons',C('COUPON_TYPE'));
        return $this->fetch();
    }

    /*
     * 添加编辑一个优惠券类型
     */
    public function coupon_info(){
        if (IS_POST) {
            $data = I('post.');
            $data['send_start_time'] = strtotime($data['send_start_time']);
            $data['send_end_time'] = strtotime($data['send_end_time']);
            $data['use_end_time'] = strtotime($data['use_end_time']);
            $data['use_start_time'] = strtotime($data['use_start_time']);
            $couponValidate = Loader::validate('Coupon');
            if (!$couponValidate->batch()->check($data)) {
                $this->ajaxReturn(['status' => 0, 'msg' => '操作失败', 'result' => $couponValidate->getError()]);
            }
            if (empty($data['id'])) {
                $data['add_time'] = time();
                $row = Db::name('coupon')->insertGetId($data);
                //指定商品
                if($data['use_type'] == 1){
                    foreach ($data['goods_id'] as $v) {
                        Db::name('goods_coupon')->add(['coupon_id'=>$row,'goods_id'=>$v]);
                    }
                }
                //指定商品分类id
                if($data['use_type'] == 2){
                    Db::name('goods_coupon')->add(['coupon_id'=>$row,'goods_category_id'=>$data['cat_id3']]);
                }
            } else {
                $row = M('coupon')->where(array('id' => $data['id']))->save($data);
                Db::name('goods_coupon')->where('coupon_id',$data['id'])->delete();//先删除后添加
                //指定商品
                if($data['use_type'] == 1){
                    foreach ($data['goods_id'] as $v) {
                        Db::name('goods_coupon')->add(['coupon_id'=>$data['id'],'goods_id'=>$v]);
                    }
                }
                //指定商品分类id
                if($data['use_type'] == 2){
                    Db::name('goods_coupon')->add(['coupon_id'=>$data['id'],'goods_category_id'=>$data['cat_id3']]);
                }
            }
            if ($row !== false) {
                $this->ajaxReturn(['status' => 1, 'msg' => '编辑代金券成功', 'result' => '']);
            } else {
                $this->ajaxReturn(['status' => 0, 'msg' => '编辑代金券失败', 'result' => '']);
            }
        }
        $cid = I('get.id/d');
        if ($cid) {
            $coupon = M('coupon')->where(array('id' => $cid))->find();
            if (empty($coupon)) {
                $this->error('代金券不存在');
            }else{
                if($coupon['use_type'] == 2){
                    $goods_coupon = Db::name('goods_coupon')->where('coupon_id',$cid)->find();
                    $cat_info = M('goods_category')->where(array('id'=>$goods_coupon['goods_category_id']))->find();
                    $cat_path = explode('_', $cat_info['parent_id_path']);
                    $coupon['cat_id1'] = $cat_path[1];
                    $coupon['cat_id2'] = $cat_path[2];
                    $coupon['cat_id3'] = $goods_coupon['goods_category_id'];
                }
                if($coupon['use_type'] == 1){
                    $coupon_goods_ids = Db::name('goods_coupon')->where('coupon_id',$cid)->getField('goods_id',true);
                    $enable_goods = M('goods')->where("goods_id", "in", $coupon_goods_ids)->select();
                    $this->assign('enable_goods',$enable_goods);
                }
            }
            $this->assign('coupon', $coupon);
        } else {
            $def['send_start_time'] = strtotime("+1 day");
            $def['send_end_time'] = strtotime("+1 month");
            $def['use_start_time'] = strtotime("+1 day");
            $def['use_end_time'] = strtotime("+2 month");
            $this->assign('coupon', $def);
        }
        $cat_list = M('goods_category')->where(['parent_id' => 0])->select();//自营店已绑定所有分类
        $this->assign('cat_list',$cat_list);
        return $this->fetch();
    }

    /*
    * 优惠券发放
    */
    public function make_coupon(){
        //获取优惠券ID
        $cid = I('get.id/d');
        $type = I('get.type');
        //查询是否存在优惠券
        $data = M('coupon')->where(array('id'=>$cid))->find();
        $remain = $data['createnum'] - $data['send_num'];//剩余派发量
    	if($remain<=0 && $data['createnum']>0) $this->error($data['name'].'已经发放完了');
        if(!$data) $this->error("优惠券类型不存在");
        if($type != 3) $this->error("该优惠券类型不支持发放");
        if(IS_POST){
            $num  = I('post.num/d');
            if($num>$remain && $data['createnum']>0) $this->error($data['name'].'发放量不够了');
            if(!$num > 0) $this->error("发放数量不能小于0");
            $add['cid'] = $cid;
            $add['type'] = $type;
            $add['send_time'] = time();
            for($i=0;$i<$num; $i++){
                do{
                    $code = get_rand_str(8,0,1);//获取随机8位字符串
                    $check_exist = M('coupon_list')->where(array('code'=>$code))->find();
                }while($check_exist);
                $add['code'] = $code;
                M('coupon_list')->add($add);
            }
            M('coupon')->where("id",$cid)->setInc('send_num',$num);
            adminLog("发放".$num.'张'.$data['name']);
            $this->success("发放成功",U('Admin/Coupon/index'));
            exit;
        }
        $this->assign('coupon',$data);
        return $this->fetch();
    }
    
    public function ajax_get_user(){
    	//搜索条件
    	$condition = array();
    	I('mobile') ? $condition['mobile'] = I('mobile') : false;
    	I('email') ? $condition['email'] = I('email') : false;
    	I('level_id') ? $condition['level'] = I('level_id') : false;
        $cid = I('cid');
    	$nickname = I('nickname');
    	if(!empty($nickname)){
    		$condition['nickname'] = array('like',"%$nickname%");
    	}
        $issued_uids = Db::name('coupon_list')->where(['cid'=>$cid])->getField('uid',true); //已经发放的用户ID
    	$count = Db::name('users')->whereNotIn('user_id',$issued_uids)->where($condition)->count();
    	$Page  = new AjaxPage($count,10);
    	/*foreach($condition as $key=>$val) {
    		$Page->parameter[$key] = urlencode($val);
    	}*/
    	$show = $Page->show();
    	$userList = Db::name('users')->whereNotIn('user_id',$issued_uids)->where($condition)->order("user_id desc")->limit($Page->firstRow.','.$Page->listRows)->select();

        $user_level = M('user_level')->getField('level_id,level_name',true);       
        $this->assign('user_level',$user_level);
    	$this->assign('userList',$userList);
    	$this->assign('page',$show);
        $this->assign('pager',$Page);
    	return $this->fetch();
    }
    
    public function send_coupon(){
    	$cid = I('cid/d');
    	if(IS_POST){
    		$level_id = I('level_id');
    		$user_id = I('user_id/a');
    		$insert = '';
    		$coupon = M('coupon')->where("id",$cid)->find();
    		if($coupon['createnum']>0){
    			$remain = $coupon['createnum'] - $coupon['send_num'];//剩余派发量
    			if($remain<=0) $this->error($coupon['name'].'已经发放完了');
    		}
    		if(empty($user_id) && $level_id>=0){
    			if($level_id==0){
    				$user = M('users')->where("is_lock",0)->select();
    			}else{
    				$user = M('users')->where("is_lock",0)->where('level', $level_id)->select();
    			}
    			if($user){
    				$able = count($user);//本次发送量
    				if($coupon['createnum']>0 && $remain<$able){
    					$this->error($coupon['name'].'派发量只剩'.$remain.'张');
    				}
    				foreach ($user as $k=>$val){
    					$time = time();
                        $insert[] = ['cid' => $cid, 'type' => 1, 'uid' => $val['user_id'], 'send_time' => $time];
    				}
    			}
    		}else{
    			$able = count($user_id);//本次发送量
    			if($coupon['createnum']>0 && $remain<$able){
    				$this->error($coupon['name'].'派发量只剩'.$remain.'张');
    			}
    			foreach ($user_id as $k=>$v){
    				$time = time();
                    $insert[] = ['cid' => $cid, 'type' => 1, 'uid' => $v, 'send_time' => $time];
    			}
    		}
			DB::name('coupon_list')->insertAll($insert);
			M('coupon')->where("id",$cid)->setInc('send_num',$able);
			adminLog("发放".$able.'张'.$coupon['name']);
			$this->success("发放成功");
			exit;
    	}
    	$level = M('user_level')->select();
    	$this->assign('level',$level);
    	$this->assign('cid',$cid);
    	return $this->fetch();
    }
    
    public function send_cancel(){
    	
    }

    /*
     * 删除优惠券类型
     */
    public function del_coupon(){
        //获取优惠券ID
        $cid = I('get.id/d');
        //查询是否存在优惠券
        $row = M('coupon')->where(array('id'=>$cid))->delete();
        if (!$row) {
            $this->ajaxReturn(['status' => 0, 'msg' => '优惠券不存在，删除失败']);
        }
        
        //删除此类型下的优惠券
        M('coupon_list')->where(array('cid'=>$cid))->delete();
        $this->ajaxReturn(['status' => 1, 'msg' => '删除成功']);
    }


    /*
     * 优惠券详细查看
     */
    public function coupon_list(){
        //获取优惠券ID
        $cid = I('get.id/d');
        //查询是否存在优惠券
        $check_coupon = M('coupon')->field('id,type')->where(array('id'=>$cid))->find();
        if(!$check_coupon['id'] > 0)
            $this->error('不存在该类型优惠券');
       
        //查询该优惠券的列表的数量
        $sql = "SELECT count(1) as c FROM __PREFIX__coupon_list  l ".
                "LEFT JOIN __PREFIX__coupon c ON c.id = l.cid ". //联合优惠券表查询名称
                "LEFT JOIN __PREFIX__order o ON o.order_id = l.order_id ".     //联合订单表查询订单编号
                "LEFT JOIN __PREFIX__users u ON u.user_id = l.uid WHERE l.cid = :cid";    //联合用户表去查询用户名
        
        $count = DB::query($sql,['cid' => $cid]);
        $count = $count[0]['c'];
    	$Page = new Page($count,10);
    	$show = $Page->show();
        
        //查询该优惠券的列表
        $sql = "SELECT l.*,c.name,o.order_sn,u.nickname FROM __PREFIX__coupon_list  l ".
                "LEFT JOIN __PREFIX__coupon c ON c.id = l.cid ". //联合优惠券表查询名称
                "LEFT JOIN __PREFIX__order o ON o.order_id = l.order_id ".     //联合订单表查询订单编号
                "LEFT JOIN __PREFIX__users u ON u.user_id = l.uid WHERE l.cid = :cid".    //联合用户表去查询用户名
                " limit {$Page->firstRow} , {$Page->listRows}";
        $coupon_list = DB::query($sql,['cid' => $cid]);
        $this->assign('coupon_type',C('COUPON_TYPE'));
        $this->assign('type',$check_coupon['type']);       
        $this->assign('lists',$coupon_list);            	
    	$this->assign('page',$show);
        $this->assign('pager',$Page);
        return $this->fetch();
    }
    
    /*
     * 删除一张优惠券
     */
    public function coupon_list_del(){
        //获取优惠券ID
        $cid = I('get.id');
        if(!$cid)
            $this->error("缺少参数值");
        //查询是否存在优惠券
         $row = M('coupon_list')->where(array('id'=>$cid))->delete();
        if(!$row)
            $this->error('删除失败');
        $this->success('删除成功');
    }
}