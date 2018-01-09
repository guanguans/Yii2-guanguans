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

                                <h1><?= Html::encode($this->title) ?></h1>

                                <p>
                                    <?= Html::a('编辑', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
                                        'cid',
                                        'type',
                                        'title',
                                        'sub_title',
                                        'summary',
                                        'thumb',
                                        'seo_title',
                                        'seo_keywords',
                                        'seo_description',
                                        'status',
                                        'sort',
                                        'author_id',
                                        'author_name',
                                        'scan_count',
                                        'comment_count',
                                        'can_comment',
                                        'visibility',
                                        'tag',
                                        'flag_headline',
                                        'flag_recommend',
                                        'flag_slide_show',
                                        'flag_special_recommend',
                                        'flag_roll',
                                        'flag_bold',
                                        'flag_picture',
                                        'created_at',
                                        'updated_at',
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



