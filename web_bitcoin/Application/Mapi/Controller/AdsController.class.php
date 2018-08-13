<?php
    /**
     * 广告应用
     */
namespace Mapi\Controller;

class AdsController extends CommonController {
    public function __construct(){
        parent::__construct();
    }

    //初始化等级
    public function init_ads(){
        //判断用户等级
        $uid = $this->userid();

        $coin = D('coin')->select();
        $coinMap = array();
        foreach($coin as $val){
            $coinMap[$val['id']] = $val['name'];
        }

        $VipUser = D('AppVipuser')->where(array('uid' =>$uid))->find();
        $save_id = 0;
        if(!$VipUser){
            //vip0
            $save_id = D('AppVipuser')->add(array('uid' => $uid,'vip_id' => 0,'addtime' => time()));
            D('AppLog')->add(
                array(
                    'uid'   => $uid,
                    'type'  => 'vip',
                    'content' => '初始化等级vip0',
                    'addtime' => time()
                )
            );
            $User = D('User')->where(array('id' =>$uid))->find();
            if($User['moble'] && $User['truename'] && $User['idcard']){
                //完善资料了
                if($AppVip = D('AppVip')->order('tag asc')->find()){
                    $rule = $AppVip['rule'];
                }
            }
        }else{
            $save_id = $VipUser['id'];
            $last_tag = 0;
            if($VipUser['vip_id']){
                $VipData = D('AppVip')->where(array('id' => $VipUser['vip_id']))->find();
                $last_tag = $VipData['tag'];
            }
            //判断是否可以进入下一个等级
            $AppVip = D('AppVip')->where('`tag` > '.$last_tag)->order('tag asc')->find();
            if(!$AppVip){
                //无可升级
                return;
            }
            $rule = $AppVip['rule'];
        }

        //最低级vip
        $rule = json_decode($rule,true);
        $up_do = 0;
        if($rule){
            $UserCoin = D('UserCoin')->where(array('userid' => $uid))->find();
            $flag = 1;
            foreach($rule as $val){
                $coin_name = $coinMap[$val['id']];
                if($UserCoin[$coin_name] < $val['num']){
                    $flag = 0;
                    break;
                }
            }
            if($flag){
                //升级vip1
                $up_do = 1;
            }
        }else{
            $up_do = 1;
        }

        if($up_do){
            D('AppVipuser')->save(array('id' =>$save_id,'vip_id' => $AppVip['id']));
            D('AppLog')->add(
                array(
                    'uid'   => $uid,
                    'type'  => 'vip',
                    'content' => '升级到'.$AppVip['name'],
                    'addtime' => time()
                )
            );
        }
    }


    //看广告模块
    public function showBlock(){
        $blocks = D('Appadsblock')->where(array('status' => 1))->order('sort desc')->select();
        $this->ajaxShow($blocks);
    }

    //查看广告
    public function show($bid){
        $uid = $this->userid();
        $this->init_ads();
        $blockData = D('Appadsblock')->where(array('id' => $bid))->find();
        $Appads = D('Appads')->where(array('block_id' => $bid,'status' => 1))->select();
        foreach($Appads as $key=>$val){
            //生成广告哈希
            $hash = md5($uid.'_'.time() . mt_rand(1,1000000));
            session('app_ads_hash_'.$val['id'],$hash);
            $val['hash'] = $hash;
            $val['remain'] = $blockData['remain'];
            $Appads[$key] = $val;
        }
        $this->ajaxShow($Appads);
    }

    public function click($hash,$aid){
        $uid = $this->userid();
        $ads_session_id = 'app_ads_hash_'.$aid;
        if(!session($ads_session_id)){
            $this->error('广告信息丢失');
        }
        if(session($ads_session_id) != $hash){
            $this->error('广告签名错误');
        }
        $Vipuser = D('AppVipuser')->where(array('uid' =>$uid))->find();
        $Vip     = D('AppVip')->where(array('id' => $Vipuser['vip_id']))->find();
        $Appads  = D('Appads')->where(array('id' => $aid))->find();
        $Appadsblock = D('Appadsblock')->where(array('id' => $Appads['block_id']))->find();
        if($Appadsblock['rank'] > $Vip['tag']){
            $this->error('您的等级('.$Appadsblock['rank'].')不够('.$Vip['tag'].'),不可以查看本广告');
        }
        $price_coin = D('Coin')->where(array('id' =>$Vip['price_coin']))->find();
        //点击成功
        $mo = M();
        $rs = array();
        $mo->execute('set autocommit=0');
        $mo->execute('lock tables qq3479015851_app_log write ,qq3479015851_user_coin write');

        $rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $uid))->setDec($price_coin['name'], $Vip['price_num']);
        $rs[] = $mo->table('qq3479015851_app_log')->add(
            array(
                'uid'     => $uid,
                'type'    => 'click_ads',
                'content' => '查看广告[id:'.$aid.']盈利:'.$price_coin['name'].' '.$Vip['price_num'],
                'addtime' => time()
            )
        );
        if(check_arr($rs)) {
            $mo->execute('commit');
            $mo->execute('unlock tables');
            //删除hash
            session($ads_session_id,null);
            $this->success('成功！');
        } else {
            $mo->execute('rollback');
            $mo->execute('unlock tables');
            $this->error('失败！');
        }
    }
}