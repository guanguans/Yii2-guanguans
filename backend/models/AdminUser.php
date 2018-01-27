<?php

namespace backend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "{{%admin_user}}".
 *
 * @property string $id
 * @property string $username 用户名
 * @property string $auth_key 授权token
 * @property string $password_hash 密码
 * @property string $password_reset_token 重置密码taken
 * @property string $email
 * @property string $avatar
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class AdminUser extends User
{
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
	    return [
	        [['username', 'auth_key', 'password_hash', 'email', 'created_at'], 'required'],
	        [['status', 'created_at', 'updated_at'], 'integer'],
	        [['username', 'password_hash', 'password_reset_token', 'email', 'avatar'], 'string', 'max' => 255],
	        [['auth_key'], 'string', 'max' => 32],
	        [['username'], 'unique'],
	        [['email'], 'unique'],
	        [['password_reset_token'], 'unique'],
	    ];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
	    return [
	        'id' => Yii::t('app', 'ID'),
	        'username' => Yii::t('app', '用户名'),
	        'auth_key' => Yii::t('app', '授权token'),
	        'password_hash' => Yii::t('app', '密码'),
	        'password_reset_token' => Yii::t('app', '重置密码taken'),
	        'email' => Yii::t('app', '邮箱'),
	        'avatar' => Yii::t('app', '头像'),
	        'status' => Yii::t('app', '状态'),
	        'created_at' => Yii::t('app', '添加时间'),
	        'updated_at' => Yii::t('app', '更新时间'),
	    ];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getAdminLogs()
	{
	    return $this->hasMany(AdminLog::className(), ['user_id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getAdminRoleUsers()
	{
	    return $this->hasMany(AdminRoleUser::className(), ['uid' => 'id']);
	}

}
