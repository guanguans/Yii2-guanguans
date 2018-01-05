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
        'static/css/bootstrap.min.css',
        'static/font-awesome/css/font-awesome.css?v=4.3.0',
        'static/css/style.min862f.css?v=4.1.0',
        'static/css/plugins/toastr/toastr.min.css',
    ];

    public $js = [
        "static/js/jquery-2.1.1.min.js?v=2.1.4",
        "static/js/bootstrap.min.js?v=3.3.6",
        // "static/js/feehi.js?v=4.1.0",
        "static/js/plugins/metisMenu/jquery.metisMenu.js",
        "static/js/plugins/slimscroll/jquery.slimscroll.min.js",
        "static/js/plugins/layer/layer.min.js",
        "static/js/hplus.js?v=4.1.0",
        "static/js/contabs.min.js",
        "static/js/plugins/pace/pace.min.js",
        "static/js/plugins/toastr/toastr.min.js",
        "static/js/admin.js",
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
