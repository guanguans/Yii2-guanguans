<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'class' => 'well form-inline',
            'id'=>'signupForm',
        ],
    ]); ?>
    用户ID：
    <input class="form-control" type="text" name="UserSearch[id]" style="width: 200px;" value="" placeholder="请输入用户ID">
    用户名：
    <input class="form-control" type="text" name="UserSearch[username]" style="width: 200px;" value="" placeholder="用户名">
    邮箱
    <input class="form-control" type="text" name="UserSearch[id]" style="width: 200px;" value="" placeholder="邮箱">
    状态
    <input class="form-control" type="text" name="UserSearch[username]" style="width: 200px;" value="" placeholder="状态">
    <input type="submit" class="btn btn-primary" value="搜索">
    <input type="reset" class="btn btn-danger" value="重置">
    <?php ActiveForm::end(); ?>
</div>
