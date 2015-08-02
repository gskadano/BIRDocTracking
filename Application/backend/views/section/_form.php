<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Section */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="section-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sectionNum')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sectionCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sectionName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sectionDesc')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
