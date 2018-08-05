<?php
return array(
    'code'=> 'unionpay',
    'name' => '银联在线支付',
    'version' => '1.0',
    'author' => '奇闻科技',
    'desc' => '银联在线支付插件 ',
    'scene' =>0,  // 使用场景 0 PC+手机 1 手机 2 PC
    'icon' => 'logo.jpg',
    'config' => array(
        array('name' => 'unionpay_mid','label'=>'商户号',           'type' => 'text',   'value' => '777290058130619'),
        array('name' => 'unionpay_cer_password','label'=>' 商户私钥证书密码',               'type' => 'text',   'value' => '000000'),
        array('name' => 'unionpay_user','label'=>' 企业网银账号',               'type' => 'text',   'value' => '123456789001'),
		array('name' => 'unionpay_password','label'=>' 企业网银密码',               'type' => 'text',   'value' => '789001')
    )
);