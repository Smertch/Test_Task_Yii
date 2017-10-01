<?php
/**
 * Created by PhpStorm.
 * User: smertch
 * Date: 27.09.17
 * Time: 15:23
 */

namespace app\models;

use Yii;
use yii\base\Model;

class SignupForm extends Model
{

    public $username;
    public $email;
    public $password;
    public $verifyCode;

    /**
     * @return array
     */

    public function rules() // These rules will be used when validating: the input form, by calling the validate () method, when you try to save to the database table
    {
        return [
            ['username', 'trim'], // Truncates spaces and turns to null if nothing remains
            ['username', 'required'], // 'username' Required
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels() // Used for localization
    {
        return [
            'username' => 'login',
            'email' => 'E-mail',
            'password' => 'password',
        ];
    }

    /**
     * @return User|null
     */
    public function signup() // check in

    {
        $user = new User(); // use AcriveRecord User
        $user->username = $this->username; // Define the properties of the object
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->created_at = Yii::$app->formatter->asDate('now', 'php:Y-m-d H:i:s');
        return $user->save() ? $user : null;
    }
}