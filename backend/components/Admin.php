<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2017-03-15 21:16
 */

namespace backend\components;

use yii;
use yii\base\Component;
use backend\components\AdminLogEvent;
use yii\base\Event;
use yii\db\BaseActiveRecord;

class Admin extends Component
{

    public static function adminLog()
    {
        Event::on(BaseActiveRecord::className(), BaseActiveRecord::EVENT_AFTER_INSERT, [
            AdminLogEvent::className(),
            'create'
        ]);
        Event::on(BaseActiveRecord::className(), BaseActiveRecord::EVENT_AFTER_UPDATE, [
            AdminLogEvent::className(),
            'update'
        ]);
        Event::on(BaseActiveRecord::className(), BaseActiveRecord::EVENT_AFTER_DELETE, [
            AdminLogEvent::className(),
            'delete'
        ]);
        Event::on(BaseActiveRecord::className(), BaseActiveRecord::EVENT_AFTER_FIND, function ($event) {
            if (isset($event->sender->updated_at) && $event->sender->updated_at == 0) {
                $event->sender->updated_at = null;
            }
        });
        // 登录控制
        if (Yii::$app->user->isGuest) {
            if (!in_array(Yii::$app->request->pathInfo, ['site/login', 'site/captcha'])) {
                    return Yii::$app->getResponse()->redirect(Yii::$app->getHomeUrl());
            }
        }
    }

}
