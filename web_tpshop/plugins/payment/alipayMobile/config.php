<?php
return array(
    'code'=> 'alipayMobile',
    'name' => '手机网站支付宝',
    'version' => '1.0',
    'author' => '宇宙人',
    'desc' => '手机端网站支付宝 ',
    'icon' => 'logo.jpg',
    'scene' =>1,  // 使用场景 0 PC+手机 1 手机 2 PC
    'config' => array(
        array('name' => 'alipay_account','label'=>'支付宝帐户',           'type' => 'text',   'value' => ''),
        array('name' => 'alipay_key','label'=>'交易安全校验码',               'type' => 'text',   'value' => ''),
        array('name' => 'alipay_partner','label'=>'合作者身份ID',           'type' => 'text',   'value' => ''),
        array('name' => 'alipay_private_key','label'=>'秘钥',           'type' => 'textarea',   'value' => ''),
        array('name' => 'alipay_pay_method','label'=>' 选择接口类型',        'type' => 'select', 'option' => array(
          '0' =>  '使用担保交易接口',
          '1' => '使用即时到帐交易接口',
        )),
        array('name' => 'is_bank','label'=>'是否开通网银',        'type' => 'select', 'option' => array(
            '0' => '否',
            '1' =>  '是',
        )),
    ),    
);