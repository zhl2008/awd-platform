<?php

return array(
    'code'=> 'weixin',
    'name' => '微信登录',
    'version' => '1.0',
    'author' => '彭老师',
    'desc' => '微信扫码登录插件 ',
    'icon' => 'logo.jpg',
    'config' => array(
        array('name' => 'appid','label'=>'开放平台appid','type' => 'text',   'value' => ''),
        array('name' => 'secret','label'=>'开放平台secret','type' => 'text',   'value' => '')
    )
);