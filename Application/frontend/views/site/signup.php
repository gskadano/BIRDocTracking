<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2; //===================

use backend\models\Users;
use backend\models\Position;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
				<?php 
					//$query = new Query;
					//$query->select('id')
					//	->from('position');
					//$command = $query->createCommand();
					//$data = $command->queryAll();  ?>
				<?= $form->field($model, 'position_id')->widget(Select2::classname(), [
						//'data' => $data,
						'data' => array_merge(["" => ""], backend\models\User::getPosition()),
						//'data' => ArrayHelper::map(Position::find()->all(),'id', 'id'),
						'options' => ['placeholder' => 'Select a position'],
						'pluginOptions' => [
						'allowClear' => true
						],
					]); ?>
                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
