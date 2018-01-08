<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<div class="wrapper wrapper-content animated fadeIn" >
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="padding: 0px;border-top: 0px;">
                    <ul class="nav nav-tabs">
                        <li class=""><a href="<?= Url::to(['user/index'])?>">前台用户</a></li>
                        <li class="active"><a href="<?= Url::to(['user/create'])?>">创建用户</a></li>
                    </ul>
                </div>
                <div class="ibox-content" style="border-top: 0px;">
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                        	<?= $this->render('_form', [
                        	    'model' => $model,
                        	]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
