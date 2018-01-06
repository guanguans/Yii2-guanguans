<?php

namespace backend\controllers;

use Yii;
use backend\models\SettingWebForm;
use backend\models\SettingEmailForm;

class SettingController extends \yii\web\Controller
{

    public function actionWebsite()
    {
        $model = new SettingWebForm();
        $model->scenario = SettingWebForm::SCENARIO_WEBSITE;
        if (yii::$app->request->isPost) {
            if ($model->load(yii::$app->request->post()) && $model->validate() && $model->setWebConfig(yii::$app->request->post())) {
                yii::$app->session->setFlash('hintInfo', '成功');
            } else {
                $errors = $model->getErrors();
                $err = '';
                foreach ($errors as $v) {
                    $err .= $v[0] . '<br>';
                }
                yii::$app->getSession()->setFlash('hintInfo', $err);
            }
        }
        // 设置模型属性值
        $model->getWebSetting();
        return $this->render('web', [
            'model'  => $model,
            'active' => SettingWebForm::SCENARIO_WEBSITE,
        ]);
    }

    public function actionWebseo()
    {
        $model = new SettingWebForm();
        $model->scenario = SettingWebForm::SCENARIO_WEBSEO;
        if (yii::$app->request->isPost) {
            if ($model->load(yii::$app->request->post()) && $model->validate() && $model->setWebConfig(yii::$app->request->post())) {
                yii::$app->session->setFlash('hintInfo', '成功');
            } else {
                $errors = $model->getErrors();
                $err = '';
                foreach ($errors as $v) {
                    $err .= $v[0] . '<br>';
                }
                yii::$app->getSession()->setFlash('hintInfo', $err);
            }
        }
        // 设置模型属性值
        $model->getWebSetting();
        return $this->render('web', [
            'model'  => $model,
            'active' => SettingWebForm::SCENARIO_WEBSEO,
        ]);
    }

    public function actionEmail()
    {
        $model = new SettingEmailForm();
        if (yii::$app->request->isPost) {
            if ($model->load(yii::$app->request->post()) && $model->validate() && $model->setEmailConfig(yii::$app->request->post())) {
                yii::$app->session->setFlash('hintInfo', '成功');
            } else {
                $errors = $model->getErrors();
                $err = '';
                foreach ($errors as $v) {
                    $err .= $v[0] . '<br>';
                }
                yii::$app->getSession()->setFlash('hintInfo', $err);
            }
        }
        // 设置模型属性值
        $model->getEmailSetting();
        return $this->render('email', [
            'model'  => $model,
        ]);
    }

}
