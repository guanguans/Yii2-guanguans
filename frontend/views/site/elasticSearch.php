<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = 'ElasticSearch';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-ElasticSearch">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row col-md-12">
    	<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">ElasticSearch API</h3>
			</div>
			<div class="panel-body">
				<div class="col-md-11">
					<a href="<?= Url::to(['elastic-search/create-index'])?>" class="btn btn-info">createIndex（创建索引）</a> |
					<a href="<?= Url::to(['elastic-search/delete-index'])?>" class="btn btn-info">deleteIndex（删除索引）</a> |
					<a href="<?= Url::to(['elastic-search/update-mapping'])?>" class="btn btn-info">updateMapping（更新索引）</a>
				</div>
				<hr class="col-md-11">
				<form action="<?= Url::to(['elastic-search/query'])?>" method="get" class="col-md-7">
					<div class="form-group">
						<label for="keyword">QueryData（查询记录）</label>
						<input type="text" name="keyword" class="form-control" id="keyword" placeholder="keyword">
					</div>
					<button type="submit" class="btn btn-info">提交</button>
				</form>
				<hr class="col-md-11">
				<div class="col-md-11">
					<a href="<?= Url::to(['elastic-search/add-data-one'])?>" class="btn btn-info">addDataOne（添加一条记录）</a> |
					<a href="<?= Url::to(['elastic-search/add-data-all'])?>" class="btn btn-info">addDataAll（添加所有记录）</a> |
					<a href="<?= Url::to(['elastic-search/delete-data-all'])?>" class="btn btn-info">deleteDataAll（删除所有记录）</a>
				</div>
				<hr class="col-md-11">
			</div>
    	</div>
    </div>
</div>
