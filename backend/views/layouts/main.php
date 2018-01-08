<?php
/**
/* @var $this yii\web\View */
/* @var $content string */

use backend\assets\MyAppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

MyAppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body >
<?php $this->beginBody() ?>
    <?= $content ?>
    <input type="hidden" value="<?= Yii::$app->session->getFlash('hintInfo')?>" id="hintInfo">
<?php $this->endBody() ?>
</body>

<script>

	$(function(){
		// iframe 弹出层
		function layerIframe (title='信息', url='', width='50%', height='50%')
		{
			$.layer({
			    type: 2,
			    title: title,
			    // 加上边框
			    skin: 'layui-layer-rim',
			    // offset: 't',
			    // 宽高
			    area: [width, height],
			    // 遮罩层
			    shade: [0.5, '#000000'],
			    shadeClose: true,
			    iframe: {
	                src : url,
	            },
			});
		}
		// 询问框
		$('.confirm').click(function(){
			// layer.confirm(); 快捷调用
			var action = $(this).attr("action");
			$.layer({
			    shade: [0],
			    area: ['auto','auto'],
			    shade: [0.5, '#000000'],
			    dialog: {
			        msg: '您确定删除吗？',
			        btns: 2,
			        type: 4,
			        btn: ['确定','取消'],
			        yes: function(){
			            layer.msg('确定', 1, 1);
			        	$.post(action);
			        }, no: function(){
			            // layer.msg('取消', 1, 2);
			        }
			    }
			});
		});
	});

</script>
</html>
<?php $this->endPage() ?>
