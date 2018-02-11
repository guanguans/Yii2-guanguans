<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'name' => 'My Blog',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            // 指是否开启路由美化
            'enablePrettyUrl' => true,
            // 是否忽略脚本名index.php
            'enableStrictParsing' => false,
            // 指是否显示 index.php
            'showScriptName' => false,
            // 伪装成 html 静态文件
            // 'suffix' => '.html',
            'rules' => [
                // /xxx/yyy?cid=1 优化为 /xxx/yyy/1
                '<controller:\w+>/<action:\w+>/<cid:\d+>' => '<controller>/<action>',
                // /site/signup 优化为 /signup ; /site/login 优化为 /login
                '<alias:login|signup|contact|elastic-search>' => 'site/<alias>',
                // 指定 /site/index 为默认首页
                '/' => 'site/index',
                
                /*// 搜索的时候 /column/index?category_id=1&name=forecho 优化为 /column/search-1-forecho
                'column/search-<category_id:\d+>-<name:\w+>' => 'column/index',
                // /column/index 优化为 /columns
                'columns' => 'column/index',
                // /column/view?id=1 优化为 /column/1
                'column/<id:\d+>' => 'column/view',*/
            ],
        ],
    ],
    'params' => $params,
];
