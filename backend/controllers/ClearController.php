<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2016-04-13 12:49
 */

namespace backend\controllers;

use yii;
use yii\helpers\FileHelper;


class ClearController extends \yii\web\Controller
{

    /**
     * 清除后台缓存
     *
     * @return string
     */
    public function actionBackend()
    {
        FileHelper::removeDirectory(yii::getAlias('@runtime/cache'));
        hintInfo(['code'=>1, 'data'=>'操作成功']);
        return $this->render('clear');
    }

    /**
     * 清除后台缓存
     *
     * @return string
     */
    public function actionFrontend()
    {
        FileHelper::removeDirectory(yii::getAlias('@frontend/runtime/cache'));
        hintInfo(['code'=>1, 'data'=>'操作成功']);
        return $this->render('clear');
    }


}
