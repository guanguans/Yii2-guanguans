<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .form-group{margin: 0px; padding: 0px;}
    .help-block{margin: 5px 0px 0px 0px; padding: 0px;}
</style>
<div class="article-form">
    <?php $form = ActiveForm::begin([
            'fieldConfig' => [
                'template' => "<div class='col-md-12'>{input}{error}{hint}</div>",
            ],
            'options' => [
                'class' => 'form-horizontal m-t',
                'id'=>'signupForm',
            ],
        ]); ?>
        <div class="col-md-9">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th width="150"><?= $model->getAttributeLabel('parent_id')?></th>
                        <td>
                            <select name="parent_id" multiple class="col-md-6" style="height: 150px;" required="">
                                <?= categoryTree() ?>
                            </select>
                            <div class="col-md-12">windows：按住 Ctrl 按钮来选择多个选项,Mac：按住 command 按钮来选择多个选项</div>
                        </td>
                    </tr>
                    <tr>
                        <th><?= $model->getAttributeLabel('post_title')?></th>
                        <td>
                            <?= $form->field($model, 'post_title')->textInput()->label(false) ?>
                        </td>
                    </tr>
                    <tr>
                        <th><?= $model->getAttributeLabel('post_keywords')?></th>
                        <td>
                            <?= $form->field($model, 'post_keywords')->textInput()->label(false) ?>
                            <div class="col-md-12">多关键词之间用英文逗号隔开</div>
                        </td>
                    </tr>
                    <tr>
                        <th><?= $model->getAttributeLabel('post_source')?></th>
                        <td>
                            <?= $form->field($model, 'post_source')->textInput()->label(false) ?>
                        </td>
                    </tr>
                    <tr>
                        <th><?= $model->getAttributeLabel('post_excerpt')?></th>
                        <td>
                            <?= $form->field($model, 'post_excerpt')->textArea(['rows'=>3])->label(false) ?>
                        </td>
                    </tr>
                    <tr>
                        <th><?= $model->getAttributeLabel('post_content')?></th>
                        <td>
                            <?= $form->field($model, 'post_content')->widget(\crazydb\ueditor\UEditor::className([
                                'model' => $model,
                                'attribute' => 'post_content',
                                'config' => [
                                    //client config @see http://fex-team.github.io/ueditor/#start-config
                                    'serverUrl' => ['/ueditor/index'],//确保serverUrl正确指向后端地址
                                    'lang' => 'zh-cn',
                                    'iframeCssUrl' => Yii::getAlias('@web') . '/static/css/ueditor.css',// 自定义编辑器内显示效果
                                ]
                            ])) ?>
                        </td>
                    </tr>

                    <tr>
                        <th>相册</th>
                        <td>
                            <?php
                            // 单图
                            // echo $form->field($model, 'post_content')->widget('manks\FileInput', []);

                            // 多图
                            echo $form->field($model, 'post_content')->widget('manks\FileInput', [
                                'clientOptions' => [
                                    'pick' => [
                                        'multiple' => true,
                                    ],
                                    'accept' => [
                                        'extensions' => 'gif,jpg,jpeg,bmp,png',
                                    ],
                                ],
                            ]); ?>
                        </td>
                    </tr>
                    <tr>
                        <th>附件</th>
                        <td>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-md-3">
            <table class="table table-bordered">
                <tbody>
                    <tr class="bg-primary">
                        <th>缩略图</th>
                    </tr>
                    <tr>
                        <td>
                            <div style="text-align: center;">
                                <input type="hidden" name="post[more][thumbnail]" id="thumbnail" value="">
                                <a href="javascript:uploadOneImage('图片上传','#thumbnail');">
                                    <img src="/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png" id="thumbnail-preview" width="135" style="cursor: pointer;" title="">
                                </a>
                                <input type="button" class="btn btn-sm btn-cancel-thumbnail" value="取消图片">
                            </div>
                        </td>
                    </tr>
                    <tr class="bg-primary">
                        <th>发布时间</th>
                    </tr>
                    <tr>
                        <td>
                            <input class="form-control" type="text" name="Article[published_time]" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" value="">
                        </td>
                    </tr>
                    <tr class="bg-primary">
                        <th>状态</th>
                    </tr>
                    <tr>
                        <td><label><input type="checkbox" name="Article[post_status]" class="form-control" value="1" checked="">发布</label></td>
                    </tr>
                    <tr>
                        <td><label><input type="checkbox" name="Article[is_top]" class="form-control" value="1">置顶</label></td>
                    </tr>
                    <tr>
                        <td><label><input type="checkbox" name="Article[recommended]" class="form-control" value="1">推荐</label></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="form-group">
            <div class="col-sm-12 col-sm-offset-3">
                <button class="btn btn-success" type="submit">保存</button>
                <a class="btn btn-primary" onclick="location.href=go(-1)">返回</a>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
