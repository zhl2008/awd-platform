<?php
namespace Admin\Controller;

class ArticleController extends AdminController
{
	public function index($name = NULL, $field = NULL, $status = NULL)
	{

		//$this->checkUpdata();
		$where = array();

		if ($field && $name) {
			if ($field == 'username') {
				$where['userid'] = M('User')->where(array('username' => $name))->getField('id');
			}
			else if ($field == 'title') {
				$where['title'] = array('like', '%' . $name . '%');
			}
			else {
				$where[$field] = $name;
			}
		}

		if ($status) {
			$where['status'] = $status - 1;
		}

		$count = M('Article')->where($where)->count();
		$Page = new \Think\Page($count, 15);
		$show = $Page->show();
		$list = M('Article')->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

		foreach ($list as $k => $v) {
			$list[$k]['adminid'] = M('Admin')->where(array('id' => $v['adminid']))->getField('username');
			$list[$k]['type'] = M('ArticleType')->where(array('name' => $v['type']))->getField('title');
		}

		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	
	
	public function articleimage()
	{
		$upload = new \Think\Upload();
		$upload->maxSize = 3145728;
		$upload->exts = array('jpg', 'gif', 'png', 'jpeg');
		$upload->rootPath = './Upload/article/';
		$upload->autoSub = false;
		$info = $upload->upload();

		foreach ($info as $k => $v) {
			$path = $v['savepath'] . $v['savename'];
			echo $path;
			exit();
		}
	}
	
	
	
	
	
	
	public function linkimage()
	{
		$upload = new \Think\Upload();
		$upload->maxSize = 3145728;
		$upload->exts = array('jpg', 'gif', 'png', 'jpeg');
		$upload->rootPath = './Upload/link/';
		$upload->autoSub = false;
		$info = $upload->upload();

		foreach ($info as $k => $v) {
			$path = $v['savepath'] . $v['savename'];
			echo $path;
			exit();
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function edit($id = NULL, $type = NULL)
	{
		if (empty($_POST)) {
			$list = M('ArticleType')->select();

			foreach ($list as $k => $v) {
				$listType[$v['name']] = $v['title'];
			}

			$this->assign('list', $listType);

			if ($id) {
				$this->data = M('Article')->where(array('id' => trim($id)))->find();
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

			if ($type == 'images') {
				$baseUrl = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
				$upload = new \Think\Upload();
				$upload->maxSize = 3145728;
				$upload->exts = array('jpg', 'gif', 'png', 'jpeg');
				$upload->rootPath = './Upload/article/';
				$upload->autoSub = false;
				$info = $upload->uploadOne($_FILES['imgFile']);

				if ($info) {
					$data = array('url' => str_replace('./', '/', $upload->rootPath) . $info['savename'], 'error' => 0);
					exit(json_encode($data));
				}
				else {
					$error['error'] = 1;
					$error['message'] = '';
					exit(json_encode($error));
				}
			}
			else {
				$upload = new \Think\Upload();
				$upload->maxSize = 3145728;
				$upload->exts = array('jpg', 'gif', 'png', 'jpeg');
				$upload->rootPath = './Upload/article/';
				$upload->autoSub = false;
				$info = $upload->upload();

				if ($info) {
					foreach ($info as $k => $v) {
						$_POST[$v['key']] = $v['savename'];
					}
				}

				if ($_POST['addtime']) {
					if (addtime(strtotime($_POST['addtime'])) == '---') {
						$this->error('添加时间格式错误');
					}
					else {
						$_POST['addtime'] = strtotime($_POST['addtime']);
					}
				}
				else {
					$_POST['addtime'] = time();
				}

				if ($_POST['endtime']) {
					if (addtime(strtotime($_POST['endtime'])) == '---') {
						$this->error('编辑时间格式错误');
					}
					else {
						$_POST['endtime'] = strtotime($_POST['endtime']);
					}
				}
				else {
					$_POST['endtime'] = time();
				}

				if ($_POST['id']) {
					$rs = M('Article')->save($_POST);
				}
				else {
					$_POST['addtime'] = time();
					$_POST['adminid'] = session('admin_id');
					$rs = M('Article')->add($_POST);
				}

				if ($rs) {
					$this->success('编辑成功！');
				}
				else {
					$this->error('编辑失败！');
				}
			}
		}
	}

	public function status($id = NULL, $type = NULL, $moble = 'Article')
	{
		if (APP_DEMO) {
			$this->error('测试站暂时不能修改！');
		}

		if (empty($id)) {
			$this->error('参数错误！');
		}

		if (empty($type)) {
			$this->error('参数错误1！');
		}

		if (strpos(',', $id)) {
			$id = implode(',', $id);
		}

		$where['id'] = array('in', $id);

		switch (strtolower($type)) {
		case 'forbid':
			$data = array('status' => 0);
			break;

		case 'resume':
			$data = array('status' => 1);
			break;

		case 'repeal':
			$data = array('status' => 2, 'endtime' => time());
			break;

		case 'delete':
			$data = array('status' => -1);
			break;

		case 'del':
			if (M($moble)->where($where)->delete()) {
				$this->success('操作成功！');
			}
			else {
				$this->error('操作失败！');
			}

			break;

		default:
			$this->error('操作失败！');
		}

		if (M($moble)->where($where)->save($data)) {
			$this->success('操作成功！');
		}
		else {
			$this->error('操作失败！');
		}
	}

	public function type($name = NULL, $field = NULL, $status = NULL)
	{
		$where = array();

		if ($field && $name) {
			if ($field == 'username') {
				$where['userid'] = M('User')->where(array('username' => $name))->getField('id');
			}
			else if ($field == 'title') {
				$where['title'] = array('like', '%' . $name . '%');
			}
			else {
				$where[$field] = $name;
			}
		}

		if ($status) {
			$where['status'] = $status - 1;
		}

		$count = M('ArticleType')->where($where)->count();
		$Page = new \Think\Page($count, 15);
		$show = $Page->show();
		$list = M('ArticleType')->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

		foreach ($list as $k => $v) {
			$list[$k]['adminid'] = M('Admin')->where(array('id' => $v['adminid']))->getField('username');
			$list[$k]['shang'] = M('ArticleType')->where(array('name' => $v['shang']))->getField('title');

			if (!$list[$k]['shang']) {
				$list[$k]['shang'] = '顶级';
			}
		}

		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	public function typeEdit($id = NULL, $type = NULL)
	{
		$list = M('ArticleType')->select();

		foreach ($list as $k => $v) {
			$listType[$v['name']] = $v['title'];
		}

		$this->assign('list', $listType);

		if (empty($_POST)) {
			if ($id) {
				$this->data = M('ArticleType')->where(array('id' => trim($id)))->find();
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

			if ($type == 'images') {
				$baseUrl = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
				$upload = new \Think\Upload();
				$upload->maxSize = 3145728;
				$upload->exts = array('jpg', 'gif', 'png', 'jpeg');
				$upload->rootPath = './Upload/article/';
				$upload->autoSub = false;
				$info = $upload->uploadOne($_FILES['imgFile']);

				if ($info) {
					$data = array('url' => str_replace('./', '/', $upload->rootPath) . $info['savename'], 'error' => 0);
					exit(json_encode($data));
				}
				else {
					$error['error'] = 1;
					$error['message'] = '';
					exit(json_encode($error));
				}
			}
			else {
				if ($_POST['addtime']) {
					if (addtime(strtotime($_POST['addtime'])) == '---') {
						$this->error('添加时间格式错误');
					}
					else {
						$_POST['addtime'] = strtotime($_POST['addtime']);
					}
				}
				else {
					$_POST['addtime'] = time();
				}

				if ($_POST['endtime']) {
					if (addtime(strtotime($_POST['endtime'])) == '---') {
						$this->error('编辑时间格式错误');
					}
					else {
						$_POST['endtime'] = strtotime($_POST['endtime']);
					}
				}
				else {
					$_POST['endtime'] = time();
				}

				if ($_POST['id']) {
					$rs = M('ArticleType')->save($_POST);
				}
				else {
					$_POST['adminid'] = session('admin_id');
					$rs = M('ArticleType')->add($_POST);
				}

				if ($rs) {
					$this->success('编辑成功！');
				}
				else {
					$this->error('编辑失败！');
				}
			}
		}
	}

	public function typeStatus($id = NULL, $type = NULL, $moble = 'ArticleType')
	{
		if (APP_DEMO) {
			$this->error('测试站暂时不能修改！');
		}

		if (empty($id)) {
			$this->error('参数错误！');
		}

		if (empty($type)) {
			$this->error('参数错误1！');
		}

		if (strpos(',', $id)) {
			$id = implode(',', $id);
		}

		$where['id'] = array('in', $id);

		switch (strtolower($type)) {
		case 'forbid':
			$data = array('status' => 0);
			break;

		case 'resume':
			$data = array('status' => 1);
			break;

		case 'repeal':
			$data = array('status' => 2, 'endtime' => time());
			break;

		case 'delete':
			$data = array('status' => -1);
			break;

		case 'del':
			if (M($moble)->where($where)->delete()) {
				$this->success('操作成功！');
			}
			else {
				$this->error('操作失败1！');
			}

			break;

		default:
			$this->error('操作失败2！');
		}

		if (M($moble)->where($where)->save($data)) {
			$this->success('操作成功！');
		}
		else {
			$this->error('操作失败3！');
		}
	}

	public function adver($name = NULL, $field = NULL, $status = NULL)
	{
		$where = array();

		if ($field && $name) {
			if ($field == 'username') {
				$where['userid'] = M('User')->where(array('username' => $name))->getField('id');
			}
			else if ($field == 'title') {
				$where['title'] = array('like', '%' . $name . '%');
			}
			else {
				$where[$field] = $name;
			}
		}

		if ($status) {
			$where['status'] = $status - 1;
		}

		$count = M('Adver')->where($where)->count();
		$Page = new \Think\Page($count, 15);
		$show = $Page->show();
		$list = M('Adver')->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	public function adverEdit($id = NULL)
	{
		if (empty($_POST)) {
			if ($id) {
				$this->data = M('Adver')->where(array('id' => trim($id)))->find();
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

			if ($_POST['addtime']) {
				if (addtime(strtotime($_POST['addtime'])) == '---') {
					$this->error('添加时间格式错误');
				}
				else {
					$_POST['addtime'] = strtotime($_POST['addtime']);
				}
			}
			else {
				$_POST['addtime'] = time();
			}

			if ($_POST['endtime']) {
				if (addtime(strtotime($_POST['endtime'])) == '---') {
					$this->error('编辑时间格式错误');
				}
				else {
					$_POST['endtime'] = strtotime($_POST['endtime']);
				}
			}
			else {
				$_POST['endtime'] = time();
			}

			if ($_POST['id']) {
				$rs = M('Adver')->save($_POST);
			}
			else {
				$_POST['adminid'] = session('admin_id');
				$rs = M('Adver')->add($_POST);
			}

			if ($rs) {
				$this->success('编辑成功！');
			}
			else {
				$this->error('编辑失败！');
			}
		}
	}

	public function adverStatus($id = NULL, $type = NULL, $moble = 'Adver')
	{
		if (APP_DEMO) {
			$this->error('测试站暂时不能修改！');
		}

		if (empty($id)) {
			$this->error('参数错误！');
		}

		if (empty($type)) {
			$this->error('参数错误1！');
		}

		if (strpos(',', $id)) {
			$id = implode(',', $id);
		}

		$where['id'] = array('in', $id);

		switch (strtolower($type)) {
		case 'forbid':
			$data = array('status' => 0);
			break;

		case 'resume':
			$data = array('status' => 1);
			break;

		case 'repeal':
			$data = array('status' => 2, 'endtime' => time());
			break;

		case 'delete':
			$data = array('status' => -1);
			break;

		case 'del':
			if (M($moble)->where($where)->delete()) {
				$this->success('操作成功！');
			}
			else {
				$this->error('操作失败1！');
			}

			break;

		default:
			$this->error('操作失败2！');
		}

		if (M($moble)->where($where)->save($data)) {
			$this->success('操作成功！');
		}
		else {
			$this->error('操作失败3！');
		}
	}

	public function adverImage()
	{
		$upload = new \Think\Upload();
		$upload->maxSize = 3145728;
		$upload->exts = array('jpg', 'gif', 'png', 'jpeg');
		$upload->rootPath = './Upload/ad/';
		$upload->autoSub = false;
		$info = $upload->upload();

		foreach ($info as $k => $v) {
			$path = $v['savepath'] . $v['savename'];
			echo $path;
			exit();
		}
	}

	public function link($name = NULL, $field = NULL, $status = NULL)
	{
		$where = array();

		if ($field && $name) {
			if ($field == 'username') {
				$where['userid'] = M('User')->where(array('username' => $name))->getField('id');
			}
			else if ($field == 'title') {
				$where['title'] = array('like', '%' . $name . '%');
			}
			else {
				$where[$field] = $name;
			}
		}

		if ($status) {
			$where['status'] = $status - 1;
		}

		$count = M('Link')->where($where)->count();
		$Page = new \Think\Page($count, 15);
		$show = $Page->show();
		$list = M('Link')->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	public function linkEdit($id = NULL)
	{
		if (empty($_POST)) {
			if ($id) {
				$this->data = M('Link')->where(array('id' => trim($id)))->find();
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

			if ($_POST['addtime']) {
				if (addtime(strtotime($_POST['addtime'])) == '---') {
					$this->error('添加时间格式错误');
				}
				else {
					$_POST['addtime'] = strtotime($_POST['addtime']);
				}
			}
			else {
				$_POST['addtime'] = time();
			}

			if ($_POST['endtime']) {
				if (addtime(strtotime($_POST['endtime'])) == '---') {
					$this->error('编辑时间格式错误');
				}
				else {
					$_POST['endtime'] = strtotime($_POST['endtime']);
				}
			}
			else {
				$_POST['endtime'] = time();
			}

			if ($_POST['id']) {
				$rs = M('Link')->save($_POST);
			}
			else {
				$rs = M('Link')->add($_POST);
					}

			if ($rs) {
				$this->success('编辑成功！');
			}
			else {
				$this->error('编辑失败！');
			}
		}
	}

	public function linkStatus($id = NULL, $type = NULL, $moble = 'Link')
	{
		if (APP_DEMO) {
			$this->error('测试站暂时不能修改！');
		}

		if (empty($id)) {
			$this->error('参数错误！');
		}

		if (empty($type)) {
			$this->error('参数错误1！');
		}

		if (strpos(',', $id)) {
			$id = implode(',', $id);
		}

		$where['id'] = array('in', $id);

		switch (strtolower($type)) {
		case 'forbid':
			$data = array('status' => 0);
			break;

		case 'resume':
			$data = array('status' => 1);	
			break;

		case 'repeal':
			$data = array('status' => 2, 'endtime' => time());
			break;

		case 'delete':
			//$data = array('status' => -1);
			//break;
			
			if (M($moble)->where($where)->delete()) {
				$this->success('操作成功！');
			}
			else {
				$this->error('操作失败1！');
			}

			break;
			

		case 'del':
			if (M($moble)->where($where)->delete()) {
				$this->success('操作成功！');
			}
			else {
				$this->error('操作失败2！');
			}

			break;

		default:
			$this->error('操作失败3！');
		}

		if (M($moble)->where($where)->save($data)) {
			$this->success('操作成功！');
		}
		else {
			$this->error('操作失败4！');
		}
	}

	public function checkUpdata()
	{
		if (!S(MODULE_NAME . CONTROLLER_NAME . 'checkUpdata')) {
			$list = M('Menu')->where(array(
				'url' => 'Article/index',
				'pid' => array('neq', 0)
				))->select();

			if ($list[1]) {
				M('Menu')->where(array('id' => $list[1]['id']))->delete();
			}
			else if (!$list) {
				M('Menu')->add(array('url' => 'Article/index', 'title' => '文章管理', 'pid' => 2, 'sort' => 1, 'hide' => 0, 'group' => '内容', 'ico_name' => 'list-alt'));
			}
			else {
				M('Menu')->where(array(
					'url' => 'Article/index',
					'pid' => array('neq', 0)
					))->save(array('title' => '文章管理', 'pid' => 2, 'sort' => 1, 'hide' => 0, 'group' => '内容', 'ico_name' => 'list-alt'));
			}

			$list = M('Menu')->where(array(
				'url' => 'Article/type',
				'pid' => array('neq', 0)
				))->select();

			if ($list[1]) {
				M('Menu')->where(array('id' => $list[1]['id']))->delete();
			}
			else if (!$list) {
				M('Menu')->add(array('url' => 'Article/type', 'title' => '文章类型', 'pid' => 2, 'sort' => 2, 'hide' => 0, 'group' => '内容', 'ico_name' => 'list-alt'));
			}
			else {
				M('Menu')->where(array(
					'url' => 'Article/type',
					'pid' => array('neq', 0)
					))->save(array('title' => '文章类型', 'pid' => 2, 'sort' => 2, 'hide' => 0, 'group' => '内容', 'ico_name' => 'list-alt'));
			}

			$list = M('Menu')->where(array(
				'url' => 'Article/adver',
				'pid' => array('neq', 0)
				))->select();

			if ($list[1]) {
				M('Menu')->where(array('id' => $list[1]['id']))->delete();
			}
			else if (!$list) {
				M('Menu')->add(array('url' => 'Article/adver', 'title' => '广告管理', 'pid' => 2, 'sort' => 3, 'hide' => 0, 'group' => '内容', 'ico_name' => 'list-alt'));
			}
			else {
				M('Menu')->where(array(
					'url' => 'Article/adver',
					'pid' => array('neq', 0)
					))->save(array('title' => '广告管理', 'pid' => 2, 'sort' => 3, 'hide' => 0, 'group' => '内容', 'ico_name' => 'list-alt'));
			}

			$list = M('Menu')->where(array(
				'url' => 'Article/link',
				'pid' => array('neq', 0)
				))->select();

			if ($list[1]) {
				M('Menu')->where(array('id' => $list[1]['id']))->delete();
			}
			else if (!$list) {
				M('Menu')->add(array('url' => 'Article/link', 'title' => '友情链接', 'pid' => 2, 'sort' => 4, 'hide' => 0, 'group' => '内容', 'ico_name' => 'list-alt'));
			}
			else {
				M('Menu')->where(array(
					'url' => 'Article/link',
					'pid' => array('neq', 0)
					))->save(array('title' => '友情链接', 'pid' => 2, 'sort' => 4, 'hide' => 0, 'group' => '内容', 'ico_name' => 'list-alt'));
			}

			$list = M('Menu')->where(array(
				'url' => 'Article/status',
				'pid' => array('neq', 0)
				))->select();

			if ($list[1]) {
				M('Menu')->where(array('id' => $list[1]['id']))->delete();
			}
			else {
				$pid = M('Menu')->where(array(
					'url' => 'Article/index',
					'pid' => array('neq', 0)
					))->getField('id');

				if (!$list) {
					M('Menu')->add(array('url' => 'Article/status', 'title' => '修改状态', 'pid' => $pid, 'sort' => 100, 'hide' => 1, 'group' => '内容', 'ico_name' => 'home'));
				}
				else {
					M('Menu')->where(array(
						'url' => 'Article/status',
						'pid' => array('neq', 0)
						))->save(array('title' => '修改状态', 'pid' => $pid, 'sort' => 100, 'hide' => 1, 'group' => '内容', 'ico_name' => 'home'));
				}
			}

			$list = M('Menu')->where(array(
				'url' => 'Article/edit',
				'pid' => array('neq', 0)
				))->select();

			if ($list[1]) {
				M('Menu')->where(array('id' => $list[1]['id']))->delete();
			}
			else {
				$pid = M('Menu')->where(array(
					'url' => 'Article/index',
					'pid' => array('neq', 0)
					))->getField('id');

				if (!$list) {
					M('Menu')->add(array('url' => 'Article/edit', 'title' => '编辑添加', 'pid' => $pid, 'sort' => 1, 'hide' => 1, 'group' => '内容', 'ico_name' => 'home'));
				}
				else {
					M('Menu')->where(array(
						'url' => 'Article/edit',
						'pid' => array('neq', 0)
						))->save(array('title' => '编辑添加', 'pid' => $pid, 'sort' => 1, 'hide' => 1, 'group' => '内容', 'ico_name' => 'home'));
				}
			}

			$list = M('Menu')->where(array(
				'url' => 'Article/typeEdit',
				'pid' => array('neq', 0)
				))->select();

			if ($list[1]) {
				M('Menu')->where(array('id' => $list[1]['id']))->delete();
			}
			else {
				$pid = M('Menu')->where(array(
					'url' => 'Article/type',
					'pid' => array('neq', 0)
					))->getField('id');

				if (!$list) {
					M('Menu')->add(array('url' => 'Article/typeEdit', 'title' => '编辑添加', 'pid' => $pid, 'sort' => 1, 'hide' => 1, 'group' => '内容', 'ico_name' => 'home'));
				}
				else {
					M('Menu')->where(array(
						'url' => 'Article/typeEdit',
						'pid' => array('neq', 0)
						))->save(array('title' => '编辑添加', 'pid' => $pid, 'sort' => 1, 'hide' => 1, 'group' => '内容', 'ico_name' => 'home'));
				}
			}

			$list = M('Menu')->where(array(
				'url' => 'Article/typeStatus',
				'pid' => array('neq', 0)
				))->select();

			if ($list[1]) {
				M('Menu')->where(array('id' => $list[1]['id']))->delete();
			}
			else {
				$pid = M('Menu')->where(array(
					'url' => 'Article/type',
					'pid' => array('neq', 0)
					))->getField('id');

				if (!$list) {
					M('Menu')->add(array('url' => 'Article/typeStatus', 'title' => '修改状态', 'pid' => $pid, 'sort' => 100, 'hide' => 1, 'group' => '内容', 'ico_name' => 'home'));
				}
				else {
					M('Menu')->where(array(
						'url' => 'Article/typeStatus',
						'pid' => array('neq', 0)
						))->save(array('title' => '修改状态', 'pid' => $pid, 'sort' => 100, 'hide' => 1, 'group' => '内容', 'ico_name' => 'home'));
				}
			}

			$list = M('Menu')->where(array(
				'url' => 'Article/linkEdit',
				'pid' => array('neq', 0)
				))->select();

			if ($list[1]) {
				M('Menu')->where(array('id' => $list[1]['id']))->delete();
			}
			else {
				$pid = M('Menu')->where(array(
					'url' => 'Article/link',
					'pid' => array('neq', 0)
					))->getField('id');

				if (!$list) {
					M('Menu')->add(array('url' => 'Article/linkEdit', 'title' => '编辑添加', 'pid' => $pid, 'sort' => 1, 'hide' => 1, 'group' => '内容', 'ico_name' => 'home'));
				}
				else {
					M('Menu')->where(array(
						'url' => 'Article/linkEdit',
						'pid' => array('neq', 0)
						))->save(array('title' => '编辑添加', 'pid' => $pid, 'sort' => 1, 'hide' => 1, 'group' => '内容', 'ico_name' => 'home'));
				}
			}

			$list = M('Menu')->where(array(
				'url' => 'Article/linkStatus',
				'pid' => array('neq', 0)
				))->select();

			if ($list[1]) {
				M('Menu')->where(array('id' => $list[1]['id']))->delete();
			}
			else {
				$pid = M('Menu')->where(array(
					'url' => 'Article/link',
					'pid' => array('neq', 0)
					))->getField('id');

				if (!$list) {
					M('Menu')->add(array('url' => 'Article/linkStatus', 'title' => '修改状态', 'pid' => $pid, 'sort' => 100, 'hide' => 1, 'group' => '内容', 'ico_name' => 'home'));
				}
				else {
					M('Menu')->where(array(
						'url' => 'Article/linkStatus',
						'pid' => array('neq', 0)
						))->save(array('title' => '修改状态', 'pid' => $pid, 'sort' => 100, 'hide' => 1, 'group' => '内容', 'ico_name' => 'home'));
				}
			}

			$list = M('Menu')->where(array(
				'url' => 'Article/adverEdit',
				'pid' => array('neq', 0)
				))->select();

			if ($list[1]) {
				M('Menu')->where(array('id' => $list[1]['id']))->delete();
			}
			else {
				$pid = M('Menu')->where(array(
					'url' => 'Article/adver',
					'pid' => array('neq', 0)
					))->getField('id');

				if (!$list) {
					M('Menu')->add(array('url' => 'Article/adverEdit', 'title' => '编辑添加', 'pid' => $pid, 'sort' => 1, 'hide' => 1, 'group' => '内容', 'ico_name' => 'home'));
				}
				else {
					M('Menu')->where(array(
						'url' => 'Article/adverEdit',
						'pid' => array('neq', 0)
						))->save(array('title' => '编辑添加', 'pid' => $pid, 'sort' => 1, 'hide' => 1, 'group' => '内容', 'ico_name' => 'home'));
				}
			}

			$list = M('Menu')->where(array(
				'url' => 'Article/adverStatus',
				'pid' => array('neq', 0)
				))->select();

			if ($list[1]) {
				M('Menu')->where(array('id' => $list[1]['id']))->delete();
			}
			else {
				$pid = M('Menu')->where(array(
					'url' => 'Article/adver',
					'pid' => array('neq', 0)
					))->getField('id');

				if (!$list) {
					M('Menu')->add(array('url' => 'Article/adverStatus', 'title' => '修改状态', 'pid' => $pid, 'sort' => 100, 'hide' => 1, 'group' => '内容', 'ico_name' => 'home'));
				}
				else {
					M('Menu')->where(array(
						'url' => 'Article/adverStatus',
						'pid' => array('neq', 0)
						))->save(array('title' => '修改状态', 'pid' => $pid, 'sort' => 100, 'hide' => 1, 'group' => '内容', 'ico_name' => 'home'));
				}
			}

			$list = M('Menu')->where(array(
				'url' => 'Article/adverImage',
				'pid' => array('neq', 0)
				))->select();

			if ($list[1]) {
				M('Menu')->where(array('id' => $list[1]['id']))->delete();
			}
			else {
				$pid = M('Menu')->where(array(
					'url' => 'Article/adver',
					'pid' => array('neq', 0)
					))->getField('id');

				if (!$list) {
					M('Menu')->add(array('url' => 'Article/adverImage', 'title' => '上传图片', 'pid' => $pid, 'sort' => 100, 'hide' => 1, 'group' => '内容', 'ico_name' => 'home'));
				}
				else {
					M('Menu')->where(array(
						'url' => 'Article/adverImage',
						'pid' => array('neq', 0)
						))->save(array('title' => '上传图片', 'pid' => $pid, 'sort' => 100, 'hide' => 1, 'group' => '内容', 'ico_name' => 'home'));
				}
			}

			if (M('Menu')->where(array('url' => 'Adver/index'))->delete()) {
				M('AuthRule')->where(array('status' => 1))->delete();
			}

			if (M('Menu')->where(array('url' => 'Link/index'))->delete()) {
				M('AuthRule')->where(array('status' => 1))->delete();
			}

			if (M('Menu')->where(array('url' => 'Articletype/index'))->delete()) {
				M('AuthRule')->where(array('status' => 1))->delete();
			}

			if (M('Menu')->where(array('url' => 'Chat/index'))->delete()) {
				M('AuthRule')->where(array('status' => 1))->delete();
			}

			$DbFields = M('Article')->getDbFields();

			if (!in_array('footer', $DbFields)) {
				M()->execute('ALTER TABLE `qq3479015851_article` ADD COLUMN `footer` VARCHAR(200)  NOT NULL   COMMENT \' \' AFTER `id`;');
			}

			if (!in_array('index', $DbFields)) {
				M()->execute('ALTER TABLE `qq3479015851_article` ADD COLUMN `index` VARCHAR(200)  NOT NULL   COMMENT \' \' AFTER `id`;');
			}

			$DbFields = M('ArticleType')->getDbFields();

			if (!in_array('footer', $DbFields)) {
				M()->execute('ALTER TABLE `qq3479015851_article_type` ADD COLUMN `footer` VARCHAR(200)  NOT NULL   COMMENT \' \' AFTER `id`;');
			}

			if (!in_array('index', $DbFields)) {
				M()->execute('ALTER TABLE `qq3479015851_article_type` ADD COLUMN `index` VARCHAR(200)  NOT NULL   COMMENT \' \' AFTER `id`;');
			}

			if (!in_array('content', $DbFields)) {
				M()->execute('ALTER TABLE `qq3479015851_article_type` ADD COLUMN `content` TEXT NOT NULL    COMMENT \' \' AFTER `id`;');
			}

			if (!in_array('shang', $DbFields)) {
				M()->execute('ALTER TABLE `qq3479015851_article_type` ADD COLUMN `shang` TEXT NOT NULL    COMMENT \' \' AFTER `id`;');
			}

			S(MODULE_NAME . CONTROLLER_NAME . 'checkUpdata', 1);
		}
	}
}

?>