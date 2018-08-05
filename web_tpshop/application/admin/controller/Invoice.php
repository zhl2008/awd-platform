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
 * 发票控制器
 * Author: 545
 * Date: 2017-10-23
 */

namespace app\admin\controller;

use think\AjaxPage;
use think\Db;
use think\Page;

class Invoice extends Base {
    /*
     * 初始化操作
     */

    public function _initialize() {
        
        parent::_initialize();
        C('TOKEN_ON', false); // 关闭表单令牌验证
    }

    /*
     * 发票列表
     */

    public function index() {
       header("Content-type: text/html; charset=utf-8");
exit("请联系TPshop官网客服购买高级版支持此功能");
    }
    
    /**
     * 发票列表 ajax
     * @date 2017/10/23
     */
    public function ajaxindex() {
    header("Content-type: text/html; charset=utf-8");
exit("请联系TPshop官网客服购买高级版支持此功能");
    }
    
    
     //开票时间
    function changetime(){
        
     header("Content-type: text/html; charset=utf-8");
exit("请联系TPshop官网客服购买高级版支持此功能");

    }
    
    
    public function export_invoice()
    {
    header("Content-type: text/html; charset=utf-8");
exit("请联系TPshop官网客服购买高级版支持此功能");
    }

}
