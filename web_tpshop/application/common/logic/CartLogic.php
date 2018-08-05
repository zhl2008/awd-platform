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
 * Author: IT宇宙人
 * Date: 2015-09-09
 */

namespace app\common\logic;
use app\common\model\SpecGoodsPrice;
use app\common\model\Cart;
use app\common\model\Goods;
use think\Model;
use think\Db;
/**
 * 购物车 逻辑定义
 * Class CatsLogic
 * @package Home\Logic
 */
class CartLogic extends Model
{
    protected $goods;//商品模型
    protected $specGoodsPrice;//商品规格模型
    protected $goodsBuyNum;//购买的商品数量
    protected $session_id;//session_id
    protected $user_id = 0;//user_id
    protected $userGoodsTypeCount = 0;//用户购物车的全部商品种类

    public function __construct()
    {
        parent::__construct();
        $this->session_id = session_id();
    }

    /**
     * 将session_id改成unique_id
     * @param $uniqueId|api唯一id 类似于 pc端的session id
     */
    public function setUniqueId($uniqueId){
        $this->session_id = $uniqueId;
    }
    /**
     * 包含一个商品模型
     * @param $goods_id
     */
    public function setGoodsModel($goods_id)
    {
        $goodsModel = new Goods();
        $this->goods = $goodsModel::get($goods_id);
    }
    /**
     * 包含一个商品规格模型
     * @param $item_id
     */
    public function setSpecGoodsPriceModel($item_id)
    {
        $specGoodsPriceModel = new SpecGoodsPrice();
        $this->specGoodsPrice = $specGoodsPriceModel::get($item_id,'',10);
    }

    /**
     * 设置用户ID
     * @param $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * 设置购买的商品数量
     * @param $goodsBuyNum
     */
    public function setGoodsBuyNum($goodsBuyNum)
    {
        $this->goodsBuyNum = $goodsBuyNum;
    }

    /**
     * 立即购买
     * @return array
     */
    public function buyNow(){
        if(empty($this->goods)){
            return ['status'=>0,'msg'=>'购买商品不存在','result'=>''];
        }
        $buyGoods = [
            'user_id'=>$this->user_id,
            'session_id'=>$this->session_id,
            'goods_id'=>$this->goods['goods_id'],
            'goods_sn'=>$this->goods['goods_sn'],
            'goods_name'=>$this->goods['goods_name'],
            'market_price'=>$this->goods['market_price'],
            'goods_price'=>$this->goods['shop_price'],
            'member_goods_price'=>$this->goods['shop_price'],
            'goods_num' => $this->goodsBuyNum, // 购买数量
            'add_time' => time(), // 加入购物车时间
            'prom_type' => 0,   // 0 普通订单,1 限时抢购, 2 团购 , 3 促销优惠
            'prom_id' => 0,   // 活动id
            'weight' => $this->goods['weight'],   // 商品重量
            'goods'=>$this->goods,
        ];
        if(empty($this->specGoodsPrice)){
            $specGoodsPriceCount = Db::name('SpecGoodsPrice')->where("goods_id", $this->goods['goods_id'])->count('item_id');
            if($specGoodsPriceCount > 0){
                return ['status' => 0, 'msg' => '必须传递商品规格', 'result' => ''];
            }
            $prom_type = $this->goods['prom_type'];
            $store_count = $this->goods['store_count'];
        }else{
            $buyGoods['member_goods_price'] = $this->specGoodsPrice['price'];
            $buyGoods['goods_price'] = $this->specGoodsPrice['price'];
            $buyGoods['spec_key'] = $this->specGoodsPrice['key'];
            $buyGoods['spec_key_name'] = $this->specGoodsPrice['key_name']; // 规格 key_name
            $buyGoods['sku'] = $this->specGoodsPrice['sku']; //商品条形码
            $prom_type = $this->specGoodsPrice['prom_type'];
            $store_count = $this->specGoodsPrice['store_count'];
        }
        if($this->goodsBuyNum > $store_count){
            return array('status' => 0, 'msg' => '商品库存不足，剩余'.$this->goods['store_count'], 'result' => '');
        }
        $goodsPromFactory = new GoodsPromFactory();
        if ($goodsPromFactory->checkPromType($prom_type)) {
            $goodsPromLogic = $goodsPromFactory->makeModule($this->goods,$this->specGoodsPrice);
            $buyResult = $goodsPromLogic->buyNow($buyGoods);
            $buyGoods = $buyResult['result']['buy_goods'];
        }else{
            $buyResult = ['status' => 1, 'msg' => '立即购买成功'];
        }
        $cart = new Cart();
        $buyGoods['cut_fee'] = $cart->getCutFeeAttr(0,$buyGoods);
        $buyGoods['goods_fee'] = $cart->getGoodsFeeAttr(0,$buyGoods);
        $buyGoods['total_fee'] = $cart->getTotalFeeAttr(0,$buyGoods);
        $buyResult['result']['buy_goods'] = $buyGoods;
        return $buyResult;
    }
    /**
     * modify ：addCart
     * @return array
     */
    public function addGoodsToCart()
    {
        if(empty($this->goods)){
            return ['status'=>-3,'msg'=>'购买商品不存在','result'=>''];
        }
        if($this->goods['exchange_integral'] > 0){
            return ['status'=>0,'msg'=>'积分商品跳转','result'=>['url'=>U('Goods/goodsInfo',['id'=>$this->goods['goods_id'],'item_id'=>$this->specGoodsPrice['item_id']],'',true)]];
        }
        $userCartCount = Db::name('cart')->where(['user_id'=>$this->user_id,'session_id'=>$this->session_id])->count();//获取用户购物车的商品有多少种
        if ($userCartCount >= 20) {
            return array('status' => -9, 'msg' => '购物车最多只能放20种商品', 'result' => '');
        }
        $specGoodsPriceCount = Db::name('SpecGoodsPrice')->where("goods_id", $this->goods['goods_id'])->count('item_id');
        if(empty($this->specGoodsPrice) && !empty($specGoodsPriceCount)){
            return array('status' => -1, 'msg' => '必须传递商品规格', 'result' => '');
        }
        //有商品规格，和没有商品规格
        if($this->specGoodsPrice){
            if($this->specGoodsPrice['prom_type'] == 1){
                $result = $this->addFlashSaleCart();
            }elseif($this->specGoodsPrice['prom_type'] == 2){
                $result = $this->addGroupBuyCart();
            }elseif($this->specGoodsPrice['prom_type'] == 3){
                $result = $this->addPromGoodsCart();
            }else{
                $result = $this->addNormalCart();
            }
        }else{
            if($this->goods['prom_type'] == 1){
                $result = $this->addFlashSaleCart();
            }elseif($this->goods['prom_type'] == 2){
                $result = $this->addGroupBuyCart();
            }elseif($this->goods['prom_type'] == 3){
                $result = $this->addPromGoodsCart();
            }else{
                $result = $this->addNormalCart();
            }
        }
        $result['result'] = $UserCartGoodsNum = $this->getUserCartGoodsNum(); // 查找购物车数量
        setcookie('cn', $UserCartGoodsNum, null, '/');
        return $result;
    }


    /**
     * 购物车添加普通商品
     * @return array
     */
    private function addNormalCart(){
        if(empty($this->specGoodsPrice)){
            $price =  $this->goods['shop_price'];
            $store_count =  $this->goods['store_count'];
        }else{
            //如果有规格价格，就使用规格价格，否则使用本店价。
            $price = $this->specGoodsPrice['price'];
            $store_count = $this->specGoodsPrice['store_count'];
        }
        // 查询购物车是否已经存在这商品
        if (!$this->user_id) {
            $userCartGoods = Cart::get(['user_id'=>$this->user_id,'session_id'=>$this->session_id,'goods_id'=>$this->goods['goods_id'],'spec_key'=>($this->specGoodsPrice['key'] ?: '')]);
        } else {
            $userCartGoods = Cart::get(['user_id'=>$this->user_id,'goods_id'=>$this->goods['goods_id'],'spec_key'=>($this->specGoodsPrice['key'] ?: '')]);
        }
        // 如果该商品已经存在购物车
        if ($userCartGoods) {
            $userWantGoodsNum = $this->goodsBuyNum + $userCartGoods['goods_num'];//本次要购买的数量加上购物车的本身存在的数量
            //如果有阶梯价格,就是用阶梯价格
            if (!empty($this->goods['price_ladder'])) {
                $goodsLogic = new GoodsLogic();
                $price_ladder = unserialize($this->goods['price_ladder']);
                $price = $goodsLogic->getGoodsPriceByLadder($userWantGoodsNum, $this->goods['shop_price'], $price_ladder);
            }
            if($userWantGoodsNum > 200){
                $userWantGoodsNum = 200;
            }
            if($userWantGoodsNum > $store_count){
                return array('status' => -4, 'msg' => '商品库存不足，剩余'.$store_count.',当前购物车已有'.$userCartGoods['goods_num'].'件', 'result' => '');
            }
            $cartResult = $userCartGoods->save(['goods_num' => $userWantGoodsNum,'goods_price'=>$price,'member_goods_price'=>$price]);
        }else{
            //如果该商品没有存在购物车
            if($this->goodsBuyNum > $store_count){
                return array('status' => -4, 'msg' => '商品库存不足，剩余'.$this->goods['store_count'], 'result' => '');
            }
            //如果有阶梯价格,就是用阶梯价格
            if (!empty($this->goods['price_ladder'])) {
                $goodsLogic = new GoodsLogic();
                $price_ladder = unserialize($this->goods['price_ladder']);
                $price = $goodsLogic->getGoodsPriceByLadder($this->goodsBuyNum, $this->goods['shop_price'], $price_ladder);
            }
            $cartAddData = array(
                'user_id' => $this->user_id,   // 用户id
                'session_id' => $this->session_id,   // sessionid
                'goods_id' => $this->goods['goods_id'],   // 商品id
                'goods_sn' => $this->goods['goods_sn'],   // 商品货号
                'goods_name' => $this->goods['goods_name'],   // 商品名称
                'market_price' => $this->goods['market_price'],   // 市场价
                'goods_price' => $price,  // 原价
                'member_goods_price' => $price,  // 会员折扣价 默认为 购买价
                'goods_num' => $this->goodsBuyNum, // 购买数量
                'add_time' => time(), // 加入购物车时间
                'prom_type' => 0,   // 0 普通订单,1 限时抢购, 2 团购 , 3 促销优惠
                'prom_id' => 0,   // 活动id
            );
            if($this->specGoodsPrice){
                $cartAddData['spec_key'] = $this->specGoodsPrice['key'];
                $cartAddData['spec_key_name'] = $this->specGoodsPrice['key_name']; // 规格 key_name
                $cartAddData['sku'] = $this->specGoodsPrice['sku']; //商品条形码
            }
            $cartResult = Db::name('Cart')->insertGetId($cartAddData);
        }
        if($cartResult !== false){
            return array('status' => 1, 'msg' => '成功加入购物车', 'result' => '');
        }else{
            return array('status' => -1, 'msg' => '加入购物车失败', 'result' => '');
        }
    }

    /**
     * 购物车添加秒杀商品
     * @return array
     */
    private function addFlashSaleCart(){
        $flashSaleLogic = new FlashSaleLogic($this->goods, $this->specGoodsPrice);
        $flashSale = $flashSaleLogic->getPromModel();
        $flashSaleIsEnd = $flashSaleLogic->checkActivityIsEnd();
        if($flashSaleIsEnd){
            return array('status' => -1, 'msg' => '秒杀活动已结束', 'result' => '');
        }
        $flashSaleIsAble = $flashSaleLogic->checkActivityIsAble();
        if(!$flashSaleIsAble){
            //活动没有进行中，走普通商品下单流程
            return $this->addNormalCart();
        }else{
            //活动进行中
            if ($this->user_id == 0) {
                return array('status' => -101, 'msg' => '购买活动商品必须先登录', 'result' => '');
            }
        }
        if($this->goodsBuyNum > $flashSale['buy_limit']){
            return array('status' => -4, 'msg' => '每人限购'.$flashSale['buy_limit'].'件', 'result' => '');
        }
        //获取用户购物车的抢购商品
        if (!$this->user_id) {
            $userCartGoods = Cart::get(['user_id'=>$this->user_id,'session_id'=>$this->session_id,'goods_id'=>$this->goods['goods_id'],'spec_key'=>($this->specGoodsPrice['key'] ?: '')]);
        } else {
            $userCartGoods = Cart::get(['user_id'=>$this->user_id,'goods_id'=>$this->goods['goods_id'],'spec_key'=>($this->specGoodsPrice['key'] ?: '')]);
        }
        $userCartGoodsNum = empty($userCartGoods) ? 0 : $userCartGoods['goods_num'];///获取用户购物车的抢购商品数量
        $userFlashOrderGoodsNum = $flashSaleLogic->getUserFlashOrderGoodsNum($this->user_id); //获取用户抢购已购商品数量
        $flashSalePurchase = $flashSale['goods_num'] - $flashSale['buy_num'];//抢购剩余库存
        $userBuyGoodsNum = $this->goodsBuyNum + $userFlashOrderGoodsNum + $userCartGoodsNum;
        if($userBuyGoodsNum > $flashSale['buy_limit']){
            return array('status' => -4, 'msg' => '每人限购'.$flashSale['buy_limit'].'件，您已下单'.$userFlashOrderGoodsNum.'件'.'购物车已有'.$userCartGoodsNum.'件', 'result' => '');
        }
        $userWantGoodsNum = $this->goodsBuyNum + $userCartGoodsNum;//本次要购买的数量加上购物车的本身存在的数量
        if($userWantGoodsNum > 200){
            $userWantGoodsNum = 200;
        }
        if($userWantGoodsNum > $flashSalePurchase){
            return array('status' => -4, 'msg' => '商品库存不足，剩余'.$flashSalePurchase.',当前购物车已有'.$userCartGoodsNum.'件', 'result' => '');
        }
        // 如果该商品已经存在购物车
        if($userCartGoods){
            $cartResult = $userCartGoods->save(['goods_num' => $userWantGoodsNum]);
        }else{
            $cartAddFlashSaleData = array(
                'user_id' => $this->user_id,   // 用户id
                'session_id' => $this->session_id,   // sessionid
                'goods_id' => $this->goods['goods_id'],   // 商品id
                'goods_sn' => $this->goods['goods_sn'],   // 商品货号
                'goods_name' => $this->goods['goods_name'],   // 商品名称
                'market_price' => $this->goods['market_price'],   // 市场价
                'member_goods_price' => $flashSale['price'],  // 会员折扣价 默认为 购买价
                'goods_num' => $userWantGoodsNum, // 购买数量
                'add_time' => time(), // 加入购物车时间
                'prom_type' => 1,   // 0 普通订单,1 限时抢购, 2 团购 , 3 促销优惠
            );
            //商品有规格
            if($this->specGoodsPrice){
                $cartAddFlashSaleData['spec_key'] = $this->specGoodsPrice['key'];
                $cartAddFlashSaleData['spec_key_name'] = $this->specGoodsPrice['key_name']; // 规格 key_name
                $cartAddFlashSaleData['sku'] = $this->specGoodsPrice['sku']; //商品条形码
                $cartAddFlashSaleData['goods_price'] = $this->specGoodsPrice['price'];   // 规格价
                $cartAddFlashSaleData['prom_id'] = $this->specGoodsPrice['prom_id']; // 活动id
            }else{
                $cartAddFlashSaleData['goods_price'] =  $this->goods['shop_price'];   // 原价
                $cartAddFlashSaleData['prom_id'] = $this->goods['prom_id'];// 活动id
            }
            $cartResult = Db::name('Cart')->insert($cartAddFlashSaleData);
        }
        if($cartResult !== false){
            return array('status' => 1, 'msg' => '成功加入购物车', 'result' => '');
        }else{
            return array('status' => -1, 'msg' => '加入购物车失败', 'result' => '');
        }
    }

    /**
     *  购物车添加团购商品
     * @return array
     */
    private function addGroupBuyCart(){
        $groupBuyLogic = new GroupBuyLogic($this->goods, $this->specGoodsPrice);
        $groupBuy = $groupBuyLogic->getPromModel();
        //活动是否已经结束
        if($groupBuy['is_end'] == 1 || empty($groupBuy)){
            return array('status' => -1, 'msg' => '团购活动已结束', 'result' => '');
        }
        $groupBuyIsAble = $groupBuyLogic->checkActivityIsAble();
        if(!$groupBuyIsAble){
            //活动没有进行中，走普通商品下单流程
            return $this->addNormalCart();
        }else{
            //活动进行中
            if ($this->user_id == 0) {
                return array('status' => -101, 'msg' => '购买活动商品必须先登录', 'result' => '');
            }
        }
        //获取用户购物车的团购商品
        if (!$this->user_id) {
            $userCartGoods = Cart::get(['user_id'=>$this->user_id,'session_id'=>$this->session_id,'goods_id'=>$this->goods['goods_id'],'spec_key'=>($this->specGoodsPrice['key'] ?: '')]);
        } else {
            $userCartGoods = Cart::get(['user_id'=>$this->user_id,'goods_id'=>$this->goods['goods_id'],'spec_key'=>($this->specGoodsPrice['key'] ?: '')]);
        }
        $userCartGoodsNum = empty($userCartGoods) ? 0 : $userCartGoods['goods_num'];///获取用户购物车的团购商品数量
        $userWantGoodsNum = $userCartGoodsNum + $this->goodsBuyNum;//购物车加上要加入购物车的商品数量
        $groupBuyPurchase = $groupBuy['goods_num'] - $groupBuy['buy_num'];//团购剩余库存
        if($userWantGoodsNum > 200){
            $userWantGoodsNum = 200;
        }
        if($userWantGoodsNum > $groupBuyPurchase){
            return array('status' => -4, 'msg' => '商品库存不足，剩余'.$groupBuyPurchase.',当前购物车已有'.$userCartGoodsNum.'件', 'result' => '');
        }
        // 如果该商品已经存在购物车
        if($userCartGoods){
            $cartResult = $userCartGoods->save(['goods_num' => $userWantGoodsNum]);
        }else{
            $cartAddFlashSaleData = array(
                'user_id' => $this->user_id,   // 用户id
                'session_id' => $this->session_id,   // sessionid
                'goods_id' => $this->goods['goods_id'],   // 商品id
                'goods_sn' => $this->goods['goods_sn'],   // 商品货号
                'goods_name' => $this->goods['goods_name'],   // 商品名称
                'market_price' => $this->goods['market_price'],   // 市场价
                'member_goods_price' => $groupBuy['price'],  // 会员折扣价 默认为 购买价
                'goods_num' => $userWantGoodsNum, // 购买数量
                'add_time' => time(), // 加入购物车时间
                'prom_type' => 2,   // 0 普通订单,1 限时抢购, 2 团购 , 3 促销优惠
            );
            //商品有规格
            if($this->specGoodsPrice){
                $cartAddFlashSaleData['spec_key'] = $this->specGoodsPrice['key'];
                $cartAddFlashSaleData['spec_key_name'] = $this->specGoodsPrice['key_name']; // 规格 key_name
                $cartAddFlashSaleData['sku'] = $this->specGoodsPrice['sku']; //商品条形码
                $cartAddFlashSaleData['goods_price'] = $this->specGoodsPrice['price'];   // 规格价
                $cartAddFlashSaleData['prom_id'] = $this->specGoodsPrice['prom_id']; // 活动id
            }else{
                $cartAddFlashSaleData['goods_price'] =  $this->goods['shop_price'];   // 原价
                $cartAddFlashSaleData['prom_id'] = $this->goods['prom_id'];// 活动id
            }
            $cartResult = Db::name('Cart')->insert($cartAddFlashSaleData);
        }
        if($cartResult !== false){
            return array('status' => 1, 'msg' => '成功加入购物车', 'result' => '');
        }else{
            return array('status' => -1, 'msg' => '加入购物车失败', 'result' => '');
        }
    }

    /**
     *  购物车添加优惠促销商品
     * @return array
     */
    private function addPromGoodsCart(){
        $promGoodsLogic = new PromGoodsLogic($this->goods, $this->specGoodsPrice);
        //活动是否存在，是否关闭，是否处于有效期
        if($promGoodsLogic->checkActivityIsEnd() || !$promGoodsLogic->checkActivityIsAble()){
            //活动不存在，已关闭，不处于有效期,走添加普通商品流程
            return $this->addNormalCart();
        }else{
            //活动进行中
            if ($this->user_id == 0) {
                return array('status' => -101, 'msg' => '购买活动商品必须先登录', 'result' => '');
            }
        }
        //如果有规格价格，就使用规格价格，否则使用本店价。
        if ($this->specGoodsPrice) {
            $priceBefore = $this->specGoodsPrice['price'];
        } else {
            $priceBefore = $this->goods['shop_price'];
        }
        //计算优惠价格
        $priceAfter = $promGoodsLogic->getPromotionPrice($priceBefore);
        // 查询购物车是否已经存在这商品
        if (!$this->user_id) {
            $userCartGoods = Cart::get(['user_id'=>$this->user_id,'session_id'=>$this->session_id,'goods_id'=>$this->goods['goods_id'],'spec_key'=>($this->specGoodsPrice['key'] ?: '')]);
        } else {
            $userCartGoods = Cart::get(['user_id'=>$this->user_id,'goods_id'=>$this->goods['goods_id'],'spec_key'=>($this->specGoodsPrice['key'] ?: '')]);
        }
        // 如果该商品已经存在购物车
        if ($userCartGoods) {
            $userWantGoodsNum = $this->goodsBuyNum + $userCartGoods['goods_num'];//本次要购买的数量加上购物车的本身存在的数量
            if($userWantGoodsNum > 200){
                $userWantGoodsNum = 200;
            }
            $cartResult = $userCartGoods->save(['goods_num' => $userWantGoodsNum, 'goods_price' => $priceBefore, 'member_goods_price' => $priceAfter]);
        }else{
            $cartAddData = array(
                'user_id' => $this->user_id,   // 用户id
                'session_id' => $this->session_id,   // sessionid
                'goods_id' => $this->goods['goods_id'],   // 商品id
                'goods_sn' => $this->goods['goods_sn'],   // 商品货号
                'goods_name' => $this->goods['goods_name'],   // 商品名称
                'market_price' => $this->goods['market_price'],   // 市场价
                'goods_price' => $priceBefore,  // 原价
                'member_goods_price' => $priceAfter,  // 会员折扣价 默认为 购买价
                'goods_num' => $this->goodsBuyNum, // 购买数量
                'add_time' => time(), // 加入购物车时间
                'prom_type' => 3,   // 0 普通订单,1 限时抢购, 2 团购 , 3 促销优惠
            );
            //商品有规格
            if($this->specGoodsPrice){
                $cartAddData['spec_key'] = $this->specGoodsPrice['key'];
                $cartAddData['spec_key_name'] = $this->specGoodsPrice['key_name']; // 规格 key_name
                $cartAddData['sku'] = $this->specGoodsPrice['sku']; //商品条形码
                $cartAddData['prom_id'] = $this->specGoodsPrice['prom_id']; // 活动id
            }else{
                $cartAddData['prom_id'] = $this->goods['prom_id'];// 活动id
            }
            $cartResult = Db::name('Cart')->insert($cartAddData);
        }
        if($cartResult !== false){
            return array('status' => 1, 'msg' => '成功加入购物车', 'result' => '');
        }else{
            return array('status' => -1, 'msg' => '加入购物车失败', 'result' => '');
        }
    }

    /**
     * 获取用户购物车商品总数
     * @return float|int
     */
    public function getUserCartGoodsNum()
    {
        if ($this->user_id) {
            $goods_num = Db::name('cart')->where(['user_id' => $this->user_id])->sum('goods_num');
        } else {
            $goods_num = Db::name('cart')->where(['session_id' => $this->session_id])->sum('goods_num');
        }
        return empty($goods_num) ? 0 : $goods_num;
    }

    /**
     * 获取用户购物车商品总数
     * @return float|int
     */

    public function getUserCartGoodsTypeNum()
    {
        if ($this->user_id) {
            $goods_num = Db::name('cart')->where(['user_id' => $this->user_id])->count();
        } else {
            $goods_num = Db::name('cart')->where(['session_id' => $this->session_id])->count();
        }
        return empty($goods_num) ? 0 : $goods_num;
    }

    /**
     * @param int $selected|是否被用户勾选中的 0 为全部 1为选中  一般没有查询不选中的商品情况
     * 获取用户的购物车列表
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getCartList($selected = 0){
        $cart = new Cart();
        // 如果用户已经登录则按照用户id查询
        if ($this->user_id) {
            $cartWhere['user_id'] = $this->user_id;
        } else {
            $cartWhere['session_id'] = $this->session_id;
        }
        if($selected != 0){
            $cartWhere['selected'] = 1;
        }
        $cartList = $cart->with('promGoods,goods')->where($cartWhere)->select();  // 获取购物车商品
        $cartCheckAfterList = $this->checkCartList($cartList);
//        $cartCheckAfterList = $cartList;
        $cartGoodsTotalNum = array_sum(array_map(function($val){return $val['goods_num'];}, $cartCheckAfterList));//购物车购买的商品总数
        setcookie('cn', $cartGoodsTotalNum, null, '/');
        return $cartCheckAfterList;
    }

    /**
     * 过滤掉无效的购物车商品
     * @param $cartList
     */
    public function checkCartList($cartList){
        $goodsPromFactory = new GoodsPromFactory();
        foreach($cartList as $cartKey=>$cart){
            //商品不存在或者已经下架
            if(empty($cart['goods']) || $cart['goods']['is_on_sale'] != 1){
                $cart->delete();
                unset($cartList[$cartKey]);
                continue;
            }
            //活动商品的活动是否失效
            if ($goodsPromFactory->checkPromType($cart['prom_type'])) {
                if (!empty($cart['spec_key'])) {
                    $specGoodsPrice = SpecGoodsPrice::get(['goods_id' => $cart['goods_id'], 'key' => $cart['spec_key']], '', true);
                    if($specGoodsPrice['prom_id'] != $cart['prom_id']){
                        $cart->delete();
                        unset($cartList[$cartKey]);
                        continue;
                    }
                } else {
                    if($cart['goods']['prom_id'] != $cart['prom_id']){
                        $cart->delete();
                        unset($cartList[$cartKey]);
                        continue;
                    }
                    $specGoodsPrice = null;
                }
                $goodsPromLogic = $goodsPromFactory->makeModule($cart['goods'], $specGoodsPrice);
                if ($goodsPromLogic && !$goodsPromLogic->isAble()) {
                    $cart->delete();
                    unset($cartList[$cartKey]);
                    continue;
                }

            }
        }
        return $cartList;
    }

    /**
     *  modify ：cart_count
     *  获取用户购物车欲购买的商品有多少种
     * @return int|string
     */
    public function getUserCartOrderCount(){
        $count = Db::name('Cart')->where(['user_id' => $this->user_id , 'selected' => 1])->count();
        return $count;
    }

    /**
     * 用户登录后 对购物车操作
     * modify：login_cart_handle
     */
    public function doUserLoginHandle()
    {
        if (empty($this->session_id) || empty($this->user_id)) {
            return;
        }
        //登录后将购物车的商品的 user_id 改为当前登录的id
        $cart = new Cart();
        $cart->save(['user_id' => $this->user_id], ['session_id' => $this->session_id, 'user_id' => 0]);
        // 查找购物车两件完全相同的商品
        $cart_id_arr = $cart->field('id')->where(['user_id' => $this->user_id])->group('goods_id,spec_key')->having('count(goods_id) > 1')->select();
        if (!empty($cart_id_arr)) {
            $cart_id_arr = get_arr_column($cart_id_arr, 'id');
            M('cart')->delete($cart_id_arr); // 删除购物车完全相同的商品
        }
    }
    /**
     * 更改购物车的商品数量
     * @param $cart_id|购物车id
     * @param $goods_num|商品数量
     * @return array
     */
    public function changeNum($cart_id, $goods_num){
        $Cart = new Cart();
        $cart = $Cart::get($cart_id);
        if($goods_num > $cart->limit_num){
            return ['status' => 0, 'msg' => '商品数量不能大于'.$cart->limit_num, 'result' => ['limit_num'=>$cart->limit_num]];
        }
        if($goods_num > 200){
            $goods_num = 200;
        }
        $cartGoods = Goods::get($cart['goods_id']);
        $cart->goods_num = $goods_num;
        if($cart->prom_type == 0 && !empty($cartGoods['price_ladder'])){
            //如果有阶梯价格,就是用阶梯价格
            $goodsLogic = new GoodsLogic();
            $price_ladder = unserialize($cartGoods['price_ladder']);
            $cart->goods_price = $cart->member_goods_price = $goodsLogic->getGoodsPriceByLadder($goods_num, $cartGoods['shop_price'], $price_ladder);
        }
        $cart->save();
        return ['status' => 1, 'msg' => '修改商品数量成功', 'result' => ''];
    }
    /**
     * 删除购物车商品
     * @param array $cart_ids
     * @return int
     * @throws \think\Exception
     */
    public function delete($cart_ids = array()){
        if ($this->user_id) {
            $cartWhere['user_id'] = $this->user_id;
        } else {
            $cartWhere['session_id'] = $this->session_id;
            $user['user_id'] = 0;
        }
        $delete = Db::name('cart')->where($cartWhere)->where('id','IN',$cart_ids)->delete();
        return $delete;
    }
    /**
     *  更新购物车，并返回计算结果
     * @param array $cart
     * @return array
     */
    public function AsyncUpdateCart($cart = [])
    {
        $cartList = $cartSelectedId = $cartNoSelectedId = [];
        if (empty($cart)) {
            return ['status' => 0, 'msg' => '购物车没商品', 'result' => compact('total_fee', 'goods_fee', 'goods_num', 'cartList')];
        }
        foreach ($cart as $key => $val) {
            if ($cart[$key]['selected'] == 1) {
                $cartSelectedId[] = $cart[$key]['id'];
            } else {
                $cartNoSelectedId[] = $cart[$key]['id'];
            }
        }
        $Cart = new Cart();
        if ($this->user_id) {
            $cartWhere['user_id'] = $this->user_id;
        } else {
            $cartWhere['session_id'] = $this->session_id;
        }
        if (!empty($cartNoSelectedId)) {
            $Cart->where('id', 'IN', $cartNoSelectedId)->where($cartWhere)->update(['selected' => 0]);
        }
        if (empty($cartSelectedId)) {
            $cartPriceInfo = $this->getCartPriceInfo();
            $cartPriceInfo['cartList'] = $cartList;
            return ['status' => 1, 'msg' => '购物车没选中商品', 'result' => $cartPriceInfo];
        }
        $cartList = $Cart->where('id', 'IN', $cartSelectedId)->where($cartWhere)->select();
        foreach($cartList as $cartKey=>$cartVal){
            if($cartList[$cartKey]['selected'] == 0){
                $Cart->where('id', 'IN', $cartSelectedId)->where($cartWhere)->update(['selected' => 1]);
                break;
            }
        }
        if ($cartList) {
            $cartList = collection($cartList)->append(['cut_fee', 'total_fee', 'goods_fee'])->toArray();
            $cartPriceInfo = $this->getCartPriceInfo($cartList);
            $cartPriceInfo['cartList'] = $cartList;
            return ['status' => 1, 'msg' => '计算成功', 'result' => $cartPriceInfo];
        } else {
            $cartPriceInfo = $this->getCartPriceInfo();
            $cartPriceInfo['cartList'] = $cartList;
            return ['status' => 1, 'msg' => '购物车没选中商品', 'result' => $cartPriceInfo];
        }
    }

    /**
     * 获取购物车的价格详情
     * @param $cartList|购物车列表
     * @return array
     */
    public function getCartPriceInfo($cartList = null){
        $total_fee = $goods_fee = $goods_num = 0;//初始化数据。商品总额/节约金额/商品总共数量
        if($cartList){
            foreach ($cartList as $cartKey => $cartItem) {
                $total_fee += $cartItem['goods_fee'];
                $goods_fee += $cartItem['cut_fee'];
                $goods_num += $cartItem['goods_num'];
            }
        }
        return compact('total_fee', 'goods_fee', 'goods_num');
    }

    /**
     * 转换购物车的优惠券数据
     * @param $cartList|购物车商品
     * @param $userCouponList|用户优惠券列表
     * @return mixedable
     */
    public function getCouponCartList($cartList, $userCouponList)
    {
        $userCouponArray = collection($userCouponList)->toArray();  //用户的优惠券
        $couponNewList = [];
        foreach ($userCouponArray as $couponKey => $couponItem) {
            if ($userCouponArray[$couponKey]['coupon']['use_type'] == 0) { //全店使用优惠券
                if ($cartList['total_fee'] >= $userCouponArray[$couponKey]['coupon']['condition']) {  //订单商品总价是否符合优惠券购买价格
                    $userCouponArray[$couponKey]['coupon']['able'] = 1;
                } else {
                    $userCouponArray[$couponKey]['coupon']['able'] = 0;
                }
            } elseif ($userCouponArray[$couponKey]['coupon']['use_type'] == 1) { //指定商品优惠券
                $pointGoodsPrice = 0;//指定商品的购买总价
                $couponGoodsId = get_arr_column($userCouponArray[$couponKey]['coupon']['goods_coupon'], 'goods_id');
                foreach ($cartList['cartList'] as $tKey => $Item) {
                    if (in_array($Item['goods_id'], $couponGoodsId)) {
                        $pointGoodsPrice += $Item['goods_price'] * $Item['goods_num'];  //统计每个商品的总价
                    }
                }
                if ($pointGoodsPrice >= $userCouponArray[$couponKey]['coupon']['condition']) {
                    $userCouponArray[$couponKey]['coupon']['able'] = 1;
                } else {
                    $userCouponArray[$couponKey]['coupon']['able'] = 0;
                }
            } elseif ($userCouponArray[$couponKey]['coupon']['use_type'] == 2) { //指定商品分类优惠券
                $pointGoodsCatPrice = 0;//指定商品分类的购买总价
                $couponGoodsCatId = get_arr_column($userCouponArray[$couponKey]['coupon']['goods_coupon'], 'goods_category_id');
                foreach ($cartList['cartList'] as $tKey => $Item) {
                    if (in_array($Item['goods']['cat_id'], $couponGoodsCatId)) {
                        $pointGoodsCatPrice += $Item['goods_price'] * $Item['goods_num'];
                    }
                }
                if ($pointGoodsCatPrice >= $userCouponArray[$couponKey]['coupon']['condition']) {
                    $userCouponArray[$couponKey]['coupon']['able'] = 1;
                } else {
                    $userCouponArray[$couponKey]['coupon']['able'] = 0;
                }
            } else {
                $userCouponList[$couponKey]['coupon']['able'] = 1;
            }
            $couponNewList[] = $userCouponArray[$couponKey];
        }
        return $couponNewList;
    }
}