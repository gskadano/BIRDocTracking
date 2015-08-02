<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "position".
 *
 * @property integer $id
 * @property string $positionCode
 * @property string $positionName
 * @property string $positionDesc
 * @property string $positionNotes
 *
 * @property User[] $users
 */
class Position extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'position';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['positionName'], 'required'],
            [['positionCode'], 'string', 'max' => 45],
            [['positionName'], 'string', 'max' => 100],
            [['positionDesc', 'positionNotes'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'positionCode' => 'Position Code',
            'positionName' => 'Position Name',
            'positionDesc' => 'Position Desc',
            'positionNotes' => 'Position Notes',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['position_id' => 'id']);
    }
}
