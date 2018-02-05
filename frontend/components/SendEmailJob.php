<?php

namespace frontend\components;

use \yii\base\Object as BaseObject;

class SendEmailJob extends BaseObject implements \yii\queue\JobInterface
{
    public $object;
    public $title;
    public $verifyAddress;
    public $sender;

    public function execute($queue)
    {
        send_email($this->object, $this->title, $this->verifyAddress, $this->sender);
    }
}
