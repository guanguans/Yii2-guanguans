<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'static/css/bootstrap.min.css?v=3.4.0',
        'static/font-awesome/css/font-awesome.css?v=4.3.0',
        'static/css/animate.css',
        'static/css/style.css?v=2.2.0',
    ];
    public $js = [
        'static/js/jquery-2.1.1.min.js',
        'static/js/bootstrap.min.js?v=3.4.0',
        // 统计代码
        // 'http://tajs.qq.com/stats?sId=9051096',
    ];
    public $depends = [
    ];
}
