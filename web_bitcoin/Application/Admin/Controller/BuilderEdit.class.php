<?php
namespace Admin\Controller;

class BuilderEdit extends AdminController
{
	private $_title;
	private $_suggest;
	private $_titleList;
	private $_keyList = array();
	private $_data = array();
	private $_buttonList = array();
	private $_savePostUrl = array();
	private $_group = array();
	private $_callback;

	public function title($title)
	{
		$this->_title = $title;
		return $this;
	}

	public function titleList($title, $url)
	{
		$this->_titleList = array('title' => $title, 'url' => $url);
		return $this;
	}

	public function suggest($suggest)
	{
		$this->_suggest = $suggest;
		return $this;
	}

	public function callback($callback)
	{
		$this->_callback = $callback;
		return $this;
	}

	public function keyTitle($name = 'title', $title = '标题', $subtitle = NULL)
	{
		return $this->keyText($name, $title, $subtitle);
	}

	public function keyId($name = 'id', $title = '编号', $subtitle = NULL)
	{
		return $this->keyReadOnly($name, $title, $subtitle);
	}

	public function keyHidden($name, $title, $subtitle = NULL)
	{
		return $this->key($name, $title, $subtitle, 'hidden');
	}

	public function keyReadOnly($name, $title, $subtitle = NULL)
	{
		return $this->key($name, $title, $subtitle, 'readonly');
	}

	public function keyText($name, $title, $subtitle = NULL)
	{
		return $this->key($name, $title, $subtitle, 'text');
	}

	public function keyPass($name, $title, $subtitle = NULL)
	{
		return $this->key($name, $title, $subtitle, 'pass');
	}

	public function keySelect($name, $title, $subtitle = NULL, $options)
	{
		return $this->key($name, $title, $subtitle, 'select', $options);
	}

	public function keyStatus($name = 'status', $title = '状态', $subtitle = NULL, $map = NULL)
	{
		if (empty($map)) {
			$map = array('禁用', '启用');
		}

		return $this->key($name, $title, $subtitle, 'select', $map);
	}

	public function keyTime($name, $title, $subtitle = NULL, $type = 'time')
	{
		return $this->key($name, $title, $subtitle, $type);
	}

	public function keyAddTime($name = 'addtime', $title = '添加时间', $subtitle = '不填写，默认当前时间')
	{
		return $this->keyTime($name, $title, $subtitle);
	}

	public function keyEndTime($name = 'endtime', $title = '编辑时间', $subtitle = '不填写，默认当前时间')
	{
		return $this->keyTime($name, $title, $subtitle);
	}

	public function keyTextArea($name, $title, $subtitle = NULL)
	{
		return $this->key($name, $title, $subtitle, 'textarea');
	}

	public function keyEditor($name, $title, $subtitle = NULL, $config = '', $style = NULL)
	{
		if (empty($style)) {
			$style = array('width' => '520px', 'height' => '200px');
		}

		$toolbars = 'toolbars:[[' . $config . ']]';

		if (empty($config)) {
			$toolbars = 'toolbars:[[\'source\',\'|\',\'bold\',\'italic\',\'underline\',\'fontsize\',\'forecolor\',\'justifyleft\',\'fontfamily\',\'|\',\'map\',\'emotion\',\'insertimage\',\'insertcode\',\'fullscreen\']]';
		}

		if ($config == 'all') {
			$toolbars = 'all';
		}

		$key = array('name' => $name, 'title' => $title, 'subtitle' => $subtitle, 'type' => 'editor', 'config' => $toolbars, 'style' => $style);
		$this->_keyList[] = $key;
		return $this;
	}

	public function keyImage($name, $title, $subtitle = NULL, $options = array())
	{
		if (empty($options)) {
			$options = array('width' => 408, 'height' => 80, 'savePath' => '', 'url' => '');
		}

		return $this->key($name, $title, $subtitle, 'singleImage', $options);
	}

	public function keyMultiImage($name, $title, $subtitle = NULL, $limit = '')
	{
		return $this->key($name, $title, $subtitle, 'multiImage', $limit);
	}

	public function keyRadio($name, $title, $options, $subtitle = NULL)
	{
		if (empty($subtitle)) {
			$subtitle = $title;
		}

		return $this->key($name, $title, $subtitle, 'radio', $options);
	}

	public function keyColor($name, $title, $subtitle = NULL)
	{
		return $this->key($name, $title, $subtitle, 'colorPicker');
	}

	public function keyLabel($name, $title, $subtitle = NULL)
	{
		return $this->key($name, $title, $subtitle, 'label');
	}

	public function keyInteger($name, $title, $subtitle = NULL)
	{
		return $this->key($name, $title, $subtitle, 'integer');
	}

	public function keyUid($name, $title, $subtitle = NULL)
	{
		return $this->key($name, $title, $subtitle, 'uid');
	}

	public function keyCheckBox($name, $title, $subtitle = NULL, $options)
	{
		return $this->key($name, $title, $subtitle, 'checkbox', $options);
	}

	public function key($name, $title, $subtitle = NULL, $type, $opt = NULL)
	{
		$key = array('name' => $name, 'title' => $title, 'subtitle' => $subtitle, 'type' => $type, 'opt' => $opt);
		$this->_keyList[] = $key;
		return $this;
	}

	public function keyBool($name, $title, $subtitle = NULL)
	{
		$map = array(1 => '是', 0 => '否');
		return $this->keyRadio($name, $title, $subtitle, $map);
	}

	public function keySwitch($name, $title, $subtitle = NULL)
	{
		$map = array(1 => '打开', 0 => '关闭');
		return $this->keyRadio($name, $title, $subtitle, $map);
	}

	public function keyKanban($name, $title, $subtitle = NULL)
	{
		return $this->key($name, $title, $subtitle, 'kanban');
	}

	public function keyMultiUserGroup($name, $title, $subtitle = NULL)
	{
		$options = $this->readUserGroups();
		return $this->keyCheckBox($name, $title, $subtitle, $options);
	}

	public function keySingleFile($name, $title, $subtitle = NULL)
	{
		return $this->key($name, $title, $subtitle, 'singleFile');
	}

	public function keyMultiFile($name, $title, $subtitle = NULL)
	{
		return $this->key($name, $title, $subtitle, 'multiFile');
	}

	public function keySingleUserGroup($name, $title, $subtitle = NULL)
	{
		$options = $this->readUserGroups();
		return $this->keySelect($name, $title, $subtitle, $options);
	}

	public function keyCity($name = array('province', 'city', 'district'), $title, $subtitle)
	{
		return $this->key($name, $title, $subtitle, 'city');
	}

	public function keyDataSelect($name, $title, $subtitle = NULL, $url)
	{
		$urls = U($url, array('inputid' => $name));
		return $this->key($name, $title, $subtitle, 'dataselect', $urls);
	}

	public function button($title, $attr = array())
	{
		$this->_buttonList[] = array('title' => $title, 'attr' => $attr);
		return $this;
	}

	public function data($list)
	{
		$this->_data = $list;
		return $this;
	}

	public function savePostUrl($url)
	{
		if ($url) {
			$this->_savePostUrl = $url;
		}
	}

	public function keyChosen($name, $title, $subtitle = NULL, $options)
	{
		if (key($options) === 0) {
			if (!is_array(reset($options))) {
				foreach ($options as $key => &$val) {
					$val = array($val, $val);
				}

				unset($key);
				unset($val);
			}
		}
		else {
			foreach ($options as $key => &$val) {
				foreach ($val as $k => &$v) {
					if (!is_array($v)) {
						$v = array($v, $v);
					}
				}

				unset($k);
				unset($v);
			}

			unset($key);
			unset($val);
		}

		return $this->key($name, $title, $subtitle, 'chosen', $options);
	}

	public function keyMultiInput($name, $title, $subtitle, $config, $style = NULL)
	{
		empty($style) && ($style = 'width:400px;');
		$key = array('name' => $name, 'title' => $title, 'subtitle' => $subtitle, 'type' => 'multiInput', 'config' => $config, 'style' => $style);
		$this->_keyList[] = $key;
		return $this;
	}

	public function group($name, $list = array())
	{
		!is_array($list) && ($list = explode(',', $list));
		$this->_group[$name] = $list;
		return $this;
	}

	public function groups($list = array())
	{
		foreach ($list as $key => $v) {
			$this->_group[$key] = (is_array($v) ? $v : explode(',', $v));
		}

		return $this;
	}

	public function handleConfig()
	{
		if (IS_POST) {
			$success = false;
			$configModel = D('Config');

			foreach (I('') as $k => $v) {
				$config['name'] = '_' . strtoupper(CONTROLLER_NAME) . '_' . strtoupper($k);
				$config['type'] = 0;
				$config['title'] = '';
				$config['group'] = 0;
				$config['extra'] = '';
				$config['remark'] = '';
				$config['create_time'] = time();
				$config['update_time'] = time();
				$config['status'] = 1;
				$config['value'] = (is_array($v) ? implode(',', $v) : $v);
				$config['sort'] = 0;

				if ($configModel->add($config, null, true)) {
					$success = 1;
				}

				$tag = 'conf_' . strtoupper(CONTROLLER_NAME) . '_' . strtoupper($k);
				S($tag, null);
			}

			if ($success) {
				if ($this->_callback) {
					$str = $this->_callback;
					A(CONTROLLER_NAME)->$str(I(''));
				}

				header('Content-type: application/json');
				exit(json_encode(array('info' => '保存配置成功！', 'status' => 1, 'url' => __SELF__)));
			}
			else {
				header('Content-type: application/json');
				exit(json_encode(array('info' => '保存配置失败!', 'status' => 0, 'url' => __SELF__)));
			}
		}
		else {
			$configs = D('Config')->where(array(
				'name' => array('like', '_' . strtoupper(CONTROLLER_NAME) . '_' . '%')
				))->limit(999)->select();
			$data = array();

			foreach ($configs as $k => $v) {
				$key = str_replace('_' . strtoupper(CONTROLLER_NAME) . '_', '', strtoupper($v['name']));
				$data[$key] = $v['value'];
			}

			return $data;
		}
	}

	private function readUserGroups()
	{
		$list = M('AuthGroup')->where(array('status' => 1))->order('id asc')->select();
		$result = array();

		foreach ($list as $group) {
			$result[$group['id']] = $group['title'];
		}

		return $result;
	}

	public function parseKanbanArray($data, $item = array(), $default = array())
	{
		if (empty($data)) {
			$head = reset($default);

			if (!array_key_exists('items', $head)) {
				$temp = array();

				foreach ($default as $k => $v) {
					$temp[] = array('data-id' => $k, 'title' => $k, 'items' => $v);
				}

				$default = $temp;
			}

			$result = $default;
		}
		else {
			$data = json_decode($data, true);
			$item_d = getSubByKey($item, 'data-id');
			$all = array();

			foreach ($data as $key => $v) {
				$data_id = getSubByKey($v['items'], 'data-id');
				$data_d[$key] = $v;
				unset($data_d[$key]['items']);
				$data_d[$key]['items'] = ($data_id ? $data_id : array());
				$all = array_merge($all, $data_id);
			}

			unset($v);

			foreach ($item_d as $val) {
				if (!in_array($val, $all)) {
					$data_d[0]['items'][] = $val;
				}
			}

			unset($val);

			foreach ($all as $v) {
				if (!in_array($v, $item_d)) {
					foreach ($data_d as $key => $val) {
						$key_search = array_search($v, $val['items']);

						if (!is_bool($key_search)) {
							unset($data_d[$key]['items'][$key_search]);
						}
					}

					unset($val);
				}
			}

			unset($v);
			$item_t = array();

			foreach ($item as $val) {
				$item_t[$val['data-id']] = $val['title'];
			}

			unset($v);

			foreach ($data_d as &$v) {
				foreach ($v['items'] as &$val) {
					$t = $val;
					$val = array();
					$val['data-id'] = $t;
					$val['title'] = $item_t[$t];
				}

				unset($val);
			}

			unset($v);
			$result = $data_d;
		}

		return $result;
	}

	public function setDefault($data, $key, $value)
	{
		$data[$key] = ($data[$key] != null ? $data[$key] : $value);
		return $data;
	}

	public function keyDefault($key, $value)
	{
		$data = $this->_data;
		$data[$key] = ($data[$key] !== null ? $data[$key] : $value);
		$this->_data = $data;
		return $this;
	}

	public function groupLocalComment($group_name, $mod)
	{
		$mod = strtoupper($mod);
		$this->keyDefault($mod . '_LOCAL_COMMENT_CAN_GUEST', 1);
		$this->keyDefault($mod . '_LOCAL_COMMENT_ORDER', 0);
		$this->keyDefault($mod . '_LOCAL_COMMENT_COUNT', 10);
		$this->keyRadio($mod . '_LOCAL_COMMENT_CAN_GUEST', L('_COMMENTS_ALLOW_VISITOR_IF_'), L('_ALLOW_DEFAULT_'), array(L('_DISALLOW_'), L('_ALLOW_')))->keyRadio($mod . '_LOCAL_COMMENT_ORDER', L('_COMMENTS_SORT_'), L('_DESC_DEFAULT_'), array(L('DESC'), L('ASC')))->keyText($mod . '_LOCAL_COMMENT_COUNT', L('_COMMENTS_PAGE_DISPLAY_COUNT_'), L('post_show_image_number_default'));
		$this->group($group_name, $mod . '_LOCAL_COMMENT_CAN_GUEST,' . $mod . '_LOCAL_COMMENT_ORDER,' . $mod . '_LOCAL_COMMENT_COUNT');
		return $this;
	}

	public function keyUserDefined($name, $title, $subtitle, $display = '', $param = '')
	{
		$this->assign('param', $param);
		$this->assign('name', $name);
		$html = $this->fetch($display);
		$key = array('name' => $name, 'title' => $title, 'subtitle' => $subtitle, 'type' => 'userDefined', 'definedHtml' => $html);
		$this->_keyList[] = $key;
		return $this;
	}

	public function addCustomJs($script)
	{
		$this->assign('myJs', $script);
	}

	public function display($templateFile = '', $charset = '', $contentType = '', $content = '', $prefix = '')
	{
		foreach ($this->_keyList as &$e) {
			if ($e['type'] == 'multiInput') {
				$e['name'] = explode('|', $e['name']);
			}

			if (is_array($e['name'])) {
				$i = 0;
				$n = count($e['name']);

				while (0 < $n) {
					$e['value'][$i] = $this->_data[$e['name'][$i]];
					$i++;
					$n--;
				}
			}
			else {
				$e['value'] = $this->_data[$e['name']];
			}
		}

		foreach ($this->_buttonList as &$button) {
			
		}

		$this->assign('group', $this->_group);
		$this->assign('title', $this->_title);
		$this->assign('suggest', $this->_suggest);
		$this->assign('titleList', $this->_titleList);
		$this->assign('keyList', $this->_keyList);
		$this->assign('buttonList', $this->_buttonList);
		$this->assign('savePostUrl', $this->_savePostUrl);
		parent::display('Public/edit');
	}
}

?>