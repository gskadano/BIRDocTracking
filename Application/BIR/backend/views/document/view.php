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
            'category_id',
            'type_id',
            'priority_id',
            'documentComment',
            'user_id',
            'companyAgency_id',
            //'documentImage',
			/*array(
	                'name'=>'docPicture',
	                'type'=>'raw',
	                'value'=>html_entity_decode(CHtml::image(Yii::app()->controller->createUrl('church/loadImage', array('id'=>$model->id))
	                                                                                ,'alt'
	                                                                                ,array('width'=>300)
	                                                                                )),
	                ),*/
			[
				'attribute'=>'documentImage',
				'value'=>\yii\helpers\Html::img('<img src =' .'uploads/' . $model->documentImage),
				//'value'=>yii\helpers\Html::app()->controller->createUrl('backend\controllers\DocumentController\loadImage', array('id'=>$model->id)),
				'format' => ['image',['width'=>'100','height'=>'100']],
			],
            'section_id',
            'documentCreate',
            'documentUpdate',
        ],
    ]) ?>

</div>
