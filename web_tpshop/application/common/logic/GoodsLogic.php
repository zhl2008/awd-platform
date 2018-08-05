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
 */

namespace app\common\logic;

use think\Model;
use think\Db;
/**
 * 分类逻辑定义
 * Class CatsLogic
 * @package common\Logic
 */
class GoodsLogic extends Model
{
    /**
     * @param $goods_id_arr
     * @param $filter_param
     * @param $action
     * @return array|mixed 这里状态一般都为1 result 不是返回数据 就是空
     * 获取 商品列表页帅选品牌
     */
    public function get_filter_brand($goods_id_arr, $filter_param, $action)
    {
        if (!empty($filter_param['brand_id'])) {
            return array();
        }

        $map['goods_id'] = ['in', $goods_id_arr];
        $map['brand_id'] = ['>', 0];
        $brand_id_arr = M('goods')->where($map)->column('brand_id');
        $list_brand = M('brand')->where('id','in',$brand_id_arr)->limit('30')->select();

        foreach ($list_brand as $k => $v) {
            // 帅选参数
            $filter_param['brand_id'] = $v['id'];
            $list_brand[$k]['href'] = urldecode(U("Goods/$action", $filter_param, ''));
        }
        return $list_brand;
    }

    /**
     * @param $goods_id_arr
     * @param $filter_param
     * @param $action
     * @param int $mode  0  返回数组形式  1 直接返回result
     * @return array 这里状态一般都为1 result 不是返回数据 就是空
     * 获取 商品列表页帅选规格
     */
    public function get_filter_spec($goods_id_arr, $filter_param, $action, $mode = 0)
    {
        $goods_id_str = implode(',', $goods_id_arr);
        $goods_id_str = $goods_id_str ? $goods_id_str : '0';
        $spec_key = DB::query("select group_concat(`key` separator  '_') as `key` from __PREFIX__spec_goods_price where goods_id in($goods_id_str)");  //where("goods_id in($goods_id_str)")->select();
        $spec_key = explode('_', $spec_key[0]['key']);
        $spec_key = array_unique($spec_key);
        $spec_key = array_filter($spec_key);

        if (empty($spec_key)) {
            if ($mode == 1) return array();
            return array('status' => 1, 'msg' => '', 'result' => array());
        }
        $spec = M('spec')->where(array('search_index'=>1))->getField('id,name');
        $spec_item = M('spec_item')->where(array('spec_id'=>array('in',array_keys($spec))))->getField('id,spec_id,item');

        $list_spec = array();
        $old_spec = $filter_param['spec'];
        foreach ($spec_key as $k => $v) {
            if (strpos($old_spec, $spec_item[$v]['spec_id'] . '_') === 0 || strpos($old_spec, '@' . $spec_item[$v]['spec_id'] . '_') || $spec_item[$v]['spec_id'] == '')
                continue;
            $list_spec[$spec_item[$v]['spec_id']]['spec_id'] = $spec_item[$v]['spec_id'];
            $list_spec[$spec_item[$v]['spec_id']]['name'] = $spec[$spec_item[$v]['spec_id']];
            //$list_spec[$spec_item[$v]['spec_id']]['item'][$v] = $spec_item[$v]['item'];

            // 帅选参数
            if (!empty($old_spec))
                $filter_param['spec'] = $old_spec . '@' . $spec_item[$v]['spec_id'] . '_' . $v;
            else
                $filter_param['spec'] = $spec_item[$v]['spec_id'] . '_' . $v;
            $list_spec[$spec_item[$v]['spec_id']]['item'][] = array('key' => $spec_item[$v]['spec_id'], 'val' => $v, 'item' => $spec_item[$v]['item'], 'href' => urldecode(U("Goods/$action", $filter_param, '')));
        }

        if ($mode == 1) return $list_spec;
        return array('status' => 1, 'msg' => '', 'result' => $list_spec);
    }
    /**
     * @param array $goods_id_arr
     * @param $filter_param
     * @param $action
     * @param int $mode 0  返回数组形式  1 直接返回result
     * @return array
     * 获取商品列表页帅选属性
     */
    public function get_filter_attr($goods_id_arr = array(), $filter_param, $action, $mode = 0)
    {
        $goods_id_str = implode(',', $goods_id_arr);
        $goods_id_str = $goods_id_str ? $goods_id_str : '0';
        $goods_attr = M('goods_attr')->where(['goods_id'=>['in',$goods_id_str],'attr_value'=>['<>','']])->select();
        // $goods_attr = M('goods_attr')->where("attr_value != ''")->select();
        $goods_attribute = M('goods_attribute')->where("attr_index = 1")->getField('attr_id,attr_name,attr_index');
        if (empty($goods_attr)) {
            if ($mode == 1) return array();
            return array('status' => 1, 'msg' => '', 'result' => array());
        }
        $list_attr = $attr_value_arr = array();
        $old_attr = $filter_param['attr'];
        foreach ($goods_attr as $k => $v) {
            // 存在的帅选不再显示
            if (strpos($old_attr, $v['attr_id'] . '_') === 0 || strpos($old_attr, '@' . $v['attr_id'] . '_'))
                continue;
            if ($goods_attribute[$v['attr_id']]['attr_index'] == 0)
                continue;
            $v['attr_value'] = trim($v['attr_value']);
            // 如果同一个属性id 的属性值存储过了 就不再存贮
            if (in_array($v['attr_id'] . '_' . $v['attr_value'], (array)$attr_value_arr[$v['attr_id']]))
                continue;
            $attr_value_arr[$v['attr_id']][] = $v['attr_id'] . '_' . $v['attr_value'];

            $list_attr[$v['attr_id']]['attr_id'] = $v['attr_id'];
            $list_attr[$v['attr_id']]['attr_name'] = $goods_attribute[$v['attr_id']]['attr_name'];

            // 帅选参数
            if (!empty($old_attr))
                $filter_param['attr'] = $old_attr . '@' . $v['attr_id'] . '_' . $v['attr_value'];
            else
                $filter_param['attr'] = $v['attr_id'] . '_' . $v['attr_value'];

            $list_attr[$v['attr_id']]['attr_value'][] = array('key' => $v['attr_id'], 'val' => $v['attr_value'], 'attr_value' => $v['attr_value'], 'href' => U("Goods/$action", $filter_param, ''));
            //unset($filter_param['attr_id_'.$v['attr_id']]);
        }
        if ($mode == 1) return $list_attr;
        return array('status' => 1, 'msg' => '', 'result' => $list_attr);
    }

    /**
     * 获取某个商品的评论统计
     * c0:全部评论数  c1:好评数 c2:中评数  c3差评数
     * rate1:好评率 rate2:中评率  c3差评率
     * @param $goods_id
     * @return array
     */
    public function commentStatistics($goods_id)
    {
        $commentWhere = ['is_show'=>1,'goods_id'=>$goods_id,'parent_id'=>0,'user_id'=>['gt',0]];
        $c1 = M('comment')->where($commentWhere)->where('ceil((deliver_rank + goods_rank + service_rank) / 3) in (4,5)')->count();
        $c2 = M('comment')->where($commentWhere)->where('ceil((deliver_rank + goods_rank + service_rank) / 3) in (3)')->count();
        $c3 = M('comment')->where($commentWhere)->where('ceil((deliver_rank + goods_rank + service_rank) / 3) in (0,1,2)')->count();
        $c4 = M('comment')->where($commentWhere)->where("img !='' and img NOT LIKE 'N;%'")->count(); // 晒图
        $c0 = $c1 + $c2 + $c3; // 所有评论
        if($c0 <= 0){
            $rate1 = 100;
            $rate2 = 0;
            $rate3 = 0;
        }else{
            $rate1 = ceil($c1 / $c0 * 100); // 好评率
            $rate2 = ceil($c2 / $c0 * 100); // 中评率
            $rate3 = ceil($c3 / $c0 * 100); // 差评率
        }
        return array('c0' => $c0, 'c1' => $c1, 'c2' => $c2, 'c3' => $c3, 'c4'=>$c4,'rate1' => $rate1, 'rate2' => $rate2, 'rate3' => $rate3);
    }

    /**
     * 商品收藏
     * @param $user_id|用户id
     * @param $goods_id|商品id
     * @return array
     */
    public function collect_goods($user_id, $goods_id)
    {
        if (!is_numeric($user_id) || $user_id <= 0) return array('status' => -1, 'msg' => '必须登录后才能收藏', 'result' => array());
        $count = M('GoodsCollect')->where("user_id",$user_id)->where("goods_id", $goods_id)->count();
        if ($count > 0) return array('status' => -3, 'msg' => '商品已收藏', 'result' => array());
        M('GoodsCollect')->add(array('goods_id' => $goods_id, 'user_id' => $user_id, 'add_time' => time()));
        return array('status' => 1, 'msg' => '收藏成功!请到个人中心查看', 'result' => array());
    }
    /**
     * 获取商品规格
     * @param $goods_id|商品id
     * @return array
     */
    public function get_spec($goods_id)
    {
        //商品规格 价钱 库存表 找出 所有 规格项id
        $keys = M('SpecGoodsPrice')->where("goods_id", $goods_id)->getField("GROUP_CONCAT(`key` ORDER BY store_count desc SEPARATOR '_') ");
        $filter_spec = array();
        if ($keys) {
            $specImage = M('SpecImage')->where(['goods_id'=>$goods_id,'src'=>['<>','']])->getField("spec_image_id,src");// 规格对应的 图片表， 例如颜色
            $keys = str_replace('_', ',', $keys);
            $sql = "SELECT a.name,a.order,b.* FROM __PREFIX__spec AS a INNER JOIN __PREFIX__spec_item AS b ON a.id = b.spec_id WHERE b.id IN($keys) ORDER BY b.id";
            $filter_spec2 = \think\Db::query($sql);
            foreach ($filter_spec2 as $key => $val) {
                $filter_spec[$val['name']][] = array(
                    'item_id' => $val['id'],
                    'item' => $val['item'],
                    'src' => $specImage[$val['id']],
                );
            }
        }
        return $filter_spec;
    }

    /**
     * 获取相关分类
     * @param $cat_id|分类id
     * @return array|false|mixed|\PDOStatement|string|\think\Collection
     */
    public function get_siblings_cate($cat_id)
    {
        if (empty($cat_id))
            return array();
        $cate_info = M('goods_category')->where("id", $cat_id)->find();
        $siblings_cate = M('goods_category')->where(['id'=>['<>',$cat_id],'parent_id'=>$cate_info['parent_id']])->select();
        return empty($siblings_cate) ? array() : $siblings_cate;
    }

    /**
     * 看了又看
     */
    public function get_look_see($goods)
    {
        return M('goods')->where(['goods_id'=>['<>',$goods['goods_id']],'cat_id'=>['<>',$goods['cat_id']],'is_on_sale'=>1])->limit(12)->select();
    }


    /**
     * 筛选的价格期间
     * @param $goods_id_arr|帅选的分类id
     * @param $filter_param
     * @param $action
     * @param int $c 分几段 默认分5 段
     * @return array
     */
    function get_filter_price($goods_id_arr, $filter_param, $action, $c = 5)
    {

        if (!empty($filter_param['price']))
            return array();

        $goods_id_str = implode(',', $goods_id_arr);
        $goods_id_str = $goods_id_str ? $goods_id_str : '0';
        $priceList = M('goods')->where("goods_id", "in", $goods_id_str)->getField('shop_price', true);  //where("goods_id in($goods_id_str)")->select();
        rsort($priceList);
        $max_price = (int)$priceList[0];

        $psize = ceil($max_price / $c); // 每一段累积的价钱
        $parr = array();
        for ($i = 0; $i < $c; $i++) {
            $start = $i * $psize;
            $end = $start + $psize;

            // 如果没有这个价格范围的商品则不列出来
            $in = false;
            foreach ($priceList as $k => $v) {
                if ($v > $start && $v < $end)
                    $in = true;
            }
            if ($in == false)
                continue;

            $filter_param['price'] = "{$start}-{$end}";
            if ($i == 0)
                $parr[] = array('value' => "{$end}元以下", 'href' => urldecode(U("Goods/$action", $filter_param, '')));
            elseif($i == ($c-1) && ($max_price > $end))
                $parr[] = array('value' => "{$end}元以上", 'href' => urldecode(U("Goods/$action", $filter_param, '')));
            else
                $parr[] = array('value' => "{$start}-{$end}元", 'href' => urldecode(U("Goods/$action", $filter_param, '')));
        }
        return $parr;
    }

    /**
     * 筛选条件菜单
     * @param $filter_param
     * @param $action
     * @return array
     */
    function get_filter_menu($filter_param, $action)
    {
        $menu_list = array();
        // 品牌
        if (!empty($filter_param['brand_id'])) {
            $brand_list = M('brand')->getField('id,name');
            $brand_id = explode('_', $filter_param['brand_id']);
            $brand['text'] = "品牌:";
            foreach ($brand_id as $k => $v) {
                $brand['text'] .= $brand_list[$v] . ',';
            }
            $brand['text'] = substr($brand['text'], 0, -1);
            $tmp = $filter_param;
            unset($tmp['brand_id']); // 当前的参数不再带入
            $brand['href'] = urldecode(U("Goods/$action", $tmp, ''));
            $menu_list[] = $brand;
        }
        // 规格
        if (!empty($filter_param['spec'])) {
            $spec = M('spec')->getField('id,name');
            $spec_item = M('spec_item')->getField('id,item');
            $spec_group = explode('@', $filter_param['spec']);
            foreach ($spec_group as $k => $v) {
                $spec_group2 = explode('_', $v);
                $spec_menu['text'] = $spec[$spec_group2[0]] . ':';
                array_shift($spec_group2); // 弹出第一个规格名称
                foreach ($spec_group2 as $k2 => $v2) {
                    $spec_menu['text'] .= $spec_item[$v2] . ',';
                }
                $spec_menu['text'] = substr($spec_menu['text'], 0, -1);

                $tmp = $spec_group;
                $tmp2 = $filter_param;
                unset($tmp[$k]);
                $tmp2['spec'] = implode('@', $tmp); // 当前的参数不再带入
                $spec_menu['href'] = urldecode(U("Goods/$action", $tmp2, ''));
                $menu_list[] = $spec_menu;
            }
        }
        // 属性
        if (!empty($filter_param['attr'])) {
            $goods_attribute = M('goods_attribute')->getField('attr_id,attr_name');
            $attr_group = explode('@', $filter_param['attr']);
            foreach ($attr_group as $k => $v) {
                $attr_group2 = explode('_', $v);
                $attr_menu['text'] = $goods_attribute[$attr_group2[0]] . ':';
                array_shift($attr_group2); // 弹出第一个规格名称
                foreach ($attr_group2 as $k2 => $v2) {
                    $attr_menu['text'] .= $v2 . ',';
                }
                $attr_menu['text'] = substr($attr_menu['text'], 0, -1);

                $tmp = $attr_group;
                $tmp2 = $filter_param;
                unset($tmp[$k]);
                $tmp2['attr'] = implode('@', $tmp); // 当前的参数不再带入
                $attr_menu['href'] = urldecode(U("Goods/$action", $tmp2, ''));
                $menu_list[] = $attr_menu;
            }
        }
        // 价格
        if (!empty($filter_param['price'])) {
            $price_menu['text'] = "价格:" . $filter_param['price'];
            unset($filter_param['price']);
            $price_menu['href'] = urldecode(U("Goods/$action", $filter_param, ''));
            $menu_list[] = $price_menu;
        }

        return $menu_list;
    }

    /**
     * 传入当前分类 如果当前是 2级 找一级
     * 如果当前是 3级 找2 级 和 一级
     * @param  $goodsCate
     */
    function get_goods_cate(&$goodsCate)
    {
        if (empty($goodsCate)) return array();
        $cateAll = get_goods_category_tree();
        if ($goodsCate['level'] == 1) {
            $cateArr = $cateAll[$goodsCate['id']]['tmenu'];
            $goodsCate['parent_name'] = $goodsCate['name'];
            $goodsCate['select_id'] = 0;
        } elseif ($goodsCate['level'] == 2) {
            $cateArr = $cateAll[$goodsCate['parent_id']]['tmenu'];
            $goodsCate['parent_name'] = $cateAll[$goodsCate['parent_id']]['name'];//顶级分类名称
            $goodsCate['open_id'] = $goodsCate['id'];//默认展开分类
            $goodsCate['select_id'] = 0;
        } else {
            $parent = M('GoodsCategory')->where("id", $goodsCate['parent_id'])->order('`sort_order` desc')->find();//父类
            $cateArr = $cateAll[$parent['parent_id']]['tmenu'];
            $goodsCate['parent_name'] = $cateAll[$parent['parent_id']]['name'];//顶级分类名称
            $goodsCate['open_id'] = $parent['id'];
            $goodsCate['select_id'] = $goodsCate['id'];//默认选中分类
        }
        return $cateArr;
    }

    /**
     * @param  $brand_id|帅选品牌id
     * @param  $price|帅选价格
     * @return array|mixed
     */
    function getGoodsIdByBrandPrice($brand_id, $price)
    {
        if (empty($brand_id) && empty($price))
            return array();
        $brand_select_goods=$price_select_goods=array();
        if ($brand_id) // 品牌查询
        {
            $brand_id_arr = explode('_', $brand_id);
            $brand_select_goods = M('goods')->whereIn('brand_id',$brand_id_arr,'or')->getField('goods_id', true);
        }
        if ($price)// 价格查询
        {
            $price = explode('-', $price);
            $price[0] = intval($price[0]);
            $price[1] = intval($price[1]);
            $price_where=" shop_price >= $price[0] and shop_price <= $price[1] ";
            $price_select_goods = M('goods')->where($price_where)->getField('goods_id', true);
        }
        if($brand_select_goods && $price_select_goods)
            $arr = array_intersect($brand_select_goods,$price_select_goods);
        else
            $arr = array_merge($brand_select_goods,$price_select_goods);
        return $arr ? $arr : array();
    }

    /**
     * 根据规格 查找 商品id
     * @param $spec|规格
     * @return array|\type
     */
    function getGoodsIdBySpec($spec)
    {
        if (empty($spec))
            return array();

        $spec_group = explode('@', $spec);
        $where = " where 1=1 ";
        foreach ($spec_group as $k => $v) {
            $spec_group2 = explode('_', $v);
            array_shift($spec_group2);
            $like = array();
            foreach ($spec_group2 as $k2 => $v2) {
                $v2 = addslashes($v2);
                $like[] = " key2  like '%\_$v2\_%' ";
            }
            $where .= " and (" . implode('or', $like) . ") ";
        }
        $sql = "select * from (select *,concat('_',`key`,'_') as key2 from __PREFIX__spec_goods_price as a) b  $where";
        $result = Db::query($sql);
        $arr = get_arr_column($result, 'goods_id');  // 只获取商品id 那一列
        return ($arr ? $arr : array_unique($arr));
    }

    /**
     * @param $attr|属性
     * @return array|mixed
     * 根据属性 查找 商品id
     * 59_直板_翻盖
     * 80_BT4.0_BT4.1
     */
    function getGoodsIdByAttr($attr)
    {
        if (empty($attr))
            return array();

        $attr_group = explode('@', $attr);
        $attr_id = $attr_value = array();
        foreach ($attr_group as $k => $v) {
            $attr_group2 = explode('_', $v);
            $attr_id[] = array_shift($attr_group2);
            $attr_value = array_merge($attr_value, $attr_group2);
        }
        $c = count($attr_id) - 1;
        if ($c > 0) {
            $arr = Db::name('goods_attr')
                ->where(['attr_id'=>['in',$attr_id],'attr_value'=>['in',$attr_value]])
                ->group('goods_id')
                ->having("count(goods_id) > $c")
                ->getField("goods_id", true);
        }else{
            $arr = M('goods_attr')
                ->where(['attr_id'=>['in',$attr_id],'attr_value'=>['in',$attr_value]])
                ->getField("goods_id", true); // 如果只有一个条件不再进行分组查询
        }
        return ($arr ? $arr : array_unique($arr));
    }

    /**
     * 获取地址
     * @return array
     */
    function getRegionList()
    {
        $res = S('getRegionList');
        if(!empty($res))
            return $res;
        $parent_region = M('region')->field('id,name')->where(array('level'=>1))->cache(true)->select();
        $ip_location = array();
        $city_location = array();
        foreach($parent_region as $key=>$val){
            $c = M('region')->field('id,name')->where(array('parent_id'=>$parent_region[$key]['id']))->order('id asc')->cache(true)->select();
            $ip_location[$parent_region[$key]['name']] = array('id'=>$parent_region[$key]['id'],'root'=>0,'djd'=>1,'c'=>$c[0]['id']);
            $city_location[$parent_region[$key]['id']] = $c;
        }
        $res = array(
            'ip_location'=>$ip_location,
            'city_location'=>$city_location
        );
        S('getRegionList',$res);
        return $res;
    }

    /**
     * 寻找Region_id的父级id
     * @param $cid
     * @return array
     */
    function getParentRegionList($cid){
        //$pids = '';
        $pids = array();
        $parent_id =  M('region')->where(array('id'=>$cid))->getField('parent_id');
        if($parent_id != 0){
            //$pids .= $parent_id;
            array_push($pids,$parent_id);
            $npids = $this->getParentRegionList($parent_id);
            if(!empty($npids)){
                //$pids .= ','.$npids;
                $pids = array_merge($pids,$npids);
            }

        }
        return $pids;
    }

    /**
     * 商品物流配送和运费
     * @param $goods_id
     * @param $region_id
     * @return array
     */
    function getGoodsDispatching($goods_id,$region_id)
    {
        $return_data = array('status'=>1,'msg'=>'');
        $goods = M('goods')->where(array('goods_id'=>$goods_id))->find();
        //检查商品是否包邮
        if($goods['is_free_shipping']){
            $return_data['msg'] = '可配送';
            $return_data['result'] = array(array('shipping_name'=>'包邮','freight'=>0));
            return $return_data;
        }
        $parent_region_id = $this->getParentRegionList($region_id);
        $goodsLogic = new GoodsLogic();
        //商品没有配置物流，使用物流配置里的默认物流
        if(empty($goods['shipping_area_ids'])){
            $plugin_goods_shipping = M('plugin')->where(array('type'=>'shipping'))->select();
            $goods_shipping = array();
            foreach($plugin_goods_shipping as $k=>$v){
                $goods_shipping[$k]['freight'] = $goodsLogic->getFreight($plugin_goods_shipping[$k]['code'],$parent_region_id[0],$parent_region_id[1],$region_id,$goods['weight']);//默认全国
                $goods_shipping[$k]['shipping_name'] = $plugin_goods_shipping[$k]['name'];
            }
            $return_data['msg'] = '可配送';
            $return_data['result'] = $goods_shipping;
            return $return_data;
        }
        //查找地区$region_id的所有父类，与地区地址表进行匹配
        $goods_shipping_area_id_array = explode(',',$goods['shipping_area_ids']);
        array_push($parent_region_id,(string)$region_id);//把region_id和它全部父级存起来
        $find_shipping_area_id = M('area_region')->where(array('region_id'=>array('in',$parent_region_id)))->group('shipping_area_id')->getField('shipping_area_id',true);
        $shipping_area_id_array =array();
        foreach($find_shipping_area_id as $key=>$val){
            if(in_array($find_shipping_area_id[$key],$goods_shipping_area_id_array)){
                array_push($shipping_area_id_array,$find_shipping_area_id[$key]);
            }
        }
        //没有匹配到，就使用商品配置的物流id去物流地址表去查找
        if(count($shipping_area_id_array) == 0){
            $goods_shipping = M('shipping_area')->where(array('shipping_area_id'=>array('in',$goods_shipping_area_id_array),'is_default'=>1))->select();
            //查询到就返回物流信息和运费，没有返回无货
            if(!empty($goods_shipping)){
                foreach($goods_shipping as $k=>$v){
                    $goods_shipping[$k]['freight'] = $goodsLogic->getFreight($goods_shipping[$k]['shipping_code'],$parent_region_id[0],$parent_region_id[1],$region_id,$goods['weight']);
                    $goods_shipping[$k]['shipping_name'] = M('plugin')->where(array('type'=>'shipping','code'=>$goods_shipping[$k]['shipping_code']))->getField('name');
                }
                $return_data['msg'] = '可配送';
                $return_data['result'] = $goods_shipping;
                return $return_data;
            }else{
                $return_data['status'] = -1;
                $return_data['msg'] = '该地区不支持配送';
                return $return_data;
            }
        }
        //匹配到就返回物流信息和运费
        $goods_shipping = M('area_region')
            ->alias('ar')
            ->join('__SHIPPING_AREA__ sa','sa.shipping_area_id = ar.shipping_area_id','INNER')
            ->where(array('ar.shipping_area_id'=>array('in',$shipping_area_id_array)))
            ->group('sa.shipping_code')
            ->select();
        //没匹配到就返回无货
        if(empty($goods_shipping)){
            $return_data['status'] = -1;
            $return_data['msg'] = '该地区不支持配送';
            return $return_data;
        }
        foreach($goods_shipping as $k=>$v){
            $goods_shipping[$k]['freight'] = $goodsLogic->getFreight($goods_shipping[$k]['shipping_code'],0,0,$goods_shipping[$k]['region_id'],$goods['weight']);
            $goods_shipping[$k]['shipping_name'] = M('plugin')->where(array('type'=>'shipping','code'=>$goods_shipping[$k]['shipping_code']))->getField('name');
        }
        $return_data = array(
            'status'=>1,
            'msg'=>'可配送',
            'result'=>$goods_shipping
        );
        return $return_data;
    }


    /**
     *网站自营,入驻商家,货到付款,仅看有货,促销商品
     * @param $sel|筛选条件
     * @param array $cat_id|分类ID
     * @return mixed
     */
    function getFilterSelected($sel ,$cat_id = array(1)){
        $where = " 1 = 1 ";
        $Goods = M('goods')->where("cat_id" ,"in" ,implode(',', $cat_id));
        //查看全部
        if($sel == 'selall'){
            $where .= '';
        }
        //促销商品
        if($sel == 'prom_type'){
            $where .= ' and prom_type = 3';
        }
        //看有货
        if($sel == 'store_count'){
            $where .= ' and store_count > 0';
        }
        //看包邮
        if($sel == 'free_post'){
            $where .= ' and is_free_shipping=1';
        }
        //看全部
        if($sel == 'all'){
            $arrid = $Goods->getField('goods_id', true);
        }else{
            $arrid = $Goods->where($where)->getField('goods_id', true);
        }
        return $arrid;
    }

    /**
     * 用户浏览记录
     * @author lxl
     * @time  17-4-20
     */
    public function add_visit_log($user_id,$goods){
        $record = M('goods_visit')->where(array('user_id'=>$user_id,'goods_id'=>$goods['goods_id']))->find();
        if($record){
            M('goods_visit')->where(array('user_id'=>$user_id,'goods_id'=>$goods['goods_id']))->save(array('visittime'=>time()));
        }else{
            $visit = array('user_id'=>$user_id,'goods_id'=>$goods['goods_id'],'visittime'=>time(),'cat_id'=>$goods['cat_id'],'extend_cat_id'=>$goods['extend_cat_id']);
            M('goods_visit')->add($visit);
        }
    }

    /**
     * 在有价格阶梯的情况下，根据商品数量，获取商品价格
     * @param $goods_num|购买的商品数
     * @param $goods_price|商品默认单价
     * @param $price_ladder|价格阶梯数组
     * @return mixed
     */
    public function getGoodsPriceByLadder($goods_num, $goods_price, $price_ladder)
    {
        $price_ladder = array_values(array_sort($price_ladder,'amount','asc'));
        $price_ladder_count = count($price_ladder);
        for ($i = 0; $i < $price_ladder_count; $i++) {
            if($i == 0 && $goods_num < $price_ladder[$i]['amount']){
                return $goods_price;
            }
            if($goods_num >= $price_ladder[$i]['amount'] && $goods_num < $price_ladder[$i+1]['amount']){
                return $price_ladder[$i]['price'];
            }
            if($i == ($price_ladder_count - 1)){
                return $price_ladder[$i]['price'];
            }
        }
    }

    /**
     * 计算根据商品重量计算物流运费
     * @param  $shipping_code|物流 编号
     * @param  $province|省份
     * @param  $city|市
     * @param  $district|区
     * @param  $weight|重量
     * @return int
     */
    public function getFreight($shipping_code, $province, $city, $district, $weight)
    {

        if ($weight == 0) return 0; // 商品没有重量
        if ($shipping_code == '') return 0;

        // 先根据 镇 县 区找 shipping_area_id
        if ($district != 0) {
            $shipping_area_id = M('AreaRegion')->where("shipping_area_id in (select shipping_area_id from  " . C('database.prefix') . "shipping_area where shipping_code = :shipping_code) and region_id = :region_id")->bind(['shipping_code'=>$shipping_code,'region_id'=>$district])->getField('shipping_area_id');
        }

        // 先根据市区找 shipping_area_id
        if ($shipping_area_id == false && $city != 0) {
            $shipping_area_id = M('AreaRegion')->where("shipping_area_id in (select shipping_area_id from  " . C('database.prefix') . "shipping_area where shipping_code = :shipping_code) and region_id = :region_id")->bind(['shipping_code'=>$shipping_code,'region_id'=>$city])->getField('shipping_area_id');
        }

        // 市区找不到 根据省份找shipping_area_id
        if ($shipping_area_id == false && $province != 0) {
            $shipping_area_id = M('AreaRegion')->where("shipping_area_id in (select shipping_area_id from  " . C('database.prefix') . "shipping_area where shipping_code = :shipping_code) and region_id = :region_id")->bind(['shipping_code'=>$shipping_code,'region_id'=>$province])->getField('shipping_area_id');
        }

        // 省份找不到 找默认配置全国的物流费
        if ($shipping_area_id == false) {
            // 如果市和省份都没查到, 就查询 tp_shipping_area 表 is_default = 1 的  表示全国的  select * from `tp_plugin`  select * from  `tp_shipping_area` select * from  `tp_area_region`
            $shipping_area_id = M("ShippingArea")->where(['shipping_code'=>$shipping_code,'is_default'=>1])->getField('shipping_area_id');
        }

        if ($shipping_area_id == false) {
            return 0;
        }

        /// 找到了 shipping_area_id  找config
        $shipping_config = M('ShippingArea')->where("shipping_area_id", $shipping_area_id)->getField('config');
        $shipping_config = unserialize($shipping_config);
        $shipping_config['money'] = $shipping_config['money'] ? $shipping_config['money'] : 0;

        // 1000 克以内的 只算个首重费
        if ($weight < $shipping_config['first_weight']) {
            return $shipping_config['money'];
        }
        // 超过 1000 克的计算方法
        $weight = $weight - $shipping_config['first_weight']; // 续重
        $weight = ceil($weight / $shipping_config['second_weight']); // 续重不够取整
        $freight = $shipping_config['money'] + $weight * $shipping_config['add_money']; // 首重 + 续重 * 续重费

        return $freight;
    }

    /**
     * 是否收藏商品
     * @param type $user_id
     * @param type $goods_id
     * @return type
     */
    public function isCollectGoods($user_id, $goods_id)
    {
        $collect = M('goods_collect')->where(['user_id' => $user_id, 'goods_id' => $goods_id])->find();
        return $collect ? 1 : 0;
    }
    /**
     * 获取促销商品数据
     * @return mixed
     */
    public function getPromotionGoods()
    {
        $goods_where = array('g.is_on_sale' => 1);
        $promotion_goods = M('goods')
            ->alias('g')
            ->field('g.goods_id,g.goods_name,f.price AS shop_price,f.end_time')
            ->join('__FLASH_SALE__ f','g.goods_id = f.goods_id')
            ->where($goods_where)
            ->limit(3)
            ->select();
        return $promotion_goods;
    }

    /**
     * 获取精品商品数据
     * @return mixed
     */
    public function getRecommendGoods($p = 1)
    {
        $goods_where = array('is_recommend' => 1, 'is_on_sale' => 1);
//        $goods_where['goods_name'] = array("exp", " NOT REGEXP '华为|荣耀|小米|合约机|三星|魅族' ");//临时屏蔽,苹果APP审核过了之后注释
        $favourite_goods = M('goods')
            ->field('goods_id,goods_name,shop_price,cat_id')
            ->where($goods_where)
            ->order('sort DESC')
            ->page($p, 10)
            ->cache(true, 3600)
            ->select();
        return $favourite_goods;
    }

    /**
     * 获取新品商品数据
     * @return mixed
     */
    public function getNewGoods()
    {
        $goods_where = array('is_new' => 1,  'is_on_sale' => 1);
        $orderBy = array('sort' => 'desc');
        $new_goods = M('goods')
            ->field('goods_id,goods_name,shop_price')
            ->where($goods_where)
            ->order($orderBy)
            ->limit(9)
            ->select();
        return $new_goods;
    }

    /**
     * 获取热销商品数据
     * @return mixed
     */
    public function getHotGood($is_brand = 0)
    {
        $goods_where = array('is_hot' => 1,  'is_on_sale' => 1);
        if ($is_brand) {
            $goods_where['brand_id'] = ['<>', 0];
        }
        $orderBy = array('sort' => 'desc');
        $new_goods = M('goods')
            ->field('goods_id,goods_name,shop_price,market_price,is_virtual')
            ->where($goods_where)
            ->order($orderBy)
            ->limit(9)
            ->select();
        return $new_goods;
    }

    /**
     * 获取首页轮播图片
     * @return mixed
     */
    public function getHomeAdv()
    {
        $start_time = strtotime(date('Y-m-d H:00:00'));
        $end_time = strtotime(date('Y-m-d H:00:00'));
        $adv = M("ad")->field(array('ad_link','ad_name','ad_code'))
        ->where("pid=9 and enabled=1 and start_time< $start_time and end_time > $end_time")
        ->order("orderby desc")->cache(true,3600)
        ->limit(5)->select(); 
        //广告地址转换
        foreach($adv as $k=>$v){
            if(!strstr($v['ad_link'],'http')){
                $adv[$k]['ad_link'] = SITE_URL.$v['ad_link'];
            }
            $adv[$k]['ad_code'] = SITE_URL.$v['ad_code'];
        }
        return $adv;
    }
    
    /**
     * 获取首页轮播图片
     * @return mixed
     */
    public function getAppHomeAdv($isBanner=true)
    {
        $start_time = strtotime(date('Y-m-d H:00:00'));
        $end_time = strtotime(date('Y-m-d H:00:00'));
        if($isBanner){
            $where = array("pid"=>500);
        }else{
            $where = "pid > 500 AND pid < 520";
        }
    
        $adv = M("ad")->field(array('ad_link','ad_name','ad_code','media_type,pid'))
        ->where(" enabled=1 and start_time< $start_time and end_time > $end_time")->where($where)
        ->order("orderby desc")//->fetchSql(true)//->cache(true,3600)
        ->limit(20)->select();
         
        return $adv;
    }
    
    /**
     * 获取秒杀商品
     * @return mixed
     */
    public function getFlashSaleGoods($count, $page = 1, $start_time=0, $end_time=0)
    {
        //$where['f.status'] = 1;
        $where['f.start_time'] = array('egt', $start_time ?: time());
        if ($end_time) {
            $where['f.end_time'] = array('elt',$end_time);
        }

        $flash_sale_goods = M('flash_sale')->alias('f')
            ->field('f.end_time,f.goods_name,f.price,f.goods_id,f.price,g.shop_price,f.item_id,100*(FORMAT(f.buy_num/f.goods_num,2)) as percent')
            ->join('__GOODS__ g','g.goods_id = f.goods_id')
            ->where($where)
            //->order('f.start_time', 'asc')
            ->page($page, $count)
            ->select();
        return $flash_sale_goods;
    }
    
     /**
     * 找相似
     */
    public function getSimilar($goods_id, $p, $count)
    {
        $goods = M('goods')->field('cat_id')->where('goods_id', $goods_id)->find();
        if (empty($goods)) {
            return [];
        }

        $where = ['goods_id' => ['<>', $goods_id], 'cat_id' => $goods['cat_id']];
    	$goods_list = M('goods')->field("goods_id,goods_name,shop_price,is_virtual")
                ->where($where)->page($p, $count)->select();

    	return $goods_list;
    }
    
    /**
     * 积分商城
     */
    public function integralMall($rank, $user_id, $p = 1)
    {
        $ranktype = '';
        if ($rank == 'num') {
            $ranktype = 'sales_sum';//以兑换量（购买量）排序
        } elseif ($rank == 'integral') {
            $ranktype = 'exchange_integral';//以需要积分排序
        }
        
        $point_rate = tpCache('shopping.point_rate');
        $goods_where['is_on_sale'] = 1;//是否上架
        $goods_where['is_virtual'] = 0;//是否虚拟商品
        //积分兑换筛选
        $exchange_integral_where_array = array(array('gt',0));
        //我能兑换
        if ($rank == 'exchange' && !empty($user_id)) {
            //获取用户积分
            $user_pay_points = intval(M('users')->where(array('user_id' => $user_id))->getField('pay_points'));
            if ($user_pay_points !== false) {
                array_push($exchange_integral_where_array, array('lt', $user_pay_points));
            }
        }
        $goods_where['exchange_integral'] =  $exchange_integral_where_array;  //拼装条件
        $goods_list_count = M('goods')->where($goods_where)->count();   //总数
        $goods_list = M('goods')->field('goods_id,goods_name,shop_price,market_price,exchange_integral,is_virtual')
                ->where($goods_where)->order($ranktype ,'desc')->page($p, 15)->select();
        
        $result = [
            'goods_list' => $goods_list,
            'goods_list_count' => $goods_list_count,
            'point_rate' => $point_rate,
        ];
        
        return $result;
    }
    
    /**
     *  获取排好序的品牌列表
     */
    function getSortBrands()
    {
        $brandList =  M("Brand")->select();
        $brandIdArr =  M("Brand")->where("name in (select `name` from `".C('database.prefix')."brand` group by name having COUNT(id) > 1)")->getField('id,cat_id');
        $goodsCategoryArr = M('goodsCategory')->where("level = 1")->getField('id,name');
        $nameList = array();
        foreach($brandList as $k => $v)
        {

            $name = getFirstCharter($v['name']) .'  --   '. $v['name']; // 前面加上拼音首字母

            if(array_key_exists($v[id],$brandIdArr) && $v['cat_id']) { // 如果有双重品牌的 则加上分类名称
                $name .= ' ( '. $goodsCategoryArr[$v['cat_id']] . ' ) ';
            }
            $nameList[] = $v['name'] = $name;
            $brandList[$k] = $v;
        }
        array_multisort($nameList,SORT_STRING,SORT_ASC,$brandList);

        return $brandList;
    }
    
    /**
     * 获取活动简要信息
     * @param array $goods
     * @param FlashSaleLogic|GroupBuyLogic|PromGoodsLogic $goodsPromLogic
     * @return array
     */
    public function getActivitySimpleInfo($goods, $goodsPromLogic)
    {
        //1.商品促销
        $activity = $this->getGoodsPromSimpleInfo($goods, $goodsPromLogic);
    
        //2.订单促销
        $activity_order = $this->getOrderPromSimpleInfo($goods);
    
        //3.数据合并
        if ($activity['data'] || $activity_order) {
            empty($activity['data']) && $activity['data'] = [];
            $activity['data'] = array_merge($activity['data'], $activity_order);
        }
    
        $activity['server_current_time'] = time();//服务器时间
        return $activity;
    }
    
    /**
     * 获取商品促销简单信息
     * @param array $goods
     * @param FlashSaleLogic|GroupBuyLogic|PromGoodsLogic $goodsPromLogic
     * @return array
     */
    public function getGoodsPromSimpleInfo($goods, $goodsPromLogic)
    {
        //prom_type: 0默认 1抢购 2团购 3优惠促销 4预售(不考虑)
        $activity['prom_type'] = 0;
    
        $goodsPromFactory = new \app\common\logic\GoodsPromFactory;
        if (!$goodsPromFactory->checkPromType($goods['prom_type'])
            || !$goodsPromLogic || !$goodsPromLogic->checkActivityIsAble()) {
                return $activity;
            }
    
            // 1抢购 2团购
            $prom = $goodsPromLogic->getPromModel()->getData();
            if (in_array($goods['prom_type'], [1, 2])) {
                $info = $goodsPromLogic->getActivityGoodsInfo();
                $activity = [
                    'prom_type' => $goods['prom_type'],
                    'prom_price' => $prom['price'],
                    'prom_start_time' => $prom['start_time'],
                    'prom_end_time' => $prom['end_time'],
                    'prom_store_count' => $info['store_count'],
                    'virtual_num' => $info['virtual_num']
                ];
                return $activity;
            }
    
            // 3优惠促销
            // type:0直接打折,1减价优惠,2固定金额出售,3买就赠优惠券
            if ($prom['type'] == 0) {
                $activityData[] = ['title' => '折扣', 'content' => "指定商品立打{$prom['expression']}折"];
            } elseif ($prom['type'] == 1) {
                $activityData[] = ['title' => '直减', 'content' => "指定商品立减{$prom['expression']}元"];
            } elseif ($prom['type'] == 2) {
                $activityData[] = ['title' => '促销', 'content' => "促销价{$prom['expression']}元"];
            } elseif ($prom['type'] == 3) {
                $couponLogic = new \app\common\logic\CouponLogic;
                $money = $couponLogic->getSendValidCouponMoney($prom['expression'], $goods['goods_id'], $goods['store_id'], $goods['cat_id']);
                if ($money !== false) {
                    $activityData[] = ['title' => '送券', 'content' => "买就送代金券{$money}元"];
                }
            }
            if ($activityData) {
                $activityInfo = $goodsPromLogic->getActivityGoodsInfo();
                $activity = [
                    'prom_type' => $goods['prom_type'],
                    'prom_price' => $activityInfo['shop_price'],
                    'prom_start_time' => $prom['start_time'],
                    'prom_end_time' => $prom['end_time'],
                    'data' => $activityData
                ];
            }
    
            return $activity;
    }
    
    /**
     * 获取
     * @param type $user_level
     * @param type $cur_time
     * @param type $goods
     * @return string|array
     */
    public function getOrderPromSimpleInfo($goods)
    {
        $cur_time = time();
       
        $data = [];
        $po = M('prom_order')->where(['start_time' => ['<=', $cur_time], 'end_time' => ['>', $cur_time], 'is_close' => 0])->select();
        if (!empty($po)) {
            foreach ($po as $p) {
                //type:0满额打折,1满额优惠金额,2满额送积分,3满额送优惠券
                if ($p['type'] == 0) {
                    $data[] = ['title' => '折扣', 'content' => "满{$p['money']}元打{$p['expression']}折"];
                } elseif ($p['type'] == 1) {
                    $data[] = ['title' => '优惠', 'content' => "满{$p['money']}元优惠{$p['expression']}元"];
                } elseif ($p['type'] == 2) {
                    //积分暂不支持?
                } elseif ($p['type'] == 3) {
                    $couponLogic = new \app\common\logic\CouponLogic;
                    $money = $couponLogic->getSendValidCouponMoney($p['expression'], $goods['goods_id'],  $goods['cat_id']);
                    if ($money !== false) {
                        $data[] = ['title' => '送券', 'content' => "满{$p['money']}元送{$money}元优惠券"];
                    }
                }
            }
        }
    
        return $data;
    }

    /**
     *  获取排好序的分类列表
     */
    function getSortCategory()
    {
        $categoryList =  M("GoodsCategory")->getField('id,name,parent_id,level');
        $nameList = array();
        foreach($categoryList as $k => $v)
        {

            //$str_pad = str_pad('',($v[level] * 5),'-',STR_PAD_LEFT);
            $name = getFirstCharter($v['name']) .' '. $v['name']; // 前面加上拼音首字母
            //$name = getFirstCharter($v['name']) .' '. $v['name'].' '.$v['level']; // 前面加上拼音首字母
            /*
            // 找他老爸
            $parent_id = $v['parent_id'];
            if($parent_id)
                $name .= '--'.$categoryList[$parent_id]['name'];
            // 找他 爷爷
            $parent_id = $categoryList[$v['parent_id']]['parent_id'];
            if($parent_id)
                $name .= '--'.$categoryList[$parent_id]['name'];
            */
            $nameList[] = $v['name'] = $name;
            $categoryList[$k] = $v;
        }
        array_multisort($nameList,SORT_STRING,SORT_ASC,$categoryList);

        return $categoryList;
    }
}