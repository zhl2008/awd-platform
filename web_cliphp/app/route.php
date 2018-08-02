<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    '__pattern__' => [
        'name' => '\w+',
        'id' => '\d+',
        'catId' => '\d+',
    ],
    '[hello]'     => [
        ':id'   => ['home/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['home/hello', ['method' => 'post']],
    ],
    'index' => 'home/index/index',

    'news/:catId' => 'home/news/index',
    'newsInfo/:id/:catId' => 'home/news/info',

    'about/:catId' => 'home/about/index',

    'system/:catId' => 'home/system/index',

    'services/:catId' => 'home/services/index',
    'servicesInfo/:id/:catId' => 'home/services/info',

    'team/:catId' => 'home/team/index',
    'contact/:catId' => 'home/contact/index',
];
