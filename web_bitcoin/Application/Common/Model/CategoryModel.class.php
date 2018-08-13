<?php
namespace Common\Model;
class CategoryModel extends \Think\Model
{
	protected $_validate = array(
		'un-handled kind  in zend_ast' => array('un-handled kind  in zend_ast' => 'name', 'un-handled kind  in zend_ast' => 'require', 'un-handled kind  in zend_ast' => '标识不能为空', 'un-handled kind  in zend_ast' => self::EXISTS_VALIDATE, 'un-handled kind  in zend_ast' => 'regex', 'un-handled kind  in zend_ast' => self::MODEL_BOTH),
		'un-handled kind  in zend_ast' => array('un-handled kind  in zend_ast' => 'name', 'un-handled kind  in zend_ast' => '', 'un-handled kind  in zend_ast' => '标识已经存在', 'un-handled kind  in zend_ast' => self::VALUE_VALIDATE, 'un-handled kind  in zend_ast' => 'unique', 'un-handled kind  in zend_ast' => self::MODEL_BOTH),
		'un-handled kind  in zend_ast' => array('un-handled kind  in zend_ast' => 'title', 'un-handled kind  in zend_ast' => 'require', 'un-handled kind  in zend_ast' => '名称不能为空', 'un-handled kind  in zend_ast' => self::MUST_VALIDATE, 'un-handled kind  in zend_ast' => 'regex', 'un-handled kind  in zend_ast' => self::MODEL_BOTH),
		'un-handled kind  in zend_ast' => array('un-handled kind  in zend_ast' => 'meta_title', 'un-handled kind  in zend_ast' => '1,50', 'un-handled kind  in zend_ast' => '网页标题不能超过50个字符', 'un-handled kind  in zend_ast' => self::VALUE_VALIDATE, 'un-handled kind  in zend_ast' => 'length', 'un-handled kind  in zend_ast' => self::MODEL_BOTH),
		'un-handled kind  in zend_ast' => array('un-handled kind  in zend_ast' => 'keywords', 'un-handled kind  in zend_ast' => '1,255', 'un-handled kind  in zend_ast' => '网页关键字不能超过255个字符', 'un-handled kind  in zend_ast' => self::VALUE_VALIDATE, 'un-handled kind  in zend_ast' => 'length', 'un-handled kind  in zend_ast' => self::MODEL_BOTH),
		'un-handled kind  in zend_ast' => array('un-handled kind  in zend_ast' => 'meta_title', 'un-handled kind  in zend_ast' => '1,255', 'un-handled kind  in zend_ast' => '网页描述不能超过255个字符', 'un-handled kind  in zend_ast' => self::VALUE_VALIDATE, 'un-handled kind  in zend_ast' => 'length', 'un-handled kind  in zend_ast' => self::MODEL_BOTH)
		);
	protected $_auto = array(
		'un-handled kind  in zend_ast' => array('un-handled kind  in zend_ast' => 'model', 'un-handled kind  in zend_ast' => 'arr2str', 'un-handled kind  in zend_ast' => self::MODEL_BOTH, 'un-handled kind  in zend_ast' => 'function'),
		'un-handled kind  in zend_ast' => array('un-handled kind  in zend_ast' => 'model', 'un-handled kind  in zend_ast' => NULL, 'un-handled kind  in zend_ast' => self::MODEL_BOTH, 'un-handled kind  in zend_ast' => 'ignore'),
		'un-handled kind  in zend_ast' => array('un-handled kind  in zend_ast' => 'type', 'un-handled kind  in zend_ast' => 'arr2str', 'un-handled kind  in zend_ast' => self::MODEL_BOTH, 'un-handled kind  in zend_ast' => 'function'),
		'un-handled kind  in zend_ast' => array('un-handled kind  in zend_ast' => 'type', 'un-handled kind  in zend_ast' => NULL, 'un-handled kind  in zend_ast' => self::MODEL_BOTH, 'un-handled kind  in zend_ast' => 'ignore'),
		'un-handled kind  in zend_ast' => array('un-handled kind  in zend_ast' => 'reply_model', 'un-handled kind  in zend_ast' => 'arr2str', 'un-handled kind  in zend_ast' => self::MODEL_BOTH, 'un-handled kind  in zend_ast' => 'function'),
		'un-handled kind  in zend_ast' => array('un-handled kind  in zend_ast' => 'reply_model', 'un-handled kind  in zend_ast' => NULL, 'un-handled kind  in zend_ast' => self::MODEL_BOTH, 'un-handled kind  in zend_ast' => 'ignore'),
		'un-handled kind  in zend_ast' => array('un-handled kind  in zend_ast' => 'extend', 'un-handled kind  in zend_ast' => 'json_encode', 'un-handled kind  in zend_ast' => self::MODEL_BOTH, 'un-handled kind  in zend_ast' => 'function'),
		'un-handled kind  in zend_ast' => array('un-handled kind  in zend_ast' => 'extend', 'un-handled kind  in zend_ast' => NULL, 'un-handled kind  in zend_ast' => self::MODEL_BOTH, 'un-handled kind  in zend_ast' => 'ignore'),
		'un-handled kind  in zend_ast' => array('un-handled kind  in zend_ast' => 'create_time', 'un-handled kind  in zend_ast' => NOW_TIME, 'un-handled kind  in zend_ast' => self::MODEL_INSERT),
		'un-handled kind  in zend_ast' => array('un-handled kind  in zend_ast' => 'update_time', 'un-handled kind  in zend_ast' => NOW_TIME, 'un-handled kind  in zend_ast' => self::MODEL_BOTH),
		'un-handled kind  in zend_ast' => array('un-handled kind  in zend_ast' => 'status', 'un-handled kind  in zend_ast' => '1', 'un-handled kind  in zend_ast' => self::MODEL_BOTH)
		);

	public function info($id, $field = true)
	{
		$map = array();

		if (is_numeric($id)) {
			$map['id'] = $id;
		}
		else {
			$map['name'] = $id;
		}

		return $this->field($field)->where($map)->find();
	}

	public function getTree($id = 0, $field = true)
	{
		if ($id) {
			$info = $this->info($id);
			$id = $info['id'];
		}

		$map = array(
			'status' => array('gt', -1)
			);
		$list = $this->field($field)->where($map)->order('sort')->select();
		$list = list_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_', $root = $id);

		if (isset($info)) {
			$info['_'] = $list;
		}
		else {
			$info = $list;
		}

		return $info;
	}

	public function getSameLevel($id, $field = true)
	{
		$info = $this->info($id, 'pid');
		$map = array('pid' => $info['pid'], 'status' => 1);
		return $this->field($field)->where($map)->order('sort')->select();
	}

	public function update()
	{
		$data = $this->create();

		if (!$data) {
			return false;
		}

		if (empty($data['id'])) {
			$res = $this->add();
		}
		else {
			$res = $this->save();
		}

		S('sys_category_list', null);
		action_log('update_category', 'category', $data['id'] ? $data['id'] : $res, UID);
		return $res;
	}

	protected function _after_find(&$data, $options)
	{
		if (!empty($data['model'])) {
			$data['model'] = explode(',', $data['model']);
		}

		if (!empty($data['type'])) {
			$data['type'] = explode(',', $data['type']);
		}

		if (!empty($data['reply_model'])) {
			$data['reply_model'] = explode(',', $data['reply_model']);
		}

		if (!empty($data['reply_type'])) {
			$data['reply_type'] = explode(',', $data['reply_type']);
		}

		if (!empty($data['extend'])) {
			$data['extend'] = json_decode($data['extend'], true);
		}
	}
}

?>