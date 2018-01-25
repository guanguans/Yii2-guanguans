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

}
