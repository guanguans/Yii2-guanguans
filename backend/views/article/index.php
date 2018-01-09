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
                        <li class="active"><a href="">文章管理</a></li>
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
                                        'cid',
                                        'type',
                                        'title',
                                        'sub_title',
                                        //'summary',
                                        //'thumb',
                                        //'seo_title',
                                        //'seo_keywords',
                                        //'seo_description',
                                        //'status',
                                        //'sort',
                                        //'author_id',
                                        //'author_name',
                                        //'scan_count',
                                        //'comment_count',
                                        //'can_comment',
                                        //'visibility',
                                        //'tag',
                                        //'flag_headline',
                                        //'flag_recommend',
                                        //'flag_slide_show',
                                        //'flag_special_recommend',
                                        //'flag_roll',
                                        //'flag_bold',
                                        //'flag_picture',
                                        //'created_at',
                                        //'updated_at',

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


