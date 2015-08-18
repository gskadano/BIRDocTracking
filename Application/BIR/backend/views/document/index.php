<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DocumentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Documents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::button('Create Document', ['value'=>Url::to('index.php?r=document%2Fcreate'),'class' => 'showModalButton btn btn-success']) ?>

    </p>
	
	<?php
        Modal::begin([
                'header'=>'<h4>Documents</h4>',
                'id'=>'modal',
                //'size'=>'modal-sm',
            ]);

        echo "<div id='modalContent'></div>";

        Modal::end()
	
    ?>
	
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            [	'attribute'=>'id',
				'contentOptions'=>['style'=>'width: 20px;'],
			],
            'document_tracking_number',
            'documentName',
            'documentDesc',
			[
				'attribute' => 'user_id',
				'value' => 'user.username',
			],
            //'documentTargetDate',
            // 'category_id',
            // 'type_id',
            // 'priority_id',
            // 'documentComment',
            // 'user_id',
            // 'companyAgency_id',
            // 'documentImage',
            // 'section_id',
            // 'documentCreate',
            // 'documentUpdate',

			
			[
					'attribute' => 'Actions',
					'format' => 'raw',
					'value' => function ($model) {                    
					return Html::button('Release', ['value'=>Url::to('index.php?r=document/release&id=' . $model->id),'class' => 'showModalButton btn btn-success']);
					},
			],
			
			

			['class' => 'yii\grid\ActionColumn'],
			
        ],
    ]); 
	
	?>
	
	

</div>
