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
                        <li class="active"><a data-toggle="tab" href="tabs_panels.html#tab-1">网站信息</a>
                        </li>
                        <li><a data-toggle="tab" href="tabs_panels.html#tab-2">SEO设置</a>
                        </li>
                    </ul>
                </div>
                <div class="ibox-content" style="border-top: 0px;">
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
							<?php $form = ActiveForm::begin([
									'class'=>'form-horizontal m-t',
									'id'=>'signupForm',
								]); ?>
							    	<?= $form->field($model, 'website_title')->textInput([
							    			'id'=> 'firstname',
							    			'class'=> 'form-control',
							    			'value'=> $model->website_title,
							    		])->label() ?>
							    <div class="form-group">
							        <div class="col-sm-8 col-sm-offset-3">
							            <button class="btn btn-info" type="submit">保存</button>
										<a class="btn btn-default" >返回</a>
							        </div>
							    </div>
							<?php ActiveForm::end(); ?>
								
                        </div>
                        <div id="tab-2" class="tab-pane">
                            <form class="form-horizontal m-t" id="signupForm">
								<div class="form-group">
							        <label for="firstname" class="col-sm-2 control-label">名字22</label>
							        <div class="col-sm-6">
							          	<input type="text" class="form-control" id="firstname" 
							            placeholder="请输入名字">
							        </div>
							    </div>
							    <div class="form-group">
							        <div class="col-sm-8 col-sm-offset-3">
							            <button class="btn btn-info" type="submit">保存</button>
										<a class="btn btn-default" onclick="">返回</a>
							        </div>
							    </div>
							</form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
