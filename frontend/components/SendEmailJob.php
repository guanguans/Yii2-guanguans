<?php

namespace frontend\components;

use \yii\base\Object as BaseObject;

class SendEmailJob extends BaseObject implements \yii\queue\JobInterface
{
    public $object;
    public $title;
    public $verifyCode;
    public $sender;

    public function execute($queue)
    {
        send_email($this->object, $this->title, $this->verifyCode, $this->sender);
    }
}
