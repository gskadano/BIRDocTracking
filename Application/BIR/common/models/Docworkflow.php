<?php

namespace common\models;

use Yii;
//use backend\models\UserAdmin;

/**
 * This is the model class for table "docworkflow".
 *
 * @property integer $id
 * @property integer $document_id
 * @property integer $user_receive
 * @property integer $docStatus_id
 * @property string $docWorkflowComment
 * @property string $timeAccepted
 * @property string $timeRelease
 * @property string $totalTimeSpent
 * @property integer $user_release
 *
 * @property Document $document
 * @property Docstatus $docStatus
 * @property User $userReceive
 * @property User $userRelease
 */
class Docworkflow extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'docworkflow';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['document_id', 'user_receive', 'docStatus_id'/*, 'timeRelease', 'user_release'*/], 'required'],
            [['document_id', 'user_receive', 'docStatus_id', 'user_release'], 'integer'],
            [['timeAccepted', 'timeRelease'], 'safe'],
            [['docWorkflowComment'], 'string', 'max' => 255],
            [['totalTimeSpent'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'document_id' => 'Document',
            'user_receive' => 'Receiver',
            'docStatus_id' => 'Document Status ',
            'docWorkflowComment' => 'Comment',
            'timeAccepted' => 'Time Accepted',
            'timeRelease' => 'Time Release',
            'totalTimeSpent' => 'Total Time Spent',
            'user_release' => 'User Release',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocument()
    {
        return $this->hasOne(Document::className(), ['id' => 'document_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocStatus()
    {
        return $this->hasOne(Docstatus::className(), ['id' => 'docStatus_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserReceive()
    {
        return $this->hasOne(User::className(), ['id' => 'user_receive']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRelease()
    {
		return $this->hasOne(User::className(), ['id' => 'user_release']);
    }
}
