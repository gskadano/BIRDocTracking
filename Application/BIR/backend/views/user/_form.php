<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use kartik\select2\Select2; //===================
use kartik\depdrop\DepDrop; //===================
use nenad\passwordStrength\PasswordInput;
/* @var $this yii\web\View */
/* @var $model backend\models\UserAdmin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-admin-form">

    <?php $form = ActiveForm::begin(); ?>
	
	<!--<?= $form->field($model, 'position_id')->dropDownList(
        ArrayHelper::map(\common\models\Position::find()->all(),'id', 'positionName'),
        ['prompt'=>'Position']
    ) ?>-->
	
	<!--<?= $form->field($model, 'section_id')->dropDownList(
       ArrayHelper::map(\common\models\Section::find()->all(),'id', 'sectionName'),
        ['prompt'=>'Section']
    ) ?>-->
	
	<?php //$form->field($model, 'position_id') 
		echo $form->field($model, 'position_id')->widget(Select2::classname(), [
			'data' => ArrayHelper::map(\common\models\Position::find()->all(), 'id', 'positionName'),
			'options' => ['placeholder' => 'Select a position'],
			'pluginOptions' => [
				'allowClear' => true
			],
		]);?>
	
	<?php //$form->field($model, 'section_id') 
		echo $form->field($model, 'section_id')->widget(Select2::classname(), [
			'data' => ArrayHelper::map(\common\models\Section::find()->all(), 'id', 'sectionName'),
			'options' => ['placeholder' => 'Select a section'],
			'pluginOptions' => [
				'allowClear' => true
			],
		]);?>
	
	<?= $form->field($model, 'userFName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userMName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userLName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true])->widget(PasswordInput::classname(), []) ?>

	<!--<?= $form->field($model, 'status')->dropDownList(['10' => 'Active', '0' => 'Inactive']); ?>-->
	<?php echo $form->field($model, 'status')->widget(Select2::classname(), [
			'data' => (['10' => 'Active', '0' => 'Inactive']),
			'options' => ['placeholder' => 'Select a status'],
			'pluginOptions' => [
				'allowClear' => true
			],
		]);?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
