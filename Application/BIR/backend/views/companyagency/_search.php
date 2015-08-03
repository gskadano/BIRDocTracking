<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CompanyagencySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="companyagency-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'companyAgencyCode') ?>

    <?= $form->field($model, 'companyAgencyName') ?>

    <?= $form->field($model, 'companyAgencyDesc') ?>

    <?= $form->field($model, 'companyAgencyCreate') ?>

    <?php // echo $form->field($model, 'companyAgencyUpdate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
