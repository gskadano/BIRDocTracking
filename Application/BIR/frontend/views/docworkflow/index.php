<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel common\models\DocworkflowSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Document Workflow';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="docworkflow-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::button('Create Document Workflow', ['value'=>Url::to('index.php?r=docworkflow%2Fcreate'),'class' => 'showModalButton btn btn-success']) ?>
    </p>

	<?php
        Modal::begin([
                'header'=>'<h4>Document Workflow</h4>',
                'id'=>'modal',
                'size'=>'modal-lg',
            ]);

        echo "<div id='modalContent'></div>";

        Modal::end()
    ?>
	
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'document_id',
			[
				'attribute' => 'document_id',
				'value' => 'document.documentName',
			],
            //'user_receive',
			[
				'attribute' => 'user_receive',
				'value' => 'userReceive.Fullname',
			],
            //'docStatus_id',
			[
				'attribute' => 'docStatus_id',
				'value' => 'docStatus.docStatusName',
			],
            'docWorkflowComment',
            'timeAccepted',
            'timeRelease',
            'totalTimeSpent',
            //'user_release',
			[
				'attribute' => 'user_release',
				'value' => 'userRelease.Fullname',
			],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
