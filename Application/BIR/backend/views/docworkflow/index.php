<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel common\models\DocworkflowSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Docworkflows';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="docworkflow-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::button('Create Document Workflow', ['value'=>Url::to('index.php?r=docworkflow%2Fcreate'),'class' => 'btn btn-success','id'=>'modalButton']) ?>
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
            'document_id',
            'user_receive',
            'docStatus_id',
            'docWorkflowComment',
            // 'timeAccepted',
            // 'timeRelease',
            // 'totalTimeSpent',
            // 'user_release',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
