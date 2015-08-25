<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pendingdoc".
 *
 * @property integer $id
 * @property string $pendingDocFName
 * @property string $pendingDocSection
 * @property string $pendingDocName
 * @property string $pendingDocTimeRelease
 */
class Pendingdoc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pendingdoc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pendingDocFName', 'pendingDocName'], 'required'],
            [['pendingDocTimeRelease'], 'safe'],
            [['pendingDocFName', 'pendingDocSection', 'pendingDocName'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pendingDocFName' => 'First Name',
            'pendingDocSection' => 'Section',
            'pendingDocName' => 'Pending Document Name',
            'pendingDocTimeRelease' => 'Time Release',
        ];
    }
	
}
