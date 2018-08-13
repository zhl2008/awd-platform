<?php
namespace Admin\Controller;

class MoneyController extends AdminController
{
	private $Model;

	public function __construct()
	{
		parent::__construct();
		$this->Model = M('Money');
		$this->Title = '理财';
	}

	public function index()
	{
		//$this->checkUpdata();
		$where = array(
			'status' => array('egt', 0)
			);
		$count = $this->Model->where($where)->count();
		$Page = new \Think\Page($count, 15);
		$show = $Page->show();
		$list = $this->Model->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

		foreach ($list as $k => $v) {
			$list[$k]['tian'] = $list[$k]['tian'] . ' ' . $this->danweitostr($list[$k]['danwei']);
		}

		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	public function edit()
	{
		if (empty($_GET['id'])) {
			$this->data = false;
		}
		else {
			$data = array();
			$data = $this->Model->where(array('id' => trim($_GET['id'])))->find();
			$data['deal'] = M('MoneyLog')->where(array('money_id' => $data['id']))->sum('num');
			$this->data = $data;
		}

		$this->display();
	}

	public function save()
	{
		if (APP_DEMO) {
			$this->error('测试站暂时不能修改！');
		}

		if (strtotime($_POST['endtime']) != strtotime(addtime(strtotime($_POST['endtime'])))) {
			$this->error('结束时间格式错误！');
		}

		if (floatval($_POST['num']) < floatval($_POST['deal'])) {
			$this->error('合成总量不能小于已合成量');
		}

		$_POST['addtime'] = strtotime($_POST['addtime']);
		$_POST['endtime'] = strtotime($_POST['endtime']);

		if (($_POST['fee'] < 0.01) || (100 < $_POST['fee'])) {
			$this->error('周期利息范围为0.01 -- 100 %！');
		}

		if (!floatval($_POST['tian'])) {
			$this->error('理财周期不能为空');
		}

		switch ($_POST['danwei']) {
		case 'y':
			$_POST['step'] = $_POST['tian'] * 12 * 30 * 24 * 60 * 60;
			break;

		case 'm':
			$_POST['step'] = $_POST['tian'] * 30 * 24 * 60 * 60;
			break;

		case 'd':
			$_POST['step'] = $_POST['tian'] * 24 * 60 * 60;
			break;

		case 'h':
			$_POST['step'] = $_POST['tian'] * 60 * 60;
			break;

		default:

		case 'i':
			$_POST['step'] = $_POST['tian'] * 60;
			break;
		}

		if ($_POST['outfee'] && (($_POST['outfee'] < 0.01) || (100 < $_POST['outfee']))) {
			$this->error('活期取现手续费范围为0.01 -- 100 %！');
		}

		if ($_POST['id']) {
			$rs = $this->Model->save($_POST);
		}
		else {
			$rs = $this->Model->add($_POST);
		}

		if ($rs) {
			$this->success('操作成功！');
		}
		else {
			debug($this->Model->getDbError(), 'lastSql');
			$this->error('操作失败！');
		}
	}

	public function log($money_id = NULL, $name = NULL)
	{
		if ($name && check($name, 'username')) {
			$where['userid'] = M('User')->where(array('money_id' => $money_id, 'username' => $name))->getField('id');
		}
		else {
			$where = array(
				array('money_id' => $money_id)
				);
		}

		$this->Model = M('MoneyLog');
		$count = $this->Model->where($where)->count();
		$Page = new \Think\Page($count, 15);
		$show = $Page->show();
		$list = $this->Model->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

		foreach ($list as $k => $v) {
			$list[$k]['username'] = M('User')->where(array('id' => $v['userid']))->getField('username');
			$list[$k]['money'] = M('Money')->where(array('id' => $v['money_id']))->find();
			$list[$k]['money']['tian'] = $list[$k]['money']['tian'] . ' ' . $this->danweitostr($list[$k]['money']['danwei']);
		}

		$this->assign('money_id', $money_id);
		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	public function fee($userid = NULL, $money_id = NULL)
	{
		$where['userid'] = $userid;
		$user = D('User')->where(array('id' => $userid))->find();

		if (!$user) {
		}

		$this->Model = M('MoneyFee');
		$count = $this->Model->where($where)->count();
		$Page = new \Think\Page($count, 15);
		$show = $Page->show();
		$list = $this->Model->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

		foreach ($list as $k => $v) {
			$list[$k]['money'] = M('Money')->where(array('id' => $v['money_id']))->find();
		}

		debug($v, 'v');
		$this->assign('money_id', $money_id);
		$this->assign('user', $user);
		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	public function status()
	{
		if (APP_DEMO) {
			$this->error('测试站暂时不能修改！');
		}

		if (IS_POST) {
			$id = array();
			$id = implode(',', $_POST['id']);
		}
		else {
			$id = $_GET['id'];
		}

		if (empty($id)) {
			$this->error('请选择要操作的数据!');
		}

		$where['id'] = array('in', $id);
		$method = $_GET['method'];

		switch (strtolower($method)) {
		case 'forbid':
			$data = array('status' => 0);
			break;

		case 'resume':
			$data = array('status' => 1);
			break;

		case 'delete':
			if ($this->Model->where($where)->delete()) {
				$this->success('操作成功！');
			}
			else {
				$this->error('操作失败！');
			}

			break;

		default:
			$this->error('参数非法');
		}

		if ($this->Model->where($where)->save($data)) {
			$this->success('操作成功！');
		}
		else {
			$this->error('操作失败！');
		}
	}

	private function danweitostr($danwei)
	{
		switch ($danwei) {
		case 'y':
			return '年';
			break;

		case 'm':
			return '月';
			break;

		case 'd':
			return '天';
			break;

		case 'h':
			return '小时';
			break;

		default:

		case 'i':
			return '分钟';
			break;
		}
	}

	public function checkUpdata()
	{
	}
}

?>