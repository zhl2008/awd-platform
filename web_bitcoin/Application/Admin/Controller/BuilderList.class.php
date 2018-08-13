<?php
namespace Admin\Controller;

class BuilderList extends AdminController
{
	private $_title;
	private $_suggest;
	private $_titleList;
	private $_keyList = array();
	private $_buttonList = array();
	private $_pagination = array();
	private $_data = array();
	private $_setStatusUrl;
	private $_searchPostUrl;
	private $_selectPostUrl;
	private $_setDeleteTrueUrl;
	private $_search = array();
	private $_select = array();

	public function title($title)
	{
		$this->_title = $title;
		return $this;
	}

	public function key($name, $title, $type, $opt = NULL, $width = '150px')
	{
		$key = array('name' => $name, 'title' => $title, 'type' => $type, 'opt' => $opt, 'width' => $width);
		$this->_keyList[] = $key;
		return $this;
	}

	public function keyId($name = 'id', $title = 'ID')
	{
		return $this->key($name, $title, 'text');
	}

	public function keyUserid($name = 'userid', $title = '用户名')
	{
		return $this->key($name, $title, 'userid');
	}

	public function keyInvitid($name = 'invitid', $title = '推荐人')
	{
		return $this->key($name, $title, 'userid');
	}

	public function keyShopid($name = 'shopid', $title = '商品')
	{
		return $this->key($name, $title, 'shopid');
	}

	public function keyText($name, $title)
	{
		return $this->key($name, $title, 'text');
	}

	public function keyTime($name, $title)
	{
		return $this->key($name, $title, 'time');
	}

	public function keyStatus($name = 'status', $title = '状态', $map = NULL)
	{
		if (empty($map)) {
			$map = array('禁用', '启用', '未审核');
		}

		return $this->key($name, $title, 'status', $map);
	}

	public function keyType($name = 'type', $title = '类型', $map = NULL)
	{
		return $this->key($name, $title, 'type', $map);
	}

	public function keyLink($name, $title = '操作', $map = NULL)
	{
		if (is_array($map)) {
			if (is_string($map['url'])) {
				$map['url'] = $this->createDefaultGetUrlFunction($map['url']);
			}
		}

		return $this->key($name, $title, 'link', $map);
	}

	public function suggest($suggest)
	{
		$this->_suggest = $suggest;
		return $this;
	}

	public function titleList($title, $url)
	{
		$this->_titleList = array('title' => $title, 'url' => $url);
		return $this;
	}

	public function button($name, $title, $url, $subtitle = '')
	{
		$this->_buttonList[$name] = array('title' => $title, 'url' => $url, 'subtitle' => $subtitle);
		return $this;
	}

	public function buttonSort($href, $title = '排序', $attr = array())
	{
		$attr['href'] = $href;
		return $this->button($title, $attr);
	}

	public function setStatusUrl($url)
	{
		$this->_setStatusUrl = $url;
		return $this;
	}

	public function setDeleteTrueUrl($url)
	{
		$this->_setDeleteTrueUrl = $url;
		return $this;
	}

	public function setSelectPostUrl($url)
	{
		$this->_selectPostUrl = $url;
		return $this;
	}

	public function setSearchPostUrl($url)
	{
		$this->_searchPostUrl = $url;
		return $this;
	}

	public function ajaxButton($url, $params, $title, $attr = array())
	{
		$attr['class'] = 'btn ajax-post';
		$attr['url'] = $this->addUrlParam($url, $params);
		$attr['target-form'] = 'ids';
		return $this->button($title, $attr);
	}

	public function buttonModalPopup($url, $params, $title, $attr = array())
	{
		$attr['modal-url'] = $this->addUrlParam($url, $params);
		$attr['data-role'] = 'modal_popup';
		return $this->button($title, $attr);
	}

	public function search($name = 'key', $type = 'text', $attr = '')
	{
		$this->_search[] = array('name' => $name, 'type' => $type, 'attr' => $attr);
		return $this;
	}

	public function select($title = '筛选', $name = 'key', $type = 'select', $des = '', $attr, $arrdb = '', $arrvalue = NULL)
	{
		if (empty($arrdb)) {
			$this->_select[] = array('title' => $title, 'name' => $name, 'type' => $type, 'des' => $des, 'attr' => $attr, 'arrvalue' => $arrvalue);
		}

		return $this;
	}

	public function keyHtml($name, $title, $width = '150px')
	{
		return $this->key($name, op_h($title), 'html', null, $width);
	}

	public function keyMap($name, $title, $map)
	{
		return $this->key($name, $title, 'map', $map);
	}

	public function keyIcon($name = 'icon', $title = '图标')
	{
		return $this->key($name, $title, 'icon');
	}

	public function keyYesNo($name, $title)
	{
		$map = array('否', '是');
		return $this->keymap($name, $title, $map);
	}

	public function keyBool($name, $title)
	{
		return $this->keyYesNo($name, $title);
	}

	public function keyImage($name, $title)
	{
		return $this->key($name, $title, 'image');
	}

	public function keyCreateTime($name = 'create_time', $title = '创建时间')
	{
		return $this->keyTime($name, $title);
	}

	public function keyUpdateTime($name = 'update_time', $title = '更新时间')
	{
		return $this->keyTime($name, $title);
	}

	public function keyTitle($name = 'title', $title = '标题')
	{
		return $this->keyText($name, $title);
	}

	public function keyJoin($name, $title, $mate, $return, $model, $url = '')
	{
		$map = array('mate' => $mate, 'return' => $return, 'model' => $model, 'url' => $url);
		return $this->key($name, $title, 'Join', $map);
	}

	public function keyDoActionModalPopup($getUrl, $text, $title, $attr = array())
	{
		$attr['data-role'] = 'modal_popup';

		if (is_string($getUrl)) {
			$getUrl = $this->createDefaultGetUrlFunction($getUrl);
		}

		$doActionKey = null;

		foreach ($this->_keyList as $key) {
			if ($key['name'] === 'DOACTIONS') {
				$doActionKey = $key;
				break;
			}
		}

		if (!$doActionKey) {
			$this->key('DOACTIONS', $title, 'doaction', $attr);
		}

		$doActionKey = null;

		foreach ($this->_keyList as &$key) {
			if ($key['name'] == 'DOACTIONS') {
				$doActionKey = &$key;
				break;
			}
		}

		$doActionKey['opt']['actions'][] = array('text' => $text, 'get_url' => $getUrl, 'opt' => $attr);
		return $this;
	}

	public function keyDoAction($getUrl, $text, $title = '操作')
	{
		if (is_string($getUrl)) {
			$getUrl = $this->createDefaultGetUrlFunction($getUrl);
		}

		$doActionKey = null;

		foreach ($this->_keyList as $key) {
			if ($key['name'] === 'DOACTIONS') {
				$doActionKey = $key;
				break;
			}
		}

		if (!$doActionKey) {
			$this->key('DOACTIONS', $title, 'doaction', array());
		}

		$doActionKey = null;

		foreach ($this->_keyList as &$key) {
			if ($key['name'] == 'DOACTIONS') {
				$doActionKey = &$key;
				break;
			}
		}

		$doActionKey['opt']['actions'][] = array('text' => $text, 'get_url' => $getUrl);
		return $this;
	}

	public function keyDoActionEdit($getUrl, $text = '编辑')
	{
		return $this->keyDoAction($getUrl, $text);
	}

	public function keyMycz($name = 'queren', $title = '已付款', $getUrl)
	{
		if (is_string($getUrl)) {
			$getUrl = $this->createDefaultGetUrlFunction($getUrl);
		}

		return $this->key($name, $title, 'queren', $getUrl);
	}

	public function keyDoActionRestore($text = '还原')
	{
		$that = $this;
		$setStatusUrl = $this->_setStatusUrl;
		$getUrl = function() use($that, $setStatusUrl) {
			return $that->addUrlParam($setStatusUrl, array('status' => 1));
		};
		return $this->keyDoAction($getUrl, $text, array('class' => 'ajax-get'));
	}

	public function keyTruncText($name, $title, $length)
	{
		return $this->key($name, $title, 'trunktext', $length);
	}

	public function pagination($totalCount, $listRows, $parameter)
	{
		$this->_pagination = array('totalCount' => $totalCount, 'listRows' => $listRows, 'parameter' => $parameter);
		return $this;
	}

	public function doSetStatus($model, $ids, $status = 1)
	{
		$id = array_unique((array) $ids);

		if ($status == -1) {
			$rs = M($model)->where(array(
				'id' => array('in', $id)
				))->delete();
		}
		else {
			$rs = M($model)->where(array(
				'id' => array('in', $id)
				))->save(array('status' => $status));
		}

		if ($rs === false) {
			$this->error('操作失败!');
		}

		$this->success('操作成功!', $_SERVER['HTTP_REFERER']);
	}

	private function addDefaultCssClass(&$button)
	{
		if (!isset($button['attr']['class'])) {
			$button['attr']['class'] = 'btn';
		}
		else {
			$button['attr']['class'] .= ' btn';
		}
	}

	private function createDefaultGetUrlFunction($pattern)
	{
		$explode = explode('|', $pattern);
		$pattern = $explode[0];
		$fun = (empty($explode[1]) ? 'U' : $explode[1]);
		return function($item) use($pattern, $fun) {
			$pattern = str_replace('###', $item['id'], $pattern);
			$view = new \Think\View();
			$view->assign($item);
			$pattern = $view->fetch('', $pattern);
			return $fun($pattern);
		};
	}

	public function addUrlParam($url, $params)
	{
		if (strpos($url, '?') === false) {
			$seperator = '?';
		}
		else {
			$seperator = '&';
		}

		$params = http_build_query($params);
		return $url . $seperator . $params;
	}

	public function clearTrash($model = '')
	{
		if (IS_POST) {
			if ($model != '') {
				$aIds = I('post.ids', array());

				if (!empty($aIds)) {
					$map['id'] = array('in', $aIds);
				}
				else {
					$map['status'] = -1;
				}

				$result = D($model)->where($map)->delete();

				if ($result) {
					$this->success(L('_SUCCESS_TRASH_CLEARED_', array('result' => $result)));
				}

				$this->error(L('_TRASH_ALREADY_EMPTY_'));
			}
			else {
				$this->error(L('_TRASH_SELECT_'));
			}
		}
	}

	public function doDeleteTrue($model, $ids)
	{
		$ids = (is_array($ids) ? $ids : explode(',', $ids));
		M($model)->where(array(
			'id' => array('in', $ids)
			))->delete();
		$this->success(L('_SUCCESS_DELETE_COMPLETELY_'), $_SERVER['HTTP_REFERER']);
	}

	public function keyLinkByFlag($name, $title, $getUrl, $flag = 'id')
	{
		if (is_string($getUrl)) {
			$getUrl = $this->ParseUrl($getUrl, $flag);
		}

		return $this->key($name, $title, 'link', $getUrl);
	}

	private function ParseUrl($pattern, $flag)
	{
		return function($item) use($pattern, $flag) {
			$pattern = str_replace('###', $item[$flag], $pattern);
			$view = new \Think\View();
			$view->assign($item);
			$pattern = $view->fetch('', $pattern);
			return U($pattern);
		};
	}

	public function data($list)
	{
		$this->_data = $list;
		return $this;
	}

	private function convertKey($from, $to, $convertFunction)
	{
		foreach ($this->_keyList as &$key) {
			if ($key['type'] == $from) {
				$key['type'] = $to;

				foreach ($this->_data as &$data) {
					$value = &$data[$key['name']];
					$value = $convertFunction($value, $key, $data);
					unset($value);
				}

				unset($data);
			}
		}

		unset($key);
	}

	public function display($templateFile = '', $charset = '', $contentType = '', $content = '', $prefix = '')
	{
		$this->convertKey('text', 'html', function($value) {
			return $value;
		});
		$this->convertKey('userid', 'text', function($value) {
			$username = username($value);

			if ($username) {
				return '<a href=\'' . U('User/index', array('type' => 'username', 'name' => $username)) . '\' target=\'_blank\'>' . $username . '</a>';
			}
			else {
				return '---';
			}
		});
		$this->convertKey('shopid', 'text', function($value) {
			$name = D('Shop')->getShopName($value);

			if ($name) {
				return '<a href=\'' . U('Shop/index', array('field' => 'name', 'name' => $name)) . '\' >' . $name . '</a>';
			}
			else {
				return '---';
			}
		});
		$this->convertKey('time', 'text', function($value) {
			if ($value) {
				return addtime($value);
			}
			else {
				return '---';
			}
		});
		$this->convertKey('status', 'html', function($value, $key) {
			return $key['opt'][$value];
		});
		$this->convertKey('type', 'html', function($value, $key) {
			return $key['opt'][$value];
		});
		$this->convertKey('link', 'html', function($value, $key, $item) {
			dump($value);
			dump($key);
			exit();
			$value = htmlspecialchars($value);
			$getUrl = $key['opt'];
			$url = $getUrl($item);

			if (!$value) {
				return '---';
			}
			else {
				return '<a href="' . $url . '" target="_blank">' . $key['title'] . '</a>';
			}
		});
		$this->convertKey('html', 'html', function($value) {
			if ($value === '') {
				return '<span style="color:#bbb;">---</span>';
			}

			return $value;
		});
		$this->convertKey('map', 'text', function($value, $key) {
			return $key['opt'][$value];
		});
		$this->convertKey('trunktext', 'text', function($value, $key) {
			$length = $key['opt'];
			return msubstr($value, 0, $length);
		});
		$this->convertKey('icon', 'html', function($value, $key, $item) {
			$value = htmlspecialchars($value);

			if ($value == '') {
				$html = L('_NONE_');
			}
			else {
				$html = '<i class="' . $value . '"></i> ' . $value;
			}

			return $html;
		});
		$this->convertKey('image', 'html', function($value, $key, $item) {
			$sc_src = $value;
			$html = '<img src=/Upload/' . $sc_src . ' style="height:14px;">';
			return $html;
		});
		$this->convertKey('doaction', 'html', function($value, $key, $item) {
			$actions = $key['opt']['actions'];
			$result = array();

			foreach ($actions as $action) {
				$getUrl = $action['get_url'];
				$linkText = $action['text'];
				$url = $getUrl($item);

				if (isset($action['opt'])) {
					$content = array();

					foreach ($action['opt'] as $key => $value) {
						$value = htmlspecialchars($value);
						$content[] = $key . '="' . $value . '"';
					}

					$content = implode(' ', $content);

					if (isset($action['opt']['data-role']) && ($action['opt']['data-role'] == 'modal_popup')) {
						$result[] = '<a href=" javascrapt:void(0);" modal-url="' . $url . '" ' . $content . '>' . $linkText . '</a>';
					}
					else {
						$result[] = '<a href="' . $url . '" ' . $content . '>' . $linkText . '</a>';
					}
				}
				else {
					$linkTextArr = explode('|', $linkText);

					if (count($linkTextArr) == 1) {
						$result[] = '<a href="' . $url . '">' . $linkText . '</a>';
					}
					else if (count($linkTextArr) == 3) {
						if ($item[$linkTextArr[2]]) {
							$result[] = '';
						}
						else {
							$result[] = '<a href="' . $url . '" class="ajax-get" >' . $linkTextArr[0] . '</a>';
						}
					}
					else if (count($linkTextArr) == 4) {
						if ($item[$linkTextArr[2]]) {
							$result[] = '';
						}
						else {
							$result[] = '<a href="' . $url . '" >' . $linkTextArr[0] . '</a>';
						}
					}
				}
			}

			return implode(' ', $result);
		});
		$this->convertKey('Join', 'html', function($value, $key) {
			if ($value != 0) {
				$val = get_table_field($value, $key['opt']['mate'], $key['opt']['return'], $key['opt']['model']);

				if (!$key['opt']['url']) {
					return $val;
				}
				else {
					$urld = U($key['opt']['url'], array($key['opt']['return'] => $value));
					return '<a href="' . $urld . '">' . $val . '</a>';
				}
			}
			else {
				return '-';
			}
		});
		$pager = new \Think\Page($this->_pagination['totalCount'], $this->_pagination['listRows'], $this->_pagination['parameter']);
		$paginationHtml = $pager->show();
		$this->assign('title', $this->_title);
		$this->assign('suggest', $this->_suggest);
		$this->assign('titleList', $this->_titleList);
		$this->assign('keyList', $this->_keyList);
		$this->assign('buttonList', $this->_buttonList);
		$this->assign('pagination', $paginationHtml);
		$this->assign('list', $this->_data);
		$this->assign('searches', $this->_search);
		$this->assign('searchPostUrl', $this->_searchPostUrl);
		$this->assign('selects', $this->_select);
		$this->assign('selectPostUrl', $this->_selectPostUrl);
		parent::display('Public/list');
	}
}

?>