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
                            <div class="category-index">
                                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                                <?= GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'filterModel' => $searchModel,
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],

                                        'id',
                                        'parent_id',
                                        'name',
                                        'alias',
                                        'sort',
                                        //'remark',
                                        //'created_at',
                                        //'updated_at',

                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'template' => '{add} {view} {update} {delete} ',
                                            'buttons' => [
                                                'add'=>function ($url, $model, $key) {
                                                    return Html::a('添加子类', ['category/create', 'id' => $model->id], ['class' => "text-info"]);
                                                },
                                            ],
                                        ],
                                    ],
                                ]); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


