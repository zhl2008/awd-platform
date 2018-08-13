<?php
namespace Admin\Controller;

class TradeController extends AdminController
{
	public function index($field = NULL, $name = NULL, $market = NULL, $status = NULL,$type=0)
	{
		//$this->checkUpdata();
		$where = array();

		if ($field && $name) {
			if ($field == 'username') {
				$where['userid'] = M('User')->where(array('username' => $name))->getField('id');
			}
			else {
				$where[$field] = $name;
			}
		}
		
		
		$where['userid'] = array('gt',0);
		
		
		if ($market) {
			$where['market'] = $market;
		}

		if ($status) {
			$where['status'] = $status;
		}
		
		if($status == 0 && $status != null){
			$where['status'] = 0;
		}
		if ($type==1 || $type==2) {
			$where['type'] = $type;
		}
		
		

		$count = M('Trade')->where($where)->count();
		
		$qq3479015851_getSum = M('Trade')->where($where)->sum('mum');
		
		$Page = new \Think\Page($count, 15);
		$show = $Page->show();
		$list = M('Trade')->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

		foreach ($list as $k => $v) {
			$list[$k]['username'] = M('User')->where(array('id' => $v['userid']))->getField('username');
		}
		$this->assign('list', $list);
		$this->assign('qq3479015851_count', $count);
		$this->assign('qq3479015851_getSum', $qq3479015851_getSum);
		$this->assign('page', $show);
		$this->display();
	}

	public function chexiao($id = NULL)
	{
		$rs = D('Trade')->chexiao($id);

		if ($rs[0]) {
			$this->success($rs[1]);
		}
		else {
			$this->error($rs[1]);
		}
	}

	public function log($field = NULL, $name = NULL, $market = NULL,$type=NULL)
	{
		$where = array();

		if ($field && $name) {
			if ($field == 'username') {
				$where['userid'] = M('User')->where(array('username' => $name))->getField('id');
			}
			else if ($field == 'peername') {
				$where['peerid'] = M('User')->where(array('username' => $name))->getField('id');
			}
			else {
				$where[$field] = $name;
			}
		}
		
		
		if ($type==1 || $type==2) {
			$where['type'] = $type;
		}
		
		$where['userid'] = array('gt',0);

		if ($market) {
			$where['market'] = $market;
		}

		$count = M('TradeLog')->where($where)->count();
		$qq3479015851_getSum = M('TradeLog')->where($where)->sum('mum');
		$Page = new \Think\Page($count, 15);
		$show = $Page->show();
		$list = M('TradeLog')->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

		foreach ($list as $k => $v) {
			$list[$k]['username'] = M('User')->where(array('id' => $v['userid']))->getField('username');
			$list[$k]['peername'] = M('User')->where(array('id' => $v['peerid']))->getField('username');
		}

		
		$this->assign('qq3479015851_count', $count);
		$this->assign('qq3479015851_getSum', $qq3479015851_getSum);
		
		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	public function chat($field = NULL, $name = NULL)
	{
		$where = array();

		if ($field && $name) {
			if ($field == 'username') {
				$where['userid'] = M('User')->where(array('username' => $name))->getField('id');
			}
			else {
				$where[$field] = $name;
			}
		}

		$count = M('Chat')->where($where)->count();
		$Page = new \Think\Page($count, 15);
		$show = $Page->show();
		$list = M('Chat')->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

		foreach ($list as $k => $v) {
			$list[$k]['username'] = M('User')->where(array('id' => $v['userid']))->getField('username');
		}

		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	public function chatStatus($id = NULL, $type = NULL, $moble = 'Chat')
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

	public function comment($field = NULL, $name = NULL, $coinname = NULL)
	{
		$where = array();

		if ($field && $name) {
			if ($field == 'username') {
				$where['userid'] = M('User')->where(array('username' => $name))->getField('id');
			}
			else {
				$where[$field] = $name;
			}
		}

		if ($coinname) {
			$where['coinname'] = $coinname;
		}

		$count = M('CoinComment')->where($where)->count();
		$Page = new \Think\Page($count, 15);
		$show = $Page->show();
		$list = M('CoinComment')->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

		foreach ($list as $k => $v) {
			$list[$k]['username'] = M('User')->where(array('id' => $v['userid']))->getField('username');
		}

		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	public function commentStatus($id = NULL, $type = NULL, $moble = 'CoinComment')
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

	public function market($field = NULL, $name = NULL)
	{
		$where = array();

		if ($field && $name) {
			if ($field == 'username') {
				$where['userid'] = M('User')->where(array('username' => $name))->getField('id');
			}
			else {
				$where[$field] = $name;
			}
		}

		$count = M('Market')->where($where)->count();
		$Page = new \Think\Page($count, 15);
		$show = $Page->show();
		$list = M('Market')->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		
		foreach($list as $k=>$v){
			if($v['begintrade']){
				$begintradeqq_3479015851 = substr($v['begintrade'],0,5);
			}else{
				$begintradeqq_3479015851 = "00:00";
			}
			if($v['endtrade']){
				$endtradeqq_3479015851 = substr($v['endtrade'],0,5);
			}else{
				$endtradeqq_3479015851 = "23:59";
			}
			
			
			$list[$k]['tradetimeqq3479015851'] = $begintradeqq_3479015851."-".$endtradeqq_3479015851;
		}
		
		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	public function marketEdit($id = NULL)
	{
		
		
		$qq3479015851_getCoreConfig = qq3479015851_getCoreConfig();
		if(!$qq3479015851_getCoreConfig){
			$this->error('核心配置有误');
		}

		
		
		if (empty($_POST)) {
			if (empty($id)) {
				$this->data = array();
				
				$beginshi = "00";
				$beginfen = "00";
				$endshi = "23";
				$endfen = "59";
				
			}
			else {
				$market_qq3479015851 = M('Market')->where(array('id' => $id))->find();
				$this->data = $market_qq3479015851;

				if($market_qq3479015851['begintrade']){
					$beginshi = explode(":",$market_qq3479015851['begintrade'])[0];
					$beginfen = explode(":",$market_qq3479015851['begintrade'])[1];
				}else{
					$beginshi = "00";
					$beginfen = "00";
				}
				
				if($market_qq3479015851['endtrade']){
					$endshi = explode(":",$market_qq3479015851['endtrade'])[0];
					$endfen = explode(":",$market_qq3479015851['endtrade'])[1];
				}else{
					$endshi = "23";
					$endfen = "59";
				}
	
			}
			
			$this->assign('qq3479015851_getCoreConfig',$qq3479015851_getCoreConfig['qq3479015851_indexcat']);
			$this->assign('beginshi', $beginshi);
			$this->assign('beginfen', $beginfen);
			$this->assign('endshi', $endshi);
			$this->assign('endfen', $endfen);
			$this->display();
		}
		else {
			if (APP_DEMO) {
				$this->error('测试站暂时不能修改！');
			}

			$round = array(0, 1, 2, 3, 4, 5, 6);

			if (!in_array($_POST['round'], $round)) {
				$this->error('小数位数格式错误！');
			}

			if ($_POST['id']) {
				$rs = M('Market')->save($_POST);
			}
			else {
				$_POST['name'] = $_POST['sellname'] . '_' . $_POST['buyname'];
				unset($_POST['buyname']);
				unset($_POST['sellname']);

				if (M('Market')->where(array('name' => $_POST['name']))->find()) {
					$this->error('市场存在！');
				}

				$rs = M('Market')->add($_POST);
			}

			if ($rs) {
				$this->success('操作成功！');
			}
			else {
				$this->error('操作失败！');
			}
		}
	}

	public function marketStatus($id = NULL, $type = NULL, $moble = 'Market')
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

	public function invit($field = NULL, $name = NULL)
	{
		$where = array();

		if ($field && $name) {
			if ($field == 'username') {
				$where['userid'] = M('User')->where(array('username' => $name))->getField('id');
			}
			else {
				$where[$field] = $name;
			}
		}

		$count = M('Invit')->where($where)->count();
		$Page = new \Think\Page($count, 15);
		$show = $Page->show();
		$list = M('Invit')->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

		foreach ($list as $k => $v) {
			$list[$k]['username'] = M('User')->where(array('id' => $v['userid']))->getField('username');
			$list[$k]['invit'] = M('User')->where(array('id' => $v['invit']))->getField('username');
		}

		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	public function checkUpdata()
	{
		if (!S(MODULE_NAME . CONTROLLER_NAME . 'checkUpdata')) {
			$list = M('Menu')->where(array(
				'url' => 'Trade/index',
				'pid' => array('neq', 0)
				))->select();

			if ($list[1]) {
				M('Menu')->where(array('id' => $list[1]['id']))->delete();
			}
			else if (!$list) {
				M('Menu')->add(array('url' => 'Trade/index', 'title' => '委托管理', 'pid' => 5, 'sort' => 1, 'hide' => 0, 'group' => '交易', 'ico_name' => 'stats'));
			}
			else {
				M('Menu')->where(array(
					'url' => 'Trade/index',
					'pid' => array('neq', 0)
					))->save(array('title' => '委托管理', 'pid' => 5, 'sort' => 1, 'hide' => 0, 'group' => '交易', 'ico_name' => 'stats'));
			}

			$list = M('Menu')->where(array(
				'url' => 'Trade/log',
				'pid' => array('neq', 0)
				))->select();

			if ($list[1]) {
				M('Menu')->where(array('id' => $list[1]['id']))->delete();
			}
			else if (!$list) {
				M('Menu')->add(array('url' => 'Trade/log', 'title' => '成交记录', 'pid' => 5, 'sort' => 2, 'hide' => 0, 'group' => '交易', 'ico_name' => 'stats'));
			}
			else {
				M('Menu')->where(array(
					'url' => 'Trade/log',
					'pid' => array('neq', 0)
					))->save(array('title' => '成交记录', 'pid' => 5, 'sort' => 2, 'hide' => 0, 'group' => '交易', 'ico_name' => 'stats'));
			}

			$list = M('Menu')->where(array(
				'url' => 'Trade/chat',
				'pid' => array('neq', 0)
				))->select();

			if ($list[1]) {
				M('Menu')->where(array('id' => $list[1]['id']))->delete();
			}
			else if (!$list) {
				M('Menu')->add(array('url' => 'Trade/chat', 'title' => '交易聊天', 'pid' => 5, 'sort' => 3, 'hide' => 0, 'group' => '交易', 'ico_name' => 'stats'));
			}
			else {
				M('Menu')->where(array(
					'url' => 'Trade/chat',
					'pid' => array('neq', 0)
					))->save(array('title' => '交易聊天', 'pid' => 5, 'sort' => 3, 'hide' => 0, 'group' => '交易', 'ico_name' => 'stats'));
			}

			$list = M('Menu')->where(array(
				'url' => 'Trade/comment',
				'pid' => array('neq', 0)
				))->select();

			if ($list[1]) {
				M('Menu')->where(array('id' => $list[1]['id']))->delete();
			}
			else if (!$list) {
				M('Menu')->add(array('url' => 'Trade/comment', 'title' => '币种评论', 'pid' => 5, 'sort' => 4, 'hide' => 0, 'group' => '交易', 'ico_name' => 'stats'));
			}
			else {
				M('Menu')->where(array(
					'url' => 'Trade/comment',
					'pid' => array('neq', 0)
					))->save(array('title' => '币种评论', 'pid' => 5, 'sort' => 4, 'hide' => 0, 'group' => '交易', 'ico_name' => 'stats'));
			}

			$list = M('Menu')->where(array(
				'url' => 'Trade/market',
				'pid' => array('neq', 0)
				))->select();

			if ($list[1]) {
				M('Menu')->where(array('id' => $list[1]['id']))->delete();
			}
			else if (!$list) {
				M('Menu')->add(array('url' => 'Trade/market', 'title' => '交易市场', 'pid' => 5, 'sort' => 5, 'hide' => 0, 'group' => '交易', 'ico_name' => 'stats'));
			}
			else {
				M('Menu')->where(array(
					'url' => 'Trade/market',
					'pid' => array('neq', 0)
					))->save(array('title' => '交易市场', 'pid' => 5, 'sort' => 5, 'hide' => 0, 'group' => '交易', 'ico_name' => 'stats'));
			}

			$list = M('Menu')->where(array(
				'url' => 'Trade/invit',
				'pid' => array('neq', 0)
				))->select();

			if ($list[1]) {
				M('Menu')->where(array('id' => $list[1]['id']))->delete();
			}
			else if (!$list) {
				M('Menu')->add(array('url' => 'Trade/invit', 'title' => '交易推荐', 'pid' => 5, 'sort' => 6, 'hide' => 0, 'group' => '交易', 'ico_name' => 'stats'));
			}
			else {
				M('Menu')->where(array(
					'url' => 'Trade/invit',
					'pid' => array('neq', 0)
					))->save(array('title' => '交易推荐', 'pid' => 5, 'sort' => 6, 'hide' => 0, 'group' => '交易', 'ico_name' => 'stats'));
			}

			if (M('Menu')->where(array('url' => 'Chat/index'))->delete()) {
				M('AuthRule')->where(array('status' => 1))->delete();
			}

			if (M('Menu')->where(array('url' => 'Tradelog/index'))->delete()) {
				M('AuthRule')->where(array('status' => 1))->delete();
			}

			S(MODULE_NAME . CONTROLLER_NAME . 'checkUpdata', 1);
		}
	}
}

?>