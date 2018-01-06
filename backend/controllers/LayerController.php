<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\BaseForm;

/**
 * Site controller
 */
class LayerController extends Controller
{
    /**
     * layer 弹出层
     */
    public function actionIframe()
    {
        $model = new BaseForm();
        if (yii::$app->request->isPost) {
            if ($model->load(yii::$app->request->post()) && $model->validate()) {
                $data = Yii::$app->request->post()['BaseForm'];
                $res = send_email($data['email_object'], $data['email_title'], $data['email_content']);

                if ($res !== true) {

                }
                yii::$app->session->setFlash('hintInfo', '成功');
            }
        }
        return $this->render('iframe', ['model'=>$model]);
    }


}
