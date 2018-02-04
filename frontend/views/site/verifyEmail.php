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
    	<?php if ($is_verify): ?>
        <div class="alert-body text-success">
            <h5 class="welcome-title ng-binding">Hi, </h5>
            <p class="welcome-tips">感谢您注册琯琯博客。</p>
            
            <p class="welcome-tips text-success" >该邮箱已激活，请不要重复操作</p>
            <a class="btn btn-primary" href="<?= Url::to('login') ?>">立即登录</a>
        </div>
        <?php else: ?>
        <p class="welcome-tips ng-scope" >该邮箱激活失败，请重新激活</p>
        <?php endif ?>
    </div>
</div>
