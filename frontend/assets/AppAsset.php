<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'static/font-awesome/css/font-awesome.css?v=4.3.0',
        'static/share.js/dist/css/share.min.css',
    ];
    public $js = [
        'static/share.js/src/js/social-share.js',
        'static/share.js/src/js/qrcode.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
