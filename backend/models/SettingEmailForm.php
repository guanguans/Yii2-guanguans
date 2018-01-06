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
use backend\models\Options;

class SettingEmailForm extends Model
{
    public $smtp_host;
    public $smtp_port;
    public $smtp_username;
    public $smtp_password;
    public $smtp_nickname;
    public $smtp_encryption;

    public $Options;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['smtp_host', 'smtp_port', 'smtp_username', 'smtp_password', 'smtp_nickname', 'smtp_encryption'], 'required'],
            [['smtp_username'], 'email'],
            [['smtp_port'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->Options = new Options();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'smtp_nickname'=>'* 发件人',
            'smtp_host'=>'* SMTP服务器',
            'smtp_encryption'=>'* 连接方式',
            'smtp_port'=>'* SMTP服务器端口',
            'smtp_username'=>'* 发件箱帐号',
            'smtp_password'=>'* 发件箱密码',
        ];
    }

    /**
     * 填充网站配置
     *
     */
    public function getEmailSetting()
    {
        $names = $this->getNames();
        foreach ($names as $name) {
            $model = $this->Options->findOne(['name' => $name]);
            if (!empty($model)) {
                $this->$name = $model->value;
            }
        }
    }

    /**
     * 写入网站配置到数据库
     *
     * @return bool
     */
    public function setEmailConfig($data)
    {
        foreach ($data['SettingEmailForm'] as $k => $vo) {
            $model = $this->Options->findOne(['name' => $k]);
            if (!empty($model)) {
                $model->value = $vo;
                $result = $model->save();
                if (!$result) {
                    return false;
                }
            } else {
                $this->Options->name = $k;
                $this->Options->value = $vo;
                $res = $this->Options->save();
                if (!$res) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * @return array
     */
    public function getNames()
    {
        return array_keys($this->attributeLabels());
    }
}
