<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel common\models\DocstatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Docstatuses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="docstatus-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::button('Create Document Status', ['value'=>Url::to('index.php?r=docstatus%2Fcreate'),'class' => 'showModalButton btn btn-success']) ?>
    </p>

	<?php
        Modal::begin([
                'header'=>'<h4>Document Status</h4>',
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
            'docStatusName',
            'docStatusDesc',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
