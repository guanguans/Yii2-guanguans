<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use backend\models\CategoryArticle;
use backend\models\Category;
use backend\models\AdminUser;
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
                                        [
                                            'class' => 'yii\grid\SerialColumn',
                                            'class' => 'yii\grid\CheckboxColumn'
                                        ],

                                        'id',
                                        [
                                            'attribute' => 'post_title',
                                            'value' => function ($model) {
                                                return  mb_substr($model->post_title,0,8,"UTF-8").'...';
                                            },
                                        ],
                                        /*[
                                            'attribute' => 'categories',
                                            'value' => function ($model) {
                                                $categorys = ArrayHelper::toArray(CategoryArticle::find()
                                                    ->where(['post_id' => $model->id])
                                                    ->select(['category_id'])
                                                    ->all());
                                                $categorys = ArrayHelper::getColumn($categorys, 'category_id');
                                                $names = '';
                                                foreach ($categorys as $k => $v) {
                                                    $names .= Category::find()->where(['id' => $v])
                                                        ->select(['name'])
                                                        ->one()['name'].',';
                                                }
                                                return mb_substr(trim($names, ','), 0, 8, "UTF-8").'...';
                                            },
                                        ],*/
                                        [
                                            'attribute' => 'user_id',
                                            'value' => function ($model) {
                                                $user_name = AdminUser::findOne($model->user_id)->username;

                                                return $user_name;
                                            },
                                        ],
                                        'post_hits',
                                        'comment_count',
                                        'post_like',
                                        /*[
                                            'attribute' => 'post_keywords',
                                            'value' => function ($model) {
                                                return trim(implode(',', json_decode($model->post_keywords, 1)), ',');
                                            },
                                        ],*/
                                        'post_excerpt',
                                        'post_source',
                                        'more:ntext',
                                        'post_status',
                                        'is_top',
                                        'recommended',

                                        //'create_time',
                                        //'update_time',
                                        //'published_time',
                                        //'delete_time',
                                        //'comment_status',
                                        // 'post_type',
                                        // 'post_format',
                                        //'post_content:ntext',
                                        //'post_content_filtered:ntext',
                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'options' => [
                                                'width' => '70px'
                                            ]
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



