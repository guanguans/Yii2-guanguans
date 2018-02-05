<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $user common\models\User */
$verifyAddress = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'verifyCode' => $verifyCode]);
?>
<div class="password-reset">
    <tr>
      <td style="background-color: #fff;border-radius:6px;padding:40px 40px 0;">
        <table>
          <tbody><tr height="40">
            <td style="padding-left:25px;padding-right:25px;font-size:18px;font-family:'微软雅黑','黑体',arial;">
              尊敬的<a href="mailto:<?= $object ?>" target="_blank"><?= $object ?></a>，您好,
            </td>
          </tr>
          <tr height="15">
            <td></td>
          </tr>
          <tr height="30">
            <td style="padding-left:55px;padding-right:55px;font-family:'微软雅黑','黑体',arial;font-size:14px;">
              感谢您注册 <?= $sender ?> 。
            </td>
          </tr>
          <tr height="30">
            <td style="padding-left:55px;padding-right:55px;font-family:'微软雅黑','黑体',arial;font-size:14px;">
              请点击以下链接进行邮箱验证，以便开始使用您的 <?= $sender ?> 账户：
            </td>
          </tr>
          <tr height="60">
            <td style="padding-left:55px;padding-right:55px;font-family:'微软雅黑','黑体',arial;font-size:14px;">
              <a href="<?= $verifyAddress ?>" target="_blank" style="display: inline-block;color:#fff;line-height: 40px;background-color: #1989fa;border-radius: 5px;text-align: center;text-decoration: none;font-size: 14px;padding: 1px 30px;">
                马上验证邮箱
              </a>
            </td>
          </tr>
          <tr height="10">
            <td></td>
          </tr>
          <tr height="20">
            <td style="padding-left:55px;padding-right:55px;font-family:'微软雅黑','黑体',arial;font-size:12px;">
              如果您无法点击以上链接，请复制以下网址到浏览器里直接打开：
            </td>
          </tr>
          <tr height="30">
            <td style="padding-left:55px;padding-right:65px;font-family:'微软雅黑','黑体',arial;line-height:18px;">
              <a style="color:#0c94de;font-size:12px;" href="<?= $verifyAddress ?>" target="_blank">
                <?= $verifyAddress ?>

              </a>
            </td>
          </tr>
          <tr height="20">
            <td style="padding-left:55px;padding-right:55px;font-family:'微软雅黑','黑体',arial;font-size:12px;">
              如果您并未申请 <?= $sender ?> 账户，可能是其他用户误输入了您的邮箱地址。请忽略此邮件。
            </td>
          </tr>
          <tr height="20">
            <td></td>
          </tr>
        </tbody></table>
      </td>
    </tr>
</div>
