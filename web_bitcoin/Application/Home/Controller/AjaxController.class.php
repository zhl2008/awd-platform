<?php
namespace Home\Controller;

class AjaxController extends HomeController
{
	
	public function imgUser(){
		//上传用户身份证
		if (!userid()) {
			echo "nologin";
		}
		
		$userimg = M('User')->where(array('id' => userid()))->getField("idcardimg1");
		if($userimg){
			$img_arr = array();
			$img_arr = explode("_",$userimg);
			if(count($img_arr)>=3){
				M('User')->where(array('id' => userid()))->save(array('idcardimg1' => ''));
			}
		}	
		
		
		
		
		$upload = new \Think\Upload();
		$upload->maxSize = 2048000;
		$upload->exts = array('jpg', 'gif', 'png', 'jpeg');
		$upload->rootPath = './Upload/idcard/';
		$upload->autoSub = false;
		$info = $upload->upload();
		
		if(!$info){
			echo "error";
			exit();
		}
		
		foreach ($info as $k => $v) {
			
			
			$userimg = M('User')->where(array('id' => userid()))->getField("idcardimg1");
			if($userimg){
				$img_arr = array();
				$img_arr = explode("_",$userimg);
				if(count($img_arr)>=3){
					echo "error2";
					exit();
				}
				
				$path = $userimg . "_" . $v['savename'];
			}else{
				$path = $v['savename'];
			}
			if(count($img_arr)>=2){
				M('User')->where(array('id' => userid()))->save(array('idcardimg1' => $path,'idcardinfo'=>''));
			}else{
				M('User')->where(array('id' => userid()))->save(array('idcardimg1' => $path));
			}
			echo $v['savename'];
			exit();
		}
	}
	
	
	public function getJsonMenu($ajax = 'json')
	{
		$data = (APP_DEBUG ? null : S('getJsonMenu'));

		if (!$data) {
			foreach (C('market') as $k => $v) {
				$v['xnb'] = explode('_', $v['name'])[0];
				$v['rmb'] = explode('_', $v['name'])[1];
				$data[$k]['name'] = $v['name'];
				$data[$k]['img'] = $v['xnbimg'];
				$data[$k]['title'] = $v['title'];
			}

			S('getJsonMenu', $data);
		}

		if ($ajax) {
			exit(json_encode($data));
		}
		else {
			return $data;
		}
	}
	
	
	
	public function top_coin_menu($ajax = 'json')
	{
		
		$data = (APP_DEBUG ? null : S('qq3479015851_getTopCoinMenu'));
		
		
		$qq3479015851_getCoreConfig = qq3479015851_getCoreConfig();
		if(!$qq3479015851_getCoreConfig){
			$this->error('核心配置有误');
		}
		
		
		
		
		
		if (!$data) {
			$data = array();
			
			foreach($qq3479015851_getCoreConfig['qq3479015851_indexcat'] as $k=>$v){
				$data[$k][title] = $v;
			}

			foreach (C('market') as $k => $v) {
				
 				$v['xnb'] = explode('_', $v['name'])[0];
				$v['rmb'] = explode('_', $v['name'])[1];

				$data_tmp['img'] = $v['xnbimg'];
				$data_tmp['title'] = $v['navtitle'];
				
				$data[$v['jiaoyiqu']]['data'][$k] = $data_tmp;

				unset($data_tmp);
			}

			S('qq3479015851_getTopCoinMenu', $data);
		}
		
		if ($ajax) {
			exit(json_encode($data));
		}
		else {
			return $data;
		} 
	}
	
	
	
	function getCurrentCny($type){
		if($type == "cny"){
			echo json_encode("");
		}else{
			$coin_price = D('Market')->get_new_price($type . '_cny');
			if ((floatval($coin_price)+0)>0) {
				echo json_encode($coin_price);
			}else{
				echo json_encode("nodata");
			}
		}

	}
	
	
	
	
	
	
	

	public function allfinance($ajax = 'json')
	{
		if (!userid()) {
			return false;
		}

		$UserCoin = M('UserCoin')->where(array('userid' => userid()))->find();
		$cny['zj'] = 0;

		foreach (C('coin') as $k => $v) {
			if ($v['name'] == 'cny') {
				$cny['ky'] = $UserCoin[$v['name']] * 1;
				$cny['dj'] = $UserCoin[$v['name'] . 'd'] * 1;
				$cny['zj'] = $cny['zj'] + $cny['ky'] + $cny['dj'];
			}
			else {
/* 				if (C('market')[$v['name'] . '_cny']['new_price']) {
					$jia = C('market')[$v['name'] . '_cny']['new_price'];
				} */
				
				if (C('market')[C('market_type')[$v['name']]]['new_price']) {
					$jia = C('market')[C('market_type')[$v['name']]]['new_price'];
				}
				
				
				else {
					$jia = 1;
				}

				$cny['zj'] = round($cny['zj'] + (($UserCoin[$v['name']] + $UserCoin[$v['name'] . 'd']) * $jia), 2) * 1;
			}
		}

		$data = round($cny['zj'], 8);
		$data = NumToStr($data);

		if ($ajax) {
			exit(json_encode($data));
		}
		else {
			return $data;
		}
	}

	public function allsum($ajax = 'json')
	{
		$data = (APP_DEBUG ? null : S('allsum'));

		if (!$data) {
			$data = M('TradeLog')->sum('mum');
			S('allsum', $data);
		}

		$data = round($data);
		$data = str_repeat('0', 12 - strlen($data)) . (string) $data;

		if ($ajax) {
			exit(json_encode($data));
		}
		else {
			return $data;
		}
	}

	public function allcoin($ajax = 'json')
	{
		$data = (APP_DEBUG ? null : S('allcoin'));
		
        // 市场交易记录
        $marketLogs = array();
        foreach (C('market') as $k => $v) {
			//S('getTradelog' . $market, null);
            //$_tmp = S('getTradelog' . $k);
			$_tmp = null;
            if (!empty($_tmp)) {
                $marketLogs[$k] = $_tmp;
            } else {
                $tradeLog = M('TradeLog')->where(array('status' => 1, 'market' => $k))->order('id desc')->limit(50)->select();
                $_data = array();
                foreach ($tradeLog as $_k => $v) {
                    $_data['tradelog'][$_k]['addtime'] = date('m-d H:i:s', $v['addtime']);
                    $_data['tradelog'][$_k]['type'] = $v['type'];
                    $_data['tradelog'][$_k]['price'] = $v['price'] * 1;
                    $_data['tradelog'][$_k]['num'] = round($v['num'], 6);
                    $_data['tradelog'][$_k]['mum'] = round($v['mum'], 2);
                }
                $marketLogs[$k] = $_data;
                S('getTradelog' . $k, $_data);
            }
        }

        $themarketLogs = array();
        if ($marketLogs) {
            $last24 = time() - 86400;
            $_date = date('m-d H:i:s', $last24);
            foreach (C('market') as $k => $v) {
                $tradeLog = isset($marketLogs[$k]['tradelog']) ? $marketLogs[$k]['tradelog'] : null;
                if ($tradeLog) {
                    $sum = 0;
                    foreach ($tradeLog as $_k => $_v) {
                        if ($_v['addtime'] < $_date) {
                            continue;
                        }
                        $sum += $_v['mum'];
                    }
                    $themarketLogs[$k] = $sum;
                }
            }
        }

		if (!$data) {
			foreach (C('market') as $k => $v) {
				$data[$k][0] = $v['title'];
				$data[$k][1] = round($v['new_price'], $v['round']);
				$data[$k][2] = round($v['buy_price'], $v['round']);
				$data[$k][3] = round($v['sell_price'], $v['round']);
				$data[$k][4] = isset($themarketLogs[$k]) ? $themarketLogs[$k] : 0;//round($v['volume'] * $v['new_price'], 2) * 1;
				$data[$k][5] = '';
				$data[$k][6] = round($v['volume'], 2) * 1;
				$data[$k][7] = round($v['change'], 2);
				$data[$k][8] = $v['name'];
				$data[$k][9] = $v['xnbimg'];
				$data[$k][10] = '';
			}

			S('allcoin', $data);
		}

		if ($ajax) {
			exit(json_encode($data));
		}
		else {
			return $data;
		}
	}

	
	//20170511 新增按类别查询     
	
	public function allcoin_a_暂时不用($id=1,$ajax = 'json')
	{
		//$data = (APP_DEBUG ? null : S('qq3479015851_allcoin'));
		
		
		$qq3479015851_data=array();
		
		$qq3479015851_data['info']="数据异常";
		$qq3479015851_data['status']=0;
		$qq3479015851_data['url']="";
		
        // 市场交易记录
        $marketLogs = array();
        foreach (C('market') as $k => $v) {

			$_tmp = null;
            if (!empty($_tmp)) {
                $marketLogs[$k] = $_tmp;
            } else {
                $tradeLog = M('TradeLog')->where(array('status' => 1, 'market' => $k))->order('id desc')->limit(50)->select();
                $_data = array();
                foreach ($tradeLog as $_k => $v) {
                    $_data['tradelog'][$_k]['addtime'] = date('m-d H:i:s', $v['addtime']);
                    $_data['tradelog'][$_k]['type'] = $v['type'];
                    $_data['tradelog'][$_k]['price'] = $v['price'] * 1;
                    $_data['tradelog'][$_k]['num'] = round($v['num'], 6);
                    $_data['tradelog'][$_k]['mum'] = round($v['mum'], 2);
                }
                $marketLogs[$k] = $_data;
                S('getTradelog' . $k, $_data);
            }
        }

        $themarketLogs = array();
        if ($marketLogs) {
            $last24 = time() - 86400;
            $_date = date('m-d H:i:s', $last24);
            foreach (C('market') as $k => $v) {
                $tradeLog = isset($marketLogs[$k]['tradelog']) ? $marketLogs[$k]['tradelog'] : null;
                if ($tradeLog) {
                    $sum = 0;
                    foreach ($tradeLog as $_k => $_v) {
                        if ($_v['addtime'] < $_date) {
                            continue;
                        }
                        $sum += $_v['mum'];
                    }
                    $themarketLogs[$k] = $sum;
                }
            }
        }

		if (!$data) {
			
			$qq3479015851_data['info']="数据正常";
			$qq3479015851_data['status']=1;
			$qq3479015851_data['url']="";
			
			
			foreach (C('market') as $k => $v) {
				
				if($id==1){
					if(stristr($k,'_cny')){
						$qq3479015851_data['url'][$k][0] = $v['title'];
						$qq3479015851_data['url'][$k][1] = round($v['new_price'], $v['round']);
						$qq3479015851_data['url'][$k][2] = round($v['buy_price'], $v['round']);
						$qq3479015851_data['url'][$k][3] = round($v['sell_price'], $v['round']);
						$qq3479015851_data['url'][$k][4] = isset($themarketLogs[$k]) ? $themarketLogs[$k] : 0;//round($v['volume'] * $v['new_price'], 2) * 1;
						$qq3479015851_data['url'][$k][5] = '';
						$qq3479015851_data['url'][$k][6] = round($v['volume'], 2) * 1;
						$qq3479015851_data['url'][$k][7] = round($v['change'], 2);
						$qq3479015851_data['url'][$k][8] = $v['name'];
						$qq3479015851_data['url'][$k][9] = $v['xnbimg'];
						$qq3479015851_data['url'][$k][10] = '';
					}
				}
				if($id==2){
					if(stristr($k,'_btc')){
						$qq3479015851_data['url'][$k][0] = $v['title'];
						$qq3479015851_data['url'][$k][1] = round($v['new_price'], $v['round']);
						$qq3479015851_data['url'][$k][2] = round($v['buy_price'], $v['round']);
						$qq3479015851_data['url'][$k][3] = round($v['sell_price'], $v['round']);
						$qq3479015851_data['url'][$k][4] = isset($themarketLogs[$k]) ? $themarketLogs[$k] : 0;//round($v['volume'] * $v['new_price'], 2) * 1;
						$qq3479015851_data['url'][$k][5] = '';
						$qq3479015851_data['url'][$k][6] = round($v['volume'], 2) * 1;
						$qq3479015851_data['url'][$k][7] = round($v['change'], 2);
						$qq3479015851_data['url'][$k][8] = $v['name'];
						$qq3479015851_data['url'][$k][9] = $v['xnbimg'];
						$qq3479015851_data['url'][$k][10] = '';
					}
				}
				
				
				
				if($id==3){
					if(stristr($k,'_eth')){
						$qq3479015851_data['url'][$k][0] = $v['title'];
						$qq3479015851_data['url'][$k][1] = round($v['new_price'], $v['round']);
						$qq3479015851_data['url'][$k][2] = round($v['buy_price'], $v['round']);
						$qq3479015851_data['url'][$k][3] = round($v['sell_price'], $v['round']);
						$qq3479015851_data['url'][$k][4] = isset($themarketLogs[$k]) ? $themarketLogs[$k] : 0;//round($v['volume'] * $v['new_price'], 2) * 1;
						$qq3479015851_data['url'][$k][5] = '';
						$qq3479015851_data['url'][$k][6] = round($v['volume'], 2) * 1;
						$qq3479015851_data['url'][$k][7] = round($v['change'], 2);
						$qq3479015851_data['url'][$k][8] = $v['name'];
						$qq3479015851_data['url'][$k][9] = $v['xnbimg'];
						$qq3479015851_data['url'][$k][10] = '';
					}
				}
				
				
				
				
				
				
				
			}

			//S('allcoin', $data);
		}
		
		if ($ajax) {
			echo json_encode($qq3479015851_data);
			unset($qq3479015851_data);
			exit();
		}
		else {
			return $qq3479015851_data;
		}
	}
	
	
	
	
	//新增自定义分区查询 2017-06-05
	
	public function allcoin_a($id=1,$ajax = 'json')
	{
		//$data = (APP_DEBUG ? null : S('qq3479015851_allcoin'));
		
		
		$qq3479015851_data=array();
		
		$qq3479015851_data['info']="数据异常";
		$qq3479015851_data['status']=0;
		$qq3479015851_data['url']="";
		
        // 市场交易记录
        $marketLogs = array();
        foreach (C('market') as $k => $v) {

			$_tmp = null;
            if (!empty($_tmp)) {
                $marketLogs[$k] = $_tmp;
            } else {
                $tradeLog = M('TradeLog')->where(array('status' => 1, 'market' => $k))->order('id desc')->limit(50)->select();
                $_data = array();
                foreach ($tradeLog as $_k => $v) {
                    $_data['tradelog'][$_k]['addtime'] = date('m-d H:i:s', $v['addtime']);
                    $_data['tradelog'][$_k]['type'] = $v['type'];
                    $_data['tradelog'][$_k]['price'] = $v['price'] * 1;
                    $_data['tradelog'][$_k]['num'] = round($v['num'], 6);
                    $_data['tradelog'][$_k]['mum'] = round($v['mum'], 2);
                }
                $marketLogs[$k] = $_data;
                S('getTradelog' . $k, $_data);
            }
        }

        $themarketLogs = array();
        if ($marketLogs) {
            $last24 = time() - 86400;
            $_date = date('m-d H:i:s', $last24);
            foreach (C('market') as $k => $v) {
                $tradeLog = isset($marketLogs[$k]['tradelog']) ? $marketLogs[$k]['tradelog'] : null;
                if ($tradeLog) {
                    $sum = 0;
                    foreach ($tradeLog as $_k => $_v) {
                        if ($_v['addtime'] < $_date) {
                            continue;
                        }
                        $sum += $_v['mum'];
                    }
                    $themarketLogs[$k] = $sum;
                }
            }
        }

		if (!$data) {
			
			$qq3479015851_data['info']="数据正常";
			$qq3479015851_data['status']=1;
			$qq3479015851_data['url']="";
			
			
			foreach (C('market') as $k => $v) {
				
				if($v['jiaoyiqu']==$id){
						$qq3479015851_data['url'][$k][0] = $v['title'];
						$qq3479015851_data['url'][$k][1] = round($v['new_price'], $v['round']);
						$qq3479015851_data['url'][$k][2] = round($v['buy_price'], $v['round']);
						$qq3479015851_data['url'][$k][3] = round($v['sell_price'], $v['round']);
						$qq3479015851_data['url'][$k][4] = isset($themarketLogs[$k]) ? $themarketLogs[$k] : 0;//round($v['volume'] * $v['new_price'], 2) * 1;
						$qq3479015851_data['url'][$k][5] = '';
						$qq3479015851_data['url'][$k][6] = round($v['volume'], 2) * 1;
						$qq3479015851_data['url'][$k][7] = round($v['change'], 2);
						$qq3479015851_data['url'][$k][8] = $v['name'];
						$qq3479015851_data['url'][$k][9] = $v['xnbimg'];
						$qq3479015851_data['url'][$k][10] = '';
				}

			}

			//S('allcoin', $data);
		}
		
		if ($ajax) {
			echo json_encode($qq3479015851_data);
			unset($qq3479015851_data);
			exit();
		}
		else {
			return $qq3479015851_data;
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function index_b_trends($ajax = 'json')
	{
		$data = (APP_DEBUG ? null : S('trends'));

		if (!$data) {
			foreach (C('market') as $k => $v) {
				$tendency = json_decode($v['tendency'], true);
				$data[$k]['data'] = $tendency;
				$data[$k]['yprice'] = $v['new_price'];
			}

			S('trends', $data);
		}

		if ($ajax) {
			exit(json_encode($data));
		}
		else {
			return $data;
		}
	}
	
	
	
	
	
	
	public function trends($ajax = 'json')
	{
		$data = (APP_DEBUG ? null : S('trends'));

		if (!$data) {
			foreach (C('market') as $k => $v) {
				$tendency = json_decode($v['tendency'], true);
				$data[$k]['data'] = $tendency;
				$data[$k]['yprice'] = $v['new_price'];
			}

			S('trends', $data);
		}

		if ($ajax) {
			exit(json_encode($data));
		}
		else {
			return $data;
		}
	}

	public function getJsonTop($market = NULL, $ajax = 'json')
	{
		$data = (APP_DEBUG ? null : S('getJsonTop' . $market));

		if (!$data) {
			if ($market) {
				$xnb = explode('_', $market)[0];
				$rmb = explode('_', $market)[1];

				foreach (C('market') as $k => $v) {
					$v['xnb'] = explode('_', $v['name'])[0];
					$v['rmb'] = explode('_', $v['name'])[1];
					$data['list'][$k]['name'] = $v['name'];
					$data['list'][$k]['img'] = $v['xnbimg'];
					$data['list'][$k]['title'] = $v['title'];
					$data['list'][$k]['new_price'] = $v['new_price'];
				}

				$data['info']['img'] = C('market')[$market]['xnbimg'];
				$data['info']['title'] = C('market')[$market]['title'];
				$data['info']['new_price'] = C('market')[$market]['new_price'];
				
				if(C('market')[$market]['max_price']){
					$data['info']['max_price'] = C('market')[$market]['max_price'];
				}else{
					$qq3479015851_tempprice = round((C('market')[$market]['qq3479015851_faxingjia'] / 100) * (100 + C('market')[$market]['zhang']), C('market')[$market]['round']);
					$data['info']['max_price'] = $qq3479015851_tempprice;
				}
				
				if(C('market')[$market]['min_price']){
					$data['info']['min_price'] = C('market')[$market]['min_price'];
				}else{
					$qq3479015851_tempprice = round((C('market')[$market]['qq3479015851_faxingjia'] / 100) * (100 - C('market')[$market]['die']), C('market')[$market]['round']);
					$data['info']['min_price'] = $qq3479015851_tempprice;
				}
				
				
				$data['info']['buy_price'] = C('market')[$market]['buy_price'];
				$data['info']['sell_price'] = C('market')[$market]['sell_price'];
				$data['info']['volume'] = C('market')[$market]['volume'];
				$data['info']['change'] = C('market')[$market]['change'];
				S('getJsonTop' . $market, $data);
			}
		}

		if ($ajax) {
			exit(json_encode($data));
		}
		else {
			return $data;
		}
	}

	public function getTradelog($market = NULL, $ajax = 'json')
	{
		$data = (APP_DEBUG ? null : S('getTradelog' . $market));
		if (!$data) {
			$tradeLog = M('TradeLog')->where(array('status' => 1,'market' => $market))->order('id desc')->limit(50)->select();

			if ($tradeLog) {
				foreach ($tradeLog as $k => $v) {
					$data['tradelog'][$k]['addtime'] = date('m-d H:i:s', $v['addtime']);
					$data['tradelog'][$k]['type'] = $v['type'];
					$data['tradelog'][$k]['price'] = $v['price'] * 1;
					$data['tradelog'][$k]['num'] = round($v['num'], 6);
					$data['tradelog'][$k]['mum'] = round($v['mum'], 2);
				}

				S('getTradelog' . $market, $data);
			}
		}

		if ($ajax) {
			exit(json_encode($data));
		}
		else {
			return $data;
		}
	}
	
	
	public function getAwardInfo($ajax = 'json')
	{
		$data = (APP_DEBUG ? null : S('getAwardInfo'));
		if (!$data) {
			$awardInfo = M('UserAward')->order('id desc')->limit(50)->select();

			if ($awardInfo) {
				foreach ($awardInfo as $k => $v) {
					$data['awardInfo'][$k]['addtime'] = date('m-d H:i:s', $v['addtime']);
					$name_tmp = M('User')->where(array('id' => $v['userid']))->getField('username');
					$data['awardInfo'][$k]['username'] = substr_replace($name_tmp, '****', 2, strlen($name_tmp)-4);
					$data['awardInfo'][$k]['awardname'] = $v['awardname'];
				}

				S('getAwardInfo', $data,300);
			}
		}

		if ($ajax) {
			exit(json_encode($data));
		}
		else {
			return $data;
		}
	}
	
	
	

	public function getDepth($market = NULL, $trade_moshi = 1, $ajax = 'json')
	{
		if (!C('market')[$market]) {
			return null;
		}

		$qq3479015851_getCoreConfig = qq3479015851_getCoreConfig();
		if(!$qq3479015851_getCoreConfig){
			$this->error('核心配置有误');
		}else{
			$qq3479015851_putong = $qq3479015851_getCoreConfig['qq3479015851_userTradeNum'];
			$qq3479015851_teshu = $qq3479015851_getCoreConfig['qq3479015851_specialUserTradeNum'];
		}
		
		
		$data_getDepth = (APP_DEBUG ? null : S('getDepth'));

		if (!$data_getDepth[$market][$trade_moshi]) {
			if ($trade_moshi == 1) {
				$limt = 15;
			}else{
				$limt = 20;
			}

/* 			if (($trade_moshi == 3) || ($trade_moshi == 4)) {
				//20170608增加按用户级别调用信息条数
				if(userid()){
					$usertype = M('User')->where(array($id => $userid))->getField('usertype');
					if($usertype ==1){
						$limt = $qq3479015851_teshu;
					}else{
						$limt = $qq3479015851_putong;
					}
				}else{
					$limt = $qq3479015851_putong;
				}
			} */

			$trade_moshi = intval($trade_moshi);
			
			
			$mo = M();
			if ($trade_moshi == 1) {
				$buy = $mo->query('select id,price,sum(num-deal)as nums from qq3479015851_trade where status=0 and type=1 and market =\'' . $market . '\' group by price order by price desc limit ' . $limt . ';');
				$sell = array_reverse($mo->query('select id,price,sum(num-deal)as nums from qq3479015851_trade where status=0 and type=2 and market =\'' . $market . '\' group by price order by price asc limit ' . $limt . ';'));
			}

			if ($trade_moshi == 3) {
				$buy = $mo->query('select id,price,sum(num-deal)as nums from qq3479015851_trade where status=0 and type=1 and market =\'' . $market . '\' group by price order by price desc limit ' . $limt . ';');
				$sell = null;
			}

			if ($trade_moshi == 4) {
				$buy = null;
				$sell = array_reverse($mo->query('select id,price,sum(num-deal)as nums from qq3479015851_trade where status=0 and type=2 and market =\'' . $market . '\' group by price order by price asc limit ' . $limt . ';'));
			}

			if ($buy) {
				foreach ($buy as $k => $v) {
					$data['depth']['buy'][$k] = array(floatval($v['price'] * 1), floatval($v['nums'] * 1));
				}
			}
			else {
				$data['depth']['buy'] = '';
			}

			if ($sell) {
				foreach ($sell as $k => $v) {
					$data['depth']['sell'][$k] = array(floatval($v['price'] * 1), floatval($v['nums'] * 1));
				}
			}
			else {
				$data['depth']['sell'] = '';
			}

			$data_getDepth[$market][$trade_moshi] = $data;
			S('getDepth', $data_getDepth);
		}
		else {
			$data = $data_getDepth[$market][$trade_moshi];
		}

		if ($ajax) {
			exit(json_encode($data));
		}
		else {
			return $data;
		}
	}

	public function getEntrustAndUsercoin($market = NULL, $ajax = 'json')
	{
		if (!userid()) {
			return null;
		}

		if (!C('market')[$market]) {
			return null;
		}

		$result = M()->query('select id,price,num,deal,mum,type,fee,status,addtime from qq3479015851_trade where status=0 and market=\'' . $market . '\' and userid=' . userid() . ' order by id desc limit 10;');

		if ($result) {
			foreach ($result as $k => $v) {
				$data['entrust'][$k]['addtime'] = date('m-d H:i:s', $v['addtime']);
				$data['entrust'][$k]['type'] = $v['type'];
				$data['entrust'][$k]['price'] = $v['price'] * 1;
				$data['entrust'][$k]['num'] = round($v['num'], 6);
				$data['entrust'][$k]['deal'] = round($v['deal'], 6);
				$data['entrust'][$k]['id'] = round($v['id']);
			}
		}
		else {
			$data['entrust'] = null;
		}

		$userCoin = M('UserCoin')->where(array('userid' => userid()))->find();

		if ($userCoin) {
			$xnb = explode('_', $market)[0];
			$rmb = explode('_', $market)[1];
			$data['usercoin']['xnb'] = floatval($userCoin[$xnb]);
			$data['usercoin']['xnbd'] = floatval($userCoin[$xnb . 'd']);
			$data['usercoin']['cny'] = floatval($userCoin[$rmb]);
			$data['usercoin']['cnyd'] = floatval($userCoin[$rmb . 'd']);
		}
		else {
			$data['usercoin'] = null;
		}

		if ($ajax) {
			exit(json_encode($data));
		}
		else {
			return $data;
		}
	}

	public function getChat($ajax = 'json')
	{
		$chat = (APP_DEBUG ? null : S('getChat'));

		if (!$chat) {
			$chat = M('Chat')->where(array('status' => 1))->order('id desc')->limit(500)->select();
			S('getChat', $chat);
		}

		asort($chat);

		if ($chat) {
			foreach ($chat as $k => $v) {
				$data[] = array((int) $v['id'], $v['username'], $v['content']);
			}
		}
		else {
			$data = '';
		}

		if ($ajax) {
			exit(json_encode($data));
		}
		else {
			return $data;
		}
	}

	public function upChat($content)
	{
		if (!userid()) {
			$this->error('请先登录...');
		}

		$content = msubstr($content, 0, 20, 'utf-8', false);

		if (!$content) {
			$this->error('请先输入内容');
		}

		if (APP_DEMO) {
				$this->error('测试站暂时不能聊天！');
			}

		if (time() < (session('chat' . userid()) + 10)) {
			$this->error('不能发送过快');
		}

		$id = M('Chat')->add(array('userid' => userid(), 'username' => username(), 'content' => $content, 'addtime' => time(), 'status' => 1));

		if ($id) {
			S('getChat', null);
			session('chat' . userid(), time());
			$this->success($id);
		}
		else {
			$this->error('发送失败');
		}
	}

	public function upcomment($msgaaa, $s1, $s2, $s3, $xnb)
	{
		if (empty($msgaaa)) {
			$this->error('提交内容错误');
		}

		if (!check($s1, 'd')) {
			$this->error('技术评分错误');
		}

		if (!check($s2, 'd')) {
			$this->error('应用评分错误');
		}

		if (!check($s3, 'd')) {
			$this->error('前景评分错误');
		}

		if (!userid()) {
			$this->error('请先登录！');
		}

		if (M('CoinComment')->where(array(
			'userid'   => userid(),
			'coinname' => $xnb,
			'addtime'  => array('gt', time() - 60)
			))->find()) {
			$this->error('请不要频繁提交！');
		}

		if (M('Coin')->where(array('name' => $xnb))->save(array(
			'tp_zs' => array('exp', 'tp_zs+1'),
			'tp_js' => array('exp', 'tp_js+' . $s1),
			'tp_yy' => array('exp', 'tp_yy+' . $s2),
			'tp_qj' => array('exp', 'tp_qj+' . $s3)
			))) {
			if (M('CoinComment')->add(array('userid' => userid(), 'coinname' => $xnb, 'content' => $msgaaa, 'addtime' => time(), 'status' => 1))) {
				$this->success('提交成功');
			}
			else {
				$this->error('提交失败！');
			}
		}
		else {
			$this->error('提交失败！');
		}
	}

	public function subcomment($id, $type)
	{
		if ($type != 1) {
			if ($type != 2) {
				if ($type != 3) {
					$this->error('参数错误！');
				}
				else {
					$type = 'xcd';
				}
			}
			else {
				$type = 'tzy';
			}
		}
		else {
			$type = 'cjz';
		}

		if (!check($id, 'd')) {
			$this->error('参数错误1');
		}

		if (!userid()) {
			$this->error('请先登录！');
		}

		if (S('subcomment' . userid() . $id)) {
			$this->error('请不要频繁提交！');
		}

		if (M('CoinComment')->where(array('id' => $id))->setInc($type, 1)) {
			S('subcomment' . userid() . $id, 1);
			$this->success('提交成功');
		}
		else {
			$this->error('提交失败！');
		}
	}
}

?>