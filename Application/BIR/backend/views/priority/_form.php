<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Priority */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="priority-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'priorityName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'priorityDesc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'priorityCreate')->textInput() ?>

    <?= $form->field($model, 'priorityUpdate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
