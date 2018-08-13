<?php
namespace Admin\Controller;

class AppController extends AdminController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function config()
	{
		if (empty($_POST)) {
			$appc = D('Appc')->find();
			$appc['pay'] = json_decode($appc['pay'], true);
			$show_coin = json_decode($appc['show_coin'], true);
			$Coin = D('coin')->where('type in ("rgb","qbb") and status = 1')->select();
			$appc['show_coin'] = array();

			foreach ($Coin as $val) {
				$appc['show_coin'][] = array('id' => $val['id'], 'name' => $val['title'] . '(' . $val['name'] . ')', 'flag' => $show_coin ? (in_array($val['id'], $show_coin) ? 1 : 0) : 1);
			}

			$show_market = json_decode($appc['show_market'], true);
			$Market = D('Market')->where('status = 1')->select();
			$appc['show_market'] = array();

			foreach ($Market as $val) {
				$coin_name = explode('_', $val['name']);
				$xnb_name = D('Coin')->where(array('name' => $coin_name[0]))->find()['title'];
				$rmb_name = D('Coin')->where(array('name' => $coin_name[1]))->find()['title'];
				$appc['show_market'][] = array('id' => $val['id'], 'name' => $xnb_name . '/' . $rmb_name . '(' . $val['name'] . ')', 'flag' => $show_market ? (in_array($val['id'], $show_market) ? 1 : 0) : 1);
			}

			$this->assign('appCon', $appc);
			$this->display();
		}
		else {
			$_POST['pay'] = json_encode($_POST['pay']);
			$_POST['show_coin'] = json_encode($_POST['show_coin']);
			$_POST['show_market'] = json_encode($_POST['show_market']);

			if (D('Appc')->save($_POST)) {
				$this->success('保存成功！');
			}
			else {
				$this->error('没有修改');
			}
		}
	}

	public function vip_config_list()
	{
		$coin = D('coin')->select();
		$coinMap = array();

		foreach ($coin as $val) {
			$coinMap[$val['id']] = $val['title'];
		}

		$this->assign('coinMap', $coinMap);
		$this->Model = D('AppVip');
		$where = array();
		$count = $this->Model->where($where)->count();
		$Page = new \Think\Page($count, 15);
		$show = $Page->show();
		$list = $this->Model->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->order('tag asc')->select();

		foreach ($list as $key => $val) {
			$val['rule'] = json_decode($val['rule'], true);
			$list[$key] = $val;
		}

		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	public function vip_config_edit()
	{
		if (empty($_POST)) {
			$coin = D('Coin')->where('status = 1')->select();
			$this->assign('coin', $coin);

			if (isset($_GET['id']) && $_GET['id']) {
				$vipArr = D('AppVip')->where(array('id' => trim($_GET['id'])))->find();
				$vipArr['rule'] = json_decode($vipArr['rule'], true);
				$this->assign('idi', count($vipArr['rule']));
				$rule_t = str_repeat('1,', count($vipArr['rule']));
				$rule_t = mb_substr($rule_t, 0, -1);
				$this->assign('rule_str', '[' . $rule_t . ']');
				$this->assign('data', $vipArr);
			}
			else {
				$this->assign('rule_str', '[]');
				$this->assign('idi', 0);
			}

			$this->display();
		}
		else {
			if (APP_DEMO) {
				$this->error('测试站暂时不能修改！');
			}

			if (!$_POST['tag']) {
				$this->error('等级次序不能为空');
			}

			if (!check($_POST['tag'], 'integer')) {
				$this->error('等级次序必须为整数！');
			}

			if ($res = D('AppVip')->where(array('tag' => $_POST['tag']))->find()) {
				if ($res['id'] != $_POST['id']) {
					$this->error('等级次序' . $_POST['tag'] . ' 已经存在！');
				}
			}

			$_POST['rule'] = json_decode($_POST['rule'], true);
			$key_map = array();
			$rule = array();

			foreach ($_POST['rule'] as $val) {
				if (!isset($key_map[$val['id']])) {
					$key_map[$val['id']] = 1;
					$rule[] = $val;
				}
				else {
					$this->error('升级币种不能相同');
				}
			}

			$_POST['rule'] = json_encode($rule);

			if ($_POST['id']) {
				$rs = D('AppVip')->save($_POST);
			}
			else {
				$_POST['addtime'] = time();
				$rs = D('AppVip')->add($_POST);
			}

			if ($rs) {
				$this->success('操作成功！');
			}
			else {
				$this->error('没有任何修改!');
			}
		}
	}

	public function vip_config_edit_status()
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
			if (D('Appadsblock')->where($where)->delete()) {
				$this->success('操作成功！');
			}
			else {
				$this->error('没有任何修改！');
			}

			break;

		default:
			$this->error('参数非法');
		}

		if (D('Appadsblock')->where($where)->save($data)) {
			$this->success('操作成功！');
		}
		else {
			$this->error('没有任何修改！');
		}
	}

	public function adsblock_list()
	{
		$rankMap = array();
		$AppVip = D('AppVip')->where(array('status' => 1))->select();

		foreach ($AppVip as $val) {
			$rankMap[$val['id']] = $val['name'];
		}

		$this->assign('rankMap', $rankMap);
		$this->Model = D('Appadsblock');
		$where = array();
		$count = $this->Model->where($where)->count();
		$Page = new \Think\Page($count, 15);
		$show = $Page->show();
		$list = $this->Model->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	public function adsblock_edit()
	{
		if (empty($_POST)) {
			$AppVip = D('AppVip')->where(array('status' => 1))->select();
			$this->assign('AppVip', $AppVip);

			if (isset($_GET['id'])) {
				$this->data = D('Appadsblock')->where(array('id' => trim($_GET['id'])))->find();
			}
			else {
				$this->data = null;
			}

			$this->display();
		}
		else {
			if (APP_DEMO) {
				$this->error('测试站暂时不能修改！');
			}

			if ($_POST['id']) {
				$rs = D('Appadsblock')->save($_POST);
			}
			else {
				$_POST['adminid'] = session('admin_id');
				$rs = D('Appadsblock')->add($_POST);
			}

			if ($rs) {
				$this->success('操作成功！');
			}
			else {
				$this->error('没有任何修改！');
			}
		}
	}

	public function adsblock_edit_status()
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
			if (D('Appadsblock')->where($where)->delete()) {
				$this->success('操作成功！');
			}
			else {
				$this->error('没有任何修改！');
			}

			break;

		default:
			$this->error('参数非法');
		}

		if (D('Appadsblock')->where($where)->save($data)) {
			$this->success('操作成功！');
		}
		else {
			$this->error('没有任何修改！');
		}
	}

	public function ads_list($block_id)
	{
		if(empty($block_id) || !isset($block_id)){
			$block_id=1;
		}
		
		$block_id = intval($block_id);
		$ads_block = M('Appadsblock')->where(array('id' => $block_id))->find();
		$this->assign('ads_block', $ads_block);
		$this->Model = D('Appads');

		if ($block_id) {
			//$where['block_id'] = $block_id;
		}

		$count = $this->Model->where($where)->count();
		$Page = new \Think\Page($count, 15);
		$show = $Page->show();
		$list = $this->Model->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	public function ads_edit()
	{
		if (empty($_POST)) {
			if (isset($_GET['id'])) {
				$this->data = D('Appads')->where(array('id' => trim($_GET['id'])))->find();
			}
			else {
				$this->data = null;
			}

			$this->display();
		}
		else {
			if (APP_DEMO) {
				$this->error('测试站暂时不能修改！');
			}

			$upload = new \Think\Upload();
			$upload->maxSize = 3145728;
			$upload->exts = array('jpg', 'gif', 'png', 'jpeg');
			$upload->rootPath = './Upload/ad/';
			$upload->autoSub = false;
			$info = $upload->upload();

			if ($info) {
				foreach ($info as $k => $v) {
					$_POST[$v['key']] = $v['savename'];
				}
			}

			if ($_POST['id']) {
				$rs = D('Appads')->save($_POST);
			}
			else {
				$_POST['adminid'] = session('admin_id');
				$rs = D('Appads')->add($_POST);
			}

			if ($rs) {
				$this->success('操作成功！');
			}
			else {
				$this->error('没有任何修改！');
			}
		}
	}

	public function ads_edit_status()
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
			if (D('Appads')->where($where)->delete()) {
				$this->success('操作成功！');
			}
			else {
				$this->error('没有任何修改！');
			}

			break;

		default:
			$this->error('参数非法');
		}

		if (D('Appads')->where($where)->save($data)) {
			$this->success('操作成功！');
		}
		else {
			$this->error('没有任何修改！');
		}
	}

	public function ads_user()
	{
		$this->Model = M('AppVipuser');
		$where = array();
		$count = $this->Model->join('qq3479015851_user ON qq3479015851_user.id = qq3479015851_app_vipuser.uid')->join('qq3479015851_app_vip ON qq3479015851_app_vip.id = qq3479015851_app_vipuser.vip_id')->field('qq3479015851_user.username,qq3479015851_app_vipuser.*,qq3479015851_app_vip.name as vip_name,qq3479015851_app_vip.tag')->where($where)->count();
		$Page = new \Think\Page($count, 15);
		$show = $Page->show();
		$list = $this->Model->join('qq3479015851_user ON qq3479015851_user.id = qq3479015851_app_vipuser.uid')->join('qq3479015851_app_vip ON qq3479015851_app_vip.id = qq3479015851_app_vipuser.vip_id')->field('qq3479015851_user.username,qq3479015851_app_vipuser.*,qq3479015851_app_vip.name as vip_name,qq3479015851_app_vip.tag')->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$this->assign('list', $list);

		foreach ($list as $key => $val) {
			
		}

		$this->assign('page', $show);
		$this->display();
	}

	public function ads_user_detail($uid = NULL)
	{
		$where = array();
		$this->Model = D('AppLog');

		if ($uid) {
			$where['uid'] = $uid;
		}

		$count = $this->Model->where($where)->count();
		$Page = new \Think\Page($count, 15);
		$show = $Page->show();
		$list = $this->Model->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	public function upload()
	{
		$upload = new \Think\Upload();
		$upload->maxSize = 3145728;
		$upload->exts = array('jpg', 'gif', 'png', 'jpeg');
		$upload->rootPath = './Upload/app/';
		$upload->autoSub = false;
		$info = $upload->upload();

		foreach ($info as $k => $v) {
			$path = '/Upload/app/' . $v['savepath'] . $v['savename'];
			echo $path;
			exit();
		}
	}
}

?>