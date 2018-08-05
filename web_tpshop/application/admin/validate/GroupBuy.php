<?php
namespace app\admin\validate;
use think\Validate;
use think\Db;
class GroupBuy extends Validate
{
    // 验证规则
    protected $rule = [
        ['id','checkId'],
        ['title', 'require'],
        ['goods_id', 'require'],
        ['goods_name', 'require'],
        ['price','require|number|checkPrice'],
        ['goods_num','require|number|checkGoodsNum'],
        ['virtual_num','number'],
        ['start_time','require'],
        ['end_time','require|checkEndTime'],
        ['intro','max:100'],
    ];
    //错误信息
    protected $message  = [
        'title.require'         => '团购标题必须',
        'start_time.require'    => '请选择开始时间',
        'end_time.require'      => '请选择结束时间',
        'end_time.checkEndTime' => '结束时间不能早于开始时间',
        'goods_name.require'    => '请填写商品名称',
        'goods_id.require'      => '请选择参与团购的商品',
        'price.require'         => '请填写团购价格',
        'price.number'          => '团购价格必须是数字',
        'price.checkPrice'      => '团购价格不能大于或等于原商品价格',
        'goods_num.require'     => '请填写参加团购数量',
        'goods_num.number'      => '团购数量必须为数字',
        'goods_num.checkGoodsNum' => '团购数量不能大于库存数量',
        'virtual_num.number'    => '虚拟购买数量必须为数字',
        'intro.max'             => '活动介绍小于100字符',
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
     * 检查团购价格
     * @param $value|验证数据
     * @param $rule|验证规则
     * @param $data|全部数据
     * @return bool|string
     */
    protected function checkPrice($value, $rule ,$data)
    {
        return ($value >= $data['goods_price']) ? false : true;
    }
    /**
     * 检查参与抢购数量
     * @param $value|验证数据
     * @param $rule|验证规则
     * @param $data|全部数据
     * @return bool|string
     */
    protected function checkGoodsNum($value, $rule ,$data)
    {
        return ($value > $data['store_count']) ? false : true;
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
        $isHaveOrder = Db::name('order_goods')->where(['prom_type'=>2,'prom_id'=>$value])->find();
        if($isHaveOrder){
            return '该活动已有用户下单购买不能编辑';
        }else{
            return true;
        }
    }
}