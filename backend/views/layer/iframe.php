<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<div class="wrapper wrapper-content animated fadeIn" >
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content" style="border-top: 0px;">
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
							<?php $form = ActiveForm::begin([
									// 'action' => ['setting/webseo'],
									'fieldConfig' => [
									    'template' => "{label}<div class='col-sm-8'>{input}\n{error}\n{hint}</div>",
									],
									'options' => [
                                        'class' => 'form-horizontal m-t',
                                        'id'=>'signupForm',
                                    ],
								]); ?>
					    	    <?= $form->field($model, 'email_object')->textInput()->label(null, ['for'=>'firstname', 'class'=>'col-sm-2 control-label']) ?>
					    	    <?= $form->field($model, 'email_title')->textInput()->label(null, ['for'=>'firstname', 'class'=>'col-sm-2 control-label']) ?>
						    	<?= $form->field($model, 'email_content')->textArea()->label(null, ['for'=>'firstname', 'class'=>'col-sm-2 control-label']) ?>
							    <div class="form-group">
							        <div class="col-sm-8 col-sm-offset-3">
							            <button class="btn btn-info" type="submit">发送</button>
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

