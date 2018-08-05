<?php
/**
 * tpshop
 * ============================================================================
 * * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * 订单以及售后中心
 * @author soubao 当燃
 *  @Date: 2016-12-20
 */
namespace app\home\controller;
use app\common\logic\MessageLogic;
use app\common\logic\OrderLogic;
use app\common\logic\CommentLogic;
use app\common\logic\UsersLogic;
use think\Db;
use think\Page;

class Order extends Base {

	public $user_id = 0;
	public $user = array();

    public function _initialize() {      
        parent::_initialize();
        if(session('?user'))
        {
        	$user = session('user');             
        	$this->user = $user;
        	$this->user_id = $user['user_id'];
        	$this->assign('user',$user); //存储用户信息
        	$this->assign('user_id',$this->user_id);
            //获取用户信息的数量
            $messageLogic = new MessageLogic();
            $user_message_count = $messageLogic->getUserMessageCount();
            $this->assign('user_message_count', $user_message_count);
        }else{
        	header("location:".U('Home/User/login'));
        	exit;
        }
        //用户中心面包屑导航
        $navigate_user = navigate_user();
        $this->assign('navigate_user',$navigate_user);        
    }

    /*
     * 订单列表
     */
    public function order_list(){
        $where = ' user_id=:user_id';
        $bind['user_id'] = $this->user_id;
        //条件搜索
       if(I('get.type')){
           $where .= C(strtoupper(I('get.type')));
       }
       // 搜索订单 根据商品名称 或者 订单编号
       $search_key = trim(I('search_key'));       
       if($search_key)
       {
          $where .= " and (order_sn like :search_key1 or order_id in (select order_id from `".C('database.prefix')."order_goods` where goods_name like :search_key2) ) ";
           $bind['search_key1'] = "%$search_key%";
           $bind['search_key2'] = "%$search_key%";
       }
        $where.=' and order_prom_type < 5 ';//虚拟拼团订单不列出来
        $count = M('order')->where($where)->bind($bind)->count();
        $Page = new Page($count,10);

        $show = $Page->show();
        $order_str = "order_id DESC";
        $order_list = M('order')->order($order_str)->where($where)->bind($bind)->limit($Page->firstRow.','.$Page->listRows)->select();

        //获取订单商品
        $model = new UsersLogic();
        foreach($order_list as $k=>$v)
        {
            $order_list[$k] = set_btn_order_status($v);  // 添加属性  包括按钮显示属性 和 订单状态显示属性
            //$order_list[$k]['total_fee'] = $v['goods_amount'] + $v['shipping_fee'] - $v['integral_money'] -$v['bonus'] - $v['discount']; //订单总额
            $data = $model->get_order_goods($v['order_id']);
            $order_list[$k]['goods_list'] = $data['result'];
            if($order_list[$k]['order_prom_type'] == 4){
                $pre_sell_item =  M('goods_activity')->where(array('act_id'=>$order_list[$k]['order_prom_id']))->find();
                $pre_sell_item = array_merge($pre_sell_item,unserialize($pre_sell_item['ext_info']));
                $order_list[$k]['pre_sell_is_finished'] = $pre_sell_item['is_finished'];
                $order_list[$k]['pre_sell_retainage_start'] = $pre_sell_item['retainage_start'];
                $order_list[$k]['pre_sell_retainage_end'] = $pre_sell_item['retainage_end'];
            }else{
                $order_list[$k]['pre_sell_is_finished'] = -1;//没有参与预售的订单
            }
        }
        $this->assign('order_status',C('ORDER_STATUS'));
        $this->assign('shipping_status',C('SHIPPING_STATUS'));
        $this->assign('pay_status',C('PAY_STATUS'));
        $this->assign('page',$show);
        $this->assign('lists',$order_list);
        $this->assign('active','order_list');
        $this->assign('active_status',I('get.type'));
        return $this->fetch();
    }

    /*
     * 订单详情
     */
    public function order_detail(){
        $id = I('get.id/d');
        $map['order_id'] = $id;
        $map['user_id'] = $this->user_id;
        $order_info = M('order')->where($map)->find();
        if(!$order_info){
            $this->error('没有获取到订单信息');
            exit;
        }
        $order_info = set_btn_order_status($order_info);  // 添加属性  包括按钮显示属性 和 订单状态显示属性
        if($order_info['order_prom_type'] == 5){   //虚拟订单
            $this->redirect(U('virtual/virtual_order',['order_id'=>$id]));
        }
        //获取订单商品
        $model = new UsersLogic();
        $data = $model->get_order_goods($order_info['order_id']);
        $order_info['goods_list'] = $data['result'];
        if($order_info['order_prom_type'] == 4){
            $pre_sell_item =  M('goods_activity')->where(array('act_id'=>$order_info['order_prom_id']))->find();
            $pre_sell_item = array_merge($pre_sell_item,unserialize($pre_sell_item['ext_info']));
            $order_info['pre_sell_is_finished'] = $pre_sell_item['is_finished'];
            $order_info['pre_sell_retainage_start'] = $pre_sell_item['retainage_start'];
            $order_info['pre_sell_retainage_end'] = $pre_sell_item['retainage_end'];
            $order_info['pre_sell_deliver_goods'] = $pre_sell_item['deliver_goods'];
        }else{
            $order_info['pre_sell_is_finished'] = -1;//没有参与预售的订单
        }
        //获取订单进度条
        $sql = "SELECT action_id,log_time,status_desc,order_status FROM ((SELECT * FROM __PREFIX__order_action WHERE order_id = :id AND status_desc <>'' ORDER BY action_id) AS a) GROUP BY status_desc ORDER BY action_id";
        $bind['id'] = $id;
        $items = DB::query($sql,$bind);
        $items_count = count($items);

        $ids = $order_info['province'].','.$order_info['city'].','.$order_info['district'];
        $region_list = M('region')->where("id in (".$ids.")")->getField("id,name");
        $invoice_no = M('DeliveryDoc')->where("order_id", $id)->getField('invoice_no',true);
        $order_info['invoice_no'] = implode(' , ', $invoice_no);
        //获取订单操作记录
        $order_action = M('order_action')->where(array('order_id'=>$id))->select();
        $this->assign('order_status',C('ORDER_STATUS'));
        $this->assign('shipping_status',C('SHIPPING_STATUS'));
        $this->assign('pay_status',C('PAY_STATUS'));
        $this->assign('region_list',$region_list);
        $this->assign('order_info',$order_info);
        $this->assign('order_action',$order_action);
        $this->assign('active','order_list');
        return $this->fetch();
    }

    public function del_order()
    {
        $order_id = I('order_id/d',0);
        $order_type = I('type/s');
        
        $orderLogic = new OrderLogic;
        $orderLogic->setUserId($this->user_id);
        $return = $orderLogic->delOrder($order_id);
        $this->ajaxReturn($return);
        //$this->success('删除成功',U('Home/Order/order_list', array('type'=>$order_type)));
    }

    /*
     * 取消订单
     */
    public function cancel_order(){
        $id = I('get.id/d');
        //检查是否有积分，余额支付
        $logic = new OrderLogic();
        $data = $logic->cancel_order($this->user_id,$id);
        if($data['status'] < 0)
            $this->error($data['msg']);
        $this->success($data['msg']);
    }

    public function cancel_order_info(){
    	$order_id = I('order_id/d',0);
    	$order = M('order')->where(array('order_id'=>$order_id,'order_status'=>3,'pay_status'=>1))->find();
    	$this->assign('order', $order);
    	return $this->fetch();
    }
    //取消订单弹窗
    public function refund_order()
    {
    	$order_id = I('get.order_id/d');
        
    	$order = M('order')
                ->field('order_id,pay_code,pay_name,user_money,integral_money,coupon_price,order_amount,total_amount')
                ->where(['order_id' => $order_id, 'user_id' => $this->user_id])
                ->find();
        
        if (!$order) {
            return $this->error('订单不存在');
        }
        
        $this->assign('user',  $this->user);
        $this->assign('order', $order);
    	return $this->fetch();
    }

    //申请取消订单
    public function record_refund_order()
    {
        $order_id   = input('post.order_id', 0);
        $user_note  = input('post.user_note', '');
        $consignee  = input('post.consignee', '');
        $mobile     = input('post.mobile', '');
        
        $logic = new OrderLogic;
        $return = $logic->recordRefundOrder($this->user_id, $order_id, $user_note, $consignee, $mobile);
        
        $this->ajaxReturn($return);
    }
    
    public function virtual_order(){
        $Order = new \app\common\model\Order();
    	$order_id = I('get.order_id/d');
    	$map['order_id'] = $order_id;
    	$map['user_id'] = $this->user_id;
    	$orderobj = $Order->where($map)->find();
        if(!$orderobj) $this->error('没有获取到订单信息');
        // 添加属性  包括按钮显示属性 和 订单状态显示属性
        $order_info = $orderobj->append(['order_status_detail','order_button','order_goods'])->toArray();
    	//获取订单操作记录
    	$order_action = M('order_action')->where(array('order_id'=>$order_id))->select();
    	$this->assign('order_status',C('ORDER_STATUS'));
    	$this->assign('pay_status',C('PAY_STATUS'));
    	$this->assign('order_info',$order_info);
    	$this->assign('order_action',$order_action);

    	if($order_info['pay_status'] == 1 && $order_info['order_status']!=3){
    		$vrorder = M('vr_order_code')->where(array('order_id'=>$order_id))->select();
    		$this->assign('vrorder',$vrorder);
    	}
    	return $this->fetch();
    }

        
    /*
     * 评论晒单
     */
    public function comment()
    {
        $user_id = $this->user_id;
        $status = I('get.status', -1);
        $logic = new CommentLogic;
        $data = $logic->getComment($user_id, $status); //获取评论列表
        $this->assign('page', $data['show']);// 赋值分页输出
        $this->assign('comment_page', $data['page']);
        $this->assign('comment_list', $data['result']);
        $this->assign('active', 'comment');
        return $this->fetch();
    }

    /**
     * 删除评价
     */
    public function delComment()
    {
        $comment_id = I('comment_id');
        if (empty($comment_id)) {
            $this->error('参数错误');
        }
        $comment = Db::name('comment')->where('comment_id', $comment_id)->find();
        if ($this->user_id != $comment['user_id']) {
            $this->error('不能删除别人的评论');
        }
        Db::name('reply')->where('comment_id', $comment_id)->delete();
        Db::name('comment')->where('comment_id', $comment_id)->delete();
        $this->success('删除评论成功');
    }

    /**
     *  点赞
     * @author dyr
     */
    public function ajaxZan()
    {
        $comment_id = I('post.comment_id/d');
        $user_id = $this->user_id;
        $comment_info = M('comment')->where(array('comment_id' => $comment_id))->find();
        $comment_user_id_array = explode(',', $comment_info['zan_userid']);
        if (in_array($user_id, $comment_user_id_array)) {
            $result['success'] = 0;
        } else {
            array_push($comment_user_id_array, $user_id);
            $comment_user_id_string = implode(',', $comment_user_id_array);
            $comment_data['zan_num'] = $comment_info['zan_num'] + 1;
            $comment_data['zan_userid'] = $comment_user_id_string;
            M('comment')->where(array('comment_id' => $comment_id))->save($comment_data);
            $result['success'] = 1;
        }
        exit(json_encode($result));
    }

    /**
     * 添加回复
     * @author dyr
     */
    public function reply_add()
    {
        $comment_id = I('post.comment_id/d');
        $reply_id = I('post.reply_id/d', 0);
        $content = I('post.content');
        $to_name = I('post.to_name', '');
        $goods_id = I('post.goods_id/d');
        $reply_data = array(
            'comment_id' => $comment_id,
            'parent_id' => $reply_id,
            'content' => $content,
            'user_name' => $this->user['nickname'],
            'to_name' => $to_name,
            'reply_time' => time()
        );
        $where = array('o.user_id' => $this->user_id, 'og.goods_id' => $goods_id, 'o.pay_status' => 1);
        $user_goods_count = Db::name('order')
            ->alias('o')
            ->join('__ORDER_GOODS__ og','o.order_id = og.order_id', 'LEFT')
            ->where($where)
            ->count();
        if ($user_goods_count > 0) {
            M('reply')->add($reply_data);
            M('comment')->where(array('comment_id' => $comment_id))->setInc('reply_num');
            $json['success'] = true;
        } else {
            $json['success'] = false;
            $json['msg'] = '只有购买过该商品才能进行评价';
        }
        $this->ajaxReturn($json);
    }
    
    public function order_confirm()
    {
    	$id = I('post.order_id/d', 0);
    	$data = confirm_order($id, $this->user_id);
        $this->ajaxReturn($data);
    }

    /**
     * 可申请退换货
     */
    public function return_goods_index(){
        $sale_t = I('sale_t/i',0);
        $keywords = I('keywords');
        $model = new OrderLogic();
        $data = $model->getReturnGoodsIndex($sale_t,$keywords,$this->user_id);
    	$this->assign('store_list',$data['store_list']);
    	$this->assign('order_list',$data['order_list']);
    	$this->assign('page',$data['show']);
    	return $this->fetch();
    }
    
    /**
     * 申请退货
     */
    public function return_goods()
    {
        $rec_id = I('rec_id',0);
        $return_goods = M('return_goods')->where(array('rec_id'=>$rec_id))->find();
        if(!empty($return_goods))
        {
            $this->error('已经提交过退货申请!',U('Order/return_goods_info',array('id'=>$return_goods['id'])));
        }
        $order_goods = M('order_goods')->where(array('rec_id'=>$rec_id))->find();
        $order = M('order')->where(array('order_id'=>$order_goods['order_id'],'user_id'=>$this->user_id))->find();
        $confirm_time_config = tpCache('shopping.auto_service_date');//后台设置多少天内可申请售后
        $confirm_time = $confirm_time_config * 24 * 60 * 60;
        if ((time() - $order['confirm_time']) > $confirm_time && !empty($order['confirm_time'])) {
            $this->error('已经超过' . $confirm_time_config . "天内退货时间");
//            return ['result'=>-1,'msg'=>'已经超过' . $confirm_time_config . "天内退货时间"];
        }
        if(empty($order))$this->error('非法操作');
        if(IS_POST)
        {
            $model = new OrderLogic();
            $res = $model->addReturnGoods($rec_id,$order);  //申请售后
            if($res['status']==1)$this->success($res['msg'],U('Order/return_goods_list'));
            $this->error($res['msg']);
        }
        $region_id[] = tpCache('shop_info.province');        
        $region_id[] = tpCache('shop_info.city');        
        $region_id[] = tpCache('shop_info.district');
        $region_id[] = 0;        
        $return_address = M('region')->where("id in (".implode(',', $region_id).")")->getField('id,name');
        $order_info = array_merge($order,$order_goods);  //合并数组
        $this->assign('return_address', $return_address);
        $this->assign('goods', $order_goods);
    	$this->assign('order',$order);
        return $this->fetch();
    }

    /**
     * 退换货列表
     */
    public function return_goods_list()
    {
        $where = " user_id=$this->user_id ";
        // 搜索订单 根据商品名称 或者 订单编号
        $search_key = trim(I('search_key'));
        if($search_key)
        {
            $where .= " and order_sn=$search_key";
        }
        $count = M('return_goods')->where($where)->count();
        $page = new Page($count,10);
        $list = M('return_goods')->where($where)->order("id desc")->limit("{$page->firstRow},{$page->listRows}")->select();
        $goods_id_arr = get_arr_column($list, 'goods_id');
        if(!empty($goods_id_arr))
            $goodsList = M('goods')->where("goods_id","in", implode(',',$goods_id_arr))->getField('goods_id,goods_name');
        $state = C('REFUND_STATUS');
        $this->assign('state',$state);
        $this->assign('goodsList', $goodsList);
        $this->assign('list', $list);
        $this->assign('page', $page->show());// 赋值分页输出
        return $this->fetch();
    }

    /**
     *  退货详情
     */
    public function return_goods_info()
    {
        $id = I('id/d',0);
        $ReturnGoodsModel = new \app\common\model\ReturnGoods();
        $return_goods=$ReturnGoodsModel::get(['id' => $id,'user_id'=>$this->user_id]);
        if(empty($return_goods)) $this->error('参数错误');
        $return_goods['seller_delivery'] = unserialize($return_goods['seller_delivery']);  //订单的物流信息，服务类型为换货会显示
        if($return_goods['imgs'])
            $return_goods['imgs'] = explode(',', $return_goods['imgs']);
        $goods = M('goods')->where("goods_id", $return_goods['goods_id'])->find();
        $this->assign('state',C('REFUND_STATUS'));
        $this->assign('goods',$goods);
        $this->assign('return_goods',$return_goods);
        return $this->fetch();
    }
    
    public function return_goods_refund()
    {
    	$order_sn = I('order_sn');
    	$where = array('user_id'=>$this->user_id);
    	if($order_sn){
    		$where['order_sn'] = $order_sn;
    	}
    	$where['status'] = 5;
    	$count = M('return_goods')->where($where)->count();
    	$page = new Page($count,10);
    	$list = M('return_goods')->where($where)->order("id desc")->limit($page->firstRow, $page->listRows)->select();
    	$goods_id_arr = get_arr_column($list, 'goods_id');
    	if(!empty($goods_id_arr))
    		$goodsList = M('goods')->where("goods_id in (".  implode(',',$goods_id_arr).")")->getField('goods_id,goods_name');
    	$this->assign('goodsList', $goodsList);
    	$state = C('REFUND_STATUS');
    	$this->assign('list', $list);
    	$this->assign('state',$state);
    	$this->assign('page', $page->show());// 赋值分页输出
    	return $this->fetch();
    }

    /**
     * 取消服务单
     */
    public function return_goods_cancel(){
    	$id = I('id/d',0);
    	if(empty($id))$this->ajaxReturn(['status'=>0,'msg'=>'参数错误']);
    	$res=M('return_goods')->where(['id'=>$id,'user_id'=>$this->user_id])->save(array('status'=>-2,'canceltime'=>time()));
        if($res){
            $this->ajaxReturn(['status'=>1,'msg'=>'成功取消服务单','url'=>U('Order/return_goods_info',['id'=>$id])]);
        }
            $this->ajaxReturn(['status'=>0,'msg'=>'服务单不存在']);
    }

    /**
     * 换货商品确认收货
     * @author lxl
     * @time  17-4-25
     * */
    public function receiveConfirm(){
        $return_id=I('return_id/d');
        $return_info=M('return_goods')->field('order_id,order_sn,goods_id,spec_key')->where('id',$return_id)->find(); //查找退换货商品信息
        $update = M('return_goods')->where('id',$return_id)->save(['status'=>3]);  //要更新状态为已完成
        if($update) {
            M('order_goods')->where(array(
                'order_id' => $return_info['order_id'],
                'goods_id' => $return_info['goods_id'],
                'spec_key' => $return_info['spec_key']))->save(['is_send' => 2]);  //订单商品改为已换货
            $this->success("操作成功", U("User/return_goods_info", array('id' => $return_id)));
        }
        $this->error("操作失败");
    }

    public function lower_list(){
    	$level = I('get.level',1);
    	$q = I('post.q','','trim');
    	$condition = array(1=>'first_leader',2=>'second_leader',3=>'third_leader');
    	$where = "{$condition[$level]} = {$this->user_id}";
    	$q && $where .= " and (nickname like '%$q%' or user_id = '$q' or mobile = '$q')";
    
    	$count = M('users')->where($where)->count();
    	$page = new Page($count,10);
    	$list = M('users')->where($where)->limit("{$page->firstRow},{$page->listRows}")->order('user_id desc')->select();
    	 
    	$this->assign('count', $count);// 总人数
    	$this->assign('level',$level);
    	$this->assign('page', $page->show());// 赋值分页输出
    	$this->assign('member',$list); // 下线
    	return $this->fetch();
    }
    
    public function income(){
    	$result = Db::query("select sum(goods_price) as goods_price, sum(money) as money from __PREFIX__rebate_log where user_id = {$this->user_id}");
    	$result = $result[0];
    	$result['goods_price'] = $result['goods_price'] ? $result['goods_price'] : 0;
    	$result['money'] = $result['money'] ? $result['money'] : 0;
    	$status = I('get.status',-2);
    	 
    	if($status=='0' || $status>0){
    		$condition['status'] = $status;
    	}
    	 
    	$condition['user_id'] = $this->user_id;
    	$count = M('rebate_log')->where($condition)->count();
    	$page = new Page($count,10);
    	$rebate_log = M('rebate_log')->where($condition)->limit("{$page->firstRow},{$page->listRows}")->order('user_id desc')->select();
    	$this->assign('page', $page->show());// 赋值分页输出
    	$this->assign('rebate_log',$rebate_log);
    	$this->assign('status',$status);
    	$this->assign('result',$result);
    	return $this->fetch();
    }

    /**
     * @time 2017/2/9
     * 订单商品评价列表
     */
    public function comment_list()
    {
        $order_id = I('order_id/d');
        $rec_id = I('rec_id/d');
        if (empty($order_id) || empty($rec_id)) {
            $this->error("参数错误");
        } else {
            //查找订单
            $order_comment_where['order_id'] = $order_id;
            $order_info = M('order')->field('order_sn,order_id,add_time,order_prom_type') ->where($order_comment_where)->find();
            //查找评价商品
            $order_comment_where['rec_id'] = $rec_id;
            $order_goods = M('order_goods')
                ->field('goods_id,is_comment,goods_name,goods_num,goods_price,spec_key_name')
                ->where($order_comment_where)
                ->find();
            $order_info = array_merge($order_info,$order_goods);
            $this->assign('order_info', $order_info);
            return $this->fetch();
        }
    }

    /*
    *添加评论
    */
    public function add_comment()
    {
        $user_info = session('user');
        $comment_img = serialize(I('comment_img/a')); // 上传的图片文件
        $add['goods_id'] = I('goods_id/d');
        $add['email'] = $user_info['email'];
        $hide_username = I('hide_username');
        if (empty($hide_username)) {
            $add['username'] = $user_info['nickname'];
        }
        $add['is_anonymous'] = $hide_username;  //是否匿名评价:0不是\1是
        $add['order_id'] = I('order_id/d');
        $add['service_rank'] = I('service_rank');
        $add['deliver_rank'] = I('deliver_rank');
        $add['goods_rank'] = I('goods_rank');
        $add['is_show'] = 1; //默认显示
        //$add['content'] = htmlspecialchars(I('post.content'));
        $add['content'] = I('content');
        $add['img'] = $comment_img;
        $add['add_time'] = time();
        $add['ip_address'] = $_SERVER['REMOTE_ADDR'];
        $add['user_id'] = $this->user_id;
        $logic = new UsersLogic();
        //添加评论
        $row = $logic->add_comment($add);
        exit(json_encode($row));
    }
}