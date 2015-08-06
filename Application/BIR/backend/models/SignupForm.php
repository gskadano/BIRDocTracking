<?php
namespace backend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
	public $position_id;
	public $section_id;
    public $username;
	public $userFName;
	public $userMName;
	public $userLName;
    public $email;
    public $password;
	public $auth_key;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			['position_id', 'required', 'message' => 'Position cannot be blank.'],
			['section_id', 'required', 'message' => 'Section cannot be blank.'],
			
			['userFName', 'required'],
			['userLName', 'required'],
			[['userFName', 'userMName', 'userLName'], 'string', 'max'=>45],
			
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
			['password', 'required'],
			
			['auth_key', 'required'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
			$user->position_id = $this->position_id;
			$user->section_id = $this->section_id;
			$user->userFName = $this->userFName;
			$user->userMName = $this->userMName;
			$user->userLName = $this->userLName;
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }
        return null;
    }
}
