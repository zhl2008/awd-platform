<?php
/**
 * tpshop
 * ============================================================================
 * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: lhb
 * Date: 2017-05-15
 */

namespace app\common\logic;
use think\Model;


/**
 * 拼单逻辑类
 */
class TeamFoundLogic extends Model
{
    protected $teamFound;//团长模型
    protected $team;//拼团模型
    /**
     * 设置拼团模型
     * @param $team
     */
    public function setTeam($team)
    {
        $this->team = $team;
    }
    /**
     * 设置团长模型
     * @param $teamFound
     */
    public function setTeamFound($teamFound)
    {
        $this->teamFound = $teamFound;
    }

    /**
     * 检查该单是否可以拼
     * @return array
     */
    public function TeamFoundIsCanFollow()
    {
        if($this->teamFound['team_id'] != $this->team['team_id']){
            return ['status' => 0, 'msg' => '该拼单数据不存在或已失效', 'result' => ''];
        }
        if($this->teamFound['join'] >= $this->teamFound['need']){
            return ['status' => 0, 'msg' => '该单已成功结束', 'result' => ''];
        }
        if(time() - $this->teamFound['found_time'] > $this->team['time_limit']){
            return ['status' => 0, 'msg' => '该拼单已过期', 'result' => ''];
        }
        return ['status' => 1, 'msg' => '能拼', 'result' => ''];
    }
}