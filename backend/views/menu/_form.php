<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-form">
    <div class="col-md-2"></div>
    <div class="col-md-6">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->dropDownList(['0'=>'后台菜单', '1'=>'前台导航']) ?>

    <div class="form-group field-menu-parent_id has-success">
        <label class="control-label" for="menu-parent_id">上级</label>
        <select id="menu-parent_id" class="form-control" name="Menu[parent_id]" style="" aria-invalid="false">
            <option value="0">作为一级菜单</option>
            <?= $model->menuTree([$model->parent_id]) ?>
        </select>
        <div class="help-block"></div>
    </div>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'icon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sort')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_display')->dropDownList(['1'=>'显示', '0'=>'隐藏']) ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>

</div>
