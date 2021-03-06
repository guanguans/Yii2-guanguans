<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\User;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\AdminUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Admin Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wrapper wrapper-content animated fadeIn" >
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="padding: 0px;border-top: 0px;">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="tabs_panels.html#tab-1">后台用户</a></li>
                        <li><a href="<?=Url::to(['admin-user/create'])?>">创建用户</a></li>
                    </ul>
                </div>
                <div class="ibox-content" style="border-top: 0px;">
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="user-index">
                                <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
                                <p>
                                    <button type="btn" class="btn btn-success">批量操作</button>
                                    <?= Html::a("删除", "javascript:void(0);", [
                                        "class" => "btn btn-danger mybtn",
                                        'action' => Url::to(['admin-user/delete']),
                                    ]) ?>
                                    <button type="btn" class="btn btn-success">批量操作</button>
                                </p>

                                <?php
                                    $js = <<<js
                                    $(document).on('click', '.mybtn', function () {
                                        //可以把选中的id通过ajax提交到后端，然后借助yii的deleteAll()语句进行删除或操作
                                        var keys = $("#grid").yiiGridView("getSelectedRows");
                                        var ids = keys.join(",");
                                        var action = $(this).attr("action")+"&id="+ids;
                                        console.log(action);
                                        $.post(action, function(data){
                                            // console.log(data);
                                        });
                                    });
js;
                                    $this->registerJs($js);
                                ?>
                                <?= GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'filterModel' => $searchModel,
                                    "options" => ["class" => "grid-view","style"=>"overflow:auto", "id" => "grid"],
                                    'columns' => [
                                        [
                                            'class' => 'yii\grid\SerialColumn',
                                            'class' => 'yii\grid\CheckboxColumn',
                                        ],

                                        [
                                           'attribute' => 'id',
                                           'headerOptions'=> ['width'=> '200'],
                                        ],
                                        'username',
                                        'avatar',
                                        'email:email',
                                        [
                                            'attribute' => 'status',
                                            // 'label' => '状态',
                                            'value' => function ($model) {
                                                if($model->status == User::STATUS_ACTIVE){
                                                    return '正常';
                                                }else if( $model->status == User::STATUS_DELETED ){
                                                    return '禁用';
                                                }
                                            },
                                            'filter' => User::getStatuses(),
                                        ],
                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'header' => '操作',
                                            'template' => '{assignment} {view} {update} {delete}',
                                            'buttons' => [
                                                'assignment'=>function ($url, $model, $key) {
                                                    return Html::a('分配权限', ['admin/assignment/view', 'id' => $model->id], ['class' => ""]);
                                                },
                                                'delete'=>function ($url, $model, $key) {
                                                    return Html::tag('span', '删除', [
                                                        'class' => "text-danger confirm",
                                                        'action' => Url::to(['admibn-user/delete','id'=>$model->id]),
                                                        'style' => ['cursor' => 'pointer'],
                                                    ]);
                                                }
                                            ],
                                        ],
                                    ],
                                ]); ?>
                                <p>
                                    <button type="btn" class="btn btn-success">批量操作</button>
                                    <?= Html::a("删除", "javascript:void(0);", [
                                        "class" => "btn btn-danger mybtn",
                                        'action' => Url::to(['admin-user/delete']),
                                    ]) ?>
                                    <button type="btn" class="btn btn-success">批量操作</button>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



