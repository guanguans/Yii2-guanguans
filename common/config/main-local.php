<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=yiiblog',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
            'tablePrefix' => 'feehi_',
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
