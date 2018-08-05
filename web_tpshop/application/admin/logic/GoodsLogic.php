<?php
/**
 * tpshop
 * ============================================================================
 * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * Author: IT宇宙人
 * Date: 2015-09-09
 */

namespace app\admin\logic;

use think\Model;
use think\db;
/**
 * 分类逻辑定义
 * Class CatsLogic
 * @package Home\Logic
 */
class GoodsLogic extends Model
{

    /**
     * 获得指定分类下的子分类的数组     
     * @access  public
     * @param   int     $cat_id     分类的ID
     * @param   int     $selected   当前选中分类的ID
     * @param   boolean $re_type    返回的类型: 值为真时返回下拉列表,否则返回数组
     * @param   int     $level      限定返回的级数。为0时返回所有级数
     * @return  mix
     */
    public function goods_cat_list($cat_id = 0, $selected = 0, $re_type = true, $level = 0)
    {
                global $goods_category, $goods_category2;                
                $sql = "SELECT * FROM  __PREFIX__goods_category ORDER BY parent_id , sort_order ASC";
                $goods_category = DB::query($sql);
                $goods_category = convert_arr_key($goods_category, 'id');
                
                foreach ($goods_category AS $key => $value)
                {
                    if($value['level'] == 1)
                        $this->get_cat_tree($value['id']);                                
                }
                /*
                foreach ($goods_category2 AS $key => $value)
                {
                        $strpad_count = $value['level']*10;
                        echo str_pad('',$strpad_count,"-",STR_PAD_LEFT);             
                        echo $value['name'];
                        echo "<br/>";
                }*/
                return $goods_category2;               
    }
    
    /**
     * 获取指定id下的 所有分类      
     * @global type $goods_category 所有商品分类
     * @param type $id 当前显示的 菜单id
     * @return 返回数组 Description
     */
    public function get_cat_tree($id)
    {
        global $goods_category, $goods_category2;          
        $goods_category2[$id] = $goods_category[$id];    
        foreach ($goods_category AS $key => $value){
             if($value['parent_id'] == $id)
             {                 
                $this->get_cat_tree($value['id']);  
                $goods_category2[$id]['have_son'] = 1; // 还有下级
             }
        }               
    }
    
    
    /**
     * 移除指定$parent_id_path 分类以及下的所有分类
     * @global type $cat_list 所有商品分类
     * @param type $parent_id_path 指定的id
     * @return 返回数组 Description
     */
    public function remove_cat($cat_list,$parent_id_path)
    {
        foreach ($cat_list AS $key => $value){
             if(strstr($value['parent_id_path'],$parent_id_path))
             {                 
                 unset($cat_list[$value['id']]); 
             }
        }     
        return $cat_list;
    }
    
    /**
     * 改变或者添加分类时 需要修改他下面的 parent_id_path  和 level 
     * @global type $cat_list 所有商品分类
     * @param type $parent_id_path 指定的id
     * @return 返回数组 Description
     */
    public function refresh_cat($id)
    {            
        $GoodsCategory = M("GoodsCategory"); // 实例化User对象
        $cat = $GoodsCategory->where("id = $id")->find(); // 找出他自己
        // 刚新增的分类先把它的值重置一下
        if($cat['parent_id_path'] == '')
        {
            ($cat['parent_id'] == 0) && Db::execute("UPDATE __PREFIX__goods_category set  parent_id_path = '0_$id', level = 1 where id = $id"); // 如果是一级分类               
            Db::execute("UPDATE __PREFIX__goods_category AS a ,__PREFIX__goods_category AS b SET a.parent_id_path = CONCAT_WS('_',b.parent_id_path,'$id'),a.level = (b.level+1) WHERE a.parent_id=b.id AND a.id = $id");                
            $cat = $GoodsCategory->where("id = $id")->find(); // 从新找出他自己
        }        
        
        if($cat['parent_id'] == 0) //有可能是顶级分类 他没有老爸
        {
            $parent_cat['parent_id_path'] =   '0';   
            $parent_cat['level'] = 0;
        }
        else{
            $parent_cat = $GoodsCategory->where("id = {$cat['parent_id']}")->find(); // 找出他老爸的parent_id_path
        }        
        $replace_level = $cat['level'] - ($parent_cat['level'] + 1); // 看看他 相比原来的等级 升级了多少  ($parent_cat['level'] + 1) 他老爸等级加一 就是他现在要改的等级
        $replace_str = $parent_cat['parent_id_path'].'_'.$id;                
        Db::execute("UPDATE `__PREFIX__goods_category` SET parent_id_path = REPLACE(parent_id_path,'{$cat['parent_id_path']}','$replace_str'), level = (level - $replace_level) WHERE  parent_id_path LIKE '{$cat['parent_id_path']}%'");        
    }    

    /**
     * 动态获取商品属性输入框 根据不同的数据返回不同的输入框类型
     * @param int $goods_id 商品id
     * @param int $type_id 商品属性类型id
     */
    public function getAttrInput($goods_id,$type_id)
    {
        header("Content-type: text/html; charset=utf-8");
        $GoodsAttribute = D('GoodsAttribute');
        $attributeList = $GoodsAttribute->where("type_id = $type_id")->select();                                
        
        foreach($attributeList as $key => $val)
        {                                                                        
            
            $curAttrVal = $this->getGoodsAttrVal(NULL,$goods_id, $val['attr_id']);
             //促使他 循环
            if(count($curAttrVal) == 0)
                $curAttrVal[] = array('goods_attr_id' =>'','goods_id' => '','attr_id' => '','attr_value' => '','attr_price' => '');
            foreach($curAttrVal as $k =>$v)
            {                                        
                            $str .= "<tr class='attr_{$val['attr_id']}'>";            
                            $addDelAttr = ''; // 加减符号
                            // 单选属性 或者 复选属性
                            if($val['attr_type'] == 1 || $val['attr_type'] == 2)
                            {
                                if($k == 0)                                
                                    $addDelAttr .= "<a onclick='addAttr(this)' href='javascript:void(0);'>[+]</a>&nbsp&nbsp";                                                                    
                                else                                
                                     $addDelAttr .= "<a onclick='delAttr(this)' href='javascript:void(0);'>[-]</a>&nbsp&nbsp";                               
                            }

                            $str .= "<td>$addDelAttr {$val['attr_name']}</td> <td>";            

                           // if($v['goods_attr_id'] > 0) //tp_goods_attr 表id
                           //     $str .= "<input type='hidden' name='goods_attr_id[]' value='{$v['goods_attr_id']}'/>";
                                    
                            // 手工录入
                            if($val['attr_input_type'] == 0)
                            {
                                $str .= "<input type='text' size='40' value='".($goods_id ? $v['attr_value'] : $val['attr_values'])."' name='attr_{$val['attr_id']}[]' />";
                            }
                            // 从下面的列表中选择（一行代表一个可选值）
                            if($val['attr_input_type'] == 1)
                            {
                                $str .= "<select name='attr_{$val['attr_id']}[]'><option value='0'>无</option>";
                                $tmp_option_val = explode(PHP_EOL, $val['attr_values']);
                                foreach($tmp_option_val as $k2=>$v2)
                                {
                                    // 编辑的时候 有选中值
                                    $v2 = preg_replace("/\s/","",$v2);
                                    if($v['attr_value'] == $v2)
                                        $str .= "<option selected='selected' value='{$v2}'>{$v2}</option>";
                                    else
                                        $str .= "<option value='{$v2}'>{$v2}</option>";
                                }
                                $str .= "</select>";                
                                //$str .= "属性价格<input type='text' maxlength='10' size='5' value='{$v['attr_price']}' name='attr_price_{$val['attr_id']}[]'>";
                            }
                            // 多行文本框
                            if($val['attr_input_type'] == 2)
                            {
                                $str .= "<textarea cols='40' rows='3' name='attr_{$val['attr_id']}[]'>".($goods_id ? $v['attr_value'] : $val['attr_values'])."</textarea>";
                                //$str .= "属性价格<input type='text' maxlength='10' size='5' value='{$v['attr_price']}' name='attr_price_{$val['attr_id']}[]'>";
                            }                                                        
                            $str .= "</td></tr>";
                            //$str .= "<br/>";            
            }                        
            
        }        
        return  $str;
    }
    
    /**
     * 获取 tp_goods_attr 表中指定 goods_id  指定 attr_id  或者 指定 goods_attr_id 的值 可是字符串 可是数组
     * @param int $goods_attr_id tp_goods_attr表id
     * @param int $goods_id 商品id
     * @param int $attr_id 商品属性id
     * @return array 返回数组
     */
    public function getGoodsAttrVal($goods_attr_id = 0 ,$goods_id = 0, $attr_id = 0)
    {
        $GoodsAttr = D('GoodsAttr');        
        if($goods_attr_id > 0)
            return $GoodsAttr->where("goods_attr_id = $goods_attr_id")->select(); 
        if($goods_id > 0 && $attr_id > 0)
            return $GoodsAttr->where("goods_id = $goods_id and attr_id = $attr_id")->select();        
    }
   
    /**
     *  给指定商品添加属性 或修改属性 更新到 tp_goods_attr
     * @param int $goods_id  商品id
     * @param int $goods_type  商品类型id
     */
    public function saveGoodsAttr($goods_id,$goods_type)
    {  
        $GoodsAttr = M('GoodsAttr');
        //$Goods = M("Goods");
                
         // 属性类型被更改了 就先删除以前的属性类型 或者没有属性 则删除        
        if($goods_type == 0)  
        {
            $GoodsAttr->where('goods_id = '.$goods_id)->delete(); 
            return;
        }
        
            $GoodsAttrList = $GoodsAttr->where('goods_id = '.$goods_id)->select();
            
            $old_goods_attr = array(); // 数据库中的的属性  以 attr_id _ 和值的 组合为键名
            foreach($GoodsAttrList as $k => $v)
            {                
                $old_goods_attr[$v['attr_id'].'_'.$v['attr_value']] = $v;
            }            
                              
            // post 提交的属性  以 attr_id _ 和值的 组合为键名    
            $post_goods_attr = array();
            $post = I("post.");
            foreach($post as $k => $v)
            {
                $attr_id = str_replace('attr_','',$k);
                if(!strstr($k, 'attr_') || strstr($k, 'attr_price_'))
                   continue;                                 
               foreach ($v as $k2 => $v2)
               {                      
                   $v2 = str_replace('_', '', $v2); // 替换特殊字符
                   $v2 = str_replace('@', '', $v2); // 替换特殊字符
                   $v2 = trim($v2);
                   
                   if(empty($v2))
                       continue;
                   
                   
                   $tmp_key = $attr_id."_".$v2;
                   $post_attr_price = I("post.attr_price_{$attr_id}");
                   $attr_price = $post_attr_price[$k2]; 
                   $attr_price = $attr_price ? $attr_price : 0;
                   if(array_key_exists($tmp_key , $old_goods_attr)) // 如果这个属性 原来就存在
                   {   
                       if($old_goods_attr[$tmp_key]['attr_price'] != $attr_price) // 并且价格不一样 就做更新处理
                       {                       
                            $goods_attr_id = $old_goods_attr[$tmp_key]['goods_attr_id'];                         
                            $GoodsAttr->where("goods_attr_id = $goods_attr_id")->save(array('attr_price'=>$attr_price));                       
                       }
                   }
                   else // 否则这个属性 数据库中不存在 说明要做删除操作
                   {
                       $GoodsAttr->add(array('goods_id'=>$goods_id,'attr_id'=>$attr_id,'attr_value'=>$v2,'attr_price'=>$attr_price));                       
                   }
                   unset($old_goods_attr[$tmp_key]);
               }
                
            }     
            // 没有被 unset($old_goods_attr[$tmp_key]); 掉是 说明 数据库中存在 表单中没有提交过来则要删除操作
            foreach($old_goods_attr as $k => $v)
            {                
               $GoodsAttr->where('goods_attr_id = '.$v['goods_attr_id'])->delete(); // 
            }                       

    }
    
    /**
     * 获取 tp_spec_item表 指定规格id的 规格项
     * @param int $spec_id 规格id
     * @return array 返回数组
     */
    public function getSpecItem($spec_id)
    { 
        $model = M('SpecItem');        
        $arr = $model->where("spec_id = $spec_id")->order('id')->select(); 
        $arr = get_id_val($arr, 'id','item');        
        return $arr;
    }    
    
    /**
     * 获取 规格的 笛卡尔积
     * @param $goods_id 商品 id     
     * @param $spec_arr 笛卡尔积
     * @return string 返回表格字符串
     */
    public function getSpecInput($goods_id, $spec_arr)
    {
        // <input name="item[2_4_7][price]" value="100" /><input name="item[2_4_7][name]" value="蓝色_S_长袖" />        
        /*$spec_arr = array(         
            20 => array('7','8','9'),
            10=>array('1','2'),
            1 => array('3','4'),
            
        );  */        
        // 排序
        foreach ($spec_arr as $k => $v)
        {
            $spec_arr_sort[$k] = count($v);
        }
        asort($spec_arr_sort);        
        foreach ($spec_arr_sort as $key =>$val)
        {
            $spec_arr2[$key] = $spec_arr[$key];
        }
     
        
         $clo_name = array_keys($spec_arr2);         
         $spec_arr2 = combineDika($spec_arr2); //  获取 规格的 笛卡尔积                 
                       
         $spec = M('Spec')->getField('id,name'); // 规格表
         $specItem = M('SpecItem')->getField('id,item,spec_id');//规格项
         $keySpecGoodsPrice = M('SpecGoodsPrice')->where('goods_id = '.$goods_id)->getField('key,key_name,price,store_count,bar_code,sku');//规格项
                          
       $str = "<table class='table table-bordered' id='spec_input_tab'>";
       $str .="<tr>";       
       // 显示第一行的数据
       foreach ($clo_name as $k => $v) 
       {
           $str .=" <td><b>{$spec[$v]}</b></td>";
       }    
        $str .="<td><b>价格</b></td>
               <td><b>库存</b></td>
               <td><b>SKU</b></td>
             </tr>";
       // 显示第二行开始 
       foreach ($spec_arr2 as $k => $v) 
       {
            $str .="<tr>";
            $item_key_name = array();
            foreach($v as $k2 => $v2)
            {
                $str .="<td>{$specItem[$v2][item]}</td>";
                $item_key_name[$v2] = $spec[$specItem[$v2]['spec_id']].':'.$specItem[$v2]['item'];
            }   
            ksort($item_key_name);            
            $item_key = implode('_', array_keys($item_key_name));
            $item_name = implode(' ', $item_key_name);
            
			$keySpecGoodsPrice[$item_key][price] ? false : $keySpecGoodsPrice[$item_key][price] = 0; // 价格默认为0
			$keySpecGoodsPrice[$item_key][store_count] ? false : $keySpecGoodsPrice[$item_key][store_count] = 0; //库存默认为0
            $str .="<td><input name='item[$item_key][price]' value='{$keySpecGoodsPrice[$item_key][price]}' onkeyup='this.value=this.value.replace(/[^\d.]/g,\"\")' onpaste='this.value=this.value.replace(/[^\d.]/g,\"\")' /></td>";
            $str .="<td><input name='item[$item_key][store_count]' value='{$keySpecGoodsPrice[$item_key][store_count]}' onkeyup='this.value=this.value.replace(/[^\d.]/g,\"\")' onpaste='this.value=this.value.replace(/[^\d.]/g,\"\")'/></td>";            
            $str .="<td><input name='item[$item_key][sku]' value='{$keySpecGoodsPrice[$item_key][sku]}' />
                <input type='hidden' name='item[$item_key][key_name]' value='$item_name' /></td>";
            $str .="</tr>";           
       }
        $str .= "</table>";
       return $str;   
    }
    
    /**
     * 获取指定规格类型下面的所有规格  但不包括规格项 供商品分类列表页帅选作用
     * @param type $type_id
     * @param type $checked
     */
    function GetSpecCheckboxList($type_id, $checked = array()){
        $list = M('Spec')->where("type_id = $type_id")->order('`order` desc')->select();        
        //$list = M('Spec')->where("1=1")->order('`order` desc')->select();        
        $str = '';
        
        foreach($list as $key => $val)
        {
            if(in_array($val['id'],$checked))
                $str .= $val['name'].":<input type='checkbox' name='spec_id[]' value='{$val['id']}' checked='checked'/>&nbsp;&nbsp";
            else
                $str .= $val['name'].":<input type='checkbox' name='spec_id[]' value='{$val['id']}' />&nbsp;&nbsp";
        }
        return $str;
    }
    
    /**
     * 获取指定商品类型下面的所有属性  供商品分类列表页帅选作用
     * @param type $type_id
     * @param type $checked
     */
    function GetAttrCheckboxList($type_id, $checked = array()){                
        $list = M('GoodsAttribute')->where("type_id = $type_id and attr_index > 0 ")->order('`order` desc')->select();        
        //$list = M('Spec')->where("1=1")->order('`order` desc')->select();        
        $str = '';
        
        foreach($list as $key => $val)
        {
            if(in_array($val['attr_id'],$checked))
                $str .= $val['attr_name'].":<input type='checkbox' name='attr_id[]' value='{$val['attr_id']}' checked='checked'/>&nbsp;&nbsp";
            else
                $str .= $val['attr_name'].":<input type='checkbox' name='attr_id[]' value='{$val['attr_id']}' />&nbsp;&nbsp";
        }
        return $str;
    }
    
    /**
     *  获取选中的下拉框
     * @param type $cat_id
     */
    function find_parent_cat($cat_id)
    {
        if($cat_id == null) 
            return array();
        
        $cat_list =  M('goods_category')->getField('id,parent_id,level');
        $cat_level_arr[$cat_list[$cat_id]['level']] = $cat_id;

        // 找出他老爸
        $parent_id = $cat_list[$cat_id]['parent_id'];
        if($parent_id > 0)
             $cat_level_arr[$cat_list[$parent_id]['level']] = $parent_id;
        // 找出他爷爷
        $grandpa_id = $cat_list[$parent_id]['parent_id'];
        if($grandpa_id > 0)
             $cat_level_arr[$cat_list[$grandpa_id]['level']] = $grandpa_id;
        
        // 建议最多分 3级, 不要继续往下分太多级
        // 找出他祖父
        $grandfather_id = $cat_list[$grandpa_id]['parent_id'];
        if($grandfather_id > 0)
             $cat_level_arr[$cat_list[$grandfather_id]['level']] = $grandfather_id;
        
        return $cat_level_arr;      
    }        
    
    /**
     *  获取排好序的品牌列表    
     */
    function getSortBrands()
    {
        $brandList = S('getSortBrands');
        if(!empty($brandList)){
            return $brandList;
        }
        $brandList =  M("Brand")->cache(true)->select();
        $brandIdArr =  M("Brand")->cache(true)->where("name in (select `name` from `".C('database.prefix')."brand` group by name having COUNT(id) > 1)")->getField('id,cat_id');
        $goodsCategoryArr = M('goodsCategory')->cache(true)->where("level = 1")->getField('id,name');
        $nameList = array();
        foreach($brandList as $k => $v)
        {

            $name = getFirstCharter($v['name']) .'  --   '. $v['name']; // 前面加上拼音首字母

            if(array_key_exists($v[id],$brandIdArr) && $v[cat_id]) // 如果有双重品牌的 则加上分类名称
                    $name .= ' ( '. $goodsCategoryArr[$v[cat_id]] . ' ) ';

             $nameList[] = $v['name'] = $name;
             $brandList[$k] = $v;
        }
        array_multisort($nameList,SORT_STRING,SORT_ASC,$brandList);

        S('getSortBrands',$brandList); 
        return $brandList;
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
     *  获取排好序的分类列表     
     */
    function getSortCategory()
    {
        $categoryList = S('categoryList');
        if($categoryList)
        {
            return $categoryList;
        }
        $categoryList =  M("GoodsCategory")->cache(true)->getField('id,name,parent_id,level');
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

        S('categoryList',$categoryList);
        return $categoryList;
    }

    /**
     * 添加编辑预售商品
     * @param $data
     * @return array
     */
    function savePreSell($data)
    {
        $data['start_time'] = strtotime($data['start_time']);
        $data['end_time'] = strtotime($data['end_time']);
        //结束活动
        if (array_key_exists('shut_down', $data) && $data['shut_down'] == 1) {
            if (!empty($data['id'])) {
                $pre_sell_shut_down = M('goods_activity')->where(array('act_id' => $data['id']))->save(array('end_time' => time()));
                if ($pre_sell_shut_down !== false) {
                    return array('msg' => '编辑预售活动成功。', 'status' => 1, 'url' => U('Promotion/pre_sell_info', array('id' => $data['id'])));
                } else {
                    return array('msg' => '编辑预售活动失败。', 'status' => 0, 'url' => U('Promotion/pre_sell_info', array('id' => $data['id'])));
                }
            } else {
                return array('msg' => '未指定需结束的预售商品', 'status' => 0, 'url' => U('Promotion/pre_sell_list'));
            }
        }
        if ($data['start_time'] > $data['end_time']) {
            return array('msg'=>'您输入了一个无效的时间，活动结束时间不能早于活动开始时间！','status'=>0, 'url'=>U('Promotion/pre_sell_info', array('id' => $data['id'])));
        }
        if (empty($data['restrict_amount']) || $data['restrict_amount'] <= 0) {
            return array('msg'=>'您输入了一个无效的预售库存，预售库存要大于0！','status'=>0, 'url'=>U('Promotion/pre_sell_info', array('id' => $data['id'])));
        }
        if ($data['restrict_amount'] < max($data['ladder_amount'])) {
            return array('msg'=>'您没有输入有效的价格阶梯，预定最多人数不能大于预售库存！','status'=>0, 'url'=>U('Promotion/pre_sell_info', array('id' => $data['id'])));
        }
        if ($data['deposit'] > min($data['ladder_price'])) {
            return array('msg'=>'定金不能大于阶梯价格！','status'=>0, 'url'=>U('Promotion/pre_sell_info', array('id' => $data['id'])));
        }
        $price_ladder = array();
        foreach ($data['ladder_amount'] as $key => $value) {
            $price_ladder[$key]['amount'] = intval($data['ladder_amount'][$key]);
            $price_ladder[$key]['price'] = floatval($data['ladder_price'][$key]);
        }
        $price_ladder = array_values(array_sort($price_ladder, 'amount', 'asc'));
        if($price_ladder[0]['amount'] <= 0 ||$price_ladder[0]['price'] <= 0){
            return array('msg'=>'您没有输入有效的价格阶梯！','status'=>0, 'url'=>U('Promotion/pre_sell_info', array('id' => $data['id'])));
        }
        $ext_info = array(
            'sale_price' => 0,
            'price_ladder' => $price_ladder,
            'restrict_amount' => $data['restrict_amount'],
            'deposit' => $data['deposit'],
            'deliver_goods' => $data['deliver_goods'],
        );

        if($data['deposit'] > 0 && empty($data['id'])){
            $data['retainage_start'] = strtotime($data['retainage_start']);
            $data['retainage_end'] = strtotime($data['retainage_end']);
            if($data['retainage_start'] === false || $data['retainage_end'] === false){
                return array('msg'=>'您输入了一个无效的时间，请选择尾款支付时间！','status'=>0, 'url'=>U('Promotion/pre_sell_info', array('id' => $data['id'])));
            }
            if ($data['retainage_start'] > $data['retainage_end']) {
                return array('msg'=>'您输入了一个无效的时间，尾款结束支付时间不能早于尾款开始支付时间！','status'=>0, 'url'=>U('Promotion/pre_sell_info', array('id' => $data['id'])));
            }
            if ($data['start_time'] > $data['retainage_start'] && $data['retainage_start']) {
                return array('msg'=>'您输入了一个无效的时间，尾款开始支付时间不能早于活动结束时间！','status'=>0, 'url'=>U('Promotion/pre_sell_info', array('id' => $data['id'])));
            }
            $ext_info['retainage_start'] = $data['retainage_start'];
            $ext_info['retainage_end'] = $data['retainage_end'];
        }
        $goods_main = M('goods')->where(array('goods_id'=>$data['goods_id']))->find();
        if($goods_main['store_count'] < $ext_info['restrict_amount']){
            return array('msg'=>'预售库存不得大于商品库存','status'=>0, 'url'=>U('Promotion/pre_sell_info', array('id' => $data['id'])));
        }
        if (empty($data['id'])) {
            //添加一个活动的判断
            $is_have_where = array('goods_id'=>$data['goods_id']);
            $is_have_goods = M('goods_activity')->where($is_have_where)->find();
            if($is_have_goods){
                if($is_have_goods['is_finished'] == 0){
                    return array('msg'=>'该商品已经参加了预售活动，不能再次参与预售活动','status'=>0, 'url'=>U('Promotion/pre_sell_info', array('id' => $data['id'])));
                }
            }
            if($goods_main['prom_type'] != 0){
                return array('msg'=>'该商品已经参加了其他活动，不能参与预售活动','status'=>0, 'url'=>U('Promotion/pre_sell_info', array('id' => $data['id'])));
            }
        }
        if(!empty($data['id']) && !empty($data['goods_id'])){
            $goods_activity = M('goods_activity')->where(array('act_id'=>$data['id']))->find();
            $old_ext_info = unserialize($goods_activity['ext_info']);
            $ext_info['retainage_start'] = $old_ext_info['retainage_start'];
            $ext_info['retainage_end'] = $old_ext_info['retainage_end'];
            if($goods_activity['start_time'] < time() && $goods_activity['goods_id'] != $data['goods_id']){
                return array('msg'=>'预售活动已经开始不能更改预售商品','status'=>0, 'url'=>U('Promotion/pre_sell_info', array('id' => $data['id'])));
            }
        }
        if (empty($data['id'])) {
            $add_data = array(
                'act_name' => $data['goods_name'],
                'act_type' => 1,
                'goods_id' => $data['goods_id'],
                'spec_id' => 0,
                'goods_name' => $data['goods_name'],
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
                'is_finished' => 0,
                'ext_info' => serialize($ext_info),
                'act_count' => 0,
                'act_desc' => $data['act_desc']
            );
            $goods_save_data['prom_type'] = 4;//预售商品类型
            M('goods')->where(array('goods_id'=>$data['goods_id']))->save($goods_save_data);
            $r = M('goods_activity')->add($add_data);
            adminLog("管理员添加商品预售活动 " . $data['goods_name']);
            if ($r !== false) {
                return array('msg'=>'添加预售商品活动成功','status'=>1, 'url'=>U('Promotion/pre_sell_list'));
            } else {
                return array('msg'=>'添加预售商品活动失败','status'=>0, 'url'=>U('Promotion/pre_sell_list'));
            }
        } else {
            $save_data = array(
                'act_name' => $data['goods_name'],
                'goods_id' => $data['goods_id'],
                'goods_name' => $data['goods_name'],
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
                'ext_info' => serialize($ext_info),
                'act_desc' => $data['act_desc']
            );
            $goods_save_data['prom_type'] = 4;//预售商品类型
            M('goods')->where(array('goods_id'=>$data['goods_id']))->save($goods_save_data);
            $r = M('goods_activity')->where(array('act_id' => $data['id'], 'act_type' => 1))->save($save_data);
            if ($r !== false) {
                return array('msg'=>'编辑预售商品活动成功','status'=>1, 'url'=>U('Promotion/pre_sell_list'));
            } else {
                return array('msg'=>'编辑预售商品活动失败','status'=>0, 'url'=>U('Promotion/pre_sell_list'));
            }
        }
    }
}