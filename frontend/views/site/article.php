<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Article';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about row">
    <div class="col-sm-9">
    	<?php
    		$cids = yii\helpers\ArrayHelper::getColumn($article[0]['categorys'], 'category_id');

    		$categoryNames = implode(',', yii\helpers\ArrayHelper::getColumn(\backend\models\Category::find()
    			->select(['name'])
    			->where(['id'=>$cids])
    			->asArray()
    			->all(), 'name')
    		);
    		// pp($categoryNames);
    	?>
    	<h1 class="text-center"><?= $article[0]['post_title'] ?></h1>
    	<div class="panel panel-default">
    	  <div class="panel-heading">
    	  	<div class="row">
    	  		<span class="fa fa-user col-md-2"> <?= $article[0]['adminUser']['username'] ?></span>
    	  		<span class="fa fa-list col-md-4"> <?= mb_substr($categoryNames, 0, 30) ?>...</span>
    	  		<span class="fa fa-eye col-md-2"> <?= $article[0]['post_hits'] ?></span>
                <?php if (\frontend\models\UserFavorite::findOne(['user_id'=>Yii::$app->user->id, 'object_id'=>$article[0]['id']])): ?>
                    <span class="fa fa-star col-md-1" title="已经收藏" onclick="alert('已经收藏过了');" style="cursor: pointer;">&nbsp;</span>
                <?php else: ?>
                    <span class="fa fa-star-o col-md-1" onclick="favorite(this);" data-id="<?= $article[0]['id'] ?>" title="加入收藏" style="cursor: pointer;">&nbsp;</span>
                <?php endif ?>
    	  		<span class="fa fa-clock-o col-md-3"> <?= date('Y-m-d H:i:s', $article[0]['published_time']) ?></span>
    	  	</div>
    	  </div>
    	  <div class="panel-body"><?= $article[0]['post_content'] ?></div>
    	</div>
        <?php $this->beginBlock('starjs'); ?>
            function favorite(span){
                var object_id = $(span).attr('data-id');
                $.get("<?= Url::to(['site/favorite']) ?>", {object_id: object_id}, function(data){
                    if (data == 1) {
                        $(span).attr('class', 'fa fa-star col-md-1');
                    } else {
                        alert('已经收藏过了');
                    }
                });
            }
        <?php $this->endBlock(); ?>
        <?php $this->registerJs($this->blocks['starjs'], View::POS_END); ?>
    </div>
    <?php
        $top = backend\models\Article::find()
            ->select(['id', 'post_title', 'post_hits', 'published_time'])
            ->where(['post_status'=>1, 'post_type'=>1])
            ->orderBy('post_hits DESC')
            ->limit(5)
            ->all();
        $recommended = backend\models\Article::find()
            ->select(['id', 'post_title', 'post_hits', 'published_time'])
            ->where(['post_status'=>1, 'post_type'=>1, 'recommended'=>1])
            ->orderBy('post_hits DESC')
            ->limit(5)
            ->all();

        $friendLink = backend\models\FriendLink::find()
            ->where(['status'=>1])
            ->orderBy('sort ASC')
            ->all();
        $dependency = [
            'class' => 'yii\caching\DbDependency',
            'sql' => 'SELECT name,url FROM feehi_friend_link',
        ];
    ?>

    <div class="col-md-3">
        <div class="list-group">
          <a href="#" class="list-group-item active">排行榜</a>
          <?php foreach ($top as $key => $value): ?>
          <a href="<?= Url::to(['site/article', 'id'=>$value->id]) ?>" class="list-group-item"><?= mb_substr($value->post_title, 0, 15)?>...<span class="badge"><?= $value->post_hits ?></span></a>
          <?php endforeach ?>
        </div>
        <div class="list-group">
          <a href="#" class="list-group-item active">推荐</a>
          <?php foreach ($recommended as $key => $value): ?>
          <a href="<?= Url::to(['site/article', 'id'=>$value->id]) ?>" class="list-group-item"><?= mb_substr($value->post_title, 0, 15)?>...<span class="badge"><?= $value->post_hits ?></span></a>
          <?php endforeach ?>
        </div>
        <!-- 片段缓存 -->
        <?php if ($this->beginCache('friendLink', ['duration' => 30 * 60, 'variations' => [Yii::$app->language], 'dependency' => $dependency])): ?>
            <div class="list-group">
              <a href="#" class="list-group-item active">友情链接</a>
              <?php foreach ($friendLink as $key => $value): ?>
              <a href="<?= $value->url ?>" class="list-group-item" target="<?= $value->target ?>"><?= $value->name ?></a>
              <?php endforeach ?>
            </div>

            <?php $this->endCache('friendLink'); ?>
        <?php endif ?>
        <div class="list-group">
            <div class="social-share" data-mode="prepend">
                <a href="javascript:" class="social-share-icon icon-heart"></a>
            </div>
        </div>
    </div>
</div>
