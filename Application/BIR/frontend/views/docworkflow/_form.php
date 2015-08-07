<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Docworkflow */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="docworkflow-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'document_id')->textInput() ?>

    <?= $form->field($model, 'user_receive')->textInput() ?>

    <?= $form->field($model, 'docStatus_id')->textInput() ?>

    <?= $form->field($model, 'docWorkflowComment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'timeAccepted')->textInput() ?>

    <?= $form->field($model, 'timeRelease')->textInput() ?>

    <?= $form->field($model, 'totalTimeSpent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_release')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>