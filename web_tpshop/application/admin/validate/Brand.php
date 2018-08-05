<?php
namespace app\admin\validate;
use think\validate;
//品牌验证器
class Brand extends validate
{

    protected $rule=[
        ['name' ,'require|checkName'],
        ['url' ,'url'],
        ['sort','number'],
        ['desc' ,'max:100']
    ];
    protected $message = [
        'name.require'      => '品牌名称必须',
        'name.checkName'    => '品牌已经存在',
        'url.url'           => '品牌地址不是有效的URL地址',
        'sort.number'       => '排序必须是数字',
        'desc.max'          => '品牌描述不得大于100个字节'
    ];

    /**
     * 验证品牌名称是否唯一
     * @param $value
     * @param $rule
     * @param $data
     */
    protected function checkName($value,$rule,$data){
        $checkBrandWhere = [
            'name'=>$value,
            'parent_cat_id'=>$data['parent_cat_id'],
            'cat_id'=>$data['cat_id']
        ];
        $res = M('Brand')->where($checkBrandWhere)->getField('id');
        return !empty($res) ? false:true;
    }
}