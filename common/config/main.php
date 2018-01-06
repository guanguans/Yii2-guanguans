<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'language' => 'zh-CN',//默认语言
    'timeZone' => 'Asia/Shanghai',//默认时区
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // 这个要设置为false,才会真正的发邮件
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.qq.com',
                'username' => '798314049@qq.com',
                'password' => 'ocoxnzwjvpcgbfcf',
                'port' => '465',
                'encryption' => 'ssl',
            ],
            'messageConfig'=>[
                'charset'=>'UTF-8',
                'from'=>['798314049@qq.com'=>'客服名称']
            ],
        ],


    ],
];
