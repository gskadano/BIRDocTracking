<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PendingdocSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pending Documents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pendingdoc-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pending Document', ['create'], ['class' => 'showModalButton btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'pendingDocFName',
            'pendingDocSection',
            'pendingDocName',
            'pendingDocTimeRelease',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
