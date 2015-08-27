<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "document".
 *
 * @property integer $id
 * @property string $document_tracking_number
 * @property string $documentName
 * @property string $documentDesc
 * @property string $documentTargetDate
 * @property integer $category_id
 * @property integer $type_id
 * @property integer $priority_id
 * @property string $documentComment
 * @property integer $user_id
 * @property integer $companyAgency_id
 * @property resource $documentImage
 * @property integer $section_id
 * @property string $documentCreate
 * @property string $documentUpdate
 *
 * @property User $user
 * @property Type $type
 * @property Priority $priority
 * @property Companyagency $companyAgency
 * @property Category $category
 * @property Section $section
 * @property Docworkflow[] $docworkflows
 */
class Document extends ActiveRecord
{
    /**
     * @inheritdoc
     */
	 
	public $file;
    
	public static function tableName()
    {
        return 'document';
    }
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['documentTargetDate', 'documentCreate', 'documentUpdate'], 'safe'],
            [['category_id', 'type_id', 'priority_id', 'user_id', 'companyAgency_id', 'section_id'], 'required'],
            [['category_id', 'type_id', 'priority_id', 'user_id', 'companyAgency_id', 'section_id'], 'integer'],
    
	[['documentImage'], 'safe'],
	[['documentImage'], 'file', 'extensions'=>'jpg, gif, png'],
	
	//[['file'], 'safe'],
	//[['file'], 'file', 'extensions'=>'jpg, gif, png'],

		    [['document_tracking_number'], 'string', 'max' => 45],
            [['documentName'], 'string', 'max' => 100],
            [['documentDesc', 'documentComment'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'document_tracking_number' => 'Document Tracking Number',
            'documentName' => 'Document Name',
            'documentDesc' => 'Description',
            'documentTargetDate' => 'Target Date',
            'category_id' => 'Category',
            'type_id' => 'Type',
            'priority_id' => 'Priority',
            'documentComment' => 'Comment',
            'user_id' => 'User',
            'companyAgency_id' => 'Company Agency',            
			
			'documentImage' => 'Document Image',
            
			'section_id' => 'Section',
            'documentCreate' => 'Document Create',
            'documentUpdate' => 'Document Update',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPriority()
    {
        return $this->hasOne(Priority::className(), ['id' => 'priority_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyAgency()
    {
        return $this->hasOne(Companyagency::className(), ['id' => 'companyAgency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSection()
    {
        return $this->hasOne(Section::className(), ['id' => 'section_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocworkflows()
    {
        return $this->hasMany(Docworkflow::className(), ['document_id' => 'id']);
    }
}
