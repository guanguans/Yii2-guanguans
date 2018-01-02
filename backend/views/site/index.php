<?php
use backend\assets\MyAppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

// $this 代表视图对象
MyAppAsset::register($this);  
$this->params['breadcrumbs'][] = $this->title;
$this->title = '主页';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta name="keywords" content="H+后台主题,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题。">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">

                        <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="/static/img/profile_small.jpg" />
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                                <span class="text-muted text-xs block">超级管理员 <b class="caret"></b></span> </span>
                                <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">admin</strong></span>  
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="contacts.html">联系我们</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="login.html">安全退出</a>
                                </li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            H+
                        </div>

                    </li>
                    <li>
                        <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">主页</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="index_1.html">主页示例一</a>
                            </li>
                            <li><a href="index_2.html">主页示例二</a>
                            </li>
                            <li><a href="index_3.html">主页示例三</a>
                            </li>
                            <li><a href="index_4.html">主页示例四</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="layouts.html"><i class="fa fa-columns"></i> <span class="nav-label">布局</span></a>
                    </li>                    
                    <li>
                        <a href="index.html#"><i class="fa fa-sitemap"></i> <span class="nav-label">菜单 </span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="index.html#">三级菜单 <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="index.html#">三级菜单 01</a>
                                    </li>
                                    <li>
                                        <a href="index.html#">三级菜单 01</a>
                                    </li>
                                    <li>
                                        <a href="index.html#">三级菜单 01</a>
                                    </li>

                                </ul>
                            </li>
                            <li><a href="index.html#">二级菜单</a>
                            </li>
                            <li>
                                <a href="index.html#">二级菜单</a>
                            </li>
                            <li>
                                <a href="index.html#">二级菜单</a>
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message"><a href="#" title="返回首页"><i class="fa fa-home"></i>前台</a></span>
                        </li>
                        <li>
                            <span class="m-r-sm text-muted welcome-message"><a href="#" title="返回首页"><i class="fa fa-home"></i></a>刷新</span>
                        </li>
                        <li>
                            <span class="m-r-sm text-muted welcome-message"><a href="#" title="返回首页"><i class="fa fa-home"></i></a>清除缓冲</span>
                        </li>
                        <li>
                            <a href="<?= Url::to(['site/logout']) ?>">
                                <i class="fa fa-sign-out"></i> 退出
                            </a>
                        </li>
                    </ul>

                </nav>
            </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2>标题</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">主页</a>
                        </li>
                        <li>
                            <strong>包屑导航</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-sm-8">
                    <div class="title-action">
                        <a href="empty_page.html" class="btn btn-primary">活动区域</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper wrapper-content">
                        <div class="middle-box text-center animated fadeInRightBig">
                            <h3 class="font-bold">这里是页面内容</h3>

                            <div class="error-desc">
                                您可以在这里添加栅格，参考首页及其他页面完成不同的布局
                                <br/><a href="index.html" class="btn btn-primary m-t">打开主页</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer">
                <div class="pull-right">
                    By：<a href="http://www.zi-han.net" target="_blank">zihan's blog</a>
                </div>
                <div>
                    <strong>Copyright</strong> H+ &copy; 2014
                </div>
            </div>

        </div>
    </div>
    </div>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>