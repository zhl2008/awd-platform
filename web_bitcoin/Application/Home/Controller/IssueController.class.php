<?php
namespace Home\Controller;

class IssueController extends HomeController
{
	public function index()
	{
		if (!userid()) {
			redirect('/#login');
		}

		
		$where['status'] = array('neq', 0);
		$Model = M('Issue');
		$count = $Model->where($where)->count();
		$Page = new \Think\Page($count, 5);
		$show = $Page->show();
		//$list = $Model->fetchSql()->where($where)->order('addtime desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

		$list = $Model->where($where)->order('tuijian asc,paixu desc,addtime desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		
		$tuijian = $Model->where(array("tuijian"=>1))->order("addtime desc")->limit(1)->find();
		
		
		if($tuijian){
			
			$tuijian['coinname'] = C('coin')[$tuijian['coinname']]['title'];
			$tuijian['buycoin']  = C('coin')[$tuijian['buycoin']]['title'];
			$tuijian['bili']     = round(($tuijian['deal'] / $tuijian['num']) * 100, 2);
			$tuijian['content']  = mb_substr(clear_html($tuijian['content']),0,350,'utf-8');
			
			
			$end_ms = strtotime($tuijian['time'])+$tuijian['tian']*3600*24;
			$begin_ms = strtotime($tuijian['time']);
			
			$tuijian['beginTime'] = date("Y-m-d H:i:s",$begin_ms);
			$tuijian['endTime']   = date("Y-m-d H:i:s",$end_ms);
			
			$tuijian['zhuangtai'] = "进行中" ;
			
			if($begin_ms>time()){
				$tuijian['zhuangtai'] = "尚未开始";//未开始
			}
			
			
			if($tuijian['num']<=$tuijian['deal']){
				$tuijian['zhuangtai'] =  "已结束";//已结束
			}
			
			
			
			if($end_ms<time()){
				$tuijian['zhuangtai'] = "已结束";//已结束
			}
			
			$tuijian['rengou']="";
			if($tuijian['zhuangtai'] == "进行中"){
				$tuijian['rengou']="<a href='/Issue/buy/id/".$tuijian['id'].".html'>立即认购</a>";
			}
		}
		
		
		
		
		
		
		
		if($list){
			$this->assign('prompt_text', D('Text')->get_content('game_issue'));
		}else{
			$this->assign('prompt_text', '');
		}
		
		
		$list_jinxing = array();
		$list_yure	  = array();
		$list_jieshu  = array();
		
		
		foreach ($list as $k => $v) {
			//$list[$k]['img'] = M('Coin')->where(array('name' => $v['coinname']))->getField('img');
			
			
			
			
			
			
			$list[$k]['bili'] = round(($v['deal'] / $v['num']) * 100, 2);
			$list[$k]['endtime'] = date("Y-m-d H:i:s",strtotime($v['time'])+$v['tian']*3600*24);
			
			$list[$k]['coinname'] = C('coin')[$v['coinname']]['title'];
			$list[$k]['buycoin']  = C('coin')[$v['buycoin']]['title'];
			$list[$k]['bili']     = round(($v['deal'] / $v['num']) * 100, 2);
			$list[$k]['content']  = mb_substr(clear_html($v['content']),0,350,'utf-8');
			
			
			$end_ms = strtotime($v['time'])+$v['tian']*3600*24;
			$begin_ms = strtotime($v['time']);
			
			
			$list[$k]['beginTime'] = date("Y-m-d H:i:s",$begin_ms);
			$list[$k]['endTime']   = date("Y-m-d H:i:s",$end_ms);
			
			$list[$k]['zhuangtai'] = "进行中" ;
			
			if($begin_ms>time()){
				$list[$k]['zhuangtai'] = "尚未开始";//未开始
			}
			
			
			
			if($list[$k]['num']<=$list[$k]['deal']){
				$list[$k]['zhuangtai'] =  "已结束";//已结束
			}

			if($end_ms<time()){
				$list[$k]['zhuangtai'] = "已结束";//已结束
			}
			
			switch($list[$k]['zhuangtai']){
				case "尚未开始":
					$list_yure[] = $list[$k];
					break;
				case "进行中":	
					$list_jinxing[] = $list[$k];
					break;
				case "已结束":
					$list_jieshu[] = $list[$k];
					break;
			}
			
			
			
			
			
			
			
			
		}
		
		//var_dump($list_jieshu);
		
		$this->assign('tuijian', $tuijian);
		$this->assign('list_yure', $list_yure);
		$this->assign('list_jinxing', $list_jinxing);
		$this->assign('list_jieshu', $list_jieshu);
		$this->assign('page', $show);
		$this->display();
	}

	public function buy($id = 1)
	{
		if (!userid()) {
			redirect('/#login');
		}

		$this->assign('prompt_text', D('Text')->get_content('game_issue_buy'));

		if (!check($id, 'd')) {
			$this->error('参数错误！');
		}

		$Issue = M('Issue')->where(array('id' => $id))->find();
		$Issue['bili'] = round(($Issue['deal'] / $Issue['num']) * 100, 2);
		
		$end_ms = strtotime($Issue['time'])+$Issue['tian']*3600*24;
		$begin_ms = strtotime($Issue['time']);
		
		$Issue['status'] = 1 ;
		
		if($begin_ms>time()){
			$Issue['status'] = 2;//未开始
		}
		
		
		if($Issue['num']==$Issue['deal']){
			$Issue['status'] = 0;//已结束
		}
		
		
		
		if($end_ms<time()){
			$Issue['status'] = 0;//已结束
		}
		
		
		$Issue['endtime'] = date("Y-m-d H:i:s",strtotime($Issue['time'])+$Issue['tian']*3600*24);
		
		
		
		
		$user_coin = M('UserCoin')->where(array('userid' => userid()))->find();
		$this->assign('user_coin', $user_coin);

		if (!$Issue) {
			$this->error('认购错误！');
		}

		$Issue['img'] = M('Coin')->where(array('name' => $Issue['coinname']))->getField('img');
		$this->assign('issue', $Issue);
		$this->display();
	}

	public function log($ls = 15)
	{
		if (!userid()) {
			redirect('/#login');
		}

		$this->assign('prompt_text', D('Text')->get_content('game_issue_log'));
		$where['status'] = array('egt', 0);
		$where['userid'] = userid();
		$IssueLog = M('IssueLog');
		$count = $IssueLog->where($where)->count();
		$Page = new \Think\Page($count, $ls);
		$show = $Page->show();
		$list = $IssueLog->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

		foreach ($list as $k => $v) {
			$list[$k]['shen'] = round((($v['ci'] - $v['unlock']) * $v['num']) / $v['ci'], 6);
		}

		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}
	
	
	
	
	
	public function ALLLog($ls = 15)
	{
		if (!userid()) {
			redirect('/#login');
		}

		$this->assign('prompt_text', D('Text')->get_content('game_issue_log'));
		$where['status'] = array('egt', 0);
		$IssueLog = M('IssueLog');
		$count = $IssueLog->where($where)->count();
		$Page = new \Think\Page($count, $ls);
		$show = $Page->show();
		$list = $IssueLog->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

		foreach ($list as $k => $v) {
			$list[$k]['shen'] = round((($v['ci'] - $v['unlock']) * $v['num']) / $v['ci'], 6);
		}

		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}
	
	
	
	
	
	
	

	public function upbuy($id, $num, $paypassword)
	{
		if (!userid()) {
			redirect('/#login');
		}

		if (!check($id, 'd')) {
			$this->error('参数错误！');
		}

		if (!check($num, 'd')) {
			$this->error('认购数量格式错误！');
		}

		if (!check($paypassword, 'password')) {
			$this->error('交易密码格式错误！');
		}

		$User = M('User')->where(array('id' => userid()))->find();

		if (!$User['paypassword']) {
			$this->error('交易密码非法！');
		}

		if (md5($paypassword) != $User['paypassword']) {
			$this->error('交易密码错误！');
		}

		$Issue = M('Issue')->where(array('id' => $id))->find();

		if (!$Issue) {
			$this->error('认购错误！');
		}

		if (time() < strtotime($Issue['time'])) {
			$this->error('当前认购还未开始！');
		}
		
		if (!$Issue['status']) {
			$this->error('当前认购已经结束！');
		}
		
		
		$end_ms = strtotime($Issue['time'])+$Issue['tian']*3600*24;
/* 		$begin_ms = strtotime($Issue['time']);
		if($begin_ms<time()){
			$Issue['status'] = 2;//未开始
		} */
		
		if($end_ms<time()){
			$this->error('当前认购已经结束！');
		}
		
		
		
		


		$issue_min = ($Issue['min'] ? $Issue['min'] : 9.9999999999999995E-7);
		$issue_max = ($Issue['max'] ? $Issue['max'] : 100000000);

		if ($num < $issue_min) {
			$this->error('单次认购数量不得少于系统设置' . $issue_min . '个');
		}

		if ($issue_max < $num) {
			$this->error('单次认购数量不得大于系统设置' . $issue_max . '个');
		}

		if (($Issue['num'] - $Issue['deal']) < $num) {
			$this->error('认购数量超过当前剩余量！');
		}

		$mum = round($Issue['price'] * $num, 6);

		if (!$mum) {
			$this->error('认购总额错误');
		}

		$buycoin = M('UserCoin')->where(array('userid' => userid()))->getField($Issue['buycoin']);

		if ($buycoin < $mum) {
			$this->error('可用' . C('coin')[$Issue['buycoin']]['title'] . '余额不足');
		}

		$issueLog = M('IssueLog')->where(array('userid' => userid(), 'coinname' => $Issue['coinname']))->sum('num');

		if ($Issue['limit'] < ($issueLog + $num)) {
			$this->error('认购总数量超过最大限制' . $Issue['limit']);
		}

		if ($Issue['ci']) {
			$jd_num = round($num / $Issue['ci'], 6);
		}
		else {
			$jd_num = $num;
		}

		if (!$jd_num) {
			$this->error('认购解冻数量错误');
		}

		$mo = M();
		$mo->execute('set autocommit=0');
		$mo->execute('lock tables qq3479015851_invit write ,  qq3479015851_user_coin write  , qq3479015851_issue write  , qq3479015851_issue_log  write ,qq3479015851_finance write');
		$rs = array();
		$finance = $mo->table('qq3479015851_finance')->where(array('userid' => userid()))->order('id desc')->find();
		$finance_num_user_coin = $mo->table('qq3479015851_user_coin')->where(array('userid' => userid()))->find();
		$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => userid()))->setDec($Issue['buycoin'], $mum);
		$rs[] = $finance_nameid = $mo->table('qq3479015851_issue_log')->add(array('userid' => userid(), 'coinname' => $Issue['coinname'], 'buycoin' => $Issue['buycoin'], 'name' => $Issue['name'], 'price' => $Issue['price'], 'num' => $num, 'mum' => $mum, 'ci' => $Issue['ci'], 'jian' => $Issue['jian'], 'unlock' => 1, 'addtime' => time(), 'endtime' => time(), 'status' => $Issue['ci'] == 1 ? 1 : 0));
		$finance_mum_user_coin = $mo->table('qq3479015851_user_coin')->where(array('userid' => userid()))->find();
		$finance_hash = md5(userid() . $finance_num_user_coin['cny'] . $finance_num_user_coin['cnyd'] . $mum . $finance_mum_user_coin['cny'] . $finance_mum_user_coin['cnyd'] . MSCODE . 'auth.qq3479015851.com');
		$rs[] = $mo->table('qq3479015851_finance')->add(array('userid' => userid(), 'coinname' => 'cny', 'num_a' => $finance_num_user_coin['cny'], 'num_b' => $finance_num_user_coin['cnyd'], 'num' => $finance_num_user_coin['cny'] + $finance_num_user_coin['cnyd'], 'fee' => $mum, 'type' => 2, 'name' => 'issue', 'nameid' => $finance_nameid, 'remark' => '认购中心-立即认购', 'mum_a' => $finance_mum_user_coin['cny'], 'mum_b' => $finance_mum_user_coin['cnyd'], 'mum' => $finance_mum_user_coin['cny'] + $finance_mum_user_coin['cnyd'], 'move' => $finance_hash, 'addtime' => time(), 'status' => $finance['mum'] != $finance_num_user_coin['cny'] + $finance_num_user_coin['cnyd'] ? 0 : 1));
		$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => userid()))->setInc($Issue['coinname'], $jd_num);
		$rs[] = $mo->table('qq3479015851_issue')->where(array('id' => $id))->setInc('deal', $num);

		if ($Issue['num'] <= $Issue['deal']) {
			$rs[] = $mo->table('qq3479015851_issue')->where(array('id' => $id))->setField('status', 0);
		}

		if ($User['invit_1'] && $Issue['invit_1']) {
			$invit_num_1 = round(($mum / 100) * $Issue['invit_1'], 6);

			if ($invit_num_1) {
				$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $User['invit_1']))->setInc($Issue['invit_coin'], $invit_num_1);
				$rs[] = $mo->table('qq3479015851_invit')->add(array('userid' => $User['invit_1'], 'invit' => userid(), 'name' => $Issue['name'], 'type' => '一代认购赠送', 'num' => $num, 'mum' => $mum, 'fee' => $invit_num_1, 'addtime' => time(), 'status' => 1));
			}
		}

		if ($User['invit_2'] && $Issue['invit_2']) {
			$invit_num_2 = round(($mum / 100) * $Issue['invit_2'], 6);

			if ($invit_num_2) {
				$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $User['invit_2']))->setInc($Issue['invit_coin'], $invit_num_2);
				$rs[] = $mo->table('qq3479015851_invit')->add(array('userid' => $User['invit_2'], 'invit' => userid(), 'name' => $Issue['name'], 'type' => '二代认购赠送', 'num' => $num, 'mum' => $mum, 'fee' => $invit_num_2, 'addtime' => time(), 'status' => 1));
			}
		}

		if ($User['invit_3'] && $Issue['invit_3']) {
			$invit_num_3 = round(($mum / 100) * $Issue['invit_3'], 6);

			if ($invit_num_3) {
				$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $User['invit_3']))->setInc($Issue['invit_coin'], $invit_num_3);
				$rs[] = $mo->table('qq3479015851_invit')->add(array('userid' => $User['invit_3'], 'invit' => userid(), 'name' => $Issue['name'], 'type' => '三代认购赠送', 'num' => $num, 'mum' => $mum, 'fee' => $invit_num_3, 'addtime' => time(), 'status' => 1));
			}
		}

		if ($mo->execute('commit')>=0) {
			$mo->execute('unlock tables');
			$this->success('购买成功！');
		}
		else {
			$mo->execute('rollback');
			$this->error('购买失败!');
		}
	}

	public function unlock($id)
	{
		if (!userid()) {
			redirect('/#login');
		}

		if (!check($id, 'd')) {
			$this->error('请选择解冻项！');
		}

		$IssueLog = M('IssueLog')->where(array('id' => $id))->find();

		if (!$IssueLog) {
			$this->error('参数错误！');
		}

		if ($IssueLog['status']) {
			$this->error('当前解冻已完成！');
		}

		if ($IssueLog['ci'] <= $IssueLog['unlock']) {
			$this->error('非法访问！');
		}

		$tm = $IssueLog['endtime'] + (60 * 60 * $IssueLog['jian']);

		if (time() < $tm) {
			$this->error('解冻时间还没有到,请在<br>【' . addtime($tm) . '】<br>之后再次操作');
		}

		if ($IssueLog['userid'] != userid()) {
			$this->error('非法访问');
		}

		$jd_num = round($IssueLog['num'] / $IssueLog['ci'], 6);
		$mo = M();
		$mo->execute('set autocommit=0');
		$mo->execute('lock tables qq3479015851_user_coin write  , qq3479015851_issue_log write ');
		$rs = array();
		$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => userid()))->setInc($IssueLog['coinname'], $jd_num);
		$rs[] = $mo->table('qq3479015851_issue_log')->where(array('id' => $IssueLog['id']))->save(array('unlock' => $IssueLog['unlock'] + 1, 'endtime' => time()));

		if ($IssueLog['ci'] <= $IssueLog['unlock'] + 1) {
			$rs[] = $mo->table('qq3479015851_issue_log')->where(array('id' => $IssueLog['id']))->save(array('status' => 1));
		}

		if (check_arr($rs)) {
			$mo->execute('commit');
			$mo->execute('unlock tables');
			$this->success('解冻成功！');
		}
		else {
			$mo->execute('rollback');
			$this->error('解冻失败！');
		}
	}

	public function uninstall()
	{

	}
    
}

?>