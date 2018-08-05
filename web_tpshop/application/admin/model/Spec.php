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
namespace app\admin\model;
use think\Model;
class Spec extends Model {

    
   /**
     * 后置操作方法
     * 自定义的一个函数 用于数据保存后做的相应处理操作, 使用时手动调用
     * @param int $id 规格id
     */
    public function afterSave($id)
    {
        
        $model = M("SpecItem"); // 实例化User对象
        $post_items = explode(PHP_EOL, I('items'));
        foreach ($post_items as $key => $val)  // 去除空格
        {
            $val = str_replace('_', '', $val); // 替换特殊字符
            $val = str_replace('@', '', $val); // 替换特殊字符
            
            $val = trim($val);
            if(empty($val)) 
                unset($post_items[$key]);
            else                     
                $post_items[$key] = $val;
        }
        $db_items = $model->where("spec_id = $id")->getField('id,item');
        // 两边 比较两次
        
        /* 提交过来的 跟数据库中比较 不存在 插入*/
        foreach($post_items as $key => $val)
        {
            if(!in_array($val, $db_items))            
                $dataList[] = array('spec_id'=>$id,'item'=>$val);            
        }
        // 批量添加数据
        $dataList && $model->insertAll($dataList);
        
        /* 数据库中的 跟提交过来的比较 不存在删除*/
        foreach($db_items as $key => $val)
        {
            if(!in_array($val, $post_items))       
            {       
                //  SELECT * FROM `tp_spec_goods_price` WHERE `key` REGEXP '^11_' OR `key` REGEXP '_13_' OR `key` REGEXP '_21$'
                M("SpecGoodsPrice")->where("`key` REGEXP '^{$key}_' OR `key` REGEXP '_{$key}_' OR `key` REGEXP '_{$key}$' or `key` = '{$key}'")->delete(); // 删除规格项价格表
                M("SpecItem")->where('id='.$key)->delete(); // 删除规格项
            }
        }        
    }    
}
