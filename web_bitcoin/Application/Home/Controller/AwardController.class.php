<?php
namespace Home\Controller;

class AwardController extends HomeController
{
	public function index($id = NULL)
	{
		
		die();
		
		$userid=userid();
		if($userid){
			$todayTimeB=strtotime(date('Y-m-d',time())." 00:00:00");
			$todayTimeE=strtotime(date('Y-m-d',time())." 23:59:59");
			$where = "id={$userid} and (awardtime>={$todayTimeB} and awardtime<={$todayTimeE})";
			$awardCountToday=M('User')->where($where)->count();
			 if($awardCountToday==0){
				$where = "(userid={$userid} or peerid={$userid}) and status=1 and (addtime>={$todayTimeB} and addtime<={$todayTimeE})";
				$awardNum=floor((floor(M('TradeLog')->where($where)->sum('mum')))/300);
				$awardNum=$awardNum>6?6:$awardNum;
				$uinfo['id']=$userid;
				$uinfo['awardTotalToday']=$awardNum;
				$uinfo['awardNumToday']=0;
				M('User')->save($uinfo); 
			} 
			
 			$curuinfo=M('User')->where(array('id'=>$userid))->find();
			$uinfo['awardNumToday']=$curuinfo['awardnumtoday'];
			$uinfo['awardTotalToday']=$curuinfo['awardtotaltoday']; 
		}else{
			$uinfo['awardNumToday']=0;
			$uinfo['awardTotalToday']=0;
		}

		$this->assign('uinfo',$uinfo);
		$this->display();
	}
	
	
	public function award(){
		
		die();
		if (!userid()) {
			$prize_id=10;
			$prize_site=$prize_id-1;
			$data['prize_name'] = "";
			$data['prize_site'] = "";
			$data['prize_id'] = "";
			$data['loginState']=0;
		}else{
			
			$awardTimeE=strtotime("2017-12-28 23:59:59");//活动结束时间
			
			if(time()>$awardTimeE){
				$data['loginState']=4;
				echo json_encode($data);
				die();
			}
			
			$userid = userid();
			$data['loginState']=3;
			$data['awardStatus']=0;
			$curuinfo=M('User')->where(array('id'=>$userid))->find();
			$prize_id=$curuinfo['awardid'];
			$prize_status=$curuinfo['awardstatus'];
			$awardNumToday=$curuinfo['awardnumtoday'];
			$awardNumAll=$curuinfo['awardnumall'];

			$todayTimeB=strtotime(date('Y-m-d',time())." 00:00:00");
			$todayTimeE=strtotime(date('Y-m-d',time())." 23:59:59");
			$where = "(userid={$userid} or peerid={$userid}) and status=1 and (addtime>={$todayTimeB} and addtime<={$todayTimeE})";
			$awardNum=floor((floor(M('TradeLog')->where($where)->sum('mum')))/300);
			$awardNum=$awardNum>6?6:$awardNum;
			
			$uinfo['id']=$userid;
			$uinfo['awardTotalToday']=$awardNum;
			M('User')->save($uinfo);
			
			if($awardNum==0){
				$data['awardStatus']=1;
			}else{
				if($awardNumToday>=$awardNum){
					$data['awardStatus']=2;
				}else{
					$data['awardStatus']=3;
				}
			}
			
			
			if($data['awardStatus']==3){
				
				if($prize_id>0 && $prize_status==0){

					//把中奖记录写入数据库
					$awardInfo['userid']=$userid;
					
					switch($prize_id){
						case 0:
							$awardname="无奖品";
							break;
						case 1:
							$awardname="苹果电脑";
							break;
						case 2:
							$awardname="华为手机";
							break;
						case 3:
							$awardname="1000元现金";
							break;
						case 4:
							$awardname="小米手环";
							break;
						case 5:
							$awardname="100元现金";
							break;
						case 6:
							$awardname="10元现金";
							break;
						case 7:
							$awardname="1元现金";
							break;
						case 8:
							$awardname="无奖品";
							break;
						case 9:
							$awardname="1元现金";
							break;
						case 10:
							$awardname="无奖品";
							break;
						default:
							$awardname="无奖品";
					}
					
					$awardInfo['awardname']=$awardname;
					$awardInfo['status']=0;
					$awardInfo['addtime']=time();
					$awardInfo['awardid']=$prize_id;
					
					$uinfo['id']=$userid;
					$uinfo['awardstatus']=1;
					$uinfo['awardname']=$awardname;
					$uinfo['awardNumAll']=$awardNumAll+1;
					$uinfo['awardNumToday']=$awardNumToday+1;
					$uinfo['awardtime']=time();
					
					$mo = M();
					$mo->execute('set autocommit=0');
					$mo->execute('lock tables qq3479015851_user_award write,qq3479015851_user write');
					$rs[] = $mo->table('qq3479015851_user_award')->add($awardInfo);
					$rs[] = $mo->table('qq3479015851_user')->save($uinfo);
					$flag = true;
					if ($rs) {
						if ($flag) {
							$mo->execute('commit');
							$mo->execute('unlock tables');
							
							$data['prize_name'] = "恭喜你中了[".$awardname."]奖";
							$data['prize_site'] = $prize_id-1;
							$data['prize_id'] = $prize_id;
							
						}

					}
					else {
						if ($flag) {
							$mo->execute('rollback');
						}
						
						$prize_id=(mt_rand(5, 15)%2==0)?8:10;
						$data['prize_name'] = "";
						$data['prize_site'] = $prize_id-1;
						$data['prize_id'] = $prize_id;
					} 
					
					
					
				}else{
					
					$prize_id=(mt_rand(5, 15)%2==0)?8:10;
					$data['prize_name'] = "";
					$data['prize_site'] = $prize_id-1;
					$data['prize_id'] = $prize_id;
					
					
					$uinfo['id']=$userid;
					$uinfo['awardNumAll']=$awardNumAll+1;
					$uinfo['awardNumToday']=$awardNumToday+1;
					$uinfo['awardtime']=time();
					$mo = M();
					$mo->execute('set autocommit=0');
					$mo->execute('lock tables qq3479015851_user write');
					$rs = $mo->table('qq3479015851_user')->save($uinfo);
					$flag = true;
					if ($rs) {
						if ($flag) {
							$mo->execute('commit');
							$mo->execute('unlock tables');
						}

					}
					else {
						if ($flag) {
							$mo->execute('rollback');
						}
						
						$prize_id=(mt_rand(5, 15)%2==0)?8:10;
						$data['prize_name'] = "";
						$data['prize_site'] = $prize_id-1;
						$data['prize_id'] = $prize_id;
					} 
					
					
				}
					
			}
			
		} 
		echo json_encode($data);
		
	}


    
}

?>