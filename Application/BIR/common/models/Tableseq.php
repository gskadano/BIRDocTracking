<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tableseq".
 *
 * @property integer $id
 * @property string $timestamp
 */
class Tableseq extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tableseq';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['timestamp'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'timestamp' => 'Timestamp',
        ];
    }
}
