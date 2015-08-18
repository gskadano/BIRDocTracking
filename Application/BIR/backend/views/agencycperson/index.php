<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
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
		 <?= Html::button('Create Agencycperson', ['value'=>Url::to('index.php?r=agencycperson%2Fcreate'),'class' => 'showModalButton btn btn-success']) ?>
    </p>

	<?php
        Modal::begin([
                'header'=>'<h4>Agency Person</h4>',
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
