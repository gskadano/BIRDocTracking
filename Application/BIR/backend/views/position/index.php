<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel common\models\PositionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Positions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="position-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::button('Create Position', ['value'=>Url::to('index.php?r=position%2Fcreate'),'class' => 'btn btn-success','id'=>'modalButton']) ?>
    </p>

	<?php
        Modal::begin([
                'header'=>'<h4>Document</h4>',
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
            'positionCode',
            'positionName',
            'positionDesc',
            'positionNotes',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
