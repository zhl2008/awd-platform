<?php

namespace Common\Model;

class TreeModel
{
	/**
		 * 将格式数组转换为树
		 *
		 * @param array   $list
		 * @param integer $level 进行递归时传递用的参数
		 */
	private $formatTree;

	public function toTree($list = NULL, $pk = 'id', $pid = 'pid', $child = '_child')
	{
		if (null === $list) {
			$list = &$this->dataList;
		}

		$tree = array();

		if (is_array($list)) {
			$refer = array();

			foreach ($list as $key => $data) {
				$_key = (is_object($data) ? $data->$pk : $data[$pk]);
				$refer[$_key] = &$list[$key];
			}

			foreach ($list as $key => $data) {
				$parentId = (is_object($data) ? $data->$pid : $data[$pid]);
				$is_exist_pid = false;

				foreach ($refer as $k => $v) {
					if ($parentId == $k) {
						$is_exist_pid = true;
						break;
					}
				}

				if ($is_exist_pid) {
					if (isset($refer[$parentId])) {
						$parent = &$refer[$parentId];
						$parent[$child][] = &$list[$key];
					}
				}
				else {
					$tree[] = &$list[$key];
				}
			}
		}

		return $tree;
	}

	private function _toFormatTree($list, $level = 0, $title = 'title')
	{
		foreach ($list as $key => $val) {
			$tmp_str = str_repeat('&nbsp;', $level * 2);
			$tmp_str .= '└';
			$val['level'] = $level;
			$val['title_show'] = ($level == 0 ? $val[$title] . '&nbsp;' : $tmp_str . $val[$title] . '&nbsp;');

			if (!array_key_exists('_child', $val)) {
				array_push($this->formatTree, $val);
			}
			else {
				$tmp_ary = $val['_child'];
				unset($val['_child']);
				array_push($this->formatTree, $val);
				$this->_toFormatTree($tmp_ary, $level + 1, $title);
			}
		}

		return NULL;
	}

	public function toFormatTree($list, $title = 'title', $pk = 'id', $pid = 'pid', $root = 0)
	{
		$list = list_to_tree($list, $pk, $pid, '_child', $root);
		$this->formatTree = array();
		$this->_toFormatTree($list, 0, $title);
		return $this->formatTree;
	}
}

?>