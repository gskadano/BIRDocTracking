<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "docstatus".
 *
 * @property integer $id
 * @property string $docStatusName
 * @property string $docStatusDesc
 *
 * @property Docworkflow[] $docworkflows
 */
class Docstatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'docstatus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['docStatusName'], 'required'],
            [['docStatusName'], 'string', 'max' => 45],
            [['docStatusDesc'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'docStatusName' => 'Document Status Name',
            'docStatusDesc' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocworkflows()
    {
        return $this->hasMany(Docworkflow::className(), ['docStatus_id' => 'id']);
    }
}
