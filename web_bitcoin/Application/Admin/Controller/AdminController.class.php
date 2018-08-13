<?php
namespace Admin\Controller;

class AdminController extends \Think\Controller
{
    public function __construct()
    {
        parent::__construct();

        defined('APP_DEMO') || define('APP_DEMO', 0);

        if (!session('admin_id')) {
            $this->redirect('Admin/Login/index');
        }

        define('UID', session('admin_id'));
        $config = M('Config')->where(array('id' => 1))->find();
        C($config);
        $coin = (APP_DEBUG ? null : S('home_coin'));

        if (!$coin) {
            $coin = M('Coin')->where(array('status' => 1))->select();
            S('home_coin', $coin);
        }

        $coinList = array();

        foreach ($coin as $k => $v) {
            $coinList['coin'][$v['name']] = $v;

            if ($v['name'] != 'cny') {
                $coinList['coin_list'][$v['name']] = $v;
            }

            if ($v['type'] == 'rmb') {
                $coinList['rmb_list'][$v['name']] = $v;
            } else {
                $coinList['xnb_list'][$v['name']] = $v;
            }

            if ($v['type'] == 'rgb') {
                $coinList['rgb_list'][$v['name']] = $v;
            }

            if ($v['type'] == 'qbb') {
                $coinList['qbb_list'][$v['name']] = $v;
            }
        }

        C($coinList);
        $market = (APP_DEBUG ? null : S('home_market'));

        if (!$market) {
            $market = M('Market')->where(array('status' => 1))->select();
            S('home_market', $market);
        }

        foreach ($market as $k => $v) {
            $v['new_price'] = round($v['new_price'], $v['round']);
            $v['buy_price'] = round($v['buy_price'], $v['round']);
            $v['sell_price'] = round($v['sell_price'], $v['round']);
            $v['min_price'] = round($v['min_price'], $v['round']);
            $v['max_price'] = round($v['max_price'], $v['round']);
            $v['xnb'] = explode('_', $v['name'])[0];
            $v['rmb'] = explode('_', $v['name'])[1];
            $v['xnbimg'] = C('coin')[$v['xnb']]['img'];
            $v['rmbimg'] = C('coin')[$v['rmb']]['img'];
            $v['volume'] = $v['volume'] * 1;
            $v['change'] = $v['change'] * 1;
            $v['title'] = C('coin')[$v['xnb']]['title'] . '(' . strtoupper($v['xnb']) . '/' . strtoupper($v['rmb']) . ')';
            $marketList['market'][$v['name']] = $v;
        }

        C($marketList);
        $C = C();

        foreach ($C as $k => $v) {
            $C[strtolower($k)] = $v;
        }

        $this->assign('C', $C);

        if (session('admin_id') == 1) {
            $currentVersion = file_get_contents('./Database/version.ini');
            $nextVersion = M('Version')->where(array('status' => 0))->order('name desc')->getField('name');

            if ($nextVersion && ($currentVersion != $nextVersion)) {
                $this->assign('versionUp', 1);
            }

            define('IS_ROOT', 1);
        } else {
            define('IS_ROOT', 0);
        }

        $access = $this->accessControl();
		
		
		
		
		
        if ($access === false) {
            $this->error('403:禁止访问');
        } else if ($access === null) {
            $dynamic = $this->checkDynamic();
			
			;
			
            if ($dynamic === null) {
                $rule = strtolower(MODULE_NAME . '/' . CONTROLLER_NAME . '/' . ACTION_NAME);
                //if (!$this->checkRule($rule, array('in', '1,2'))) {
                 //   $this->error('未授权访问!');
                //}
            } else if ($dynamic === false) {
                $this->error('未授权访问!');
            }
        }

        $this->assign('__MENU__', $this->getMenus());
    }

    public function index()
    {
        $this->redirect('Admin/Index/index');
    }

    final protected function checkRule($rule, $type = \Common\Model\AuthRuleModel::RULE_URL, $mode = 'url')
    {
        if (IS_ROOT) {
            return true;
        }

        static $Auth;

        if (!$Auth) {
            $Auth = new \Think\Auth();
        }

        if (!$Auth->check($rule, UID, $type, $mode)) {
            return false;
        }

        return true;
    }

    final protected function editRow($model, $data, $where, $msg)
    {
        $id = array_unique((array)I('id', 0));
        $id = (is_array($id) ? implode(',', $id) : $id);
        $where = array_merge(array(
            'id' => array('in', $id)
        ), (array)$where);
        $msg = array_merge(array('success' => '操作成功！', 'error' => '操作失败！', 'url' => '', 'ajax' => IS_AJAX), (array)$msg);

        if (M($model)->where($where)->save($data) !== false) {
            $this->success($msg['success'], $msg['url'], $msg['ajax']);
        } else {
            $this->error($msg['error'], $msg['url'], $msg['ajax']);
        }
    }

    protected function forbid($model, $where = array(), $msg = array('success' => '状态禁用成功！', 'error' => '状态禁用失败！'))
    {
        $data = array('status' => 0);
        $this->editRow($model, $data, $where, $msg);
    }

    protected function resume($model, $where = array(), $msg = array('success' => '状态恢复成功！', 'error' => '状态恢复失败！'))
    {
        $data = array('status' => 1);
        $this->editRow($model, $data, $where, $msg);
    }

    protected function restore($model, $where = array(), $msg = array('success' => '状态还原成功！', 'error' => '状态还原失败！'))
    {
        $data = array('status' => 1);
        $where = array_merge(array('status' => -1), $where);
        $this->editRow($model, $data, $where, $msg);
    }

    protected function delete($model, $where = array(), $msg = array('success' => '删除成功！', 'error' => '删除失败！'))
    {
        $data['status'] = -1;
        $data['update_time'] = NOW_TIME;
        $this->editRow($model, $data, $where, $msg);
    }

    public function setStatus($Model = CONTROLLER_NAME)
    {
        $ids = I('request.ids');
        $status = I('request.status');

        if (empty($ids)) {
            $this->error('请选择要操作的数据');
        }

        $map['id'] = array('in', $ids);

        switch ($status) {
            case -1:
                $this->delete($Model, $map, array('success' => '删除成功', 'error' => '删除失败'));
                break;

            case 0:
                $this->forbid($Model, $map, array('success' => '禁用成功', 'error' => '禁用失败'));
                break;

            case 1:
                $this->resume($Model, $map, array('success' => '启用成功', 'error' => '启用失败'));
                break;

            default:
                $this->error('参数错误');
                break;
        }
    }

    protected function checkDynamic()
    {
        if (IS_ROOT) {
            return true;
        }

        return null;
    }

    final protected function accessControl()
    {
        if (IS_ROOT) {
            return true;
        }

        $allow = C('ALLOW_VISIT');
        $deny = C('DENY_VISIT');
        $check = strtolower(CONTROLLER_NAME . '/' . ACTION_NAME);

        if (!empty($deny) && in_array_case($check, $deny)) {
            return false;
        }

        if (!empty($allow) && in_array_case($check, $allow)) {
            return true;
        }

        return null;
    }

    final public function getMenus($controller = CONTROLLER_NAME)
    {
        if (empty($menus)) {
            $where['pid'] = 0;
            $where['hide'] = 0;

            if (!C('DEVELOP_MODE')) {
                $where['is_dev'] = 0;
            }

            $menus['main'] = M('Menu')->where($where)->order('sort asc')->select();
            $menus['child'] = array();
            $current = M('Menu')->where('url like \'' . $controller . '/' . ACTION_NAME . '%\'')->field('id')->find();

            if (!$current) {
                $current = M('Menu')->where('url like \'' . $controller . '/%\'')->field('id')->find();
            }

            if ($current) {
                $nav = D('Menu')->getPath($current['id']);
                $nav_first_title = $nav[0]['title'];

                foreach ($menus['main'] as $key => $item) {
                    if (!is_array($item) || empty($item['title']) || empty($item['url'])) {
                        $this->error('控制器基类$menus属性元素配置有误');
                    }

                    if (stripos($item['url'], MODULE_NAME) !== 0) {
                        $item['url'] = MODULE_NAME . '/' . $item['url'];
                    }

                    if (!IS_ROOT && !$this->checkRule($item['url'], \Common\Model\AuthRuleModel::RULE_MAIN, null)) {
                        unset($menus['main'][$key]);
                        continue;
                    }

                    if ($item['title'] == $nav_first_title) {
                        $menus['main'][$key]['class'] = 'current';
                        $groups = M('Menu')->where('pid = ' . $item['id'])->distinct(true)->field('`group`')->select();

                        if ($groups) {
                            $groups = array_column($groups, 'group');
                        } else {
                            $groups = array();
                        }

                        $where = array();
                        $where['pid'] = $item['id'];
                        $where['hide'] = 0;

                        if (!C('DEVELOP_MODE')) {
                            $where['is_dev'] = 0;
                        }

                        $second_urls = M('Menu')->where($where)->getField('id,url');

                        if (!IS_ROOT) {
                            $to_check_urls = array();

                            foreach ($second_urls as $key => $to_check_url) {
                                if (stripos($to_check_url, MODULE_NAME) !== 0) {
                                    $rule = MODULE_NAME . '/' . $to_check_url;
                                } else {
                                    $rule = $to_check_url;
                                }

                                if ($this->checkRule($rule, \Common\Model\AuthRuleModel::RULE_URL, null)) {
                                    $to_check_urls[] = $to_check_url;
                                }
                            }
                        }

                        foreach ($groups as $g) {
                            $map = array('group' => $g);

                            if (isset($to_check_urls)) {
                                if (empty($to_check_urls)) {
                                    continue;
                                } else {
                                    $map['url'] = array('in', $to_check_urls);
                                }
                            }

                            $map['pid'] = $item['id'];
                            $map['hide'] = 0;

                            if (!C('DEVELOP_MODE')) {
                                $map['is_dev'] = 0;
                            }

                            $menuList = M('Menu')->where($map)->field('id,pid,title,url,tip,ico_name')->order('sort asc')->select();
                            $menus['child'][$g] = list_to_tree($menuList, 'id', 'pid', 'operater', $item['id']);
                        }

                        if ($menus['child'] === array()) {
                        }
                    }
                }
            }
        }

        return $menus;
    }

    final protected function returnNodes($tree = true)
    {
        static $tree_nodes = array();

        if ($tree && !empty($tree_nodes[(int)$tree])) {
            return $tree_nodes[$tree];
        }

        if ((int)$tree) {
            $list = M('Menu')->field('id,pid,title,url,tip,hide')->where(array('hide'=>0))->order('sort asc')->select();

            foreach ($list as $key => $value) {
                if (stripos($value['url'], MODULE_NAME) !== 0) {
                    $list[$key]['url'] = MODULE_NAME . '/' . $value['url'];
                }
            }

            $nodes = list_to_tree($list, $pk = 'id', $pid = 'pid', $child = 'operator', $root = 0);

            foreach ($nodes as $key => $value) {
                if (!empty($value['operator'])) {
                    $nodes[$key]['child'] = $value['operator'];
                    unset($nodes[$key]['operator']);
                }
            }
        } else {
            $nodes = M('Menu')->field('title,url,tip,pid')->where(array('hide'=>0))->order('sort asc')->select();

            foreach ($nodes as $key => $value) {
                if (stripos($value['url'], MODULE_NAME) !== 0) {
                    $nodes[$key]['url'] = MODULE_NAME . '/' . $value['url'];
                }
            }
        }

        $tree_nodes[(int)$tree] = $nodes;
        return $nodes;
    }

    protected function lists($model, $where = array(), $order = '', $base = array(
        'status' => array('egt', 0)
    ), $field = true)
    {
        $options = array();
        $REQUEST = (array)I('request.');

        if (is_string($model)) {
            $model = M($model);
        }

        $OPT = new \ReflectionProperty($model, 'options');
        $OPT->setAccessible(true);
        $pk = $model->getPk();

        if ($order === null) {
        } else if (isset($REQUEST['_order']) && isset($REQUEST['_field']) && in_array(strtolower($REQUEST['_order']), array('desc', 'asc'))) {
            $options['order'] = '`' . $REQUEST['_field'] . '` ' . $REQUEST['_order'];
        } else if (($order === '') && empty($options['order']) && !empty($pk)) {
            $options['order'] = $pk . ' desc';
        } else if ($order) {
            $options['order'] = $order;
        }
        unset($REQUEST['_order']);
        unset($REQUEST['_field']);
        $options['where'] = array_filter(array_merge((array)$base, (array)$where), function ($val) {
            if (($val === '') || ($val === null)) {
                return false;
            } else {
                return true;
            }
        });

        if (empty($options['where'])) {
            unset($options['where']);
        }

        $options = array_merge((array)$OPT->getValue($model), $options);
        $total = $model->where($options['where'])->count();

        if (isset($REQUEST['r'])) {
            $listRows = (int)$REQUEST['r'];
        } else {
            $listRows = (0 < C('LIST_ROWS') ? C('LIST_ROWS') : 10);
        }

        $page = new \Think\Page($total, $listRows, $REQUEST);

        if ($listRows < $total) {
            $page->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        }

        $p = $page->show();
        $this->assign('_page', $p ? $p : '');
        $this->assign('_total', $total);
        $options['limit'] = $page->firstRow . ',' . $page->listRows;
        $model->setProperty('options', $options);
        return $model->field($field)->select();
    }

    public function exportExcel($expTitle, $expCellName, $expTableData)
    {
        //import('Org.Util.PHPExcel');
        //import('Org.Util.PHPExcel.Writer.Excel5');
        //import('Org.Util.PHPExcel.IOFactory.php');
		
		
		import("Org.Util.PHPExcel");  
		import("Org.Util.PHPExcel.Writer.Excel5", '', '.php');  
		import("Org.Util.PHPExcel.IOFactory", '', '.php');
		
		
        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);
        $fileName = $_SESSION['loginAccount'] . date('_YmdHis');
        $cellNum = count($expCellName);
        $dataNum = count($expTableData);
        $objPHPExcel = new \PHPExcel();
        $cellName = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');
        $objPHPExcel->getActiveSheet(0)->mergeCells('A1:' . $cellName[$cellNum - 1] . '1');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', date('Y-m-d H:i:s') . '导出记录');
        $i = 0;

        for (; $i < $cellNum; $i++) {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i] . '2', $expCellName[$i][2]);
            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($cellName[$i])->setWidth(12);
            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('D')->setWidth(20);
            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('H')->setWidth(30);
            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('M')->setWidth(30);
            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('O')->setWidth(20);
            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('L')->setWidth(30);
        }

        $i = 0;

        for (; $i < $dataNum; $i++) {
            $j = 0;

            for (; $j < $cellNum; $j++) {
                $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j] . ($i + 3), (string)$expTableData[$i][$expCellName[$j][0]]);
            }
        }

        ob_end_clean();
        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="' . $xlsTitle . '.xls"');
        header('Content-Disposition:attachment;filename=' . $fileName . '.xls');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit();
    }

    public function _empty()
    {
        send_http_status(404);
        $this->error();
        echo '模块不存在！';
        die();

    }

     public function callOnce($url, $args=null, $method="post", $withCookie = false, $timeout = CURL_TIMEOUT, $headers=array())
    {/*{{{*/
        $ch = curl_init();
        if($method == "post")
        {
            $data = $this->convert($args);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_POST, 1);
        }
        else
        {
            $data = $this->convert($args);
            if($data)
            {
                if(stripos($url, "?") > 0)
                {
                    $url .= "&$data";
                }
                else
                {
                    $url .= "?$data";
                }
            }
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if(!empty($headers))
        {
	    ;
        }
        if($withCookie)
        {
            curl_setopt($ch, CURLOPT_COOKIEJAR, $_COOKIE);
        }
        $r = curl_exec($ch);
        curl_close($ch);
	var_dump($r);
        return $r;
    }

  public  function convert(&$args)
    {
        $data = '';
        if (is_array($args))
        {
            foreach ($args as $key=>$val)
            {
                if (is_array($val))
                {
                    foreach ($val as $k=>$v)
                    {
                        $data .= $key.'['.$k.']='.rawurlencode($v).'&';
                    }
                }
                else
                {
                    $data .="$key=".rawurlencode($val)."&";
                }
            }
            return trim($data, "&");
        }
        return $args;
    }
}
?>
