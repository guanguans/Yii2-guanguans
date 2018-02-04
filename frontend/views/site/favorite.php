<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'My Favorite';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <div class="row">
        <div class="col-sm-12">
            <?php if (json_decode($user->email_verify, 1)['is_verify'] == 0): ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Warning!</strong>
                    邮箱未激活，请激活邮箱！
                </div>
            <?php endif ?>
        </div>
        <div class="col-md-3" style="margin-top: 38px;">
            <div class="list-group">
              <a href="#" class="list-group-item active">个人信息</a>
              <a href="#" class="list-group-item "><span class="fa fa-user"></span> <?= $user->username ?></a>
              <a href="#" class="list-group-item "><span class="fa fa-envelope"></span> <?= $user->email ?></a>
              <a href="#" class="list-group-item "><span class="fa fa-calendar"></span> <?= date('Y-m-d H:i:s', $user->created_at) ?></a>
            </div>
        </div>
    	<div class="col-md-9">
    		<table class="table table-bordered table-hover table-bordered table-responsive">
    		  <caption class=" text-center">My Favorite</caption>
    		  <thead>
    		    <tr>
    		      <th>ID</th>
    		      <th>主题</th>
    		      <th>地址</th>
    		      <th>收藏时间</th>
    		      <th>操作</th>
    		    </tr>
    		  </thead>
    		  <tbody>
    		  	<?php foreach ($models as $key => $value): ?>
    		  		<tr>
    		  		  <td><?= $value->id ?></td>
    		  		  <td><a href="<?= Url::to(json_decode($value->url, 1)) ?>" title=""><?= $value->title ?></a></td>
    		  		  <td><?= Url::to(json_decode($value->url, 1)) ?></td>
    		  		  <td><?= date('Y-m-d H:i:s', $value->create_time) ?></td>
    		  		  <td>
    		  		  	<a href="<?= Url::to(['site/favorite-delete', 'id'=>$value->id]) ?>" title="取消收藏" data-confirm="您确定要取消收藏吗？" class="btn btn-danger btn-xs">取消收藏</a>
    		  		  </td>
    		  		</tr>
    		  	<?php endforeach ?>
    		  </tbody>
    		</table>
    		<div class="text-center">
    		<?php echo yii\widgets\LinkPager::widget([
    			    'pagination' => $pages,
    		]);?>
    		</div>
    	</div>
    </div>
</div>
