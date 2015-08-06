<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2; //===================
use yii\helpers\ArrayHelper;

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
				<?php //$form->field($model, 'position_id') 
					echo $form->field($model, 'position_id')->widget(Select2::classname(), [
						'data' => ArrayHelper::map(\common\models\Position::find()->all(), 'id', 'positionCode'),
						'options' => ['placeholder' => 'Select a position'],
						'pluginOptions' => [
							'allowClear' => true
						],
					]);?>
				<?php //$form->field($model, 'section_id') 
					echo $form->field($model, 'section_id')->widget(Select2::classname(), [
						'data' => ArrayHelper::map(\common\models\Section::find()->all(), 'id', 'sectionCode'),
						'options' => ['placeholder' => 'Select a section'],
						'pluginOptions' => [
							'allowClear' => true
						],
					]);?>
				<?= $form->field($model, 'userFName') ?>
				<?= $form->field($model, 'userMName') ?>
				<?= $form->field($model, 'userLName') ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
				<?= $form->field($model, 'auth_key') ?>
                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
