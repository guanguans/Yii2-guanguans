<?php

namespace backend\controllers;

use backend\models\SettingWebsiteForm;
use Yii;

class SettingController extends \yii\web\Controller
{
    public function actionWebsite()
    {
        $model = new SettingWebsiteForm();
        $model->scenario = SettingWebsiteForm::SCENARIO_WEBSITE;
        // 或者通过构造函数配置
        // $model = new SettingWebsiteForm(['scenario'=>SettingWebsiteForm::SCENARIO_WEBSITE]);
        if (yii::$app->request->isPost) {
            if ($model->load(yii::$app->request->post()) && $model->validate() && $model->setWebsiteConfig(yii::$app->request->post())) {
                    yii::$app->session->setFlash('info', '成功');
            } else {
                $errors = $model->getErrors();
                $err = '';
                foreach ($errors as $v) {
                    $err .= $v[0] . '<br>';
                }
                yii::$app->getSession()->setFlash('info', $err);
            }
        }
        $model->getWebsiteSetting();
        return $this->render('web', [
            'model'  => $model,
            'active' => SettingWebsiteForm::SCENARIO_WEBSITE,
        ]);
    }

    public function actionWebseo()
    {
        $model = new SettingWebsiteForm();
        $model->scenario = SettingWebsiteForm::SCENARIO_WEBSEO;
        // 或者通过构造函数配置
        // $model = new SettingWebsiteForm(['scenario'=>SettingWebsiteForm::SCENARIO_WEBSITE]);
        if (yii::$app->request->isPost) {
            if ($model->load(yii::$app->request->post()) && $model->validate()) {
                $res = $model->setWebsiteConfig(yii::$app->request->post());
                if ($res) {
                    yii::$app->session->setFlash('success', '成功');
                } else {
                    $errors = $model->getErrors();
                    $err = '';
                    foreach ($errors as $v) {
                        $err .= $v[0] . '<br>';
                    }
                    // yii::$app->getSession()->setFlash('error', $err);
                }
            }
        }
        $model->getWebsiteSetting();
        return $this->render('web', [
            'model'  => $model,
            'active' => SettingWebsiteForm::SCENARIO_WEBSEO,
        ]);
    }

}
