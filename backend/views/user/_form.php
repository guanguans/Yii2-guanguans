<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
    <?php $form = ActiveForm::begin([
            'fieldConfig' => [
                'template' => "{label}<div class='col-md-6'>{input}\n{error}\n{hint}</div>",
            ],
            'options' => [
                'class' => 'form-horizontal m-t',
                'id'=>'signupForm',
            ],
        ]); ?>
        <?= $form->field($model, 'username')->textInput()->label(null, ['for'=>'firstname', 'class'=>'col-sm-2 control-label']) ?>
        <?= $form->field($model, 'password_hash')->textInput()->label(null, ['for'=>'firstname', 'class'=>'col-sm-2 control-label']) ?>
        <?= $form->field($model, 'email')->textInput()->label(null, ['for'=>'firstname', 'class'=>'col-sm-2 control-label']) ?>
        <?= $form->field($model, 'status')->dropDownList(
            ['10'=>'正常','0'=>'禁用'],
            ['prompt'=>'请选择',]
        )->label(null, ['for'=>'firstname', 'class'=>'col-sm-2 control-label']) ?>
        <div class="form-group">
            <div class="col-sm-8 col-sm-offset-3">
                <button class="btn btn-success" type="submit">保存</button>
                <!-- <a class="btn btn-default" onclick="window.history.back();">返回</a> -->
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
</div>
