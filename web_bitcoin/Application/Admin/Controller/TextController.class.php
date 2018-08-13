<?php
namespace Admin\Controller;

class TextController extends AdminController
{
	public function index($name = NULL)
	{
		$where = array();

		if (isset($name)) {
			$where = array(
				'title' => array('like', '%' . $name . '%')
				);
		}

		$this->assign('name', $name);
		$count = M('Text')->where($where)->count();
		$Page = new \Think\Page($count, 15);
		$show = $Page->show();
		$list = M('Text')->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	public function edit()
	{
		if (IS_POST) {
			if (APP_DEMO) {
				$this->error('测试站暂时不能修改！');
			}

			$_POST['addtime'] = time();

			if ($_POST['id']) {
				$rs = M('Text')->save($_POST);
			}
			else {
				$rs = M('Text')->add($_POST);
			}

			if ($rs) {
				$this->success('操作成功！');
			}
			else {
				$this->error('操作失败！');
			}
		}
		else {
			if (empty($_GET['id'])) {
				$this->data = false;
			}
			else {
				$this->data = M('Text')->where(array('id' => trim($_GET['id'])))->find();
			}

			$this->display();
		}
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

		default:
			$this->error('参数非法');
		}

		if (M('Text')->where($where)->save($data)) {
			$this->success('操作成功！');
		}
		else {
			$this->error('操作失败！');
		}
	}
}

?>