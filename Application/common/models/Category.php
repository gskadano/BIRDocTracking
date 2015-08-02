<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $categoryName
 * @property string $categoryDesc
 * @property string $categoryCreate
 * @property string $categoryUpdate
 *
 * @property Document[] $documents
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categoryName', 'categoryUpdate'], 'required'],
            [['categoryCreate', 'categoryUpdate'], 'safe'],
            [['categoryName'], 'string', 'max' => 100],
            [['categoryDesc'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'categoryName' => 'Category Name',
            'categoryDesc' => 'Category Desc',
            'categoryCreate' => 'Category Create',
            'categoryUpdate' => 'Category Update',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Document::className(), ['category_id' => 'id']);
    }
}
