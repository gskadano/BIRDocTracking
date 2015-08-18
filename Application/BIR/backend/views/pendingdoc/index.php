<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PendingdocSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pending Document';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pendingdoc-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
 <?= Html::button('Create Pending Documents', ['value'=>Url::to('index.php?r=pendingdoc%2Fcreate'),'class' => 'showModalButton btn btn-success']) ?>
    </p>
	
	<?php
        Modal::begin([
                'header'=>'<h4>Pending Documents</h4>',
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

           // 'id',
            'pendingDocFName',
            'pendingDocSection',
            'pendingDocName',
            'pendingDocTimeRelease',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
