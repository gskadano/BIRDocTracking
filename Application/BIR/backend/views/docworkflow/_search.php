<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DocworkflowSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="docworkflow-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'document_id') ?>

    <?= $form->field($model, 'user_receive') ?>

    <?= $form->field($model, 'docStatus_id') ?>

    <?= $form->field($model, 'docWorkflowComment') ?>

    <?php // echo $form->field($model, 'timeAccepted') ?>

    <?php // echo $form->field($model, 'timeRelease') ?>

    <?php // echo $form->field($model, 'totalTimeSpent') ?>

    <?php // echo $form->field($model, 'user_release') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
