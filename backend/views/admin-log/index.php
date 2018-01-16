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
                        <li class="active"><a data-toggle="tab" href="tabs_panels.html#tab-1">日志管理</a></li>
                    </ul>
                </div>
                <div class="ibox-content" style="border-top: 0px;">
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="admin-log-index">
                                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                                <?= GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'filterModel' => $searchModel,
                                    'columns' => [
                                        [
                                            'class' => 'yii\grid\CheckBoxColumn',
                                        ],
                                        [
                                            'class' => 'yii\grid\SerialColumn',
                                        ],
                                        [
                                            'attribute' => 'id',
                                            'options' => [
                                                'width' => '50px'
                                            ],
                                        ],
                                        [
                                            'label' => '管理员',
                                            // 'header' => '管理员',
                                            'attribute' => 'user_id',
                                        ],
                                        'route',
                                        [
                                            'attribute' => 'description',
                                            'value' => function ($model) {
                                                return $post_title = mb_substr($model->description, 0, 150, "UTF-8").'...';
                                            },
                                        ],
                                        [
                                            'attribute' => 'created_at',
                                            // 'format' => ['date','php:Y-m-d'],
                                            'value' => function ($model) {
                                                return date('Y-m-d H:i:s', $model->created_at);
                                            },
                                            'filter' => Html::activeInput('text', $searchModel, 'created_at', [
                                                'class' => 'form-control layer-date',
                                                'placeholder' => '',
                                                'onclick' => "laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'});"
                                            ]),
                                            'options' => [
                                                'width' => '200px'
                                            ],
                                        ],
                                        [
                                            'attribute' => 'updated_at',
                                            'format' => ['date','php:Y-m-d H:i:s'],
                                        ],
                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'header' => '操作',
                                            'options' => [
                                                'width' => '100px'
                                            ],
                                            'template' => '{view}|{update}|{delete}',
                                            'buttons' => [
                                                'delete'=>function ($url, $model, $key) {
                                                    return Html::tag('span', '删除', [
                                                        'class' => "text-danger confirm",
                                                        'action' => Url::to(['admin-log/delete','id'=>$model->id]),
                                                        'style' => ['cursor' => 'pointer'],
                                                    ]);
                                                }
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



