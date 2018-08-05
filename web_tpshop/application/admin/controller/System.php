<?php
/**
 * tpshop
 * ============================================================================
 * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 采用TP5助手函数可实现单字母函数M D U等,也可db::name方式,可双向兼容
 * ============================================================================
 * Author: 当燃      
 * Date: 2015-10-09
 */

namespace app\admin\controller;
use app\admin\logic\GoodsLogic;
use think\db;
use think\Cache;
class System extends Base
{
	/*
	 * 配置入口
	 */
	public function index()
	{
		/*配置列表*/
		$group_list = [
            'shop_info' => '网站信息',
            'basic'     => '基本设置',
            'sms'       => '短信设置',
            'shopping'  => '购物流程设置',
            'smtp'      => '邮件设置',
            'water'     => '水印设置',
            'distribut' => '分销设置',
            'push'      => '推送设置',
            'oss'       => '对象存储'
        ];		
		$this->assign('group_list',$group_list);
		$inc_type =  I('get.inc_type','shop_info');
		$this->assign('inc_type',$inc_type);
		$config = tpCache($inc_type);
		if($inc_type == 'shop_info'){
			$province = M('region')->where(array('parent_id'=>0))->select();
			$city =  M('region')->where(array('parent_id'=>$config['province']))->select();
			$area =  M('region')->where(array('parent_id'=>$config['city']))->select();
			$this->assign('province',$province);
			$this->assign('city',$city);
			$this->assign('area',$area);
		}
		$this->assign('config',$config);//当前配置项
                //C('TOKEN_ON',false);
		return $this->fetch($inc_type);
	}
	
	/*
	 * 新增修改配置
	 */
	public function handle()
	{
		$param = I('post.');
		$inc_type = $param['inc_type'];
		//unset($param['__hash__']);
		unset($param['inc_type']);
		tpCache($inc_type,$param);
		$this->success("操作成功",U('System/index',array('inc_type'=>$inc_type)));
	}        
        
       /**
        * 自定义导航
        */
    public function navigationList(){
           $model = M("Navigation");
           $navigationList = $model->order("id desc")->select();            
           $this->assign('navigationList',$navigationList);
           return $this->fetch('navigationList');
     }

    /**
     * 添加修改编辑 前台导航
     */
    public function addEditNav()
    {
        $model = D("Navigation");
        if (IS_POST) {
            if (I('id')){
                $model->update(I('post.'));
            }else{
                $model->add(I('post.'));
            }
            $this->success("操作成功!!!", U('Admin/System/navigationList'));
            exit;
        }
        // 点击过来编辑时
        $id = I('id',0);
        $navigation = DB::name('navigation')->where('id',$id)->find();
        // 系统菜单
        $GoodsLogic = new GoodsLogic();
        $cat_list = $GoodsLogic->goods_cat_list();
        $select_option = array();
        if(!empty($cat_list))
        {        
            foreach ($cat_list AS $key => $value) {
                $strpad_count = $value['level'] * 4;
                $select_val = U("/Home/Goods/goodsList", array('id' => $key));
                $select_option[$select_val] = str_pad('', $strpad_count, "-", STR_PAD_LEFT) . $value['name'];
            }
        }    
        $system_nav = array(
            'http://www.tp-shop.cn' => 'tpshop官网',
            'http://www.99soubao.com' => '搜豹公司',
            '/index.php?m=Home&c=Activity&a=promoteList' => '促销',
            '/index.php?m=Home&c=Activity&a=flash_sale_list' => '抢购',
            '/index.php?m=Home&c=Activity&a=group_list' => '团购',
            '/index.php?m=Home&c=Goods&a=integralMall' => '积分商城',
        );
        $system_nav = array_merge($system_nav, $select_option);
        $this->assign('system_nav', $system_nav);

        $this->assign('navigation', $navigation);
        return $this->fetch('_navigation');
    }   
    
    /**
     * 删除前台 自定义 导航
     */
    public function delNav()
    {     
        // 删除导航
        M('Navigation')->where("id",I('id'))->delete();
        $this->success("操作成功!!!",U('Admin/System/navigationList'));
    }
	
	public function refreshMenu(){
		$pmenu = $arr = array();
		$rs = M('system_module')->where('level>1 AND visible=1')->order('mod_id ASC')->select();
		foreach($rs as $row){
			if($row['level'] == 2){
				$pmenu[$row['mod_id']] = $row['title'];//父菜单
			}
		}

		foreach ($rs as $val){
			if($row['level']==2){
				$arr[$val['mod_id']] = $val['title'];
			}
			if($row['level']==3){
				$arr[$val['mod_id']] = $pmenu[$val['parent_id']].'/'.$val['title'];
			}
		}
		return $arr;
	}

        
        /**
         * 清空系统缓存
         */
        public function cleanCache(){          
			delFile(RUNTIME_PATH);
			Cache::clear();
            $script = "<script>parent.layer.msg('缓存清除成功', {time:3000,icon: 1});window.location='/index.php?m=Admin&c=Index&a=welcome';</script>";
            echo $script;
            exit;
        }
	    
    /**
     * 清空静态商品页面缓存
     */
      public function ClearGoodsHtml(){
            $goods_id = I('goods_id');            
            if(unlink("./Application/Runtime/Html/Home_Goods_goodsInfo_{$goods_id}.html"))
            {
                // 删除静态文件                
                $html_arr = glob("./Application/Runtime/Html/Home_Goods*.html");
                foreach ($html_arr as $key => $val)
                {            
                    strstr($val,"Home_Goods_ajax_consult_{$goods_id}") && unlink($val); // 商品咨询缓存
                    strstr($val,"Home_Goods_ajaxComment_{$goods_id}") && unlink($val); // 商品评论缓存
                }
                $json_arr = array('status'=>1,'msg'=>'清除成功','result'=>'');
            }
            else 
            {
                $json_arr = array('status'=>-1,'msg'=>'未能清除缓存','result'=>'' );
            }                                                    
            $json_str = json_encode($json_arr);            
            exit($json_str);            
      } 
    /**
     * 商品静态页面缓存清理
     */
      public function ClearGoodsThumb(){
            $goods_id = I('goods_id');
            delFile(UPLOAD_PATH."goods/thumb/".$goods_id); // 删除缩略图
            $json_arr = array('status'=>1,'msg'=>'清除成功,请清除对应的静态页面','result'=>'');
            $json_str = json_encode($json_arr);            
            exit($json_str);            
      } 
    /**
     * 清空 文章静态页面缓存
     */
      public function ClearAritcleHtml(){
            $article_id = I('article_id');            
            unlink("./Application/Runtime/Html/Index_Article_detail_{$article_id}.html"); // 清除文章静态缓存
            unlink("./Application/Runtime/Html/Doc_Index_article_{$article_id}_api.html"); // 清除文章静态缓存
            unlink("./Application/Runtime/Html/Doc_Index_article_{$article_id}_phper.html"); // 清除文章静态缓存
            unlink("./Application/Runtime/Html/Doc_Index_article_{$article_id}_android.html"); // 清除文章静态缓存
            unlink("./Application/Runtime/Html/Doc_Index_article_{$article_id}_ios.html"); // 清除文章静态缓存
            $json_arr = array('status'=>1,'msg'=>'操作完成','result'=>'' );                                                          
            $json_str = json_encode($json_arr);            
            exit($json_str);            
      }
      
	//发送测试邮件
	public function send_email(){
		$param = I('post.');
//		tpCache($param['inc_type'],$param); //注释掉，不注释会出现重复写入数据库
        	$res = send_email($param['test_eamil'],'后台测试','测试发送验证码:'.mt_rand(1000,9999));
        	exit(json_encode($res));
      }
	        
    /**
     *  管理员登录后 处理相关操作
     */        
     public function login_task()
     {
         
        /*** 随机清空购物车的垃圾数据*/                     
        $time = time() - 3600; // 删除购物车数据  1小时以前的
        M("Cart")->where("user_id = 0 and  add_time < $time")->delete();            
        $today_time = time();
		
		// 删除 cart表垃圾数据 删除一个月以前的 
		$time = time() - 2592000; 
        M("cart")->where("add_time < $time")->delete();		
		// 删除 tp_sms_log表垃圾数据 删除一个月以前的短信
        M("sms_log")->where("add_time < $time")->delete();				
        
        // 发货后满多少天自动收货确认
        $auto_confirm_date = tpCache('shopping.auto_confirm_date');
        $auto_confirm_date = $auto_confirm_date * (60 * 60 * 24); // 7天的时间戳
		$time = time() - $auto_confirm_date; // 比如7天以前的可用自动确认收货
        $order_id_arr = M('order')->where("order_status = 1 and shipping_status = 1 and shipping_time < $time")->getField('order_id',true);       
        foreach($order_id_arr as $k => $v)
        {
            confirm_order($v);
        }      
        
        // 多少天后自动分销记录自动分成
         $switch = tpCache('distribut.switch');         
         if($switch == 1 && file_exists(APP_PATH.'common/logic/DistributLogic.php')){
            $distributLogic = new \app\common\logic\DistributLogic();
            $distributLogic->auto_confirm(); // 自动确认分成
         }         
     }
     
     function ajax_get_action()
     {
     	$control = I('controller');
     	$advContrl = get_class_methods("app\\admin\\controller\\".str_replace('.php','',$control));
     	$baseContrl = get_class_methods('app\admin\controller\Base');
     	$diffArray  = array_diff($advContrl,$baseContrl);
     	$html = '';
     	foreach ($diffArray as $val){
     		$html .= "<option value='".$val."'>".$val."</option>";
     	}
     	exit($html);
     }
     
     function right_list(){
     	$group = array('system'=>'系统设置','content'=>'内容管理','goods'=>'商品中心','member'=>'会员中心','finance'=>'财务管理',
     			'order'=>'订单中心','marketing'=>'营销推广','tools'=>'插件工具','count'=>'统计报表','distribut'=>'分销中心'
     	);
     	
     	$name = I('name');
     	if($name){
     	    $condition['name|right'] = array('like',"%$name%");
     	    $right_list = M('system_menu')->where($condition)->order('id desc')->select();
     	}else{
     	    $right_list = M('system_menu')->order('id desc')->select();
     	}
     	
     	$this->assign('right_list',$right_list);
     	$this->assign('group',$group);
     	return $this->fetch();
     }
     
     public function edit_right(){
     	if(IS_POST){
     		$data = I('post.');
     		$data['right'] = implode(',',$data['right']);
     		if(!empty($data['id'])){
     			M('system_menu')->where(array('id'=>$data['id']))->save($data);
     		}else{
     			if(M('system_menu')->where(array('name'=>$data['name']))->count()>0){
     				$this->error('该权限名称已添加，请检查',U('System/right_list'));
     			}
     			unset($data['id']);
     			M('system_menu')->add($data);
     		}
     		$this->success('操作成功',U('System/right_list'));
     		exit;
     	}
     	$id = I('id');
     	if($id){
     		$info = M('system_menu')->where(array('id'=>$id))->find();
     		$info['right'] = explode(',', $info['right']);
     		$this->assign('info',$info);
     	}
     	$group = array('system'=>'系统设置','content'=>'内容管理','goods'=>'商品中心','member'=>'会员中心','finance'=>'财务管理',
     			'order'=>'订单中心','marketing'=>'营销推广','tools'=>'插件工具','count'=>'统计报表','distribut'=>'分销中心'
     	);
     	$planPath = APP_PATH.'admin/controller';
     	$planList = array();
     	$dirRes   = opendir($planPath);
     	while($dir = readdir($dirRes))
     	{
     		if(!in_array($dir,array('.','..','.svn')))
     		{
     			$planList[] = basename($dir,'.php');
     		}
     	}
     	$this->assign('planList',$planList);
     	$this->assign('group',$group);
        return $this->fetch();
     }
     
     public function right_del(){
     	$id = I('del_id');
     	if(is_array($id)){
     		$id = implode(',', $id); 
     	}
     	if(!empty($id)){
     		$r = M('system_menu')->where("id in ($id)")->delete();
     		if($r){
     			respose(1);
     		}else{
     			respose('删除失败');
     		}
     	}else{
     		respose('参数有误');
     	}
     }
	//清除所有活动数据
	public function clearProm()
	{
		Db::name('flash_sale')->where('1=1')->delete();
		Db::name('group_buy')->where('1=1')->delete();
		Db::name('prom_goods')->where('1=1')->delete();
		Db::name('prom_order')->where('1=1')->delete();
		Db::name('coupon')->where('1=1')->delete();
		Db::name('coupon_list')->where('1=1')->delete();
		Db::name('goods_coupon')->where('1=1')->delete();
		Db::name('goods')->where('prom_type', '<>', 0)->whereOr('prom_id', '<>', 0)->update(['prom_type' => 0, 'prom_id' => 0]);
		Db::name('spec_goods_price')->where('prom_type', '<>', 0)->whereOr('prom_id', '<>', 0)->update(['prom_type' => 0, 'prom_id' => 0]);
		Db::name('cart')->where('prom_type', '<>', 0)->whereOr('prom_id', '<>', 0)->update(['prom_type' => 0, 'prom_id' => 0]);
		Db::name('order_goods')->where('prom_type', '<>', 0)->whereOr('prom_id', '<>', 0)->update(['prom_type' => 0, 'prom_id' => 0]);
		$this->success('清除活动数据成功');
	}

	//清楚拼团活动数据
	public function clearTeam(){
		Db::name('team_activity')->where('1=1')->delete();
		Db::name('team_follow')->where('1=1')->delete();
		Db::name('team_found')->where('1=1')->delete();
		Db::name('team_lottery')->where('1=1')->delete();
		Db::name('goods')->where('prom_type',6)->update(['prom_type' => 0, 'prom_id' => 0]);
		Db::name('spec_goods_price')->where('prom_type',6)->update(['prom_type' => 0, 'prom_id' => 0]);
		Db::name('order')->where('order_prom_type',6)->update(['order_prom_type' => 0, 'order_prom_id' => 0]);
		Db::name('order_goods')->where('prom_type',6)->update(['prom_type' => 0, 'prom_id' => 0]);
		$this->success('清除拼团活动数据成功');
	}
}
