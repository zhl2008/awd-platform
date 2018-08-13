<?php
namespace Admin\Controller;

class MarketController extends AdminController
{
	private $Model;

	public function __construct()
	{
		parent::__construct();
		$this->Model = M('Market');
		$this->Title = '市场配置';
	}

	public function index($name = NULL)
	{
		if ($name) {
			$where['name'] = $name;
		}

		$count = $this->Model->where($where)->count();
		$Page = new \Think\Page($count, 15);
		$show = $Page->show();
		$list = $this->Model->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	public function edit($id = NULL)
	{
		if (empty($id)) {
			$this->data = array();
		}
		else {
			$this->data = $this->Model->where(array('id' => $id))->find();
		}

		$this->display();
	}

	public function save()
	{
		if (APP_DEMO) {
			$this->error('测试站暂时不能修改！');
		}

		$round = array(0, 1, 2, 3, 4, 5, 6);

		if (!in_array($_POST['round'], $round)) {
			$this->error('小数位数格式错误！');
		}

		if ($_POST['id']) {
			$rs = $this->Model->save($_POST);
		}
		else {
			$_POST['name'] = $_POST['sellname'] . '_' . $_POST['buyname'];
			unset($_POST['buyname']);
			unset($_POST['sellname']);

			if (M('Market')->where(array('name' => $_POST['name']))->find()) {
				$this->error('市场存在！');
			}

			$rs = $this->Model->add($_POST);
		}

		if ($rs) {
			$this->success('操作成功！');
		}
		else {
			$this->error('操作失败！');
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
}

?>