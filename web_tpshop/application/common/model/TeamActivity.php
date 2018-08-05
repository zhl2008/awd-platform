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
namespace app\common\model;

use think\Model;
use think\Request;

class TeamActivity extends Model
{
    public function specGoodsPrice(){
        return $this->hasOne('specGoodsPrice','item_id','item_id');
    }
    public function goods(){
        return $this->hasOne('goods','goods_id','goods_id');
    }
    public function teamFound(){
        return $this->hasMany('teamFound','team_id','team_id');
    }

    public function getTeamTypeDescAttr($value, $data){
        $status = config('TEAM_TYPE');
        return $status[$data['team_type']];
    }
    public function getTimeLimitHoursAttr($value, $data){
        return $data['time_limit'] / 3600;
    }
    //分享链接
    public function getBdUrlAttr($value, $data){
        return U('Mobile/Team/info',['goods_id'=>$data['goods_id'],'team_id'=>$data['team_id']],'',true);
    }
    public function getBdPicAttr($value, $data){
        $request = Request::instance();
        return $request->domain().$data['share_img'];
    }
    public function getLotteryUrlAttr($value, $data){
        return U('Mobile/Team/lottery',['team_id'=>$data['team_id']],'',true);
    }
    public function getStatusDescAttr($value, $data){
        $status = array('关闭', '启用');
        return $status[$data['status']];
    }
    public function getVirtualSaleNumAttr($value, $data){
        return $data['virtual_num'] + $data['sales_sum'];
    }

    /**
     * 前台显示拼团详情
     */
    public function getFrontStatusDescAttr($value, $data){
        if($data['status'] != 1){
            return '活动未上架';
        }
        if($data['team_type'] == 2){
            if($data['is_lottery'] == 1){
                return '已开奖';
            }else{
                return '拼团中';
            }
        }else{
            return '拼团中';
        }
    }


    public function setTimeLimitAttr($value, $data){
        return $value * 3600;
    }
    public function setBonusAttr($value,$data)
    {
        return ($data['team_type'] != 1) ? 0 : $value;
    }
    public function setBuyLimitAttr($value,$data){
        return ($data['team_type'] == 2) ? 1 : $value;
    }
}
