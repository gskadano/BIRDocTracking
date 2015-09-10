<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers;

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
            [['documentName', 'category_id', 'type_id', 'priority_id', 'user_id', 'companyAgency_id', 'section_id'], 'required'],
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
	
	function some_func_name($from, $to) {
		$workingDays = [1, 2, 3, 4, 5]; # date format = N
		$workingHours = ['from' => ['08', '00'], 'to' => ['17', '00']];

		$start = new \DateTime($from);
		$end = new \DateTime($to);

		$startP = clone $start;
		$startP->setTime(0, 0, 0);
		$endP = clone $end;
		$endP->setTime(23, 59, 59);
		$interval = new \DateInterval('P1D');
		$periods = new \DatePeriod($startP, $interval, $endP);

		$sum = [];
		foreach ($periods as $i => $period) {
			if (!in_array($period->format('N'), $workingDays)) continue;

			$startT = clone $period;
			$startT->setTime($workingHours['from'][0], $workingHours['from'][1]);
			if (!$i && $start->diff($startT)->invert) $startT = $start;

			$endT = clone $period;
			$endT->setTime($workingHours['to'][0], $workingHours['to'][1]);
			if (!$end->diff($endT)->invert) $endT = $end;

			#echo $startT->format('Y-m-d H:i') . ' - ' . $endT->format('Y-m-d H:i') . "\n"; # debug

			$diff = $startT->diff($endT);
			if ($diff->invert) continue;
			foreach ($diff as $k => $v) {
				if (!isset($sum[$k])) $sum[$k] = 0;
				$sum[$k] += $v;
			}
		}

		//if (!$sum) return 'ccc, no time on job?';
		if (!$sum) return 'Document overtime! Release to next employee...';

		$spec = "P{$sum['y']}Y{$sum['m']}M{$sum['d']}DT{$sum['h']}H{$sum['i']}M{$sum['s']}S";
		$interval = new \DateInterval($spec);
		$startS = new \DateTime;
		$endS = clone $startS;
		$endS->sub($interval);
		$diff = $endS->diff($startS);

		$labels = [
			'y' => 'year',
			'm' => 'month',
			'd' => 'day',
			'h' => 'hour',
			'i' => 'minute',
			's' => 'second',
		];
		$return = [];
		foreach ($labels as $k => $v) {
			if ($diff->$k) {
				$return[] = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
			}
		}

		return implode(', ', $return);
	}
}
