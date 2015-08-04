<?php

namespace backend\models;

use Yii;
//use common\models\User;//==========

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
class User extends \yii\db\ActiveRecord
{
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
            [['password_hash', 'auth_key', 'email'], 'string', 'max' => 255]
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
            'password_hash' => 'Password Hash',
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
	
	public function signup()
    {
        if ($this->validate()) {
			$user = new UserSignup();
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
