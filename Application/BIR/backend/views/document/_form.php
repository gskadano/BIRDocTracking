<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Document */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
use yii\helpers\ArrayHelper;
use backend\models\Standard;
?>


<div class="document-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'document_tracking_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'documentName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'documentDesc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'documentTargetDate')->textInput() ?>

    <?= $form->field($model, 'category_id')->textInput() ?>

    <?= $form->field($model, 'type_id')->textInput() ?>

    
	<?= $form->field($model, 'priority_id')->dropDownList(
       // ArrayHelper::map(DocumentPriority::find()->all(),'id', 'document_priority_name'),
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
