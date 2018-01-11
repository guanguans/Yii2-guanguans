<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
?>
<div class="wrapper wrapper-content animated fadeIn" >
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="padding: 0px;border-top: 0px;">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="tabs_panels.html#tab-1">分类管理</a></li>
                        <li><a href="<?=Url::to(['category/create'])?>">创建分类</a></li>
                    </ul>
                </div>
                <div class="ibox-content" style="border-top: 0px;">
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="article-index">
                            </div>
                            <?php $form = ActiveForm::begin([
                                    'action' => ['category/sort'],
                                ]); ?>
                                <div id="w0" class="grid-view">
                                    <div class="table-actions">
                                        <button type="submit" class="btn btn-primary btn-sm js-ajax-submit">排序</button>
                                    </div>
                                    <table class="table table-hover table-bordered table-list">
                                        <thead>
                                            <tr>
                                                <th width="50">排序</th>
                                                <th width="50">ID</th>
                                                <th>分类名称</th>
                                                <th>描述</th>
                                                <th width="180">操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?=$categoryTableTree?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th width="50">排序</th>
                                                <th width="50">ID</th>
                                                <th>分类名称</th>
                                                <th>描述</th>
                                                <th width="180">操作</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="table-actions">
                                        <button type="submit" class="btn btn-primary btn-sm js-ajax-submit">排序</button>
                                    </div>
                                </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




