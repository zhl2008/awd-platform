<?php
/**
 * tpshop
 * ============================================================================
 * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: 当燃
 * 拼团控制器
 * Date: 2016-06-09
 */

namespace app\admin\controller;

use app\common\logic\OrderLogic;
use app\common\logic\TeamActivityLogic;
use app\common\model\Order;
use app\common\model\TeamActivity;
use app\common\model\TeamFollow;
use app\common\model\TeamFound;
use think\Loader;
use think\Db;
use think\Page;

class Team extends Base
{
	public function index()
	{
	header("Content-type: text/html; charset=utf-8");
exit("请联系TPshop官网客服购买高级版支持此功能");	
	}

	/**
	 * 拼团详情
	 * @return mixed
	 */
	public function info()
	{
	header("Content-type: text/html; charset=utf-8");
exit("请联系TPshop官网客服购买高级版支持此功能");	
	}

	/**
	 * 保存
	 * @throws \think\Exception
	 */
	public function save(){
	header("Content-type: text/html; charset=utf-8");
exit("请联系TPshop官网客服购买高级版支持此功能");	
	}

	/**
	 * 删除拼团
	 */
	public function delete(){
	header("Content-type: text/html; charset=utf-8");
exit("请联系TPshop官网客服购买高级版支持此功能");	
	}

	/**
	 * 确认拼团
	 * @throws \think\Exception
	 */
	public function confirmFound(){
	header("Content-type: text/html; charset=utf-8");
exit("请联系TPshop官网客服购买高级版支持此功能");	
	}

	/**
	 * 拼团退款
	 */
	public function refundFound(){
	header("Content-type: text/html; charset=utf-8");
exit("请联系TPshop官网客服购买高级版支持此功能");	
	}

	/**
	 * 拼团抽奖
	 */
	public function lottery(){
	header("Content-type: text/html; charset=utf-8");
exit("请联系TPshop官网客服购买高级版支持此功能");	
	}

	/**
	 * 拼团订单
	 */
	public function team_list()
	{
	header("Content-type: text/html; charset=utf-8");
exit("请联系TPshop官网客服购买高级版支持此功能");	
	}

	/**
	 * 拼团订单详情
	 * @return mixed
	 */
	public function team_info()
	{
	header("Content-type: text/html; charset=utf-8");
exit("请联系TPshop官网客服购买高级版支持此功能");	
	}

	//拼团订单
	public function order_list(){
	header("Content-type: text/html; charset=utf-8");
exit("请联系TPshop官网客服购买高级版支持此功能");	
	}

	/**
	 * 团长佣金
	 */
	public function bonus(){
	header("Content-type: text/html; charset=utf-8");
exit("请联系TPshop官网客服购买高级版支持此功能");	
	}

	public function doBonus(){
	header("Content-type: text/html; charset=utf-8");
exit("请联系TPshop官网客服购买高级版支持此功能");	
	}
}
