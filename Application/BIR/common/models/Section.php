<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "section".
 *
 * @property integer $id
 * @property string $sectionNum
 * @property string $sectionCode
 * @property string $sectionName
 * @property string $sectionDesc
 *
 * @property Document[] $documents
 * @property User[] $users
 */
class Section extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'section';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sectionName'], 'required'],
            [['sectionNum', 'sectionCode'], 'string', 'max' => 45],
            [['sectionName'], 'string', 'max' => 100],
            [['sectionDesc'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sectionNum' => 'Section',
            'sectionCode' => 'Section Code',
            'sectionName' => 'Section Name',
            'sectionDesc' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Document::className(), ['section_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['section_id' => 'id']);
    }
}
