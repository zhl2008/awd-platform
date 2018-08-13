<?php
namespace Admin\Controller;

class HuafeiController extends AdminController
{
	public function index($name = NULL)
	{
		//$this->checkUpdata();
		$where = array();

		if ($name && ($userid = D('User')->get_userid($name))) {
			$where['userid'] = $userid;
		}

		$where['status'] = array('neq', -1);
		$count = M('Huafei')->where($where)->count();
		$Page = new \Think\Page($count, 15);
		$show = $Page->show();
		$list = M('Huafei')->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

		foreach ($list as $k => $v) {
			$list[$k]['username'] = D('User')->get_username($v['userid']);
			$list[$k]['mum'] = Num($v['mum']);
			$list[$k]['addtime'] = addtime($v['addtime']);
			$list[$k]['endtime'] = addtime($v['endtime']);
		}

		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	public function delete($id = NULL)
	{
				if (APP_DEMO) {
			$this->error('测试站暂时不能修改！');
		}
		if (D('Huafei')->setStatus($id, 'delete')) {
			$this->success('操作成功！');
		}
		else {
			$this->error('操作失败！');
		}
	}

	public function repeal($id = NULL)
	{
		$huafei = M('Huafei')->where(array('id' => $id))->find();

		if (!$huafei) {
			$this->error('不存在！');
		}

		if ($huafei['status'] != 0) {
			$this->error('已经处理过！');
		}

		$mo = M();
		$mo->execute('set autocommit=0');
		$mo->execute('lock tables  qq3479015851_user_coin write  , qq3479015851_huafei write ');
		$rs = array();
		$user_coin = $mo->table('qq3479015851_user_coin')->where(array('userid' => $huafei['userid']))->find();

		if (!$user_coin) {
			session(null);
			$this->error('用户财产错误!');
		}

		$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $huafei['userid']))->setInc($huafei['type'], $huafei['mum']);
		$rs[] = $mo->table('qq3479015851_huafei')->where(array('id' => $id))->save(array('endtime' => time(), 'status' => 2));

		if (check_arr($rs)) {
			$mo->execute('commit');
			$mo->execute('unlock tables');
			$this->success('操作成功！');
		}
		else {
			$mo->execute('rollback');
			$this->error('操作失败!');
		}
	}

	public function resume($id = NULL)
	{
		if (empty($id)) {
			$this->error('参数错误！');
		}

		$huafei = M('Huafei')->where(array('id' => $id))->find();

		if (!$huafei) {
			$this->error('数据错误！');
		}

		if (huafei($huafei['moble'], $huafei['num'], md5($huafei['id']))) {
			if (D('Huafei')->setStatus($id, 'resume')) {
				$this->success('操作成功！');
			}
			else {
				$this->error('操作失败！');
			}
		}
		else {
			$this->error('第三方付款失败!');
		}
	}

	public function config()
	{

		$Config_DbFields = M('Config')->getDbFields();

		if (!in_array('huafei_appkey', $Config_DbFields)) {
			M()->execute('ALTER TABLE `qq3479015851_config` ADD COLUMN `huafei_appkey` VARCHAR(200)  NOT NULL   COMMENT \'名称\' AFTER `id`;');
		}

		if (!in_array('huafei_openid', $Config_DbFields)) {
			M()->execute('ALTER TABLE `qq3479015851_config` ADD COLUMN `huafei_openid` VARCHAR(200)  NOT NULL   COMMENT \'名称\' AFTER `id`;');
		}

		if (!in_array('huafei_zidong', $Config_DbFields)) {
			M()->execute('ALTER TABLE `qq3479015851_config` ADD COLUMN `huafei_zidong` VARCHAR(200)  NOT NULL   COMMENT \'名称\' AFTER `id`;');
		}

		if (empty($_POST)) {
			$this->display();
		}
		else if (M('Config')->where(array('id' => 1))->save($_POST)) {
			$this->success('修改成功！');
		}
		else {
			$this->error('修改失败');
		}
	}

	public function type()
	{
		$where = array();
		$where['status'] = array('neq', -1);
		$count = M('HuafeiType')->where($where)->count();
		$Page = new \Think\Page($count, 15);
		$show = $Page->show();
		$list = M('HuafeiType')->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	public function forbidType($id = NULL)
	{
		if (D('Huafei')->setStatus($id, 'forbid', 'HuafeiType')) {
			$this->success('操作成功！');
		}
		else {
			$this->error('操作失败！');
		}
	}

	public function resumeType($id = NULL)
	{
		if (D('Huafei')->setStatus($id, 'resume', 'HuafeiType')) {
			$this->success('操作成功！');
		}
		else {
			$this->error('操作失败！');
		}
	}

	public function coin()
	{
		$where = array();
		$where['status'] = array('neq', -1);
		$count = M('HuafeiCoin')->where($where)->count();
		$Page = new \Think\Page($count, 15);
		$show = $Page->show();
		$list = M('HuafeiCoin')->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	public function forbidCoin($id = NULL)
	{
				if (APP_DEMO) {
			$this->error('测试站暂时不能修改！');
		}
		if (D('Huafei')->setStatus($id, 'forbid', 'HuafeiCoin')) {
			$this->success('操作成功！');
		}
		else {
			$this->error('操作失败！');
		}
	}

	public function resumeCoin($id = NULL)
	{
				if (APP_DEMO) {
			$this->error('测试站暂时不能修改！');
		}
		if (D('Huafei')->setStatus($id, 'resume', 'HuafeiCoin')) {
			$this->success('操作成功！');
		}
		else {
			$this->error('操作失败！');
		}
	}

	public function deleteCoin($id = NULL)
	{
				if (APP_DEMO) {
			$this->error('测试站暂时不能修改！');
		}
		if (D('Huafei')->setStatus($id, 'del', 'HuafeiCoin')) {
			$this->success('操作成功！');
		}
		else {
			$this->error('操作失败！');
		}
	}

	public function editCoin($id = NULL)
	{
		if (empty($_POST)) {
			if ($id) {
				$this->data = M('HuafeiCoin')->where(array('id' => trim($id)))->find();
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
			if (!C('coin')[$_POST['coinname']]) {
				$this->error('币种错误！');
			}

			if ($_POST['id']) {
				$rs = M('HuafeiCoin')->save($_POST);
			}
			else {
				if ($id = M('HuafeiCoin')->where(array('coinname' => $_POST['coinname']))->find()) {
					$this->error('币种存在！');
				}

				$rs = M('HuafeiCoin')->add($_POST);
			}

			if ($rs) {
				$this->success('操作成功！');
			}
			else {
				$this->error('操作失败！');
			}
		}
	}

	public function checkUpdata()
	{
	}
}

?>