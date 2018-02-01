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
    	  		<span class="fa fa-list col-md-4"> <?= $categoryNames ?></span>
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
    <div class="col-md-3">
	    <div class="list-group">
	      <a href="#" class="list-group-item active">排行榜</a>
	      <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
	      <a href="#" class="list-group-item">Morbi leo risus</a>
	      <a href="#" class="list-group-item">Porta ac consectetur ac</a>
	      <a href="#" class="list-group-item">Vestibulum at eros</a>
	    </div>
	    <div class="list-group">
	      <a href="#" class="list-group-item active">推荐</a>
	      <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
	      <a href="#" class="list-group-item">Morbi leo risus</a>
	      <a href="#" class="list-group-item">Porta ac consectetur ac</a>
	      <a href="#" class="list-group-item">Vestibulum at eros</a>
	    </div>
	    <div class="list-group">
	      <a href="#" class="list-group-item active">友情链接</a>
	      <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
	      <a href="#" class="list-group-item">Morbi leo risus</a>
	      <a href="#" class="list-group-item">Porta ac consectetur ac</a>
	      <a href="#" class="list-group-item">Vestibulum at eros</a>
	    </div>
	    <div class="list-group">
	        <div class="social-share" data-mode="prepend">
	        	<a href="javascript:" class="social-share-icon icon-heart"></a>
	        </div>
	    </div>
	</div>
</div>
