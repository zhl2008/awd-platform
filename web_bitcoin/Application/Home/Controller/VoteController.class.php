<?php
namespace Home\Controller;

class VoteController extends HomeController
{
	public function index()
	{

		
		if (!userid()) {
			redirect('/#login');
		}
		
		$coin_list = M('VoteType')->select();

		if (is_array($coin_list)) {
			foreach ($coin_list as $k => $v) {
				$vv = $v;
				
				//$v = M('Coin')->where(array('name'=>$v['coinname']))->find();
				//$voteC = M('Coin')->where(array('name'=>$vv['votecoin']))->find();
				//$voteC = C('coin')[$vv['votecoin']];
				
				//$list[$v['name']]['img'] = $v['img'];
				//$list[$v['name']]['name'] = $v['name'];
				
				
				$list[$vv['coinname']]['name'] = $vv['coinname'];
				$list[$vv['coinname']]['title'] = $vv['title'];
				$list[$vv['coinname']]['zhichi'] = M('Vote')->where(array('coinname' => $vv['coinname'], 'type' => 1))->count() + $vv['zhichi'];
				$list[$vv['coinname']]['fandui'] = M('Vote')->where(array('coinname' => $vv['coinname'], 'type' => 2))->count() + $vv['fandui'];
				$list[$vv['coinname']]['zongji'] = $list[$vv['coinname']]['zhichi'] - $list[$vv['coinname']]['fandui'];
				$list[$vv['coinname']]['bili'] = round(($list[$vv['coinname']]['zhichi'] / $list[$vv['coinname']]['zongji']) * 100, 2);
				$list[$vv['coinname']]['votecoin'] =  C('coin')[$vv['votecoin']]['title'];
				$list[$vv['coinname']]['assumnum'] = $vv['assumnum'];
				$list[$vv['coinname']]['id'] = $vv['id'];
			}
			
			
			
 			$sort = array(  
					'direction' => 'SORT_DESC',
					'field'     => 'zongji', 
			);  
			$arrSort = array();  
			foreach($list AS $uniqid => $row){  
				foreach($row AS $key=>$value){  
					$arrSort[$key][$uniqid] = $value;  
				}  
			} 
			
			
			if($sort['direction']){  
				array_multisort($arrSort[$sort['field']], constant($sort['direction']), $list);  
			}   		
			
			
			$this->assign('list', $list);
		}

		$this->assign('prompt_text', D('Text')->get_content('game_vote'));
		$this->display();
	}

	public function up($type = NULL,$coinname = NULL,$votecoin = NULL,$id = 0)
	{
		if (!userid()) {
			$this->error('请先登录！');
		}

		if (($type != 1) && ($type != 2)) {
			$this->error('参数错误！');
		}

		if (!is_array(D('Coin')->get_all_name_list())) {
			$this->error('参数错误2！');
		}

		$curVote = M('VoteType')->where(array('coinname'=>$coinname,'id'=>$id))->find();

		if($curVote){
			$curUserB = M('UserCoin')->where(array('userid' =>userid()))->getField($curVote['votecoin']);
			
			//var_dump($curUserB);
			
			if(floatval($curUserB)<floatval($curVote['assumnum'])){
				$this->error('投票所需要的'.$votecoin.'数量不足');
			}
			
		}else{
			$this->error('不存在的投票类型');
		}
		//$this->error('测试中');
		//if (M('Vote')->where(array('userid' => userid(), 'coinname' => $coinname))->find()) {
			//$this->error('您已经投票过，不能再次操作！');
		//}
		
		
		
		
		
		if (1>3) {
			//$this->error('您已经投票过，不能再次操作！');
		}
		//else if(1==1) {
		else if(M('Vote')->add(array('userid' => userid(), 'coinname' => $coinname,'title' => $curVote['title'], 'type' => $type, 'addtime' => time(), 'status' => 1))) {
//            $zhichi = M('Vote')->where(array('coinname' => $coinname, 'type' => 1))->count();
//            $fandui = M('Vote')->where(array('coinname' => $coinname, 'type' => 2))->count();
//            $meta = array(
//                'zhichi' => $zhichi,
//                'fandui' => $fandui,
//                'zongji' => $zhichi + $fandui,
//                'bili' => round(($zhichi / $fandui) * 100, 2),
//            );
//            M('VoteType')->where(array('coinname' => $coinname))->save($meta);

			M('UserCoin')->where(array('userid' =>userid()))->setDec($curVote['votecoin'],$curVote['assumnum']);


			$this->success('投票成功！');
		}
		else {
			$this->error('投票失败！');
		}
	}

	public function uninstall()
	{

	}
}

?>