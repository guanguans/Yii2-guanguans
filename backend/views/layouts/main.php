<?php
/**
/* @var $this yii\web\View */
/* @var $content string */

use backend\assets\MyAppAsset;
use yii\helpers\Html;

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
    <?php
        // $this->render("/widgets/_language-js")
    ?>
    <script>
        var common = {
            chooseFile: "选择文件",
        }
        var tips = {
            realyToDo: "确定要执行此操作？",
            ok: "确定",
            cancel: "取消",
            noItemSelected: "啊哦,神马都都没有选中!",
            PleaseSelectOne: "请至少选中一项",
            waitingAndNoRefresh: "执行中,请勿刷新页面",
            operating: "执行中",
            operatingSuccess: "执行成功",
            operatingFailed: "啊哦,执行失败啦~",
            onlyPictureCanBeSelected: "只能选择图片类型",
            success: "成功",
            error: "失败"
        };
    </script>
</head>
<body >
<?php $this->beginBody() ?>
    <?php
        $this->render('/widgets/_flash')
    ?>
    <?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
