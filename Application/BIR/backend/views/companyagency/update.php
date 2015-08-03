<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Companyagency */

$this->title = 'Update Companyagency: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Companyagencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="companyagency-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
