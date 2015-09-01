<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Release Documents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <p>Assign to:</p>

    <div class="row">
        <div class="col-lg-8">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= 
				$form->field($model, 'user_id')->dropDownList(
					ArrayHelper::map(\common\models\User::find()->all(),'id', 'username'),
					['prompt'=>'User']
				) ?>
                <div class="form-group">
                    <?= Html::submitButton('Release', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
