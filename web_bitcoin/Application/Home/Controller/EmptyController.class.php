<?php
namespace Home\Controller;
use Think\Controller;

class EmptyController extends HomeController
{

    public function _empty() {
        send_http_status(404);
        $this->error();
        echo '模块不存在！';
        die();

    }


}