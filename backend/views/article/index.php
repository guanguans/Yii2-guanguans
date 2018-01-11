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
                        <li class="active"><a data-toggle="tab" href="">文章管理</a></li>
                        <li><a href="<?=Url::to(['article/create'])?>">创建文章</a></li>
                    </ul>
                </div>
                <div class="ibox-content" style="border-top: 0px;">
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="article-index">
                                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                                <?= GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'filterModel' => $searchModel,
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],

                                        'id',
                                        'parent_id',
                                        'post_type',
                                        'post_format',
                                        'user_id',
                                        //'post_status',
                                        //'comment_status',
                                        //'is_top',
                                        //'recommended',
                                        //'post_hits',
                                        //'post_like',
                                        //'comment_count',
                                        //'create_time',
                                        //'update_time',
                                        //'published_time',
                                        //'delete_time',
                                        //'post_title',
                                        //'post_keywords',
                                        //'post_excerpt',
                                        //'post_source',
                                        //'post_content:ntext',
                                        //'post_content_filtered:ntext',
                                        //'more:ntext',

                                        ['class' => 'yii\grid\ActionColumn'],
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



