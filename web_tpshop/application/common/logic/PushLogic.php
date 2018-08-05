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
 * Author: lhb
 * Date: 2017-05-19
 */

namespace app\common\logic;

require_once './vendor/jpush/jpush/autoload.php';

/**
 * Class orderLogic
 * @package Common\Logic
 */
class PushLogic
{
    private $jpush = null;
    
    function __construct() 
    {
        $config = M('config')->field('name,value')->where('name', 'IN', 'jpush_app_key,jpush_master_secret')->select();
        foreach ($config as $v) {
            $c[$v['name']] = $v['value'];
        }
        if ($c['jpush_app_key'] &&  $c['jpush_master_secret']) {
            $this->jpush = new \JPush\Client($c['jpush_app_key'], $c['jpush_master_secret']);
            //$this->jpush = new \JPush\Client('e3e4c1a919f5781357e7f693', 'c9bfba5714254d6d41d677aa');
        }
    }
    
    /**
     * 推送消息
     * @param array $data 发送的数据
     * @param type $all 1向所有用户发送，0,向指定用户发送
     * @param array $push_ids 推送id
     */
    public function push($data, $all = 0, $push_ids = [])
    {
        if ($push_ids && is_array($push_ids)) {
            foreach ($push_ids as $k => $p) {
                if (empty($p)) {
                    unset($push_ids[$k]);
                }
            }
            if (!$push_ids) {
                return ['status' => 1, 'msg' => '用户的推送ID无效，但不影响'];
            }
        }
        
        if (!$this->jpush) {
            return ['status' => -1, 'msg' => '推送初始化不成功！'];
        } elseif (!$all && !$push_ids) {
            return ['status' => -1, 'msg' => '个体推送时没有指定用户！'];
        }
        
        $data = json_encode($data, JSON_UNESCAPED_UNICODE);
        $push = $this->jpush->push()
                ->setPlatform('all')
                ->message($data);
        if ($all) {
            $push = $push->addAllAudience();
        } else {
            $push = $push->addRegistrationId($push_ids);
        }
        
        try {
            $response = $push->send();
            if ($response['http_code'] != 200) {
                return ['status' => -1, 'msg' => "http错误码:{$response['http_code']}", 'result' => $response];
            }
            return ['status' => 1, 'msg' => '已推送', 'result' => $response];
        } catch (\JPush\Exceptions\APIConnectionException $e) {
            return ['status' => -1, 'msg' => $e->getMessage()];
        } catch (\JPush\Exceptions\APIRequestException $e) {
            return ['status' => -1, 'msg' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => -1, 'msg' => $e->getMessage()];
        }
    }
}