<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Position */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="position-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'positionCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'positionName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'positionDesc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'positionNotes')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
