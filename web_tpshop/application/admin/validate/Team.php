<?php
namespace app\admin\validate;
use think\Validate;
use think\Db;
class Team extends Validate
{
    // 验证规则
    protected $rule = [
        'team_id'                   =>'checkTeamId',
        'act_name'                  =>'require|max:50',
        'time_limit'                =>'require|number|gt:0',
        'team_price'                =>['require','regex'=>'([1-9]\d*(\.\d*[1-9])?)|(0\.\d*[1-9])','checkTeamPrice'],
        'needer'                    =>'require|number|gt:1|checkNeed',
        'goods_id'                  =>'require',
        'bonus'                     =>['regex'=>'^(?=.*[1-9])\d+(\.\d{1,2})?$'],
        'stock_limit'               =>'number|checkStockLimit',
        'buy_limit'                 =>'number|egt:0|lt:10000',
        'virtual_num'               =>'number',
        'share_title'               =>'max:50',
        'share_desc'                =>'max:200',
    ];
    //错误信息
    protected $message  = [
        'act_name.require'          => '拼团标题必须',
        'act_name.max'              => '拼团标题长度不得超过50字符',
        'time_limit.require'        => '成团有效期必须',
        'time_limit.number'         => '成团有效期格式错误',
        'time_limit.gt'             => '成团有效期必须大于0',
        'team_price.require'        => '拼团价格必须',
        'team_price.regex'          => '拼团价格格式错误',
        'team_price.checkTeamPrice' => '拼团价格必须低于单买价格',
        'needer.require'            => '需要成团人数必须',
        'needer.gt'                 => '需要成团人数必须大于1人',
        'goods_id.require'          => '请选择参与拼团的商品',
        'bonus.regex'               => '团长佣金格式错误',
        'stock_limit.number'        => '抽奖限量格式错误',
        'buy_limit.number'          => '购买限制数格式错误',
        'buy_limit.egt'             => '购买限制数范围0~10000',
        'buy_limit.lt'              => '购买限制数范围0~10000',
        'virtual_num.number'        => '虚拟销售基数格式错误',
        'share_title.max'           => '分享标题长度不得超过50字符',
        'share_desc.max'            => '分享描述长度不得超过200字符',
    ];

    /**
     * 检查拼团活动成功一次最少需要库存，假定一人
     * @param $value|验证数据
     * @param $rule|验证规则
     * @param $data|全部数据
     * @return bool|string
     */
    protected function checkNeed($value, $rule ,$data)
    {
        if($data['item_id'] > 0){
            //商品规格
            $store_count = Db::name("spec_goods_price")->where(['item_id'=>$data['item_id']])->getField('store_count');
        }else{
            $store_count = Db::name('goods')->where('goods_id',$data['goods_id'])->getField('store_count');
        }
        if($data['buy_limit'] > 0){
            $needStoreCount = $data['buy_limit'] * $value;
            if($store_count < $needStoreCount){
                return '单次拼团若每人购买满（限购)'.$data['buy_limit'].'件'.'成团条件'.$value.'人'.',则最少需要库存'.$needStoreCount;
            }else{
                return true;
            }
        }else{
            $needStoreCount = $value;
            if($store_count < $needStoreCount){
                return '单次拼团若每人购买一件,成团条件'.$value.'人'.',则最少需要库存'.$needStoreCount;
            }else{
                return true;
            }
        }
    }
    /**
     * 检查拼团价格
     * @param $value|验证数据
     * @param $rule|验证规则
     * @param $data|全部数据
     * @return bool|string
     */
    protected function checkTeamPrice($value, $rule ,$data)
    {
        if($data['item_id'] > 0){
            //商品规格
            $price = Db::name("spec_goods_price")->where(['item_id'=>$data['item_id']])->getField('price');
        }else{
            $price = Db::name('goods')->where('goods_id',$data['goods_id'])->getField('shop_price');
        }
        return ($value >= $price) ? false : true;
    }

    /**
     * 该活动是否可以编辑
     * @param $value|验证数据
     * @param $rule|验证规则
     * @param $data|全部数据
     * @return bool|string
     */
    protected function checkTeamId($value, $rule ,$data)
    {
        $isHaveOrder = Db::name('order_goods')->where(['prom_type' => 6, 'prom_id' => $value])->find();
        if($isHaveOrder){
            return '该活动已有用户下单购买不能编辑';
        }else{
            return true;
        }
    }

    protected function checkStockLimit($value, $rule ,$data){
        if($data['team_type'] != 2){
            return true;
        }
        if($value <= 0){
            return '抽奖限量必须大于0';
        }
        if($data['item_id'] > 0){
            //商品规格
            $store_count = Db::name("spec_goods_price")->where(['item_id'=>$data['item_id']])->getField('store_count');
        }else{
            $store_count = Db::name('goods')->where('goods_id',$data['goods_id'])->getField('store_count');
        }
        if($store_count < $value){
            return '商品库存只有'.$store_count.'件,不能满足'.$value.'人购买';
        }else{
            return true;
        }
    }

}