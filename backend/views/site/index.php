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
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
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
                                <span class="clear"> <span class="block m-t-xs">
                                    <strong class="font-bold">
                                        <?= Yii::$app->user->identity ? Yii::$app->user->identity->username : ''; ?>
                                    </strong>
                                </span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="<?= Url::to(['site/logout']) ?>">安全退出</a>
                                </li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            琯琯
                        </div>

                    </li>
                    <li>
                        <a class="J_menuItem" data-index="4"><i class="fa fa-columns"></i> <span class="nav-label">设置管理</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?= Url::to(['setting/website']) ?>" data-index="4"><i class="fa fa-columns"></i> <span class="nav-label">网站设置</span></a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?= Url::to(['setting/email']) ?>" data-index="4"><i class="fa fa-columns"></i> <span class="nav-label">邮箱设置</span></a>
                            </li>

                        </ul>
                    </li>
                    <li>
                        <a class="J_menuItem" data-index="4"><i class="fa fa-columns"></i> <span class="nav-label">用户管理</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?= Url::to(['user/index']) ?>" data-index="4"><i class="fa fa-columns"></i> <span class="nav-label">前台用户</span></a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?= Url::to(['admin-user/index']) ?>" data-index="4"><i class="fa fa-columns"></i> <span class="nav-label">后台用户</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="">
                        <a class="J_menuItem" data-index="4"><i class="fa fa-columns"></i> <span class="nav-label">权限管理</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level collapse" aria-expanded="false" style="height: 0px;">
                            <li>
                                <a class="J_menuItem" href="<?= Url::to(['admin/user']) ?>" data-index="4"><i class="fa fa-columns"></i> <span class="nav-label">用户列表</span></a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?= Url::to(['admin/assignment']) ?>" data-index="4"><i class="fa fa-columns"></i> <span class="nav-label">分配权限</span></a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?= Url::to(['admin/role']) ?>" data-index="4"><i class="fa fa-columns"></i> <span class="nav-label">角色列表</span></a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?= Url::to(['admin/permission']) ?>" data-index="4"><i class="fa fa-columns"></i> <span class="nav-label">权限列表</span></a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?= Url::to(['admin/route']) ?>" data-index="4"><i class="fa fa-columns"></i> <span class="nav-label">路由列表</span></a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?= Url::to(['admin/rule']) ?>" data-index="4"><i class="fa fa-columns"></i> <span class="nav-label">规则列表</span></a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?= Url::to(['admin/menu']) ?>" data-index="4"><i class="fa fa-columns"></i> <span class="nav-label">菜单列表</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="J_menuItem" data-index="4"><i class="fa fa-columns"></i> <span class="nav-label">内容管理</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?= Url::to(['category/index']) ?>" data-index="4"><i class="fa fa-columns"></i> <span class="nav-label">分类管理</span></a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?= Url::to(['article/index']) ?>" data-index="4"><i class="fa fa-columns"></i> <span class="nav-label">文章管理</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="J_menuItem" href="<?= Url::to(['friend-link/index']) ?>" data-index="4"><i class="fa fa-columns"></i> <span class="nav-label">友情连接</span></a>
                    </li>
                    <li>
                        <a class="J_menuItem" data-index="4"><i class="fa fa-columns"></i> <span class="nav-label">菜单管理</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?= Url::to(['menu/index', 'type'=>1]) ?>" data-index="4"><i class="fa fa-columns"></i> <span class="nav-label">前台导航</span></a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?= Url::to(['menu/index', 'type'=>0]) ?>" data-index="4"><i class="fa fa-columns"></i> <span class="nav-label">后台菜单</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="J_menuItem" data-index="4"><i class="fa fa-columns"></i> <span class="nav-label">缓存管理</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?= Url::to(['clear/frontend']) ?>" data-index="4"><i class="fa fa-columns"></i> <span class="nav-label">清除前台</span></a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?= Url::to(['clear/backend']) ?>" data-index="4"><i class="fa fa-columns"></i> <span class="nav-label">清除后台</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="J_menuItem" href="<?= Url::to(['admin-log/index']) ?>" data-index="4"><i class="fa fa-columns"></i> <span class="nav-label">日志管理</span></a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="gii" data-index="4"><i class="fa fa-columns"></i> <span class="nav-label">Gii</span></a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="debug" data-index="4"><i class="fa fa-columns"></i> <span class="nav-label">Debug</span></a>
                    </li>
                </ul>
            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="col-md-2">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li><a href="#" title="刷新"><i class="fa fa-home"></i>前台</a></li>
                        <li title="前台" class="hidden-xs"><a href=""><i class="fa fa-refresh"></i>刷新</a></li>
                        <li><a href="<?= Url::to(['site/logout']) ?>" title="退出"><i class="fa fa-sign-out"></i>退出</a></li>
                    </ul>
                </nav>
            </div>
            <div class="row content-tabs">
                <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i>
                </button>
                <nav class="page-tabs J_menuTabs">
                    <div class="page-tabs-content">
                        <a href="javascript:;" class="active J_menuTab"
                           data-id="<?= Url::to(['site/main']) ?>">首页</a>
                    </div>
                </nav>
                <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i>
                </button>
                <div class="btn-group roll-nav roll-right">
                    <button class="dropdown J_tabClose" data-toggle="dropdown">关闭操作<span
                                class="caret"></span>

                    </button>
                    <ul role="menu" class="dropdown-menu dropdown-menu-right">
                        <li class="J_tabShowActive"><a>定位当前选项卡</a>
                        </li>
                        <li class="divider"></li>
                        <li class="J_tabCloseAll"><a>关闭全部选项卡</a>
                        </li>
                        <li class="J_tabCloseOther"><a>关闭其他选项卡</a>
                        </li>
                    </ul>
                </div>
                <a href="javascript:void(0)" onclick="reloadIframe()" class="roll-nav roll-right J_tabExit"><i class="fa fa-refresh"></i> 刷新</a>
            </div>
            <div class="row J_mainContent" id="content-main" >
                <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="<?= Url::to(['site/main']) ?>" frameborder="0" data-id="<?= Url::to(['site/main']) ?>" seamless></iframe>
            </div>
            <div class="footer">
                <div class="pull-right">
                    By：<a href="#" target="_blank">guanguan's blog</a>
                </div>
                <div>
                    <strong>Copyright</strong> 琯琯 &copy; 2014
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php $this->endBody() ?>
</body>
<script>
    function reloadIframe() {
        var current_iframe = $("iframe:visible");
        current_iframe[0].contentWindow.location.reload();
        return false;
    }
</script>
</html>
<?php $this->endPage() ?>
