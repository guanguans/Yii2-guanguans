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
									'action' => ['setting/website'],
									'fieldConfig' => [
									    'template' => '{error}{input}',
									],
									'options' => [
                                        'class' => 'form-horizontal m-t',
                                        'id'=>'signupForm',
                                    ],
								]); ?>
						    	<?= $form->field($model, 'website_title', ['template' => "<label for='firstname' class='col-sm-2 control-label'>{$model->getAttributeLabel('website_title')}</label><div class='col-md-6'>{input}\n{error}\n</div>"])
							    	->textInput() ?>
					    	    <?= $form->field($model, 'website_email', ['template' => "<label for='firstname' class='col-sm-2 control-label'>{$model->getAttributeLabel('website_email')}</label><div class='col-md-6'>{input}\n{error}\n{hint}</div>"])
							    	->textInput() ?>
					    	    <?= $form->field($model, 'website_status', ['template' => "<label for='firstname' class='col-sm-2 control-label'>{$model->getAttributeLabel('website_status')}</label><div class='col-md-6'>{input}\n{error}\n{hint}</div>"])
							    	->radioList(['1'=>'开','0'=>'关']) ?>
					    	    <?= $form->field($model, 'website_icp', ['template' => "<label for='firstname' class='col-sm-2 control-label'>{$model->getAttributeLabel('website_icp')}</label><div class='col-md-6'>{input}\n{error}\n{hint}</div>"])
							    	->textInput() ?>
					    	    <?= $form->field($model, 'website_statics_script', ['template' => "<label for='firstname' class='col-sm-2 control-label'>{$model->getAttributeLabel('website_statics_script')}</label><div class='col-md-6'>{input}\n{error}\n{hint}</div>"])
							    	->textarea(['rows'=>5]) ?>
							    <div class="form-group">
							        <div class="col-sm-8 col-sm-offset-3">
							            <button class="btn btn-info" type="submit">保存</button>
										<!-- <a class="btn btn-default" onclick="window.history.back();">返回</a> -->
							        </div>
							    </div>
							<?php ActiveForm::end(); ?>
                        </div>
                        <div id="tab-2" class="tab-pane">
							<?php $form = ActiveForm::begin([
									'action' => ['setting/webseo'],
									'fieldConfig' => [
									    'template' => "{label}<div class='col-md-6'>{input}\n{error}\n{hint}</div>",
									],
									'options' => [
                                        'class' => 'form-horizontal m-t',
                                        'id'=>'signupForm',
                                    ],
								]); ?>
						    	<?= $form->field($model, 'seo_title')->textInput()->label(null, ['for'=>'firstname', 'class'=>'col-sm-2 control-label']) ?>
					    	    <?= $form->field($model, 'seo_keywords')->textInput()->label(null, ['for'=>'firstname', 'class'=>'col-sm-2 control-label']) ?>
					    	    <?= $form->field($model, 'seo_description')->textarea(['rows'=>5])->label(null, ['for'=>'firstname', 'class'=>'col-sm-2 control-label']) ?>
							    <div class="form-group">
							        <div class="col-sm-8 col-sm-offset-3">
							            <button class="btn btn-info" type="submit">保存</button>
										<!-- <a class="btn btn-default" onclick="window.history.back();">返回</a> -->
							        </div>
							    </div>
							<?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
