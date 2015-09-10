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

use common\models\Document;

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
		'rowOptions'=>function($model){
			$userid = ArrayHelper::getValue(User::find()->where(['username' => Yii::$app->user->identity->username])->one(), 'id');
            if($model->user_id != $userid){
                return ['class' => 'danger'];
            }
		},
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
            //'priority_id',
			[
                'attribute' => 'priority_id',
                'value' => 'priority.priorityName',
            ],
            // 'documentComment',
            // 'user_id',
            // 'companyAgency_id',
            // 'documentImage',
            // 'section_id',
            // 'documentCreate',
            // 'documentUpdate',
			[
				'attribute' => 'Duration',
				'format' => 'raw',
				'value' => function ($model) {
					$position = Yii::$app->user->identity->position_id;
					//$today = date('Y-m-d H:i:s');
					$today = null;
					//$today = ArrayHelper::getValue(Docworkflow::find()->where(['document_id' => $model->id])->orderBy(['id'=>SORT_DESC])->one(), 'timeAccepted');
					$today = ArrayHelper::getValue(Document::find()->where(['id' => $model->id])->one(), 'documentUpdate');
					
					if($today == null){
						$today = ArrayHelper::getValue(Document::find()->where(['id' => $model->id])->one(), 'documentCreate');
					}
					
					if($position == 21 || $position == 22 || $position == 23 || $position == 24 || $position == 25 || $position == 26){
						if($model->priority->priorityName == 'Urgent'){
							$now = date('Y-m-d H:i:s', strtotime("$today + 8 hours"));
						}else if($model->priority->priorityName == 'High'){
							$now = date('Y-m-d H:i:s', strtotime("$today + 3 days"));
						}else if($model->priority->priorityName == 'Medium'){
							$now = date('Y-m-d H:i:s', strtotime("$today + 5 days"));
						}else if($model->priority->priorityName == 'Low'){
							$now = date('Y-m-d H:i:s', strtotime("$today + 7 days"));
						}
					}else{
						$now = date('Y-m-d H:i:s', strtotime("$today + 4 hours"));
					}
					//$from = '2015-09-10 15:00:00';
					$from = date('Y-m-d H:i:s');
					//$to   = '2015-09-11 8:00:00';
					$to = $now;
					//$to = date('Y-m-d H:i:s');
					//return '<div>'.$model->some_func_name($from,$to);
					return '<div>'.$model->some_func_name($from,$to) . " /now: " . $from . " /end: " . $now . " / " . $model->priority->priorityName . " /time accepted: " . $today;
				},
			],
			
			[
					'attribute' => 'Actions',
					'format' => 'raw',
					'value' => function ($model) {
					
						$userid = ArrayHelper::getValue(User::find()->where(['username' => Yii::$app->user->identity->username])->one(), 'id');
					
						if ($model->user_id == $userid){
				
					return Html::button('Release', ['value'=>Url::to('index.php?r=document/release&id=' . $model->id),'class' => 'showModalButton btn btn-success']);
							}else{
								//return Html::button('Confirm', ['value'=>Url::to('index.php?r=document/confirm&id=' . $model->id),'class' => 'showModalButton btn btn-success']);
								//return Html::a('Confirm', ['confirm'], ['id' => $model->id],['class' => 'btn btn-success']);
								return Html::a(Yii::t('app', 'Confirm'), ['confirm', 'id' => $model->id], ['class' => 'btn btn-danger']);
							}
					},
			],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
