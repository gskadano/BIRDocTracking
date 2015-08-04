<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

<<<<<<< HEAD
   

	<?= $form->field($model, 'position_id')->dropDownList(
       // ArrayHelper::map(DocumentPriority::find()->all(),'id', 'document_priority_name'),
        ['prompt'=>'Position']
    ) ?>
	
	<?= $form->field($model, 'section_id')->dropDownList(
       // ArrayHelper::map(DocumentPriority::find()->all(),'id', 'document_priority_name'),
        ['prompt'=>'Section']
    ) ?>
	
    

    <?= $form->field($model, 'userFName')->textInput(['maxlength' => true]) ?>
=======
	<?= $form->field($model, 'position_id')->dropDownList(['Position A' => 'Static Position A', 'Position B' => 'Static Position B', 'Position C' => 'Static Position C']); ?>
	
	<?= $form->field($model, 'section_id')->dropDownList(['Section A' => 'Static Section A', 'Section B' => 'Static Section B', 'Section C' => 'Static Section C']); ?>
    
	<?= $form->field($model, 'userFName')->textInput(['maxlength' => true]) ?>
>>>>>>> 2784c335019513d25ef3cc981e2ac3dc03797c85

    <?= $form->field($model, 'userMName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userLName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'status')->dropDownList(['0' => 'Inactive', '1' => 'Active', '2' => 'Dormant']); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
