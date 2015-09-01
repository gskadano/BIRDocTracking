<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use dosamigos\datepicker\DatePicker;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use common\models\User;



/* @var $this yii\web\View */
/* @var $searchModel common\models\DocumentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Documents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	
	<p>
        <?= Html::button('Create Document', ['value'=>Url::to('index.php?r=document%2Fcreate'),'class' => 'showModalButton btn btn-success']) ?>
    </p>
	
	 <?php
        Modal::begin([
			'header'=>'<h4>Document</h4>',
			'id'=>'modal',
			//'size'=>'modal-lg',
		]);

        echo "<div id='modalContent'></div>";

        Modal::end()
    ?>
<!--
    <p>
    
    </p>-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			[
            'attribute' => 'id',
			'contentOptions'=>['style'=>'width: 20px;'],
			],
            'document_tracking_number',
            'documentName',
            'documentDesc',
			[
                'attribute' => 'documentTargetDate',
				'contentOptions'=>['style'=>'width: 165px;'],
                'value' => 'documentTargetDate',
                'format' => 'raw',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'documentTargetDate', 
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]),
            ],
            // 'category_id',
            // 'type_id',
            // 'priority_id',
            // 'documentComment',
            // 'user_id',
            // 'companyAgency_id',
            'documentImage',
            // 'section_id',
            // 'documentCreate',
            // 'documentUpdate',
			
			[
					'attribute' => 'Actions',
					'format' => 'raw',
					'value' => function ($model) {
					
						$userid = ArrayHelper::getValue(User::find()->where(['username' => Yii::$app->user->identity->username])->one(), 'id');
					
						if ($model->user_id == $userid){
				
					return Html::button('Release', ['value'=>Url::to('index.php?r=document/release&id=' . $model->id),'class' => 'showModalButton btn btn-success']);
							}else{
								return Html::button('Confirm', ['value'=>Url::to('index.php?r=document/confirm&id=' . $model->id),'class' => 'showModalButton btn btn-success']);
								//return Html::a('Confirm', ['confirm'], ['id' => $model->id],['class' => 'btn btn-success']);
							}
					},
			],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
