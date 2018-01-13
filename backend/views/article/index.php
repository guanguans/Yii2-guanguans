<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use backend\models\CategoryArticle;
use backend\models\Category;
use backend\models\AdminUser;
use yii\grid\ActionColumn;
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

                                        [
                                            'attribute' => 'id',
                                            'options' => [
                                                'width' => '100px'
                                            ]
                                        ],
                                        [
                                            'attribute' => 'post_title',
                                            'format'=>'raw',
                                            'value' => function ($model) {
                                                $post_title = mb_substr($model->post_title, 0, 20, "UTF-8").'...';
                                                return "<a href=".Url::to(['article/view', 'id'=>$model->id]).">$post_title</a>"; 
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
                                            'options' => [
                                                'width' => '100px'
                                            ]
                                        ],
                                        [
                                            'attribute' => 'post_hits',
                                            'options' => [
                                                'width' => '60px'
                                            ]
                                        ],
                                        [
                                            'header' => '关键字/来源<br>摘要/缩略图',
                                            'format'=>'raw',
                                            'value' => function ($model) {
                                                $post_keywords = $model->post_keywords? '<i class="fa fa-check fa-fw text-info"></i> ': ' <i class="fa fa-close fa-fw text-danger"></i> ';
                                                $post_source   = $model->post_source? ' <i class="fa fa-check fa-fw text-info"></i> ': ' <i class="fa fa-close fa-fw text-danger"></i> ';
                                                $post_excerpt  = $model->post_excerpt? ' <i class="fa fa-check fa-fw text-info"></i> ': ' <i class="fa fa-close fa-fw text-danger"></i> ';
                                                $thumbnail     = json_decode($model->more)->thumbnail? '<i class="fa fa-photo fa-fw text-info"></i> ': ' <i class="fa fa-close fa-fw text-danger"></i> ';
                                                return $post_keywords.$post_source.$post_excerpt.$thumbnail; 
                                            },
                                            'options' => [
                                                'width' => '100px'
                                            ]
                                        ],
                                        [
                                            'attribute' => 'published_time',
                                            'value' => function ($model) {
                                                return date('Y-m-d H:i:s', $model->published_time); 
                                            },
                                            'options' => [
                                                'width' => '150px'
                                            ]
                                        ],
                                        [
                                            'header' => '状态',
                                            'format'=>'raw',
                                            'value' => function ($model) {
                                                $post_status = $model->post_status ? ' <i title="已发布" class="fa fa-check fa-fw text-info"></i> ': ' <i title="未发布" class="fa fa-close fa-fw text-danger"></i> ';
                                                $is_top      = $model->is_top ? ' <i title="已置顶" class="fa fa-arrow-down text-info"></i> ': ' <i title="未置顶" class="fa fa-arrow-up text-danger"></i> ';
                                                $recommended = $model->recommended ? ' <i title="已推荐" class="fa fa-thumbs-up text-info"></i> ': ' <i title="未推荐" class="fa fa-thumbs-down text-danger"></i> ';
                                                return $post_status.$is_top.$recommended; 
                                            },
                                            'options' => [
                                                'width' => '70px'
                                            ]
                                        ],
                                        /*'comment_count',
                                        'post_keywords',
                                        'post_like',
                                        'post_excerpt',
                                        'post_source',
                                        'more:ntext',
                                        'post_status',
                                        'is_top',
                                        'recommended',
                                        'create_time',
                                        'update_time',
                                        'published_time',
                                        'delete_time',
                                        'comment_status',
                                        'post_type',
                                        'post_format',
                                        'post_content:ntext',
                                        'post_content_filtered:ntext',*/
                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'header' => '操作',
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



