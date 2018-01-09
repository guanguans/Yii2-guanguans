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
    <input class="form-control" type="text" id="usersearch-id" name="UserSearch[id]" style="width: 200px;" value="" >
    用户名：
    <input class="form-control" type="text" id="usersearch-username" name="UserSearch[username]" style="width: 200px;" value="">
    邮箱：
    <input class="form-control" type="text" id="usersearch-email" name="UserSearch[email]" style="width: 200px;" value="" >
    状态：
    <select class="form-control" id="usersearch-status" name="UserSearch[status]">
        <option value="">默认</option>
        <option value="10">正常</option>
        <option value="0">禁用</option>
    </select>
    <input type="submit" class="btn btn-primary" value="搜索">
    <input type="reset" class="btn btn-danger" value="清空">
    <?php ActiveForm::end(); ?>
</div>
