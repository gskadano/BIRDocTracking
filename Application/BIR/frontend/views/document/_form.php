<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\Document */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="document-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

 <!--   <?= $form->field($model, 'document_tracking_number')->textInput(['maxlength' => true]) ?>-->

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

	<?= $form->field($model, 'file')->fileInput() ?>
    
	<?php
    
    if ($model->documentImage)
	{
             echo '<img src="'.\Yii::$app->request->BaseUrl.'/'.$model->documentImage.'" width="90px">&nbsp;&nbsp;&nbsp;';
             //echo Html::a('Delete Logo', ['uploads/', 'id'=>$model->id, 'field'=> 'documentImage'], ['class'=>'btn btn-danger']).'<p>';
    }
    
	?>
	
	
	<?= $form->field($model, 'category_id')->dropDownList(
        ArrayHelper::map(\common\models\Category::find()->all(),'id', 'categoryName'),
        ['prompt'=>'Category']
    ) ?>

    <?= $form->field($model, 'type_id')->dropDownList(
        ArrayHelper::map(\common\models\Type::find()->all(),'id', 'typeName'),
        ['prompt'=>'Type']
    ) ?>

    <?= $form->field($model, 'priority_id')->dropDownList(
        ArrayHelper::map(\common\models\Priority::find()->all(),'id', 'priorityName'),
        ['prompt'=>'Priority']
    ) ?>
	
    <?= $form->field($model, 'companyAgency_id')->dropDownList(
        ArrayHelper::map(\common\models\Companyagency::find()->all(),'id', 'companyAgencyName'),
        ['prompt'=>'Company Agency']
    ) ?>
	
	<?= $form->field($model, 'section_id')->dropDownList(
        ArrayHelper::map(\common\models\Section::find()->all(),'id', 'sectionName'),
        ['prompt'=>'Section']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
