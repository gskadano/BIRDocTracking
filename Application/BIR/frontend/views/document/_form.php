<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model common\models\Document */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="document-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'document_tracking_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'documentName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'documentDesc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'documentTargetDate')->widget(
    DatePicker::className(), [
        // inline too, not bad
         'inline' => false, 
         // modify template for custom rendering
        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
]);?>

    <?= $form->field($model, 'documentComment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'documentImage')->textInput() ?>

    <?= $form->field($model, 'documentUpdate')->textInput() ?>
	
	<?= $form->field($model, 'category_id')->textInput() ?>

    <?= $form->field($model, 'type_id')->textInput() ?>

    <?= $form->field($model, 'priority_id')->textInput() ?>
	
	<?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'companyAgency_id')->textInput() ?>
	
	<?= $form->field($model, 'section_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
