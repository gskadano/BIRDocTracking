<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "priority".
 *
 * @property integer $id
 * @property string $priorityName
 * @property string $priorityDesc
 * @property string $priorityCreate
 * @property string $priorityUpdate
 *
 * @property Document[] $documents
 */
class Priority extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'priority';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['priorityName'], 'required'],
            [['priorityCreate', 'priorityUpdate'], 'safe'],
            [['priorityName'], 'string', 'max' => 100],
            [['priorityDesc'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'priorityName' => 'Priority Name',
            'priorityDesc' => 'Priority Desc',
            'priorityCreate' => 'Priority Create',
            'priorityUpdate' => 'Priority Update',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Document::className(), ['priority_id' => 'id']);
    }
}
