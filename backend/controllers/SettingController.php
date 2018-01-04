<?php

namespace backend\controllers;

use backend\models\SettingWebsiteForm;

class SettingController extends \yii\web\Controller
{
    public function actionWebsite()
    {
    	$model = new SettingWebsiteForm();
    	$model->getWebsiteSetting();
        return $this->render('website', ['model'=>$model]);
    }

}
