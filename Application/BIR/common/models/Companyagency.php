<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "companyagency".
 *
 * @property integer $id
 * @property string $companyAgencyCode
 * @property string $companyAgencyName
 * @property string $companyAgencyDesc
 * @property string $companyAgencyCreate
 * @property string $companyAgencyUpdate
 *
 * @property Agencycperson[] $agencycpeople
 * @property Document[] $documents
 */
class Companyagency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'companyagency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['companyAgencyName'], 'required'],
            [['companyAgencyCreate', 'companyAgencyUpdate'], 'safe'],
            [['companyAgencyCode'], 'string', 'max' => 45],
            [['companyAgencyName'], 'string', 'max' => 100],
            [['companyAgencyDesc'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'companyAgencyCode' => 'Company Agency Code',
            'companyAgencyName' => 'Company Agency Name',
            'companyAgencyDesc' => 'Description',
            'companyAgencyCreate' => 'Company Agency Create',
            'companyAgencyUpdate' => 'Company Agency Update',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgencycpeople()
    {
        return $this->hasMany(Agencycperson::className(), ['companyAgency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Document::className(), ['companyAgency_id' => 'id']);
    }
}
