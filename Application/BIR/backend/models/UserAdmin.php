<?php

namespace backend\models;

use Yii;
use yii\web\IdentityInterface;
use common\models\Position;
use common\models\Section;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property integer $position_id
 * @property integer $section_id
 * @property string $userFName
 * @property string $userMName
 * @property string $userLName
 * @property string $username
 * @property string $password_hash
 * @property string $auth_key
 * @property integer $status
 * @property string $email
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Document[] $documents
 * @property Docworkflow[] $docworkflows
 * @property Docworkflow[] $docworkflows0
 * @property Position $position
 * @property Section $section
 */
class UserAdmin extends \yii\db\ActiveRecord implements IdentityInterface
{
	const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['position_id', 'section_id', 'userFName', 'userLName', 'username', 'password_hash', 'email'], 'required'],
            [['position_id', 'section_id', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['userFName', 'userMName', 'userLName', 'username'], 'string', 'max' => 45],
            [['password_hash', 'auth_key', 'email'], 'string', 'max' => 255],
			
			['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            
            'position_id' => 'Position',
            'section_id' => 'Section',
            'userFName' => 'First Name',
            'userMName' => 'Middle Name',
            'userLName' => 'Last Name',
            'username' => 'Username',
            'password_hash' => 'Password',
            'auth_key' => 'Authentication Key',
            'status' => 'Status',
            'email' => 'Email',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Document::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocworkflows()
    {
        return $this->hasMany(Docworkflow::className(), ['user_receive' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocworkflows0()
    {
        return $this->hasMany(Docworkflow::className(), ['user_release' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosition()
    {
        return $this->hasOne(Position::className(), ['id' => 'position_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSection()
    {
        return $this->hasOne(Section::className(), ['id' => 'section_id']);
    }
	//===================================================================================
	public function getFullname(){
		return $this->userLName . ', ' . $this->userFName;
	}
	//===================================================================================

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
