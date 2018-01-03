<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class MyAppAsset extends AssetBundle
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
        'static/js/bootstrap.min.js?v=3.4.0s',
        'static/js/plugins/metisMenu/jquery.metisMenu.js',
        'static/js/plugins/slimscroll/jquery.slimscroll.min.js',
        'static/js/hplus.js?v=2.2.0',
        'static/js/plugins/pace/pace.min.js',

        "static/js/plugins/layer/layer.min.js",
        "static/js/contabs.min.js",
    ];
    public $depends = [
        /*'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',*/
    ];
}
