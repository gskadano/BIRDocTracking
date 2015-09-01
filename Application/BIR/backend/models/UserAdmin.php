<?php

namespace backend\models;

use Yii;
use common\models\Position;
use common\models\Section;

use common\models\User;

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
class UserAdmin extends \yii\db\ActiveRecord
{
	//const STATUS_DELETED = 0;
    //const STATUS_ACTIVE = 10;
	
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
			
			//['status', 'default', 'value' => self::STATUS_ACTIVE],
            //['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
			
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
			['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
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
	
	public function getFullname()
	{
		return $this->userLName . ', ' . $this->userFName;
	}
	
	public function getFPname()
	{
		return $this->userLName . ', ' . $this->userFName  . '; ' . $this->position->positionName;
	}
	
	//===================================================================================
	
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
            $user->setPassword($this->password_hash);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }
        return null;
    }
	
	//===================================================================================

}
