<?php

return array(
	'DB_TYPE'              => DB_TYPE,
	'DB_HOST'              => DB_HOST,
	'DB_NAME'              => DB_NAME,
	'DB_USER'              => DB_USER,
	'DB_PWD'               => DB_PWD,
	'DB_PORT'              => DB_PORT,
	'DB_PREFIX'            => 'qq3479015851_',
	'ACTION_SUFFIX'        => '',
	'MULTI_MODULE'         => true,
	'MODULE_DENY_LIST'     => array('Common', 'Runtime'),
	'MODULE_ALLOW_LIST'    => array('Home', 'Admin'),
	'DEFAULT_MODULE'       => 'Home',
	'URL_CASE_INSENSITIVE' => true,//之前是false
	'URL_MODEL'            => 2,
	'URL_HTML_SUFFIX'      => 'html',
	'UPDATE_PATH'          => '',
	'CLOUD_PATH'           => '',
    'HOST_IP'	=> '',
	'TMPL_CACHFILE_SUFFIX' =>'.php',
	'DATA_CACHE_TYPE'      => 'file',
	'URL_PARAMS_SAFE'	   => true,
	'DEFAULT_FILTER'       =>'check_qq3479015851,htmlspecialchars,strip_tags',
	'URL_PARAMS_FILTER_TYPE' =>'check_qq3479015851,htmlspecialchars,strip_tags',
	'MY_DEFAULT_FILTER'       =>'check_qq3479015851,htmlspecialchars,strip_tags,assert',
	);
?>
