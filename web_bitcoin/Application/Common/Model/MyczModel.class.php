<?php
namespace Common\Model;

class MyczModel extends \Think\Model
{
	protected $keyS = 'Mycz';

	public function check_intact()
	{
		$list = M('Menu')->where(array('url' => 'Mycz/index'))->select();

		if ($list[1]) {
			M('Menu')->where(array('id' => $list[1]['id']))->delete();
		}
		else if (!$list) {
			M('Menu')->add(array('url' => 'Mycz/index', 'title' => '充值记录', 'pid' => 4, 'sort' => 1, 'hide' => 0, 'group' => '充值管理', 'ico_name' => 'th-list'));
		}
		else {
			M('Menu')->where(array('url' => 'Mycz/index'))->save(array('title' => '充值记录', 'pid' => 4, 'sort' => 1, 'hide' => 0, 'group' => '充值管理', 'ico_name' => 'th-list'));
		}

		$list = M('Menu')->where(array('url' => 'Mycz/type'))->select();

		if ($list[1]) {
			M('Menu')->where(array('id' => $list[1]['id']))->delete();
		}
		else if (!$list) {
			M('Menu')->add(array('url' => 'Mycz/type', 'title' => '充值方式', 'pid' => 4, 'sort' => 2, 'hide' => 0, 'group' => '充值管理', 'ico_name' => 'th-list'));
		}
		else {
			M('Menu')->where(array('url' => 'Mycz/type'))->save(array('title' => '充值方式', 'pid' => 4, 'sort' => 2, 'hide' => 0, 'group' => '充值管理', 'ico_name' => 'th-list'));
		}

		$list = M('Menu')->where(array('url' => 'Mycz/invit'))->select();

		if ($list[1]) {
			M('Menu')->where(array('id' => $list[1]['id']))->delete();
		}
		else if (!$list) {
			M('Menu')->add(array('url' => 'Mycz/invit', 'title' => '充值推荐', 'pid' => 4, 'sort' => 3, 'hide' => 0, 'group' => '充值管理', 'ico_name' => 'th-list'));
		}
		else {
			M('Menu')->where(array('url' => 'Mycz/invit'))->save(array('title' => '充值推荐', 'pid' => 4, 'sort' => 3, 'hide' => 0, 'group' => '充值管理', 'ico_name' => 'th-list'));
		}
	}

	public function check_type($name = NULL)
	{
		if (empty($name)) {
			return null;
		}

		if (M('MyczType')->where(array('name' => $name))->find()) {
			return true;
		}
		else {
			return null;
		}
	}

	public function get_type_list()
	{
		$get_type_list = (APP_DEBUG ? null : S('get_type_list' . $this->keyS));

		if (!$get_type_list) {
			$list = M('MyczType')->select();

			foreach ($list as $k => $v) {
				$get_type_list[$v['name']] = $v['title'];
			}

			S('get_type_list' . $this->keyS, $get_type_list);
		}

		return $get_type_list;
	}
}

?>