<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "agencycperson".
 *
 * @property integer $id
 * @property string $firstName
 * @property string $lastName
 * @property string $phoneNumber
 * @property string $telNumber
 * @property string $email
 * @property integer $companyAgency_id
 *
 * @property Companyagency $companyAgency
 */
class Agencycperson extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agencycperson';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstName', 'lastName', 'email', 'companyAgency_id'], 'required'],
            [['companyAgency_id'], 'integer'],
            [['firstName', 'lastName', 'phoneNumber', 'telNumber', 'email'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'phoneNumber' => 'Phone No.',
            'telNumber' => 'Telephone No.',
            'email' => 'Email',
            'companyAgency_id' => 'Company Agency',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyAgency()
    {
        return $this->hasOne(Companyagency::className(), ['id' => 'companyAgency_id']);
    }
}
