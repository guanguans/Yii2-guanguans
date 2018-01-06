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
                        <li class="active"><a data-toggle="tab" href="tabs_panels.html#tab-1">邮箱设置</a></li>
                    </ul>
                </div>
                <div class="ibox-content" style="border-top: 0px;">
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
							<?php $form = ActiveForm::begin([
									// 'action' => ['setting/webseo'],
									'fieldConfig' => [
									    'template' => "{label}<div class='col-md-6'>{input}\n{error}\n{hint}</div>",
									],
									'options' => [
                                        'class' => 'form-horizontal m-t',
                                        'id'=>'signupForm',
                                    ],
								]); ?>
					    	    <?= $form->field($model, 'smtp_nickname')->textInput(['placeholder'=>'例如：张三'])->label(null, ['for'=>'firstname', 'class'=>'col-sm-2 control-label']) ?>

					    	    <?= $form->field($model, 'smtp_nickname')->textInput(['placeholder'=>'例如：admin@admin.com'])->label('* 邮箱地址', ['for'=>'firstname', 'class'=>'col-sm-2 control-label']) ?>

						    	<?= $form->field($model, 'smtp_host')->textInput(['placeholder'=>'例如：smtp.163.com、smtp.qq.com'])->label(null, ['for'=>'firstname', 'class'=>'col-sm-2 control-label']) ?>
					    	    <?= $form->field($model, 'smtp_port')->textInput(['placeholder'=>'例如：25、465'])->label(null, ['for'=>'firstname', 'class'=>'col-sm-2 control-label']) ?>
					    	    <?= $form->field($model, 'smtp_encryption')->dropDownList(
						    	    	['ssl'=>'ssl','2'=>'tls'],
						    	    	['prompt'=>'默认',]
					    	    	)->label(null, ['for'=>'firstname', 'class'=>'col-sm-2 control-label']) ?>
					    	    <?= $form->field($model, 'smtp_username')->textInput(['placeholder'=>'例如：admin@admin.com'])->label(null, ['for'=>'firstname', 'class'=>'col-sm-2 control-label']) ?>
					    	    <?= $form->field($model, 'smtp_password')->passwordInput(['placeholder'=>'例如：xxxx xxxx xxxx xxxx'])->label(null, ['for'=>'firstname', 'class'=>'col-sm-2 control-label']) ?>
							    <div class="form-group">
							        <div class="col-sm-8 col-sm-offset-3">
							            <button class="btn btn-info" type="submit">保存</button>
										<a class="btn btn-warning" onclick="layerIframe('测试邮件', '<?= Url::to(['layer/iframe'])?>');">测试邮件</a>
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

