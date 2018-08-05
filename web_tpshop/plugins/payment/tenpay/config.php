<?php
return array(
    'code'=> 'tenpay',
    'name' => 'PC端财付通',
    'version' => '1.0',
    'author' => 'IT宇宙人',
    'desc' => 'PC端财付通插件 ',
    'scene' =>2,  // 使用场景 0 PC+手机 1 手机 2 PC
    'icon' => 'logo.jpg',
    'config' => array(
        //array('name' => 'spname','label'=>'spname',           'type' => 'text',   'value' => '财付通双接口测试'),
        array('name' => 'partner','label'=>'partner',               'type' => 'text',   'value' => ''),
        array('name' => 'key','label'=>'key',           'type' => 'text',   'value' => ''),       
    ),
);