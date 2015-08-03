<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Companyagency */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="companyagency-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'companyAgencyCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'companyAgencyName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'companyAgencyDesc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'companyAgencyCreate')->textInput() ?>

    <?= $form->field($model, 'companyAgencyUpdate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
