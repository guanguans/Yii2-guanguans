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
        'static/css/bootstrap.min14ed.css?v=3.3.6',
        //'//cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css',
        'static/font-awesome/css/font-awesome.css?v=4.3.0',
        'static/css/animate.min.css',
        'static/css/style.min862f.css?v=4.1.0',
        'static/css/plugins/sweetalert/sweetalert.css',
        'static/js/plugins/layer/laydate/need/laydate.css',
        //'js/plugins/layer/laydate/skins/default/laydate.css'
        'static/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css',
        'static/css/plugins/toastr/toastr.min.css',
    ];
    public $js = [
        'static/js/feehi.js',
        'static/js/plugins/sweetalert/sweetalert.min.js',
        'static/js/plugins/layer/laydate/laydate.js',
        'static/js/plugins/layer/layer.min.js',
        'static/js/plugins/prettyfile/bootstrap-prettyfile.js',
        'static/js/plugins/toastr/toastr.min.js',
        // 统计代码
        // 'http://tajs.qq.com/stats?sId=9051096',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
