<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Document */
/* @var $form yii\widgets\ActiveForm */
?>



<div class="document-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'document_tracking_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'documentName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'documentDesc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'documentTargetDate')->textInput() ?>

    
	
	<?= $form->field($model, 'category_id')->dropDownList(
        ArrayHelper::map(\common\models\Category::find()->all(),'id', 'categoryName'),
        ['prompt'=>'Select Category']
    ) ?>

	
	<?= $form->field($model, 'type_id')->dropDownList(
        ArrayHelper::map(\common\models\Type::find()->all(),'id', 'typeName'),
        ['prompt'=>'Select Type']
    ) ?>
	
	<?= $form->field($model, 'priority_id')->dropDownList(
       ArrayHelper::map(\common\models\Priority::find()->all(),'id', 'priorityName'),
        ['prompt'=>'Select Priority']
    ) ?>
	
	
	

    <?= $form->field($model, 'documentComment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->dropDownList(
		//ArrayHelper::map(user::find()->all(),'id', 'userLName'),
        ['prompt'=>'Select Customer']
    ) ?>
	
	<?= $form->field($model, 'companyAgency_id')->dropDownList(
       // ArrayHelper::map(companyagency::find()->all(),'id', 'companyAgencyName'),
        ['prompt'=>'Select Company Agency']
    ) ?>

   
	 <?=$form->field($model, 'documentImage')->fileInput(); ?>

    <?= $form->field($model, 'section_id')->textInput() ?>

    <?= $form->field($model, 'documentCreate')->textInput() ?>

    <?= $form->field($model, 'documentUpdate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
