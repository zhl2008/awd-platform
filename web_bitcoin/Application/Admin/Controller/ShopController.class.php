<?php
namespace Admin\Controller;

class ShopController extends AdminController
{
	public function status($id, $status, $model)
	{
		$builder = new BuilderList();
		$builder->doSetStatus($model, $id, $status);
	}

	public function config($id = NULL)
	{

		if (!empty($_POST)) {
					if (APP_DEMO) {
			$this->error('测试站暂时不能修改！');
		}
			if (M('Config')->where(array('id' => 1))->save($_POST)) {
				$this->success('操作成功');
			}
			else {
				$this->error('操作失败');
			}
		}
		else {
			$data['shop_login'] = C('shop_login');
			$data['shop_logo'] = C('shop_logo');
			$data['shop_coin'] = C('shop_coin');
			$builder = new BuilderEdit();
			$builder->title('商城配置');
			$builder->keySelect('shop_login', '是否要登陆', '是否要登陆才能访问商城', array('不需要', '需要登录'));
			$builder->keyImage('shop_logo', '商城LOGO', '商城LOGO', array('width' => 240, 'height' => 40, 'savePath' => 'shop', 'url' => U('Shop/images')));
			$builder->data($data);
			$builder->savePostUrl(U('Shop/config'));
			$builder->display();
		}
	}

	public function index($p = 1, $r = 15, $str_addtime = '', $end_addtime = '', $order = '', $status = '', $type = '', $field = '', $name = '')
	{
		$Type_arr = D('Shop')->shop_type_list();
		$Type_arr[0] = '全部';
		$map = array();

		if ($str_addtime && $end_addtime) {
			$str_addtime = strtotime($str_addtime);
			$end_addtime = strtotime($end_addtime);

			if ((addtime($str_addtime) != '---') && (addtime($end_addtime) != '---')) {
				$map['addtime'] = array(
					array('egt', $str_addtime),
					array('elt', $end_addtime)
					);
			}
		}

		if (empty($order)) {
			$order = 'id_desc';
		}

		$order_arr = explode('_', $order);

		if (count($order_arr) != 2) {
			$order = 'id_desc';
			$order_arr = explode('_', $order);
		}

		$order_set = $order_arr[0] . ' ' . $order_arr[1];

		if (empty($status)) {
			$map['status'] = array('egt', 0);
		}

		if (($status == 1) || ($status == 2) || ($status == 3)) {
			$map['status'] = $status - 1;
		}

		if ($type && $Type_arr[$type]) {
			$map['type'] = $type;
		}

		if ($field && $name) {
			if ($field == 'name') {
				$map['name'] = array('like', '%' . $name . '%');
			}
			else {
				$map[$field] = $name;
			}
		}

		$data = M('Shop')->where($map)->order($order_set)->page($p, $r)->select();
		$count = M('Shop')->where($map)->count();
		$parameter['p'] = $p;
		$parameter['status'] = $status;
		$parameter['order'] = $order;
		$parameter['type'] = $type;
		$parameter['name'] = $name;
		$builder = new BuilderList();
		$builder->title('商品管理');
		$builder->titleList('商品列表', U('Shop/index'));
		$builder->button('add', '添 加', U('Shop/edit'));
		$builder->button('resume', '启 用', U('Shop/status', array('model' => 'Shop', 'status' => 1)));
		$builder->button('forbid', '禁 用', U('Shop/status', array('model' => 'Shop', 'status' => 0)));
		$builder->button('delete', '删 除', U('Shop/status', array('model' => 'Shop', 'status' => -1)));
		$builder->setSearchPostUrl(U('Shop/index'));
		$builder->search('order', 'select', array('id_desc' => 'ID降序', 'id_asc' => 'ID升序'));
		$builder->search('status', 'select', array('全部状态', '禁用', '启用'));
		$builder->search('type', 'select', $Type_arr);
		$builder->search('field', 'select', array('name' => '商品名称'));
		$builder->search('name', 'text', '请输入查询内容');
		$builder->keyId();
		$builder->keyText('name', '商品名称');
		$builder->keyType('type', '商品类型', $Type_arr);
		
		$coin_list = D('Coin')->get_all_name_list();
		
		$builder->keyType('buycoin', '交易币种',$coin_list);
		
		$builder->keyText('price', '商品价格');
		$builder->keyText('market_price', '市场价');
		$builder->keyText('num', '库存');
		$builder->keyText('deal', '销量');
		$builder->keyText('sort', '排序');
		$builder->keyTime('addtime', '添加时间');
		$builder->keyTime('endtime', '编辑时间');
		$builder->keyStatus('status', '状态', array('禁用', '启用'));
		$builder->keyDoAction('Shop/edit?id=###', '编辑', '操作');
		$builder->data($data);
		$builder->pagination($count, $r, $parameter);
		$builder->display();
	}

	public function edit($id = NULL)
	{
		if (!empty($_POST)) {
			
		if (APP_DEMO) {
			$this->error('测试站暂时不能修改！');
		}
		
			if (!check($_POST['name'], 'a')) {
			}

			if (!check($_POST['type'], 'w')) {
				$this->error('商品类型格式错误');
			}

			if (!check($_POST['price'], 'cny')) {
				$this->error('商品价格格式错误');
			}

			if (!check($_POST['market_price'], 'cny')) {
				$this->error('市场价格式错误');
			}

			if (!check($_POST['num'], 'd')) {
				$this->error('库存格式错误');
			}

			if ($_POST['deal'] && !check($_POST['deal'], 'd')) {
				$this->error('总销量格式错误');
			}

			if (!check($_POST['sort'], 'd')) {
				$this->error('类型排序格式错误');
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

			if (check($_POST['id'], 'd')) {
				$rs = M('Shop')->save($_POST);
			}
			else {
				$rs = M('Shop')->add($_POST);
			}

			if ($rs) {
				$this->success('操作成功');
			}
			else {
				$this->error('操作失败');
			}
		}
		else {
			$builder = new BuilderEdit();
			$builder->title('商品管理');
			$builder->titleList('商品列表', U('Shop/index'));

			if ($id) {
				$builder->keyReadOnly('id', '类型id');
				$builder->keyHidden('id', '类型id');
				$data = M('Shop')->where(array('id' => $id))->find();
				$data['addtime'] = addtime($data['addtime']);
				$data['endtime'] = addtime($data['endtime']);
				$builder->data($data);
			}
			
			$builder->keyText('name', '商品名称', '可以中中文');
			$builder->keySelect('type', '商品类型', '商品类型', D('Shop')->shop_type_list());
			$builder->keyImage('img', '商品图片', '商品logo', array('width' => 408, 'height' => 300, 'savePath' => 'shop', 'url' => U('Shop/images')));
			
			$coin_list = D('Coin')->get_all_name_list();
			
			$builder->keySelect('buycoin', '付款币种', '付款币种', $coin_list);
			
			
			$builder->keyText('qq3479015851_awardcoinnum', '奖励币种数量', '整数,留空或者填写0 不奖励');
			$builder->keySelect('qq3479015851_awardcoin', '奖励币种', '奖励币种', $coin_list);
			
			
			
			$builder->keyText('price', '商品价格', '保留2位小数');
			$builder->keyText('market_price', '市场价格', '保留2位小数');
			$builder->keyText('num', '库存', '整数');
			$builder->keyText('deal', '销量', '整数');
			$builder->keyText('sort', '排序', '整数');
			//$builder->keyEditor('content', '商品介绍', U('Shop/images'));
			$builder->keyEditor('content', '商品介绍', '');
			$builder->keyAddTime();
			$builder->keyEndTime();
			$builder->keyStatus();
			$builder->savePostUrl(U('Shop/edit'));
			$builder->display();
		}
	}

	public function type($p = 1, $r = 15, $str_addtime = '', $end_addtime = '', $order = '', $status = '', $type = '', $field = '', $name = '')
	{
		$map = array();

		if ($str_addtime && $end_addtime) {
			$str_addtime = strtotime($str_addtime);
			$end_addtime = strtotime($end_addtime);

			if ((addtime($str_addtime) != '---') && (addtime($end_addtime) != '---')) {
				$map['addtime'] = array(
					array('egt', $str_addtime),
					array('elt', $end_addtime)
					);
			}
		}

		if (empty($order)) {
			$order = 'id_desc';
		}

		$order_arr = explode('_', $order);

		if (count($order_arr) != 2) {
			$order = 'id_desc';
			$order_arr = explode('_', $order);
		}

		$order_set = $order_arr[0] . ' ' . $order_arr[1];

		if (empty($status)) {
			$map['status'] = array('egt', 0);
		}

		if (($status == 1) || ($status == 2) || ($status == 3)) {
			$map['status'] = $status - 1;
		}

		if ($field && $name) {
			$map[$field] = $name;
		}

		$data = M('ShopType')->where($map)->order($order_set)->page($p, $r)->select();
		$count = M('ShopType')->where($map)->count();
		$parameter['p'] = $p;
		$parameter['status'] = $status;
		$parameter['order'] = $order;
		$parameter['type'] = $type;
		$parameter['name'] = $name;
		$builder = new BuilderList();
		$builder->title('商品类型');
		$builder->titleList('类型列表', U('Shop/type'));
		$builder->button('add', '添 加', U('Shop/edit_type'));
		$builder->button('resume', '启 用', U('Shop/status', array('model' => 'ShopType', 'status' => 1)));
		$builder->button('forbid', '禁 用', U('Shop/status', array('model' => 'ShopType', 'status' => 0)));
		$builder->button('delete', '删 除', U('Shop/status', array('model' => 'ShopType', 'status' => -1)));
		$builder->setSearchPostUrl(U('Shop/type'));
		$builder->search('order', 'select', array('id_desc' => 'ID降序', 'id_asc' => 'ID升序'));
		$builder->search('status', 'select', array('全部状态', '禁用', '启用'));
		$builder->search('field', 'select', array('name' => '类型名称', 'title' => '类型标题'));
		$builder->search('name', 'text', '请输入查询内容');
		$builder->keyId();
		$builder->keyText('name', '类型名称');
		$builder->keyText('title', '类型标题');
		$builder->keyText('remark', '类型备注');
		$builder->keyText('sort', '排序');
		$builder->keyTime('addtime', '添加时间');
		$builder->keyTime('endtime', '编辑时间');
		$builder->keyStatus('status', '状态', array('禁用', '启用'));
		$builder->keyDoAction('Shop/edit_type?id=###', '编辑', '操作');
		$builder->data($data);
		$builder->pagination($count, $r, $parameter);
		$builder->display();
	}

	public function edit_type($id = NULL)
	{
		if (!empty($_POST)) {
					if (APP_DEMO) {
			$this->error('测试站暂时不能修改！');
		}
		
			if (!check($_POST['name'], 'w')) {
				$this->error('类型名称格式错误');
			}

			if (!check($_POST['title'], 'a')) {
				$this->error('类型标题格式错误');
			}

			if (!check($_POST['remark'], 'a')) {
				$this->error('类型备注格式错误');
			}

			if (!check($_POST['sort'], 'd')) {
				$this->error('类型排序格式错误');
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

			if (check($_POST['id'], 'd')) {
				$rs = M('ShopType')->save($_POST);
			}
			else {
				$rs = M('ShopType')->add($_POST);
			}

			if ($rs) {
				$this->success('操作成功');
			}
			else {
				$this->error('操作失败');
			}
		}
		else {
			$builder = new BuilderEdit();
			$builder->title('商品类型');
			$builder->titleList('类型列表', U('Shop/type'));

			if ($id) {
				$builder->keyReadOnly('id', '类型id');
				$builder->keyHidden('id', '类型id');
				$data = M('ShopType')->where(array('id' => $id))->find();
				$data['addtime'] = addtime($data['addtime']);
				$data['endtime'] = addtime($data['endtime']);
				$builder->data($data);
			}

			$builder->keyText('name', '类型名称', '只能是英文字母');
			$builder->keyText('title', '类型标题', '可以中文');
			$builder->keyText('remark', '类型备注', '可以中文');
			$builder->keyText('sort', '类型排序', '只能是数字');
			$builder->keyAddTime();
			$builder->keyEndTime();
			$builder->keyStatus();
			$builder->savePostUrl(U('Shop/edit_type'));
			$builder->display();
		}
	}

	public function coin($p = 1, $r = 15, $str_addtime = '', $end_addtime = '', $order = '', $status = '', $type = '', $field = '', $name = '')
	{
		$map = array();

		if ($str_addtime && $end_addtime) {
			$str_addtime = strtotime($str_addtime);
			$end_addtime = strtotime($end_addtime);

			if ((addtime($str_addtime) != '---') && (addtime($end_addtime) != '---')) {
				$map['addtime'] = array(
					array('egt', $str_addtime),
					array('elt', $end_addtime)
					);
			}
		}

		if (empty($order)) {
			$order = 'id_desc';
		}

		$order_arr = explode('_', $order);

		if (count($order_arr) != 2) {
			$order = 'id_desc';
			$order_arr = explode('_', $order);
		}

		$order_set = $order_arr[0] . ' ' . $order_arr[1];

		if (empty($status)) {
			$map['status'] = array('egt', 0);
		}

		if (($status == 1) || ($status == 2) || ($status == 3)) {
			$map['status'] = $status - 1;
		}

		if ($field && $name) {
			if ($field == 'name') {
				$map['shopid'] = D('Shop')->getShopId($name);
			}

			$map[$field] = $name;
		}

		D('Shop')->tongbu();
		$data = M('ShopCoin')->where($map)->order($order_set)->page($p, $r)->select();
		$count = M('ShopCoin')->where($map)->count();
		$parameter['p'] = $p;
		$parameter['status'] = $status;
		$parameter['order'] = $order;
		$parameter['type'] = $type;
		$parameter['name'] = $name;
		$builder = new BuilderList();
		$builder->title('付款方式');
		$builder->titleList('方式列表', U('Shop/coin'));
		$builder->setSearchPostUrl(U('Shop/coin'));
		$builder->search('order', 'select', array('id_desc' => 'ID降序', 'id_asc' => 'ID升序'));
		$builder->search('field', 'select', array('name' => '商品名称'));
		$builder->search('name', 'text', '请输入查询内容');
		$builder->keyId();
		$builder->keyShopid();
		$coin_list = D('Coin')->get_all_name_list();

		if ($coin_list) {
			foreach ($coin_list as $k => $v) {
				$builder->keyText($k, $v);
			}
		}

		$builder->keyDoAction('Shop/edit_coin?id=###', '编辑', '操作');
		$builder->data($data);
		$builder->pagination($count, $r, $parameter);
		$builder->display();
	}

	public function edit_coin($id = NULL)
	{
		if (!empty($_POST)) {
			
					if (APP_DEMO) {
			$this->error('测试站暂时不能修改！');
		}
		
			if (check($_POST['id'], 'd')) {
				$rs = M('ShopCoin')->save($_POST);
			}
			else {
				$this->error('操作失败1');
			}

			if ($rs) {
				$this->success('操作成功');
			}
			else {
				$this->error('操作失败');
			}
		}
		else {
			$builder = new BuilderEdit();
			$builder->title('付款方式');
			$builder->titleList('方式列表', U('Shop/coin'));

			if ($id) {
				$builder->keyReadOnly('id', '方式id');
				$builder->keyHidden('id', '方式id');
				$data = M('ShopCoin')->where(array('id' => $id))->find();
				$builder->data($data);
			}

			$builder->keyReadOnly('shopid', '商品id', '不能修改');
			$coin_list = D('Coin')->get_all_name_list();

			if ($coin_list) {
				foreach ($coin_list as $k => $v) {
					$builder->keyText($k, $v, '为空或者0则不能使用这个币种付款，使用请设置为数字1 只能设置数字');
				}
			}

			$builder->savePostUrl(U('Shop/edit_coin'));
			$builder->display();
		}
	}

	public function log($p = 1, $r = 15, $str_addtime = '', $end_addtime = '', $order = '', $status = '', $type = '', $field = '', $name = '')
	{
		$map = array();

		if ($str_addtime && $end_addtime) {
			$str_addtime = strtotime($str_addtime);
			$end_addtime = strtotime($end_addtime);

			if ((addtime($str_addtime) != '---') && (addtime($end_addtime) != '---')) {
				$map['addtime'] = array(
					array('egt', $str_addtime),
					array('elt', $end_addtime)
					);
			}
		}

		if (empty($order)) {
			$order = 'id_desc';
		}

		$order_arr = explode('_', $order);

		if (count($order_arr) != 2) {
			$order = 'id_desc';
			$order_arr = explode('_', $order);
		}

		$order_set = $order_arr[0] . ' ' . $order_arr[1];

		if (empty($status)) {
			$map['status'] = array('egt', 0);
		}

		if (($status == 1) || ($status == 2) || ($status == 3)) {
			$map['status'] = $status - 1;
		}

		if ($field && $name) {
			if ($field == 'name') {
				$map['shopid'] = D('Shop')->getShopId($name);
			}

			$map[$field] = $name;
		}

		D('Shop')->tongbu();
		$data = M('ShopLog')->where($map)->order($order_set)->page($p, $r)->select();

		foreach ($data as $k => $v) {
			$data[$k]['fahuo'] = ($v['status'] == 0 ? 0 : 1);
			$data[$k]['chexiao'] = ($v['status'] == 0 ? 0 : 1);
			$data[$k]['shouhuo'] = ($v['status'] == 3 ? 0 : 1);
		}

		$count = M('ShopLog')->where($map)->count();
		$parameter['p'] = $p;
		$parameter['status'] = $status;
		$parameter['order'] = $order;
		$parameter['type'] = $type;
		$parameter['name'] = $name;
		$builder = new BuilderList();
		$builder->title('付款方式');
		$builder->titleList('方式列表', U('Shop/coin'));
		$builder->setSearchPostUrl(U('Shop/coin'));
		$builder->search('order', 'select', array('id_desc' => 'ID降序', 'id_asc' => 'ID升序'));
		$builder->search('field', 'select', array('name' => '商品名称'));
		$builder->search('name', 'text', '请输入查询内容');
		$builder->keyId();
		$builder->keyUserid();
		$builder->keyShopid();
		$builder->keyText('price', '商品价格');
		$builder->keyText('coinname', '付款币种');
		$builder->keyText('num', '购买数量');
		$builder->keyText('mum', '总额[折合人民币]');
		
		$builder->keyText('xuyao', '付款数量[折合人民币]');
		$builder->keyText('addr', '收货地址');
		$builder->keyText('sort', '排序');
		$builder->keyTime('addtime', '添加时间');
		$builder->keyTime('endtime', '更新时间');
		$builder->keyStatus('status', '状态', array('等待发货', '交易完成', '已撤销', '已发货'));
		$builder->keyDoAction('Shop/fahuo?id=###', '已经发货|---|fahuo', '操作');
		$builder->keyDoAction('Shop/chexiao?id=###', '撤销|---|chexiao', '操作');
		$builder->keyDoAction('Shop/shouhuo?id=###', '已收货|---|shouhuo', '操作');
		$builder->data($data);
		$builder->pagination($count, $r, $parameter);
		$builder->display();
	}

	public function fahuo($id = NULL)
	{
		if (!check($id, 'd')) {
			$this->error('参数错误！');
		}

		$rs = M('ShopLog')->where(array('id' => $id))->save(array('status' => 3));

		if ($rs) {
			$this->success('操作成功！');
		}
		else {
			$this->error('操作失败！');
		}
	}

	public function chexiao($id = NULL)
	{
		
		if (!check($id, 'd')) {
			$this->error('参数错误！');
		}

		$shoplog = M('ShopLog')->where(array('id' => $id))->find();

		if (!$shoplog) {
			$this->error('操作失败1！');
		}

		if (!$shoplog['coinname']) {
			$this->error('操作失败2！');
		}

		if (!$shoplog['xuyao']) {
			$this->error('操作失败3！');
		}

		$mo = M();
		$mo->execute('set autocommit=0');
		$mo->execute('lock tables qq3479015851_user_coin write,qq3479015851_shop_log write');
		$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $shoplog['userid']))->setInc($shoplog['coinname'], $shoplog['xuyao']);
		$rs[] = $mo->table('qq3479015851_shop_log')->where(array('id' => $id))->save(array('status' => 2));

		if (check_arr($rs)) {
			$mo->execute('commit');
			$mo->execute('unlock tables');
			$this->success('操作成功！');
		}
		else {
			$mo->execute('rollback');
			$this->error('操作失败！');
		}
	}

	public function shouhuo($id = NULL)
	{
		if (!check($id, 'd')) {
			$this->error('参数错误！');
		}

		$rs = M('ShopLog')->where(array('id' => $id))->save(array('status' => 1));

		if ($rs) {
			$this->success('操作成功！');
		}
		else {
			$this->error('操作失败！');
		}
	}

	public function goods($p = 1, $r = 15, $str_addtime = '', $end_addtime = '', $order = '', $status = '', $type = '', $field = '', $name = '')
	{
		$Type_arr = D('Shop')->shop_type_list();
		$Type_arr[0] = '全部';
		$map = array();

		if ($str_addtime && $end_addtime) {
			$str_addtime = strtotime($str_addtime);
			$end_addtime = strtotime($end_addtime);

			if ((addtime($str_addtime) != '---') && (addtime($end_addtime) != '---')) {
				$map['addtime'] = array(
					array('egt', $str_addtime),
					array('elt', $end_addtime)
					);
			}
		}

		if (empty($order)) {
			$order = 'id_desc';
		}

		$order_arr = explode('_', $order);

		if (count($order_arr) != 2) {
			$order = 'id_desc';
			$order_arr = explode('_', $order);
		}

		$order_set = $order_arr[0] . ' ' . $order_arr[1];

		if (empty($status)) {
			$map['status'] = array('egt', 0);
		}

		if (($status == 1) || ($status == 2) || ($status == 3)) {
			$map['status'] = $status - 1;
		}

		if ($type && $Type_arr[$type]) {
			$map['type'] = $type;
		}

		if ($field && $name) {
			if ($field == 'name') {
				$userid = D('User')->get_userid();

				if ($userid) {
					$map['userid'] = $userid;
				}
				else {
					$map[$field] = $name;
				}
			}
			else {
				$map[$field] = $name;
			}
		}

		$data = M('UserGoods')->where($map)->order($order_set)->page($p, $r)->select();
		$count = M('UserGoods')->where($map)->count();
		$parameter['p'] = $p;
		$parameter['status'] = $status;
		$parameter['order'] = $order;
		$parameter['type'] = $type;
		$parameter['name'] = $name;
		$builder = new BuilderList();
		$builder->title('收货地址');
		$builder->titleList('收货地址', U('Shop/index'));
		$builder->setSearchPostUrl(U('Shop/goods'));
		$builder->search('order', 'select', array('id_desc' => 'ID降序', 'id_asc' => 'ID升序'));
		$builder->search('field', 'select', array('name' => '用户名'));
		$builder->search('name', 'text', '请输入查询内容');
		$builder->keyId();
		$builder->keyUserId();
		$builder->keyText('name', '名称');
		$builder->keyText('truename', '真实姓名');
		$builder->keyText('idcard', '身份证');
		$builder->keyText('moble', '联系电话');
		$builder->keyText('addr', '联系地址');
		$builder->keyText('sort', '排序');
		$builder->keyTime('addtime', '添加时间');
		$builder->data($data);
		$builder->pagination($count, $r, $parameter);
		$builder->display();
	}

	public function images()
	{
		$baseUrl = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
		$upload = new \Think\Upload();
		$upload->maxSize = 3145728;
		$upload->exts = array('jpg', 'gif', 'png', 'jpeg');
		$upload->rootPath = UPLOAD_PATH . 'shop/';
		$upload->autoSub = false;
		$info = $upload->upload();

		if ($info) {
			if (!is_array($info['imgFile'])) {
				$info['imgFile'] = $info['file'];
			}

			$data = array('url' => str_replace('./', '/', $upload->rootPath) . $info['imgFile']['savename'], 'error' => 0);
			exit(json_encode($data));
		}
		else {
			$error['error'] = 1;
			$error['message'] = $upload->getError();
			exit(json_encode($error));
		}
	}
}

?>