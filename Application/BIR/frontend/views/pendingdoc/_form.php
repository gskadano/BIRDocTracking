<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Pendingdoc */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pendingdoc-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pendingDocFName')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'pendingDocSection')->dropDownList(
        ArrayHelper::map(\common\models\Section::find()->all(),'id', 'sectionName'),
        ['prompt'=>'Section']
    ) ?>
	
    <?= $form->field($model, 'pendingDocName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pendingDocTimeRelease')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
