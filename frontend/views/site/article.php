<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about row">
    <div class="col-sm-9">
    	<h1 class="text-center"><?= Html::encode($this->title) ?></h1>
    	<div class="panel panel-default">
    	  <div class="panel-heading">
    	  	<div class="row">
    	  		<span class="fa fa-user col-md-2"> <?= $article->user_id ?></span>
    	  		<span class="fa fa-list col-md-2"> <?= $article->user_id ?></span>
    	  		<span class="fa fa-eye col-md-2"> <?= $article->post_hits ?></span>
    	  		<span class="fa fa-star-o col-md-2"> <?= $article->post_hits ?></span>
    	  		<span class="fa fa-clock-o col-md-3"> <?= date('Y-m-d H:i:s', $article->published_time) ?></span>
    	  	</div>
    	  </div>
    	  <div class="panel-body"><?= $article->post_content ?></div>
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
	</div>
</div>
