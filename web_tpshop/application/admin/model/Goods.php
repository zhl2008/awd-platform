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
use think\Db;
class Goods extends Model {
    /**
     * 一个商品对应多个规格
     */
    public function specGoodsPrice()
    {
        return $this->hasMany('SpecGoodsPrice','goods_id','goods_id');
    }
    public function getShippingAreaIdArrAttr($value,$data)
    {
        if($data['shipping_area_ids']){
            return explode(',', $data['shipping_area_ids']);
        }else{
            return [];
        }
    }
    /**
     * 后置操作方法
     * 自定义的一个函数 用于数据保存后做的相应处理操作, 使用时手动调用
     * @param int $goods_id 商品id
     */
    public function afterSave($goods_id)
    {
        $item_img = I('item_img/a');
         // 商品货号
         $goods_sn = "TP".str_pad($goods_id,7,"0",STR_PAD_LEFT);   
         $this->where("goods_id = $goods_id and goods_sn = ''")->save(array("goods_sn"=>$goods_sn)); // 根据条件更新记录
                 
         // 商品图片相册  图册
         $goods_images = I('goods_images/a');
         if(count($goods_images) > 1)
         {                          
             array_pop($goods_images); // 弹出最后一个             
             $goodsImagesArr = M('GoodsImages')->where("goods_id = $goods_id")->getField('img_id,image_url'); // 查出所有已经存在的图片
             
             // 删除图片
             foreach($goodsImagesArr as $key => $val)
             {
                 if(!in_array($val, $goods_images))
                     M('GoodsImages')->where("img_id = {$key}")->delete(); // 
             }
             // 添加图片
             foreach($goods_images as $key => $val)
             {
                 if($val == null)  continue;                                  
                 if(!in_array($val, $goodsImagesArr))
                 {                 
                        $data = array(
                            'goods_id' => $goods_id,
                            'image_url' => $val,
                        );
                        M("GoodsImages")->insert($data); // 实例化User对象                     
                 }
             }
         }
         // 查看主图是否已经存在相册中
         $original_img = I('original_img');
         $c = M('GoodsImages')->where("goods_id = $goods_id and image_url = '{$original_img}'")->count(); 
          
         //@modify by wangqh fix:删除商品详情的图片(相册图刚好是主图时)删除的图片仍然在相册中显示. 如果主图存物理图片存在才添加到相册 @{
         $deal_orignal_img = str_replace('../','',$original_img);
         $deal_orignal_img= trim($deal_orignal_img,'.');
         $deal_orignal_img= trim($deal_orignal_img,'/');
         if($c == 0 && $original_img && file_exists($deal_orignal_img)) //@}
         {
             M("GoodsImages")->add(array('goods_id'=>$goods_id,'image_url'=>$original_img)); 
         }
         delFile(UPLOAD_PATH."goods/thumb/$goods_id"); // 删除缩略图
         
         // 商品规格价钱处理        
//         M("SpecGoodsPrice")->where('goods_id = '.$goods_id)->delete(); // 删除原有的价格规格对象
        $goods_item = I('item/a');
        if ($goods_item) {
            $keyArr = '';//规格key数组
            foreach ($goods_item as $k => $v) {
                $keyArr .= $k.',';
                // 批量添加数据
                $v['price'] = trim($v['price']);
                $store_count = $v['store_count'] = trim($v['store_count']); // 记录商品总库存
                $v['sku'] = trim($v['sku']);
                $data = ['goods_id' => $goods_id, 'key' => $k, 'key_name' => $v['key_name'], 'price' => $v['price'], 'store_count' => $v['store_count'], 'sku' => $v['sku']];
                $specGoodsPrice = Db::name('spec_goods_price')->where(['goods_id' => $data['goods_id'], 'key' => $data['key']])->find();
                if ($item_img) {
                    $spec_key_arr = explode('_', $k);
                    foreach ($item_img as $key => $val) {
                        if (in_array($key, $spec_key_arr)) {
                            $data['spec_img'] = $val;
                            break;
                        }
                    }
                }
                if ($specGoodsPrice) {
                    Db::name('spec_goods_price')->where(['goods_id' => $goods_id, 'key' => $k])->update($data);
                } else {
                    Db::name('spec_goods_price')->insert($data);
                }
                $dataList[] = $data;
                // 修改商品后购物车的商品价格也修改一下
                M('cart')->where("goods_id = $goods_id and spec_key = '$k'")->save(array(
                    'market_price' => $v['price'], //市场价
                    'goods_price' => $v['price'], // 本店价
                    'member_goods_price' => $v['price'], // 会员折扣价
                ));
            }
            if($keyArr){
                Db::name('spec_goods_price')->where('goods_id',$goods_id)->whereNotIn('key',$keyArr)->delete();
            }
//             M("SpecGoodsPrice")->insertAll($dataList);

        }
         
         // 商品规格图片处理
         if(I('item_img/a'))
         {    
             M('SpecImage')->where("goods_id = $goods_id")->delete(); // 把原来是删除再重新插入
             foreach (I('item_img/a') as $key => $val)
             {                 
                 M('SpecImage')->insert(array('goods_id'=>$goods_id ,'spec_image_id'=>$key,'src'=>$val));
             }                                                    
         }
         refresh_stock($goods_id); // 刷新商品库存
    }
}
