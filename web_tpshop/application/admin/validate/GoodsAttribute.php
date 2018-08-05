<?php
namespace app\admin\validate;
use think\Validate;
class GoodsAttribute extends Validate
{       
    
    /**
    //protected $tablePrefix = 'tp_'; 
    protected $patchValidate = true; // 系统支持数据的批量验证功能，
    
     *     
        self::EXISTS_VALIDATE 或者0 存在字段就验证（默认）
        self::MUST_VALIDATE 或者1 必须验证
        self::VALUE_VALIDATE或者2 值不为空的时候验证
     * 
     * 
        self::MODEL_INSERT或者1新增数据时候验证
        self::MODEL_UPDATE或者2编辑数据时候验证
        self::MODEL_BOTH或者3全部情况下验证（默认）       
     
    protected $_validate = array(
        array('attr_name','require','商品名称必须填写！',1 ,'',3),         
        array('type_id','require','商品类型必须选择！',1 ,'',3),
        array('attr_values','checkAttrValues','可选值列表不能为空',1,'function',3), // 自定义函数验证密码格式
     );  
    */
    
    
    // 验证规则
    protected $rule = [
        ['attr_name','require','属性名称必须填写'],
        ['type_id', 'require', '所属商品类型必须选择'],
        ['attr_values','checkAttrValues','可选值列表不能为空'],
    ];
      
    /**
     *  自定义函数 判断 用户选择 从下面的列表中选择 可选值列表：不能为空
     * @param type $attr_values
     * @return boolean
     */
    protected function checkAttrValues($attr_values,$rule)
    {                
        if((trim($attr_values) == '') && (I('attr_input_type') == '1'))        
            return '可选值列表不能为空';
        else
            return true;
     }    
}