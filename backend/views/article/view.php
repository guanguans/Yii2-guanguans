<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

?>
<div class="wrapper wrapper-content animated fadeIn" >
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="padding: 0px;border-top: 0px;">
                    <ul class="nav nav-tabs">
                        <li><a href="<?=Url::to(['article/index'])?>">文章管理</a></li>
                        <li class="active"><a href="<?=Url::to(['article/view'])?>">文章详情</a></li>
                    </ul>
                </div>
                <div class="ibox-content" style="border-top: 0px;">
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="article-view">
                                <p>
                                    <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                                    <?= Html::a('删除', ['delete', 'id' => $model->id], [
                                        'class' => 'btn btn-danger',
                                        'data' => [
                                            'confirm' => 'Are you sure you want to delete this item?',
                                            'method' => 'post',
                                        ],
                                    ]) ?>
                                </p>

                                <?= DetailView::widget([
                                    'model' => $model,
                                    'attributes' => [
                                        'id',
                                        'parent_id',
                                        'post_type',
                                        'post_format',
                                        'user_id',
                                        'post_status',
                                        'comment_status',
                                        'is_top',
                                        'recommended',
                                        'post_hits',
                                        'post_like',
                                        'comment_count',
                                        'create_time',
                                        'update_time',
                                        'published_time',
                                        'delete_time',
                                        'post_title',
                                        'post_keywords',
                                        'post_excerpt',
                                        'post_source',
                                        'post_content:ntext',
                                        'post_content_filtered:ntext',
                                        'more:ntext',
                                    ],
                                ]) ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



