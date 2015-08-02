<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Docstatus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="docstatus-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'docStatusName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'docStatusDesc')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
