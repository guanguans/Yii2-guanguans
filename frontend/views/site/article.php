<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Article';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about row">
    <div class="col-sm-9">
    	<?php
    		// pp($article);
    	?>
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
    	  		<a href="" title="加入收藏"><span class="fa fa-star-o col-md-1" style="cursor: pointer;">&nbsp;</span></a>
    	  		<span class="fa fa-clock-o col-md-3"> <?= date('Y-m-d H:i:s', $article[0]['published_time']) ?></span>
    	  	</div>
    	  </div>
    	  <div class="panel-body"><?= $article[0]['post_content'] ?></div>
    	</div>
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
