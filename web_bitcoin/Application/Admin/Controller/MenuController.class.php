<?php
namespace Admin\Controller;

class MenuController extends AdminController
{
	public function index()
	{
		$pid = I('get.pid', 0);

		if ($pid) {
			$data = M('Menu')->where('id=' . $pid)->field(true)->find();
			$this->assign('data', $data);
		}

		$title = trim(I('get.title'));
		$type = C('CONFIG_GROUP_LIST');
		$all_menu = M('Menu')->getField('id,title');
		$map['pid'] = $pid;

		if ($title) {
			$map['title'] = array('like', '%' . $title . '%');
		}

		$list = M('Menu')->where($map)->field(true)->order('sort asc,id asc')->select();
		int_to_string($list, array(
			'hide'   => array(1 => '是', 0 => '否'),
			'is_dev' => array(1 => '是', 0 => '否')
			));

		if ($list) {
			foreach ($list as &$key) {
				if ($key['pid']) {
					$key['up_title'] = $all_menu[$key['pid']];
				}
			}

			$this->assign('list', $list);
		}

		Cookie('__forward__', $_SERVER['REQUEST_URI']);
		$this->meta_title = '菜单列表';
		$this->display();
	}

	public function add()
	{
		if (IS_POST) {
			if (APP_DEMO) {
				$this->error('测试站暂时不能修改！');
			}

			$Menu = D('Menu');
			$data = $Menu->create();

			if ($data) {
				$id = $Menu->add();

				if ($id) {
					action_log('update_menu', 'Menu', $id, UID);
					$this->success('新增成功', Cookie('__forward__'));
				}
				else {
					$this->error('新增失败');
				}
			}
			else {
				$this->error($Menu->getError());
			}
		}
		else {
			$this->assign('info', array('pid' => I('pid')));
			$menus = M('Menu')->field(true)->select();
			$menus = D('Tree')->toFormatTree($menus);
			$menus = array_merge(array(
				array('id' => 0, 'title_show' => '顶级菜单')
				), $menus);
			$this->assign('Menus', $menus);
			$this->meta_title = '新增菜单';
			$this->display('edit');
		}
	}

	public function edit($id = 0)
	{
		if (IS_POST) {
			if (APP_DEMO) {
				$this->error('测试站暂时不能修改！');
			}

			$Menu = D('Menu');
			$data = $Menu->create();

			if ($data) {
				if ($Menu->save() !== false) {
					action_log('update_menu', 'Menu', $data['id'], UID);
					$this->success('更新成功', Cookie('__forward__'));
				}
				else {
					$this->error('更新失败');
				}
			}
			else {
				$this->error($Menu->getError());
			}
		}
		else {
			$info = array();
			$info = M('Menu')->field(true)->find($id);
			$menus = M('Menu')->field(true)->select();
			$menus = D('Tree')->toFormatTree($menus);
			$menus = array_merge(array(
				array('id' => 0, 'title_show' => '顶级菜单')
				), $menus);
			$this->assign('Menus', $menus);

			if (false === $info) {
				$this->error('获取后台菜单信息错误');
			}

			$this->assign('info', $info);
			$this->meta_title = '编辑后台菜单';
			$this->display();
		}
	}

	public function del()
	{
		if (APP_DEMO) {
			$this->error('测试站暂时不能修改！');
		}

		$id = array_unique((array) I('id', 0));

		if (empty($id)) {
			$this->error('请选择要操作的数据!');
		}

		$map = array(
			'id' => array('in', $id)
			);

		if (M('Menu')->where($map)->delete()) {
			action_log('update_menu', 'Menu', $id, UID);
			$this->success('删除成功');
		}
		else {
			$this->error('删除失败！');
		}
	}

	public function toogleHide($id, $value = 1)
	{
		$this->editRow('Menu', array('hide' => $value), array('id' => $id));
	}

	public function toogleDev($id, $value = 1)
	{
		$this->editRow('Menu', array('is_dev' => $value), array('id' => $id));
	}

	public function importFile($tree = NULL, $pid = 0)
	{
		if ($tree == null) {
			$file = APP_PATH . 'Admin/Conf/Menu.php';
			$tree = require_once $file;
		}

		$menuModel = D('Menu');

		foreach ($tree as $value) {
			$add_pid = $menuModel->add(array('title' => $value['title'], 'url' => $value['url'], 'pid' => $pid, 'hide' => isset($value['hide']) ? (int) $value['hide'] : 0, 'tip' => isset($value['tip']) ? $value['tip'] : '', 'group' => $value['group']));

			if ($value['operator']) {
				$this->import($value['operator'], $add_pid);
			}
		}
	}

	public function import()
	{
		if (IS_POST) {
			$tree = I('post.tree');
			$lists = explode(PHP_EOL, $tree);
			$menuModel = M('Menu');

			if ($lists == array()) {
				$this->error('请按格式填写批量导入的菜单，至少一个菜单');
			}
			else {
				$pid = I('post.pid');

				foreach ($lists as $key => $value) {
					$record = explode('|', $value);

					if (count($record) == 2) {
						$menuModel->add(array('title' => $record[0], 'url' => $record[1], 'pid' => $pid, 'sort' => 0, 'hide' => 0, 'tip' => '', 'is_dev' => 0, 'group' => ''));
					}
				}

				$this->success('导入成功', U('index?pid=' . $pid));
			}
		}
		else {
			$this->meta_title = '批量导入后台菜单';
			$pid = (int) I('get.pid');
			$this->assign('pid', $pid);
			$data = M('Menu')->where('id=' . $pid)->field(true)->find();
			$this->assign('data', $data);
			$this->display();
		}
	}

	public function sort()
	{
		if (IS_GET) {
			$ids = I('get.ids');
			$pid = I('get.pid');
			$map = array(
				'status' => array('gt', -1)
				);

			if (!empty($ids)) {
				$map['id'] = array('in', $ids);
			}
			else if ($pid !== '') {
				$map['pid'] = $pid;
			}

			$list = M('Menu')->where($map)->field('id,title')->order('sort asc,id asc')->select();
			$this->assign('list', $list);
			$this->meta_title = '菜单排序';
			$this->display();
		}
		else if (IS_POST) {
			$ids = I('post.ids');
			$ids = explode(',', $ids);

			foreach ($ids as $key => $value) {
				$res = M('Menu')->where(array('id' => $value))->setField('sort', $key + 1);
			}

			if ($res !== false) {
				$this->success('排序成功！');
			}
			else {
				$this->eorror('排序失败！');
			}
		}
		else {
			$this->error('非法请求！');
		}
	}
}

?>