<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
        <?= Html::a('Create Docworkflow', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
