<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            // yii2-admin的导航菜单
            // 'layout' => 'left-menu',
        ]
    ],
    //默认语言
    'language' => 'zh-CN',
    //默认时区
    'timeZone' => 'Asia/Shanghai',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'backend\models\AdminUser',
            'enableAutoLogin' => false,
            'authTimeout' => 1800, // 登陆有效时间
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages', // if advanced application, set @frontend/messages
                    'sourceLanguage' => 'zh-CN',
                    'fileMap' => [
                        //'main' => 'main.php',
                    ],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
       "urlManager" => [
           "enablePrettyUrl" => true,
           "enableStrictParsing" => false,
           "showScriptName" => false,
           "suffix" => "",
           "rules" => [
               "<controller:\w+>/<id:\d+>"=>"<controller>/view",
               "<controller:\w+>/<action:\w+>"=>"<controller>/<action>"
           ],
       ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/index',//允许访问的节点，可自行添加
            'site/login',
            'site/main',
            'site/logout',
            'site/captcha',
        ]
    ],
    'controllerMap' => [
        'ueditor' => [
            'class' => 'crazydb\ueditor\UEditorController',
            'thumbnail' => false,//如果将'thumbnail'设置为空，将不生成缩略图。
            'watermark' => [    //默认不生存水印
                'path' => './static/img/a9.jpg', //水印图片路径
                'position' => [1, 9] //position in [1, 9]，表示从左上到右下的 9 个位置，即如1表示左上，5表示中间，9表示右下。
            ],
            'zoom' => ['height' => 900, 'width' => 900  ], //缩放，默认不缩放
            'config' => [
                //server config @see http://fex-team.github.io/ueditor/#server-config
                'imagePathFormat' => '/ueditor/image/{yyyy}{mm}{dd}/{time}{rand:6}',
                'scrawlPathFormat' => '/ueditor/image/{yyyy}{mm}{dd}/{time}{rand:6}',
                'snapscreenPathFormat' => '/ueditor/image/{yyyy}{mm}{dd}/{time}{rand:6}',
                'catcherPathFormat' => '/ueditor/image/{yyyy}{mm}{dd}/{time}{rand:6}',
                'videoPathFormat' => '/ueditor/video/{yyyy}{mm}{dd}/{time}{rand:6}',
                'filePathFormat' => '/ueditor/file/{yyyy}{mm}{dd}/{rand:4}_{filename}',
                'imageManagerListPath' => '/ueditor/image/',
                'fileManagerListPath' => '/ueditor/file/',
            ]
        ]
    ],
    'on beforeRequest' => [backend\components\Admin::className(), 'adminLog'],
    'params' => $params,
];
