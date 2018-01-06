<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2016-03-23 12:54
 */

namespace backend\models;

use yii;
use yii\base\Model;

class BaseForm extends Model
{
    public $email_object;
    public $email_title;
    public $email_content;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email_object', 'email_title', 'email_content'], 'required'],
            [['email_object'], 'email'],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email_object'=>'* 收件箱',
            'email_title'=>'* 标题',
            'email_content'=>'* 内容',
        ];
    }
}
