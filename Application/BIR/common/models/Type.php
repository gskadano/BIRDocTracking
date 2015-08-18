<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "type".
 *
 * @property integer $id
 * @property string $typeName
 * @property string $typeDesc
 * @property string $typeCreate
 * @property string $typeUpdate
 *
 * @property Document[] $documents
 */
class Type extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['typeName'], 'required'],
            [['typeCreate', 'typeUpdate'], 'safe'],
            [['typeName'], 'string', 'max' => 100],
            [['typeDesc'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'typeName' => 'Type Name',
            'typeDesc' => 'Description',
            'typeCreate' => 'Type Create',
            'typeUpdate' => 'Type Update',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Document::className(), ['type_id' => 'id']);
    }
}
