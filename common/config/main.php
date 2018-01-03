<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'language' => 'zh-CN',//默认语言
    'timeZone' => 'Asia/Shanghai',//默认时区
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    /*'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],*/
];
