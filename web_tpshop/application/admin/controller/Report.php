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
 * Date: 2015-12-21
 */

namespace app\admin\controller;
use app\admin\logic\GoodsLogic;
use think\Db;
use think\Page;

class Report extends Base{
	public $begin;
	public $end;
	public function _initialize(){
        parent::_initialize();
        $start_time = I('start_time');
		if(I('start_time')){
           $begin = urldecode($start_time);
            $end_time = I('end_time');
           $end = urldecode($end_time);
		}else{
           $begin = date('Y-m-d', strtotime("-3 month"));//30天前
           $end = date('Y-m-d', strtotime('+1 days'));
		}
		$this->assign('start_time',$begin);
		$this->assign('end_time',$end);
		$this->begin = strtotime($begin);
		$this->end = strtotime($end)+86399;
	}
	
	public function index(){
		$now = strtotime(date('Y-m-d'));
		$today['today_amount'] = M('order')->where("add_time>$now AND (pay_status=1 or pay_code='cod') and order_status in(1,2,4)")->sum('total_amount');//今日销售总额
		$today['today_order'] = M('order')->where("add_time>$now and (pay_status=1 or pay_code='cod')")->count();//今日订单数
		$today['cancel_order'] = M('order')->where("add_time>$now AND order_status=3")->count();//今日取消订单
		if ($today['today_order'] == 0) {
			$today['sign'] = round(0, 2);
		} else {
			$today['sign'] = round($today['today_amount'] / $today['today_order'], 2);
		}
		$this->assign('today',$today);
        $select_year = $this->select_year;
        $begin = $this->begin;
        $end = $this->end;
        $res = Db::name("order".$select_year)
            ->field(" COUNT(*) as tnum,sum(total_amount) as amount, FROM_UNIXTIME(add_time,'%Y-%m-%d') as gap ")
            ->where(" add_time >$begin and add_time < $end AND (pay_status=1 or pay_code='cod') and order_status in(1,2,4) ")
            ->group('gap')
            ->select();
		foreach ($res as $val){
			$arr[$val['gap']] = $val['tnum'];
			$brr[$val['gap']] = $val['amount'];
			$tnum += $val['tnum'];
			$tamount += $val['amount'];
		}

		for($i=$this->begin;$i<=$this->end;$i=$i+24*3600){
			$tmp_num = empty($arr[date('Y-m-d',$i)]) ? 0 : $arr[date('Y-m-d',$i)];
			$tmp_amount = empty($brr[date('Y-m-d',$i)]) ? 0 : $brr[date('Y-m-d',$i)];
			$tmp_sign = empty($tmp_num) ? 0 : round($tmp_amount/$tmp_num,2);						
			$order_arr[] = $tmp_num;
			$amount_arr[] = $tmp_amount;			
			$sign_arr[] = $tmp_sign;
			$date = date('Y-m-d',$i);
			$list[] = array('day'=>$date,'order_num'=>$tmp_num,'amount'=>$tmp_amount,'sign'=>$tmp_sign,'end'=>date('Y-m-d',$i+24*60*60));
			$day[] = $date;
		}
		rsort($list);
		$this->assign('list',$list);
		$result = array('order'=>$order_arr,'amount'=>$amount_arr,'sign'=>$sign_arr,'time'=>$day);
		$this->assign('result',json_encode($result));
		return $this->fetch();
	}

	public function saleTop(){
		$sql = "select goods_name,goods_sn,sum(goods_num) as sale_num,sum(goods_num*goods_price) as sale_amount from __PREFIX__order_goods ";
		$sql .=" where is_send = 1 group by goods_id order by sale_num DESC limit 100";
		$res = DB::cache(true,3600)->query($sql);
		$this->assign('list',$res);
		return $this->fetch();
	}

    /**
     * 统计报表 - 会员排行
     * @return mixed
     */
	public function userTop(){

		$mobile = I('mobile');
		$email = I('email');
        $order_where = [
            'o.add_time'=>['egt',$this->begin],
            'o.add_time'=>['elt',$this->end],
            'o.pay_status'=>1
        ];
		if($mobile){
			$user_where['mobile'] =$mobile;
		}		
		if($email){
            $user_where['email'] = $email;
		}
        if($user_where){   //有查询单个用户的条件就去找出user_id
            $user_id = Db::name('users')->where($user_where)->getField('user_id');
            $order_where['o.user_id']=$user_id;
        }

        $count = Db::name('order')->alias('o')->where($order_where)->group('o.user_id')->count();  //统计数量
        $Page = new Page($count,20);
        $list = Db::name('order')->alias('o')
            ->field('count(o.order_id) as order_num,sum(o.order_amount) as amount,o.user_id,u.mobile,u.email,u.nickname')
            ->join('users u','o.user_id=u.user_id','LEFT')
            ->where($order_where)
            ->group('o.user_id')
            ->order('amount DESC')
            ->limit($Page->firstRow,$Page->listRows)
            ->cache(true)->select();   //以用户ID分组查询
        $this->assign('pager',$Page);
        $this->assign('list',$list);
		return $this->fetch();
	}

    public function saleOrder(){
        $end_time = $this->begin+24*60*60;
        $order_where = "o.add_time>$this->begin and o.add_time<$end_time";  //交易成功的有效订单
        $order_count = Db::name('order')->alias('o')->where($order_where)->whereIn('order_status','1,24')->count();
        $Page = new Page($order_count,20);
        $order_list = Db::name('order')->alias('o')
            ->field('o.order_id,o.order_sn,o.goods_price,o.shipping_price,o.total_amount,o.add_time,u.user_id,u.nickname')
            ->join('users u','u.user_id = o.user_id','left')
            ->where($order_where)->whereIn('order_status','1,2,4')
            ->limit($Page->firstRow,$Page->listRows)->select();
        $this->assign('order_list',$order_list);
        $this->assign('page',$Page->show());
        return $this->fetch();
    }

    /**
     * 销售明细列表
     */
	public function saleList(){
        $cat_id = I('cat_id',0);
        $brand_id = I('brand_id',0);
        $where = "o.add_time>$this->begin and o.add_time<$this->end and order_status in(1,2,4) ";  //交易成功的有效订单
        if($cat_id>0){
            $where .= " and (g.cat_id=$cat_id or g.extend_cat_id=$cat_id)";
            $this->assign('cat_id',$cat_id);
        }
        if($brand_id>0){
            $where .= " and g.brand_id=$brand_id";
            $this->assign('brand_id',$brand_id);
        }

        $count = Db::name('order_goods')->alias('og')
            ->join('order o','og.order_id=o.order_id ','left')
            ->join('goods g','og.goods_id = g.goods_id','left')
            ->where($where)->count();  //统计数量
        $Page = new Page($count,20);
        $show = $Page->show();

        $res = Db::name('order_goods')->alias('og')->field('og.*,o.order_sn,o.shipping_name,o.pay_name,o.add_time')
            ->join('order o','og.order_id=o.order_id ','left')
            ->join('goods g','og.goods_id = g.goods_id','left')
            ->where($where)->limit($Page->firstRow,$Page->listRows)
            ->order('o.add_time desc')->select();
        $this->assign('list',$res);
        $this->assign('pager',$Page);
        $this->assign('page',$show);

        $GoodsLogic = new GoodsLogic();
        $brandList = $GoodsLogic->getSortBrands();  //获取排好序的品牌列表
        $categoryList = $GoodsLogic->getSortCategory(); //获取排好序的分类列表
        $this->assign('categoryList',$categoryList);
        $this->assign('brandList',$brandList);
        return $this->fetch();
	}
	
	public function user(){
		$today = strtotime(date('Y-m-d'));
		$month = strtotime(date('Y-m-01'));
		$user['today'] = D('users')->where("reg_time>$today")->count();//今日新增会员
		$user['month'] = D('users')->where("reg_time>$month")->count();//本月新增会员
		$user['total'] = D('users')->count();//会员总数
		$user['user_money'] = D('users')->sum('user_money');//会员余额总额
		$res = M('order')->cache(true)->distinct(true)->field('user_id')->select();
		$user['hasorder'] = count($res);
		$this->assign('user',$user);
		$sql = "SELECT COUNT(*) as num,FROM_UNIXTIME(reg_time,'%Y-%m-%d') as gap from __PREFIX__users where reg_time>$this->begin and reg_time<$this->end group by gap";
		$new = DB::query($sql);//新增会员趋势
		foreach ($new as $val){
			$arr[$val['gap']] = $val['num'];
		}
		
		for($i=$this->begin;$i<=$this->end;$i=$i+24*3600){
			$brr[] = empty($arr[date('Y-m-d',$i)]) ? 0 : $arr[date('Y-m-d',$i)];
			$day[] = date('Y-m-d',$i);
		}		
		$result = array('data'=>$brr,'time'=>$day);
		$this->assign('result',json_encode($result));					
		return $this->fetch();
	}
	
	//财务统计
	public function finance(){
		$sql = "SELECT sum(b.goods_num*b.member_goods_price) as goods_amount,sum(a.shipping_price) as shipping_amount,sum(b.goods_num*b.cost_price) as cost_price,";
		$sql .= "sum(a.coupon_price) as coupon_amount,FROM_UNIXTIME(a.add_time,'%Y-%m-%d') as gap from  __PREFIX__order a left join __PREFIX__order_goods b on a.order_id=b.order_id ";
		$sql .= " where a.add_time>$this->begin and a.add_time<$this->end AND a.pay_status=1 and a.shipping_status=1 and b.is_send=1 group by gap order by a.add_time";
		$res = DB::cache(true)->query($sql);//物流费,交易额,成本价
		
		foreach ($res as $val){
			$arr[$val['gap']] = $val['goods_amount'];
			$brr[$val['gap']] = $val['cost_price'];
			$crr[$val['gap']] = $val['shipping_amount'];
			$drr[$val['gap']] = $val['coupon_amount'];
		}
			
		for($i=$this->begin;$i<=$this->end;$i=$i+24*3600){
			$date = $day[] = date('Y-m-d',$i);
			$tmp_goods_amount = empty($arr[$date]) ? 0 : $arr[$date];
			$tmp_cost_amount = empty($brr[$date]) ? 0 : $brr[$date];
			$tmp_shipping_amount = empty($crr[$date]) ? 0 : $crr[$date];
			$tmp_coupon_amount = empty($drr[$date]) ? 0 : $drr[$date];
			
			$goods_arr[] = $tmp_goods_amount;
			$cost_arr[] = $tmp_cost_amount;
			$shipping_arr[] = $tmp_shipping_amount;
			$coupon_arr[] = $tmp_coupon_amount;
			$list[] = array('day'=>$date,'goods_amount'=>$tmp_goods_amount,'cost_amount'=>$tmp_cost_amount,
					'shipping_amount'=>$tmp_shipping_amount,'coupon_amount'=>$tmp_coupon_amount,'end'=>date('Y-m-d',$i+24*60*60));
		}
                rsort($list);
		$this->assign('list',$list);
		$result = array('goods_arr'=>$goods_arr,'cost_arr'=>$cost_arr,'shipping_arr'=>$shipping_arr,'coupon_arr'=>$coupon_arr,'time'=>$day);
		$this->assign('result',json_encode($result));
		return $this->fetch();
	}
	
	public function expense_log(){
		$map = array();
        $add_time_begin = I('add_time_begin');
        $add_time_end = I('add_time_end');
		$begin = strtotime($add_time_begin);
		$end = strtotime($add_time_end);
		$admin_id = I('admin_id');
		if($begin && $end){
			$map['addtime'] = array('between',"$begin,$end");
		}
		if($admin_id){
			$map['admin_id'] = $admin_id;
		}
		$count = M('expense_log')->where($map)->count();
		$page = new Page($count);
		$lists  = M('expense_log')->where($map)->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('page',$page->show());
		$this->assign('total_count',$count);
		$this->assign('add_time_begin',$add_time_begin);
		$this->assign('add_time_end',$add_time_end);
		$this->assign('list',$lists);
		$admin = M('admin')->getField('admin_id,user_name');
		$this->assign('admin',$admin);
		$typeArr = array('','会员提现','订单退款','其他');//数据库设计问题
		$this->assign('typeArr',$typeArr);
		return $this->fetch();
	}

  /**
     * 运营概况详情
     * @return mixed
     */
    public function financeDetail(){
        $end_time = $this->begin+24*60*60;
        $order_where = "o.add_time>$this->begin and o.add_time<$end_time AND o.pay_status=1 and o.shipping_status=1 and og.is_send=1";  //交易成功的有效订单
        $order_count = Db::name('order')->alias('o')->join('order_goods og','o.order_id = og.order_id','left')->join('users u','u.user_id = o.user_id','left')->where($order_where)->group('o.order_id')->count();
        $Page = new Page($order_count,50);
        $order_list = Db::name('order')->alias('o')
            ->field('o.order_id,o.order_sn,o.order_prom_amount,o.coupon_price,o.goods_price,o.shipping_price,o.total_amount,o.add_time,u.user_id,u.nickname,SUM(og.cost_price) as coupon_amount')
            ->join('order_goods og','o.order_id = og.order_id','left')
            ->join('users u','u.user_id = o.user_id','left')
            ->where($order_where)
            ->group('o.order_id')
            ->limit($Page->firstRow,$Page->listRows)->select();
        $this->assign('order_list',$order_list);
        $this->assign('page',$Page);
        return $this->fetch();
    }
}