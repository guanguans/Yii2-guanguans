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
	// iframe 弹出层
	function layerIframe (title='信息', url='', width='50%', height='50%')
	{
		$.layer({
		    type: 2,
		    title: title,
		    skin: 'layui-layer-rim', //加上边框
		    area: [width, height], //宽高
		    shade: [0.5, '#000000'], // 遮罩层
		    shadeClose: true,
		    iframe: {
                src : url,
            },
		});
	}
</script>
</html>
<?php $this->endPage() ?>
