<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Document */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'document_tracking_number',
            'documentName',
            'documentDesc',
            'documentTargetDate',
			['label' => 'Category',
			'value' => $model->category->categoryName,
			],
			['label' => 'Type',
			'value' => $model->type->typeName,
			],
			['label' => 'Priority',
			'value' => $model->priority->priorityName,
			],
            'documentComment',
			['label' => 'User',
			'value' => $model->user->userFName.' '.$model->user->userLName,
			],
			['label' => 'Company Agency',
			'value' => $model->companyAgency->companyAgencyName,
			],
            
			//'documentImage',
			
			
			['value' =>Html::a(str_replace('web/uploads/', "", $model->documentImage),''.$model->documentImage), 'attribute' => 'documentImage', 'format' => 'raw'],
			['label' => 'Section',
			'value' => $model->section->sectionName,
			],
            'documentCreate',
            'documentUpdate',
        ],
    ]) ?>

</div>
