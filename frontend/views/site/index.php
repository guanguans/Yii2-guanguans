<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\StringHelper;
use yii\web\View;

$this->title = Yii::$app->name;
?>
<div class="site-index row">
	<div class="col-md-9">
		<?php foreach ($models as $key => $value): ?>
	    <div class="media">
	      <div class="media-left media-middle">
	        <a href="#">
			    <img class="media-object" src="https://static.oschina.net/uploads/img/201711/15190729_qSNe.jpg" width="150" height="93" alt="...">

	        </a>
	      </div>
	      <div class="media-body">
	        <a href="<?= Url::to(['site/article', 'id'=>$value->id]) ?>">
	        	<h4 class="media-heading text-info lead"><?= $value->post_title ?></h4>
	        </a>
	        <p>
	        	<?= mb_substr($value->post_excerpt, 0, 100) ?>...&nbsp;&nbsp;&nbsp;
	        	<a href="<?= Url::to(['site/article', 'id'=>$value->id]) ?>" title="" class="pull-right">阅读全文&nbsp;&nbsp;&nbsp;>></a>
	    	</p>
	        <p class="row">
	        	<?php
	        		$cids = yii\helpers\ArrayHelper::getColumn($value->categorys, 'category_id');

	        		$categoryNames = implode(',', yii\helpers\ArrayHelper::getColumn(\backend\models\Category::find()
	        			->select(['name'])
	        			->where(['id'=>$cids])
	        			->asArray()
	        			->all(), 'name')
	        		);
	        		// pp($categoryNames);
	        	?>
	        	<span class="fa fa-user col-md-2">&nbsp;<?= $value->adminUser['username'] ?></span>
	        	<span class="fa fa-list col-md-4">&nbsp;<?= $categoryNames ?></span>
	        	<span class="fa fa-eye col-md-1">&nbsp;<?= $value->post_hits ?></span>
        		<?php if (\frontend\models\UserFavorite::findOne(['user_id'=>Yii::$app->user->id, 'object_id'=>$value->id])): ?>
        			<span class="fa fa-star col-md-1" title="已经收藏" onclick="alert('已经收藏过了');" style="cursor: pointer;">&nbsp;</span>
        		<?php else: ?>
        			<span class="fa fa-star-o col-md-1" onclick="favorite(this);" data-id="<?= $value->id ?>" title="加入收藏" style="cursor: pointer;">&nbsp;</span>
        		<?php endif ?>
	        	<span class="fa fa-clock-o col-md-4">&nbsp;<?= date('Y-m-d H:i:s', $value->published_time) ?></span>
	        </p>
	      </div>
	    </div>
		<?php endforeach ?>
		<div class="text-center">
		<?php echo yii\widgets\LinkPager::widget([
			    'pagination' => $pages,
		]);?>
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
	    <div class="list-group">
	      <a href="#" class="list-group-item active">友情链接</a>
	      <?php foreach ($friendLink as $key => $value): ?>
	      <a href="<?= $value->url ?>" class="list-group-item" target="<?= $value->target ?>"><?= $value->name ?></a>
	      <?php endforeach ?>
	    </div>
	    <div class="list-group">
	        <div class="social-share" data-mode="prepend">
	        	<a href="javascript:" class="social-share-icon icon-heart"></a>
	        </div>
	    </div>
	</div>
</div>
