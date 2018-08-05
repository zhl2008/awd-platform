<?php
namespace app\admin\validate;
use think\Validate;
use think\Db;
class PromGoods extends Validate
{
    // 验证规则
    protected $rule = [
        'id'=>'checkId',
        'title'=>'require|max:50',
        'goods'=> 'require',
        'type'=> 'require',
        'expression'=>'require|checkExpression',
//        'group','require',
        'start_time'=>'require',
        'end_time'=>'require|checkEndTime',
        'prom_img'=>'require',
        'description'=>'max:100',
    ];
    //错误信息
    protected $message  = [
        'title.require'                 => '促销标题必须',
        'title.max'                     => '促销标题小于50字符',
        'type.require'                  => '活动类型必须',
        'goods.require'                 => '请选择参与促销的商品',
        'expression.require'            => '请填写优惠',
//        'expression.checkExpression'    => '优惠有误',
//        'group.require'         => '请选择适合用户范围',
        'start_time.require'            => '请选择开始时间',
        'end_time.require'              => '请选择结束时间',
        'end_time.checkEndTime'         => '结束时间不能早于开始时间',
        'prom_img.require'              => '图片必须',
        'description.max'               => '活动介绍小于100字符'
    ];
    /**
     * 检查结束时间
     * @param $value|验证数据
     * @param $rule|验证规则
     * @param $data|全部数据
     * @return bool|string
     */
    protected function checkEndTime($value, $rule ,$data)
    {
        return ($value < $data['start_time']) ? false : true;
    }
    /**
     * 检查优惠
     * @param $value|验证数据
     * @param $rule|验证规则
     * @param $data|全部数据
     * @return bool|string
     */
    protected function checkExpression($value, $rule ,$data){
        //【固定金额出售】出售金额价格不能大于上传价格
        if ($data['type'] == 2 ||$data['type'] == 1) {
            $promGoods = $data['goods'];
            $no_spec_goods = [];//不包含规格的商品id数组
            $item_ids = [];
            foreach ($promGoods as $goodsKey => $goodsVal) {
                if (array_key_exists('item_id', $goodsVal)) {
                    $item_ids = array_merge($item_ids, $goodsVal['item_id']);
                } else {
                    array_push($no_spec_goods, $goodsVal['goods_id']);
                }
            }
            if($no_spec_goods){
                $minGoodsPrice = Db::name('goods')->where('goods_id','in',$no_spec_goods)->order('shop_price')->find();
                if($data['expression'] > $minGoodsPrice['shop_price']){
                    return '优惠金额不能大于商品为'.$minGoodsPrice['goods_name'].'的价格：'.$minGoodsPrice['shop_price'];
                }
            }
            if($item_ids){
                $minSpecGoodsPrice = Db::name('spec_goods_price')->where('item_id', 'in', $item_ids)->order('price')->find();
                if($data['expression'] > $minSpecGoodsPrice['price']){
                    return '优惠金额不能大于规格为'.$minSpecGoodsPrice['key_name'].'的价格：'.$minSpecGoodsPrice['price'];
                }
            }
        }
        return true;
    }
    /**
     * 该活动是否可以编辑
     * @param $value|验证数据
     * @param $rule|验证规则
     * @param $data|全部数据
     * @return bool|string
     */
    protected function checkId($value, $rule ,$data)
    {
        $isHaveOrder = Db::name('order_goods')->where(['prom_type'=>3,'prom_id'=>$value])->find();
        if($isHaveOrder){
            return '该活动已有用户下单购买不能编辑';
        }else{
            return true;
        }
    }
}