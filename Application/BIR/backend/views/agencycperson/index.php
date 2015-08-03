<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AgencycpersonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Agencycpeople';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agencycperson-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Agencycperson', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'firstName',
            'lastName',
            'phoneNumber',
            'telNumber',
            // 'email:email',
            // 'companyAgency_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
