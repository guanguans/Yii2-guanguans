<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group field-category-alias required">
        <label class="control-label" for="category-alias">上级分类</label>
        <select id="category-parent_id" class="form-control" name="Category[parent_id]" aria-required="true">
            <option value="0">作为一级分类</option>
            <?= categoryTree($model->parent_id) ?>
        </select>
        <div class="help-block"></div>
    </div>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remark')->textArea(['maxlength' => true, 'rows'=>5]) ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
