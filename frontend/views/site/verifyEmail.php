<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'verifyEmail';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="alert alert-danger" role="alert">
        <div class="alert-body">
            <h5 class="welcome-title ng-binding">Hi, </h5>
            <p class="welcome-tips">感谢您注册琯琯博客。</p>
            <p class="welcome-tips ng-scope" >该邮箱已激活，请不要重复操作</p>
            <a class="btn btn-primary btn-emphasis ng-scope" href="<?= Url::to('login') ?>">立即登录</a>
        </div>
    </div>
</div>
