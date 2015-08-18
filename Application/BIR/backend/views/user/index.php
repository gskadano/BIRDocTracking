<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\helpers\Url;
//use common\models\position;
//use common\models\section;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::button('Create User', ['value'=>Url::to('index.php?r=user%2Fcreate'),'class' => 'btn btn-success','id'=>'modalButton']) ?>
	</p>

	<?php
        Modal::begin([
                'header'=>'<h4>User</h4>',
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
			//'position.positionName',
			//'section.sectionName',
			
			[
                'attribute'=>'position_id',
                'value'=>'position.positionName',
            ],
			
			[
                'attribute'=>'section_id',
                'value'=>'section.sectionName',
            ],
			
			'userLName',
			'userFName',
            'userMName',
            // 'username',
            // 'password_hash',
            // 'auth_key',
            // 'status',
            // 'email:email',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
