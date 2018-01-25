<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\captcha\Captcha;
use backend\models\AdminUser;

/**
 * Login form
 */
class LoginForm extends Model
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    public $username;
    public $password;
    public $verifyCode;
    public $rememberMe = true;

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password', 'verifyCode'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            // 验证码
            ['verifyCode', 'captcha', 'captchaAction' => 'site/captcha', 'message' => '验证码错误'],
        ];
    }

    public function attributeLabels()
    {
        return [
               'username' => '用户名',
               'password' => '密码',
               'rememberMe' => '记住密码',
               'verifyCode' => '验证码',
        ];
    }
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {

                $this->addError($attribute, '用户名或密码错误');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }

        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = AdminUser::findByUsername($this->username);
        }

        return $this->_user;
    }
}
